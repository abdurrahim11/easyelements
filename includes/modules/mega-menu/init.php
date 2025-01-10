<?php


namespace EasyElements\Modules\Mega_Menu;


class Init {

    public static $menuitem_settings_key = 'easyelements_menuitem_settings';
    public static $megamenu_settings_key = 'megamenu_settings';

    public function __construct() {
        $this->initialize();
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
    }

    public function initialize() {
        new \EasyElements\Modules\Mega_Menu\Mega_Menu_Options();
        new \EasyElements\Modules\Mega_Menu\Megamenu_Api();
    }

    public function enqueue() {
        $screen = get_current_screen();

        if ( $screen->base == 'nav-menus' ) {
            wp_enqueue_style( 'wp-color-picker' );

            wp_enqueue_style(
                'easy-elements-icons',
                ELE_PLUGIN_URL . 'includes/modules/icon-library/assets/css/eleicons.css',
                null,
                ELE_VERSION
            );

            wp_enqueue_style(
                'aesthetic-ele-picker-fonts',
                ELE_PLUGIN_URL . 'assets/libs/font-awesome/css/all.min.css',
                null,
                ELE_VERSION
            );

            wp_enqueue_style(
                'aesthetic-icon-picker',
                ELE_PLUGIN_URL . 'assets/libs/aesthetic-icon-picker/css/aesthetic-icon-picker.css',
                null,
                ELE_VERSION
            );

            wp_enqueue_style(
                'ele-meag-menu',
                ELE_PLUGIN_URL . 'includes/modules/mega-menu/assets/css/meag-menu-style.css',
                false,
                ELE_VERSION
            );

            wp_enqueue_script(
                'aesthetic-icon-picker',
                ELE_PLUGIN_URL . 'assets/libs/aesthetic-icon-picker/js/aesthetic-icon-picker.js',
                array('jquery'),
                ELE_VERSION,
                true
            );

            wp_enqueue_script(
                'ele-meag-menu',
                ELE_PLUGIN_URL . 'includes/modules/mega-menu/assets/js/meag-menu-script.js',
                array( 'jquery', 'wp-color-picker' ),
                ELE_VERSION,
                true
            );

        }
    }

}
