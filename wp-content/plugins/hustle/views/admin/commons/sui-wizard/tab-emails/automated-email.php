<?php
ob_start();

require self::$plugin_path . 'assets/css/sui-editor.min.css';
$editor_css = ob_get_clean();
$editor_css = '<style>' . $editor_css. '</style>';
?>

<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">

		<span class="sui-settings-label"><?php esc_html_e( 'Automated Email', 'wordpress-popup' ); ?></span>

		<span class="sui-description"><?php esc_html_e( "Send an automated email to the subscribers after they've subscribed.", 'wordpress-popup' ); ?></span>

	</div>

	<div class="sui-box-settings-col-2">
		<label for="hustle-automated-email" class="sui-toggle">
			<input type="checkbox"
				name="automated_email"
				data-attribute="automated_email"
				id="hustle-automated-email"
				{{ _.checked( _.isTrue( automated_email ), true ) }} />
			<span class="sui-toggle-slider"></span>
		</label>

		<label for="hustle-automated-email"><?php esc_html_e( 'Send an automated email to the user', 'wordpress-popup' ); ?></label>

		<div id="hustle-automated-email-toggle-wrapper" class="sui-border-frame sui-toggle-content{{ ( _.isTrue( automated_email ) ) ? '' : ' sui-hidden' }}">



				<div class="sui-form-field">

					<label class="sui-label"><?php esc_html_e( 'Email time', 'wordpress-popup' ); ?></label>


					<div class="sui-side-tabs">

						<div class="sui-tabs-menu">

							<label class="sui-tab-item {{ 'instant' === email_time ? 'active' : '' }}">
								<input type="radio"
									name="email_time"
									data-attribute="email_time"
									value="instant"
									{{ _.checked( ( 'instant' === email_time ), true) }}/>
								<?php esc_html_e( 'Instant', 'wordpress-popup' ); ?>
							</label>
							<label class="sui-tab-item {{ 'delay' === email_time ? 'active' : '' }}">
								<input type="radio"
									name="email_time"
									data-attribute="email_time"
									data-tab-menu="delay"
									value="delay"
									{{ _.checked( ( 'redirect' === email_time ), true) }}/>
								<?php esc_html_e( 'Delay', 'wordpress-popup' ); ?>
							</label>
							<label class="sui-tab-item {{ 'schedule' === email_time ? 'active' : '' }}">
								<input type="radio"
									name="email_time"
									data-attribute="email_time"
									data-tab-menu="schedule"
									value="schedule"
									{{ _.checked( ( 'redirect' === email_time ), true) }}/>
								<?php esc_html_e( 'Schedule', 'wordpress-popup' ); ?>
							</label>

						</div>

						<div class="sui-tabs-content">

							<div class="sui-tab-content sui-tab-boxed {{ 'delay' === email_time ? 'active' : '' }}" data-tab-content="delay">

								<div class="sui-row" >

									<div class="sui-col-md-6">
										<input type="number"
											name="auto_email_time"
											data-attribute="auto_email_time"
											value="{{ auto_email_time }}"
											placeholder="0"
											min="0"
											class="sui-form-control" />
									</div>

									<div class="sui-col-md-6">
										<select name="auto_email_unit" data-attribute="auto_email_unit">
											<option value="seconds" {{ _.selected( ('seconds' === auto_email_unit), true) }}><?php esc_html_e( 'seconds', 'wordpress-popup' ); ?></option>
											<option value="minutes" {{ _.selected( ('minutes' === auto_email_unit), true) }}><?php esc_html_e( 'minutes', 'wordpress-popup' ); ?></option>
											<option value="hours" {{ _.selected( ('hours' === auto_email_unit), true) }}><?php esc_html_e( 'hours', 'wordpress-popup' ); ?></option>
											<option value="days" {{ _.selected( ('days' === auto_email_unit), true) }}><?php esc_html_e( 'days', 'wordpress-popup' ); ?></option>
										</select>
									</div>

								</div>

							</div>

							<div class="sui-tab-content sui-tab-boxed {{ 'schedule' === email_time ? 'active' : '' }}" data-tab-content="schedule">

								<label class="sui-description"><?php printf( esc_html__( 'Choose a fixed date and time for your email or select %1$sDatepicker and Timepicker%2$s fields of your form to schedule this email dynamically based on user input.', 'wordpress-popup' ), '<b>', '</b>' ); ?></label>

								<div class="sui-form-field">

									<label for="hustle-email-day" class="sui-label"><?php esc_html_e( 'Day', 'wordpress-popup' ); ?></label>

									<div class="sui-insert-variables">

										<div class="sui-control-with-icon">

											<input type="text"
												name="day"
												value="{{ day }}"
												placeholder="Datepicker {date-1}"
												id="hustle-email-day"
												class="sui-form-control"
												data-attribute="day"
											/>

											<i class="sui-icon-calendar" aria-hidden="true"></i>

										</div>

										<select class="hustle-field-options" data-type="datepicker"></select>

									</div>

								</div>

								<div class="sui-form-field">

									<label for="hustle-email-time" class="sui-label"><?php esc_html_e( 'Time of Day', 'wordpress-popup' ); ?></label>

									<div class="sui-insert-variables hustle-field">

										<div class="sui-control-with-icon">

											<input type="text"
												name="time"
												value="{{ time }}"
												placeholder="<?php printf( esc_attr__( 'Timepicker %s', 'wordpress-popup' ), '{time-1}' ); ?>"
												id="hustle-email-time"
												class="sui-form-control"
												data-attribute="time"
											/>

											<i class="sui-icon-clock" aria-hidden="true"></i>

										</div>

										<select class="hustle-field-options" data-type="timepicker"></select>

									</div>

								</div>

							</div>

						</div>

					</div>

				</div>

				<div class="sui-form-field">

					<label for="hustle-email-recipient" class="sui-label"><?php esc_html_e( 'Recipient', 'wordpress-popup' ); ?></label>

					<div class="sui-insert-variables">

						<input type="text"
							name="recipient"
							value="{{ recipient }}"
							placeholder="Email {email-1}"
							id="hustle-email-recipient"
							class="sui-form-control"
							data-attribute="recipient"
						/>

						<select class="hustle-field-options" data-type="email"></select>

					</div>

				</div>

				<div class="sui-form-field">

					<label for="hustle-email-copy-subject" class="sui-label"><?php esc_html_e( 'Subject', 'wordpress-popup' ); ?></label>

					<input type="text"
						placeholder="<?php esc_html_e( 'Email copy subject', 'wordpress-popup' ); ?>"
						name="email_subject"
						data-attribute="email_subject"
						value="{{ email_subject }}"
						id="hustle-email-copy-subject"
						class="sui-form-control" />

				</div>

				<div class="sui-form-field">

					<label class="sui-label sui-label-editor"><?php esc_html_e( 'Email body', 'wordpress-popup' ); ?></label>

					<?php wp_editor(
						'{{ email_body }}',
						'email_body',
						array(
							'media_buttons'    => false,
							'textarea_name'    => 'email_body',
							'editor_css'       => $editor_css,
							'tinymce'          => array(
								'content_css' => self::$plugin_url . 'assets/css/sui-editor.min.css'
							),
							'editor_height'    => 192,
							'drag_drop_upload' => false,
						)
					); ?>

				</div>

		</div>

	</div>

</div>
