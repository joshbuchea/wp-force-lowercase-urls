<?php
/**
 * Plugin Name:     WP Force Lowercase URLs
 * Plugin URI:      https://github.com/joshbuchea/wp-force-lowercase-urls/
 * Description:     Redirect uppercase URLs to lowercase.
 * Version:         2.1.1
 * Author:          Josh Buchea
 * Author URI:      http://joshbuchea.com/
 * Text Domain:     wp-force-lowercase-urls
 * Domain Path:     /languages
 */

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

if ( !class_exists('WPForceLowercaseURLs') ) {

  class WPForceLowercaseURLs {

    /**
     * Initialize plugin
     */
    public static function init() {

      // If page is non-admin, force lowercase URLs
      if ( !is_admin() ) {
        add_action( 'init', array('WPForceLowercaseURLs', 'toLower') );
      }

    }

    /**
     * Changes the requested URL to lowercase and redirects if modified
     */
    public static function toLower() {

      // Grab requested URL
      $url = (isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '');
      $params = (isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '');

      // Not a normal request (e.g. WP-CLI, cron) or not an origin-form path
      if ( $url === '' || $url[0] !== '/' ) {
        return;
      }

      // REST API routes are case sensitive, leave them alone
      $rest_prefix = function_exists('rest_get_url_prefix') ? rest_get_url_prefix() : 'wp-json';
      if ( stripos($url, '/'.$rest_prefix.'/') !== false || isset($_GET['rest_route']) ) {
        return;
      }

      // If URL contains a period, halt (likely contains a filename and filenames are case specific)
      if ( preg_match('/[\.]/', $url) ) {
        return;
      }

      // If URL contains a capital letter
      if ( preg_match('/[A-Z]/', $url) ) {

        // Convert URL to lowercase
        $lc_url = empty($params)
          ? strtolower($url)
          : strtolower(substr($url, 0, strrpos($url, '?'))).'?'.$params;

        // Collapse leading slashes/backslashes so the redirect can't leave this site (open redirect)
        $lc_url = '/'.ltrim($lc_url, '/\\');

        // if url was modified, re-direct
        if ($lc_url !== $url) {

          // 301 redirect to new lowercase URL
          header('Location: '.$lc_url, TRUE, 301);
          exit();

        }

      }

    }

  }
  WPForceLowercaseURLs::init();

}
