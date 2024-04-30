<?php

namespace EasyElements\Modules\Template_Library;

use Elementor\TemplateLibrary\Source_Local;

/**
 * Custom Template Library Source Class
 *
 * @package EasyElements\Modules\Template_Library
 */
class Library_Source extends Source_Local {

    private $dependencies;

    /**
     * Import template and handle plugin installation and activation
     *
     * @param array $args
     * @param string $context
     * @return mixed
     * @throws \Exception
     */
    public function import(array $args, $context = 'display') {
        $template_api_url = sprintf('%stemplate-kit/%d', ELE_KITS_BASE_API_URL, sanitize_text_field($args['template_id']));
        $template_info = $this->get_api_request($template_api_url);
        $template_result = json_decode($template_info, true);
        if (!is_array($template_result) || !isset($template_result['json_url'])) {
            throw new \Exception(__('Template missing', 'easy-elements'));
        }

        $this->install_activate_required_plugins($template_result);

        $template_data = $this->get_api_request($template_result['json_url']);
        $data = json_decode($template_data, true);
        if (empty($data) || empty($data['content'])) {
            throw new \Exception(__('Template does not have any content', 'easy-elements'));
        }

        $data['content'] = $this->replace_elements_ids($data['content']);
        $data['content'] = $this->process_export_import_content($data['content'], 'on_import');

        $post_id = $args['editor_post_id'];
        $document = \Elementor\Plugin::instance()->documents->get($post_id);

        if ($document) {
            $data['content'] = $document->get_elements_raw_data($data['content'], true);
        }

        $data['dependencies'] = false;
        if( $this->dependencies >= 1 ) {
            $data['dependencies'] = true;
        }
        return $data;
    }

    /**
     * Helper method to install and activate required plugins
     *
     * @param $template_result
     * @throws \Exception
     */
    private function install_activate_required_plugins($template_result) {

        if (isset($template_result['dependencies']) && $template_result['dependencies'] !== false) {
            foreach ($template_result['dependencies'] as $dependency) {
                $plugin_slug = $dependency['slug'];
                if (!$this->is_plugin_installed( dirname( $plugin_slug ) )) {
                    $install_result = $this->install_plugin_by_slug($plugin_slug);
                    if (is_wp_error($install_result)) {
                        throw new \Exception(__('Error installing plugin', 'easy-elements'));
                    }
                }

                if (!is_plugin_active( $plugin_slug )) {
                    $activation_result = activate_plugin( $plugin_slug );
                    if (is_wp_error($activation_result)) {
                        throw new \Exception(__('Error activating plugin', 'easy-elements'));
                    }
                    $this->dependencies++;
                }
            }
        }
    }

    /**
     * Helper method to check if a plugin is installed
     *
     * @param $plugin_slug
     * @return bool
     */
    private function is_plugin_installed($plugin_slug) {
        return file_exists(WP_PLUGIN_DIR . '/' . $plugin_slug);
    }

    /**
     * Helper method to install a plugin by slug
     *
     * @param $plugin_slug
     * @return array|bool|object|\WP_Error
     */
    private function install_plugin_by_slug($plugin_slug) {
        include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
        include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

        $api = plugins_api('plugin_information', array('slug' => $plugin_slug));
        if (is_wp_error($api)) {
            return $api;
        }

        $upgrader = new \Plugin_Upgrader(new \WP_Ajax_Upgrader_Skin());
        $install_result = $upgrader->install($api->download_link);
        return $install_result;
    }

    /**
     * Helper method to perform an API request
     *
     * @param $request_url
     * @return string|void
     */
    private function get_api_request($request_url) {
        if (empty($request_url)) {
            return;
        }

        $response = wp_remote_get($request_url, array(
            'timeout' => 120,
            'httpversion' => '1.1',
        ));

        return wp_remote_retrieve_body($response);
    }
}
