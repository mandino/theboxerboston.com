<?php 

	/* Template Name: Blog */

	get_header();

?>
	
	<div id="rooms" class="section">

		<div class="container">

			<div class="section-header">

				<div class="fl">

					<div class="section-pre-title fl">Blog</div>
					<div class="section-header-divider fl"></div>
					<h1 class="section-title fr">The Boxer Boston Blog</h1>

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

			<div class="fl room-list catlist">
                <?php
                    if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb('
                    <p id="breadcrumbs">','</p>
                    ');
                    }
                    ?>    
				<ul>

					<?php

						$postcount = 1;
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

						$blogPage_query = new WP_Query(array(
							'post_type' => 'post',
							'posts_per_page' => 10,
							'paged' => $paged,
						));

						if ( $blogPage_query->have_posts() ) : while ( $blogPage_query->have_posts() ) : $blogPage_query->the_post();

							$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");

					?>

						<li class="room-box">
							<a href="<?php the_permalink(); ?>">
								<div class="fl" style="background-image: url(<?php if(get_post_meta($post->ID, 'cebo_homethumb', true)) { ?><?php echo tt(get_post_meta($post->ID, 'cebo_homethumb', true), 385, 330); ?><?php } else { ?><?php echo tt($imgsrc[0], 385, 330); ?><?php } ?>);"></div>
							</a>

							<div class="fr">

								<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
								<span><?php the_time('F jS, Y') ?>&nbsp;&nbsp;&bull;&nbsp;&nbsp;<?php $project_terms = wp_get_object_terms($post->ID, 'category'); if(!empty($project_terms)) { if(!is_wp_error( $project_terms )) { echo ''; $count = 0; foreach($project_terms as $term){ if($count > 0) { echo ', '; } echo '<a href="'.get_term_link($term->slug, 'category'). '">'.$term->name. '</a>';  $count++; }  } } ?></span>
								<p><?php echo excerpt(13); ?></p>

								<div class="room-list-buttons">
									<a class="button" href="<?php the_permalink(); ?>"><?php _e('Continue Reading', 'cebolang'); ?></a>
								</div>

							</div>
						</li>
					
					<?php $postcount++; endwhile; ?>

				</ul>

				<div class="navigation">
					<div rel="prev" class="alignleft"><?php next_posts_link( __(' Older Entries' , 'cebolang'), $blogPage_query->max_num_pages ) ?></div>
					<div rel="next" class="alignright"><?php previous_posts_link( __('Newer Entries', 'cebolang'), $blogPage_query->max_num_pages ) ?></div>
					<div class="clear"></div>
				</div>

					<?php else : ?>

						<p><?php _e('Sorry, no posts in this category' , 'cebolang'); ?></p>

					<?php endif; wp_reset_postdata(); ?>

			</div>

			<div class="sidebar fr" style="padding-top: 20px">

				<!-- widgetized  -->

					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) : ?><?php endif; ?>
		
				<!-- widgetized  -->	

			</div>

			<div class="clear"></div>

		</div>

		<div class="clear"></div>

	</div>

	<?php get_footer(); ?>