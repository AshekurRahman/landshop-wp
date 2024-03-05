<?php

namespace Codexse_Addons\Elementor;

use Elementor\Core\Files\CSS\Post as Post_CSS;
use Elementor\Core\Settings\Manager as SettingsManager;

defined('ABSPATH') || die();

class Assets_Manager {

	/**
	 * Bind hook and run internal methods here
	 */
	public static function init() {
		// Frontend scripts
		add_action('wp_enqueue_scripts', [__CLASS__, 'frontend_register']);
		add_action('wp_enqueue_scripts', [__CLASS__, 'frontend_enqueue'], 100);
		add_action('elementor/css-file/post/enqueue', [__CLASS__, 'frontend_enqueue_exceptions']);

		// Edit and preview enqueue
		add_action('elementor/preview/enqueue_styles', [__CLASS__, 'enqueue_preview_styles']);

		// Enqueue editor scripts
		add_action('elementor/editor/after_enqueue_scripts', [__CLASS__, 'editor_enqueue']);

		// Paragraph toolbar registration
		add_filter('elementor/editor/localize_settings', [__CLASS__, 'add_inline_editing_intermediate_toolbar']);

		/**
		 * @see self::fix_pro_assets_loading
		 */
		//self::fix_pro_assets_loading();
	}

	/**
	 * Register inline editing paragraph toolbar
	 *
	 * @param array $config
	 * @return array
	 */
	public static function add_inline_editing_intermediate_toolbar($config) {
		if (!isset($config['inlineEditing'])) {
			return $config;
		}

		$tools = [
			'bold',
			'underline',
			'italic',
			'createlink',
		];

		if (isset($config['inlineEditing']['toolbar'])) {
			$config['inlineEditing']['toolbar']['intermediate'] = $tools;
		} else {
			$config['inlineEditing'] = [
				'toolbar' => [
					'intermediate' => $tools,
				],
			];
		}

		return $config;
	}

