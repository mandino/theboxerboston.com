=== Async JavaScript ===
Contributors: (cloughit)
Donate link: http://www.cloughit.com.au/donate/ (coming soon)
Tags: async,javascript,google,pagespeed,js,speed,performance,boost,render,blocking,above-the-fold
Requires at least: 2.8
Tested up to: 4.7.2
Stable tag: 1.17.02.06
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Async JavaScript adds a 'async' or 'defer' attribute to JavaScripts loaded via wp_enqueue_script

== Description ==

Help to eliminate Render-blocking JavaScript in above-the-fold content with Async JavaScript.

Render-blocking JavaScript prevents above-the-fold content on your page from being rendered until the JavaScript has finished loading.  This can impact on your page speed and ultimately your ranking within search engines.  It can also impact your users experience.

Async JavaScript adds a 'async' or 'defer' attribute to all JavaScripts loaded by the WordPress wp_enqueue_script function.  This 'async' or 'defer' attribute forces the JavaScript to be loaded asynchronously or deferred, therefore speeding up page delivery.

<em>Want more control? </em><strong>Async JavaScript Pro</strong> allows you to:

* Selective 'async' - choose which JavaScripts to apply 'async' to
* Selective 'defer' - choose which JavaScripts to apply 'defer' to
* Exclude individual scripts - choose which JavaScripts to ignore
* Exclude plugins - choose local plugin JavaScripts to ignore

<a href="http://cloughit.com.au/product/async-javascript-pro/" target="_blank">Read more...</a>

== Installation ==

Just install from your WordPress "Plugins | Add New" screen and all will be well. Manual installation is very straightforward as well:

1. Upload the zip-file and unzip it in the /wp-content/plugins/ directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to `Async JavaScript` menu to load setings page

== Frequently Asked Questions ==

= Which browsers support the 'async' and 'defer' attributes =

The 'async' attribute is new in HTML5. It is supported by the following browsers:

* Chrome
* IE 10 and higher
* Firefox 3.6 and higher
* Safari
* Opera

= Where can I report an error? =

Please lodge a support request at <a href="https://cloughit.com.au/support/?wpsc_category=8" target="_blank">https://cloughit.com.au/support/</a>

Note: Support is NOT offered via the wordpress.org forums.

= What information should I include when requesting support =

* A description of the problem, including screenshots and information from your browser's debug console
* URL of your blog (you can turn Async JavaScript off, but should be willing to turn it briefly on to have the error visible)
* your Async JavaScript settings (including a description of changes you made to the configuration to try to troubleshoot yourself)
* the Theme used (including the Theme's download link)
* optionally plugins used (if you suspect one or more plugins are raising havoc)

= I want out, how should I remove Async JavaScript? =

* Disable the plugin
* Delete the plugin

== Screenshots ==

Coming soon!

== Changelog ==

= 1.17.02.06 =

* FIX: Remove variable notice

= 1.17.01.22 =

* MOD: Changes in notice functionality

= 1.17.01.14 =

* MOD: Update readme.txt information
* MOD: Minify plugin JS & CSS

= 1.16.12.12 =

* MOD: WordPress 4.7 Support
* AD: Christmas Sale Sale

= 1.16.10.25 =

* AD: Crazy One Week Sale

= 1.16.09.30 =

* MOD: Better detection of jQuery core file

= 1.16.08.17 =

* FIX: Typo in variable name

= 1.16.08.11 =

* NEW: Select jQuery handler
* NEW: Select Autoptimize handler

= 1.16.08.10 =

* FIX: Return $tag instead of $src

= 1.16.08.09 =

* MOD: Added ability to check for spaces in comma separated exclusion list
* MOD: Added support link

= 1.16.06.22 =

* MOD: Remove admin message marketing
* MOD: Moved menu item to Settings menu
* MOD: Fixed marketing image css
* MOD: Fixed spelling of 'JavaScript' to 'JavaScript'

= 1.16.06.21 =

* MOD: converted from 'clean_url' to 'script_loader_tag' filter

= 1.16.03.23 =

* FIX: added check for empty string entered in exclusions

= 1.16.03.13 =

* FIX: Fixed autoptomize settings
* FIX: Removed redundant settings

= 1.16.03.12 =

* FIX: Adjust code flow for registered settings

= 1.16.03.11 =

* FIX: Properly register options

= 1.16.02.18 =

* NEW: Added dismissable upgrade notice

= 1.16.02.17 =

* NEW: Added information for Async JavaScript Pro

= 1.15.02.23.1 =

* FIX: Code error fix

= 1.15.02.23 =

* NEW: Tested for WordPress v4.1.1
* NEW: Added ability to provide a comma seperated list of scripts to be excluded from async/defer (thanks to Nico Ryba for this suggestion)

= 1.14.12.19 =

* NEW: Tested for Wordpress v4.1

= 1.14.12.11.2 =

* FIX: Repaired broken SVN issue preventing plugin install

= 1.14.12.11.1 =

* FIX: Repaired broken SVN issue preventing plugin install

= 1.14.12.11 =

* FIX: Updated minor versioning issue

= 1.14.12.10 =

* Genesis