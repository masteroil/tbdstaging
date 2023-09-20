<?php
namespace Javorszky\Toolbox\Settings;

add_filter( 'woocommerce_settings_tabs_array', __NAMESPACE__ . '\\add_toolbox_settings_tab', 60 );
add_action( 'woocommerce_settings_tabs_jg-toolbox', __NAMESPACE__ . '\\toolbox_settings_page' );
add_action( 'woocommerce_update_options_jg-toolbox', __NAMESPACE__ . '\\update_toolbox_settings' );
add_filter( 'plugin_action_links_' . plugin_basename( JGTB_FILE ), __NAMESPACE__ . '\\plugin_action_links' );
add_action( 'woocommerce_product_options_general_product_data', __NAMESPACE__ . '\\setting_hide_add_to_existing' );
add_action( 'save_post', __NAMESPACE__ . '\\save_setting_meta', 11 );

/**
 * Add the Toolbox settings tab to the WooCommerce settings tabs array.
 *
 * @param array      $settings_tabs  Array of WooCommerce setting tabs & their labels, excluding the Toolbox tab.
 * @return array
 * @since 0.1.0
 */
function add_toolbox_settings_tab( $settings_tabs ) {

	$settings_tabs['jg-toolbox'] = __( 'Toolbox for Subscriptions', 'jg-toolbox' );

	return $settings_tabs;
}

/**
 * Uses the WooCommerce admin fields API to output settings via the @see woocommerce_admin_fields() function.
 *
 * @uses woocommerce_admin_fields()
 * @uses get_toolbox_settings()
 * @since 0.1.0
 */
function toolbox_settings_page() {
	woocommerce_admin_fields( get_toolbox_settings() );
	wp_nonce_field( 'jgtb_toolbox_settings', '_wcsnonce', false );
}

/**
 * Sets default values for all the Toolbox options. Called on plugin activation.
 *
 * @since 0.1.0
 */
function add_default_settings() {
	foreach ( get_toolbox_settings() as $setting ) {
		if ( isset( $setting['default'] ) ) {
			update_option( $setting['id'], $setting['default'], false );
		}
	}
}

/**
 * Uses the WooCommerce options API to save settings via the @see woocommerce_update_options() function.
 *
 * @uses woocommerce_update_options()
 * @uses get_toolbox_settings()
 * @since 0.1.0
 */
function update_toolbox_settings() {
	if ( empty( $_POST['_wcsnonce'] ) || ! wp_verify_nonce( $_POST['_wcsnonce'], 'jgtb_toolbox_settings' ) ) {
		return;
	}

	woocommerce_update_options( get_toolbox_settings() );
	flush_rewrite_rules();
}

/**
 * Get all the settings for the Subscriptions extension in the format required by the @see woocommerce_admin_fields() function.
 *
 * @return array Array of settings in the format required by the @see woocommerce_admin_fields() function.
 * @since 1.0
 */
