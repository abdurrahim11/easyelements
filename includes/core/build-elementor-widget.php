<?php


namespace EasyElements\Core;



class build_Elementor_Widget {

    use \EasyElements\Traits\Singleton;

    private $widgets;


    public function __construct() {
        $this->initialize();
        $this->widgets = \EasyElements\Core\Elementor_Widget_List::get_active_widget_list();
        add_action( 'elementor/widgets/register', array( $this, 'register_widget' ) );
    }

    private function initialize() {
        new \EasyElements\Elementor_Widgets\Register_Widget_Categories();
        new \EasyElements\Elementor_Widgets\Enqueue_Scripts();
    }

    public function register_widget( $widgets_manager ) {
        foreach ( $this->widgets as $widget_slug => $widget ) {
            $class_name = '\\EasyElements\Elementor_Widgets\\' . ele_make_classname( $widget_slug ) . '\\' . ele_make_classname( $widget_slug );
            if ( class_exists( $class_name ) ) {
                $widgets_manager->register( new $class_name() );
            }
        }

    }
}