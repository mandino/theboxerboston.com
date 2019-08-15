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
		<span class="sui-settings-label"><?php esc_html_e( 'Animation Settings', Opt_In::TEXT_DOMAIN ); ?></span>
		<span class="sui-description"><?php printf( esc_html__( 'Choose how you want your %s to animate on entrance & exit.', Opt_In::TEXT_DOMAIN ), esc_html( $smallcaps_singular ) ); ?></span>
	</div>

	<div class="sui-box-settings-col-2">

		<div class="sui-row">

			<?php if ( isset( $entrance_animation ) && true === $entrance_animation ) { ?>

				<div class="<?php echo esc_attr( $column_class ); ?>">

					<div class="sui-form-field">

						<label class="sui-label"><?php printf( esc_html__( '%s entrance animation', Opt_In::TEXT_DOMAIN ), esc_html( $capitalize_singular ) ); ?></label>

						<select class="sui-select" name="animation_in" data-attribute="animation_in">

							<option value="no_animation"
								{{ _.selected( ( 'no_animation' === animation_in || '' === animation_in ), true) }}>
								<?php esc_attr_e( "No Animation", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="bounceIn"
								{{ _.selected( ( 'bounceIn' === animation_in ), true) }}>
								<?php esc_attr_e( "Bounce In", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="bounceInUp"
								{{ _.selected( ( 'bounceInUp' === animation_in ), true) }}>
								<?php esc_attr_e( "Bounce In Up", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="bounceInRight"
								{{ _.selected( ( 'bounceInRight' === animation_in ), true) }}>
								<?php esc_attr_e( "Bounce In Right", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="bounceInDown"
								{{ _.selected( ( 'bounceInDown' === animation_in ), true) }}>
								<?php esc_attr_e( "Bounce In Down", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="bounceInLeft"
								{{ _.selected( ( 'bounceInLeft' === animation_in ), true) }}>
								<?php esc_attr_e( "Bounce In Left", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="fadeIn"
								{{ _.selected( ( 'fadeIn' === animation_in ), true) }}>
								<?php esc_attr_e( "Fade In", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="fadeInUp"
								{{ _.selected( ( 'fadeInUp' === animation_in ), true) }}>
								<?php esc_attr_e( "Fade In Up", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="fadeInRight"
								{{ _.selected( ( 'fadeInRight' === animation_in ), true) }}>
								<?php esc_attr_e( "Fade In Right", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="fadeInDown"
								{{ _.selected( ( 'fadeInDown' === animation_in ), true) }}>
								<?php esc_attr_e( "Fade In Down", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="fadeInLeft"
								{{ _.selected( ( 'fadeInLeft' === animation_in ), true) }}>
								<?php esc_attr_e( "Fade In Left", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="rotateIn"
								{{ _.selected( ( 'rotateIn' === animation_in ), true) }}>
								<?php esc_attr_e( "Rotate In", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="rotateInDownLeft"
								{{ _.selected( ( 'rotateInDownLeft' === animation_in ), true) }}>
								<?php esc_attr_e( "Rotate In Down Left", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="rotateInDownRight"
								{{ _.selected( ( 'rotateInDownRight' === animation_in ), true) }}>
								<?php esc_attr_e( "Rotate In Down Right", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="rotateInUpLeft"
								{{ _.selected( ( 'rotateInUpLeft' === animation_in ), true) }}>
								<?php esc_attr_e( "Rotate In Up Left", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="rotateInUpRight"
								{{ _.selected( ( 'rotateInUpRight' === animation_in ), true) }}>
								<?php esc_attr_e( "Rotate In Up Right", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="slideInUp"
								{{ _.selected( ( 'slideInUp' === animation_in ), true) }}>
								<?php esc_attr_e( "Slide In Up", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="slideInRight"
								{{ _.selected( ( 'slideInRight' === animation_in ), true) }}>
								<?php esc_attr_e( "Slide In Right", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="slideInDown"
								{{ _.selected( ( 'slideInDown' === animation_in ), true) }}>
								<?php esc_attr_e( "Slide In Down", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="slideInLeft"
								{{ _.selected( ( 'slideInLeft' === animation_in ), true) }}>
								<?php esc_attr_e( "Slide In Left", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="zoomIn"
								{{ _.selected( ( 'zoomIn' === animation_in ), true) }}>
								<?php esc_attr_e( "Zoom In", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="zoomInUp"
								{{ _.selected( ( 'zoomInUp' === animation_in ), true) }}>
								<?php esc_attr_e( "Zoom In Up", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="zoomInRight"
								{{ _.selected( ( 'zoomInRight' === animation_in ), true) }}>
								<?php esc_attr_e( "Zoom In Right", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="zoomInDown"
								{{ _.selected( ( 'zoomInDown' === animation_in ), true) }}>
								<?php esc_attr_e( "Zoom In Down", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="zoomInLeft"
								{{ _.selected( ( 'zoomInLeft' === animation_in ), true) }}>
								<?php esc_attr_e( "Zoom In Left", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="rollIn"
								{{ _.selected( ( 'rollIn' === animation_in ), true) }}>
								<?php esc_attr_e( "Roll In", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="lightSpeedIn"
								{{ _.selected( ( 'lightSpeedIn' === animation_in ), true) }}>
								<?php esc_attr_e( "Light Speed In", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="newspaperIn"
								{{ _.selected( ( 'newspaperIn' === animation_in ), true) }}>
								<?php esc_attr_e( "Newspaper In", Opt_In::TEXT_DOMAIN ); ?>
							</option>

						</select>

					</div>

				</div>

			<?php } ?>

			<?php if ( isset( $exit_animation ) && true === $exit_animation ) { ?>

				<div class="<?php echo esc_attr( $column_class ); ?>">

					<div class="sui-form-field">

						<label class="sui-label"><?php printf( esc_html__( '%s exit animation', Opt_In::TEXT_DOMAIN ), esc_html( $capitalize_singular ) ); ?></label>

						<select class="sui-select" data-attribute="animation_out">

							<option value="no_animation"
								{{ _.selected( ( 'no_animation' === animation_out || '' === animation_out ), true) }}>
								<?php esc_attr_e( "No Animation", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="bounceOut"
								{{ _.selected( ( 'bounceOut' === animation_out ), true) }}>
								<?php esc_attr_e( "Bounce Out", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="bounceOutUp"
								{{ _.selected( ( 'bounceOutUp' === animation_out ), true) }}>
								<?php esc_attr_e( "Bounce Out Up", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="bounceOutRight"
								{{ _.selected( ( 'bounceOutRight' === animation_out ), true) }}>
								<?php esc_attr_e( "Bounce Out Right", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="bounceOutDown"
								{{ _.selected( ( 'bounceOutDown' === animation_out ), true) }}>
								<?php esc_attr_e( "Bounce Out Down", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="bounceOutLeft"
								{{ _.selected( ( 'bounceOutLeft' === animation_out ), true) }}>
								<?php esc_attr_e( "Bounce Out Left", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="fadeOut"
								{{ _.selected( ( 'fadeOut' === animation_out ), true) }}>
								<?php esc_attr_e( "Fade Out", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="fadeOutUp"
								{{ _.selected( ( 'fadeOutUp' === animation_out ), true) }}>
								<?php esc_attr_e( "Fade Out Up", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="fadeOutRight"
								{{ _.selected( ( 'fadeOutRight' === animation_out ), true) }}>
								<?php esc_attr_e( "Fade Out Right", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="fadeOutDown"
								{{ _.selected( ( 'fadeOutDown' === animation_out ), true) }}>
								<?php esc_attr_e( "Fade Out Down", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="fadeOutLeft"
								{{ _.selected( ( 'fadeOutLeft' === animation_out ), true) }}>
								<?php esc_attr_e( "Fade Out Left", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="rotateOut"
								{{ _.selected( ( 'rotateOut' === animation_out ), true) }}>
								<?php esc_attr_e( "Rotate Out", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="rotateOutUpLeft"
								{{ _.selected( ( 'rotateOutUpLeft' === animation_out ), true) }}>
								<?php esc_attr_e( "Rotate Out Up Left", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="rotateOutUpRight"
								{{ _.selected( ( 'rotateOutUpRight' === animation_out ), true) }}>
								<?php esc_attr_e( "Rotate Out Up Right", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="rotateOutDownLeft"
								{{ _.selected( ( 'rotateOutDownLeft' === animation_out ), true) }}>
								<?php esc_attr_e( "Rotate Out Down Left", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="rotateOutDownRight"
								{{ _.selected( ( 'rotateOutDownRight' === animation_out ), true) }}>
								<?php esc_attr_e( "Rotate Out Down Right", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="slideOutUp"
								{{ _.selected( ( 'slideOutUp' === animation_out ), true) }}>
								<?php esc_attr_e( "Slide Out Up", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="slideOutRight"
								{{ _.selected( ( 'slideOutRight' === animation_out ), true) }}>
								<?php esc_attr_e( "Slide Out Right", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="slideOutDown"
								{{ _.selected( ( 'slideOutDown' === animation_out ), true) }}>
								<?php esc_attr_e( "Slide Out Down", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="slideOutLeft"
								{{ _.selected( ( 'slideOutLeft' === animation_out ), true) }}>
								<?php esc_attr_e( "Slide Out Left", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="zoomOut"
								{{ _.selected( ( 'zoomOut' === animation_out ), true) }}>
								<?php esc_attr_e( "Zoom Out", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="zoomOutUp"
								{{ _.selected( ( 'zoomOutUp' === animation_out ), true) }}>
								<?php esc_attr_e( "Zoom Out Up", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="zoomOutRight"
								{{ _.selected( ( 'zoomOutRight' === animation_out ), true) }}>
								<?php esc_attr_e( "Zoom Out Right", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="zoomOutDown"
								{{ _.selected( ( 'zoomOutDown' === animation_out ), true) }}>
								<?php esc_attr_e( "Zoom Out Down", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="zoomOutLeft"
								{{ _.selected( ( 'zoomOutLeft' === animation_out ), true) }}>
								<?php esc_attr_e( "Zoom Out Left", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="rollOut"
								{{ _.selected( ( 'rollOut' === animation_out ), true) }}>
								<?php esc_attr_e( "Roll Out", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="lightSpeedOut"
								{{ _.selected( ( 'lightSpeedOut' === animation_out ), true) }}>
								<?php esc_attr_e( "Light Speed Out", Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="newspaperOut"
								{{ _.selected( ( 'newspaperOut' === animation_out ), true) }}>
								<?php esc_attr_e( "Newspaper Out", Opt_In::TEXT_DOMAIN ); ?>
							</option>

						</select>

					</div>

				</div>

			<?php } ?>

		</div>

	</div>

</div>
