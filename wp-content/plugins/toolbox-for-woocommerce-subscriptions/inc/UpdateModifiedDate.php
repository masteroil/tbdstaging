<?php
namespace Javorszky\Toolbox;

// When payment method is updated, let's update subscription modified date
add_action( 'woocommerce_subscription_payment_method_updated', 'Javorszky\\Toolbox\\Utilities\\update_post_modified_date' );
add_action( 'woocommerce_customer_save_address', __NAMESPACE__ . '\\maybe_update_subscription_addresses', 9 );

/**
 * When address is updated, make sure that the subscription(s) modified date is updated.
 * @see \WC_Subscriptions_Addresses->maybe_update_subscription_addresses()
 *
 * @param $user_id
 */
function maybe_update_subscription_addresses( $user_id ) {

	if ( ! wcs_user_has_subscription( $user_id ) || wc_notice_count( 'error' ) > 0 || empty( $_POST['_wcsnonce'] ) || ! wp_verify_nonce( $_POST['_wcsnonce'], 'wcs_edit_address' ) ) {
		return;
	}

	if ( isset( $_POST['update_all_subscriptions_addresses'] ) ) {

		$users_subscriptions = wcs_get_users_subscriptions( $user_id );

		foreach ( $users_subscriptions as $subscription ) {
			if ( $subscription->has_status( array( 'active', 'on-hold' ) ) ) {
				Utilities\update_post_modified_date( $subscription );
			}
		}
	} elseif ( isset( $_POST['update_subscription_address'] ) ) {

		$subscription = wcs_get_subscription( intval( $_POST['update_subscription_address'] ) );

		// Update the address only if the user actually owns the subscription
		if ( ! empty( $subscription ) ) {
			Utilities\update_post_modified_date( $subscription );
		}
	}
}

