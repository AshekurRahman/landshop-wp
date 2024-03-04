<?php
namespace Codexse_Addons\Elementor\Extension;

use Elementor\Element_Base;
use Elementor\Controls_Manager;
use Codexse_Addons\Elementor\Controls\Widget_List;

defined( 'ABSPATH' ) || die();

class Equal_Height {

	static $should_script_enqueue = false;

	public static function init() {

		add_action( 'elementor/element/container/section_layout/after_section_end', [ __CLASS__, 'register' ], 1 );

		add_action( 'elementor/element/section/section_advanced/after_section_end', [ __CLASS__, 'register' ], 1 );

		add_action( 'elementor/frontend/container/before_render', [ __CLASS__, 'should_script_enqueue' ] );

		add_action( 'elementor/frontend/section/before_render', [ __CLASS__, 'should_script_enqueue' ] );

		add_action( 'elementor/preview/enqueue_scripts', [ __CLASS__, 'enqueue_scripts' ] );
	}

	public static function enqueue_scripts() {
		wp_enqueue_script(
			'jquery-match-height',
			CODEXSE_ADDONS_ASSETS . 'vendor/jquery-match-height/jquery.matchHeight-min.js',
			[],
			CODEXSE_ADDONS_VERSION,
			true
		);

		$extension_js = CODEXSE_ADDONS_DIR_PATH . 'assets/js/extension-equal-height.min.js';

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
	 * @param Element_Base $section
	 * @return void
	 */
	public static function should_script_enqueue( Element_Base $section ) {
		if ( self::$should_script_enqueue ) {
			return;
		}

		if ( 'yes' == $section->get_settings_for_display( '_cx_eqh_enable' ) ) {
			self::$should_script_enqueue = true;

			self::enqueue_scripts();

			remove_action( 'elementor/frontend/section/before_render', [ __CLASS__, 'should_script_enqueue' ] );

			remove_action( 'elementor/frontend/container/before_render', [ __CLASS__, 'should_script_enqueue' ] );
		}
	}

	public static function register( Element_Base $element ) {
		$element->start_controls_section(
			'_section_cx_eqh',
			[
				'label' => __( 'Equal Height', 'codexse-elementor-addons' ) . cx_get_section_icon(),
				'tab' => Controls_Manager::TAB_ADVANCED,
			]
		);

		$element->add_control(
			'_cx_eqh_enable',
			[
				'label'        => __( 'Enable', 'codexse-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => false,
				'return_value' => 'yes',
				'render_type'  => 'ui',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'_cx_eqh_to',
			[
				'label' => __( 'Apply To', 'codexse-elementor-addons' ),
				'type'  => Controls_Manager::SELECT,
				'options' => [
					'widget'   => __( 'Widgets', 'codexse-elementor-addons' ),
				],
				'default' => 'widget',
				'condition' => [
					'_cx_eqh_enable' => 'yes',
				],
				'render_type'  => 'ui',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'_cx_eqh_widget',
			[
				'label' => __( 'Select Widgets', 'codexse-elementor-addons' ),
				'label_block' => true,
				'description' => __( 'You can select multiple widgets from the dropdown and these widgets are only from the current selected section.', 'codexse-elementor-addons' ),
				'type' => Widget_List::TYPE,
				'multiple' => true,
				'condition' => [
					'_cx_eqh_enable' => 'yes',
					'_cx_eqh_to' => 'widget'
				],
				'render_type' => 'ui',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'_cx_eqh_disable_on_tablet',
			[
				'label'        => __( 'Disable On Tablet', 'codexse-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
				'render_type'  => 'ui',
				'frontend_available' => true,
				'condition' => [
					'_cx_eqh_enable' => 'yes',
				],
			]
		);

		$element->add_control(
			'_cx_eqh_disable_on_mobile',
			[
				'label'        => __( 'Disable On Mobile', 'codexse-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'render_type'  => 'ui',
				'frontend_available' => true,
				'condition' => [
					'_cx_eqh_enable' => 'yes',
				],
			]
		);

		$element->end_controls_section();
	}
}

Equal_Height::init();
