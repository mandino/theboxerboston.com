<div id="home-slider">
	
	<div class="flexslider">
		<ul class="slides">
		
			<!-- loop for the slides -->
		
			<?php query_posts('post_type=slides&posts_per_page=5'); if(have_posts()) : while(have_posts()) : the_post(); 
			$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");?>
			
			
			<li>
				<div class="slide-header">
					
					<?php if(get_post_meta($post->ID, 'logopic', true)) { ?>
					
					<div class="slicer" style="background-image: url(<?php echo get_post_meta($post->ID, 'logopic', true); ?>);"></div>
										
					<?php } ?>
					
					
					<?php if(get_post_meta($post->ID, 'bigtitle', true)) { ?>
					
					<h2><?php echo get_post_meta($post->ID, 'bigtitle', true); ?></h2>
					
					<?php } ?>
					
					<?php if(get_post_meta($post->ID, 'littletitle', true)) { ?>
					
					<h3><?php echo get_post_meta($post->ID, 'littletitle', true); ?></h3>
					
					<?php } ?>
					
				</div>
				<img src="<?php echo $imgsrc[0]; ?>" alt="<?php get_post_meta($post->ID, 'bigtitle', true); ?>" />
			</li>
			
			
			<?php endwhile; endif; wp_reset_query(); ?>	
			
			<!-- end loop for the slides -->
			
		</ul>
	</div>
		
	<?php 

		$popout_query = new WP_Query(
			array(
				'post_type' => 'popout-box', 
				'posts_per_page' => 1,
			)
		);

		if($popout_query->have_posts()) :
	
	?>

		<div class="specialsbox">
				
			<div class="closebox"><a href="#">X</a></div>

			<?php while($popout_query->have_posts()) : $popout_query->the_post(); ?>

				<?php if(get_post_meta($post->ID, 'cebo_popout_welcome', true)) { ?>
					<span class="welcome-text"><?php echo get_post_meta($post->ID, 'cebo_popout_welcome', true); ?></span>
				<?php } ?>
				
				<div class="specialtab">
					
					<?php if(get_post_meta($post->ID, 'cebo_popout_url', true)) { ?>
						<a href="<?php echo get_post_meta($post->ID, 'cebo_popout_url', true); ?>"><h3 style="font-size: 25px;">
					<?php } ?>

						<span><?php echo get_post_meta($post->ID, 'cebo_popout_subtitle', true); ?></span>
						<?php echo get_post_meta($post->ID, 'cebo_popout_title', true); ?><br>
						<span><?php echo get_post_meta($post->ID, 'cebo_popout_tagline', true); ?></span></h3>

					<?php if(get_post_meta($post->ID, 'cebo_popout_url', true)) { ?></a><?php } ?>
						
				</div>

			<?php endwhile; ?>
	
		</div>

	<?php endif; ?>

</div>