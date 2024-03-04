<?php
/**
 * Slider integration
 */
namespace Codexse_Addons\Elementor;

defined( 'ABSPATH' ) || die();

class WPML_Slider extends \WPML_Elementor_Module_With_Items  {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'slides';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return [
			'title',
			'subtitle',
			'link' => ['url']
		];
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'title':
				return __( 'Slider: Title', 'codexse-elementor-addons' );
			case 'subtitle':
				return __( 'Slider: Subtitle', 'codexse-elementor-addons' );
			case 'url':
				return __( 'Slider: Link', 'codexse-elementor-addons' );
			default:
				return '';
		}
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'title':
				return 'LINE';
			case 'subtitle':
				return 'AREA';
			case 'url':
				return 'LINK';
			default:
				return '';
		}
	}
}