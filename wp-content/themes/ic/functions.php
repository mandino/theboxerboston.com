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

function get_image_alt_text_by_post_id($post_id) {
    if(has_post_thumbnail($post_id)) $post_meta = get_post_meta(get_post_thumbnail_id($post_id));
    else $post_meta = get_post_meta($post_id);
    if(is_array($post_meta)) {
        if(array_key_exists('_wp_attachment_image_alt', $post_meta) && $post_meta['_wp_attachment_image_alt'][0]) {
            return $post_meta['_wp_attachment_image_alt'][0];
        }
        else return get_the_title();
    }
}

function get_post_meta_img_id($img_url) {
    global $wpdb;
    $uploads_img_path = implode('/', array_slice(explode('/', $img_url), -3));
    $post_id = $wpdb->get_col($wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '%1\$s' AND meta_value = '%2\$s';", "_wp_attached_file", $uploads_img_path));
    return $post_id[0];
}

function get_custom_image_thumb_alt_text($img_url,$img_id) {
    if($img_url) $post_id = get_post_meta_img_id($img_url);
	else $post_id = $img_id;
    $image_thumb_alt_text =get_image_alt_text_by_post_id($post_id);
    return $image_thumb_alt_text;
}

add_filter('amp_post_template_file', 'amp_set_custom_footer_template', 10, 2);

function amp_set_custom_footer_template($file, $type) {
	if ('footer' === $type) {
		$file = TEMPLATEPATH . '/amp/templates/footer.php';
	}

	return $file;
}

add_filter('amp_post_template_file', 'amp_set_custom_style_css', 10, 3);

function amp_set_custom_style_css($file, $type, $post) {
	if ('style' === $type) {
		$file = TEMPLATEPATH . '/amp/templates/style.php';
	}

	return $file;
}

/*
	widget-calendar.js in plugin transfer to ic theme tribe-events-widget-calendar.js
	mini-calendar in neighborhood page
*/
add_action('wp_enqueue_scripts', 'enqueue_js');
function enqueue_js() {
	wp_register_script('tribe-mini-calendar', get_template_directory_uri().'/js/tribe-events-widget-calendar.js', array( 'jquery' ));
	wp_localize_script( 'your_unique_js_name', 'youruniquejs_vars', 

	array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'current' => $current,
		'next' => $next,
		'prev' => $prev,

		)
	);
}

function upcoming_query($current_date, $next_date) {
	$query = new WP_Query(array(
		'post_type' => 'tribe_events',
		'eventDisplay' => 'upcoming',
		'posts_per_page' => 4,
		'meta_query' => array(
		'relation' => 'AND',
			array(
				'relation' => 'AND',
					array(
						'key' => '_EventStartDate',
						'value' => date('Y-m-d H:i:s', strtotime($next_date)),
						'compare' => '<='
					),
					array(
						'key' => '_EventStartDate',
						'value' => date('Y-m-d H:i:s', strtotime($current_date)),
						'compare' => '>='
					)
			)
		)
	));

	return $query;
}

/* ajax for upcoming events */
add_action('wp_ajax_upcoming_event_tiles', 'upcoming_events_tiles');
add_action('wp_ajax_nopriv_upcoming_event_tiles', 'upcoming_events_tiles');
function upcoming_events_tiles() {

$class_even = '';
header('Content-Type: text/html');

$query = upcoming_query($_GET['current'], $_GET['next']);

if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
	$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");
	$shortdater = tribe_get_start_date($post->ID, true, 'M'); $shortdaterz = substr($shortdater, 0, 3);
	$shortdate = tribe_get_start_date($post->ID, true, 'j'); $shortdatez = substr($shortdate, 0, 2);
?>

<li <?php echo $class_even ?>>
	<a href="<?php the_permalink(); ?>">

	<img src="<?php echo tt($imgsrc[0], 275, 178); ?>"  alt="<?php echo get_custom_image_thumb_alt_text('', $post->ID); ?>"/>
	<div class="event-date">
		<?php echo $shortdaterz . " <span>" . $shortdatez. "</span>"; ?>
	</div>

	<div class="event-description">
		<p><?php the_title(); ?></p>
	</div>

	</a>
</li>
<?php

$class_even = $class_even ? '' : 'class="even"';

endwhile; endif; wp_reset_postdata(); wp_die();
}

