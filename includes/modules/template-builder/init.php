<?php

namespace EasyElements\Modules\Template_Builder;

/**
 * Class Template_Builder_Init
 *
 * @package EasyElements\Admin\Template_Builder
 */
class Init {

    public function __construct() {
        $this->initialize();
        add_action('init', array($this, 'register_ele_template_builder_post_type'));
        add_action('add_meta_boxes', array($this, 'register_meta_box'));
        add_action('save_post', array($this, 'save_meta'));
        add_filter('manage_ele-template-builder_posts_columns', array($this, 'add_template_type_column'));
        add_action('manage_ele-template-builder_posts_custom_column', array($this, 'render_template_type_column'), 10, 2);
        add_filter('views_edit-ele-template-builder', array( $this,  'add_template_type_tabs' ) );
        add_action( 'pre_get_posts', array( $this, 'filter_by_template_type' ) );

        if ( is_admin() ) {
            add_action( 'admin_init', array( $this, 'init' ), 5 );
        } else {
            add_action( 'wp', array( $this, 'init' ), 5 );
        }
    }

    public function initialize() {
        new \EasyElements\Modules\Template_Builder\Header_Footer();
    }

    public function register_ele_template_builder_post_type() {
        $labels = [
            'name' => esc_html__('Template Builder', 'easy-elements'),
            'singular_name' => esc_html__('Template Builder', 'easy-elements'),
            'menu_name' => esc_html__('Template Builder', 'easy-elements'),
            'name_admin_bar' => esc_html__('Template Builder', 'easy-elements'),
            'add_new' => esc_html__('Add New', 'easy-elements'),
            'add_new_item' => esc_html__('Add New Template Builder', 'easy-elements'),
            'new_item' => esc_html__('New Template Builder', 'easy-elements'),
            'edit_item' => esc_html__('Edit Template Builder', 'easy-elements'),
            'view_item' => esc_html__('View Template Builder', 'easy-elements'),
            'all_items' => esc_html__('All Template Builders', 'easy-elements'),
            'search_items' => esc_html__('Search Template Builders', 'easy-elements'),
            'parent_item_colon' => esc_html__('Parent Template Builders:', 'easy-elements'),
            'not_found' => esc_html__('No Template Builders found.', 'easy-elements'),
            'not_found_in_trash' => esc_html__('No Template Builders found in Trash.', 'easy-elements'),
        ];

        $args = [
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => false,
            'show_in_nav_menus' => false,
            'exclude_from_search' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_icon' => 'dashicons-editor-kitchensink',
            'supports' => ['title', 'thumbnail', 'elementor'],
        ];

        register_post_type('ele-template-builder', $args);
    }

    public function register_meta_box() {
        add_meta_box(
            'ele-meta-box',
            esc_html__('Ele Template Builder Options', 'easy-elements'),
            array($this, 'render_meta_box'),
            'ele-template-builder',
            'normal',
            'high'
        );
    }

    public function render_meta_box( $post ) {
        // Retrieve existing meta data
        $template_type = get_post_meta($post->ID, 'ele_template_type', true);
        $selected_condition = get_post_meta($post->ID, 'ele_condition', true);
        $elementor_canvas = get_post_meta($post->ID, 'ele_is_elementor_canvas', true);
        $is_elementor_canvas = $elementor_canvas != 0 ? 1 : 0;
        ?>
        <div class="ele-meta-box">
            <div class="ele-meta-box-row">
                <label for="ele-template-type" class="ele-meta-box-label"><?php esc_html_e('Template Type:', 'easy-elements'); ?></label>
                <select name="ele-template-type" id="ele-template-type" class="ele-meta-box-select">
                    <option value="type-header" <?php selected($template_type, 'type-header'); ?>><?php esc_html_e('Header', 'easy-elements'); ?></option>
                    <option value="type-footer" <?php selected($template_type, 'type-footer'); ?>><?php esc_html_e('Footer', 'easy-elements'); ?></option>
                </select>
            </div>
            <div class="ele-meta-box-row">
                <label for="ele-condition" class="ele-meta-box-label"><?php esc_html_e('Condition:', 'easy-elements'); ?></label>
                <select name="ele-condition" id="ele-condition" class="ele-meta-box-select">
                    <option value="entire-site" <?php selected($selected_condition, 'entire-site'); ?>><?php esc_html_e('Entire Site', 'easy-elements'); ?></option>
                    <option value="singular" <?php selected($selected_condition, 'singular'); ?>><?php esc_html_e('Singular', 'easy-elements'); ?></option>
                    <option value="archive" <?php selected($selected_condition, 'archive'); ?>><?php esc_html_e('Archive', 'easy-elements'); ?></option>
                </select>
            </div>
            <div class="ele-meta-box-row">
                <label for="ele-is-elementor-canvas" class="ele-meta-box-label">
                    <input type="checkbox" name="ele-is-elementor-canvas" id="ele-is-elementor-canvas" value="1" <?php checked( $is_elementor_canvas, 1 ) ; ?>>
                    <?php esc_html_e('Elementor Canvas', 'easy-elements'); ?>
                </label>
            </div>
            <?php
            // Add nonce field for security
            wp_nonce_field(basename(__FILE__), 'ele_meta_box_nonce');
            ?>
        </div>
        <?php
    }

