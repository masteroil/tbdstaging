<?php
namespace Javorszky\Toolbox\Utilities;

use DateTime;
use DateTimeZone;
use WC_Subscriptions;
use WC_Subscription;

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\add_js' );
add_filter( 'jgtb_change_placeholder_dates', __NAMESPACE__ . '\\change_date_format' );
add_action( 'woocommerce_subscription_payment_complete', __NAMESPACE__ . '\\maybe_remove_skip', 10 );

/**
 * General method that handles adding markup. Separate because this should also be used to enqueue any javascript
 * files if we need them (for example date pickers).
 */
function add_js() {
	wp_register_script( 'jgtb', JGTB_URL . 'assets/js/jgtb.js', array( 'jquery', 'jquery-ui-datepicker' ), JGTB_VERSION, false );
	wp_enqueue_script( 'jgtb' );
	wp_localize_script(
		'jgtb',
		'wcs_toolbox',
		array(
			'text' => array(
				'cancel'               => __( 'Cancel', 'jg-toolbox' ),
				'yes'                  => __( 'Yes', 'jg-toolbox' ),
				'skip_next'            => __( 'Are you sure you want to skip next payment?', 'jg-toolbox' ),
				'ship_now_keep_date'   => __( 'Are you sure you want to ship now and keep schedule?', 'jg-toolbox' ),
				'ship_now_recalculate' => __( 'Are you sure you want to ship now and reschedule from today?', 'jg-toolbox' ),
			),
		)
	);
	$css = 'jquery-ui.min.css';
	if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
		$css = 'jquery-ui.css';
	}

	wp_register_style( 'jquery-ui-datepicker', JGTB_URL . 'assets/css/' . $css, array(), JGTB_VERSION );

	wp_enqueue_style( 'jquery-ui-datepicker' );

	if ( is_account_page() ) {
		wp_register_style( 'toolbox', JGTB_URL . 'assets/css/toolbox.css', array(), JGTB_VERSION );
		wp_enqueue_style( 'toolbox' );
	}
}

/**
 * Strips the query args from the current URL, so clicking on buttons won't accidentally trigger other actions than
 * we wanted.
 *
 * @return string                           The current URL minus a few query args
 */
function strip_custom_query_args() {
	return remove_query_arg( array( 'skip_next_shipping', 'ship_now_keep_date', 'ship_now_adjust_date', 'new_frequency' ) );
}

function generate_nonce_on_items( $subscription ) {
	$string = '';
	foreach ( $subscription->get_items() as $item ) {
		$string .= $item['product_id'] . '-' . $item['qty'] . '-' . $item['variation_id'];
	}
	return $string;
}

/**
 * This will calculate the next payment date from today. Today, because we're calling "ship_now" previously, which
 * sets the "last_payment" as "now".
 *
 * @param \WC_Subscription $subscription   Subscription object we're changing the date on
 * @param string $old_next_date            Next date before we changed it. It's in UTC, and format 'Y-m-d H:i:s'
 * @return mixed                           Next calculated date.
 * @throws \Exception
 */
function adjust_date( $subscription, $old_next_date ) {
	if ( is_ship_reschedule_from_next_payment_available() ) {
		$next_payment_timestamp = wcs_add_time( $subscription->get_billing_interval(), $subscription->get_billing_period(), wcs_date_to_time( $old_next_date ), 'offset_site_time' );

		// Make sure the next payment is more than 2 hours in the future, this ensures changes to the site's timezone because of daylight savings will never cause a 2nd renewal payment to be processed on the same day
		$i = 1;
		while ( $next_payment_timestamp < ( time() + 2 * HOUR_IN_SECONDS ) && $i < 3000 ) {
			$next_payment_timestamp = wcs_add_time( $subscription->get_billing_interval(), $subscription->get_billing_period(), $next_payment_timestamp, 'offset_site_time' );

			$i++;
		}

		if ( $next_payment_timestamp > 0 ) {
			$next_payment_date = gmdate( 'Y-m-d H:i:s', $next_payment_timestamp );
		} else {
			$next_payment_date = 0;
		}
	} else {
		$next_payment_date = $subscription->calculate_date( 'next_payment' );
	}

	$dates = array(
		'next_payment' => $next_payment_date,
	);

	if ( apply_filters( 'jgtb_adjust_end_date_with_next_date', false, $subscription, $next_payment_date, $old_next_date ) ) {
		// let's calculate the difference between the two
		$utc = new DateTimeZone( 'UTC' );

		$old_next_date_object = DateTime::createFromFormat( 'Y-m-d H:i:s', $old_next_date, $utc );
		$new_next_date_object = DateTime::createFromFormat( 'Y-m-d H:i:s', $next_payment_date, $utc );
		$now                  = new DateTime( 'now', $utc );
		$old_end_date         = $subscription->get_date( 'end' );
		$end_date_object      = DateTime::createFromFormat( 'Y-m-d H:i:s', $old_end_date, $utc );

		$diff = $old_next_date_object->diff( $now );

		$end_date_object->add( $diff );

		$dates['end']          = $end_date_object->format( 'Y-m-d H:i:s' );
		$dates['next_payment'] = ( $new_next_date_object >= $end_date_object ) ? 0 : $new_next_date_object->format( 'Y-m-d H:i:s' );
	}

	$subscription->update_dates( $dates );
	$subscription->save();
	return $next_payment_date;
}

