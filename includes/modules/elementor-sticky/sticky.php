<?php

namespace EasyElements\Modules\Elementor_Sticky;

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;

class Sticky{

    public function __construct() {
		add_action( 'elementor/element/section/section_advanced/after_section_end', [ $this, 'register_controls' ], 6 );
		add_action( 'elementor/element/common/_section_style/after_section_end', [ $this, 'register_controls' ], 6 );
		add_action( 'elementor/element/container/section_layout/after_section_end', array( $this, 'register_controls' ) );
	}

    public function register_controls( Controls_Stack $element ) {
        $element->start_controls_section(
            'section_ele_scroll_effect',
            [
                'label' => esc_html__( 'Sticky', 'easyelements' ),
                'tab' => Controls_Manager::TAB_ADVANCED,
            ]
        );

        $element->add_control(
            'ele_sticky',
            [
                'label' => esc_html__( 'Sticky', 'easyelements' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'None', 'easyelements' ),
                    'top' 				=> esc_html__( 'Top', 'easyelements' ),
                    'bottom' 			=> esc_html__( 'Bottom', 'easyelements' ),
                    'column' 			=> esc_html__( 'Column', 'easyelements' ),
                    'show_on_scroll_up' => esc_html__( 'Show on Scroll Up', 'easyelements' ),
                ],
                'prefix_class'	=> 'ele-sticky--',
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'ele_sticky_until',
            [
                'label' => esc_html__( 'Sticky Until', 'easyelements' ),
                'description' => esc_html__( 'Section id without starting hash, example "section1".', 'easyelements'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'condition' => [
                    'ele_sticky!' => ['', 'column'],
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'ele_sticky_offset',
            [
                'label' => esc_html__( 'Sticky Offset', 'easyelements' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'required' => true,
                'condition' => [
                    'ele_sticky!' => '',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'ele_sticky_color',
            [
                'label' => esc_html__( 'Sticky Background Color', 'easyelements' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'ele_sticky!' => ['', 'column'],
                ],
                'selectors' => [
                    '{{WRAPPER}}.ele-sticky--effects' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $element->add_control(
            'ele_sticky_on',
            [
                'label' => esc_html__( 'Sticky On', 'easyelements' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'desktop_tablet_mobile' => esc_html__( 'All Devices', 'easyelements' ),
                    'desktop' => esc_html__( 'Desktop Only', 'easyelements' ),
                    'desktop_tablet' => esc_html__( 'Desktop & Tablet', 'easyelements' ),
                ],
                'default' => 'desktop_tablet_mobile',
                'render_type' => 'none',
                'frontend_available' => true,
                'condition' => [
                    'ele_sticky!' => '',
                ],
            ]
        );

        $element->add_control(
            'ele_sticky_effect_offset',
            [
                'label' => esc_html__( 'Add "ele-sticky--effects" Class Offset', 'easyelements' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'required' => true,
                'condition' => [
                    'ele_sticky!' => '',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->end_controls_section();
    }
}
