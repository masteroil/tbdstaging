<?php
/**
 * This file adds functionality for defining which product categories will be offered
 * to customers when they are editing their subscriptions.
 * An integer setting is used to specify order of the products in the dropdown.
 */


add_action( 'product_cat_add_form_fields', 'wcte_add_category_fields' );
add_action( 'product_cat_edit_form_fields', 'wcte_edit_category_fields', 10 );
add_action( 'created_term', 'wcte_save_category_fields', 10, 3 );
add_action( 'edit_term', 'wcte_save_category_fields', 10, 3 );

/**
 * Add product category extra settings to the admin page.
 */
function wcte_add_category_fields() {
	?>
	<div class="form-field">
		<strong><?php esc_html_e( 'Subscription Toolbox', 'wcte' ); ?></strong>
		<label for="wcte_show_category_in_edit_subscription">
			<?php esc_html_e( 'Add Item - Subscription Product Category', 'wcte' ); ?>
		</label>
		<p class="description">
			<input value="1" type="checkbox" id="wcte_show_category_in_edit_subscription" name="wcte_show_category" />

			<?php esc_html_e( 'Products under this category will be shown when editing a subscription and adding an item.', 'wcte'); ?>
		</p>

		<label for="wcte_category_order">
			<?php esc_html_e( 'Category Order', 'wcte' ); ?>
		</label>
		<input type="number" value="" name="wcte_category_order" id="wcte_category_order" />
		<p class="description">
			<?php esc_html_e( 'Define the order in which the category products are shown in ascending order. From lowest to highest.', 'wcte'); ?>
		</p>
	</div>
	<?php
}

/**
 * Update product category extra settings.
 * @param $term
 */
function wcte_edit_category_fields( $term ) {

	$category_order = absint( get_term_meta( $term->term_id, 'wcte_category_order', true ) );
	$category_show  = absint( get_term_meta( $term->term_id, 'wcte_show_category', true ) );

	?>
	<tr>
		<th colspan="2">
			<strong><?php esc_html_e( 'Subscription Toolbox', 'wcte' ); ?></strong>
		</th>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="wcte_show_category_in_edit_subscription">
				<?php esc_html_e( 'Add Item - Subscription Product Category', 'woocommerce' ); ?>
			</label>
		</th>
		<td>
			<p class="description">
				<input value="1" <?php checked( $category_show, 1, true ); ?> type="checkbox" id="wcte_show_category_in_edit_subscription" name="wcte_show_category" />

				<?php esc_html_e( 'Products under this category will be shown when editing a subscription and adding an item.', 'wcte'); ?>
			</p>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="wcte_category_order">
				<?php esc_html_e( 'Category Order', 'wcte' ); ?>
			</label>
		</th>
		<td>
			<input type="number" value="<?php echo esc_attr( $category_order );?>" name="wcte_category_order" id="wcte_category_order" />
			<p class="description">
				<?php esc_html_e( 'Define the order in which the category products are shown in ascending order. From lowest to highest. If 0, it will be set as last.', 'wcte'); ?>
			</p>
		</td>
	</tr>
	<?php
}

/**
 * Save product category extra settings.
 *
 * @param        $term_id
 * @param string $tt_id
 * @param string $taxonomy
 */
function wcte_save_category_fields( $term_id, $tt_id = '', $taxonomy = '' ) {
	if ( 'product_cat' !== $taxonomy ) {
		return;
	}

	if ( isset( $_POST['wcte_category_order'] ) ) { // WPCS: CSRF ok, input var ok.
		update_term_meta( $term_id, 'wcte_category_order', absint( $_POST['wcte_category_order'] ) ); // WPCS: CSRF ok, sanitization ok, input var ok.
	}

	if ( isset( $_POST['wcte_show_category'] ) ) { // WPCS: CSRF ok, input var ok.
		update_term_meta( $term_id, 'wcte_show_category', 1 ); // WPCS: CSRF ok, input var ok.
	} else {
		delete_term_meta( $term_id, 'wcte_show_category' );
	}
}
