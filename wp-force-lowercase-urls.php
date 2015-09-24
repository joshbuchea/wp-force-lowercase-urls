<?php
/**
 * Plugin Name:     WP Force Lowercase URLs
 * Plugin URI:      https://github.com/joshbuchea/wp-force-lowercase-urls/
 * Description:     Redirect uppercase URLs to lowercase.
 * Version:         1.0
 * Author:          Josh Buchea
 * Author URI:      http://joshbuchea.com/
 * Text Domain:     wp-force-lowercase-urls
 * Domain Path:     /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) die;

// If user is non-admin, force lowercase URLs
if ( !is_admin() ) {
  add_action( 'init', 'buchea_force_lowercase_url' );
}

if ( !function_exists('buchea_force_lowercase_url') ) :
/**
 * Changes the requested URL to lowercase.
 *
 * Only if user is non-admin and URL does not include a filename or query variable.
 *
 * @since 1.0
 */
function buchea_force_lowercase_url() {

  // Grab requested URL
  $url = $_SERVER['REQUEST_URI'];

  // If URL contains a period, halt (likely contains a filename and filenames are case specific)
  if ( preg_match('/[\.]/', $url) ) {
    return;
  }

  // If URL contains a question mark, halt (likely contains a query variable)
  if ( preg_match('/[\?]/', $url) ) {
    return;
  }

  if ( preg_match('/[A-Z]/', $url) ) {

    // Convert URL to lowercase
    $lc_url = strtolower($url);

    // 301 redirect to new lowercase URL
    header('Location: ' . $lc_url, TRUE, 301);
    exit();
  }
}
endif;