	/**
	 * Register frontend assets.
	 *
	 * Frontend assets handler will be used in widgets map
	 * to load widgets assets on demand.
	 *
	 * @return void
	 */
	public static function frontend_register() {
		$suffix = cx_is_script_debug_enabled() ? '.' : '.min.';

		wp_register_style(
			'codexse-icons',
			CODEXSE_ADDONS_ASSETS . 'fonts/style.min.css',
			null,
			CODEXSE_ADDONS_VERSION
		);

		// Image comparasion
		wp_register_style(
			'twentytwenty',
			CODEXSE_ADDONS_ASSETS . 'vendor/twentytwenty/css/twentytwenty.css',
			null,
			CODEXSE_ADDONS_VERSION
		);

		wp_register_script(
			'jquery-event-move',
			CODEXSE_ADDONS_ASSETS . 'vendor/twentytwenty/js/jquery.event.move.js',
			['jquery'],
			CODEXSE_ADDONS_VERSION,
			true
		);

		wp_register_script(
			'jquery-twentytwenty',
			CODEXSE_ADDONS_ASSETS . 'vendor/twentytwenty/js/jquery.twentytwenty.js',
			['jquery-event-move'],
			CODEXSE_ADDONS_VERSION,
			true
		);

		// Justified Grid
		wp_register_style(
			'justifiedGallery',
			CODEXSE_ADDONS_ASSETS . 'vendor/justifiedGallery/css/justifiedGallery.min.css',
			null,
			CODEXSE_ADDONS_VERSION
		);

		wp_register_script(
			'jquery-justifiedGallery',
			CODEXSE_ADDONS_ASSETS . 'vendor/justifiedGallery/js/jquery.justifiedGallery.min.js',
			['jquery'],
			CODEXSE_ADDONS_VERSION,
			true
		);

		// Carousel and Slider
		wp_register_style(
			'slick',
			CODEXSE_ADDONS_ASSETS . 'vendor/slick/slick.css',
			null,
			CODEXSE_ADDONS_VERSION
		);

		wp_register_style(
			'slick-theme',
			CODEXSE_ADDONS_ASSETS . 'vendor/slick/slick-theme.css',
			null,
			CODEXSE_ADDONS_VERSION
		);

		wp_register_script(
			'jquery-slick',
			CODEXSE_ADDONS_ASSETS . 'vendor/slick/slick.min.js',
			['jquery'],
			CODEXSE_ADDONS_VERSION,
			true
		);

		// Masonry grid
		wp_register_script(
			'jquery-isotope',
			CODEXSE_ADDONS_ASSETS . 'vendor/jquery.isotope.js',
			['jquery'],
			CODEXSE_ADDONS_VERSION,
			true
		);

		// Number animation
		wp_register_script(
			'jquery-numerator',
			CODEXSE_ADDONS_ASSETS . 'vendor/jquery-numerator/jquery-numerator.min.js',
			['jquery'],
			CODEXSE_ADDONS_VERSION,
			true
		);

		// Magnific popup
		wp_register_style(
			'magnific-popup',
			CODEXSE_ADDONS_ASSETS . 'vendor/magnific-popup/magnific-popup.css',
			null,
			CODEXSE_ADDONS_VERSION
		);

		wp_register_script(
			'jquery-magnific-popup',
			CODEXSE_ADDONS_ASSETS . 'vendor/magnific-popup/jquery.magnific-popup.min.js',
			null,
			CODEXSE_ADDONS_VERSION,
			true
		);

		// keyframes
		wp_register_script(
			'jquery-keyframes',
			CODEXSE_ADDONS_ASSETS . 'vendor/keyframes/jquery.keyframes.min.js',
			['jquery'],
			CODEXSE_ADDONS_VERSION,
			true
		);

		// Chart.js
		wp_register_script(
			'chart-js',
			CODEXSE_ADDONS_ASSETS . 'vendor/chart/chart.min.js',
			['jquery'],
			CODEXSE_ADDONS_VERSION,
			true
		);

		// Threesixty Rotation js
		wp_register_script(
			'circlr',
			CODEXSE_ADDONS_ASSETS . 'vendor/threesixty-rotation/circlr.min.js',
			['jquery'],
			CODEXSE_ADDONS_VERSION,
			true
		);

		// codexse magnify js
		wp_register_script(
			'cx-simple-magnify',
			CODEXSE_ADDONS_ASSETS . 'vendor/threesixty-rotation/codexse-simple-magnify.js',
			['jquery'],
			CODEXSE_ADDONS_VERSION,
			true
		);

		// fullcalendar js
		wp_register_script(
			'cx-fullcalendar',
			CODEXSE_ADDONS_ASSETS . 'vendor/fullcalendar/fullcalendar.min.js',
			['jquery'],
			CODEXSE_ADDONS_VERSION,
			true
		);

		// fullcalendar language js
		wp_register_script(
			'cx-fullcalendar-locales',
			CODEXSE_ADDONS_ASSETS . 'vendor/fullcalendar/locales-all.min.js',
			['jquery'],
			CODEXSE_ADDONS_VERSION,
			true
		);

		// fullcalendar css
		wp_register_style(
			'cx-fullcalendar',
			CODEXSE_ADDONS_ASSETS . 'vendor/fullcalendar/fullcalendar.min.css',
			null,
			CODEXSE_ADDONS_VERSION
		);

		// Hover css
		wp_register_style(
			'hover-css',
			CODEXSE_ADDONS_ASSETS . 'vendor/hover-css/hover-css.css',
			null,
			CODEXSE_ADDONS_VERSION
		);

		// Sharer JS
		wp_register_script(
			'sharer-js',
			CODEXSE_ADDONS_ASSETS . 'vendor/sharer-js/sharer.min.js',
			['jquery'],
			CODEXSE_ADDONS_VERSION,
			true
		);


		// Codexse addons PDF JS
		wp_register_script(
			'pdf-js',
			'//cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.7/pdfobject.min.js',
			[],
			CODEXSE_ADDONS_VERSION,
			false
		);
		// Codexse addons LordIcon JS
		wp_register_script(
			'lord-icon',
			CODEXSE_ADDONS_ASSETS . 'vendor/lord-icon/lord-icon-2.1.0.js',
			[],
			CODEXSE_ADDONS_VERSION,
			false
		);
		// Main assets
		wp_register_style(
			'codexse-elementor-addons',
			CODEXSE_ADDONS_ASSETS . 'css/main' . $suffix . 'css',
			['elementor-frontend'],
			CODEXSE_ADDONS_VERSION
		);

		// Codexse addons script
		wp_register_script(
			'codexse-elementor-addons',
			CODEXSE_ADDONS_ASSETS . 'js/codexse-addons' . $suffix . 'js',
			['jquery'],
			CODEXSE_ADDONS_VERSION,
			true
		);

		//Localize scripts
		wp_localize_script(
			'codexse-elementor-addons',
			'CodexseLocalize',
			[
				'ajax_url' => admin_url('admin-ajax.php'),
				'nonce'    => wp_create_nonce('codexse_addons_nonce'),
				'pdf_js_lib' => CODEXSE_ADDONS_ASSETS . 'vendor/pdfjs/lib'
			]
		);
	}

