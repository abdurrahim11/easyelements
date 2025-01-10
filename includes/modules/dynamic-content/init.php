<?php

namespace EasyElements\Modules\Dynamic_Content;

class Init {

    public function __construct() {
        $this->initialize();
        add_action('init', array($this, 'register_post_type'));
    }

    /**
     * Initialize the class by instantiating dependencies.
     */
    public function initialize() {
        new \EasyElements\Modules\Dynamic_Content\Elementor_Editor_Api();
    }

    /**
     * Register custom post type for EasyElements content.
     */
    public function register_post_type() {

        $labels = array(
            'name'                  => _x('EasyElements Items', 'Post Type General Name', 'easy-elements'),
            'singular_name'         => _x('EasyElements Item', 'Post Type Singular Name', 'easy-elements'),
            'menu_name'             => esc_html__('EasyElements Items', 'easy-elements'),
            'name_admin_bar'        => esc_html__('EasyElements Item', 'easy-elements'),
            'archives'              => esc_html__('Item Archives', 'easy-elements'),
            'attributes'            => esc_html__('Attributes of Item', 'easy-elements'),
            'parent_item_colon'     => esc_html__('Parent Item:', 'easy-elements'),
            'all_items'             => esc_html__('All Items', 'easy-elements'),
            'add_new_item'          => esc_html__('Add New EasyElements Item', 'easy-elements'),
            'add_new'               => esc_html__('Add New Item', 'easy-elements'),
            'new_item'              => esc_html__('New EasyElements Item', 'easy-elements'),
            'edit_item'             => esc_html__('Edit EasyElements Item', 'easy-elements'),
            'update_item'           => esc_html__('Update Item Details', 'easy-elements'),
            'view_item'             => esc_html__('View EasyElements Item', 'easy-elements'),
            'view_items'            => esc_html__('View All Items', 'easy-elements'),
            'search_items'          => esc_html__('Search Items', 'easy-elements'),
            'not_found'             => esc_html__('No items found', 'easy-elements'),
            'not_found_in_trash'    => esc_html__('No items found in trash', 'easy-elements'),
            'featured_image'        => esc_html__('Main Featured Image', 'easy-elements'),
            'set_featured_image'    => esc_html__('Set the Featured Image', 'easy-elements'),
            'remove_featured_image' => esc_html__('Remove the Featured Image', 'easy-elements'),
            'use_featured_image'    => esc_html__('Use as Featured Image', 'easy-elements'),
            'insert_into_item'      => esc_html__('Insert into EasyElements Item', 'easy-elements'),
            'uploaded_to_this_item' => esc_html__('Uploaded to this EasyElements Item', 'easy-elements'),
            'items_list'            => esc_html__('EasyElements Items List', 'easy-elements'),
            'items_list_navigation' => esc_html__('Navigate EasyElements Items', 'easy-elements'),
            'filter_items_list'     => esc_html__('Filter EasyElements Items', 'easy-elements'),
        );

        $rewrite = array(
            'slug'       => 'easyelements-content',
            'with_front' => true,
            'pages'      => false,
            'feeds'      => false,
        );

        $args = array(
            'label'               => esc_html__('EasyElements Item', 'easy-elements'),
            'description'         => esc_html__('Post type for EasyElements dynamic content', 'easy-elements'),
            'labels'              => $labels,
            'supports'            => array('title', 'editor', 'elementor', 'permalink'),
            'hierarchical'        => true,
            'public'              => true,
            'show_ui'             => false,
            'show_in_menu'        => false,
            'menu_position'       => 5,
            'show_in_admin_bar'   => false,
            'show_in_nav_menus'   => false,
            'can_export'          => true,
            'has_archive'         => false,
            'publicly_queryable'  => true,
            'rewrite'             => $rewrite,
            'query_var'           => true,
            'exclude_from_search' => true,
            'capability_type'     => 'page',
            'show_in_rest'        => true,
            'rest_base'           => 'easyelements-content',
        );

        register_post_type('easyelements_content', $args);
    }

}
