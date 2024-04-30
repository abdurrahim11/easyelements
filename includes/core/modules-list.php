<?php


namespace EasyElements\Core;


class Modules_List {

    public static function get_all_modules_list() {
        $modules_list = array(
            'dynamic-content' => array(
                'slug'            => 'dynamic-content',
                'title'           => 'Dynamic Content',
                'visibility'      => false,
                'active'          => true
            ),
            'elementor-sticky' => array(
                'slug'            => 'elementor-sticky',
                'title'           => 'Elementor sticky',
                'visibility'      => false,
                'active'          => true
            ),
            'icon-library' => array(
                'slug'            => 'icon-library',
                'title'           => 'EasyElements Icon',
                'visibility'      => true,
                'active'          => true
            ),
            'template-builder' => array(
                'slug'            => 'template-builder',
                'title'           => 'Header Footer',
                'visibility'      => true,
                'active'          => true,
            ),
            'mega-menu' => array(
                'slug'            => 'mega-menu',
                'title'           => 'Mega Menu',
                'visibility'      => true,
                'active'          => true,
            ),
            'template-library' => array(
                'slug'            => 'template-library',
                'title'           => 'Template Library',
                'visibility'      => true,
                'active'          => true,
            ),
            'live-copy-paste' => array(
                'slug'            => 'live-copy-paste',
                'title'           => 'Live Copy Paste',
                'visibility'      => true,
                'active'          => true,
            ),
            'custom-css' => array(
                'slug'            => 'custom-css',
                'title'           => 'Custom Css',
                'visibility'      => true,
                'active'          => true,
            ),
            'floating-effect' => array(
                'slug'            => 'floating-effect',
                'title'           => 'Floating Effect',
                'visibility'      => true,
                'active'          => true,
            ),
        );

        $modules_list = apply_filters( 'easyelements_moduless_list', $modules_list );

        return $modules_list;
    }

    public static function get_active_modules_list() {
        $active_modules = array();

        // Get all modules.
        $all_moduless = self::get_all_modules_list();

        // Loop through all moduless and filter active ones.
        foreach ( $all_moduless as $key => $modules ) {
            if ( $modules['active'] ) {
                $active_modules[$key] = $modules;
            }
        }

        return $active_modules;
    }
}