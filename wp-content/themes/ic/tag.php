<?php
/**
 * The template for displaying Tag Archive pages.

 */

get_header(); ?>

					
			<!-- ========================================>  PAGE CONTENT  <====================================== -->
			
			
			<article class="hs-content" id="categorycontent">
				<div class="hs-inner">

					<h1><?php printf( __( 'Tag Archives: %s', 'cebolang' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>
					
						<!-- FEATURED WORK -->
					            <ul class="details">
					            	
					            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
					            			
					       
					            		
					            		<li>
					            		
					            		
					            		<?php if(!sp_get_image() && !get_post_meta($post->ID, 'vimeo', $single = true) && !get_post_meta($post->ID, 'youtube', $single = true) && !get_post_meta($post->ID, 'embed', $single = true)) { ?>
					            				
					            					<div style="padding-top: 40px;"></div>
					            			<? } ?>
					            			
					            			
					            			<p class="catov"><?php $project_terms = wp_get_object_terms($post->ID, 'category'); if(!empty($project_terms)) { if(!is_wp_error( $project_terms )) { echo ''; $count = 0; foreach($project_terms as $term){ if($count > 0) { echo '+ '; } echo ''.$term->name. ' ';  $count++; }  }  ?><? } else { ?><?php foreach((get_the_category()) as $category) { echo $category->cat_name . "&nbsp;"; } } ?></p>
					            		
					            			<?php if(get_post_meta($post->ID, 'embed', $single = true)) { ?>
					            				
					            				<?php echo get_post_meta($post->ID, 'embed', $single = true); ?>
					            			
					            			<?php } elseif(get_post_meta($post->ID, 'youtube', $single = true)) { ?>
							
												<iframe width="745" height="410" src="http://www.youtube.com/embed/<?php echo get_post_meta($post->ID, 'youtube', $single = true); ?>"></iframe>	
												
												<? } elseif (get_post_meta($post->ID, 'vimeo', $single = true)) { ?>
												
												<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta($post->ID, 'vimeo', $single = true); ?>" width="745" height="410"></iframe>
												
												<?php } elseif(sp_get_image()) { ?>
												
												<?php if(sp_get_image(1)) { ?>   
												<?php $i = 0; while($i <= 1) : ?>
										    	<?php if(sp_get_image($i)) : ?>   
													
													<div class="slides">
														<div class="slides_container">
	    	

													
													<?php if(sp_get_image(1)): ?>   
													<?php $i = 0; while($i <= 5) : ?>
									            	<?php if(sp_get_image($i)) : ?>   
													
					            		
					            					<a href="<?php the_permalink(); ?>" class="featured"><img src="<?php bloginfo('template_directory'); ?>/tools/timthumb.php?src=<?php echo sp_get_image($i); ?>&amp;h=400&amp;w=745&amp;zc=1" alt="<?php wp_title(); ?>" /></a>
					            					
					            					
					            						<?php else : break; endif; ?>
										                <?php $i++; ?>
														<?php endwhile; ?>
										                <?php endif; ?>	 
					            					
					            					</div>

								            		</div>

												
												
												<?php else : break; endif; ?>
								                <?php $i++; ?>
												<?php endwhile; ?>
								                <?php } else { ?>
													
													<a href="<?php the_permalink(); ?>" class="featured"><img src="<?php echo sp_get_image(); ?>" width="746" alt="<?php wp_title(); ?>" /></a>
													
												<? } ?>
										                		

													
							
							                <?php } ?>
						            		
						        			<div class="type"><?php the_time('M d') ?></div>
						        			
						        			<a href="<?php the_permalink(); ?>"><h2><?php wp_title(); ?></h2></a>
						        			<small><?php _e('Written by', 'cebolang'); ?> <?php the_author(); ?></small>
						        			<p><?php echo excerpt(70); ?></p>
											
											<a href="<?php the_permalink(); ?>" class="summore"><?php _e('Read More', 'cebolang'); ?></a>
											
											<div class="commentson"><?php comments_popup_link('0', ' 1', ' %'); ?></div>

											    <a href="#"
												   class="likeling"
												   data-url="<?php the_permalink(); ?>"
												   data-via="<?php echo get_option('cebo_twitter'); ?>"
												   data-text="<?php wp_title(); ?>"
												   data-related="<?php echo get_option('cebo_twitter'); ?>"      
									   			   data-hashtags="">       
												    
												       <span class="count">0</span>
												       <span class="message">Tweet</span>
												       
												</a>
												<script type="text/javascript">
													var API_URL = "http://cdn.api.twitter.com/1/urls/count.json",
													TWEET_URL = "https://twitter.com/intent/tweet";
													    
													$(".likeling").each(function() {
													    var elem = $(this),
													    // Use current page URL as default link
													    url = encodeURIComponent(elem.attr("data-url") || document.location.href),
													    // Use page title as default tweet message
													    text = elem.attr("data-text") || document.title,
													    via = elem.attr("data-via") || "",
													    related = encodeURIComponent(elem.attr("data-related")) || "",
													    hashtags = encodeURIComponent(elem.attr("data-hashtags")) || "";
													    
													    // Set href to tweet page
													    elem.attr({
													        href: TWEET_URL + "?hashtags=" + hashtags + "&original_referer=" +
													                encodeURIComponent(document.location.href) + "&related=" + related +
													                "&source=tweetbutton&text=" + text + "&url=" + url + "&via=" + via,
													        target: "_blank"
													    });
													    
													    // Get count and set it as the inner HTML of .count
													    $.getJSON(API_URL + "?callback=?&url=" + url, function(data) {
													        elem.find(".count").html(data.count);
													    });
													});
												</script>		


						            	</li>
					            	
					            	
					            	<?php endwhile; ?>
					            	
					            <div class="navigation">
                        			<div class="alignleft"><?php next_posts_link('&laquo;' .   __(' Older Entries' , 'cebolang')) ?></div>
                        			<div class="alignright"><?php previous_posts_link( __('Newer Entries ', 'cebolang') .  '&raquo;') ?></div>
                        			<div class="clear"></div>
                    			</div>
								<?php else : endif; ?>
					            						            	
					           	</ul>
					          <!-- / FEATURED WORK -->						 
			</div>
					</article>
					
					<!-- ========================================>  / PAGE CONTENT  <====================================== -->
					
					<!-- recent posts -->
					
					
					
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
				
					<!-- ========================================>  ABOUT  <====================================== -->
					
					<?php include(TEMPLATEPATH . '/library/about.php'); ?>	
											
					<!-- ========================================>  / ABOUT  <====================================== -->
	
					
<?php get_footer(); ?>