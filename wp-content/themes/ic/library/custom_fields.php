<?php
/**
	Extra set of custom fields for Team Members
 */
 
///////////////////////////////////////////////////////////////////////////// Please Do Not Edit Unless You Know What You Are Doing

$fp_boxes = array (
	'Team Member Information' => array (
			array( 'bigtitle', 'Title ex Designer' , 'text'),
			array( 'twitlink', 'Twitter Link ex: //twitter.com/username' , 'text'),
			array( 'faclink', 'Facebook Link  ex: //facebook.com/username' , 'text'),
			array( 'googlink', 'Google + Link  ex: //google.com' , 'text'),
			array( 'linlink', 'Linkedin Link  ex: //linkedin.com' , 'text'),
		),
);
			// Do not edit past this point.
			// Use the admin_menu action to define the custom boxes
			add_action( 'admin_menu', 'fp_add_custom_box' );
			// Use the save_post action to do something with the data entered
		// Save the custom fields
	add_action( 'save_post', 'fp_save_postdata', 1, 2 );
	// Adds a custom section to the –advanced” Post and Page edit screens
		function fp_add_custom_box() {
		global $fp_boxes;
			if ( function_exists( 'add_meta_box' ) ) {
		foreach ( array_keys( $fp_boxes ) as $box_name ) {
			
			add_meta_box( $box_name, __( $box_name, 'fp' ), 'fp_post_custom_box', 'team', 'side', 'high' );
			}
		}
		}
		function fp_post_custom_box ( $obj, $box ) {
			global $fp_boxes;
			static $fp_nonce_flag = false;
			// Run once
				if ( ! $fp_nonce_flag ) {
				echo_fp_nonce();
				$fp_nonce_flag = true;
				}
			// Genrate box contents
				foreach ( $fp_boxes[$box['id']] as $fp_box ) {
				echo field_html( $fp_box );
				}
			}
			function field_html ( $args ) {
			switch ( $args[2] ) {
			case 'textarea':
			return text_area( $args );
			case 'checkbox':
		// To Do
			case 'radio':
		// To Do
			case 'text':
			default:
			return text_field( $args );
		}
	}
			function text_field ( $args ) {
			global $post;
		// adjust data
			$args[2] = get_post_meta($post->ID, $args[0], true);
			$args[1] = __($args[1], 'fp' );
			$label_format =
				'<label for="%1$s">%2$s</label><br />'
				. '<input style="width: 95%%; padding: 8px; margin: 10px 0;" type="text" name="%1$s" value="%3$s" /><br /><br />';
			return vsprintf( $label_format, $args );
				}
			function text_area ( $args ) {
			global $post;
			// adjust data
			$args[2] = get_post_meta($post->ID, $args[0], true);
			$args[1] = __($args[1], 'fp' );
				$label_format =
				'<label for="%1$s">%2$s</label><br />'
				. '<textarea style="width: 95%%;" name="%1$s">%3$s</textarea><br /><br />';
			return vsprintf( $label_format, $args );
		}
			/* When the post is saved, saves our custom data */
			function fp_save_postdata($post_id, $post) {
			global $fp_boxes;
				// verify this came from the our screen and with proper authorization,
				// because save_post can be triggered at other times
				if ( ! wp_verify_nonce( $_POST['fp_nonce_name'], plugin_basename(__FILE__) ) ) {
				return $post->ID;
		}
				// Is the user allowed to edit the post or page?
			if ( 'page' == $_POST['post_type'] ) {
				if ( ! current_user_can( 'edit_page', $post->ID ))
				return $post->ID;
				} else {
			if ( ! current_user_can( 'edit_post', $post->ID ))
				return $post->ID;
				}
			// OK, weêre authenticated: we need to find and save the data
			// Weêll put it into an array to make it easier to loop though.
			// The data is already in $fp_boxes, but we need to flatten it out.
				foreach ( $fp_boxes as $fp_box ) {
				foreach ( $fp_box as $fp_fields ) {
			$my_data[$fp_fields[0]] =  $_POST[$fp_fields[0]];
				}
			}
		// Add values of $my_data as custom fields
			// Letês cycle through the $my_data array!
			foreach ($my_data as $key => $value) {
				if ( 'revision' == $post->post_type  ) {
				// donêt store custom data twice
				return;
			}
			// if $value is an array, make it a CSV (unlikely)
			$value = implode(',', (array)$value);
				if ( get_post_meta($post->ID, $key, FALSE) ) {
				// Custom field has a value.
				update_post_meta($post->ID, $key, $value);
			} else {
			// Custom field does not have a value.
		add_post_meta($post->ID, $key, $value);
		}
			if (!$value) {
			// delete blanks
		delete_post_meta($post->ID, $key);
			}
		}
	}
	function echo_fp_nonce () {
		// Use nonce for verification Ä ONLY USE ONCE!
		echo sprintf(
		'<input type="hidden" name="%1$s" id="%1$s" value="%2$s" />',
		'fp_nonce_name',
			wp_create_nonce( plugin_basename(__FILE__) )
		);
	}
?>