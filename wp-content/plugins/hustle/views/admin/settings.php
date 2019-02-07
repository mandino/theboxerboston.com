<?php
/**
 * @var Opt_In_Admin $this
 */
?>

<?php if ( count( $modules ) == 0 ) : ?>

	<?php $this->render( "admin/settings/welcome", array( 'user_name' => $user_name ) ); ?>

<?php else : ?>

	<main id="wpmudev-hustle" class="wpmudev-ui wpmudev-hustle-popup-wizard-view">

		<header id="wpmudev-hustle-title">

			<h1><?php _e( "Settings", Opt_In::TEXT_DOMAIN ); ?></h1>

		</header>

		<section id="wpmudev-hustle-content" class="wpmudev-container">

			<div class="wpmudev-row">

				<div id="wpmudev-settings-activity" class="wpmudev-col col-12 col-sm-6">

					<?php $this->render( "admin/settings/widget-modules", array(
						"modules" => $modules,
						"modules_state_toggle_nonce" => $modules_state_toggle_nonce
					) ); ?>

				</div><?php // #wpmudev-settings-activity ?>

				<?php if ( $is_e_newsletter_active ){ ?>

					<div id="wpmudev-settings-enews" class="wpmudev-col col-12 col-sm-6">

						<div id="wpmudev-settings-widget-enews" class="wpmudev-box wpmudev-box-close">

							<?php $this->render( "admin/settings/widget-enews", array(
								"modules" => $modules,
								"enews_sync_state_toggle_nonce" => $enews_sync_state_toggle_nonce,
								"enews_sync_setup_nonce" => $enews_sync_setup_nonce,
								"enews_double_optin_state_toggle_nonce" => $enews_double_optin_state_toggle_nonce
							) ); ?>

							<?php $this->render("admin/settings/widget-enews_sync"); ?>

						</div>

					</div>

				<?php } ?>

			</div><?php // .wpmudev-row ?>

		</section>

		<?php $this->render( "admin/commons/footer", array() ); ?>

	</main>

<?php endif; ?>