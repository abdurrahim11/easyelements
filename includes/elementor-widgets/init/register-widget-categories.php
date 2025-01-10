<?php
/**
 * Register custom Elementor categories.
 *
 * @package EasyElements
 */

namespace EasyElements\Elementor_Widgets\Init;

/**
 * Class Register_Widget_Categories
 */
class Register_Widget_Categories {

    /**
     * Constructor to hook into Elementor actions.
     */
    public function __construct() {
        add_action( 'elementor/elements/categories_registered', array( $this, 'add_elementor_widget_categories' ) );
    }

    /**
     * Add custom widget categories.
     *
     */
    public function add_elementor_widget_categories( $elements_manager ) {
        // Add the custom category.
        $elements_manager->add_category(
            'easy-elements',
            array(
                'title' => esc_html__( 'Easy Elements', 'easy-elements' ),
                'icon'  => 'fa fa-plug',
            )
        );

        $this->reorder_categories( $elements_manager );
    }

    /**
     * Reorder categories to place 'easy-elements' after 'basic'.
     *
     */
    public function reorder_categories( $elements_manager ) {
        // Use the get_categories method to retrieve the categories.
        $categories = $elements_manager->get_categories();

        // Check if 'basic' and 'easy-elements' categories exist.
        if ( isset( $categories['basic'] ) && isset( $categories['easy-elements'] ) ) {
            // Preserve the 'easy-elements' category and remove it from the array.
            $easy_elements_category = $categories['easy-elements'];
            unset( $categories['easy-elements'] );

            // Find the position of the 'basic' category.
            $basic_category_position = array_search( 'basic', array_keys( $categories ) );

            // Insert 'easy-elements' after 'basic'.
            $categories = array_merge(
                array_slice( $categories, 0, $basic_category_position + 1, true ),
                array( 'easy-elements' => $easy_elements_category ),
                array_slice( $categories, $basic_category_position + 1, null, true )
            );

            // Use reflection to set the reordered categories.
            $reflection = new \ReflectionClass( $elements_manager );
            $property   = $reflection->getProperty( 'categories' );
            $property->setAccessible( true );
            $property->setValue( $elements_manager, $categories );
        }
    }
}