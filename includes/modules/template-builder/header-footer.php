<?php

namespace EasyElements\Modules\Template_Builder;

/**
 * Class Header_Footer
 *
 * @package EasyElements\Modules\Template_Builder
 */
class Header_Footer {

    private $header_id;
    private $footer_id;

    /**
     * Header_Footer constructor.
     */
    public function __construct() {
        add_action( 'wp', array( $this, 'hooks' ) );
    }

    /**
     * Register hooks for header and footer templates.
     */
    public function hooks() {
        // Check if header template is created
        if ( $header_id = ele_is_template_created('type-header') ) {
            $this->header_id = $header_id;
            $this->render_elementor_content_css( $header_id );
            add_action( 'get_header', array( $this, 'override_header' ) );
            add_action( 'ele_header', array( $this, 'render_header' ) );
        }

        // Check if footer template is created
        if ( $footer_id = ele_is_template_created('type-footer') ) {
            $this->footer_id = $footer_id;
            $this->render_elementor_content_css( $header_id );
            add_action( 'get_footer', array( $this, 'override_footer' ) );
            add_action( 'ele_footer', array( $this, 'render_footer' ) );
        }
    }

    /**
     * Override default header template.
     */
    public function override_header() {
        require __DIR__ . '/template/header.php';
        $templates   = [];
        $templates[] = 'header.php';
        // Avoid running wp_head hooks again.
        remove_all_actions( 'wp_head' );
        ob_start();
        locate_template( $templates, true );
        ob_get_clean();
    }

    /**
     * Render custom header template content.
     */
    public function render_header() {
        do_action('ele_template_before_header');
        echo '<div class="ele-template-content-markup ele-template-content-header">';
        echo $this->render_builder_data( $this->header_id );
        echo '</div>';
        do_action('ele_template_header');
    }

    /**
     * Override default footer template.
     */
    public function override_footer() {
        require __DIR__ . '/template/footer.php';
        $templates   = [];
        $templates[] = 'footer.php';
        // Avoid running wp_footer hooks again.
        remove_all_actions( 'wp_footer' );
        ob_start();
        locate_template( $templates, true );
        ob_get_clean();
    }

    /**
     * Render custom footer template content.
     */
    public function render_footer() {
        do_action( 'ele_before_footer' );
        echo '<div class="ele-template-content-markup ele-template-content-footer">';
        echo $this->render_builder_data( $this->footer_id );
        echo '</div>';
        do_action( 'ele_after_footer' );
    }

    /**
     * Render Elementor builder data.
     *
     * @param int $content_id Content ID.
     * @return string Rendered builder content.
     */
    private function render_builder_data( $content_id ) {
        $elementor_instance = \Elementor\Plugin::instance();
        $has_css            = false;

        /**
         * CSS Print Method Internal and External option support for Header and Footer Builder.
         */
        if ( ( 'internal' === get_option( 'elementor_css_print_method' ) ) || \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
            $has_css = true;
        }

        return $elementor_instance->frontend->get_builder_content_for_display( $content_id, $has_css );
    }

    public function render_elementor_content_css( $content_id ) {
        if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
            $css_file = new \Elementor\Core\Files\CSS\Post( $content_id );
            $css_file->enqueue();
        }
    }
}
