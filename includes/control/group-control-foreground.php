<?php
namespace EasyElements\Control;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Base;

class Group_Control_Foreground extends Group_Control_Base {

    /**
     * Holds all the foreground control fields.
     *
     * @access protected
     * @static
     * @var array Foreground control fields.
     */
    protected static $fields;

    /**
     * Retrieve the control type, in this case, 'foreground'.
     *
     * @return string Control type.
     * @since 1.0.0
     * @access public
     * @static
     */
    public static function get_type() {
        return 'foreground';
    }

    /**
     * Initialize foreground control fields.
     *
     * @return array Control fields.
     * @since 1.0.0
     * @access public
     */
    public function init_fields() {
        $fields = array();

        // Define the color type selection field (Classic or Gradient).
        $fields['color_type'] = array(
            'label'       => _x( 'Color Type', 'Background Control', 'easyelements' ),
            'type'        => Controls_Manager::CHOOSE,
            'label_block' => false,
            'render_type' => 'ui',
            'options'     => array(
                'classic'  => array(
                    'title' => _x( 'Classic', 'Text Color Control', 'easyelements' ),
                    'icon'  => 'eicon-paint-brush',
                ),
                'gradient' => array(
                    'title' => _x( 'Gradient', 'Text Color Control', 'easyelements' ),
                    'icon'  => 'eicon-barcode',
                ),
            ),
        );

        // Define the color field for text color.
        $fields['color'] = array(
            'label'     => _x( 'Color', 'Background Control', 'easyelements' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '',
            'title'     => _x( 'Color', 'Background Control', 'easyelements' ),
            'selectors' => array(
                '{{SELECTOR}}' => 'color: {{VALUE}};',
            ),
            'condition' => array(
                'color_type' => array( 'classic', 'gradient' ),
            ),
        );

        // Define the color stop location for gradient color.
        $fields['color_stop'] = array(
            'label'       => _x( 'Location', 'Background Control', 'easyelements' ),
            'type'        => Controls_Manager::SLIDER,
            'size_units'  => array( '%' ),
            'default'     => array(
                'unit' => '%',
                'size' => 0,
            ),
            'render_type' => 'ui',
            'condition'   => array(
                'color_type' => array( 'gradient' ),
            ),
            'of_type'     => 'gradient',
        );

        // Define the second color field for gradient color.
        $fields['color_b'] = array(
            'label'       => _x( 'Second Color', 'Background Control', 'easyelements' ),
            'type'        => Controls_Manager::COLOR,
            'default'     => '#f2295b',
            'render_type' => 'ui',
            'condition'   => array(
                'color_type' => array( 'gradient' ),
            ),
            'of_type'     => 'gradient',
        );

        // Define the second color stop location for gradient color.
        $fields['color_b_stop'] = array(
            'label'       => _x( 'Location', 'Background Control', 'easyelements' ),
            'type'        => Controls_Manager::SLIDER,
            'size_units'  => array( '%' ),
            'default'     => array(
                'unit' => '%',
                'size' => 100,
            ),
            'render_type' => 'ui',
            'condition'   => array(
                'color_type' => array( 'gradient' ),
            ),
            'of_type'     => 'gradient',
        );

        // Define the gradient type selection field (Linear or Radial).
        $fields['gradient_type'] = array(
            'label'       => _x( 'Type', 'Background Control', 'easyelements' ),
            'type'        => Controls_Manager::SELECT,
            'options'     => array(
                'linear' => _x( 'Linear', 'Background Control', 'easyelements' ),
                'radial' => _x( 'Radial', 'Background Control', 'easyelements' ),
            ),
            'default'     => 'linear',
            'render_type' => 'ui',
            'condition'   => array(
                'color_type' => array( 'gradient' ),
            ),
            'of_type'     => 'gradient',
        );

        // Define the gradient angle field for linear gradients.
        $fields['gradient_angle'] = array(
            'label'      => _x( 'Angle', 'Background Control', 'easyelements' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => array( 'deg' ),
            'default'    => array(
                'unit' => 'deg',
                'size' => 180,
            ),
            'range'      => array(
                'deg' => array(
                    'step' => 10,
                ),
            ),
            'selectors'  => array(
                '{{SELECTOR}}' => '-webkit-background-clip: text; -webkit-text-fill-color: transparent; background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
            ),
            'condition'  => array(
                'color_type'    => array( 'gradient' ),
                'gradient_type' => 'linear',
            ),
            'of_type'    => 'gradient',
        );

        // Define the gradient position field for radial gradients.
        $fields['gradient_position'] = array(
            'label'     => _x( 'Position', 'Background Control', 'easyelements' ),
            'type'      => Controls_Manager::SELECT,
            'options'   => array(
                'center center' => _x( 'Center Center', 'Background Control', 'easyelements' ),
                'center left'   => _x( 'Center Left', 'Background Control', 'easyelements' ),
                'center right'  => _x( 'Center Right', 'Background Control', 'easyelements' ),
                'top center'    => _x( 'Top Center', 'Background Control', 'easyelements' ),
                'top left'      => _x( 'Top Left', 'Background Control', 'easyelements' ),
                'top right'     => _x( 'Top Right', 'Background Control', 'easyelements' ),
                'bottom center' => _x( 'Bottom Center', 'Background Control', 'easyelements' ),
                'bottom left'   => _x( 'Bottom Left', 'Background Control', 'easyelements' ),
                'bottom right'  => _x( 'Bottom Right', 'Background Control', 'easyelements' ),
            ),
            'default'   => 'center center',
            'selectors' => array(
                '{{SELECTOR}}' => '-webkit-background-clip: text; -webkit-text-fill-color: transparent; background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
            ),
            'condition' => array(
                'color_type'    => array( 'gradient' ),
                'gradient_type' => 'radial',
            ),
            'of_type'   => 'gradient',
        );

        return $fields;
    }

    /**
     * Retrieve the default arguments for all the child controls for a specific group control.
     *
     * @return array Default arguments for all the child controls.
     * @since 1.0.0
     * @access protected
     */
    protected function get_child_default_args() {
        return array(
            'types' => array( 'classic', 'gradient' ),
        );
    }

    /**
     * Filter which controls to display, using `include`, `exclude`, `condition`, and `of_type` arguments.
     *
     * @return array Control fields.
     * @since 1.0.0
     * @access protected
     */
    protected function filter_fields() {
        $fields = parent::filter_fields();

        $args = $this->get_args();

        foreach ( $fields as &$field ) {
            if ( isset( $field['of_type'] ) && ! in_array( $field['of_type'], $args['types'], true ) ) {
                unset( $field );
            }
        }

        return $fields;
    }

    /**
     * Retrieve the default options of the foreground control.
     *
     * @return array Default foreground control options.
     * @since 1.0.0
     * @access protected
     */
    protected function get_default_options() {
        return array(
            'popover' => false,
        );
    }
}