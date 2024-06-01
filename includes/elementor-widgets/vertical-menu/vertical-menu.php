<?php

namespace EasyElements\Elementor_Widgets\Vertical_Menu;



use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

class Vertical_Menu extends Widget_Base {
    public $base;

    public function get_name() {
        return 'ele-vertical-menu';
    }

    public function get_title() {
        return esc_html__( 'Vertical menu', 'easy-elements' );
    }

    public function get_icon() {
        return 'eicon-navigation-vertical ele-widget-icon';
    }

    public function get_categories() {
        return [ 'easy-elements' ];
    }

    public function get_keywords() {
        return ['ele', 'menu', 'nav-menu', 'nav', 'navigation', 'navigation-menu', 'mega', 'megamenu', 'mega-menu', 'header-menu', 'footer-menu', 'sidebar-menu', 'primary-menu', 'secondary-menu', 'mobile-menu', 'dropdown-menu', 'horizontal-menu', 'vertical-menu', 'responsive-menu', 'custom-menu', 'menu-bar', 'site-menu', 'main-menu', 'top-menu', 'sub-menu', 'side-menu'];
    }

    public function get_help_url() {
        return 'https://wpmet.com/doc/vertical-mega-menu/';
    }

    public function get_menus(){
        $list = [];
        $menus = wp_get_nav_menus();
        foreach($menus as $menu){
            $list[$menu->slug] = $menu->name;
        }

        return $list;
    }

