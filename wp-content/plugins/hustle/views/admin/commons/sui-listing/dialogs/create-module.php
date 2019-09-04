<?php
$module_steps = 1;
$dialog_class = 'sui-dialog sui-dialog-sm sui-dialog-alt';

$is_social_share = ( Hustle_Module_Model::SOCIAL_SHARING_MODULE === $module_type );

if ( ! $is_social_share ) {
	$module_steps = 2;
	$dialog_class = 'sui-dialog sui-dialog-alt';
}
$hide_branding = apply_filters( 'wpmudev_branding_hide_branding', false );
?><div id="hustle-dialog--add-new-module" class="<?php echo esc_attr( $dialog_class ); ?>" aria-hidden="true" tabindex="-1">

	<div class="sui-dialog-overlay sui-fade-out" data-a11y-dialog-hide="hustle-dialog--add-new-module"></div>

	<div role="dialog"
		class="sui-dialog-content sui-bounce-out"
		aria-labelledby="dialogTitle"
		aria-describedby="dialogDescription">

		<?php
		// STEP: Choose Content Type
		// Select module's mode, either "informational" or "optin"
		if ( ! $is_social_share ) { ?>

			<div role="document"
				id="module-mode-step"
				class="sui-box">

				<div class="sui-box-header sui-block-content-center">

					<h3 id="dialogTitle" class="sui-box-title"><?php esc_html_e( 'Choose Content Type', Opt_In::TEXT_DOMAIN ); ?></h3>

					<button class="sui-dialog-close" data-a11y-dialog-hide="hustle-dialog--add-new-module">
						<span class="sui-screen-reader-text"><?php esc_html_e( 'Close this dialog window', Opt_In::TEXT_DOMAIN ); ?></span>
					</button>

				</div>

				<div class="sui-box-body sui-box-body-slim sui-block-content-center">

					<span class="sui-description"><?php esc_html_e( 'Let’s start by choosing an appropriate content type based on your goal.', Opt_In::TEXT_DOMAIN ); ?></span>

				</div>

				<div class="sui-box-selectors sui-box-selectors-col-2">

					<ul id="hustle-module-types">

						<li><label for="optin" class="sui-box-selector">
							<input type="radio" name="mode" id="optin" value="optin" checked="checked" />
							<span><i class="sui-icon-mail" aria-hidden="true"></i> <?php esc_html_e( 'Email Opt-in', Opt_In::TEXT_DOMAIN ); ?></span>
							<span><?php esc_html_e( 'Perfect for Newsletter signups, or collecting user data in general.', Opt_In::TEXT_DOMAIN ); ?></span>
						</label></li>

						<li><label for="informational" class="sui-box-selector">
							<input type="radio" name="mode" id="informational" value="informational" />
							<span><i class="sui-icon-info" aria-hidden="true"></i> <?php esc_html_e( 'Informational', Opt_In::TEXT_DOMAIN ); ?></span>
							<span><?php esc_html_e( 'Perfect for promotional offers with Call to Action.', Opt_In::TEXT_DOMAIN ); ?></span>
						</label></li>

					</ul>

				</div>

				<div class="sui-box-footer sui-box-footer-right">

					<button id="hustle-select-mode" class="sui-button">
						<span class="sui-loading-text"><?php esc_html_e( 'Next', Opt_In::TEXT_DOMAIN ); ?></span>
						<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
					</button>

				</div>

<?php if ( ! $hide_branding ) { ?>
				<img src="<?php echo esc_url( self::$plugin_url . 'assets/images/hustle-create.png' ); ?>"
					srcset="<?php echo esc_url( self::$plugin_url . 'assets/images/hustle-create.png' ); ?> 1x, <?php echo esc_url( self::$plugin_url . 'assets/images/hustle-create@2x.png' ); ?> 2x"
					alt="<?php printf( esc_html__( 'Create New %s', Opt_In::TEXT_DOMAIN ), esc_html( $capitalize_singular ) ); ?>"
					class="sui-image sui-image-center"
					aria-hidden="true" />
<?php } ?>
			</div>

		<?php } ?>

		<?php
		// STEP: Create Module
		// Give your chosen module a name and create it ?>
		<div role="document"
			id="module-name-step"
			class="sui-box"
			<?php if ( ! $is_social_share ) { echo 'style="display: none;"'; } ?>
			data-nonce="<?php echo esc_attr( wp_create_nonce( 'hustle_create_new_module' ) ); ?>">

			<div class="sui-box-header sui-block-content-center">

				<h3 class="sui-box-title" id="dialogTitle"><?php printf( esc_html__( 'Create %s', Opt_In::TEXT_DOMAIN ), esc_html( $capitalize_singular ) ); ?></h3>

				<button class="sui-dialog-back"<?php if ( $is_social_share ) { echo ' style="display: none;"'; } ?>>
					<span class="sui-screen-reader-text"><?php esc_html_e( 'Choose content type', Opt_In::TEXT_DOMAIN ); ?></span>
				</button>

				<button class="sui-dialog-close" aria-label="<?php esc_html_e( 'Close this dialog window', Opt_In::TEXT_DOMAIN ); ?>" data-a11y-dialog-hide></button>

			</div>

			<div class="sui-box-body sui-box-body-slim sui-block-content-center">

				<span class="sui-description"><?php printf( esc_html__( "Let's give your new %s module a name. What would you like to name it?", Opt_In::TEXT_DOMAIN ), esc_html( $smallcaps_singular ) ); ?></span>

				<div class="sui-form-field">

					<label for="hustle-module-name" class="sui-screen-reader-text"><?php printf( esc_html__( '%s name', Opt_In::TEXT_DOMAIN ), esc_html( $capitalize_singular ) ); ?></label>

					<div class="sui-with-button sui-inside">

						<input type="text"
							name="name"
							autofocus
							placeholder="<?php esc_html_e( 'E.g. Newsletter', Opt_In::TEXT_DOMAIN ); ?>"
							id="hustle-module-name"
							class="sui-form-control sui-required"
						/>

						<button id="hustle-create-module" class="sui-button-icon sui-button-blue sui-button-filled sui-button-lg" disabled>
							<span class="sui-loading-text">
								<i class="sui-icon-arrow-right" aria-hidden="true"></i>
							</span>
							<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
							<span class="sui-screen-reader-text"><?php esc_html_e( 'Done', Opt_In::TEXT_DOMAIN ); ?></span>
						</button>

					</div>

					<span id="error-empty-name" class="sui-error-message" style="display: none;"><?php esc_html_e( 'Please add a name for this module.', Opt_In::TEXT_DOMAIN ); ?></span>

					<span id="error-saving-settings" class="sui-error-message" style="display: none;"><?php esc_html_e( 'Something went wrong saving the settings. Make sure everything is okay.', Opt_In::TEXT_DOMAIN ); ?></span>

					<span class="sui-description"><?php esc_html_e( 'This will not be visible anywhere on your website', Opt_In::TEXT_DOMAIN ); ?></span>

				</div>

			</div>
<?php if ( ! $hide_branding ) { ?>
			<img src="<?php echo esc_url( self::$plugin_url . 'assets/images/hustle-create.png' ); ?>"
				srcset="<?php echo esc_url( self::$plugin_url . 'assets/images/hustle-create.png' ); ?> 1x, <?php echo esc_url( self::$plugin_url . 'assets/images/hustle-create@2x.png' ); ?> 2x"
				alt="<?php printf( esc_html__( 'Create New %s', Opt_In::TEXT_DOMAIN ), esc_html( $capitalize_singular ) ); ?>"
				class="sui-image sui-image-center"
				aria-hidden="true" />
<?php } ?>
		</div>

	</div>

</div>
