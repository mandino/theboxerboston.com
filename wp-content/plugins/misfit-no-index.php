<?php
/*
Plugin Name: No Index on Events Calendar Past Events
Plugin URI:  https://www.theindependenthotel.com/
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
	global $post,$wp_query;
    $event= tribe_get_events_link ();
	if (!is_admin() && $post->post_type == 'tribe_events') {
		if (!function_exists('tribe_get_end_date')) { return false; }          
                if(tribe_is_day() === true) {
                    echo "\n<!-- noindex calendar Events -->\n<meta name=\"robots\" content=\"noindex, follow\" />\n";  
                    $t = tribe_get_events_title();
                    $mtime = str_replace('Events for ','',$t);                     
                    $pdate = date('Y-m-d',strtotime($mtime));
                    $prev_date = date('Y-m-d', strtotime($pdate.' -1 day'));                    
                    $prev_link = $event.$prev_date.'/';
                    $next_date = date('Y-m-d', strtotime($pdate.' +1 day'));
                    $next_link = $event.$next_date.'/';
                     echo "\n<link rel=\"prev\" href=\"".$prev_link."\" />\n";
                    echo "\n<link rel=\"next\" href=\"".$next_link."\" />\n";
                }else if (tribe_is_week() ){          
                   $prevwk = tribe_events_week_previous_link(); 
                   preg_match_all('~<a(.*?)href="([^"]+)"(.*?)>~', $prevwk, $prev_wk); 
                   $prev_link = $prev_wk[2][0];    
                   $nxtwk = tribe_events_week_next_link(); 
                   preg_match_all('~<a(.*?)href="([^"]+)"(.*?)>~', $nxtwk, $nxt_wk); 
                   $next_link = $nxt_wk[2][0];    
                   $Current = Date('N');
                   $DaysFromMonday = $Current - 1;    
                   $Monday = Date('Y-m-d', StrToTime("- {$DaysFromMonday} Days"));    
                   $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";     
                   $lnk = tribe_events_get_event();    
                   $t = tribe_get_events_title();
                   $mtime = str_replace('Events for week of ','',$t);  
                   $pdate = date('Y-m-d',strtotime($mtime));   
                   echo "\n<!-- noindex calendar Events -->\n<link rel=\"canonical\" href=\"$actual_link\" />";  
                   echo "\n<link rel=\"prev\" href=\"".$prev_link."\" />";
                   echo "\n<link rel=\"next\" href=\"".$next_link."\" />";    
                   if ($pdate < $Monday){                      
                       echo "\n<meta name=\"robots\" content=\"noindex, follow\" />\n"; 
                   }
               }else if(tribe_is_month() ) {
//                   $prev_link = tribe_get_previous_month_link();
//                   $next_link = tribe_get_next_month_link(); 
//                   $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";        
//                   echo "\n<!-- noindex calendar Events -->\n<link rel=\"canonical\" href=\"$actual_link\" />";  
//                   echo "\n<link rel=\"prev\" href=\"".$prev_link."\" />";
//                   echo "\n<link rel=\"next\" href=\"".$next_link."\" />";     
               }else if ($wp_query->tribe_is_past ) {
                     disable_wpseo_meta_robots();
                     echo "\n<!-- noindex calendar Events -->\n<meta name=\"robots\" content=\"noindex, follow\" />\n";  
                }   
                             
                  
            }
	
}
add_action('wp_head', 'misfit_noindex_past_events');


function disable_wpseo_meta_robots() {
    return $robotsstr = '';
}
add_filter('wpseo_robots','disable_wpseo_meta_robots');

//disable ajax on day view

function events_calendar_remove_scripts() {
if (!is_admin() && !in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) ) {

        //wp_dequeue_script( 'the-events-calendar');
        //wp_dequeue_script( 'tribe-events-list');
        wp_dequeue_script( 'tribe-events-ajax-day');

}}
add_action('wp_print_scripts', 'events_calendar_remove_scripts' , 10);
add_action('wp_footer', 'events_calendar_remove_scripts' , 10);

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