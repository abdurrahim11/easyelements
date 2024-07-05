<?php

namespace EasyElements\Admin;


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
        //add_filter( 'plugin_action_links_appointment-booking-and-scheduling/appointment-booking-and-scheduling.php', array( $this, 'plugin_setting_link' ) );
    }

    /**
     * Crate admin menu
     */
    public function admin_menu() {
        $capability = 'manage_options';
        $parent_slug = 'easy-elements';

        add_menu_page( esc_html__( 'Easy Elements', 'easy-elements' ), esc_html__( 'Easy Elements', 'easy-elements' ), $capability, $parent_slug, array( $this->dashboard, 'page' ), ELE_PLUGIN_URL . 'assets/admin/images/logo-icon.gif', 58.50 );
        add_submenu_page( $parent_slug, esc_html__( 'Easy Elements', 'easy-elements' ), esc_html__( 'Easy Elements', 'easy-elements' ), $capability, $parent_slug, array( $this->dashboard, 'page' ) );
        add_submenu_page(
            $parent_slug,
            esc_html__( 'Template Builder', 'easy-elements' ),
            esc_html__( 'Template Builder', 'easy-elements' ),
            $capability, "edit.php?post_type=ele-template-builder" );



    }


    /**
     * Plugin setting page link
     *
     * @param $link
     * @return mixed
     */
    public function plugin_setting_link( $link ) {
        $new_link = sprintf("<a href='%s'>%s</a>","admin.php?page=calendar-manage",esc_html__("Setting","woo-address-auto-complete"));
        $link[]   = $new_link;
        return $link;
    }

}