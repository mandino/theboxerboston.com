<?php
/**
 * The template for displaying Comments.
 *
 */
?>


<div class="boxer">



	<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'cebolang' ); ?></p>
	</div><!-- #comments -->
	<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
		endif;
	?>
	
	
	

	<?php // You can start editing here -- including this comment! ?>
	
	
	
		
				
				
				<?php if ( have_comments() ) { ?>
					
					<h4>
						<?php
							printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s responses on &ldquo;%2$s&rdquo;', get_comments_number(), 'cebolang' ),
								number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
						?>
					</h4>
					
					<? } else { ?>
					
					<h4><?php _e('Leave a Reply', 'cebolang'); ?></h4>
					
					<? } ?>
		
					<div class="postcomments">
					
					
					
					<?php $args = array(
						'id_form' => 'sleek',
						'id_submit' => 'submit',
						'title_reply' => __( '' ),
						'title_reply_to' => __( '' ),
						'cancel_reply_link' => __( 'Cancel Reply' ),
						'label_submit' => __( 'Submit' ),
						
						'comment_field' => '<div class="messenger"><span aria-hidden="true" class="icon-right-quote"></span><textarea id="comment" class="lonely" name="comment" cols="45" rows="8" aria-required="true"></textarea></div><div class="clear"></div>',
						
						'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
						
						'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
						'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) . '</p>',
						'comment_notes_after' => '',
						
						'fields' => apply_filters( 'comment_form_default_fields', array(
							'author' => '<div class="letterbox"><input id="author" class="lilly" placeholder="Your Name*" name="author" type="text" value="' . esc_attr(  $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />',
							
							'email' => '<input id="email" name="email" type="text" class="lilly" placeholder="Your Email*" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />',
							'url' => '<input id="url" name="url" type="text" class="lilly" placeholder="Your Website (optional)" value="' . esc_attr(  $commenter['comment_author_website'] ) . '"/></div>' ) ) );
						
						comment_form($args); ?>
					
					
					
						<!--<form class="sleek">
							<div id="form">
								
								<div class="letterbox">
				                	
				                	<input type="hidden" name="subject" value="Tam Cai Website | Collaborate With Me" />
									<input type="hidden" name="redirect" value="index.php" />
				                    <input type="text" class="lilly" onfocus="if(this.value == 'Name'){this.value = '';}" name="name" onblur="if(this.value == ''){this.value='Name';}" value="Name" />
										
										<input type="text" class="lilly" onfocus="if(this.value == 'Email'){this.value = '';}" name="email" onblur="if(this.value == ''){this.value='Email';}" value="Email" />
										
										<input type="text" class="lilly" onfocus="if(this.value == 'Website (optional)'){this.value = '';}" name="web" onblur="if(this.value == ''){this.value='Website (optional)';}" value="Website (optional)" />
										
								
								</div>
									
								<div class="messenger">	
									
				                    <span aria-hidden="true" class="icon-right-quote"></span>
				                    <textarea onfocus="this.value=''; this.onfocus=null;" rows='3' class="lonely" name="project01">Project Description #1</textarea>
				                    
									<br/>
									<!-- BUTTON 
									<a href="javascript:;" class="hang">Submit</a>
								</div>
								<!-- / BUTTON 
							</div>
							
							<div class="clear"></div>
							
							
						</form>-->


					
					
					<div class="usercomments">
					
					
						<ul class="commentlist">
							<?php
								
								wp_list_comments(array('avatar_size' => 80));
							?>
						</ul>

					<!--<div class="usercomments">
					
					
						<ul>
						
							<li>
							
								<span>
									
									<img src="images/thumb.png" width="80" alt="">
									
									<p>Aug, 21 2013</p>
								
								</span>
								
								
								<h4>Chico Hatterson<i><a href="#">Reply</a></i></h4>
								
								<p>Aenean dictum, purus egestas feugiat fermentum, neque purus elementum massa, malesuada auctor turpis dui ut urna. Proin quis nisl nulla. Maecenas quis dui vitae ante viverra fermentum. Sed facilisis imperdiet odio, vel porttitor eros  Maecenas quis dui vitae ante viverra fermentum. Sed facilisis imperdiet odio, vel porttitor eros feugiat ut. Phasellus malesuada, felis sed varius ultrices. Aenean dictum, purus egestas.</p>
							
							</li>
							
							
							<li>
							
								<span>
									
									<img src="images/thumb.png" width="80" alt="">
									
									<p>Aug, 21 2013</p>
								
								</span>
								
								
								<h4>Chico Hatterson<i><a href="#">Reply</a></i></h4>
								
								<p>Aenean dictum, purus egestas feugiat fermentum, neque purus elementum massa, malesuada auctor turpis dui ut urna. Proin quis nisl nulla. Maecenas quis dui vitae ante viverra fermentum. Sed facilisis imperdiet odio, vel porttitor eros  Maecenas quis dui vitae ante viverra fermentum. Sed facilisis imperdiet odio, vel porttitor eros feugiat ut. Phasellus malesuada, felis sed varius ultrices. Aenean dictum, purus egestas.</p>
							
							</li>
							
							
							<li>
							
								<span>
									
									<img src="images/thumb.png" width="80" alt="">
									
									<p>Aug, 21 2013</p>
								
								</span>
								
								
								<h4>Chico Hatterson<i><a href="#">Reply</a></i></h4>
								
								<p>Aenean dictum, purus egestas feugiat fermentum, neque purus elementum massa, malesuada auctor turpis dui ut urna. Proin quis nisl nulla. Maecenas quis dui vitae ante viverra fermentum. Sed facilisis imperdiet odio, vel porttitor eros  Maecenas quis dui vitae ante viverra fermentum. Sed facilisis imperdiet odio, vel porttitor eros feugiat ut. Phasellus malesuada, felis sed varius ultrices. Aenean dictum, purus egestas.</p>
							
							</li>
							
							
							
							
							<li>
							
								<span>
									
									<img src="images/thumb.png" width="80" alt="">
									
									<p>Aug, 21 2013</p>
								
								</span>
								
								
								<h4>Chico Hatterson<i><a href="#">Reply</a></i></h4>
								
								<p>Aenean dictum, purus egestas feugiat fermentum, neque purus elementum massa, malesuada auctor turpis dui ut urna. Proin quis nisl nulla. Maecenas quis dui vitae ante viverra fermentum. Sed facilisis imperdiet odio, vel porttitor eros  Maecenas quis dui vitae ante viverra fermentum. Sed facilisis imperdiet odio, vel porttitor eros feugiat ut. Phasellus malesuada, felis sed varius ultrices. Aenean dictum, purus egestas.</p>
							
							</li>
							
							
							
							<li>
							
								<span>
									
									<img src="images/thumb.png" width="80" alt="">
									
									<p>Aug, 21 2013</p>
								
								</span>
								
								
								<h4>Chico Hatterson<i><a href="#">Reply</a></i></h4>
								
								<p>Aenean dictum, purus egestas feugiat fermentum, neque purus elementum massa, malesuada auctor turpis dui ut urna. Proin quis nisl nulla. Maecenas quis dui vitae ante viverra fermentum. Sed facilisis imperdiet odio, vel porttitor eros  Maecenas quis dui vitae ante viverra fermentum. Sed facilisis imperdiet odio, vel porttitor eros feugiat ut. Phasellus malesuada, felis sed varius ultrices. Aenean dictum, purus egestas.</p>
								
									<ul class="inner">
									
										<li>
								
											<span>
												
												<img src="images/thumb.png" width="80" alt="">
												
												<p>Aug, 21 2013</p>
											
											</span>
											
											
											<h4>Chico Hatterson<i><a href="#">Reply</a></i></h4>
											
											<p>Aenean dictum, purus egestas feugiat fermentum, neque purus elementum massa, malesuada auctor turpis dui ut urna. Proin quis nisl nulla. Maecenas quis dui vitae ante viverra fermentum. Sed facilisis imperdiet odio, vel porttitor eros  Maecenas quis dui vitae ante viverra fermentum. Sed facilisis imperdiet odio, vel porttitor eros feugiat ut. Phasellus malesuada, felis sed varius ultrices. Aenean dictum, purus egestas.</p>
										
										</li>
										
										
										<li>
								
											<span>
												
												<img src="images/thumb.png" width="80" alt="">
												
												<p>Aug, 21 2013</p>
											
											</span>
											
											
											<h4>Chico Hatterson<i><a href="#">Reply</a></i></h4>
											
											<p>Aenean dictum, purus egestas feugiat fermentum, neque purus elementum massa, malesuada auctor turpis dui ut urna. Proin quis nisl nulla. Maecenas quis dui vitae ante viverra fermentum. Sed facilisis imperdiet odio, vel porttitor eros  Maecenas quis dui vitae ante viverra fermentum. Sed facilisis imperdiet odio, vel porttitor eros feugiat ut. Phasellus malesuada, felis sed varius ultrices. Aenean dictum, purus egestas.</p>
										
										</li>
									
									</ul>
							
							</li>
							
							
							
							
							<li>
							
								<span>
									
									<img src="images/thumb.png" width="80" alt="">
									
									<p>Aug, 21 2013</p>
								
								</span>
								
								
								<h4>Chico Hatterson<i><a href="#">Reply</a></i></h4>
								
								<p>Aenean dictum, purus egestas feugiat fermentum, neque purus elementum massa, malesuada auctor turpis dui ut urna. Proin quis nisl nulla. Maecenas quis dui vitae ante viverra fermentum. Sed facilisis imperdiet odio, vel porttitor eros  Maecenas quis dui vitae ante viverra fermentum. Sed facilisis imperdiet odio, vel porttitor eros feugiat ut. Phasellus malesuada, felis sed varius ultrices. Aenean dictum, purus egestas.</p>
							
							</li>
						
						</ul>-->
					
					
					<?php
		/* If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we don't want the note on pages or post types that do not support comments.
		 */
		if ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'cebolang' ); ?></p>
	<?php endif; ?>
	
					</div><!-- end .usercomments -->
					
					
				
				</div>
		
			</div>		
						
		</div>
		
		
		
		
		<div class="clear"></div>