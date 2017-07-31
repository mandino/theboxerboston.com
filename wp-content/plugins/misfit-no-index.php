<?php
/*
Plugin Name: No Index on Events Calendar Past Events
Plugin URI:  http://misfit-inc.com/
Description: Automatically add a "noindex" meta tag to past events on event calendar' detail pages to prevent them from appearing in search engines.
Version:     1.0
Author:      Misfit Inc
Author URI:  http://misfit-inc.com/
Text Domain: misfit
License:     GPL2
*/

if (!defined('ABSPATH')) { exit; }

// added no index when Yoast SEO disable
function misfit_noindex_past_events() {
	global $post;
    global $wp;
  
    $event= tribe_get_events_link ();
	if (!is_admin() && $post->post_type == 'tribe_events') {
        remove_yoast_canonical();
       echo "<link rel=\"canonical\" href=\"".$event."\" />";
		if (!function_exists('tribe_get_end_date')) { return false; }          
                if(tribe_is_day() === true) {
                    echo "\n<!-- noindex Past Events -->\n<meta name=\"robots\" content=\"noindex, follow\" />\n\n";  
                }
            if(tribe_is_list_view() == false ){
                     $linkn = tribe_get_next_event_link();
                   if($linkn){
                        preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', $linkn, $resultn);
                        $relnext = $resultn['href'][0];
                       echo "\n<link rel=\"next\" href=\"".$relnext."\" />\n";
                   }
                    $linkp = tribe_get_prev_event_link();
                   if($linkp){
                        preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', $linkp, $resultp);
                        $relprev = $resultp['href'][0];
                       echo "\n<link rel=\"prev\" href=\"".$relprev."\" />\n";
                   }
                  
            }
	}
}
add_action('wp_head', 'misfit_noindex_past_events');


//* remove yoast added canonical tag on tribe events
function remove_yoast_canonical(){
    return false;
}

add_filter( 'wpseo_canonical', 'remove_yoast_canonical' );

// Add admin page
function misfit_admin() {
	// Missing plugin notice
	if (!is_plugin_active('the-events-calendar/the-events-calendar.php')) {
		add_action('admin_notices', 'misfit_missing_plugin');
	}
	// Admin page
	else {
		// Placeholder for future admin page
	}
}
add_action('admin_menu', 'misfit_admin');

// Admin notice for missing plugin
function misfit_missing_plugin() {
	?>
	<div class="notice notice-error"><p><b>noindex Past Events</b> requires <b>The Events Calendar</b> plugin, but it is missing. Please <a href="plugins.php?s=The+Events+Calendar">activate</a> or <a href="plugin-install.php?s=The+Events+Calendar&tab=search&type=term">install</a> The Events Calendar, or <a href="plugins.php?s=noindex+Past+Events">deactivate</a> noindex Past Events.</p></div>
	<?php
}

?>