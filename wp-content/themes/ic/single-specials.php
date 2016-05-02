<?php 

/* Basic Single Post Template 

*/
 get_header(); ?>





<?php if(get_post_meta($post->ID, 'cebo_fullpic', true)) { ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<div class="fullpic">

	<div class="slide-header">
		<a class="button"  onclick="_gaq.push(['_link', this.href]);return false;" href="<?php if(get_post_meta ($post->ID, 'cebo_booklink', true)) { echo get_post_meta ($post->ID, 'cebo_booklink', true); } else { echo get_option('cebo_genbooklink'); } ?>"><?php _e('RESERVE NOW', 'cebolang'); ?></a>
	</div>
	<img src="<?php echo get_post_meta($post->ID, 'cebo_fullpic', true); ?>" />


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
					
						<li class="facebook"><a href="http://facebook.com/<?php echo get_option('cebo_facebook'); ?>" target="_blank"><i class="fa fa-facebook fa-2x"></i><span>facebook</span></a></li>
						
					<?php } ?>
					<?php if(get_option('cebo_twitter')) { ?>
					
						<li class="twitter"><a href="http://twitter.com/<?php echo get_option('cebo_twitter'); ?>" target="_blank"><i class="fa fa-twitter fa-2x"></i><span>twitter</span></a></li>
						
					<?php } ?>
					</ul>
	
				</div>
	
			</div>
			
			<div class="post-tags">
				<ul>
	
				<?php  query_posts(
					array(
					'post_type' => 'specials',
					'posts_per_page'=> 8
					
					)); if(have_posts()) : while(have_posts()) : the_post(); ?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; endif; wp_reset_query(); ?>	
			</ul>
			</div>
			
				<div class="wonderline"></div>
			
			<div class="post-content fl">
			
				<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				
					<?php the_content(); ?>
				
				
				<?php endwhile; endif; wp_reset_query(); ?>	

			</div>

			<div class="sidebar fr">
				
				<a class="button"  onclick="_gaq.push(['_link', this.href]);return false;" href="<?php if(get_post_meta ($post->ID, 'cebo_booklink', true)) { echo get_post_meta ($post->ID, 'cebo_booklink', true); } else { echo get_option('cebo_genbooklink'); } ?>"><?php _e('RESERVE NOW', 'cebolang'); ?></a>
				
				
				<ul class="thumbgal">
						
						<?php query_posts('post_type=specials&posts_per_page=3'); if(have_posts()) : while(have_posts()) : the_post(); 
						$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
							
							<li>
								
					
								<?php if(get_post_meta($post->ID, 'cebo_pricepoint', true)) { ?>
								
								<div class="from-price">
									<?php echo get_post_meta($post->ID, 'cebo_pricepoint', true); ?>
								</div>
								
								<?php } ?>
								
								<?php if(get_post_meta($post->ID, 'cebo_homethumb', true)) { ?>
								
								<a href="<?php the_permalink(); ?>"><img src="<?php echo tt(get_post_meta($post->ID, 'cebo_homethumb', true), 260, 292); ?>"></a>
								
								<?php } else { ?>
								
								<a href="<?php the_permalink(); ?>"><img src="<?php echo tt($imgsrc[0], 260, 292); ?>"></a>
								
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
							
							<?php endwhile; endif; wp_reset_query(); ?>
							
					
							
						</ul>
		
				</div>
			
			<div class="clear"></div>

		</div>

	</div>


<div class="clear"></div>
	
					
<?php get_footer(); ?>