<?php

namespace EasyElements\Admin\Dashboard;


/**
 * Class Dashboard
 *
 * @package EasyElements\Admin\Dashboard
 */
class Dashboard {

    public function __construct() {
        add_action('wp_ajax_save_ele_settings', array( $this, 'save_ele_settings' ) );
        add_action('admin_init', [$this, 'remove_admin_notices']);
    }

    /**
     * Dashboard view load
     */
    public function page() {
        require_once ELE_PLUGIN_PATH . 'includes/admin/dashboard/templates/dashboard.php';
    }

    public function save_ele_settings() {
        // Check nonce for security
        check_ajax_referer('ele_save_settings_nonce', 'security');

        // Get the data from the request
        $elements = isset($_POST['elements']) ? $_POST['elements'] : array();
        $features = isset($_POST['features']) ? $_POST['features'] : array();
        $ele_elements_all = isset($_POST['ele_elements_all']) ? sanitize_text_field($_POST['ele_elements_all']) : 0;
        $ele_features_all = isset($_POST['ele_features_all']) ? sanitize_text_field($_POST['ele_features_all']) : 0;

        // Sanitize the data
        $elements = array_map('sanitize_text_field', $elements);
        $features = array_map('sanitize_text_field', $features);

        // Process and save the settings
        update_option('ele_elements_settings', $elements);
        update_option('ele_features_settings', $features);
        update_option('ele_elements_all', $ele_elements_all);
        update_option('ele_features_all', $ele_features_all);

        // Send a response back to the client
        wp_send_json_success();
    }

    public function remove_admin_notices() {
        if (!isset($_GET['page'])) {
            return;
        }

        // Sanitize the input to prevent security issues
        $current_page = sanitize_text_field(wp_unslash($_GET['page']));

        // Ensure this only runs on the correct settings page
        if ($current_page === 'easyelements') {
            remove_all_actions('admin_notices');
            remove_all_actions('network_admin_notices');
            remove_all_actions('user_admin_notices');
        }
    }



}

