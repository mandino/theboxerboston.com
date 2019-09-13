<?php $accessibility_color = ! empty( $settings['accessibility_color'] ); ?>
<div id="accessibility-box" class="sui-box" data-tab="accessibility" <?php if ( 'accessibility' !== $section ) echo 'style="display: none;"'; ?>>

	<div class="sui-box-header">
		<h2 class="sui-box-title"><?php esc_html_e( 'Accessibility', 'wordpress-popup' ); ?></h2>
	</div>

	<div class="sui-box-body">

		<div class="sui-box-settings-row">

			<div class="sui-box-settings-col-2">

				<p><?php esc_html_e( 'Enable support for any accessibility enhancements available in the plugin interface.', 'wordpress-popup' ); ?></p>

			</div>

		</div>

		<div class="sui-box-settings-row">

			<div class="sui-box-settings-col-1">
				<span class="sui-settings-label"><?php esc_html_e( 'High Contrast Mode', 'wordpress-popup' ); ?></span>
				<span class="sui-description"><?php esc_html_e( 'Increase the visibility and accessibility of the elements and components of the plugin to meet WCAG AAA requirements.', 'wordpress-popup' ); ?></span>
			</div>

			<div class="sui-box-settings-col-2">

				<label for="hustle-accessibility-color" class="sui-toggle">
					<input
						type="checkbox"
						value="1"
						name="hustle-accessibility-color"
						id="hustle-accessibility-color"
						data-attribute="accessibility_color"
						<?php checked( $accessibility_color ); ?>
					>
					<span class="sui-toggle-slider"></span>
				</label>

				<label for="hustle-accessibility-color"><?php esc_html_e( 'Enable high contrast mode', 'wordpress-popup' ); ?></label>

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
