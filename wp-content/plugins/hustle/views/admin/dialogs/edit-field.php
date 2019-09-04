<div id="hustle-dialog--edit-field" class="sui-dialog" aria-hidden="true" tabindex="-1">

	<div class="sui-dialog-overlay sui-fade-out"></div>

	<div role="dialog"
		class="sui-dialog-content sui-bounce-out"
		aria-labelledby="dialogTitle"
		aria-describedby="dialogDescription">

		<div class="sui-box" role="document">

			<div class="sui-box-header sui-block-content-center">

				<h3 id="dialogTitle" class="sui-box-title"><?php esc_html_e( 'Edit Field', Opt_In::TEXT_DOMAIN ); ?></h3>

				<div class="sui-actions-left">

					<span class="sui-tag"></span>

				</div>

				<div class="sui-actions-right">

					<button class="hustle-discard-changes sui-dialog-close">
						<span class="sui-screen-reader-text"><?php esc_html_e( 'Close this dialog window', Opt_In::TEXT_DOMAIN ); ?></span>
					</button>

				</div>

			</div>

			<div class="sui-box-body">

				<div class="sui-tabs sui-tabs-flushed">

					<div data-tabs>

						<div id="hustle-data-tab--settings" class="active"><?php esc_html_e( 'Settings', Opt_In::TEXT_DOMAIN ); ?></div>
						<div id="hustle-data-tab--styling"><?php esc_html_e( 'Styling', Opt_In::TEXT_DOMAIN ); ?></div>

					</div>

					<div id="field-settings-container" data-panes>

						<?php
						// TAB: Settings ?>
						<div id="hustle-data-pane--settings" class="active"></div>

						<?php
						// TAB: Styling ?>
						<div id="hustle-data-pane--styling"></div>

					</div>

				</div>

			</div>

			<div class="sui-box-footer">

				<button class="sui-button sui-button-ghost hustle-discard-changes">
					<i class="sui-icon-undo" aria-hidden="true"></i> <?php esc_attr_e( 'Discard Changes', Opt_In::TEXT_DOMAIN); ?>
				</button>

				<div class="sui-actions-right">

					<button id="hustle-apply-changes" class="sui-button">
						<span class="sui-loading-text">
							<i class="sui-icon-check" aria-hidden="true"></i> <?php esc_attr_e( 'Apply', Opt_In::TEXT_DOMAIN); ?>
						</span>
						<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
					</button>

				</div>

			</div>

		</div>

	</div>

</div>

