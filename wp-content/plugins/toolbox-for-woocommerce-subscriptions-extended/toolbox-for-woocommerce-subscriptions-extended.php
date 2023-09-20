<?php
/**
 * Plugin Name: Toolbox for WooCommerce Subscriptions - Extended
 * Description: Plugin that extends the toolbox plugin.
 * Author:      Grow Development
 * Author URI:  https://growdevelopment.com
 * Text Domain: twce
 * Domain Path: /languages
 * Version:     1.0.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

define( 'WCTE_PATH', plugin_dir_path( __FILE__ ) );
define( 'WCTE_URL', plugin_dir_url( __FILE__ ) );
define( 'WCTE_VERSION', '1.0.4' );

require_once __DIR__ . '/category-functionality.php';

add_filter( 'wc_get_template', 'twce_replace_templates', 20, 5 );

function twce_replace_templates( $template, $template_name, $args, $template_path, $default_path ) {
	if ( ! defined( 'JGTB_PATH' ) ) {
		return $template;
	}

	if ( JGTB_PATH . 'templates/' === $default_path ) {
		switch ( $template_name ) {
			case 'myaccount/edit-subscription-products.php':
				return WCTE_PATH . 'templates/' . $template_name;
		}
	}

	return $template;
}

add_action( 'wp_enqueue_scripts', 'wcte_enqueue' );

/**
 * Enqueue enhanced select on the my account edit subscription page.
 * Add public.js and styles.css for this plugin.
 */
function wcte_enqueue() {
	if ( is_account_page() ) {
		wp_enqueue_script( 'wcte', WCTE_URL . 'assets/public.js', array( 'jquery', 'wp-util', 'selectWoo', 'wc-enhanced-select' ), WCTE_VERSION, false );
		wp_enqueue_style( 'wcte-style', WCTE_URL . 'assets/styles.css', array(), WCTE_VERSION );

		wp_localize_script(
			'wcte',
			'wcte',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'wcte' ),
			)
		);

		if ( ! wp_scripts()->query( 'select2' ) ) {
			wp_register_script( 'select2', WC()->plugin_url() . '/assets/js/select2/select2.full.min.js', array( 'jquery' ), '4.0.3', false );
		}
		if ( ! wp_scripts()->query( 'selectWoo' ) ) {
			wp_register_script( 'selectWoo', WC()->plugin_url() . '/assets/js/selectWoo/selectWoo.full.min.js', array( 'jquery' ), '1.0.6', false );
		}
		if ( ! wp_scripts()->query( 'wc-enhanced-select' ) ) {
			wp_register_script(
				'wc-enhanced-select',
				WC()->plugin_url() . '/assets/js/admin/wc-enhanced-select.min.js',
				array(
					'jquery',
					'selectWoo',
				),
				'4.0.3',
				false
			);

			wp_localize_script(
				'wc-enhanced-select',
				'wc_enhanced_select_params',
				array(
					'i18n_no_matches'           => _x( 'No matches found', 'enhanced select', 'woocommerce' ),
					'i18n_ajax_error'           => _x( 'Loading failed', 'enhanced select', 'woocommerce' ),
					'i18n_input_too_short_1'    => _x( 'Please enter 1 or more characters', 'enhanced select', 'woocommerce' ),
					'i18n_input_too_short_n'    => _x( 'Please enter %qty% or more characters', 'enhanced select', 'woocommerce' ),
					'i18n_input_too_long_1'     => _x( 'Please delete 1 character', 'enhanced select', 'woocommerce' ),
					'i18n_input_too_long_n'     => _x( 'Please delete %qty% characters', 'enhanced select', 'woocommerce' ),
					'i18n_selection_too_long_1' => _x( 'You can only select 1 item', 'enhanced select', 'woocommerce' ),
					'i18n_selection_too_long_n' => _x( 'You can only select %qty% items', 'enhanced select', 'woocommerce' ),
					'i18n_load_more'            => _x( 'Loading more results&hellip;', 'enhanced select', 'woocommerce' ),
					'i18n_searching'            => _x( 'Searching&hellip;', 'enhanced select', 'woocommerce' ),
					'ajax_url'                  => admin_url( 'admin-ajax.php' ),
					'search_products_nonce'     => wp_create_nonce( 'search-products' ),
					'search_customers_nonce'    => wp_create_nonce( 'search-customers' ),
					'search_categories_nonce'   => wp_create_nonce( 'search-categories' ),
				)
			);
		}
	}
}

