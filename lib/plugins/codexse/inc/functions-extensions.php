<?php
/**
 * Filters function defination
 *
 * @package Codexse_Addons
 * @since 2.13.0
 * @author CodexseMonster
 *
 */
defined( 'ABSPATH' ) || die();

if ( ! function_exists( 'cx_is_adminbar_menu_enabled' ) ) {
	/**
	 * Check if Adminbar is enabled
	 *
	 * @return bool
	 */
	function cx_is_adminbar_menu_enabled() {
		return apply_filters( 'codexseaddons/extensions/adminbar_menu', true );
	}
}

if ( ! function_exists( 'cx_is_background_overlay_enabled' ) ) {
	/**
	 * Check if Background Overlay is enabled
	 *
	 * @return bool
	 */
	function cx_is_background_overlay_enabled() {
		return apply_filters( 'codexseaddons/extensions/background_overlay', true );
	}
}

if ( ! function_exists( 'cx_is_css_transform_enabled' ) ) {
	/**
	 * Check if CSS Transform is enabled
	 *
	 * @return bool
	 */
	function cx_is_css_transform_enabled() {
		return apply_filters( 'codexseaddons/extensions/css_transform', true );
	}
}

if ( ! function_exists( 'cx_is_floating_effects_enabled' ) ) {
	/**
	 * Check if Floating Effects is enabled
	 *
	 * @return bool
	 */
	function cx_is_floating_effects_enabled() {
		return apply_filters( 'codexseaddons/extensions/floating_effects', true );
	}
}

if ( ! function_exists( 'cx_is_grid_layer_enabled' ) ) {
	/**
	 * Check if Grid Layer is enabled
	 *
	 * @return bool
	 */
	function cx_is_grid_layer_enabled() {
		return apply_filters( 'codexseaddons/extensions/grid_layer', true );
	}
}

if ( ! function_exists( 'cx_is_wrapper_link_enabled' ) ) {
	/**
	 * Check if Wrapper Link is enabled
	 *
	 * @return bool
	 */
	function cx_is_wrapper_link_enabled() {
		return apply_filters( 'codexseaddons/extensions/wrapper_link', true );
	}
}

if ( ! function_exists( 'cx_is_codexse_clone_enabled' ) ) {
	/**
	 * Check if Codexse Clone is enabled
	 *
	 * @return bool
	 */
	function cx_is_codexse_clone_enabled() {
		return apply_filters( 'codexseaddons/extensions/codexse_clone', true );
	}
}

if ( ! function_exists( 'cx_is_on_demand_cache_enabled' ) ) {
	/**
	 * Check if On Demand Cache is enabled
	 *
	 * @return bool
	 */
	function cx_is_on_demand_cache_enabled() {
		return apply_filters( 'codexseaddons/extensions/on_demand_cache', true );
	}
}

if ( ! function_exists( 'cx_is_equal_height_enabled' ) ) {
	/**
	 * Check if equal height is enabled
	 *
	 * @return bool
	 */
	function cx_is_equal_height_enabled() {
		return apply_filters( 'codexseaddons/extensions/equal_height', true );
	}
}

if ( ! function_exists( 'cx_is_shape_divider_enabled' ) ) {
	/**
	 * Check if Codexse Shape Divider is enabled
	 *
	 * @return bool
	 */
	function cx_is_shape_divider_enabled() {
		return apply_filters( 'codexseaddons/extensions/shape_divider', true );
	}
}
