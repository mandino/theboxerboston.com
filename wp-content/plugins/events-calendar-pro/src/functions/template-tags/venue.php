<?php
/**
 * Events Calendar Pro Venue Template Tags
 *
 * Display functions for use in WordPress templates.
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( class_exists( 'Tribe__Events__Pro__Main' ) ) {

	/**
	 * Output the upcoming events associated with a venue
	 *
	 * @return string|null
	 */
	function tribe_venue_upcoming_events( $post_id = false ) {

		$post_id = Tribe__Events__Main::postIdHelper( $post_id );

		if ( $post_id ) {
			$args = array(
				'venue'          => $post_id,
				'eventDisplay'   => 'list',
				'posts_per_page' => apply_filters( 'tribe_events_single_venue_posts_per_page', 100 ),
			);

			$html = tribe_include_view_list( $args );

			return apply_filters( 'tribe_venue_upcoming_events', $html );
		}

		return null;
	}
}
