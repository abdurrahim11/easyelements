<?php


namespace EasyElements\Elementor_Widgets\Init;


class Register_Widget_Categories {

    public function __construct() {
        add_action( 'elementor/elements/categories_registered', array( $this, 'add_elementor_widget_categories' ), 1 );
    }

    public function add_elementor_widget_categories( $elements_manager ) {
        $elements_manager->add_category(
            'easyelements',
            [
                'title' => esc_html__( 'EasyElements', 'easyelements' ),
                'icon' => 'fa fa-plug',
            ]
        );
    }
}