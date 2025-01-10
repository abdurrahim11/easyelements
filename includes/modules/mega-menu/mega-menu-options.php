<?php

namespace EasyElements\Modules\Mega_Menu;

class Mega_Menu_Options {
    protected $current_menu_id = null; // Stores the current menu ID

    public function __construct() {
        // Hook methods to appropriate WordPress actions
        add_action( 'admin_footer', array( $this, 'render_options_menu_item' ) );
        add_action( 'admin_footer', array( $this, 'render_options_megamenu' ) );
        add_action( 'admin_head', array( $this, 'handle_megamenu_options_save' ) );
    }

    // Retrieves the current menu ID
    public function get_current_menu_id() {
        if ( null !== $this->current_menu_id ) {
            return $this->current_menu_id;
        }

        // Get all nav menus
        $nav_menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );
        $menu_count = count( $nav_menus );

        // Get selected menu ID from request
        $selected_menu_id = isset( $_REQUEST['menu'] ) ? (int) $_REQUEST['menu'] : 0;
        $is_new_menu_screen = ( isset( $_GET['menu'] ) && 0 == $_GET['menu'] ) ? true : false;

        $this->current_menu_id = $selected_menu_id;

        // Check if there is one theme location with no menus
        $page_count = wp_count_posts( 'page' );
        $one_theme_location_no_menus = ( 1 == count( get_registered_nav_menus() ) && ! $is_new_menu_screen && empty( $nav_menus ) && ! empty( $page_count->publish ) ) ? true : false;

        // Get the recently edited menu ID
        $recently_edited_menu_id = absint( get_user_option( 'nav_menu_recently_edited' ) );
        if ( empty( $recently_edited_menu_id ) && is_nav_menu( $this->current_menu_id ) ) {
            $recently_edited_menu_id = $this->current_menu_id;
        }

        // Use the recently edited menu ID if none are selected
        if ( empty( $this->current_menu_id ) && ! isset( $_GET['menu'] ) && is_nav_menu( $recently_edited_menu_id ) ) {
            $this->current_menu_id = $recently_edited_menu_id;
        }

        // Set the first menu ID if the current menu is deleted
        if ( ! $is_new_menu_screen && 0 < $menu_count && isset( $_GET['action'] ) && 'delete' === $_GET['action'] ) {
            $this->current_menu_id = $nav_menus[0]->term_id;
        }

        // Set current menu ID to 0 if no menus
        if ( $one_theme_location_no_menus ) {
            $this->current_menu_id = 0;
        } elseif ( empty( $this->current_menu_id ) && ! empty( $nav_menus ) && ! $is_new_menu_screen ) {
            $this->current_menu_id = $nav_menus[0]->term_id;
        }

        return $this->current_menu_id;
    }

    // Returns an array of icons
    public static function get_icons() {
        return array(
            'fa-external-link-alt' => 'fas fa-external-link-alt',
            'fas fa-external-link-alt' => 'fas fa-external-link-alt',
        );
    }

    // Renders the options menu item
    public function render_options_menu_item() {
        $screen = get_current_screen();
        if ( 'nav-menus' !== $screen->base ) {
            return;
        }

        include __DIR__ . '/views/options-menu-item.php';
    }

    // Renders the megamenu options
    public function render_options_megamenu() {
        $screen = get_current_screen();
        if ( 'nav-menus' !== $screen->base ) {
            return;
        }

        $menu_id = $this->get_current_menu_id();
        $megamenu_data = ele_get_option( Init::$megamenu_settings_key, array() );
        $megamenu_data = isset( $megamenu_data[ 'menu_location_' . $menu_id ] ) ? $megamenu_data[ 'menu_location_' . $menu_id ] : array();
        include __DIR__ . '/views/options-megamenu.php';
    }

    // Handles saving megamenu options
    public function handle_megamenu_options_save() {
        $screen = get_current_screen();

        if ( 'nav-menus' !== $screen->base || ! isset( $_POST['update-nav-menu-nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['update-nav-menu-nonce'] ) ), 'update-nav_menu' ) ) {
            return;
        }

        $menu_id = isset( $_POST['menu'] ) ? intval( wp_unslash( $_POST['menu'] ) ) : 0;
        $is_megamenu_enabled = isset( $_POST['ele_is_enabled'] ) ? intval( wp_unslash( $_POST['ele_is_enabled'] ) ) : 0;

        $megamenu_data = ele_get_option( Init::$megamenu_settings_key, array() );
        $megamenu_data[ 'menu_location_' . $menu_id ] = array(
            'ele_is_enabled' => $is_megamenu_enabled,
        );

        ele_save_option( Init::$megamenu_settings_key, $megamenu_data );
    }
}
?>