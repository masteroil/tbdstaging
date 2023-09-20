<?php
namespace Javorszky\Toolbox;

use WCS_Remove_Item;

$category_terms = get_terms([
	'taxonomy'   => 'product_cat',
	'meta_query' => array(
		array(
			'key' => 'wcte_show_category',
			'value' => '1'
		)
	),
	'meta_key' => 'wcte_category_order',
	'orderby' => 'wcte_category_order',
	'order' => 'ASC'
]);

$category_products = array();

if ( $category_terms ) {
	foreach ( $category_terms as $category ) {
		$category_products[ $category->name ] = wc_get_products( array( 
			'category' => array( $category->slug ),
			'limit' => -1 ,
			'status' => array('publish' ), 
			'stock_status' => 'instock', 
			) 
		); 
	}
}

$tax_display = get_option( 'woocommerce_tax_display_cart' );
$include_tax = true;
if ( 'excl' === $tax_display ) {
	$include_tax = false;
}

?>
<div class="desupdtproduct">
	<table class="shop_table order_details">
		<thead>
		<tr>

			<th class="product-name"><?php echo esc_html_x( 'Product', 'table headings in notification email', 'jg-toolbox' ); ?></th>
			<th class="product-quantity"><?php echo esc_html_x( 'Quantity', 'table heading', 'jg-toolbox' ); ?></th>
			<th class="product-total"><?php echo esc_html_x( 'Total', 'table heading', 'jg-toolbox' ); ?></th>
			<?php
			if ( $allow_remove_item ) {
				?>
				<th class="product-remove" style="width: 3em;">&nbsp;</th>
				<?php
			}
			?>
		</tr>
		</thead>
		<tbody>
		<?php
		$subscription_items = $subscription->get_items();
		$exclude_for_add_items = array();
		if ( count( $subscription_items ) > 0 ) {

			foreach ( $subscription_items as $item_id => $item ) {
				$_product = apply_filters( 'woocommerce_subscriptions_order_item_product', $item->get_product(), $item );
				$exclude_for_add_items[] = $_product->get_id();
				if ( apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
					?>
					<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $subscription ) ); ?>">

						<td class="product-name">
							<?php
							if ( $_product && ! $_product->is_visible() ) {
								echo esc_html( apply_filters( 'woocommerce_order_item_name', $item['name'], $item ) );
							} else {
								echo wp_kses_post( apply_filters( 'woocommerce_order_item_name', sprintf( '<a href="%s">%s</a>', get_permalink( $item['product_id'] ), $item['name'] ), $item ) );
							}
							?>

							<?php

							// Allow other plugins to add additional product information here
							do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $subscription );

							$item->get_formatted_meta_data();

							if ( $_product && $_product->exists() && $_product->is_downloadable() && $subscription->is_download_permitted() ) {

								$download_files = $subscription->get_item_downloads( $item );
								$i              = 0;
								$links          = array();

								foreach ( $download_files as $download_id => $file ) {
									$i++;
									// translators: %1$s is the number of the file, %2$s: the name of the file
									$link_text = sprintf( _nx( 'Download file %1$s: %2$s', 'Download file %1$s: %2$s', count( $download_files ), 'Used as link text in view-subscription template', 'jg-toolbox' ), $i, $file['name'] );
									$links[]   = '<small><a href="' . esc_url( $file['download_url'] ) . '">' . esc_html( $link_text ) . '</a></small>';
								}

								echo '<br/>' . wp_kses_post( implode( '<br/>', $links ) );
							}

							// Allow other plugins to add additional product information here
							do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $subscription );
							?>
						</td>

						<td class="product-quantity">
							<strong class="product-quantity">

								<?php
								if ( 'no' !== $allow_edit_qty ) {
									?>
									<input type="number" data-item-id="<?php echo esc_attr( $item_id ); ?>" class="wcte_quantity" name="new_quantity_<?php echo esc_attr( $item_id ); ?>" min="0" step="1" max="999" value="<?php echo esc_attr( $item['qty'] ); ?>" style="display: inline-block;width: 4rem">
									<?php
								} else {
									echo esc_html( $item->get_quantity() );
								}
								?>
							</strong>
						</td>

						<td class="product-total" data-decimals="<?php echo esc_attr( wc_get_price_decimals() ); ?>" data-price="<?php echo esc_attr( $subscription->get_line_subtotal( $item, $include_tax ) / $item['qty'] ); ?>" id="wcteProductTotal_<?php echo esc_attr( $item_id ); ?>">
							<?php echo wp_kses_post( $subscription->get_formatted_line_subtotal( $item ) ); ?>
						</td>
						<?php if ( $allow_remove_item ) : ?>
							<td class="remove_item"><a href="<?php echo esc_url( WCS_Remove_Item::get_remove_url( $subscription->get_id(), $item_id ) ); ?>" class="remove" onclick="return confirm('<?php printf( esc_html__( 'Are you sure you want remove this item from your subscription?', 'jg-toolbox' ) ); ?>' );">&times;</a></td>
						<?php endif; ?>
					</tr>
					<tr class="mobail-custome-remove">
						<td class="remove_item" colspan="<?php echo esc_attr( $allow_remove_item ? 4 : 3 ); ?>"><a href="<?php echo esc_url( WCS_Remove_Item::get_remove_url( $subscription->get_id(), $item_id ) ); ?>" class="remove" onclick="return confirm('<?php printf( esc_html__( 'Are you sure you want remove this item from your subscription?', 'jg-toolbox' ) ); ?>' );">&times;</a></td>
					</tr>
					<?php
				}

				$purchase_note = get_post_meta( $_product->get_id(), '_purchase_note', true );

				if ( $subscription->has_status( array( 'completed', 'processing' ) ) && $purchase_note ) {
					?>
					<tr class="product-purchase-note">
						<td colspan="3"><?php echo wp_kses_post( wpautop( do_shortcode( $purchase_note ) ) ); ?></td>
					</tr>
					<?php
				}
			}
		}

		?>
        <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $subscription ) ); ?> wcte_new_order_item hidden">
            <td class="product-name">
                <div class="wcte-new-item-select">
                    <select data-exclude="<?php echo esc_attr(wp_json_encode( $exclude_for_add_items )); ?>" data-subscription="<?php echo esc_attr( $subscription->get_id() ); ?>" style="width:100%;" class="wcte-product-search" name="wcte_item_id" data-placeholder="<?php echo esc_attr__( 'Search for a product&hellip;', 'woocommerce' ); ?>">
                        <?php
                            foreach ( $category_products as $category_name => $term_products ) {

                                $products_to_show = array();

	                            foreach ( $term_products as $term_product ) {
		                            if ( in_array( $term_product->get_id(), $exclude_for_add_items, true ) ) {
			                            continue;
		                            }

		                            $products_to_show[ $term_product->get_id() ] = $term_product->get_name();

	                            }

	                            if ( ! $products_to_show ) {
	                                continue;
                                }

	                            ?>
                                <optgroup label="<?php echo esc_attr( $category_name ); ?>">
                                    <?php
                                    foreach ( $products_to_show as $term_product_id => $term_product_name ) {
                                        ?>
                                        <option value="<?php echo esc_attr( $term_product_id ); ?>">
                                            <?php echo esc_html( $term_product_name ); ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </optgroup>
                                <?php
                            }
                        ?>
                    </select>

                </div>
            </td>
            <td class="product-quantity"></td>
            <td class="product-total"></td>
	        <?php if ( $allow_remove_item ) : ?>
                <td class="remove_item"></td>
	        <?php endif; ?>
        </tr>


		</tbody>

	</table>

	<div class="cusedisub">

		<div class="clear"></div>
		<input type="hidden" name="jgtb_edit_subscription_details" value="<?php echo esc_attr( $subscription->get_id() ); ?>">
		<?php wp_nonce_field( 'wcs_edit_details_of_' . $subscription->get_id(), 'jgtb_edit_details_of_' . $subscription->get_id() ); ?>


        <button type="button" class="esavesubedit wcte-show-product-search" name="add-subscription-item" value=1><?php echo esc_html_x( 'Add Item', 'Button text on Edit Subscription page when adding item', 'wcte' ); ?></button>
        <button type="submit" class="esavesubedit" name="edit-subscription-button" value=1><?php echo esc_html_x( 'Save updated subscription details', 'Button text on Edit Subscription page', 'jg-toolbox' ); ?></button>
	</div>
</div>
