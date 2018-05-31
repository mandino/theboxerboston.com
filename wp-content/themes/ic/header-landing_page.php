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
    
    <style>.async-hide { opacity: 0 !important} </style>
    <script>(function(a,s,y,n,c,h,i,d,e){s.className+=' '+y;h.start=1*new Date;
    h.end=i=function(){s.className=s.className.replace(RegExp(' ?'+y),'')};
    (a[n]=a[n]||[]).hide=h;setTimeout(function(){i();h.end=null},c);h.timeout=c;
    })(window,document.documentElement,'async-hide','dataLayer',4000,
    {'GTM-5XBBBWD':true});</script>
    
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
	<link rel="stylesheet" type="text/css" href="<?php bloginfo ('template_url'); ?>/css/landingpage.css">

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
	
    <!--    slick css-->
    <link rel="stylesheet" type="text/css" href="<?php bloginfo ('template_url'); ?>/js/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo ('template_url'); ?>/js/slick/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo ('template_url'); ?>/css/magnific-popup.css">
	<!-- Color Override CSS -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php bloginfo ('template_url'); ?>/css/oceana-hotel.css"> -->
	
	<style>
	<?php include(TEMPLATEPATH. "/library/inset.php"); ?>	
	</style>

	<!-- Jquery -->
	<?php //include(TEMPLATEPATH. "/library/jquery.php"); ?>	
<!--	<script type="text/javascript" src="//code.jquery.com/jquery-1.8.2.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
	})(window,document,'script','dataLayer','GTM-5XBBBWD');</script>
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

	<script>
		!function(w,d,s,u) {
		if(window.curacity) { return; }
		window.curacity = function() { window.curacity.callMethod ?
		window.curacity.callMethod.apply(window.curacity, arguments) :
		window.curacity.queue.push(arguments); }
		window.curacity.version = '1.0';
		window.curacity.queue = [];
		var scriptElement = document.createElement(s);
		scriptElement.type = 'text/javascript';
		scriptElement.async = true;
		scriptElement.src = u;
		var e = d.getElementsByTagName(s)[0];
		e.parentNode.insertBefore(scriptElement,e);
		}(window, document, 'script',
		'https://booking.curacity.com/api/js/curacity_events.js');
		curacity('init', 'merchant', '365'); // 365 = hotel id
		curacity('track', 'view_checkout', null);
	</script>

	<noscript>
		<img height="1" width="1" style="display: none" src="https://booking.curacity.com/trackevent?merchant_id=365&ev=view_checkout&noscript=1" />
	</noscript>

</head> 
	
<body id="oceana" <?php body_class($class); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5XBBBWD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="menu-wrap">

	<div id="navigation" class="lp-navigation">
			
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
						
						<button type="submit" class="button">Search Now</button>
						
					
						</form>
				
					</div>

				<!-- flex dates -->

					<div class="reservationform flexdate">
					
						<p><a href="https://theboxerboston.reztrip.com/calendar">Flexible dates?</a> Search for our best available rate</p>
						
					</div>

				<!-- end flex dates -->

				</div>
				
				<div class="calendars">
					
					 <div class="datepicker"></div>
				
				
				</div>
				
				</div>
			</div>
			
				
		<div id="primary-nav" class="landing-page display-none" style="overflow:visible;position: absolute;top: 0px;z-index: 1;width: 100%;">
          <?php if ( have_rows('landing_page') ) : while( have_rows('landing_page') ) : the_row(); ?>
            <?php if(get_row_layout() == 'banner') :?>  
              <div class="landing-page-logo-header">
                  <a href="<?php bloginfo('url'); ?>"><img src="<?php echo get_sub_field('landing_page_logo')['url']?>" alt=""/></a>
              </div>
             <?php endif; ?>
        <?php endwhile; endif; ?>

           <a href="https://theboxerboston.reztrip.com" class="reserve fixeer button fr input-append date lp-button " rooms ="1" id="idp3" data-date="12-02-2012" data-date-format="mm-dd-yyyy">RESERVE</a>

			<a class="reserve fixeer mobile button fr lp-button" id="idp4"  onclick="_gaq.push(['_link', this.href]);return false;" href="<?php echo get_option('cebo_genbooklink'); ?>">RESERVE</a>
			
			
		</div>
	</div>
	
<!--	<div id="quiet"></div>-->