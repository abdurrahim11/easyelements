<?php

namespace EasyElements\Modules\Template_Library;


/**
 * Class Library_Manager
 *
 * @package EasyElements\Modules\Editor\Template_Library
 */
class Init {

    public function __construct() {
        $this->initialize();
        add_action( 'elementor/preview/enqueue_styles', array( $this, 'preview_styles' ) );

        // Template Library Assets
        add_action( 'elementor/editor/before_enqueue_scripts', array( $this,  "enqueue_elementor_scripts" ), 0 );
        add_action('elementor/editor/after_enqueue_styles', array( $this, "editor_styles" ) );

        add_action('elementor/editor/footer', array( $this, 'admin_inline_js' ) );
        add_action( 'elementor/editor/footer', array( $this, 'print_template_views' ) );
    }

    public function initialize() {
       new \EasyElements\Modules\Template_Library\Api();
       new \EasyElements\Modules\Template_Library\Import();
    }

    public function preview_styles() {
        wp_enqueue_style(
            'ele-library-editor-preview',
            ELE_PLUGIN_URL . 'includes/modules/template-library/assets/css/elementor-editor-preview.css',
            array(),
            ELE_VERSION
        );
    }

    public function enqueue_elementor_scripts() {
        wp_enqueue_script(
            'ele-library-editor',
            ELE_PLUGIN_URL . 'includes/modules/template-library/assets/js/elementor-editor.js',
            array(
                'jquery',
                'underscore',
                'backbone-marionette',
            ),
            ELE_VERSION,
            true
        );
    }

    public function editor_styles() {
        wp_enqueue_style(
            'ele-library-editor',
            ELE_PLUGIN_URL . 'includes/modules/template-library/assets/css/elementor-editor.css',
            array(),
            ELE_VERSION
        );
    }

    public function admin_inline_js() {
        // Define the initial data array
        $easy_temps_data = array(
            "libraryButton" => "Elements Button",
            "modalRegions" => array(
                "modalHeader" => ".dialog-header",
                "modalContent" => ".dialog-message"
            ),
            "license" => array(
                "activated" => true,
                "link" => "https://easyelementspro.com/"
            ),
            "tabs" => array(
                "ele_page" => array(
                    "title" => "Pages",
                    "data" => array(),
                    "settings" => array(
                        "show_title" => true,
                        "show_keywords" => true
                    )
                ),
                "ele_block" => array(
                    "title" => "Blocks",
                    "data" => array(),
                    "settings" => array(
                        "show_title" => false,
                        "show_keywords" => true
                    )
                ),
                "ele_header" => array(
                    "title" => "Headers",
                    "data" => array(),
                    "settings" => array(
                        "show_title" => false,
                        "show_keywords" => true
                    )
                ),
                "ele_footer" => array(
                    "title" => "Footers",
                    "data" => array(),
                    "settings" => array(
                        "show_title" => false,
                        "show_keywords" => true
                    )
                ),
            ),
            "defaultTab" => "ele_page",
            "new_demo_rang_date" => gmdate('Ymd', strtotime('-31 days')),
            "nonce" => wp_create_nonce('easyelements_nonce') // Generate the nonce
        );

        // Apply the filter so other developers can modify the data
        $easy_temps_data = apply_filters('easyelements_template_library_data', $easy_temps_data);

        // Output the JavaScript
        ?>
        <script type="text/javascript">
            var EasyTempsData = <?php echo json_encode($easy_temps_data); ?>;
        </script>
        <?php
    }


    public function print_template_views() {
        include_once ELE_PLUGIN_PATH . 'includes/modules/template-library/templates/templates.php';
    }

}