<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.cecredentialtrust.com
 * @since      1.0.0
 *
 * @package    CeValidationsr
 * @subpackage CeValidationsr/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
  <h1>Wordpress CeValidationsr Plugin Settings</h1>
  <?php
  // Let see if we have a caching notice to show
  $admin_notice = get_option('cevalidationsr_admin_notice');
  if($admin_notice) {
    // We have the notice from the DB, let's remove it.
    delete_option( 'cevalidationsr_admin_notice' );
    // Call the notice message
    $this->admin_notice($admin_notice);
  }
  if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] ){
    $this->admin_notice("Your settings have been updated!");
  }
  ?>
  <form method="POST" action="options.php">
  <?php
    settings_fields('cevalidationsr-options');
    do_settings_sections('cevalidationsr-options');
    submit_button();
  ?>
  </form>
</div>