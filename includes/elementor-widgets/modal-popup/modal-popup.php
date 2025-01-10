<?php

namespace EasyElements\Elementor_Widgets\Modal_Popup;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

class Modal_Popup extends Widget_Base {

    public function get_name() {
        return 'ele-modal-video';
    }

    public function get_title() {
        return esc_html__( 'Modal Popup', 'easy-elements' );
    }

    public function get_icon() {
        return 'eicon-video-camera  ele-widget-icon';
    }

    public function get_categories() {
        return [ 'easy-elements' ];
    }

    public function get_keywords() {
        return [ 'ele', 'lightbox', 'popup', 'quickview', 'video', 'btn', 'button' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'ele_modal_content_section',
            [
                'label' => esc_html__( 'Contents', 'easy-elements' )
            ]
        );

        $this->add_control(
            'ele_modal_content',
            [
                'label'   => esc_html__( 'Type of Modal', 'easy-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image'          => esc_html__( 'Image', 'easy-elements' ),
                    'image-gallery'  => esc_html__( 'Image Gallery', 'easy-elements' ),
                    'html_content'   => esc_html__( 'HTML Content', 'easy-elements' ),
                    'youtube'        => esc_html__( 'Youtube Video', 'easy-elements' ),
                    'vimeo'          => esc_html__( 'Vimeo Video', 'easy-elements' ),
                    'external-video' => esc_html__( 'Self Hosted Video', 'easy-elements' ),
                    'external_page'  => esc_html__( 'External Page', 'easy-elements' ),
                    'shortcode'      => esc_html__( 'ShortCode', 'easy-elements' )
                ]
            ]
        );

        /**
         * Modal Popup image section
         */
        $this->add_control(
            'ele_modal_image',
            [
                'label'      => esc_html__( 'Image', 'easy-elements' ),
                'type'       => Controls_Manager::MEDIA,
                'default'    => [
                    'url' 	 => Utils::get_placeholder_image_src()
                ],
                'dynamic'    => [
                    'active' => true
                ],
                'condition'  => [
                    'ele_modal_content' => 'image'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail',
                'default'   => 'full',
                'condition' => [
                    'ele_modal_content' => 'image'
                ]
            ]
        );

        /**
         * Modal Popup image gallery
         */

        $this->add_control(
            'ele_modal_image_gallery_column',
            [
                'label'   => esc_html__( 'Column', 'easy-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'column-three',
                'options' => [
                    'column-one'   => esc_html__( 'Column 1', 'easy-elements' ),
                    'column-two'   => esc_html__( 'Column 2', 'easy-elements' ),
                    'column-three' => esc_html__( 'Column 3', 'easy-elements' ),
                    'column-four'  => esc_html__( 'Column 4', 'easy-elements' ),
                    'column-five'  => esc_html__( 'Column 5', 'easy-elements' ),
                    'column-six'   => esc_html__( 'Column 6', 'easy-elements' )
                ],
                'condition' => [
                    'ele_modal_content' => 'image-gallery'
                ]
            ]
        );

        $image_repeater = new Repeater();

        $image_repeater->add_control(
            'ele_modal_image_gallery',
            [
                'label'   => esc_html__( 'Image', 'easy-elements' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src()
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $image_repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail',
                'default'   => 'full',
            ]
        );

        $image_repeater->add_control(
            'ele_modal_image_gallery_text',
            [
                'label' => esc_html__( 'Description', 'easy-elements' ),
                'type'  => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'ele_modal_image_gallery_repeater',
            [
                'label'   => esc_html__( 'Image Gallery', 'easy-elements' ),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $image_repeater->get_controls(),
                'default' => [
                    [ 'ele_modal_image_gallery' => Utils::get_placeholder_image_src() ],
                    [ 'ele_modal_image_gallery' => Utils::get_placeholder_image_src() ],
                    [ 'ele_modal_image_gallery' => Utils::get_placeholder_image_src() ]
                ],
                'condition' => [
                    'ele_modal_content' => 'image-gallery'
                ]
            ]
        );
        /**
         * Modal Popup html content section
         */
        $this->add_control(
            'ele_modal_html_content',
            [
                'label'     => esc_html__( 'Add your content here (HTML/Shortcode)', 'easy-elements' ),
                'type'      => Controls_Manager::WYSIWYG,
                'default'   => esc_html__( 'Add your popup content here', 'easy-elements' ),
                'dynamic'   => [ 'active' => true ],
                'condition' => [
                    'ele_modal_content' => 'html_content'
                ]
            ]
        );

        /**
         * Modal Popup video section
         */

        $this->add_control(
            'ele_modal_youtube_video_url',
            [
                'label'       => esc_html__( 'Provide Youtube Video URL', 'easy-elements' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => 'https://www.youtube.com/watch?v=b1lyIT1FvDo',
                'placeholder' => esc_html__( 'Place Youtube Video URL', 'easy-elements' ),
                'title'       => esc_html__( 'Place Youtube Video URL', 'easy-elements' ),
                'condition'   => [
                    'ele_modal_content' => 'youtube'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );


        $this->add_control(
            'ele_modal_vimeo_video_url',
            [
                'label'       => esc_html__( 'Provide Vimeo Video URL', 'easy-elements' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => 'https://vimeo.com/347565673',
                'placeholder' => esc_html__( 'Place Vimeo Video URL', 'easy-elements' ),
                'title'       => esc_html__( 'Place Vimeo Video URL', 'easy-elements' ),
                'condition'   => [
                    'ele_modal_content' => 'vimeo'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        /**
         * Modal Popup external video section
         */
        $this->add_control(
            'ele_modal_external_video',
            [
                'label'      => esc_html__( 'External Video', 'easy-elements' ),
                'type'       => Controls_Manager::MEDIA,
                'media_type' => 'video',
                'dynamic' => [
                    'active' => true,
                ],
                'condition'  => [
                    'ele_modal_content' => 'external-video'
                ]
            ]
        );

        $this->add_control(
            'ele_modal_external_page_url',
            [
                'label'       => esc_html__( 'Provide External URL', 'easy-elements' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => 'https://joydevs.com',
                'placeholder' => esc_html__( 'Place External Page URL', 'easy-elements' ),
                'condition'   => [
                    'ele_modal_content' => 'external_page'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_responsive_control(
            'ele_modal_video_width',
            [
                'label'        => esc_html__( 'Content Width', 'easy-elements' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px', '%' ],
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 5
                    ],
                    '%'        => [
                        'min'  => 0,
                        'max'  => 100
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 720
                ],
                'selectors'    => [
                    '{{WRAPPER}} .ele-modal-item .ele-modal-content .ele-modal-element iframe,
					{{WRAPPER}} .ele-modal-item .ele-modal-content .ele-video-hosted' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ele-modal-item' => 'width: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'ele_modal_content' => [ 'youtube', 'vimeo', 'external_page', 'external-video' ]
                ]
            ]
        );

        $this->add_responsive_control(
            'ele_modal_video_height',
            [
                'label'        => esc_html__( 'Content Height', 'easy-elements' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px', '%' ],
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 5
                    ],
                    '%'        => [
                        'min'  => 0,
                        'max'  => 100
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 400
                ],
                'selectors'    => [
                    '{{WRAPPER}} .ele-modal-item .ele-modal-content .ele-modal-element iframe' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ele-modal-item' => 'height: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'ele_modal_content' => [ 'youtube', 'vimeo', 'external_page' ]
                ]
            ]
        );

        $this->add_control(
            'ele_modal_shortcode',
            [
                'label'       => esc_html__( 'Enter your shortcode', 'easy-elements' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__( '[gallery]', 'easy-elements' ),
                'condition'   => [
                    'ele_modal_content' => 'shortcode'
                ]
            ]
        );

        $this->add_responsive_control(
            'ele_modal_content_width',
            [
                'label' => esc_html__( 'Content Width', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ele-modal-item' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'    => [
                    'ele_modal_content' => [ 'image', 'image-gallery', 'html_content', 'shortcode' ]
                ]
            ]
        );

        $this->add_control(
            'ele_modal_btn_text',
            [
                'label'       => esc_html__( 'Button Text', 'easy-elements' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( '', 'easy-elements' ),
                'dynamic'     => [
                    'active'  => true
                ]
            ]
        );

        $this->add_control(
            'ele_modal_btn_icon',
            [
                'label'       => esc_html__( 'Button Icon', 'easy-elements' ),
                'label_block' => true,
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-play',
                    'library' => 'fa-brands'
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Modal Popup settings section
         */
        $this->start_controls_section(
            'ele_modal_setting_section',
            [
                'label' => esc_html__( 'Settings', 'easy-elements' )
            ]
        );

        $this->add_control(
            'ele_modal_overlay',
            [
                'label'        => esc_html__( 'Overlay', 'easy-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'easy-elements' ),
                'label_off'    => esc_html__( 'Hide', 'easy-elements' ),
                'return_value' => 'yes',
                'default'      => 'yes'
            ]
        );

        $this->add_control(
            'ele_modal_overlay_click_close',
            [
                'label'     => esc_html__( 'Close While Clicked Outside', 'easy-elements' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'ON', 'easy-elements' ),
                'label_off' => esc_html__( 'OFF', 'easy-elements' ),
                'default'   => 'yes',
                'condition' => [
                    'ele_modal_overlay' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Modal Popup button style
         */

        $this->start_controls_section(
            'ele_modal_display_settings',
            [
                'label' => esc_html__( 'Button', 'easy-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );


        /**
         * display settings for button normal and hover
         */
        $this->start_controls_tabs( 'ele_modal_btn_typhography_color', ['separator' => 'before' ] );

        $this->start_controls_tab( 'ele_modal_btn_typhography_color_normal_tab', [ 'label' => esc_html__( 'Normal', 'easy-elements' )] );

        $this->add_control(
            'ele_modal_btn_typhography_color_normal',
            [
                'label'     => esc_html__( 'Color', 'easy-elements' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .ele-modal-button .ele-modal-image-action span' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'ele_modal_btn_background_normal',
            [
                'label'     => esc_html__( 'Background Color', 'easy-elements' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#4243DC',
                'selectors' => [
                    '{{WRAPPER}} .ele-modal-button .ele-modal-image-action' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'ele_modal_btn_align',
            [
                'label'         => esc_html__( 'Alignment', 'easy-elements' ),
                'type'          => Controls_Manager::CHOOSE,
                'default'       => 'center',
                'toggle'        => false,
                'separator'     => 'before',
                'options'       => [
                    'left'      => [
                        'title' => esc_html__( 'Left', 'easy-elements' ),
                        'icon'  => 'eicon-text-align-left'
                    ],
                    'center'    => [
                        'title' => esc_html__( 'Center', 'easy-elements' ),
                        'icon'  => 'eicon-text-align-center'
                    ],
                    'right'     => [
                        'title' => esc_html__( 'Right', 'easy-elements' ),
                        'icon'  => 'eicon-text-align-right'
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .ele-modal-button' => 'text-align: {{VALUE}};'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ele_modal_btn_typhography',
                'label'     => esc_html__( 'Button Typography', 'easy-elements' ),
                'selector'  => '{{WRAPPER}} .ele-modal-button .ele-modal-image-action span'
            ]
        );

        $this->add_control(
            'ele_modal_btn_enable_fixed_width_height',
            [
                'label' => esc_html__( 'Enable Fixed Height & Width?', 'easy-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'easy-elements' ),
                'label_off' => esc_html__( 'Hide', 'easy-elements' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'ele_modal_btn_fixed_width_height',
            [
                'label' => esc_html__( 'Fixed Height & Width', 'easy-elements' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => esc_html__( 'Default', 'easy-elements' ),
                'label_on' => esc_html__( 'Custom', 'easy-elements' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'ele_modal_btn_enable_fixed_width_height' => 'yes'
                ]
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'ele_modal_btn_fixed_width',
            [
                'label'      => esc_html__( 'Width', 'easy-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px'     => [
                        'min'  => 0,
                        'max'  => 500,
                        'step' => 1
                    ],
                    '%'        => [
                        'min'  => 0,
                        'max'  => 100
                    ]
                ],
                'default'    => [
                    'unit'   => 'px',
                    'size'   => 70
                ],
                'selectors'  => [
                    '{{WRAPPER}} .ele-modal-button .ele-modal-image-action' => 'width: {{SIZE}}{{UNIT}};'

                ],
                'condition' => [
                    'ele_modal_btn_enable_fixed_width_height' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'ele_modal_btn_fixed_height',
            [
                'label'      => esc_html__( 'Height', 'easy-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px'     => [
                        'min'  => 0,
                        'max'  => 500,
                        'step' => 1
                    ],
                    '%'        => [
                        'min'  => 0,
                        'max'  => 100
                    ]
                ],
                'default'    => [
                    'unit'   => 'px',
                    'size'   => 70
                ],
                'selectors'  => [
                    '{{WRAPPER}} .ele-modal-button .ele-modal-image-action' => 'height: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'ele_modal_btn_enable_fixed_width_height' => 'yes'
                ]
            ]
        );

        $this->end_popover();

        $this->add_responsive_control(
            'ele_modal_btn_width',
            [
                'label'        => esc_html__( 'Width', 'easy-elements' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px', '%' ],
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 500,
                        'step' => 1
                    ],
                    '%'        => [
                        'min'  => 0,
                        'max'  => 100
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 70
                ],
                'selectors'    => [
                    '{{WRAPPER}} .ele-modal-button .ele-modal-image-action' => 'width: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'ele_modal_btn_enable_fixed_width_height!' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'               => 'ele_modal_btn_border_normal',
                'selector'           => '{{WRAPPER}} .ele-modal-button .ele-modal-image-action'
            ]
        );

        $this->add_responsive_control(
            'ele_modal_btn_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'easy-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'    => '50',
                    'right'  => '50',
                    'bottom' => '50',
                    'left'   => '50',
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .ele-modal-image-action, {{WRAPPER}} .ele-modal-image-action::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'ele_modal_btn_padding',
            [
                'label'        => esc_html__( 'Padding', 'easy-elements' ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', '%' ],
                'default'      => [
                    'top'      => '20',
                    'right'    => '0',
                    'bottom'   => '20',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'    => [
                    '{{WRAPPER}} .ele-modal-image-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'ele_modal_btn_typhography_color_hover_tab', [ 'label' => esc_html__( 'Hover', 'easy-elements' ) ] );

        $this->add_control(
            'ele_modal_btn_color_hover',
            [
                'label'     => esc_html__( 'Text Color', 'easy-elements' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ele-modal-button .ele-modal-image-action:hover span' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'ele_modal_btn_background_hover',
            [
                'label'     => esc_html__( 'Background Color', 'easy-elements' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#EF2469',
                'selectors' => [
                    '{{WRAPPER}} .ele-modal-button .ele-modal-image-action:hover' => 'background-color: {{VALUE}};'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'ele_modal_btn_border_hover',
                'selector' => '{{WRAPPER}} .ele-modal-button .ele-modal-image-action:hover'
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        /**
         * Modal Popup Icon section
         */
        $this->start_controls_section(
            'ele_modal_icon_section',
            [
                'label' => esc_html__( 'Icon', 'easy-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'ele_modal_btn_icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'easy-elements' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .ele-modal-button .ele-modal-image-action span i' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'ele_modal_btn_icon_align',
            [
                'label'     => esc_html__( 'Icon Position', 'easy-elements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'left',
                'options'   => [
                    'left'  => esc_html__( 'Before', 'easy-elements' ),
                    'right' => esc_html__( 'After', 'easy-elements' )
                ],
                'condition' => [
                    'ele_modal_btn_icon[value]!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'ele_modal_btn_icon_indent',
            [
                'label'       => esc_html__( 'Icon Spacing', 'easy-elements' ),
                'type'        => Controls_Manager::SLIDER,
                'range'       => [
                    'px'      => [
                        'max' => 50
                    ]
                ],
                'selectors'   => [
                    '{{WRAPPER}} .ele-modal-button .ele-modal-image-action span.ele-modal-action-icon-left i' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ele-modal-button .ele-modal-image-action span.ele-modal-action-icon-right i' => 'margin-left: {{SIZE}}{{UNIT}};'
                ],
                'condition'   => [
                    'ele_modal_btn_icon[value]!' => ''
                ]
            ]
        );
        $this->end_controls_section();

        /**
         * Modal Popup Container section
         */
        $this->start_controls_section(
            'ele_modal_container_section',
            [
                'label' => esc_html__( 'Container', 'easy-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'ele_modal_content_align',
            [
                'label'     => esc_html__( 'Alignment', 'easy-elements' ),
                'type'      => Controls_Manager::CHOOSE,
                'toggle'    => false,
                'default'   => 'center',
                'options'   => [
                    'left'  => [
                        'title' => esc_html__( 'Left', 'easy-elements' ),
                        'icon'  => 'eicon-text-align-left'
                    ],
                    'center'    => [
                        'title' => esc_html__( 'Center', 'easy-elements' ),
                        'icon'  => 'eicon-text-align-center'
                    ],
                    'right'     => [
                        'title' => esc_html__( 'Right', 'easy-elements' ),
                        'icon'  => 'eicon-text-align-right'
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .ele-modal-item .ele-modal-content .ele-modal-element' => 'text-align: {{VALUE}};'
                ],
                'condition' => [
                    'ele_modal_content' => ['image-gallery', 'html_content']
                ]
            ]
        );

        $this->add_responsive_control(
            'ele_modal_content_height',
            [
                'label' => esc_html__( 'Contant Height for Tablet & Mobile', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 500,
                        'step' => 1
                    ],
                    '%'        => [
                        'min'  => 0,
                        'max'  => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .ele-modal-item.modal-vimeo' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ele_modal_image_gallery_description_typography',
                'selector'  => '{{WRAPPER}} .ele-modal-content .ele-modal-element .ele-modal-element-card .ele-modal-element-card-body p',
                'condition' => [
                    'ele_modal_content' => [ 'image-gallery' ]
                ]
            ]
        );

        $this->add_control(
            'ele_modal_image_gallery_description_color',
            [
                'label'     => esc_html__( 'Description Color', 'easy-elements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ele-modal-content .ele-modal-element .ele-modal-element-card .ele-modal-element-card-body p'  => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'ele_modal_content' => [ 'image-gallery' ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'ele_modal_content_border',
                'selector' => '{{WRAPPER}} .ele-modal-item .ele-modal-content .ele-modal-element'
            ]
        );

        $this->add_control(
            'ele_modal_image_gallery_bg',
            [
                'label'     => esc_html__( 'Background Color', 'easy-elements' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .ele-modal-item .ele-modal-content .ele-modal-element'  => 'background: {{VALUE}};'
                ],
                'condition' => [
                    'ele_modal_content' => ['image-gallery', 'html_content']
                ]
            ]
        );

        $this->add_control(
            'ele_modal_image_gallery_padding',
            [
                'label'      => esc_html__( 'Padding', 'easy-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'    => '10',
                    'right'  => '10',
                    'bottom' => '10',
                    'left'   => '10',
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .ele-modal-item .ele-modal-content .ele-modal-element .ele-modal-element-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ele-modal-item .ele-modal-content .ele-modal-element' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'  => [
                    'ele_modal_content' => [ 'image-gallery', 'html_content' ]
                ]
            ]
        );

        $this->add_responsive_control(
            'ele_modal_image_gallery_description_margin',
            [
                'label'      => esc_html__('Margin(Description)', 'easy-elements'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .ele-modal-item .ele-modal-content .ele-modal-element .ele-modal-element-card-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'  => [
                    'ele_modal_content' => [ 'image-gallery' ]
                ]
            ]
        );

        $this->add_control(
            'ele_modal_overlay_overflow_x',
            [
                'label'        => esc_html__( 'Overflow X', 'easy-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'easy-elements' ),
                'label_off'    => esc_html__( 'No', 'easy-elements' ),
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'ele_modal_overlay_overflow_y',
            [
                'label'        => esc_html__( 'Overflow Y', 'easy-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'easy-elements' ),
                'label_off'    => esc_html__( 'No', 'easy-elements' ),
                'default'      => 'yes',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ele_modal_animation_tab',
            [
                'label' => esc_html__( 'Animation', 'easy-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'ele_modal_transition',
            [
                'label'   => esc_html__( 'Style', 'easy-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'top-to-middle',
                'options' => [
                    'top-to-middle'    => esc_html__( 'Top To Middle', 'easy-elements' ),
                    'bottom-to-middle' => esc_html__( 'Bottom To Middle', 'easy-elements' ),
                    'right-to-middle'  => esc_html__( 'Right To Middle', 'easy-elements' ),
                    'left-to-middle'   => esc_html__( 'Left To Middle', 'easy-elements' ),
                    'zoom-in'          => esc_html__( 'Zoom In', 'easy-elements' ),
                    'zoom-out'         => esc_html__( 'Zoom Out', 'easy-elements' ),
                    'left-rotate'      => esc_html__( 'Rotation', 'easy-elements' )
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Modal Popup overlay style
         */

        $this->start_controls_section(
            'ele_modal_overlay_tab',
            [
                'label'     => esc_html__( 'Overlay', 'easy-elements' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ele_modal_overlay' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'            => 'ele_modal_overlay_color',
                'types'           => [ 'classic' ],
                'selector'        => '{{WRAPPER}} .ele-modal-overlay',
                'fields_options'  => [
                    'background'  => [
                        'default' => 'classic'
                    ],
                    'color'       => [
                        'default' => 'rgba(0,0,0,.5)'
                    ]
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Modal Popup Close button style
         */

        $this->start_controls_section(
            'ele_modal_close_btn_style',
            [
                'label' => esc_html__( 'Close Button', 'easy-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'ele_modal_close_btn_position',
            [
                'label' => esc_html__( 'Close Button Position', 'easy-elements' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => esc_html__( 'Default', 'easy-elements' ),
                'label_on' => esc_html__( 'Custom', 'easy-elements' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'ele_modal_close_btn_position_x_offset',
            [
                'label' => esc_html__( 'X Offset', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -4000,
                        'max' => 4000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ele-modal-item.modal-vimeo .ele-modal-content .ele-close-btn' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ele_modal_close_btn_position_y_offset',
            [
                'label' => esc_html__( 'Y Offset', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -4000,
                        'max' => 4000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ele-modal-item.modal-vimeo .ele-modal-content .ele-close-btn' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_popover();

        $this->add_responsive_control(
            'ele_modal_close_btn_icon_size',
            [
                'label'      => esc_html__( 'Icon Size', 'easy-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 30,
                    ],
                ],
                'default'   => [
                    'unit'  => 'px',
                    'size'  => 20
                ],
                'selectors' => [
                    '{{WRAPPER}} .ele-modal-item.modal-vimeo .ele-modal-content .ele-close-btn span::before' => 'width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .ele-modal-item.modal-vimeo .ele-modal-content .ele-close-btn span::after' => 'height: {{SIZE}}{{UNIT}}'
                ],
            ]
        );

        $this->add_control(
            'ele_modal_close_btn_color',
            [
                'label'     => esc_html__( 'Color', 'easy-elements' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .ele-modal-item.modal-vimeo .ele-modal-content .ele-close-btn span::before, {{WRAPPER}} .ele-modal-item.modal-vimeo .ele-modal-content .ele-close-btn span::after'  => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'ele_modal_close_btn_bg_color',
            [
                'label'    => esc_html__( 'Background Color', 'easy-elements' ),
                'type'     => Controls_Manager::COLOR,
                'default'  => 'transparent',
                'selectors' => [
                    '{{WRAPPER}} .ele-modal-item.modal-vimeo .ele-modal-content .ele-close-btn'  => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        // Get settings for display
        $settings = $this->get_settings_for_display();

        // Process YouTube video URL if the content type is YouTube
        if( 'youtube' === $settings['ele_modal_content'] ){
            $youtube_url = $settings['ele_modal_youtube_video_url'];
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $youtube_url, $matches);
            $youtube_video_id = $matches[1];
        }

        // Process Vimeo video URL if the content type is Vimeo
        if( 'vimeo' === $settings['ele_modal_content'] ){
            $vimeo_url = $settings['ele_modal_vimeo_video_url'];
            $vimeo_url_parts = explode('/', $vimeo_url);
            $vimeo_video_id_parts = explode('&', str_replace('https://vimeo.com', '', end($vimeo_url_parts)));
            $vimeo_video_id = $vimeo_video_id_parts[0];
        }

        // Add attributes for modal action
        $this->add_render_attribute('ele_modal_action', [
            'class' => 'ele-modal-image-action image-modal',
            'data-ele-modal' => '#ele-modal-' . $this->get_id(),
            'data-ele-overlay' => esc_attr($settings['ele_modal_overlay'])
        ]);

        // Add attributes for modal overlay
        $this->add_render_attribute('ele_modal_overlay', [
            'class' => 'ele-modal-overlay',
            'data-ele_overlay_click_close' => $settings['ele_modal_overlay_click_close']
        ]);

        // Add attributes for modal item
        $this->add_render_attribute('ele_modal_item', 'class', 'ele-modal-item');
        $this->add_render_attribute('ele_modal_item', 'class', 'modal-vimeo');
        $this->add_render_attribute('ele_modal_item', 'class', $settings['ele_modal_transition']);
        $this->add_render_attribute('ele_modal_item', 'class', $settings['ele_modal_content']);
        $this->add_render_attribute('ele_modal_item', 'class', esc_attr('ele-content-overflow-x-' . $settings['ele_modal_overlay_overflow_x']));
        $this->add_render_attribute('ele_modal_item', 'class', esc_attr('ele-content-overflow-y-' . $settings['ele_modal_overlay_overflow_y']));
        ?>

        <div class="ele-modal">
            <div class="ele-modal-wrapper">

                <div class="ele-modal-button ele-modal-btn-fixed-width-<?php echo esc_attr($settings['ele_modal_btn_enable_fixed_width_height']);?>">
                    <a href="#" <?php echo $this->get_render_attribute_string('ele_modal_action');?> >
                    <span class="ele-modal-action-icon-<?php echo esc_attr($settings['ele_modal_btn_icon_align']);?>">
                        <!-- Render icon if it is aligned to the left -->
                        <?php if( 'left' === $settings['ele_modal_btn_icon_align'] && !empty($settings['ele_modal_btn_icon']['value']) ) {
                            \Elementor\Icons_Manager::render_icon($settings['ele_modal_btn_icon'], ['aria-hidden' => 'true']);
                        }
                        // Render button text
                        echo esc_html($settings['ele_modal_btn_text']);
                        // Render icon if it is aligned to the right
                        if( 'right' === $settings['ele_modal_btn_icon_align'] && !empty($settings['ele_modal_btn_icon']['value']) ) {
                            \Elementor\Icons_Manager::render_icon($settings['ele_modal_btn_icon'], ['aria-hidden' => 'true']);
                        } ;?>
                    </span>
                    </a>
                </div>

                <div id="ele-modal-<?php echo esc_attr($this->get_id());?>" <?php echo $this->get_render_attribute_string('ele_modal_item');?> >
                    <div class="ele-modal-content">
                        <div class="ele-modal-element <?php echo esc_attr($settings['ele_modal_image_gallery_column']);?>">
                            <?php
                            // Render image content
                            if ( 'image' === $settings['ele_modal_content'] ) {
                                echo Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'ele_modal_image');
                            }

                            // Render image gallery content
                            if ( 'image-gallery' === $settings['ele_modal_content'] ) {
                                foreach ( $settings['ele_modal_image_gallery_repeater'] as $gallery_item ) : ?>
                                    <div class="ele-modal-element-card">
                                        <div class="ele-modal-element-card-thumb">
                                            <?php echo Group_Control_Image_Size::get_attachment_image_html($gallery_item, 'thumbnail', 'ele_modal_image_gallery');?>
                                        </div>
                                        <?php if ( !empty($gallery_item['ele_modal_image_gallery_text']) ) {?>
                                            <div class="ele-modal-element-card-body">
                                                <p><?php echo wp_kses_post($gallery_item['ele_modal_image_gallery_text']);?></p>
                                            </div>
                                        <?php } ;?>
                                    </div>
                                <?php
                                endforeach;
                            }

                            // Render HTML content
                            if ( 'html_content' === $settings['ele_modal_content'] ) { ?>
                                <div class="ele-modal-element-body">
                                    <p><?php echo wp_kses_post($settings['ele_modal_html_content']);?></p>
                                </div>
                            <?php }

                            // Render YouTube video content
                            if ( 'youtube' === $settings['ele_modal_content'] ) { ?>
                                <iframe src="https://www.youtube.com/embed/<?php echo esc_attr($youtube_video_id);?>" frameborder="0" allowfullscreen></iframe>
                            <?php }

                            // Render Vimeo video content
                            if ( 'vimeo' === $settings['ele_modal_content'] ) { ?>
                                <iframe id="vimeo-video" src="https://player.vimeo.com/video/<?php echo esc_attr($vimeo_video_id);?>" frameborder="0" allowfullscreen ></iframe>
                            <?php }

                            // Render external video content
                            if ( 'external-video' === $settings['ele_modal_content'] ) { ?>
                                <video class="ele-video-hosted" src="<?php echo esc_url($settings['ele_modal_external_video']['url']);?>" controls="" controlslist="nodownload">
                                </video>
                            <?php }

                            // Render external page content
                            if ( 'external_page' === $settings['ele_modal_content'] ) { ?>
                                <iframe src="<?php echo esc_url($settings['ele_modal_external_page_url']);?>" frameborder="0" allowfullscreen ></iframe>
                            <?php }

                            // Render shortcode content
                            if ( 'shortcode' === $settings['ele_modal_content'] ) {
                                echo do_shortcode($settings['ele_modal_shortcode']);
                            } ;?>

                            <!-- Close button for modal -->
                            <div class="ele-close-btn">
                                <span></span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div <?php echo $this->get_render_attribute_string('ele_modal_overlay');?>></div>
        </div>
        <?php
    }
}