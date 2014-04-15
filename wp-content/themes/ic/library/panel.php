			
					<!-- PANEL -->
        <section>
        <div id="modal">
			<a href="javascript:$.pageslide.close()" class="close">X</a>
			<h2><?php if(get_option('cebo_formhead')) { echo get_option('cebo_formhead'); } else { _e( 'Send message', 'cebolang' ); } ?></h2>
			<?php if(get_option('cebo_form')) {  ?>
			
			<p><?php echo get_option('cebo_form'); ?></p>
		
			<? } ?>
				
				<form id="form" class="inquiryform" action="<?php bloginfo ('template_url'); ?>/library/form.php" method="post">
						<div class="form">
		                	
		                	<div class="primaryinputs">
		                		
		                		<span style="margin-right: 25px;">
			                		<label><?php _e( 'Your Name (required)', 'cebolang' ); ?></label>
			                		<input class="short space" type="text" style="line-height: normal;" onfocus="if(this.value == 'Your Name'){this.value = '';}" name="name" onblur="if(this.value == ''){this.value='Your Name';}" value="Your Name"  />
			                		
			                	</span>
		                		
		                		<span>
			                		<label><?php _e( 'Your Email (required', 'cebolang' ); ?>)</label>
			                		<input type="text" class="short" style="line-height: normal;" onfocus="if(this.value == 'Your Email'){this.value = '';}" name="email" onblur="if(this.value == ''){this.value='Your Email';}"  value="Your Email"  />
			                	</span>
			                	
			                	<span style="margin-right: 25px;">
			                		<label><?php _e( 'Your Website (optional)', 'cebolang' ); ?></label>
			                		<input type="text" class="short" style="line-height: normal;" onfocus="if(this.value == 'Your Website'){this.value = '';}" name="site" onblur="if(this.value == ''){this.value='Your Website';}" value="Your Website"  />
			                		<input name="emailer" type="hidden" value="<?php echo get_option('cebo_email'); ?>"  />
			                	</span>
		                		
		                		<span>
			                		<label><?php _e( 'Your Telephone (optional)', 'cebolang' ); ?></label>
			                		<input type="text" class="short" style="line-height: normal;" onfocus="if(this.value == 'Your Telephone'){this.value = '';}" name="tel" onblur="if(this.value == ''){this.value='Your Telephone';}" value="Your Telephone"  />
			                		<input name="emailer" type="hidden" value="<?php echo get_option('cebo_email'); ?>"  />
			                		
			                		<input name="lostcolor" type="hidden" value="<?php echo get_option('cebo_accent_color'); ?>"  />
			                	</span>
		                	
		                	</div>
		                	
		                	<div class="clear"></div>
		                	
		                	<div class="singulartext">
		                		
		                		<span>
			                		<label><?php _e( 'Your Message (required)', 'cebolang' ); ?></label>
			                		<textarea onfocus="this.value=''; this.onfocus=null;" rows='3' class="long" style="line-height: normal;" name="message"></textarea>
			                	</span>
		                	
		                	</div>
		                	
		                	<div class="clear"></div>
		                	
		                	<div class="submitcontain">
		                	
		                		
		                		
		                		<label><img src="<?php bloginfo ('template_url'); ?>/library/captcha.php"></label>
								<input type="text" name="code"> <br /> 
				
								<input type="submit" class="submit captain" name="submit" value="<?php _e( 'Send message', 'cebolang' ); ?>" />
		                	
		                	</div>
		                	
						</div>
					</form>
				
			</div>
		</section>
		<!-- / PANEL -->
