<?php
/**
		Attachment
 */

 get_header(); ?>
					
					<!-- ========================================>  PAGE CONTENT  <====================================== -->
					
					
					<article class="hs-content" id="pagecontent">
						<div class="hs-inner">
						
						
						<div class="contentarea">
						
						<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
  
						<?php if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "large"); ?>
      						<p class="attachment"><a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>" rel="attachment"><img src="<?php echo $att_image[0];?>" style="max-width: 100%;" class="attachment-medium" alt="<?php $post->post_excerpt; ?>" /></a>
     						 </p>
						<?php else : ?>  
      							<a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo wp_specialchars( get_the_title($post->ID), 1 ) ?>" rel="attachment"><?php echo basename($post->guid) ?></a>  
						<?php endif; ?>  
      						
      						  
      					<?php if ( !empty($post->post_excerpt) ) the_excerpt() ?>
      					
						
						<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'cebolang' ) . '&after=</div>') ?>

			
			
			<?php comments_template( '', true ); ?>
							
														
							<?php endwhile; endif; wp_reset_query(); ?>	
							
							</div>
							
						</div>
					</article>
					
					<!-- ========================================>  / PAGE CONTENT  <====================================== -->
					
					<!-- ========================================>  SIDEBAR  <====================================== -->
					
					
					<?php if(get_option('cebo_sidebar') == 'true') { ?>
					
						<?php get_sidebar(); ?>
					
					<? } ?>
					
					
					
					<?php if(get_option('cebo_instagram_column') == 'true') { ?>
					
					<!-- ========================================>  INSTAGRAM  <====================================== -->
						
						
					<?php include (TEMPLATEPATH . '/library/instagram.php'); ?>
					
				    <!-- ========================================>  / INSTAGRAM  <====================================== -->
				    
				    <? } ?>
					
					<?php if(get_option('cebo_twitter_column') == 'true') { ?>
					
					<!-- ========================================>  TWEETS  <====================================== -->
					
						<?php include (TEMPLATEPATH . '/library/tweets.php'); ?>		
							
					<!-- ========================================>  / TWEETS  <====================================== -->
					
					<? } ?>
				
					<?php $about = get_page_with_template('page_about');	
						if($about) { ?>
					
					<!-- ========================================>  ABOUT  <====================================== -->
					
					<?php include (TEMPLATEPATH . '/library/about.php'); ?>					
					
					<!-- ========================================>  / ABOUT  <====================================== -->
					
					<? } //if there is no page templage do not show ?>	
					
<?php get_footer(); ?>