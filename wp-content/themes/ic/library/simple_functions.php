<?php

register_nav_menus( array(
	'primary' => __( 'Primary Navigation', 'cebo' ),
) );

register_nav_menus( array(
	'footer' => __( 'Footer Navigation', 'cebo' ),
) );


// Sidebar Activation

if ( function_exists('register_sidebar') )
register_sidebar(array('name'=>'Sidebar',
'before_widget' => '<div class="sidewidgets">',
'after_widget' => '<div class="clear"></div></div>',
'before_title' => '<h4>',
'after_title' => '</h4>',
));

if ( function_exists('register_sidebar') )
register_sidebar(array('name'=>'Footer Column 1',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h3>',
'after_title' => '</h3>',
));


if ( function_exists('register_sidebar') )
register_sidebar(array('name'=>'Footer Column 2',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h3>',
'after_title' => '</h3>',
));

if ( function_exists('register_sidebar') )
register_sidebar(array('name'=>'Footer Column 3',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h3>',
'after_title' => '</h3>',
));


/* this is for the image grabber 

*/
// Pull an image/post ID from the media gallery
function sp_get_image_id($num = 0) {
	global $post;
	$children = get_children(array(
		'post_parent' => $post->ID,
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
		'orderby' => 'menu_order',
		'order' => 'ASC'
	));

	$count = 0;
    foreach ((array)$children as $key => $value) {
        $images[$count] = $value;
        $count++;
    }
	if(isset($images[$num]))
		return $images[$num]->ID;
	else
		return false;
}

// Pull an image URL from the media gallery
function sp_get_image($num = 0) {
	global $post;
	$children = get_children(array(
		'post_parent' => $post->ID,
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
		'orderby' => 'menu_order',
		'order' => 'ASC'
	));

	$count = 0;
    foreach ((array)$children as $key => $value) {
        $images[$count] = $value;
        $count++;
    }
	if(isset($images[$num]))
		return wp_get_attachment_url($images[$num]->ID);
	else
		return false;
}

// Custom columns for Specials

function set_custom_edit_specials_columns($columns) {
    $columns['available_on_sidebar'] = __( 'Available on sidebar', 'your_text_domain' );

    return $columns;
}

function custom_specials_column($columns, $post_id) {

   if ( $columns == 'available_on_sidebar' ) {

        $terms = get_post_meta( $post_id , 'cebo_available_on_sidebar' , true );
        if ( $terms )
            echo 'yes';
        else
            echo 'no';
       
    }
}
add_filter('manage_edit-specials_columns', 'set_custom_edit_specials_columns');
add_action( 'manage_specials_posts_custom_column' , 'custom_specials_column', 10, 2 );

/* Determine how many words are in an excerpt and what the (Read More) link looks like */

function new_excerpt_length($length) {
	return 70;
}
add_filter('excerpt_length', 'new_excerpt_length');

function new_excerpt_more($post) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }	
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

/* ==================================== */

if ( function_exists( 'add_theme_support' ) ) { // WP 2.9 Post Thumbnail Feature
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 500, 500, true ); // Normal Post Thumbnail
    add_image_size( 'featured-properties-thumbnail', 290, 200, true ); // Home Page Featured Property Thumbnail
    add_image_size( 'listing-photo-thumbnail', 110, 80, true ); // Property Listing Thumbnail
    add_image_size( 'archive-photo-thumbnail', 225, 150, true ); // Archive Listing Thumbnail
}

function get_page_with_template($template) {
	$pages = get_pages();
	foreach($pages as $p) {
		$meta = get_post_custom_values("_wp_page_template",$p->ID);
		if($meta[0] == $template.".php") {
			return $p->ID;
		}
	}
	return false;
}

function url_get_contents ($Url) {
    if (!function_exists('curl_init')){ 
        die('CURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

function feedFilter($query) {
	if ($query->is_feed) {
		add_filter('rss2_item', 'feedContentFilter');
		}
	return $query;
}
add_filter('pre_get_posts','feedFilter');
 
function feedContentFilter($item) {

	global $post;

	$args = array(
		'order'          => 'ASC',
		'post_type'      => 'attachment',
		'post_parent'    => $post->ID,
		'post_mime_type' => 'image',
		'post_status'    => null,
		'numberposts'    => 1,
	);
	$attachments = get_posts($args);
	if ($attachments) {
		foreach ($attachments as $attachment) {
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");
			$mime = get_post_mime_type($attachment->ID);
		}
	}
	$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");
	if ($imgsrc) {
		echo '<enclosure url="'.$imgsrc [0].'" length="" type="'.$mime.'"/>';
	} 
	return $item;
}

class Walker_Sitemap extends Walker_page {
 function start_el(&$output, $page, $depth, $args, $item, $current_page) {
		if ( $depth )
			$indent = str_repeat("\t", $depth);
		else
			$indent = '';
 
		extract($args, EXTR_SKIP);
 
		$output .= $indent . '' . apply_filters( 'the_title', $page->post_title, $page->ID ) . ',';
 
                $description = get_post_meta($page->ID, 'description', true);
                $desc = substr($description, 0, 10);
 
                if( ! empty( $description ) ) {
			$output .= '<div class="description">' . $desc . '</div>';
                }		
 
	}
}

class MV_Cleaner_Walker_Nav_Menu extends Walker {
    var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
    function start_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<nav class=\"sub-menu\">\n";
    }
    function end_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</nav>\n";
    }
    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes = in_array( 'current-menu-item', $classes ) ? array( 'current-menu-item' ) : array();
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = strlen( trim( $class_names ) ) > 0 ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $id = apply_filters( 'nav_menu_item_id', '', $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
        $output .= $indent . '<span' . $id . $value . $class_names .'>';
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
    function end_el(&$output, $item, $depth) {
        $output .= "</span>\n";
    }
}


add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}


add_filter('next_posts_link_attributes', 'posts_link_attributes_1');
add_filter('previous_posts_link_attributes', 'posts_link_attributes_2');

function posts_link_attributes_1() {
    return 'class="gohead"';
}
function posts_link_attributes_2() {
    return 'class="gohead"';
}

function custom_tag_cloud_widget($args) {
	$args['number'] = 0; //adding a 0 will display all tags
	$args['largest'] = 18; //largest tag
	$args['smallest'] = 10; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	$args['format'] = 'list'; //ul with a class of wp-tag-cloud
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'custom_tag_cloud_widget' );


if( !is_admin()){
    wp_deregister_script('jquery');
    wp_register_script('jquery', (" "), false, '1.10.1');
    wp_enqueue_script('jquery');
}



?>