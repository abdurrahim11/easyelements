<?php
namespace EasyElements\Modules\Floating_Effect;

use Elementor\Controls_Manager;
use Elementor\Element_Base;

class Init {
    private $floating_effect_url_url;
    private $should_script_enqueue = false;

    public function __construct() {
        $this->floating_effect_url_url = ELE_PLUGIN_URL . 'includes/modules/floating-effect/';
        add_action( 'elementor/element/common/_section_style/after_section_end', [ $this, 'register' ], 1 );

        add_action( 'elementor/frontend/widget/before_render', [ $this, 'should_script_enqueue' ] );

        add_action( 'elementor/preview/enqueue_scripts', [ $this, 'enqueue_scripts' ] );
    }

    public function enqueue_scripts() {
        // Floating effects
        wp_enqueue_script( 'anime' );

        wp_enqueue_script(
            'ele-floating',
            $this->floating_effect_url_url . 'js/floating-effect.min.js',
            null,
            ELE_VERSION,
            true
        );
    }

    /**
     * Set should_script_enqueue based extension settings
     *
     * @param Element_Base $section
     * @return void
     */
    public  function should_script_enqueue( Element_Base $section ) {
        if ( $this->should_script_enqueue ) {
            return;
        }

        if ( 'yes' == $section->get_settings_for_display( 'ele_floating_fx' ) ) {
            $this->enqueue_scripts();

            $this->should_script_enqueue = true;

            remove_action( 'elementor/frontend/widget/before_render', [ $this, 'should_script_enqueue' ] );
        }
    }

