<?php
defined( 'ABSPATH' ) || exit;

class Change_Role implements Component_Interface {


	/**
	 * @inheritDoc
	 */
	public function initialize() {
		add_action( 'woocommerce_checkout_order_processed', array( $this, 'change_role_on_checkout' ), 10, 3 );
	}


	/**
	 * Change customer role after checkout was proccesed.
	 *
	 * @param order_id    $order_id  ID of a created order
	 * @param $posted_data $posted_data [description]
	 * @param order       $order  Created order object
	 */
	public function change_role_on_checkout( $order_id, $posted_data, $order ) {

		$items = $order->get_items();
		$user = $order->get_user();

		// Array with products IDs that we want to associate with some role.
		$products_to_check = array( '11', '10' );

		foreach ( $items as $item ) {
			if ( $user && in_array( $item['product_id'], $products_to_check ) ) {
				$user->set_role( 'editor' );
				break;
			}
		}
	}
}
