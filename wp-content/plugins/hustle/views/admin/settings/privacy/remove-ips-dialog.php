<div class="sui-dialog sui-dialog-sm" aria-hidden="true" tabindex="-1" id="hustle-dialog--delete-ips">
	<div class="sui-dialog-overlay" data-a11y-dialog-hide></div>
	<div class="sui-dialog-content" aria-labelledby="dialogTitle" aria-describedby="dialogDescription" role="dialog">
		<div class="sui-box" role="document">
			<div class="sui-box-header">
				<h3 id="dialogTitle" class="sui-box-title"></h3>
				<div class="sui-actions-right">
					<button class="sui-dialog-close" aria-label="<?php esc_html_e( 'Close dialog', 'wordpress-popup' ); ?>" data-a11y-dialog-hide></button>
				</div>
			</div>
			<div class="sui-box-body">
				<p id="dialogDescription"></p>
			</div>
			<div class="sui-box-footer">
				<button class="sui-button sui-button-ghost" data-a11y-dialog-hide><?php esc_html_e( 'Cancel', 'wordpress-popup' ); ?></button>
				<button
					id="hustle-delete-all-ips"
					class="sui-button sui-button-red sui-button-ghost hustle-delete"
					data-nonce="<?php echo esc_attr( wp_create_nonce( 'hustle_remove_ips' ) ); ?>"
				>
					<span class="sui-loading-text">
						<i class="sui-icon-trash" aria-hidden="true"></i> <?php esc_html_e( 'Delete', 'wordpress-popup' ); ?>
					</span>
					<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
				</button>
			</div>
		</div>
	</div>
</div>
