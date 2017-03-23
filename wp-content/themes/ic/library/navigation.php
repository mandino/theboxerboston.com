<nav>


<?php if(get_option('cebo_hidicon') == 'true') { ?>
			
<div class="four columns">

	<!-- Social Icons -->	
	<ul class="social-icons">
		<?php if(get_option('cebo_facebook')) { ?>
		<li>
			<a class="box1" href="//facebook.com/<?php echo get_option('cebo_facebook'); ?>" target="_blank">
				<span aria-hidden="true" class="icon-facebook"></span>
			</a>
		</li>
		<? } ?>
		<?php if(get_option('cebo_instagram')) { ?>
		<li>
			<a class="box1" href="//twitter.com/<?php echo get_option('cebo_twitter'); ?>" target="_blank">
				<span aria-hidden="true" class="icon-twitter"></span>
			</a>
		</li>
		<? } ?>
		<?php if(get_option('cebo_instagram')) { ?>
		<li>
			<a class="box1" href="//instagram.com/<?php echo get_option('cebo_instagram'); ?>" target="_blank">
				<span aria-hidden="true" class="icon-instagram"></span>
			</a>
		</li>
		<? } ?>
		<?php if(get_option('cebo_dribbble')) { ?>
		<li>
			<a class="box1" href="//dribbble.com/<?php echo get_option('cebo_dribbble'); ?>" target="_blank">
				<span aria-hidden="true" class="icon-dribbble-2"></span>
			</a>
		</li>
		<? } ?>
		<?php if(get_option('cebo_email')) { ?>
		<li>
			<a href="#modal" class="fuschia home second">
				<span aria-hidden="true" class="icon-mail"></span>
			</a>
		</li>
		<? } ?>
	</ul>
	<!-- End Icons -->

</div>

<? } ?>


<div class="twelve columns">
	
	
	<?php if(get_option('cebo_logo') == '') { ?>
						
	<a href="<?php bloginfo ('url'); ?>"><img alt="<?php bloginfo('description'); ?>" class="logo" src="<?php bloginfo('template_url'); ?>/images/logo.png" /></a>
						
		<? } else { ?>
						
	<a href="<?php bloginfo ('url'); ?>"><img alt="<?php bloginfo('description'); ?>" style="top: <?php echo get_option('cebo_logoposition'); ?>px;" class="logo" src="<?php echo get_option('cebo_logo'); ?>" /></a>
	
	<? } ?>
	
	<div class="mainlinks">
	<!-- Start Nav Links -->
	
	<?php wp_nav_menu( array( 'theme_location' => 'primary' ,  'container' => '', 'menu_class' => 'navitem' ) ); ?>
	
	<!-- End Nav Links -->
	
	<!-- Start Dropmenu for mobile -->	
	<span aria-hidden="true" class="icon-menu"></span>	
	
	<!-- End Dropmenu for mobile -->
	</div>
	
</div>





</nav>
