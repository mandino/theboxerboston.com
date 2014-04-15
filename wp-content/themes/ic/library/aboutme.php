<div id="aboutme" style="background-image: url(<?php echo get_option('cebo_aboutmepic'); ?>); background-color: <?php if(get_option('cebo_aboutmecolor')) { echo get_option('cebo_aboutmecolor'); } else { echo '#ffffff' ; } ?>; ">
	
		<div class="container">
		
			<div class="two columns halfsies">
				
				
				<?php if(get_option('cebo_aboutmeheader')) { ?>
				
					<h1 class="heading"><?php echo get_option('cebo_aboutmeheader'); ?></h1>
					
				<? } ?>
				<?php if(get_option('cebo_aboutskillpercent')) { ?>
				
					<div class="galactus"><span><?php echo get_option('cebo_aboutskillpercent'); ?></span>%</div>
					
				<? } ?>
				<?php if(get_option('cebo_aboutmeskilltit')) { ?>
				
					<h2 class="title"><?php echo get_option('cebo_aboutmeskilltit'); ?></h2>
				
				<? } ?>
				
				<?php if(get_option('cebo_aboutmedesc')) { ?>
				
					<p><?php echo get_option('cebo_aboutmedesc'); ?></p>
				
				<? } ?>
				
				
				<div class="superspace"></div>
				
				
				<?php if(get_option('cebo_aboutmeskilltit2')) { ?>
				
				<div class="five columns">
				
					<div class="surfer"><span><?php echo get_option('cebo_aboutskillpercent2'); ?></span>%</div>
				
					<h2 class="surftitle"><?php echo get_option('cebo_aboutmeskilltit2'); ?></h2>
				
				</div>
				
				<? } ?>
				
				
				<?php if(get_option('cebo_aboutmeskilltit3')) { ?>
				
				<div class="five columns">
					
					<div class="surfer"><span><?php echo get_option('cebo_aboutskillpercent3'); ?></span>%</div>
				
					<h2 class="surftitle"><?php echo get_option('cebo_aboutmeskilltit3'); ?></h2>
				
				</div>
				
				<? } ?>
				
				
				<div class="clear"></div>
				
				
				<?php $projects = get_page_with_template('page-portfolio');
				  $projecturl= get_permalink($projects);	
					?>
			        
			        <?php if($projects) { ?>
			        
			        <a href="<?php echo $projecturl; ?>" class="button"><?php _e('View My Portfolio', 'cebolang'); ?></a>
			        
			        <? } ?>
				
					<?php if(get_option('cebo_email')) { ?>
				
					<a href="#modal" class="second button"><?php _e('Contact Me', 'cebolang'); ?></a>
				
					<? } ?>
			
			</div>
			
			
		</div>
	
	</div>
	
	
	
