<div id="recaptcha-box" class="sui-box hustle-settings-tab-recaptcha" data-tab="recaptcha"  <?php if ( 'recaptcha' !== $section ) echo 'style="display: none;"'; ?>>

	<div class="sui-box-header">
		<h2 class="sui-box-title"><?php esc_html_e( 'reCAPTCHA', 'wordpress-popup' ); ?></h2>
	</div>

	<div class="sui-box-body">

		<div class="sui-box-settings-row">

			<div class="sui-box-settings-col-1">
				<span class="sui-settings-label"><?php esc_html_e( 'Configure', 'wordpress-popup' ); ?></span>
				<span class="sui-description"><?php esc_html_e( 'You need to enter your API keys here to use reCAPTCHA field in your opt-in forms.', 'wordpress-popup' ); ?></span>
				<span class="sui-description"><?php printf( esc_html( __( "Note: Click %1\$shere%2\$s to register your site with reCAPTCHA API and generate your API keys.", 'wordpress-popup' ) ), '<a href="https://www.google.com/recaptcha/admin#list" target="_blank">', '</a>' ); ?></span>

			</div>

			<div class="sui-box-settings-col-2">

				<div id="recaptcha-site-key">

					<div class="sui-form-field">

						<label class="sui-label"><?php esc_html_e( 'Site Key', 'wordpress-popup' ); ?></label>

						<input type="text"
							name="hustle-recaptcha-site-key"
							placeholder="<?php esc_html_e( 'Enter your site key here', 'wordpress-popup' ); ?>"
							value="<?php echo ! empty( $settings['sitekey'] ) ? esc_html( $settings['sitekey'] ) : ''; ?>"
							class="sui-form-control" />

					</div>

					<div class="sui-form-field">

						<label class="sui-label"><?php esc_html_e( 'Secret Key', 'wordpress-popup' ); ?></label>

						<input type="text"
							name="hustle-recaptcha-secret-key"
							placeholder="<?php esc_html_e( 'Enter your secret key here', 'wordpress-popup' ); ?>"
							value="<?php echo ! empty( $settings['secret'] ) ? esc_html( $settings['secret'] ) : ''; ?>"
							class="sui-form-control" />

					</div>

					<div class="sui-form-field">
						<label class="sui-label"><?php esc_html_e( 'Language', 'wordpress-popup' ); ?></label>
							<select id="hustle-recaptcha-language" data-attribute="recaptcha_language" class="sui-select" name="recaptcha_language">
								<option value="automatic" <?php selected( !empty( $settings['language'] ) && 'automatic' === $settings['language'] ); ?>>
									<?php esc_attr_e( "Automatic", 'wordpress-popup' ); ?>
								</option>
								<?php
									$languages = Opt_In_Utils::get_captcha_languages();
									foreach ( $languages as $key => $language ) {
								?>
										<option value="<?php echo esc_attr( $key ); ?>" <?php selected( !empty( $settings['language'] ) && $settings['language'] === $key ); ?>>
											<?php echo esc_attr( $language ); ?>
										</option>
								<?php } ?>
							</select>
						<span class="sui-description"><?php esc_html_e( "By default, we'll show the reCAPTCHA in your website's language.", 'wordpress-popup' ); ?></span>
					</div>

				</div>

			</div>

		</div>

	</div>

	<div class="sui-box-footer">

		<div class="sui-actions-right">

			<button class="sui-button sui-button-blue hustle-settings-save" data-nonce="<?php echo esc_attr( wp_create_nonce( 'hustle-settings' ) ); ?>">
				<span class="sui-loading-text"><?php esc_html_e( 'Save Settings', 'wordpress-popup' ); ?></span>
				<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
			</button>

		</div>

	</div>

</div>
