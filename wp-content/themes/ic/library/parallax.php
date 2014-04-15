<?php 


// ------------------------------------------
// converts a string with a stret address
// into a couple of lat, long coordinates.
// ------------------------------------------


$addressly = get_option('cebo_address');

function getLatLonger($addressly){
    if (!is_string($addressly))die("All Addresses must be passed as a string");
    $_urler = sprintf('http://maps.google.com/maps?output=js&q=%s',rawurlencode($addressly));
    $_resulter = false;
    if($_resulter = file_get_contents($_urler)) {
        if(strpos($_resulter,'errortips') > 1 || strpos($_resulter,'Did you mean:') !== false) return false;
        preg_match('!center:\s*{lat:\s*(-?\d+\.\d+),lng:\s*(-?\d+\.\d+)}!U', $_resulter, $_matcher);
        $_coordser['lat'] = $_matcher[1];
        $_coordser['long'] = $_matcher[2];
    }
    return $_coordser;
}

?>
	
	<div id="parallax2">
		<div class="bg2" style="background-image: url(<?php echo get_option('cebo_officepic'); ?>);"></div>
		<div class="pattern"></div>
		<div class="container">
			
			<div class="contact-container">
			
				<div class="third">
				
					<h3><?php echo get_option('cebo_cheader'); ?></h3>
					
					<div class="databox">
						
						<div class="leftmin">
							
							<p><?php echo get_option('cebo_cblurp'); ?></p>
						
						</div>
						
						<div class="rightmin">
						
							<p><?php echo get_option('cebo_address'); ?><br><?php echo get_option('cebo_phone'); ?></p>
							
							<br />
									
							<?php $coordinate = getLatLonger($addressly);
								$lats = $coordinate['lat'];
								$longs = $coordinate['long'];
								
								$latitudes = str_replace('.', ',', $lats);
								$longitudes = str_replace('.', ',', $longs);
							?>
		
		
							<div class="map" data-latitude="<?php echo $latitudes; ?>" data-longtitude="<?php echo $longitudes; ?>"></div>
						
						</div>
						
						<div class="clear"></div>
						
					</div>
				
				</div>
				
				<div class="seconded">
								
					
					<div id="contactform">
						<div id="message" class="message"></div>
						<form method="post" action="<?php bloginfo('template_url'); ?>/library/contact.php" name="cform" id="cform" class="cform sleek">
							
							<input class="lilly" id="name" type="text" placeholder="<?php _e('Your Name*','cebolang'); ?>" name="name" value="" />
							
							<input class="lilly" id="email" type="text" placeholder="<?php _e('Your Email*','cebolang'); ?>" name="email" value="" />
		
							<input class="lilly" type="hidden" name="subject" id="subject" value="<?php echo get_option('cebo_email'); ?>" />
							<input class="lilly" type="hidden" name="honeypot" id="honeypot" />
							
							<input class="lilly" type="text" style="display: none;" name="myemail" id="myemail" value="<?php echo get_option('cebo_email'); ?>" />
							
							<span aria-hidden="true" class="icon-right-quote"></span>
							
							<textarea class="lonely" name="comments" placeholder="<?php _e('Your Message*','cebolang'); ?>" id="comments"></textarea>
					        <input type="submit" name="send" value="<?php _e('Send Message','cebolang'); ?>" id="submit" class="hang"/>
					        
					        
						</form>		
					</div><!--end contactform-->
				
				
					<!--
						
						<form class="sleek">
							
							<input type="text" class="lilly" onfocus="if(this.value == 'Name'){this.value = '';}" name="name" onblur="if(this.value == ''){this.value='Name';}" value="Name" />
							
							<input type="text" class="lilly" onfocus="if(this.value == 'Email'){this.value = '';}" name="email" onblur="if(this.value == ''){this.value='Email';}" value="Email" />
							
							
							
							
							<textarea class="lonely"></textarea>
							
							<button class="hang">Submit</button>
						
						
						</form>
					
					-->
				</div>
			
			</div>	
				
		</div>
	</div>