/**
 * This will create a renewal order, but otherwise leave the next date intact. Used in both "ship now" requests.
 *
 * @param  \WC_Subscription  $subscription   subscription object we're generating a renewal order for
 */
function ship_now( $subscription ) {
	do_action( 'woocommerce_scheduled_subscription_payment', $subscription->get_id() );
}

/**
 * Extracts address details in posted data. Plucks from $_REQUEST
 *
 * @param  array        $request    request data (usually $_POST)
 * @param  string       $type       type of address details to pluck
 * @return array                    plucked address details
 */
function sieve_address_details( $request, $type = 'billing' ) {
	$type    = ( 'billing' === $type ) ? 'billing' : 'shipping';
	$address = array();
	foreach ( $request as $key => $value ) {
		if ( 0 === strpos( $key, $type ) ) {
			$new_key             = str_replace( $type . '_', '', $key );
			$address[ $new_key ] = $value;
		}
	}
	return $address;
}

/**
 * Returns an array containing all values that have changed in new.
 * @param  array        $old        Existing values to check against
 * @param  array        $new        New values to see whether anything changed
 * @return array                    Containing everything from New that changed with regards to Old
 */
function get_difference( $old, $new ) {
	$diff = array();
	foreach ( $new as $key => $value ) {
		if ( ! array_key_exists( $key, $old ) || $old[ $key ] !== $value ) {
			$diff[ $key ] = $value;
		}
	}
	return $diff;
}

/**
 * Makes sure that the date is a date, that it's not in the past, and that it's at least 24 hours in the future due
 * to wanting to avoid rescheduling bugs.
 *
 * @param  string           $new_date       ideally a mysql date format
 * @return boolean                          true if all is well and we can change the date on the subscription
 */
function sanitize_new_date( $new_date ) {
	$result    = true;
	$timestamp = strtotime( $new_date );

	// because incoming timestamp is going to be only YYYY-MM-DD, it would default to 0:00:00, and we need 3 am for
	// consistency
	$timestamp += 3 * HOUR_IN_SECONDS;

	if ( ! $timestamp ) {
		wc_add_notice( _x( 'New payment date is in an invalid format. Please check again.', 'Error notice while sanitizing date format', 'jg-toolbox' ), 'error' );
		$result = false;
	} elseif ( $timestamp < time() ) {
		wc_add_notice( _x( 'New payment date is in the past.', 'Error notice when next payment is in the past', 'jg-toolbox' ), 'error' );
		$result = false;
	} elseif ( $timestamp < time() + DAY_IN_SECONDS ) {
		wc_add_notice( _x( 'New payment date is too close to today, it might lead to renewal errors. Please use one of the "ship now" options.', 'Error notice when validating new next payment date', 'jg-toolbox' ), 'error' );
		$result = false;
	}

	return $result;
}

function is_feature_available( $feature ) {
	if ( 'yes' === get_option( JGTB_OPTION_PREFIX . $feature ) ) {
		return true;
	}
	return false;
}

function is_skip_next_available() {
	return is_feature_available( 'skip_next_available' );
}

function is_ship_keep_available() {
	return is_feature_available( 'ship_now_keep_available' );
}

function is_ship_reschedule_from_next_payment_available() {
	return is_feature_available( 'reschedule_from_payment_date' );
}

function is_ship_reschedule_available() {
	return is_feature_available( 'ship_now_reschedule_available' );
}

function is_edit_details_available() {
	return is_feature_available( 'edit_sub_details_available' );
}

function is_change_next_payment_available() {
	return is_feature_available( 'change_next_payment_available' );
}

function is_add_to_subscription_available() {
	return is_feature_available( 'add_to_subscription' );
}

function is_bulk_edit_available() {
	return is_feature_available( 'bulk_edit_subscriptions' );
}

/**
 * Implements functionality to replace placeholder text in button / description texts.
 *
 * @param  string           $button_text   text used in buttons
 * @param  \WC_Subscription  $subscription  subscription the dates relate to
 * @return string                          button text but with the placeholder replaced
 */
function replace_key_dates( $button_text, $subscription ) {
	add_filter( 'wcs_calculate_next_payment_from_last_payment', '__return_false' );
	$next_payment_date = $subscription->calculate_date( 'next_payment' );
	remove_filter( 'wcs_calculate_next_payment_from_last_payment', '__return_false' );

	$search = array(
		'[date_created]',
		'[start_date]',
		'[next_date]',
		'[next_date_from_next]',
		'[next_date_from_last]',
		'[next_date_from_today]',
	);

	$replace = apply_filters(
		'jgtb_change_placeholder_dates',
		array(
			$subscription->get_date( 'date_created' ),
			$subscription->get_date( 'date_created' ),
			$subscription->get_date( 'next_payment' ),
			$next_payment_date,
			$subscription->calculate_date( 'next_payment' ),
			calculate_next_payment_date_from_today( $subscription ),
		)
	);

	return str_replace( $search, $replace, $button_text );
}

