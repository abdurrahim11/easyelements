<?php


namespace EasyElements\Elementor_Widgets\Progress_Bar;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

class Progress_Bar extends Widget_Base {

	public function get_name() {
		return 'ele-progress-bar';
	}

	public function get_title() {
		return esc_html__( 'Progress Bar', 'easy-elements' );
	}

	public function get_icon() {
		return 'ele ele-progress ele-widget-icon';
	}

	public function get_categories() {
		return array( 'easy-elements' );
	}

    public function get_keywords() {
        return array( 'skill', 'progress', 'bar', 'ability', 'competence', 'development', 'achievement', 'level', 'meter', 'indicator' );
    }

	public function get_script_depends() {
		//return array( 'elementor-waypoints' );
		return array( 'waypoints' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_general',
			array(
				'label' => esc_html__( 'General', 'easy-elements' ),
			)
		);

		$this->add_control(
			'layout',
			array(
				'label'   => esc_html__( 'Layout', 'easy-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => array(
					'1'  => esc_html__( 'Style 1', 'easy-elements' ),
					'2'  => esc_html__( 'Style 2', 'easy-elements' ),
					'3'  => esc_html__( 'Style 3', 'easy-elements' ),
					'4'  => esc_html__( 'Style 4', 'easy-elements' ),
					'5'  => esc_html__( 'Style 5', 'easy-elements' ),
					'6'  => esc_html__( 'Style 6', 'easy-elements' ),
					'7'  => esc_html__( 'Style 7', 'easy-elements' ),
					'8'  => esc_html__( 'Style 8', 'easy-elements' ),
					'9'  => esc_html__( 'Style 9', 'easy-elements' ),
					'10' => esc_html__( 'Style 10', 'easy-elements' ),
					'11' => esc_html__( 'Style 11', 'easy-elements' ),
					'12' => esc_html__( 'Style 12', 'easy-elements' ),
					'13' => esc_html__( 'Style 13', 'easy-elements' ),
					'14' => esc_html__( 'Style 14', 'easy-elements' ),
					'15' => esc_html__( 'Style 15', 'easy-elements' ),
				),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => esc_html__( 'Title', 'easy-elements' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'WordPress', 'easy-elements' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'value',
			array(
				'label'              => esc_html__( 'Percentage', 'easy-elements' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 1,
				'max'                => 100,
				'step'               => 1,
				'default'            => 90,
				'frontend_available' => true,
				'dynamic'            => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'show_count',
			array(
				'label'              => esc_html__( 'Show Count', 'easy-elements' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Show', 'easy-elements' ),
				'label_off'          => esc_html__( 'Hide', 'easy-elements' ),
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'duration',
			array(
				'label'              => esc_html__( 'Animation Duration', 'easy-elements' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'frontend_available' => true,
				'range'              => array(
					'px' => array(
						'min'  => 1,
						'max'  => 10,
						'step' => 1,
					),

				),
				'default'            => array(
					'size' => 3,
				),

			)
		);

		$this->add_control(
			'align',
			array(
				'label'     => esc_html__( 'Alignment', 'easy-elements' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'easy-elements' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'easy-elements' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'easy-elements' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .ele-progress-content' => 'text-align: {{VALUE}}',
				),
				'condition' => array(
					'layout' => array( '15' ),
				),
			)
		);

		$this->end_controls_section();

		//Title Style
		$this->start_controls_section(
			'section_style_title',
			array(
				'label' => esc_html__( 'Title', 'easy-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-progress-title',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-progress-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-progress-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Counter Style
		$this->start_controls_section(
			'section_style_counter',
			array(
				'label' => esc_html__( 'Counter', 'easy-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'counter_typography',
				'label'    => esc_html__( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-progress-counter',
			)
		);

		$this->add_control(
			'counter_color',
			array(
				'label'     => esc_html__( 'Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-progress-counter' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'counter_secondary_color',
			array(
				'label'     => esc_html__( 'Decrement Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-progress-bar-layout-6 .ele-progress-count-less-wrapper' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'layout' => array( '6' ),
				),
			)
		);

		$this->add_control(
			'counter_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-progress-bar-layout-3 .ele-progress-counter,{{WRAPPER}} .ele-progress-bar-layout-7 .ele-progress-counter,
					 {{WRAPPER}}  .ele-progress-bar-layout-11 .ele-progress-track::after,{{WRAPPER}} .ele-progress-bar-layout-12 .ele-progress-counter,
					 {{WRAPPER}} .ele-progress-bar-layout-13 .ele-progress-counter,{{WRAPPER}} .ele-progress-bar-layout-14 .ele-progress-counter'               => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .ele-progress-bar-layout-7 .ele-progress-counter::after,{{WRAPPER}} .ele-progress-bar-layout-13 .ele-progress-counter::before' => 'border-top-color: {{VALUE}}',
					'{{WRAPPER}} .ele-progress-bar-layout-14 .ele-progress-counter::before'                                                                       => 'border-bottom-color: {{VALUE}}',
				),
				'condition' => array(
					'layout' => array( '3', '7', '11', '12', '13', '14' ),
				),
			)
		);

		$this->add_control(
			'counter_shape_color',
			array(
				'label'     => esc_html__( 'Shape Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-progress-control' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .ele-progress-control:before,{{WRAPPER}} .ele-progress-bar-layout-10 .ele-progress-counter::after' => 'border-top-color: {{VALUE}}',
				),
				'condition' => array(
					'layout' => array( '5', '10' ),
				),
			)
		);

		$this->add_control(
			'counter_bg_size',
			array(
				'label'      => esc_html__( 'Background Size', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-progress-bar-layout-7 .ele-progress-counter,{{WRAPPER}} .ele-progress-bar-layout-11 .ele-progress-track::after,{{WRAPPER}} .ele-progress-bar-layout-12 .ele-progress-counter' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => array( '7', '11', '12' ),
				),
			)
		);

		$this->add_control(
			'counter_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-progress-bar-layout-7 .ele-progress-counter::before,{{WRAPPER}} .ele-progress-bar-layout-11 .ele-progress-track::after,{{WRAPPER}} .ele-progress-bar-layout-12 .ele-progress-counter' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'layout' => array( '7', '11', '12' ),
				),
			)
		);

		$this->add_responsive_control(
			'counter_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-progress-counter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_bar',
			array(
				'label' => esc_html__( 'Track', 'easy-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'bar_height',
			array(
				'label'      => esc_html__( 'Height', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-progress-bar' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'bar_bg',
				'label'    => esc_html__( 'Background', 'easy-elements' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .ele-progress-bar,{{WRAPPER}}  .ele-progress-bar-layout-11 .ele-progress-track::after',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'bar_shadow',
				'label'    => esc_html__( 'Bar Shadow', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-progress-bar',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'bar_border',
				'label'    => esc_html__( 'Border', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-progress-bar',
			)
		);

		$this->add_responsive_control(
			'bar_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-progress-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'bar_padding',
			array(
				'label'      => esc_html__( 'Padding', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-progress-bar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'bar_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-progress-bar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_track',
			array(
				'label' => esc_html__( 'Bar', 'easy-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'track_striped',
			array(
				'label'        => esc_html__( 'Striped', 'easy-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'easy-elements' ),
				'label_off'    => esc_html__( 'Hide', 'easy-elements' ),
				'return_value' => 'yes',
				'selectors'    => array(
					'{{WRAPPER}} .ele-progress-track' => 'background-size: 1rem 1rem; background-image: linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);',
				),
				'condition'    => array(
					'layout!' => array( '9', '10' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'track_bg',
				'label'     => esc_html__( 'Background', 'easy-elements' ),
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'selector'  => '{{WRAPPER}} .ele-progress-track',
				'condition' => array(
					'layout!' => array( '9', '10' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'track_border',
				'label'     => esc_html__( 'Border', 'easy-elements' ),
				'selector'  => '{{WRAPPER}} .ele-progress-track',
				'condition' => array(
					'layout!' => array( '9', '10' ),
				),
			)
		);

		$this->add_control(
			'track_striped_color',
			array(
				'label'     => esc_html__( 'Striped Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-progress-track' => 'background: repeating-linear-gradient(to right,{{VALUE}},{{VALUE}} 10px,transparent 10px,transparent 12px)',
				),
				'condition' => array(
					'layout' => array( '9', '10' ),
				),
			)
		);

		$this->add_responsive_control(
			'track_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-progress-track' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		require ELE_WIDGET_ASSETS_PATH . 'progress-bar/layout/frontend.php';
	}
}
