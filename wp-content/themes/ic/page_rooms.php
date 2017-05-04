<?php 

/* Template Name: Rooms List Page

*/
 get_header(); ?>


<?php if(get_post_meta($post->ID, 'cebo_fullpic', true)) { ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<div class="fullpic">

	<div class="slide-header">
		<a class="button" onclick="fbq('track', 'InitiateCheckout'); ga('send', 'event', 'Reserve', 'Reservation-button-banner', 'Reserve Now'); _gaq.push(['_link', this.href]);return false;" href="<?php if(get_post_meta ($post->ID, 'cebo_booklink', true)) { echo get_post_meta ($post->ID, 'cebo_booklink', true); } else { echo get_option('cebo_genbooklink'); } ?>"><?php _e('RESERVE NOW', 'cebolang'); ?></a>
	</div>
	<img src="<?php echo tt(get_post_meta($post->ID, 'cebo_fullpic', true), 1400, 350); ?>" alt="<?php echo get_custom_image_thumb_alt_text(get_post_meta($post->ID, 'cebo_fullpic', true), ''); ?>" />


</div>

<?php endwhile; endif; wp_reset_query(); ?>	

<?php } ?>

	<div id="rooms" class="section">

		<div class="container">

			<div class="section-header">

				<div class="fl">

					<h1 class="section-title fr"><?php the_title(); ?></h1>

					<?php if(get_option('cebo_shorttitle')) { ?>

						<h2 class="section-pre-title fl"><?php echo get_option('cebo_shorttitle'); ?></h2>

						<div class="section-header-divider fl"></div>

					<?php } ?>

				</div>

				<div class="fr">
					
					<ul class="social-buttons">
					<?php if(get_option('cebo_facebook')) { ?>
					
						<li class="facebook"><a href="//facebook.com/<?php echo get_option('cebo_facebook'); ?>" target="_blank"><i class="fa fa-facebook fa-2x"></i><span>facebook</span></a></li>
						
					<?php } ?>
					<?php if(get_option('cebo_twitter')) { ?>
					
						<li class="twitter"><a href="//twitter.com/<?php echo get_option('cebo_twitter'); ?>" target="_blank"><i class="fa fa-twitter fa-2x"></i><span>twitter</span></a></li>
						
					<?php } ?>

					<?php if(get_option('cebo_instagram')) { ?>
					
						<li class="instagram"><a href="//instagram.com/<?php echo get_option('cebo_instagram'); ?>" target="_blank"><i class="fa fa-instagram fa-2x"></i><span>twitter</span></a></li>
						
					<?php } ?>
					</ul>
	
				</div>
	
			</div>

			<div class="wonderline"></div>

			<div class="post-content" style="padding: 20px;">
				<?php the_content(); ?>
			</div>

			<div class="room-list">
				
				<ul>
					
					<?php query_posts('post_type=rooms&posts_per_page=-1'); if(have_posts()) : while(have_posts()) : the_post(); 							  
					$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
					
					<li class="room-box">
						<div class="fl">

							<?php if(get_post_meta($post->ID, 'cebo_homethumb', true)) { ?>
						
								<img src="<?php echo tt(get_post_meta($post->ID, 'cebo_homethumb', true), 557, 400); ?>" alt="<?php echo get_custom_image_thumb_alt_text(get_post_meta($post->ID, 'cebo_homethumb', true), ''); ?>">
							
							<?php } else { ?>
							
								<img src="<?php echo tt($imgsrc[0], 557, 400); ?>" alt="<?php echo get_custom_image_thumb_alt_text('', get_post_thumbnail_id( $post->ID ));?>">
							
							<?php } ?>
								
							</div>

						<div class="fr">
							
							<h3><?php the_title(); ?></h3>

							<p><?php echo excerpt(67); ?></p>

							<div class="room-list-buttons">

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
								<!--<a class="button" href="<?php the_permalink(); ?>"><?php _e('More Info', 'cebolang'); ?></a>-->
							<?php } ?>

							</div>

						</div>
					</li>
					
					<?php endwhile; endif; wp_reset_query(); ?>	

				

				</ul>

			</div>

		</div>

	</div>
	
					
<?php get_footer(); ?>