<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label"><?php esc_html_e( 'Additional Closing Methods', 'wordpress-popup' ); ?></span>
		<span class="sui-description"><?php printf( esc_html__( 'Choose the additional closing methods for your %s apart from closing it by clicking on “x”.', 'wordpress-popup' ), esc_html( $smallcaps_singular ) ); ?></span>
	</div>

	<div class="sui-box-settings-col-2">

		<?php
		// SETTINGS: Auto Close
		if ( true === $autoclose ) { ?>

			<div class="sui-form-field">

				<label for="hustle-methods--auto-hide" class="sui-toggle">
					<input type="checkbox"
						id="hustle-methods--auto-hide"
						name="auto_hide" 
						data-attribute="auto_hide"
						{{ _.checked( _.isTrue( auto_hide ), true ) }}/>
					<span class="sui-toggle-slider"></span>
				</label>

				<label for="hustle-methods--auto-hide"><?php printf( esc_html__( 'Auto-Close %s', 'wordpress-popup' ), esc_html( $smallcaps_singular ) ); ?></label>

				<span class="sui-description sui-toggle-description" style="margin-top: 0;"><?php printf( esc_html__( 'This will automatically close your %s after specified time.', 'wordpress-popup' ), esc_html( $smallcaps_singular ) ); ?></span>

				<div id="hustle-auto-hide-toggle-wrapper" class="sui-border-frame sui-toggle-content{{ ( _.isTrue( auto_hide ) ) ? '' : ' sui-hidden' }}">

					<label class="sui-label"><?php printf( esc_html__( 'Automatically close %s after', 'wordpress-popup' ), esc_html( $smallcaps_singular ) ); ?></label>

					<div class="sui-row">

						<div class="sui-col-md-6">

							<input type="number"
								value="{{ auto_hide_time }}"
								min="1"
								class="sui-form-control"
								name="auto_hide_time"
								data-attribute="auto_hide_time">

						</div>

						<div class="sui-col-md-6">

							<select name="auto_hide_unit" data-attribute="auto_hide_unit">

								<option value="seconds"
									{{ _.selected( ( 'seconds' === auto_hide_unit ), true) }}>
									<?php esc_html_e( 'seconds', 'wordpress-popup' ); ?>
								</option>

								<option value="minutes"
									{{ _.selected( ( 'minutes' === auto_hide_unit ), true) }}>
									<?php esc_html_e( 'minutes', 'wordpress-popup' ); ?>
								</option>

								<option value="hours"
									{{ _.selected( ( 'hours' === auto_hide_unit ), true) }}>
									<?php esc_html_e( 'hours', 'wordpress-popup' ); ?>
								</option>

							</select>

						</div>

					</div>

				</div>

			</div>

		<?php } ?>

		<?php
		// SETTINGS: Close when click outside
		if ( Hustle_Module_Model::POPUP_MODULE === $module_type ) :

			if ( true === $onclick ) { ?>

				<div class="sui-form-field">

					<label for="hustle-methods--close-mask" class="sui-toggle">
						<input type="checkbox"
							id="hustle-methods--close-mask"
							name="close_on_background_click"
							data-attribute="close_on_background_click"
							{{ _.checked( _.isTrue( close_on_background_click ), true ) }} />
						<span class="sui-toggle-slider"></span>
					</label>

					<label for="hustle-methods--close-mask"><?php printf( esc_html__( 'Close %1$s when clicked outside', 'wordpress-popup' ), esc_html( $smallcaps_singular ) ); ?></label>

					<span class="sui-description sui-toggle-description" style="margin-top: 0;"><?php printf( esc_html__( 'This will close the %1$s when a user clicks anywhere outside of the %1$s.', 'wordpress-popup' ), esc_html( $smallcaps_singular ), esc_html( $smallcaps_singular ) ); ?></span>

				</div>

			<?php } 
			
		endif; ?>

	</div>

</div>
