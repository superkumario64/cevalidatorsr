<?php

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.cecredentialtrust.com
 * @since      1.0.0
 * @package    CeValidationsr
 * @subpackage CeValidationsr/includes
 * @author     R. A. Joseph <rjoseph@paradigm-corp.com>
 */

class CeValidationsr_i18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'cevalidationsr',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}
}
