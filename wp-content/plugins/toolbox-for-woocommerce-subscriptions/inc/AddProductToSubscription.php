<?php
namespace Javorszky\Toolbox;

add_action( 'woocommerce_after_add_to_cart_form', __NAMESPACE__ . '\\add_to_existing_sub_markup', 21 );
add_action( 'wp_loaded', __NAMESPACE__ . '\\add_to_subscription' );
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\add_addtocart_js' );

/**
 * Add markup for "Add to existing subscription" to the variable subscription single page.
 */
function add_to_existing_sub_markup() {
	global $product;

	if ( ! is_user_logged_in() || ! in_array( $product->get_type(), apply_filters( 'jgtb_available_product_types_for_add_to_subscription', array( 'simple', 'variable', 'subscription', 'variable-subscription' ) ), true ) ) {
		return;
	}

	$subscriptions = wcs_get_users_subscriptions();

	$subscriptions = array_filter( $subscriptions, __NAMESPACE__ . '\\remove_subs_with_no_next_payment' );

	$subscriptions = apply_filters( 'jgtb_available_subscriptions_for_product', $subscriptions, $product );

	if ( empty( $subscriptions ) ) {
		return;
	}

	$do_not_show_for_product = get_post_meta( $product->get_id(), '_toolbox_hide_add_to_existing', true );
	if ( 'yes' === $do_not_show_for_product ) {
		return;
	}

	wp_register_style( 'add-to-existing', JGTB_URL . 'assets/css/add-to-existing.css', array(), JGTB_VERSION );
	wp_enqueue_style( 'add-to-existing' );

	wc_get_template(
		'single-product/add-to-existing-subscription.php',
		array(
			'product'       => $product,
			'subscriptions' => $subscriptions,
		),
		'',
		JGTB_PATH . 'templates/'
	);
}

/**
 * @param \WC_Subscription $subscription
 * @return mixed
 */
function remove_subs_with_no_next_payment( $subscription ) {
	return $subscription->get_time( 'next_payment' );
}

function add_addtocart_js() {
	global $product, $post;

	if ( ! is_product() ) {
		return;
	}

	$product = wc_get_product( $post->ID );

	$type = $product->get_type();

	if ( 'simple' === $type || 'subscription' === $type ) {
		wp_register_script( 'jgtbatss', JGTB_URL . 'assets/js/jgtbatss.js', array( 'jquery', 'jquery-ui-datepicker', 'wc-add-to-cart' ), JGTB_VERSION, true );
		wp_enqueue_script( 'jgtbatss' );
	} elseif ( 'variable' === $type || 'variable-subscription' === $type ) {
		wp_register_script( 'jgtbatsv', JGTB_URL . 'assets/js/jgtbatsv.js', array( 'jquery', 'jquery-ui-datepicker', 'wc-add-to-cart-variation' ), JGTB_VERSION, true );
		wp_enqueue_script( 'jgtbatsv' );
	}
}

/**
 * Custom add to cart handler. Instead of adding items to the cart, it will add items to existing subscriptions if
 * a checkbox is checked and a subscription is selected. The code is based on WC_AJAX::add_order_item, which is what
 * happens when you add a new item from the edit subscription page.
 *
 */
function add_to_subscription() {
	if ( isset( $_REQUEST['jgtb_add_to_existing_subscription'] )
		&& isset( $_REQUEST[ 'jgtbwpnonce_' . $_REQUEST['jgtb_add_to_existing_subscription'] ] )
		&& isset( $_REQUEST['add-to-subscription'] )
		&& isset( $_REQUEST['ats_product_id'] )
		&& isset( $_REQUEST['ats_variation_id'] )
		&& isset( $_REQUEST['ats_quantity'] )
		&& isset( $_REQUEST['ats_variation_attributes'] )
	) {
		$user_id      = get_current_user_id();
		$subscription = wcs_get_subscription( $_REQUEST['jgtb_add_to_existing_subscription'] );
		$nonce        = $_REQUEST[ 'jgtbwpnonce_' . $_REQUEST['jgtb_add_to_existing_subscription'] ];
		if ( Utilities\Validate\validate_subscription_ownership( $user_id, $subscription ) && Utilities\Validate\validate_add_to_subscription_request( $subscription, $nonce ) ) {

			$product_id  = $_REQUEST['ats_variation_id'] ? $_REQUEST['ats_variation_id'] : $_REQUEST['ats_product_id'];
			$attributes  = array();
			$item_to_add = sanitize_text_field( $product_id );

			// Find the item
			if ( ! is_numeric( $item_to_add ) ) {
				return;
			}

			$product = wc_get_product( $item_to_add );

			if ( ! $product || ( 'simple' !== $product->get_type() && 'variation' !== $product->get_type() && 'product_variation' !== $product->get_type() && 'subscription' !== $product->get_type() && 'subscription_variation' !== $product->get_type() ) ) {
				return;
			}

			if ( 'variation' === $product->get_type() || 'subscription_variation' === $product->get_type() ) {
				$passed_attributes = $_REQUEST['ats_variation_attributes'] ? json_decode( stripcslashes( $_REQUEST['ats_variation_attributes'] ), true ) : array();
				$saved_attributes  = $product->get_variation_attributes();
				$attributes        = array_intersect_key( $passed_attributes, $saved_attributes );
			}

			$quantity     = absint( $_REQUEST['ats_quantity'] );
			$product_data = apply_filters( 'jgtb_add_to_subscription_product_data', array( 'variation' => $attributes ), $product, $subscription, $quantity );
			$subscription->add_product( $product, $quantity, $product_data );

			$subscription->calculate_totals();
			$subscription->add_order_note( 'Customer added a new line item to the subscription: ' . PHP_EOL . $product->get_name() . ' x ' . $quantity . ' (id: ' . $product_id . ')' );
			$subscription->save();

			// translators: placeholder is ID of subscription.
			wc_add_notice( sprintf( _x( 'The item has been added to subscription #%s', 'Notice after product added to subscription.', 'jg-toolbox' ), $subscription->get_id() ) );

			do_action( 'jgtb_added_item_to_subscription', $subscription, $product, $quantity );
		}

		do_action( 'jgtb_adding_item_to_subscription_failed', $subscription );
	}
}
