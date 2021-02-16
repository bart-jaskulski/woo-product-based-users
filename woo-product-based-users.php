<?php
/**
 * Plugin Name: Custom Roles for WooCommerce
 * Plugin URI:
 * Description:
 * Version: 0.1.0
 * Author: Dentonet
 * Author URI: https://dentonet.pl
 * Developer:
 * Developer URI: https://github.com/
 * Domain Path: /languages
 *
 * WC requires at least: 5.0
 * WC tested up to: 5.0
 *
 * @package dentonet
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

// Check if WooCommerce is active.
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

}
