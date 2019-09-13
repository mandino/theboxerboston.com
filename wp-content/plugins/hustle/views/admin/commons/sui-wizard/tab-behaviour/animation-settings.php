<?php if (
	( isset( $entrance_animation ) && true === $entrance_animation ) &&
	( isset( $exit_animation ) && true === $exit_animation )
) {
	$column_class = 'sui-col-md-6';
} else {
	$column_class = 'sui-col';
} ?>

<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label"><?php esc_html_e( 'Animation Settings', 'wordpress-popup' ); ?></span>
		<span class="sui-description"><?php printf( esc_html__( 'Choose how you want your %s to animate on entrance & exit.', 'wordpress-popup' ), esc_html( $smallcaps_singular ) ); ?></span>
	</div>

	<div class="sui-box-settings-col-2">

		<div class="sui-row">

			<?php if ( isset( $entrance_animation ) && true === $entrance_animation ) { ?>

				<div class="<?php echo esc_attr( $column_class ); ?>">

					<div class="sui-form-field">

						<label class="sui-label"><?php printf( esc_html__( '%s entrance animation', 'wordpress-popup' ), esc_html( $capitalize_singular ) ); ?></label>

						<select class="sui-select" name="animation_in" data-attribute="animation_in">

							<option value="no_animation"
								{{ _.selected( ( 'no_animation' === animation_in || '' === animation_in ), true) }}>
								<?php esc_attr_e( "No Animation", 'wordpress-popup' ); ?>
							</option>

							<option value="bounceIn"
								{{ _.selected( ( 'bounceIn' === animation_in ), true) }}>
								<?php esc_attr_e( "Bounce In", 'wordpress-popup' ); ?>
							</option>

							<option value="bounceInUp"
								{{ _.selected( ( 'bounceInUp' === animation_in ), true) }}>
								<?php esc_attr_e( "Bounce In Up", 'wordpress-popup' ); ?>
							</option>

							<option value="bounceInRight"
								{{ _.selected( ( 'bounceInRight' === animation_in ), true) }}>
								<?php esc_attr_e( "Bounce In Right", 'wordpress-popup' ); ?>
							</option>

							<option value="bounceInDown"
								{{ _.selected( ( 'bounceInDown' === animation_in ), true) }}>
								<?php esc_attr_e( "Bounce In Down", 'wordpress-popup' ); ?>
							</option>

							<option value="bounceInLeft"
								{{ _.selected( ( 'bounceInLeft' === animation_in ), true) }}>
								<?php esc_attr_e( "Bounce In Left", 'wordpress-popup' ); ?>
							</option>

							<option value="fadeIn"
								{{ _.selected( ( 'fadeIn' === animation_in ), true) }}>
								<?php esc_attr_e( "Fade In", 'wordpress-popup' ); ?>
							</option>

							<option value="fadeInUp"
								{{ _.selected( ( 'fadeInUp' === animation_in ), true) }}>
								<?php esc_attr_e( "Fade In Up", 'wordpress-popup' ); ?>
							</option>

							<option value="fadeInRight"
								{{ _.selected( ( 'fadeInRight' === animation_in ), true) }}>
								<?php esc_attr_e( "Fade In Right", 'wordpress-popup' ); ?>
							</option>

							<option value="fadeInDown"
								{{ _.selected( ( 'fadeInDown' === animation_in ), true) }}>
								<?php esc_attr_e( "Fade In Down", 'wordpress-popup' ); ?>
							</option>

							<option value="fadeInLeft"
								{{ _.selected( ( 'fadeInLeft' === animation_in ), true) }}>
								<?php esc_attr_e( "Fade In Left", 'wordpress-popup' ); ?>
							</option>

							<option value="rotateIn"
								{{ _.selected( ( 'rotateIn' === animation_in ), true) }}>
								<?php esc_attr_e( "Rotate In", 'wordpress-popup' ); ?>
							</option>

							<option value="rotateInDownLeft"
								{{ _.selected( ( 'rotateInDownLeft' === animation_in ), true) }}>
								<?php esc_attr_e( "Rotate In Down Left", 'wordpress-popup' ); ?>
							</option>

							<option value="rotateInDownRight"
								{{ _.selected( ( 'rotateInDownRight' === animation_in ), true) }}>
								<?php esc_attr_e( "Rotate In Down Right", 'wordpress-popup' ); ?>
							</option>

							<option value="rotateInUpLeft"
								{{ _.selected( ( 'rotateInUpLeft' === animation_in ), true) }}>
								<?php esc_attr_e( "Rotate In Up Left", 'wordpress-popup' ); ?>
							</option>

							<option value="rotateInUpRight"
								{{ _.selected( ( 'rotateInUpRight' === animation_in ), true) }}>
								<?php esc_attr_e( "Rotate In Up Right", 'wordpress-popup' ); ?>
							</option>

							<option value="slideInUp"
								{{ _.selected( ( 'slideInUp' === animation_in ), true) }}>
								<?php esc_attr_e( "Slide In Up", 'wordpress-popup' ); ?>
							</option>

							<option value="slideInRight"
								{{ _.selected( ( 'slideInRight' === animation_in ), true) }}>
								<?php esc_attr_e( "Slide In Right", 'wordpress-popup' ); ?>
							</option>

							<option value="slideInDown"
								{{ _.selected( ( 'slideInDown' === animation_in ), true) }}>
								<?php esc_attr_e( "Slide In Down", 'wordpress-popup' ); ?>
							</option>

							<option value="slideInLeft"
								{{ _.selected( ( 'slideInLeft' === animation_in ), true) }}>
								<?php esc_attr_e( "Slide In Left", 'wordpress-popup' ); ?>
							</option>

							<option value="zoomIn"
								{{ _.selected( ( 'zoomIn' === animation_in ), true) }}>
								<?php esc_attr_e( "Zoom In", 'wordpress-popup' ); ?>
							</option>

							<option value="zoomInUp"
								{{ _.selected( ( 'zoomInUp' === animation_in ), true) }}>
								<?php esc_attr_e( "Zoom In Up", 'wordpress-popup' ); ?>
							</option>

							<option value="zoomInRight"
								{{ _.selected( ( 'zoomInRight' === animation_in ), true) }}>
								<?php esc_attr_e( "Zoom In Right", 'wordpress-popup' ); ?>
							</option>

							<option value="zoomInDown"
								{{ _.selected( ( 'zoomInDown' === animation_in ), true) }}>
								<?php esc_attr_e( "Zoom In Down", 'wordpress-popup' ); ?>
							</option>

							<option value="zoomInLeft"
								{{ _.selected( ( 'zoomInLeft' === animation_in ), true) }}>
								<?php esc_attr_e( "Zoom In Left", 'wordpress-popup' ); ?>
							</option>

							<option value="rollIn"
								{{ _.selected( ( 'rollIn' === animation_in ), true) }}>
								<?php esc_attr_e( "Roll In", 'wordpress-popup' ); ?>
							</option>

							<option value="lightSpeedIn"
								{{ _.selected( ( 'lightSpeedIn' === animation_in ), true) }}>
								<?php esc_attr_e( "Light Speed In", 'wordpress-popup' ); ?>
							</option>

							<option value="newspaperIn"
								{{ _.selected( ( 'newspaperIn' === animation_in ), true) }}>
								<?php esc_attr_e( "Newspaper In", 'wordpress-popup' ); ?>
							</option>

						</select>

					</div>

				</div>

			<?php } ?>

			<?php if ( isset( $exit_animation ) && true === $exit_animation ) { ?>

				<div class="<?php echo esc_attr( $column_class ); ?>">

					<div class="sui-form-field">

						<label class="sui-label"><?php printf( esc_html__( '%s exit animation', 'wordpress-popup' ), esc_html( $capitalize_singular ) ); ?></label>

						<select class="sui-select" data-attribute="animation_out">

							<option value="no_animation"
								{{ _.selected( ( 'no_animation' === animation_out || '' === animation_out ), true) }}>
								<?php esc_attr_e( "No Animation", 'wordpress-popup' ); ?>
							</option>

							<option value="bounceOut"
								{{ _.selected( ( 'bounceOut' === animation_out ), true) }}>
								<?php esc_attr_e( "Bounce Out", 'wordpress-popup' ); ?>
							</option>

							<option value="bounceOutUp"
								{{ _.selected( ( 'bounceOutUp' === animation_out ), true) }}>
								<?php esc_attr_e( "Bounce Out Up", 'wordpress-popup' ); ?>
							</option>

							<option value="bounceOutRight"
								{{ _.selected( ( 'bounceOutRight' === animation_out ), true) }}>
								<?php esc_attr_e( "Bounce Out Right", 'wordpress-popup' ); ?>
							</option>

							<option value="bounceOutDown"
								{{ _.selected( ( 'bounceOutDown' === animation_out ), true) }}>
								<?php esc_attr_e( "Bounce Out Down", 'wordpress-popup' ); ?>
							</option>

							<option value="bounceOutLeft"
								{{ _.selected( ( 'bounceOutLeft' === animation_out ), true) }}>
								<?php esc_attr_e( "Bounce Out Left", 'wordpress-popup' ); ?>
							</option>

							<option value="fadeOut"
								{{ _.selected( ( 'fadeOut' === animation_out ), true) }}>
								<?php esc_attr_e( "Fade Out", 'wordpress-popup' ); ?>
							</option>

							<option value="fadeOutUp"
								{{ _.selected( ( 'fadeOutUp' === animation_out ), true) }}>
								<?php esc_attr_e( "Fade Out Up", 'wordpress-popup' ); ?>
							</option>

							<option value="fadeOutRight"
								{{ _.selected( ( 'fadeOutRight' === animation_out ), true) }}>
								<?php esc_attr_e( "Fade Out Right", 'wordpress-popup' ); ?>
							</option>

							<option value="fadeOutDown"
								{{ _.selected( ( 'fadeOutDown' === animation_out ), true) }}>
								<?php esc_attr_e( "Fade Out Down", 'wordpress-popup' ); ?>
							</option>

							<option value="fadeOutLeft"
								{{ _.selected( ( 'fadeOutLeft' === animation_out ), true) }}>
								<?php esc_attr_e( "Fade Out Left", 'wordpress-popup' ); ?>
							</option>

							<option value="rotateOut"
								{{ _.selected( ( 'rotateOut' === animation_out ), true) }}>
								<?php esc_attr_e( "Rotate Out", 'wordpress-popup' ); ?>
							</option>

							<option value="rotateOutUpLeft"
								{{ _.selected( ( 'rotateOutUpLeft' === animation_out ), true) }}>
								<?php esc_attr_e( "Rotate Out Up Left", 'wordpress-popup' ); ?>
							</option>

							<option value="rotateOutUpRight"
								{{ _.selected( ( 'rotateOutUpRight' === animation_out ), true) }}>
								<?php esc_attr_e( "Rotate Out Up Right", 'wordpress-popup' ); ?>
							</option>

							<option value="rotateOutDownLeft"
								{{ _.selected( ( 'rotateOutDownLeft' === animation_out ), true) }}>
								<?php esc_attr_e( "Rotate Out Down Left", 'wordpress-popup' ); ?>
							</option>

							<option value="rotateOutDownRight"
								{{ _.selected( ( 'rotateOutDownRight' === animation_out ), true) }}>
								<?php esc_attr_e( "Rotate Out Down Right", 'wordpress-popup' ); ?>
							</option>

							<option value="slideOutUp"
								{{ _.selected( ( 'slideOutUp' === animation_out ), true) }}>
								<?php esc_attr_e( "Slide Out Up", 'wordpress-popup' ); ?>
							</option>

							<option value="slideOutRight"
								{{ _.selected( ( 'slideOutRight' === animation_out ), true) }}>
								<?php esc_attr_e( "Slide Out Right", 'wordpress-popup' ); ?>
							</option>

							<option value="slideOutDown"
								{{ _.selected( ( 'slideOutDown' === animation_out ), true) }}>
								<?php esc_attr_e( "Slide Out Down", 'wordpress-popup' ); ?>
							</option>

							<option value="slideOutLeft"
								{{ _.selected( ( 'slideOutLeft' === animation_out ), true) }}>
								<?php esc_attr_e( "Slide Out Left", 'wordpress-popup' ); ?>
							</option>

							<option value="zoomOut"
								{{ _.selected( ( 'zoomOut' === animation_out ), true) }}>
								<?php esc_attr_e( "Zoom Out", 'wordpress-popup' ); ?>
							</option>

							<option value="zoomOutUp"
								{{ _.selected( ( 'zoomOutUp' === animation_out ), true) }}>
								<?php esc_attr_e( "Zoom Out Up", 'wordpress-popup' ); ?>
							</option>

							<option value="zoomOutRight"
								{{ _.selected( ( 'zoomOutRight' === animation_out ), true) }}>
								<?php esc_attr_e( "Zoom Out Right", 'wordpress-popup' ); ?>
							</option>

							<option value="zoomOutDown"
								{{ _.selected( ( 'zoomOutDown' === animation_out ), true) }}>
								<?php esc_attr_e( "Zoom Out Down", 'wordpress-popup' ); ?>
							</option>

							<option value="zoomOutLeft"
								{{ _.selected( ( 'zoomOutLeft' === animation_out ), true) }}>
								<?php esc_attr_e( "Zoom Out Left", 'wordpress-popup' ); ?>
							</option>

							<option value="rollOut"
								{{ _.selected( ( 'rollOut' === animation_out ), true) }}>
								<?php esc_attr_e( "Roll Out", 'wordpress-popup' ); ?>
							</option>

							<option value="lightSpeedOut"
								{{ _.selected( ( 'lightSpeedOut' === animation_out ), true) }}>
								<?php esc_attr_e( "Light Speed Out", 'wordpress-popup' ); ?>
							</option>

							<option value="newspaperOut"
								{{ _.selected( ( 'newspaperOut' === animation_out ), true) }}>
								<?php esc_attr_e( "Newspaper Out", 'wordpress-popup' ); ?>
							</option>

						</select>

					</div>

				</div>

			<?php } ?>

		</div>

	</div>

</div>
