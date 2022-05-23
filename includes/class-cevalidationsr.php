<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @link       https://www.cecredentialtrust.com
 * @since      1.0.0
 * @package    CeValidationsr
 * @subpackage CeValidationsr/includes
 * @author     R. A. Joseph <rjoseph@paradigm-corp.com>
 */
class CeValidationsr
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      CeValidationsr_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	// /**
	//  * The unique identifier of this plugin.
	//  *
	//  * @since    1.0.0
	//  * @access   protected
	//  * @var      string    $plugin_base_name    The string path for this plugin.
	//  */
	// protected $plugin_base_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * The global error message.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The global error message.
	 */
	protected $globalerrormessage;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		//add_action('admin_init', array($this, 'check_version'));

		if (defined('CEVALIDATIONSR_VERSION')) {
			$this->version = CEVALIDATIONSR_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'cevalidationsr';

		$this->globalerrormessage = '';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - CeValidationsr_Loader. Orchestrates the hooks of the plugin.
	 * - CeValidationsr_i18n. Defines internationalization functionality.
	 * - CeValidationsr_Admin. Defines all hooks for the admin area.
	 * - CeValidationsr_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-cevalidationsr-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-cevalidationsr-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-cevalidationsr-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-cevalidationsr-public.php';

		$this->loader = new CeValidationsr_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the CeValidationsr_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new CeValidationsr_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{

		$plugin_admin = new CeValidationsr_Admin($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 * https://wordpress.stackexchange.com/questions/263160/how-do-you-use-the-plugin-boilerplate-loader-class-to-hook-actions-and-filters
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{

		$plugin_public = new CeValidationsr_Public($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles', 40); //set priority to 40 so it loads last
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts', 40);

		//Shortcodes
		$this->loader->add_action('init', $plugin_public, 'register_shortcodes', 40);

		//Ajax
		$this->loader->add_action('wp_ajax_public_validate_function', $plugin_public, 'public_validatesr_function', 40);
		$this->loader->add_action('wp_ajax_nopriv_public_validate_function', $plugin_public, 'public_validatesr_function', 40);
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * The basename of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_base_name()
	{
		return $this->plugin_name . '/' . $this->plugin_name . '.php'; //cevalidationsr/cevalidationsr.php
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    CeValidationsr_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}

	/**
	 * Initialize global error message.
	 *
	 * @since     1.0.0
	 * @return    string    Initialize global error message.
	 */
	public function globalerrormessage_init()
	{
		$this->globalerrormessage = "";
	}

	/**
	 * Append global error message.
	 *
	 * @since     1.0.0
	 * @return    string    Append global error message.
	 */
	public function globalerrormessage_append($arg)
	{
		return $this->globalerrormessage . $arg;
	}

	// The primary sanity check, automatically disable the plugin on activation if it doesn't
	// meet minimum requirements.
	static function activation_check()
	{
		globalerrormessage_init();

		if (!self::compatible_version()) {
			deactivate_plugins(get_plugin_base_name()); //plugin_basename(__FILE__)
			wp_die(__('This Plugin requires WordPress 3.7 or higher!', 'cevalidationsr'));
		}
	}

	// The backup sanity check, in case the plugin is activated in a weird way,
	// or the versions change after activation.
	public function check_version()
	{
		globalerrormessage_init();

		if (!self::compatible_version()) {
			if (is_plugin_active(get_plugin_base_name())) { //plugin_basename(__FILE__)
				deactivate_plugins(get_plugin_base_name()); //plugin_basename(__FILE__)
				add_action('admin_notices', array($this, 'disabled_noticesr'));
				if (isset($_GET['activate'])) {
					unset($_GET['activate']);
				}
			}
		}
	}

	public static function compatible_version()
	{
		if (version_compare(phpversion(), '5.2.0', '<')) {
			globalerrormessage_append('PHP ' . '<b>5.2.0</b> or higher required. Detected <b>' . phpversion() . '</b>');
			return false;
		}

		if (version_compare($GLOBALS['wp_version'], '3.7', '<')) {
			globalerrormessage_append('WordPress <b>3.7</b> or higher required. Detected <b>' . $GLOBALS['wp_version'] . '</b>');
			return false;
		}

		// Add sanity checks for other version requirements here

		return true;
	}
}

function disabled_noticesr()
{
	echo esc_html__($this->globalerrormessage);
}