<script id="hustle-common-field-settings-tpl" type="text/template">

	<?php // TAB: Settings ?>

	<div class="sui-row">

		<div class="sui-col-md-6">

			<div class="sui-form-field">

				<label class="sui-label"><?php esc_html_e( 'Label', Opt_In::TEXT_DOMAIN ); ?></label>

				<input type="text"
					name="label"
					value="{{ label }}"
					placeholder="{{ label_placeholder }}"
					class="sui-form-control" />

			</div>

		</div>

		<div class="sui-col-md-6">

			<div class="sui-form-field">

				<label class="sui-label"><?php esc_html_e( 'Name', Opt_In::TEXT_DOMAIN ); ?></label>

				<input type="text"
					name="name"
					value="{{ name }}"
					{{ ( 'email' === type && 'email' === name ) ? ' readonly="readonly"' : '' }}
					placeholder="{{ name_placeholder }}"
					class="sui-form-control" />

				<span class="sui-description">
					<?php esc_html_e( 'Do not use any spaces in the name to ensure this field is submitted successfully.', Opt_In::TEXT_DOMAIN ); ?>
				</span>

			</div>

		</div>

	</div>

	<div class="sui-form-field">

		<label class="sui-label"><?php esc_html_e( 'Placeholder (optional)', Opt_In::TEXT_DOMAIN ); ?></label>

		<input type="text"
			name="placeholder"
			value="{{ placeholder }}"
			placeholder="{{ placeholder_placeholder }}"
			class="sui-form-control" />

	</div>

	<div class="sui-form-field">

		<label for="hustle-optin-field--required" class="sui-toggle">
			<input type="checkbox"
				name="required"
				value="1"
				id="hustle-optin-field--required"
				{{ _.disabled( 'email' === type && 'email' === name, true ) }}
				{{ _.checked( _.isTrue( required ), true ) }} />
			<span class="sui-toggle-slider"></span>
		</label>

		<label for="hustle-optin-field--required"><?php esc_html_e( 'Require this field', Opt_In::TEXT_DOMAIN ); ?></label>
		<span class="sui-description sui-toggle-description"><?php esc_html_e( 'Force the user to fill out this field, otherwise it will be optional.', Opt_In::TEXT_DOMAIN ); ?></span>

		<# if ( 'email' === type && 'email' === name ) { #>
			<div class="sui-notice" style="margin-top: 10px; margin-left: 48px;">
				<p><?php esc_html_e( "The default email field can't be made optional to ensure there is always a required email field in your opt-in form.", Opt_In::TEXT_DOMAIN ); ?></p>
			</div>
		<# } #>

		<# if ( false && 'url' === type ) { #>
			<label for="hustle-optin-field--validated" class="sui-toggle">
				<input type="checkbox"
					name="validated"
					value="1"
					id="hustle-optin-field--validated"
					{{ _.checked( _.isTrue( validated ), true ) }} />
				<span class="sui-toggle-slider"></span>
			</label>
			<label for="hustle-optin-field--validated"><?php esc_html_e( 'Validate this field', Opt_In::TEXT_DOMAIN ); ?></label>
			<span class="sui-description sui-toggle-description"><?php esc_html_e( 'Make sure the user has filled out this field correctly and warn them when they haven\'t.', Opt_In::TEXT_DOMAIN ); ?></span>
		<# } #>

	</div>

</script>

<script id="hustle-common-field-styling-tpl" type="text/template">

	<?php // TAB: Styling ?>

	<div class="sui-box-settings-row">

		<div class="sui-box-settings-col-1">
			<span class="sui-settings-label"><?php esc_html_e('Additional CSS Classes', Opt_In::TEXT_DOMAIN ); ?></span>
			<span class="sui-description"><?php esc_html_e('Add classes that will be output on this field’s container to aid your theme’s default styling.', Opt_In::TEXT_DOMAIN ); ?></span>
		</div>

		<div class="sui-box-settings-col-2">
			<input type="text"
				name="css_classes"
				value="{{ css_classes }}"
				placeholder="<?php esc_html_e('E.g. form-field', Opt_In::TEXT_DOMAIN ); ?>"
				class="sui-form-control" >
			<span class="sui-description"><?php esc_html_e('These will be output as you see them here.', Opt_In::TEXT_DOMAIN ); ?></span>
		</div>

	</div>

</script>

