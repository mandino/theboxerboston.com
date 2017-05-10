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
						<a class="button"  onclick="fbq('track', 'InitiateCheckout'); ga('send', 'event', 'Reserve', 'Reservation-button-banner', 'Reserve Now'); _gaq.push(['_link', this.href]);return false;" target="_blank" href="<?php if(get_post_meta ($post->ID, 'cebo_booklink', true)) { echo get_post_meta ($post->ID, 'cebo_booklink', true); } else { echo get_option('cebo_genbooklink'); } ?>"><?php _e('RESERVE NOW', 'cebolang'); ?></a>
					</div>
					<img src="<?php echo get_post_meta($post->ID, 'cebo_fullpic', true); ?>" alt="<?php echo get_custom_image_thumb_alt_text(get_post_meta($post->ID, 'cebo_fullpic', true), ''); ?>" />
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
					
					<div class="section-pre-title fl"><?php echo get_option('cebo_shorttitle'); ?></div>

					<div class="section-header-divider fl"></div>
					
					<?php } ?>

		
					<h1 class="section-title fr"><?php the_title(); ?></h1>
	
				</div>
	
				<div class="fr">
					
					<ul class="social-buttons">
					<?php if(get_option('cebo_facebook')) { ?>
					
						<li class="facebook"><a href="//facebook.com/<?php echo get_option('cebo_facebook'); ?>" target="_blank"><i class="fa fa-facebook fa-2x"></i><span>facebook</span></a></li>
						
					<?php } ?>
					<?php if(get_option('cebo_twitter')) { ?>
					
						<li class="twitter"><a href="//twitter.com/<?php echo get_option('cebo_twitter'); ?>" target="_blank"><i class="fa fa-twitter fa-2x"></i><span>twitter</span></a></li>
						
					<?php } ?>
					</ul>
	
				</div>
	
			</div>

			<div class="wonderline"></div>

			<div class="breadcrumbs"><a href="<?php echo get_permalink(49); ?>">All Rooms</a> > <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
			
			<div class="room-details-content">

				<div class="section-photos fl">
				
				
					<?php if(have_posts()) : while(have_posts()) : the_post(); $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
					
					<?php if(get_post_meta($post->ID, 'cebo_homethumb', true)) { ?>
						
						<img src="<?php echo get_post_meta($post->ID, 'cebo_homethumb', true); ?>" alt="<?php echo get_custom_image_thumb_alt_text(get_post_meta($post->ID, 'cebo_homethumb', true), ''); ?>">
						
					<?php } else { ?>
						
						<img src="<?php echo $imgsrc[0]; ?>" alt="<?php echo get_custom_image_thumb_alt_text('', get_post_thumbnail_id( $post->ID ));?>">
						
					<?php } ?>

					
					
					
					
					<?php the_content(); ?>	
					
					
					<div id="inline-1" class="hide">
						<h3 class="roomfeaturs-h3">Room Features</h3>
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
					
					
					<?php
						$btn_label = get_post_meta( $post->ID, 'rooms_button_label', true);
						$btn_link = get_post_meta( $post->ID, 'rooms_button_link', true);

						if(empty($btn_label) === false) { // has a value in rooms_button_label
							if (empty($btn_link) === false){
								$href = $btn_link;
							} else {
								$href = get_post_meta($post->ID, 'cebo_booklink', true) ? get_post_meta($post->ID, 'cebo_booklink', true) :  get_option('cebo_genbooklink');
							}
					?>
						<a class="button" onclick="fbq('track', 'InitiateCheckout');_gaq.push(['_link', this.href]);return false;" href="<?php echo $href ?>"><?php echo get_post_meta( $post->ID, 'rooms_button_label', true) ?></a>
					<?php } else { ?>
						<a class="button" onclick="fbq('track', 'InitiateCheckout');  ga('send', 'event', 'Booking', 'Reserve', '<?php echo get_the_title(); ?>'); _gaq.push(['_link', this.href]);return false;" href="<?php if(get_post_meta ($post->ID, 'cebo_booklink', true)) { echo get_post_meta ($post->ID, 'cebo_booklink', true); } else { echo get_option('cebo_genbooklink'); } ?>">Reserve Now</a>
					<?php } ?>

					<!-- <a class="button" href="#inline-1" title="" rel="prettyPhoto">SEE ROOM FEATURES</a> -->
					
					<?php  if( has_shortcode( $post->post_content, 'gallery' ) ) {       ?>
					<div class="room-gallery">
						
						<ul>
							 <?php
                                $gallery = get_post_gallery(get_the_ID(), false);
                                $args = array( 
                                    'post_type'      => 'attachment', 
                                    'posts_per_page' => -1, 
                                    'post_status'    => 'any', 
                                    'post__in'       => explode(',', $gallery['ids']) 
                                ); 
                                $attachments = get_posts($args);
                                foreach ($attachments as $attachment) {
                                    $image_alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
                                    if (empty($image_alt)) {
                                        $image_alt = $attachment->post_title;
                                    }
                                    if (empty($image_alt)) {
                                        $image_alt = $attachment->post_excerpt;
                                    }
                                    $image_title = $attachment->post_title;
                                    $image_url = wp_get_attachment_image_src( $attachment->ID, 'full' );
                                    $image_list .= '<li><a rel="prettyPhoto[gal]" href=" ' . str_replace('-150x150','',$image_url[0]) . ' "><img src="' . str_replace('-150x150','',$image_url[0]) . '"  alt="' . $image_alt . '"/></a></li>';
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
									
									<a href="<?php the_permalink(); ?>"><img src="<?php echo get_post_meta($post->ID, 'cebo_homethumb', true); ?>" alt="<?php echo get_custom_image_thumb_alt_text(get_post_meta($post->ID, 'cebo_homethumb', true), ''); ?>" ></a>
									
									<?php } else { ?>
									
									<a href="<?php the_permalink(); ?>"><img src="<?php echo $imgsrc[0]; ?>" alt="<?php echo get_custom_image_thumb_alt_text('', get_post_thumbnail_id( $post->ID ));?>" ></a>
									
									<?php } ?>
									
									<?php if(get_post_meta($post->ID, 'cebo_subtagline', true)) { ?>
									
									<h3><?php echo get_post_meta($post->ID, 'cebo_subtagline', true); ?></h3>
									
									
									<?php } ?>
									
									<div class="hover-effect">
										
										<?php if(get_post_meta($post->ID, 'cebo_tagline', true)) { ?>
										
										<h3><?php echo get_post_meta($post->ID, 'cebo_tagline', true); ?></h3>
										
										<?php } ?>
										
										
										<!-- , and Hotel Oceana Tote Bag., and breakfast at the Hotel. -->
										<a class="special-external" href="<?php the_permalink(); ?>"><i class="fa fa-chevron-right fa-lg"></i></a>
									</div>
								</li>

							<?php } ?>
							
							<?php endwhile; endif; wp_reset_query(); ?>	
							
						</ul>
					</div>

				</div>

			</div>
			
			<div class="section-header" style="border-top: 1px solid #ddd; margin-top: 60px; margin-bottom: 0; float: none; text-align: center;"></div>
			
		</div>

	</div>
	
	<div class="clear"></div>

					
<?php get_footer(); ?>