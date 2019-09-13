<?php
ob_start();

require self::$plugin_path . 'assets/css/sui-editor.min.css';
$editor_css = ob_get_clean();
$editor_css = '<style>' . $editor_css. '</style>';
?>

<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label"><?php esc_html_e( 'Submission Behavior', 'wordpress-popup' ); ?></span>
		<span class="sui-description"><?php esc_html_e( 'Show a success message to the visitors or redirect them to another URL on successful form submission.', 'wordpress-popup' ); ?></span>
	</div>

	<div class="sui-box-settings-col-2">

		<div class="sui-side-tabs">

			<div class="sui-tabs-menu">

				<label class="sui-tab-item {{ 'show_success' === after_successful_submission ? 'active' : '' }}">
					<input type="radio"
						name="after_successful_submission"
						data-attribute="after_successful_submission"
						data-tab-menu="show_success"
						value="show_success"
						{{ _.checked( ( 'show_success' === after_successful_submission ), true) }}/>
					<?php esc_html_e( 'Success message', 'wordpress-popup' ); ?>
				</label>
				<label class="sui-tab-item {{ 'redirect' === after_successful_submission ? 'active' : '' }}">
					<input type="radio"
						name="after_successful_submission"
						data-attribute="after_successful_submission"
						data-tab-menu="redirect"
						value="redirect"
						{{ _.checked( ( 'redirect' === after_successful_submission ), true) }}/>
					<?php esc_html_e( 'Redirect', 'wordpress-popup' ); ?>
				</label>

			</div>

			<div class="sui-tabs-content">

				<div class="sui-tab-content sui-tab-boxed {{ 'show_success' === after_successful_submission ? 'active' : '' }}" data-tab-content="show_success">

					<div class="sui-form-field">

						<label class="sui-label sui-label-editor"><?php esc_html_e( 'Message', 'wordpress-popup' ); ?></label>

						<?php wp_editor(
							'{{ success_message }}',
							'success_message',
							array(
								'media_buttons'    => false,
								'textarea_name'    => 'success_message',
								'editor_css'       => $editor_css,
								'tinymce'          => array(
									'content_css' => self::$plugin_url . 'assets/css/sui-editor.min.css'
								),
								'editor_height'    => 192,
								'drag_drop_upload' => false,
							)
						); ?>

					</div>

					<div id="section-auto-close-success-message" class="sui-form-field">

						<label class="sui-label"><?php esc_html_e( 'Auto close success message', 'wordpress-popup' ); ?></label>

						<select name="auto_close_success_message" data-attribute="auto_close_success_message">
							<option value="0" {{ _.selected(_.isFalse(auto_close_success_message), true) }}><?php esc_html_e( 'Never', 'wordpress-popup' ); ?></option>
							<option value="1" {{ _.selected(_.isTrue(auto_close_success_message), true) }}><?php esc_html_e( 'After specified time', 'wordpress-popup' ); ?></option>
						</select>

						<div class="sui-row {{ _.isFalse(auto_close_success_message) ? 'sui-hidden' : '' }}">

							<div class="sui-col-md-6">
								<input type="number"
									name="auto_close_time"
									data-attribute="auto_close_time"
									value="{{ auto_close_time }}"
									placeholder="0"
									min="0"
									class="sui-form-control" />
							</div>

							<div class="sui-col-md-6">
								<select class="sui-select" name="auto_close_unit" data-attribute="auto_close_unit">
									<option value="seconds" {{ _.selected( ('seconds' === auto_close_unit), true) }}><?php esc_html_e( 'seconds', 'wordpress-popup' ); ?></option>
									<option value="minutes" {{ _.selected( ('minutes' === auto_close_unit), true) }}><?php esc_html_e( 'minutes', 'wordpress-popup' ); ?></option>
								</select>
							</div>

						</div>

					</div>

				</div>

				<div class="sui-tab-content sui-tab-boxed {{ 'redirect' === after_successful_submission ? 'active' : '' }}" data-tab-content="redirect">

					<div class="sui-form-field">

						<label class="sui-label"><?php esc_html_e( 'Redirect URL', 'wordpress-popup' ); ?></label>
						<input type="url"
							name="redirect_url"
							data-attribute="redirect_url"
							value="{{ redirect_url }}"
							placeholder="<?php esc_html_e( 'E.g. http://website.com', 'wordpress-popup' ); ?>"
							class="sui-form-control" />

					</div>

				</div>

			</div>

		</div>

	</div>

</div>
