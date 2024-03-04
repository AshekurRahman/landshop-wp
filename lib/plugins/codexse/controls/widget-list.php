<?php
/**
 * Widget List control extended from select2
 *
 * @package Codexse_Addons
 */
namespace Codexse_Addons\Elementor\Controls;

use Elementor\Control_Select2;

defined( 'ABSPATH' ) || die();

class Widget_List extends Control_Select2 {

	const TYPE = 'widget-list';

	public function get_type() {
		return self::TYPE;
	}
}
