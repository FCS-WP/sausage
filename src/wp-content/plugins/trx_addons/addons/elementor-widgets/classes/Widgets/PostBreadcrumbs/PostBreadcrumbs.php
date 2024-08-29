<?php
/**
 * Post Breadcrumbs Module
 *
 * @package ThemeREX Addons
 * @since v2.30.2
 */

namespace TrxAddons\ElementorWidgets\Widgets\PostBreadcrumbs;

use TrxAddons\ElementorWidgets\BaseWidgetModule;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Post Breadcrumbs module
 */
class PostBreadcrumbs extends BaseWidgetModule {

	/**
	 * Constructor.
	 *
	 * Initializing the module base class.
	 */
	public function __construct() {
		parent::__construct();
		$this->assets = array(
			'css' => false,
			'js'  => false,
		);
	}

	/**
	 * Get the name of the module
	 *
	 * @return string  The name of the module.
	 */
	public function get_name() {
		return 'post-breadcrumbs';
	}

}
