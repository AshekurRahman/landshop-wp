<?php
/**
 * Image Accordion integration
 */
namespace Codexse_Addons\Elementor;

defined( 'ABSPATH' ) || die();

class WPML_Image_Accordion extends WPML_Module_With_Items  {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'accordion_items';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return [
			'label',
			'title',
			'description',
			'button_label',
			'button_url' => ['url'],
			'link_url' => ['url'],
		];
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'label':
				return __( 'Image Accordion: Label', 'codexse-elementor-addons' );
			case 'title':
				return __( 'Image Accordion: Title', 'codexse-elementor-addons' );
			case 'description':
				return __( 'Image Accordion: Description', 'codexse-elementor-addons' );
			case 'button_label':
				return __( 'Image Accordion: Button Label', 'codexse-elementor-addons' );
			case 'button_url':
				return __( 'Image Accordion: Button URL', 'codexse-elementor-addons' );
			case 'link_url':
				return __( 'Image Accordion: Link URL', 'codexse-elementor-addons' );
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
			case 'label':
				return 'LINE';
			case 'title':
				return 'AREA';
			case 'description':
				return 'AREA';
			case 'button_label':
				return 'LINE';
			case 'button_url':
				return 'LINK';
			case 'link_url':
				return 'LINK';
			default:
				return '';
		}
	}
}