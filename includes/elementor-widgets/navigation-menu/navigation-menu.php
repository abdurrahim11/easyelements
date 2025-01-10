<?php

namespace EasyElements\Elementor_Widgets\Navigation_Menu;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use Elementor\Widget_Base;

class Navigation_Menu extends Widget_Base {
    public function __construct( $data = [], $args = null ) {
        parent::__construct( $data, $args );
        $this->add_script_depends('ele-nav-menu');
    }

    public function get_name() {
        return 'ele-nav-menu';
    }

    public function get_title() {
        return esc_html__( 'Nav Menu', 'easy-elements' );
    }

    public function get_icon() {
        return 'ele ele-nav-menu ele-widget-icon';
    }

    public function get_categories() {
        return [ 'easy-elements' ];
    }

    public function get_keywords() {
        return ['ele', 'menu', 'nav-menu', 'nav', 'navigation', 'navigation-menu', 'mega', 'megamenu', 'mega-menu', 'header-menu', 'footer-menu', 'sidebar-menu', 'primary-menu', 'secondary-menu', 'mobile-menu', 'dropdown-menu', 'horizontal-menu', 'vertical-menu', 'responsive-menu', 'custom-menu', 'menu-bar', 'site-menu', 'main-menu', 'top-menu', 'sub-menu', 'side-menu'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'easyelements_content_tab',
            [
                'label' => esc_html__('Menu Settings', 'easy-elements'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'ele_control_nav_menu',
            [
                'label'     => esc_html__( 'Select menu', 'easy-elements' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $this->get_navigation_menus(),
            ]
        );

        $this->add_responsive_control(
            'easyelements_main_menu_position',
            [
                'label' => esc_html__( 'Horizontal menu position', '-lite' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'easyelements-menu-po-left',
                'options' => [
                    'easyelements-menu-po-left'  => esc_html__( 'Left', 'easy-elements' ),
                    'easyelements-menu-po-center' => esc_html__( 'Center', 'easy-elements' ),
                    'easyelements-menu-po-right' => esc_html__( 'Right', 'easy-elements' ),
                    'easyelements-menu-po-justified'  => esc_html__( 'Justified', 'easy-elements' ),
                ],
            ]
        );

        $this->add_control(
            'easyelements_nav_dropdown_as',
            [
                'label' => esc_html__( 'Dropdown open as', 'easy-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ele-nav-dropdown-hover',
                'options' => [
                    'ele-nav-dropdown-hover'  => esc_html__( 'Hover', 'easy-elements' ),
                    'ele-nav-dropdown-click' => esc_html__( 'Click', 'easy-elements' ),
                ],
            ]
        );

        $this->add_control(
            'easyelements_submenu_indicator_icon',
            [
                'label' => esc_html__( 'Dropdown Indicator Icon', 'easy-elements' ),
                'type' => Controls_Manager::ICONS,
                'skin' => 'inline',
                'exclude_inline_options' => ['svg'],
                'skin_settings' => [
                    'inline' => [
                        'none' => [
                            'label' => esc_html__( 'Default', 'easy-elements' ),
                            'icon' => 'ele ele-down-arrow',
                        ],
                        'icon' => [
                            'label' => esc_html__( 'Icon Library', 'easy-elements' ),
                            'icon' => 'fas fa-external-link-alt',
                        ],
                    ],
                ],
                'recommended' => [
                    'fa-solid' => [
                        'external-link-alt',
                        'link',
                        'plus',
                        'angle-down',
                    ],
                    'easyelements' => [
                        'down-arrow',
                        'plus',
                        'arrow-point-to-down',
                        'link',
                    ],
                ],
                'label_block' => false,
            ]
        );

        $this->add_control(
            'easyelements_one_page_enable',
            [
                'label' => esc_html__('Enable one page? ', 'easy-elements'),
                'description'	=> esc_html__('This works in the current page.', 'easy-elements'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' =>esc_html__( 'Yes', 'easy-elements' ),
                'label_off' =>esc_html__( 'No', 'easy-elements' ),
            ]
        );

        $this->add_control(
            'easyelements_responsive_breakpoint',
            [
                'label' => esc_html__( 'Responsive Breakpoint', 'easy-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ele_menu_responsive_tablet',
                'options' => [
                    'ele_menu_responsive_tablet'  => esc_html__( 'Tablet', 'easy-elements' ),
                    'ele_menu_responsive_mobile' => esc_html__( 'Mobile', 'easy-elements' ),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'easyelements_mobile_menu',
            [
                'label' => esc_html__('Mobile Menu Settings', 'easy-elements'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'easyelements_nav_menu_logo',
            [
                'label' => esc_html__( 'Mobile Menu Logo', 'easy-elements' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '', //Utils::get_placeholder_image_src() -- removed for conflict with jetpack
                    'id'    => -1
                ],
            ]
        );

        $this->add_control(
            'easyelements_nav_menu_logo_link_to',
            [
                'label' => esc_html__( 'Menu link', 'easy-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'home',
                'options' => [
                    'home' => esc_html__( 'Default(Home)', 'easy-elements' ),
                    'custom' => esc_html__( 'Custom URL', 'easy-elements' ),
                ],
            ]
        );

        $this->add_control(
            'easyelements_nav_menu_logo_link',
            [
                'label' => esc_html__( ' Custom Link', 'easy-elements' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => 'https://wpmet.com',
                'condition' => [
                    'easyelements_nav_menu_logo_link_to' => 'custom',
                ],
                'show_label' => false,

            ]
        );

        $this->add_control(
            'easyelements_hamburger_icon',
            [
                'label' => esc_html__( 'Hamburger Icon (Optional)', 'easy-elements' ),
                'type' => Controls_Manager::ICONS,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'submenu_click_area',
            [
                'label'         => esc_html__('Submenu Click Area', 'easy-elements'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__('Icon', 'easy-elements'),
                'label_off'     => esc_html__('Text', 'easy-elements'),
                'return_value'  => 'icon',
                'default'       => 'icon',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'easyelements_menu_style_tab',
            [
                'label' => esc_html__('Menu Wrapper', 'easy-elements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'easyelements_menubar_height',
            [
                'label' => esc_html__( 'Menu Height', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 300,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => [ 'desktop' ],
                'desktop_default' => [
                    'size' => 80,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .easyelements-menu-container' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'easyelements_menu_wrap_h',
            [
                'label' => esc_html__( 'Menu wrapper background', 'easy-elements' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'easyelements_menubar_background',
                'label' => esc_html__( 'Menu Panel Background', 'easy-elements' ),
                'types' => [ 'classic', 'gradient' ],
                'devices' => [ 'desktop' ],
                'selector' => '{{WRAPPER}} .easyelements-menu-container',
            ]
        );

        $this->add_responsive_control(
            'wrapper_color_mobile',
            [
                'label'     => esc_html__( 'Mobile Wrapper Background', 'easy-elements' ),
                'type'      => Controls_Manager::COLOR,
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .easyelements-menu-container'   => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'easyelements_mobile_menu_panel_spacing',
            [
                'label' => esc_html__( 'Padding', 'easy-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'tablet_default' => [
                    'top' => '10',
                    'right' => '0',
                    'bottom' => '10',
                    'left' => '0',
                    'unit' => 'px',
                ],
                'devices' => ['desktop', 'tablet'],
                'selectors' => [
                    '{{WRAPPER}} .easyelements-nav-identity-panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'easyelements_mobile_menu_panel_width',
            [
                'label' => esc_html__( 'Width', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'range' => [
                    'px' => [
                        'min' => 350,
                        'max' => 700,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'tablet_default' => [
                    'size' => 350,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .easyelements-menu-container' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'easyelements_border_radius',
            [
                'label' => esc_html__( 'Menu border radius', 'easy-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'separator' => [ 'before' ],
                'desktop_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .easyelements-menu-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ele_menu_item_icon_spacing',
            [
                'label' => esc_html__( 'Menu Icon Spacing', 'easy-elements' ),
                'description' => esc_html__( 'This is only work with Mega menu icon option', 'easy-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .easyelements-navbar-nav li a .ele-menu-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'easyelements_style_tab_menuitem',
            [
                'label' => esc_html__('Menu item style', 'easy-elements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );



        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'easyelements_content_typography',
                'label' => esc_html__( 'Typography', 'easy-elements' ),
                'selector' => '{{WRAPPER}} .easyelements-navbar-nav > li > a',
            ]
        );



        $this->add_control(
            'easyelements_menu_item_h',
            [
                'label' => esc_html__( 'Menu Item Style', 'easy-elements' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->start_controls_tabs(
            'easyelements_nav_menu_tabs'
        );
        // Normal
        $this->start_controls_tab(
            'easyelements_nav_menu_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'easy-elements' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'easyelements_item_background',
                'label' => esc_html__( 'Item background', 'easy-elements' ),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .easyelements-navbar-nav > li > a',
            ]
        );

        $this->add_responsive_control(
            'easyelements_menu_text_color',
            [
                'label' => esc_html__( 'Item text color', 'easy-elements' ),
                'type' => Controls_Manager::COLOR,
                'desktop_default' => '#000000',
                'tablet_default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .easyelements-navbar-nav > li > a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'  => 'easyelements_menu_text_border',
                'selector'  => '{{WRAPPER}} .easyelements-navbar-nav > li > a',
                'size_units'  => ['px'],
            ]
        );

        $this->add_control(
            'easyelements_menu_text_border_radius',
            [
                'label'      => esc_html__('Border Radius (px)', 'easy-elements'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .easyelements-navbar-nav > li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover
        $this->start_controls_tab(
            'easyelements_nav_menu_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'easy-elements' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'easyelements_item_background_hover',
                'label' => esc_html__( 'Item background', 'easy-elements' ),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .easyelements-navbar-nav > li > a:hover, {{WRAPPER}} .easyelements-navbar-nav > li > a:focus, {{WRAPPER}} .easyelements-navbar-nav > li > a:active, {{WRAPPER}} .easyelements-navbar-nav > li:hover > a',
            ]
        );

        $this->add_responsive_control(
            'easyelements_item_color_hover',
            [
                'label' => esc_html__( 'Item text color', 'easy-elements' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#707070',
                'selectors' => [
                    '{{WRAPPER}} .easyelements-navbar-nav > li > a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .easyelements-navbar-nav > li > a:focus' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .easyelements-navbar-nav > li > a:active' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .easyelements-navbar-nav > li:hover > a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .easyelements-navbar-nav > li:hover > a .easyelements-submenu-indicator' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .easyelements-navbar-nav > li > a:hover .easyelements-submenu-indicator' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .easyelements-navbar-nav > li > a:focus .easyelements-submenu-indicator' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .easyelements-navbar-nav > li > a:active .easyelements-submenu-indicator' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'  => 'easyelements_menu_text_border_hover',
                'selector'  => '{{WRAPPER}} .easyelements-navbar-nav > li:hover > a',
                'size_units'  => ['px'],
            ]
        );

        $this->add_control(
            'easyelements_menu_text_border_radius_hover',
            [
                'label'      => esc_html__('Border Radius (px)', 'easy-elements'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .easyelements-navbar-nav > li:hover > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // active
        $this->start_controls_tab(
            'easyelements_nav_menu_active_tab',
            [
                'label' => esc_html__( 'Active', 'easy-elements' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'		=> 'easyelements_nav_menu_active_bg_color',
                'label' 	=> esc_html__( 'Item background', 'easy-elements' ),
                'types'		=> ['classic', 'gradient'],
                'selector'	=> '{{WRAPPER}} .easyelements-navbar-nav > li.current-menu-item > a,{{WRAPPER}} .easyelements-navbar-nav > li.current-menu-ancestor > a'
            ]
        );

        $this->add_responsive_control(
            'easyelements_nav_menu_active_text_color',
            [
                'label' => esc_html__( 'Item text color (Active)', 'easy-elements' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#707070',
                'selectors' => [
                    '{{WRAPPER}} .easyelements-navbar-nav > li.current-menu-item > a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .easyelements-navbar-nav > li.current-menu-ancestor > a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .easyelements-navbar-nav > li.current-menu-ancestor > a .easyelements-submenu-indicator' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'  => 'easyelements_menu_text_border_active',
                'selector'  => '{{WRAPPER}} .easyelements-navbar-nav > li.current-menu-item > a',
                'size_units'  => ['px'],
            ]
        );

        $this->add_control(
            'easyelements_menu_text_border_radius_active',
            [
                'label'      => esc_html__('Border Radius (px)', 'easy-elements'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .easyelements-navbar-nav > li.current-menu-item > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'easyelements_menu_item_spacing',
            [
                'label' => esc_html__( 'Item Spacing', 'easy-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => [ 'before' ],
                'desktop_default' => [
                    'top' => 0,
                    'right' => 15,
                    'bottom' => 0,
                    'left' => 15,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => 10,
                    'right' => 15,
                    'bottom' => 10,
                    'left' => 15,
                    'unit' => 'px',
                ],
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .easyelements-navbar-nav > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'easyelements_menu_item_margin',
            [
                'label' => esc_html__( 'Item Margin', 'easy-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .easyelements-navbar-nav > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'easyelements_style_tab_submenu_indicator',
            [
                'label' => esc_html__('Submenu indicator style', 'easy-elements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ele_submenu_indicator_font_size',
            [
                'label' => esc_html__( 'Font Size', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .easyelements-navbar-nav > li > a .easyelements-submenu-indicator' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .easyelements-navbar-nav > li > a .ele-submenu-indicator-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'easyelements_style_tab_submenu_indicator_color',
            [
                'label' => esc_html__( 'Indicator color', 'easy-elements' ),
                'type'  => Controls_Manager::COLOR,
                'default'   =>  '#101010',
                'alpha'     => false,
                'selectors' => [
                    '{{WRAPPER}} .easyelements-navbar-nav > li > a .easyelements-submenu-indicator' => 'color: {{VALUE}}; fill: {{VALUE}}',
                    '{{WRAPPER}} .easyelements-navbar-nav > li > a .ele-submenu-indicator-icon' => 'color: {{VALUE}}; fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'ele_submenu_indicator_spacing',
            [
                'label' => esc_html__( 'Indicator Margin (px)', 'easy-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .easyelements-navbar-nav-default .easyelements-dropdown-has>a .easyelements-submenu-indicator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .easyelements-navbar-nav-default .easyelements-dropdown-has>a .ele-submenu-indicator-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'easyelements_style_tab_submenu_item',
            [
                'label' => esc_html__('Submenu item style', 'easy-elements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'easyelements_menu_item_typography',
                'label' => esc_html__( 'Typography', 'easy-elements' ),
                'selector' => '{{WRAPPER}} .easyelements-navbar-nav .easyelements-submenu-panel > li > a',
            ]
        );

        $this->add_responsive_control(
            'easyelements_submenu_item_spacing',
            [
                'label' => esc_html__( 'Spacing', 'easy-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'devices' => ['desktop', 'tablet'],
                'desktop_default' => [
                    'top' => 15,
                    'right' => 15,
                    'bottom' => 15,
                    'left' => 15,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => 15,
                    'right' => 15,
                    'bottom' => 15,
                    'left' => 15,
                    'unit' => 'px',
                ],
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .easyelements-navbar-nav .easyelements-submenu-panel > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'easyelements_submenu_active_hover_tabs'
        );
        $this->start_controls_tab(
            'easyelements_submenu_normal_tab',
            [
                'label'	=> esc_html__('Normal', 'easy-elements')
            ]
        );

        $this->add_responsive_control(
            'easyelements_submenu_item_color',
            [
                'label' => esc_html__( 'Item text color', 'easy-elements' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .easyelements-navbar-nav .easyelements-submenu-panel > li > a' => 'color: {{VALUE}}',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'easyelements_menu_item_background',
                'label' => esc_html__( 'Item background', 'easy-elements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .easyelements-navbar-nav .easyelements-submenu-panel > li > a',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'easyelements_submenu_hover_tab',
            [
                'label'	=> esc_html__('Hover', 'easy-elements')
            ]
        );

        $this->add_responsive_control(
            'easyelements_item_text_color_hover',
            [
                'label' => esc_html__( 'Item text color (hover)', 'easy-elements' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#707070',
                'selectors' => [
                    '{{WRAPPER}} .easyelements-navbar-nav .easyelements-submenu-panel > li > a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .easyelements-navbar-nav .easyelements-submenu-panel > li > a:focus' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .easyelements-navbar-nav .easyelements-submenu-panel > li > a:active' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .easyelements-navbar-nav .easyelements-submenu-panel > li:hover > a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'easyelements_menu_item_background_hover',
                'label' => esc_html__( 'Item background (hover)', 'easy-elements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '
					{{WRAPPER}} .easyelements-navbar-nav .easyelements-submenu-panel > li > a:hover,
					{{WRAPPER}} .easyelements-navbar-nav .easyelements-submenu-panel > li > a:focus,
					{{WRAPPER}} .easyelements-navbar-nav .easyelements-submenu-panel > li > a:active,
					{{WRAPPER}} .easyelements-navbar-nav .easyelements-submenu-panel > li:hover > a',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'easyelements_submenu_active_tab',
            [
                'label'	=> esc_html__('Active', 'easy-elements')
            ]
        );

        $this->add_responsive_control(
            'easyelements_nav_sub_menu_active_text_color',
            [
                'label' => esc_html__( 'Item text color (Active)', 'easy-elements' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#707070',
                'selectors' => [
                    '{{WRAPPER}} .easyelements-navbar-nav .easyelements-submenu-panel > li.current-menu-item > a' => 'color: {{VALUE}} !important'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'		=> 'easyelements_nav_sub_menu_active_bg_color',
                'label' 	=> esc_html__( 'Item background (Active)', 'easy-elements' ),
                'types'		=> ['classic', 'gradient'],
                'selector'	=> '{{WRAPPER}} .easyelements-navbar-nav .easyelements-submenu-panel > li.current-menu-item > a',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'easyelements_menu_item_border_heading',
            [
                'label' => esc_html__( 'Sub Menu Items Border', 'easy-elements' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'easyelements_menu_item_border',
                'label' => esc_html__( 'Border', 'easy-elements' ),
                'selector' => '{{WRAPPER}} .easyelements-navbar-nav .easyelements-submenu-panel > li > a',
            ]
        );

        $this->add_control(
            'easyelements_menu_item_border_last_child_heading',
            [
                'label' => esc_html__( 'Border Last Child', 'easy-elements' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'easyelements_menu_item_border_last_child',
                'label' => esc_html__( 'Border last Child', 'easy-elements' ),
                'selector' => '{{WRAPPER}} .easyelements-navbar-nav .easyelements-submenu-panel > li:last-child > a',
            ]
        );

        $this->add_control(
            'easyelements_menu_item_border_first_child_heading',
            [
                'label' => esc_html__( 'Border First Child', 'easy-elements' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'easyelements_menu_item_border_first_child',
                'label' => esc_html__( 'Border First Child', 'easy-elements' ),
                'selector' => '{{WRAPPER}} .easyelements-navbar-nav .easyelements-submenu-panel > li:first-child > a',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'easyelements_style_tab_submenu_panel',
            [
                'label' => esc_html__('Submenu panel style', 'easy-elements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'sub_panel_padding',
            [
                'label'         => esc_html__('Padding', 'easy-elements'),
                'type'          => Controls_Manager::DIMENSIONS,
                'default'       => [
                    'top'       => '15',
                    'bottom'    => '15',
                    'left'      => '0',
                    'right'     => '0',
                    'isLinked'  => false,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .easyelements-submenu-panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'easyelements_panel_submenu_border',
                'label' => esc_html__( 'Panel Menu Border', 'easy-elements' ),
                'selector' => '{{WRAPPER}} .easyelements-navbar-nav .easyelements-submenu-panel',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'easyelements_submenu_container_background',
                'label' => esc_html__( 'Container background', 'easy-elements' ),
                'types' => [ 'classic','gradient' ],
                'selector' => '{{WRAPPER}} .easyelements-navbar-nav .easyelements-submenu-panel',
            ]
        );

        $this->add_responsive_control(
            'easyelements_submenu_panel_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'easy-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'desktop_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .easyelements-navbar-nav .easyelements-submenu-panel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'easyelements_submenu_container_width',
            [
                'label' => esc_html__( 'Conatiner width', 'easy-elements' ),
                'type' => Controls_Manager::TEXT,
                'devices' => [ 'desktop' ],
                'desktop_default' => '220px',
                'tablet_default' => '200px',
                'selectors' => [
                    '{{WRAPPER}} .easyelements-navbar-nav .easyelements-submenu-panel' => 'min-width: {{VALUE}};',
                ]
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'easyelements_panel_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'easy-elements' ),
                'selector' => '{{WRAPPER}} .easyelements-navbar-nav .easyelements-submenu-panel',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'easyelements_menu_toggle_style_tab',
            [
                'label' => esc_html__( 'Hamburger Style', 'easy-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'easyelements_menu_toggle_style_title',
            [
                'label' => esc_html__( 'Hamburger Toggle', 'easy-elements' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'easyelements_menu_toggle_icon_position',
            [
                'label' => esc_html__( 'Position', 'easy-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Top', 'easy-elements' ),
                        'icon' => 'fa fa-angle-left',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Middle', 'easy-elements' ),
                        'icon' => 'fa fa-angle-right',
                    ],
                ],
                'default' => 'right',
                'selectors' => [
                    '{{WRAPPER}} .easyelements-menu-hamburger' => 'float: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'easyelements_menu_toggle_spacing',
            [
                'label' => esc_html__( 'Padding', 'easy-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
                'devices' => ['desktop', 'tablet'],
                'tablet_default' => [
                    'top' => '8',
                    'right' => '8',
                    'bottom' => '8',
                    'left' => '8',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .easyelements-menu-hamburger' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'easyelements_menu_toggle_width',
            [
                'label' => esc_html__( 'Width', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 45,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'devices' => ['desktop', 'tablet'],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 45,
                ],
                'selectors' => [
                    '{{WRAPPER}} .easyelements-menu-hamburger' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'easyelements_menu_toggle_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => ['desktop', 'tablet'],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .easyelements-menu-hamburger' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'easyelements_menu_open_typography',
            [
                'label' => esc_html__( 'Icon Size', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 15,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .easyelements-menu-hamburger > .ele-menu-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'easyelements_hamburger_icon[value]!'    => '',
                ],
            ]
        );

        $this->start_controls_tabs(
            'easyelements_menu_toggle_normal_and_hover_tabs'
        );

        $this->start_controls_tab(
            'easyelements_menu_toggle_normal',
            [
                'label' => esc_html__( 'Normal', 'easy-elements' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'easyelements_menu_toggle_background',
                'label' => esc_html__( 'Background', 'easy-elements' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .easyelements-menu-hamburger',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'easyelements_menu_toggle_border',
                'label' => esc_html__( 'Border', 'easy-elements' ),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .easyelements-menu-hamburger',
            ]
        );

        $this->add_control(
            'easyelements_menu_toggle_icon_color',
            [
                'label' => esc_html__( 'Hamburger Icon Color', 'easy-elements' ),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, 0.5)',
                'selectors' => [
                    '{{WRAPPER}} .easyelements-menu-hamburger .easyelements-menu-hamburger-icon' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .easyelements-menu-hamburger > i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .easyelements-menu-hamburger > svg' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'easyelements_menu_toggle_hover',
            [
                'label' => esc_html__( 'Hover', 'easy-elements' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'easyelements_menu_toggle_background_hover',
                'label' => esc_html__( 'Background', 'easy-elements' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .easyelements-menu-hamburger:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'easyelements_menu_toggle_border_hover',
                'label' => esc_html__( 'Border', 'easy-elements' ),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .easyelements-menu-hamburger:hover',
            ]
        );

        $this->add_control(
            'easyelements_menu_toggle_icon_color_hover',
            [
                'label' => esc_html__( 'Hamburger Icon Color', 'easy-elements' ),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, 0.5)',
                'selectors' => [
                    '{{WRAPPER}} .easyelements-menu-hamburger:hover .easyelements-menu-hamburger-icon' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .easyelements-menu-hamburger:hover > .ele-menu-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_control(
            'easyelements_menu_close_style_title',
            [
                'label' => esc_html__( 'Close Toggle', 'easy-elements' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'easyelements_menu_close_typography',
                'label' => esc_html__( 'Typography', 'easy-elements' ),
                'selector' => '{{WRAPPER}} .easyelements-menu-close',
            ]
        );

        $this->add_responsive_control(
            'easyelements_menu_close_spacing',
            [
                'label' => esc_html__( 'Padding', 'easy-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
                'devices' => ['desktop', 'tablet'],
                'tablet_default' => [
                    'top' => '8',
                    'right' => '8',
                    'bottom' => '8',
                    'left' => '8',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .easyelements-menu-close' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'easyelements_menu_close_margin',
            [
                'label' => esc_html__( 'Margin', 'easy-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
                'devices' => ['desktop', 'tablet'],
                'tablet_default' => [
                    'top' => '12',
                    'right' => '12',
                    'bottom' => '12',
                    'left' => '12',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .easyelements-menu-close' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'easyelements_menu_close_width',
            [
                'label' => esc_html__( 'Width', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 45,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'devices' => ['desktop', 'tablet'],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 45,
                ],
                'selectors' => [
                    '{{WRAPPER}} .easyelements-menu-close' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'easyelements_menu_close_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => ['desktop', 'tablet'],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .easyelements-menu-close' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'easyelements_menu_close_normal_and_hover_tabs'
        );

        $this->start_controls_tab(
            'easyelements_menu_close_normal',
            [
                'label' => esc_html__( 'Normal', 'easy-elements' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'easyelements_menu_close_background',
                'label' => esc_html__( 'Background', 'easy-elements' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .easyelements-menu-close',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'easyelements_menu_close_border',
                'label' => esc_html__( 'Border', 'easy-elements' ),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .easyelements-menu-close',
            ]
        );

        $this->add_control(
            'easyelements_menu_close_icon_color',
            [
                'label' => esc_html__( 'Hamburger Icon Color', 'easy-elements' ),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(51, 51, 51, 1)',
                'selectors' => [
                    '{{WRAPPER}} .easyelements-menu-close' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'easyelements_menu_close_hover',
            [
                'label' => esc_html__( 'Hover', 'easy-elements' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'easyelements_menu_close_background_hover',
                'label' => esc_html__( 'Background', 'easy-elements' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .easyelements-menu-close:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'easyelements_menu_close_border_hover',
                'label' => esc_html__( 'Border', 'easy-elements' ),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .easyelements-menu-close:hover',
            ]
        );

        $this->add_control(
            'easyelements_menu_close_icon_color_hover',
            [
                'label' => esc_html__( 'Hamburger Icon Color', 'easy-elements' ),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, 0.5)',
                'selectors' => [
                    '{{WRAPPER}} .easyelements-menu-close:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'easyelements_mobile_menu_logo_style_tab',
            [
                'label' => esc_html__( 'Mobile Menu Logo', 'easy-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'easyelements_mobile_menu_logo_width',
            [
                'label' => esc_html__( 'Width', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 5,
                    ],
                ],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 160,
                ],
                'mobile_default' => [
                    'unit' => 'px',
                    'size' => 120,
                ],
                'selectors' => [
                    '{{WRAPPER}} .easyelements-nav-logo > img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'easyelements_mobile_menu_logo_height',
            [
                'label' => esc_html__( 'Height', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 60,
                ],
                'mobile_default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .easyelements-nav-logo > img' => 'max-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'easyelements_mobile_menu_logo_margin',
            [
                'label' => esc_html__( 'Margin', 'easy-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'tablet_default' => [
                    'top' => '5',
                    'right' => '0',
                    'bottom' => '5',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => 'false',
                ],
                'selectors' => [
                    '{{WRAPPER}} .easyelements-nav-logo' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'easyelements_mobile_menu_logo_padding',
            [
                'label' => esc_html__( 'Padding', 'easy-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'tablet_default' => [
                    'top' => '5',
                    'right' => '5',
                    'bottom' => '5',
                    'left' => '5',
                    'unit' => 'px',
                    'isLinked' => 'true',
                ],
                'selectors' => [
                    '{{WRAPPER}} .easyelements-nav-logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Return if menu not selected
        if (empty($settings['ele_control_nav_menu'])) {
            return;
        }

        $hamburger_icon_value = '';
        $hamburger_icon_type = '';

        // Determine the type and value of the hamburger icon
        if ($settings['easyelements_hamburger_icon'] != '' && $settings['easyelements_hamburger_icon']) {
            if ($settings['easyelements_hamburger_icon']['library'] !== 'svg') {
                $hamburger_icon_value = esc_attr($settings['easyelements_hamburger_icon']['value']);
                $hamburger_icon_type = esc_attr('icon');
            } else {
                $hamburger_icon_value = esc_url($settings['easyelements_hamburger_icon']['value']['url']);
                $hamburger_icon_type = esc_attr('url');
            }
        }

        // Set responsive menu breakpoint
        $menu_breakpoint_value = '';
        if ($settings['easyelements_responsive_breakpoint'] === 'ele_menu_responsive_tablet') {
            $menu_breakpoint_value = "1024";
        } else {
            $menu_breakpoint_value = "767";
        }

        // Render the main container with data attributes for the hamburger icon and responsive breakpoint
        echo '<div class="menu-widget-container ' . esc_attr($settings['easyelements_responsive_breakpoint']) . '" data-hamburger-icon="' . esc_attr($hamburger_icon_value) . '" data-hamburger-icon-type="' . esc_attr($hamburger_icon_type) . '" data-responsive-breakpoint="' . esc_attr($menu_breakpoint_value) . '">';
        $this->render_raw();
        echo '</div>';
    }

    protected function render_raw() {
        $settings = $this->get_settings_for_display();

        if ($settings['ele_control_nav_menu'] != '' && wp_get_nav_menu_items($settings['ele_control_nav_menu']) !== false && count(wp_get_nav_menu_items($settings['ele_control_nav_menu'])) > 0) {
            // Hamburger Toggler Button
            ?>
            <button class="easyelements-menu-hamburger easyelements-menu-toggler" type="button" aria-label="hamburger-icon">
                <?php
                // Show Default Icon if no custom icon is set
                if ($settings['easyelements_hamburger_icon']['value'] === '') {
                    ?>
                    <i class="ele ele-menu"></i>
                    <?php
                }

                // Show custom icon or SVG
                \Elementor\Icons_Manager::render_icon($settings['easyelements_hamburger_icon'], ['aria-hidden' => 'true', 'class' => 'ele-menu-icon']);
                ?>
            </button>
            <?php

            // Main Menu Container
            $logo_link = $link_target = $link_nofollow = '';

            // Set link for the logo
            if (isset($settings['easyelements_nav_menu_logo_link_to']) && $settings['easyelements_nav_menu_logo_link_to'] == 'home') {
                $logo_link = get_home_url();
            } elseif (isset($settings['easyelements_nav_menu_logo_link'])) {
                $logo_link = $settings['easyelements_nav_menu_logo_link']['url'];
                $link_target = ($settings['easyelements_nav_menu_logo_link']['is_external'] != "on" ? "" : "_blank");
                $link_nofollow = ($settings['easyelements_nav_menu_logo_link']['nofollow'] != "on" ? "" : "nofollow");
            }

            $identity_markup = '<div class="easyelements-nav-identity-panel">';

            // Conditionally display the site logo
            if (!empty($settings['easyelements_nav_menu_logo']['id'])) {
                $identity_markup .= '
            <div class="easyelements-site-title">
                <a class="easyelements-nav-logo" href="' . esc_url($logo_link) . '" target="' . (!empty($link_target) ? esc_attr($link_target) : '_self') . '" rel="' . esc_attr($link_nofollow) . '">
                    ' . ele_get_attachment_image_html($settings, 'easyelements_nav_menu_logo', 'full') . '
                </a> 
            </div>';
            }
            $identity_markup .= '<button class="easyelements-menu-close easyelements-menu-toggler" type="button">X</button></div>';

            $menu_container_classes = [
                'easyelements-menu-container easyelements-menu-offcanvas-elements easyelements-navbar-nav-default',
                'ele-nav-menu-one-page-' . $settings['easyelements_one_page_enable'],
                !empty($settings['easyelements_nav_dropdown_as']) ? $settings['easyelements_nav_dropdown_as'] : 'ele-nav-dropdown-hover',
            ];

            $menu_arguments = [
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>' . $identity_markup,
                'container'       => 'div',
                'container_id'    => 'ele-megamenu-' . $settings['ele_control_nav_menu'],
                'container_class' => join(' ', $menu_container_classes),
                'menu'            => $settings['ele_control_nav_menu'],
                'menu_class'      => 'easyelements-navbar-nav ' . $settings['easyelements_main_menu_position'] . ' submenu-click-on-' . $settings['submenu_click_area'],
                'depth'           => 4,
                'echo'            => true,
                'fallback_cb'     => 'wp_page_menu',
                'walker'          => (class_exists('\EasyElements\Modules\Mega_Menu\Nav_Menu_Walker') ? new \EasyElements\Modules\Mega_Menu\Nav_Menu_Walker() : '')
            ];

            // Set submenu indicator icon
            $menu_arguments['submenu_indicator_icon'] = $this->get_submenu_indicator_icon($settings);

            // Fixed for WP 6.1 submenu issue
            if (version_compare(get_bloginfo('version'), '6.1', '>=')) {
                unset($menu_arguments['depth']);
            }

            wp_nav_menu($menu_arguments);
            ?>
            <div class="easyelements-menu-overlay easyelements-menu-offcanvas-elements easyelements-menu-toggler ele-nav-menu--overlay"></div><?php

            if (Plugin::$instance->editor->is_edit_mode()) { ?>
                <span class="ele-nav-menu--empty-fallback">&nbsp;</span>
            <?php }
        }
    }
    public function get_navigation_menus() {
        $menu_list = [];
        $available_menus = wp_get_nav_menus();

        foreach ($available_menus as $menu) {
            $menu_list[$menu->slug] = $menu->name;
        }

        return $menu_list;
    }
    protected function get_submenu_indicator_icon($settings) {
        extract($settings);

        $icon_html = '';
        $submenu_indicator_class = 'easyelements-submenu-indicator';

        if(!empty($easyelements_submenu_indicator_icon['value'])) {
            return Icons_Manager::try_get_icon_html($settings['submenu_indicator_icon'], ['class' => $submenu_indicator_class , 'aria-hidden' => 'true']);
        }

        return $icon_html;
    }
}