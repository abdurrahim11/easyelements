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
        return esc_html__( 'Easy Button', 'easy-elements' );
    }

    public function get_icon() {
        return 'ele ele-easy-button ele-widget-icon';
    }

    public function get_categories() {
        return array( 'easy-elements' );
    }

    public function get_keywords() {
        return array( 'button', 'btn', 'easy', 'advance', 'link', 'creative-button', 'advanced button' );
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            '_section_button',
            [
                'label' => esc_html__( 'Easy Button', 'easy-elements' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'btn_style',
            [
                'label'   => esc_html__( 'Style', 'easy-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'hermosa',
                'options' => [
                    'hermosa'  => esc_html__( 'Hermosa', 'easy-elements' ),
                    'montino'  => esc_html__( 'Montino', 'easy-elements' ),
                    'iconica'  => esc_html__( 'Iconica', 'easy-elements' ),
                    'symbolab' => esc_html__( 'Symbolab', 'easy-elements' ),
                    'estilo'   => esc_html__( 'Estilo', 'easy-elements' ),
                ],
            ]
        );

        $this->add_control(
            'estilo_effect',
            [
                'label'     => esc_html__( 'Effects', 'easy-elements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'dissolve',
                'options'   => [
                    'dissolve'     => esc_html__( 'Dissolve', 'easy-elements' ),
                    'slide-down'   => esc_html__( 'Slide In Down', 'easy-elements' ),
                    'slide-right'  => esc_html__( 'Slide In Right', 'easy-elements' ),
                    'slide-x'      => esc_html__( 'Slide Out X', 'easy-elements' ),
                    'cross-slider' => esc_html__( 'Cross Slider', 'easy-elements' ),
                    'slide-y'      => esc_html__( 'Slide Out Y', 'easy-elements' ),
                ],
                'condition' => [
                    'btn_style' => 'estilo',
                ],
            ]
        );

        $this->add_control(
            'symbolab_effect',
            [
                'label'     => esc_html__( 'Effects', 'easy-elements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'back-in-right',
                'options'   => [
                    'back-in-right'  => esc_html__( 'Back In Right', 'easy-elements' ),
                    'back-in-left'   => esc_html__( 'Back In Left', 'easy-elements' ),
                    'back-out-right' => esc_html__( 'Back Out Right', 'easy-elements' ),
                    'back-out-left'  => esc_html__( 'Back Out Left', 'easy-elements' ),
                ],
                'condition' => [
                    'btn_style' => 'symbolab',
                ],
            ]
        );

        $this->add_control(
            'iconica_effect',
            [
                'label'     => esc_html__( 'Effects', 'easy-elements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'slide-in-down',
                'options'   => [
                    'slide-in-down'  => esc_html__( 'Slide In Down', 'easy-elements' ),
                    'slide-in-top'   => esc_html__( 'Slide In Top', 'easy-elements' ),
                    'slide-in-right' => esc_html__( 'Slide In Right', 'easy-elements' ),
                    'slide-in-left'  => esc_html__( 'Slide In Left', 'easy-elements' ),
                ],
                'condition' => [
                    'btn_style' => 'iconica',
                ],
            ]
        );

        $this->add_control(
            'montino_effect',
            [
                'label'     => esc_html__( 'Effects', 'easy-elements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'winona',
                'options'   => [
                    'winona'  => esc_html__( 'Winona', 'easy-elements' ),
                    'rayen'   => esc_html__( 'Rayen', 'easy-elements' ),
                    'aylen'   => esc_html__( 'Aylen', 'easy-elements' ),
                    'wapasha' => esc_html__( 'Wapasha', 'easy-elements' ),
                    'nina'    => esc_html__( 'Nina', 'easy-elements' ),
                    'antiman' => esc_html__( 'Antiman', 'easy-elements' ),
                    'sacnite' => esc_html__( 'Sacnite', 'easy-elements' ),
                ],
                'condition' => [
                    'btn_style' => 'montino',
                ],
            ]
        );

        $this->add_control(
            'hermosa_effect',
            [
                'label'     => esc_html__( 'Effects', 'easy-elements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'exploit',
                'options'   => [
                    'exploit'    => esc_html__( 'Exploit', 'easy-elements' ),
                    'upward'     => esc_html__( 'Upward', 'easy-elements' ),
                    'newbie'     => esc_html__( 'Newbie', 'easy-elements' ),
                    'render'     => esc_html__( 'Render', 'easy-elements' ),
                    'reshape'    => esc_html__( 'Reshape', 'easy-elements' ),
                    'expandable' => esc_html__( 'Expandable', 'easy-elements' ),
                    'downhill'   => esc_html__( 'Downhill', 'easy-elements' ),
                    'bloom'      => esc_html__( 'Bloom', 'easy-elements' ),
                    'roundup'    => esc_html__( 'Roundup', 'easy-elements' ),
                ],
                'condition' => [
                    'btn_style' => 'hermosa',
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'       => esc_html__( 'Text', 'easy-elements' ),
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
                'label'         => esc_html__( 'Link', 'easy-elements' ),
                'type'          => Controls_Manager::URL,
                'placeholder'   => esc_html__( 'https://your-link.com', 'easy-elements' ),
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
                'label'                  => esc_html__( 'Icon', 'easy-elements' ),
                'description'            => esc_html__( 'Please set an icon for the button.', 'easy-elements' ),
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
                'label'       => esc_html__( 'Alignment', 'easy-elements' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'easy-elements' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'easy-elements' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'easy-elements' ),
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
                'label'        => esc_html__( 'Magnetic Effect', 'easy-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_block'  => false,
                'return_value' => 'yes',
                'separator'    => 'before',
            ]
        );

        $this->add_control(
            'threshold',
            [
                'label'     => esc_html__( 'Threshold', 'easy-elements' ),
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
                'label' => esc_html__( 'Common', 'easy-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_item_width',
            [
                'label'      => esc_html__( 'Size', 'easy-elements' ),
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
                'label'      => esc_html__( 'Icon Size', 'easy-elements' ),
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
                'label'    => esc_html__( 'Typography', 'easy-elements' ),
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
                'label'      => esc_html__( 'Border Radius', 'easy-elements' ),
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
                'label'      => esc_html__( 'Stroke Width', 'easy-elements' ),
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
                'label'      => esc_html__( 'Padding', 'easy-elements' ),
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
                'label' => esc_html__( 'Normal', 'easy-elements' ),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'easy-elements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ele-easy-btn-wrap .ele-easy-btn' => '--ele-ctv-btn-txt-clr: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label'      => esc_html__( 'Background Color', 'easy-elements' ),
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
                'label'      => esc_html__( 'Border Color', 'easy-elements' ),
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
                'label'      => esc_html__( 'Circle Color', 'easy-elements' ),
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
                'label' => esc_html__( 'Hover', 'easy-elements' ),
            ]
        );

        $this->add_control(
            'button_hover_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'easy-elements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ele-easy-btn-wrap .ele-easy-btn' => '--ele-ctv-btn-txt-hvr-clr: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label'      => esc_html__( 'Background Color', 'easy-elements' ),
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
                'label'      => esc_html__( 'Border Color', 'easy-elements' ),
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
                'label'      => esc_html__( 'Circle Color', 'easy-elements' ),
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