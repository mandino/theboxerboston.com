<?php 
	if ( file_exists( TEMPLATEPATH.'/library/mobile-detect.php' ) ) {
		require_once TEMPLATEPATH.'/library/mobile-detect.php';
		$detect = new Mobile_Detect;
		$check = $detect->isMobile();
	}
?>
<!DOCTYPE HTML>
<html <?php language_attributes() ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title>
		<?php global $page, $paged; wp_title( '|', true, 'right' ); //bloginfo( 'name' );
	
		// Add the blog description for the home/front page.
		// $site_description = get_bloginfo( 'description', 'display' );
		// if ( $site_description && ( is_home() || is_front_page() ) )
		// 	echo " | $site_description";
	
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'cebolang' ), max( $paged, $page ) );
		?>
	</title>
	<?php 
		if ( file_exists( dirname( __FILE__ ) . '/noindex.php' ) ) {
		    include( dirname( __FILE__ ) . '/noindex.php' );
		}
	?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="profile" href="//gmpg.org/xfn/11" />	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if (get_option('cebo_custom_favicon') == '') { ?>	
	<link rel="icon" href="<?php bloginfo ('template_url'); ?>/cebo_options/<?php bloginfo ('template_url'); ?>/images/admin_sidebar_icon.png" type="image/x-ico"/>	
	<?php } else { ?>
	
	<link rel="icon" href="<?php echo get_option('cebo_custom_favicon'); ?>" type="image/x-ico"/>
	
	<?php } ?>
	
	
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( get_option('cebo_feedburner_url') <> "" ) { echo get_option('cebo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
	
	<!-- favicon -->

	<link rel="shortcut icon" href="<?php bloginfo ('template_url'); ?>/icfavicon.png" type="image/png">
	<link rel="icon" href="icfavicon.png" type="image/png">
	
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	
	<link rel="stylesheet" type="text/css" href="<?php bloginfo ('template_url'); ?>/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo ('template_url'); ?>/css/custom.css">

	<!-- Fonts -->
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Libre+Baskerville:400,400italic,700' rel='stylesheet' type='text/css'>
	
	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo ('template_url'); ?>/css/quotes-rotator/component.css" />
	<link rel="stylesheet" href="<?php bloginfo ('template_url'); ?>/css/slidejs.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo ('template_url'); ?>/js/flexslider/flexslider.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo ('template_url'); ?>/css/jquery.mmenu.css">

	<?php if ( 'rooms' == get_post_type() ) 	{ ?>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo ('template_url'); ?>/css/iosslider.css">
	<?php } ?>

	<!-- Custom Plugin Settings -->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo ('template_url'); ?>/css/custom-plugins.css">

	<!-- responsive style -->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo ('template_url'); ?>/css/media.css">

	<!-- Color Override CSS -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php bloginfo ('template_url'); ?>/css/oceana-hotel.css"> -->
	
	<style>
	<?php include(TEMPLATEPATH. "/library/inset.php"); ?>	
	</style>

	<!-- Jquery -->
	<?php //include(TEMPLATEPATH. "/library/jquery.php"); ?>	
	<script type="text/javascript" src="//code.jquery.com/jquery-1.8.2.min.js"></script>
	<script type='text/javascript' src='<?php bloginfo ('url'); ?>/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.2.1'></script>
	

	<!-- pinterest -->
	<meta name="p:domain_verify" content="fdcd1755542385831e526a2a712cc134"/>

	<?php
		/****************** DO NOT REMOVE **********************
		/* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
		wp_head();
	?>

<!-- Google Tag Manager -->

<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W8NRVV2');</script>

<!-- End Google Tag Manager -->

<!-- Sojern Head -->
<script>
(function () {
var pl = document.createElement('script');
pl.type = 'text/javascript';
pl.async = true;
pl.src = 'https://beacon.sojern.com/pixel/p/3035';(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(pl);
})();
</script>
<!-- End Sojern -->

	<script type="application/ld+json">
		{
		"@context": "//schema.org",
		"@type": "NewsArticle",
		"headline": "Article headline",
		"alternativeHeadline": "The headline of the Article",
		"image": [
		"thumbnail1.jpg",
		"thumbnail2.jpg"
		],
		"datePublished": "2015-02-05T08:00:00+08:00",
		"description": "A most wonderful article",
		"articleBody": "The full body of the article"
		}
	</script> 
	
<script> 

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new
Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-37161096-1', 'auto',{'allowLinker': true });
ga('require', 'linker'); ga('linker:autoLink', ['theboxerboston.reztrip.com','theboxerboston.reztripmobile.com']);
ga('send', 'pageview');

</script>

<script type="text/javascript">
function viewContent(){

	fbq('track', "ViewContent");

}
</script>

</head> 
	
<body id="oceana" <?php body_class($class); ?>>

<!-- Google Tag Manager (noscript) -->

<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W8NRVV2"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<!-- End Google Tag Manager (noscript) -->

<div class="menu-wrap">

	<div id="navigation">
			
			<div class="ressys">
				
				<div class="whippapeal">
				<div class="formfields">
				
					<div class="reservationform">
					
					
						<form method="get" action="https://theboxerboston.reztrip.com">

						<input type="hidden" value="1" name="rooms">
						
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
						
						<button type="submit" class="button" onClick="fbq('track', 'Lead'); ga('send', 'event', 'Booking-widget', 'Search-now', 'Search dates with booking widget');">Search Now</button>
						
					
						</form>
				
					</div>

				<!-- flex dates -->

					<div class="reservationform flexdate">
					
						<p><a href="https://theboxerboston.reztrip.com" onclick="fbq('track', 'Lead'); ga('send', 'event', 'Flexible Dates', 'click', 'Booking-widget');">Flexible dates?</a> Search for our best available rate</p>
						
					</div>

				<!-- end flex dates -->

				</div>
				
				<div class="calendars">
					
					 <div class="datepicker"></div>
				
				
				</div>
				
				</div>
			</div>
			
			
		<div id="property-nav">
			<div class="pride pos-right">
				<img src="<?php bloginfo('template_directory'); ?>/images/pride.png">
				<a href="#"><i class="fa fa-info-circle" aria-hidden="true"></i>Celebrate Pride</a>
			</div>
			<div class="pride pos-left">
				<img src="<?php bloginfo('template_directory'); ?>/images/pride-left.png">	
			</div>
			<nav class="click-nav" style="border: none;">
			<nav class="click-nav">
				<ul class="container no-js">
					<li>
						<a href="//www.iclocalrewards.com/" target="_blank" class="clicknav-clicker">Join IC Local and Start Receiving Perks with Every Stay</a>	
					</li>
					<li class="blue-btn"><a href="//theboxerboston.com/blue"><i class="fa fa-info-circle"></i><span class="blue-mobile">why blue?</span></a></li>
				</ul>
			</nav>
			
			
			
	
		</div>
	
		<div id="primary-nav">
		
			<a href="<?php bloginfo('url'); ?>" class="logo<?php if(is_home()) { ?> droplogo<?php } ?>"><img src="<?php echo get_option('cebo_logo'); ?>" alt="<?php echo the_title(); ?>" /></a>

			<a href="<?php bloginfo('url'); ?>" class="logo mobile"><img src="<?php echo get_option('cebo_logo'); ?>" alt="<?php echo the_title(); ?>" /></a>
			
			<a href="https://theboxerboston.reztrip.com" class="reserve fixeer button fr input-append date" rooms ="1" id="idp3" data-date="12-02-2012" data-date-format="mm-dd-yyyy">RESERVE</a>

			<a class="reserve fixeer mobile button fr" id="idp4"  onclick=" ga('send', 'event', 'Booking', 'Reserve'); _gaq.push(['_link', this.href]);return false;" href="<?php echo get_option('cebo_genbooklink'); ?>" target="_blank">RESERVE</a>
			
			<div class="container" style="float: right;">

				<a class="mmenu-icon" href="#menu"><i class="fa fa-bars"></i></a>
	
				<nav id="menu" class="fl" style="z-index:1">
					<ul>
						<?php wp_nav_menu( array( 'theme_location' => 'primary' ,  'items_wrap' => '%3$s', 'container' => '', 'menu_class' => 'navitem' ) ); ?>
						<li class="hamburgermenu">
							<a class="cheese" href="#">
								<div class="hamburger">
									<span></span>
									<span></span>
									<span></span>
								</div>
								<span class="menutext">Menu</span>
							</a>
						</li>
						<?php wp_nav_menu( array( 
							'theme_location' => 'mobilenav',
							'items_wrap' => '%3$s', 
							'container' => ''
						)); ?>
					</ul>
				</nav>
	
			</div>

		</div>

	</div>
	
	<div id="quiet"></div>