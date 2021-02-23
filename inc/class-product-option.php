<?php
defined( 'ABSPATH' ) || exit;

/**
 * Add WooCommerce option and save it to database.
 */
class Product_Option implements Component_Interface {

	/**
	 * Hook necesary actions and filters.
	 */
	public function initialize() {
		add_action( 'woocommerce_product_options_general_product_data', array( $this, 'add_related_role_selector' ) );
		add_action( 'woocommerce_process_product_meta', array( $this, 'action_save_related_role_selector' ) );
	}


	/**
	 * Insert a dropdown selector with user roles in product general options.
	 */
	public function add_related_role_selector() {

		global $wp_roles;

		$options = array();

		// Add all roles names to a dropdown except an Administrator.
		foreach ( $wp_roles->get_names() as $key => $role ) {
			if ( ! in_array( $role, array( 'Administrator' ) ) ) {
				$options[ $key ] = $role;
			}
		}

		woocommerce_wp_select(
			array(
				'id'      => '_related_role',
				'label'   => __( 'Related customer role', 'woocommerce' ),
				'options' => $options,
			)
		);
	}


	/**
	 * Save selector's state to database.
	 *
	 * @param  int $post_id Current product ID.
	 */
	public function action_save_related_role_selector( int $post_id ) {
		$role = $_POST['_related_role'];
		if ( ! empty( $role ) ) {
			update_post_meta( $post_id, '_related_role', esc_attr( $role ) );
		} else {
			update_post_meta( $post_id, '_related_role', '' );
		}
	}
}
