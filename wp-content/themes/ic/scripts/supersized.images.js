			jQuery(function($){
				
				$.supersized({
				
					// Functionality
					slideshow               :   1,			// Slideshow on/off
					autoplay				:	1,			// Slideshow starts playing automatically
					start_slide             :   1,			// Start slide (0 is random)
					stop_loop				:	0,			// Pauses slideshow on last slide
					random					: 	0,			// Randomize slide order (Ignores start slide)
					slide_interval          :   12000,		// Length between transitions
					transition              :   1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed		:	1000,		// Speed of transition
					new_window				:	1,			// Image links open in new window/tab
					pause_hover             :   0,			// Pause slideshow on hover
					keyboard_nav            :   1,			// Keyboard navigation on/off
					performance				:	1,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
					image_protect			:	1,			// Disables image dragging and right click with Javascript
															   
					// Size & Position						   
					min_width		        :   0,			// Min width allowed (in pixels)
					min_height		        :   0,			// Min height allowed (in pixels)
					vertical_center         :   1,			// Vertically center background
					horizontal_center       :   1,			// Horizontally center background
					fit_always				:	0,			// Image will never exceed browser width or height (Ignores min. dimensions)
					fit_portrait         	:   1,			// Portrait images will not exceed browser height
					fit_landscape			:   0,			// Landscape images will not exceed browser width
															   
					// Components							
					slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
					thumb_links				:	0,			// Individual thumb links for each slide
					thumbnail_navigation    :   0,			// Thumbnail navigation
					slides 					:  	[			// Slideshow Images
														{image : './images/feat-bg1.jpg', title : '<div class="major">Apollo</div><div class="slidedescription">Quisque non magna ac tortor tincidunt posuere. Vestibulum luctus aliquet gravida. Etiam non dolor sit amet libero porttitor egestas quis sed urna.</div><ul class="footprints"><li><a href="">Our Work</a></li><li><a href="">Our Blog</a></li><li><a href="">Our People</a></li><ul>', thumb : '', url : '#'},
														{image : './images/feat-bg6.jpg', title : '<div class="major">LIVE EPIC</div><div class="slidedescription">What a piece of work is a man, how noble in reason, how infinite in faculties, in form and moving how express and admirable, in action how like an angel, in apprehension how like a god.</div>', thumb : '', url : '#'},
														{image : './images/feat-bg2.jpg', title : '<div class="major minor">&hellip; or lavishly</div><div class="slidedescription">As a space, Work Happy hosts events regularly with the intent to educate and grow our local creative community. From courses on web design and programming, classes on photography, to community meetups to help introduce creatives to other creatives. </div>', thumb : '', url : '#'},
														{image : './images/feat-bg3.jpg', title : '<div class="major">Apollo</div><div class="slidedescription">Desks start at $75 a month part time or $125 full time. All Co-workers have access to all Work Happuy events and meetups. Desks are month to month and the facility does have a security system.</div>', thumb : '', url : '#'},  
														{image : './images/feat-bg4.jpg', title : '<div class="major">Apollo</div><div class="slidedescription">Desks start at $75 a month part time or $125 full time. All Co-workers have access to all Work Happuy events and meetups. Desks are month to month and the facility does have a security system.</div>', thumb : '', url : '#'},  
														{image : './images/feat-bg5.jpg', title : '<div class="major">Apollo</div><div class="slidedescription">Desks start at $75 a month part time or $125 full time. All Co-workers have access to all Work Happuy events and meetups. Desks are month to month and the facility does have a security system.</div>', thumb : '', url : '#'}  
												],
												
					// Theme Options			   
					progress_bar			:	0,			// Timer for each slide							
					mouse_scrub				:	0
					
				});
		    });
