# Updater for EDD Software Licensing

[![Build Status](https://travis-ci.com/shopplugins/wp-updater.svg?token=iyRwCHjNrkkKZi8c9U7z&branch=master)](https://travis-ci.com/shopplugins/wp-updater)

This package is used with plugins sold on [Shop Plugins](https://shopplugins.com) to allow auto updating. 

The package adds the following functionality to the WordPress > Plugins dashboard:

- Add license
- Activate license
- Deactivate license
- Notice of available update
- Update version

## Use in plugins

Include this package in the plugin using composer. Add this line to the `composer.json` file:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/shopplugins/wp-updater"
    }
  ],
}
```

Add the following action to the plugin's admin init:

```php
	add_action( 'admin_init', array( $this, 'auto_updater' ) );
```

and this method:

```php
	/**
	 * Updater.
	 *
	 * Function to get automatic updates.
	 *
	 * @since 1.0.0
	 */
	public function auto_updater() {
		// Updater.
		if ( ! class_exists( '\ShopPlugins\Updater\WP_Updater' ) ) {
			require SP_WFM_PATH . '/vendor/shopplugins/wp-updater/class-wp-updater.php';
		}
		new \ShopPlugins\Updater\WP_Updater( array(
			'file'    => SP_WFM_FILE, // the main plugin file's path eg: __FILE__
			'name'    => 'WooCommerce Fee Manager', // the plugin's name
			'version' => $this->version,
			'api_url' => 'https://shopplugins.com',
		) );
	}
```


## Plugin Data

License data is stored in the `wp_options` table. 
TODO: add the options that are stored for the plugin (plugin-name_status, plugin-name_license_key, etc) and examples.
