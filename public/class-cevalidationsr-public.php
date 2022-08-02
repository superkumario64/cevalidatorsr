<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.cecredentialtrust.com
 * @since      1.0.0
 *
 * @package    CeValidationsr
 * @subpackage CeValidationsr/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    CeValidationsr
 * @subpackage CeValidationsr/public
 * @author     R. A. Joseph <rjoseph@paradigm-corp.com>
 */
class CeValidationsr_Public
{

  /**
   * The plugin options.
   *
   * @since 		1.0.0
   * @access 		private
   * @var 		string 			$options    The plugin options.
   */
  private $options;

  protected $config  = NULL;

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
   * @param      string    $plugin_name       The name of the plugin.
   * @param      string    $version    The version of this plugin.
   */
  public function __construct($plugin_name, $version)
  {

    $this->plugin_name = $plugin_name;
    $this->version = $version;

    $this->load_dependencies();
  }

  /**
   * Load the required dependencies for the Public facing functionality.
   *
   * Include the following files that make up the plugin:
   *
   * - CeValidationsr_Public_Settings. Registers the public settings and page.
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

    // Add an action to setup the public menu in the left nav
    add_action('init', array($this, 'add_public_menu'));

    //Call the Ajax function query
    //add_action('admin_menu', array($this, 'exec_public_validatesr'));
  }

  /**
   * Add the menu items to the public menu
   *
   * @since    1.0.0
   */
  public function add_public_menu()
  {
    // Check if the menu exists
    $menu_name = 'CeCredential Menu';
    $menu_exists = wp_get_nav_menu_object($menu_name);

    // If it doesn't exist, let's create it.
    if (!$menu_exists) {
      $menu_id = wp_create_nav_menu($menu_name);
    } else {
      $menu_id = $menu_exists->term_id;
    }
  }

  /**
   * Callback function for displaying the public settings page.
   *
   * @since    1.0.0
   */
  public function display_cevalidationsr_public_page()
  {
    require_once plugin_dir_path(dirname(__FILE__)) . 'public/partials/cevalidationsr-public-display.php';
  }

  /**
   * Register the stylesheets for the public-facing side of the site.
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
    // wp_enqueue_style('validationpubliccss', plugin_dir_url(__FILE__) . 'css/cevalidationsr-public.css', array(), $this->version, 'all');
    wp_enqueue_style('validationpubliccss', plugin_dir_url(__FILE__) . 'css/cevalidationsr-public.css', false);
  }

  /**
   * Register the JavaScript for the public-facing side of the site.
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

    // Ajax using ajax_url endpoint -- https://wordpress.stackexchange.com/questions/223331/using-ajax-in-frontend-with-wordpress-plugin-boilerplate-wppb-io
    // Note:  admin_url & admin-ajax.php are always used since they don't exist in "public"
    wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/cevalidationsr-public.js', array('jquery'), $this->version, false, false);
    wp_localize_script($this->plugin_name, 'cevalidationsr', array('ajax_url' => admin_url('admin-ajax.php', ((is_ssl()) ? 'https' : 'http'))));
    // wp_enqueue_script('jquery321', get_template_directory_uri() . '/js/jquery-3.2.1.min.js', array(), '3.2.1', true);
    wp_enqueue_script('maskedinput', plugin_dir_url(__FILE__) . 'js/jquery.maskedinput.min.js', array('jquery'), $this->version, false, false);
  }

  /**
   * Processes shortcode cevsrform
   *
   * @param   array	$atts		The attributes from the shortcode
   *
   * @uses	get_option
   * @uses	get_layout
   *
   * @return	mixed	$output		Output of the buffer
   */
  public function cevalidationsr_form()
  {
    $apostilleemail = $this->getConfig('cevalidationsr_apostilleemail');
    ob_start();
    include $this->cevalidationsr_get_template('cevalidationsr-form');
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
  }

  /**
   * Registers all shortcodes at once
   *
   * @return [type] [description]
   */
  public function register_shortcodes()
  {
    add_shortcode('cevsrform', array($this, 'cevalidationsr_form'));
    // add_shortcode( 'cevsrform2', array( $this, 'cevalidationsr_form2' ) ); //Additional shortcodes?
  }

  /**
   * Returns the result of the get_template global function
   */
  public function cevalidationsr_get_template($name)
  {
    return self::get_template($name);
  }

