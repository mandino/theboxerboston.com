<?php 

/* Template Name: Trip Advisor Review

*/
 get_header(); ?>





<?php if(get_post_meta($post->ID, 'cebo_fullpic', true)) { ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<div class="fullpic">

	<div class="slide-header">
		<a class="button" onclick="fbq('track', 'InitiateCheckout'); _gaq.push(['_trackEvent', 'Reserve', 'Reservation-button-banner', 'Reserve Now']);" href="<?php if(get_post_meta ($post->ID, 'cebo_booklink', true)) { echo get_post_meta ($post->ID, 'cebo_booklink', true); } else { echo get_option('cebo_genbooklink'); } ?>"><?php _e('RESERVE NOW', 'cebolang'); ?></a>
	</div>
	<img src="<?php echo tt(get_post_meta($post->ID, 'cebo_fullpic', true), 1400, 350); ?>" />


</div>

<?php endwhile; endif; wp_reset_query(); ?>	

<?php } ?>


	<div id="page-content" class="section">
		
		<div class="container">

			<div class="post-title section-header">

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

					<?php if(get_option('cebo_instagram')) { ?>
					
						<li class="instagram"><a href="//instagram.com/<?php echo get_option('cebo_instagram'); ?>" target="_blank"><i class="fa fa-instagram fa-2x"></i><span>twitter</span></a></li>
						
					<?php } ?>
					</ul>
	
				</div>
	
			</div>
			
			
			<?php if(is_subpage()) { ?>
			
			
			
			<div class="post-tags">
				<ul>
	
				<?php 
						$currency = $post->ID;
						$ancestors = get_post_ancestors($post->ID);
  						$parents = $ancestors[0];
  						$this_post = $post->ID;
  						
  					query_posts(
					array(
					'post_type' => 'page',
					'post_parent' => $parents,
					'posts_per_page'=> 8,
					// 'post__not_in' => array($currency)
					
					)); if(have_posts()) : while(have_posts()) : the_post(); ?>
				<li <?php if( $this_post == $post->ID ) { echo ' class="current"'; } ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; endif; wp_reset_query(); ?>	
			</ul>
			</div>
			
			<?php } else { ?>
			
				<?php $children = get_pages('child_of='.$post->ID);
				if( count( $children ) != 0 ) { ?>
			
			<div class="post-tags">
				<ul>
	
				<?php  $parent = $post->ID; query_posts(
					array(
					'post_type' => 'page',
					'post_parent' => $parent,
					'posts_per_page'=> 8
					
					)); if(have_posts()) : while(have_posts()) : the_post(); ?>
				<li <?php if( $this_post == $post->ID ) { echo ' class="current"'; } ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; endif; wp_reset_query(); ?>	
			</ul>
			</div>
			
			<?php } } ?>
			
					
			<div class="wonderline"></div>
			<div class="post-content fl">
			
				<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				
					<?php the_content(); ?>
				
				
				<?php endwhile; endif; wp_reset_query(); ?>	

				<!--TRIP ADVISOR WIDGET -->
				<div id="TA_ssnarrowcollectreview496" class="TA_ssnarrowcollectreview">
				<ul id="FdovVYLnC8Z" class="TA_links S7RVj5omjC">
				<li id="6Q9Lencl" class="2mdugPBCXGp">
				<a target="_blank" href="//www.tripadvisor.com/"><img src="https://www.tripadvisor.com/img/cdsi/img2/branding/150_logo-16124-2.png" alt="TripAdvisor"/></a>
				</li>
				</ul>
				</div>
				<script src="//www.jscache.com/wejs?wtype=ssnarrowcollectreview&amp;uniq=496&amp;locationId=499916&amp;lang=en_US&amp;border=true&amp;display_version=2"></script>
				<!--TRIP ADVISOR WIDGET -->
			</div>

			<div class="sidebar fr">
				
				<a class="button" onclick="fbq('track', 'InitiateCheckout'); _gaq.push(['_trackEvent', 'Reserve', 'Reservation-button-sidebar', 'Reserve Now']);" href="<?php if(get_post_meta ($post->ID, 'cebo_booklink', true)) { echo get_post_meta ($post->ID, 'cebo_booklink', true); } else { echo get_option('cebo_genbooklink'); } ?>"><?php _e('RESERVE NOW', 'cebolang'); ?></a>
				
				<?php
					$sidebarformid = get_the_ID();

					if($sidebarformid == 206){ ?>
				<p><strong>Get on the List. </br>The Finch Restaurant's VIP Email Signup.</br></strong></p>
				<p style="line-height:20px;margin-top: -5%;">Be the first to know about of all the exclusive events and happening at the Boxer's modern American restaurant, Finch.</span></p>

				<div class="signup-form">
					
					<form name="surveys" action="//zmaildirect.com/app/new/MjA0MjA0MTM2" method="get">  

						<input type="hidden" name="formId" value="MjA0MjA0MTM2">
						    <div>
						<input type="text" name="email" placeholder="Get on the List">
							</div>
						  <div>	
						<input type="submit" value="Sign Up">
							</div>
					</form>
	
				</div> 
				<?php } ?> 

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
										<a class="special-external" href="<?php the_permalink(); ?>"><i class="fa fa-chevron-right fa-lg"></i></a>
									</div>
									
								</li>

							<?php } ?>
							
							<?php endwhile; endif; wp_reset_query(); ?>
							
						
							
						</ul>
		
				</div>
			
			<div class="clear"></div>

		</div>

	</div>


<div class="clear"></div>
	
					
<?php get_footer(); ?>