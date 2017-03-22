<!--<script src="//code.jquery.com/mobile/1.4.1/jquery.mobile-1.4.1.min.js"></script>-->
	<script type="text/javascript" src="<?php bloginfo ('template_url'); ?>/js/jquery.prettyPhoto.js"></script>

	<!-- ClickNav -->
	<script type="text/javascript" src="<?php bloginfo ('template_url'); ?>/js/jquery-clicknav.js"></script>

	<!-- Lightbox - Prettyphoto -->	
	<link rel="stylesheet" href="<?php bloginfo ('template_url'); ?>/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet"/>	

	<!-- Pinterest -->
	<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>

	<!-- Custom Modernizr for Quotes Rotator -->
	<script src="<?php bloginfo ('template_url'); ?>/js/quotes-rotator/modernizr.custom.js"></script>

	<!-- Quotes Rotator -->
	<script src="<?php bloginfo ('template_url'); ?>/js/quotes-rotator/jquery.cbpQTRotator.js"></script>

	<!-- SlideJS -->
	<script src="<?php bloginfo ('template_url'); ?>/js/jquery.slides.min.js"></script>

	<!-- Flex Slider -->
	<script src="<?php bloginfo ('template_url'); ?>/js/flexslider/jquery.flexslider.js"></script>

	<!-- Jquery Sticky -->
	<script type="text/javascript" src="<?php bloginfo ('template_url'); ?>/js/jquery.sticky.js"></script>

	<!-- Jquery UI -->
	<!-- <script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js?ver=3.5.2'></script> -->

	<!-- Iosslider -->
	<?php if ( 'rooms' == get_post_type() ) 	{ ?>
		<script src="<?php bloginfo ('template_url'); ?>/js/jquery.iosslider.min.js"></script>
	<?php } ?>

	<!-- jquery mmenu -->
	<script src="<?php bloginfo ('template_url'); ?>/js/jquery.mmenu.min.js"></script>

	<!-- Optional FlexSlider Additions -->
	<!-- <script src="<?php bloginfo ('template_url'); ?>/js/jquery.easing.js"></script> -->
	<script src="<?php bloginfo ('template_url'); ?>/js/jquery.mousewheel.js"></script>

