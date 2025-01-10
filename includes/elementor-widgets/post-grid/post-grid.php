<?php

namespace EasyElements\Elementor_Widgets\Post_Grid;

use EasyElements\Control\Group_Control_Foreground;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Widget_Base;
use WP_Query;

class Post_Grid extends Widget_Base {

	public function get_name() {
		return 'ele-post-grid';
	}

	public function get_title() {
		return esc_html__( 'Post Grid', 'easy-elements' );
	}

	public function get_icon() {
		return 'ele ele-post-grid ele-widget-icon';
	}

	public function get_categories() {
        return [ 'easy-elements' ];
	}

	public function get_keywords() {
		return array( 'post', 'grid', 'blog', 'posts', 'query' );
	}

	public function get_style_depends() {

		return array( 'cubeportfolio' );
	}

	public function get_script_depends() {
		return array( 'cubeportfolio' );
	}

	protected function register_controls() {

		$post_types                   = ele_elementor_get_post_types();
		$post_types['by_id']          = esc_html__( 'Manual Selection', 'easy-elements' );
		$post_types['source_dynamic'] = esc_html__( 'Dynamic', 'easy-elements' );

		$taxonomies = get_taxonomies( array(), 'objects' );

		$this->start_controls_section(
			'section_general',
			array(
				'label' => esc_html__( 'General', 'easy-elements' ),
			)
		);

		$this->add_control(
			'layout',
			array(
				'label'   => esc_html__( 'Layout', 'easy-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => array(
					'1'  => esc_html__( 'Layout 1', 'easy-elements' ),
					'2'  => esc_html__( 'Layout 2', 'easy-elements' ),
					'3'  => esc_html__( 'Layout 3', 'easy-elements' ),
					'4'  => esc_html__( 'Layout 4', 'easy-elements' ),
					'5'  => esc_html__( 'Layout 5', 'easy-elements' ),
					'6'  => esc_html__( 'Layout 6', 'easy-elements' ),
					'7'  => esc_html__( 'Layout 7', 'easy-elements' ),
					'8'  => esc_html__( 'Layout 8', 'easy-elements' ),
					'9'  => esc_html__( 'Layout 9', 'easy-elements' ),
					'10' => esc_html__( 'Layout 10', 'easy-elements' ),
				),
			)
		);

		$this->add_responsive_control(
			'column_grid',
			array(
				'label'              => esc_html__( 'Columns', 'easy-elements' ),
				'type'               => Controls_Manager::SELECT,
				'desktop_default'    => '3',
				'tablet_default'     => '2',
				'mobile_default'     => '1',
				'options'            => array(
					'1' => esc_html__( '1', 'easy-elements' ),
					'2' => esc_html__( '2', 'easy-elements' ),
					'3' => esc_html__( '3', 'easy-elements' ),
					'4' => esc_html__( '4', 'easy-elements' ),
					'5' => esc_html__( '5', 'easy-elements' ),
					'6' => esc_html__( '6', 'easy-elements' ),
				),
				'render_type'        => 'template',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'show_image',
			array(
				'label'        => esc_html__( 'Show Image', 'easy-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'thumbnail',
				'exclude'   => array( 'custom' ),
				'default'   => 'medium',
				'condition' => array(
					'show_image' => 'yes',
				),
			)
		);

		$this->add_control(
			'show_content',
			array(
				'label'        => esc_html__( 'Show Excerpt', 'easy-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'content_length',
			array(
				'label'     => esc_html__( 'Content Length', 'easy-elements' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 500,
				'step'      => 5,
				'default'   => 10,
				'condition' => array(
					'show_content' => 'yes',
				),
			)
		);

		$this->add_control(
			'show_readmore',
			array(
				'label'        => esc_html__( 'Show Button', 'easy-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'readmore_text',
			array(
				'label'     => esc_html__( 'Button Text', 'easy-elements' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Read More', 'easy-elements' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'show_readmore' => 'yes',
				),
			)
		);

		$this->add_control(
			'show_author',
			array(
				'label'        => esc_html__( 'Show Author', 'easy-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'author_title',
			array(
				'label'     => esc_html__( 'Author Title', 'easy-elements' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Posted By', 'easy-elements' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'show_author' => 'yes',
				),
			)
		);

		$this->add_control(
			'show_author_avatar',
			array(
				'label'        => esc_html__( 'Show Avatar', 'easy-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'show_author' => 'yes',
				),
			)
		);

		$this->add_control(
			'show_meta',
			array(
				'label'     => esc_html__( 'Show Meta', 'easy-elements' ),
				'type'      => Controls_Manager::SELECT2,
				'multiple'  => true,
				'separator' => 'before',
				'options'   => array(
					'date'     => esc_html__( 'Date', 'easy-elements' ),
					'category' => esc_html__( 'Category', 'easy-elements' ),
					'comments' => esc_html__( 'Comments', 'easy-elements' ),
				),
				'default'   => array( 'date' ),
			)
		);

		$this->add_control(
			'date_icon',
			array(
				'label'     => esc_html__( 'Date Icon', 'easy-elements' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'far fa-calendar',
					'library' => 'regular',
				),
				'condition' => array(
					'show_meta' => 'date',
				),
			)
		);

		$this->add_control(
			'category_icon',
			array(
				'label'     => esc_html__( 'Category Icon', 'easy-elements' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'far fa-folder',
					'library' => 'regular',
				),
				'condition' => array(
					'show_meta' => 'category',
				),
			)
		);

		$this->add_control(
			'comments_icon',
			array(
				'label'     => esc_html__( 'Comment Icon', 'easy-elements' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'far fa-comment-alt',
					'library' => 'regular',
				),
				'condition' => array(
					'show_meta' => 'comments',
				),
			)
		);

		$this->end_controls_section();

		//Query
		$this->start_controls_section(
			'section_query',
			array(
				'label' => esc_html__( 'Query', 'easy-elements' ),
			)
		);

		$this->add_control(
			'post_type',
			array(
				'label'   => esc_html__( 'Source', 'easy-elements' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $post_types,
				'default' => key( $post_types ),
			)
		);

		$this->add_control(
			'posts_ids',
			array(
				'label'       => esc_html__( 'Search & Select', 'easy-elements' ),
				'type'        => 'ele-advanced-select2',
				'options'     => ele_elementor_get_query_post_list(),
				'label_block' => true,
				'multiple'    => true,
				'source_name' => 'post_type',
				'source_type' => 'any',
				'condition'   => array(
					'post_type' => 'by_id',
				),
			)
		);

		$this->add_control(
			'authors',
			array(
				'label'       => esc_html__( 'Author', 'easy-elements' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default'     => array(),
				'options'     => ele_elementor_get_authors_list(),
				'condition'   => array(
					'post_type!' => array( 'by_id', 'source_dynamic' ),
				),
			)
		);

		$this->add_control(
			'terms',
			array(
				'label'     => esc_html__( 'Term', 'easy-elements' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->get_taxonomies(),
				'default'   => '',
				'condition' => array(
					'post_type' => array( 'source_dynamic' ),
				),
			)
		);

		foreach ( $taxonomies as $taxonomy => $object ) {
			if ( ! isset( $object->object_type[0] ) || ! in_array( $object->object_type[0], array_keys( $post_types ), true ) ) {
				continue;
			}

			$this->add_control(
				$taxonomy . '_ids',
				array(
					'label'       => $object->label,
					'type'        => 'ele-advanced-select2',
					'label_block' => true,
					'multiple'    => true,
					'source_name' => 'taxonomy',
					'source_type' => $taxonomy,
					'condition'   => array(
						'post_type' => $object->object_type,
					),
				)
			);
		}

		$this->add_control(
			'post__not_in',
			array(
				'label'       => esc_html__( 'Exclude', 'easy-elements' ),
				'type'        => 'ele-advanced-select2',
				'label_block' => true,
				'multiple'    => true,
				'source_name' => 'post_type',
				'source_type' => 'any',
				'condition'   => array(
					'post_type!' => array( 'by_id', 'source_dynamic' ),
				),
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'label'     => esc_html__( 'Per Page', 'easy-elements' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 3,
				'condition' => array(
					'post_type!' => array( 'source_dynamic' ),
				),
			)
		);

		$this->add_control(
			'offset',
			array(
				'label'     => esc_html__( 'Offset', 'easy-elements' ),
				'type'      => Controls_Manager::NUMBER,
				'condition' => array(
					'orderby!'         => 'rand',
					'show_pagination!' => 'yes',
				),
			)
		);

		$this->add_control(
			'orderby',
			array(
				'label'   => esc_html__( 'Order By', 'easy-elements' ),
				'type'    => Controls_Manager::SELECT,
				'options' => ele_elementor_get_post_orderby_options(),
				'default' => 'date',

			)
		);

		$this->add_control(
			'order',
			array(
				'label'   => esc_html__( 'Order', 'easy-elements' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'asc'  => 'Ascending',
					'desc' => 'Descending',
				),
				'default' => 'desc',

			)
		);

		$this->add_control(
			'post_only_image',
			array(
				'label'        => esc_html__( 'Post With Image', 'easy-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);

		if ( Plugin::$instance->editor->is_edit_mode() ) {
			$this->add_control(
				'_source_dynamic_notice',
				array(
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => sprintf(
					/* translators: %s: Title */
						esc_html__( 'This option will show %1$s dynamically according to loop.', 'easy-elements' ),
						'<strong>Posts</strong>'
					),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'condition'       => array(
						'post_type' => array( 'source_dynamic' ),
					),
				)
			);
		}

		$this->end_controls_section();

		//Pagination
		$this->start_controls_section(
			'section_pagination',
			array(
				'label'     => esc_html__( 'Pagination', 'easy-elements' ),
				'condition' => array(
					'terms' => '',
				),
			)
		);

		$this->add_control(
			'show_pagination',
			array(
				'label'        => esc_html__( 'Show Pagination', 'easy-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'prev_label',
			array(
				'label'     => esc_html__( 'Prev Label', 'easy-elements' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Prev', 'easy-elements' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'show_pagination' => 'yes',
				),
			)
		);

		$this->add_control(
			'next_label',
			array(
				'label'     => esc_html__( 'Next Label', 'easy-elements' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Next', 'easy-elements' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'show_pagination' => 'yes',
				),
			)
		);

		$this->add_control(
			'arrow',
			array(
				'label'     => esc_html__( 'Arrows Type', 'easy-elements' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'fas fa-arrow-left'          => esc_html__( 'Arrow', 'easy-elements' ),
					'fas fa-angle-left'          => esc_html__( 'Angle', 'easy-elements' ),
					'fas fa-angle-double-left'   => esc_html__( 'Double Angle', 'easy-elements' ),
					'fas fa-chevron-left'        => esc_html__( 'Chevron', 'easy-elements' ),
					'fas fa-chevron-circle-left' => esc_html__( 'Chevron Circle', 'easy-elements' ),
					'fas fa-caret-left'          => esc_html__( 'Caret', 'easy-elements' ),
					'xi xi-long-arrow-left'      => esc_html__( 'Long Arrow', 'easy-elements' ),
					'fas fa-arrow-circle-left'   => esc_html__( 'Arrow Circle', 'easy-elements' ),
				),
				'default'   => 'fas fa-arrow-left',
				'condition' => array(
					'show_pagination' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		//Styling Tab
		$this->start_controls_section(
			'section_general_style',
			array(
				'label' => esc_html__( 'General', 'easy-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'alignment',
			array(
				'label'        => esc_html__( 'Alignment', 'easy-elements' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'easy-elements' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'easy-elements' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'easy-elements' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'prefix_class' => 'ele-post-grid-align%s-',
			)
		);

		$this->add_responsive_control(
			'item_height',
			array(
				'label'              => esc_html__( 'Height', 'easy-elements' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px', 'vh' ),
				'default'            => array(
					'unit' => 'px',
					'size' => 400,
				),
				'range'              => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
					'vh' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'selectors'          => array(
					'{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-item' => 'height: {{SIZE}}{{UNIT}}',
				),
				'condition'          => array(
					'layout' => array( '2', '6', '8', '9', '10' ),
				),
			)
		);

		$this->add_responsive_control(
			'image_height',
			array(
				'label'              => esc_html__( 'Image Height', 'easy-elements' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px', 'vh' ),
				'range'              => array(
					'px' => array(
						'min' => 10,
						'max' => 1200,
					),
					'vh' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'selectors'          => array(
					'{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-image' => 'height: {{SIZE}}{{UNIT}}',
				),
				'condition'          => array(
					'layout!'    => array( '2', '6' ),
					'show_image' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'space_between',
			array(
				'label'              => esc_html__( 'Space Between', 'easy-elements' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px' ),
				'default'            => array(
					'size' => 15,
				),
				'tablet_default'     => array(
					'size' => 15,
				),
				'mobile_default'     => array(
					'size' => 15,
				),
				'range'              => array(
					'px' => array(
						'min' => 0,
						'max' => 500,
					),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'item_background',
				'label'    => esc_html__( 'Background', 'easy-elements' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .ele-post-grid-wrapper .cbp-item-wrapper',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'item_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-item',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'item_border',
				'label'    => esc_html__( 'Border', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-post-grid-wrapper .cbp-item-wrapper',
			)
		);

		$this->add_responsive_control(
			'item_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-item' => 'overflow:hidden; border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'item_padding',
			array(
				'label'      => esc_html__( 'Padding', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'overlay_style_tabs',
			array(
				'condition' => array(
					'layout!' => array( '8', '10' ),
				),
			)
		);

		$this->start_controls_tab(
			'overlay_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'easy-elements' ),
			)
		);

		$this->add_control(
			'overlay_color',
			array(
				'label'     => esc_html__( 'Overlay Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-item .ele-post-grid-image::after' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'overlay_hover_tab_style',
			array(
				'label' => esc_html__( 'Hover', 'easy-elements' ),
			)
		);

		$this->add_control(
			'overlay_hover_color',
			array(
				'label'     => esc_html__( 'Overlay Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-item:hover .ele-post-grid-image::after' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		//Content
		$this->start_controls_section(
			'section_content_style',
			array(
				'label' => esc_html__( 'Content', 'easy-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'content_height',
			array(
				'label'              => esc_html__( 'Min Height', 'easy-elements' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => array( 'px', 'vh' ),
				'range'              => array(
					'px' => array(
						'min' => 10,
						'max' => 1200,
					),
					'vh' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'frontend_available' => true,
				'render_type'        => 'template',
				'selectors'          => array(
					'{{WRAPPER}} .ele-post-grid-content' => 'min-height: {{SIZE}}{{UNIT}}',
				),
				'condition'          => array(
					'layout!' => array( '6', '2', '8', '10' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'content_background',
				'label'     => esc_html__( 'Background', 'easy-elements' ),
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'selector'  => '{{WRAPPER}} .ele-post-grid-content',
				'condition' => array(
					'layout!' => array( '6', '2' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'content_border',
				'selector'  => '{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-content',
				'condition' => array(
					'layout!' => array( '6', '2' ),
				),
			)
		);

		$this->add_responsive_control(
			'content_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout!' => array( '6', '2' ),
				),
			)
		);

		$this->add_responsive_control(
			'content_padding',
			array(
				'label'      => esc_html__( 'Padding', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'heading_title',
			array(
				'label'     => esc_html__( 'Title', 'easy-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-title',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'title_hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-title:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'heading_excerpt',
			array(
				'label'     => esc_html__( 'Content', 'easy-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'show_content' => 'yes',
				),
			)
		);

		$this->add_control(
			'excerpt_color',
			array(
				'label'     => esc_html__( 'Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-excerpt' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'show_content' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'description_typography',
				'label'     => esc_html__( 'Typography', 'easy-elements' ),
				'selector'  => '{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-excerpt',
				'condition' => array(
					'show_content' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'excerpt_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'show_content' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		//Meta
		$this->start_controls_section(
			'section_meta_style',
			array(
				'label' => esc_html__( 'Meta', 'easy-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'meta_typography',
				'label'    => esc_html__( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-meta-list > li',
			)
		);

		$this->add_responsive_control(
			'meta_space_between',
			array(
				'label'      => esc_html__( 'Space Between', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-meta-list' => 'grid-gap: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_control(
			'meta_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-meta-list > li > i'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-meta-list > li > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'meta_color',
			array(
				'label'     => esc_html__( 'Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-meta-list > li,{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-meta-list > li a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'meta_bg_color',
			array(
				'label'     => esc_html__( 'Background', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-meta-list > li' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'meta_border',
				'label'    => esc_html__( 'Border', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-meta-list > li',
			)
		);

		$this->add_responsive_control(
			'meta_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-meta-list > li' => 'overflow:hidden; border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'meta_padding',
			array(
				'label'      => esc_html__( 'Padding', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-meta-list > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'meta_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-meta-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'heading_meta_wrapper',
			array(
				'label'     => esc_html__( 'Wrapper', 'easy-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'layout' => '7',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'meta_wrapper_border',
				'label'     => esc_html__( 'Border', 'easy-elements' ),
				'selector'  => '{{WRAPPER}} .ele-post-grid-layout-7 .ele-post-grid-meta-list',
				'condition' => array(
					'layout' => '7',
				),
			)
		);

		$this->add_responsive_control(
			'meta_wrapper_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-post-grid-layout-7 .ele-post-grid-meta-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => '7',
				),
			)
		);

		$this->add_responsive_control(
			'meta_wrapper_padding',
			array(
				'label'      => esc_html__( 'Padding', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-post-grid-layout-7 .ele-post-grid-meta-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => '7',
				),
			)
		);

		$this->add_responsive_control(
			'meta_wrapper_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-post-grid-layout-7 .ele-post-grid-meta-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout' => '7',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			array(
				'label'     => esc_html__( 'Button', 'easy-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_readmore' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'label'    => esc_html__( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-post-grid-btn',
			)
		);

		$this->start_controls_tabs(
			'button_style_tabs'
		);

		$this->start_controls_tab(
			'button_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'easy-elements' ),
			)
		);

		$this->add_control(
			'button_color',
			array(
				'label'     => esc_html__( 'Text Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-post-grid-btn' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_bg',
				'label'    => esc_html__( 'Background', 'easy-elements' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .ele-post-grid-btn',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'button_border',
				'label'    => esc_html__( 'Border', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-post-grid-btn',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_hover_tab_style',
			array(
				'label' => esc_html__( 'Hover', 'easy-elements' ),
			)
		);

		$this->add_control(
			'button_hcolor',
			array(
				'label'     => esc_html__( 'Text Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-post-grid-btn:hover,{{WRAPPER}} .ele-post-grid-btn:focus' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_hbg',
				'label'    => esc_html__( 'Background', 'easy-elements' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .ele-post-grid-btn:hover,{{WRAPPER}} .ele-post-grid-btn:focus',
			)
		);

		$this->add_control(
			'button_hborder',
			array(
				'label'     => esc_html__( 'Border Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-post-grid-btn:hover,{{WRAPPER}} .ele-post-grid-btn:focus' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'button_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-post-grid-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_item_padding',
			array(
				'label'      => esc_html__( 'Padding', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-post-grid-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-post-grid-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Author
		$this->start_controls_section(
			'section_author_style',
			array(
				'label'     => esc_html__( 'Author', 'easy-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_author' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'avatar_size',
			array(
				'label'       => esc_html__( 'Avatar Size', 'easy-elements' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'selectors'   => array(
					'{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-author img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ele-post-grid-layout-4 .ele-post-grid-content'   => 'margin-top: calc({{SIZE}}{{UNIT}} / 2);',
				),
				'condition'   => array(
					'show_author_avatar' => 'yes',
				),
				'render_type' => 'template',
			)
		);

		$this->add_responsive_control(
			'author_space_between',
			array(
				'label'      => esc_html__( 'Space Between', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-post-grid-author' => 'grid-gap: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'show_author_avatar' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'author_border',
				'label'     => esc_html__( 'Border', 'easy-elements' ),
				'selector'  => '{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-author img',
				'condition' => array(
					'show_author_avatar' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'author_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-author img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'show_author_avatar' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'author_wrapper_margin',
			array(
				'label'      => esc_html__( 'Wrapper Margin', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-post-grid-wrapper .ele-post-grid-author' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'author_heading_title',
			array(
				'label'     => esc_html__( 'Title', 'easy-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'author_title!' => '',
				),
			)
		);

		$this->add_group_control(
            'foreground',
			array(
				'name'      => 'author_title_color',
				'label'     => esc_html__( 'Title Color', 'easy-elements' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .ele-post-grid-author-title',
				'condition' => array(
					'author_title!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'author_title_typography',
				'label'     => esc_html__( 'Typography', 'easy-elements' ),
				'selector'  => '{{WRAPPER}} .ele-post-grid-author-title',
				'condition' => array(
					'author_title!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'author_title_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-post-grid-author-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'author_title!' => '',
				),
			)
		);

		$this->add_control(
			'author_heading_name',
			array(
				'label'     => esc_html__( 'Name', 'easy-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'author_name_color',
			array(
				'label'     => esc_html__( 'Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-post-grid-author-name' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'author_name_typography',
				'label'    => esc_html__( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-post-grid-author-name',
			)
		);

		$this->add_responsive_control(
			'author_name_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-post-grid-author-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		//Pagination
		$this->start_controls_section(
			'section_pagination_style',
			array(
				'label'     => esc_html__( 'Pagination', 'easy-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_pagination' => 'yes',
					'terms'           => '',
				),
			)
		);

		$this->add_responsive_control(
			'pagination_alignment',
			array(
				'label'     => esc_html__( 'Alignment', 'easy-elements' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'easy-elements' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'easy-elements' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'easy-elements' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .ele-elementor-post-pagination' => 'justify-content: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pagination_typography',
				'label'    => esc_html__( 'Typography', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-elementor-post-pagination .page-numbers',
			)
		);

		$this->add_responsive_control(
			'pagination_space_between',
			array(
				'label'      => esc_html__( 'Space Between', 'easy-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-elementor-post-pagination' => 'grid-gap: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'pagination_border',
				'label'    => esc_html__( 'Border', 'easy-elements' ),
				'selector' => '{{WRAPPER}} .ele-elementor-post-pagination .page-numbers',
			)
		);

		$this->add_responsive_control(
			'pagination_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-elementor-post-pagination .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'pagination_padding',
			array(
				'label'      => esc_html__( 'Padding', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-elementor-post-pagination .page-numbers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'pagination_margin',
			array(
				'label'      => esc_html__( 'Margin', 'easy-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .ele-elementor-post-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'pagination_style_tabs'
		);

		$this->start_controls_tab(
			'pagination_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'easy-elements' ),
			)
		);

		$this->add_control(
			'pagination_color',
			array(
				'label'     => esc_html__( 'Text Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-elementor-post-pagination .page-numbers' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'pagination_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-elementor-post-pagination .page-numbers' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'pagination_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'easy-elements' ),
			)
		);

		$this->add_control(
			'pagination_hover_color',
			array(
				'label'     => esc_html__( 'Text Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-elementor-post-pagination .page-numbers:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'pagination_bg_hover_color',
			array(
				'label'     => esc_html__( 'Background Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-elementor-post-pagination .page-numbers:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'pagination_active_tab',
			array(
				'label' => esc_html__( 'Active', 'easy-elements' ),
			)
		);

		$this->add_control(
			'pagination_active_color',
			array(
				'label'     => esc_html__( 'Text Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-elementor-post-pagination .page-numbers.current' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'pagination_bg_arctive_color',
			array(
				'label'     => esc_html__( 'Background Color', 'easy-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ele-elementor-post-pagination .page-numbers.current' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}
    protected function render() {

        $display_settings = $this->get_settings_for_display();

        ?>

        <div class="ele-post-grid-wrapper ele-post-grid-layout-<?php echo esc_attr( $display_settings['layout'] ); ?>">

            <?php

            $query_args = ele_elementor_get_query_args( $display_settings );
            $query_args = ele_elementor_get_dynamic_args( $display_settings, $query_args );

            if ( 'source_dynamic' === $display_settings['post_type'] && ( 'ele-themer' === get_post_type() || 'ele_content' === get_post_type() ) ) {
                $current_document = Plugin::instance()->documents->get_doc_or_auto_save( get_the_ID() );
                $dynamic_query_args = $current_document->get_document_query_args();
                if ( empty( $dynamic_query_args ) ) {
                    $dynamic_query_args['post_type']      = 'post';
                    $dynamic_query_args['posts_per_page'] = get_option( 'posts_per_page' );
                }
                $query_args = array_merge( $query_args, $dynamic_query_args );
            }

            $total_posts_found = 0;
            $current_page_number = 1;

            if ( '' === $display_settings['terms'] || 'yes' === $display_settings['show_pagination'] ) {
                $query_args['offset'] = '';
                if ( get_query_var( 'paged' ) ) {
                    $current_page_number = get_query_var( 'paged' );
                } elseif ( get_query_var( 'page' ) ) {
                    $current_page_number = get_query_var( 'page' );
                }
            }

            $query_args['paged'] = $current_page_number;

            $post_query = new WP_Query( $query_args );

            if ( $post_query->have_posts() ) {
                $total_posts_found = $post_query->found_posts;
                $max_pages = ceil( $total_posts_found / absint( $query_args['posts_per_page'] ) );
                $query_args['max_page'] = $max_pages;
                ?>

                <div class="ele-post-grid-main cbp">
                    <?php
                    while ( $post_query->have_posts() ) {
                        $post_query->the_post();
                        require ELE_WIDGET_ASSETS_PATH . 'post-grid/layout/frontend.php';
                    }
                    ?>
                </div>

                <?php

                if ( $total_posts_found > $query_args['posts_per_page'] && 'yes' === $display_settings['show_pagination'] ) {
                    $prev_icon_class = $display_settings['arrow'];
                    $next_icon_class = str_replace( 'left', 'right', $display_settings['arrow'] );

                    $prev_text = '<i class="' . $prev_icon_class . '"></i><span class="ele-elementor-post-pagination-prev-text">' . $display_settings['prev_label'] . '</span>';
                    $next_text = '<span class="ele-elementor-post-pagination-next-text">' . $display_settings['next_label'] . '</span><i class="' . $next_icon_class . '"></i>';

                    $pagination_args = array(
                        'type'      => 'array',
                        'current'   => max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) ),
                        'total'     => $post_query->max_num_pages,
                        'prev_next' => true,
                        'prev_text' => $prev_text,
                        'next_text' => $next_text,
                    );

                    if ( is_singular() && ! is_front_page() ) {
                        global $wp_rewrite;
                        if ( $wp_rewrite->using_permalinks() ) {
                            $pagination_args['format'] = user_trailingslashit( 'page%#%', 'single_paged' );
                        } else {
                            $pagination_args['format'] = '?page=%#%';
                        }
                    }

                    $pagination_links = paginate_links( $pagination_args );

                    ?>

                    <nav class="ele-elementor-post-pagination" role="navigation"
                         aria-label="<?php esc_attr_e( 'Pagination', 'easy-elements' ); ?>">
                        <?php echo implode( PHP_EOL, $pagination_links ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </nav>

                    <?php
                }

                wp_reset_postdata();
            } else {
                ?>
                <p class="ele-alert ele-alert-warning">
                    <span class="ele-alert-title"><?php esc_html_e( 'No Posts Found!', 'easy-elements' ); ?></span>
                    <span class="ele-alert-description"><?php esc_html_e( 'Sorry, but nothing matched your selection. Please try again with some different keywords.', 'easy-elements' ); ?></span>
                </p>
                <?php
            }

            ?>

        </div>

        <?php
    }

    public static function get_taxonomies() {

        $taxonomie_list     = ele_elementor_get_taxonomies( array( 'public' => true ), 'object', true );
        $taxonomie_list[''] = esc_html__( 'None', 'easy-elements' );
        return $taxonomie_list;
    }
}
