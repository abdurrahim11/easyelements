<?php

namespace EasyElements\Elementor_Widgets\Pricing_Table;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;


class Pricing_Table extends Widget_Base {

	public function get_name() {
		return 'ele-pricing';
	}

	public function get_title() {
		return esc_html__( 'Pricing', 'easy-elements' );
	}

	public function get_icon() {
		return 'ele ele-pricing-table ele-widget-icon';
	}

	public function get_categories() {
		return array( 'easy-elements' );
	}

    public function get_keywords() {
        return array( 'pricing', 'price', 'card', 'table', 'cost', 'rate', 'fee', 'charge', 'billing', 'invoice', 'payment' );
    }

	protected function register_controls() {

		$this->start_controls_section(
			'section_header',
			array(
				'label' => esc_html__( 'Header', 'easy-elements' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => esc_html__( 'Title', 'easy-elements' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'Basic', 'easy-elements' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'media_type',
			array(
				'label'       => esc_html__( 'Media Type', 'easy-elements' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => array(
					'icon'  => array(
						'title' => esc_html__( 'Icon', 'easy-elements' ),
						'icon'  => 'eicon-star-o',
					),
					'image' => array(
						'title' => esc_html__( 'Image', 'easy-elements' ),
						'icon'  => 'eicon-image',
					),
				),
				'default'     => 'icon',
				'toggle'      => false,
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'     => esc_html__( 'Icon', 'easy-elements' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'far fa-clone',
					'library' => 'regular',
				),
				'condition' => array(
					'media_type' => 'icon',
				),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'     => esc_html__( 'Image', 'easy-elements' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'media_type' => 'image',
				),
				'dynamic'   => array(
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
				'condition' => array(
					'media_type' => 'image',
				),
			)
		);

		$this->add_control(
			'media_position',
			array(
				'label'   => esc_html__( 'Position', 'easy-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'before_header',
				'options' => array(
					'after_header'  => esc_html__( 'After Title', 'easy-elements' ),
					'before_header' => esc_html__( 'Before Title', 'easy-elements' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_price',
			array(
				'label' => esc_html__( 'Price', 'easy-elements' ),
			)
		);

		$this->add_control(
			'currency',
			array(
				'label'       => esc_html__( 'Currency', 'easy-elements' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => false,
				'options'     => array(
					''             => esc_html__( 'None', 'easy-elements' ),
					'dollar'       => '&#36; ' . _x( 'Dollar', 'Currency Symbol', 'easy-elements' ),
					'baht'         => '&#3647; ' . _x( 'Baht', 'Currency Symbol', 'easy-elements' ),
					'bdt'          => '&#2547; ' . _x( 'BD Taka', 'Currency Symbol', 'easy-elements' ),
					'euro'         => '&#128; ' . _x( 'Euro', 'Currency Symbol', 'easy-elements' ),
					'franc'        => '&#8355; ' . _x( 'Franc', 'Currency Symbol', 'easy-elements' ),
					'guilder'      => '&fnof; ' . _x( 'Guilder', 'Currency Symbol', 'easy-elements' ),
					'krona'        => 'kr ' . _x( 'Krona', 'Currency Symbol', 'easy-elements' ),
					'lira'         => '&#8356; ' . _x( 'Lira', 'Currency Symbol', 'easy-elements' ),
					'peseta'       => '&#8359 ' . _x( 'Peseta', 'Currency Symbol', 'easy-elements' ),
					'peso'         => '&#8369; ' . _x( 'Peso', 'Currency Symbol', 'easy-elements' ),
					'pound'        => '&#163; ' . _x( 'Pound Sterling', 'Currency Symbol', 'easy-elements' ),
					'real'         => 'R$ ' . _x( 'Real', 'Currency Symbol', 'easy-elements' ),
					'ruble'        => '&#8381; ' . _x( 'Ruble', 'Currency Symbol', 'easy-elements' ),
					'rupee'        => '&#8360; ' . _x( 'Rupee', 'Currency Symbol', 'easy-elements' ),
					'indian_rupee' => '&#8377; ' . _x( 'Rupee (Indian)', 'Currency Symbol', 'easy-elements' ),
					'shekel'       => '&#8362; ' . _x( 'Shekel', 'Currency Symbol', 'easy-elements' ),
					'won'          => '&#8361; ' . _x( 'Won', 'Currency Symbol', 'easy-elements' ),
					'yen'          => '&#165; ' . _x( 'Yen/Yuan', 'Currency Symbol', 'easy-elements' ),
					'custom'       => esc_html__( 'Custom', 'easy-elements' ),
				),
				'default'     => 'dollar',
			)
		);

		$this->add_control(
			'currency_custom',
			array(
				'label'     => esc_html__( 'Custom Symbol', 'easy-elements' ),
				'type'      => Controls_Manager::TEXT,
				'condition' => array(
					'currency' => 'custom',
				),
			)
		);

		$this->add_control(
			'price',
			array(
				'label'   => esc_html__( 'Price', 'easy-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '9.99',
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'period',
			array(
				'label'   => esc_html__( 'Period', 'easy-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Per Month', 'easy-elements' ),
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'price_position',
			array(
				'label'   => esc_html__( 'Position', 'easy-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'before_features',
				'options' => array(
					'before_features' => esc_html__( 'Before Features', 'easy-elements' ),
					'after_features'  => esc_html__( 'After Features', 'easy-elements' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_features',
			array(
				'label' => esc_html__( 'Features', 'easy-elements' ),
			)
		);

		$this->add_control(
			'show_feature',
			array(
				'label'        => esc_html__( 'Show', 'easy-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'easy-elements' ),
				'label_off'    => esc_html__( 'Hide', 'easy-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'features_title',
			array(
				'label'     => esc_html__( 'Title', 'easy-elements' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Features', 'easy-elements' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'show_feature' => 'yes',
				),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'icon',
			array(
				'label'       => esc_html__( 'Icon', 'easy-elements' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => array(
					'value'   => 'fas fa-check',
					'library' => 'fa-solid',
				),
				'recommended' => array(
					'fa-solid' => array(
						'check',
						'check-circle',
						'times',
						'times-circle',
					),
				),
			)
		);

		$repeater->add_control(
			'title_text',
			array(
				'label'       => esc_html__( 'Title', 'easy-elements' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Type list item content.', 'easy-elements' ),
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'tooltip_text',
			array(
				'label'       => esc_html__( 'Tooltip Text', 'easy-elements' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'placeholder' => esc_html__( 'Type tooltip text here.', 'easy-elements' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'status',
			array(
				'label'   => esc_html__( 'Status', 'easy-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'active',
				'options' => array(
					'active'   => esc_html__( 'Active', 'easy-elements' ),
					'inactive' => esc_html__( 'Inactive', 'easy-elements' ),
				),
			)
		);

		$this->add_control(
			'feature_items',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'show_label'  => false,
				'title_field' => sprintf(
				/* translators: %s: Title */
					esc_html__( 'Item: %1$s', 'easy-elements' ),
					'{{title_text}}'
				),
				'render_type' => 'template',
				'default'     => array(
					array(
						'icon'       => array(
							'value'   => 'fas fa-check',
							'library' => 'fa-solid',
						),
						'title_text' => esc_html__( 'Feature List 1', 'easy-elements' ),
						'status'     => 'active',
					),
					array(
						'icon'         => array(
							'value'   => 'fas fa-check',
							'library' => 'fa-solid',
						),
						'title_text'   => esc_html__( 'Feature List 2', 'easy-elements' ),
						'tooltip_text' => esc_html__( 'Tooltip Text Here', 'easy-elements' ),
						'status'       => 'active',
					),
					array(
						'icon'       => array(
							'value'   => 'fas fa-times',
							'library' => 'fa-solid',
						),
						'title_text' => esc_html__( 'Feature List 3', 'easy-elements' ),
						'status'     => 'inactive',
					),
					array(
						'icon'       => array(
							'value'   => 'fas fa-times',
							'library' => 'fa-solid',
						),
						'title_text' => esc_html__( 'Feature List 4', 'easy-elements' ),
						'status'     => 'inactive',
					),
				),
				'condition'   => array(
					'show_feature' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_description',
			array(
				'label' => esc_html__( 'Description', 'easy-elements' ),
			)
		);

		$this->add_control(
			'item_description',
			array(
				'label'   => '',
				'type'    => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'easy-elements' ),
			)
		);

		$this->add_control(
			'description_position',
			array(
				'label'   => esc_html__( 'Position', 'easy-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'before_features',
				'options' => array(
					'before_features' => esc_html__( 'Before Features', 'easy-elements' ),
					'after_features'  => esc_html__( 'After Features', 'easy-elements' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			array(
				'label' => esc_html__( 'Button', 'easy-elements' ),
			)
		);

		$this->add_control(
			'button_title',
			array(
				'label'       => esc_html__( 'Title', 'easy-elements' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'Get Started', 'easy-elements' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'button_link',
			array(
				'label'       => esc_html__( 'Link', 'easy-elements' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'placeholder' => 'https://yoursite.com/',
				'default'     => array(
					'url' => '#',
				),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'button_position',
			array(
				'label'   => esc_html__( 'Position', 'easy-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'after_features',
				'options' => array(
					'before_features' => esc_html__( 'Before Features', 'easy-elements' ),
					'after_features'  => esc_html__( 'After Features', 'easy-elements' ),
				),
			)
		);

		$this->add_control(
			'button_css_id',
			array(
				'label'       => esc_html__( 'Button ID', 'easy-elements' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => 'myID',
				'title'       => esc_html__( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'easy-elements' ),

			)
		);

		$this->add_control(
			'onclick_event',
			array(
				'label'       => esc_html__( 'onClick Event', 'easy-elements' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'myFunction()',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_badge',
			array(
				'label' => esc_html__( 'Badge', 'easy-elements' ),
			)
		);

		$this->add_control(
			'show_badge',
			array(
				'label'        => esc_html__( 'Show', 'easy-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'easy-elements' ),
				'label_off'    => esc_html__( 'Hide', 'easy-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'badge_text',
			array(
				'label'       => esc_html__( 'Text', 'easy-elements' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'Recommended', 'easy-elements' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'show_badge' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		//Styling
		$this->start_controls_section(
			'section_style_general',
			array(
				'label' => esc_html__( 'General', 'easy-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'align',
			array(
				'label'        => esc_html__( 'Alignment', 'easy-elements' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
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
				'prefix_class' => 'ele-pricing-align-',
				'selectors'    => array(
					'{{WRAPPER}} .ele-pricing-item' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_header',
			array(
				'label' => esc_html__( 'Header', 'easy-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'header_title_typography',
				'label'    => esc_html__( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-title',
			)
		);

		$this->add_control(
			'header_title_color',
			array(
				'label'     => esc_html__( 'Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'header_title_background',
				'label'    => esc_html__( 'Background', 'easy-elements' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .ele-pricing-title',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'header_title_border',
				'label'    => esc_html__( 'Border', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-title',
			)
		);

		$this->add_control(
			'header_title_display',
			array(
				'label'     => esc_html__( 'Display', 'easy-elements' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'block',
				'options'   => array(
					'block'        => array(
						'title' => esc_html__( 'Block', 'easy-elements' ),
						'icon'  => 'eicon-menu-bar',
					),
					'inline-block' => array(
						'title' => esc_html__( 'Inline', 'easy-elements' ),
						'icon'  => 'eicon-ellipsis-h',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-title' => 'display: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'header_title_padding',
			array(
				'label'      => esc_html__( 'Padding', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'header_title_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'header_media',
			array(
				'label'     => esc_html__( 'Media', 'easy-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'header_media_color',
			array(
				'label'     => esc_html__( 'Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'media_type' => 'icon',
				),
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-icon > i'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .ele-pricing-icon > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'header_media_size',
			array(
				'label'      => esc_html__( 'Size', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 40,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-icon > i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-pricing-icon > svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-pricing-media img'  => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_height',
			array(
				'label'          => esc_html__( 'Height', 'easy-elements' ),
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
				'condition'      => array(
					'media_type' => 'image',
				),
				'selectors'      => array(
					'{{WRAPPER}} .ele-pricing-media img' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'object-fit',
			array(
				'label'     => esc_html__( 'Object Fit', 'easy-elements' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					''        => esc_html__( 'Default', 'easy-elements' ),
					'fill'    => esc_html__( 'Fill', 'easy-elements' ),
					'cover'   => esc_html__( 'Cover', 'easy-elements' ),
					'contain' => esc_html__( 'Contain', 'easy-elements' ),
				),
				'default'   => '',
				'condition' => array(
					'media_type'          => 'image',
					'image_height[size]!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-media img' => 'object-fit: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'header_media_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-icon, {{WRAPPER}} .ele-pricing-media' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_price',
			array(
				'label' => esc_html__( 'Price', 'easy-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'price_style',
			array(
				'label'   => esc_html__( 'Layout', 'easy-elements' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => '2',
				'options' => array(
					'1' => array(
						'title' => esc_html__( 'Block', 'easy-elements' ),
						'icon'  => 'eicon-menu-bar',
					),
					'2' => array(
						'title' => esc_html__( 'Inline', 'easy-elements' ),
						'icon'  => 'eicon-ellipsis-h',
					),
				),
			)
		);

		$this->add_control(
			'price_color',
			array(
				'label'     => esc_html__( 'Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-price-tag' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'price_typography',
				'label'    => esc_html__( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-price-tag',
			)
		);

		$this->add_responsive_control(
			'price_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-price-tag' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'price_currency_title',
			array(
				'label'     => esc_html__( 'Currency', 'easy-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'price_currency_color',
			array(
				'label'     => esc_html__( 'Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-currency' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'price_currency_typography',
				'label'    => esc_html__( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-currency',
			)
		);

		$this->add_responsive_control(
			'price_currency_vertical_offset',
			array(
				'label'      => esc_html__( 'Vertical Offset', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'unit' => 'px',
				),
				'range'      => array(
					'px' => array(
						'min' => - 50,
						'max' => 50,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-currency' => 'transform: translateY({{SIZE}}{{UNIT}});',
				),
			)
		);

		$this->add_responsive_control(
			'price_currency_space_between',
			array(
				'label'      => esc_html__( 'Space Between', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'unit' => 'px',
				),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-currency' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'price_period_title',
			array(
				'label'     => esc_html__( 'Period', 'easy-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'price_period_color',
			array(
				'label'     => esc_html__( 'Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-price-period' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'price_period_typography',
				'label'    => esc_html__( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-price-period',
			)
		);

		$this->add_responsive_control(
			'price_period_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-price-period' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_features',
			array(
				'label'     => esc_html__( 'Features', 'easy-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_feature' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'features_margin',
			array(
				'label'      => esc_html__( 'Wrapper Margin', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-features' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'features_title_heading',
			array(
				'label'     => esc_html__( 'Title', 'easy-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'features_title_color',
			array(
				'label'     => esc_html__( 'Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-features-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'features_title_typography',
				'label'    => esc_html__( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-features-title',
			)
		);

		$this->add_responsive_control(
			'features_title_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-features-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'features_list_heading',
			array(
				'label'     => esc_html__( 'Feature List', 'easy-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'features_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 14,
				),
				'selectors'  => array(				
					'{{WRAPPER}} .ele-pricing-feature-icon svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-pricing-feature-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'features_icon_space',
			array(
				'label'      => esc_html__( 'Icon Space', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-feature-icon'                          => 'margin:0 {{SIZE}}{{UNIT}} 0 0;',
					'{{WRAPPER}}.ele-pricing-align-right .ele-pricing-feature-icon' => 'margin:0 0 0 {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'features_list_align',
			array(
				'label'     => esc_html__( 'Content Align', 'easy-elements' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Left', 'easy-elements' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'easy-elements' ),
						'icon'  => 'eicon-h-align-center',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-features-list li' => 'justify-content: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'features_list_typography',
				'label'    => esc_html__( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-features-list li',
			)
		);

		$this->add_responsive_control(
			'features_list_space_between',
			array(
				'label'      => esc_html__( 'Space between', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 15,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-features-list li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'features_list_tab' );

		$this->start_controls_tab(
			'features_list_active',
			array(
				'label' => esc_html__( 'Active', 'easy-elements' ),
			)
		);

		$this->add_control(
			'features_list_active_color',
			array(
				'label'     => esc_html__( 'Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-features-list li.active' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ele-pricing-features-list li.active svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'features_list_active_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-features-list li.active .ele-pricing-feature-icon' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'features_list_inactive',
			array(
				'label' => esc_html__( 'Inactive', 'easy-elements' ),
			)
		);

		$this->add_control(
			'features_list_inactive_color',
			array(
				'label'     => esc_html__( 'Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-features-list li.inactive' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'features_list_inactive_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-features-list li.inactive .ele-pricing-feature-icon' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'features_list_tooltip',
			array(
				'label'     => esc_html__( 'Tooltip', 'easy-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'features_list_tooltip_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-item .ele-pricing-tooltip-toggle' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'features_list_tooltip_bg',
			array(
				'label'     => esc_html__( 'Icon Background', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-item .ele-pricing-tooltip-toggle' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'features_tooltip_typography',
				'label'    => esc_html__( 'Content Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-item .ele-pricing-tooltip',
			)
		);

		$this->add_responsive_control(
			'features_list_tooltip_width',
			array(
				'label'      => esc_html__( 'Width', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 200,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-item .ele-pricing-tooltip' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'features_list_tooltip_content_color',
			array(
				'label'     => esc_html__( 'Content Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-item .ele-pricing-tooltip' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'features_list_tooltip_content_bg',
			array(
				'label'     => esc_html__( 'Content Background', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-item .ele-pricing-tooltip'        => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .ele-pricing-item .ele-pricing-tooltip::after' => 'border-color: transparent {{VALUE}} transparent transparent;',
				),
			)
		);

		$this->add_responsive_control(
			'features_list_icon_tooltip_padding',
			array(
				'label'      => esc_html__( 'Content Padding', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-item .ele-pricing-tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_description_style',
			array(
				'label' => esc_html__( 'Description', 'easy-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'features_description_color',
			array(
				'label'     => esc_html__( 'Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-description,{{WRAPPER}} .ele-pricing-description > *' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'label'    => esc_html__( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-description, {{WRAPPER}} .ele-pricing-description > *',
			)
		);

		$this->add_responsive_control(
			'description_width',
			array(
				'label'      => esc_html__( 'Max Width', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 400,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-description' => 'max-width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .ele-pricing-description-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_separator_style',
			array(
				'label' => esc_html__( 'Separator', 'easy-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'show_separator',
			array(
				'label'        => esc_html__( 'Show', 'easy-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'easy-elements' ),
				'label_off'    => esc_html__( 'Hide', 'easy-elements' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'separator_color',
			array(
				'label'     => esc_html__( 'Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-separator:before' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'show_separator' => 'yes',
				),
			)
		);

		$this->add_control(
			'separator_style',
			array(
				'label'     => esc_html__( 'Style', 'easy-elements' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => array(
					'solid'  => esc_html__( 'Solid', 'easy-elements' ),
					'double' => esc_html__( 'Double', 'easy-elements' ),
					'dotted' => esc_html__( 'Dotted', 'easy-elements' ),
					'dashed' => esc_html__( 'Dashed', 'easy-elements' ),
					'groove' => esc_html__( 'Groove', 'easy-elements' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-separator:before' => 'border-top-style: {{VALUE}};',
				),
				'condition' => array(
					'show_separator' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'separator_width',
			array(
				'label'      => esc_html__( 'Width', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
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
					'{{WRAPPER}} .ele-pricing-separator:before' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'show_separator' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'separator_height',
			array(
				'label'      => esc_html__( 'Height', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-separator:before' => 'border-top-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'show_separator' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'separator_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-separator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'show_separator' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			array(
				'label' => esc_html__( 'Button', 'easy-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'button_display',
			array(
				'label'     => esc_html__( 'Display', 'easy-elements' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'inline-block',
				'options'   => array(
					'block'        => array(
						'title' => esc_html__( 'Block', 'easy-elements' ),
						'icon'  => 'eicon-menu-bar',
					),
					'inline-block' => array(
						'title' => esc_html__( 'Inline', 'easy-elements' ),
						'icon'  => 'eicon-ellipsis-h',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-btn' => 'display: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'label'    => esc_html__( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-btn',
			)
		);

		$this->start_controls_tabs(
			'button_style_tabs'
		);

		$this->start_controls_tab(
			'button_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'easy-elements' ),
			)
		);

		$this->add_control(
			'button_color',
			array(
				'label'     => esc_html__( 'Text Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-btn' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_bg',
				'label'    => esc_html__( 'Background', 'easy-elements' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .ele-pricing-btn',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'button_border',
				'label'    => esc_html__( 'Border', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-btn',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_hover_tab_style',
			array(
				'label' => esc_html__( 'Hover', 'easy-elements' ),
			)
		);

		$this->add_control(
			'button_hcolor',
			array(
				'label'     => esc_html__( 'Text Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-btn:hover,{{WRAPPER}} .ele-pricing-btn:focus' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_hbg',
				'label'    => esc_html__( 'Background', 'easy-elements' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .ele-pricing-btn:hover,{{WRAPPER}} .ele-pricing-btn:focus',
			)
		);

		$this->add_control(
			'button_hborder',
			array(
				'label'     => esc_html__( 'Border Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-btn:hover,{{WRAPPER}} .ele-pricing-btn:focus' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'button_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_item_padding',
			array(
				'label'      => esc_html__( 'Padding', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_badge_style',
			array(
				'label'     => esc_html__( 'Badge', 'easy-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_badge' => 'yes',
				),
			)
		);

		$this->add_control(
			'badge_display',
			array(
				'label'     => esc_html__( 'Display', 'easy-elements' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'auto',
				'options'   => array(
					'100%' => array(
						'title' => esc_html__( 'Block', 'easy-elements' ),
						'icon'  => 'eicon-menu-bar',
					),
					'auto' => array(
						'title' => esc_html__( 'Inline', 'easy-elements' ),
						'icon'  => 'eicon-ellipsis-h',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-item .ele-badge'            => 'width: {{VALUE}}; top:0; left: 0',
					'{{WRAPPER}} .ele-pricing-item .ele-badge-top-left'   => 'left:0; right:auto;',
					'{{WRAPPER}} .ele-pricing-item .ele-badge-top-center' => 'left:50%; right:auto;',
					'{{WRAPPER}} .ele-pricing-item .ele-badge-top-right'  => 'right:0; left:auto;',
				),
			)
		);

		$this->add_control(
			'badge_position',
			array(
				'label'     => esc_html__( 'Position', 'easy-elements' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'top-left'   => esc_html__( 'Top Left', 'easy-elements' ),
					'top-center' => esc_html__( 'Top Center', 'easy-elements' ),
					'top-right'  => esc_html__( 'Top Right', 'easy-elements' ),
				),
				'default'   => 'top-right',
				'condition' => array(
					'badge_display' => 'auto',
				),
			)
		);

		$this->add_control(
			'badge_transform_toggle',
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
			'badge_horizontal_offset',
			array(
				'label'      => esc_html__( 'Horizontal Offset', 'easy-elements' ),
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
				'condition'  => array(
					'badge_transform_toggle' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-item .ele-badge' => '--ele-badge-translate-x: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'badge_vertical_offset',
			array(
				'label'      => esc_html__( 'Vertical Offset', 'easy-elements' ),
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
						'max' => 200,
					),
				),
				'condition'  => array(
					'badge_transform_toggle' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-item .ele-badge' => '--ele-badge-translate-y: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'badge_rotate',
			array(
				'label'      => esc_html__( 'Rotate', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => - 360,
						'max' => 360,
					),
				),
				'condition'  => array(
					'badge_transform_toggle' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-item .ele-badge' => '--ele-badge-rotate: {{SIZE}}deg;',
				),
			)
		);

		$this->add_control(
			'badge_transform_origin',
			array(
				'label'       => esc_html__( 'Transform Origin', 'easy-elements' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => true,
				'options'     => array(
					'center center' => _x( 'Center Center', 'Background Control', 'easy-elements' ),
					'center left'   => _x( 'Center Left', 'Background Control', 'easy-elements' ),
					'center right'  => _x( 'Center Right', 'Background Control', 'easy-elements' ),
					'top center'    => _x( 'Top Center', 'Background Control', 'easy-elements' ),
					'top left'      => _x( 'Top Left', 'Background Control', 'easy-elements' ),
					'top right'     => _x( 'Top Right', 'Background Control', 'easy-elements' ),
					'bottom center' => _x( 'Bottom Center', 'Background Control', 'easy-elements' ),
					'bottom left'   => _x( 'Bottom Left', 'Background Control', 'easy-elements' ),
					'bottom right'  => _x( 'Bottom Right', 'Background Control', 'easy-elements' ),
				),
				'default'     => 'center center',
				'selectors'   => array(
					'{{WRAPPER}} .ele-pricing-item .ele-badge' => 'transform-origin: {{VALUE}};',
				),
				'condition'   => array(
					'badge_transform_toggle' => 'yes',
				),
			)
		);

		$this->end_popover();

		$this->add_control(
			'badge_overflow',
			array(
				'label'     => esc_html__( 'Overflow', 'easy-elements' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					''       => _x( 'Auto', 'Background Control', 'easy-elements' ),
					'hidden' => _x( 'Hidden', 'Background Control', 'easy-elements' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}}.elementor-widget-ele-pricing > .elementor-widget-container' => 'overflow: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'badge_typography',
				'label'    => esc_html__( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-item .ele-badge',
			)
		);

		$this->add_control(
			'badge_color',
			array(
				'label'     => esc_html__( 'Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-item .ele-badge' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'badge_background',
				'label'    => esc_html__( 'Background', 'easy-elements' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .ele-pricing-item .ele-badge',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'badge_border',
				'label'    => esc_html__( 'Border', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-item .ele-badge',
			)
		);

		$this->add_responsive_control(
			'badge_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-item .ele-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .ele-pricing-item .ele-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

    private static function get_currency_symbol_by_name( $currency_name ) {
        // Define an array of currency symbols
        $currency_symbols = array(
            'won'          => '&#8361;',
            'ruble'        => '&#8381;',
            'dollar'       => '&#36;',
            'yen'          => '&#165;',
            'peso'         => '&#8369;',
            'guilder'      => '&fnof;',
            'krona'        => 'kr',
            'indian_rupee' => '&#8377;',
            'real'         => 'R$',
            'euro'         => '&#128;',
            'baht'         => '&#3647;',
            'rupee'        => '&#8360;',
            'shekel'       => '&#8362;',
            'lira'         => '&#8356;',
            'franc'        => '&#8355;',
            'pound'        => '&#163;',
            'peseta'       => '&#8359;',
            'bdt'          => '&#2547;',
        );

        // Return the currency symbol if it exists in the array, otherwise return an empty string
        return isset( $currency_symbols[ $currency_name ] ) ? $currency_symbols[ $currency_name ] : '';
    }

	protected function render() {
		$settings = $this->get_settings_for_display();

		require ELE_WIDGET_ASSETS_PATH . 'pricing-table/layout/frontend.php';
	}
}
