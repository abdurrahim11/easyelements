<?php


namespace EasyElements\Elementor_Widgets;


class Register_Widget_Categories {

    public function __construct() {
        add_action( 'elementor/elements/categories_registered', array( $this, 'add_elementor_widget_categories' ) );
    }

    public function add_elementor_widget_categories( $elements_manager ) {
        $elements_manager->add_category(
            'easy-elements',
            [
                'title' => esc_html__( 'EasyElements', 'easy-elements' ),
                'icon' => 'fa fa-plug',
            ]
        );
    }
}