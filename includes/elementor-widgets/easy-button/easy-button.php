<?php

namespace EasyElements\Elementor_Widgets\Easy_Button;

use EasyElements\Traits\Easy_Button_Helper;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;

class Easy_Button extends Widget_Base {
   use Easy_Button_Helper;
    public function get_name() {
        return 'ele-easy-button';
    }

    public function get_title() {
        return esc_html__( 'Easy Button', 'easyelements' );
    }

    public function get_icon() {
        return 'ele ele-easy-button ele-widget-icon';
    }

    public function get_categories() {
        return array( 'easyelements' );
    }

    public function get_keywords() {
        return array( 'button', 'btn', 'easy', 'advance', 'link', 'creative-button', 'advanced button' );
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            '_section_button',
            [
                'label' => esc_html__( 'Easy Button', 'easyelements' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'btn_style',
            [
                'label'   => esc_html__( 'Style', 'easyelements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'hermosa',
                'options' => [
                    'hermosa'  => esc_html__( 'Hermosa', 'easyelements' ),
                    'montino'  => esc_html__( 'Montino', 'easyelements' ),
                    'iconica'  => esc_html__( 'Iconica', 'easyelements' ),
                    'symbolab' => esc_html__( 'Symbolab', 'easyelements' ),
                    'estilo'   => esc_html__( 'Estilo', 'easyelements' ),
                ],
            ]
        );

        $this->add_control(
            'estilo_effect',
            [
                'label'     => esc_html__( 'Effects', 'easyelements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'dissolve',
                'options'   => [
                    'dissolve'     => esc_html__( 'Dissolve', 'easyelements' ),
                    'slide-down'   => esc_html__( 'Slide In Down', 'easyelements' ),
                    'slide-right'  => esc_html__( 'Slide In Right', 'easyelements' ),
                    'slide-x'      => esc_html__( 'Slide Out X', 'easyelements' ),
                    'cross-slider' => esc_html__( 'Cross Slider', 'easyelements' ),
                    'slide-y'      => esc_html__( 'Slide Out Y', 'easyelements' ),
                ],
                'condition' => [
                    'btn_style' => 'estilo',
                ],
            ]
        );

        $this->add_control(
            'symbolab_effect',
            [
                'label'     => esc_html__( 'Effects', 'easyelements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'back-in-right',
                'options'   => [
                    'back-in-right'  => esc_html__( 'Back In Right', 'easyelements' ),
                    'back-in-left'   => esc_html__( 'Back In Left', 'easyelements' ),
                    'back-out-right' => esc_html__( 'Back Out Right', 'easyelements' ),
                    'back-out-left'  => esc_html__( 'Back Out Left', 'easyelements' ),
                ],
                'condition' => [
                    'btn_style' => 'symbolab',
                ],
            ]
        );

        $this->add_control(
            'iconica_effect',
            [
                'label'     => esc_html__( 'Effects', 'easyelements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'slide-in-down',
                'options'   => [
                    'slide-in-down'  => esc_html__( 'Slide In Down', 'easyelements' ),
                    'slide-in-top'   => esc_html__( 'Slide In Top', 'easyelements' ),
                    'slide-in-right' => esc_html__( 'Slide In Right', 'easyelements' ),
                    'slide-in-left'  => esc_html__( 'Slide In Left', 'easyelements' ),
                ],
                'condition' => [
                    'btn_style' => 'iconica',
                ],
            ]
        );

        $this->add_control(
            'montino_effect',
            [
                'label'     => esc_html__( 'Effects', 'easyelements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'winona',
                'options'   => [
                    'winona'  => esc_html__( 'Winona', 'easyelements' ),
                    'rayen'   => esc_html__( 'Rayen', 'easyelements' ),
                    'aylen'   => esc_html__( 'Aylen', 'easyelements' ),
                    'wapasha' => esc_html__( 'Wapasha', 'easyelements' ),
                    'nina'    => esc_html__( 'Nina', 'easyelements' ),
                    'antiman' => esc_html__( 'Antiman', 'easyelements' ),
                    'sacnite' => esc_html__( 'Sacnite', 'easyelements' ),
                ],
                'condition' => [
                    'btn_style' => 'montino',
                ],
            ]
        );

        $this->add_control(
            'hermosa_effect',
            [
                'label'     => esc_html__( 'Effects', 'easyelements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'exploit',
                'options'   => [
                    'exploit'    => esc_html__( 'Exploit', 'easyelements' ),
                    'upward'     => esc_html__( 'Upward', 'easyelements' ),
                    'newbie'     => esc_html__( 'Newbie', 'easyelements' ),
                    'render'     => esc_html__( 'Render', 'easyelements' ),
                    'reshape'    => esc_html__( 'Reshape', 'easyelements' ),
                    'expandable' => esc_html__( 'Expandable', 'easyelements' ),
                    'downhill'   => esc_html__( 'Downhill', 'easyelements' ),
                    'bloom'      => esc_html__( 'Bloom', 'easyelements' ),
                    'roundup'    => esc_html__( 'Roundup', 'easyelements' ),
                ],
                'condition' => [
                    'btn_style' => 'hermosa',
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'       => esc_html__( 'Text', 'easyelements' ),
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
                'label'         => esc_html__( 'Link', 'easyelements' ),
                'type'          => Controls_Manager::URL,
                'placeholder'   => esc_html__( 'https://your-link.com', 'easyelements' ),
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
                'label'                  => esc_html__( 'Icon', 'easyelements' ),
                'description'            => esc_html__( 'Please set an icon for the button.', 'easyelements' ),
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
                'label'       => esc_html__( 'Alignment', 'easyelements' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'easyelements' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'easyelements' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'easyelements' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'toggle'      => true,
                'selectors'   => [
                    '{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}};',
                    // '{{WRAPPER}} .ele-easy-btn-wrap' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'magnetic_enable',
            [
                'label'        => esc_html__( 'Magnetic Effect', 'easyelements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_block'  => false,
                'return_value' => 'yes',
                'separator'    => 'before',
            ]
        );

        $this->add_control(
            'threshold',
            [
                'label'     => esc_html__( 'Threshold', 'easyelements' ),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 0,
                'max'       => 100,
                'step'      => 1,
                'default'   => 30,
                'condition' => [
                    'magnetic_enable' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ele-easy-btn' => 'margin: {{VALUE}}px;',
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
                'label' => esc_html__( 'Common', 'easyelements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_item_width',
            [
                'label'      => esc_html__( 'Size', 'easyelements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .ele-easy-btn.ele-eft--downhill' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ele-easy-btn.ele-eft--roundup' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ele-easy-btn.ele-eft--roundup .progress' => 'width: calc({{SIZE}}{{UNIT}} - (({{SIZE}}{{UNIT}} / 100) * 20) ); height:auto;',
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
                'label'      => esc_html__( 'Icon Size', 'easyelements' ),
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
                    '{{WRAPPER}} .ele-easy-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
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
                'label'    => esc_html__( 'Typography', 'easyelements' ),
                'selector' => '{{WRAPPER}} .ele-easy-btn',
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
                'selector'   => '{{WRAPPER}} .ele-easy-btn, {{WRAPPER}} .ele-easy-btn.ele-eft--bloom div',
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
                'label'      => esc_html__( 'Border Radius', 'easyelements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ele-easy-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ele-easy-btn.ele-stl--hermosa.ele-eft--bloom div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_hermosa_roundup_stroke_width',
            [
                'label'      => esc_html__( 'Stroke Width', 'easyelements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .ele-easy-btn.ele-eft--roundup' => '--ele-ctv-btn-stroke-width: {{SIZE}}{{UNIT}};',
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
                'label'      => esc_html__( 'Padding', 'easyelements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .ele-easy-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ele-easy-btn.ele-stl--iconica > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ele-easy-btn.ele-stl--montino.ele-eft--winona > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ele-easy-btn.ele-stl--montino.ele-eft--winona::after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ele-easy-btn.ele-stl--montino.ele-eft--rayen > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ele-easy-btn.ele-stl--montino.ele-eft--rayen::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ele-easy-btn.ele-stl--montino.ele-eft--nina' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ele-easy-btn.ele-stl--montino.ele-eft--nina::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ele-easy-btn.ele-stl--hermosa.ele-eft--bloom span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'label' => esc_html__( 'Normal', 'easyelements' ),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'easyelements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ele-easy-btn-wrap .ele-easy-btn' => '--ele-ctv-btn-txt-clr: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label'      => esc_html__( 'Background Color', 'easyelements' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .ele-easy-btn-wrap .ele-easy-btn' => '--ele-ctv-btn-bg-clr: {{VALUE}}',
                ],
                'conditions' => $conditions,
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label'      => esc_html__( 'Border Color', 'easyelements' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .ele-easy-btn-wrap .ele-easy-btn' => '--ele-ctv-btn-border-clr: {{VALUE}}',
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
                'label'      => esc_html__( 'Circle Color', 'easyelements' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .ele-easy-btn-wrap .ele-easy-btn.ele-eft--roundup' => '--ele-ctv-btn-border-clr: {{VALUE}}',
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
                'selector' => '{{WRAPPER}} .ele-easy-btn',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tabs_button_hover',
            [
                'label' => esc_html__( 'Hover', 'easyelements' ),
            ]
        );

        $this->add_control(
            'button_hover_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'easyelements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ele-easy-btn-wrap .ele-easy-btn' => '--ele-ctv-btn-txt-hvr-clr: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label'      => esc_html__( 'Background Color', 'easyelements' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .ele-easy-btn-wrap .ele-easy-btn' => '--ele-ctv-btn-bg-hvr-clr: {{VALUE}}',
                ],
                'conditions' => $conditions,
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label'      => esc_html__( 'Border Color', 'easyelements' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .ele-easy-btn-wrap .ele-easy-btn' => '--ele-ctv-btn-border-hvr-clr: {{VALUE}}',
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
                'label'      => esc_html__( 'Circle Color', 'easyelements' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .ele-easy-btn-wrap .ele-easy-btn.ele-eft--roundup' => '--ele-ctv-btn-border-hvr-clr: {{VALUE}}',
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
                'selector' => '{{WRAPPER}} .ele-easy-btn:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
    }

    protected function render() {
        $display_settings = $this->get_settings_for_display();
        $this->add_render_attribute('wrap', 'data-magnetic', $display_settings['magnetic_enable'] ? $display_settings['magnetic_enable'] : 'no');
        $this->{'render_' . $display_settings['btn_style'] . '_button'}($display_settings);
    }


}