<div id="hustle-dialog--tracking-reset-data" class="sui-dialog sui-dialog-alt sui-dialog-sm" aria-hidden="true" tabindex="-1">
	<div class="sui-dialog-overlay sui-fade-out" data-a11y-dialog-hide="hustle-dialog--delete"></div>
	<div role="dialog"
		class="sui-dialog-content sui-bounce-out"
		aria-labelledby="dialogTitle"
		aria-describedby="dialogDescription">
		<div class="sui-box" role="document">
			<div class="sui-box-header sui-block-content-center">
				<h3 id="dialogTitle" class="sui-box-title"><?php esc_html_e( 'Reset Tracking Data', 'wordpress-popup' ); ?></h3>
				<button class="sui-dialog-close" data-a11y-dialog-hide="hustle-dialog--delete">
					<span class="sui-screen-reader-text"><?php esc_html_e( 'Close this dialog window', 'wordpress-popup' ); ?></span>
				</button>
			</div>
			<div class="sui-box-body sui-box-body-slim sui-block-content-center">
				<p id="dialogDescription" class="sui-description"><?php esc_html_e( 'Are you sure you wish reset the tracking data of this module?', 'wordpress-popup' ); ?></p>
			</div>
			<div class="sui-box-footer sui-box-footer-center">
				<button type="button" class="sui-button sui-button-ghost" data-a11y-dialog-hide>
					<?php esc_attr_e( 'Cancel', 'wordpress-popup' ); ?>
				</button>
				<button
					class="sui-button sui-button-ghost sui-button-red hustle-delete"
				>
					<span class="sui-loading-text">
						<i class="sui-icon-trash" aria-hidden="true"></i> <?php esc_attr_e( 'Delete', 'wordpress-popup' ); ?>
					</span>
					<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
				</button>
			</div>
		</div>
	</div>
</div>
