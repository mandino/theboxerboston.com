<?php
$slide_one_1x = self::$plugin_url . 'assets/images/onboard-welcome.png';
$slide_one_2x = self::$plugin_url . 'assets/images/onboard-welcome@2x.png';

$slide_two_1x = self::$plugin_url . 'assets/images/onboard-migrate.png';
$slide_two_2x = self::$plugin_url . 'assets/images/onboard-migrate@2x.png';

$slide_three_1x = self::$plugin_url . 'assets/images/onboard-create.png';
$slide_three_2x = self::$plugin_url . 'assets/images/onboard-create@2x.png';

$is_first_time_opening = empty( $_GET['show-migrate'] );
$support_link = 'https://premium.wpmudev.org/get-support/';

if ( Opt_In_Utils::_is_free() ) {
	$support_link = 'https://wordpress.org/support/plugin/wordpress-popup/';
}
?>

<div
	id="hustle-dialog--migrate"
	class="sui-dialog sui-dialog-onboard"
	aria-hidden="true"
	tabindex="-1"
	data-nonce="<?php echo esc_attr( wp_create_nonce( 'hustle_dismiss_notification' ) ); ?>"
>

	<div class="sui-dialog-overlay sui-fade-out"></div>

	<div
		class="sui-dialog-content sui-bounce-out"
		aria-labelledby="dialogTitle"
		aria-describedby="dialogDescription"
		role="dialog"
	>

		<div class="sui-slider">

			<ul class="sui-slider-content" role="document">

				<?php
				// SLIDE 1: Welcome ?>
				<li <?php if ( $is_first_time_opening ) echo 'class="sui-current sui-loaded" '; ?>data-slide="1">

					<div class="sui-box">

						<div class="sui-box-banner" role="banner" aria-hidden="true">
							<?php echo Opt_In_Utils::render_image_markup( esc_url( $slide_one_1x ), esc_url( $slide_one_2x ), 'sui-image sui-image-center' ); // WPCS: XSS ok. ?>
						</div>

						<div class="sui-box-header sui-lg sui-block-content-center">

							<h2 id="dialogTitle" class="sui-box-title"><?php printf( esc_html__( 'Hey, %s', 'wordpress-popup' ), esc_html( $username ) ); ?></h2>

							<span id="dialogDescription" class="sui-description"><?php esc_html_e( "Welcome to Hustle, the only plugin you'll ever need to turn your visitors into loyal subscribers, leads and customers.", 'wordpress-popup' ); ?></span>

						</div>

						<div class="sui-box-body sui-lg sui-block-content-center">

							<button class="sui-button sui-button-blue sui-button-icon-right" data-a11y-dialog-tour-next>
								<?php esc_html_e( 'Get Started', 'wordpress-popup' ); ?>
								<i class="sui-icon-chevron-right" aria-hidden="true"></i>
							</button>

						</div>

					</div>

				</li>

				<?php
				// SLIDE 2: Migrate ?>
				<li <?php if ( ! $is_first_time_opening ) echo 'class="sui-current sui-loaded" '; ?>data-slide="2">

					<div class="sui-box">

						<div class="sui-box-banner" role="banner" aria-hidden="true">
							<?php echo Opt_In_Utils::render_image_markup( esc_url( $slide_two_1x ), esc_url( $slide_two_2x ), 'sui-image sui-image-center' ); // WPCS: XSS ok. ?>
						</div>

						<div class="sui-box-header sui-lg sui-block-content-center">

							<h2
								id="dialogTitle"
								class="sui-box-title"
								data-done-text="<?php esc_html_e( 'Migration complete', 'wordpress-popup' ); ?>"
							>
								<?php esc_html_e( 'Migrate Data', 'wordpress-popup' ); ?>
							</h2>

							<span
								id="dialogDescription"
								class="sui-description"
								data-default-text="<?php esc_html_e( 'Nice work on updating the Hustle! All your modules are already in place. However, You need to migrate the data of your existing modules such as tracking data and email list manually.', 'wordpress-popup' ); ?>"
								data-migrate-text="<?php esc_html_e( 'Data migration is in progress. It can take anywhere from a few seconds to a couple of hours depending upon the data of your existing modules and traffic on your site.', 'wordpress-popup' ); ?>"
								data-done-text="<?php esc_html_e( "We've successfully migrated your existing data. You're good to continue using Hustle!", 'wordpress-popup' ); ?>"
							><?php esc_html_e( 'Nice work on updating the Hustle! All your modules are already in place. However, You need to migrate the data of your existing modules such as tracking data and email list manually.', 'wordpress-popup' ); ?></span>

						</div>

						<div class="sui-box-body sui-block-content-center sui-lg sui-last" data-migrate-start>

							<button
								id="hustle-migrate-start"
								class="sui-button sui-button-icon-right"
								data-nonce="<?php echo esc_attr( wp_create_nonce( 'hustle-migrate-tracking-and-subscriptions' ) ); ?>"
							>
								<span class="sui-loading-text">
									<?php esc_html_e( 'Begin Migration', 'wordpress-popup' ); ?>
									<i class="sui-icon-chevron-right" aria-hidden="true"></i>
								</span>
								<i class="sui-icon-loader sui-loading"></i>
							</button>

						</div>

						<div class="sui-box-body sui-block-content-center sui-lg sui-last sui-hidden" data-migrate-progress>

							<div class="sui-progress-block">

								<div class="sui-progress">

									<span class="sui-progress-icon" aria-hidden="true">
										<i class="sui-icon-loader sui-loading"></i>
									</span>

									<span class="sui-progress-text">
										<span>0%</span>
									</span>

									<div class="sui-progress-bar" aria-hidden="true">
										<span style="width: 0%"></span>
									</div>

								</div>

							</div>

							<div class="sui-progress-state">
								<span><?php printf( esc_html__( 'Rows migrated: %1$s%3$s/%2$s%3$s' ), '<span id="hustle-partial-rows" style="display: inline;">', '<span id="hustle-total-rows" style="display: inline;">', '</span>' ); ?></span>
							</div>

						</div>

						<div class="sui-box-body sui-block-content-center sui-lg sui-last sui-hidden" data-migrate-failed>

							<div class="sui-notice sui-notice-error">
								<p><?php printf( esc_html__( 'There was an error while migrating your data. Please retry again or contact our %1$ssupport%2$s team for help.', 'wordpress-popup' ), '<a href="' . esc_url( $support_link ) . '" target="_blank">', '</a>' ); ?></p>
							</div>

							<button
								id="hustle-migrate-start"
								class="sui-button sui-button-icon-right"
								data-nonce="<?php echo esc_attr( wp_create_nonce( 'hustle-migrate-tracking-and-subscriptions' ) ); ?>"
							>
								<span class="sui-loading-text">
									<?php esc_html_e( 'Retry Migration', 'wordpress-popup' ); ?>
								</span>
								<i class="sui-icon-loader sui-loading"></i>
							</button>
							
							<span class="sui-description" style="margin: 10px 0 0;"><?php esc_html_e( 'The migration will continue from where it failed in the last attempt.', 'wordpress-popup' ); ?></span>

						</div>

						<div class="sui-box-body sui-block-content-center sui-lg sui-last sui-hidden" data-migrate-done>

							<button class="sui-button" data-a11y-dialog-tour-next>
								<?php esc_html_e( 'Continue', 'wordpress-popup' ); ?>
							</button>

						</div>

					</div>

					<p class="sui-onboard-skip"><a href="#" data-a11y-dialog-hide="hustle-dialog--migrate"><?php esc_html_e( "Skip this, I'll migrate data later", 'wordpress-popup' ); ?></a></p>

				</li>

				<?php
				// SLIDE 3: Create ?>
				<li data-slide="3">

					<div class="sui-box">

						<div class="sui-box-banner" role="banner" aria-hidden="true">
							<?php echo Opt_In_Utils::render_image_markup( esc_url( $slide_three_1x ), esc_url( $slide_three_2x ), 'sui-image sui-image-center' ); // WPCS: XSS ok. ?>
						</div>

						<div class="sui-box-header sui-lg sui-block-content-center">

							<h2 id="dialogTitle" class="sui-box-title"><?php esc_html_e( 'Create Module', 'wordpress-popup' ); ?></h2>

							<span id="dialogDescription" class="sui-description"><?php esc_html_e( 'Choose a module to get started on converting your visitors into subscribers, generate more leads and grow your social following.', 'wordpress-popup' ); ?></span>

							<button class="sui-dialog-close" data-a11y-dialog-hide="hustle-dialog--welcome">
								<span class="sui-screen-reader-text"><?php esc_html_e( 'Close this dialog window', 'wordpress-popup' ); ?></span>
							</button>

						</div>

						<div class="sui-box-selectors sui-box-selectors-col-2">

							<ul>

								<li><label for="hustle-new-popup" class="sui-box-selector">
									<input type="radio" name="hustle-create-new" id="hustle-new-popup" value="<?php echo esc_attr( Hustle_Module_Model::POPUP_MODULE ); ?>" />
									<span>
										<i class="sui-icon-popup" aria-hidden="true"></i>
										<?php esc_html_e( 'Pop-up', 'wordpress-popup' ); ?>
									</span>
								</label></li>

								<li><label for="hustle-new-slidein" class="sui-box-selector">
									<input type="radio" name="hustle-create-new" id="hustle-new-slidein" value="<?php echo esc_attr( Hustle_Module_Model::SLIDEIN_MODULE ); ?>" />
									<span>
										<i class="sui-icon-slide-in" aria-hidden="true"></i>
										<?php esc_html_e( 'Slide-in', 'wordpress-popup' ); ?>
									</span>
								</label></li>

								<li><label for="hustle-new-embed" class="sui-box-selector">
									<input type="radio" name="hustle-create-new" id="hustle-new-embed" value="<?php echo esc_attr( Hustle_Module_Model::EMBEDDED_MODULE ); ?>" />
									<span>
										<i class="sui-icon-embed" aria-hidden="true"></i>
										<?php esc_html_e( 'Embed', 'wordpress-popup' ); ?>
									</span>
								</label></li>

								<li><label for="hustle-new-sshare" class="sui-box-selector">
									<input type="radio" name="hustle-create-new" id="hustle-new-sshare" value="<?php echo esc_attr( Hustle_Module_Model::SOCIAL_SHARING_MODULE ); ?>" />
									<span>
										<i class="sui-icon-share" aria-hidden="true"></i>
										<?php esc_html_e( 'Social Share', 'wordpress-popup' ); ?>
									</span>
								</label></li>

							</ul>

						</div>

						<div class="sui-box-body sui-block-content-center sui-lg">

							<button
								id="hustle-create-new-module"
								class="sui-button sui-button-blue sui-button-icon-right"
								disabled="disabled"
							>
								<span class="sui-loading-text"><?php esc_html_e( 'Create', 'wordpress-popup' ); ?></span>
								<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
							</button>

						</div>

					</div>

					<p class="sui-onboard-skip"><a href="#" data-a11y-dialog-hide="hustle-dialog--migrate"><?php esc_html_e( 'Skip this, I will create a module later', 'wordpress-popup' ); ?></a></p>

				</li>

			</ul>

		</div>

	</div>

</div>
