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
	 * @param order_id    $order_id  ID of a created order.
	 * @param $posted_data $posted_data [description].
	 * @param order       $order  Created order object.
	 */
	public function change_role_on_checkout( $order_id, $posted_data, $order ) {

		$items = $order->get_items();
		$user = $order->get_user();

		foreach ( $items as $item ) {
			$product_id = $item->get_product_id();

			$value = get_post_meta( $product_id, '_related_role', true );
			if ( empty( $value ) ) {
				// Exit the loop when product has no role assigned.
				break;
			}

			if ( $user ) {
				$user->set_role( $value );
				$user->save();

				// Exit the loop when new role has been set.
				break;
			}
		}
	}
}