	/**
	 * Handle exception cases where regular enqueue won't work
	 *
	 * @param Post_CSS $file
	 *
	 * @return void
	 */
	public static function frontend_enqueue_exceptions(Post_CSS $file) {
		$post_id = $file->get_post_id();

		if (get_queried_object_id() === $post_id) {
			return;
		}

		$template_type = get_post_meta($post_id, '_elementor_template_type', true);

		if ($template_type === 'kit') {
			return;
		}

		self::enqueue($post_id);
	}

	/**
	 * Enqueue fontend assets
	 *
	 * @return void
	 */
	public static function frontend_enqueue() {
		if (!is_singular()) {
			return;
		}

		self::enqueue(get_the_ID());
	}

	/**
	 * Just enqueue the assets
	 *
	 * It just processes the assets from cache if avilable
	 * otherwise raw assets
	 *
	 * @param int $post_id
	 *
	 * @return void
	 */
	public static function enqueue($post_id) {
		if (Cache_Manager::should_enqueue($post_id)) {
			Cache_Manager::enqueue($post_id);
		}

		if (Cache_Manager::should_enqueue_raw($post_id)) {
			Cache_Manager::enqueue_raw($post_id);
		}
	}

	public static function get_dark_stylesheet_url() {
		return CODEXSE_ADDONS_ASSETS . 'admin/css/editor-dark.min.css';
	}

	public static function enqueue_dark_stylesheet() {
		$theme = SettingsManager::get_settings_managers('editorPreferences')->get_model()->get_settings('ui_theme');

		if ('light' !== $theme) {
			$media_queries = 'all';

			if ('auto' === $theme) {
				$media_queries = '(prefers-color-scheme: dark)';
			}

			wp_enqueue_style(
				'codexse-addons-editor-dark',
				self::get_dark_stylesheet_url(),
				[
					'elementor-editor',
				],
				CODEXSE_ADDONS_VERSION,
				$media_queries
			);
		}
	}

	/**
	 * Enqueue editor assets
	 *
	 * @return void
	 */
	public static function editor_enqueue() {

		wp_enqueue_style(
			'codexse-icons',
			CODEXSE_ADDONS_ASSETS . 'fonts/style.min.css',
			null,
			CODEXSE_ADDONS_VERSION
		);

		wp_enqueue_style(
			'codexse-elementor-addons-editor',
			CODEXSE_ADDONS_ASSETS . 'admin/css/editor.min.css',
			null,
			CODEXSE_ADDONS_VERSION
		);

		wp_enqueue_script(
			'codexse-elementor-addons-editor',
			CODEXSE_ADDONS_ASSETS . 'admin/js/editor.min.js',
			['elementor-editor', 'jquery'],
			CODEXSE_ADDONS_VERSION,
			true
		);

		Library_Manager::enqueue_assets();

		/**
		 * Make sure to enqueue this at the end
		 * otherwise it may not work properly
		 */
		self::enqueue_dark_stylesheet();

		$localize_data = [
			'placeholder_widgets' => [],
			'hasPro'                  => cx_has_pro(),
			'editor_nonce'            => wp_create_nonce('cx_editor_nonce'),
			'dark_stylesheet_url'     => self::get_dark_stylesheet_url(),
			'i18n' => [
				'promotionDialogHeader'     => esc_html__('%s Widget', 'codexse-elementor-addons'),
				'promotionDialogMessage'    => esc_html__('Use %s widget with other exclusive pro widgets and 100% unique features to extend your toolbox and build sites faster and better.', 'codexse-elementor-addons'),
				'promotionDialogBtnTxt'    => esc_html__('Upgrade Now', 'codexse-elementor-addons'),
				'templatesEmptyTitle'       => esc_html__('No Templates Found', 'codexse-elementor-addons'),
				'templatesEmptyMessage'     => esc_html__('Try different category or sync for new templates.', 'codexse-elementor-addons'),
				'templatesNoResultsTitle'   => esc_html__('No Results Found', 'codexse-elementor-addons'),
				'templatesNoResultsMessage' => esc_html__('Please make sure your search is spelled correctly or try a different words.', 'codexse-elementor-addons'),
			],
		];

		if (!cx_has_pro() && cx_is_elementor_version('>=', '2.9.0')) {
			//$localize_data['placeholder_widgets'] = Widgets_Manager::get_pro_widget_map();
		}

		wp_localize_script(
			'codexse-elementor-addons-editor',
			'CodexseAddonsEditor',
			$localize_data
		);
	}