<script id="hustle-recaptcha-field-settings-tpl" type="text/template">

	<?php // TAB: ReCaptcha Settings ?>

	<div class="sui-form-field">

		<label><b><?php esc_html_e( 'Display', Opt_In::TEXT_DOMAIN ); ?></b></label>
		<span class="sui-description">
			<?php esc_html_e( 'Choose how you want to display the reCAPTCHA widget to your visitors.', Opt_In::TEXT_DOMAIN ); ?>
		</span>

	</div>

	<label class="sui-label"><?php esc_html_e( 'Type', Opt_In::TEXT_DOMAIN ); ?></label>

	<div class="sui-side-tabs">

		<div class="sui-tabs-menu">

			<label for="hustle-recaptcha-type--compact" class="sui-tab-item{{ ( 'compact' === recaptcha_type ) ? ' active' : '' }}">
				<input type="radio"
					name="recaptcha_type"
					data-attribute="recaptcha_type"
					value="compact"
					id="hustle-recaptcha-type--compact"
					data-tab-menu="hustle-theme-recaptcha-tab"
					{{ _.checked( 'compact' === recaptcha_type, true ) }} />
				<?php esc_html_e( 'Compact', Opt_In::TEXT_DOMAIN ); ?>
			</label>

			<label for="hustle-recaptcha-type--full" class="sui-tab-item{{ ( 'full' === recaptcha_type ) ? ' active' : '' }}">
				<input type="radio"
					name="recaptcha_type"
					data-attribute="recaptcha_type"
					value="full"
					data-tab-menu="hustle-theme-recaptcha-tab"
					id="hustle-recaptcha-type--full"
					{{ _.checked( 'full' === recaptcha_type, true ) }} />
				<?php esc_html_e( 'Full size', Opt_In::TEXT_DOMAIN ); ?>
			</label>

		</div>

		<div class="sui-tabs-content">

			<div class="sui-tab-content sui-tab-boxed active" data-tab-content="hustle-theme-recaptcha-tab">

				<div class="sui-form-field">

					<div class="sui-row">

						<div class="sui-col-md-6">

							<label for="hustle-recaptcha-theme" class="sui-label"><?php esc_html_e( 'Theme', Opt_In::TEXT_DOMAIN ); ?></label>

							<select id="hustle-recaptcha-theme" data-attribute="recaptcha_theme" class="sui-select-sm" name="recaptcha_theme">
								<option value="dark" {{ _.selected( 'dark' === recaptcha_theme, true ) }} ><?php esc_attr_e( "Dark", Opt_In::TEXT_DOMAIN ); ?></option>
								<option value="light" {{ _.selected( 'light' === recaptcha_theme, true ) }} ><?php esc_attr_e( "Light", Opt_In::TEXT_DOMAIN ); ?></option>
							</select>

						</div>

						<div class="sui-col-md-6"></div>

					</div>

				</div>

			</div>

		</div>

	</div>

</script>

<script id="hustle-gdpr-field-settings-tpl" type="text/template">

	<?php // TAB: GDPR Settings ?>


	<div class="sui-form-field">

		<label class="sui-label"><?php esc_html_e( 'Label', Opt_In::TEXT_DOMAIN ); ?></label>

		<input type="text"
			name="label"
			value="{{ label }}"
			placeholder="{{ label_placeholder }}"
			class="sui-form-control" />

	</div>

	<div class="sui-form-field">

		<textarea name="gdpr_message" id="gdpr_message">{{gdpr_message}}</textarea>

		<span class="sui-description">
			<?php esc_html_e( 'Note, the form will not submit until the user has accepted the terms.', Opt_In::TEXT_DOMAIN ); ?>
		</span>

	</div>


</script>

