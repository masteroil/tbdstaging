<tr class="wp-updater-license-row <?php echo esc_attr( sanitize_html_class( $plugin->get_license_status() ) ); ?>">
	<td colspan="5">
		<label><?php esc_html_e( 'License' ); ?>&nbsp;
			<input
				type="text"
				value="<?php echo esc_attr( $plugin->get_license_key() ); ?>"
				class="wp-updater-license-input"
				placeholder="<?php esc_attr_e( 'Your license key' ); ?>"
				data-plugin="<?php echo esc_attr( $plugin->plugin_basename ); ?>"
			>
		</label>
		<span class="waiting spinner" style="float: none; vertical-align: top;"></span>
		<?php

		$license_status = $plugin->get_license_status();
		if ( 'expired' === $license_status ) {
			?>
			<em><?php esc_html_e( 'Your license has expired. Please renew it to receive plugin updates' ); ?></em>
			<?php
		} elseif ( 'no_activations_left' === $license_status ) {
			?>
			<em><?php esc_html_e( 'Your license has reached its activation limit.' ); ?></em>
			<?php
		} else {
			?>
			<em><?php esc_html_e( 'Enter your license info and press return to activate it.' ); ?> <a target="_blank" href="https://shopplugins.com/account"><?php esc_html_e( 'Find your license here.' ); ?></a></em>
			<?php
		}

		if ( $plugin->client->is_update_available() && $plugin->get_license_status() !== 'valid' ) {
			?>
			<div class="update-message notice inline notice-error notice-alt" style="margin: 10px 0 5px;">
				<p>
					<?php
					// translators: Plugin Name.
					echo esc_html( sprintf( __( 'There is a new version of %s available.' ), $plugin->get_name() ) );
					?>
					&nbsp;
					<strong><?php esc_html_e( 'Please enter a valid license to receive this update.' ); ?></strong>
				</p>
				<?php if ( ! empty( $plugin->message ) ) { ?>
					<p>
						<?php
						echo esc_html( $plugin->message );
						?>
					</p>
				<?php } ?>
			</div>
			<?php
		}

		?>
	</td>
</tr>
