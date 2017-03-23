<?php
/**

 Functions
 
 */
 
 
//.................. BASIC FUNCTIONS .................. //

/* language include.*/
$lang = TEMPLATE_PATH . '/languages';
load_theme_textdomain('cebolang', $lang);

//.................. BASIC FUNCTIONS .................. //

/* Below is an include to default custom fields for the posts.*/
include(TEMPLATEPATH . '/library/simple_functions.php');


/* Include Super Furu Custom Options Panel*/
require_once(TEMPLATEPATH .  '/options/options_panel.php');


 /* ................. CUSTOM POST TYPES .................... */
/* Below is an include to a default custom post type.*/
include(TEMPLATEPATH . '/library/post_types.php');

 /* ................. SOME OPTIONS FOR POSTS .................... */
/* Below is an include to a few options for your posts.*/
include(TEMPLATEPATH . '/options/single-options.php'); 


 /* ................. SOME OPTIONS FOR POPOUT BOXES .................... */
/* Below is an include to a few options for your popout boxes.*/
include(TEMPLATEPATH . '/options/popout-box-options.php'); 


 /* ................. SOME OPTIONS FOR SLIDES .................... */
/* Below is an include to a few options for your slides.*/
include(TEMPLATEPATH . '/library/videobox.php'); 


 /* ................. SOME OPTIONS FOR PROJECTS .................... */
/* Below is an include to a few options for your projects.*/
include(TEMPLATEPATH . '/options/project-options.php'); 
include(TEMPLATEPATH . '/options/email-signup-options.php'); 
include(TEMPLATEPATH . '/options/neighborhood-options.php'); 


 /* ................. SOME OPTIONS FOR PROJECTS .................... */
/* Below is an include to a few options for your projects.*/
include(TEMPLATEPATH . '/options/local-options.php'); 




 /* ................. CUSTOM FIELDS .................... */
/* Below is an include to a few options for your projects.*/
include(TEMPLATEPATH . '/library/custom_fields.php'); 

/* .................. SHORTCODES ...…… */
/* Below is an include to default custom fields for the posts.*/
include(TEMPLATEPATH . '/library/shortcodes.php');



/* .................. SHORTCODES ...…… */
/* Below is an include to default custom fields for the posts.*/
include(TEMPLATEPATH . '/library/widgets.php');




function is_subpage() {
    global $post;                              // load details about this page

    if ( is_page() && $post->post_parent ) {   // test to see if the page has a parent
        return $post->post_parent;             // return the ID of the parent post

    } else {                                   // there is no parent so ...
        return false;                          // ... the answer to the question is false
    }
}



 /* ................. ADDITIONAL INFO FOR SHORTCODES .................... */
/* Below is an include to a few options for your projects.*/

define( 'SS_BASE_DIR', TEMPLATEPATH . '/' );
define( 'SS_BASE_URL', get_template_directory_uri() . '/' );


if ( !function_exists('ss_framework_admin_scripts') ) {

	// Backend Scripts
	function ss_framework_admin_scripts( $hook ) {

		if( $hook == 'post.php' || $hook == 'post-new.php' ) {
			wp_register_script( 'tinymce_scripts', SS_BASE_URL . 'library/tinymce/js/scripts.js', array('jquery'), false, true );
			wp_enqueue_script('tinymce_scripts');
		}

	}
	add_action('admin_enqueue_scripts', 'ss_framework_admin_scripts');
	
}

//  Do not load smoothness calendar CSS

function remove_events_css() {
    wp_dequeue_style( 'tribe-events-custom-jquery-styles' );
    wp_deregister_style( 'tribe-events-custom-jquery-styles' );
}
add_action( 'wp_enqueue_scripts', 'remove_events_css', 20 );


function tt($image,$width,$height){
    return bloginfo('template_url') . "/library/thumb.php?src=$image&w=$width&h=$height";
}


add_filter( 'wpseo_next_rel_link', 'is_homeFrontpageNextPrev' );
function is_homeFrontpageNextPrev($string) {
	if (is_home() || is_front_page() ) { // IF HOMEPAGE, remove <link rel="next" />
		$string = '';
	}
	return $string;
}


add_action( 'wp_head', 'blogPage_relNextPrev', 0 );
function blogPage_relNextPrev() {

	if ( is_page_template('page_blog.php') ) { // IF BLOG PAGE

		$nextprev_query = new WP_Query(array(
			'post_type' => 'post',
		));

		global $paged;
		$paged_max = intval($nextprev_query->max_num_pages);

		if ( $paged == 0 ) { // IF IS THE BLOG PAGE
			echo '<link rel="next" href="' . get_permalink() . 'page/' . ($paged + 2) . '/" />';
		} elseif ( $paged == 2 ) { // ELSEIF $paged is equal to 2.. NOTE: $paged = 1, is the BLOG PAGE
			echo '<link rel="prev" href="' . get_permalink() . '" />';
			echo '<link rel="next" href="' . get_permalink() . 'page/' . ($paged + 1) . '/" />';
		} elseif ( $paged > 2 && $paged < $paged_max ) { // ELSEIF $paged is more than 1 AND lesser than $paged_max
			echo '<link rel="prev" href="' . get_permalink() . 'page/' . ($paged - 1) . '/" />';
			echo '<link rel="next" href="' . get_permalink() . 'page/' . ($paged + 1) . '/" />';
		} elseif ( $paged == $paged_max ) { // ELSEIF $paged is at the end of pagination page
			echo '<link rel="prev" href="' . get_permalink() . 'page/' . ($paged - 1) . '/" />';
		}

		wp_reset_postdata();
	}
}

function get_image_alt_text($post_id) {
	$thumb_id = get_post_meta_value($post_id, '_thumbnail_id');
	$alt_text = get_post_meta_value($thumb_id, '_wp_attachment_image_alt');
	if (empty($alt_text)) return get_the_title();
	else return $alt_text;
}

function get_post_meta_value( $post_id, $meta_key) {
	global $wpdb;
	$mid = $wpdb->get_var( $wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE post_id = %d AND meta_key = %s", $post_id, $meta_key) );
	if( $mid != '' ) return $mid;
	return false;
}