<script id="hustle-datepicker-field-settings-tpl" type="text/template">

	<?php // TAB: Datepicker Settings ?>

	<div class="sui-row">

		<div class="sui-col-md-6">

			<div class="sui-form-field">

				<label class="sui-label"><?php esc_html_e( 'Label', Opt_In::TEXT_DOMAIN ); ?></label>

				<input type="text"
					name="label"
					value="{{ label }}"
					placeholder="{{ label_placeholder }}"
					class="sui-form-control" />

			</div>

		</div>

		<div class="sui-col-md-6">

			<div class="sui-form-field">

				<label class="sui-label"><?php esc_html_e( 'Name', Opt_In::TEXT_DOMAIN ); ?></label>

				<input type="text"
					name="name"
					value="{{ name }}"
					placeholder="{{ name_placeholder }}"
					class="sui-form-control" />

			</div>

		</div>

	</div>

	<div class="sui-row">

		<div class="sui-col-md-6">

			<div class="sui-form-field">

				<label class="sui-label"><?php esc_html_e( 'Placeholder (optional)', Opt_In::TEXT_DOMAIN ); ?></label>

				<input type="text"
					name="placeholder"
					value="{{ placeholder }}"
					placeholder="{{ placeholder_placeholder }}"
					class="sui-form-control" />

			</div>

		</div>

		<div class="sui-col-md-6">

			<div class="sui-form-field">

				<label class="sui-label"><?php esc_html_e( 'Format', Opt_In::TEXT_DOMAIN ); ?></label>

				<select id="hustle-date-format" data-attribute="date_format" name="date_format">
					<?php
						$formats = Opt_In_Utils::get_date_formats();
						foreach ( $formats as $key => $format ) {
					?>
							<option value="<?php echo esc_attr( $key ); ?>" {{ _.selected( '<?php echo esc_attr( $key ); ?>' === date_format, true ) }} ><?php echo esc_attr( $format ); ?></option>
					<?php } ?>
				</select>

			</div>

		</div>

	</div>

	<div class="sui-form-field">

		<label for="hustle-optin-field--required" class="sui-toggle">
			<input type="checkbox"
				name="required"
				value="1"
				id="hustle-optin-field--required"
				{{ _.checked( _.isTrue( required ), true ) }} />
			<span class="sui-toggle-slider"></span>
		</label>

		<label for="hustle-optin-field--required"><?php esc_html_e( 'Require this field', Opt_In::TEXT_DOMAIN ); ?></label>
		<span class="sui-description sui-toggle-description"><?php esc_html_e( 'Force the user to fill out this field, otherwise it will be optional.', Opt_In::TEXT_DOMAIN ); ?></span>

		<# if ( 'email' === type || 'url' === type ) { #>
			<label for="hustle-optin-field--validated" class="sui-toggle">
				<input type="checkbox"
					name="validated"
					value="1"
					id="hustle-optin-field--validated"
					{{ _.checked( _.isTrue( validated ), true ) }} />
				<span class="sui-toggle-slider"></span>
			</label>
			<label for="hustle-optin-field--validated"><?php esc_html_e( 'Validate this field', Opt_In::TEXT_DOMAIN ); ?></label>
			<span class="sui-description sui-toggle-description"><?php esc_html_e( 'Make sure the user has filled out this field correctly and warn them when they haven\'t.', Opt_In::TEXT_DOMAIN ); ?></span>
		<# } #>

	</div>

</script>

