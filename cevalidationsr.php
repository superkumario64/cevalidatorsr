<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.cecredentialtrust.com
 * @since             1.0.1
 * @package           CeValidationsr
 *
 * @wordpress-plugin
 * Plugin Name:       CeValidationsr
 * Plugin URI:        localhost:9210
 * Description:       CeCredential validation page with optional ScholarRecord via CeCredentialTrust.com Web API.
 * Version:           1.0.2
 * Author:            R. A. Joseph
 * Author URI:        https://www.cecredentialtrust.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cevalidationsr
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('CEVALIDATIONSR_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cevalidationsr-activator.php
 */
function activate_cevalidationsr()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-cevalidationsr-activator.php';
	CeValidationsr_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cevalidationsr-deactivator.php
 */
function deactivate_cevalidationsr()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-cevalidationsr-deactivator.php';
	CeValidationsr_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_cevalidationsr');
register_deactivation_hook(__FILE__, 'deactivate_cevalidationsr');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-cevalidationsr.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cevalidationsr()
{
	$plugin = new CeValidationsr();
	$plugin->run();
}

function prefix_is_requirements_metsr()
{
	$globalerrormessage = "";
	$min_wp  = '4.0';
	$min_php = '5.6';
	$exts    = array('json');

	// Check for WordPress version
	if (version_compare(get_bloginfo('version'), $min_wp, '<')) {
		return false;
	}

	// Check the PHP version
	if (version_compare(PHP_VERSION, $min_php, '<')) {
		return false;
	}

	// Check PHP loaded extensions
	foreach ($exts as $ext) {
		if (!extension_loaded($ext)) {
			return false;
		}
	}

	return true;
}

function prefix_disable_pluginsr()
{
	if (current_user_can('activate_plugins') && is_plugin_active(plugin_basename(__FILE__))) {
		deactivate_plugins(plugin_basename(__FILE__));

		// Hide the default "Plugin activated" notice
		if (isset($_GET['activate'])) {
			unset($_GET['activate']);
		}
	}
}

function prefix_show_noticesr()
{
	echo '<div class="error"><p><b>' .plugin_basename(__FILE__).'</b> cannot be activated due to incompatible environment.</p></div>';
}

// Check requirements ... do not enable plugin if they are not met and notify user.
if (!prefix_is_requirements_metsr()) {
	add_action('admin_init', 'prefix_disable_pluginsr');
	add_action('admin_notices', 'prefix_show_noticesr');
} else {
	run_cevalidationsr();
}
