<?php


namespace EasyElements\Core;


class Modules_List {

    public static function get_all_modules_list() {
        // Retrieve saved modules settings from the options table
        $saved_modules_settings = get_option('ele_features_settings', array());

        $modules_list = array(
            'dynamic-content' => array(
                'slug'            => 'dynamic-content',
                'title'           => 'Dynamic Content',
                'video_tutorial'  => '',
                'document'        => '',
                'update_label'    => 'Updated',
                'visibility'      => false,
                'active'          => true
            ),
            'elementor-sticky' => array(
                'slug'            => 'elementor-sticky',
                'title'           => 'Elementor sticky',
                'video_tutorial'  => '',
                'document'        => '',
                'update_label'    => 'Updated',
                'visibility'      => false,
                'active'          => true
            ),
            'icon-library' => array(
                'slug'            => 'icon-library',
                'title'           => 'EasyElements Icon',
                'video_tutorial'  => '',
                'document'        => '',
                'update_label'    => 'Updated',
                'visibility'      => true,
                'active'          => true
            ),
            'template-builder' => array(
                'slug'            => 'template-builder',
                'title'           => 'Theme builder',
                'video_tutorial'  => '',
                'document'        => '',
                'update_label'    => 'Updated',
                'visibility'      => true,
                'active'          => true,
            ),
            'mega-menu' => array(
                'slug'            => 'mega-menu',
                'title'           => 'Mega Menu',
                'video_tutorial'  => '',
                'document'        => '',
                'update_label'    => 'Updated',
                'visibility'      => true,
                'active'          => true,
            ),
            'template-library' => array(
                'slug'            => 'template-library',
                'title'           => 'Template Library',
                'video_tutorial'  => '',
                'document'        => '',
                'update_label'    => 'Updated',
                'visibility'      => true,
                'active'          => true,
            ),
            'live-copy-paste' => array(
                'slug'            => 'live-copy-paste',
                'title'           => 'Live Copy Paste',
                'video_tutorial'  => '',
                'document'        => '',
                'update_label'    => 'Updated',
                'visibility'      => true,
                'active'          => true,
            ),
            'custom-css' => array(
                'slug'            => 'custom-css',
                'title'           => 'Custom Css',
                'video_tutorial'  => '',
                'document'        => '',
                'update_label'    => 'Updated',
                'visibility'      => true,
                'active'          => true,
            ),
            'floating-effect' => array(
                'slug'            => 'floating-effect',
                'title'           => 'Floating Effect',
                'video_tutorial'  => '',
                'document'        => '',
                'update_label'    => 'Updated',
                'visibility'      => true,
                'active'          => true,
            ),
        );

        if ( count( $saved_modules_settings ) != 0 ) {
            // Update the active status of each module based on the saved settings
            foreach ($modules_list as $key => $module) {
                $modules_list[$key]['active'] = (bool) $saved_modules_settings[$key];
            }
        }

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