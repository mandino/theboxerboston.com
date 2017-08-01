<?php
/*
Plugin Name: No Index on Events Calendar Past Events
Plugin URI:  http://misfit-inc.com
Description: Automatically add a "noindex" meta tag to past events on event calendar' detail pages to prevent them from appearing in search engines.
Version:     1.0
Author:      Misfit Inc
Author URI:  http://misfit-inc.com
Text Domain: misfit
License:     GPL2
*/

if (!defined('ABSPATH')) { exit; }

// added no index when Yoast SEO disable
function misfit_noindex_past_events() {
	global $post;
    $event= tribe_get_events_link ();
	if (!is_admin() && $post->post_type == 'tribe_events') {
		if (!function_exists('tribe_get_end_date')) { return false; }          
                if(tribe_is_day() === true) {
                    
                    echo "\n<!-- noindex calendar Events -->\n<meta name=\"robots\" content=\"noindex, follow\" />\n\n";  
                    
                    $t_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                    $turl = explode('/',$t_url);
                    $turl = array_filter($turl);                       
                    $pdate = end($turl);
    
                    $prev_date = date('Y-m-d', strtotime($pdate.' -1 day'));
                    $prev_link = $event.$prev_date.'/';
                    $next_date = date('Y-m-d', strtotime($pdate.' +1 day'));
                    $next_link = $event.$next_date.'/';
                    echo "\n<link rel=\"next\" href=\"".$next_link."\" />\n";
                    echo "\n<link rel=\"prev\" href=\"".$prev_link."\" />\n";

                  
            }
	}
}
add_action('wp_head', 'misfit_noindex_past_events');

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