// Image with src, srcset and sizes $class => image class

function get_image_with_detail( $photo_id, $size = 'Full' ) {
	$imgsrc = wp_get_attachment_image_src( $photo_id, $size);
	$srcset = esc_attr( wp_get_attachment_image_srcset( $photo_id, $size ) );
	$imgsize = esc_attr( wp_get_attachment_image_sizes( $photo_id, $size ) );

	return array( 'imgsrc' => $imgsrc, 'srcset' => $srcset, 'sizes' => $imgsize );
}

function custom_tribe_event_thumbnail_image( $post_id = null, $size = 'full', $link = true, $wrapper = true ) {
	if ( is_null( $post_id ) ) {
		$post_id = get_the_ID();
	}

	/**
	 * Provides an opportunity to modify the featured image size.
	 *
	 * @param string $size
	 * @param int    $post_id
	 */
	$size = apply_filters( 'tribe_event_featured_image_size', $size, $post_id );

	$featured_image = $wrapper
		? get_the_post_thumbnail( $post_id, $size )
		: wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size, false );

	if ( is_array( $featured_image ) ) {
		$featured_image = $featured_image[ 0 ];
	}

	/**
	 * Controls whether the featured image should be wrapped in a link
	 * or not.
	 *
	 * @param bool $link
	 */

	if (get_field('thumbnail')) :
		$image_detail = get_image_with_detail( get_field('thumbnail'), $size );
		$banner_photo = $image_detail['imgsrc'];
		$banner = $banner_photo;
		$featured_image = '<img src="'.$banner[0].'" class="attachment-full size-full wp-post-image" srcset="'.$image_detail['srcset'].'" sizes="'.$image_detail['sizes'].'" alt="'.get_the_title().'">';

	endif;

	if ( ! empty( $featured_image ) && apply_filters( 'tribe_event_featured_image_link', $link ) ) {
		$featured_image = '<a href="' . esc_url( tribe_get_event_link( $post_id ) ) . '">' . $featured_image . '</a>';
	}

	/**
	 * Whether to wrap the featured image in our standard div (used to
	 * assist in targeting featured images from stylesheets, etc).
	 *
	 * @param bool $wrapper
	 */
	if ( ! empty( $featured_image ) && apply_filters( 'tribe_events_featured_image_wrap', $wrapper ) ) {
		$featured_image = '<div class="tribe-events-event-image">' . $featured_image . '</div>';
	}

	/**
	 * Provides an opportunity to modify the featured image HTML.
	 *
	 * @param string $featured_image
	 * @param int    $post_id
	 * @param string $size
	 */
	return apply_filters( 'tribe_event_featured_image', $featured_image, $post_id, $size );
}

function home_nav_wrap() {

	$mobilenav = wp_nav_menu( array(
		'theme_location'=> 'mobilenav',
		'fallback_cb'	=> false,
		'container'		=> '',
		'items_wrap' => '%3$s',
		'echo' => false
	) );

	// $wrap  = '<ul>';

	$wrap .= '<li class="navis-mobile">
			<a href="tel:'.get_option('cebo_tele').'" target="new"><span class="ic-navis"><i class="fa fa-phone"></i> <span>'.get_option('cebo_tele').'</span></span></a>
								</li>';

	$wrap .= '%3$s';

	$wrap .= '<li class="hamburgermenu">
				<a class="cheese" href="#">
					<div class="hamburger">
						<span></span>
						<span></span>
						<span></span>
					</div>
					<span class="menutext">Menu</span>
				</a>
			</li>';

	$wrap .= $mobilenav;

	// $wrap .= '</ul>';

	return $wrap;
}

if (!class_exists('walker_menu')) {
	class walker_menu extends Walker_Nav_Menu {
		function start_el( &$output, $item, $depth = 0, $args = array() ) {
			$has_children = array_search ( 'menu-item-has-children' , $item->classes );
			// if($has_children != false) :
				$item_output .= '<div class="toggle-button"></div>';
			// endif;
		}
	}
}