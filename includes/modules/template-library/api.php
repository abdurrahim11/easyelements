<?php


namespace EasyElements\Modules\Template_Library;


class Api {

    public function __construct() {
        add_action('wp_ajax_ele_get_templates', [ $this, 'get_templates' ] );
    }

    public function get_templates() {
        // Verify the nonce
        if ( ! isset( $_REQUEST['_ajax_nonce'] ) || ! wp_verify_nonce( wp_unslash( $_REQUEST['_ajax_nonce'] ), 'easyelements_nonce' ) ) {
            wp_send_json_error( array( 'message' => 'Invalid nonce' ), 400 );
            exit();
        }

        if ( ! isset( $_REQUEST['tab'] ) ) {
            exit();
        }

        // Unslash and sanitize the 'tab' parameter
        $tab = sanitize_text_field( wp_unslash( $_REQUEST['tab'] ) );
        $kit_type = 1;

        switch ( $tab ) {
            case "ele_page":
                $kit_type = 1;
                break;
            case "ele_block":
                $kit_type = 2;
                break;
            case "ele_header":
                $kit_type = 3;
                break;
            case "ele_footer":
                $kit_type = 4;
                break;
            default:
                $kit_type = 1;
        }

        $request_url = add_query_arg( array(
            'kit_type' => $kit_type,
        ), ELE_KITS_BASE_API_URL . 'template-kits/' );

        $response = wp_remote_get( $request_url, [
            'timeout'   => 120,
            'sslverify' => false
        ] );

        if ( is_wp_error( $response ) ) {
            $error_message = $response->get_error_message();
            echo "Error: $error_message";
        } else {
            $data = wp_remote_retrieve_body( $response );
            echo wp_send_json( json_decode( $data ), 200 );
        }
    }
}