<?php 

/* Template Name: Specials List Page

*/
 get_header('landing_page'); ?>


<?php if(get_post_meta($post->ID, 'cebo_fullpic', true)) { ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<div class="fullpic">

	<div class="slide-header">
		<a class="button" onclick="_gaq.push(['_link', this.href]);return false;" href="<?php if(get_post_meta ($post->ID, 'cebo_booklink', true)) { echo get_post_meta ($post->ID, 'cebo_booklink', true); } else { echo get_option('cebo_genbooklink'); } ?>"><?php _e('RESERVE NOW', 'cebolang'); ?></a>
	</div>
	<img src="<?php echo tt(get_post_meta($post->ID, 'cebo_fullpic', true), 1400, 350); ?>" alt="<?php echo get_custom_image_thumb_alt_text(get_post_meta($post->ID, 'cebo_fullpic', true), ''); ?>"
 />


</div>

<?php endwhile; endif; wp_reset_query(); ?>	

<?php } ?>

	<div id="rooms" class="section">
		
		<div class="container">
		
			
			<div class="post-content postwidth">
			     <?php
                    if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb('
                    <p id="breadcrumbs">','</p>
                    ');
                    }
                ?>
				<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				
					<?php the_content(); ?>
				
				<?php endwhile; endif; wp_reset_query(); ?>	
					<div class="imagegal thumbgal">
						
						<ul>
							
							 <?php  query_posts(
							array(
							'post_type' => 'specials',
							'posts_per_page'=> 4
							
							)); if(have_posts()) : while(have_posts()) : the_post(); 
							$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
							
							<li>
								
								<a href="<?php the_permalink(); ?>" class="overlink"></a>
					
								<?php if(get_post_meta($post->ID, 'cebo_pricepoint', true)) { ?>
								
								<div class="from-price">
									<?php echo get_post_meta($post->ID, 'cebo_pricepoint', true); ?>
								</div>
								
								<?php } ?>
								
								<?php if(get_post_meta($post->ID, 'cebo_homethumb', true)) { ?>
								
								<a href="<?php the_permalink(); ?>"><img src="<?php echo tt(get_post_meta($post->ID, 'cebo_homethumb', true), 262, 290); ?>" alt="<?php echo get_custom_image_thumb_alt_text(get_post_meta($post->ID, 'cebo_homethumb', true), ''); ?>"
 style="width: 100%"></a>
								
								<?php } else { ?>
								
								<a href="<?php the_permalink(); ?>"><img src="<?php echo tt($imgsrc[0], 262, 290); ?>" alt="<?php echo get_custom_image_thumb_alt_text('', get_post_thumbnail_id( $post->ID ));?>" style="width: 100%"></a>
								
								<?php } ?>
								
								<?php if(get_post_meta($post->ID, 'cebo_subtagline', true)) { ?>
								
								<h3><?php echo get_post_meta($post->ID, 'cebo_subtagline', true); ?></h3>
								
								
								<?php } ?>

								<div class="hover-effect">
									
									<?php if(get_post_meta($post->ID, 'cebo_tagline', true)) { ?>
									
									<h3><a href="<?php the_permalink(); ?>"><?php echo get_post_meta($post->ID, 'cebo_tagline', true); ?></a></h3>
									
									<?php } ?>
									
									
									<!-- , and Hotel Oceana Tote Bag., and breakfast at the Hotel. -->
									<a class="special-external" href="<?php the_permalink(); ?>"><i class="fa fa-chevron-right fa-lg"></i></a>
								</div>
								
							</li>
						
							
							<?php endwhile; endif; wp_reset_query(); ?>	
								
								<div class="clear"></div>
						</ul>
						
					<div class="clear"></div>
					</div>

			</div>

		</div>

	</div>

<div id="neighborhood" class="section">

		<!-- section containing the to do map -->

	<ul style="" class="right-links right" id="toggles">

		<li class="dine"><a class="linkerd active" href="<?php bloginfo('url'); ?>/?page_id=74" title="Dining">Eat</a></li>
		<li class="shop"><a class="linkerd active" href="<?php bloginfo('url'); ?>/?page_id=76" title="Dining">Shop</a></li>
		<li class="arts"><a class="linkerd active" href="<?php bloginfo('url'); ?>/?page_id=72" title="Dining">Culture</a></li>
		<li class="sights"><a class="linkerd active" href="<?php bloginfo('url'); ?>/?page_id=78" title="Dining">Landmarks</a></li>

	</ul>



		<a href="#features-1" id="link" class="navigateTo page-down"></a>


    <!-- begins map area -->
	<div id="maparea" style="width: 100%; height: 500px; position: relative;">
	</div>
    <!-- begins map area -->
</div>
	
					
<?php get_footer(); ?>