<?php

namespace EasyElements\Elementor_Widgets\Init;


class Enqueue_Scripts {

    private $widgets_assets_url;
    
    public function __construct() {
        $this->widgets_assets_url = plugin_dir_url( __FILE__ ) . "assets/";

        //add_action( 'elementor/frontend/after_register_scripts',  array( $this , 'load_frontend_widget_assets' ), 99  );
        add_action( 'wp_enqueue_scripts',  array( $this , 'load_frontend_widget_assets' ), 99  );

        add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'editor_enqueue_styles'] );
        add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'editor_enqueue_script' ) );
        //add_action( 'elementor/editor/after_enqueue_scripts', array( $this, 'editor_enqueue_script' ) );
    }

    public function load_frontend_widget_assets() {



        wp_enqueue_style( 'ele-widget', $this->widgets_assets_url . 'css/widgets.css', array(), ELE_VERSION );

        wp_enqueue_script( 'ele-widget', $this->widgets_assets_url . 'js/widgets.js', array( 'jquery' ), ELE_VERSION, true );
    }

    public function editor_enqueue_styles() {
        wp_enqueue_style( 'ele-elementor', $this->widgets_assets_url . 'css/elementor.css', array(), ELE_VERSION );

    }
    public function editor_enqueue_script() {
        wp_enqueue_script( 'ele-elementor', $this->widgets_assets_url . 'js/elementor.js', ['jquery', 'elementor-frontend' ], ELE_VERSION, true );
    }
}