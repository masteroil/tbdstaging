<?php

$item_id = $product ? $product->get_id() + time() : time();
?>
<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $product, $subscription ) ); ?>">

	<td class="product-name">
		<?php
		if ( $product && ! $product->is_visible() ) {
			echo esc_html( apply_filters( 'woocommerce_order_item_name', $product->get_name(), array() ) );
		} else {
			echo wp_kses_post( apply_filters( 'woocommerce_order_item_name', sprintf( '<a href="%s">%s</a>', get_permalink( $product->get_id() ), $product->get_name() ) ) );
		}
		?>

	</td>

	<td class="product-quantity">
		<strong class="product-quantity">

			<?php
			if ( 'no' !== $allow_edit_qty ) {
				?>
				<input type="number" data-item-id="<?php echo esc_attr( $item_id ); ?>" class="wcte_quantity" name="wcte_new_quantity[<?php echo esc_attr( $product->get_id() ); ?>]" min="0" step="1" max="999" value="1" style="display: inline-block;width: 4rem">
				<?php
			} else {
				echo esc_html( 1 );
			}
			?>
		</strong>
	</td>

    <?php
        $prices = wcte_get_product_price(array( 'price' => $product->get_price() ), $product, $subscription );
    ?>
	<td class="product-total" data-decimals="<?php echo esc_attr( wc_get_price_decimals() ); ?>" data-price="<?php echo esc_attr( $prices['price'] ); ?>" id="wcteProductTotal_<?php echo esc_attr( $item_id ); ?>">
        <?php

        $subscription_details = array(
	        'currency'                    => $subscription->get_currency(),
	        'recurring_amount'            => $prices['price'],
	        'subscription_period'         => $subscription->get_billing_period(),
	        'subscription_interval'       => $subscription->get_billing_interval(),
	        'display_excluding_tax_label' => false,
        );

        echo wcs_price_string( $subscription_details );
        ?>

	</td>
	<?php if ( $allow_remove_item ) : ?>
		<td class="remove_item"><a href="#" class="remove wcte-remove-item">&times;</a></td>
	<?php endif; ?>
</tr>
<tr class="mobail-custome-remove">
	<td class="remove_item" colspan="<?php echo esc_attr( $allow_remove_item ? 4 : 3 ); ?>">
		<a href="#" class="remove wcte-remove-item">&times;</a>
	</td>
</tr>
<?php


$purchase_note = get_post_meta( $product->get_id(), '_purchase_note', true );

if ( $subscription->has_status( array( 'completed', 'processing' ) ) && $purchase_note ) {
	?>
	<tr class="product-purchase-note">
		<td colspan="3"><?php echo wp_kses_post( wpautop( do_shortcode( $purchase_note ) ) ); ?></td>
	</tr>
	<?php
}
