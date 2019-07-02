<?php
	/* TEMPLATE NAME: New Press Page*/

?>
	
	<?php get_header(); ?>
	<?php if(get_post_meta($post->ID, 'cebo_fullpic', true)) { ?>

	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

	<div class="fullpic">

		<div class="slide-header">
			<a class="button" target="_blank" href="<?php if(get_post_meta ($post->ID, 'cebo_booklink', true)) { echo get_post_meta ($post->ID, 'cebo_booklink', true); } else { echo get_option('cebo_genbooklink'); } ?>"><?php _e('RESERVE NOW', 'cebolang'); ?></a>
		</div>
		<img src="<?php echo tt(get_post_meta($post->ID, 'cebo_fullpic', true), 1400, 350); ?>" alt="<?php echo get_custom_image_thumb_alt_text(get_post_meta($post->ID, 'cebo_fullpic', true), ''); ?>" />


	</div>

	<?php endwhile; endif; wp_reset_query(); ?>	

	<?php } ?>
	<div class="container">
		<div class="post-title section-header">

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
				<?php if(get_option('cebo_spotify')) { ?>
				
					<li class="spotify"><a href="<?php echo get_option('cebo_spotify'); ?>" target="_blank"><i class="fa fa-spotify fa-2x"></i><span>spotify</span></a></li>
					
				<?php } ?>
				</ul>

			</div>

		</div>
		<div class="section">
			<div class="press-logo">

				<?php 
					$cnt = 0;
					
					if ( have_rows('press_logos') ) : while( have_rows('press_logos') ) : the_row();

						// SHOW/HIDE
						if ( $cnt < 8 ) {
							$image_hide_class = 'press-logo__item--displayed';
						} else {
							$image_hide_class = 'press-logo__item--hidden';
						}

						// IMAGE
						$press_logo = getImageValues( get_sub_field('press_logo') );

						// LINK TYPE
						if ( get_sub_field('press_type') == 'press_link' ) :
							$press_link_type = get_sub_field('press_link');
						elseif ( get_sub_field('press_type') == 'press_upload' ) :
							$press_link_type = get_sub_field('press_upload')['url'];
						else :
							$press_link_type = '';
						endif;
				?>
						<div class="press-logo__item valign-middle <?php echo $image_hide_class; ?>">
							<div class="press-logo__img" style="background-image: url('<?php echo $press_logo['url']; ?>');">
								<img src="<?php echo $press_logo['url']; ?>" alt="<?php echo $press_logo['alt']; ?>">
							</div>
							<?php if ( $press_link_type ) : ?>
								<a class="press-link" href="<?php echo $press_link_type; ?>" target="_blank"></a>
							<?php endif; ?>
							<p><?php the_sub_field('press_title'); ?></p>
						</div>

				<?php $cnt++; endwhile; endif; ?>

			</div>

			<?php if ( count( get_field('press_logos') ) > 8 ): ?>

				<div class="press_logo__view-more">
					<div class="button button--outline button__view-more">
						<span class="button__label">View More</span>
					</div>
				</div>

			<?php endif ?>

		</div>

	</div>

<?php get_footer(); ?>
<?php //endif ?>

