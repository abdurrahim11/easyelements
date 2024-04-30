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
        $widget_list = array(
            'navigation-menu' => array(
                'slug'            => 'navigation-menu',
                'title'           => 'Navigation Menu',
                'active'          => true
            ),
            'vertical-menu' => array(
                'slug'            => 'vertical-menu',
                'title'           => 'Vertical Menu',
                'active'          => true
            ),
            'post-grid' => array(
                'slug'            => 'post-grid',
                'title'           => 'Post Grid',
                'active'          => true,
            ),
            'step-flow' => array(
                'slug'            => 'step-flow',
                'title'           => 'Step Flow',
                'active'          => true,
            ),
            'team' => array(
                'slug'            => 'team',
                'title'           => 'Team',
                'active'          => true,
            ),
            'testimonial' => array(
                'slug'            => 'testimonial',
                'title'           => 'Testimonial',
                'active'          => true,
            ),
            'horizontal-timeline' => array(
                'slug'            => 'horizontal-timeline',
                'title'           => 'Horizontal Timeline',
                'active'          => true,
            ),
            'hot-spot' => array(
                'slug'            => 'hot-spot',
                'title'           => 'Hot Spot',
                'active'          => true,
            ),
            'progress-bar' => array(
                'slug'            => 'progress-bar',
                'title'           => 'Progress Bar',
                'active'          => true,
            ),
            'pricing-table' => array(
                'slug'            => 'pricing-table',
                'title'           => 'Pricing Table',
                'active'          => true,
            ),
            'creative-button' => array(
                'slug'            => 'creative-button',
                'title'           => 'Creative Button',
                'active'          => true,
            ),
            'info-box' => array(
                'slug'            => 'info-box',
                'title'           => 'Info Box',
                'active'          => true,
            ),
            'modal-popup' => array(
                'slug'            => 'modal-popup',
                'title'           => 'Modal Popup',
                'active'          => true,
            ),
        );

        /**
         * Filters the list of widgets.
         *
         * @param array $widget_list The list of widgets.
         */
        $widget_list = apply_filters( 'easyelements_widgets_list', $widget_list );

        return $widget_list;
    }

    /**
     * Retrieves active widgets.
     *
     * @return array The array containing active widgets.
     */
    public static function get_active_widget_list() {
        $active_widgets = array();

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