function get_toolbox_settings() {
	return apply_filters(
		'jgtb_toolbox_settings',
		array(

			// begins a section
			array(
				'name' => __( 'Features', 'jg-toolbox' ),
				'type' => 'title',
				'desc' => '',
				'id'   => JGTB_OPTION_PREFIX . 'toolbox_features',
			),

			array(
				'name'            => __( 'Skip next scheduled payment', 'jg-toolbox' ),
				'desc'            => __( 'Whether skip next schedule functionality is available.', 'jg-toolbox' ),
				'id'              => JGTB_OPTION_PREFIX . 'skip_next_available',
				'default'         => 'yes',
				'type'            => 'checkbox',
				// translators: placeholders are opening and closing link tags
				'desc_tip'        => __( 'Skip next scheduled payment will automatically advance the subscription to the next payment date after the one that is coming up without charging the customer or generating an order for it.', 'jg-toolbox' ),
				'show_if_checked' => 'option',
			),

			array(
				'name'            => __( 'Ship now and keep schedule', 'jg-toolbox' ),
				'desc'            => __( 'Whether ship now and keep schedule functionality is available.', 'jg-toolbox' ),
				'id'              => JGTB_OPTION_PREFIX . 'ship_now_keep_available',
				'default'         => 'yes',
				'type'            => 'checkbox',
				// translators: placeholders are opening and closing link tags
				'desc_tip'        => __( 'Shipping a subscription now will charge the customer right away and generate an order. It will also keep the original schedule, so the next payment date will remain what it was before they had an order generated.', 'jg-toolbox' ),
				'show_if_checked' => 'option',
			),

			array(
				'name'            => __( 'Ship now and reschedule payment', 'jg-toolbox' ),
				'desc'            => __( 'Whether ship now and reschedule functionality is available.', 'jg-toolbox' ),
				'id'              => JGTB_OPTION_PREFIX . 'ship_now_reschedule_available',
				'default'         => 'yes',
				'type'            => 'checkbox',
				// translators: placeholders are opening and closing link tags
				'desc_tip'        => __( 'Shipping a subscription now will charge the customer right away and generate an order. It will reschedule the next payment day with relation to when the customer requested it. For example if the subscription is monthly, and the next payment would be 10 days in the future, this will move the next payment date to be a month from the day.', 'jg-toolbox' ),
				'show_if_checked' => 'option',
				'checkboxgroup'   => 'start',
			),

			array(
				'name'            => __( 'Reschedule payment from next payment date', 'jg-toolbox' ),
				'desc'            => __( 'Reschedule payment from next payment date', 'jg-toolbox' ),
				'id'              => JGTB_OPTION_PREFIX . 'reschedule_from_payment_date',
				'default'         => 'no',
				'type'            => 'checkbox',
				// translators: placeholders are opening and closing link tags
				'desc_tip'        => __( 'It will reschedule the next payment day with relation to current next payment date. For example if the subscription is monthly, and the next payment would be 10 days in the future, this will move the next payment date to be a month + 10 days from the day.', 'jg-toolbox' ),
				'show_if_checked' => 'yes',
				'checkboxgroup'   => 'end',
			),

			array(
				'name'            => __( 'Edit subscription details', 'jg-toolbox' ),
				'desc'            => __( 'Whether edit subscription details functionality is available.', 'jg-toolbox' ),
				'id'              => JGTB_OPTION_PREFIX . 'edit_sub_details_available',
				'default'         => 'yes',
				'type'            => 'checkbox',
				// translators: placeholders are opening and closing link tags
				'desc_tip'        => __( 'This will allow customers to edit their subscription details in a more streamlined way. The edit subscription screen allows them to change the next payment date, the quantities of products in the subscription, the interval and period of the subscription, and the shipping and billing addresses.', 'jg-toolbox' ),
				'show_if_checked' => 'option',
				'checkboxgroup'   => 'start',
			),

			array(
				'name'            => __( 'Allow quantity change in edit details?', 'jg-toolbox' ),
				'desc'            => __( 'Allow quantity change in edit details?', 'jg-toolbox' ),
				'id'              => JGTB_OPTION_PREFIX . 'qty_change_edit_sub_details',
				'default'         => 'yes',
				'type'            => 'checkbox',
				// translators: placeholders are opening and closing link tags
				'desc_tip'        => __( 'If this box is ticked, customers will be able to change the quantity of their products on their subscriptions. Does not change bulk edit quantities.', 'jg-toolbox' ),
				'checkboxgroup'   => '',
				'show_if_checked' => 'yes',
			),

			array(
				'name'            => __( 'Allow product variation change in edit details?', 'jg-toolbox' ),
				'desc'            => __( 'Allow product variation change in edit details?', 'jg-toolbox' ),
				'id'              => JGTB_OPTION_PREFIX . 'variation_change_edit_sub_details',
				'default'         => 'no',
				'type'            => 'checkbox',
				// translators: placeholders are opening and closing link tags
				'desc_tip'        => __( 'If this box is ticked, customers will be able to change the variation of their products on their subscriptions.', 'jg-toolbox' ),
				'checkboxgroup'   => '',
				'show_if_checked' => 'yes',
			),

			array(
				'name'            => __( 'Allow frequency change in edit details?', 'jg-toolbox' ),
				'desc'            => __( 'Allow frequency change in edit details?', 'jg-toolbox' ),
				'id'              => JGTB_OPTION_PREFIX . 'freq_change_edit_sub_details',
				'default'         => 'yes',
				'type'            => 'checkbox',
				// translators: placeholders are opening and closing link tags
				'desc_tip'        => __( 'If this box is ticked, customers will be able to change the shipping frequency of their subscriptions.', 'jg-toolbox' ),
				'checkboxgroup'   => 'end',
				'show_if_checked' => 'yes',
			),

			array(
				'name'            => __( 'Bulk edit / ship subscriptions', 'jg-toolbox' ),
				'desc'            => __( 'Whether customers can ship multiple subscriptions from their subscriptions screen.', 'jg-toolbox' ),
				'id'              => JGTB_OPTION_PREFIX . 'bulk_edit_subscriptions',
				'default'         => 'yes',
				'type'            => 'checkbox',
				// translators: placeholders are opening and closing link tags
				'desc_tip'        => __( 'Customers can select subscriptions and choose to ship them now and keep schedule / reschedule it. They can also edit the quantities of items on those subscriptions.', 'jg-toolbox' ),
				'show_if_checked' => 'option',
			),

			array(
				'name'            => __( 'Change next payment date', 'jg-toolbox' ),
				'desc'            => __( 'Whether customers can change the next payment date of the subscription themselves.', 'jg-toolbox' ),
				'id'              => JGTB_OPTION_PREFIX . 'change_next_payment_available',
				'default'         => 'yes',
				'type'            => 'checkbox',
				// translators: placeholders are opening and closing link tags
				'desc_tip'        => __( 'Customers can choose a new next payment date from a date dropdown. The earliest they can choose is the next day.', 'jg-toolbox' ),
				'show_if_checked' => 'option',
			),

			array(
				'name'            => __( 'Add products to existing subscriptions', 'jg-toolbox' ),
				'desc'            => __( 'Whether customers can add subscription products to existing subscriptions.', 'jg-toolbox' ),
				'id'              => JGTB_OPTION_PREFIX . 'add_to_subscription',
				'default'         => 'yes',
				'type'            => 'checkbox',
				// translators: placeholders are opening and closing link tags
				'desc_tip'        => __( 'Customers can add products to existing subscriptions. The products\' own period and interval will be ignored, and the subscription\'s interval and period will be used.', 'jg-toolbox' ),
				'show_if_checked' => 'option',
			),

			array(
				'type' => 'sectionend',
				'id'   => JGTB_OPTION_PREFIX . 'toolbox_features',
			),

			// begins a section
			array(
				'name' => __( 'Button text', 'jg-toolbox' ),
				'type' => 'title',
				'desc' => 'These will change the buttons\' text on the view subscription page. You can use a few placeholders in the button names. These are <code>[date_created]</code>, <code>[start_date]</code>, <code>[next_date]</code>, <code>[next_date_from_next]</code>, <code>[next_date_from_last]</code>, and <code>[next_date_from_today]</code>. They will be replaced with the dates relating to the subscription.',
				'id'   => JGTB_OPTION_PREFIX . 'toolbox_buttons',
			),

			array(
				'name'     => __( 'Skip next schedule button text', 'jg-toolbox' ),
				'tip'      => '',
				'id'       => JGTB_OPTION_PREFIX . 'skip_next_button_text',
				'css'      => 'min-width:300px;',
				'default'  => __( 'Skip next payment', 'jg-toolbox' ),
				'type'     => 'text',
				'desc_tip' => true,
			),

			array(
				'name'     => __( 'Ship now keep schedule button text', 'jg-toolbox' ),
				'tip'      => '',
				'id'       => JGTB_OPTION_PREFIX . 'ship_keep_button_text',
				'css'      => 'min-width:300px;',
				'default'  => __( 'Ship now, keep schedule', 'jg-toolbox' ),
				'type'     => 'text',
				'desc_tip' => true,
			),

			array(
				'name'     => __( 'Ship now reschedule button text', 'jg-toolbox' ),
				'tip'      => '',
				'id'       => JGTB_OPTION_PREFIX . 'ship_reschedule_button_text',
				'css'      => 'min-width:300px;',
				'default'  => __( 'Ship now, reschedule from today', 'jg-toolbox' ),
				'type'     => 'text',
				'desc_tip' => true,
			),

			array(
				'name'     => __( 'Ship now reschedule from next payment button text', 'jg-toolbox' ),
				'tip'      => '',
				'id'       => JGTB_OPTION_PREFIX . 'ship_reschedule_from_next_payment_button_text',
				'css'      => 'min-width:300px;',
				'default'  => __( 'Ship now, reschedule from next payment', 'jg-toolbox' ),
				'type'     => 'text',
				'desc_tip' => true,
			),

			array(
				'name'     => __( 'Edit subscription details button text', 'jg-toolbox' ),
				'tip'      => '',
				'id'       => JGTB_OPTION_PREFIX . 'edit_subs_button_text',
				'css'      => 'min-width:300px;',
				'default'  => __( 'Edit details', 'jg-toolbox' ),
				'type'     => 'text',
				'desc_tip' => true,
			),
			array(
				'type' => 'sectionend',
				'id'   => JGTB_OPTION_PREFIX . 'toolbox_buttons',
			),
		)
	);

}