    protected function register_controls() {

        $this->start_controls_section(
            'easyelements_vertical_menu_content_tab',
            [
                'label' => esc_html__('Vertical Menu', 'easy-elements'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'easyelements_nav_menu',
            [
                'label'     =>  esc_html__( 'Select Menu', 'easy-elements' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $this->get_menus(),
            ]
        );

        $this->add_control(
            'easyelements_vertical_menu_badge_position',
            [
                'label' => esc_html__( 'Badge Position', 'easy-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Right', 'easy-elements' ),
                'label_off' => esc_html__( 'Left', 'easy-elements' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'divider_1',
            ['type' => Controls_Manager::DIVIDER]
        );

        $this->add_control(
            'easyelements_vertical_menu_show_toggle',
            [
                'label' => esc_html__( 'Toggle', 'easy-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'easy-elements' ),
                'label_off' => esc_html__( 'Hide', 'easy-elements' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'easyelements_vertical_menu_show_active_or_not',
            [
                'label' => esc_html__( 'Show Toggle Menu on all pages', 'easy-elements' ),
                'type'  => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'Show', 'easy-elements' ),
                'label_off' => esc_html__( 'Hide', 'easy-elements' ),
                'return_value' => 'yes',
                'condition' => [
                    'easyelements_vertical_menu_show_toggle' => 'yes'
                ]
            ]
        );


        $this->add_control(
            'easyelements_vertical_menu_is_toggle_for_frontpage',
            [
                'label' => esc_html__( 'Show Toggle only on home', 'easy-elements' ),
                'type'  => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'Show', 'easy-elements' ),
                'label_off' => esc_html__( 'Hide', 'easy-elements' ),
                'description' => esc_html__('This option allows you to show this menu only for home page', 'easy-elements'),
                'condition' => [
                    'easyelements_vertical_menu_show_active_or_not' => ''
                ],

            ]
        );

        $this->add_control(
            'toggler_hover',
            [
                'label'     => esc_html__( 'Enable Hover', 'easy-elements' ),
                'type'      => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .ele-vertical-main-menu-on-click:hover > .ele-vertical-menu-container' => 'opacity: 1; visibility: visible;',
                ],
                'condition' => [
                    'easyelements_vertical_menu_show_toggle' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'divider_2',
            ['type' => Controls_Manager::DIVIDER]
        );

        $this->add_control(
            'easyelements_vertical_menu_toggle_title',
            [
                'label' => esc_html__( 'Title', 'easy-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'All Categories', 'easy-elements' ),
                'placeholder' => esc_html__( 'Type your title here', 'easy-elements' ),
                'condition' => [
                    'easyelements_vertical_menu_show_toggle' => 'yes'
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->start_controls_tabs(
            'easyelements_vertical_nav_menu_tabs',
            [
                'condition' => [
                    'easyelements_vertical_menu_show_toggle' => 'yes'
                ]
            ]
        );
        // right icon
        $this->start_controls_tab(
            'easyelements_vertical_nav_menu_right_icon_tab',
            [
                'label' => esc_html__( 'Icon Left', 'easy-elements' ),
            ]
        );

        $this->add_control(
            'easyelements_vertical_menu_toggle_title_icon_right',
            [
                'label' => __( 'Menu Icon Left', 'easy-elements' ),
                'type' => Controls_Manager::ICONS,
            ]
        );

        $this->end_controls_tab();

        // left icon
        $this->start_controls_tab(
            'easyelements_vertical_nav_menu_left_icon_tab',
            [
                'label' => esc_html__( 'Icon Right', 'easy-elements' ),
            ]
        );

        $this->add_control(
            'easyelements_vertical_menu_toggle_title_icon_left',
            [
                'label' => __( 'Menu Icon Right', 'easy-elements' ),
                'type' => Controls_Manager::ICONS,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

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

        // Toggle Button Style
        $this->start_controls_section(
            'easyelements_vertical_menu_toggle_style_tab',
            [
                'label' => __( 'Toggle Button', 'easy-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'easyelements_vertical_menu_show_toggle' => 'yes'
                ]
            ]
        );

        $this->start_controls_tabs(
            'easyelements_vertical_menu_toggle_style_control_tabs'
        );
        // Normal
        $this->start_controls_tab(
            'easyelements_vertical_menu_toggle_style_noraml_tab',
            [
                'label' => esc_html__( 'Normal', 'easy-elements' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ele_vertical_menu_toggle_content_typography',
                'label' => __( 'Typography', 'easy-elements' ),
                'selector' => '{{WRAPPER}} .ele-vertical-menu-tigger',
            ]
        );

        $this->add_control(
            'ele_vertical_menu_toggle_title_color',
            [
                'label' => __( 'Color', 'easy-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ele-vertical-menu-tigger' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ele_vertical_menu_toggle_background',
                'label' => __( 'Background', 'easy-elements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .ele-vertical-menu-tigger',
            ]
        );

        $this->add_control(
            'ele_vertical_menu_toggle_padding',
            [
                'label' => __( 'Padding', 'easy-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ele-vertical-menu-tigger' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ele_vertical_menu_toggle_border_radius',
            [
                'label' => __( 'Border Radius', 'easy-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ele-vertical-menu-tigger' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Active
        $this->start_controls_tab(
            'easyelements_vertical_menu_toggle_style_active_tab',
            [
                'label' => esc_html__( 'Active', 'easy-elements' ),
            ]
        );

        $this->add_control(
            'ele_vertical_menu_toggle_title_color_active',
            [
                'label' => __( 'Color', 'easy-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .vertical-menu-active .ele-vertical-menu-tigger' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ele_vertical_menu_toggle_background_active',
                'label' => __( 'Background', 'easy-elements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .vertical-menu-active .ele-vertical-menu-tigger',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Main menu
        $this->start_controls_section(
            'ele_vertical_menu_container_style_tab',
            [
                'label' => __( 'Main Menu', 'easy-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ele_vertical_menu_container_background',
                'label' => __( 'Background', 'easy-elements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .ele-vertical-navbar-nav',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ele_vertical_menu_container_box_shadow',
                'label' => __( 'Box Shadow', 'easy-elements' ),
                'selector' => '{{WRAPPER}} .ele-vertical-navbar-nav',
            ]
        );

        $this->add_control(
            'ele_vertical_menu_container_border_radius',
            [
                'label' => __( 'Border Radius', 'easy-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ele-vertical-navbar-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Menu items
        $this->start_controls_section(
            'ele_vertical_menu_items_style_tab',
            [
                'label' => __( 'Menu Items', 'easy-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'easyelements_vertical_menu_items_style_control_tabs'
        );
        // Normal
        $this->start_controls_tab(
            'easyelements_vertical_menu_items_style_noraml_tab',
            [
                'label' => esc_html__( 'Normal', 'easy-elements' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ele_vertical_menu_items_content_typography',
                'label' => __( 'Typography', 'easy-elements' ),
                'selector' => '{{WRAPPER}} .ele-vertical-navbar-nav>li>a',
            ]
        );

        $this->add_control(
            'ele_vertical_menu_items_title_color',
            [
                'label' => __( 'Color', 'easy-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ele-vertical-navbar-nav>li>a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'ele_vertical_menu_items_padding',
            [
                'label' => __( 'Padding', 'easy-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ele-vertical-navbar-nav>li>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ele_vertical_menu_items_icon_padding',
            [
                'label' => __( 'Icon Spacing', 'easy-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ele-vertical-navbar-nav>li>a .ele-menu-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ele_vertical_menu_items_border',
                'label' => __( 'Border', 'easy-elements' ),
                'selector' => '{{WRAPPER}} .ele-vertical-navbar-nav>li',
            ]
        );

        $this->end_controls_tab();

        // Hover
        $this->start_controls_tab(
            'easyelements_vertical_menu_items_style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'easy-elements' ),
            ]
        );

        $this->add_control(
            'ele_vertical_menu_items_title_color_active',
            [
                'label' => __( 'Color', 'easy-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ele-vertical-navbar-nav>li>a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .ele-vertical-navbar-nav>li:hover>a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Sub Menu items
        $this->start_controls_section(
            'ele_vertical_sub_menu_items_style_tab',
            [
                'label' => __( 'Sub Menu Items', 'easy-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'easyelements_vertical_sub_menu_items_style_control_tabs'
        );
        // Normal
        $this->start_controls_tab(
            'easyelements_vertical_sub_menu_items_style_noraml_tab',
            [
                'label' => esc_html__( 'Normal', 'easy-elements' ),
            ]
        );

        $this->add_responsive_control(
            'ele_vertical_sub_menu_container_width',
            [
                'label' => esc_html__( 'Width', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 220,
                        'max' => 700,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ele-vertical-navbar-nav .easyelements-dropdown' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ele_vertical_sub_menu_items_content_typography',
                'label' => __( 'Typography', 'easy-elements' ),
                'selector' => '{{WRAPPER}} .ele-vertical-navbar-nav .easyelements-dropdown>li>a',
            ]
        );

        $this->add_control(
            'ele_vertical_sub_menu_items_title_color',
            [
                'label' => __( 'Color', 'easy-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ele-vertical-navbar-nav .easyelements-dropdown>li>a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'ele_vertical_sub_menu_items_padding',
            [
                'label' => __( 'Padding', 'easy-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ele-vertical-navbar-nav .easyelements-dropdown>li>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ele_vertical_sub_menu_items_border',
                'label' => __( 'Border', 'easy-elements' ),
                'selector' => '{{WRAPPER}} .ele-vertical-navbar-nav .easyelements-dropdown>li',
            ]
        );

        $this->end_controls_tab();

        // Hover
        $this->start_controls_tab(
            'easyelements_vertical_sub_menu_items_style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'easy-elements' ),
            ]
        );

        $this->add_control(
            'ele_vertical_sub_menu_items_title_color_active',
            [
                'label' => __( 'Color', 'easy-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ele-vertical-navbar-nav .easyelements-dropdown>li>a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .ele-vertical-navbar-nav .easyelements-dropdown>li:hover>a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render( ) {
        $settings = $this->get_settings_for_display();
        echo '<div class="ele-wid-con">';
        $this->render_raw();
        echo '</div>';
    }

    protected function vertical_menu_icon($props, $classname) {
        if ($props && $props['value'] !== '') {
            if ($props['library'] !== 'svg') { ?>
                <i class="<?php echo esc_attr($props['value'] .' '. $classname); ?> vertical-menu-icon"></i>
            <?php } else { ?>
                <img class="<?php echo esc_attr($classname); ?> vertical-menu-icon" src="<?php echo esc_url($props['value']['url']); ?>" alt="vertical menu icon">
            <?php }
        }
    }

    protected function render_raw( ) {
        $settings = $this->get_settings_for_display();
        extract($settings);

        if ($easyelements_nav_menu !== '') {
            $active_vertical_menu_toggle = $easyelements_vertical_menu_show_active_or_not == 'yes' ? 'vertical-menu-active' : '';

            if( $easyelements_vertical_menu_is_toggle_for_frontpage === 'yes' && is_front_page()  ) {
                $active_vertical_menu_toggle = 'vertical-menu-active';
            }

            ?>
            <div
                class="ele-vertical-main-menu-wraper <?php echo esc_attr($easyelements_vertical_menu_show_toggle == 'yes' ? 'ele-vertical-main-menu-on-click' : '') ?> <?php echo esc_attr( $active_vertical_menu_toggle ) ?> <?php echo esc_attr($easyelements_vertical_menu_badge_position == 'yes' ? 'badge-position-right' : 'badge-position-left') ?>"
            >
                <?php if ($easyelements_vertical_menu_show_toggle == 'yes') { ?>
                    <a href="#" class="ele-vertical-menu-tigger">
                        <?php $this->vertical_menu_icon($easyelements_vertical_menu_toggle_title_icon_right, 'vertical-menu-right-icon'); ?>
                        <?php if ($easyelements_vertical_menu_toggle_title !== '') { ?>
                            <span class="ele-vertical-menu-tigger-title"><?php echo esc_html($easyelements_vertical_menu_toggle_title);?></span>
                        <?php }; ?>
                        <?php $this->vertical_menu_icon($easyelements_vertical_menu_toggle_title_icon_left, 'vertical-menu-left-icon'); ?>
                    </a>
                <?php }; ?>
                <?php
                if($settings['easyelements_nav_menu'] != '' && wp_get_nav_menu_items($settings['easyelements_nav_menu']) !== false && count(wp_get_nav_menu_items($settings['easyelements_nav_menu'])) > 0){
                    $args = [
                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'container'       => 'div',
                        'container_class' => 'ele-vertical-menu-container',
                        'menu'         	  => $settings['easyelements_nav_menu'],
                        'menu_class'      => 'ele-vertical-navbar-nav submenu-click-on-' . $settings['submenu_click_area'],
                        'depth'           => 4,
                        'echo'            => true,
                        'fallback_cb'     => 'wp_page_menu',
                        'walker'          => (class_exists('\EasyElements\Modules\Mega_Menu\Nav_Menu_Walker') ? new \EasyElements\Modules\Mega_Menu\Nav_Menu_Walker() : '' )
                    ];

                    wp_nav_menu($args);
                }
                ?>
            </div>
            <?php
        } else { ?>
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    <?php echo esc_html__('Please Select Menu', 'easy-elements'); ?>
                </div>
            </div>
        <?php }
    }
}