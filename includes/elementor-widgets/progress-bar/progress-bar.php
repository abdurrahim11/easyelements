<?php

namespace EasyElements\Elementor_Widgets\Progress_Bar;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

class Progress_Bar extends Widget_Base {

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
		return 'ele-progress-bar';
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
		return __( 'Progress Bar', 'ele-elementor-addons' );
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
		return 'ele ele-progress ele-widget-icon';
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
		return array( 'skill', 'progress', 'bar' );
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
		return array( 'elementor-waypoints' );
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
			'section_general',
			array(
				'label' => __( 'General', 'ele-elementor-addons' ),
			)
		);

		$this->add_control(
			'layout',
			array(
				'label'   => esc_html__( 'Layout', 'ele-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => array(
					'1'  => esc_html__( 'Style 1', 'ele-elementor-addons' ),
					'2'  => esc_html__( 'Style 2', 'ele-elementor-addons' ),
					'3'  => esc_html__( 'Style 3', 'ele-elementor-addons' ),
					'4'  => esc_html__( 'Style 4', 'ele-elementor-addons' ),
					'5'  => esc_html__( 'Style 5', 'ele-elementor-addons' ),
					'6'  => esc_html__( 'Style 6', 'ele-elementor-addons' ),
					'7'  => esc_html__( 'Style 7', 'ele-elementor-addons' ),
					'8'  => esc_html__( 'Style 8', 'ele-elementor-addons' ),
					'9'  => esc_html__( 'Style 9', 'ele-elementor-addons' ),
					'10' => esc_html__( 'Style 10', 'ele-elementor-addons' ),
					'11' => esc_html__( 'Style 11', 'ele-elementor-addons' ),
					'12' => esc_html__( 'Style 12', 'ele-elementor-addons' ),
					'13' => esc_html__( 'Style 13', 'ele-elementor-addons' ),
					'14' => esc_html__( 'Style 14', 'ele-elementor-addons' ),
					'15' => esc_html__( 'Style 15', 'ele-elementor-addons' ),
				),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => esc_html__( 'Title', 'ele-elementor-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'WordPress', 'ele-elementor-addons' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'value',
			array(
				'label'              => esc_html__( 'Percentage', 'ele-elementor-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 1,
				'max'                => 100,
				'step'               => 1,
				'default'            => 90,
				'frontend_available' => true,
				'dynamic'            => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'show_count',
			array(
				'label'              => __( 'Show Count', 'ele-elementor-addons' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => __( 'Show', 'ele-elementor-addons' ),
				'label_off'          => __( 'Hide', 'ele-elementor-addons' ),
				'return_value'       => 'yes',
				'default'            => 'yes',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'duration',
			array(
				'label'              => esc_html__( 'Animation Duration', 'ele-elementor-addons' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'frontend_available' => true,
				'range'              => array(
					'px' => array(
						'min'  => 1,
						'max'  => 10,
						'step' => 1,
					),

				),
				'default'            => array(
					'size' => 3,
				),

			)
		);

		$this->add_control(
			'align',
			array(
				'label'     => __( 'Alignment', 'ele-elementor-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'ele-elementor-addons' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'ele-elementor-addons' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'ele-elementor-addons' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .ele-progress-content' => 'text-align: {{VALUE}}',
				),
				'condition' => array(
					'layout' => array( '15' ),
				),
			)
		);

		$this->end_controls_section();

		//Title Style
		$this->start_controls_section(
			'section_style_title',
			array(
				'label' => __( 'Title', 'ele-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'ele-elementor-addons' ),
				'selector' => '{{WRAPPER}} .ele-progress-title',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Color', 'ele-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-progress-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => __( 'Margin', 'ele-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-progress-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Counter Style
		$this->start_controls_section(
			'section_style_counter',
			array(
				'label' => __( 'Counter', 'ele-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'counter_typography',
				'label'    => __( 'Typography', 'ele-elementor-addons' ),
				'selector' => '{{WRAPPER}} .ele-progress-counter',
			)
		);

		$this->add_control(
			'counter_color',
			array(
				'label'     => __( 'Color', 'ele-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-progress-counter' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'counter_secondary_color',
			array(
				'label'     => __( 'Decrement Color', 'ele-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-progress-bar-layout-6 .ele-progress-count-less-wrapper' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'layout' => array( '6' ),
				),
			)
		);

		$this->add_control(
			'counter_bg_color',
			array(
				'label'     => __( 'Background Color', 'ele-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-progress-bar-layout-3 .ele-progress-counter,{{WRAPPER}} .ele-progress-bar-layout-7 .ele-progress-counter,
					 {{WRAPPER}}  .ele-progress-bar-layout-11 .ele-progress-track::after,{{WRAPPER}} .ele-progress-bar-layout-12 .ele-progress-counter,
					 {{WRAPPER}} .ele-progress-bar-layout-13 .ele-progress-counter,{{WRAPPER}} .ele-progress-bar-layout-14 .ele-progress-counter'               => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .ele-progress-bar-layout-7 .ele-progress-counter::after,{{WRAPPER}} .ele-progress-bar-layout-13 .ele-progress-counter::before' => 'border-top-color: {{VALUE}}',
					'{{WRAPPER}} .ele-progress-bar-layout-14 .ele-progress-counter::before'                                                                       => 'border-bottom-color: {{VALUE}}',
				),
				'condition' => array(
					'layout' => array( '3', '7', '11', '12', '13', '14' ),
				),
			)
		);

		$this->add_control(
			'counter_shape_color',
			array(
				'label'     => __( 'Shape Color', 'ele-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-progress-control' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .ele-progress-control:before,{{WRAPPER}} .ele-progress-bar-layout-10 .ele-progress-counter::after' => 'border-top-color: {{VALUE}}',
				),
				'condition' => array(
					'layout' => array( '5', '10' ),
				),
			)
		);

		$this->add_control(
			'counter_bg_size',
			array(
				'label'      => __( 'Background Size', 'ele-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-progress-bar-layout-7 .ele-progress-counter,{{WRAPPER}} .ele-progress-bar-layout-11 .ele-progress-track::after,{{WRAPPER}} .ele-progress-bar-layout-12 .ele-progress-counter' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => array( '7', '11', '12' ),
				),
			)
		);

		$this->add_control(
			'counter_border_color',
			array(
				'label'     => __( 'Border Color', 'ele-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-progress-bar-layout-7 .ele-progress-counter::before,{{WRAPPER}} .ele-progress-bar-layout-11 .ele-progress-track::after,{{WRAPPER}} .ele-progress-bar-layout-12 .ele-progress-counter' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'layout' => array( '7', '11', '12' ),
				),
			)
		);

		$this->add_responsive_control(
			'counter_margin',
			array(
				'label'      => __( 'Margin', 'ele-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-progress-counter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_bar',
			array(
				'label' => __( 'Track', 'ele-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'bar_height',
			array(
				'label'      => __( 'Height', 'ele-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ele-progress-bar' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'bar_bg',
				'label'    => __( 'Background', 'ele-elementor-addons' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .ele-progress-bar,{{WRAPPER}}  .ele-progress-bar-layout-11 .ele-progress-track::after',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'bar_shadow',
				'label'    => __( 'Bar Shadow', 'ele-elementor-addons' ),
				'selector' => '{{WRAPPER}} .ele-progress-bar',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'bar_border',
				'label'    => __( 'Border', 'ele-elementor-addons' ),
				'selector' => '{{WRAPPER}} .ele-progress-bar',
			)
		);

		$this->add_responsive_control(
			'bar_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ele-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-progress-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'bar_padding',
			array(
				'label'      => __( 'Padding', 'ele-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-progress-bar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'bar_margin',
			array(
				'label'      => __( 'Margin', 'ele-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-progress-bar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_track',
			array(
				'label' => __( 'Bar', 'ele-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'track_striped',
			array(
				'label'        => __( 'Striped', 'ele-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'ele-elementor-addons' ),
				'label_off'    => __( 'Hide', 'ele-elementor-addons' ),
				'return_value' => 'yes',
				'selectors'    => array(
					'{{WRAPPER}} .ele-progress-track' => 'background-size: 1rem 1rem; background-image: linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);',
				),
				'condition'    => array(
					'layout!' => array( '9', '10' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'track_bg',
				'label'     => __( 'Background', 'ele-elementor-addons' ),
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'selector'  => '{{WRAPPER}} .ele-progress-track',
				'condition' => array(
					'layout!' => array( '9', '10' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'track_border',
				'label'     => __( 'Border', 'ele-elementor-addons' ),
				'selector'  => '{{WRAPPER}} .ele-progress-track',
				'condition' => array(
					'layout!' => array( '9', '10' ),
				),
			)
		);

		$this->add_control(
			'track_striped_color',
			array(
				'label'     => __( 'Striped Color', 'ele-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-progress-track' => 'background: repeating-linear-gradient(to right,{{VALUE}},{{VALUE}} 10px,transparent 10px,transparent 12px)',
				),
				'condition' => array(
					'layout' => array( '9', '10' ),
				),
			)
		);

		$this->add_responsive_control(
			'track_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ele-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-progress-track' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		require ELE_WIDGET_ASSETS_PATH . 'progress-bar/layout/frontend.php';
	}
}
