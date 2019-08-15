<div
	id="hustle-dialog--import"
	class="sui-dialog sui-dialog-alt sui-dialog-sm"
	aria-hidden="true"
	tabindex="-1"
>

	<div class="sui-dialog-overlay sui-fade-out" data-a11y-dialog-hide="hustle-dialog--import"></div>

	<div
		role="dialog"
		class="sui-dialog-content sui-bounce-out"
		aria-labelledby="dialogTitle"
		aria-describedby="dialogDescription"
	>

		<div role="document" class="sui-box">

			<div class="sui-box-header sui-block-content-center">

				<h3 id="dialogTitle" class="sui-box-title"><?php printf( esc_html__( 'Import %s', Opt_In::TEXT_DOMAIN ), esc_html( $capitalize_singular ) ); ?></h3>

				<button class="sui-dialog-close" data-a11y-dialog-hide="hustle-dialog--import">
					<span class="sui-screen-reader-text"><?php esc_html_e( 'Close this dialog window', Opt_In::TEXT_DOMAIN ); ?></span>
				</button>

			</div>

			<div class="sui-box-body sui-box-body-slim sui-block-content-center">

				<p id="dialogDescription" class="sui-description"><?php printf( esc_html__( 'Choose the %1$s configuration file and hit import to import your %1$s.', Opt_In::TEXT_DOMAIN ), esc_html( $smallcaps_singular ) ); ?></p>

				<div class="sui-notice sui-notice-error sui-hidden">
					<p><?php printf( esc_html__( "The file %1\$s is either invalid or doesn't have any %2\$s configurations. Please check your file or upload another file.", Opt_In::TEXT_DOMAIN ), '<strong></strong>', esc_html( $smallcaps_singular ) ); ?></p>
				</div>

				<div class="sui-form-field">

					<label class="sui-label"><?php esc_html_e( 'Configuration file', Opt_In::TEXT_DOMAIN ); ?></label>

					<div class="sui-upload">

						<input
							id="sui-upload-button"
							type="file"
							value=""
							readonly="readonly"
							accept=".json"
						/>

						<button class="sui-upload-button" for="sui-upload-button">
							<i class="sui-icon-upload-cloud" aria-hidden="true"></i> <?php esc_html_e( 'Upload file', Opt_In::TEXT_DOMAIN ); ?>
						</button>

						<div class="sui-upload-file">

							<span></span>

							<button aria-label="Remove file">
								<i class="sui-icon-close" aria-hidden="true"></i>
							</button>

						</div>

					</div>

					<span class="sui-description" style="margin-top: 10px;"><?php printf( esc_html__( 'Choose a JSON (.json) file to import the %s from.', Opt_In::TEXT_DOMAIN ), esc_html( $smallcaps_singular ) ); ?></span>

				</div>

			</div>

			<div class="sui-box-footer">

				<button class="sui-button"
					id="hustle-upload-button"
					data-type="<?php echo esc_attr( $module_type ); ?>"
					data-nonce="<?php echo esc_attr( wp_create_nonce( 'hustle_module_import' . $module_type ) ); ?>"
					disabled
				>

					<span class="sui-loading-text">
						<i class="sui-icon-upload-cloud" aria-hidden="true"></i> <?php esc_html_e( 'Import', Opt_In::TEXT_DOMAIN ); ?>
					</span>

					<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>

				</button>

				<div class="sui-actions-right">

					<button class="sui-button sui-button-ghost" data-a11y-dialog-hide="hustle-dialog--import">
						<?php esc_html_e( 'Cancel', Opt_In::TEXT_DOMAIN ); ?>
					</button>

				</div>

			</div>

		</div>

	</div>

</div>
