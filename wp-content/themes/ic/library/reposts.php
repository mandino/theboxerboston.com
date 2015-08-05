<!-- ========================================>  RECENT POSTS  <====================================== -->


<article class="hs-content" id="posters">
	<span class="pagetitle">Recent Posts</span>
	<div class="hs-inner" style="width: 240px; padding: 20px 0 10px 0;">
		<div class="line"></div>
		<ul class="posters">
		
			<?php query_posts('post_type=post&showposts=15'); if(have_posts()) : while(have_posts()) : the_post(); ?>
			
			<li><a href="<?php the_permalink(); ?>"><p><?php the_title(); ?></p></a><span class="hitbottom"><small>Written by <?php the_author(); ?> on <?php the_time('F jS') ?></small></span></li>
			
			<?php endwhile; endif; wp_reset_query(); ?>	
		
		</ul>
	</div>	
</article>



<!-- ========================================>  /  RECENT POSTS  <====================================== -->	