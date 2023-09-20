<?php
namespace ShopPlugins\Updater;

use ShopPlugins\Updater\Clients\EDD;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Plugin {

	/**
	 * Plugin base name.
	 *
	 * Used to identify the plugin in several locations.
	 *
	 * @var string plugin base name based on the plugin_basename() function and plugin file.
	 */
	public $plugin_basename = '';

	/** @var string  */
	public $name = '';

	/** @var string  */
	public $client = '';

	/** @var string  */
	public $version = '';

	/** @var string Last message from remote site. */
	public $message = '';

	/** @var string  */
	public $message_type = '';

	/** @var string  */
	public $license_option_name = '';

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args List of arguments.
	 */
	public function __construct( $args ) {
		$this->name                = esc_html( $args['name'] );
		$this->client              = new EDD( $args['api_url'], $this, array() );
		$this->version             = preg_replace( '/[^\.0-9]/', '', $args['version'] );
		$this->plugin_basename     = plugin_basename( $args['file'] );
		$this->license_option_name = isset( $args['license_option_name'] ) ? $args['license_option_name'] : '';
	}

	/**
	 * Get plugin name.
	 *
	 * @since 1.0.0
	 *
	 * @return string Name of the plugin.
	 */
	public function get_name() {
		return $this->name;
	}

	/**
	 * Plugin slug.
	 *
	 * The plugin slug is mainly used at the 'view details' part of the plugins site.
	 * By normal w.org plugin this is based on the URL slug of the plugin.
	 *
	 * @since 1.0.0
	 *
	 * @return string The slug of the plugin.
	 */
	public function get_slug() {
		$plugin_data = $this->client->get_plugin_update_info();

		return $plugin_data->slug;
	}

	/**
	 * Set the license key in the database.
	 *
	 * @since 1.0.0
	 *
	 * @param  string $license License key to set.
	 * @return bool True on success, false otherwise.
	 */
	public function set_license_key( $license ) {
		$license = sanitize_text_field( $license );

		// Allow license keys to be saved in custom option fields
		if ( ! empty( $this->license_option_name ) ) {
			return update_option( $this->license_option_name, $license );
		}

		$dirname = dirname( $this->plugin_basename );
		return update_option( $dirname . '_license', $license );
	}

	/**
	 * Get the license key from the database.
	 *
	 * @since 1.0.0
	 *
	 * @return string License key if available, empty string otherwise.
	 */
	public function get_license_key() {
		// Allow license keys to be saved in custom option fields
		if ( ! empty( $this->license_option_name ) ) {
			return get_option( $this->license_option_name, '' );
		}

		$dirname = dirname( $this->plugin_basename );
		return get_option( $dirname . '_license', '' );
	}

	/**
	 * Get plugin version.
	 *
	 * Get the installed version of the plugin.
	 *
	 * @since 1.0.0
	 *
	 * @return string Plugin version number.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Get license status.
	 *
	 * Get the current status of the license from a DB saved value.
	 *
	 * @since 1.0.0
	 *
	 * @return string Current license status.
	 */
	public function get_license_status() {
		$dirname = dirname( $this->plugin_basename );
		$status  = get_option( $dirname . '_license_status', 'pending' );
		$status  = empty( $status ) ? 'pending' : $status;

		return $status;
	}

	/**
	 * Set license status.
	 *
	 * @since 1.0.0
	 *
	 * @param string $status The status to update to.
	 */
	public function set_license_status( $status ) {

		// Don't update if the status is the same
		if ( $this->get_license_status() === $status ) {
			return;
		}

		$dirname = dirname( $this->plugin_basename );
		$status  = sanitize_text_field( $status );

		update_option( $dirname . '_license_status', $status );

		do_action( 'wp_updater_update_license_status', $status, $this );

	}

	/**
	 * Check and update license status.
	 *
	 * Update the license status from the server.
	 *
	 * @since 1.0.0
	 */
	public function check_and_update_license_status() {

		$status = $this->client->get_status();
		switch ( $status ) {

			case 'pending';
			case 'valid':
			case 'expired':
				$this->set_license_status( $status );
				break;
			case 'site_inactive':
				if ( ! is_wp_error( $this->client->activate() ) ) {
					$this->set_license_status( 'valid' );
				} else {
					$this->set_license_status( $status );
				}
				break;
			default:
				$this->set_license_status( 'invalid' );
				break;

		}
	}

}
