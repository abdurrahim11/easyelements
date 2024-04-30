<?php


namespace EasyElements\Modules\Custom_Css;

use Elementor\Controls_Manager;

class Init {
    
    public function __construct() {
        add_action( 'elementor/element/after_section_end', array( $this, 'register' ), 25, 3 );
        // Render the custom CSS
        add_action( 'elementor/element/parse_css', array( $this, 'ele_elementor_add_post_css' ), 10, 2 );
    }
    
    public function register( $element, $section_id ) {

        if ( 'section_custom_css_pro' !== $section_id ) {
            return;
        }

        if ( in_array( $element->get_name(), array( 'section', 'column', 'common', 'container' ), true ) ) {

            $element->start_controls_section(
                'section_ele_elementor_custom_css',
                array(
                    'label' => __( ' Custom CSS', 'ele-elementor-addons' ),
                    'tab'   => Controls_Manager::TAB_ADVANCED,
                )
            );

            $element->add_control(
                'ele_custom_css',
                array(
                    'type'        => Controls_Manager::CODE,
                    'label'       => __( 'Custom CSS', 'ele-elementor-addons' ),
                    'render_type' => 'ui',
                    'show_label'  => false,
                    'language'    => 'css',
                )
            );

            $element->add_control(
                'ele_custom_css_description',
                array(
                    'raw'             => __( 'Use "selector" to target wrapper element. Examples:<br>selector {color: red;} // For main element<br>selector .child-element {margin: 10px;} // For child element<br>.my-class {text-align: center;} // Or use any custom selector', 'ele-elementor-addons' ),
                    'type'            => Controls_Manager::RAW_HTML,
                    'content_classes' => 'elementor-descriptor',
                )
            );

            $element->end_controls_section();
        }
    }

    public function ele_elementor_add_post_css( $post_css, $element ) {

        $element_settings = $element->get_settings();

        if ( empty( $element_settings['ele_custom_css'] ) ) {
            return;
        }

        $css = trim( $element_settings['ele_custom_css'] );

        if ( empty( $css ) ) {
            return;
        }
        $css = str_replace( 'selector', $post_css->get_element_unique_selector( $element ), $css );

        // Add a css comment
        $css = sprintf( '/* Start custom CSS for %s, class: %s */', $element->get_name(), $element->get_unique_selector() ) . $css . '/* End custom CSS */';

        $post_css->get_stylesheet()->add_raw_css( $css );
    }
}