	/**
	 * Enqueue stylesheets only for preview window
	 * editing mode basically.
	 *
	 * @return void
	 */
	public static function enqueue_preview_styles() {
		if (cx_is_weforms_activated()) {
			wp_enqueue_style(
				'codexse-addons-weform',
				plugins_url('/weforms/assets/wpuf/css/frontend-forms.css', 'weforms'),
				null,
				CODEXSE_ADDONS_VERSION
			);
		}

		if (cx_is_wpforms_activated() && defined('WPFORMS_PLUGIN_SLUG')) {
			wp_enqueue_style(
				'codexse-addons-wpform',
				plugins_url('/' . WPFORMS_PLUGIN_SLUG . '/assets/css/wpforms-full.css', WPFORMS_PLUGIN_SLUG),
				null,
				CODEXSE_ADDONS_VERSION
			);
		}

		if (cx_is_calderaforms_activated()) {
			wp_enqueue_style(
				'codexse-addons-caldera-forms',
				plugins_url('/caldera-forms/assets/css/caldera-forms-front.css', 'caldera-forms'),
				null,
				CODEXSE_ADDONS_VERSION
			);
		}

		if (cx_is_gravityforms_activated()) {
			wp_enqueue_style(
				'codexse-addons-gravity-forms',
				plugins_url('/gravityforms/css/formsmain.min.css', 'gravityforms'),
				null,
				CODEXSE_ADDONS_VERSION
			);
		}

		$data = '
		.elementor-add-section[data-view=choose-action] .elementor-add-new-section {
			display: inline-flex !important;
			flex-wrap: wrap;
			align-items: center;
			justify-content: center;
		}
		.elementor-add-section-drag-title{
			flex-basis: 100%;
		}
		.elementor-add-new-section .elementor-add-cx-button {
			background: rgb(39,181,158);
			background: linear-gradient(90deg, rgba(39,181,158,1) 0%, rgba(176,239,229,1) 100%);
			margin-left: 5px;
			font-size: 20px;
			color: #fff;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		';
		wp_add_inline_style('codexse-elementor-addons', $data);

		if (cx_is_fluent_form_activated()) {
			wp_enqueue_style(
				'codexse-addons-fluent-forms',
				plugins_url('/fluentform/public/css/fluent-forms-public.css', 'fluentform'),
				null,
				CODEXSE_ADDONS_VERSION
			);
		}
	}

	/**
	 * Fix CodexseAddons Pro assets loading.
	 *
	 * Assets loading issue casued by free 2.13.2 release
	 * due to a change in hook priority.
	 *
	 * @todo remove in future
	 *
	 * @return void
	 */
	public static function fix_pro_assets_loading() {
		if (cx_has_pro() && version_compare(CODEXSE_ADDONS_PRO_VERSION, '1.9.0', '<=')) {
			$callback = ['\Codexse_Addons_Pro\Assets_Manager', 'frontend_register'];
			remove_action('wp_enqueue_scripts', $callback);
			add_action('wp_enqueue_scripts', $callback, 0);
		}
	}
}

Assets_Manager::init();
