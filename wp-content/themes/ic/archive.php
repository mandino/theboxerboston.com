<?php 
/* Template Name: Archive
*/
get_header(); ?>   
	<div id="rooms" class="section">
		<div class="container">
			<div class="section-header">
				<div class="fl">
					<h2 class="section-pre-title fl">Archives</h2>
					<div class="section-header-divider fl"></div>
					<h1 class="section-title fr">
						<?php if ( is_day() ) : ?><?php printf( __('%s'), get_the_date() ); ?>
						<?php elseif ( is_month() ) : ?><?php printf( __('%s'), get_the_date('F Y') ); ?>
						<?php elseif ( is_year() ) : ?><?php printf( __('%s'), get_the_date('Y') ); ?>
						<?php else : ?><?php _e( 'Blog Archives', 'cebolang' ); ?>
						<?php endif; ?>
					</h1>
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
				<ul>
					<?php if (have_posts()): while (have_posts()) : the_post(); $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
					<li class="room-box">
						<a href="<?php the_permalink(); ?>"><div class="fl" style="background-image: url(<?php if(get_post_meta($post->ID, 'cebo_homethumb', true)) { ?><?php echo get_post_meta($post->ID, 'cebo_homethumb', true); ?><?php } else { ?><?php echo $imgsrc[0]; ?><?php } ?>);"></div></a>
						<div class="fr">
							<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
							<span><?php the_time('F jS, Y') ?>&nbsp;&nbsp;&bull;&nbsp;&nbsp;<?php $project_terms = wp_get_object_terms($post->ID, 'category'); if(!empty($project_terms)) { if(!is_wp_error( $project_terms )) { echo ''; $count = 0; foreach($project_terms as $term){ if($count > 0) { echo ', '; } echo '<a href="'.get_term_link($term->slug, 'category'). '">'.$term->name. '</a>';  $count++; }  } } ?></span>
							<p><?php echo excerpt(13); ?></p>
							<div class="room-list-buttons">
								<a class="button" href="<?php the_permalink(); ?>"><?php _e('Continue Reading', 'cebolang'); ?></a>
							</div>
						</div>
					</li>
					<?php endwhile; ?>
				</ul>
				<div class="navigation">
                    <div class="alignleft"><?php next_posts_link( __(' Older Entries' , 'cebolang') ) ?></div>
                    <div class="alignright"><?php previous_posts_link( __('Newer Entries ', 'cebolang') ) ?></div>
                    <div class="clear"></div>
                </div>
				<?php else : ?>
					<p><?php _e('Sorry, no posts found for ' , 'cebolang'); ?>
						<?php if ( is_day() ) : ?><?php printf( __(), get_the_date() ); ?>
						<?php elseif ( is_month() ) : ?><?php printf( __(), get_the_date('F Y') ); ?>
						<?php elseif ( is_year() ) : ?><?php printf( __(), get_the_date('Y') ); ?>
						<?php else : ?><?php _e( 'this archive', 'cebolang' ); ?>
						<?php endif; ?>
					</p>
				<?php endif; ?>
			</div>
			<div class="sidebar fr" style="padding-top: 25px;">
				<!-- widgetized  -->
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) : ?><?php endif; ?>  
		     	<!-- widgetized  -->	
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
<?php get_footer(); ?>