add_action( 'wp_ajax_get_wcte_item_row', 'wcte_get_ajax_row_for_new_item' );
add_action( 'wp_ajax_nopriv_get_wcte_item_row', 'wcte_get_ajax_row_for_new_item' );

/**
 * Ajax callback used when customer adds an item row to the Subscription Items table.
 * Returns json containing table row for selected item with quantity of 1.
 */
function wcte_get_ajax_row_for_new_item() {
	check_ajax_referer( 'wcte', 'nonce' );

	$product      = ! empty( $_GET['product_id'] ) ? absint( $_GET['product_id'] ) : 0;
	$subscription = ! empty( $_GET['subscription'] ) ? absint( $_GET['subscription'] ) : 0;

	if ( ! $product || ! $subscription ) {
		wp_send_json_error(
			array(
				'message' => __( 'No Product or Subscription provided', 'wcte' ),
			)
		);
		wp_die();
	}

	$product      = wc_get_product( $product );
	$subscription = wcs_get_subscription( $subscription );

	ob_start();
	wc_get_template(
		'myaccount/wcte-get-item-row.php',
		array(
			'allow_remove_item' => wcs_can_items_be_removed( $subscription ),
			'allow_edit_qty'    => apply_filters( 'jgtb_allow_edit_qty_for_subscription', get_option( JGTB_OPTION_PREFIX . 'qty_change_edit_sub_details', 'yes' ), $subscription ),
			'product'           => $product,
			'subscription'      => $subscription,
		),
		'',
		trailingslashit( WCTE_PATH ) . 'templates/'
	);
	$html = ob_get_clean();

	wp_send_json_success(
		array(
			'html' => $html,
		)
	);
	wp_die();
}

/**
 * Get a discounted product price.
 * Used when no subscription plan was fount to match the subscription interval and period.
 *
 * @see wcte_get_product_price()
 *
 * @param \WC_Product $product Product object.
 *
 * @return float[]
 */
function wcte_get_discounted_product_price( $product ) {

	$prices = array(
		'price'         => $product->get_price() - $product->get_price() * 0.075,
		'sale_price'    => $product->get_sale_price() - $product->get_sale_price() * 0.075,
		'regular_price' => $product->get_regular_price() - $product->get_regular_price() * 0.075,
	);

	return $prices;
}

/**
 * Helper function used by wcte_handle_new_items().
 *
 * Checks the All Subscriptions for WC schemes to see if the product price should be changed.
 *
 * @param     $args
 * @param     $product
 * @param     $subscription
 * @param int $quantity
 * @return array
 */
function wcte_get_product_price( $args, $product, $subscription, $quantity = 1 ) {
	// No such class for some reason? Exit early.
	if ( ! class_exists( 'WCS_ATT_Product_Schemes' ) ) {
		return wcte_get_discounted_product_price( $product );
	}

	$schemes = \WCS_ATT_Product_Schemes::get_subscription_schemes( $product, 'product' );

	if ( ! $schemes ) {

		return wcte_get_discounted_product_price( $product );
	}

	$period   = $subscription->get_billing_period();
	$interval = $subscription->get_billing_interval();

	$matching_period_schemes = array();
	/** @var \WCS_ATT_Scheme $scheme */
	foreach ( $schemes as $scheme ) {
		if ( $period === $scheme->get_period() ) {
			$matching_period_schemes[] = $scheme;
		}
	}

	if ( ! $matching_period_schemes ) {
		return wcte_get_discounted_product_price( $product );
	}

	/** @var \WCS_ATT_Scheme $chosen_scheme */
	$chosen_scheme = $matching_period_schemes[0]; // Use first scheme in case the interval is not there.

	$found_interval = false;
	/** @var \WCS_ATT_Scheme $scheme */
	foreach ( $matching_period_schemes as $scheme ) {
		if ( absint( $interval ) === absint( $scheme->get_interval() ) ) {
			$chosen_scheme  = $scheme;
			$found_interval = true;
		}
	}

	// No interval found from product subscription plans.
	if ( ! $found_interval ) {
		return wcte_get_discounted_product_price( $product );
	}

	$prices = $chosen_scheme->get_prices(
		array(
			'price'         => $product->get_price(),
			'sale_price'    => $product->get_sale_price(),
			'regular_price' => $product->get_regular_price(),
		)
	);

	return $prices;
}

add_action( 'jgtb_after_change_product_quantities', 'wcte_after_change_product_quantities_calculate_shipping' );

/**
 * Recalculate shipping after customer changes item quantities.
 *
 * @param \WC_Subscription $subscription
 */
function wcte_after_change_product_quantities_calculate_shipping( $subscription ) {
	wcte_recalculate_shipping_for_subscription( $subscription );
	$subscription->save();
}