  /**
   * Returns the path to a template file
   *
   * Looks for the file in these directories, in this order:
   * 		Current theme
   * 		Parent theme
   * 		Current theme templates folder
   * 		Parent theme templates folder
   * 		This plugin
   *
   * To use a custom list template in a theme, copy the
   * file from public/templates into a templates folder in your
   * theme. Customize as needed, but keep the file name as-is. The
   * plugin will automatically use your custom template file instead
   * of the ones included in the plugin.
   *
   * @param 	string 		$name 			The name of a template file
   * @return 	string 						The path to the template
   */
  public static function get_template($name)
  {
    $template = '';
    $locations[] = "{$name}.php";
    $locations[] = "/templates/{$name}.php";
    /**
     * Filter the locations to search for a template file
     *
     * @param 	array 		$locations 			File names and/or paths to check
     */
    apply_filters('cevalidationsr-template-paths', $locations);
    $template = locate_template($locations, TRUE);
    if (empty($template)) {
      $template = plugin_dir_path(dirname(__FILE__)) . 'public/templates/' . $name . '.php';
    }
    return $template;
  } // get_template()

  /**
   * Get configuration or state setting for this integration module.
   *
   * @param string $name this module's config or state.
   *
   * @return string
   */
  protected function getConfig($name)
  {
    return get_option($name, '');
  }

  /**
   * Get Neutral Reponse, including the embedded Helpdesk Email.
   *
   * @param string $helpdeskemail this module's Helpdesk Email.
   *
   * @return string
   */
  protected function neutralReponse($helpdeskemail)
  {
    return "<div class='well'><ul>" .
      "<li>We cannot validate the Credential at this time.</li>" .
      "<li>The information provided does not match the information on record, or there was a connection error.</li>" .
      "<li>Please contact <a href='mailto:" . $helpdeskemail . "?subject=CeDiploma Information Request' data-rel='external' target='_blank'>" . $helpdeskemail . "</a> for assistance. When you do, please provide the student name and CeDiD.</li>" .
      "</ul></div>";
  }

