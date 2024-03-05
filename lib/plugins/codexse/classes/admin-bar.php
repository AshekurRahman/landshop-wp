<?php
namespace Codexse_Addons\Elementor;

defined( 'ABSPATH' ) || die();

class Admin_Bar {

	public static function init() {
		add_action( 'admin_bar_menu', [__CLASS__, 'add_toolbar_items'], 500 );
		add_action( 'wp_enqueue_scripts', [__CLASS__, 'enqueue_assets'] );
		add_action( 'admin_enqueue_scripts', [__CLASS__, 'enqueue_assets'] );
		add_action( 'wp_ajax_cx_clear_cache', [__CLASS__, 'clear_cache' ] );
	}

	public static function clear_cache() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		if ( ! check_ajax_referer( 'cx_clear_cache', 'nonce' ) ) {
			wp_send_json_error();
		}

		$type = isset( $_POST['type'] ) ? sanitize_text_field($_POST['type']) : '';
		$post_id = isset( $_POST['post_id'] ) ? absint($_POST['post_id']) : 0;
		$assets_cache = new Assets_Cache( $post_id );
		if ( $type === 'page' ) {
			$assets_cache->delete();
		} elseif ( $type === 'all' ) {
			$assets_cache->delete_all();
		}
		wp_send_json_success();
	}

	public static function enqueue_assets() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		wp_enqueue_style(
			'codexse-elementor-addons-admin',
			CODEXSE_ADDONS_ASSETS . 'admin/css/admin.min.css',
			null,
			CODEXSE_ADDONS_VERSION
		);

		wp_enqueue_script(
			'codexse-elementor-addons-admin',
			CODEXSE_ADDONS_ASSETS . 'admin/js/admin.min.js',
			['jquery'],
			CODEXSE_ADDONS_VERSION,
			true
		);
		// wp_enqueue_style('select2');

		// wp_enqueue_script( 'select2' );

		wp_enqueue_script(
			'micromodal',
			'//unpkg.com/micromodal/dist/micromodal.min.js',
			[],
			CODEXSE_ADDONS_VERSION,
			true
		);

		wp_enqueue_style(
			'select2',
			'//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
			null,
			CODEXSE_ADDONS_VERSION
		);

		wp_enqueue_script(
			'select2',
			'//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
			['jquery'],
			CODEXSE_ADDONS_VERSION,
			true
		);

		wp_enqueue_script( 'wp-api' );
		
		wp_enqueue_script(
			'alpine',
			'//unpkg.com/alpinejs',
			[],
			CODEXSE_ADDONS_VERSION,
			true
		);
		
		wp_localize_script(
			'codexse-elementor-addons-admin',
			'CodexseAdmin',
			[
				'nonce'    => wp_create_nonce( 'cx_clear_cache' ),
				'post_id'  => get_queried_object_id(),
				'ajax_url' => admin_url( 'admin-ajax.php' ),
			]
		);
	}

	public static function add_toolbar_items( \WP_Admin_Bar $admin_bar ) {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$icon = '<i class="dashicons dashicons-update-alt"></i> ';

		$admin_bar->add_menu( [
			'id'    => 'codexse-addons',
			'title' => '<i class="cx cx-codexseaddons" style="font-size: large; height: 32px; display: flex; align-items: center;"></i>',
			'href'  => cx_get_dashboard_link(),
			'meta'  => [
				'title' => __( 'CodexseAddons', 'codexse-elementor-addons' ),
			]
		] );

		if ( is_singular() ) {
			$admin_bar->add_menu( [
				'id'     => 'cx-clear-page-cache',
				'parent' => 'codexse-addons',
				'title'  => $icon . __( 'Page: Renew On Demand Assets', 'codexse-elementor-addons' ),
				'href'   => '#',
				'meta'   => [
					'class' => 'hajs-clear-cache cx-clear-page-cache',
				]
			] );
		}

		$admin_bar->add_menu( [
			'id'     => 'cx-clear-all-cache',
			'parent' => 'codexse-addons',
			'title'  => $icon . __( 'Global: Renew On Demand Assets', 'codexse-elementor-addons' ),
			'href'   => '#',
			'meta'   => [
				'class' => 'hajs-clear-cache cx-clear-all-cache',
			]
		] );
	}
}

Admin_Bar::init();
