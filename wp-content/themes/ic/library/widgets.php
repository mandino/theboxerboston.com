<?php


/* ---------------------------------------------------- */
/*	Contact Info
/* ---------------------------------------------------- */

class Comment_Widget extends WP_Widget {

	function Comment_Widget() {
		$widget_ops = array( 'classname' => 'ss-contact-info', 'description' => __('Add the big latest comment. Works well in the footer', 'cebolang') );
		$this->WP_Widget( 'ss-contact-info', __('Sexy Latest Comment', 'cebolang'), $widget_ops );
	}

	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );

		$title = esc_attr( $instance['title'] );

		?>

		
		

		<?php

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	function widget( $args, $instance ) {

		extract( $args );

		$title = esc_attr( $instance['title'] );

		echo $before_widget;

		if($title)
			echo $before_title . $title . $after_title;

		
		?>
			<?php $comments = get_comments('status=approve&number=1'); ?>
							<?php foreach ($comments as $comment) { ?>
							    <?php
							        $title = get_the_title($comment->comment_post_ID);
							  
							        echo '<div class="whosaid"><p>Recently ' . ($comment->comment_author) . ''; ?><?php _e(' said: ', 'cebolang'); ?></p><span class="icon-right-quote" aria-hidden="true"></span></div><p class="quoter"> "<?php
							        echo wp_html_excerpt( $comment->comment_content, 112 ); ?>…"</p>
							        
							        <div class="saidmore"><p><a href="<?php echo get_permalink($comment->comment_post_ID); ?>"
							           rel="external nofollow" title="<?php echo $title; ?>"><?php _e('Read The Post ', 'cebolang'); ?></a></p></div>
							   
							<?php }  ?>
							
						

		
		<?php
		

		echo $after_widget;
	}

}

add_action( 'widgets_init', create_function('', "register_widget('Comment_Widget');") );