<script type="text/javascript">

	$(document).ready(function(){

		if ($(window).width() > 399) {
			$("a[rel^='prettyPhoto']").prettyPhoto({
		    	default_width: 800,
		    	default_height: 600
		    });
		}
	    
		$(".closebox a").click(function(e) {
			e.preventDefault();
			
			$(".specialsbox").addClass("shutit");

			
		})

	    // Hidden calendar

	    $("#primary-nav .button.input-append.date").hover(function() {
					
			$(".ressys").addClass("dropit");
			$(this).removeClass("fixeer");
		
		},function(){
		
			$(".ressys").removeClass("dropit");
		
		
		});

		$("#primary-nav .button.input-append.date").toggle(function() {
					
			$(".ressys").addClass("dropit");
			$(this).removeClass("fixeer");
		
		},function(){
		
			$(".ressys").removeClass("dropit");
		
		
		});
		
		


		// Reserve button hover
		
		 $('.ressys').hover(function() {
			$("#primary-nav .button").stop().addClass("nothingness");
			
			
		 	}, function() {
	 		$("#primary-nav .button").removeClass("nothingness");			
		 });

		$('.slides-mini').slidesjs({
		    width: 540,
		    height: 292,
		    navigation: false,
		    effect: {
			      slide: {
			        // Slide effect settings.
			        speed: 500
			          // [number] Speed in milliseconds of the slide animation.
			      },
			      fade: {
			      	speed: 1000,
			      	crossfade: true
			      }
			  },
			  navigation: {
			      active: false,
			        // [boolean] Generates next and previous buttons.
			        // You can set to false and use your own buttons.
			        // User defined buttons must have the following:
			        // previous button: class="slidesjs-previous slidesjs-navigation"
			        // next button: class="slidesjs-next slidesjs-navigation"
			      effect: "fade"
			        // [string] Can be either "slide" or "fade".
			    },
		    pagination: {
		    	effect: 'fade',
		    }
		});



		// Flexslider

		$('.flexslider').flexslider({
			animation: "fade",
			animationSpeed: 1200,
			slideshowSpeed: 3500,
			pauseOnAction: false,
		});



		// Datepicker
		$.datepicker._defaults.dateFormat = 'yy-mm-dd';
		
		$(".datepicker").datepicker({
			minDate: 0,
			numberOfMonths: [2,1],
			beforeShowDay: function(date) {
				var date1 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#arrival_date").val());
				var date2 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#departure_date").val());
				return [true, date1 && ((date.getTime() == date1.getTime()) || (date2 && date >= date1 && date <= date2)) ? "dp-highlight" : ""];
			},
			onSelect: function(dateText, inst) {
				var date1 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#arrival_date").val());
				var date2 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#departure_date").val());
                var selectedDate = $.datepicker.parseDate($.datepicker._defaults.dateFormat, dateText);

                
                if (!date1 || date2) {
					$("#arrival_date").val(dateText);
					$("#departure_date").val("");
                    $(this).datepicker();
                } else if( selectedDate < date1 ) {
                    $("#departure_date").val( $("#arrival_date").val() );
                    $("#arrival_date").val( dateText );
                    $(this).datepicker();
                } else {
					$("#departure_date").val(dateText);
                    $(this).datepicker();
				}
			}
		});



		// Question box

		 $("input.check").click(function(){
	        if($(this).is(":checked")){
	            $(this).parent().addClass("question-box-active");
	        }
	    });



		// Pretty Photo

	    $('a[rel=tooltip]').mouseover(function(e) {
	         
	        //Grab the title attribute's value and assign it to a variable
	        var tip = $(this).attr('title');   
	         
	        //Remove the title attribute's to avoid the native tooltip from the browser
	        $(this).attr('title','');
	         
	        //Append the tooltip template and its value
	        $(this).append('<div id="tooltip"><div class="tipHeader"></div><div class="tipBody">' + tip + '</div><div class="tipFooter"></div></div>');    
	         
	        //Set the X and Y axis of the tooltip
	        $('#tooltip').css('top', e.pageY + 10 );
	        $('#tooltip').css('left', e.pageX + 20 );
	         
	        //Show the tooltip with faceIn effect
	        $('#tooltip').fadeIn('500');
	        $('#tooltip').fadeTo('10',0.8);
	         
	    }).mousemove(function(e) {
	     
	        //Keep changing the X and Y axis for the tooltip, thus, the tooltip move along with the mouse
	        $('#tooltip').css('top', e.pageY + 10 );
	        $('#tooltip').css('left', e.pageX + 20 );
	         
	    }).mouseout(function() {
	     
	        //Put back the title attribute's value
	        $(this).attr('title',$('.tipBody').html());
	     
	        //Remove the appended tooltip template
	        $(this).children('div#tooltip').remove();
	         
	    });
	    
	    $('.section-photos').remove('.gallery');



	    // Tabbing - TABS FUNCTION

		// $('.tabs-wrapper').each(function() {
		// 	$(this).find(".tab-content").hide(); //Hide all content
		// 	$(this).find("ul.tabs li:first").addClass("active").show(); //Activate first tab
		// 	$(this).find(".tab-content:first").show(); //Show first tab content
		// });

		// $("ul.tabs li").click(function(e) {
		// 	$(this).parents('.tabs-wrapper').find("ul.tabs li").removeClass("active"); //Remove any "active" class
		// 	$(this).addClass("active"); //Add "active" class to selected tab
		// 	$(this).parents('.tabs-wrapper').find(".tab-content").hide(); //Hide all tab content

		// 	var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		// 	$("li.tab-item:first-child").css("background", "none" );
		// 	$(this).parents('.tabs-wrapper').find(activeTab).fadeIn(1000); //Fade in the active ID content
		// 	e.preventDefault();
		// });

		// $("ul.tabs li a").click(function(e) {
		// 	e.preventDefault();
		// })

		$("li.tab-item:last-child").addClass('last-item');

		<?php if( is_page_template('page_guide.php') ) { ?>

			$('.tabs li').removeClass('active');
			$('.tabs .<?php echo $post->post_name; ?>').addClass('active');

			<?php if(!is_page(62)) { ?>

				$('.tabs-wrapper').each(function() {
					$(this).find(".tab-content").hide(); //Hide all content
					$(this).find("#<?php echo $post->post_name; ?>.tab-content").show(); //Hide all content
				});

				var container = $('html'),
			    	scrollTo = $('#neighborhood-guide');

			    container.scrollTop(0),
				container.scrollTop(
				    10 + scrollTo.offset().top - container.offset().top + container.scrollTop()
				);


			<?php } else { ?>

				$('.tabs-wrapper').each(function() {
					$(this).find(".tab-content").hide(); //Hide all content
					$(this).find(".tab-content:first").show(); //Show first tab content
				});

				$('.tabs li:first-child').addClass('active');

			<?php } ?>

		<?php } ?>


		// iosslider

		<?php if ( 'rooms' == get_post_type() ) 	{ ?>

			$('#room-details-slider .iosSlider').iosSlider({
				snapToChildren: true,
				desktopClickDrag: true,
				infiniteSlider: true,
				snapSlideCenter: true,
				onSlideChange: slideChange,
				autoSlideTransTimer: 2000,
				keyboardControls: true,
				onSlideComplete: slideComplete,
				navNextSelector: $('.iosslider-next'),
			    navPrevSelector: $('.iosslider-prev'),
			});

			function slideComplete(args) {
					
				$('.iosslider-next, .iosslider-prev').removeClass('unselectable');
			    if(args.currentSlideNumber == 1) {
			        $('.iosslider-prev').addClass('unselectable');
			    } else if(args.currentSliderOffset == args.data.sliderMax) {
			        $('.iosslider-next').addClass('unselectable');
		    	}

		    }

			function slideChange(args) {

				try {
					console.log('changed: ' + (args.currentSlideNumber - 1));
				} catch(err) {
				}
				
				$('.indicators .item').removeClass('selected');
				$('.indicators .item:eq(' + (args.currentSlideNumber - 1) + ')').addClass('selected');

				$('.slideSelectors .item').removeClass('selected');
				$('.slideSelectors .item:eq(' + (args.currentSlideNumber - 1) + ')').addClass('selected');

				$('.iosSlider .item').removeClass('current');
			    $(args.currentSlideObject).addClass('current');

			}

			$('.iosSlider').bind('mousewheel', function(event, delta) {

			    var currentSlide = $('.iosSlider').data('args').currentSlideNumber;

			    //if delta is a positive number, go to prev slide. If delta is a negative number, go to next slide.
			    if(delta > 0) {

			        $('.iosSlider').iosSlider('goToSlide', currentSlide - 1);

			    } else {

			        $('.iosSlider').iosSlider('goToSlide', currentSlide + 1);

			    }

			});

		<?php } ?>

	


		// Sidebar not working fix

		$("body a").attr('data-ajax', false);

		$('.section-photos li').bind("vmousedown", function(){});

		$('.thumbgal li').bind("vmousedown", function(){});

		<?php if( $check ) { ?>

			$('.hover-effect').hide();
			
			$('.section-photos li, .imagegal li').toggle( function(){

				// $(this).children('.hover-effect').addClass('mobile-hovered');

				$(this).children('.hover-effect').fadeIn(500);

			}, function(){

				// $(this).children('.hover-effect').removeClass('mobile-hovered');

				$(this).children('.hover-effect').fadeOut(500).hide();

			});

			$('.special-external, .special-copy-link').click(function(){
				window.location.href = $(this).attr('href');
			});

		<?php  } ?>

	});



	$( function() {

		// Quotes Rotator

		$( '#cbp-qtrotator' ).cbpQTRotator();

	} );



	// Sticky Nav

	$(window).load(function(){
		$(".searchbox").sticky({ topSpacing: 61, className: 'sticky', wrapperClassName: 'my-wrapper' });
		$("#navigation").sticky({ topSpacing: 0, className: 'sticky', wrapperClassName: 'my-wrapper' });
		$("#quiet").sticky({ topSpacing: 0, className: 'unstick'});
	});



	// FadeIn logo

	 $(window).scroll(function() {
		        
        var verschil = ($(window).scrollTop() / 5);
    
      if (verschil > 40) 
            
           $('.droplogo').addClass('jumpshot');
        
        else if (verschil < 40)
            
           $('.droplogo').removeClass('jumpshot');
    });



	 // Calendar in Navigation

	 $(function() {

	 	var $html 	= $('html'),
			$menu	= $('nav#menu'),
			$both	= $html.add( $menu );

		$menu.mmenu();
			
	 	if ($(window).width() < 940) {
			   
		   var pos 	= 'mm-top mm-right mm-bottom',
				zpos	= 'mm-front mm-next';

			//	Add the position-classnames onChange
			$('input[name="pos"]').change(function() {
				$both.removeClass( pos ).addClass( 'mm-' + this.value );
			});
			$('input[name="zpos"]').change(function() {
				$both.removeClass( zpos ).addClass( 'mm-' + this.value );
			});

		} else {
		
		var $menu	= $('nav#menu');
				$menu.removeClass()
				$('nav#menu ul').removeClass()
				$('#primary-nav .container').prepend($menu);
		
		}


	 	$( window ).resize(function() {

			if ($(window).width() > 940) {

				var $menu	= $('nav#menu');
				$menu.removeClass()
				$('nav#menu ul').removeClass()
				$('#primary-nav .container').prepend($menu);

			} else {

				var $menu	= $('nav#menu');
				$menu.addClass('fl mm-menu mm-horizontal mm-ismenu')
				$('nav#menu ul').addClass('mm-list mm-panel mm-opened mm-current')
				$('html').prepend($menu);

			}

		});
			
	});

</script>