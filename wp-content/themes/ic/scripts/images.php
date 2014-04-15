<script type="text/javascript">

jQuery(function($){
				
				$.supersized({
				
					// Functionality
					slideshow               :   1,			// Slideshow on/off
					autoplay				:	1,			// Slideshow starts playing automatically
					start_slide             :   1,			// Start slide (0 is random)
					stop_loop				:	0,			// Pauses slideshow on last slide
					random					: 	0,			// Randomize slide order (Ignores start slide)
					slide_interval          :   12000,		// Length between transitions
					transition              :   <?php if(get_option('cebo_slidertransitions') == 'Fade' )  { echo '1'; } elseif(get_option('cebo_slidertransitions') == 'Slide Top') { echo '2'; } elseif(get_option('cebo_slidertransitions') == 'Slide Right') { echo '3'; } elseif(get_option('cebo_slidertransitions') == 'Slide Bottom') { echo '4'; } elseif(get_option('cebo_slidertransitions') == 'Slide Left') { echo '5'; } elseif(get_option('cebo_slidertransitions') == 'Carousel Right') { echo '6'; } elseif(get_option('cebo_slidertransitions') == 'Carousel Left') { echo '7'; } else { echo '1'; } ?>, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed		:	1000,		// Speed of transition
					new_window				:	1,			// Image links open in new window/tab
					pause_hover             :   0,			// Pause slideshow on hover
					keyboard_nav            :   1,			// Keyboard navigation on/off
					performance				:	1,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
					image_protect			:	1,			// Disables image dragging and right click with Javascript
															   
					// Size & Position						   
					min_width		        :   0,			// Min width allowed (in pixels)
					min_height		        :   0,			// Min height allowed (in pixels)
					vertical_center         :   1,			// Vertically center background
					horizontal_center       :   1,			// Horizontally center background
					fit_always				:	0,			// Image will never exceed browser width or height (Ignores min. dimensions)
					fit_portrait         	:   1,			// Portrait images will not exceed browser height
					fit_landscape			:   0,			// Landscape images will not exceed browser width
															   
					// Components							
					slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
					thumb_links				:	0,			// Individual thumb links for each slide
					thumbnail_navigation    :   0,			// Thumbnail navigation
					slides 					:  	[			// Slideshow Images
					
					
					
					<?php $pcount = get_option('cebo_slidecount'); ?>
					<?php $query = new WP_Query(array(
						'post_type' => 'slides',
						'posts_per_page' => $pcount, 
						'order' => 'DESC' )); ?>
					<?php if ($query->have_posts()) : ?>
					<?php while ($query->have_posts()) : $query->the_post(); ?>
						      
					
					
					
					{image : '<?php $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); if($imgsrc) { echo $imgsrc[0]; } else { ?><?php bloginfo ('template_url'); ?>/images/nopic.jpg<? } ?>', title : '<?php if(get_post_meta($post->ID, 'heading',true)) { ?><div class="major"><?php echo get_post_meta($post->ID, 'heading',true); ?></div><? } ?><?php if(get_post_meta($post->ID, 'desc',true)) { ?><div class="slidedescription"><?php echo get_post_meta($post->ID, 'desc',true); ?></div><?php } ?><?php if(get_post_meta($post->ID, 'button1name',true)) { ?><ul class="footprints"><?php if(get_post_meta($post->ID, 'button1name',true)) { ?><li><a href="<?php echo get_post_meta($post->ID, 'button1link',true); ?>"><?php echo get_post_meta($post->ID, 'button1name',true); ?></a></li><?php } ?><?php if(get_post_meta($post->ID, 'button2name',true)) { ?><li><a href="<?php echo get_post_meta($post->ID, 'button2link',true); ?>"><?php echo get_post_meta($post->ID, 'button2name',true); ?></a></li><? } ?><?php if(get_post_meta($post->ID, 'button3name',true)) { ?><li><a href="<?php echo get_post_meta($post->ID, 'button3link',true); ?>"><?php echo get_post_meta($post->ID, 'button3name',true); ?></a></li><? } ?></ul><? } ?>', thumb : '', url : 'http://cebocampbell.com'}<?php if(($query->current_post + 1) == ($query->post_count)) { ?> <? } else { ?>,<? } ?>

														
														
						<?php endwhile; endif; wp_reset_query(); ?>										
														
														
												],
												
					// Theme Options			   
					progress_bar			:	0,			// Timer for each slide							
					mouse_scrub				:	0
					
				});
		    });
</script>