<?php 

/* Template Name: Neighborhood Guide

*/
 get_header(); ?>


 	<?php if (is_page(62)) { ?>

	  	<ul class="right-links right" id="toggles">		
			<li class="dine"><a onClick="location.href='<?php echo get_permalink( $post->post_parent ); ?>/eat'" class="linkerd2 active" href="<?php bloginfo('url'); ?>/echo-dining" title="Dining">Eat</a></li>
			<li class="shop"><a onClick="location.href='<?php echo get_permalink( $post->post_parent ); ?>/shop'" class="linkerd2 active" href="<?php bloginfo('url'); ?>/echo-shop" title="Dining">Shop</a></li>
			<li class="arts"><a onClick="location.href='<?php echo get_permalink( $post->post_parent ); ?>/culture'" class="linkerd2 active" href="<?php bloginfo('url'); ?>/echo-culture" title="Dining">Culture</a></li>
			<li class="sights"><a onClick="location.href='<?php echo get_permalink( $post->post_parent ); ?>/landmarks'" class="linkerd2 active" href="<?php bloginfo('url'); ?>/echo-sights" title="Dining">Landmarks</a></li>
		</ul>

	<?php } else { 

		$com_link = basename(get_permalink());
		
	?>
						
		<ul class="right-links right" id="toggles">						
			<li class="dine"><a onClick="location.href='<?php echo get_permalink( $post->post_parent ); ?>/eat'" data-id="eatl" class="linkerd <?php if ($com_link == 'eat') { ?>active<?php } ?>" href="/echo-dining" title="Dining">Eat</a></li>
			<li class="shop"><a onClick="location.href='<?php echo get_permalink( $post->post_parent ); ?>/shop'" data-id="shopl" class="linkerd <?php if ($com_link == 'shop') { ?>active<?php } ?>" href="/echo-shop" title="Dining">Shop</a></li>
			<li class="arts"><a onClick="location.href='<?php echo get_permalink( $post->post_parent ); ?>/culture'" data-id="cult" class="linkerd <?php if ($com_link == 'culture') { ?>active<?php } ?>" href="/echo-culture" title="Dining">Culture</a></li>
			<li class="sights"><a onClick="location.href='<?php echo get_permalink( $post->post_parent ); ?>/landmarks'" data-id="landl" class="linkerd <?php if ($com_link == 'landmarks') { ?>active<?php } ?>" href="/echo-sights" title="Dining">Landmarks</a></li>
		</ul>

	<?php } ?>					
						<a href="#features-1" id="link" class="navigateTo page-down"></a>
						
						
    <!-- begins map area -->
	<div id="maparea" class="mapheight">
	
	
	
	</div>
    <!-- begins map area -->


