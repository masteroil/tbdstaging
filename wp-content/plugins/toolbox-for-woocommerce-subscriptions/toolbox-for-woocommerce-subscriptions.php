<?php
/**
 * Plugin Name:     Toolbox for WooCommerce Subscriptions
 * Plugin URI:      https://shopplugins.com/plugins/toolbox-for-woocommerce-subscriptions/
 * Description:     Plugin that adds additional functionality to stores that use WooCommerce and WooCommerce Subscriptions.
 * Author:          Shop Plugins
 * Author URI:      https://shopplugins.com
 * Text Domain:     jg-toolbox
 * Domain Path:     /languages
 * Version:         1.4.27
 * WC requires at least: 3.0
 * WC tested up to:      7
 *
 * @package         Toolbox_For_Woocommerce_Subscriptions
 */
namespace Javorszky\Toolbox;

define( 'JGTB_PATH', plugin_dir_path( __FILE__ ) );
define( 'JGTB_URL', plugin_dir_url( __FILE__ ) );
define( 'JGTB_FILE', __FILE__ );
define( 'JGTB_VERSION', '1.4.27' );
define( 'JGTB_REQ_WC_VERSION', '3.0.0' );
define( 'JGTB_REQ_WCS_VERSION', '3.0.0' );
define( 'JGTB_OPTION_PREFIX', 'jgtb_' );

add_action( 'plugins_loaded', __NAMESPACE__ . '\\init', 0 );

/**
 * All distinct functionality are in their own files, namespaced, no classes. That makes it easier to get stuff.
 */
function init() {
	if ( ! check_prerequisites() ) {
		return false;
	}

	if ( ! defined( 'JGTB_EDIT_SUB_ENDPOINT' ) ) {
		// By defining this constant in another plugin (anywhere before init:0),
		// we can override what the edit subscription endpoint is going to be.
		// After this is changed, do not forget to flush the permalinks.
		define( 'JGTB_EDIT_SUB_ENDPOINT', 'edit-subscription' );
	}

	include_functions();

	if ( is_admin() ) {
		include_admin_functions();
	} else {
		include_frontend_functions();
	}

	add_action( 'plugins_loaded', '\Javorszky\Toolbox\load_integrations', 999 );

	add_action( 'init', '\Javorszky\Toolbox\toolbox_load_plugin_textdomain' );

	new Emails();
}

/**
 * Load all integrations after plugins have been loaded.
 */
function load_integrations() {

	if ( class_exists( 'WCS_ATT' ) ) {
		include_once 'inc/integrations/AllProductsForSubscriptions.php';
	}
}

/**
 * Load Localisation files.
 *
 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
 */
function toolbox_load_plugin_textdomain() {
	\load_plugin_textdomain( 'jg-toolbox', false, plugin_basename( dirname( JGTB_FILE ) ) . '/languages' );
}

/**
 * Load admin specific functionality. That's the updater, and the settings tab.
 */
function include_admin_functions() {
	if ( file_exists( JGTB_PATH . '/vendor/autoload.php' ) ) {
		include_once 'vendor/autoload.php';
	}
	require_once 'inc/admin/ShopPluginsUpdater.php';
	require_once 'inc/admin/Settings.php';

	if ( false === get_option( JGTB_OPTION_PREFIX . 'skip_next_available', false ) ) {
		first_run();
	}
}

/**
 * Load files / functionality that are only required on the front end. That's most of it.
 */
function include_frontend_functions() {
	require_once 'inc/ValidationFunctions.php';
	require_once 'inc/ProcessingFunctions.php';
	require_once 'inc/UpdateModifiedDate.php';

	/**
	 * Features enable / disable by options
	 */
	if ( Utilities\is_skip_next_available() ) {
		require_once 'inc/SkipNextSchedule.php';
	}

	if ( Utilities\is_ship_keep_available() ) {
		require_once 'inc/ShipNowKeep.php';
	}

	if ( Utilities\is_ship_reschedule_available() ) {
		require_once 'inc/ShipNowReschedule.php';
	}

	if ( Utilities\is_change_next_payment_available() ) {
		require_once 'inc/RescheduleNextRenewal.php';
	}

	if ( Utilities\is_add_to_subscription_available() ) {
		require_once 'inc/AddProductToSubscription.php';
	}

	if ( Utilities\is_bulk_edit_available() ) {
		require_once 'inc/BulkChangeSubscriptions.php';
	}
}

function include_functions() {
	require_once 'inc/UtilityFunctions.php';
	require_once 'inc/RestrictGateways.php';
	require_once 'inc/Emails.php';
	require_once 'inc/integrations/class-tm-extra-product-options.php';

	if ( Utilities\is_edit_details_available() ) {
		require_once 'inc/EditSubscriptionTemplate.php';
		require_once 'inc/Query.php';
	}
}

/**
 * Wrapper function to check whether WooCommerce and Subscriptions are active.
 */
function check_prerequisites() {
	// Subs 3.0+ check.
	if ( ! class_exists( 'WC_Subscriptions' ) || version_compare( \WC_Subscriptions::$version, JGTB_REQ_WCS_VERSION ) < 0 ) {
		add_action( 'admin_notices', __NAMESPACE__ . '\\wcs_admin_notice' );
		return false;
	}

	// WC version check. version compare returns -1 if the first version is lower, 0 if they're equal, 1 if the second is higher
	if ( ! class_exists( 'WooCommerce' ) || version_compare( WC()->version, JGTB_REQ_WC_VERSION ) < 0 ) {
		add_action( 'admin_notices', __NAMESPACE__ . '\\wc_admin_notice' );
		return false;
	}

	return true;
}

/**
 * Display a warning message if Subs version check fails.
 *
 * @return void
 */
function wc_admin_notice() {
	// translators: placeholder is required WooCommerce version (eg 3.0.0)
	echo '<div class="error"><p>' . esc_html( sprintf( __( 'Toolbox for WooCommerce Subscriptions requires at least WooCommerce %s in order to function. Please activate or upgrade WooCommerce.', 'jg-toolbox' ), JGTB_REQ_WC_VERSION ) ) . '</p></div>';
}

/**
 * Display a warning message if WC version check fails.
 *
 * @return void
 */
function wcs_admin_notice() {
	// translators: placeholder is required Subscriptions version (eg 3.0.0)
	echo '<div class="error"><p>' . esc_html( sprintf( __( 'Toolbox for WooCommerce Subscriptions requires WooCommerce Subscriptions version %s. Please activate or update Subscriptions.', 'jg-toolbox' ), JGTB_REQ_WCS_VERSION ) ) . '</p></div>';
}

/**
 * Is only run on plugins_loaded when it's an admin request, and we haven't saved any options yet. It checks whether
 * the 'skip_next_available' option is present or not to determine whether it's been run.
 */
function first_run() {
	Settings\add_default_settings();
	add_action( 'after_setup_theme', __NAMESPACE__ . '\\trigger_flush_rewrite_rules' );
}

/**
 * Hooked into after_setup_theme, because its previous position within first_run was too early. WP_Rewrite isn't populated / loaded
 * at plugins_loaded.
 */
function trigger_flush_rewrite_rules() {
	flush_rewrite_rules();
}

$GLOBALS['toolbox_for_wcs_namespace'] = __NAMESPACE__;
