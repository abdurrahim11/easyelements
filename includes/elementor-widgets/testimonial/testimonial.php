<?php

namespace EasyElements\Elementor_Widgets\Testimonial;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;
use EasyElements\Control\Group_Control_Foreground;

class Testimonial extends Widget_Base {


	public function get_name() {
		return 'ele-testimonial';
	}

	public function get_title() {
		return esc_html__( 'Testimonial', 'easyelements' );
	}

	public function get_icon() {
		return 'ele ele-testimonials ele-widget-icon';
	}

	public function get_categories() {
        return array( 'easyelements' );
	}

    public function get_keywords() {
        return array( 'testimonial', 'review', 'feedback',  'rating', 'client', 'customer', 'opinion', 'comment', 'praise', 'endorsement' );
    }

	protected function register_controls() {

		$this->start_controls_section(
			'section_general',
			array(
				'label' => esc_html__( 'General', 'easyelements' ),
			)
		);

		$this->add_control(
			'layout',
			array(
				'label'          => esc_html__( 'Layout', 'easyelements' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '1',
				'options'        => array(
					'1'  => esc_html__( 'Style 1', 'easyelements' ),
					'2'  => esc_html__( 'Style 2', 'easyelements' ),
					'3'  => esc_html__( 'Style 3', 'easyelements' ),
					'4'  => esc_html__( 'Style 4', 'easyelements' ),
					'5'  => esc_html__( 'Style 5', 'easyelements' ),
					'6'  => esc_html__( 'Style 6', 'easyelements' ),
					'7'  => esc_html__( 'Style 7', 'easyelements' ),
					'8'  => esc_html__( 'Style 8', 'easyelements' ),
					'9'  => esc_html__( 'Style 9', 'easyelements' ),
					'10' => esc_html__( 'Style 10', 'easyelements' ),
				),
				'prefix_class'   => 'ele-testimonial-layout-',
				'render_type'    => 'template',
				'style_transfer' => true,
			)
		);

		$this->add_control(
			'image',
			array(
				'label'   => esc_html__( 'Choose Image', 'easyelements' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array(
					'active' => true,
				),
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'thumbnail',
				'default'   => 'large',
				'separator' => 'none',
				'exclude'   => array( 'image' ),
			)
		);

		$this->add_control(
			'name',
			array(
				'label'       => esc_html__( 'Name', 'easyelements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Jhon Walker', 'easyelements' ),
				'label_block' => true,
				'separator'   => 'before',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'name_link',
			array(
				'label'       => esc_html__( 'Link', 'easyelements' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://example.com',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'designation',
			array(
				'label'       => esc_html__( 'Designation', 'easyelements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Managing Director', 'easyelements' ),
				'label_block' => true,
				'separator'   => 'before',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => esc_html__( 'Description', 'easyelements' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content.', 'easyelements' ),
				'placeholder' => esc_html__( 'Type your description here', 'easyelements' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'show_quote',
			array(
				'label'       => esc_html__( 'Show Quote', 'easyelements' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Show', 'easyelements' ),
				'label_off'   => esc_html__( 'Hide', 'easyelements' ),
				'default'     => 'yes',
				'condition'   => array(
					'layout!' => array( '6', '9', '10' ),
				),
				'render_type' => 'template',
			)
		);

		$this->add_control(
			'quote_icon',
			array(
				'label'     => esc_html__( 'Icons', 'easyelements' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-quote-left',
					'library' => 'solid',
				),
				'condition' => array(
					'show_quote' => 'yes',
					'layout!'    => array( '6', '9', '10' ),
				),
			)
		);

		$this->add_responsive_control(
			'align',
			array(
				'label'          => esc_html__( 'Alignment', 'easyelements' ),
				'type'           => Controls_Manager::CHOOSE,
				'options'        => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'easyelements' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'easyelements' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'easyelements' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'separator'      => 'before',
				'mobile_default' => 'center',
				'prefix_class'   => 'ele-testimonial-align-%s',
				'selectors'      => array(
					'{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_rating',
			array(
				'label' => esc_html__( 'Rating', 'easyelements' ),
			)
		);

		$this->add_control(
			'rating_style',
			array(
				'label'          => esc_html__( 'Type', 'easyelements' ),
				'type'           => Controls_Manager::SELECT,
				'options'        => array(
					'none' => esc_html__( 'None', 'easyelements' ),
					'star' => esc_html__( 'Star', 'easyelements' ),
					'num'  => esc_html__( 'Number', 'easyelements' ),
				),
				'default'        => 'star',
				'style_transfer' => true,
			)
		);

		$this->add_control(
			'rating',
			array(
				'label'      => esc_html__( 'Rating', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'unit' => 'px',
					'size' => 4,
				),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 5,
						'step' => 1,
					),
				),
				'dynamic'    => array(
					'active' => true,
				),
			)
		);

		$this->end_controls_section();

		//Styling
		$this->start_controls_section(
			'section_image_style',
			array(
				'label' => esc_html__( 'Image', 'easyelements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'width',
			array(
				'label'          => esc_html__( 'Width', 'easyelements' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => array(
					'unit' => '%',
				),
				'tablet_default' => array(
					'unit' => '%',
				),
				'mobile_default' => array(
					'unit' => '%',
				),
				'size_units'     => array( '%', 'px', 'vw' ),
				'range'          => array(
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 1000,
					),
					'vw' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors'      => array(
					'{{WRAPPER}} .ele-testimonial-image > img' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'height',
			array(
				'label'          => esc_html__( 'Height', 'easyelements' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => array(
					'unit' => 'px',
				),
				'tablet_default' => array(
					'unit' => 'px',
				),
				'mobile_default' => array(
					'unit' => 'px',
				),
				'size_units'     => array( 'px', 'vh' ),
				'range'          => array(
					'px' => array(
						'min' => 1,
						'max' => 500,
					),
					'vh' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors'      => array(
					'{{WRAPPER}} .ele-testimonial-image > img' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'object-fit',
			array(
				'label'     => esc_html__( 'Object Fit', 'easyelements' ),
				'type'      => Controls_Manager::SELECT,
				'condition' => array(
					'height[size]!' => '',
				),
				'options'   => array(
					''        => esc_html__( 'Default', 'easyelements' ),
					'fill'    => esc_html__( 'Fill', 'easyelements' ),
					'cover'   => esc_html__( 'Cover', 'easyelements' ),
					'contain' => esc_html__( 'Contain', 'easyelements' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .ele-testimonial-image > img' => 'object-fit: {{VALUE}};',
				),
			)
		);

		$this->start_controls_tabs( 'image_effects' );

		$this->start_controls_tab(
			'normal',
			array(
				'label' => esc_html__( 'Normal', 'easyelements' ),
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'css_filters',
				'selector' => '{{WRAPPER}} .ele-testimonial-image > img',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'hover',
			array(
				'label' => esc_html__( 'Hover', 'easyelements' ),
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .ele-testimonial-image > img',
			)
		);

		$this->add_control(
			'background_hover_transition',
			array(
				'label'     => esc_html__( 'Transition Duration', 'easyelements' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 3,
						'step' => 0.1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .ele-testimonial-image > img' => 'transition-duration: {{SIZE}}s',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'image_border',
				'selector'  => '{{WRAPPER}} .ele-testimonial-image > img',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_box_shadow',
				'exclude'  => array(
					'box_shadow_position',
				),
				'selector' => '{{WRAPPER}} .ele-testimonial-image > img',
			)
		);

		$this->add_responsive_control(
			'image_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-testimonial-image > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-testimonial-image > img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Content
		$this->start_controls_section(
			'section_content_style',
			array(
				'label' => esc_html__( 'Content', 'easyelements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'content_background',
				'label'     => esc_html__( 'Background', 'easyelements' ),
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'selector'  => '{{WRAPPER}}.ele-testimonial-layout-4 .ele-testimonial-inner-wrapper,{{WRAPPER}}.ele-testimonial-layout-5 .ele-testimonial-inner-wrapper,{{WRAPPER}}.ele-testimonial-layout-6 .ele-testimonial-content,{{WRAPPER}}.ele-testimonial-layout-8 .ele-testimonial-content',
				'condition' => array(
					'layout' => array( '4', '5', '6', '8' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'content_border',
				'selector'  => '{{WRAPPER}}.ele-testimonial-layout-4 .ele-testimonial-inner-wrapper,{{WRAPPER}}.ele-testimonial-layout-5 .ele-testimonial-inner-wrapper,{{WRAPPER}}.ele-testimonial-layout-6 .ele-testimonial-content,{{WRAPPER}}.ele-testimonial-layout-8 .ele-testimonial-content',
				'condition' => array(
					'layout' => array( '4', '5', '6', '8' ),
				),
			)
		);

		$this->add_responsive_control(
			'content_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}}.ele-testimonial-layout-4 .ele-testimonial-inner-wrapper,{{WRAPPER}}.ele-testimonial-layout-5 .ele-testimonial-inner-wrapper,{{WRAPPER}}.ele-testimonial-layout-6 .ele-testimonial-content,{{WRAPPER}}.ele-testimonial-layout-8 .ele-testimonial-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => array( '4', '5', '6', '8' ),
				),
			)
		);

		$this->add_responsive_control(
			'content_padding',
			array(
				'label'      => esc_html__( 'Padding', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}}.ele-testimonial-layout-4 .ele-testimonial-inner-wrapper,{{WRAPPER}}.ele-testimonial-layout-5 .ele-testimonial-inner-wrapper,{{WRAPPER}}.ele-testimonial-layout-6 .ele-testimonial-content,{{WRAPPER}}.ele-testimonial-layout-8 .ele-testimonial-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
				'condition'  => array(
					'layout' => array( '4', '5', '6', '8' ),
				),
			)
		);

		$this->add_control(
			'heading_name',
			array(
				'label'     => esc_html__( 'Name', 'easyelements' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'name!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'name_typography',
				'label'     => esc_html__( 'Typography', 'easyelements' ),
				'selector'  => '{{WRAPPER}} .ele-testimonial-title',
				'condition' => array(
					'name!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Foreground::get_type(),
			array(
				'name'      => 'name_color',
				'label'     => esc_html__( 'Title Color', 'easyelements' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .ele-testimonial-title',
				'condition' => array(
					'name!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'name_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-testimonial-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'name!' => '',
				),
			)
		);

		$this->add_control(
			'heading_designation',
			array(
				'label'     => esc_html__( 'Designation', 'easyelements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'designation!' => '',
				),
			)
		);

		$this->add_control(
			'designation_color',
			array(
				'label'     => esc_html__( 'Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-testimonial-designation' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'designation!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'designation_typography',
				'label'     => esc_html__( 'Typography', 'easyelements' ),
				'selector'  => '{{WRAPPER}} .ele-testimonial-designation',
				'condition' => array(
					'designation!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'designation_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-testimonial-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'designation!' => '',
				),
			)
		);

		$this->add_control(
			'heading_description',
			array(
				'label'     => esc_html__( 'Description', 'easyelements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'description!' => '',
				),
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => esc_html__( 'Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-testimonial-description' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'description!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'description_typography',
				'label'     => esc_html__( 'Typography', 'easyelements' ),
				'selector'  => '{{WRAPPER}} .ele-testimonial-description',
				'condition' => array(
					'description!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'description_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-testimonial-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'description!' => '',
				),
			)
		);

		$this->end_controls_section();

		//Rating
		$this->start_controls_section(
			'section_rating_style',
			array(
				'label'     => esc_html__( 'Rating', 'easyelements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'rating_style!' => 'none',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'rating_typography',
				'label'     => esc_html__( 'Typography', 'easyelements' ),
				'selector'  => '{{WRAPPER}} .ele-rating-layout-num',
				'condition' => array(
					'rating_style' => 'num',
				),
			)
		);

		$this->add_responsive_control(
			'ratting_size',
			array(
				'label'      => esc_html__( 'Size', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'condition'  => array(
					'rating_style' => 'star',
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-testimonial-rating' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-testimonial-rating svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'ratting_space_between',
			array(
				'label'      => esc_html__( 'Space Between', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 10,
						'step' => 1,
					),
				),
				'condition'  => array(
					'rating_style' => 'star',
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-testimonial-rating > i' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-testimonial-rating > svg' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'rating_color',
			array(
				'label'     => esc_html__( 'Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-testimonial-rating, {{WRAPPER}} .ele-rating-layout-star > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'rating_fill',
			array(
				'label'     => esc_html__( 'Filled', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-rating-layout-star > svg.fill' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'rating_style' => 'star',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'rating_background',
				'label'     => esc_html__( 'Background', 'easyelements' ),
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'selector'  => '{{WRAPPER}} .ele-rating-layout-num',
				'condition' => array(
					'rating_style' => 'num',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'rating_border',
				'selector'  => '{{WRAPPER}} .ele-rating-layout-num',
				'separator' => 'before',
				'condition' => array(
					'rating_style' => 'num',
				),
			)
		);

		$this->add_responsive_control(
			'rating_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-rating-layout-num' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'rating_style' => 'num',
				),
			)
		);

		$this->add_responsive_control(
			'rating_padding',
			array(
				'label'      => esc_html__( 'Padding', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-rating-layout-num' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'rating_style' => 'num',
				),
			)
		);

		$this->add_responsive_control(
			'rating_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-testimonial-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Quote
		$this->start_controls_section(
			'section_quote_style',
			array(
				'label'     => esc_html__( 'Quote', 'easyelements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_quote' => 'yes',
					'layout!'    => array( '6', '9', '10' ),
				),
			)
		);

		$this->add_control(
			'quote_color',
			array(
				'label'     => esc_html__( 'Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-testimonial-quote > i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ele-testimonial-quote > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'quote_sizes',
			array(
				'label'      => esc_html__( 'Size', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-testimonial-quote > i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-testimonial-quote > svg' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'layout!' => array( '6', '9', '10' ),
				),
			)
		);

		$this->add_responsive_control(
			'quote_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-testimonial-quote' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout!' => array( '6', '9', '10' ),
				),
			)
		);

		$this->end_controls_section();
	}


	protected function render() {

		$settings = $this->get_settings_for_display();

		require ELE_WIDGET_ASSETS_PATH . 'testimonial/layout/frontend.php';
	}
}