<script id="hustle-timepicker-field-settings-tpl" type="text/template">

	<?php // TAB: Timepicker Settings ?>

	<div class="sui-row">

		<div class="sui-col-md-12">

			<label class="sui-label"><?php esc_html_e( 'Format', Opt_In::TEXT_DOMAIN ); ?></label>

			<div class="sui-side-tabs">

				<div class="sui-tabs-menu">

					<label for="hustle-time-format--12" class="sui-tab-item{{ ( '12' === time_format ) ? ' active' : '' }}">
						<input type="radio"
							name="time_format"
							data-attribute="time_format"
							value="12"
							id="hustle-time-format--12"
							{{ _.checked( '12' === time_format, true ) }} />
						<?php esc_html_e( '12 hour', Opt_In::TEXT_DOMAIN ); ?>
					</label>

					<label for="hustle-time-format--24" class="sui-tab-item{{ ( '24' === time_format ) ? ' active' : '' }}">
						<input type="radio"
							name="time_format"
							data-attribute="time_format"
							value="24"
							id="hustle-time-format--24"
							{{ _.checked( '24' === time_format, true ) }} />
						<?php esc_html_e( '24 hour', Opt_In::TEXT_DOMAIN ); ?>
					</label>

				</div>

				<div class="sui-tabs-content">
				</div>

			</div>

		</div>

	</div>

	<div class="sui-row">

		<div class="sui-col-md-6">

			<div class="sui-form-field">

				<label class="sui-label"><?php esc_html_e( 'Label', Opt_In::TEXT_DOMAIN ); ?></label>

				<input type="text"
					name="label"
					value="{{ label }}"
					placeholder="{{ label_placeholder }}"
					class="sui-form-control" />

			</div>

		</div>

		<div class="sui-col-md-6">

			<div class="sui-form-field">

				<label class="sui-label"><?php esc_html_e( 'Name', Opt_In::TEXT_DOMAIN ); ?></label>

				<input type="text"
					name="name"
					value="{{ name }}"
					placeholder="{{ name_placeholder }}"
					class="sui-form-control" />

			</div>

		</div>

	</div>

	<label class="sui-label"><?php esc_html_e( 'Default time', Opt_In::TEXT_DOMAIN ); ?></label>
	<div class="sui-row">

		<div class="sui-col-md-2">
			<div class="sui-form-field">
				<input type="number"
					min="{{ '12' === time_format ? 1 : 0 }}"
					max="{{ '12' === time_format ? 12 : 23 }}"
					name="time_hours"
					value="{{ time_hours }}"
					class="sui-form-control" />
			</div>
		</div>

		<div class="sui-col-md-2">
			<div class="sui-form-field">
				<input type="number"
					min="0"
					max="59"
					name="time_minutes"
					value="{{ time_minutes }}"
					class="sui-form-control" />
			</div>
		</div>

		<div class="sui-col-md-3">
			<div class="sui-form-field{{'24' === time_format ? ' sui-hidden' : ''}}">
				<select id="hustle-date-format" data-attribute="time_period" class="sui-select-sm" name="time_period">
					<?php
						$periods = Opt_In_Utils::get_time_periods();
						foreach ( $periods as $key => $period ) {
					?>
							<option value="<?php echo esc_attr( $key ); ?>" {{ _.selected( '<?php echo esc_attr( $key ); ?>' === time_period, true ) }} ><?php echo esc_attr( $period ); ?></option>
					<?php } ?>
				</select>
			</div>
		</div>

		<div class="sui-col-md-5">
		</div>

	</div>

	<div class="sui-form-field">

		<label for="hustle-optin-field--required" class="sui-toggle">
			<input type="checkbox"
				name="required"
				value="1"
				id="hustle-optin-field--required"
				{{ _.checked( _.isTrue( required ), true ) }} />
			<span class="sui-toggle-slider"></span>
		</label>

		<label for="hustle-optin-field--required"><?php esc_html_e( 'Require this field', Opt_In::TEXT_DOMAIN ); ?></label>
		<span class="sui-description sui-toggle-description"><?php esc_html_e( 'Force the user to fill out this field, otherwise it will be optional.', Opt_In::TEXT_DOMAIN ); ?></span>

		<# if ( 'email' === type || 'url' === type ) { #>
			<label for="hustle-optin-field--validated" class="sui-toggle">
				<input type="checkbox"
					name="validated"
					value="1"
					id="hustle-optin-field--validated"
					{{ _.checked( _.isTrue( validated ), true ) }} />
				<span class="sui-toggle-slider"></span>
			</label>
			<label for="hustle-optin-field--validated"><?php esc_html_e( 'Validate this field', Opt_In::TEXT_DOMAIN ); ?></label>
			<span class="sui-description sui-toggle-description"><?php esc_html_e( 'Make sure the user has filled out this field correctly and warn them when they haven\'t.', Opt_In::TEXT_DOMAIN ); ?></span>
		<# } #>

	</div>

</script>

<script id="hustle-submit-field-settings-tpl" type="text/template">

	<?php // TAB: Submit Settings ?>

	<div class="sui-row">

		<div class="sui-col-md-12">

			<div class="sui-form-field">

				<label class="sui-label"><?php esc_html_e( 'Button Text', Opt_In::TEXT_DOMAIN ); ?></label>

				<input type="text"
					name="label"
					value="{{ label }}"
					class="sui-form-control" />

			</div>

		</div>

	</div>

	<div class="sui-row">

		<div class="sui-col-md-12">

			<div class="sui-form-field">

				<label class="sui-label"><?php esc_html_e( 'Error Message', Opt_In::TEXT_DOMAIN ); ?></label>

				<input type="text"
					name="error_message"
					value="{{ error_message }}"
					class="sui-form-control" />

			</div>

		</div>

	</div>

</script>
