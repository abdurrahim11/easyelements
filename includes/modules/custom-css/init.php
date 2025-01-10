<?php

namespace EasyElements\Modules\Custom_Css;

use Elementor\Controls_Manager;

class Init {

    public function __construct() {
        add_action( 'elementor/editor/after_enqueue_scripts', array( $this, 'enqueue_editor_scripts' ) );
        add_action( 'elementor/element/after_section_end', [ $this, 'register_custom_css_controls' ], 25, 3 );
        add_action( 'elementor/element/parse_css', [ $this, 'render_custom_css' ], 10, 2 );
    }
    public function enqueue_editor_scripts() {
        wp_enqueue_script(
            'ele-editor-scripts',
            ELE_PLUGIN_URL . 'includes/modules/custom-css/assets/js/editor-scripts.js',
            array( 'jquery' ),
            ELE_VERSION.
            true
        );
    }

    public function register_custom_css_controls( $element, $section_id ) {
        if ( 'section_custom_css_pro' !== $section_id ) {
            return;
        }

        $allowed_elements = [ 'section', 'column', 'common', 'container' ];
        if ( in_array( $element->get_name(), $allowed_elements, true ) ) {
            $element->start_controls_section(
                'section_ele_elementor_custom_css',
                [
                    'label' => esc_html__( 'Custom CSS', 'ele-elementor-addons' ),
                    'tab'   => Controls_Manager::TAB_ADVANCED,
                ]
            );

            $element->add_control(
                'ele_custom_css',
                [
                    'type'        => Controls_Manager::CODE,
                    'label'       => esc_html__( 'Custom CSS', 'ele-elementor-addons' ),
                    'render_type' => 'ui',
                    'show_label'  => false,
                    'language'    => 'css',
                ]
            );

            $element->add_control(
                'ele_custom_css_description',
                [
                    'raw'             => esc_html__( 'Use "selector" to target wrapper element. Examples:<br>selector {color: red;} // For main element<br>selector .child-element {margin: 10px;} // For child element<br>.my-class {text-align: center;} // Or use any custom selector', 'ele-elementor-addons' ),
                    'type'            => Controls_Manager::RAW_HTML,
                    'content_classes' => 'elementor-descriptor',
                ]
            );

            $element->end_controls_section();
        }
    }

    public function render_custom_css( $post_css, $element ) {
        $element_settings = $element->get_settings();
        if ( empty( $element_settings['ele_custom_css'] ) ) {
            return;
        }

        $css = trim( $element_settings['ele_custom_css'] );
        if ( empty( $css ) ) {
            return;
        }

        $css = str_replace( 'selector', $post_css->get_element_unique_selector( $element ), $css );
        $css = sprintf( '/* Start custom CSS for %s, class: %s */', $element->get_name(), $element->get_unique_selector() ) . $css . '/* End custom CSS */';

        $post_css->get_stylesheet()->add_raw_css( $css );
    }
}