  /**
   * Query the CeValidationsr API for data
   *
   * @return object
   */
  public function public_validatesr_function()
  {
    // Get Helpdesk Email
    $helpdeskemail = $this->getConfig('cevalidation_helpdeskemail');
    $helpdeskemail = isset($helpdeskemail) ? $helpdeskemail : "";

    // Set default and init parameters
    $output['result_table'] = "";
    $output['successfail_result'] = $this->neutralReponse($helpdeskemail);
    $output['scholarrecord_result'] = "";

    try {
      $result = $this->callGetEndpoint();
      if (wp_remote_retrieve_response_code($result) === 200) {
        $item = json_decode(wp_remote_retrieve_body($result), true);
        if ($item[0]['ValidStatus'] === "VALID") {
          $utcDateTime = gmdate("Y-m-d H:i:s");
          $schoolName = $item[0]['SchoolName'] == '' ? '' :'<tr><td>' . '<b>School:</b>' . '</td><td>' . $item[0]['SchoolName'] . '</td></tr>';
          $degree = $item[0]['Degree1'] == '' ? '' : $item[0]['Degree1'] . '<br />';
          $degree .= $item[0]['Degree2'] == '' ? '' : $item[0]['Degree2'] . '<br />';
          $degree .= $item[0]['Degree3'] == '' ? '' : $item[0]['Degree3'] . '<br />';
          $degree .= $item[0]['Degree4'] == '' ? '' : $item[0]['Degree4'] . '<br />';
          $degree .= $item[0]['Degree5'] == '' ? '' : $item[0]['Degree5'] . '<br />';
          $major = $item[0]['Major1'] == "" ? "" : $item[0]['Major1'] . "<br />";
          $major .= $item[0]['Major2'] == "" ? "" : $item[0]['Major2'] . "<br />";
          $major .= $item[0]['Major3'] == "" ? "" : $item[0]['Major3'] . "<br />";
          $major .= $item[0]['Major4'] == "" ? "" : $item[0]['Major4'] . "<br />";
          $major .= $item[0]['Major5'] == "" ? "" : $item[0]['Major5'] . "<br />";
          $major .= $item[0]['Major6'] == "" ? "" : $item[0]['Major6'] . "<br />";
          $major .= $item[0]['Major7'] == "" ? "" : $item[0]['Major7'] . "<br />";
          $major .= $item[0]['Major8'] == "" ? "" : $item[0]['Major8'] . "<br />";
          $major .= $item[0]['Major9'] == "" ? "" : $item[0]['Major9'] . "<br />";
          $honor = $item[0]['Honor1'] == "" ? "" : $item[0]['Honor1'] . "<br />";
          $honor .= $item[0]['Honor2'] == "" ? "" : $item[0]['Honor2'] . "<br />";
          $honor .= $item[0]['Honor3'] == "" ? "" : $item[0]['Honor3'] . "<br />";
          $honor .= $item[0]['Honor4'] == "" ? "" : $item[0]['Honor4'] . "<br />";
          $honor .= $item[0]['Honor5'] == "" ? "" : $item[0]['Honor5'] . "<br />";
          $honor .= $item[0]['Honor6'] == "" ? "" : $item[0]['Honor6'] . "<br />";
          $honor .= $item[0]['Honor7'] == "" ? "" : $item[0]['Honor7'] . "<br />";
          $honor .= $item[0]['Honor8'] == "" ? "" : $item[0]['Honor8'] . "<br />";
          $honor .= $item[0]['Honor9'] == "" ? "" : $item[0]['Honor9'] . "<br />";
          $credential = $this->replaceLast('<br />', '', $degree . $major . $honor);
          $tbody = "<tbody>" .
            "<tr><td style='width:25%'>" . "<b>CeDiD:</b>" . "</td><td style='width:75%'>" . $item[0]['CeDiplomaID'] . "</td></tr>" .
            $schoolName .
            "<tr><td>" . "<b>Name:</b>" . "</td><td>" . $item[0]['Name'] . "</td></tr>" .
            "<tr><td>" . "<b>Date:</b>" . "</td><td>" . $item[0]['ConferralDate'] . "</td></tr>" .
            "<tr><td>" . "<b>Credential:</b>" . "</td><td>" . $credential . "</td></tr>" .
            "</tbody>";
          $tbodyHtml = preg_replace('/\s+/', ' ', $tbody);
          $output['result_table'] = $tbodyHtml;
          $output['successfail_result'] = "<br /><b>This is a Valid Credential</b><br />Validated: " . $utcDateTime;

          $hostedvalidationurl=$item[0]['HostedValidationUrl'];
          if ($hostedvalidationurl != "") {
            $output['scholarrecord_result'] = "<a class='btn btn-success btn-lg' href='" .
            $hostedvalidationurl .
                "' target='_blank'><b>Scholar</b>Record</a>" .
                "<p>" .
                "By selecting ScholarRecord&#8482;, you will be taken to CeCredential Trust, a trusted partner of the University, to provide you with more detail of the learner's credential." .
                "</p>";
          } else {
              $output['scholarrecord_result'] = "";
          }
        }
      }
      //don't return data, just echo it and die(); (Wordpress is WIERD like that)
      $final = json_encode($output, JSON_UNESCAPED_SLASHES); //JSON_UNESCAPED_SLASHES Available since PHP 5.4
      echo $final;
      die();
    } catch (\Exception $e) {
      // return Neutral response as a default
      echo $output;
      die();
    }
  }

  protected function replaceLast($search, $replace, $source){
    $pos = strrpos($source, $search);
    if($pos !== false){
        $source = substr_replace($source, $replace, $pos, strlen($search));
    }
    return $source;
  }

  /**
   * Call the CeValidationsr API endpoint using wp_remote_get.
   *
   * @return (array) (required) HTTP response.
   */
  public function callGetEndpoint()
  {
    $endpoint = $this->getConfig('cevalidationsr_url');
    $url      = $this->requestUrl($endpoint);
    $response = wp_remote_get(
      esc_url_raw($url)
      , array(
        'timeout' => 30,
        'sslverify' => ((is_ssl()) ? TRUE : FALSE),
        'httpversion' => '1.1',
        'headers'     => array(
          'Accept' => 'application/json',
          'Content-type' => 'application/json'
        )
      )
    );

    return $response;
  }


  /**
   * Build a Url object of the URL data to query the CeValidationsr API.
   *
   * @param string $endpoint to the API data
   *
   * @return \Drupal\Core\Url
   */
  protected function requestUrl($endpoint)
  {
    $request_uri = $this->requestUri();
    return $endpoint . $request_uri;
  }

  /**
   * Build the URI part of the URL based on the endpoint and configuration.
   *
   * @param string $endpoint to the API data
   *
   * @return string
   */
  protected function requestUri()
  {
    $clientid = $this->getConfig('cevalidationsr_clientid');
    $cedid = "";
    if (isset($_GET['ceDiD'])) {
      $cedid = $_GET['ceDiD'];
    }
    return '/' . $clientid . '/' . $cedid;
  }
}
