<?php

namespace EasyElements\Modules\Icon_Library;

class Init {

    private $icon_library_url;

    public function __construct() {
        $this->icon_library_url = ELE_PLUGIN_URL . "includes/modules/icon-library/";
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend' ), 200000 );
        add_action( 'elementor/editor/after_enqueue_scripts', array( $this, 'enqueue_frontend' ), 200000 );
        add_filter( 'elementor/icons_manager/additional_tabs', array( $this, 'add_easy_elements_icons_tab' ) );
    }

    public function enqueue_frontend() {
        wp_enqueue_style( 'eles', $this->icon_library_url . 'assets/css/eleicons.css', array(), ELE_VERSION );
    }

    public function add_easy_elements_icons_tab( $font ) {
        $font_new['easyelements'] = array(
            'name'          => 'easyelements',
            'label'         => esc_html__( 'EasyElements Icon', 'easy-elements' ),
            'url'           => $this->icon_library_url . 'assets/css/eleicons.css?ver=' . ELE_VERSION,
            'prefix'        => 'ele-',
            'displayPrefix' => 'ele',
            'labelIcon'     => 'ele ele-easy-elements',
            'ver'           => ELE_VERSION,
            'fetchJson'     =>  $this->icon_library_url .'assets/js/eleicons.json?v=' . ELE_VERSION,
            'native'        => true,
        );
        return array_merge( $font, $font_new );
    }
}
