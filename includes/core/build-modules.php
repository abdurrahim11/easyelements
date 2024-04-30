<?php


namespace EasyElements\Core;


class Build_Modules {

    use \EasyElements\Traits\Singleton;

    private $modules;

    public function __construct() {
        $this->modules = \EasyElements\Core\Modules_List::get_active_modules_list();

        foreach ( $this->modules as $module_slug => $module ) {
            // make the class name and call it.
            $class_name = (
            isset( $module['base_class_name'] )
                ? $module['base_class_name']
                : '\EasyElements\Modules\\' . ele_make_classname( $module_slug ) . '\Init'
            );

            if ( class_exists( $class_name ) ) {
                new $class_name();
            }
        }
    }
}