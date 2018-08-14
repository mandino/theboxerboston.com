<!--<script src="//code.jquery.com/mobile/1.4.1/jquery.mobile-1.4.1.min.js"></script>-->
	<script type="text/javascript" src="<?php bloginfo ('template_url'); ?>/js/jquery.prettyPhoto.js"></script>

	<!-- ClickNav -->
	<script type="text/javascript" src="<?php bloginfo ('template_url'); ?>/js/jquery-clicknav.js"></script>

	<!-- Lightbox - Prettyphoto -->	
	<link rel="stylesheet" href="<?php bloginfo ('template_url'); ?>/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet"/>

	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.vide.js"></script>

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
	
<!--    slick carousel-->
    <script src="<?php bloginfo ('template_url'); ?>/js/slick/slick.min.js"></script>
    <script src="<?php bloginfo ('template_url'); ?>/js/jquery.magnific-popup.min.js"></script>

	<!-- Jquery Sticky -->
	<script type="text/javascript" src="<?php bloginfo ('template_url'); ?>/js/jquery.sticky.js"></script>

	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.lazyloadxt.extra.js"></script>

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

<!--    countdown picker-->
    <script type="text/javascript" src="<?php bloginfo ('template_url'); ?>/js/ticker.js"></script>


<script type="text/javascript">

	$(document).ready(function(){
		$(".eat-tab-button").click(function() {
			var id = "#"+$(this).data('class');
			$('.eat-menu-container').removeClass('showMenu');
			$('.eat-menu-container').addClass('hideMenu');
			$(id).removeClass('hideMenu');
			$(id).addClass('showMenu');
		});

		$(".drink-tab-button").click(function() {
			var id = "#"+$(this).data('class');
			console.log(id)
			$('.drink-menu-container').removeClass('showMenu');
			$('.drink-menu-container').addClass('hideMenu');
			$(id).removeClass('hideMenu');
			$(id).addClass('showMenu');
		});


		$( window ).resize(function() {
			if ($(window).width() > 1024) {

				if ($('.read-more-button').length) {
					$('.read-more').attr('style', '');
					$('.read-more-button').get(0).firstChild.nodeValue = "Read More";
					$('.read-more-button').parent().addClass('relative');
					$('.read-more-button i').removeClass('fa-angle-up');
					$('.read-more-button i').addClass('fa-angle-down');
				}
			}
		});

		$('.white-shadow').parent().addClass('relative');

		$('.read-more-button').click(function() {
			if ($(window).width() <= 1024) {
				if($(this).parent().hasClass('relative')) {
					$(this).parent().removeClass('relative');
					$('.read-more-button i').removeClass('fa-angle-down');
					$('.read-more').slideDown(1000);
					$(this).get(0).firstChild.nodeValue = "Read Less";
					$('.read-more-button i').addClass('fa-angle-up');
				} else {
					$(this).parent().addClass('relative');
					$('.read-more').slideUp(1000);
					$(this).get(0).firstChild.nodeValue = "Read More";
					$('.read-more-button i').removeClass('fa-angle-up');
					$('.read-more-button i').addClass('fa-angle-down');
				}
			}
		});
		
		// ACCORDION BOX
		$('.accbox-btn').click(function() {
			var accBoxItem = $(this).parent().parent();
			if ( accBoxItem.hasClass('active') ) {
				accBoxItem.removeClass('active');
				accBoxItem.find('.accbox-hidden').slideUp();
			} else {
				accBoxItem.addClass('active');
				accBoxItem.find('.accbox-hidden').slideDown();
			}
		});

		// if ($(window).width() > 399) {
			$("a[rel^='prettyPhoto']").prettyPhoto({
		    	default_width: 800,
		    	default_height: 600
		    });
		// }
	    
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
    
//    countdown picker
    
    $(window).scroll(function() {
        var verschil = ($(window).scrollTop() / 5);

        if (verschil > 40) {
            $('.droplogo').addClass('jumpshot');
            $('.ticker').addClass('ticker-down');
        } else if (verschil < 40) {
            $('.droplogo').removeClass('jumpshot');
            $('.ticker').removeClass('ticker-down');
        }
    });



	 // Calendar in Navigation

	 $(function() {

		if ($(window).width() > 940) {
			$('#menus').removeClass('mm-menu mm-horizontal mm-ismenu');
			$('#menu').removeClass('mm-list mm-panel mm-opened mm-current');
		} else {
			$('#menus').addClass('mm-menu mm-horizontal mm-ismenu');
			$('#menu').addClass('mm-list mm-panel mm-opened mm-current');
			$('body').prepend($('#menus'));
		}

		$('.mmenu-icon .fa.fa-bars').click(function(){
			if($('#menus').hasClass('mm-opened')) {
				$('html').removeClass('mm-background mm-opened mm-opening');
				$('#menus').removeClass('mm-current mm-opened');
				$('.mm-page').attr('style','');
			} else {
				$('html').addClass('mm-background mm-opened mm-opening');
				$('#menus').addClass('mm-opened mm-current');
				$('.mm-page').attr('style','width: ' + $(window).width() + 'px');
			}

		});

		$('.menu-wrap').wrap('<div class="mm-page"></div>');

		$.each($('#menu li'), function(index, value){
			if ($(value).hasClass('menu-item-has-children')) {
				$(value).first().append('<div class="button"></div>');
			}
		});

		$(document).on('click', '.button', function() {
			$sub_menu = $(this).parent().find('.sub-menu');

			if ($(this).hasClass('show')) {
				$(this).removeClass('show');
			} else {
				$(this).addClass('show');
			}

			if ($sub_menu.hasClass('display-block')) {
				$sub_menu.removeClass('display-block');
				$sub_menu.slideToggle(500);
			} else {
				$sub_menu.addClass('display-block');
				$sub_menu.slideToggle(500);
			}

		});
			
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
				$('#menus').removeClass('mm-menu mm-horizontal mm-ismenu');
				$('#menu').removeClass('mm-list mm-panel mm-opened mm-current');
				$('#primary-nav .container').prepend($('#menus'));
				$('.mm-page').attr('style','');
				$('.sub-menu').attr('style', '');
				$('.button').removeClass('show');
				$('html').removeClass('mm-background mm-opened mm-opening');
			} else {
				$('#menus').removeClass('mm-current mm-opened');
				$('.mm-page').attr('style','');
				$('.sub-menu').attr('style', '');
				$('.button').removeClass('show');
				$('html').removeClass('mm-background mm-opened mm-opening');
				$('#menus').addClass('mm-menu mm-horizontal mm-ismenu');
				$('#menu').addClass('mm-list mm-panel mm-opened mm-current');
				$('body').prepend($('#menus'));
			}

			if ($(window).width() > 1024 ) {
				$('#home-slider.home-video').css('height', 'calc(' + $(window).height() + 'px - ' + ($('.section-header').height() + $('#primary-nav').height() + $('#property-nav').height() + 30) + 'px)');
			} else {
				$('#home-slider.home-video').css('height', '');
			}

		});


		$(".hamburgermenu a").click(function(e){
			e.preventDefault();
			$(".mm-page").addClass("opened");
			$(".rightnav").addClass("rightready");
			$("section.stophovering").css("display","block");
		});

		$('.royale,.stophovering').click(function(e){
			e.preventDefault();
			$(".mm-page").removeClass("opened");
			$(".rightnav").removeClass("rightready");
			$("section.stophovering").css("display","none");
			$(".closer").removeClass("open-left");
		});

		$('#navmenumob li').each(function() {
			if ($(this).hasClass('menu-item-has-children')) {
				$(this).find('.tnbox').append('<i class="fa fa-plus"></i>');
			}
		});

		$('.topnavigationmob li i.fa-plus').click(function() {
			if ($(this).hasClass('fa-plus')) {
				$(this).removeClass('fa-plus');
				$(this).addClass('fa-minus');
				$(this).addClass('active');
				$(this).closest('li').find('.sub-menu').addClass('open');
			} else {
				$(this).addClass('fa-plus');
				$(this).removeClass('fa-minus');
				$(this).removeClass('active');
				$(this).closest('li').find('.sub-menu').removeClass('open');
			}
			
		});

		$(window).load(function() {
            try{
			// Home - Video Banner
			var check_home = $('video').length;

			if (check_home) {
				$('video').get(0).play();
			}

			if ( vide_video ) {
				$('.video-banner-onload').vide(vide_video);
			}
                
            }catch(err) {
                console.log(err.message);
            }
		});

		if ($(window).width() > 1024 ) {
			$('#home-slider.home-video').css('height', 'calc(' + $(window).height() + 'px - ' + ($('.section-header').height() + $('#primary-nav').height() + $('#property-nav').height() + 30) + 'px)');
		} else {
			$('#home-slider.home-video').css('height', '');
		}

	});
    
    

    
