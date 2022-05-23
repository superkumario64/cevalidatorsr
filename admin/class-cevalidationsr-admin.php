<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.cecredentialtrust.com
 * @since      1.0.0
 *
 * @package    CeValidationsr
 * @subpackage CeValidationsr/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    CeValidationsr
 * @subpackage CeValidationsr/admin
 * @author     R. A. Joseph <rjoseph@paradigm-corp.com>
 */
class CeValidationsr_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->load_dependencies();
	}

	/**
	 * Load the required dependencies for the Admin facing functionality.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - CeValidationsr_Admin. Registers the admin settings and page.
	 *
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

		// Add an action to setup the admin menu under "Settings"
		add_action('admin_menu', array($this, 'add_admin_menu'));
		// Add some actions to setup the settings we want on the wp admin page
		add_action('admin_init', array($this, 'setup_sections'));
		add_action('admin_init', array($this, 'setup_fields'));
	}

	/**
	 * Add the menu items to the admin menu
	 *
	 * @since    1.0.0
	 */
	public function add_admin_menu()
	{
		add_options_page(
			'CeValidationsr Plugin',
			'CeValidationsr Plugin',
			'manage_options',
			$this->plugin_name,
			array($this, 'display_cevalidationsr_admin_page')
		);

		// Main Menu Item
		// add_menu_page(
		// 	'CeValidationsr Plugin',        // The value used to populate the browser's title bar when the menu page
		// 	'CeValidationsr Plugin',        // The text of the menu in the administrator's sidebar
		// 	'manage_options',             // What roles are able to access the menu (administrator)
		// 	'custom-plugin',              // The ID used to bind submenu items to this menu
		// 	array($this, 'display_cevalidationsr_admin_page'),   // The function to call for this menu
		// 	'dashicons-store', //the path to the icon that you want to display next to your menu item
		// 	4 //where the menu should be added in relation to the other menus in the WordPress Dashboard
		// );
		// // Sub Menu Item One
		// add_submenu_page(
		// 	'custom-plugin',
		// 	'Settings',
		// 	'Settings',
		// 	'manage_options',
		// 	'custom-plugin',
		// 	array($this, 'display_cevalidationsr_admin_page')
		// );
	}
	/**
	 * Callback function for displaying the admin settings page.
	 *
	 * @since    1.0.0
	 */
	public function display_cevalidationsr_admin_page()
	{
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/cevalidationsr-admin-display.php';
	}
	/**
	 * Callback function for displaying the second sub menu item page.
	 *
	 * @since    1.0.0
	 */

	/**
	 * Setup sections in the settings
	 *
	 * @since    1.0.0
	 */
	public function setup_sections()
	{
		add_settings_section('section_one', 'CeValidation SR settings', array($this, 'section_callback'), 'cevalidationsr-options');
		// add_settings_section( 'section_two', 'Section Two', array($this, 'section_callback'), 'cevalidationsr-options' );
	}
	/**
	 * Callback for each section
	 *
	 * @since    1.0.0
	 */
	public function section_callback($arguments)
	{
		switch ($arguments['id']) {
			case 'section_one':
				echo '<p>This following settings are required for CeValidation SR. They are supplied by Paradigm, Inc.</p>';
				break;
				// case 'section_two':
				// 	echo '<p>Section two! More information on this section can go here.</p>';
				// 	break;
		}
	}
	/**
	 * Field Configuration, each item in this array is one field/setting we want to capture
	 *
	 * @since    1.0.0
	 */
	public function setup_fields()
	{
		$fields = array(
			array(
				'uid' => 'cevalidationsr_url',
				'label' => 'CeValidation SR API Base URL',
				'section' => 'section_one',
				'type' => 'text',
				'class' => 'textboxwidth40',
				'placeholder' => '',
				'helper' => '',
				'supplemental' => 'https://test.secure.cecredentialtrust.com:8086/api/webapi/v3/cecredentialvalidate',
				'default' => "",
			),
			array(
				'uid' => 'cevalidationsr_clientid',
				'label' => 'Client Id',
				'section' => 'section_one',
				'type' => 'text',
				'class' => 'textboxwidth25',
				'placeholder' => '',
				'helper' => '',
				'supplemental' => '80DBC6A0-6CCF-4BA3-AAD8-89B2AE22FFA9',
				'default' => "",
			),
			array(
				'uid' => 'cevalidationsr_apostilleemail',
				'label' => 'Apostille Email',
				'section' => 'section_one',
				'type' => 'text',
				'class' => 'textboxwidth20',
				'placeholder' => '',
				'helper' => '',
				'supplemental' => 'graduation@sampleuniversity.edu',
				'default' => "",
			),
			array(
				'uid' => 'cevalidationsr_helpdeskemail',
				'label' => 'Helpdesk Email',
				'section' => 'section_one',
				'type' => 'text',
				'class' => 'textboxwidth20',
				'placeholder' => '',
				'helper' => '',
				'supplemental' => 'helpdesk@sampleuniversity.edu',
				'default' => "",
			),
			array(
				'uid' => 'cevalidationsr_displaychealogo',
				'label' => 'Display CHEA Logo',
				'section' => 'section_one',
				'type' => 'checkbox',
				'options' => array(
					'yes' => 'Yes',
				),
				'class' => '',
				'placeholder' => '',
				'helper' => '',
				'supplemental' => 'Check if you are a member of CHEA',
				'default' => array(),
			),
		);

		// Let's go through each field in the array and set it up
		foreach ($fields as $field) {
			add_settings_field($field['uid'], $field['label'], array($this, 'field_callback'), 'cevalidationsr-options', $field['section'], $field);
			register_setting('cevalidationsr-options', $field['uid']);
		}
	}
	/**
	 * This handles all types of fields for the settings
	 *
	 * @since    1.0.0
	 */
	public function field_callback($arguments)
	{
		// Set our $value to that of whats in the DB
		$value = get_option($arguments['uid']);
		// Only set it to default if we get no value from the DB and a default for the field has been set
		if (!$value) {
			$value = $arguments['default'];
		}

		// Let's do some setup based on the type of element we are trying to display.
		switch ($arguments['type']) {
			case 'text':
			case 'password':
			case 'number':
				printf('<input name="%1$s" id="%1$s" type="%2$s" class="%3$s" placeholder="%4$s" value="%5$s" />', $arguments['uid'], $arguments['type'], $arguments['class'], $arguments['placeholder'], $value);
				break;
			case 'textarea':
				printf('<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>', $arguments['uid'], $arguments['placeholder'], $value);
				break;
			case 'select':
			case 'multiselect':
				if (!empty($arguments['options']) && is_array($arguments['options'])) {
					$attributes = '';
					$options_markup = '';
					foreach ($arguments['options'] as $key => $label) {
						$options_markup .= sprintf('<option value="%s" %s>%s</option>', $key, selected($value[array_search($key, $value, true)], $key, false), $label);
					}
					if ($arguments['type'] === 'multiselect') {
						$attributes = ' multiple="multiple" ';
					}
					printf('<select name="%1$s[]" id="%1$s" %2$s>%3$s</select>', $arguments['uid'], $attributes, $options_markup);
				}
				break;
			case 'radio':
			case 'checkbox':
				if (!empty($arguments['options']) && is_array($arguments['options'])) {
					$options_markup = '';
					$iterator = 0;
					foreach ($arguments['options'] as $key => $label) {
						$iterator++;
						$is_checked = '';
						// This case handles if there is only one checkbox and we don't have anything saved yet.
						if (isset($value[array_search($key, $value, true)])) {
							$is_checked = checked($value[array_search($key, $value, true)], $key, false);
						} else {
							$is_checked = "";
						}
						// Let's build out the checkbox
						$options_markup .= sprintf('<label for="%1$s_%6$s"><input id="%1$s_%6$s" name="%1$s[]" type="%2$s" value="%3$s" %4$s /> %5$s</label><br/>', $arguments['uid'], $arguments['type'], $key, $is_checked, $label, $iterator);
					}
					printf('<fieldset>%s</fieldset>', $options_markup);
				}
				break;
			case 'image':
				// Some code borrowed from: https://mycyberuniverse.com/integration-wordpress-media-uploader-plugin-options-page.html
				$options_markup = '';
				$image = [];
				$image['id'] = '';
				$image['src'] = '';
				// Setting the width and height of the header image here
				$width = '1800';
				$height = '1068';
				// Let's get the image src
				$image_attributes = wp_get_attachment_image_src($value, array($width, $height));
				// Let's check if we have a valid image
				if (!empty($image_attributes)) {
					// We have a valid option saved
					$image['id'] = $value;
					$image['src'] = $image_attributes[0];
				} else {
					// Default
					$image['id'] = '';
					$image['src'] = $value;
				}
				// Let's build our html for the image upload option
				$options_markup .= '
				<img data-src="' . $image['src'] . '" src="' . $image['src'] . '" width="180px" height="107px" />
				<div>
					<input type="hidden" name="' . $arguments['uid'] . '" id="' . $arguments['uid'] . '" value="' . $image['id'] . '" />
					<button type="submit" class="upload_image_button button">Upload</button>
					<button type="submit" class="remove_image_button button">&times; Delete</button>
				</div>';
				printf('<div class="upload">%s</div>', $options_markup);
				break;
		}
		// If there is helper text, let's show it.
		if (array_key_exists('helper', $arguments) && $helper = $arguments['helper']) {
			printf('<span class="helper"> %s</span>', $helper);
		}
		// If there is supplemental text let's show it.
		if (array_key_exists('supplemental', $arguments) && $supplemental = $arguments['supplemental']) {
			printf('<p class="description">%s</p>', $supplemental);
		}
	}
	/**
	 * Admin Notice
	 *
	 * This displays the notice in the admin page for the user
	 *
	 * @since    1.0.0
	 */
	public function admin_notice($message)
	{ ?>
	<div class="notice notice-success is-dismissible">
		<p><?php echo ($message); ?></p>
	</div><?php
		}
		/**
		 * This handles setting up the rewrite rules for Past Items
		 *
		 * @since    1.0.0
		 */
		// public function setup_rewrites()
		// {
		// 	//
		// 	$url_slug = 'custom-plugin';
		// 	// Let's setup our rewrite rules
		// 	add_rewrite_rule($url_slug . '/?$', 'index.php?cevalidationsr=index', 'top');
		// 	add_rewrite_rule($url_slug . '/page/([0-9]{1,})/?$', 'index.php?cevalidationsr=items&cevalidationsr_paged=$matches[1]', 'top');
		// 	add_rewrite_rule($url_slug . '/([a-zA-Z0-9\-]{1,})/?$', 'index.php?cevalidationsr=detail&cevalidationsr_vehicle=$matches[1]', 'top');
		// 	// Let's flush rewrite rules on activation
		// 	flush_rewrite_rules();
		// }

		/**
		 * Register the stylesheets for the admin area.
		 *
		 * @since    1.0.0
		 */
		public function enqueue_styles()
		{

			/**
			 * This function is provided for demonstration purposes only.
			 *
			 * An instance of this class should be passed to the run() function
			 * defined in CeValidationsr_Loader as all of the hooks are defined
			 * in that particular class.
			 *
			 * The CeValidationsr_Loader will then create the relationship
			 * between the defined hooks and the functions defined in this
			 * class.
			 */

			wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/cevalidationsr-admin.css', array(), $this->version, 'all');
		}

		/**
		 * Register the JavaScript for the admin area.
		 *
		 * @since    1.0.0
		 */
		public function enqueue_scripts()
		{

			/**
			 * This function is provided for demonstration purposes only.
			 *
			 * An instance of this class should be passed to the run() function
			 * defined in CeValidationsr_Loader as all of the hooks are defined
			 * in that particular class.
			 *
			 * The CeValidationsr_Loader will then create the relationship
			 * between the defined hooks and the functions defined in this
			 * class.
			 */

			wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/cevalidationsr-admin.js', array('jquery'), $this->version, false);
		}
	}
