<?php
namespace Javorszky\Toolbox;

add_action( 'wp_loaded', __NAMESPACE__ . '\\handle_change_next_ship_date' );
add_action( 'woocommerce_subscription_after_actions', __NAMESPACE__ . '\\add_change_next_ship_date_markup', 11 );

/**
 * Hooks into a new action hook in subs to deliver the markup from a template file that child themes can overwrite.
 *
 * @link https://github.com/Prospress/woocommerce-subscriptions/pull/1608
 *
 * @param \WC_Subscription   $subscription   subscription we're operating on
 */
function add_change_next_ship_date_markup( $subscription ) {
	$next_timestamp = $subscription->get_time( 'next_payment' );

	if ( 0 !== $next_timestamp && 'active' === $subscription->get_status() && 'yes' === apply_filters( 'jgtb_allow_edit_date_for_subscription', 'yes', $subscription ) ) {
		wc_get_template(
			'myaccount/choose-next-ship-date.php',
			array(
				'subscription' => $subscription,
				'embed_form'   => true,
			),
			'',
			JGTB_PATH . 'templates/'
		);
	}
}

/**
 * Changes the date of the subscription if it's been requested and we made sure all data is in order.
 */
function handle_change_next_ship_date() {
	if ( isset( $_REQUEST['new_ship_date'] ) && isset( $_REQUEST['old_ship_date'] ) && $_REQUEST['new_ship_date'] !== $_REQUEST['old_ship_date'] && isset( $_REQUEST['nsd_subscription_id'] ) && isset( $_REQUEST['jgtb_nonce'] ) ) {
		$user_id      = get_current_user_id();
		$subscription = wcs_get_subscription( $_REQUEST['nsd_subscription_id'] );

		if ( ! wcs_is_subscription( $subscription ) ) {
			return;
		}

		Utilities\Process\process_change_next_shipping_date( $user_id, $subscription, $_REQUEST['jgtb_nonce'], $_REQUEST['new_ship_date'] );
	}
}