/**
 * Add links to the Toolbox row of the WordPress Dashboard's Plugin page.
 *
 * @param $links
 * @return array
 */
function plugin_action_links( $links ) {
	$setting_link = get_setting_link();

	$plugin_links = array(
		'<a href="' . $setting_link . '">' . __( 'Settings', 'jg-toolbox' ) . '</a>',
		'<a href="https://shopplugins.com/docs/">' . __( 'Docs', 'jg-toolbox' ) . '</a>',
		'<a href="https://shopplugins.com/support/">' . __( 'Support', 'jg-toolbox' ) . '</a>',
	);
	return array_merge( $plugin_links, $links );
}

function get_setting_link() {
	return admin_url( 'admin.php?page=wc-settings&tab=jg-toolbox' );
}

/**
 * Per-product setting to hide the "Add to existing subscription" form on the product page.
 */
function setting_hide_add_to_existing() {
	global $post;
	?>
	<div class="options_group show_if_simple show_if_external show_if_variable">
		<p class="form-field _hide_add_to_existing">
			<label for="_toolbox_hide_add_to_existing">Toolbox Settings</label>
			<input id="_toolbox_hide_add_to_existing" type="checkbox" class="checkbox"
					name="_toolbox_hide_add_to_existing"
					value="yes" <?php checked( 'yes' === get_post_meta( $post->ID, '_toolbox_hide_add_to_existing', true ), true, true ); ?>>
			<span style="clear: none; margin-left: 22px;" class="description">Check this to hide the "Add to Existing Subscription" option for this product.</span>
		</p>
	</div>
	<?php
}

/**
 * Save setting meta
 *
 * @param $post_id
 */
function save_setting_meta( $post_id ) {
	if ( empty( $_POST['_wcsnonce'] ) || ! wp_verify_nonce( $_POST['_wcsnonce'], 'wcs_subscription_meta' ) ) {
		return;
	}
	if ( isset( $_REQUEST['_toolbox_hide_add_to_existing'] ) ) {
		update_post_meta( $post_id, '_toolbox_hide_add_to_existing', $_REQUEST['_toolbox_hide_add_to_existing'] );
	} else {
		delete_post_meta( $post_id, '_toolbox_hide_add_to_existing' );
	}
}
