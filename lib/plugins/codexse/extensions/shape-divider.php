<?php
namespace Codexse_Addons\Elementor\Extension;

use Elementor\Controls_Manager;
use Elementor\Element_Base;
use Elementor\Shapes;

defined( 'ABSPATH' ) || die();

class Shape_Divider {

	public static function init() {
		add_filter( 'elementor/shapes/additional_shapes', [__CLASS__, 'additional_shape_divider'] );
		add_action( 'elementor/element/section/section_shape_divider/before_section_end', [__CLASS__, 'update_shape_list'] );
		add_action( 'elementor/element/container/section_shape_divider/before_section_end', [__CLASS__, 'update_shape_list'] );
	}

	public static function update_shape_list( Element_Base $element ) {
		$default_shapes = [];
		$codexse_shapes_top = [];
		$codexse_shapes_bottom = [];

		foreach ( Shapes::get_shapes() as $shape_name => $shape_props ) {
			if ( ! isset( $shape_props['cx_shape'] ) ) {
				$default_shapes[ $shape_name ] = $shape_props['title'];
			} elseif ( ! isset( $shape_props['cx_shape_bottom'] ) ){
				$codexse_shapes_top[ $shape_name ] = $shape_props['title'];
			} else {
				$codexse_shapes_bottom[ $shape_name ] = $shape_props['title'];
			}
		}

		$element->update_control(
			'shape_divider_top',
			[
				'type' => Controls_Manager::SELECT,
				'groups' => [
					[
						'label' => __( 'Disable', 'codexse-elementor-addons' ),
						'options' => [
							'' => __( 'None', 'codexse-elementor-addons' ),
						],
					],
					[
						'label' => __( 'Default Shapes', 'codexse-elementor-addons' ),
						'options' => $default_shapes,
					],
					[
						'label' => __( 'Codexse Shapes', 'codexse-elementor-addons' ),
						'options' => $codexse_shapes_top,
					],
				],
			]
		);

		$element->update_control(
			'shape_divider_bottom',
			[
				'type' => Controls_Manager::SELECT,
				'groups' => [
					[
						'label' => __( 'Disable', 'codexse-elementor-addons' ),
						'options' => [
							'' => __( 'None', 'codexse-elementor-addons' ),
						],
					],
					[
						'label' => __( 'Default Shapes', 'codexse-elementor-addons' ),
						'options' => $default_shapes,
					],
					[
						'label' => __( 'Codexse Shapes', 'codexse-elementor-addons' ),
						'options' => array_merge( $codexse_shapes_top, $codexse_shapes_bottom ),
					],
				],
			]
		);
	}

