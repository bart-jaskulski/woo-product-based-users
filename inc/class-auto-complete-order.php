<?php
defined( 'ABSPATH' ) || exit;

class AutoCompleteOrder implements Component_Interface {


	/**
	 * @inheritDoc
	 */
	public function initialize() {
		add_action( 'woocommerce_thankyou', array( $this, 'change_order_status_to_complete' ) );
	}

	/**
	 * Change order status to Completed after the checkout
	 *
	 * @param int $order_id ID of currently processed order.
	 */
	public function change_order_status_to_complete( int $order_id ) {
		if ( ! $order_id ) {
			return;
		}
		$order = wc_get_order( $order_id );
		$order->update_status( 'completed' );
	}
}
