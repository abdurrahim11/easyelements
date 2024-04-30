<?php

namespace EasyElements\Modules\Live_Copy_Paste;

use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Controls_Stack;


/**
 * Class Live_Copy_Paste
 *
 * @package EasyElements\Modules\Editor\LiveCopy
 */
class Init {

    public function __construct() {
        add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'live_copy_enqueue' ] );
        add_action( 'wp_ajax_premium_cross_cp_import', array( $this, 'cross_cp_fetch_content_data' ) );
    }

    public function live_copy_enqueue(){
        wp_enqueue_script(
            'ele-live-copy-storage',
            ELE_PLUGIN_URL . 'assets/editor/live-copy-paste/js/xdLocalStorage.js',
            array(),
            ELE_VERSION,
            true
        );

        wp_enqueue_script(
            'ele-live-copy-scripts',
            ELE_PLUGIN_URL . 'assets/editor/live-copy-paste/js/live-copy-paste.js',
            array(
                'jquery',
                'elementor-editor',
                'ele-live-copy-storage'
            ),
            ELE_VERSION,
            true
        );

        // Check for required Compatible Elementor version.
        if ( ! version_compare( ELEMENTOR_VERSION, '3.1.0', '>=' ) ) {
            $elementor_old = true;
        } else {
            $elementor_old = false;
        }

        wp_localize_script(
            'ele-live-copy-scripts',
            'premium_cross_cp',
            array(
                'ajax_url'            => admin_url( 'admin-ajax.php' ),
                'nonce'               => wp_create_nonce( 'premium_cross_cp_import' ),
                'elementorCompatible' => $elementor_old,
            )
        );
    }


    public static function cross_cp_fetch_content_data() {
        check_ajax_referer( 'premium_cross_cp_import', 'nonce' );

        if ( ! current_user_can( 'edit_posts' ) ) {
            wp_send_json_error( __( 'Not a valid user', 'premium-addons-for-elementor' ), 403 );
        }

        $media_import = isset( $_POST['copy_content'] ) ? wp_unslash( $_POST['copy_content'] ) : '';

        if ( empty( $media_import ) ) {
            wp_send_json_error( __( 'Empty Content.', 'premium-addons-for-elementor' ) );
        }

        $media_import = array( json_decode( $media_import, true ) );
        $media_import = self::cross_cp_import_elements_ids( $media_import );
        $media_import = self::cross_cp_import_copy_content( $media_import );

        wp_send_json_success( $media_import );
    }

    protected static function cross_cp_import_elements_ids( $media_import ) {
        return \Elementor\Plugin::instance()->db->iterate_data(
            $media_import,
            function( $element ) {
                $element['id'] = Utils::generate_random_string();
                return $element;
            }
        );
    }

    protected static function cross_cp_import_copy_content( $media_import ) {
        return \Elementor\Plugin::instance()->db->iterate_data(
            $media_import,
            function( $element_data ) {
                $element = \Elementor\Plugin::instance()->elements_manager->create_element_instance( $element_data );

                if ( ! $element ) {
                    return null;
                }

                return self::cross_cp_import_element( $element );
            }
        );
    }

    protected static function cross_cp_import_element( Controls_Stack $element ) {
        $element_data = $element->get_data();
        $method = 'on_import';

        if ( method_exists( $element, $method ) ) {
            $element_data = $element->{$method}( $element_data );
        }

        foreach ( $element->get_controls() as $control ) {
            $control_class = \Elementor\Plugin::instance()->controls_manager->get_control( $control['type'] );

            if ( ! $control_class ) {
                continue;
            }

            if ( method_exists( $control_class, $method ) ) {
                if ( 'media' !== $control['type'] && 'hedia' !== $control['type'] && 'repeater' !== $control['type'] ) {
                    $element_data['settings'][ $control['name'] ] = $control_class->{$method}( $element->get_settings( $control['name'] ), $control );
                } elseif ( 'repeater' === $control['type'] ) {
                    $element_data['settings'][ $control['name'] ] = self::on_import_repeater( $element->get_settings( $control['name'] ), $control );
                } else {
                    if ( ! empty( $element_data['settings'][ $control['name'] ]['url'] ) ) {
                        $element_data['settings'][ $control['name'] ] = self::on_import_media( $element->get_settings( $control['name'] ) );
                    }
                }
            }
        }

        return $element_data;
    }

    protected static function on_import_media( $settings ) {
        if ( empty( $settings['url'] ) || false !== strpos( $settings['url'], 'placeholder' ) ) {
            return $settings;
        }

        $settings = \Elementor\Plugin::$instance->templates_manager->get_import_images_instance()->import( $settings );

        return $settings;
    }

    protected static function on_import_repeater( $settings, $control_data = array() ) {
        if ( empty( $settings ) || empty( $control_data['fields'] ) ) {
            return $settings;
        }

        $method = 'on_import';

        foreach ( $settings as &$item ) {
            foreach ( $control_data['fields'] as $field ) {
                if ( empty( $field['name'] ) || empty( $item[ $field['name'] ] ) ) {
                    continue;
                }

                $control_obj = \Elementor\Plugin::$instance->controls_manager->get_control( $field['type'] );

                if ( ! $control_obj ) {
                    continue;
                }

                if ( method_exists( $control_obj, $method ) ) {
                    if ( 'media' !== $field['type'] && 'hedia' !== $field['type'] ) {
                        $item[ $field['name'] ] = $control_obj->{$method}( $item[ $field['name'] ], $field );
                    } else {
                        if ( ! empty( $item[ $field['name'] ]['url'] ) ) {
                            $item[ $field['name'] ] = self::on_import_media( $item[ $field['name'] ] );
                        }
                    }
                }
            }
        }

        return $settings;
    }
}