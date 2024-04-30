<?php

namespace EasyElements\Elementor_Widgets;


class Enqueue_Scripts {

    public function __construct() {
        //add_action( 'elementor/frontend/after_register_scripts',  array( $this , 'load_frontend_widget_assets' ), 99  );
        add_action( 'wp_enqueue_scripts',  array( $this , 'load_frontend_widget_assets' ), 99  );

        add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'editor_enqueue_styles'] );
        add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'editor_enqueue_script' ) );
        //add_action( 'elementor/editor/after_enqueue_scripts', array( $this, 'editor_enqueue_script' ) );
    }

    public function load_frontend_widget_assets() {
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



        //wp_enqueue_style( 'xpro-widget-css', ELE_WIDGET_ASSETS_URL . 'css/xpro-widgets.css', array(), ELE_VERSION );
        wp_enqueue_style( 'ele-widget-css', ELE_WIDGET_ASSETS_URL . 'css/widgets.css', array(), ELE_VERSION );


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



        wp_enqueue_script( 'ele-widget-js', ELE_WIDGET_ASSETS_URL . 'js/widgets.js', array( 'jquery' ), ELE_VERSION, true );
    }

    public function editor_enqueue_styles() {
        wp_enqueue_style( 'ele-elementor', ELE_WIDGET_ASSETS_URL . 'css/elementor.css', array(), ELE_VERSION );

    }
    public function editor_enqueue_script() {
        wp_enqueue_script( 'ele-elementor', ELE_WIDGET_ASSETS_URL . 'js/elementor.js', ['jquery', 'elementor-frontend' ], ELE_VERSION, true );
    }
}