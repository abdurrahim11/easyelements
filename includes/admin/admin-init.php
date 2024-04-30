<?php

namespace EasyElements\Admin;


/**
 * Class Admin_Init
 *
 * @package EasyElements\Admin
 */
class Admin_Init {

    /**
     * Instance of admin
     */
    public static function get_instance() {
        $dashboard = new Dashboard\Dashboard();
        new Register_Menus( $dashboard );
    }

}