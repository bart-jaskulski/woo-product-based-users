<?php
defined( 'ABSPATH' ) || exit;

class ChangeRole implements Component_Interface {


	/**
	 * @inheritDoc
	 */
	public function initialize() {
		// add_action('woocommerce_order_status_completed', array($this, 'change_role_on_completed'));
		add_action( 'woocommerce_checkout_update_customer', array( $this, 'change_role_on_checkout' ), 10, 2 );
		add_filter( 'woocommerce_new_customer_data', array( $this, 'filter_change_new_user_role' ) );
	}

	/**
	 * Filter array of initial data, and adjust customer role based on superior order.
	 *
	 * @param  array $new_customer_data Customer data to save as WP User.
	 * @return array Modified user data array.
	 */
	public function filter_change_new_user_role( array $new_customer_data ) : array {

		return $new_customer_data;
	}


	/**
	 * Change customer role when he completes the checkout process.
	 *
	 * @param  WC_Customer $customer [description]
	 * @param  array       $data [description]
	 */
	public function change_role_on_checkout( $customer, $data ) {
	}


	/**
	 * Change customer role when order status changes to Completed.
	 * This won't be needed but includes checking if customer
	 * ordered a product that should change his role.
	 * May be useful later.
	 */
	public function change_role_on_completed( int $order_id ) {

		// Get order object and items.
		$order = wc_get_order( $order_id );
		$items = $order->get_items();

		// Array with products IDs that we want to associate with some role.
		$products_to_check = array( '11', '10' );

		foreach ( $items as $item ) {
			if ( $order->user_id > 0 && in_array( $item['product_id'], $products_to_check ) ) {
				$user = new WP_User( $order->user_id );

				// Update role to Editor.
				$user->remove_role( 'customer' );
				$user->add_role( 'editor' );

				break;
			}
		}
	}
}
