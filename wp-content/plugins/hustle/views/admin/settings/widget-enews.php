<?php
/**
 */
?>

<?php
$content_hide = false;
?>

<div id="wpmudev-settings-widget-enews" class="wpmudev-box wpmudev-box-close">

	<div class="wpmudev-box-head">

        <h2><?php _e( "e-Newsletter Integration", Opt_In::TEXT_DOMAIN ); ?></h2>

        <div class="wpmudev-box-action"><?php $this->render("general/icons/icon-minus" ); ?></div>

	</div>

	<div class="wpmudev-box-body<?php if ($content_hide === true) { echo ' wpmudev-hidden'; } ?>">

		<p><?php _e('Set up email list syncing with e-Newsletter plugin.', Opt_In::TEXT_DOMAIN); ?></p>

		<table cellspacing="0" cellpadding="0" class="wpmudev-table">

			<thead>

				<tr>

					<th><?php _e( "Module Name", Opt_In::TEXT_DOMAIN ); ?></th>

					<th class="wpmudev-enews-sync"><?php _e( "Synchronize", Opt_In::TEXT_DOMAIN ); ?></th>

					<th><?php _e( "Double Opt-In", Opt_In::TEXT_DOMAIN ); ?></th>

				</tr>

			</thead>

            <tbody>

                <?php foreach( $modules as $module ) : ?>

					<?php $has_email_collection = $module->content->use_email_collection === '1' ? true : false;

					//only modules with active email collections can be synced with e-Newsletter
					if ( !$has_email_collection || $module->module_type === "social_sharing" ) {
						continue;
					}?>

					<?php if ( is_null( $module->get_sync_with_e_newsletter() ) && $this->get_e_newsletter()->get_groups() !== array() ) : ?>

						<tr>

							<td>

								<div class="wpmudev-settings-module-name">

									<?php if ( $module->module_type === "popup" ) { $tooltip = __( "Pop-up", Opt_In::TEXT_DOMAIN ); }

									else if ( $module->module_type === "slidein" ) { $tooltip = __( "Slide-in", Opt_In::TEXT_DOMAIN ); }

									else if ( $module->module_type === "embedded" ) { $tooltip = __( "Embed", Opt_In::TEXT_DOMAIN ); } ?>

									<div class="wpmudev-module-icon wpmudev-tip" data-tip="<?php echo $tooltip; ?>">

										<?php if ( $module->module_type === "popup" ) { ?>

											<?php $this->render("general/icons/admin-icons/icon-popup" ); ?>

										<?php } ?>

										<?php if ( $module->module_type === "slidein" ) { ?>

											<?php $this->render("general/icons/admin-icons/icon-slidein" ); ?>

										<?php } ?>

										<?php if ( $module->module_type === "embedded" ) { ?>

											<?php $this->render("general/icons/admin-icons/icon-shortcode" ); ?>

										<?php } ?>

									</div>

									<div class="wpmudev-module-name"><?php echo $module->module_name ?></div>

								</div>

							</td>

							<td class="wpmudev-enews-sync" data-title="<?php _e( "Synchronize", Opt_In::TEXT_DOMAIN ); ?>"><a href="/" class="wpmudev-button wpmudev-button-sm wpmudev-button-ghost optin-enews-sync-setup" data-nonce="<?php echo $enews_sync_setup_nonce; ?>" data-id="<?php echo esc_attr( $module->id ) ?>" ><?php _e( "Setup", Opt_In::TEXT_DOMAIN ); ?></a></td>

							<td class="wpmudev-enews-sync" data-title="<?php _e( "Double Opt-In", Opt_In::TEXT_DOMAIN ); ?>">&nbsp;</td>

						</tr>

					<?php else : ?>

						<tr>

							<td>

								<div class="wpmudev-settings-module-name">

									<?php if ( $module->module_type === "popup" ) { $tooltip = __( "Pop-up", Opt_In::TEXT_DOMAIN ); }

									else if ( $module->module_type === "slidein" ) { $tooltip = __( "Slide-in", Opt_In::TEXT_DOMAIN ); }

									else if ( $module->module_type === "embedded" ) { $tooltip = __( "Embed", Opt_In::TEXT_DOMAIN ); } ?>

									<div class="wpmudev-module-icon wpmudev-tip" data-tip="<?php echo $tooltip; ?>">

										<?php if ( $module->module_type === "popup" ) { ?>

											<?php $this->render("general/icons/admin-icons/icon-popup" ); ?>

										<?php } ?>

										<?php if ( $module->module_type === "slidein" ) { ?>

											<?php $this->render("general/icons/admin-icons/icon-slidein" ); ?>

										<?php } ?>

										<?php if ( $module->module_type === "embedded" ) { ?>

											<?php $this->render("general/icons/admin-icons/icon-shortcode" ); ?>

										<?php } ?>

									</div>

									<div class="wpmudev-module-name"><?php echo $module->module_name ?></div>

								</div>

							</td>

							<td class="wpmudev-enews-sync" data-title="<?php _e( "Synchronize", Opt_In::TEXT_DOMAIN ); ?>">

								<div class="wpmudev-switch">

									<input id="optin-enews-sync-state-<?php echo esc_attr( $module->id ) ?>" class="optin-enews-sync-toggle" type="checkbox" data-nonce="<?php echo $enews_sync_state_toggle_nonce; ?>" data-id="<?php echo esc_attr( $module->id ) ?>" <?php checked( true, $module->sync_with_e_newsletter ); ?>>

									<label class="wpmudev-switch-design" for="optin-enews-sync-state-<?php echo esc_attr( $module->id ) ?>" aria-hidden="true"></label>

								</div>

								<?php if ( $this->get_e_newsletter()->get_groups() !== array() ) : ?>

									<a href="/" class="wpmudev-button wpmudev-button-sm optin-enews-sync-edit" data-nonce="<?php echo $enews_sync_setup_nonce; ?>" data-id="<?php echo esc_attr( $module->id ) ?>" ><?php _e( "Edit", Opt_In::TEXT_DOMAIN ); ?></a>

								<?php endif; ?>

							</td>

							<td class="wpmudev-enews-sync" data-title="<?php _e( "Double Opt-In", Opt_In::TEXT_DOMAIN ); ?>">

								<div class="wpmudev-switch">

									<input id="double-optin-enews-state-<?php echo esc_attr( $module->id ) ?>" class="optin-enews-double-optin-toggle" type="checkbox" data-nonce="<?php echo $enews_double_optin_state_toggle_nonce; ?>" data-id="<?php echo esc_attr( $module->id ) ?>" <?php checked( true, $module->sync_with_e_newsletter ? $module->e_newsletter_double_opt_in : false ); disabled( false, (bool) $module->sync_with_e_newsletter ); ?>>

									<label class="wpmudev-switch-design" for="double-optin-enews-state-<?php echo esc_attr( $module->id ) ?>" aria-hidden="true"></label>

								</div>

							</td>

						</tr>

					<?php endif; ?>

                <?php endforeach; ?>

            </tbody>

        </table>

	</div>

</div>