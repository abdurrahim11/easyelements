<?php


namespace EasyElements\Modules\Dynamic_Content;


class Init {

    public function __construct() {
        $this->initialize();
        add_action('init', array($this, 'post_type'));
    }

    public function initialize() {
        new \EasyElements\Modules\Dynamic_Content\Elementor_Editor_Api();
    }

    public function post_type() {

        $labels  = array(
            'name'                  => _x( 'easyelements items', 'Post Type General Name', 'easy-elements' ),
            'singular_name'         => _x( 'easyelements item', 'Post Type Singular Name', 'easy-elements' ),
            'menu_name'             => esc_html__( 'easyelements item', 'easy-elements' ),
            'name_admin_bar'        => esc_html__( 'easyelements item', 'easy-elements' ),
            'archives'              => esc_html__( 'Item Archives', 'easy-elements' ),
            'attributes'            => esc_html__( 'Item Attributes', 'easy-elements' ),
            'parent_item_colon'     => esc_html__( 'Parent Item:', 'easy-elements' ),
            'all_items'             => esc_html__( 'All Items', 'easy-elements' ),
            'add_new_item'          => esc_html__( 'Add New Item', 'easy-elements' ),
            'add_new'               => esc_html__( 'Add New', 'easy-elements' ),
            'new_item'              => esc_html__( 'New Item', 'easy-elements' ),
            'edit_item'             => esc_html__( 'Edit Item', 'easy-elements' ),
            'update_item'           => esc_html__( 'Update Item', 'easy-elements' ),
            'view_item'             => esc_html__( 'View Item', 'easy-elements' ),
            'view_items'            => esc_html__( 'View Items', 'easy-elements' ),
            'search_items'          => esc_html__( 'Search Item', 'easy-elements' ),
            'not_found'             => esc_html__( 'Not found', 'easy-elements' ),
            'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'easy-elements' ),
            'featured_image'        => esc_html__( 'Featured Image', 'easy-elements' ),
            'set_featured_image'    => esc_html__( 'Set featured image', 'easy-elements' ),
            'remove_featured_image' => esc_html__( 'Remove featured image', 'easy-elements' ),
            'use_featured_image'    => esc_html__( 'Use as featured image', 'easy-elements' ),
            'insert_into_item'      => esc_html__( 'Insert into item', 'easy-elements' ),
            'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'easy-elements' ),
            'items_list'            => esc_html__( 'Items list', 'easy-elements' ),
            'items_list_navigation' => esc_html__( 'Items list navigation', 'easy-elements' ),
            'filter_items_list'     => esc_html__( 'Filter items list', 'easy-elements' ),
        );
        $rewrite = array(
            'slug'       => 'easyelements-content',
            'with_front' => true,
            'pages'      => false,
            'feeds'      => false,
        );
        $args    = array(
            'label'               => esc_html__( 'easyelements item', 'easy-elements' ),
            'description'         => esc_html__( 'easyelements_content', 'easy-elements' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'elementor', 'permalink' ),
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
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
            'show_in_rest'        => true,
            'rest_base'           => 'easyelements-content',
        );
        register_post_type( 'easyelements_content', $args );
    }


}