<div id="neighborhood-guide" class="section nguide">

		<div class="container">

			<div class="section-header">

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
		
		</div>
			
		<div id="tabs-wrapper" class="tabs-wrapper">
			
			<?php if (is_page(62)) { ?>

			<div class="container">

				<div class="tabs-container">

					<div class="container">
						<div class="neighbor-content">
							<?php the_content(); ?>
						</div>
					</div>

				</div>

				<div class="category-neighbor">
			
					<!-- ECHO EAT -->
					<?php
						$query_eat = new WP_Query('post_type=page&p=74');
						if ($query_eat->have_posts()) : while ($query_eat->have_posts()) : $query_eat->the_post();
						$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");
					?>

							<div id="mneighbor" style="background-image: url(<?php echo $imgsrc[0]; ?>); margin-top: 10px; margin-right: 10px;">
								<a data-id="eatl" href="<?php echo get_permalink( $post->post_parent ); ?>/eat">
									<span class="def-title"><?php echo get_post_meta($post->ID, 'cebo_popout_title', true); ?></span>
									<span class="hover-title"><?php echo get_post_meta($post->ID, 'cebo_popout_welcome', true); ?></span>
								</a>		
							</div>

					<?php endwhile; endif; wp_reset_postdata(); ?>


					<!-- ECHO SHOP -->
					<?php
						$query_eat = new WP_Query('post_type=page&p=76');
						if ($query_eat->have_posts()) : while ($query_eat->have_posts()) : $query_eat->the_post();
						$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");
					?>
						<div id="mneighbor" style="background-image: url(<?php echo $imgsrc[0]; ?>); margin-top: 10px;">
							<a data-id="shopl" href="<?php echo get_permalink( $post->post_parent ); ?>/shop">
								<span class="def-title"><?php echo get_post_meta($post->ID, 'cebo_popout_title', true); ?></span>
								<span class="hover-title"><?php echo get_post_meta($post->ID, 'cebo_popout_welcome', true); ?></span>
							</a>
						</div>
					<?php endwhile; endif; wp_reset_postdata(); ?>


					<!-- ECHO CULTURE -->
					<?php
						$query_eat = new WP_Query('post_type=page&p=72');
						if ($query_eat->have_posts()) : while ($query_eat->have_posts()) : $query_eat->the_post();
						$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");
					?>
						<div id="mneighbor" style="background-image: url(<?php echo $imgsrc[0]; ?>); margin-right: 10px; margin-top: 10px;">
							<a data-id="cult" href="<?php echo get_permalink( $post->post_parent ); ?>/culture">
								<span class="def-title"><?php echo get_post_meta($post->ID, 'cebo_popout_title', true); ?></span>
								<span class="hover-title"><?php echo get_post_meta($post->ID, 'cebo_popout_welcome', true); ?></span>
							</a>	
						</div>
					<?php endwhile; endif; wp_reset_postdata(); ?>


					<!-- ECHO LANDMARK -->
					<?php
						$query_eat = new WP_Query('post_type=page&p=78');
						if ($query_eat->have_posts()) : while ($query_eat->have_posts()) : $query_eat->the_post();
						$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");
					?>
						<div id="mneighbor" style="background-image: url(<?php echo $imgsrc[0]; ?>); margin-top: 10px;">
							<a data-id="landl" href="<?php echo get_permalink( $post->post_parent ); ?>/landmarks">
								<span class="def-title"><?php echo get_post_meta($post->ID, 'cebo_popout_title', true); ?></span>
								<span class="hover-title"><?php echo get_post_meta($post->ID, 'cebo_popout_welcome', true); ?></span>
							</a>
						</div>
					<?php endwhile; endif; wp_reset_postdata(); ?>

				</div> 
			</div>

			<?php } else { ?>
			
			<div id="tabs-wrapper" class="tabs-wrapper">
		
			<ul class="tabs">
				<li class="eat"><a id="eatl" href="<?php echo get_permalink( $post->post_parent ); ?>/eat">Eat</a></li>
				<li class="shop"><a id="shopl" href="<?php echo get_permalink( $post->post_parent ); ?>/shop">Shop</a></li>
				<li class="culture"><a id="cult" href="<?php echo get_permalink( $post->post_parent ); ?>/culture">Culture</a></li>
				<li class="landmarks"><a id="landl" href="<?php echo get_permalink( $post->post_parent ); ?>/landmarks">Landmarks</a></li>
			</ul>
				
				<div class="tabs-container">
					
					
					<div id="eat" class="tab-content">
						
						<div class="container">
							
							
							<?php query_posts('post_type=page&p=74'); if(have_posts()) : while(have_posts()) : the_post(); ?>
							
							<?php the_content(); ?>
							
							<?php endwhile; endif; wp_reset_query(); ?>	
							
							<div class="clear"></div>
							
							
							<div class="widebox">
							
								<h2>Dining Around Town</h2>
								
								<div class="townbox">
								
									<?php query_posts('post_type=page&p=74'); if(have_posts()) : while(have_posts()) : the_post(); ?>
									
									
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
									
									<?php endwhile; endif; wp_reset_query(); ?>	
									
								</div>
								
							</div>
							
						</div>

					</div>
					
					
					
					
					
					
					
					
					<!-- begin shopping tab -->
					
					
					
					
				
					<div id="shop" class="tab-content">
						
						<div class="container">
							
								
							<?php query_posts('post_type=page&p=76'); if(have_posts()) : while(have_posts()) : the_post(); ?>
							
							<?php the_content(); ?>
							
							<?php endwhile; endif; wp_reset_query(); ?>	

							<div class="clear"></div>
							
							
							<div class="widebox">
							
								<h2>Shopping Around Town</h2>
								
								<div class="townbox">
								
									<?php query_posts('post_type=page&p=76'); if(have_posts()) : while(have_posts()) : the_post(); ?>
									
									
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
									
									<?php endwhile; endif; wp_reset_query(); ?>	
									
									</div>
								
								</div>
							
							</div>

					</div>
					
					
					
					
					
					
					<!-- begin sight seeing tab -->
					
					
					
					
				
					<div id="culture" class="tab-content">
						
						<div class="container">
							
								
							<?php query_posts('post_type=page&p=72'); if(have_posts()) : while(have_posts()) : the_post(); ?>
							
							<?php the_content(); ?>
							
							<?php endwhile; endif; wp_reset_query(); ?>	

							<div class="clear"></div>
							
							
							<div class="widebox">
							
								<h2>Arts & Culture Around Town</h2>
								
								<div class="townbox">
								
									<?php query_posts('post_type=page&p=72'); if(have_posts()) : while(have_posts()) : the_post(); ?>
									
									
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
									
									<?php endwhile; endif; wp_reset_query(); ?>	
									
									</div>
								
								</div>
							
							</div>

					</div>
					
					
					
					
					
					<!-- begin arts tab -->
					
					
					
					
				
					<div id="landmarks" class="tab-content">
						
						<div class="container">
							
								
							<?php query_posts('post_type=page&p=78'); if(have_posts()) : while(have_posts()) : the_post(); ?>
							
							<?php the_content(); ?>
							
							<?php endwhile; endif; wp_reset_query(); ?>	

							<div class="clear"></div>
							
							
							<div class="widebox">
							
								<h2>Things to See Around town</h2>
								
								<div class="townbox">
								
									<?php query_posts('post_type=page&p=78'); if(have_posts()) : while(have_posts()) : the_post(); ?>
									
									
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
									
									<?php endwhile; endif; wp_reset_query(); ?>	
									
									</div>
								
								</div>
							
							</div>
					</div>	

				</div>
			</div>

			<?php } ?>

			
			<div class="clear"></div>
			
			
		<div class="container">
		
		
			<div class="upcoming-events">

				<h2>Upcoming Events</h2>

				<div class="upcoming-calendar fl tribe_mini_calendar_widget">
					
					 <!-- widgetized  -->

		     		<?php if ( !function_exists('dynamic_sidebar')
							|| !dynamic_sidebar('Footer Column 2') ) : ?>
					<?php endif; ?>  

					<a class="all-events" href="<?php bloginfo('url'); ?>/events" style="text-align: center; margin-top: 10px; display: inline-block;">See all events</a>
		
			     	<!-- widgetized  -->		
								
				</div>

				<div class="fr">
					<ul>
					
						
						
		            	<?php $count = 1; $query = new WP_Query( array( 'post_type' => 'tribe_events','eventDisplay' => 'upcoming', 'posts_per_page' => 4
							) ); if($query->have_posts()) : while($query->have_posts()) : $query->the_post(); $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
						
						<li<?php if($count == 2 || $count == 4) { ?> class="even"<?php } ?>>
							
							
							<a href="<?php the_permalink(); ?>"><img src="<?php echo tt($imgsrc[0], 275, 178); ?>"  alt="<?php echo get_custom_image_thumb_alt_text('', get_post_thumbnail_id( $post->ID ));?>"/>
							
							
							<?php $shortdater = tribe_get_start_date($post->ID, true, 'M'); $shortdaterz = substr($shortdater, 0, 3);  ?>
							
							<?php $shortdate = tribe_get_start_date($post->ID, true, 'j'); $shortdatez = substr($shortdate, 0, 2);  ?>
							
							<div class="event-date"><?php echo $shortdaterz; ?> <span><?php echo $shortdatez; ?></span></div>
							<div class="event-description">
								<p><?php the_title(); ?></p>
							</div>
							
							</a>
						</li>
						
						
						<?php $count++;  endwhile; endif; wp_reset_query(); ?>	
						

					</ul>
				</div>

			</div>
			
			<div class="clear"></div>
		
		</div>
		
		<div class="heater">
					
			<div class="container">

				<div class="whats-hot">
	
					<h2>What's Hot</h2>
	
					<div>
						<ul>
						
							<?php query_posts('post_type=post&posts_per_page=2&offset=1&cat=-10'); if(have_posts()) : while(have_posts()) : the_post(); $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
							
							<li>
								<a href="<?php the_permalink(); ?>"><img src='<?php echo tt($imgsrc[0], 278, 161); ?>' alt="<?php echo get_custom_image_thumb_alt_text('', get_post_thumbnail_id( $post->ID ));?>" /></a>
								<a href="<?php the_permalink(); ?>"><h3 style="margin-top: 15px;"><?php the_title(); ?></h3></a>
								<p><?php echo excerpt(10); ?></p>
							</li>
							<?php endwhile; endif; wp_reset_query(); ?>	
							
							
						</ul>
						<ul class="hot-featured">
						
						<?php query_posts('post_type=post&posts_per_page=1&cat=-10'); if(have_posts()) : while(have_posts()) : the_post(); $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
							<li>
								<a href="<?php the_permalink(); ?>"><img src='<?php echo tt($imgsrc[0], 578, 361); ?>' alt="<?php echo get_custom_image_thumb_alt_text('', get_post_thumbnail_id( $post->ID ));?>" /></a>
								<a href="<?php the_permalink(); ?>"><h3 style="margin-top: 15px;"><?php the_title(); ?></h3></a>
								<p><?php echo excerpt(80); ?></p>
							</li>
						</ul>
						<?php endwhile; endif; wp_reset_query(); ?>	
						
						
						
						<ul>
						
							<?php query_posts('post_type=post&posts_per_page=2&offset=3&cat=-10'); if(have_posts()) : while(have_posts()) : the_post(); $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
							
							<li>
								<a href="<?php the_permalink(); ?>"><img src='<?php echo tt($imgsrc[0], 278, 161); ?>' alt="<?php echo get_custom_image_thumb_alt_text('', get_post_thumbnail_id( $post->ID ));?>" /></a>
								<a href="<?php the_permalink(); ?>"><h3 style="margin-top: 15px;"><?php the_title(); ?></h3></a>
								<p><?php echo excerpt(10); ?></p>
							</li>
						<?php endwhile; endif; wp_reset_query(); ?>	
						</ul>
						
						<div class="clear"></div>

						<?php $projects = get_page_with_template('page_blog');
				  				$projecturl= get_permalink($projects);	
									?>

						<a href="<?php echo $projecturl; ?>" style="width: 99%; display: block; padding: 20px 0; font-family: didot, serif; font-size: 20px;" class="button">View All Posts</a>
						
					</div>
	
				</div>
				
				<div class="clear"></div>
			</div>

		</div>

	</div>
	
	<div class="clear"></div>

	</div>


<?php include (TEMPLATEPATH . '/library/super-map.php'); ?>
<?php get_footer(); ?>