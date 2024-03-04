<?php
namespace Codexse_Addons\Elementor;

defined( 'ABSPATH' ) || die();

class Extensions_Manager {
	const FEATURES_DB_KEY = 'codexseaddons_inactive_features';

	/**
	 * Initialize
	 */
	public static function init() {
		// include_once CODEXSE_ADDONS_DIR_PATH . 'extensions/column-extended.php';
		include_once CODEXSE_ADDONS_DIR_PATH . 'extensions/widgets-extended.php';

		if ( is_user_logged_in() ) {
			include_once CODEXSE_ADDONS_DIR_PATH . 'classes/review.php';
		}

		if ( is_user_logged_in() && cx_is_adminbar_menu_enabled() ) {
			include_once CODEXSE_ADDONS_DIR_PATH . 'classes/admin-bar.php';
		}

		if ( is_user_logged_in() && cx_is_codexse_clone_enabled() ) {
			include_once CODEXSE_ADDONS_DIR_PATH . 'classes/clone-handler.php';
		}

		$inactive_features = self::get_inactive_features();

		foreach ( self::get_local_features_map() as $feature_key => $data ) {
			if ( ! in_array( $feature_key, $inactive_features ) ) {
				self::enable_feature( $feature_key );
			}
		}

		foreach ( self::get_pro_features_map() as $feature_key => $data ) {
			if ( in_array( $feature_key, $inactive_features ) ) {
				self::disable_pro_feature( $feature_key );
			}
		}
	}

	public static function get_features_map() {
		$features_map = [];

		$local_features_map = self::get_local_features_map();
		$features_map = array_merge( $features_map, $local_features_map );

		return apply_filters( 'codexseaddons_get_features_map', $features_map );
	}

	public static function get_inactive_features() {
		return get_option( self::FEATURES_DB_KEY, [] );
	}

	public static function save_inactive_features( $features = [] ) {
		update_option( self::FEATURES_DB_KEY, $features );
	}

	/**
	 * Get the pro features map for dashboard only
	 *
	 * @return array
	 */
	public static function get_pro_features_map() {
		return [
			'display-conditions' => [
				'title' => __( 'Display Condition', 'codexse-elementor-addons' ),
				'icon' => 'hm hm-display-condition',
				'demo' => 'https://codexseaddons.com/display-condition/',
				'is_pro' => true,
			],
			'image-masking' => [
				'title' => __( 'Image Masking', 'codexse-elementor-addons' ),
				'icon' => 'hm hm-image-masking',
				'demo' => 'https://codexseaddons.com/image-masking-demo/',
				'is_pro' => true,
			],
			'codexse-particle-effects' => [
				'title' => __( 'Codexse Particle Effects', 'codexse-elementor-addons' ),
				'icon' => 'hm hm-spark',
				'demo' => 'https://codexseaddons.com/codexse-particle-effect/',
				'is_pro' => true,
			],
			'codexse-preset' => [
				'title' => __( 'Preset', 'codexse-elementor-addons' ),
				'icon' => 'hm hm-color-card',
				'demo' => 'https://codexseaddons.com/presets-demo/',
				'is_pro' => true,
			]
		];
	}

	/**
	 * Get the free features map
	 *
	 * @return array
	 */
	public static function get_local_features_map() {
		return [
			'background-overlay' => [
				'title' => __( 'Background Overlay', 'codexse-elementor-addons' ),
				'icon' => 'hm hm-layer',
				'demo' => 'https://codexseaddons.com/background-overlay-demo/',
				'is_pro' => false,
			],
			'grid-layer' => [
				'title' => __( 'Grid Layer', 'codexse-elementor-addons' ),
				'icon' => 'hm hm-grid',
				'demo' => 'https://codexseaddons.com/codexse-grid-layout-demo/',
				'is_pro' => false,
			],
			'floating-effects' => [
				'title' => __( 'Floating Effects', 'codexse-elementor-addons' ),
				'icon' => 'hm hm-weather-flood',
				'demo' => 'https://codexseaddons.com/elementor-floating-effect-demo-2/',
				'is_pro' => false,
			],
			'wrapper-link' => [
				'title' => __( 'Wrapper Link', 'codexse-elementor-addons' ),
				'icon' => 'hm hm-section-link',
				'demo' => 'https://codexseaddons.com/wrapper-link-feature-demo/',
				'is_pro' => false,
			],
			'css-transform' => [
				'title' => __( 'CSS Transform', 'codexse-elementor-addons' ),
				'icon' => 'hm hm-3d-rotate',
				'demo' => 'https://codexseaddons.com/elementor-css-transform-demo-3/',
				'is_pro' => false,
			],
			'css-transform' => [
				'title' => __( 'CSS Transform', 'codexse-elementor-addons' ),
				'icon' => 'hm hm-3d-rotate',
				'demo' => 'https://codexseaddons.com/elementor-css-transform-demo-3/',
				'is_pro' => false,
			],
			'equal-height' => [
				'title' => __( 'Equal Height Column', 'codexse-elementor-addons' ),
				'icon' => 'hm hm-grid-layout',
				'demo' => 'https://codexseaddons.com/equal-height-feature/',
				'is_pro' => false,
			],
			'shape-divider' => [
				'title' => __( 'Shape Divider', 'codexse-elementor-addons' ),
				'icon' => 'hm hm-map',
				'demo' => 'https://codexseaddons.com/codexse-shape-divider/',
				'is_pro' => false,
			],
			'column-extended' => [
				'title' => __( 'Column Order & Extension', 'codexse-elementor-addons' ),
				'icon' => 'hm hm-flip-card2',
				'demo' => 'https://codexseaddons.com/codexse-column-control/',
				'is_pro' => false,
			],
			'advanced-tooltip' => [
				'title' => __( 'Codexse Tooltip', 'codexse-elementor-addons' ),
				'icon' => 'hm hm-comment-square',
				'demo' => 'https://codexseaddons.com/codexse-tooltip/',
				'is_pro' => false,
			],
			'text-stroke' => [
				'title' => __( 'Text Stroke', 'codexse-elementor-addons' ),
				'icon' => 'hm hm-text-outline',
				'demo' => 'https://codexseaddons.com/text-stroke/',
				'is_pro' => false,
			],
			'scroll-to-top' => [
				'title' => __( 'Scroll To Top', 'codexse-elementor-addons' ),
				'icon' => 'hm hm-scroll-top',
				// 'demo' => 'https://codexseaddons.com/text-stroke/',
				'is_pro' => false,
			],
		];
	}

	protected static function enable_feature( $feature_key ) {
		$feature_file = CODEXSE_ADDONS_DIR_PATH . 'extensions/' . $feature_key . '.php';

		if ( is_readable( $feature_file ) ) {
			include_once( $feature_file );
		}
	}

	protected static function disable_pro_feature( $feature_key ) {
		switch ($feature_key) {
			case 'display-conditions':
				add_filter( 'codexseaddons/extensions/display_condition', '__return_false' );
				break;

			case 'image-masking':
				add_filter( 'codexseaddons/extensions/image_masking', '__return_false' );
				break;

			case 'codexse-particle-effects':
				add_filter( 'codexseaddons/extensions/codexse_particle_effects', '__return_false' );
				break;

			// case 'codexse-preset':
			// 	add_filter( 'codexseaddons/extensions/codexse_preset', '__return_false' );
			// 	break;
		}
	}
}

Extensions_Manager::init();
