<?php
/**
 * This template is used to display the next payment date on the view subscription page and edit subscription page.
 * On the view subscription page a form is added along with a "Go" button so any date changes can be saved.
 *
 * This template is called from:
 * - templates/myaccount/edit-subscription.php
 * - inc/RescheduleNextRenewal.php
 *
 */
$current_date = $subscription->get_date( 'next_payment', 'site' ); ?>
<tr>
	<td>
		<p><?php echo esc_html( apply_filters( 'jgtb_change_next_shipping_date_wording', __( 'Change Next Payment Date', 'jg-toolbox' ) ) ); ?></p>
	</td>
	<td>
		<?php
		if ( 'cancelled' !== $subscription->get_status() ) {
			echo ( isset( $embed_form ) && $embed_form ) ? '<form action="" method="POST">' : '';
			wp_nonce_field( 'change_next_ship_date_' . $subscription->get_id() . $current_date, 'jgtb_nonce', false );
			?>
			<input type="hidden" name="nsd_subscription_id" value="<?php echo esc_attr( $subscription->get_id() ); ?>">
			<input type="hidden" name="old_ship_date" value="<?php echo esc_attr( substr( $current_date, 0, 10 ) ); ?>">
			<input type="text" name="new_ship_date" id="pickadate" value="<?php echo esc_attr( substr( $current_date, 0, 10 ) ); ?>">
			<?php
			echo ( isset( $embed_form ) && $embed_form ) ? '<button type="submit">' . esc_html__( 'Go', 'jg-toolbox' ) . '</button></form>' : ''; // phpcs:ignore.
		} else {
			?>
			<label type="text" name="new_ship_date" >
				<?php esc_html_e( 'None', 'jg-toolbox' ); ?>
			</label>
			<?php
		}
		?>
	</td>
</tr>