	/**
	 * Undocumented function
	 *
	 * @param array $shape_list
	 * @return void
	 */
	public static function additional_shape_divider( $shape_list ) {
		$codexse_shapes = [
			'abstract-web' => [
				'title' => _x( 'Abstract Web', 'Shapes', 'codexse-elementor-addons' ),
				'path' => CODEXSE_ADDONS_DIR_PATH . 'assets/imgs/shape-divider/abstract-web.svg',
				'url' => CODEXSE_ADDONS_ASSETS . 'imgs/shape-divider/abstract-web.svg',
				'has_flip' => true,
				'has_negative' => false,
				'cx_shape' => true,
			],
			'crossline' => [
				'title' => _x( 'Crossline', 'Shapes', 'codexse-elementor-addons' ),
				'path' => CODEXSE_ADDONS_DIR_PATH . 'assets/imgs/shape-divider/crossline.svg',
				'url' => CODEXSE_ADDONS_ASSETS . 'imgs/shape-divider/crossline.svg',
				'has_flip' => true,
				'has_negative' => false,
				'cx_shape' => true,
			],
			'droplet' => [
				'title' => _x( 'Droplet', 'Shapes', 'codexse-elementor-addons' ),
				'path' => CODEXSE_ADDONS_DIR_PATH . 'assets/imgs/shape-divider/droplet.svg',
				'url' => CODEXSE_ADDONS_ASSETS . 'imgs/shape-divider/droplet.svg',
				'has_flip' => true,
				'has_negative' => true,
				'cx_shape' => true,
			],
			'flame' => [
				'title' => _x( 'Flame', 'Shapes', 'codexse-elementor-addons' ),
				'path' => CODEXSE_ADDONS_DIR_PATH . 'assets/imgs/shape-divider/flame.svg',
				'url' => CODEXSE_ADDONS_ASSETS . 'imgs/shape-divider/flame.svg',
				'has_flip' => true,
				'has_negative' => false,
				'cx_shape' => true,
			],
			'frame' => [
				'title' => _x( 'Frame', 'Shapes', 'codexse-elementor-addons' ),
				'path' => CODEXSE_ADDONS_DIR_PATH . 'assets/imgs/shape-divider/frame.svg',
				'url' => CODEXSE_ADDONS_ASSETS . 'imgs/shape-divider/frame.svg',
				'has_flip' => true,
				'has_negative' => true,
				'cx_shape' => true,
			],
			'half-circle' => [
				'title' => _x( 'Half Circle', 'Shapes', 'codexse-elementor-addons' ),
				'path' => CODEXSE_ADDONS_DIR_PATH . 'assets/imgs/shape-divider/half-circle.svg',
				'url' => CODEXSE_ADDONS_ASSETS . 'imgs/shape-divider/half-circle.svg',
				'has_flip' => true,
				'has_negative' => true,
				'cx_shape' => true,
			],
			'multi-cloud' => [
				'title' => _x( 'Multi Cloud', 'Shapes', 'codexse-elementor-addons' ),
				'path' => CODEXSE_ADDONS_DIR_PATH . 'assets/imgs/shape-divider/multi-cloud.svg',
				'url' => CODEXSE_ADDONS_ASSETS . 'imgs/shape-divider/multi-cloud.svg',
				'has_flip' => true,
				'has_negative' => false,
				'cx_shape' => true,
			],
			'multi-wave' => [
				'title' => _x( 'Multi Wave', 'Shapes', 'codexse-elementor-addons' ),
				'path' => CODEXSE_ADDONS_DIR_PATH . 'assets/imgs/shape-divider/multi-wave.svg',
				'url' => CODEXSE_ADDONS_ASSETS . 'imgs/shape-divider/multi-wave.svg',
				'has_flip' => true,
				'has_negative' => false,
				'cx_shape' => true,
			],
			'smooth-zigzag' => [
				'title' => _x( 'Smooth Zigzag', 'Shapes', 'codexse-elementor-addons' ),
				'path' => CODEXSE_ADDONS_DIR_PATH . 'assets/imgs/shape-divider/smooth-zigzag.svg',
				'url' => CODEXSE_ADDONS_ASSETS . 'imgs/shape-divider/smooth-zigzag.svg',
				'has_flip' => true,
				'has_negative' => false,
				'cx_shape' => true,
			],
			'splash' => [
				'title' => _x( 'Splash', 'Shapes', 'codexse-elementor-addons' ),
				'path' => CODEXSE_ADDONS_DIR_PATH . 'assets/imgs/shape-divider/splash.svg',
				'url' => CODEXSE_ADDONS_ASSETS . 'imgs/shape-divider/splash.svg',
				'has_flip' => true,
				'has_negative' => true,
				'cx_shape' => true,
			],
			'splash2' => [
				'title' => _x( 'Splash 2', 'Shapes', 'codexse-elementor-addons' ),
				'path' => CODEXSE_ADDONS_DIR_PATH . 'assets/imgs/shape-divider/splash2.svg',
				'url' => CODEXSE_ADDONS_ASSETS . 'imgs/shape-divider/splash2.svg',
				'has_flip' => true,
				'has_negative' => true,
				'cx_shape' => true,
			],
			'torn-paper' => [
				'title' => _x( 'Torn Paper', 'Shapes', 'codexse-elementor-addons' ),
				'path' => CODEXSE_ADDONS_DIR_PATH . 'assets/imgs/shape-divider/torn-paper.svg',
				'url' => CODEXSE_ADDONS_ASSETS . 'imgs/shape-divider/torn-paper.svg',
				'has_flip' => true,
				'has_negative' => false,
				'cx_shape' => true,
			],
			'brush' => [
				'title' => _x( 'Brush', 'Shapes', 'codexse-elementor-addons' ),
				'path' => CODEXSE_ADDONS_DIR_PATH . 'assets/imgs/shape-divider/brush.svg',
				'url' => CODEXSE_ADDONS_ASSETS . 'imgs/shape-divider/brush.svg',
				'has_flip' => true,
				'has_negative' => true,
				'cx_shape' => true,
			],
			'sports' => [
				'title' => _x( 'Sports', 'Shapes', 'codexse-elementor-addons' ),
				'path' => CODEXSE_ADDONS_DIR_PATH . 'assets/imgs/shape-divider/sports.svg',
				'url' => CODEXSE_ADDONS_ASSETS . 'imgs/shape-divider/sports.svg',
				'has_flip' => true,
				'has_negative' => false,
				'cx_shape' => true,
				'cx_shape_bottom' => true,
			],
			'landscape' => [
				'title' => _x( 'Landscape', 'Shapes', 'codexse-elementor-addons' ),
				'path' => CODEXSE_ADDONS_DIR_PATH . 'assets/imgs/shape-divider/landscape.svg',
				'url' => CODEXSE_ADDONS_ASSETS . 'imgs/shape-divider/landscape.svg',
				'has_flip' => true,
				'has_negative' => false,
				'cx_shape' => true,
				'cx_shape_bottom' => true,
			],
			'nature' => [
				'title' => _x( 'Nature', 'Shapes', 'codexse-elementor-addons' ),
				'path' => CODEXSE_ADDONS_DIR_PATH . 'assets/imgs/shape-divider/nature.svg',
				'url' => CODEXSE_ADDONS_ASSETS . 'imgs/shape-divider/nature.svg',
				'has_flip' => true,
				'has_negative' => false,
				'cx_shape' => true,
				'cx_shape_bottom' => true,
			],
			'desert' => [
				'title' => _x( 'Desert', 'Shapes', 'codexse-elementor-addons' ),
				'path' => CODEXSE_ADDONS_DIR_PATH . 'assets/imgs/shape-divider/desert.svg',
				'url' => CODEXSE_ADDONS_ASSETS . 'imgs/shape-divider/desert.svg',
				'has_flip' => true,
				'has_negative' => false,
				'cx_shape' => true,
				'cx_shape_bottom' => true,
			],
			'under-water' => [
				'title' => _x( 'Under Water', 'Shapes', 'codexse-elementor-addons' ),
				'path' => CODEXSE_ADDONS_DIR_PATH . 'assets/imgs/shape-divider/under-water.svg',
				'url' => CODEXSE_ADDONS_ASSETS . 'imgs/shape-divider/under-water.svg',
				'has_flip' => true,
				'has_negative' => false,
				'cx_shape' => true,
				'cx_shape_bottom' => true,
			],
			'cityscape-layer' => [
				'title' => _x( 'Cityscape Layer', 'Shapes', 'codexse-elementor-addons' ),
				'path' => CODEXSE_ADDONS_DIR_PATH . 'assets/imgs/shape-divider/cityscape-layer.svg',
				'url' => CODEXSE_ADDONS_ASSETS . 'imgs/shape-divider/cityscape-layer.svg',
				'has_flip' => true,
				'has_negative' => false,
				'cx_shape' => true,
				'cx_shape_bottom' => true,
			],
			'drop' => [
				'title' => _x( 'Drop', 'Shapes', 'codexse-elementor-addons' ),
				'path' => CODEXSE_ADDONS_DIR_PATH . 'assets/imgs/shape-divider/drop.svg',
				'url' => CODEXSE_ADDONS_ASSETS . 'imgs/shape-divider/drop.svg',
				'has_flip' => true,
				'has_negative' => false,
				'cx_shape' => true,
			],
			'mosque' => [
				'title' => _x( 'Mosque', 'Shapes', 'codexse-elementor-addons' ),
				'path' => CODEXSE_ADDONS_DIR_PATH . 'assets/imgs/shape-divider/mosque.svg',
				'url' => CODEXSE_ADDONS_ASSETS . 'imgs/shape-divider/mosque.svg',
				'has_flip' => true,
				'has_negative' => false,
				'cx_shape' => true,
			],
			'christmas' => [
				'title' => _x( 'Christmas', 'Shapes', 'codexse-elementor-addons' ),
				'path' => CODEXSE_ADDONS_DIR_PATH . 'assets/imgs/shape-divider/christmas.svg',
				'url' => CODEXSE_ADDONS_ASSETS . 'imgs/shape-divider/christmas.svg',
				'has_flip' => true,
				'has_negative' => true,
				'cx_shape' => true,
			],
			'christmas2' => [
				'title' => _x( 'Christmas 2', 'Shapes', 'codexse-elementor-addons' ),
				'path' => CODEXSE_ADDONS_DIR_PATH . 'assets/imgs/shape-divider/christmas2.svg',
				'url' => CODEXSE_ADDONS_ASSETS . 'imgs/shape-divider/christmas2.svg',
				'has_flip' => true,
				'has_negative' => true,
				'cx_shape' => true,
			]
		];

		/*
		 * svg path should contain elementor class to show in editor mode
		*/
		return array_merge( $codexse_shapes, $shape_list );
	}
}

Shape_Divider::init();
