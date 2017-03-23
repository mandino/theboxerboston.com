<div id="blogsection">
	
		
		<div class="container">
		
			
			<?php if(get_option('cebo_blogheader')) { ?>
			
				<h1 class="superheading"><?php echo get_option('cebo_blogheader'); ?></h1>
				
			<? } ?>
			
			
			
			<?php 
			    $postcount=1;
			    while(have_posts()) : the_post();
			           
			        if( ($postcount % 2) == 0 ) $post_class = ' lefty';
			        else $post_class = ' righty'; 
			        
			        $attachments = get_children(
					    array(
					        'post_type' => 'attachment',
					        'post_mime_type' => 'image',
					        'post_parent' => $post->ID
					    ));
					
					$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");
			        ?>
			        
			
			
			
			<div class="blogolo <?php if(count($attachments) == 0 && !get_post_meta($post->ID, 'cebo_youtube', $single = true) && !get_post_meta($post->ID, 'cebo_vimeo', $single = true) && !$imgsrc) { echo 'fuller'; } ?>">
			
			
				<div class="he-wrap tpl2">
				
				
				
				<?php if(count($attachments) == 0 && !get_post_meta($post->ID, 'cebo_youtube', $single = true) && !get_post_meta($post->ID, 'cebo_vimeo', $single = true) && !$imgsrc) { ?>
			
			
				<!-- emptiness in the case of no pic, no youtube and no vimeo -->
				
			
				<? } else { ?>
				
				
					<div class="blogpiccontainer <?php echo $post_class; ?>">
					
						<?php if(get_post_meta($post->ID, 'cebo_attachonly', $single = true) == 'on') { ?>
					
									<a href="<?php the_permalink(); ?>"><img class="lazy" src="<?php bloginfo('template_url'); ?>/images/loading.gif" data-original="<?php bloginfo('template_directory'); ?>/tools/timthumb.php?src=<?php echo $imgsrc[0]; ?>&amp;h=394&amp;w=720&amp;zc=1" alt="<?php the_title(); ?>"></a>
								
								<?php } elseif(get_post_meta($post->ID, 'cebo_youtube', $single = true)) { ?>
						
							<div class="video-container">
							
								<iframe width="720" height="394" src="//www.youtube.com/embed/<?php echo get_post_meta($post->ID, 'cebo_youtube', $single = true); ?>" allowfullscreen></iframe>
								
							</div>
							
							
						<? } elseif (get_post_meta($post->ID, 'cebo_vimeo', $single = true)) { ?>
							
							<div class="video-container">
						
								<iframe src="//player.vimeo.com/video/<?php echo get_post_meta($post->ID, 'cebo_vimeo', $single = true); ?>" width="720" height="394"></iframe>
							
							</div>
						
						<?php } elseif(count($attachments) > 1) { ?>
						
						
							<div class="flexslider">
							  <ul class="slides">
	
								<?php if(sp_get_image(1)) : ?>   
								<?php $i = 0; while($i <= 4) : ?>
							    <?php if(sp_get_image($i)) : ?>  
							    	
										<li> <img src="<?php bloginfo('template_directory'); ?>/tools/timthumb.php?src=<?php echo sp_get_image($i) ?>&amp;h=394&amp;w=720&amp;zc=1" alt="<?php the_title(); ?>"/></li>
								
								<?php else : break; endif; ?>
					            <?php $i++; ?>
								<?php endwhile; ?>
					            <?php endif; ?>	 
							 	
							 	
							 	</ul>
							
							</div>
						
						<? } else { ?>
						
							<a href="<?php the_permalink(); ?>"><img class="lazy" src="<?php bloginfo('template_url'); ?>/images/loading.gif" data-original="<?php bloginfo('template_directory'); ?>/tools/timthumb.php?src=<?php echo $imgsrc[0]; ?>&amp;h=394&amp;w=720&amp;zc=1" alt="<?php the_title(); ?>"></a>
							
						<? } ?>
						
						
					</div>
					
				
				<? } ?>	
					
					<div class="blogcontent <?php if( ($postcount % 2) == 0 ) { echo 'righty'; } else { echo 'lefty'; } ?> <?php if(count($attachments) == 0 && !get_post_meta($post->ID, 'cebo_youtube', $single = true) && !get_post_meta($post->ID, 'cebo_vimeo', $single = true) && !$imgsrc ) { echo 'fuller'; } ?>">
					
						<div class="blogcontain">
						
							<div class="aligner">
							
							
							
								<h3><?php the_title(); ?></h3>
							
								<?php if(count($attachments) == 0 && !get_post_meta($post->ID, 'cebo_youtube', $single = true) && !get_post_meta($post->ID, 'cebo_vimeo', $single = true) && !$imgsrc ) { ?>
								
								<p><?php echo excerpt(80); ?></p>
								
								<? } else { ?>
								
								<p><?php echo excerpt(40); ?></p>
								
								<? } ?>
								
								
								<div class="he-view">
								
									<div class="bg a0" data-animate="fadeIn">								
	
										<div class="center-bar">
											<a href="<?php the_permalink(); ?>" aria-hidden="true" class="icon-link a0" data-animate="fadeInUp"></a>
										<a href="https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>&via=<?php get_option('cebo_twitter'); ?>" target="_blank" aria-hidden="true" class="icon-twitter a0" data-animate="fadeInUp"></a>
										<a href="//www.facebook.com/sharer.php?s= 100&amp;p[title]=<?php the_title(); ?>&amp;p[url]=<?php the_permalink(); ?>&amp;p[images][0]=<?php echo $imgsrc[0]; ?>&amp;p[summary]=<?php echo excerpt(30); ?>" target="_blank" aria-hidden="true" class="icon-facebook a0" data-animate="fadeInUp"></a>
											
										</div>
									</div>
							
								</div>	
							
							</div>
							
						
						
						</div>
						
					</div>
					
					
					
				</div>
				
			</div>
			
			
			
			
			
			<!-- end blog post -->
			
			<div class="clear"></div>
			
			
			<?php $postcount++; endwhile; wp_reset_query(); ?>	
			
			
			<?php $blogger = get_page_with_template('page_blog');
				  $bloggerurl= get_permalink($blogger);	
			?>
	        
	        <?php if($blogger) { ?>
	        
	        <div class="blognav">
				<a class="holup" href="#blogsection"></a>
				<a class="gohead" href="<?php echo $bloggerurl; ?>?paged=2"></a>
				
				<div class="clear"></div>
			 </div>
			 
			
	        
	        <? } ?>
	        
	        
					
		
		</div>
	
	
	</div>