add_action( 'wcs_user_removed_item', 'wcte_after_removed_or_readded_item_calculate_shipping', 20, 2 );
add_action( 'wcs_user_readded_item', 'wcte_after_removed_or_readded_item_calculate_shipping', 20, 2 );

/**
 * Recalculate shipping after the default WCS function for user removing or re-adding items.
 *
 * @param \WC_Order_Item   $line_item
 * @param \WC_Subscription $subscription
 */
function wcte_after_removed_or_readded_item_calculate_shipping( $line_item, $subscription ) {
	wcte_recalculate_shipping_for_subscription( $subscription );
	$subscription->save();
}

add_action( 'wp_loaded', 'wcte_handle_new_items' );

/**
 * Handle saving the subscription items after customer has pressed Save Updated Subscription Details
 */
function wcte_handle_new_items() {
	if (
		isset( $_REQUEST['jgtb_edit_subscription_details'] ) && // phpcs:ignore
		isset( $_REQUEST[ 'jgtb_edit_details_of_' . absint( $_REQUEST['jgtb_edit_subscription_details'] ) ] ) && // phpcs:ignore
		isset( $_REQUEST['wcte_new_quantity'] ) ) { // phpcs:ignore
		$user_id        = get_current_user_id();
		$subscription   = wcs_get_subscription( $_REQUEST['jgtb_edit_subscription_details'] ); // phpcs:ignore
		$nonce          = $_REQUEST[ 'jgtb_edit_details_of_' . $subscription->get_id() ]; // phpcs:ignore
		$allow_edit_qty = 'yes' === apply_filters( 'jgtb_allow_edit_qty_for_subscription', get_option( JGTB_OPTION_PREFIX . 'qty_change_edit_sub_details', 'yes' ), $subscription );

		if ( ! wcs_is_subscription( $subscription ) ) {
			// there's nothing to do.
			return;
		}

		if ( ! \Javorszky\Toolbox\Utilities\Validate\validate_subscription_ownership( $user_id, $subscription ) ) {
			return;
		}

		if ( ! \Javorszky\Toolbox\Utilities\Validate\validate_edit_details( $subscription, $nonce ) ) {
			return;
		}

		$new_quantities     = $_REQUEST['wcte_new_quantity']; // phpcs:ignore
		$added              = false;
		$subscription_items = false;
		foreach ( $new_quantities as $product_id => $product_qty ) {
			$product = wc_get_product( $product_id );

			if ( ! $product || ( 'simple' !== $product->get_type() && 'variation' !== $product->get_type() && 'product_variation' !== $product->get_type() && 'subscription' !== $product->get_type() && 'subscription_variation' !== $product->get_type() ) ) {
				continue;
			}

			$attributes = array();

			if ( 'variation' === $product->get_type() || 'subscription_variation' === $product->get_type() ) {
				$attributes = $product->get_variation_attributes();
			}

			$quantity = absint( $product_qty );

			if ( ! $allow_edit_qty && $quantity > 1 ) {
				$quantity = 1;
			}

			if ( $subscription->has_product( $product_id ) ) {
				// translators: This is the notice to customer that they have product in subscription already.
				wc_add_notice( sprintf( _x( 'You already have %1$s in subscription #%2$s', 'Notice if product exists in subscription.', 'wcte' ), $product->get_name(), $subscription->get_id() ) );
				continue;
			}

			$prices  = wcte_get_product_price( array( 'price' => $product->get_price() ), $product, $subscription );
			$item_id = $subscription->add_product(
				$product,
				$quantity,
				array(
					'variation' => $attributes,
					'total'     => wc_get_price_excluding_tax(
						$product,
						array(
							'qty'   => $quantity,
							'price' => $prices['price'],
						)
					),
					'subtotal'  => wc_get_price_excluding_tax(
						$product,
						array(
							'qty'   => $quantity,
							'price' => $prices['price'],
						)
					),
				)
			);

			if ( $item_id ) {
				$subscription->add_order_note( 'Customer added a new line item to the subscription: ' . PHP_EOL . $product->get_name() . ' x ' . $quantity . ' (id: ' . $product_id . ')' );

				$added = true;
				// translators: placeholder is ID of subscription.
				wc_add_notice( sprintf( _x( 'The item has been added to subscription #%s', 'Notice after product added to subscription.', 'jg-toolbox' ), $subscription->get_id() ) );
			}
		}

		if ( $added ) {
			// recalculate things
			$subscription->calculate_totals();
			wcte_recalculate_shipping_for_subscription( $subscription );
			$subscription->save();
			\Javorszky\Toolbox\Utilities\update_post_modified_date( $subscription );
		}
	}
}

