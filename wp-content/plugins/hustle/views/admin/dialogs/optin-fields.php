<div id="hustle-dialog--optin-fields" class="sui-dialog" aria-hidden="true" tabindex="-1">

	<div class="sui-dialog-overlay sui-fade-out"></div>

	<div role="dialog"
		class="sui-dialog-content sui-bounce-out"
		aria-labelledby="dialogTitle"
		aria-describedby="dialogDescription">

		<div class="sui-box" role="document">

			<div class="sui-box-header">
          
          
		     	<h3 class="sui-box-title" id="dialogTitle"><?php esc_html_e( 'Insert Fields', Opt_In::TEXT_DOMAIN ); ?></h3>
          
		     	<div class="sui-actions-right">
          
		     		<button class="hustle-cancel-insert-fields sui-dialog-close">
		     			<span class="sui-screen-reader-text"><?php esc_html_e( 'Close this dialog window', Opt_In::TEXT_DOMAIN ); ?></span>
		     		</button>
          
				</div>

			</div>

			<div class="sui-box-body">

				<p><?php esc_html_e( 'Choose which fields you want to insert into your opt-in form.', Opt_In::TEXT_DOMAIN ); ?></p>

			</div>

			<div class="sui-box-selectors sui-box-selectors-col-5">

				<ul class="sui-spacing-slim">

					<li><label for="hustle-optin-insert-field--name" class="sui-box-selector sui-box-selector-vertical">
						<input type="checkbox"
							value="name"
							name="optin_fields"
							id="hustle-optin-insert-field--name" />
						<span>
							<i class="sui-icon-profile-male" aria-hidden="true"></i>
							<?php esc_html_e( 'Name', Opt_In::TEXT_DOMAIN ); ?>
						</span>
					</label></li>

					<li><label for="hustle-optin-insert-field--email" class="sui-box-selector sui-box-selector-vertical">
						<input type="checkbox"
							value="email"
							name="optin_fields"
							id="hustle-optin-insert-field--email" />
						<span>
							<i class="sui-icon-mail" aria-hidden="true"></i>
							<?php esc_html_e( 'Email', Opt_In::TEXT_DOMAIN ); ?>
						</span>
					</label></li>

					<li><label for="hustle-optin-insert-field--phone" class="sui-box-selector sui-box-selector-vertical">
						<input type="checkbox"
							value="phone"
							name="optin_fields"
							id="hustle-optin-insert-field--phone" />
						<span>
							<i class="sui-icon-phone" aria-hidden="true"></i>
							<?php esc_html_e( 'Phone', Opt_In::TEXT_DOMAIN ); ?>
						</span>
					</label></li>

					<li><label for="hustle-optin-insert-field--address" class="sui-box-selector sui-box-selector-vertical">
						<input type="checkbox"
							value="address"
							name="optin_fields"
							id="hustle-optin-insert-field--address" />
						<span>
							<i class="sui-icon-pin" aria-hidden="true"></i>
							<?php esc_html_e( 'Address', Opt_In::TEXT_DOMAIN ); ?>
						</span>
					</label></li>

					<li><label for="hustle-optin-insert-field--url" class="sui-box-selector sui-box-selector-vertical">
						<input type="checkbox"
							value="url"
							name="optin_fields"
							id="hustle-optin-insert-field--url" />
						<span>
							<i class="sui-icon-web-globe-world" aria-hidden="true"></i>
							<?php esc_html_e( 'Website', Opt_In::TEXT_DOMAIN ); ?>
						</span>
					</label></li>

					<li><label for="hustle-optin-insert-field--text" class="sui-box-selector sui-box-selector-vertical">
						<input type="checkbox"
							value="text"
							name="optin_fields"
							id="hustle-optin-insert-field--text" />
						<span>
							<i class="sui-icon-style-type" aria-hidden="true"></i>
							<?php esc_html_e( 'Text', Opt_In::TEXT_DOMAIN ); ?>
						</span>
					</label></li>

					<li><label for="hustle-optin-insert-field--number" class="sui-box-selector sui-box-selector-vertical">
						<input type="checkbox"
							value="number"
							name="optin_fields"
							id="hustle-optin-insert-field--number" />
						<span>
							<i class="sui-icon-element-number" aria-hidden="true"></i>
							<?php esc_html_e( 'Number', Opt_In::TEXT_DOMAIN ); ?>
						</span>
					</label></li>

					<li><label for="hustle-optin-insert-field--datepicker" class="sui-box-selector sui-box-selector-vertical">
						<input type="checkbox"
							value="datepicker"
							name="optin_fields"
							id="hustle-optin-insert-field--datepicker" />
						<span>
							<i class="sui-icon-calendar" aria-hidden="true"></i>
							<?php esc_html_e( 'Datepicker', Opt_In::TEXT_DOMAIN ); ?>
						</span>
					</label></li>

					<!--<li><label for="hustle-optin-insert-field--timepicker" class="sui-box-selector sui-box-selector-vertical">
						<input type="checkbox"
							value="timepicker"
							name="optin_fields"
							id="hustle-optin-insert-field--timepicker" />
						<span>
							<i class="sui-icon-clock" aria-hidden="true"></i>
							<?php //esc_html_e( 'Timepicker', Opt_In::TEXT_DOMAIN ); ?>
						</span>
					</label></li>-->

<?php if ( $is_recaptcha_available ) { ?>
					<li><label for="hustle-optin-insert-field--recaptcha" class="sui-box-selector sui-box-selector-vertical hustle-skip">
						<input type="checkbox"
							value="recaptcha"
							name="optin_fields"
							<?php disabled( array_key_exists( 'recaptcha', $form_elements ) ); ?>
							<?php checked( array_key_exists( 'recaptcha', $form_elements ) ); ?>
							id="hustle-optin-insert-field--recaptcha" />
						<span>
							<i class="sui-icon-recaptcha" aria-hidden="true"></i>
							<?php esc_html_e( 'reCaptcha', Opt_In::TEXT_DOMAIN ); ?>
						</span>
					</label></li>
<?php } ?>

					<li><label for="hustle-optin-insert-field--gdpr" class="sui-box-selector sui-box-selector-vertical hustle-skip">
						<input type="checkbox"
							value="gdpr"
							name="optin_fields"
							<?php disabled( array_key_exists( 'gdpr', $form_elements ) ); ?>
							<?php checked( array_key_exists( 'gdpr', $form_elements ) ); ?>
							id="hustle-optin-insert-field--gdpr" />
						<span>
							<i class="sui-icon-gdpr" aria-hidden="true"></i>
							<?php esc_html_e( 'GDPR Approval', Opt_In::TEXT_DOMAIN ); ?>
						</span>
					</label></li>

				</ul>

			</div>

			<div class="sui-box-footer">

				<button class="sui-button sui-button-ghost hustle-cancel-insert-fields">
					<?php esc_attr_e( 'Cancel', Opt_In::TEXT_DOMAIN); ?>
				</button>

				<div class="sui-actions-right">

					<button id="hustle-insert-fields" class="sui-button sui-button-blue">
						<span class="sui-loading-text"><?php esc_attr_e( 'Insert Fields', Opt_In::TEXT_DOMAIN); ?></span>
						<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
					</button>

				</div>

			</div>

		</div>

	</div>

</div>
