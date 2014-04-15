<?php
/**
 * Custom Post Types
 *
 * @package WordPress
 * @subpackage cebo
 * @since Dream Home 1.0
 */
 
///////////////////////////////////////////////////////////////////////////// Custom Post Type

add_action('init', 'project_items');

function project_items()
{
  $labels = array(
    'name' => _x('Rooms', 'post type general name'),
    'singular_name' => _x('Rooms', 'post type singular name'),
    'add_new' => _x('Add New', 'Rooms'),
    'add_new_item' => __('Add New Rooms'),
    'edit_item' => __('Edit Rooms'),
    'new_item' => __('New Rooms'),
    'view_item' => __('View Rooms'),
    'search_items' => __('Search Rooms'),
    'not_found' =>  __('No Rooms found'),
    'not_found_in_trash' => __('No Rooms found in Trash'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'rooms' ),
    'capability_type' => 'post',
    'menu_icon' => get_bloginfo('template_url').'/options/images/icon_team.png',
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title','custom-fields','editor','author','excerpt','comments','thumbnail')
  );
  register_post_type('rooms',$args);
}

//create taxonomy for project type

include(TEMPLATEPATH . '/options/secondary-panel.php'); 




add_action( 'init', 'creates_post_types' );
function creates_post_types() {
  register_post_type( 'slides',
    array(
      'labels' => array(
        'name' => __( 'Slides' ),
        'singular_name' => __( 'Slides' )
      ),
      'public' => true,
      'rewrite' => array('slug' => 'slides'),
      'menu_icon' => get_bloginfo('template_url').'/options/images/icon_team.png',
      'supports' => array('title','custom-fields','editor','category','author','thumbnail')
    )
  );
}


add_action( 'init', 'createl_post_types' );
function createl_post_types() {
  register_post_type( 'amenities',
    array(
      'labels' => array(
        'name' => __( 'Amenities' ),
        'singular_name' => __( 'Amenities' )
      ),
      'public' => true,
      'rewrite' => array('slug' => 'locations'),
      'menu_icon' => get_bloginfo('template_url').'/options/images/icon_team.png',
      'supports' => array('title','custom-fields','editor','category','author','thumbnail')
    )
  );
}



add_action( 'init', 'creater_post_types' );
function creater_post_types() {
  register_post_type( 'specials',
    array(
      'labels' => array(
        'name' => __( 'Specials' ),
        'singular_name' => __( 'Specials' )
      ),
      'public' => true,
      'rewrite' => array('slug' => 'specials'),
      'menu_icon' => get_bloginfo('template_url').'/options/images/icon_team.png',
      'supports' => array('title','custom-fields','editor','category','author','thumbnail')
    )
  );
}




add_action( 'init', 'create_post_types' );
function create_post_types() {
  register_post_type( 'locations',
    array(
      'labels' => array(
        'name' => __( 'Locations' ),
        'singular_name' => __( 'Locations' )
      ),
      'public' => true,
      'rewrite' => array('slug' => 'locations'),
      'menu_icon' => get_bloginfo('template_url').'/options/images/icon_team.png',
      'supports' => array('title','custom-fields','editor','category','author','thumbnail')
    )
  );
}



add_action( 'init', 'creaters_post_types' );
function creaters_post_types() {
  register_post_type( 'testimonials',
    array(
      'labels' => array(
        'name' => __( 'Testimonials' ),
        'singular_name' => __( 'Testimonials' )
      ),
      'public' => true,
      'rewrite' => array('slug' => 'testimonials'),
      'menu_icon' => get_bloginfo('template_url').'/options/images/icon_team.png',
      'supports' => array('title','custom-fields','editor','category','author','thumbnail')
    )
  );
}




create_loctype_taxonomies();
function create_loctype_taxonomies()
{
  // Taxonomy for Location
  $labels = array(
    'name' => _x( 'Location Type', 'taxonomy general name' ),
    'singular_name' => _x( 'Location Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Location Types' ),
    'all_items' => __( 'All Location Types' ),
    'parent_item' => __( 'Parent Location Type' ),
    'parent_item_colon' => __( 'Parent Location Type:' ),
    'edit_item' => __( 'Edit Location Type' ),
    'update_item' => __( 'Update Location Type' ),
    'add_new_item' => __( 'Add New Location Type' ),
    'new_item_name' => __( 'New Location Type Name' ),
  ); 	

  register_taxonomy('loctype', array('locations'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'location-type' ),
  ));

}

?>