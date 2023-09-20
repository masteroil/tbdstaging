<?php
namespace ShopPlugins\Updater;

/**
 * Include the Shop Plugins updater on init.
 */
function updater() {

	if ( ! class_exists( '\ShopPlugins\Updater\WP_Updater' ) ) {
		if ( file_exists( JGTB_PATH . '/vendor/shopplugins/wp-updater/class-wp-updater.php' ) ) {
			require JGTB_PATH . '/vendor/shopplugins/wp-updater/class-wp-updater.php';
		}
	}

	if ( ! class_exists( '\ShopPlugins\Updater\WP_Updater' ) ) {
		return;
	}

	new \ShopPlugins\Updater\WP_Updater(
		array(
			'file'    => JGTB_FILE,
			'name'    => 'Toolbox for WooCommerce Subscriptions',
			'version' => JGTB_VERSION,
			'api_url' => 'https://shopplugins.com',
		)
	);

}

add_action( 'admin_init', '\ShopPlugins\Updater\updater' );
