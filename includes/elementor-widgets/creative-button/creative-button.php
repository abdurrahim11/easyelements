<?php

namespace EasyElements\Elementor_Widgets\Creative_Button;

use EasyElements\Traits\Creative_Button_Markup;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;


class Creative_Button extends Widget_Base {
   use Creative_Button_Markup;
    public function get_name() {
        return 'ele-creative-button';
    }

    public function get_title() {
        return __( 'Creative Button', 'easy-elements' );
    }

    public function get_icon() {
        return 'ele ele-creative-button ele-widget-icon';
    }

    public function get_categories() {
        return array( 'easy-elements' );
    }

    public function get_keywords() {
        return array( 'button', 'btn', 'advance', 'link', 'creative', 'creative-utton'  );
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            '_section_button',
            [
                'label' => __( 'Creative Button', 'easy-elements' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'btn_style',
            [
                'label'   => __( 'Style', 'easy-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'hermosa',
                'options' => [
                    'hermosa'  => __( 'Hermosa', 'easy-elements' ),
                    'montino'  => __( 'Montino', 'easy-elements' ),
                    'iconica'  => __( 'Iconica', 'easy-elements' ),
                    'symbolab' => __( 'Symbolab', 'easy-elements' ),
                    'estilo'   => __( 'Estilo', 'easy-elements' ),
                ],
            ]
        );

        $this->add_control(
            'estilo_effect',
            [
                'label'     => __( 'Effects', 'easy-elements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'dissolve',
                'options'   => [
                    'dissolve'     => __( 'Dissolve', 'easy-elements' ),
                    'slide-down'   => __( 'Slide In Down', 'easy-elements' ),
                    'slide-right'  => __( 'Slide In Right', 'easy-elements' ),
                    'slide-x'      => __( 'Slide Out X', 'easy-elements' ),
                    'cross-slider' => __( 'Cross Slider', 'easy-elements' ),
                    'slide-y'      => __( 'Slide Out Y', 'easy-elements' ),
                ],
                'condition' => [
                    'btn_style' => 'estilo',
                ],
            ]
        );

        $this->add_control(
            'symbolab_effect',
            [
                'label'     => __( 'Effects', 'easy-elements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'back-in-right',
                'options'   => [
                    'back-in-right'  => __( 'Back In Right', 'easy-elements' ),
                    'back-in-left'   => __( 'Back In Left', 'easy-elements' ),
                    'back-out-right' => __( 'Back Out Right', 'easy-elements' ),
                    'back-out-left'  => __( 'Back Out Left', 'easy-elements' ),
                ],
                'condition' => [
                    'btn_style' => 'symbolab',
                ],
            ]
        );

        $this->add_control(
            'iconica_effect',
            [
                'label'     => __( 'Effects', 'easy-elements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'slide-in-down',
                'options'   => [
                    'slide-in-down'  => __( 'Slide In Down', 'easy-elements' ),
                    'slide-in-top'   => __( 'Slide In Top', 'easy-elements' ),
                    'slide-in-right' => __( 'Slide In Right', 'easy-elements' ),
                    'slide-in-left'  => __( 'Slide In Left', 'easy-elements' ),
                ],
                'condition' => [
                    'btn_style' => 'iconica',
                ],
            ]
        );

        $this->add_control(
            'montino_effect',
            [
                'label'     => __( 'Effects', 'easy-elements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'winona',
                'options'   => [
                    'winona'  => __( 'Winona', 'easy-elements' ),
                    'rayen'   => __( 'Rayen', 'easy-elements' ),
                    'aylen'   => __( 'Aylen', 'easy-elements' ),
                    'wapasha' => __( 'Wapasha', 'easy-elements' ),
                    'nina'    => __( 'Nina', 'easy-elements' ),
                    'antiman' => __( 'Antiman', 'easy-elements' ),
                    'sacnite' => __( 'Sacnite', 'easy-elements' ),
                ],
                'condition' => [
                    'btn_style' => 'montino',
                ],
            ]
        );

        $this->add_control(
            'hermosa_effect',
            [
                'label'     => __( 'Effects', 'easy-elements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'exploit',
                'options'   => [
                    'exploit'    => __( 'Exploit', 'easy-elements' ),
                    'upward'     => __( 'Upward', 'easy-elements' ),
                    'newbie'     => __( 'Newbie', 'easy-elements' ),
                    'render'     => __( 'Render', 'easy-elements' ),
                    'reshape'    => __( 'Reshape', 'easy-elements' ),
                    'expandable' => __( 'Expandable', 'easy-elements' ),
                    'downhill'   => __( 'Downhill', 'easy-elements' ),
                    'bloom'      => __( 'Bloom', 'easy-elements' ),
                    'roundup'    => __( 'Roundup', 'easy-elements' ),
                ],
                'condition' => [
                    'btn_style' => 'hermosa',
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'       => __( 'Text', 'easy-elements' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'default'     => 'Button Text',
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'button_link',
            array(
                'label'         => __( 'Link', 'easy-elements' ),
                'type'          => Controls_Manager::URL,
                'placeholder'   => __( 'https://your-link.com', 'easy-elements' ),
                'show_external' => true,
                'default'       => array(
                    'url'         => '#',
                    'is_external' => false,
                    'nofollow'    => true,
                ),
                'dynamic'       => [
                    'active' => true,
                ],
            )
        );

        $this->add_control(
            'icon',
            [
                'label'                  => __( 'Icon', 'easy-elements' ),
                'description'            => __( 'Please set an icon for the button.', 'easy-elements' ),
                'label_block'            => false,
                'type'                   => Controls_Manager::ICONS,
                'skin'                   => 'inline',
                'exclude_inline_options' => [ 'svg' ],
                'default'                => [
                    'value'   => 'fas fa-rocket',
                    'library' => 'fa-solid',
                ],
                'conditions'             => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'relation' => 'or',
                            'terms'    => [
                                [
                                    'name'     => 'btn_style',
                                    'operator' => '==',
                                    'value'    => 'symbolab',
                                ],
                                [
                                    'name'     => 'btn_style',
                                    'operator' => '==',
                                    'value'    => 'iconica',
                                ],
                            ],
                        ],
                        [
                            'relation' => 'and',
                            'terms'    => [
                                [
                                    'name'     => 'btn_style',
                                    'operator' => '==',
                                    'value'    => 'hermosa',
                                ],
                                [
                                    'name'     => 'hermosa_effect',
                                    'operator' => '==',
                                    'value'    => 'expandable',
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'align_x',
            [
                'label'       => __( 'Alignment', 'easy-elements' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'left'   => [
                        'title' => __( 'Left', 'easy-elements' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'easy-elements' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'easy-elements' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'toggle'      => true,
                'selectors'   => [
                    '{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}};',
                    // '{{WRAPPER}} .ele-creative-btn-wrap' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'magnetic_enable',
            [
                'label'        => __( 'Magnetic Effect', 'easy-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_block'  => false,
                'return_value' => 'yes',
                'separator'    => 'before',
            ]
        );

        $this->add_control(
            'threshold',
            [
                'label'     => __( 'Threshold', 'easy-elements' ),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 0,
                'max'       => 100,
                'step'      => 1,
                'default'   => 30,
                'condition' => [
                    'magnetic_enable' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ele-creative-btn' => 'margin: {{VALUE}}px;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->style_controls_tab();
    }

    protected function style_controls_tab() {

        $this->start_controls_section(
            '_estilo_symbolab_iconica_style_section',
            [
                'label' => __( 'Common', 'easy-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_item_width',
            [
                'label'      => __( 'Size', 'easy-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .ele-creative-btn.ele-eft--downhill' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ele-creative-btn.ele-eft--roundup' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ele-creative-btn.ele-eft--roundup .progress' => 'width: calc({{SIZE}}{{UNIT}} - (({{SIZE}}{{UNIT}} / 100) * 20) ); height:auto;',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'relation' => 'or',
                            'terms'    => [
                                [
                                    'name'     => 'hermosa_effect',
                                    'operator' => '==',
                                    'value'    => 'roundup',
                                ],
                                [
                                    'name'     => 'hermosa_effect',
                                    'operator' => '==',
                                    'value'    => 'downhill',
                                ],
                            ],
                        ],
                        [
                            'terms' => [
                                [
                                    'name'     => 'btn_style',
                                    'operator' => '==',
                                    'value'    => 'hermosa',
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'button_icon_size',
            [
                'label'      => __( 'Icon Size', 'easy-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .ele-creative-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'relation' => 'or',
                            'terms'    => [
                                [
                                    'name'     => 'btn_style',
                                    'operator' => '==',
                                    'value'    => 'symbolab',
                                ],
                                [
                                    'name'     => 'btn_style',
                                    'operator' => '==',
                                    'value'    => 'iconica',
                                ],
                            ],
                        ],
                        [
                            'relation' => 'and',
                            'terms'    => [
                                [
                                    'name'     => 'btn_style',
                                    'operator' => '==',
                                    'value'    => 'hermosa',
                                ],
                                [
                                    'name'     => 'hermosa_effect',
                                    'operator' => '==',
                                    'value'    => 'expandable',
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'label'    => __( 'Typography', 'easy-elements' ),
                'selector' => '{{WRAPPER}} .ele-creative-btn',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_ACCENT,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'       => 'button_border',
                'exclude'    => ['color'], //remove border color
                'selector'   => '{{WRAPPER}} .ele-creative-btn, {{WRAPPER}} .ele-creative-btn.ele-eft--bloom div',
                'conditions' => [
                    'terms' => [
                        [
                            'relation' => 'or',
                            'terms'    => [
                                [
                                    'name'     => 'hermosa_effect',
                                    'operator' => '!=',
                                    'value'    => 'roundup',
                                ],
                            ],
                        ],
                        [
                            'terms' => [
                                [
                                    'name'     => 'btn_style',
                                    'operator' => '!=',
                                    'value'    => '',
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label'      => __( 'Border Radius', 'easy-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ele-creative-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ele-creative-btn.ele-stl--hermosa.ele-eft--bloom div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_hermosa_roundup_stroke_width',
            [
                'label'      => __( 'Stroke Width', 'easy-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .ele-creative-btn.ele-eft--roundup' => '--ele-ctv-btn-stroke-width: {{SIZE}}{{UNIT}};',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'relation' => 'or',
                            'terms'    => [
                                [
                                    'name'     => 'hermosa_effect',
                                    'operator' => '==',
                                    'value'    => 'roundup',
                                ],
                            ],
                        ],
                        [
                            'terms' => [
                                [
                                    'name'     => 'btn_style',
                                    'operator' => '==',
                                    'value'    => 'hermosa',
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->__btn_tab_style_controls();

        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => __( 'Padding', 'easy-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .ele-creative-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    '{{WRAPPER}} .ele-creative-btn.ele-stl--iconica > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    '{{WRAPPER}} .ele-creative-btn.ele-stl--montino.ele-eft--winona > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ele-creative-btn.ele-stl--montino.ele-eft--winona::after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    '{{WRAPPER}} .ele-creative-btn.ele-stl--montino.ele-eft--rayen > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ele-creative-btn.ele-stl--montino.ele-eft--rayen::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    '{{WRAPPER}} .ele-creative-btn.ele-stl--montino.ele-eft--nina' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ele-creative-btn.ele-stl--montino.ele-eft--nina::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    '{{WRAPPER}} .ele-creative-btn.ele-stl--hermosa.ele-eft--bloom span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );

        $this->end_controls_section();
    }

    protected function __btn_tab_style_controls() {

        $conditions = [
            'terms' => [
                [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'     => 'hermosa_effect',
                            'operator' => '!=',
                            'value'    => 'roundup',
                        ],
                        // [
                        // 	'name' => 'hermosa_effect',
                        // 	'operator' => '!=',
                        // 	'value' => 'downhill',
                        // ],
                    ],
                ],
                [
                    'terms' => [
                        [
                            'name'     => 'btn_style',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                    ],
                ],
            ],
        ];

        $this->start_controls_tabs( '_tabs_button' );
        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => __( 'Normal', 'easy-elements' ),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label'     => __( 'Text Color', 'easy-elements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ele-creative-btn-wrap .ele-creative-btn' => '--ele-ctv-btn-txt-clr: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label'      => __( 'Background Color', 'easy-elements' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .ele-creative-btn-wrap .ele-creative-btn' => '--ele-ctv-btn-bg-clr: {{VALUE}}',
                ],
                'conditions' => $conditions,
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label'      => __( 'Border Color', 'easy-elements' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .ele-creative-btn-wrap .ele-creative-btn' => '--ele-ctv-btn-border-clr: {{VALUE}}',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'relation' => 'or',
                            'terms'    => [
                                [
                                    'name'     => 'hermosa_effect',
                                    'operator' => '!=',
                                    'value'    => 'roundup',
                                ],
                            ],
                        ],
                        [
                            'terms' => [
                                [
                                    'name'     => 'btn_style',
                                    'operator' => '!=',
                                    'value'    => '',
                                ],
                                [
                                    'name'     => 'button_border_border',
                                    'operator' => '!=',
                                    'value'    => '',
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'button_roundup_circle_color',
            [
                'label'      => __( 'Circle Color', 'easy-elements' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .ele-creative-btn-wrap .ele-creative-btn.ele-eft--roundup' => '--ele-ctv-btn-border-clr: {{VALUE}}',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'relation' => 'or',
                            'terms'    => [
                                [
                                    'name'     => 'hermosa_effect',
                                    'operator' => '==',
                                    'value'    => 'roundup',
                                ],
                            ],
                        ],
                        [
                            'terms' => [
                                [
                                    'name'     => 'btn_style',
                                    'operator' => '==',
                                    'value'    => 'hermosa',
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .ele-creative-btn',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tabs_button_hover',
            [
                'label' => __( 'Hover', 'easy-elements' ),
            ]
        );

        $this->add_control(
            'button_hover_text_color',
            [
                'label'     => __( 'Text Color', 'easy-elements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ele-creative-btn-wrap .ele-creative-btn' => '--ele-ctv-btn-txt-hvr-clr: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label'      => __( 'Background Color', 'easy-elements' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .ele-creative-btn-wrap .ele-creative-btn' => '--ele-ctv-btn-bg-hvr-clr: {{VALUE}}',
                ],
                'conditions' => $conditions,
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label'      => __( 'Border Color', 'easy-elements' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .ele-creative-btn-wrap .ele-creative-btn' => '--ele-ctv-btn-border-hvr-clr: {{VALUE}}',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'relation' => 'or',
                            'terms'    => [
                                [
                                    'name'     => 'hermosa_effect',
                                    'operator' => '!=',
                                    'value'    => 'roundup',
                                ],
                            ],
                        ],
                        [
                            'terms' => [
                                [
                                    'name'     => 'btn_style',
                                    'operator' => '!=',
                                    'value'    => '',
                                ],
                                [
                                    'name'     => 'button_border_border',
                                    'operator' => '!=',
                                    'value'    => '',
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'button_hover_roundup_circle_color',
            [
                'label'      => __( 'Circle Color', 'easy-elements' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .ele-creative-btn-wrap .ele-creative-btn.ele-eft--roundup' => '--ele-ctv-btn-border-hvr-clr: {{VALUE}}',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'relation' => 'or',
                            'terms'    => [
                                [
                                    'name'     => 'hermosa_effect',
                                    'operator' => '==',
                                    'value'    => 'roundup',
                                ],
                            ],
                        ],
                        [
                            'terms' => [
                                [
                                    'name'     => 'btn_style',
                                    'operator' => '==',
                                    'value'    => 'hermosa',
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .ele-creative-btn:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'wrap', 'data-magnetic', $settings['magnetic_enable'] ? $settings['magnetic_enable'] : 'no' );
        $this->{'render_' . $settings['btn_style'] . '_markup'}( $settings );
    }



}