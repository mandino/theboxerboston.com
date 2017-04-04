<?php 

/* Template Name: Gallery

*/
 get_header(); ?>





<?php if(get_post_meta($post->ID, 'cebo_fullpic', true)) { ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<div class="fullpic">

	<div class="slide-header">
		<a class="button" onclick="fbq('track', 'InitiateCheckout');" href="<?php if(get_post_meta ($post->ID, 'cebo_booklink', true)) { echo get_post_meta ($post->ID, 'cebo_booklink', true); } else { echo get_option('cebo_genbooklink'); } ?>"><?php _e('RESERVE NOW', 'cebolang'); ?></a>
	</div>
	<img src="<?php echo tt(get_post_meta($post->ID, 'cebo_fullpic', true), 1400, 350); ?>" alt="<?php echo get_custom_image_thumb_alt_text(get_post_meta($post->ID, 'cebo_fullpic', true), ''); ?>" />


</div>

<?php endwhile; endif; wp_reset_query(); ?>	

<?php } ?>


	<div id="page-content" class="section">

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
  						
  					query_posts(
					array(
					'post_type' => 'page',
					'post_parent' => $parents,
					'posts_per_page'=> 8,
					// 'post__not_in' => array($currency)
					
					)); if(have_posts()) : while(have_posts()) : the_post(); ?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
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
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; endif; wp_reset_query(); ?>	
			</ul>
			</div>
			
			<?php } } ?>
			<div class="wonderline"></div>
			<div class="post-content" style="width: 100%;">
			
				<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				
					<?php the_content(); ?>
					
					<div class="imagegal photos">
						
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
								
								<div class="clear"></div>
						</ul>
						
					<div class="clear"></div>
					</div>
				
				
				<?php endwhile; endif; wp_reset_query(); ?>	
<div class="clear"></div>
			</div>
			
			<div class="clear"></div>

		</div>

	</div>


<div class="clear"></div>
	
					
<?php get_footer(); ?>