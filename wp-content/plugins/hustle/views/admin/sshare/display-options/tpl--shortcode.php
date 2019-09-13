<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">

		<span class="sui-settings-label"><?php esc_html_e( 'Shortcode', 'wordpress-popup' ); ?></span>

		<span class="sui-description"><?php esc_html_e( 'Create a shortcode for your social bar and display it wherever you want.', 'wordpress-popup' ); ?></span>

	</div>

	<div class="sui-box-settings-col-2">

		<div class="sui-form-field">

			<label for="hustle-settings--shortcode-enable" class="sui-toggle">
				<input
					type="checkbox"
					name="shortcode_enabled"
					data-attribute="shortcode_enabled"
					id="hustle-settings--shortcode-enable"
					{{ _.checked( _.isTrue( shortcode_enabled ), true ) }}
				/>
				<span class="sui-toggle-slider"></span>
			</label>

			<label for="hustle-settings--shortcode-enable"><?php esc_html_e( 'Enable shortcode module', 'wordpress-popup' ); ?></label>

			<div id="hustle-shortcode-toggle-wrapper" class="sui-toggle-content{{ ( _.isTrue( shortcode_enabled ) ) ? '' : ' sui-hidden' }}">

				<span class="sui-description"><?php esc_html_e( 'Just copy the shortcode and paste it wherever you want to render your social bar.', 'wordpress-popup' ); ?></span>

				<div class="sui-border-frame">

					<label class="sui-label"><?php esc_html_e( 'Shortcode to render your social bar', 'wordpress-popup' ); ?></label>

					<div class="sui-with-button sui-with-button-inside">
						<input
							type="text"
							value="[wd_hustle id='<?php echo esc_attr( $shortcode_id ); ?>' type='social_sharing'/]"
							class="sui-form-control"
							readonly="readonly"
						/>
						<button class="sui-button-icon hustle-copy-shortcode-button">
							<i class="sui-icon-copy" aria-hidden="true"></i>
							<span class="sui-screen-reader-text"><?php esc_html_e( 'Copy shortcode', 'wordpress-popup' ); ?></span>
						</button>
					</div>

				</div>

				<div class="sui-notice sui-notice-info" style="margin-top: 10px;">
					<p><?php esc_html_e( "You have full control over the shortcode. Visibility rules in the following section won't affect shortcode.", 'wordpress-popup' ); ?></p>
				</div>

			</div>

		</div>

	</div>

</div>
