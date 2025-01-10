<?php
namespace EasyElements\Modules\Floating_Effect;

use Elementor\Controls_Manager;
use Elementor\Element_Base;

class Init {
    private $is_script_enqueued = false;

    public function __construct() {
        add_action( 'elementor/element/common/_section_style/after_section_end', [ $this, 'register_controls' ], 1 );
        add_action( 'elementor/frontend/widget/before_render', [ $this, 'check_should_enqueue_script' ] );
        add_action( 'elementor/preview/enqueue_scripts', [ $this, 'enqueue_scripts' ] );
    }

    /**
     * Enqueue required scripts for floating effects.
     */
    public function enqueue_scripts() {
        wp_enqueue_script( 'anime' );
        wp_enqueue_script(
            'ele-floating',
            ELE_PLUGIN_URL . 'includes/modules/floating-effect/js/floating-effect.min.js',
            null,
            ELE_VERSION,
            true
        );
    }

    /**
     * Conditionally enqueue scripts based on element settings.
     *
     * @param Element_Base $section The Elementor element instance.
     */
    public function check_should_enqueue_script( Element_Base $section ) {
        if ( $this->is_script_enqueued ) {
            return;
        }

        if ( 'yes' === $section->get_settings_for_display( 'ele_floating_fx' ) ) {
            $this->enqueue_scripts();
            $this->is_script_enqueued = true;
            remove_action( 'elementor/frontend/widget/before_render', [ $this, 'check_should_enqueue_script' ] );
        }
    }

    /**
     * Register floating effect controls for Elementor elements.
     *
     * @param Element_Base $element The Elementor element instance.
     */
    public function register_controls( Element_Base $element ) {
        $element->start_controls_section(
            '_section_ele_floating_effects',
            [
                'label' => esc_html__( 'Floating Effects', 'easy-elements' ),
                'tab' => Controls_Manager::TAB_ADVANCED,
            ]
        );

        $element->add_control(
            'ele_floating_fx',
            [
                'label' => esc_html__( 'Enable', 'easy-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'ele_floating_fx_translate_toggle',
            [
                'label' => esc_html__( 'Translate', 'easy-elements' ),
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
                'label' => esc_html__( 'Translate X', 'easy-elements' ),
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
                    esc_html__( 'From', 'easy-elements' ),
                    esc_html__( 'To', 'easy-elements' ),
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
                'label' => esc_html__( 'Translate Y', 'easy-elements' ),
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
                    esc_html__( 'From', 'easy-elements' ),
                    esc_html__( 'To', 'easy-elements' ),
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
                'label' => esc_html__( 'Duration', 'easy-elements' ),
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
                'label' => esc_html__( 'Delay', 'easy-elements' ),
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
                'label' => esc_html__( 'Rotate', 'easy-elements' ),
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
                'label' => esc_html__( 'Rotate X', 'easy-elements' ),
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
                    esc_html__( 'From', 'easy-elements' ),
                    esc_html__( 'To', 'easy-elements' ),
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
                'label' => esc_html__( 'Rotate Y', 'easy-elements' ),
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
                    esc_html__( 'From', 'easy-elements' ),
                    esc_html__( 'To', 'easy-elements' ),
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
                'label' => esc_html__( 'Rotate Z', 'easy-elements' ),
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
                    esc_html__( 'From', 'easy-elements' ),
                    esc_html__( 'To', 'easy-elements' ),
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
                'label' => esc_html__( 'Duration', 'easy-elements' ),
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
                'label' => esc_html__( 'Delay', 'easy-elements' ),
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
                'label' => esc_html__( 'Scale', 'easy-elements' ),
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
                'label' => esc_html__( 'Scale X', 'easy-elements' ),
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
                    esc_html__( 'From', 'easy-elements' ),
                    esc_html__( 'To', 'easy-elements' ),
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
                'label' => esc_html__( 'Scale Y', 'easy-elements' ),
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
                    esc_html__( 'From', 'easy-elements' ),
                    esc_html__( 'To', 'easy-elements' ),
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
                'label' => esc_html__( 'Duration', 'easy-elements' ),
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
                'label' => esc_html__( 'Delay', 'easy-elements' ),
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