/**
 * Recalculate Shipping for Subscription.
 * Helper function called by wcte_recalculate_shipping_for_subscription().
 *
 * @param $subscription \WC_Subscription
 * @return false|mixed
 */
function wcte_get_shipping_rate_for_subscription( $subscription ) {
	if ( is_int( $subscription ) ) {
		$subscription = wcs_get_subscription( $subscription );
	}

	if ( ! $subscription ) {
		return false;
	}

	// If calling from API, need to set up frontend code to init cart/customer/session.
	WC()->frontend_includes();

	// Need session for calculating shipping.
	WC()->session = new \WC_Session_Handler();
	WC()->session->init();

	// Reset shipping first.
	WC()->shipping()->reset_shipping();

	$cart_items = array();
	$line_items = $subscription->get_items();
	$cost       = 0;
	$subtotal   = 0;
	$old_cart   = clone WC()->cart;

	WC()->cart->empty_cart( true );

	/** @var \WC_Order_Item_Product $item */
	foreach ( $line_items as $item ) {
		$product   = $item->get_product();
		$cost     += $item->get_total();
		$subtotal += $item->get_subtotal();

		$product->set_price( $item->get_subtotal() / $item->get_quantity() );

		WC()->cart->add_to_cart(
			$product->get_id(),
			$item->get_quantity(),
			$item->get_variation_id(),
			array(),
			array(
				'data' => $product,
			)
		);

		$cart_items[ 'emulated_' . $item->get_id() ] = array(
			'key'        => 'emulated_' . $item->get_id(),
			'product_id' => $product->get_id(),
			'quantity'   => $item->get_quantity(),
			'data'       => $product,
			'data_hash'  => wc_get_cart_item_data_hash( $product ),
		);
	}

	$packages = array(
		array(
			'contents'        => $cart_items,
			'contents_cost'   => $cost,
			'applied_coupons' => array(),
			'user'            => array(
				'ID' => $subscription->get_customer_id(),
			),
			'destination'     => array(
				'country'  => $subscription->get_shipping_country(),
				'state'    => $subscription->get_shipping_state(),
				'postcode' => $subscription->get_shipping_postcode(),
				'city'     => $subscription->get_shipping_city(),
			),
			'is_api_calc'     => 'yes',
		),
	);

	WC()->shipping()->calculate_shipping( $packages );

	$packages = WC()->shipping()->get_packages();

	WC()->cart->empty_cart();
	WC()->cart = $old_cart;

	foreach ( $packages as $package ) {
		foreach ( $package['rates'] as $shipping_rate ) {
			return $shipping_rate;
		}
	}

	return false;
}

/**
 * Recalculate Shipping for Subscription.
 *
 * @param \WC_Subscription $subscription
 * @return bool
 */
function wcte_recalculate_shipping_for_subscription( $subscription ) {

	$shipping_rate = wcte_get_shipping_rate_for_subscription( $subscription );

	if ( ! $shipping_rate ) {
		return false;
	}

	// Remove existing items.
	$subscription->remove_order_items( 'shipping' );

	$item = new \WC_Order_Item_Shipping();

	$item->set_props(
		array(
			'method_title' => $shipping_rate->label,
			'method_id'    => $shipping_rate->id,
			'total'        => wc_format_decimal( $shipping_rate->cost ),
			'taxes'        => array( 'total' => 0 ),
			'order_id'     => $subscription->get_id(),
		)
	);

	foreach ( $shipping_rate->get_meta_data() as $key => $value ) {
		$item->add_meta_data( $key, $value, true );
	}

	$subscription->add_item( $item );

	$item->save();

	$subscription->calculate_shipping();
	$subscription->update_taxes();
	$subscription->calculate_totals( false );
	return true;
}

add_filter( 'woocommerce_get_subscription_item_totals', 'wcte_get_subscription_item_totals', 20, 2 );

/**
 * Change the Shipping Method name to Free if the shipping is $0.00
 *
 * @param array $totals Subscription total rows.
 * @param \WC_Subscription $subscription Subscription object.
 *
 * @return mixed
 */
function wcte_get_subscription_item_totals( $totals, $subscription ) {

	if ( empty( $totals['shipping'] ) ) {
		return $totals;
	}

	if ( 0 < abs( (float) $subscription->get_shipping_total() ) ) {
		return $totals;
	}

	$totals['shipping']['value'] = 'Free';
	return $totals;
}
