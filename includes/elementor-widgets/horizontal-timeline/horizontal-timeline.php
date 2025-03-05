<?php

namespace EasyElements\Elementor_Widgets\Horizontal_Timeline;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;


class Horizontal_Timeline extends Widget_Base {

	public function get_name() {
		return 'ele-horizontal-timeline';
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
		return esc_html__( 'Horizontal Timeline', 'easyelements' );
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
		return 'ele ele-horizontal-timelines ele-widget-icon';
	}

	public function get_categories() {
        return [ 'easyelements' ];
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
		return array( 'ele', 'horizontal', 'timeline', 'carousel' );
	}

	/**
	 * Retrieve the list of style the widget depended on.
	 *
	 * Used to set style dependencies required to run the widget.
	 *
	 * @return array Widget style dependencies.
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 */

	public function get_style_depends() {
		return array( 'owl-carousel' );
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @return array Widget scripts dependencies.
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 */
	public function get_script_depends() {
		return array( 'owl-carousel' );
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_horizontal_timeline',
			array(
				'label' => esc_html__( 'General', 'easyelements' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'date_media_type',
			array(
				'label'       => esc_html__( 'Date Media', 'easyelements' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => array(
					'none'   => array(
						'title' => esc_html__( 'None', 'easyelements' ),
						'icon'  => 'eicon-ban',
					),
					'image'  => array(
						'title' => esc_html__( 'Image', 'easyelements' ),
						'icon'  => 'eicon-image',
					),
					'custom' => array(
						'title' => esc_html__( 'Custom', 'easyelements' ),
						'icon'  => ' eicon-font',
					),
				),
				'default'     => 'custom',
				'toggle'      => false,
			)
		);

		$repeater->add_control(
			'date_image',
			array(
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'date_media_type' => 'image',
				),
				'dynamic'   => array(
					'active' => true,
				),
			)
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'date_image_thumbnail',
				'default'   => 'large',
				'separator' => 'none',
				'condition' => array(
					'date_media_type' => 'image',
				),
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'       => esc_html__( 'Title', 'easyelements' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Project Title', 'easyelements' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'date_media_type' => 'custom',
				),
			)
		);

		$repeater->add_control(
			'date_custom',
			array(
				'label'     => esc_html__( 'Date', 'easyelements' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => gmdate( 'Y-m-d', strtotime( '+ 1 day' ) ),
				'condition' => array(
					'date_media_type' => 'custom',
				),
			)
		);

		$repeater->add_control(
			'content_media_type',
			array(
				'label'       => esc_html__( 'Content Media', 'easyelements' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'separator'   => 'before',
				'options'     => array(
					'none'  => array(
						'title' => esc_html__( 'None', 'easyelements' ),
						'icon'  => 'eicon-ban',
					),
					'image' => array(
						'title' => esc_html__( 'Image', 'easyelements' ),
						'icon'  => 'eicon-image',
					),
				),
				'default'     => 'image',
				'toggle'      => false,
			)
		);

		$repeater->add_control(
			'content_image',
			array(
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'content_media_type' => 'image',
				),
				'dynamic'   => array(
					'active' => true,
				),
			)
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'content_image_thumbnail',
				'default'   => 'large',
				'separator' => 'none',
				'condition' => array(
					'content_media_type' => 'image',
				),
			)
		);

		$repeater->add_control(
			'sub_title',
			array(
				'label'       => esc_html__( 'Title', 'easyelements' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Heading', 'easyelements' ),
				'dynamic'     => array(
					'active' => true,
				),

			)
		);

		$repeater->add_control(
			'description',
			array(
				'label'       => esc_html__( 'Description', 'easyelements' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Type your description here', 'easyelements' ),
				'default'     => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content.', 'easyelements' ),
			)
		);

		$repeater->add_control(
			'bullet_media_type',
			array(
				'label'       => esc_html__( ' Bullet Media', 'easyelements' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'separator'   => 'before',
				'options'     => array(
					'icon'   => array(
						'title' => esc_html__( 'Icon', 'easyelements' ),
						'icon'  => 'eicon-star-o',
					),
					'image'  => array(
						'title' => esc_html__( 'Image', 'easyelements' ),
						'icon'  => 'eicon-image',
					),
					'custom' => array(
						'title' => esc_html__( 'Custom', 'easyelements' ),
						'icon'  => ' eicon-font',
					),
				),
				'default'     => 'icon',
				'toggle'      => false,
			)
		);

		$repeater->add_control(
			'icon',
			array(
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-calendar-alt',
					'library' => 'fa-solid',
				),
				'condition' => array(
					'bullet_media_type' => 'icon',
				),
			)
		);

		$repeater->add_control(
			'image',
			array(
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'bullet_media_type' => 'image',
				),
				'dynamic'   => array(
					'active' => true,
				),
			)
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'bullet_image_thumbnail',
				'default'   => 'large',
				'separator' => 'none',
				'condition' => array(
					'bullet_media_type' => 'image',
				),
			)
		);

		$repeater->add_control(
			'custom',
			array(
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => '1',
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'bullet_media_type' => 'custom',
				),
			)
		);

