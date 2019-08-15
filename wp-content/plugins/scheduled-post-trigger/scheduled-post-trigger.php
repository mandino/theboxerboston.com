<?php
/**
 * Plugin Name: Scheduled Post Trigger
 * Description: This plugin triggers scheduled posts that were missed by the server's cron
 * Version: 3.0
 * Author: Jennifer Moss - Moss Web Works
 * Author URI: http://mosswebworks.com
 * License: GPL2
 */
function pubMissedPosts() {
	if (is_front_page() || is_single()) {
		global $wpdb;
		$now=gmdate('Y-m-d H:i:00');
	
    	$args=array(
        	'public'                => true,
	        'exclude_from_search'   => false,
    	    '_builtin'              => false
	    ); 
    	$post_types = get_post_types($args,'names','and');
		$str=implode ('\',\'',$post_types);

		if ($str) {
			$sql="Select ID from $wpdb->posts WHERE post_type in ('post','page','$str') AND post_status='future' AND post_date_gmt<'$now'";
		}
		else {$sql="Select ID from $wpdb->posts WHERE post_type in ('post','page') AND post_status='future' AND post_date_gmt<'$now'";}

		$resulto = $wpdb->get_results($sql);
 		if($resulto) {
			foreach( $resulto as $thisarr ) {
				wp_publish_post($thisarr->ID);
			}
		}
	}
}
add_action('wp_head', 'pubMissedPosts'); 
?>