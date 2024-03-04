<?php 
namespace Codexse_Addons\Elementor\Theme_Hooks;

use Codexse_Addons\Elementor\Theme_Builder;

defined( 'ABSPATH' ) || exit;

/**
 * MyListing support for the header footer.
 */
class MyListing {


	/**
	 * Run all the Actions / Filters.
	 */
	function __construct($template_ids) {
		global $cx__template_ids;
		
		$cx__template_ids = $template_ids;
		include 'my-listing-functions.php';
	}
}