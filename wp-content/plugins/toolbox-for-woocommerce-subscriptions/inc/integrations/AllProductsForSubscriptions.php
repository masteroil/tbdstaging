<?php
/**
 * Adding integration for WC All Products for WooCommerce Subscriptions.
 */
namespace Javorszky\Toolbox;

use WC_Product;
use WC_Subscription;
use WCS_ATT_Product_Schemes;
use WCS_ATT_Scheme;

/**
 * Class AllProductsForSubscriptions
 *
 * @package Javorszky\Toolbox
 */
class AllProductsForSubscriptions {

	/**
	 * AllProductsForSubscriptions constructor.
	 */
	public function __construct() {
		add_filter( 'jgtb_add_to_subscription_product_data', array( $this, 'change_product_price' ), 20, 4 );
	}

	/**
	 * Change the Product Price by using the discount.
	 *
	 * @param array            $args Arguments used when adding product to subscription.
	 * @param WC_Product       $product
	 * @param WC_Subscription  $subscription
	 * @param integer          $quantity Quantity of products to be added.
	 *
	 * @return array
	 */
	public function change_product_price( $args, $product, $subscription, $quantity = 1 ) : array {
		// No such class for some reason? Exit early.
		if ( ! class_exists( 'WCS_ATT_Product_Schemes' ) ) {
			return $args;
		}

		$schemes = WCS_ATT_Product_Schemes::get_subscription_schemes( $product, 'product' );

		if ( ! $schemes ) {
			return $args;
		}

		$period   = $subscription->get_billing_period();
		$interval = $subscription->get_billing_interval();

		$matching_period_schemes = array();
		/** @var WCS_ATT_Scheme $scheme */
		foreach ( $schemes as $scheme ) {
			if ( $period === $scheme->get_period() ) {
				$matching_period_schemes[] = $scheme;
			}
		}

		if ( ! $matching_period_schemes ) {
			return $args;
		}

		/** @var WCS_ATT_Scheme $chosen_scheme */
		$chosen_scheme = $matching_period_schemes[0]; // Use first scheme in case the interval is not there.

		/** @var WCS_ATT_Scheme $scheme */
		foreach ( $matching_period_schemes as $scheme ) {
			if ( $interval === $scheme->get_interval() ) {
				$chosen_scheme = $scheme;
			}
		}

		$prices = $chosen_scheme->get_prices(
			array(
				'price'         => $product->get_price(),
				'sale_price'    => $product->get_sale_price(),
				'regular_price' => $product->get_regular_price(),
			)
		);

		$data['subtotal'] = wc_get_price_excluding_tax(
			$product,
			array(
				'qty'   => $quantity,
				'price' => $prices['price'],
			)
		);
		$data['total']    = wc_get_price_excluding_tax(
			$product,
			array(
				'qty'   => $quantity,
				'price' => $prices['price'],
			)
		);

		return $data;
	}
}

new AllProductsForSubscriptions();
