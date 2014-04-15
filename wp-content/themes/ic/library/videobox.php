<?php
/**
	Extra set of custom fields for Team Members
 */
 
///////////////////////////////////////////////////////////////////////////// Please Do Not Edit Unless You Know What You Are Doing

$videobox = array (
	'Slide Configuration' => array (
			array( 'bigtitle', 'If you would like to add a  slide main heading, put it here. .. but keep it short' , 'textfield'),
			array( 'littletitle', 'If you would like to add a slide small heading, put it here. .. but keep it short" ' , 'textfield'),
			array( 'logopic', 'If you would like to add an image or logo, upload it, copy and paste the link here." ' , 'textfield'),
				),
		
);
			// Do not edit past this point.
			// Use the admin_menu action to define the custom boxes
			add_action( 'admin_menu', 'video_add_custom_box' );
			// Use the save_post action to do something with the data entered
		// Save the custom fields
	add_action( 'save_post', 'video_save_postdata', 1, 2 );
	// Adds a custom section to the –advanced” Post and Page edit screens
		function video_add_custom_box() {
		global $videobox;
			if ( function_exists( 'add_meta_box' ) ) {
		foreach ( array_keys( $videobox ) as $box_name ) {
			add_meta_box( $box_name, __( $box_name, 'video' ), 'video_post_custom_box', 'slides', 'normal', 'high' );
			}
		}
		}
		function video_post_custom_box ( $obj, $box ) {
			global $videobox;
			static $video_nonce_flag = false;
			// Run once
				if ( ! $video_nonce_flag ) {
				echo_video_nonce();
				$video_nonce_flag = true;
				}
			// Genrate box contents
				foreach ( $videobox[$box['id']] as $video_box ) {
				echo video_field_html( $video_box );
				}
			}
			function video_field_html ( $args ) {
			switch ( $args[2] ) {
			case 'textarea':
			return video_text_area( $args );
			case 'checkbox':
		// To Do
			case 'radio':
				echo '<br><p>A good ratio is 16:9. Try images at 800 x 400 or 1800 x 900</p><div class="wp-media-buttons" id="wp-content-media-buttons"><a title="Add Media" data-editor="content" class="button insert-media add_media" href="#"><span class="wp-media-buttons-icon"></span>Click Here And Set Your Featured Image</a></div><br><br>';
			return ;	
			case 'text':
			default:
			return video_text_field( $args );
		}
	}
			function video_text_field ( $args ) {
			global $post;
		// adjust data
			$args[2] = get_post_meta($post->ID, $args[0], true);
			$args[1] = __($args[1], 'video' );
			$label_format =
				'<label for="%1$s">%2$s</label><br />'
				. '<input style="width: 95%%; padding: 8px; margin: 10px 0;" type="text" name="%1$s" value="%3$s" /><br /><br />';
			return vsprintf( $label_format, $args );
				}
			function video_text_area ( $args ) {
			global $post;
			// adjust data
			$args[2] = get_post_meta($post->ID, $args[0], true);
			$args[1] = __($args[1], 'video' );
				$label_format =
				'<label for="%1$s">%2$s</label><br />'
				. '<textarea style="width: 95%%;" name="%1$s">%3$s</textarea><br /><br />';
			return vsprintf( $label_format, $args );
		}
			/* When the post is saved, saves our custom data */
			function video_save_postdata($post_id, $post) {
			global $videobox;
				// verify this came from the our screen and with proper authorization,
				// because save_post can be triggered at other times
				if ( ! wp_verify_nonce( $_POST['video_nonce_name'], plugin_basename(__FILE__) ) ) {
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
			// The data is already in $videobox, but we need to flatten it out.
				foreach ( $videobox as $video_box ) {
				foreach ( $video_box as $video_fields ) {
			$my_data[$video_fields[0]] =  $_POST[$video_fields[0]];
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
	function echo_video_nonce () {
		// Use nonce for verification Ä ONLY USE ONCE!
		echo sprintf(
		'<input type="hidden" name="%1$s" id="%1$s" value="%2$s" />',
		'video_nonce_name',
			wp_create_nonce( plugin_basename(__FILE__) )
		);
	}
?>