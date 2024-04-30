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
            ELE_PLUGIN_URL . 'assets/editor/template-library/css/elementor-editor-preview.css',
            array(),
            ELE_VERSION
        );
    }

    public function enqueue_elementor_scripts() {
        wp_enqueue_script(
            'ele-library-editor',
            ELE_PLUGIN_URL . 'assets/editor/template-library/js/elementor-editor.js',
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
            ELE_PLUGIN_URL . 'assets/editor/template-library/css/elementor-editor.css',
            array(),
            ELE_VERSION
        );
    }

    public function admin_inline_js() { ?>
        <script type="text/javascript">
            var EasyTempsData = {
                "libraryButton": "Elements Button",
                "modalRegions": {
                    "modalHeader": ".dialog-header",
                    "modalContent": ".dialog-message"
                },
                "license": {
                    "activated": false,
                    "link": "https://easyelementspro.com/"
                },
                "tabs": {
                    "ele_page": {
                        "title": "Pages",
                        "data": [],
                        "settings": {
                            "show_title": true,
                            "show_keywords": true
                        }
                    },
                    "ele_block": {
                        "title": "Blocks",
                        "data": [],
                        "settings": {
                            "show_title": false,
                            "show_keywords": true
                        }
                    },
                    "ele_header": {
                        "title": "Headers",
                        "data": [],
                        "settings": {
                            "show_title": false,
                            "show_keywords": true
                        }
                    },
                    "ele_footer": {
                        "title": "Footers",
                        "data": [],
                        "settings": {
                            "show_title": false,
                            "show_keywords": true
                        }
                    },
                },
                "defaultTab": "ele_page",
                "new_demo_rang_date": "<?php echo date('Ymd', strtotime('-31 days')) ?>"
            };
        </script> <?php
    }


    public function print_template_views() {
        include_once ELE_PLUGIN_PATH . 'includes/modules/template-library/templates/templates.php';
    }

}