    public function save_meta($post_id) {
        // Check if the request is an autosave or if the user doesn't have the capability to edit posts
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE || !current_user_can('edit_post', $post_id)) {
            return;
        }

        // Verify nonce
        if (!isset($_POST['ele_meta_box_nonce']) || !wp_verify_nonce($_POST['ele_meta_box_nonce'], basename(__FILE__))) {
            return;
        }

        // Sanitize and save the template type
        if (isset($_POST['ele-template-type'])) {
            $template_type = sanitize_text_field($_POST['ele-template-type']);
            update_post_meta($post_id, 'ele_template_type', $template_type);
        }

        // Sanitize and save the condition
        if (isset($_POST['ele-condition'])) {
            $condition = sanitize_text_field($_POST['ele-condition']);
            update_post_meta($post_id, 'ele_condition', $condition);
        }



        if ( isset( $_POST['ele-is-elementor-canvas'] ) ) {
            update_post_meta( $post_id, '_wp_page_template', 'elementor_canvas' );
            update_post_meta($post_id, 'ele_is_elementor_canvas', sanitize_text_field( $_POST['ele-is-elementor-canvas'] ) );
        } else {
            update_post_meta( $post_id, '_wp_page_template', sanitize_text_field( $_POST['page_template'] ) );
            update_post_meta($post_id, 'ele_is_elementor_canvas',  0 );
        }

    }


    public function add_template_type_column($columns) {
        $date_column = $columns['date'];
        unset($columns['date']);
        $columns['template_type'] = esc_html__('Template Type', 'easy-elements');
        $columns['condition'] = esc_html__('Condition', 'easy-elements');
        $columns['date'] = $date_column;
        return $columns;
    }

    public function render_template_type_column($column, $post_id) {
        if ($column === 'template_type') {
            $template_type = get_post_meta($post_id, 'ele_template_type', true);
            switch ($template_type) {
                case 'type-header':
                    echo esc_html__('Header', 'easy-elements');
                    break;
                case 'type-footer':
                    echo esc_html__('Footer', 'easy-elements');
                    break;
                default:
                    echo esc_html__('Unknown', 'easy-elements');
            }
        }

        if ($column === 'condition') {
            $condition = get_post_meta($post_id, 'ele_condition', true);
            switch ($condition) {
                case 'entire-site':
                    echo esc_html__('Entire Site', 'easy-elements');
                    break;
                case 'singular':
                    echo esc_html__('Singular', 'easy-elements');
                    break;
                case 'archive':
                    echo esc_html__('Archive', 'easy-elements');
                    break;
                default:
                    echo esc_html__('Unknown', 'easy-elements');
            }
        }
    }

    public function add_template_type_tabs() {
        global $pagenow, $post_type;
        if ($pagenow == 'edit.php' && $post_type == 'ele-template-builder') {
            $selected = isset($_GET['ele-template-type']) ? $_GET['ele-template-type'] : 'all';
            $options = array(
                'all'          => 'All',
                'type-header'  => 'Header',
                'type-footer'  => 'Footer'
            );

            echo '<h2 class="nav-tab-wrapper">';
            foreach ($options as $value => $label) {
                $active_class = ($selected == $value) ? 'nav-tab-active' : '';
                echo '<a href="edit.php?post_type=ele-template-builder&ele-template-type=' . $value . '" class="nav-tab ' . $active_class . '">' . $label . '</a>';
            }
            echo '</h2>';
        }
    }

    public function filter_by_template_type($query) {
        global $pagenow;
        if (is_admin() && $pagenow == 'edit.php' && isset($_GET['ele-template-type']) && $query->is_main_query()) {
            $post_type = $query->get('post_type');
            $template_type = sanitize_text_field( $_GET['ele-template-type'] );

            if ($post_type == 'ele-template-builder') {
                if ( $template_type != 'all' ) {
                    $meta_query = array(
                        array(
                            'key' => 'ele_template_type',
                            'value' => $template_type,
                        ),
                    );
                    $query->set('meta_query', $meta_query);
                }
            }
        }
    }

    public function init() {
        flush_rewrite_rules();
    }
}