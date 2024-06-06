<?php
/**
 * Plugin Name:       Easy Elements
 * Plugin URI:        http://joydevs.com/
 * Description:       Easy Elements
 * Version:           1.0.0
 * Author:            JoyDevs
 * Author URI:        https://joydevs.com/
 * License:           GPL v2 or later
 * Text Domain:       easy-elements
 * Domain Path:       /languages/
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Easy_Elements' ) ) {

    /**
     * The main plugin class
     */
    final class Easy_Elements {

        /**
         * Easy_Elements constructor.
         */
        private function __construct() {
            $this->define_constants();

            register_activation_hook( __FILE__, array( $this, 'activate' ) );
            add_action( 'plugins_loaded', array( $this, 'init_plugin' ) );
            add_action( 'plugins_loaded', array( $this, 'plugins_loaded_text_domain' ) );
            add_action( 'register_plugin_activation', array( $this, 'activate' ) );
        }

        /**
         * Initializes a single instance
         */
        public static function init() {
            static $instance = false;

            if ( ! $instance ) {
                $instance = new self();
            }

            return $instance;
        }

        /**
         * Plugin text domain loaded
         */
        public function plugins_loaded_text_domain() {
            load_plugin_textdomain( 'easy-elements', false, ELE_PLUGIN_PATH . 'languages/' );
        }

        /**
         * Define plugin path and url constants
         */
        public function define_constants() {
            define( 'ELE_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
            define( 'ELE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
            define( 'ELE_ADMIN_ASSETS_UR', plugin_dir_url( __FILE__ ) . 'assets/admin/' );
            define( 'ELE_WIDGET_ASSETS_PATH', plugin_dir_path( __FILE__ ) . 'includes/elementor-widgets/' );
            define( 'ELE_KITS_BASE_API_URL', 'https://api.easyelementspro.com/wp-json/custom-api/v1/' );
            define( 'ELE_VERSION', time() );
        }

        /**
         *  Init plugin
         */
        public function init_plugin() {
            require_once ELE_PLUGIN_PATH . 'autoloader.php';
            require_once ELE_PLUGIN_PATH . 'includes/functions.php';
            \EasyElements\Init::easy_elements_setup();
        }

        /***
         * Do Stuff Plugin activation
         */
        public function activate() {

        }
    }

}

/**
 * Initializes the main plugin
 *
 * @return \Easy_Elements
 */
function easy_elements() {
    return Easy_Elements::init();
}

/**
 * Rick off the plugin
 */
easy_elements();


/*
add_action( 'admin_init', function () {
    $plugin_slug = 'popup-maker';

    if ( install_plugin_by_slug( $plugin_slug ) ) {
        if (!is_plugin_active($plugin_slug . '/' . $plugin_slug . '.php')) {
            $activation_result = activate_plugin($plugin_slug . '/' . $plugin_slug . '.php');
            if (is_wp_error($activation_result)) {
                wp_send_json_error('Error activating plugin ' . $plugin_slug . ': ' . $activation_result->get_error_message());
            }
        }
    }
});
*/
function install_plugin_by_slug($plugin_slug) {
    include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
    include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

    $api = plugins_api('plugin_information', array('slug' => $plugin_slug));
    if (is_wp_error($api)) {
        return $api;
    }

    $upgrader = new Plugin_Upgrader(new WP_Ajax_Upgrader_Skin());
    $install_result = $upgrader->install($api->download_link);
    return $install_result;
}



function test_ajax_install_plugin( $slug ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
    require_once ABSPATH . 'wp-admin/includes/plugin-install.php';

    $api = plugins_api(
        'plugin_information',
        array(
            'slug'   => sanitize_key( wp_unslash( $slug ) ),
            'fields' => array(
                'sections' => false,
            ),
        )
    );

    if ( is_wp_error( $api ) ) {
        $status['errorMessage'] = $api->get_error_message();
        wp_send_json_error( $status );
    }

    $status['pluginName'] = $api->name;

    $skin     = new WP_Ajax_Upgrader_Skin();
    $upgrader = new Plugin_Upgrader( $skin );
    $result   = $upgrader->install( $api->download_link );

    if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
        $status['debug'] = $skin->get_upgrade_messages();
    }

    if ( is_wp_error( $result ) ) {
        $status['errorCode']    = $result->get_error_code();
        $status['errorMessage'] = $result->get_error_message();
        wp_send_json_error( $status );
    } elseif ( is_wp_error( $skin->result ) ) {
        $status['errorCode']    = $skin->result->get_error_code();
        $status['errorMessage'] = $skin->result->get_error_message();
        wp_send_json_error( $status );
    } elseif ( $skin->get_errors()->has_errors() ) {
        $status['errorMessage'] = $skin->get_error_messages();
        wp_send_json_error( $status );
    } elseif ( is_null( $result ) ) {
        global $wp_filesystem;

        $status['errorCode']    = 'unable_to_connect_to_filesystem';
        $status['errorMessage'] = __( 'Unable to connect to the filesystem. Please confirm your credentials.' );

        // Pass through the error from WP_Filesystem if one was raised.
        if ( $wp_filesystem instanceof WP_Filesystem_Base && is_wp_error( $wp_filesystem->errors ) && $wp_filesystem->errors->has_errors() ) {
            $status['errorMessage'] = esc_html( $wp_filesystem->errors->get_error_message() );
        }

        wp_send_json_error( $status );
    }

    $install_status = install_plugin_install_status( $api );
    $pagenow        = isset( $_POST['pagenow'] ) ? sanitize_key( $_POST['pagenow'] ) : '';

    // If installation request is coming from import page, do not return network activation link.
    $plugins_url = ( 'import' === $pagenow ) ? admin_url( 'plugins.php' ) : network_admin_url( 'plugins.php' );

    if ( current_user_can( 'activate_plugin', $install_status['file'] ) && is_plugin_inactive( $install_status['file'] ) ) {
        $status['activateUrl'] = add_query_arg(
            array(
                '_wpnonce' => wp_create_nonce( 'activate-plugin_' . $install_status['file'] ),
                'action'   => 'activate',
                'plugin'   => $install_status['file'],
            ),
            $plugins_url
        );
    }

    if ( is_multisite() && current_user_can( 'manage_network_plugins' ) && 'import' !== $pagenow ) {
        $status['activateUrl'] = add_query_arg( array( 'networkwide' => 1 ), $status['activateUrl'] );
    }

    wp_send_json_success( $status );
}



























/**
 * Filter to change the icon HTML output to use <i> tag instead of SVG.
 */
function change_icon_output_to_i_tag( $icon, $icon_data ) {
    if ( 'fontawesome' === $icon_data['library'] ) {
        // If the icon library is Font Awesome, generate <i> tag
        $icon = '<i class="' . esc_attr( $icon_data['value'] ) . '"></i>';
    }
    return $icon;
}

// Hook the filter to change icon output
add_filter( 'elementor/icons/render', 'change_icon_output_to_i_tag', 10, 2 );

//This is testing
