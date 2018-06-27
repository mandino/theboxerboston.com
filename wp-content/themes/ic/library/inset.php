<?php

$bgcolor = get_option('cebo_background_color');
$bgimg = get_option('cebo_background_image');
$bgrepeat = get_option('cebo_background_repeat');
$bgpos = get_option('cebo_background_position');
$accent = get_option('cebo_accent_color');
$accentsecond = get_option('cebo_second_color');	

function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);
 
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb);

}

function deleteFirstChar( $string ) {
	return substr( $string, 1 );
}



echo stripslashes(get_option('cebo_custom_css'));  

$rgb = hex2rgb($accent);

$rawcolor = deleteFirstChar( $accent );

if(get_option('cebo_accent_color')) { ?>



.mmenu-icon .fa.fa-bars { background: none repeat scroll 0 0 <?php echo $accent; ?>; }

.button:focus {
    background-color: <?php echo $accent; ?>;
}


 #room-featured-slider .button:hover,
 .upcoming-calendar .tribe-mini-calendar td.tribe-events-has-events:hover {
        background: none repeat scroll 0 0 <?php echo $accent; ?> !important;
    }

.fullpic .button:hover {
        background: none repeat scroll 0 0 <?php echo $accent; ?> !important;
}

.room-details-content .button:hover {
        background-color: <?php echo $accent; ?> !important;
        }

.sidebar .button:hover {
        background: <?php echo $accent; ?> !important;

}

.upcoming-events .fr li:hover .event-date {	background: <?php echo $accent; ?>; }

.upcoming-events li:hover .event-description {
background: none repeat scroll 0 0 <?php echo $accent; ?>;
}
	
nav .icon-mail:hover {  color: <?php echo $accent; ?>; }

nav .icon-mail { background: <?php echo $accent; ?>; }

.button {  background: <?php echo $accent; ?>; }

.circle { background: none repeat scroll 0 0 <?php echo $accent; ?>; }



a { color: <?php echo $accent; ?>; }

.button:focus { background-color: <?php echo $accent; ?>; }

.boxer .lowball { color: <?php echo $accent; ?>; }
	
.boxer h3 { color: <?php echo $accent; ?>; }
.boxer h6 {  color: <?php echo $accent; ?>; }    


.boxer a { color: <?php echo $accent; ?>; }   	


p a { color: <?php echo $accent; ?>; }	

.dropmenu select { border: 1px solid <?php echo $accent; ?>; }
 

.icon-menu { color: <?php echo $accent; ?>; }

#slidecaption .footprints li:hover {  background: <?php echo $accent; ?>; }

.boxer aside ul li a:hover { color: <?php echo $accent; ?>; }

ul.tabs li.active a { color: <?php echo $accent; ?>; }


#toggle-view li.activated:after { background: <?php echo $accent; ?>; }

.nextposters .boxer li a:hover h4 {
	color: <?php echo $accent; ?>;
}

.usercomments h4 i a {
	color: <?php echo $accent; ?>;
}

.social-buttons a:hover, .social-buttons i:hover {
		color: <?php echo $accent; ?>;
	}

#primary-nav nav ul li a:hover {
		color: <?php echo $accent; ?>;
	}

#primary-nav .button { background: none repeat scroll 0 0 <?php echo $accent; ?>;   }
 
 #neighborhood .section-header .fr li {
    background: none repeat scroll 0 0 <?php echo $accent; ?>;
    }
    
 .newsletter-form input[type="submit"] { background: none repeat scroll 0 0 <?php echo $accent; ?>; }
 
 	footer nav ul.footling li a:hover {
		color: <?php echo $accent; ?>;
	}
	


.ui-timepicker-div .ui-state-default,
.ui-timepicker-div .ui-widget-content .ui-state-default,
.ui-timepicker-div .ui-widget-header .ui-state-default {
    background: <?php echo $accent; ?>;

}

.dp-highlight .ui-state-default {
          background: <?php echo $accent; ?>;
         }


	   
#map .activities li { background: none repeat scroll 0 0 <?php echo $accent; ?>; }
  
.post-content h3 {
    color: <?php echo $accent; ?>;
 }
 
 .post-tags li a:hover, .post-tags li.current a {
	color: <?php echo $accent; ?>;
}

   
.post-content blockquote p {
    color: <?php echo $accent; ?>;
 }
 
 
  .wpcf7 input[type="submit"]:hover {
        background-color: <?php echo $accent; ?>;

    }
 
 
 .upcoming-calendar .tribe-mini-calendar td.tribe-events-has-events {
   background: none repeat scroll 0 0 <?php echo $accent; ?>;
}
      
.section-photos li div.hover-effect, .thumbgal li div.hover-effect {
background: none repeat scroll 0 0 rgba(<?php echo print_r($rgb); ?>, .8);
}


#neighborhood .section-header .fr li {
    background: none repeat scroll 0 0 <?php echo $accent; ?>;
}

footer nav ul.footling li a:hover {
		color: <?php echo $accent; ?>;
	}


.dp-highlight .ui-state-default {
          background: <?php echo $accent; ?>;
          color: #FFF;
        }
        
#map .activities li {  background: none repeat scroll 0 0 <?php echo $accent; ?>; }        
   
   
   
   
     .placeMark { 
	background: <?php echo $accentsecond; ?>;
  }
  
   #toggles li {

	background: <?php echo $accentsecond; ?>;

  }

.from-price { background: none repeat scroll 0 0 rgba(<?php echo print_r($rgb); ?>, 0.8); } 

.royalewrap,
.topnavigationmob li .tnbox i,
.hamburger span { 
  
  background-color: <?php echo $accent; ?>;

}

li.social_share_side a i,
.topnavigationmob li i {
  
  color: <?php echo $accent; ?>;

}

.read-more-button i {
  color: <?php echo $accent; ?>;
}

.ticker span,
.ticker a {
    background-color: <?php echo $accent; ?>; 
}


<?php } ?>