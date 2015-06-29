<?php get_header(); ?>



	<!-- ================= PRIMARY SLIDER HERE OPTIONAL ===================== -->

	<?php include (TEMPLATEPATH . '/library/featured.php'); ?>



	<div id="intro" class="section">
		
		<div class="container">

			<div class="section-header">
					
				<div class="fl">
					<?php if(get_option('cebo_shorttitle')) { ?>
					
					<h2 class="section-pre-title fl"><?php echo get_option('cebo_shorttitle'); ?></h2>

					<div class="section-header-divider fl"></div>
					
					<?php } ?>
					
					<?php if(get_option('cebo_longtitle')) { ?>
					
					<h2 class="section-title fr"><?php echo get_option('cebo_longtitle'); ?></h2>
					
					<?php } ?>
	
				</div>
	
				<div class="fr">
					
					<ul class="social-buttons">
					<?php if(get_option('cebo_facebook')) { ?>
					
						<li class="facebook"><a href="http://facebook.com/<?php echo get_option('cebo_facebook'); ?>" target="_blank"><i class="fa fa-facebook fa-2x"></i><span>facebook</span></a></li>
						
					<?php } ?>
					<?php if(get_option('cebo_twitter')) { ?>
					
						<li class="twitter"><a href="http://twitter.com/<?php echo get_option('cebo_twitter'); ?>" target="_blank"><i class="fa fa-twitter fa-2x"></i><span>twitter</span></a></li>
						
					<?php } ?>

					<?php if(get_option('cebo_instagram')) { ?>
					
						<li class="instagram"><a href="http://instagram.com/<?php echo get_option('cebo_instagram'); ?>" target="_blank"><i class="fa fa-instagram fa-2x"></i><span>twitter</span></a></li>
						
					<?php } ?>
					
					</ul>
	
				</div>
	
			</div>
		
		
		
		
		<!-- ================= INTRO SECTION ===================== -->





			<div class="section-photos" style="margin-bottom: 45px;">
				
				<ul>
				
					
					
					
					
					
					<!-- featured Room -->
				
					<?php query_posts('post_type=page&p=49'); if(have_posts()) : while(have_posts()) : the_post(); 							  
					$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
					
					<li>
						<?php if(get_post_meta($post->ID, 'cebo_homethumb', true)) { ?>
						
						<img src="<?php echo get_post_meta($post->ID, 'cebo_homethumb', true); ?>">
						
						<?php } else { ?>
						
						<img src="<?php echo $imgsrc[0]; ?>">
						
						<?php } ?>
						
						<h3><?php _e('Rooms & Suites', 'cebolang'); ?></h3>

						<div class="hover-effect">
							
							<?php if(get_post_meta($post->ID, 'cebo_tagline', true)) { ?>
							
							<a class="special-copy-link" href="<?php the_permalink(); ?>"><h3><?php echo get_post_meta($post->ID, 'cebo_tagline', true); ?></h3></a>
							
							<?php } ?>
							<br>
							<p>Rooms & Suites</p>
							
							<a class="special-external" href="<?php the_permalink(); ?>"><i class="fa fa-chevron-right fa-lg"></i></a>
						</div>
					</li>
					

					
					<?php endwhile; endif; wp_reset_query(); ?>	
					<?php query_posts('post_type=specials&posts_per_page=1'); if(have_posts()) : while(have_posts()) : the_post(); 
					$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
					


					
					<!-- Special -->
					
					<li>
					
						<?php if(get_post_meta($post->ID, 'cebo_pricepoint', true)) { ?>
						
						<div class="from-price">
							<?php echo get_post_meta($post->ID, 'cebo_pricepoint', true); ?>
						</div>
						
						<?php } ?>
						
						<?php if(get_post_meta($post->ID, 'cebo_homethumb', true)) { ?>
						
						<img src="<?php echo get_post_meta($post->ID, 'cebo_homethumb', true); ?>">
						
						<?php } else { ?>
						
						<img src="<?php echo $imgsrc[0]; ?>">
						
						<?php } ?>
						
						<?php if(get_post_meta($post->ID, 'cebo_subtagline', true)) { ?>
						
						<h3><?php echo get_post_meta($post->ID, 'cebo_subtagline', true); ?></h3>
						
						
						<?php } ?>
						
						<div class="hover-effect">
							
							<?php if(get_post_meta($post->ID, 'cebo_tagline', true)) { ?>
							
							<a class="special-copy-link" href="<?php the_permalink(); ?>"><h3><?php echo get_post_meta($post->ID, 'cebo_tagline', true); ?></h3></a>
							
							<?php } ?>
							
							
							<!-- , and Hotel Oceana Tote Bag., and breakfast at the Hotel. -->
							<a class="special-external" href="<?php the_permalink(); ?>"><i class="fa fa-chevron-right fa-lg"></i></a>
						</div>
					</li>

					<?php endwhile; endif; wp_reset_query(); ?>	
					<?php query_posts('post_type=page&p=47'); if(have_posts()) : while(have_posts()) : the_post(); 
					$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
					
					
					
					
					
					
					
					<!-- Amenities -->
					
					<li>
						<?php if(get_post_meta($post->ID, 'cebo_homethumb', true)) { ?>
						
						<img src="<?php echo get_post_meta($post->ID, 'cebo_homethumb', true); ?>">
						
						<?php } else { ?>
						
						<img src="<?php echo $imgsrc[0]; ?>">
						
						<?php } ?>
						
						<h3><?php _e('Hotel Overview', 'cebolang'); ?></h3>
						
						<div class="hover-effect">
							<?php if(get_post_meta($post->ID, 'cebo_tagline', true)) { ?>
							
							<a class="special-copy-link" href="<?php the_permalink(); ?>"><h3><?php echo get_post_meta($post->ID, 'cebo_tagline', true); ?></h3></a>
							
							<?php } ?>
							<br>
							<p><?php the_title(); ?></p>
							
							<a class="special-external" href="/?page_id=47"><i class="fa fa-chevron-right fa-lg"></i></a>
						</div>
					</li>
					
					<?php endwhile; endif; wp_reset_query(); ?>	
					
					
					<div class="clear"></div>
					
				</ul>



			</div>
			
			<div class="welcometext">
			
				<?php query_posts('post_type=page&p=80'); if(have_posts()) : while(have_posts()) : the_post(); 	?>
				
				<h1><?php wp_title(); ?></h1>
				
				<?php the_content(); ?>
				
				
				<?php endwhile; endif; wp_reset_query(); ?>	
			
			</div>

			<div class="quote">
	
				<a class="quote-nav quote-next"><i class="fa fa-angle-right"></i></a>
				<a class="quote-nav quote-prev"><i class="fa fa-angle-left"></i></a>
				
				<div class="ico-quote quote-left fl"></div>
				
				<?php 

					query_posts('post_type=testimonials&posts_per_page=4'); 
					if(have_posts()) : 

				?>

					<div id="cbp-qtrotator" class="cbp-qtrotator">

						<?php while(have_posts()) : the_post(); ?>

							<div class="cbp-qtcontent">
								<blockquote>
								  <p><?php echo excerpt(40); ?></p>
								  <footer><?php wp_title(); ?></footer>
								</blockquote>
							</div>
						
						<?php endwhile; ?>	

					</div>

				<?php endif; wp_reset_query(); ?>
				
				</div>

				<div class="ico-quote quote-right fr"></div>
	
			</div>

		</div>

	</div>
	


		

	<div id="neighborhood" class="section">
	
		<!-- section containing the to do map -->	
		
	<ul style="" class="right-links right" id="toggles">
										
		<li class="dine"><a class="linkerd active" href="/?page_id=74" title="Dining">Eat</a></li>
		<li class="shop"><a class="linkerd active" href="/?page_id=76" title="Dining">Shop</a></li>
		<li class="arts"><a class="linkerd active" href="/?page_id=72" title="Dining">Culture</a></li>
		<li class="sights"><a class="linkerd active" href="/?page_id=78" title="Dining">Landmarks</a></li>
			
	</ul>

		<a href="#features-1" id="link" class="navigateTo page-down"></a>
						
						
    <!-- begins map area -->
	<div id="maparea" style="width: 100%; height: 500px; position: relative;">
	</div>
    <!-- begins map area -->
    

		<div class="container">
			<div class="section-header">
				
				<div class="fl">
	
					<h2 class="section-pre-title fl">Neighborhood</h2>
				
					<div class="section-header-divider fl"></div>
		
					<h2 class="section-title fr">Boston Activities and Events</h2>
	
				</div>
		
			</div>
	
			<div class="neighborhood-sliders">
				
				<div class="fl">
					<div class="slides-mini">
					
						<?php $query = new WP_Query( array( 'post_type' => 'tribe_events','eventDisplay' => 'upcoming', 'posts_per_page' => 4
					) ); if($query->have_posts()) : while($query->have_posts()) : $query->the_post(); $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
					
					
						<div>
							
							
							<?php 
								$shortdater = tribe_get_start_date($post->ID, true, 'M');
								$shortdaterend = tribe_get_end_date($post->ID, true, 'M');
							    $shortdaterz = substr($shortdater, 0, 3);
							    $shortdaterendz = substr($shortdaterend, 0, 3);

							    $shortdate = tribe_get_start_date($post->ID, true, 'j');
								$shortdateend = tribe_get_end_date($post->ID, true, 'j');
							    $shortdatez = substr($shortdate, 0, 2);
							    $shortdateendz = substr($shortdateend, 0, 2);
							?>

							<?php if( tribe_event_is_all_day() == true ) { ?>

								<div class="post-date post-date-start" style="right: 20px;">     
									<span class="date-month"><?php echo $shortdaterz; ?></span>
									<span class="date-number"><?php echo $shortdatez; ?></span>
								</div>

							<?php } else { ?>	

								<div class="post-date post-date-start">     
									<span class="date-month"><?php echo $shortdaterz; ?></span>
									<span class="date-number"><?php echo $shortdatez; ?></span>
								</div>

								<div style="right: 109px; padding: 10px 0;" class="post-date"><span style="font-size: 30px; line-height: 2.5;">-</span></div>

								<div class="post-date">
									<span class="date-month"><?php echo $shortdaterendz; ?></span>
									<span class="date-number date-number-end"><?php echo $shortdateendz; ?></span>
								</div>

							<?php } ?>							

							<a href="<?php the_permalink(); ?>"><img src="<?php echo tt($imgsrc[0], 540, 292);; ?>"></a>
							<div class="ptit"> 
								<a href="<?php the_permalink(); ?>"><span><?php the_title_char_limit(40); ?></span></a>
							</div>

						</div>
						
						<?php endwhile; endif; wp_reset_query(); ?>	
						
						
						
					
						<a href="#" class="slidesjs-previous slidesjs-navigation"><i class="fa fa-chevron-left fa-lg"></i></a>
						<a href="#" class="slidesjs-next slidesjs-navigation"><i class="fa fa-chevron-right fa-lg"></i></a>

					</div>

					<!-- <a class="slidesjs-previous slidesjs-navigation" href="#"><i class="icon-chevron-left icon-large"></i></a> -->

					<h3><?php _e('Upcoming events', 'cebolang'); ?></h3>
				</div>

				<div class="fr">
					<div class="slides-mini">
					
						<?php query_posts('post_type=post&posts_per_page=4&cat=-10'); if(have_posts()) : while(have_posts()) : the_post(); 
						$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
						
						
						<div>
							<a href="<?php the_permalink(); ?>"><img src="<?php echo tt($imgsrc[0], 540, 292); ?>"></a>
							<div class="ptits"> 
								<a href="<?php the_permalink(); ?>"><span><?php the_title_char_limit(40); ?></span></a>
							</div>
						</div>
						
						
						<?php endwhile; endif; wp_reset_query(); ?>	

						<a href="#" class="slidesjs-previous slidesjs-navigation"><i class="fa fa-chevron-left fa-lg"></i></a>
						<a href="#" class="slidesjs-next slidesjs-navigation"><i class="fa fa-chevron-right fa-lg"></i></a>
					</div>

					<h3><?php _e('From our blog', 'cebolang'); ?></h3>
				</div>
	
			</div>
		</div>

	</div>
	
	
<?php include (TEMPLATEPATH . '/library/super-map.php'); ?>
<?php get_footer(); ?>
