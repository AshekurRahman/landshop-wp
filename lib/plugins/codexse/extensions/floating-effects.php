<?php
/**
 * Floating Effects extension class.
 *
 * @package Codexse_Addons
 */
namespace Codexse_Addons\Elementor\Extension;

use Elementor\Element_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || die();

class Floating_Effects {

	static $should_script_enqueue = false;

	public static function init() {
		add_action( 'elementor/element/common/_section_style/after_section_end', [ __CLASS__, 'register' ], 1 );

		add_action( 'elementor/frontend/widget/before_render', [ __CLASS__, 'should_script_enqueue' ] );

		add_action( 'elementor/preview/enqueue_scripts', [ __CLASS__, 'enqueue_scripts' ] );
	}

	public static function enqueue_scripts() {
		// Floating effects
		wp_enqueue_script(
			'anime',
			CODEXSE_ADDONS_ASSETS . 'vendor/anime/lib/anime.min.js',
			null,
			CODEXSE_ADDONS_VERSION,
			true
		);

		$extension_js = CODEXSE_ADDONS_DIR_PATH . 'assets/js/extension-floating-effects.min.js';

		if ( file_exists( $extension_js ) ) {
			wp_add_inline_script(
				'elementor-frontend',
				file_get_contents( $extension_js )
			);
		}
	}

	/**
	 * Set should_script_enqueue based extension settings
	 *
	 * @param Element_Base $wrapper
	 * @return void
	 */
	public static function should_script_enqueue( Element_Base $wrapper ) {
		if ( self::$should_script_enqueue ) {
			return;
		}

		if ( 'yes' == $wrapper->get_settings_for_display( 'cx_floating_fx' ) ) {
			self::enqueue_scripts();

			self::$should_script_enqueue = true;

			remove_action( 'elementor/frontend/widget/before_render', [ __CLASS__, 'should_script_enqueue' ] );
		}
	}

	public static function register( Element_Base $element ) {
		$element->start_controls_section(
			'_wrapper_floating_effects',
			[
				'label' => __( 'Floating Effects', 'codexse-elementor-addons' ) . cx_get_section_icon(),
				'tab' => Controls_Manager::TAB_ADVANCED,
			]
		);

		$element->add_control(
			'cx_floating_fx',
			[
				'label' => __( 'Enable', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'cx_floating_fx_translate_toggle',
			[
				'label' => __( 'Translate', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'frontend_available' => true,
				'condition' => [
					'cx_floating_fx' => 'yes',
				]
			]
		);

		$element->start_popover();

		$element->add_control(
			'cx_floating_fx_translate_x',
			[
				'label' => __( 'Translate X', 'codexse-elementor-addons' ),
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
					__( 'From', 'codexse-elementor-addons' ),
					__( 'To', 'codexse-elementor-addons' ),
				],
				'scales' => 1,
				'handles' => 'range',
				'condition' => [
					'cx_floating_fx_translate_toggle' => 'yes',
					'cx_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'cx_floating_fx_translate_y',
			[
				'label' => __( 'Translate Y', 'codexse-elementor-addons' ),
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
					__( 'From', 'codexse-elementor-addons' ),
					__( 'To', 'codexse-elementor-addons' ),
				],
				'scales' => 1,
				'handles' => 'range',
				'condition' => [
					'cx_floating_fx_translate_toggle' => 'yes',
					'cx_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'cx_floating_fx_translate_duration',
			[
				'label' => __( 'Duration', 'codexse-elementor-addons' ),
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
					'cx_floating_fx_translate_toggle' => 'yes',
					'cx_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'cx_floating_fx_translate_delay',
			[
				'label' => __( 'Delay', 'codexse-elementor-addons' ),
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
					'cx_floating_fx_translate_toggle' => 'yes',
					'cx_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->end_popover();

		$element->add_control(
			'cx_floating_fx_rotate_toggle',
			[
				'label' => __( 'Rotate', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'frontend_available' => true,
				'condition' => [
					'cx_floating_fx' => 'yes',
				]
			]
		);

		$element->start_popover();

		$element->add_control(
			'cx_floating_fx_rotate_x',
			[
				'label' => __( 'Rotate X', 'codexse-elementor-addons' ),
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
					__( 'From', 'codexse-elementor-addons' ),
					__( 'To', 'codexse-elementor-addons' ),
				],
				'scales' => 1,
				'handles' => 'range',
				'condition' => [
					'cx_floating_fx_rotate_toggle' => 'yes',
					'cx_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'cx_floating_fx_rotate_y',
			[
				'label' => __( 'Rotate Y', 'codexse-elementor-addons' ),
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
					__( 'From', 'codexse-elementor-addons' ),
					__( 'To', 'codexse-elementor-addons' ),
				],
				'scales' => 1,
				'handles' => 'range',
				'condition' => [
					'cx_floating_fx_rotate_toggle' => 'yes',
					'cx_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'cx_floating_fx_rotate_z',
			[
				'label' => __( 'Rotate Z', 'codexse-elementor-addons' ),
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
					__( 'From', 'codexse-elementor-addons' ),
					__( 'To', 'codexse-elementor-addons' ),
				],
				'scales' => 1,
				'handles' => 'range',
				'condition' => [
					'cx_floating_fx_rotate_toggle' => 'yes',
					'cx_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'cx_floating_fx_rotate_duration',
			[
				'label' => __( 'Duration', 'codexse-elementor-addons' ),
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
					'cx_floating_fx_rotate_toggle' => 'yes',
					'cx_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'cx_floating_fx_rotate_delay',
			[
				'label' => __( 'Delay', 'codexse-elementor-addons' ),
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
					'cx_floating_fx_rotate_toggle' => 'yes',
					'cx_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->end_popover();

		$element->add_control(
			'cx_floating_fx_scale_toggle',
			[
				'label' => __( 'Scale', 'codexse-elementor-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'frontend_available' => true,
				'condition' => [
					'cx_floating_fx' => 'yes',
				]
			]
		);

		$element->start_popover();

		$element->add_control(
			'cx_floating_fx_scale_x',
			[
				'label' => __( 'Scale X', 'codexse-elementor-addons' ),
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
					__( 'From', 'codexse-elementor-addons' ),
					__( 'To', 'codexse-elementor-addons' ),
				],
				'scales' => 1,
				'handles' => 'range',
				'condition' => [
					'cx_floating_fx_scale_toggle' => 'yes',
					'cx_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'cx_floating_fx_scale_y',
			[
				'label' => __( 'Scale Y', 'codexse-elementor-addons' ),
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
					__( 'From', 'codexse-elementor-addons' ),
					__( 'To', 'codexse-elementor-addons' ),
				],
				'scales' => 1,
				'handles' => 'range',
				'condition' => [
					'cx_floating_fx_scale_toggle' => 'yes',
					'cx_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'cx_floating_fx_scale_duration',
			[
				'label' => __( 'Duration', 'codexse-elementor-addons' ),
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
					'cx_floating_fx_scale_toggle' => 'yes',
					'cx_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'cx_floating_fx_scale_delay',
			[
				'label' => __( 'Delay', 'codexse-elementor-addons' ),
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
					'cx_floating_fx_scale_toggle' => 'yes',
					'cx_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->end_popover();

		$element->end_controls_section();
	}
}

Floating_Effects::init();
