<?php 

/* Basic Page Template 

*/
 get_header(); ?>





<?php if(get_post_meta($post->ID, 'cebo_fullpic', true)) { ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<div class="fullpic">

	<div class="slide-header">
		<a class="button" onclick="_gaq.push(['_trackEvent', 'Reserve', 'Reservation-button-banner', 'Reserve Now']);" href="<?php if(get_post_meta ($post->ID, 'cebo_booklink', true)) { echo get_post_meta ($post->ID, 'cebo_booklink', true); } else { echo get_option('cebo_genbooklink'); } ?>"><?php _e('RESERVE NOW', 'cebolang'); ?></a>
	</div>
	<img src="<?php echo tt(get_post_meta($post->ID, 'cebo_fullpic', true), 1400, 350); ?>" alt="<?php echo get_custom_image_thumb_alt_text(get_post_meta($post->ID, 'cebo_fullpic', true), ''); ?>" />


</div>

<?php endwhile; endif; wp_reset_query(); ?>	

<?php } ?>


	<div id="page-content" class="section">
		
		<div class="container">

			<div class="post-title section-header">

				<div class="fl">
	
					<?php if(get_option('cebo_shorttitle')) { ?>
					
					<div class="section-pre-title fl"><?php echo get_option('cebo_shorttitle'); ?></div>

					<div class="section-header-divider fl"></div>
					
					<?php } ?>

		
					<h1 class="section-title fr"><?php the_title(); ?></h1>
	
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
  						$this_post = $post->ID;
  						
  					query_posts(
					array(
					'post_type' => 'page',
					'post_parent' => $parents,
					'posts_per_page'=> 8,
					// 'post__not_in' => array($currency)
					
					)); if(have_posts()) : while(have_posts()) : the_post(); ?>
				<li <?php if( $this_post == $post->ID ) { echo ' class="current"'; } ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
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
				<li <?php if( $this_post == $post->ID ) { echo ' class="current"'; } ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; endif; wp_reset_query(); ?>	
			</ul>
			</div>
			
			<?php } } ?>
			
					
			<div class="wonderline"></div>
			<div class="post-content fl">
				
				<?php the_content(); ?>

				<!-- New Restaurant Menu Template -->

				<?php $class = ""; $cnt = 0; ?>
				<div class="eat-container">
					<div>
					<?php if (have_posts('eat_menu')) : while(have_rows('eat_menu')) : the_row();?>
					<?php 
						$temp_class = strtolower(get_sub_field('menu_title'));
						$class = str_replace(" ", "_", $temp_class);
						
					 ?>
						<button class="button eat-tab-button" data-class="<?php echo $class; ?>"><?php the_sub_field('menu_title') ?></button>
					<?php endwhile; endif; ?>	
				</div>

				<?php if (have_posts('eat_menu')) : while(have_rows('eat_menu')) : the_row();?>
					<?php if ($cnt == 0) : $hideClass = "showMenu"; else : $hideClass = "hideMenu"; endif; ?>

					<?php 
						$count = 0;
						$temp_class = strtolower(get_sub_field('menu_title'));
						$_class = str_replace(" ", "_", $temp_class);
					 ?>

					<section id="<?php echo $_class; ?>" class="eat-menu-container <?php echo $hideClass; ?>">

						<h2><?php the_sub_field('menu_title') ?></h2>

						<?php if (have_rows('meal_type')) : while(have_rows('meal_type'))  : the_row();?>
							<?php if ($count == 0): ?>
								<div class="menu-list left-menu">
									<div class="menu-content-<?php echo $count;?>">
										<table class="menu-table">
											<th><h3><?php the_sub_field('menu_type_name') ?></h3></th>
											<?php if (have_rows('menu_items')) : while(have_rows('menu_items'))  : the_row();?>
											<tr>
												<td>
													<div class="menu-items-container">
														<div class="menu-items">
															<span><?php the_sub_field('items'); ?></span>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="menu-items-container">
														<div class="menu-items">
															<?php the_sub_field('content') ?>
														</div>
													</div>
												</td>
												<td>
													<div class="menu-price">
														<span><?php the_sub_field('price') ?></span>	
													</div>
												</td>
											</tr>
											<?php endwhile; endif; ?>
										</table>					
									</div>
									<div class="clear"></div>
								</div>

							<?php endif ?>
							<?php $count++; break; endwhile; endif; ?>
							
								<div class="menu-list right-menu">
									<?php if (have_rows('meal_type')) : while(have_rows('meal_type'))  : the_row();?>
									<?php if ($count > 0): ?>
									<div class="menu-content-<?php echo $count;?>" style="">
										<table class="menu-table">
											<tr><th><h3><?php the_sub_field('menu_type_name') ?></h3></th></tr>
											<?php if (have_rows('menu_items')) : while(have_rows('menu_items'))  : the_row();?>
											<tr>
												<td>
													<div class="menu-items">
														<span><?php the_sub_field('items'); ?></span>
													</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="menu-items">	
														<?php the_sub_field('content') ?>
													</div>
												</td>
												<td>
													<div class="menu-price">
														<span><?php the_sub_field('price') ?></span>	
													</div>
												</td>
											</tr>
											<?php endwhile; endif; ?>
										</table>

										
									</div>

									<?php endif ?>
									<?php $count++; endwhile; endif; ?>
									<div class="clear"></div>
								</div>


						<div class="clear"></div>
					</section>
					
				<?php $cnt++; endwhile; endif; ?>
				</div>
				
				<div class="drink-container">
					<div>
					<?php if (have_posts('drink_menu')) : while(have_rows('drink_menu')) : the_row();?>
					<?php 
						$temp_class = strtolower(get_sub_field('menu_title'));
						$class = str_replace(" ", "_", $temp_class);
						
					 ?>
						<button class="button drink-tab-button" data-class="<?php echo $class; ?>"><?php the_sub_field('menu_title') ?></button>
					<?php endwhile; endif; ?>	
				</div>
				<?php $cnt2 = 0; ?>
				<?php if (have_posts('drink_menu')) : while(have_rows('drink_menu')) : the_row();?>
					<?php if ($cnt2 == 0) : $hideClass = "showMenu"; else : $hideClass = "hideMenu"; endif; ?>
					<?php 
						
						$temp_class = strtolower(get_sub_field('menu_title'));
						$_class = str_replace(" ", "_", $temp_class);
						$glass_bottle_price = get_sub_field('enable_glassbottle_price');
					 ?>
					<section id="<?php echo $_class; ?>" class="drink-menu-container <?php echo $hideClass; ?>">
						<h2><?php the_sub_field('menu_title') ?></h2>
						<?php if ($glass_bottle_price): ?>
							<div class="price-label">
								<span>Glass Price</span>
								<span>Bottle Price</span>
							</div>
						<?php endif ?>
						
						
						<div class="menu-list">
							
							<div class="menu-content-1">
								<?php if (have_rows('items')) : while(have_rows('items'))  : the_row();?>
									<div class="menu-items-container">
										<div class="menu-items">
											<span><?php the_sub_field('item_name'); ?></span>
											<?php the_sub_field('content') ?>
										</div>
									</div>
									<?php if ($glass_bottle_price): ?>
										<div class="glass-price">
											<span><?php the_sub_field('glass_price') ?></span>
										</div>
										<div class="bottle-price">
											<span><?php the_sub_field('bottle_price') ?></span>
										</div>
									<?php endif ?>

								<?php endwhile; endif; ?>
							</div>

							<div class="clear"></div>
						</div>
					</section>
					
				<?php $cnt2++; endwhile; endif; ?>
				</div>

	<!-- Restaurant Menu New Template : END -->

			</div>

			<div class="sidebar fr">
				
				<a class="button" onclick="_gaq.push(['_trackEvent', 'Reserve', 'Reservation-button-sidebar', 'Reserve Now']);" href="<?php if(get_post_meta ($post->ID, 'cebo_booklink', true)) { echo get_post_meta ($post->ID, 'cebo_booklink', true); } else { echo get_option('cebo_genbooklink'); } ?>"><?php _e('RESERVE NOW', 'cebolang'); ?></a>
				
				<?php
					$sidebarformid = get_the_ID();

					if($sidebarformid == 206){ ?>
				<p><strong>Get on the List. </br>The Finch Restaurant's VIP Email Signup.</br></strong></p>
				<p style="line-height:20px;margin-top: -5%;">Be the first to know about of all the exclusive events and happening at the Boxer's modern American restaurant, Finch.</span></p>

				<div class="signup-form">
					
					<form name="surveys" action="//zmaildirect.com/app/new/MjA0MjA0MTM2" method="get">  

						<input type="hidden" name="formId" value="MjA0MjA0MTM2">
						    <div>
						<input type="text" name="email" placeholder="Get on the List">
							</div>
						  <div>	
						<input type="submit" value="Sign Up">
							</div>
					</form>
	
				</div> 
				<?php } ?> 
				<p>&nbsp;</p><p>&nbsp;</p>
				<ul class="thumbgal">
						
						<?php query_posts('post_type=specials&posts_per_page=4'); if(have_posts()) : while(have_posts()) : the_post(); 
						$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>

							<?php if(get_post_meta($post->ID, 'cebo_available_on_sidebar', true)) { ?>
								
								<li>
									
						
									<?php if(get_post_meta($post->ID, 'cebo_pricepoint', true)) { ?>
									
									<div class="from-price">
										<?php echo get_post_meta($post->ID, 'cebo_pricepoint', true); ?>
									</div>
									
									<?php } ?>
									
									<?php if(get_post_meta($post->ID, 'cebo_homethumb', true)) { ?>
									
									<a href="<?php the_permalink(); ?>"><img src="<?php echo get_post_meta($post->ID, 'cebo_homethumb', true); ?>" alt="<?php echo get_custom_image_thumb_alt_text(get_post_meta($post->ID, 'cebo_homethumb', true), ''); ?>"></a>
									
									<?php } else { ?>
									
									<a href="<?php the_permalink(); ?>"><img src="<?php echo $imgsrc[0]; ?>" alt="<?php echo get_custom_image_thumb_alt_text('', get_post_thumbnail_id( $post->ID ));?>"></a>
									
									<?php } ?>
									
									<?php if(get_post_meta($post->ID, 'cebo_subtagline', true)) { ?>
									
									<h3><?php echo get_post_meta($post->ID, 'cebo_subtagline', true); ?></h3>
									
									
									<?php } ?>

									<div class="hover-effect">
										
										<?php if(get_post_meta($post->ID, 'cebo_tagline', true)) { ?>
										
										<h2><?php echo get_post_meta($post->ID, 'cebo_tagline', true); ?></h2>
										
										<?php } ?>
										
										
										<!-- , and Hotel Oceana Tote Bag., and breakfast at the Hotel. -->
										<a class="special-external" href="<?php the_permalink(); ?>"><i class="fa fa-chevron-right fa-lg"></i></a>
									</div>
									
								</li>

							<?php } ?>
							
							<?php endwhile; endif; wp_reset_query(); ?>
							
						
							
						</ul>
		
				</div>
			
			<div class="clear"></div>

		</div>

	</div>


<div class="clear"></div>
	
					
<?php get_footer(); ?>