		$repeater->add_control(
			'inline_style',
			array(
				'label'        => esc_html__( 'Inline Style', 'easyelements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'easyelements' ),
				'label_off'    => esc_html__( 'Hide', 'easyelements' ),
				'return_value' => 'yes',
				'separator'    => 'before',
			)
		);

		$repeater->start_controls_tabs( 'inline_bullet_media_icon' );

		$repeater->start_controls_tab(
			'inline_bullet_media_normal',
			array(
				'label'     => esc_html__( 'Normal', 'easyelements' ),
				'condition' => array(
					'inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'inline_date_bg',
			array(
				'label'     => esc_html__( 'Date Background', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .ele-horizontal-timeline-dates' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'inline_bullet_media_normal_color',
			array(
				'label'     => esc_html__( 'Bullet Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .ele-horizontal-timeline-media > i'                                      => 'color: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} .ele-horizontal-timeline-media > svg'                                      => 'fill: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} .ele-horizontal-timeline-media > .ele-horizontal-timeline-media-custom' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'inline_bullet_media_normal_bg_color',
			array(
				'label'     => esc_html__( 'Bullet Background', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .ele-horizontal-timeline-media' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'inline_bullet_media_separator_color',
			array(
				'label'     => esc_html__( 'Separator Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .ele-horizontal-timeline-dates:before,
					{{WRAPPER}} {{CURRENT_ITEM}} .ele-horizontal-timeline-content-inner:after,
					{{WRAPPER}} {{CURRENT_ITEM}} .ele-horizontal-timeline-media:before,
					{{WRAPPER}} {{CURRENT_ITEM}} .ele-horizontal-timeline-media:after' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'inline_content_bg',
			array(
				'label'     => esc_html__( 'Content Background', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .ele-horizontal-timeline-content-inner' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'inline_style' => 'yes',
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'inline_bullet_media_hover',
			array(
				'label'     => esc_html__( 'Hover', 'easyelements' ),
				'condition' => array(
					'inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'inline_hdate_bg',
			array(
				'label'     => esc_html__( 'Date Background', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover .ele-horizontal-timeline-dates' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'inline_bullet_media_hover_color',
			array(
				'label'     => esc_html__( 'Bullet Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover .ele-horizontal-timeline-media > i,
					{{WRAPPER}} {{CURRENT_ITEM}}:hover .ele-horizontal-timeline-media > svg,
					{{WRAPPER}} {{CURRENT_ITEM}}:hover .ele-horizontal-timeline-media > .ele-horizontal-timeline-media-custom' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'inline_bullet_media_hover_bg_color',
			array(
				'label'     => esc_html__( 'Bullet Background', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover .ele-horizontal-timeline-media' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'inline_bullet_media_separator_hcolor',
			array(
				'label'     => esc_html__( 'Separator Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover .ele-horizontal-timeline-dates:before,
					{{WRAPPER}} {{CURRENT_ITEM}}:hover .ele-horizontal-timeline-content-inner:after,
					{{WRAPPER}} {{CURRENT_ITEM}}:hover .ele-horizontal-timeline-media:before,
					{{WRAPPER}} {{CURRENT_ITEM}}:hover .ele-horizontal-timeline-media:after' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'inline_hcontent_bg',
			array(
				'label'     => esc_html__( 'Content Background', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover .ele-horizontal-timeline-content-inner' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'inline_style' => 'yes',
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'horizontal_timeline_item',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ sub_title }}}',
				'separator'   => 'after',
				'default'     => array(
					array(
						'sub_title'   => esc_html__( 'Step 1', 'easyelements' ),
						'description' => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content.', 'easyelements' ),
					),
					array(
						'sub_title'   => esc_html__( 'Step 2', 'easyelements' ),
						'description' => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content.', 'easyelements' ),
					),
					array(
						'sub_title'   => esc_html__( 'Step 3', 'easyelements' ),
						'description' => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content.', 'easyelements' ),
					),
					array(
						'sub_title'   => esc_html__( 'Step 4', 'easyelements' ),
						'description' => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content.', 'easyelements' ),
					),
				),
			)
		);

		$this->add_control(
			'direction',
			array(
				'label'          => esc_html__( 'Direction', 'easyelements' ),
				'type'           => Controls_Manager::CHOOSE,
				'default'        => 'col',
				'options'        => array(
					'col'         => array(
						'title' => esc_html__( 'Top', 'easyelements' ),
						'icon'  => 'eicon-v-align-top',
					),
					'col-reverse' => array(
						'title' => esc_html__( 'Bottom', 'easyelements' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'style_transfer' => true,
				'toggle'         => false,
			)
		);

		$this->add_control(
			'reverse',
			array(
				'label'              => esc_html__( 'Reverse', 'easyelements' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Show', 'easyelements' ),
				'label_off'          => esc_html__( 'Hide', 'easyelements' ),
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
			)
		);

		$this->add_responsive_control(
			'direction_space_between',
			array(
				'label'      => esc_html__( 'Space Between', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 200,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-horizontal-timeline-item .ele-horizontal-timeline-date,
					{{WRAPPER}} .ele-horizontal-timeline-item .ele-horizontal-timeline-content' => 'padding: 0 {{SIZE}}{{UNIT}} ;',
				),
			)
		);

		$this->add_responsive_control(
			'direction_space_bottom',
			array(
				'label'      => esc_html__( 'Space Bottom', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 200,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-horizontal-timeline-col .ele-horizontal-timeline-item'                                                                                                                 => 'grid-gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-horizontal-timeline-col .ele-horizontal-timeline-dates:before,{{WRAPPER}} .ele-horizontal-timeline-col .ele-horizontal-timeline-content-inner:after'                 => 'height: calc({{SIZE}}{{UNIT}} + 50px);',
					'{{WRAPPER}} .ele-horizontal-timeline-col-reverse .ele-horizontal-timeline-item'                                                                                                         => 'grid-gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-horizontal-timeline-col-reverse .ele-horizontal-timeline-dates:before,{{WRAPPER}} .ele-horizontal-timeline-col-reverse .ele-horizontal-timeline-content-inner:after' => 'height: calc({{SIZE}}{{UNIT}} + 50px);',
				),
			)
		);

		$this->end_controls_section();

		//Carousel Settings Tab
		$this->start_controls_section(
			'section_horiz_timeline_carousel',
			array(
				'label' => esc_html__( 'Settings', 'easyelements' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_responsive_control(
			'item_per_row',
			array(
				'label'              => esc_html__( 'Items To Show', 'easyelements' ),
				'description'        => esc_html__( 'Adjust items to show in a row.', 'easyelements' ),
				'type'               => Controls_Manager::NUMBER,
				'placeholder'        => 2,
				'desktop_default'    => 3,
				'tablet_default'     => 2,
				'mobile_default'     => 1,
				'min'                => 1,
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'loop',
			array(
				'label'              => esc_html__( 'Loop', 'easyelements' ),
				'description'        => esc_html__( 'Duplicate last and first items to get loop illusion.', 'easyelements' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'mouse_drag',
			array(
				'label'              => esc_html__( 'Mouse Drag', 'easyelements' ),
				'description'        => esc_html__( 'Mouse drag enabled.', 'easyelements' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'rtl',
			array(
				'label'              => esc_html__( 'RTL', 'easyelements' ),
				'description'        => esc_html__( 'Change direction from Right to left.', 'easyelements' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
				'selectors'          => array(
					'{{WRAPPER}} .ele-owl-theme.owl-carousel' => 'direction: rtl;',
				),
			)
		);

		$this->add_control(
			'auto_height',
			array(
				'label'              => esc_html__( 'Auto Height', 'easyelements' ),
				'description'        => esc_html__( 'Adaptive its height of the currently active item.', 'easyelements' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'autoplay',
			array(
				'label'              => esc_html__( 'Autoplay', 'easyelements' ),
				'description'        => esc_html__( 'To enable autoplay behaviour.', 'easyelements' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'autoplay_timeout',
			array(
				'label'              => esc_html__( 'Autoplay Timeout', 'easyelements' ),
				'description'        => esc_html__( 'Autoplay interval timeout in seconds(s).', 'easyelements' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 3,
				),
				'range'              => array(
					'px' => array(
						'min' => 1,
						'max' => 10,
					),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'condition'          => array(
					'autoplay' => 'yes',
				),
			)
		);

		$this->add_control(
			'nav',
			array(
				'label'              => esc_html__( 'Show Nav', 'easyelements' ),
				'description'        => esc_html__( 'Show next/prev buttons.', 'easyelements' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
				'default'            => 'yes',
			)
		);

		$this->add_control(
			'dots',
			array(
				'label'              => esc_html__( 'Show Dots', 'easyelements' ),
				'description'        => esc_html__( 'Show dots navigation.', 'easyelements' ),
				'type'               => Controls_Manager::SWITCHER,
				'return_value'       => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->end_controls_section();

		//Date & Time
		$this->start_controls_section(
			'section_media_style',
			array(
				'label' => esc_html__( 'Date', 'easyelements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs( 'date_styling_tabs' );

		$this->start_controls_tab(
			'date_normal',
			array(
				'label' => esc_html__( 'Normal', 'easyelements' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'media_media_background',
				'label'    => esc_html__( 'Background', 'easyelements' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .ele-horizontal-timeline-dates',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'media_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'easyelements' ),
				'selector' => '{{WRAPPER}} .ele-horizontal-timeline-dates',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'date_hover',
			array(
				'label' => esc_html__( 'Hover', 'easyelements' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'media_media_background_hover',
				'label'    => esc_html__( 'Background', 'easyelements' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .ele-horizontal-timeline-item:hover .ele-horizontal-timeline-dates',
			)
		);

		$this->add_control(
			'media_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-horizontal-timeline-item:hover .ele-horizontal-timeline-dates' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'media_border',
				'label'    => esc_html__( 'Border', 'easyelements' ),
				'selector' => '{{WRAPPER}} .ele-horizontal-timeline-dates',
			)
		);

		$this->add_responsive_control(
			'media_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-horizontal-timeline-dates' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'media_padding',
			array(
				'label'      => esc_html__( 'Padding', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-horizontal-timeline-dates' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'media_title_options',
			array(
				'label'     => esc_html__( 'Title', 'easyelements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'media_title_typography',
				'label'    => esc_html__( 'Typography', 'easyelements' ),
				'selector' => '{{WRAPPER}} .ele-horizontal-timeline-title',
			)
		);

		$this->add_control(
			'media_title_color',
			array(
				'label'     => esc_html__( 'Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .ele-horizontal-timeline-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'media_title_hcolor',
			array(
				'label'     => esc_html__( 'Hover', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .ele-horizontal-timeline-item:hover .ele-horizontal-timeline-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'media_title_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-horizontal-timeline-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'media_date_options',
			array(
				'label'     => esc_html__( 'Date', 'easyelements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'media_date_typography',
				'label'    => esc_html__( 'Typography', 'easyelements' ),
				'selector' => '{{WRAPPER}} .ele-horizontal-timeline-time',
			)
		);

		$this->add_control(
			'media_date_color',
			array(
				'label'     => esc_html__( 'Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .ele-horizontal-timeline-time,{{WRAPPER}} .ele-horizontal-timeline-content-time' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'media_date_hcolor',
			array(
				'label'     => esc_html__( 'Hover', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .ele-horizontal-timeline-item:hover .ele-horizontal-timeline-time' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'media_date_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-horizontal-timeline-time' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'media_image_options',
			array(
				'label'     => esc_html__( 'Image', 'easyelements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'media_image_width',
			array(
				'label'      => esc_html__( 'Width', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 1000,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 100,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-horizontal-timeline-inner .ele-horizontal-timeline-dates > img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'media_image_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-horizontal-timeline-inner .ele-horizontal-timeline-dates > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// Bullet Media
		$this->start_controls_section(
			'section_bullet_media_style',
			array(
				'label' => esc_html__( 'Bullet', 'easyelements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'bullet_media_size',
			array(
				'label'      => esc_html__( 'Size', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-horizontal-timeline-media > i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-horizontal-timeline-media > img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-horizontal-timeline-media > svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				),
			)
		);

		$this->add_responsive_control(
			'bullet_media_bg_size',
			array(
				'label'      => esc_html__( 'Background Size', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 1000,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-horizontal-timeline-media' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'bullet_media_icon' );

		$this->start_controls_tab(
			'bullet_media_normal',
			array(
				'label' => esc_html__( 'Normal', 'easyelements' ),
			)
		);

		$this->add_control(
			'bullet_media_normal_color',
			array(
				'label'     => esc_html__( 'Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-horizontal-timeline-media > i'                                      => 'color: {{VALUE}};',
					'{{WRAPPER}} .ele-horizontal-timeline-media > svg'                                      => 'fill: {{VALUE}};',
					'{{WRAPPER}} .ele-horizontal-timeline-media > .ele-horizontal-timeline-media-custom' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'bullet_media_normal_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-horizontal-timeline-media' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'bullet_media_separator_color',
			array(
				'label'     => esc_html__( 'Separator Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => array(
					'{{WRAPPER}} .ele-horizontal-timeline-dates:before,
					{{WRAPPER}} .ele-horizontal-timeline-content-inner:after,
					{{WRAPPER}} .ele-horizontal-timeline-media:before,
					{{WRAPPER}} .ele-horizontal-timeline-media:after' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'divider_line_color',
			array(
				'label'     => esc_html__( 'Divider Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => array(
					'{{WRAPPER}} .ele-horizontal-timeline-bullet-line' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'bullet_media_hover',
			array(
				'label' => esc_html__( 'Hover', 'easyelements' ),
			)
		);

		$this->add_control(
			'bullet_media_hover_color',
			array(
				'label'     => esc_html__( 'Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-horizontal-timeline-item:hover .ele-horizontal-timeline-media > i,
					{{WRAPPER}} .ele-horizontal-timeline-item:hover .ele-horizontal-timeline-media > svg,
					{{WRAPPER}} .ele-horizontal-timeline-item:hover .ele-horizontal-timeline-media > .ele-horizontal-timeline-media-custom' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'bullet_media_hover_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-horizontal-timeline-item:hover .ele-horizontal-timeline-media' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'bullet_media_separator_hcolor',
			array(
				'label'     => esc_html__( 'Separator Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => array(
					'{{WRAPPER}} .ele-horizontal-timeline-item:hover .ele-horizontal-timeline-dates:before,
					{{WRAPPER}} .ele-horizontal-timeline-item:hover .ele-horizontal-timeline-content-inner:after,
					{{WRAPPER}} .ele-horizontal-timeline-item:hover .ele-horizontal-timeline-media:before,
					{{WRAPPER}} .ele-horizontal-timeline-item:hover .ele-horizontal-timeline-media:after' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'bullet_media_hover_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-horizontal-timeline-item:hover .ele-horizontal-timeline-media' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'bullet_media_border',
				'separator' => 'before',
				'label'     => esc_html__( 'Border', 'easyelements' ),
				'selector'  => '{{WRAPPER}} .ele-horizontal-timeline-media',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'bullet_media_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'easyelements' ),
				'selector' => '{{WRAPPER}} .ele-horizontal-timeline-media',
			)
		);

		$this->add_responsive_control(
			'bullet_media_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-horizontal-timeline-media' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'bullet_media_custom_options',
			array(
				'label'     => esc_html__( 'Custom', 'easyelements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'bullet_media_custom_typography',
				'label'    => esc_html__( 'Typography', 'easyelements' ),
				'selector' => '{{WRAPPER}} .ele-horizontal-timeline-media > .ele-horizontal-timeline-media-custom',
			)
		);

		$this->end_controls_section();

		//Content Styling
		$this->start_controls_section(
			'section_general_style_content',
			array(
				'label' => esc_html__( 'Content', 'easyelements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'content_alignment',
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
					'{{WRAPPER}} .ele-horizontal-timeline-content-inner' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_width',
			array(
				'label'      => esc_html__( 'Width', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-horizontal-timeline-content-inner' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'content_styling_tabs' );

		$this->start_controls_tab(
			'content_normal',
			array(
				'label' => esc_html__( 'Normal', 'easyelements' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'content_background',
				'label'    => esc_html__( 'Background', 'easyelements' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .ele-horizontal-timeline-content-inner',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'content_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'easyelements' ),
				'selector' => '{{WRAPPER}} .ele-horizontal-timeline-content-inner',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'content_hover',
			array(
				'label' => esc_html__( 'Hover', 'easyelements' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'content_background_hover',
				'label'    => esc_html__( 'Background', 'easyelements' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .ele-horizontal-timeline-item:hover .ele-horizontal-timeline-content-inner',
			)
		);

		$this->add_control(
			'content_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-horizontal-timeline-item:hover .ele-horizontal-timeline-content-inner' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'content_border',
				'separator' => 'before',
				'label'     => esc_html__( 'Border', 'easyelements' ),
				'selector'  => '{{WRAPPER}} .ele-horizontal-timeline-content-inner',
			)
		);

		$this->add_responsive_control(
			'content_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-horizontal-timeline-content-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .ele-horizontal-timeline-content-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'content_image_heading',
			array(
				'label'     => esc_html__( 'Image', 'easyelements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'inline',
			array(
				'label'       => esc_html__( 'Layout', 'easyelements' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default'     => 'inline-block',
				'options'     => array(
					'inline-flex'  => array(
						'title' => esc_html__( 'Inline', 'easyelements' ),
						'icon'  => 'eicon-editor-list-ul',
					),
					'inline-block' => array(
						'title' => esc_html__( 'Block', 'easyelements' ),
						'icon'  => 'eicon-ellipsis-h',
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} .ele-horizontal-timeline-content-inner' => 'display: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_media_size',
			array(
				'label'      => esc_html__( 'Size', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 1000,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-horizontal-timeline-content-inner .ele-horizontal-timeline-content-media > img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				),

			)
		);

		$this->add_responsive_control(
			'content_media_space_between',
			array(
				'label'      => esc_html__( 'Space Between', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-horizontal-timeline-content-inner'                                               => 'grid-gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-horizontal-timeline-content-inner .ele-horizontal-timeline-content-media > img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_media_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-horizontal-timeline-content-inner .ele-horizontal-timeline-content-media > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'content_title_heading',
			array(
				'label'     => esc_html__( 'Title', 'easyelements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_title_typography',
				'label'    => esc_html__( 'Typography', 'easyelements' ),
				'selector' => '{{WRAPPER}} .ele-horizontal-timeline-sub-title',
			)
		);

		$this->add_control(
			'content_title_color',
			array(
				'label'     => esc_html__( 'Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-horizontal-timeline-sub-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'content_title_hover',
			array(
				'label'     => esc_html__( 'Hover', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-horizontal-timeline-item:hover .ele-horizontal-timeline-sub-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'content_title_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-horizontal-timeline-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'content_description_heading',
			array(
				'label'     => esc_html__( 'Description', 'easyelements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_desc_typography',
				'label'    => esc_html__( 'Typography', 'easyelements' ),
				'selector' => '{{WRAPPER}} .ele-horizontal-timeline-text',
			)
		);

		$this->add_control(
			'content_desc_color',
			array(
				'label'     => esc_html__( 'Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-horizontal-timeline-text' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'content_desc_hover',
			array(
				'label'     => esc_html__( 'Hover', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-horizontal-timeline-item:hover .ele-horizontal-timeline-text' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'content_desc_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-horizontal-timeline-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Nav Style
		$this->start_controls_section(
			'section_horizontal_timeline_nav_style',
			array(
				'label'     => esc_html__( 'Nav', 'easyelements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'nav' => 'yes',
				),
			)
		);

		$this->add_control(
			'nav_layout',
			array(
				'label'   => esc_html__( 'Layout', 'easyelements' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'style-1' => esc_html__( 'Style 1', 'easyelements' ),
					'style-2' => esc_html__( 'Style 2', 'easyelements' ),
					'style-3' => esc_html__( 'Style 3', 'easyelements' ),
					'style-4' => esc_html__( 'Style 4', 'easyelements' ),
					'style-5' => esc_html__( 'Style 5', 'easyelements' ),
					'style-6' => esc_html__( 'Style 6', 'easyelements' ),
					'style-7' => esc_html__( 'Style 7', 'easyelements' ),
				),
				'default' => 'style-1',
			)
		);

		$this->add_responsive_control(
			'nav_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 16,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-nav button.owl-prev,
					 {{WRAPPER}} .ele-owl-theme.owl-carousel .owl-nav button.owl-next' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'nav_bg_size',
			array(
				'label'      => esc_html__( 'Background Size', 'easyelements' ),
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
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-nav button.owl-prev,
					 {{WRAPPER}} .ele-owl-theme.owl-carousel .owl-nav button.owl-next' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'nav_offset_y',
			array(
				'label'      => esc_html__( 'Offset Y', 'easyelements' ),
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
				'selectors'  => array(
					'{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-nav button.owl-prev,
					{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-nav button.owl-next' => 'top: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'reverse!' => 'yes',
				),
			)
		);

		$this->start_controls_tabs(
			'news_ticker_nav_style_tabs'
		);

		$this->start_controls_tab(
			'news_ticker_nav_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'easyelements' ),
			)
		);

		$this->add_control(
			'nav_color',
			array(
				'label'     => esc_html__( 'Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-nav button.owl-prev,
					{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-nav button.owl-next' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_bg_color',
			array(
				'label'     => esc_html__( 'Background', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => array(
					'{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-nav button.owl-prev,
					{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-nav button.owl-next' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'news_ticker_nav_hover_tab_style',
			array(
				'label' => esc_html__( 'Hover', 'easyelements' ),
			)
		);

		$this->add_control(
			'nav_hover_color',
			array(
				'label'     => esc_html__( 'Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-nav button.owl-prev:hover,
					{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-nav button.owl-next' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_hover_bg',
			array(
				'label'     => esc_html__( 'Background', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'selectors' => array(
					'{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-nav button.owl-prev:hover,
					 {{WRAPPER}} .ele-owl-theme.owl-carousel .owl-nav button.owl-next:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'nav_hover_border',
			array(
				'label'     => esc_html__( 'Border', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-nav button.owl-prev:hover,
					{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-nav button.owl-next:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'nav_border',
				'label'     => esc_html__( 'Border', 'easyelements' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-nav button.owl-prev,
				{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-nav button.owl-next',
			)
		);

		$this->add_responsive_control(
			'nav_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-nav button.owl-prev, 
					{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-nav button.owl-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Dots Styling
		$this->start_controls_section(
			'timeline_dots_styling',
			array(
				'label'     => esc_html__( 'Dots', 'easyelements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'dots' => 'yes',
				),
			)
		);

		$this->add_control(
			'dots_layout',
			array(
				'label'   => esc_html__( 'Layout', 'easyelements' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'style-1' => esc_html__( 'Style 1', 'easyelements' ),
					'style-2' => esc_html__( 'Style 2', 'easyelements' ),
					'style-3' => esc_html__( 'Style 3', 'easyelements' ),
				),
				'default' => 'style-1',
			)
		);

		$this->add_responsive_control(
			'dots_bg_height',
			array(
				'label'      => esc_html__( 'Height', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 12,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-dot' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'dots_bg_width',
			array(
				'label'      => esc_html__( 'Width', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 12,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-dot'  => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-owl-dots-horizontal-style-2.owl-carousel .owl-dot.active' => 'width: calc({{SIZE}}{{UNIT}} * 2);',
				),
			)
		);

		$this->add_responsive_control(
			'dots_space_between',
			array(
				'label'      => esc_html__( 'Space Between', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 5,
				),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 20,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-dot' => 'margin: 0 {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'dots_space',
			array(
				'label'      => esc_html__( 'Spacing', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 20,
				),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-dots' => 'bottom: -{{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->start_controls_tabs(
			'horiz_timeline_dots_style_tabs'
		);

		$this->start_controls_tab(
			'horiz_timeline_dots_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'easyelements' ),
			)
		);

		$this->add_control(
			'dots_bg_color',
			array(
				'label'     => esc_html__( 'Background', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-dot' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'horiz_timeline_dots_active_tab_style',
			array(
				'label' => esc_html__( 'Active', 'easyelements' ),
			)
		);

		$this->add_control(
			'dots_hover_bg',
			array(
				'label'     => esc_html__( 'Background', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-dot.active' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'dots_hover_border',
			array(
				'label'     => esc_html__( 'Border', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-dot.active' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'dots_border',
				'label'     => esc_html__( 'Border', 'easyelements' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-dot',
			)
		);

		$this->add_responsive_control(
			'dots_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-owl-theme.owl-carousel .owl-dot' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		require ELE_WIDGET_ASSETS_PATH . 'horizontal-timeline/layout/frontend.php';

	}

}
