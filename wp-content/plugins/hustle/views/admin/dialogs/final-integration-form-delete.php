<div
	id="hustle-dialog--final-delete"
	class="sui-dialog sui-dialog-alt sui-dialog-sm"
	aria-hidden="true"
	tabindex="-1"
>

	<div class="sui-dialog-overlay sui-fade-out" data-a11y-dialog-hide="hustle-dialog--delete-final-integration"></div>

	<div
		class="sui-dialog-content sui-bounce-out"
		aria-labelledby="dialogTitle"
		aria-describedby="dialogDescription"
		role="dialog"
	>

		<div class="sui-box" role="document">

			<div class="sui-box-header sui-block-content-center">

				<h3 id="dialogTitle" class="sui-box-title"><?php esc_html_e( 'Integration Required!', 'wordpress-popup' ); ?></h3>

				<button class="sui-dialog-close" data-a11y-dialog-hide="hustle-dialog--delete-final-integration">
					<span class="sui-screen-reader-text"><?php esc_html_e( 'Close this dialog window', 'wordpress-popup' ); ?></span>
				</button>

			</div>

			<div class="sui-box-body sui-box-body-slim sui-block-content-center">

				<p class="sui-description"><?php esc_html_e( "At least one integration should be connected in a opt-in module. If you choose to continue a local list will be enabled automatically.", 'wordpress-popup' ); ?></p>

			</div>

			<div class="sui-box-footer sui-box-footer-center">

				<button class="sui-button sui-button-ghost "
				data-a11y-dialog-hide="hustle-dialog--delete-final-integration-cancel"
				id="hustle-delete-final-button-cancel">
					<?php esc_html_e( 'Cancel', 'wordpress-popup' ); ?>
				</button>

				<button
					id="hustle-delete-final-button"
					class="sui-button sui-button-ghost sui-button-red"
					data-nonce="01020202"
				>
				<span class="sui-loading-text"><?php esc_html_e( 'Continue', 'wordpress-popup' ); ?></span>
				</button>

			</div>

		</div>

	</div>

</div>
