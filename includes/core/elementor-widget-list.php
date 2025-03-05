<?php


namespace EasyElements\Core;

/**
 * Class Elementor_Widget_List
 */
class Elementor_Widget_List {

    /**
     * Retrieves all widgets.
     *
     * @return array The array containing all widgets.
     */
    public static function get_all_widget_list() {
        // Retrieve saved widgets settings from the options table
        $saved_widgets_settings = get_option('ele_elements_settings', array());

        $widget_list = array(
            'navigation-menu' => array(
                'slug'            => 'navigation-menu',
                'title'           => 'Navigation Menu',
                'video_tutorial'  => '',
                'document'        => '',
                'update_label'    => 'Updated',
                'active'          => false
            ),
            'vertical-menu' => array(
                'slug'            => 'vertical-menu',
                'title'           => 'Vertical Menu',
                'video_tutorial'  => '',
                'document'        => '',
                'update_label'    => 'Popular',
                'active'          => true
            ),
            'post-grid' => array(
                'slug'            => 'post-grid',
                'title'           => 'Post Grid',
                'video_tutorial'  => '',
                'document'        => '',
                'update_label'    => 'Updated',
                'active'          => true,
            ),
            'step-flow' => array(
                'slug'            => 'step-flow',
                'title'           => 'Step Flow',
                'video_tutorial'  => '',
                'document'        => '',
                'update_label'    => 'Updated',
                'active'          => true,
            ),
            'team' => array(
                'slug'            => 'team',
                'title'           => 'Team',
                'video_tutorial'  => '',
                'document'        => '',
                'update_label'    => 'Updated',
                'active'          => true,
            ),
            'testimonial' => array(
                'slug'            => 'testimonial',
                'title'           => 'Testimonial',
                'video_tutorial'  => '',
                'document'        => '',
                'update_label'    => 'Updated',
                'active'          => true,
            ),
            'horizontal-timeline' => array(
                'slug'            => 'horizontal-timeline',
                'title'           => 'Horizontal Timeline',
                'video_tutorial'  => '',
                'document'        => '',
                'update_label'    => 'Updated',
                'active'          => true,
            ),
            'hot-spot' => array(
                'slug'            => 'hot-spot',
                'title'           => 'Hot Spot',
                'video_tutorial'  => '',
                'document'        => '',
                'update_label'    => 'Updated',
                'active'          => true,
            ),
            'progress-bar' => array(
                'slug'            => 'progress-bar',
                'title'           => 'Progress Bar',
                'video_tutorial'  => '',
                'document'        => '',
                'update_label'    => 'Updated',
                'active'          => true,
            ),
            'pricing-table' => array(
                'slug'            => 'pricing-table',
                'title'           => 'Pricing Table',
                'video_tutorial'  => '',
                'document'        => '',
                'update_label'    => 'Updated',
                'active'          => true,
            ),
            'easy-button' => array(
                'slug'            => 'easy-button',
                'title'           => 'Easy Button',
                'video_tutorial'  => '',
                'document'        => '',
                'update_label'    => 'Updated',
                'active'          => true,
            ),
            'info-box' => array(
                'slug'            => 'info-box',
                'title'           => 'Info Box',
                'video_tutorial'  => '',
                'document'        => '',
                'update_label'    => 'Updated',
                'active'          => true,
            ),
            'modal-popup' => array(
                'slug'            => 'modal-popup',
                'title'           => 'Modal Popup',
                'video_tutorial'  => '',
                'document'        => '',
                'update_label'    => 'Updated',
                'active'          => true,
            ),
        );

        if ( count( $saved_widgets_settings ) != 0 ) {
            // Update the active status of each widget based on the saved settings
            foreach ($widget_list as $key => $widget) {
                $widget_list[$key]['active'] = (bool) $saved_widgets_settings[$key];
            }
        }

        $widget_list = apply_filters( 'easyelements_widgets_list', $widget_list );

        return $widget_list;
    }

    /**
     * Retrieves active widgets.
     *
     * @return array The array containing active widgets.
     */
    public static function get_active_widget_list() {

        // Get all widgets.
        $all_widgets = self::get_all_widget_list();

        // Loop through all widgets and filter active ones.
        foreach ( $all_widgets as $key => $widget ) {
            if ( $widget['active'] ) {
                $active_widgets[$key] = $widget;
            }
        }

        return $active_widgets;
    }
}
