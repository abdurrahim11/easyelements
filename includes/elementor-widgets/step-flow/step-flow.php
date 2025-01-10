<?php

namespace EasyElements\Elementor_Widgets\Step_Flow;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

class Step_Flow extends Widget_Base {

	public function get_name() {
		return 'ele-step-flow';
	}

	public function get_title() {
		return esc_html__( 'Step Flow', 'easy-elements' );
	}

	public function get_icon() {
		return 'ele ele-step-flow ele-widget-icon';
	}

	public function get_categories() {
		return array( 'easy-elements'  );
	}

    public function get_keywords() {
        return array('step', 'steps', 'flow', 'flows', 'process', 'sequence', 'progress', 'actions', 'phases', 'stages', 'procedures', 'workflow', 'guideline', 'instruction', 'task');
    }

	protected function register_controls() {

		$this->start_controls_section(
			'section_news_ticker',
			array(
				'label' => esc_html__( 'General', 'easy-elements' ),
			)
		);

		$this->add_control(
			'step_flow_icon',
			array(
				'show_label'  => false,
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => array(
					'value'   => 'fas fa-fingerprint',
					'library' => 'fa-solid',
				),
			)
		);

		$this->add_control(
			'step_flow_title',
			array(
				'label'       => esc_html__( 'Title', 'easy-elements' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Step Heading', 'easy-elements' ),
				'placeholder' => esc_html__( 'Type Step Flow Title', 'easy-elements' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'step_flow_description',
			array(
				'label'       => esc_html__( 'Description', 'easy-elements' ),
				'type'        => Controls_Manager::WYSIWYG,
				'rows'        => 5,
				'placeholder' => esc_html__( 'Type your description here', 'easy-elements' ),
				'default'     => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and industry.', 'easy-elements' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'step_flow_badge_text',
			array(
				'label'       => esc_html__( 'Badge Text', 'easy-elements' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Type Icon Badge Text', 'easy-elements' ),
				'default'     => esc_html__( '01', 'easy-elements' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'step_flow_separator',
			array(
				'label'        => esc_html__( 'Separator', 'easy-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => esc_html__( 'yes', 'easy-elements' ),
				'return_value' => 'yes',
			)
		);

		$this->add_responsive_control(
			'general_align',
			array(
				'label'        => esc_html__( 'Alignment', 'easy-elements' ),
				'type'         => Controls_Manager::CHOOSE,
				'separator'    => 'before',
				'options'      => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'easy-elements' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'easy-elements' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'easy-elements' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'prefix_class' => 'ele-content-align%s',
				'default'      => esc_html__( 'center', 'easy-elements' ),
				'selectors'    => array(
					'{{WRAPPER}} .ele-step-flow-wrapper' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'step_flow_icon_style',
			array(
				'label' => esc_html__( 'Media', 'easy-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'      => esc_html__( 'Media Size', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 30,

				),
				'selectors'  => array(
					'{{WRAPPER}}'                          => '--ele-step-flow-icon-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-step-flow-icon > i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-step-flow-icon > svg' => 'width: {{SIZE}}{{UNIT}}; height:auto;',
				),
			)
		);

		$this->add_responsive_control(
			'icon_box_icon',
			array(
				'label'      => esc_html__( 'Background Size', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 300,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 120,

				),
				'selectors'  => array(
					'{{WRAPPER}}'                      => '--ele-step-flow-icon-padding: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-step-flow-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_margin_bottom',
			array(
				'label'      => esc_html__( 'Bottom Spacing', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 5,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 20,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-step-flow-icon ' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-step-flow-icon > i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ele-step-flow-icon > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'icon_content_bg',
				'label'    => esc_html__( 'Background', 'easy-elements' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .ele-step-flow-icon',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'icon_border',
				'label'    => esc_html__( 'Border', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-step-flow-icon',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'icon_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-step-flow-icon',
			)
		);

		$this->add_responsive_control(
			'icon_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-step-flow-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_step_flow_title_style',
			array(
				'label'     => esc_html__( 'Title', 'easy-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'step_flow_title!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-step-flow-title',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-step-flow-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'title_text_shadow',
				'label'    => esc_html__( 'Text Shadow', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-step-flow-title',
			)
		);

		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-step-flow-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_step_flow_description_style',
			array(
				'label'     => esc_html__( 'Description', 'easy-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'step_flow_description!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'label'    => esc_html__( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-step-flow-description, {{WRAPPER}} .ele-step-flow-description > *',
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => esc_html__( 'Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-step-flow-description, {{WRAPPER}} .ele-step-flow-description > *' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'description_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-step-flow-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_step_flow_separator_style',
			array(
				'label'     => esc_html__( 'Separator', 'easy-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'step_flow_separator' => 'yes',
				),
			)
		);

		$this->add_control(
			'separator_layout_style',
			array(
				'label'   => esc_html__( 'Layout', 'easy-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'line',
				'options' => array(
					'line'       => esc_html__( 'Line', 'easy-elements' ),
					'line-arrow' => esc_html__( 'Line Arrow', 'easy-elements' ),
					'arrow'      => esc_html__( 'Arrow', 'easy-elements' ),
					'circle'     => esc_html__( 'Circle', 'easy-elements' ),
				),
			)
		);

		$this->add_control(
			'separator_border_type',
			array(
				'label'     => esc_html__( 'Border Type', 'easy-elements' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => array(
					'solid'  => esc_html__( 'Solid', 'easy-elements' ),
					'dotted' => esc_html__( 'Dotted', 'easy-elements' ),
					'dashed' => esc_html__( 'Dashed', 'easy-elements' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .ele-step-flow-line,
					{{WRAPPER}} .ele-step-flow-line-arrow,
					{{WRAPPER}} .ele-step-flow-circle,
					{{WRAPPER}} .ele-step-flow-arrow' => 'border-top-style: {{VALUE}}',
					'{{WRAPPER}} .ele-step-flow-line-arrow::after,
					{{WRAPPER}} .ele-step-flow-arrow::after' => 'border-top-style: {{VALUE}};border-right-style: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'separator_transform_toggle',
			array(
				'label'        => esc_html__( 'Transform', 'easy-elements' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => esc_html__( 'None', 'easy-elements' ),
				'label_on'     => esc_html__( 'Custom', 'easy-elements' ),
				'return_value' => 'yes',
			)
		);

		$this->start_popover();

		$this->add_responsive_control(
			'separator_offset_y',
			array(
				'label'      => esc_html__( 'Offset Top', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'condition'  => array(
					'separator_transform_toggle' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-step-flow-line-arrow,
					{{WRAPPER}} .ele-step-flow-arrow,
					{{WRAPPER}} .ele-step-flow-circle,
					{{WRAPPER}} .ele-step-flow-line' => 'top:{{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'separator_offset_x',
			array(
				'label'      => esc_html__( 'Offset Left', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 20,
				),
				'condition'  => array(
					'separator_transform_toggle' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-step-flow-line-arrow,
					{{WRAPPER}} .ele-step-flow-arrow,
					{{WRAPPER}} .ele-step-flow-circle,
					{{WRAPPER}} .ele-step-flow-line' => 'left: calc( 100% + {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}}'                     => '--ele-step-flow-direction-offset-x: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'separator_rotate',
			array(
				'label'          => esc_html__( 'Rotate', 'easy-elements' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => array( 'deg' ),
				'default'        => array(
					'unit' => 'deg',
				),
				'tablet_default' => array(
					'unit' => 'deg',
				),
				'mobile_default' => array(
					'unit' => 'deg',
				),
				'range'          => array(
					'deg' => array(
						'min' => 0,
						'max' => 360,
					),
				),
				'condition'      => array(
					'separator_transform_toggle' => 'yes',
				),
				'selectors'      => array(
					'{{WRAPPER}}' => '--ele-step-flow-direction-angle: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_popover();

		$this->add_responsive_control(
			'separator_width',
			array(
				'label'      => esc_html__( 'Width', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 100,

				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-step-flow-line, 
					 {{WRAPPER}} .ele-step-flow-circle,
					 {{WRAPPER}} .ele-step-flow-line-arrow' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'separator_layout_style' => array( 'line', 'line-arrow', 'circle' ),
				),
			)
		);

		$this->add_responsive_control(
			'separator_size',
			array(
				'label'      => esc_html__( 'Thickness', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 2,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-step-flow-line'   => 'border-top-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-step-flow-line-arrow' => 'border-top-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-step-flow-line-arrow:after' => 'border-width: {{SIZE}}{{UNIT}}; width:calc(15px * {{SIZE}} / 2); height:calc(15px * {{SIZE}} / 2); top:calc(-17px * {{SIZE}} / 4); right:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-step-flow-arrow:after' => 'border-width: {{SIZE}}{{UNIT}}; width:calc(15px * {{SIZE}} / 2); height:calc(15px * {{SIZE}} / 2); top: calc(-15px * {{SIZE}} / 4);',
					'{{WRAPPER}} .ele-step-flow-circle' => 'border-top-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-step-flow-circle:after' => 'border-width: {{SIZE}}{{UNIT}}; width:calc(15px * {{SIZE}} / 2); height:calc(15px * {{SIZE}} / 2); top:calc(-2px * {{SIZE}} / 4);',
				),
			)
		);

		$this->add_responsive_control(
			'separator_margin-left',
			array(
				'label'      => esc_html__( 'Distance', 'easy-elements' ),
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
					'{{WRAPPER}} .ele-step-flow-line,
					 {{WRAPPER}} .ele-step-flow-line-arrow,
					 {{WRAPPER}} .ele-step-flow-arrow' => 'margin-left: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'separator_color',
			array(
				'label'     => esc_html__( 'Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-step-flow-line,
					 {{WRAPPER}} .ele-step-flow-line-arrow,
					 {{WRAPPER}} .ele-step-flow-line-arrow::after,
					 {{WRAPPER}} .ele-step-flow-circle,
					 {{WRAPPER}} .ele-step-flow-arrow::after' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'separator_circle_color',
			array(
				'label'     => esc_html__( 'Circle Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-step-flow-circle::after' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'separator_layout_style' => 'circle',
				),
			)
		);

		$this->add_control(
			'separator_hide_on',
			array(
				'label'   => esc_html__( 'Hide On', 'easy-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'   => esc_html__( 'None', 'easy-elements' ),
					'tablet' => esc_html__( 'Tablet & Mobile', 'easy-elements' ),
					'mobile' => esc_html__( 'Mobile Only', 'easy-elements' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_step_flow_badge_style',
			array(
				'label'     => esc_html__( 'Badge', 'easy-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'step_flow_badge_text!' => '',
				),
			)
		);

		$this->add_control(
			'badge_position',
			array(
				'label'   => esc_html__( 'Position', 'easy-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top-left',
				'options' => array(
					'top-left'      => esc_html__( 'Top Left', 'easy-elements' ),
					'top-center'    => esc_html__( 'Top Center', 'easy-elements' ),
					'top-right'     => esc_html__( 'Top Right', 'easy-elements' ),
					'middle-left'   => esc_html__( 'Middle Left', 'easy-elements' ),
					'middle-center' => esc_html__( 'Middle Center', 'easy-elements' ),
					'middle-right'  => esc_html__( 'Middle Right', 'easy-elements' ),
					'bottom-left'   => esc_html__( 'Bottom Left', 'easy-elements' ),
					'bottom-center' => esc_html__( 'Bottom Center', 'easy-elements' ),
					'bottom-right'  => esc_html__( 'Bottom Right', 'easy-elements' ),
				),
			)
		);

		$this->add_control(
			'badge_offset_toggle',
			array(
				'label'        => esc_html__( 'Offset', 'easy-elements' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => esc_html__( 'None', 'easy-elements' ),
				'label_on'     => esc_html__( 'Custom', 'easy-elements' ),
				'return_value' => 'yes',
			)
		);

		$this->start_popover();

		$this->add_responsive_control(
			'badge_offset_x',
			array(
				'label'      => esc_html__( 'Offset Left', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => 'px',
				),
				'range'      => array(
					'px' => array(
						'min' => - 1000,
						'max' => 1000,
					),
					'%'  => array(
						'min' => - 100,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-step-flow-badge.ele-badge' => '--ele-badge-translate-x: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'badge_offset_toggle' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'badge_offset_y',
			array(
				'label'      => esc_html__( 'Offset Top', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => 'px',
				),
				'range'      => array(
					'px' => array(
						'min' => - 1000,
						'max' => 1000,
					),
					'%'  => array(
						'min' => - 100,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-step-flow-badge.ele-badge' => '--ele-badge-translate-y: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'badge_offset_toggle' => 'yes',
				),
			)
		);
		$this->end_popover();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'badge_typography',
				'label'    => esc_html__( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-step-flow-badge',
			)
		);

		$this->add_control(
			'badge_color',
			array(
				'label'     => esc_html__( 'Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-step-flow-badge' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'badge_background',
				'label'    => esc_html__( 'Background', 'easy-elements' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .ele-step-flow-badge',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'badge_border',
				'label'    => esc_html__( 'Border', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-step-flow-badge',
			)
		);

		$this->add_responsive_control(
			'badge_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-step-flow-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'badge_padding',
			array(
				'label'      => esc_html__( 'Padding', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-step-flow-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		require ELE_WIDGET_ASSETS_PATH . 'step-flow/layout/frontend.php';
	}
}
