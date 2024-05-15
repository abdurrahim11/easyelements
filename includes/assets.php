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
            'cubeportfolio',
            ELE_PLUGIN_URL . 'assets/libs/cubeportfolio/css/cubeportfolio.min.css',
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
            'owl-carousel',
            ELE_PLUGIN_URL . 'assets/libs/carousel/js/owl.carousel.min.js',
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


        wp_enqueue_script( 'ele-frontend', ELE_PLUGIN_URL . 'assets/front-end/js/front-end.js', array( 'jquery' ), ELE_VERSION, true );

        $js = $this->common_js();
        wp_add_inline_script( 'ele-frontend', $js );
    }

    /**
     * Admin css js enqueue
     */
    public function admin_enqueue() {
        wp_enqueue_style( 'ele-backend', ELE_PLUGIN_URL . 'assets/admin/css/backend.css', null, ELE_VERSION );

        wp_enqueue_script( 'ele-backend', ELE_PLUGIN_URL . 'assets/admin/js/backend.js', array( 'jquery' ), ELE_VERSION, true );

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