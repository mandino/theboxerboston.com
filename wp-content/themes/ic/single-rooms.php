<?php 

/* Single Rooms

*/
 get_header(); ?>


<?php if(get_post_meta($post->ID, 'cebo_fullpic', true)) { ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<div id="room-featured-slider">

		<div class="featured-point"></div>
				
		<div class="flexslider">
			<ul class="slides">
				<li>
					<div class="room-slider-gradience"></div>
					<div class="slide-header">
						<a class="button" target="_blank" href="<?php if(get_post_meta ($post->ID, 'cebo_booklink', true)) { echo get_post_meta ($post->ID, 'cebo_booklink', true); } else { echo get_option('cebo_genbooklink'); } ?>"><?php _e('RESERVE NOW', 'cebolang'); ?></a>
					</div>
					<img src="<?php echo get_post_meta($post->ID, 'cebo_fullpic', true); ?>" />
				</li>
				
			</ul>
		</div>

	</div>


<?php endwhile; endif; wp_reset_query(); ?>	

<?php } ?>



	<div id="intro" class="section">
		
		<div class="container">

			<div class="section-header">
					
				<div class="fl">
	
					<?php if(get_option('cebo_shorttitle')) { ?>
					
					<h2 class="section-pre-title fl"><?php echo get_option('cebo_shorttitle'); ?></h2>

					<div class="section-header-divider fl"></div>
					
					<?php } ?>

		
					<h2 class="section-title fr"><?php the_title(); ?></h2>
	
				</div>
	
				<div class="fr">
					
					<ul class="social-buttons">
					<?php if(get_option('cebo_facebook')) { ?>
					
						<li class="facebook"><a href="http://facebook.com/<?php echo get_option('cebo_facebook'); ?>" target="_blank"><i class="fa fa-facebook fa-2x"></i><span>facebook</span></a></li>
						
					<?php } ?>
					<?php if(get_option('cebo_twitter')) { ?>
					
						<li class="twitter"><a href="http://twitter.com/<?php echo get_option('cebo_twitter'); ?>" target="_blank"><i class="fa fa-twitter fa-2x"></i><span>twitter</span></a></li>
						
					<?php } ?>
					</ul>
	
				</div>
	
			</div>
			
			
			<div class="wonderline"></div>
			
			
			<div class="room-details-content">

				<div class="section-photos fl">
				
				
					<?php if(have_posts()) : while(have_posts()) : the_post(); $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
					
					<?php if(get_post_meta($post->ID, 'cebo_homethumb', true)) { ?>
						
						<img src="<?php echo get_post_meta($post->ID, 'cebo_homethumb', true); ?>">
						
					<?php } else { ?>
						
						<img src="<?php echo $imgsrc[0]; ?>">
						
					<?php } ?>

					
					
					
					
					<?php the_content(); ?>	
					
					
					<div id="inline-1" class="hide">
						<h3 style="text-align: center;">Room Features</h3>
						<ul class="amenities">
							<?php $details = get_post_meta ($post->ID, 'cebo_details', true);
			             		$detailer = explode(',', $details);
								
								foreach($detailer as $d) {
 								echo "<li>" . $d . "</li>"; } ?>

							</ul>	
	
						</div>
		
										
					<?php endwhile; endif; wp_reset_query(); ?>	

				</div>

				<div class="sidebar room-details-gallery fr">
					
					<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
					
					
					<a class="button" target="_blank" href="<?php if(get_post_meta ($post->ID, 'cebo_booklink', true)) { echo get_post_meta ($post->ID, 'cebo_booklink', true); } else { echo get_option('cebo_genbooklink'); } ?>">RESERVE NOW</a>

					<!-- <a class="button" href="#inline-1" title="" rel="prettyPhoto">SEE ROOM FEATURES</a> -->
					
					<?php  if( has_shortcode( $post->post_content, 'gallery' ) ) {       ?>
					<div class="room-gallery">
						
						<ul>
							
							 <?php
							              
								    $gallery = get_post_gallery_images( $post->ID );
								
								
								                        
								    foreach( $gallery as $image ) {// Loop through each image in each gallery
								        $image_list .= '<li><a rel="prettyPhoto[gal]" href=" ' . str_replace('-150x150','',$image) . ' "><img src=" ' . $image  . ' "  style="width: 80px; height: 80px;" /></li></a>';
								    }                  
								    echo $image_list;                       
								                     
								?>
						</ul>
						
					
					
					<?php } ?>
					
					<?php endwhile; endif; wp_reset_query(); ?>	
						<ul class="thumbgal">
						
						<?php query_posts('post_type=specials&posts_per_page=4'); if(have_posts()) : while(have_posts()) : the_post(); 
						$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>

							<?php if(get_post_meta($post->ID, 'cebo_available_on_sidebar', true)) { ?>
							
								<li>
									
						
									<?php if(get_post_meta($post->ID, 'cebo_pricepoint', true)) { ?>
									
									<div class="from-price">
										<?php echo get_post_meta($post->ID, 'cebo_pricepoint', true); ?>
									</div>
									
									<?php } ?>
									
									<?php if(get_post_meta($post->ID, 'cebo_homethumb', true)) { ?>
									
									<a href="<?php the_permalink(); ?>"><img src="<?php echo get_post_meta($post->ID, 'cebo_homethumb', true); ?>"></a>
									
									<?php } else { ?>
									
									<a href="<?php the_permalink(); ?>"><img src="<?php echo $imgsrc[0]; ?>"></a>
									
									<?php } ?>
									
									<?php if(get_post_meta($post->ID, 'cebo_subtagline', true)) { ?>
									
									<h3><?php echo get_post_meta($post->ID, 'cebo_subtagline', true); ?></h3>
									
									
									<?php } ?>
									
									<div class="hover-effect">
										
										<?php if(get_post_meta($post->ID, 'cebo_tagline', true)) { ?>
										
										<h3><?php echo get_post_meta($post->ID, 'cebo_tagline', true); ?></h3>
										
										<?php } ?>
										
										
										<!-- , and Hotel Oceana Tote Bag., and breakfast at the Hotel. -->
										<a href="<?php the_permalink(); ?>"><i class="fa fa-chevron-right fa-lg"></i></a>
									</div>
								</li>

							<?php } ?>
							
							<?php endwhile; endif; wp_reset_query(); ?>	
							
						</ul>
					</div>

				</div>


			</div>
			
			
			<div class="section-header" style="border-top: 1px solid #ddd; margin-top: 60px; margin-bottom: 0; float: none; text-align: center;">
					
				<div class="fl" style="float: none; text-align: center; padding: 20px 0;">
	
					<h2 class="section-title fr" style="text-align: center; float: none; text-transform: uppercase;"><?php _e('More Rooms & Suites', 'cebolang'); ?></h2>
	
				</div>
	
			
	
			</div>
			

		</div>

	</div>
	
	<div class="clear"></div>

	<div id="room-details-slider" style="margin-top: -69px;">

		<div class='slideSelectors'>
			
			<div class='item selected'></div>
			<div class='item'></div>					
			<div class='item'></div>
			<div class='item'></div>
			<div class='item'></div>
		
		</div>

				
		<div class='iosSlider'>
		
			<div class='slider'>
				<?php $thisid = $post->ID; ?>
				
				
				<?php query_posts(array('post_type' => 'rooms', 'posts_per_page' => -1,  'post__not_in' => array($post->ID))); if(have_posts()) : while(have_posts()) : the_post(); ?>
				
				<div class='item item1 current'>
					<a href="<?php the_permalink(); ?>"><img src = '<?php echo get_post_meta($post->ID, 'cebo_homethumb', true); ?>' /></a>
					
					<h3><?php the_title(); ?></h3>
				</div>
				
				<?php endwhile; endif; wp_reset_query(); ?>	
				
			</div>
		
		</div>

		<div class="iosslider-prev"><i class="fa fa-chevron-left"></i></div>
		<div class="iosslider-next"><i class="fa fa-chevron-right"></i></div>

	</div>

	
					
<?php get_footer(); ?>