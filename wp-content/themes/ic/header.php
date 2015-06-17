<?php 

	if ( file_exists( TEMPLATEPATH.'/library/mobile-detect.php' ) ) {

		require_once TEMPLATEPATH.'/library/mobile-detect.php';
		$detect = new Mobile_Detect;
		$check = $detect->isMobile();

	}

?>
<!DOCTYPE HTML>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!--<title>
		<?php /**global $page, $paged; wp_title( '|', true, 'right' ); bloginfo( 'name' );
	
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
	
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'cebolang' ), max( $paged, $page ) );**/
		?>
	</title>-->
	<title><?php wp_title(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if (get_option('cebo_custom_favicon') == '') { ?>
	
	<link rel="icon" href="<?php bloginfo ('template_url'); ?>/cebo_options/<?php bloginfo ('template_url'); ?>/images/admin_sidebar_icon.png" type="image/x-ico"/>
	
	<? } else { ?>
	
	<link rel="icon" href="<?php echo get_option('cebo_custom_favicon'); ?>" type="image/x-ico"/>
	
	<? } ?>
	
	
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( get_option('cebo_feedburner_url') <> "" ) { echo get_option('cebo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
	
	<!-- favicon -->

	<link rel="shortcut icon" href="<?php bloginfo ('template_url'); ?>/icfavicon.png" type="image/png">
	<link rel="icon" href="icfavicon.png" type="image/png">
	
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	
	<link rel="stylesheet" type="text/css" href="<?php bloginfo ('template_url'); ?>/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo ('template_url'); ?>/css/custom.css">

	<!-- Fonts -->
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,400italic,700' rel='stylesheet' type='text/css'>

	<!-- Jquery -->
	<?php include(TEMPLATEPATH. "/library/jquery.php"); ?>	

	<!-- pinterest -->
	<meta name="p:domain_verify" content="fdcd1755542385831e526a2a712cc134"/>

	<!-- Scripts -->
	<?php include(TEMPLATEPATH. "/library/scripts.php"); ?>	


	<style>
		<?php

			include(TEMPLATEPATH. "/library/inset.php");
		?>	
	</style>


<!-- Google Code for Remarketing Tag -->

<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 969927793;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/969927793/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<!-- zdirect script -->

<script type="text/javascript" src="https://www.zdirect.com/scripts/newApp.js"></script>

<!-- Sojern script  -->
<script>
(function () {
var pl = document.createElement('script');
pl.type = 'text/javascript';
pl.async = true;
pl.src = 'https://beacon.sojern.com/pixel/p/3677?cid=[destination_searched]&ha1=[destination_searched]&et=hs';(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(pl);
})();
</script>
<!-- End Sojern script -->


	<?php
		/****************** DO NOT REMOVE **********************
		/* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
		wp_head();
	?>

<!-- Sojern -->
<script>
(function () {
var pl = document.createElement('script');
pl.type = 'text/javascript';
pl.async = true;
pl.src = 'https://beacon.sojern.com/pixel/p/3035';(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(pl);
})();
</script>
<!-- End Sojern -->

<script>

	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-37161096-1', 'auto', {
		'allowLinker': true
	});
	ga('send', 'pageview');
	ga('require', 'linker');
	ga('linker:autoLink', ['reztrip.com'], false, true);

</script>

</head> 
	
<body id="oceana" <?php body_class($class); ?>>

	<div id="navigation">
			
			
			<div class="ressys">
				
				
				<div class="whippapeal">
				<div class="formfields">
				
					<div class="reservationform">
					
					
						<form method="get" action="https://theboxerboston.reztrip.com/search?">
						<span class="calsec">
								<input type="text"  id="arrival_date" name="arrival_date" placeholder="<?php _e('Arrival','cebolang'); ?>" class="calendarsection" />
							<input type="hidden"  id="arv">
							<i class="fa fa-calendar"></i>
						</span>
						
						<span class="calsec">
							<input type="text" id="departure_date" name="departure_date" placeholder="<?php _e('Departure','cebolang'); ?>" class="calendarsection" />
							<input type="hidden" id="dep">
							<i class="fa fa-calendar"></i>
						</span>
						<span class="dropsec" style="margin-right: 6px">
							<select name="adults[]" id="adults" class="halfsies">
								<option value="1"><?php _e('1 Adult','cebolang'); ?></option>
								<option value="2" selected="selected"><?php _e('2 Adults','cebolang'); ?></option>
								<option value="3"><?php _e('3 Adults','cebolang'); ?></option>
								<option value="4"><?php _e('4 Adults','cebolang'); ?></option>
							</select>
						</span>
						
						<span class="dropsec">
							<select name="children[]" id="children" class="halfsies">
								<option value="0"><?php _e('0 Kids','cebolang'); ?></option>
								<option value="1"><?php _e('1 Kid','cebolang'); ?></option>
								<option value="2"><?php _e('2 Kids','cebolang'); ?></option>
								<option value="3"><?php _e('3 Kids','cebolang'); ?></option>
							</select>
						</span>
						
						<button type="submit" class="button">Search Now</button>
						
					
						</form>
				
					</div>

				<!-- flex dates -->

					<div class="reservationform flexdate">
					
						<p><a href="https://theboxerboston.reztrip.com">Flexible dates?</a> Search for our best available rate</p>				
						
					</div>

				<!-- end flex dates -->

				</div>
				
				<div class="calendars">
					
					 <div class="datepicker"></div>
				
				
				</div>
				
				</div>
			</div>
			
			
		<div id="property-nav">
			
			<nav class="click-nav">
				<ul class="container no-js">
					<li>
	
						<a href="http://independentcollection.com" target="_blank" class="clicknav-clicker"></a>
	
						<!-- <ul>
							<li class="navitem"><a href="#">Independet Collection</a></li>
							<li class="navitem"><a href="#">Independet Collection</a></li>
							<li class="navitem"><a href="#">Independet Collection</a></li>
							<li class="navitem"><a href="#">Independet Collection</a></li>
							<li class="navitem"><a href="#">Independet Collection</a></li>
						</ul> -->
	
					</li>
					<!-- <li class="blue-btn"><a href="http://theboxerboston.com/blue"><i class="fa fa-info-circle"></i><span class="blue-mobile">why blue?</span></a></li> -->
				</ul>
			</nav>
			
			
			
	
		</div>
	
		<div id="primary-nav">
		
			<a href="<?php bloginfo('url'); ?>" class="logo<?php if(is_home()) { ?> droplogo<?php } ?>"><img src="<?php echo get_option('cebo_logo'); ?>" alt="<?php echo wp_title(); ?>" /></a>

			<a href="<?php bloginfo('url'); ?>" class="logo mobile"><img src="<?php echo get_option('cebo_logo'); ?>" alt="<?php echo wp_title(); ?>" /></a>
			
			<a href="https://theboxerboston.reztrip.com" class="reserve fixeer button fr input-append date" id="idp3" data-date="12-02-2012" data-date-format="mm-dd-yyyy">RESERVE</a>

			<a class="reserve fixeer mobile button fr" id="idp4"  onclick="_gaq.push(['_link', this.href]);return false;" href="<?php echo get_option('cebo_genbooklink'); ?>" target="_blank">RESERVE</a>
			
			<div class="container" style="float: right;">

				<a class="mmenu-icon" href="#menu"><i class="fa fa-bars"></i></a>
	
				<nav id="menu" class="fl">
					<ul>
						 <?php wp_nav_menu( array( 'theme_location' => 'primary' ,  'items_wrap' => '%3$s', 'container' => '', 'menu_class' => 'navitem' ) ); ?>
					</ul>
				</nav>
	
			</div>
	
				
				
				
	
		</div>

	</div>
	
	<div id="quiet"></div>
   