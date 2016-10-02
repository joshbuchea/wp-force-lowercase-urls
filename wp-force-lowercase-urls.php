<?php
/**
 * Plugin Name:     WP Force Lowercase URLs
 * Plugin URI:      https://github.com/joshbuchea/wp-force-lowercase-urls/
 * Description:     Redirect uppercase URLs to lowercase.
 * Version:         2.0
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
      $url = $_SERVER['REQUEST_URI'];
      $params = $_SERVER['QUERY_STRING'];

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
