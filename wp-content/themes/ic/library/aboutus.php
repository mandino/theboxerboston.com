<div id="about">
	
		<div class="container">
		
			<h1 class="heading"><?php echo get_option('cebo_aboutusheader'); ?></h1>
			
			
			
			<div class="five columns silo">
				
				<h3><?php echo get_option('cebo_aboutuscolumnheader'); ?></h3>
				
				<p><?php echo get_option('cebo_aboutusblurp'); ?></p>
				
				<div class="clear"></div>
				
				
				
				<?php if(get_option('cebo_show_skillsbar') == 'true') { ?>
				
				<div class="content">
					<div class="col">
					  <h3><?php echo get_option('cebo_skillsheader'); ?></h3>
					    <ul id="skill">
					    
					    <li><span class="expand html5" style="background: <?php echo get_option('cebo_skill1_color'); ?>; width: <?php echo get_option('cebo_skill1_percent'); ?>%; "></span><em><?php echo get_option('cebo_skill1'); ?></em></li>
					    
					    <li><span class="expand css3" style="background: <?php echo get_option('cebo_skill2_color'); ?>; width: <?php echo get_option('cebo_skill2_percent'); ?>%; "></span><em><?php echo get_option('cebo_skill2'); ?></em></li>
					    
					    <li><span class="expand jquery" style="background: <?php echo get_option('cebo_skill3_color'); ?>; width: <?php echo get_option('cebo_skill3_percent'); ?>%; "></span><em><?php echo get_option('cebo_skill3'); ?></em></li>
					    
					    <li><span class="expand photoshop" style="background: <?php echo get_option('cebo_skill4_color'); ?>; width: <?php echo get_option('cebo_skill4_percent'); ?>%; "></span><em><?php echo get_option('cebo_skill4'); ?></em></li>
					    
					    <li><span class="expand dreamweaver" style="background: <?php echo get_option('cebo_skill5_color'); ?>; width: <?php echo get_option('cebo_skill5_percent'); ?>%; "></span><em><?php echo get_option('cebo_skill5'); ?></em></li>
					    
					    </ul>
					</div>
				</div>
				
				
				<? } ?>
							
			</div>
			
			<!-- end left silo -->
			
			<div class="tem">
			
			<?php query_posts('post_type=team&posts_per_page=8'); if(have_posts()) : while(have_posts()) : the_post(); ?>
			<div class="five columns teamers">
				
				<div class="he-wrap tpl2">
					<?php $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
					<img src="<?php bloginfo('template_directory'); ?>/tools/timthumb.php?src=<?php echo $imgsrc[0]; ?>&amp;h=245&amp;w=220&amp;zc=1" alt="<?php wp_title(); ?>" />
						
					<div class="he-view">
							
							<div class="bg a0" data-animate="fadeIn">
							
								<h2 class="a0" data-animate="fadeInDown"><?php wp_title(); ?><?php if(get_post_meta($post->ID, 'bigtitle', $single = true )) { ?><span><?php echo get_post_meta($post->ID, 'bigtitle', $single = true ); ?></span><? } ?></h2>
							
							
								<div class="center-bar">
									
									<?php if(get_post_meta($post->ID, 'twitlink', $single = true )) { ?>
									<a href="<?php echo get_post_meta($post->ID, 'twitlink', $single = true ); ?>" target="_blank" class="twitter a0" data-animate="fadeInUp"></a>
									<? } ?>
									<?php if(get_post_meta($post->ID, 'faclink', $single = true )) { ?>
									<a href="<?php echo get_post_meta($post->ID, 'faclink', $single = true ); ?>" target="_blank" class="facebook a1" data-animate="fadeInUp"></a>
									<? } ?>
									<?php if(get_post_meta($post->ID, 'googlink', $single = true )) { ?>
									<a href="<?php echo get_post_meta($post->ID, 'googlink', $single = true ); ?>" target="_blank" class="google a2" data-animate="fadeInUp"></a>
									<? } ?>
									<?php if(get_post_meta($post->ID, 'linlink', $single = true )) { ?>
									<a href="<?php echo get_post_meta($post->ID, 'linlink', $single = true ); ?>" target="_blank" class="in a3" data-animate="fadeInUp"></a>
									<? } ?>
								</div>
							</div>
						</div>
				</div>
			
			</div>
			
			<?php endwhile; endif; wp_reset_query(); ?>	
			
			</div>
			
			<div class="clear"></div>
			
			<div class="superspace"></div>
			
			
			
			<?php if(get_option('cebo_services') == 'true') { ?>
			
				<!-- ============= BEGIN SERVICES =============== -->
				
				
				<?php if(get_option('cebo_service1name')) { ?>
				
				<!-- service starts here -->
				
				<div class="ser">
				
				<div class="five columns services">
				
					<div class="servicecard">
					
						<span aria-hidden="true" class="icon-<?php if(get_option('cebo_icon') == 'thumbs up' )  { echo 'thumbs-up'; } elseif(get_option('cebo_icon') == 'thumbs down') { echo 'thumbs-up-2'; } elseif(get_option('cebo_icon') == 'link') { echo 'link'; } elseif(get_option('cebo_icon') == 'bars') { echo 'menu'; } elseif(get_option('cebo_icon') == 'list') { echo 'list'; } elseif(get_option('cebo_icon') == 'mail') { echo 'mail'; } elseif(get_option('cebo_icon') == 'camera') { echo 'camera'; } elseif(get_option('cebo_icon') == 'picture') { echo 'picture'; } elseif(get_option('cebo_icon') == 'film strip') { echo 'film'; } elseif(get_option('cebo_icon') == 'pencil') { echo 'pencil'; } elseif(get_option('cebo_icon') == 'phone') { echo 'phone'; } elseif(get_option('cebo_icon') == 'check') { echo 'checkmark'; } elseif(get_option('cebo_icon') == 'home') { echo 'home'; } elseif(get_option('cebo_icon') == 'computer screen') { echo 'screen'; } elseif(get_option('cebo_icon') == 'mobile device') { echo 'mobile'; } elseif(get_option('cebo_icon') == 'television') { echo 'tv'; } elseif(get_option('cebo_icon') == 'shopping cart') { echo 'cart'; } elseif(get_option('cebo_icon') == 'single document') { echo 'file'; } elseif(get_option('cebo_icon') == 'multiple documents') { echo 'copy'; } elseif(get_option('cebo_icon') == 'sales tag') { echo 'tag'; } elseif(get_option('cebo_icon') == 'calendar') { echo 'calendar'; } elseif(get_option('cebo_icon') == 'support') { echo 'support'; } elseif(get_option('cebo_icon') == 'user') { echo 'user'; } elseif(get_option('cebo_icon') == 'graph') { echo 'stats'; } elseif(get_option('cebo_icon') == 'settings') { echo 'cog'; } elseif(get_option('cebo_icon') == 'cloud') { echo 'cloud'; } elseif(get_option('cebo_icon') == 'star') { echo 'star'; } ?>"></span>
					
					</div>
					
					<h3><?php echo get_option('cebo_service1name'); ?></h3>
					<p><?php echo get_option('cebo_service1desc'); ?></p>
				
				</div>
				
				<!-- end one -->
				
				<? } ?>
				
				<?php if(get_option('cebo_service2name')) { ?>
				
				<!-- service starts here -->
				
				<div class="five columns services">
				
					<div class="servicecard">
					
						<span aria-hidden="true" class="icon-<?php if(get_option('cebo_icon2') == 'thumbs up' )  { echo 'thumbs-up'; } elseif(get_option('cebo_icon2') == 'thumbs down') { echo 'thumbs-up-2'; } elseif(get_option('cebo_icon2') == 'link') { echo 'link'; } elseif(get_option('cebo_icon2') == 'bars') { echo 'menu'; } elseif(get_option('cebo_icon2') == 'list') { echo 'list'; } elseif(get_option('cebo_icon2') == 'mail') { echo 'mail'; } elseif(get_option('cebo_icon2') == 'camera') { echo 'camera'; } elseif(get_option('cebo_icon2') == 'picture') { echo 'picture'; } elseif(get_option('cebo_icon2') == 'film strip') { echo 'film'; } elseif(get_option('cebo_icon2') == 'pencil') { echo 'pencil'; } elseif(get_option('cebo_icon2') == 'phone') { echo 'phone'; } elseif(get_option('cebo_icon2') == 'check') { echo 'checkmark'; } elseif(get_option('cebo_icon2') == 'home') { echo 'home'; } elseif(get_option('cebo_icon2') == 'computer screen') { echo 'screen'; } elseif(get_option('cebo_icon2') == 'mobile device') { echo 'mobile'; } elseif(get_option('cebo_icon2') == 'television') { echo 'tv'; } elseif(get_option('cebo_icon2') == 'shopping cart') { echo 'cart'; } elseif(get_option('cebo_icon2') == 'single document') { echo 'file'; } elseif(get_option('cebo_icon2') == 'multiple documents') { echo 'copy'; } elseif(get_option('cebo_icon2') == 'sales tag') { echo 'tag'; } elseif(get_option('cebo_icon2') == 'calendar') { echo 'calendar'; } elseif(get_option('cebo_icon2') == 'support') { echo 'support'; } elseif(get_option('cebo_icon2') == 'user') { echo 'user'; } elseif(get_option('cebo_icon2') == 'graph') { echo 'stats'; } elseif(get_option('cebo_icon2') == 'settings') { echo 'cog'; } elseif(get_option('cebo_icon2') == 'cloud') { echo 'cloud'; } elseif(get_option('cebo_icon2') == 'star') { echo 'star'; } ?>"></span>
					
					</div>
					
					<h3><?php echo get_option('cebo_service2name'); ?></h3>
					<p><?php echo get_option('cebo_service2desc'); ?></p>
				
				</div>
				
				<!-- end one -->
				
				<? } ?>
				
				<?php if(get_option('cebo_service3name')) { ?>
				
				<!-- service starts here -->
	
				<div class="five columns services">
				
					<div class="servicecard">
					
						<span aria-hidden="true" class="icon-<?php if(get_option('cebo_icon3') == 'thumbs up' )  { echo 'thumbs-up'; } elseif(get_option('cebo_icon3') == 'thumbs down') { echo 'thumbs-up-2'; } elseif(get_option('cebo_icon3') == 'link') { echo 'link'; } elseif(get_option('cebo_icon3') == 'bars') { echo 'menu'; } elseif(get_option('cebo_icon3') == 'list') { echo 'list'; } elseif(get_option('cebo_icon3') == 'mail') { echo 'mail'; } elseif(get_option('cebo_icon3') == 'camera') { echo 'camera'; } elseif(get_option('cebo_icon3') == 'picture') { echo 'picture'; } elseif(get_option('cebo_icon3') == 'film strip') { echo 'film'; } elseif(get_option('cebo_icon3') == 'pencil') { echo 'pencil'; } elseif(get_option('cebo_icon3') == 'phone') { echo 'phone'; } elseif(get_option('cebo_icon3') == 'check') { echo 'checkmark'; } elseif(get_option('cebo_icon3') == 'home') { echo 'home'; } elseif(get_option('cebo_icon3') == 'computer screen') { echo 'screen'; } elseif(get_option('cebo_icon3') == 'mobile device') { echo 'mobile'; } elseif(get_option('cebo_icon3') == 'television') { echo 'tv'; } elseif(get_option('cebo_icon3') == 'shopping cart') { echo 'cart'; } elseif(get_option('cebo_icon3') == 'single document') { echo 'file'; } elseif(get_option('cebo_icon3') == 'multiple documents') { echo 'copy'; } elseif(get_option('cebo_icon3') == 'sales tag') { echo 'tag'; } elseif(get_option('cebo_icon3') == 'calendar') { echo 'calendar'; } elseif(get_option('cebo_icon3') == 'support') { echo 'support'; } elseif(get_option('cebo_icon3') == 'user') { echo 'user'; } elseif(get_option('cebo_icon3') == 'graph') { echo 'stats'; } elseif(get_option('cebo_icon3') == 'settings') { echo 'cog'; } elseif(get_option('cebo_icon3') == 'cloud') { echo 'cloud'; } elseif(get_option('cebo_icon3') == 'star') { echo 'star'; } ?>"></span>
					
					</div>
					
					<h3><?php echo get_option('cebo_service3name'); ?></h3>
					<p><?php echo get_option('cebo_service3desc'); ?></p>
				
				</div>
				
				
				<!-- end one -->
				
				<? } ?>
				
				<?php if(get_option('cebo_service4name')) { ?>
				
				<!-- service starts here -->
				
				
				<div class="five columns services">
				
					<div class="servicecard">
					
						<span aria-hidden="true" class="icon-<?php if(get_option('cebo_icon4') == 'thumbs up' )  { echo 'thumbs-up'; } elseif(get_option('cebo_icon4') == 'thumbs down') { echo 'thumbs-up-2'; } elseif(get_option('cebo_icon4') == 'link') { echo 'link'; } elseif(get_option('cebo_icon4') == 'bars') { echo 'menu'; } elseif(get_option('cebo_icon4') == 'list') { echo 'list'; } elseif(get_option('cebo_icon4') == 'mail') { echo 'mail'; } elseif(get_option('cebo_icon4') == 'camera') { echo 'camera'; } elseif(get_option('cebo_icon4') == 'picture') { echo 'picture'; } elseif(get_option('cebo_icon4') == 'film strip') { echo 'film'; } elseif(get_option('cebo_icon4') == 'pencil') { echo 'pencil'; } elseif(get_option('cebo_icon4') == 'phone') { echo 'phone'; } elseif(get_option('cebo_icon4') == 'check') { echo 'checkmark'; } elseif(get_option('cebo_icon4') == 'home') { echo 'home'; } elseif(get_option('cebo_icon4') == 'computer screen') { echo 'screen'; } elseif(get_option('cebo_icon4') == 'mobile device') { echo 'mobile'; } elseif(get_option('cebo_icon4') == 'television') { echo 'tv'; } elseif(get_option('cebo_icon4') == 'shopping cart') { echo 'cart'; } elseif(get_option('cebo_icon4') == 'single document') { echo 'file'; } elseif(get_option('cebo_icon4') == 'multiple documents') { echo 'copy'; } elseif(get_option('cebo_icon4') == 'sales tag') { echo 'tag'; } elseif(get_option('cebo_icon4') == 'calendar') { echo 'calendar'; } elseif(get_option('cebo_icon4') == 'support') { echo 'support'; } elseif(get_option('cebo_icon4') == 'user') { echo 'user'; } elseif(get_option('cebo_icon4') == 'graph') { echo 'stats'; } elseif(get_option('cebo_icon4') == 'settings') { echo 'cog'; } elseif(get_option('cebo_icon4') == 'cloud') { echo 'cloud'; } elseif(get_option('cebo_icon4') == 'star') { echo 'star'; } ?>"></span>
					
					</div>
					
					<h3><?php echo get_option('cebo_service4name'); ?></h3>
					<p><?php echo get_option('cebo_service4desc'); ?></p>
				
				</div>
				
				
				<!-- end one -->
				
				<? } ?>
				
				<?php if(get_option('cebo_service5name')) { ?>
				
				<!-- service starts here -->

				<div class="five columns services">
				
					
					<div class="servicecard">
					
						<span aria-hidden="true" class="icon-<?php if(get_option('cebo_icon5') == 'thumbs up' )  { echo 'thumbs-up'; } elseif(get_option('cebo_icon5') == 'thumbs down') { echo 'thumbs-up-2'; } elseif(get_option('cebo_icon5') == 'link') { echo 'link'; } elseif(get_option('cebo_icon5') == 'bars') { echo 'menu'; } elseif(get_option('cebo_icon5') == 'list') { echo 'list'; } elseif(get_option('cebo_icon5') == 'mail') { echo 'mail'; } elseif(get_option('cebo_icon5') == 'camera') { echo 'camera'; } elseif(get_option('cebo_icon5') == 'picture') { echo 'picture'; } elseif(get_option('cebo_icon5') == 'film strip') { echo 'film'; } elseif(get_option('cebo_icon5') == 'pencil') { echo 'pencil'; } elseif(get_option('cebo_icon5') == 'phone') { echo 'phone'; } elseif(get_option('cebo_icon5') == 'check') { echo 'checkmark'; } elseif(get_option('cebo_icon5') == 'home') { echo 'home'; } elseif(get_option('cebo_icon5') == 'computer screen') { echo 'screen'; } elseif(get_option('cebo_icon5') == 'mobile device') { echo 'mobile'; } elseif(get_option('cebo_icon5') == 'television') { echo 'tv'; } elseif(get_option('cebo_icon5') == 'shopping cart') { echo 'cart'; } elseif(get_option('cebo_icon5') == 'single document') { echo 'file'; } elseif(get_option('cebo_icon5') == 'multiple documents') { echo 'copy'; } elseif(get_option('cebo_icon5') == 'sales tag') { echo 'tag'; } elseif(get_option('cebo_icon5') == 'calendar') { echo 'calendar'; } elseif(get_option('cebo_icon5') == 'support') { echo 'support'; } elseif(get_option('cebo_icon5') == 'user') { echo 'user'; } elseif(get_option('cebo_icon5') == 'graph') { echo 'stats'; } elseif(get_option('cebo_icon5') == 'settings') { echo 'cog'; } elseif(get_option('cebo_icon5') == 'cloud') { echo 'cloud'; } elseif(get_option('cebo_icon5') == 'star') { echo 'star'; } ?>"></span>
					
					</div>
					
					<h3><?php echo get_option('cebo_service5name'); ?></h3>
					<p><?php echo get_option('cebo_service5desc'); ?></p>
				
				</div>
				
				<? } ?>
				
				<!-- end one -->
			
		<? } ?>		
		
		</div>
		
		</div>
		
		<div class="clear"></div>
		
		
		
	</div>
