<?php


namespace EasyElements\Control;

class Register_Controls {

    use \EasyElements\Traits\Singleton;

    public function __construct() {
        add_action( 'elementor/controls/controls_registered', array( $this, 'register_controls' ) );
    }

    public function register_controls() {

        $controls_manager = \Elementor\Plugin::instance()->controls_manager;
        $controls_manager->register( new Image_Selector() );
        $controls_manager->register( new Select2() );
        $controls_manager->add_group_control( Group_Control_Foreground::get_type(), new Group_Control_Foreground() );
    }
}