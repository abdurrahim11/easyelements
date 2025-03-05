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
            'name'                  => _x('EasyElements Items', 'Post Type General Name', 'easyelements'),
            'singular_name'         => _x('EasyElements Item', 'Post Type Singular Name', 'easyelements'),
            'menu_name'             => esc_html__('EasyElements Items', 'easyelements'),
            'name_admin_bar'        => esc_html__('EasyElements Item', 'easyelements'),
            'archives'              => esc_html__('Item Archives', 'easyelements'),
            'attributes'            => esc_html__('Attributes of Item', 'easyelements'),
            'parent_item_colon'     => esc_html__('Parent Item:', 'easyelements'),
            'all_items'             => esc_html__('All Items', 'easyelements'),
            'add_new_item'          => esc_html__('Add New EasyElements Item', 'easyelements'),
            'add_new'               => esc_html__('Add New Item', 'easyelements'),
            'new_item'              => esc_html__('New EasyElements Item', 'easyelements'),
            'edit_item'             => esc_html__('Edit EasyElements Item', 'easyelements'),
            'update_item'           => esc_html__('Update Item Details', 'easyelements'),
            'view_item'             => esc_html__('View EasyElements Item', 'easyelements'),
            'view_items'            => esc_html__('View All Items', 'easyelements'),
            'search_items'          => esc_html__('Search Items', 'easyelements'),
            'not_found'             => esc_html__('No items found', 'easyelements'),
            'not_found_in_trash'    => esc_html__('No items found in trash', 'easyelements'),
            'featured_image'        => esc_html__('Main Featured Image', 'easyelements'),
            'set_featured_image'    => esc_html__('Set the Featured Image', 'easyelements'),
            'remove_featured_image' => esc_html__('Remove the Featured Image', 'easyelements'),
            'use_featured_image'    => esc_html__('Use as Featured Image', 'easyelements'),
            'insert_into_item'      => esc_html__('Insert into EasyElements Item', 'easyelements'),
            'uploaded_to_this_item' => esc_html__('Uploaded to this EasyElements Item', 'easyelements'),
            'items_list'            => esc_html__('EasyElements Items List', 'easyelements'),
            'items_list_navigation' => esc_html__('Navigate EasyElements Items', 'easyelements'),
            'filter_items_list'     => esc_html__('Filter EasyElements Items', 'easyelements'),
        );

        $rewrite = array(
            'slug'       => 'easyelements-content',
            'with_front' => true,
            'pages'      => false,
            'feeds'      => false,
        );

        $args = array(
            'label'               => esc_html__('EasyElements Item', 'easyelements'),
            'description'         => esc_html__('Post type for EasyElements dynamic content', 'easyelements'),
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
