<?php
if ( isset( $smallcaps_singular ) ) {
	$smallcaps_singular = $smallcaps_singular;
} else {
	$smallcaps_singular = esc_html__( 'module', Opt_In::TEXT_DOMAIN );
}

$integrations_url = add_query_arg( 'page', Hustle_Module_Admin::INTEGRATIONS_PAGE, 'admin.php' );
?>

<div id="hustle-box-section-integrations" class="sui-box" <?php if ( 'integrations' !== $section ) echo 'style="display: none;"'; ?> data-tab="integrations">

	<div class="sui-box-header">

		<h2 class="sui-box-title"><?php esc_html_e( 'Integrations', Opt_In::TEXT_DOMAIN ); ?></h2>

	</div>

	<div class="sui-box-body">

		<div class="sui-box-settings-row">

			<div class="sui-box-settings-col-1">

				<span class="sui-settings-label"><?php esc_html_e( 'Applications', Opt_In::TEXT_DOMAIN ); ?></span>

				<span class="sui-description"><?php printf( esc_html__( 'Send this %1$s’s data to a third party applications. Connect to more 3rd party applications via the %2$sIntegrations%3$s page.', Opt_In::TEXT_DOMAIN ), esc_html( $smallcaps_singular ), '<a href="' . esc_url( $integrations_url ) . '">', '</a>' ); ?></span>

			</div>

			<div class="sui-box-settings-col-2">

				<div class="sui-form-field">

					<label class="sui-label"><?php esc_html_e( 'Active apps', Opt_In::TEXT_DOMAIN ); ?></label>

					<div id="hustle-connected-providers-section">

						<div class="hustle-integrations-display"></div>

					</div>

				</div>

				<div class="sui-form-field">

					<label class="sui-label"><?php esc_html_e( 'Connected apps', Opt_In::TEXT_DOMAIN ); ?></label>

					<div id="hustle-not-connected-providers-section">

						<div class="hustle-integrations-display"></div>

					</div>

				</div>

			</div>

		</div>

		<div class="sui-box-settings-row">

			<div class="sui-box-settings-col-1">

				<span class="sui-settings-label"><?php esc_html_e( 'Integrations Behavior', Opt_In::TEXT_DOMAIN ); ?></span>

				<span class="sui-description"><?php esc_html_e( 'Have more control over the integrations behavior of your active apps as per your liking.', Opt_In::TEXT_DOMAIN ); ?></span>

			</div>

			<div class="sui-box-settings-col-2">

				<label for="hustle-integrations-allow-subscribed-users" class="sui-toggle">

					<input
						type="checkbox"
						id="hustle-integrations-allow-subscribed-users"
						data-attribute="allow_subscribed_users"
						<?php checked( $settings['allow_subscribed_users'], '1' ); ?>
					/>

					<span class="sui-toggle-slider"></span>

				</label>

				<label for="hustle-integrations-allow-subscribed-users"><?php esc_html_e( 'Allow already subscribed user to submit the form', Opt_In::TEXT_DOMAIN ); ?></label>

				<span class="sui-description sui-toggle-description"><?php esc_html_e( 'Choose whether you want to submit the form and subscribe the user to the rest of the active apps when the user is already subscribed to one of the active apps or want the form submission to fail.', Opt_In::TEXT_DOMAIN ); ?></span>
				<input
					type="hidden"
					id="hustle-integrations-active-integrations"
					data-attribute="active_integrations"
					name="active_integrations"
					value="<?php echo esc_html( $settings['active_integrations'] ); ?>"
				/>
			</div>

		</div>

	</div>

	<div class="sui-box-footer">

		<button class="sui-button wpmudev-button-navigation"
			data-direction="prev">
			<i class="sui-icon-arrow-left" aria-hidden="true"></i> <?php esc_html_e( 'Emails', Opt_In::TEXT_DOMAIN ); ?>
		</button>

		<div class="sui-actions-right">
			<button class="sui-button sui-button-icon-right wpmudev-button-navigation"
				data-direction="next">
				<?php esc_html_e( 'Appearance', Opt_In::TEXT_DOMAIN ); ?> <i class="sui-icon-arrow-right" aria-hidden="true"></i>
			</button>
		</div>

	</div>

</div>
