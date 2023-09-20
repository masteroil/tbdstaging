<?php
/**
 * TM Extra Product Options integration.
 */

namespace Javorszky\Toolbox;

class TM_Extra_Product_Options {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'run' ), 999 );
	}

	/**
	 * Check if the integration can run.
	 * @return bool
	 */
	public function can_run() {
		return class_exists( 'THEMECOMPLETE_Extra_Product_Options' );
	}

	/**
	 * Run the integration.
	 */
	public function run() {
		if ( ! $this->can_run() ) {
			return;
		}

		add_action( 'jgtb_woocommerce_order_item_meta_end', array( $this, 'show_extra_products' ), 20, 4 );
		add_action( 'jgtb_after_change_product_quantities', array( $this, 'update_extra_product_quantities' ), 20 );
		add_action( 'jgtb_after_not_changed_product_quantities', array( $this, 'update_extra_product_quantities' ), 20 );
	}

	/**
	 * Update Subscription Totals with Product Quantities.
	 *
	 * @param \WC_Subscription $subscription
	 */
	public function update_extra_product_quantities( $subscription ) {
		if ( ! isset( $_POST['jgtb_tm_epo'] ) ) {

			return;
		}

		$posted_items = $_POST['jgtb_tm_epo'];

		if ( ! $posted_items ) {
			return;
		}

		$order              = $subscription;
		$order_currency     = is_callable( array( $order, 'get_currency' ) ) ? $order->get_currency() : $order->get_order_currency();
		$mt_prefix          = $order_currency;
		$order_items        = $order->get_items();
		$order_taxes        = $order->get_taxes();
		$prices_include_tax = themecomplete_order_get_att( $order, 'prices_include_tax' );

		foreach ( $posted_items as $item_id => $epos ) {

			$item_meta     = function_exists( 'wc_get_order_item_meta' ) ? wc_get_order_item_meta( $item_id, '', false ) : $order->get_item_meta( $item_id );
			$qty           = (float) $item_meta['_qty'][0];
			$line_total    = floatval( $item_meta['_line_total'][0] );
			$line_subtotal = isset( $item_meta['_line_subtotal'] ) ? floatval( $item_meta['_line_subtotal'][0] ) : $line_total;
			$has_epo       = is_array( $item_meta )
							&& isset( $item_meta['_tmcartepo_data'] )
							&& isset( $item_meta['_tmcartepo_data'][0] )
							&& isset( $item_meta['_tm_epo'] );

			$has_fee = is_array( $item_meta )
						&& isset( $item_meta['_tmcartfee_data'] )
						&& isset( $item_meta['_tmcartfee_data'][0] );

			$saved_epos = false;

			if ( $has_epo || $has_fee ) {
				$saved_epos = maybe_unserialize( $item_meta['_tmcartepo_data'][0] );
			}

			$do_update = false;

			if ( $saved_epos ) {

				foreach ( $epos as $key => $epo ) {

					if ( ! isset( $epo['quantity'] ) ) {
						continue;
					}

					$new_currency             = false;
					$_current_currency_prices = $saved_epos[ $key ]['price_per_currency'];
					$option_price_before      = $this->order_price_exluding_tax( $saved_epos[ $key ]['price'], 0, $prices_include_tax, $order, $order_taxes, $order_items, $item_id );

					$saved_epos[ $key ]['price']    = ( floatval( $saved_epos[ $key ]['price'] ) / floatval( $saved_epos[ $key ]['quantity'] ) ) * floatval( $epo['quantity'] );
					$saved_epos[ $key ]['quantity'] = floatval( $epo['quantity'] );

					$line_total    = $line_total - ( $option_price_before * $qty );
					$line_subtotal = $line_subtotal - ( $option_price_before * $qty );

					$saved_epos[ $key ]['price'] = $this->order_price_exluding_tax( $saved_epos[ $key ]['price'], 0, $prices_include_tax, $order, $order_taxes, $order_items, $item_id );

					$tax_price          = $this->order_get_tax_price( $saved_epos[ $key ]['price'], false, 0, $prices_include_tax, $order, $order_taxes, $order_items, $item_id );
					$option_price_after = $saved_epos[ $key ]['price'];

					if ( $prices_include_tax ) {
						$option_price_after = $this->order_price_including_tax( $saved_epos[ $key ]['price'], 0, $prices_include_tax, $order, $order_taxes, $order_items, $item_id );
					}

					$line_total    = $line_total + ( $option_price_after * $qty );
					$line_subtotal = $line_subtotal + ( $option_price_after * $qty );

					$saved_epos[ $key ]['price']                            = $saved_epos[ $key ]['price'] + $tax_price;
					$saved_epos[ $key ]['price_per_currency'][ $mt_prefix ] = $saved_epos[ $key ]['price'] + $tax_price;

					$do_update = true;
				}
			}

			if ( $do_update ) {
				wc_update_order_item_meta( $item_id, '_line_total', wc_format_decimal( $line_total ) );
				wc_update_order_item_meta( $item_id, '_line_subtotal', wc_format_decimal( $line_subtotal ) );

				wc_update_order_item_meta( $item_id, '_tmcartepo_data', $saved_epos );

				wp_cache_delete( $item_id, 'order_item_meta' );
			}
		}

		$subscription = wcs_get_subscription( $subscription->get_id() );
		$subscription->calculate_totals();
		$subscription->save();

	}

	/**
	 * Get price with tax
	 *
	 * $price must be without tax
	 *
	 * @since 1.0
	 */
	public function order_price_including_tax( $price, $legacy_order, $prices_include_tax, $order, $order_taxes, $order_items, $item_id ) {

		$tax_price = $this->order_get_tax_price( $price, false, $legacy_order, $prices_include_tax, $order, $order_taxes, $order_items, $item_id );

		return (float) $price + (float) $tax_price;

	}


	/**
	 * Get price without tax
	 *
	 * $price must be with tax
	 *
	 * @since 1.0
	 */
	public function order_price_exluding_tax( $price, $legacy_order, $prices_include_tax, $order, $order_taxes, $order_items, $item_id ) {

		$tax_price = $this->order_get_tax_price( $price, true, $legacy_order, $prices_include_tax, $order, $order_taxes, $order_items, $item_id );

		return (float) $price - (float) $tax_price;

	}

	/**
	 * Get the tax price
	 *
	 * @since 1.0
	 */
	public function order_get_tax_price( $price, $price_has_tax, $legacy_order, $prices_include_tax, $order, $order_taxes, $order_items, $item_id ) {

		$tax_data  = empty( $legacy_order ) && wc_tax_enabled() ? maybe_unserialize( isset( $order_items[ $item_id ]['line_tax_data'] ) ? $order_items[ $item_id ]['line_tax_data'] : '' ) : false;
		$tax_price = 0;

		if ( ! empty( $tax_data ) && $prices_include_tax ) {

			$tax_based_on = get_option( 'woocommerce_tax_based_on' );

			if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.7.0', '<' ) ) {
				if ( 'billing' === $tax_based_on ) {
					$country  = $order->billing_country;
					$state    = $order->billing_state;
					$postcode = $order->billing_postcode;
					$city     = $order->billing_city;
				} elseif ( 'shipping' === $tax_based_on ) {
					$country  = $order->shipping_country;
					$state    = $order->shipping_state;
					$postcode = $order->shipping_postcode;
					$city     = $order->shipping_city;
				}
			} else {
				if ( 'billing' === $tax_based_on ) {
					$country  = $order->get_billing_country();
					$state    = $order->get_billing_state();
					$postcode = $order->get_billing_postcode();
					$city     = $order->get_billing_city();
				} elseif ( 'shipping' === $tax_based_on ) {
					$country  = $order->get_shipping_country();
					$state    = $order->get_shipping_state();
					$postcode = $order->get_shipping_postcode();
					$city     = $order->get_shipping_city();
				}
			}

			// Default to base
			if ( 'base' === $tax_based_on || ! isset( $country ) || empty( $country ) ) {
				$default  = wc_get_base_location();
				$country  = $default['country'];
				$state    = $default['state'];
				$postcode = '';
				$city     = '';
			}

			$tax_class = $order_items[ $item_id ]['tax_class'];
			$tax_rates = \WC_Tax::find_rates(
				array(
					'country'   => $country,
					'state'     => $state,
					'postcode'  => $postcode,
					'city'      => $city,
					'tax_class' => $tax_class,
				)
			);

			$epo_line_taxes = \WC_Tax::calc_tax( (float) $price, $tax_rates, $price_has_tax );

			foreach ( $order_taxes as $tax_item ) {
				$tax_item_id = $tax_item['rate_id'];
				if ( is_callable( array( $tax_item, 'get_rate_id' ) ) ) {
					$tax_item_id = $tax_item->get_rate_id();
				}
				if ( isset( $epo_line_taxes[ $tax_item_id ] ) ) {
					$tax_price = $tax_price + $epo_line_taxes[ $tax_item_id ];
				}
			}
		}

		return $tax_price;
	}


	/**
	 * @param $item_id
	 * @param \WC_Order_Item_Product$item
	 * @param $subscription
	 *
	 * @throws \Exception
	 */
	public function show_extra_products( $item_id, $item, $subscription, $allow_edit_qty ) {

		if ( ! $allow_edit_qty ) {
			return;
		}

		if ( $subscription ) {
			$order_currency = is_callable( array( $subscription, 'get_currency' ) ) ? $subscription->get_currency() : $subscription->get_order_currency();
		} else {
			$order_currency = get_woocommerce_currency();
		}
		$mt_prefix = $order_currency;

		$item_meta = function_exists( 'wc_get_order_item_meta' ) ? wc_get_order_item_meta( $item_id, '', false ) : $order->get_item_meta( $item_id );

		$_image = array();
		$_alt   = array();

		$_product = $item->get_product();

		$has_epo = is_array( $item_meta ) && isset( $item_meta['_tmcartepo_data'] ) && isset( $item_meta['_tmcartepo_data'][0] );

		if ( $has_epo ) {
			$current_product_id  = $item['product_id'];
			$original_product_id = floatval( THEMECOMPLETE_EPO_WPML()->get_original_id( $current_product_id, 'product' ) );
			if ( THEMECOMPLETE_EPO_WPML()->get_lang() === THEMECOMPLETE_EPO_WPML()->get_default_lang() && $original_product_id !== $current_product_id ) {
				$current_product_id = $original_product_id;
			}
			$wpml_translation_by_id = THEMECOMPLETE_EPO_WPML()->get_wpml_translation_by_id( $current_product_id );
		}

		if ( $has_epo ) {

			$epos = maybe_unserialize( $item_meta['_tmcartepo_data'][0] );

			if ( $epos && is_array( $epos ) ) {

				foreach ( $epos as $key => $epo ) {

					if ( $epo && is_array( $epo ) ) {
						$type         = THEMECOMPLETE_EPO()->get_saved_element_price_type( $epo );
						$new_currency = false;
						if ( isset( $epo['price_per_currency'] ) ) {
							$_current_currency_prices = $epo['price_per_currency'];
							if ( '' !== $mt_prefix
								&& '' !== $_current_currency_prices
								&& is_array( $_current_currency_prices )
								&& isset( $_current_currency_prices[ $mt_prefix ] )
								&& '' !== $_current_currency_prices[ $mt_prefix ]
							) {

								$new_currency = true;
								$epo['price'] = $_current_currency_prices[ $mt_prefix ];

							}
						}
						if ( ! $new_currency ) {
							$epo['price'] = apply_filters( 'wc_epo_get_current_currency_price', $epo['price'], $type, true, null, $order_currency );
						}

						if ( ! isset( $epo['quantity'] ) ) {
							$epo['quantity'] = 1;
						}

						if ( isset( $wpml_translation_by_id[ $epo['section'] ] ) ) {
							$epo['name'] = $wpml_translation_by_id[ $epo['section'] ];
						}

						// normal (local) mode
						if ( ! isset( $epo['price_per_currency'] ) && taxonomy_exists( $epo['name'] ) ) {
							$epo['name'] = wc_attribute_label( $epo['name'] );
						}

						$epo_name    = apply_filters( 'tm_translate', $epo['name'] );
						$epo['name'] = $epo_name;

						if ( isset( $wpml_translation_by_id[ 'options_' . $epo['section'] ] )
							&& is_array( $wpml_translation_by_id[ 'options_' . $epo['section'] ] )
							&& ! empty( $epo['multiple'] )
							&& ! empty( $epo['key'] )
						) {

							$pos = strrpos( $epo['key'], '_' );

							if ( false !== $pos ) {

								$av = array_values( $wpml_translation_by_id[ 'options_' . $epo['section'] ] );

								if ( isset( $av[ substr( $epo['key'], $pos + 1 ) ] ) ) {

									$epo['value'] = $av[ substr( $epo['key'], $pos + 1 ) ];

								}
							}
						}

						$epo['price'] = floatval( $epo['price'] );
						$this->render_item_option( $epo, $item_id, $key );
					}
				}
			}
		}

	}

	/**
	 * Render the item option.
	 *
	 * @param $epo
	 * @param $item_id
	 * @param $key
	 */
	public function render_item_option( $epo, $item_id, $key ) {

		?>
		<div>
			<small>
			<?php echo esc_html( $epo['name'] ); ?> (<?php echo wc_price( floatval( $epo['price'] ) / $epo['quantity'] ); ?>)
			<strong>x <input
					type="number"
					name="jgtb_tm_epo[<?php echo esc_attr( $item_id ); ?>][<?php echo esc_attr( $key ); ?>][quantity]"
					value="<?php echo esc_attr( $epo['quantity'] ); ?>"
					style="display: inline-block;width: 4rem;"
				/>
			</strong>
			</small>
		</div>
		<?php
	}
}

new TM_Extra_Product_Options();
