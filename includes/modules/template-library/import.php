<?php


namespace EasyElements\Modules\Template_Library;


use Elementor\Core\Common\Modules\Ajax\Module as Ajax;

class Import {

    public function __construct() {
        add_action( 'elementor/ajax/register_actions', [ $this, 'register_ajax_actions' ] );
    }

    public function register_ajax_actions( Ajax $ajax ) {
        $ajax->register_ajax_action( 'ele_template_import', function( $data ) {
            if ( ! current_user_can( 'edit_posts' ) ) {
                throw new \Exception( 'Access Denied' );
            }

            if ( ! empty( $data['editor_post_id'] ) ) {
                $editor_post_id = absint( $data['editor_post_id'] );

                if ( ! get_post( $editor_post_id ) ) {
                    throw new \Exception( esc_html__( 'Post not found', 'easyelements' ) );
                }

                \Elementor\Plugin::instance()->db->switch_to_post( $editor_post_id );
            }

            if ( empty( $data['template_id'] ) ) {
                throw new \Exception( esc_html__( 'Template id missing', 'easyelements' ) );
            }

            $result = $this->get_template_data( $data );

            return $result;
        } );
    }

    public function get_template_data( array $args ) {
        $source = new Library_Source();
        $data = $source->import( $args );
        return $data;
    }

}