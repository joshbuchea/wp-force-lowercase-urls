=== WP Force Lowercase URLs ===
Contributors: joshbuchea
Donate link: https://paypal.me/joshbuchea
Tags: 301, redirect, lowercase, url
Requires at least: 3.4
Tested up to: 7.1
Stable tag: 2.1.1
License: MIT
License URI: http://opensource.org/licenses/MIT

Perform a 301 redirect from an uppercase URL to the lowercase version for all non-admin URLs

== Description ==

Perform a 301 redirect from an uppercase URL to the lowercase version for all non-admin URLs (that do not include a filename).

Please help by reporting any bugs or feature requests at the link below.

Bugs:

* Report at: [Github Issue Tracker](https://github.com/joshbuchea/wp-force-lowercase-urls/issues)

Questions/Comments:

* http://joshbuchea.com/

== Installation ==

= Installation =
1. In your WordPress Dashboard go to "Plugins" -> "Add Plugin".
2. Search for "WP Force Lowercase URLs".
3. Install the plugin by pressing the "Install" button.
4. Activate the plugin by pressing the "Activate" button.

== Changelog ==

= 2.1.1 =
* Security: prevent redirects to other hosts from crafted URLs (open redirect hardening)
* Fix: no longer redirects WordPress REST API URLs (/wp-json/), which broke case-sensitive routes
* Fix: undefined index notice for REQUEST_URI when run without a web request (WP-CLI, cron)
* Tested up to WordPress 7.1

= 2.1.0 =
* Fix: undefined index notice for QUERY_STRING (props jamesryanbell)

= 2.0.1 =
* Version bump

= 2.0 =
* Ground up rewrite
* URLs with params are now converted & redirected to lowercase as expected

= 1.0 =
* Initial commit
