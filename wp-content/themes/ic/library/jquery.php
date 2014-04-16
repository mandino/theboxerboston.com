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
<link rel="stylesheet" type="text/css" href="<?php bloginfo ('template_url'); ?>/css/oceana-hotel.css">

<!-- JS -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<!--<script src="http://code.jquery.com/mobile/1.4.1/jquery.mobile-1.4.1.min.js"></script>-->
<script async type="text/javascript" src="<?php bloginfo ('template_url'); ?>/js/jquery.prettyPhoto.js"></script>

<!-- ClickNav -->
<script type="text/javascript" src="<?php bloginfo ('template_url'); ?>/js/jquery-clicknav.js"></script>

<!-- Lightbox - Prettyphoto -->	
<link rel="stylesheet" href="<?php bloginfo ('template_url'); ?>/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet"/>	

<!-- Pinterest -->
<script async type="text/javascript" async src="http://assets.pinterest.com/js/pinit.js"></script>

<!-- Custom Modernizr for Quotes Rotator -->
<script async src="<?php bloginfo ('template_url'); ?>/js/quotes-rotator/modernizr.custom.js"></script>

<!-- Quotes Rotator -->
<script async src="<?php bloginfo ('template_url'); ?>/js/quotes-rotator/jquery.cbpQTRotator.min.js"></script>

<!-- SlideJS -->
<script async src="<?php bloginfo ('template_url'); ?>/js/jquery.slides.min.js"></script>

<!-- Flex Slider -->
<script src="<?php bloginfo ('template_url'); ?>/js/flexslider/jquery.flexslider.js"></script>

<!-- Jquery Sticky -->
<script type="text/javascript" src="<?php bloginfo ('template_url'); ?>/js/jquery.sticky.js"></script>

<!-- Jquery UI -->
<!-- <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js?ver=3.5.2'></script> -->

<!-- Iosslider -->
<?php if ( 'rooms' == get_post_type() ) 	{ ?>
	<script src="<?php bloginfo ('template_url'); ?>/js/jquery.iosslider.min.js"></script>
<?php } ?>

<!-- jquery mmenu -->
<script async src="<?php bloginfo ('template_url'); ?>/js/jquery.mmenu.min.js"></script>

<!-- Optional FlexSlider Additions -->
<!-- <script src="<?php bloginfo ('template_url'); ?>/js/jquery.easing.js"></script> -->
<script async src="<?php bloginfo ('template_url'); ?>/js/jquery.mousewheel.js"></script>