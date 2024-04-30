<?php

namespace EasyElements;


/**
 * Class Init
 *
 * @package EasyElements
 */
class Init {

    /**
     * Load plugin necessary class.
     */
    public static function easy_elements_setup() {

        if ( is_admin() ) {
            Admin\Admin_Init::get_instance();
        }



        Core\Build_Modules::instance();

        Control\Register_Controls::instance();
        Core\build_Elementor_Widget::instance();
        new Assets();
    }
}