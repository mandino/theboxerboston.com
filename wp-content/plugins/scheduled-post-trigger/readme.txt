=== Plugin Name ===
Contributors: mossifer
Donate link: http://mosswebworks.com/donate/
Tags: scheduled posts, missed schedule, missed scheduled posts
Requires at least: 3.0.1
Tested up to: 4.9.8
Stable tag: 4.9.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Checks to see if any scheduled posts have been missed. If so, it publishes them.

== Description ==
When a visitor loads your site, this lightweight script checks to see if any scheduled posts have been missed. If so, it publishes them immediately. 

== Installation ==
1. Go to Plugins, Add New, Upload Plugin.
2. Upload the ZIP file.
3. Activate the plugin through the 'Plugins' screen in WordPress


Make sure that your timezone is set correctly in Settings->General.

== Frequently Asked Questions ==

= How often does it check missed posts? =

Every time someone loads your your home page or a single blog post. 

= I’ve activated the plugin-and the posts are not publishing =

Please contact Moss Web Works directly to troubleshoot.


== Changelog ==

= 2.21 =
Fixes bug in date/time algorithm.

= 2.2 =
Reduces database interaction by limiting the call to home page and blog post headers only.

= 2.1 =
Reverting code to match 1.8 until we can do further testing.

= 2.0 =
Makes significant change to plugin so it only checks once per visitor, per session instead of each page load. Less taxing on database.

= 1.8 =
Tightened up code. Will not go into the publish loop unless there is a missed post.

= 1.7 =
Small change to integrate with WP posting function.

= 1.0 =
* Initial release

== Upgrade Notice ==

= 1.7 =
Minor changes to plugin.

