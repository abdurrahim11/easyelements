<?php

namespace EasyElements\Modules\Elementor_Sticky;


class Init {

    private $sticky_url;

    public function __construct(){
        $this->sticky_url = ELE_PLUGIN_URL . "includes/modules/elementor-sticky/";
		add_action('elementor/frontend/before_enqueue_scripts', [$this, 'editor_scripts']);

		$this->initialize();
	}

    public function initialize() {
        new Sticky();
	}

	public function editor_scripts(){
		wp_enqueue_script( 'ele-sticky', $this->sticky_url . 'assets/js/sticky.js', array( 'jquery', 'elementor-frontend' ), ELE_VERSION, true );
	}
}
