<?php


namespace EasyElements;

/**
 * Class Assets
 *
 * @package Easy \Elements
 */
class Assets {

    /**
     * Assets constructor.
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'front_end_enqueue' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );
    }

    /**
     * Front css js enqueue
     */
    public function front_end_enqueue() {
        wp_register_style(
            'ele-custom-carousel',
            ELE_PLUGIN_URL . 'assets/libs/custom-carousel/css/custom-carousel.css',
            null,
            ELE_VERSION
        );

        wp_register_style(
            'ele-carousel',
            ELE_PLUGIN_URL . 'assets/libs/custom-carousel/css/carousel.css',
            ['swiper', 'e-swiper'],
            ELE_VERSION
        );

        wp_register_style(
            'cubeportfolio',
            ELE_PLUGIN_URL . 'assets/libs/cubeportfolio/css/cubeportfolio.min.css',
            null,
            ELE_VERSION
        );

        wp_register_style(
            'ele-contact-form',
            ELE_PLUGIN_URL . 'assets/libs/contact-form/css/contact-form.css',
            null,
            ELE_VERSION
        );

        wp_register_style(
            'owl-carousel',
            ELE_PLUGIN_URL . 'assets/libs/carousel/css/owl.carousel.min.css',
            null,
            ELE_VERSION
        );

        wp_register_script(
            'cubeportfolio',
            ELE_PLUGIN_URL . 'assets/libs/cubeportfolio/js/jquery.cubeportfolio.min.js',
            array( 'jquery' ),
            ELE_VERSION,
            true
        );

        wp_register_script(
            'ele-recaptcha',
            'https://www.google.com/recaptcha/api.js?render=explicit',
            array( 'jquery' ),
            ELE_VERSION,
            false
        );

        wp_register_script(
            'ele-recaptcha-v3',
            'https://www.google.com/recaptcha/api.js?render=' . get_option('uicore_elements_recaptcha_site_key'),
            array( 'jquery' ),
            ELE_VERSION,
            false
        );

        wp_register_script(
            'ele-repeater-custom-key',
            ELE_PLUGIN_URL . 'assets/libs/contact-form/js/repeater-custom-key.js',
            array( 'jquery' ),
            ELE_VERSION,
            true
        );

        wp_register_script(
            'ele-contact-form',
            ELE_PLUGIN_URL . 'assets/libs/contact-form/js/contact-form.js',
            array( 'jquery' ),
            ELE_VERSION,
            true
        );

        wp_register_script(
            'owl-carousel',
            ELE_PLUGIN_URL . 'assets/libs/carousel/js/owl.carousel.min.js',
            array( 'jquery' ),
            ELE_VERSION,
            true
        );

        wp_register_script(
            'waypoints',
            ELE_PLUGIN_URL . 'assets/libs/waypoints/jquery.waypoints.js',
            array( 'jquery' ),
            ELE_VERSION,
            true
        );

        wp_register_script(
            'anime',
            ELE_PLUGIN_URL . 'assets/libs/anime/js/anime.min.js',
            array( 'jquery' ),
            ELE_VERSION,
            true
        );

        wp_register_script(
            'ele-circular-carousel',
            ELE_PLUGIN_URL . 'assets/libs/custom-carousel/circular.js',
            array( 'jquery' ),
            ELE_VERSION,
            true
        );

        wp_register_script(
            'ele-carousel',
            ELE_PLUGIN_URL . 'assets/libs/custom-carousel/global-carousel.js',
            array( 'jquery' ),
            ELE_VERSION,
            true
        );

        wp_register_script(
            'ele-fade-blur-carousel',
            ELE_PLUGIN_URL . 'assets/libs/custom-carousel/js/fade-and-blur.js',
            array( 'jquery' ),
            ELE_VERSION,
            true
        );


        wp_enqueue_script( 'ele-frontend', ELE_PLUGIN_URL . 'assets/front-end/js/front-end.js', array( 'jquery' ), ELE_VERSION, true );

        $js = $this->common_js();
        wp_add_inline_script( 'ele-frontend', $js );
    }

    /**
     * Admin css js enqueue
     */
    public function admin_enqueue() {
        wp_enqueue_style( 'ele-backend', ELE_PLUGIN_URL . 'assets/admin/css/backend.css', null, ELE_VERSION );
        wp_enqueue_style( 'ele-dashboard', ELE_PLUGIN_URL . 'assets/admin/css/dashboard.css', null, ELE_VERSION );

        wp_enqueue_script( 'ele-backend', ELE_PLUGIN_URL . 'assets/admin/js/backend.js', array( 'jquery' ), ELE_VERSION, true );

        wp_localize_script( 'ele-backend', 'easyElements', array(
            'security' => wp_create_nonce("ele_save_settings_nonce"),
            'save_btn_success_text' => esc_html__( 'Saved', 'easyelements' ),
            'save_btn_new_text' => esc_html__( 'Save Settings', 'easyelements' ),
            'failed_text' => esc_html__( 'Failed to save settings.', 'easyelements' ),
        ) );

        $js = $this->common_js();
        wp_add_inline_script( 'ele-backend', $js );
    }


    public function common_js() {
        ob_start(); ?>

        var easyelements = {
        resturl: '<?php echo defined( 'ICL_SITEPRESS_VERSION' ) ? esc_url(home_url('/wp-json/easyelements/v1/')) : esc_url(get_rest_url() . 'easyelements/v1/'); ?>',
        }

        <?php
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

}