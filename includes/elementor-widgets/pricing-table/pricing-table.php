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

	private static function get_currency_symbol( $symbol_name ) {
		$symbols = array(
			'dollar'       => '&#36;',
			'baht'         => '&#3647;',
			'bdt'          => '&#2547;',
			'euro'         => '&#128;',
			'franc'        => '&#8355;',
			'guilder'      => '&fnof;',
			'indian_rupee' => '&#8377;',
			'pound'        => '&#163;',
			'peso'         => '&#8369;',
			'peseta'       => '&#8359',
			'lira'         => '&#8356;',
			'ruble'        => '&#8381;',
			'shekel'       => '&#8362;',
			'rupee'        => '&#8360;',
			'real'         => 'R$',
			'krona'        => 'kr',
			'won'          => '&#8361;',
			'yen'          => '&#165;'
		);

		return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
	}

	/**
	 * Get widget name.
	 *
	 * Retrieve image widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'ele-pricing';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve image widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'Pricing', 'easy-elements' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve image widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'ele ele-pricing-table ele-widget-icon';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the image widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_categories() {
		return array( 'easy-elements' );
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @return array Widget keywords.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_keywords() {
		return array( 'pricing', 'price', 'card', 'table' );
	}

	/**
	 * Register Pricing widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Header', 'easy-elements' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'easy-elements' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => __( 'Basic', 'easy-elements' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'media_type',
			array(
				'label'       => __( 'Media Type', 'easy-elements' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => array(
					'icon'  => array(
						'title' => __( 'Icon', 'easy-elements' ),
						'icon'  => 'eicon-star-o',
					),
					'image' => array(
						'title' => __( 'Image', 'easy-elements' ),
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
				'label'     => __( 'Icon', 'easy-elements' ),
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
				'label'     => __( 'Image', 'easy-elements' ),
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
				'label'   => __( 'Position', 'easy-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'before_header',
				'options' => array(
					'after_header'  => __( 'After Title', 'easy-elements' ),
					'before_header' => __( 'Before Title', 'easy-elements' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_price',
			array(
				'label' => __( 'Price', 'easy-elements' ),
			)
		);

		$this->add_control(
			'currency',
			array(
				'label'       => __( 'Currency', 'easy-elements' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => false,
				'options'     => array(
					''             => __( 'None', 'easy-elements' ),
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
					'custom'       => __( 'Custom', 'easy-elements' ),
				),
				'default'     => 'dollar',
			)
		);

		$this->add_control(
			'currency_custom',
			array(
				'label'     => __( 'Custom Symbol', 'easy-elements' ),
				'type'      => Controls_Manager::TEXT,
				'condition' => array(
					'currency' => 'custom',
				),
			)
		);

		$this->add_control(
			'price',
			array(
				'label'   => __( 'Price', 'easy-elements' ),
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
				'label'   => __( 'Period', 'easy-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Per Month', 'easy-elements' ),
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'price_position',
			array(
				'label'   => __( 'Position', 'easy-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'before_features',
				'options' => array(
					'before_features' => __( 'Before Features', 'easy-elements' ),
					'after_features'  => __( 'After Features', 'easy-elements' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_features',
			array(
				'label' => __( 'Features', 'easy-elements' ),
			)
		);

		$this->add_control(
			'show_feature',
			array(
				'label'        => __( 'Show', 'easy-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'easy-elements' ),
				'label_off'    => __( 'Hide', 'easy-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'features_title',
			array(
				'label'     => __( 'Title', 'easy-elements' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Features', 'easy-elements' ),
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
				'label'       => __( 'Icon', 'easy-elements' ),
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
				'label'       => __( 'Title', 'easy-elements' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Type list item content.', 'easy-elements' ),
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'tooltip_text',
			array(
				'label'       => __( 'Tooltip Text', 'easy-elements' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'placeholder' => __( 'Type tooltip text here.', 'easy-elements' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'status',
			array(
				'label'   => __( 'Status', 'easy-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'active',
				'options' => array(
					'active'   => __( 'Active', 'easy-elements' ),
					'inactive' => __( 'Inactive', 'easy-elements' ),
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
					__( 'Item: %1$s', 'easy-elements' ),
					'{{title_text}}'
				),
				'render_type' => 'template',
				'default'     => array(
					array(
						'icon'       => array(
							'value'   => 'fas fa-check',
							'library' => 'fa-solid',
						),
						'title_text' => __( 'Feature List 1', 'easy-elements' ),
						'status'     => 'active',
					),
					array(
						'icon'         => array(
							'value'   => 'fas fa-check',
							'library' => 'fa-solid',
						),
						'title_text'   => __( 'Feature List 2', 'easy-elements' ),
						'tooltip_text' => __( 'Tooltip Text Here', 'easy-elements' ),
						'status'       => 'active',
					),
					array(
						'icon'       => array(
							'value'   => 'fas fa-times',
							'library' => 'fa-solid',
						),
						'title_text' => __( 'Feature List 3', 'easy-elements' ),
						'status'     => 'inactive',
					),
					array(
						'icon'       => array(
							'value'   => 'fas fa-times',
							'library' => 'fa-solid',
						),
						'title_text' => __( 'Feature List 4', 'easy-elements' ),
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
				'label' => __( 'Description', 'easy-elements' ),
			)
		);

		$this->add_control(
			'item_description',
			array(
				'label'   => '',
				'type'    => Controls_Manager::WYSIWYG,
				'default' => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'easy-elements' ),
			)
		);

		$this->add_control(
			'description_position',
			array(
				'label'   => __( 'Position', 'easy-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'before_features',
				'options' => array(
					'before_features' => __( 'Before Features', 'easy-elements' ),
					'after_features'  => __( 'After Features', 'easy-elements' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			array(
				'label' => __( 'Button', 'easy-elements' ),
			)
		);

		$this->add_control(
			'button_title',
			array(
				'label'       => __( 'Title', 'easy-elements' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => __( 'Get Started', 'easy-elements' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'button_link',
			array(
				'label'       => __( 'Link', 'easy-elements' ),
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
				'label'   => __( 'Position', 'easy-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'after_features',
				'options' => array(
					'before_features' => __( 'Before Features', 'easy-elements' ),
					'after_features'  => __( 'After Features', 'easy-elements' ),
				),
			)
		);

		$this->add_control(
			'button_css_id',
			array(
				'label'       => __( 'Button ID', 'easy-elements' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => 'myID',
				'title'       => __( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'easy-elements' ),

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
				'label' => __( 'Badge', 'easy-elements' ),
			)
		);

		$this->add_control(
			'show_badge',
			array(
				'label'        => __( 'Show', 'easy-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'easy-elements' ),
				'label_off'    => __( 'Hide', 'easy-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'badge_text',
			array(
				'label'       => __( 'Text', 'easy-elements' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => __( 'Recommended', 'easy-elements' ),
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
				'label' => __( 'General', 'easy-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'align',
			array(
				'label'        => __( 'Alignment', 'easy-elements' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
					'left'   => array(
						'title' => __( 'Left', 'easy-elements' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'easy-elements' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'easy-elements' ),
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
				'label' => __( 'Header', 'easy-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'header_title_typography',
				'label'    => __( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-title',
			)
		);

		$this->add_control(
			'header_title_color',
			array(
				'label'     => __( 'Color', 'easy-elements' ),
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
				'label'    => __( 'Background', 'easy-elements' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .ele-pricing-title',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'header_title_border',
				'label'    => __( 'Border', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-title',
			)
		);

		$this->add_control(
			'header_title_display',
			array(
				'label'     => __( 'Display', 'easy-elements' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'block',
				'options'   => array(
					'block'        => array(
						'title' => __( 'Block', 'easy-elements' ),
						'icon'  => 'eicon-menu-bar',
					),
					'inline-block' => array(
						'title' => __( 'Inline', 'easy-elements' ),
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
				'label'      => __( 'Padding', 'easy-elements' ),
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
				'label'      => __( 'Margin', 'easy-elements' ),
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
				'label'     => __( 'Media', 'easy-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'header_media_color',
			array(
				'label'     => __( 'Color', 'easy-elements' ),
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
				'label'      => __( 'Size', 'easy-elements' ),
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
				'label'          => __( 'Height', 'easy-elements' ),
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
				'label'     => __( 'Object Fit', 'easy-elements' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					''        => __( 'Default', 'easy-elements' ),
					'fill'    => __( 'Fill', 'easy-elements' ),
					'cover'   => __( 'Cover', 'easy-elements' ),
					'contain' => __( 'Contain', 'easy-elements' ),
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
				'label'      => __( 'Margin', 'easy-elements' ),
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
				'label' => __( 'Price', 'easy-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'price_style',
			array(
				'label'   => __( 'Layout', 'easy-elements' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => '2',
				'options' => array(
					'1' => array(
						'title' => __( 'Block', 'easy-elements' ),
						'icon'  => 'eicon-menu-bar',
					),
					'2' => array(
						'title' => __( 'Inline', 'easy-elements' ),
						'icon'  => 'eicon-ellipsis-h',
					),
				),
			)
		);

		$this->add_control(
			'price_color',
			array(
				'label'     => __( 'Color', 'easy-elements' ),
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
				'label'    => __( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-price-tag',
			)
		);

		$this->add_responsive_control(
			'price_margin',
			array(
				'label'      => __( 'Margin', 'easy-elements' ),
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
				'label'     => __( 'Currency', 'easy-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'price_currency_color',
			array(
				'label'     => __( 'Color', 'easy-elements' ),
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
				'label'    => __( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-currency',
			)
		);

		$this->add_responsive_control(
			'price_currency_vertical_offset',
			array(
				'label'      => __( 'Vertical Offset', 'easy-elements' ),
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
				'label'      => __( 'Space Between', 'easy-elements' ),
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
				'label'     => __( 'Period', 'easy-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'price_period_color',
			array(
				'label'     => __( 'Color', 'easy-elements' ),
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
				'label'    => __( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-price-period',
			)
		);

		$this->add_responsive_control(
			'price_period_margin',
			array(
				'label'      => __( 'Margin', 'easy-elements' ),
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
				'label'     => __( 'Features', 'easy-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_feature' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'features_margin',
			array(
				'label'      => __( 'Wrapper Margin', 'easy-elements' ),
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
				'label'     => __( 'Title', 'easy-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'features_title_color',
			array(
				'label'     => __( 'Color', 'easy-elements' ),
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
				'label'    => __( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-features-title',
			)
		);

		$this->add_responsive_control(
			'features_title_margin',
			array(
				'label'      => __( 'Margin', 'easy-elements' ),
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
				'label'     => __( 'Feature List', 'easy-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'features_icon_size',
			array(
				'label'      => __( 'Icon Size', 'easy-elements' ),
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
				'label'      => __( 'Icon Space', 'easy-elements' ),
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
				'label'     => __( 'Content Align', 'easy-elements' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => __( 'Left', 'easy-elements' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center'     => array(
						'title' => __( 'Center', 'easy-elements' ),
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
				'label'    => __( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-features-list li',
			)
		);

		$this->add_responsive_control(
			'features_list_space_between',
			array(
				'label'      => __( 'Space between', 'easy-elements' ),
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
				'label' => __( 'Active', 'easy-elements' ),
			)
		);

		$this->add_control(
			'features_list_active_color',
			array(
				'label'     => __( 'Color', 'easy-elements' ),
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
				'label'     => __( 'Icon Color', 'easy-elements' ),
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
				'label' => __( 'Inactive', 'easy-elements' ),
			)
		);

		$this->add_control(
			'features_list_inactive_color',
			array(
				'label'     => __( 'Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-features-list li.inactive' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'features_list_inactive_icon_color',
			array(
				'label'     => __( 'Icon Color', 'easy-elements' ),
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
				'label'     => __( 'Tooltip', 'easy-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'features_list_tooltip_color',
			array(
				'label'     => __( 'Icon Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-item .ele-pricing-tooltip-toggle' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'features_list_tooltip_bg',
			array(
				'label'     => __( 'Icon Background', 'easy-elements' ),
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
				'label'    => __( 'Content Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-item .ele-pricing-tooltip',
			)
		);

		$this->add_responsive_control(
			'features_list_tooltip_width',
			array(
				'label'      => __( 'Width', 'easy-elements' ),
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
				'label'     => __( 'Content Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-pricing-item .ele-pricing-tooltip' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'features_list_tooltip_content_bg',
			array(
				'label'     => __( 'Content Background', 'easy-elements' ),
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
				'label'      => __( 'Content Padding', 'easy-elements' ),
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
				'label' => __( 'Description', 'easy-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'features_description_color',
			array(
				'label'     => __( 'Color', 'easy-elements' ),
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
				'label'    => __( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-description, {{WRAPPER}} .ele-pricing-description > *',
			)
		);

		$this->add_responsive_control(
			'description_width',
			array(
				'label'      => __( 'Max Width', 'easy-elements' ),
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
				'label'      => __( 'Margin', 'easy-elements' ),
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
				'label' => __( 'Separator', 'easy-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'show_separator',
			array(
				'label'        => __( 'Show', 'easy-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'easy-elements' ),
				'label_off'    => __( 'Hide', 'easy-elements' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'separator_color',
			array(
				'label'     => __( 'Color', 'easy-elements' ),
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
				'label'     => __( 'Style', 'easy-elements' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => array(
					'solid'  => __( 'Solid', 'easy-elements' ),
					'double' => __( 'Double', 'easy-elements' ),
					'dotted' => __( 'Dotted', 'easy-elements' ),
					'dashed' => __( 'Dashed', 'easy-elements' ),
					'groove' => __( 'Groove', 'easy-elements' ),
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
				'label'      => __( 'Width', 'easy-elements' ),
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
				'label'      => __( 'Height', 'easy-elements' ),
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
				'label'      => __( 'Margin', 'easy-elements' ),
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
				'label' => __( 'Button', 'easy-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'button_display',
			array(
				'label'     => __( 'Display', 'easy-elements' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'inline-block',
				'options'   => array(
					'block'        => array(
						'title' => __( 'Block', 'easy-elements' ),
						'icon'  => 'eicon-menu-bar',
					),
					'inline-block' => array(
						'title' => __( 'Inline', 'easy-elements' ),
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
				'label'    => __( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-btn',
			)
		);

		$this->start_controls_tabs(
			'button_style_tabs'
		);

		$this->start_controls_tab(
			'button_normal_tab',
			array(
				'label' => __( 'Normal', 'easy-elements' ),
			)
		);

		$this->add_control(
			'button_color',
			array(
				'label'     => __( 'Text Color', 'easy-elements' ),
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
				'label'    => __( 'Background', 'easy-elements' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .ele-pricing-btn',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'button_border',
				'label'    => __( 'Border', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-btn',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_hover_tab_style',
			array(
				'label' => __( 'Hover', 'easy-elements' ),
			)
		);

		$this->add_control(
			'button_hcolor',
			array(
				'label'     => __( 'Text Color', 'easy-elements' ),
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
				'label'    => __( 'Background', 'easy-elements' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .ele-pricing-btn:hover,{{WRAPPER}} .ele-pricing-btn:focus',
			)
		);

		$this->add_control(
			'button_hborder',
			array(
				'label'     => __( 'Border Color', 'easy-elements' ),
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
				'label'      => __( 'Border Radius', 'easy-elements' ),
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
				'label'      => __( 'Padding', 'easy-elements' ),
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
				'label'      => __( 'Margin', 'easy-elements' ),
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
				'label'     => __( 'Badge', 'easy-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_badge' => 'yes',
				),
			)
		);

		$this->add_control(
			'badge_display',
			array(
				'label'     => __( 'Display', 'easy-elements' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'auto',
				'options'   => array(
					'100%' => array(
						'title' => __( 'Block', 'easy-elements' ),
						'icon'  => 'eicon-menu-bar',
					),
					'auto' => array(
						'title' => __( 'Inline', 'easy-elements' ),
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
				'label'     => __( 'Position', 'easy-elements' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'top-left'   => __( 'Top Left', 'easy-elements' ),
					'top-center' => __( 'Top Center', 'easy-elements' ),
					'top-right'  => __( 'Top Right', 'easy-elements' ),
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
				'label'        => __( 'Transform', 'easy-elements' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'None', 'easy-elements' ),
				'label_on'     => __( 'Custom', 'easy-elements' ),
				'return_value' => 'yes',
			)
		);

		$this->start_popover();

		$this->add_responsive_control(
			'badge_horizontal_offset',
			array(
				'label'      => __( 'Horizontal Offset', 'easy-elements' ),
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
				'label'      => __( 'Vertical Offset', 'easy-elements' ),
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
				'label'      => __( 'Rotate', 'easy-elements' ),
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
				'label'       => __( 'Transform Origin', 'easy-elements' ),
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
				'label'     => __( 'Overflow', 'easy-elements' ),
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
				'label'    => __( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-item .ele-badge',
			)
		);

		$this->add_control(
			'badge_color',
			array(
				'label'     => __( 'Color', 'easy-elements' ),
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
				'label'    => __( 'Background', 'easy-elements' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .ele-pricing-item .ele-badge',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'badge_border',
				'label'    => __( 'Border', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-pricing-item .ele-badge',
			)
		);

		$this->add_responsive_control(
			'badge_border_radius',
			array(
				'label'      => __( 'Border Radius', 'easy-elements' ),
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
				'label'      => __( 'Padding', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-pricing-item .ele-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render image widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		require ELE_WIDGET_ASSETS_PATH . 'pricing-table/layout/frontend.php';
	}
}
