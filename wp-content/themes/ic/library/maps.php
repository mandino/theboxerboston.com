
<?php 


// ------------------------------------------
// converts a string with a stret address
// into a couple of lat, long coordinates.
// ------------------------------------------


$address = get_option('cebo_address');

function getLatLong($address){
    if (!is_string($address))die("All Addresses must be passed as a string");
    $_url = sprintf('http://maps.google.com/maps?output=js&q=%s',rawurlencode($address));
    $_result = false;
    if($_result = file_get_contents($_url)) {
        if(strpos($_result,'errortips') > 1 || strpos($_result,'Did you mean:') !== false) return false;
        preg_match('!center:\s*{lat:\s*(-?\d+\.\d+),lng:\s*(-?\d+\.\d+)}!U', $_result, $_match);
        $_coords['lat'] = $_match[1];
        $_coords['long'] = $_match[2];
    }
    return $_coords;
}

?>



<div id="mapper">
		
	  <?php $coordinates = getLatLong($address);
			$lat = $coordinates['lat'];
			$long = $coordinates['long'];
			
			$latitude = str_replace('.', ',', $lat);
			$longitude = str_replace('.', ',', $long);
		?>
		
		
		
		 <div class="map" data-latitude="<?php echo $latitude; ?>" data-longtitude="<?php echo $longitude; ?>"></div>



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
							
							<img src="<?php echo get_option('cebo_officepic'); ?>" alt="<?php bloginfo('description'); ?>" />
							
							
						
						</div>
						
						<div class="clear"></div>
						
					</div>
				
				</div>
				
				<div class="seconded">
				
					
					<div id="contactform">
						<div id="messages" class="messages"></div>
						<form method="post" action="<?php bloginfo('template_url'); ?>/library/contact_two.php" name="cforms" id="cforms" class="sleek cforms">
							
							<input class="lilly" id="names" type="text"  name="names" placeholder="<?php _e('Your Name*', 'cebolang'); ?>" value="" />
							
							<input class="lilly" id="emails" type="text" name="emails" placeholder="<?php _e('Your Email*', 'cebolang'); ?>" value="" />
		
							<input class="lilly" type="hidden" name="subjects" id="subjects" value="<?php echo get_option('cebo_email'); ?>" />
							<input class="lilly" type="hidden" name="honeypot" id="honeypot" />
							
							<input class="lilly" type="text" style="display: none;" name="myemails" id="myemails" value="<?php echo get_option('cebo_email'); ?>" />
							
							<span aria-hidden="true" class="icon-right-quote"></span>
							
							<textarea class="lonely" name="commentss" placeholder="<?php _e('Your Message*', 'cebolang'); ?>" id="commentss"></textarea>
					        <input type="submit" name="sends" value="<?php _e('Send Message', 'cebolang'); ?>" id="submits" class="hang"/>
					        
					        
						</form>		
					</div><!--end contactform-->				
				
				</div>			
			</div>	
				
		</div>
		
		
	</div>