//mobile booking
    
    jQuery( document ).ready(function( $ ) {
        if ($(window).width() < 768) {
            $('.button').removeAttr('target');
       }

       	if (!localStorage.getItem("cookies")) {
			$('.cookie-consent').css("display", "block");
	   	}
		$('.cookie-consent__accept-btn').on('click', function () {
		    if (typeof(Storage) !== "undefined") {
		    	if (!localStorage.getItem("cookies")) {
					localStorage.cookies = "accept";
					$('.cookie-consent').css("display", "none");
		    	}
			}
		});

    });
    
//landing page
  
jQuery(window).scroll(function () {

	if ( $(window).scrollTop() >=  250 ) {
		$('body').addClass('onscroll');
        $('.landing-page').removeClass('display_none');
        $(".landing-page").fadeIn(700);
		
       // $('landing-page-logo img').fadeIn(500);
	} else {
		$('body').removeClass('onscroll');
        $(".landing-page").fadeOut(300);
       // $('landing-page-logo img').fadeIn(500);
		$('.landing-page').addClass('display_none');
	}

});       
    
//slick
jQuery(document).ready(function($) {
    
 $('.lp-slider, .lp-slider-no-map').slick({
      dots: false,
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true,
      arrows: true,
      fade: true,
      cssEase: 'linear',
      prevArrow: $('.lp-slider-prev'),
      nextArrow: $('.lp-slider-next')
  });
    
    var gallery_magnific_popup = {
		type: 'image',
		closeOnContentClick: false,
		closeBtnInside: false,
		mainClass: 'gallery-mfp',
		image: {
			verticalFit: true,
			titleSrc: function(item) {
				return item.el.attr('title');
			}
		},
		gallery: {
			enabled: true
		},
		zoom: {
			enabled: true,
			duration: 300, // don't foget to change the duration also in CSS
			opener: function(element) {
				return element.find('img');
			}
		}
	}
    
  $('.lp-icon-link').magnificPopup(gallery_magnific_popup);    
    
  $('.accordion-titlebox').on('click', function() {
		$btn = $(this).find('.accordion-btn');
		$hiddenContent = $(this).parent().find('.accordion-contentbox');

		if( $btn.hasClass('accordion-btn-plus') ) {
			$btn.removeClass('accordion-btn-plus');
			$btn.addClass('accordion-btn-minus');

			$hiddenContent.slideDown();
		} else {
			$btn.removeClass('accordion-btn-minus');
			$btn.addClass('accordion-btn-plus');

			$hiddenContent.slideUp();
		}

  });    
   
});
    
jQuery(window).resize(function() {
	docReady_winResize_functions();
});
    
jQuery(document).ready(function() {
     docReady_winResize_functions();
});
    
function fullBleedImage( elem, multiplier ) {

	var getHeight = jQuery(window).height();
	var getWidth = jQuery(window).width();

	elem.css('height', ''); // reset

	elem.height(getHeight * multiplier);

}    
    
function docReady_winResize_functions() {
	fullBleedImage( jQuery('.banner--40'), 0.4 );
	fullBleedImage( jQuery('.banner--50'), 0.5 );
	fullBleedImage( jQuery('.banner--60'), 0.6 );
	fullBleedImage( jQuery('.banner--70'), 0.7 );
	fullBleedImage( jQuery('.banner--80'), 0.8 );
	fullBleedImage( jQuery('.banner--90'), 0.9 );
	fullBleedImage( jQuery('.banner--100'), 1 );
	
}      

    
    
</script>