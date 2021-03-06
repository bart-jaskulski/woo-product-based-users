<?php
/**
 * Plugin Name: Custom Roles for WooCommerce
 * Plugin URI:
 * Description: Custom role assignement extension for WooCommerce
 * Version: 1.0.0
 * Author: Dentonet
 * Author URI: https://dentonet.pl
 * Developer: Michal Gladysz
 * Developer URI: https://github.com/mgladysz
 * Domain Path: /languages
 *
 * WC requires at least: 5.0
 * WC tested up to: 5.0
 *
 * @package dentonet
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

/**
 * Main plugin class responsible for lauching all components.
 */
class Woo_Product_Based_Users {


	/**
	 * Array of injected components.
	 *
	 * @var array
	 */
	protected $components = array();


	/**
	 * Create object loading files and inserting components.
	 */
	public function __construct() {
		// Check if WooCommerce is active.
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			$this->loader();
			$this->components = $this->get_components();
		}
	}


	/**
	 * Start each component respecitively.
	 */
	public function initialize() {
		array_walk(
			$this->components,
			function ( Component_Interface $component ) {
				$component->initialize();
			}
		);
	}

	/**
	 * Load all files.
	 * TODO: Switch to autoload or sth later.
	 */
	public function loader() {
		require_once( __DIR__ . '/inc/component-interface.php' );
		require_once( __DIR__ . '/inc/class-change-role.php' );
		require_once( __DIR__ . '/inc/class-product-option.php' );
	}

	/**
	 * List and instantiate all used components here.
	 *
	 * @return array List of components
	 */
	private function get_components(): array {
		return array(
			new Change_Role(),
			new Product_Option(),
		);
	}
}


/**
 * Start plugin when WooCommerce is up and running.
 */
add_action(
	'woocommerce_loaded',
	function () {
		( new Woo_Product_Based_Users() )->initialize();
	}
);
