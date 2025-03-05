<?php

namespace EasyElements\Elementor_Widgets\Team;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use EasyElements\Control\Group_Control_Foreground;
use EasyElements\Control\Image_Selector;

class Team extends Widget_Base {

	public function get_name() {
		return 'ele-team';
	}

	public function get_title() {
		return esc_html__( 'Team', 'easyelements' );
	}

	public function get_icon() {
		return 'ele ele-team-member ele-widget-icon';
	}

	public function get_categories() {
		return array( 'easyelements' );
	}

    public function get_keywords() {
        return array( 'team', 'staff', 'members','grid', 'employees', 'profiles', 'directory', 'roster', 'personnel', 'bios', 'group' );
    }

	protected function register_controls() {

		$this->start_controls_section(
			'section_general',
			array(
				'label' => esc_html__( 'General', 'easyelements' ),
			)
		);

		$this->add_control(
			'layout',
			array(
				'label'              => esc_html__( 'Layout', 'easyelements' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => '1',
				'options'            => array(
					'1'  => esc_html__( 'Style 1', 'easyelements' ),
					'2'  => esc_html__( 'Style 2', 'easyelements' ),
					'3'  => esc_html__( 'Style 3', 'easyelements' ),
					'4'  => esc_html__( 'Style 4', 'easyelements' ),
					'5'  => esc_html__( 'Style 5', 'easyelements' ),
					'6'  => esc_html__( 'Style 6', 'easyelements' ),
					'7'  => esc_html__( 'Style 7', 'easyelements' ),
					'8'  => esc_html__( 'Style 8', 'easyelements' ),
					'9'  => esc_html__( 'Style 9', 'easyelements' ),
					'10' => esc_html__( 'Style 10', 'easyelements' ),
					'11' => esc_html__( 'Style 11', 'easyelements' ),
					'12' => esc_html__( 'Style 12', 'easyelements' ),
					'13' => esc_html__( 'Style 13', 'easyelements' ),
					'14' => esc_html__( 'Style 14', 'easyelements' ),
					'15' => esc_html__( 'Style 15', 'easyelements' ),
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'image',
			array(
				'label'   => esc_html__( 'Choose Image', 'easyelements' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array(
					'active' => true,
				),
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'mask_image',
			array(
				'label'        => esc_html__( 'Mask Image', 'easyelements' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => esc_html__( 'Default', 'easyelements' ),
				'label_on'     => esc_html__( 'Custom', 'easyelements' ),
				'return_value' => 'yes',
			)
		);

		$this->start_popover();

		$this->add_control(
			'mask_shape',
			array(
				'label'   => esc_html__( 'Mask Type', 'easyelements' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'default',
				'options' => array(
					'default' => array(
						'title' => _x( 'Default Shapes', 'Mask Image', 'easyelements' ),
						'icon'  => 'eicon-image-bold',
					),
					'custom'  => array(
						'title' => _x( 'Custom Shape', 'Mask Image', 'easyelements' ),
						'icon'  => 'eicon-upload',
					),
				),
				'toggle'  => false,
			)
		);

		$this->add_control(
			'mask_shape_default',
			array(
				'label'                => _x( 'Default', 'Mask Image', 'easyelements' ),
				'label_block'          => true,
				'show_label'           => false,
				'type'                 => Image_Selector::TYPE,
				'default'              => 'shape1',
				'options'              => ele_elementor_masking_shape_list( 'list' ),
				'selectors'            => array(
					'{{WRAPPER}} .ele-team-image > img' => '-webkit-mask-image: url({{VALUE}}); mask-image: url({{VALUE}});',
				),
				'selectors_dictionary' => ele_elementor_masking_shape_list( 'url' ),
				'condition'            => array(
					'mask_image' => 'yes',
					'mask_shape' => 'default',
				),
			)
		);

		$this->add_control(
			'mask_custom_shape',
			array(
				'label'       => _x( 'Custom Shape', 'Mask Image', 'easyelements' ),
				'type'        => Controls_Manager::MEDIA,
				'show_label'  => false,
				'description' => sprintf(
				/* translators: %s: Title */
					esc_html__( 'Note: Make sure svg support is enable to upload svg file. %1$sRead More%2$s', 'easyelements' ),
					'<a href="https://elementor.com/help/enable-svg-support-in-elementor/" target="_blank">',
					'</a>'
				),
				'selectors'   => array(
					'{{WRAPPER}} .ele-team-image > img' => '-webkit-mask-image: url({{URL}}); mask-image: url({{URL}});',
				),
				'condition'   => array(
					'mask_image' => 'yes',
					'mask_shape' => 'custom',
				),
			)
		);

		$this->add_control(
			'mask_position',
			array(
				'label'                => _x( 'Position', 'Mask Image', 'easyelements' ),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'center-center',
				'options'              => array(
					'center-center' => _x( 'Center Center', 'Mask Image', 'easyelements' ),
					'center-left'   => _x( 'Center Left', 'Mask Image', 'easyelements' ),
					'center-right'  => _x( 'Center Right', 'Mask Image', 'easyelements' ),
					'top-center'    => _x( 'Top Center', 'Mask Image', 'easyelements' ),
					'top-left'      => _x( 'Top Left', 'Mask Image', 'easyelements' ),
					'top-right'     => _x( 'Top Right', 'Mask Image', 'easyelements' ),
					'bottom-center' => _x( 'Bottom Center', 'Mask Image', 'easyelements' ),
					'bottom-left'   => _x( 'Bottom Left', 'Mask Image', 'easyelements' ),
					'bottom-right'  => _x( 'Bottom Right', 'Mask Image', 'easyelements' ),
				),
				'selectors_dictionary' => array(
					'center-center' => 'center center',
					'center-left'   => 'center left',
					'center-right'  => 'center right',
					'top-center'    => 'top center',
					'top-left'      => 'top left',
					'top-right'     => 'top right',
					'bottom-center' => 'bottom center',
					'bottom-left'   => 'bottom left',
					'bottom-right'  => 'bottom right',
				),
				'selectors'            => array(
					'{{WRAPPER}} .ele-team-image > img' => '-webkit-mask-position: {{VALUE}}; mask-position: {{VALUE}};',
				),
				'condition'            => array(
					'mask_image' => 'yes',
				),
			)
		);

		$this->add_control(
			'mask_size',
			array(
				'label'     => _x( 'Size', 'Mask Image', 'easyelements' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'contain',
				'options'   => array(
					'auto'    => _x( 'Auto', 'Mask Image', 'easyelements' ),
					'cover'   => _x( 'Cover', 'Mask Image', 'easyelements' ),
					'contain' => _x( 'Contain', 'Mask Image', 'easyelements' ),
					'initial' => _x( 'Custom', 'Mask Image', 'easyelements' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .ele-team-image > img' => '-webkit-mask-size: {{VALUE}}; mask-size: {{VALUE}};',
				),
				'condition' => array(
					'mask_image' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'mask_custom_size',
			array(
				'label'      => _x( 'Custom Size', 'Mask Image', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', '%', 'vw' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
					'em' => array(
						'min' => 0,
						'max' => 100,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
					'vw' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'size' => 100,
					'unit' => '%',
				),
				'required'   => true,
				'selectors'  => array(
					'{{WRAPPER}} .ele-team-image > img' => '-webkit-mask-size: {{SIZE}}{{UNIT}}; mask-size: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'mask_image' => 'yes',
					'mask_size'  => 'initial',
				),
			)
		);

		$this->add_control(
			'mask_repeat',
			array(
				'label'                => _x( 'Repeat', 'Mask Image', 'easyelements' ),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'no-repeat',
				'options'              => array(
					'repeat'          => _x( 'Repeat', 'Mask Image', 'easyelements' ),
					'repeat-x'        => _x( 'Repeat-x', 'Mask Image', 'easyelements' ),
					'repeat-y'        => _x( 'Repeat-y', 'Mask Image', 'easyelements' ),
					'space'           => _x( 'Space', 'Mask Image', 'easyelements' ),
					'round'           => _x( 'Round', 'Mask Image', 'easyelements' ),
					'no-repeat'       => _x( 'No-repeat', 'Mask Image', 'easyelements' ),
					'repeat-space'    => _x( 'Repeat Space', 'Mask Image', 'easyelements' ),
					'round-space'     => _x( 'Round Space', 'Mask Image', 'easyelements' ),
					'no-repeat-round' => _x( 'No-repeat Round', 'Mask Image', 'easyelements' ),
				),
				'selectors_dictionary' => array(
					'repeat'          => 'repeat',
					'repeat-x'        => 'repeat-x',
					'repeat-y'        => 'repeat-y',
					'space'           => 'space',
					'round'           => 'round',
					'no-repeat'       => 'no-repeat',
					'repeat-space'    => 'repeat space',
					'round-space'     => 'round space',
					'no-repeat-round' => 'no-repeat round',
				),
				'selectors'            => array(
					'{{WRAPPER}} .ele-team-image > img' => '-webkit-mask-repeat: {{VALUE}}; mask-repeat: {{VALUE}};',
				),
				'condition'            => array(
					'mask_image' => 'yes',
				),
			)
		);

		$this->end_popover();

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'thumbnail',
				'default'   => 'large',
				'separator' => 'none',
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => esc_html__( 'Name', 'easyelements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Jhon Walker', 'easyelements' ),
				'label_block' => true,
				'separator'   => 'before',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'title_link',
			array(
				'label'       => esc_html__( 'Link', 'easyelements' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://example.com',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'designation',
			array(
				'label'       => esc_html__( 'Designation', 'easyelements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Managing Director', 'easyelements' ),
				'label_block' => true,
				'separator'   => 'before',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => esc_html__( 'Description', 'easyelements' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'It is a long established fact that a reader will be distracted by the content.', 'easyelements' ),
				'placeholder' => esc_html__( 'Type your description here', 'easyelements' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'align',
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
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .ele-team-wrapper' => 'text-align: {{VALUE}};',
				),
				'condition' => array(
					'layout!' => array( '8', '9' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_social',
			array(
				'label' => esc_html__( 'Social', 'easyelements' ),
			)
		);

		$this->add_control(
			'social_enable',
			array(
				'label'        => esc_html__( 'Enable', 'easyelements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'easyelements' ),
				'label_off'    => esc_html__( 'Hide', 'easyelements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'social_icon',
			array(
				'label'   => esc_html__( 'Icon', 'easyelements' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fab fa-wordpress',
					'library' => 'fa-brands',
				),
			)
		);

		$repeater->add_control(
			'icon_link',
			array(
				'label'       => esc_html__( 'Link', 'easyelements' ),
				'type'        => Controls_Manager::URL,
				'default'     => array(
					'is_external' => 'true',
				),
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( 'https://your-link.com', 'easyelements' ),
			)
		);

		$repeater->add_control(
			'icon_inline_style',
			array(
				'label'        => esc_html__( 'Inline Style', 'easyelements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'easyelements' ),
				'label_off'    => esc_html__( 'Hide', 'easyelements' ),
				'return_value' => 'yes',
			)
		);

		$repeater->start_controls_tabs( 'icon_inline_style_tab' );

		$repeater->start_controls_tab(
			'icon_inline_normal',
			array(
				'label'     => esc_html__( 'Normal', 'easyelements' ),
				'condition' => array(
					'icon_inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'icon_inline_color',
			array(
				'label'     => esc_html__( 'Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .ele-team-social-list {{CURRENT_ITEM}} .ele-team-social-icon > i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .ele-team-social-list {{CURRENT_ITEM}} .ele-team-social-icon > svg' => 'fill: {{VALUE}};',
				),
				'condition' => array(
					'icon_inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'icon_inline_bg',
			array(
				'label'     => esc_html__( 'Background', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .ele-team-social-list {{CURRENT_ITEM}} .ele-team-social-icon' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'icon_inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'icon_inline_border',
			array(
				'label'     => esc_html__( 'Border Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .ele-team-social-list {{CURRENT_ITEM}} .ele-team-social-icon' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'icon_inline_style' => 'yes',
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'icon_inline_hover',
			array(
				'label'     => esc_html__( 'Hover', 'easyelements' ),
				'condition' => array(
					'icon_inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'icon_inline_hover_color',
			array(
				'label'     => esc_html__( 'Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-team-social-list {{CURRENT_ITEM}} .ele-team-social-icon:hover > i, {{WRAPPER}} .ele-team-social-list {{CURRENT_ITEM}} .ele-team-social-icon:focus > i'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .ele-team-social-list {{CURRENT_ITEM}} .ele-team-social-icon:hover > svg, {{WRAPPER}} .ele-team-social-list {{CURRENT_ITEM}} .ele-team-social-icon:focus > svg' => 'fill: {{VALUE}};',
				),
				'condition' => array(
					'icon_inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'icon_inline_hover_bg',
			array(
				'label'     => esc_html__( 'Background', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-team-social-list {{CURRENT_ITEM}} .ele-team-social-icon:hover, {{WRAPPER}} .ele-team-social-list {{CURRENT_ITEM}} .ele-team-social-icon:focus' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'icon_inline_style' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'icon_inline_border_hcolor',
			array(
				'label'     => esc_html__( 'Border Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-team-social-list {{CURRENT_ITEM}} .ele-team-social-icon:hover, {{WRAPPER}} .ele-team-social-list {{CURRENT_ITEM}} .ele-team-social-icon:focus' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'icon_inline_style' => 'yes',
				),
			)
		);

		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();

		$this->add_control(
			'social_icon_list',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'social_icon' => array(
							'value'   => 'fab fa-facebook-f',
							'library' => 'fa-brands',
						),
					),
					array(
						'social_icon' => array(
							'value'   => 'fab fa-twitter',
							'library' => 'fa-brands',
						),
					),
					array(
						'social_icon' => array(
							'value'   => 'fab fa-instagram',
							'library' => 'fa-brands',
						),
					),
				),
				'title_field' => '<# var migrated = "undefined" !== typeof __fa4_migrated, social = ( "undefined" === typeof social ) ? false : social; #>{{{ elementor.helpers.getSocialNetworkNameFromIcon( social_icon, social, true, migrated, true ) }}}',
				'condition'   => array(
					'social_enable' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		//Styling
		$this->start_controls_section(
			'section_image_style',
			array(
				'label' => esc_html__( 'Image', 'easyelements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'width',
			array(
				'label'      => esc_html__( 'Width', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'unit' => 'px',
				),
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-team-wrapper .ele-team-image > img' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'height',
			array(
				'label'          => esc_html__( 'Height', 'easyelements' ),
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
						'min' => 0,
						'max' => 1000,
					),
				),
				'selectors'      => array(
					'{{WRAPPER}} .ele-team-wrapper .ele-team-image > img' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'object-fit',
			array(
				'label'     => esc_html__( 'Object Fit', 'easyelements' ),
				'type'      => Controls_Manager::SELECT,
				'condition' => array(
					'height[size]!' => '',
				),
				'options'   => array(
					''        => esc_html__( 'Default', 'easyelements' ),
					'fill'    => esc_html__( 'Fill', 'easyelements' ),
					'cover'   => esc_html__( 'Cover', 'easyelements' ),
					'contain' => esc_html__( 'Contain', 'easyelements' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .ele-team-wrapper .ele-team-image > img' => 'object-fit: {{VALUE}};',
				),
			)
		);

		$this->start_controls_tabs( 'image_effects' );

		$this->start_controls_tab(
			'normal',
			array(
				'label' => esc_html__( 'Normal', 'easyelements' ),
			)
		);

		$this->add_control(
			'shape_color',
			array(
				'label'     => esc_html__( 'Shape Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-team-layout-13::after' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'layout' => array( '13' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'css_filters',
				'selector' => '{{WRAPPER}} .ele-team-wrapper .ele-team-image img',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'hover',
			array(
				'label' => esc_html__( 'Hover', 'easyelements' ),
			)
		);

		$this->add_control(
			'image_overlay',
			array(
				'label'     => esc_html__( 'Overlay Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-team-layout-5 .ele-team-image::before, {{WRAPPER}} .ele-team-layout-12 .ele-team-image::after' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'layout' => array( '5', '12' ),
				),
			)
		);

		$this->add_control(
			'shape_hcolor',
			array(
				'label'     => esc_html__( 'Shape Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-team-layout-13:hover::after' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'layout' => array( '13' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .ele-team-wrapper:hover .ele-team-image img',
			)
		);

		$this->add_control(
			'background_hover_transition',
			array(
				'label'     => esc_html__( 'Transition Duration', 'easyelements' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 3,
						'step' => 0.1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .ele-team-wrapper .ele-team-image img' => 'transition-duration: {{SIZE}}s',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'image_border',
				'selector'  => '{{WRAPPER}} .ele-team-wrapper .ele-team-image > img',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_box_shadow',
				'exclude'  => array(
					'box_shadow_position',
				),
				'selector' => '{{WRAPPER}} .ele-team-wrapper .ele-team-image > img',
			)
		);

		$this->add_responsive_control(
			'image_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-team-wrapper .ele-team-image,{{WRAPPER}} .ele-team-wrapper .ele-team-image > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_padding',
			array(
				'label'      => esc_html__( 'Padding', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-team-wrapper .ele-team-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => '9',
				),
			)
		);

		$this->add_responsive_control(
			'image_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-team-wrapper .ele-team-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Content
		$this->start_controls_section(
			'section_content_style',
			array(
				'label' => esc_html__( 'Content', 'easyelements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'content_height',
			array(
				'label'      => esc_html__( 'Height', 'easyelements' ),
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
					'{{WRAPPER}} .ele-team-layout-6 .ele-team-content' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => '6',
				),
			)
		);

		$this->add_control(
			'content_backdrop_blur',
			array(
				'label'     => esc_html__( 'Backdrop Blur', 'easyelements' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
				),
				'default'   => array(
					'size' => 3,
				),
				'selectors' => array(
					'{{WRAPPER}} .ele-team-layout-6 .ele-team-content:before' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
				),
				'condition' => array(
					'layout' => '6',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'content_background',
				'label'     => esc_html__( 'Background', 'easyelements' ),
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'selector'  => '{{WRAPPER}} .ele-team-wrapper .ele-team-content,{{WRAPPER}} .ele-team-layout-9 .ele-team-inner-content',
				'condition' => array(
					'layout!' => array( '15' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'content_border',
				'selector' => '{{WRAPPER}} .ele-team-wrapper .ele-team-content',
			)
		);

		$this->add_responsive_control(
			'content_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-team-wrapper .ele-team-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'separator_color',
			array(
				'label'     => esc_html__( 'Separator Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-team-layout-9 .ele-team-description::before' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'layout' => '9',
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
					'{{WRAPPER}} .ele-team-wrapper .ele-team-content,{{WRAPPER}} .ele-team-layout-9 .ele-team-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'heading_title',
			array(
				'label'     => esc_html__( 'Title', 'easyelements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'title!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Foreground::get_type(),
			array(
				'name'      => 'title_color',
				'label'     => esc_html__( 'Title Color', 'easyelements' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .ele-team-wrapper .ele-team-title',
				'condition' => array(
					'title!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'title_typography',
				'label'     => esc_html__( 'Typography', 'easyelements' ),
				'selector'  => '{{WRAPPER}} .ele-team-wrapper .ele-team-title',
				'condition' => array(
					'title!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-team-wrapper .ele-team-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'title!' => '',
				),
			)
		);

		$this->add_control(
			'heading_designation',
			array(
				'label'     => esc_html__( 'Designation', 'easyelements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'designation!' => '',
				),
			)
		);

		$this->add_control(
			'designation_color',
			array(
				'label'     => esc_html__( 'Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-team-wrapper .ele-team-designation' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'designation!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'designation_typography',
				'label'     => esc_html__( 'Typography', 'easyelements' ),
				'selector'  => '{{WRAPPER}} .ele-team-wrapper .ele-team-designation',
				'condition' => array(
					'designation!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'designation_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-team-wrapper .ele-team-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'designation!' => '',
				),
			)
		);

		$this->add_control(
			'heading_description',
			array(
				'label'     => esc_html__( 'Description', 'easyelements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'description!' => '',
				),
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => esc_html__( 'Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-team-wrapper .ele-team-description' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'description!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'description_typography',
				'label'     => esc_html__( 'Typography', 'easyelements' ),
				'selector'  => '{{WRAPPER}} .ele-team-wrapper .ele-team-description',
				'condition' => array(
					'description!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'description_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-team-wrapper .ele-team-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'description!' => '',
				),
			)
		);

		$this->end_controls_section();

		// Social Icon
		$this->start_controls_section(
			'section_social_icon_style',
			array(
				'label'     => esc_html__( 'Social', 'easyelements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'social_enable' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'      => esc_html__( 'Size', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 50,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-team-social-list .ele-team-social-icon > i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-team-social-list .ele-team-social-icon > svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_bg_size',
			array(
				'label'      => esc_html__( 'Background Size', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-team-social-list .ele-team-social-icon' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_space',
			array(
				'label'      => esc_html__( 'Space Between', 'easyelements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => - 100,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-team-wrapper .ele-team-social-list > li'                       => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-team-layout-9 .ele-team-social-list > li,
					 {{WRAPPER}} .ele-team-layout-13 .ele-team-social-list > li,
					 {{WRAPPER}} .ele-team-layout-15 .ele-team-social-list > li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'social_icon_style' );

		$this->start_controls_tab(
			'icon_normal',
			array(
				'label' => esc_html__( 'Normal', 'easyelements' ),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .ele-team-social-list .ele-team-social-icon > i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .ele-team-social-list .ele-team-social-icon > svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_bg',
			array(
				'label'     => esc_html__( 'Background Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .ele-team-social-list .ele-team-social-icon' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_wrapper_bg',
			array(
				'label'     => esc_html__( 'Wrapper Background', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .ele-team-layout-15 .ele-team-social-list' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'layout' => array( '15' ),
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_hover',
			array(
				'label' => esc_html__( 'Hover', 'easyelements' ),
			)
		);

		$this->add_control(
			'icon_hover_color',
			array(
				'label'     => esc_html__( 'Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-team-social-list .ele-team-social-icon:hover > i, {{WRAPPER}} .ele-team-social-list .ele-team-social-icon:focus > i'    => 'color: {{VALUE}};',
					'{{WRAPPER}} .ele-team-social-list .ele-team-social-icon:hover > svg, {{WRAPPER}} .ele-team-social-list .ele-team-social-icon:focus  svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_hbg',
			array(
				'label'     => esc_html__( 'Background Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .ele-team-social-list .ele-team-social-icon:hover,{{WRAPPER}} .ele-team-social-list .ele-team-social-icon:focus' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'easyelements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-team-social-list .ele-team-social-icon:hover, {{WRAPPER}} .ele-team-social-list .ele-team-social-icon:focus' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'icon_border',
				'selector'  => '{{WRAPPER}} .ele-team-social-list .ele-team-social-icon',
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'icon_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-team-social-list .ele-team-social-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout!' => array( '13' ),
				),
			)
		);

		$this->add_control(
			'heading_social_wrapper',
			array(
				'label'     => esc_html__( 'Wrapper', 'easyelements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'layout' => array( '8', '9', '15' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'icon_wrapper_background',
				'label'     => esc_html__( 'Background', 'easyelements' ),
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'selector'  => '{{WRAPPER}} .ele-team-layout-8 .ele-team-social-list,{{WRAPPER}} .ele-team-layout-9 .ele-team-social-list,{{WRAPPER}} .ele-team-layout-15 .ele-team-social-list',
				'condition' => array(
					'layout' => array( '8', '9', '15' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'icon_wrapper_border',
				'selector'  => '{{WRAPPER}} .ele-team-layout-8 .ele-team-social-list,{{WRAPPER}} .ele-team-layout-9 .ele-team-social-list,{{WRAPPER}} .ele-team-layout-15 .ele-team-social-list',
				'condition' => array(
					'layout' => array( '8', '9', '15' ),
				),
			)
		);

		$this->add_responsive_control(
			'icon_wrapper_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-team-layout-8 .ele-team-social-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => array( '8' ),
				),
			)
		);

		$this->add_responsive_control(
			'icon_wrapper_padding',
			array(
				'label'      => esc_html__( 'Padding', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-team-layout-8 .ele-team-social-list'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ele-team-layout-15 .ele-team-social-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ele-team-layout-9 .ele-team-social-list'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => array( '8', '15', '9' ),
				),
			)
		);

		$this->add_responsive_control(
			'icon_wrapper_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easyelements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-team-layout-8 .ele-team-social-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => array( '8' ),
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		require ELE_WIDGET_ASSETS_PATH . 'team/layout/frontend.php';
	}
}