/**
 * Example function to turn standard MySQL datetime formats into some other format. In this case, the default
 * datetime format used by WooCommerce.
 *
 * @param  array    $dates   This should be an array of dates in MySQL format
 * @return array             array of same dates in a different format
 */
function change_date_format( $dates ) {
	return array_map(
		function( $date ) {
			$ts = strtotime( $date );

			return gmdate( apply_filters( 'jgtb_change_placeholder_date_format', wc_date_format() ), $ts );
		},
		$dates
	);
}

/**
 * This is a copy of part of the method from Subscriptions because Subs doesn't have a generic "calculate next payment
 * date from" method.
 *
 * @param  \WC_Subscription $subscription  Subscription we're getting the next payment date for from today
 * @return string                         datetime in MySQL format in GMT timezone
 */
function calculate_next_payment_date_from_today( $subscription ) {
	$end_time               = $subscription->get_time( 'end' );
	$from_timestamp         = time();
	$next_payment_timestamp = wcs_add_time( $subscription->get_billing_interval(), $subscription->get_billing_period(), $from_timestamp );

	// Make sure the next payment is more than 2 hours in the future, this ensures changes to the site's timezone because of daylight savings will never cause a 2nd renewal payment to be processed on the same day
	$i = 1;
	while ( $next_payment_timestamp < ( time() + 2 * HOUR_IN_SECONDS ) && $i < 3000 ) {
		$next_payment_timestamp = wcs_add_time( $subscription->get_billing_interval(), $subscription->get_billing_period(), $next_payment_timestamp );
		$i++;
	}

	// If the subscription has an end date and the next billing period comes after that, return 0
	if ( 0 !== $end_time && ( $next_payment_timestamp + 23 * HOUR_IN_SECONDS ) > $end_time ) {
		$next_payment_timestamp = 0;
	}

	$next_payment_date = 0;

	if ( $next_payment_timestamp > 0 ) {
		$next_payment_date = gmdate( 'Y-m-d H:i:s', $next_payment_timestamp );
	}

	return $next_payment_date;
}

/**
 * Gets button text / and default
 *
 * @param string $button the button option id without the prefix
 * @param string $default default string in case the option is not set or the string is empty
 * @return string
 */
function get_button_text( $button, $default = '' ) {

	// use get_option to return default value
	$button_text = get_option( JGTB_OPTION_PREFIX . $button, $default );

	// in case the button is saved but is empty, use the default anyways
	if ( '' === $button_text ) {
		$button_text = $default;
	}

	return $button_text;
}

/**
 * Updates post modified to now.
 *
 * @param $post_id
 */
function update_post_modified_date( $post_id ) {

	if ( is_a( $post_id, \WC_Subscription::class ) ) {
		$post_id = $post_id->get_id();
	}

	if ( absint( $post_id ) < 1 ) {
		return;
	}

	$post_data = array(
		'ID'                => $post_id,
		'post_modified'     => current_time( 'mysql' ),
		'post_modified_gmt' => current_time( 'mysql', 1 ),
	);

	wp_update_post( $post_data );
}

/**
 * Create a string that represents an existing subscription. This is used in the add-to-existing-subscription template.
 * @param $subscription
 * @return string
 */
function generate_option_text( $subscription ) {
	// translators: $1: ID of subscription, $2: recurrence, eg "2 months", $3: next payment date
	$base_text = sprintf( esc_html__( '#%1$d - every %2$s - next: %3$s', 'jg-toolbox' ), $subscription->get_id(), wcs_get_subscription_period_strings( $subscription->get_billing_interval(), $subscription->get_billing_period() ), date_i18n( wc_date_format(), $subscription->get_time( 'next_payment' ) ) );

	return $base_text;
}

/**
 * Convert date to format for display in emails.
 * Format: 'F j, Y'
 *
 * @param string $date in format 'Y-m-d H:i:s'
 *
 * @return string
 */
function email_display_date( $date ) {
	$tz       = new DateTimeZone( wc_timezone_string() );
	$new_date = DateTime::createFromFormat( 'Y-m-d H:i:s', $date, $tz ); // phpcs:ignore CSRF ok

	$new_date = apply_filters( 'jgtb_email_display_date', $new_date );
	return $new_date->format( 'F j, Y' );
}

/**
 * After subscription renewal clear the skipped meta so the customer can skip again.
 *
 * @param WC_Subscription $subscription
 * @return void
 */
function maybe_remove_skip( $subscription ) {
	delete_post_meta( $subscription->get_id(), 'wcs_toolbox_skipped' );
}