    public function register( Element_Base $element ) {
        $element->start_controls_section(
            '_section_ele_floating_effects',
            [
                'label' => __( 'Floating Effects', 'easy-elements' ),
                'tab' => Controls_Manager::TAB_ADVANCED,
            ]
        );

        $element->add_control(
            'ele_floating_fx',
            [
                'label' => __( 'Enable', 'easy-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'ele_floating_fx_translate_toggle',
            [
                'label' => __( 'Translate', 'easy-elements' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'frontend_available' => true,
                'condition' => [
                    'ele_floating_fx' => 'yes',
                ]
            ]
        );

        $element->start_popover();

        $element->add_control(
            'ele_floating_fx_translate_x',
            [
                'label' => __( 'Translate X', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'sizes' => [
                        'from' => 0,
                        'to' => 5,
                    ],
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ]
                ],
                'labels' => [
                    __( 'From', 'easy-elements' ),
                    __( 'To', 'easy-elements' ),
                ],
                'scales' => 1,
                'handles' => 'range',
                'condition' => [
                    'ele_floating_fx_translate_toggle' => 'yes',
                    'ele_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'ele_floating_fx_translate_y',
            [
                'label' => __( 'Translate Y', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'sizes' => [
                        'from' => 0,
                        'to' => 5,
                    ],
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ]
                ],
                'labels' => [
                    __( 'From', 'easy-elements' ),
                    __( 'To', 'easy-elements' ),
                ],
                'scales' => 1,
                'handles' => 'range',
                'condition' => [
                    'ele_floating_fx_translate_toggle' => 'yes',
                    'ele_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'ele_floating_fx_translate_duration',
            [
                'label' => __( 'Duration', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10000,
                        'step' => 100
                    ]
                ],
                'default' => [
                    'size' => 1000,
                ],
                'condition' => [
                    'ele_floating_fx_translate_toggle' => 'yes',
                    'ele_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'ele_floating_fx_translate_delay',
            [
                'label' => __( 'Delay', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5000,
                        'step' => 100
                    ]
                ],
                'condition' => [
                    'ele_floating_fx_translate_toggle' => 'yes',
                    'ele_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->end_popover();

        $element->add_control(
            'ele_floating_fx_rotate_toggle',
            [
                'label' => __( 'Rotate', 'easy-elements' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'frontend_available' => true,
                'condition' => [
                    'ele_floating_fx' => 'yes',
                ]
            ]
        );

        $element->start_popover();

        $element->add_control(
            'ele_floating_fx_rotate_x',
            [
                'label' => __( 'Rotate X', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'sizes' => [
                        'from' => 0,
                        'to' => 45,
                    ],
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => -180,
                        'max' => 180,
                    ]
                ],
                'labels' => [
                    __( 'From', 'easy-elements' ),
                    __( 'To', 'easy-elements' ),
                ],
                'scales' => 1,
                'handles' => 'range',
                'condition' => [
                    'ele_floating_fx_rotate_toggle' => 'yes',
                    'ele_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'ele_floating_fx_rotate_y',
            [
                'label' => __( 'Rotate Y', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'sizes' => [
                        'from' => 0,
                        'to' => 45,
                    ],
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => -180,
                        'max' => 180,
                    ]
                ],
                'labels' => [
                    __( 'From', 'easy-elements' ),
                    __( 'To', 'easy-elements' ),
                ],
                'scales' => 1,
                'handles' => 'range',
                'condition' => [
                    'ele_floating_fx_rotate_toggle' => 'yes',
                    'ele_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'ele_floating_fx_rotate_z',
            [
                'label' => __( 'Rotate Z', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'sizes' => [
                        'from' => 0,
                        'to' => 45,
                    ],
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => -180,
                        'max' => 180,
                    ]
                ],
                'labels' => [
                    __( 'From', 'easy-elements' ),
                    __( 'To', 'easy-elements' ),
                ],
                'scales' => 1,
                'handles' => 'range',
                'condition' => [
                    'ele_floating_fx_rotate_toggle' => 'yes',
                    'ele_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'ele_floating_fx_rotate_duration',
            [
                'label' => __( 'Duration', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10000,
                        'step' => 100
                    ]
                ],
                'default' => [
                    'size' => 1000,
                ],
                'condition' => [
                    'ele_floating_fx_rotate_toggle' => 'yes',
                    'ele_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'ele_floating_fx_rotate_delay',
            [
                'label' => __( 'Delay', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5000,
                        'step' => 100
                    ]
                ],
                'condition' => [
                    'ele_floating_fx_rotate_toggle' => 'yes',
                    'ele_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->end_popover();

        $element->add_control(
            'ele_floating_fx_scale_toggle',
            [
                'label' => __( 'Scale', 'easy-elements' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'frontend_available' => true,
                'condition' => [
                    'ele_floating_fx' => 'yes',
                ]
            ]
        );

        $element->start_popover();

        $element->add_control(
            'ele_floating_fx_scale_x',
            [
                'label' => __( 'Scale X', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'sizes' => [
                        'from' => 1,
                        'to' => 1.2,
                    ],
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => .1
                    ]
                ],
                'labels' => [
                    __( 'From', 'easy-elements' ),
                    __( 'To', 'easy-elements' ),
                ],
                'scales' => 1,
                'handles' => 'range',
                'condition' => [
                    'ele_floating_fx_scale_toggle' => 'yes',
                    'ele_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'ele_floating_fx_scale_y',
            [
                'label' => __( 'Scale Y', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'sizes' => [
                        'from' => 1,
                        'to' => 1.2,
                    ],
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => .1
                    ]
                ],
                'labels' => [
                    __( 'From', 'easy-elements' ),
                    __( 'To', 'easy-elements' ),
                ],
                'scales' => 1,
                'handles' => 'range',
                'condition' => [
                    'ele_floating_fx_scale_toggle' => 'yes',
                    'ele_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'ele_floating_fx_scale_duration',
            [
                'label' => __( 'Duration', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10000,
                        'step' => 100
                    ]
                ],
                'default' => [
                    'size' => 1000,
                ],
                'condition' => [
                    'ele_floating_fx_scale_toggle' => 'yes',
                    'ele_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'ele_floating_fx_scale_delay',
            [
                'label' => __( 'Delay', 'easy-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5000,
                        'step' => 100
                    ]
                ],
                'condition' => [
                    'ele_floating_fx_scale_toggle' => 'yes',
                    'ele_floating_fx' => 'yes',
                ],
                'render_type' => 'none',
                'frontend_available' => true,
            ]
        );

        $element->end_popover();

        $element->end_controls_section();
    }
}