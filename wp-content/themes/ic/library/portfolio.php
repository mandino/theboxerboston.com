<div id="portfolio" style="background: #e9e9e9;">
	
		
		<div class="container">
		
			<?php if(get_option('cebo_portfolioheader')) { ?>
			
				<h1 class="superheading"><?php echo get_option('cebo_portfolioheader'); ?></h1>
				
			<? } ?>
				
			<ul class="portfolio half">
				
			<?php $pcount = get_option('cebo_projectcount');
						
						query_posts(
						array(
								'post_type' => 'project',
								'posts_per_page' => $pcount
							));
							
							 if(have_posts()) : while(have_posts()) : the_post(); ?>		
			
					<li>
						
						<div class="he-wrap tpl2">
						
						
							<?php $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
							<img class="lazy" src="<?php bloginfo ('template_url'); ?>/images/loading.gif" data-original="<?php bloginfo('template_directory'); ?>/tools/timthumb.php?src=<?php echo $imgsrc[0]; ?>&amp;h=642&amp;w=580&amp;zc=1" alt="">
							
							<div class="he-view">
							

								<div class="bg a0" data-animate="fadeIn">								
								
									<div class="portfolio a0" data-animate="fadeInDown">
										
										<h1><?php the_title(); ?></h1>
										
										<i><?php $urlo = get_bloginfo('url'); $product_terms = wp_get_object_terms($post->ID, 'type'); if(!empty($product_terms)) { if(!is_wp_error( $product_terms )) { echo ''; $count = 0; foreach($product_terms as $term){ if($count > 0) { echo '+ '; } echo '<a href="'.get_term_link($term->slug, 'type').'">'.$term->name. ' </a>';  $count++; }  } } ?></i>
									</div>
									
									<div class="center-bar">
										
										<a href="<?php the_permalink(); ?>" aria-hidden="true" class="icon-link a0" data-animate="fadeInUp"></a>
										<a href="https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>&via=<?php get_option('cebo_twitter'); ?>" target="_blank" aria-hidden="true" class="icon-twitter a0" data-animate="fadeInUp"></a>
										<a href="http://www.facebook.com/sharer.php?s= 100&amp;p[title]=<?php the_title(); ?>&amp;p[url]=<?php the_permalink(); ?>&amp;p[images][0]=<?php echo $imgsrc[0]; ?>&amp;p[summary]=<?php echo excerpt(30); ?>" target="_blank" aria-hidden="true" class="icon-facebook a0" data-animate="fadeInUp"></a>
										
									</div>
								</div>
							</div>
						</div>
					
					</li>
				
				
				<?php endwhile; endif; wp_reset_query(); ?>		
					
						
				</ul>
				
			
			<div class="clear"></div>
			
			<?php $projects = get_page_with_template('page-portfolio');
				  $projecturl= get_permalink($projects);	
			?>
	        
	        <?php if($projects) { ?>
			
			<div class="blognav">
				<a class="holup" href="#portfolio"></a>
				<a class="gohead" href="<?php echo $projecturl; ?>?paged=2"></a>
			 </div>	
			 		        
	        <? } ?>
	        
	       
		
		
		</div>
	
	
	</div>
