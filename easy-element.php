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
use Elementor\Plugin;

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
            flush_rewrite_rules();
            update_option('elementor_load_fa4_shim', 'yes');
            //update_option('elementor_load_fa4_shim', 'no');
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


 function add_elementor_widget_categories( $elements_manager ) {
    $elements_manager->add_category(
        'easy-elements',
        [
            'title' => esc_html__( 'EasyElements', 'easy-elements' ),
            'icon' => 'fa fa-plug',
        ]
    );
}

//add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );






add_action( 'elementor/init', 'xprodsdsd_elementor_init' );
 function xprodsdsd_elementor_init() {




}
