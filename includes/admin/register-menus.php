<?php

namespace EasyElements\Admin;


use EasyElements\Core\Modules_List;

/**
 * Class Register_Menus
 *
 * @package EasyElements\Admin
 */
class Register_Menus {

    /**
     * @var
     */
    private $dashboard;

    /**
     * Menu constructor.
     */
    public function __construct( $dashboard ) {
        $this->dashboard = $dashboard;
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
        // Hook to admin notices and remove them on your options page
        add_action('admin_notices', array($this, 'remove_admin_notices'));
        add_filter( 'plugin_action_links_easy-element/easy-element.php', array( $this, 'plugin_setting_link' ) );
    }

    /**
     * Crate admin menu
     */
    public function admin_menu() {
        $capability = 'manage_options';
        $parent_slug = 'easyelements';

        add_menu_page( esc_html__( 'Easy Elements', 'easyelements' ), esc_html__( 'Easy Elements', 'easyelements' ), $capability, $parent_slug, array( $this->dashboard, 'page' ), ELE_PLUGIN_URL . 'assets/admin/images/logo-icon.gif', 58.50 );
        add_submenu_page( $parent_slug, esc_html__( 'Easy Elements', 'easyelements' ), esc_html__( 'Easy Elements', 'easyelements' ), $capability, $parent_slug, array( $this->dashboard, 'page' ) );

        $modules = Modules_List::get_all_modules_list();
        if ( $modules['template-builder']['active']  == true ) {
            add_submenu_page(
                $parent_slug,
                esc_html__( 'Theme builder', 'easyelements' ),
                esc_html__( 'Theme builder', 'easyelements' ),
                $capability, "edit.php?post_type=ele-template-builder"
            );
        }
    }

    /**
     * Plugin setting page link
     *
     * @param $link
     * @return mixed
     */
    public function plugin_setting_link( $link ) {
        $new_link = sprintf("<a href='%s'>%s</a>","admin.php?page=easy-elements",esc_html__("Setting","easyelements"));
        $link[]   = $new_link;
        return $link;
    }

    public function remove_admin_notices() {
        // Check if the current page is your options page
        $current_screen = get_current_screen();
        if ($current_screen && $current_screen->id === 'toplevel_page_easy-elements') {
            // Remove all notices
            remove_all_actions('admin_notices');
            remove_all_actions('all_admin_notices');
        }
    }

}