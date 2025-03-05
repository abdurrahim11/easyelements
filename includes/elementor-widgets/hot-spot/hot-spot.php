<?php

namespace EasyElements\Elementor_Widgets\Hot_Spot;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

class Hot_Spot extends Widget_Base {

	public function get_name() {
		return 'ele-hot-spot';
	}

	public function get_title() {
		return esc_html__( 'Hotspot', 'easyelements' );
	}

	public function get_icon() {
		return 'eicon-hotspot ele-widget-icon';
	}

	public function get_categories() {
		return array( 'easyelements' );
	}

    public function get_keywords() {
        return array( 'ele', 'hot','hotspot', 'spot', 'spots', 'electronics', 'heat', 'location', 'areas', 'places' );
    }

	protected function register_controls() {

		$this->start_controls_section(
			'section_hotspot',
			array(
				'label' => esc_html__( 'Content', 'easyelements' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'type',
			array(
				'label'   => esc_html__( 'Type', 'easyelements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'hover',
				'options' => array(
					'hover' => esc_html__( 'On Hover', 'easyelements' ),
					'click' => esc_html__( 'On Click', 'easyelements' ),
				),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'   => esc_html__( 'Image', 'easyelements' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'media_thumbnail',
				'default'   => 'full',
				'separator' => 'none',
				'exclude'   => array(
					'custom',
				),
			)
		);

		// repeater
		$repeater = new Repeater();

		$repeater->add_control(
			'hot_media_type',
			array(
				'label'       => esc_html__( 'Media Type', 'easyelements' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => array(
					'none'  => array(
						'title' => esc_html__( 'None', 'easyelements' ),
						'icon'  => 'eicon-ban',
					),
					'icon'  => array(
						'title' => esc_html__( 'Icon', 'easyelements' ),
						'icon'  => 'eicon-star-o',
					),
					'image' => array(
						'title' => esc_html__( 'Image', 'easyelements' ),
						'icon'  => 'eicon-image',
					),
				),
				'default'     => 'icon',
				'toggle'      => false,
			)
		);

		$repeater->add_control(
			'hot_icon',
			array(
				'show_label'  => false,
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => array(
					'value'   => 'fas fa-plus',
					'library' => 'fa-solid',
				),
				'condition'   => array(
					'hot_media_type' => 'icon',
				),
			)
		);

		$repeater->add_control(
			'spots_image',
			array(
				'label'     => esc_html__( 'Image', 'easyelements' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'hot_media_type' => 'image',
				),
				'dynamic'   => array(
					'active' => true,
				),
			)
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'spots_thumbnail',
				'default'   => 'full',
				'separator' => 'none',
				'exclude'   => array(
					'custom',
				),
				'condition' => array(
					'hot_media_type' => 'image',
				),
			)
		);

		$repeater->add_control(
			'hot_offset_toggle',
			array(
				'label'        => esc_html__( 'Offset', 'easyelements' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => esc_html__( 'None', 'easyelements' ),
				'label_on'     => esc_html__( 'Custom', 'easyelements' ),
				'return_value' => 'yes',
			)
		);

		$repeater->start_popover();

		$repeater->add_responsive_control(
			'hot_offset_x',
			array(
				'label'      => esc_html__( 'Offset Left', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min' => - 1000,
						'max' => 1000,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => '%',
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-hotspot-wrapper {{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'hot_offset_toggle' => 'yes',
				),
			)
		);

		$repeater->add_responsive_control(
			'hot_offset_y',
			array(
				'label'      => esc_html__( 'Offset Top', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min' => - 1000,
						'max' => 1000,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => '%',
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-hotspot-wrapper {{CURRENT_ITEM}}' => ' top: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'hot_offset_toggle' => 'yes',
				),
			)
		);

		$repeater->end_popover();

		$repeater->add_control(
			'show_tooltip',
			array(
				'label'        => esc_html__( 'Show Tooltip ', 'easyelements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'easyelements' ),
				'label_off'    => esc_html__( 'Hide', 'easyelements' ),
				'return_value' => 'yes',
				'separator'    => 'before',
				'default'      => 'yes',
			)
		);

		$repeater->add_responsive_control(
			'position',
			array(
				'label'                => esc_html__( 'Position', 'easyelements' ),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'top',
				'tablet_default'       => 'bottom',
				'mobile_default'       => 'bottom',
				'options'              => array(
					'top'    => esc_html__( 'Top', 'easyelements' ),
					'right'  => esc_html__( 'Right', 'easyelements' ),
					'bottom' => esc_html__( 'Bottom', 'easyelements' ),
					'left'   => esc_html__( 'Left', 'easyelements' ),
				),
				'selectors_dictionary' => array(
					'top'    => '--ele-hotspot-tooltip-top:auto; --ele-hotspot-tooltip-right:auto; --ele-hotspot-tooltip-bottom:100%; --ele-hotspot-tooltip-left:50%; --ele-hotspot-tooltip-transform-x: -50%; --ele-hotspot-tooltip-transform-y: 0; --ele-hotspot-tooltip-margin: 0 0 10px 0;
                    --ele-hotspot-tooltip-before-top:auto; --ele-hotspot-tooltip-before-right:auto; --ele-hotspot-tooltip-before-left: 50%; --ele-hotspot-tooltip-before-bottom: -5px; --ele-hotspot-tooltip-before-transform-x: -50%; --ele-hotspot-tooltip-before-transform-y: 0;',
					'right'  => '--ele-hotspot-tooltip-bottom:auto; --ele-hotspot-tooltip-right:auto; --ele-hotspot-tooltip-left:100%; --ele-hotspot-tooltip-top:50%; --ele-hotspot-tooltip-transform-y: -50%; --ele-hotspot-tooltip-transform-x: 0; --ele-hotspot-tooltip-margin: 0 0 0 10px;
                    --ele-hotspot-tooltip-before-bottom:auto; --ele-hotspot-tooltip-before-right:auto; --ele-hotspot-tooltip-before-top: 50%; --ele-hotspot-tooltip-before-left: -5px; --ele-hotspot-tooltip-before-transform-y: -50%; --ele-hotspot-tooltip-before-transform-x: 0;',
					'bottom' => '--ele-hotspot-tooltip-bottom:auto; --ele-hotspot-tooltip-right:auto; --ele-hotspot-tooltip-top:100%; --ele-hotspot-tooltip-left:50%; --ele-hotspot-tooltip-transform-x: -50%; --ele-hotspot-tooltip-transform-y: 0; --ele-hotspot-tooltip-margin: 10px 0 0 0;
                    --ele-hotspot-tooltip-before-bottom:auto; --ele-hotspot-tooltip-before-right:auto; --ele-hotspot-tooltip-before-left: 50%; --ele-hotspot-tooltip-before-top: -5px; --ele-hotspot-tooltip-before-transform-x: -50%; --ele-hotspot-tooltip-before-transform-y: 0;',
					'left'   => '--ele-hotspot-tooltip-bottom:auto; --ele-hotspot-tooltip-left:auto; --ele-hotspot-tooltip-right:100%; --ele-hotspot-tooltip-top:50%; --ele-hotspot-tooltip-transform-y: -50%; --ele-hotspot-tooltip-transform-x: 0; --ele-hotspot-tooltip-margin: 0 10px 0 0;
                    --ele-hotspot-tooltip-before-bottom:auto; --ele-hotspot-tooltip-before-left:auto; --ele-hotspot-tooltip-before-top: 50%; --ele-hotspot-tooltip-before-right: -5px; --ele-hotspot-tooltip-before-transform-y: -50%; --ele-hotspot-tooltip-before-transform-x: 0;',
				),
				'selectors'            => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .ele-hotspot-tooltip-text,
                    {{WRAPPER}} {{CURRENT_ITEM}} .ele-hotspot-tooltip-text:before' => '{{VALUE}};',
				),
				'condition'            => array(
					'show_tooltip' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'tooltip_text',
			array(
				'label'       => esc_html__( 'Tooltip Text', 'easyelements' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'Tooltip Content', 'easyelements' ),
				'placeholder' => esc_html__( 'Type tooltip text here.', 'easyelements' ),
				'condition'   => array(
					'show_tooltip' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'link',
			array(
				'label'       => esc_html__( 'Link', 'easyelements' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'show_default_tooltip',
			array(
				'label'        => esc_html__( 'Default Active Tooltip ', 'easyelements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'easyelements' ),
				'label_off'    => esc_html__( 'Hide', 'easyelements' ),
				'return_value' => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'hotspot_items',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'show_label'  => false,
				'separator'   => 'before',
				'render_type' => 'template',
				'default'     => array(
					array(
						'hot_icon'     => array(
							'value'   => 'fas fa-plus',
							'library' => 'fa-solid',
						),
						'tooltip_text' => esc_html__( 'Tooltip Content', 'easyelements' ),
					),
				),
			)
		);

		$this->end_controls_section();

		//Styling Tab
		$this->start_controls_section(
			'section_style_hot_image',
			array(
				'label' => esc_html__( 'Image', 'easyelements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'alignment',
			array(
				'label'     => esc_html__( 'Alignment', 'easyelements' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
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
				'selectors' => array(
					'{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'hot_image_width_size',
			array(
				'label'      => esc_html__( 'Width', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-hotspot-wrapper' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'hot_image_height_size',
			array(
				'label'      => esc_html__( 'Height', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-hotspot-wrapper .ele-hotspot-image' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'_hot_object-fit',
			array(
				'label'     => esc_html__( 'Object Fit', 'easyelements' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'cover',
				'options'   => array(
					''        => esc_html__( 'Default', 'easyelements' ),
					'fill'    => esc_html__( 'Fill', 'easyelements' ),
					'cover'   => esc_html__( 'Cover', 'easyelements' ),
					'contain' => esc_html__( 'Contain', 'easyelements' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .ele-hotspot-wrapper .ele-hotspot-image > img' => 'object-fit: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'hot_image_border',
				'label'    => esc_html__( 'Border', 'easyelements' ),
				'selector' => '{{WRAPPER}} .ele-hotspot-wrapper .ele-hotspot-image > img',
			)
		);

		$this->add_responsive_control(
			'hot_image_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-hotspot-wrapper .ele-hotspot-image > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'hot_image_shadow',
				'exclude'  => array(
					'box_shadow_position',
				),
				'selector' => '{{WRAPPER}} .ele-hotspot-wrapper .ele-hotspot-image > img',
			)
		);

		$this->add_responsive_control(
			'hot_image_padding',
			array(
				'label'      => esc_html__( 'Padding', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-hotspot-wrapper .ele-hotspot-image > img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		/* Spot */
		$this->start_controls_section(
			'section_style_spot',
			array(
				'label' => esc_html__( 'Spot', 'easyelements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'spot_font_size',
			array(
				'label'      => esc_html__( 'Media Size', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-hotspot-wrapper .ele-hotspot-item .ele-hotspot-item-wrap > i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-hotspot-wrapper .ele-hotspot-item .ele-hotspot-item-wrap > svg'   => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-hotspot-wrapper .ele-hotspot-item .ele-hotspot-item-wrap > img' => 'width: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-hotspot-wrapper .ele-hotspot-item .ele-hotspot-item-wrap > svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				),
			)
		);

		$this->add_responsive_control(
			'spot_width_size',
			array(
				'label'      => esc_html__( 'Background Size', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 500,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-hotspot-wrapper .ele-hotspot-item' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'spot_hot' );

		$this->start_controls_tab(
			'spots_hot_normal',
			array(
				'label' => esc_html__( 'Normal', 'easyelements' ),
			)
		);

		$this->add_control(
			'spot_color',
			array(
				'label'     => esc_html__( 'Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-hotspot-wrapper .ele-hotspot-item .ele-hotspot-item-wrap > i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ele-hotspot-wrapper .ele-hotspot-item .ele-hotspot-item-wrap > svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'spot_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-hotspot-wrapper .ele-hotspot-item' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'spot_hot_hover',
			array(
				'label' => esc_html__( 'Hover', 'easyelements' ),
			)
		);

		$this->add_control(
			'spot_hvr_color',
			array(
				'label'     => esc_html__( 'Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-hotspot-wrapper .ele-hotspot-item:hover .ele-hotspot-item-wrap > i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'spot_bg_hvr_color',
			array(
				'label'     => esc_html__( 'Background Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-hotspot-wrapper .ele-hotspot-item:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'spot_hvr_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-hotspot-wrapper .ele-hotspot-item:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'spot_border',
				'label'    => esc_html__( 'Border', 'easyelements' ),
				'selector' => '{{WRAPPER}} .ele-hotspot-wrapper .ele-hotspot-item',
			)
		);

		$this->add_responsive_control(
			'spot_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-hotspot-wrapper .ele-hotspot-item,
					{{WRAPPER}} .ele-hotspot-item-wrap:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'spot_image_shadow',
				'exclude'  => array(
					'box_shadow_position',
				),
				'selector' => '{{WRAPPER}} .ele-hotspot-wrapper .ele-hotspot-item',
			)
		);

		$this->end_controls_section();

		/* Tooltip */
		$this->start_controls_section(
			'section_style_tooltip',
			array(
				'label' => esc_html__( 'Tooltip', 'easyelements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'tooltip_alignment',
			array(
				'label'     => esc_html__( 'Alignment', 'easyelements' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
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
				'selectors' => array(
					'{{WRAPPER}} .ele-hotspot-tooltip-text' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tooltip_typography',
				'label'    => esc_html__( 'Typography', 'easyelements' ),
				'selector' => '{{WRAPPER}} .ele-hotspot-tooltip-text, {{WRAPPER}} .ele-hotspot-tooltip-text > *',
			)
		);

		$this->add_responsive_control(
			'tooltip_width_size',
			array(
				'label'      => esc_html__( 'Width', 'easyelements' ),
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
					'size' => 150,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-hotspot-tooltip-text' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'tooltip_color',
			array(
				'label'     => esc_html__( 'Text Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-hotspot-tooltip-text, {{WRAPPER}} .ele-hotspot-tooltip-text > *' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tooltip_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-hotspot-tooltip-text,
                    {{WRAPPER}} .ele-hotspot-tooltip-text:before' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'tooltip_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-hotspot-tooltip-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tooltip_box_shadow',
				'selector' => '{{WRAPPER}} .ele-hotspot-tooltip-text',
			)
		);

		$this->add_responsive_control(
			'tooltip_padding',
			array(
				'label'      => esc_html__( 'Padding', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-hotspot-tooltip-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		require ELE_WIDGET_ASSETS_PATH . 'hot-spot/layout/frontend.php';
	}
}
