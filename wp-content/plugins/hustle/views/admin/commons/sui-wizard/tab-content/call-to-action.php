<?php
ob_start();

require self::$plugin_path . 'assets/css/sui-editor.min.css';
$editor_css = ob_get_clean();
$editor_css = '<style>' . $editor_css. '</style>';
?>

<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label"><?php esc_html_e( 'Call to Action', Opt_In::TEXT_DOMAIN ); ?></span>
		<span class="sui-description"><?php printf( esc_html__( 'Add a call to action button on your %s to take your visitors to another webpage on your site or any other site.', Opt_In::TEXT_DOMAIN ), esc_html( $smallcaps_singular ) ); ?></span>
	</div>

	<div class="sui-box-settings-col-2">

		<div class="sui-form-field">

			<label for="hustle-show-cta" class="sui-toggle">
				<input type="checkbox"
					id="hustle-show-cta"
					data-attribute="show_cta"
					{{ _.checked( _.isTrue( show_cta ), true ) }} />
				<span class="sui-toggle-slider" aria-hidden="true"></span>
			</label>

			<label for="hustle-show-cta"><?php esc_html_e( 'Add Call to Action', Opt_In::TEXT_DOMAIN ); ?></label>

			<div id="hustle-show-cta-toggle-wrapper" class="sui-border-frame sui-toggle-content {{ ( _.isFalse( show_cta ) ) ? 'sui-hidden' : '' }}">

				<div class="sui-row">

					<div class="sui-col-md-6">

						<div class="sui-form-field">

							<label for="wph_<?php esc_attr( $module_type ); ?>_new_label" class="sui-label"><?php esc_html_e( 'Button label', Opt_In::TEXT_DOMAIN ); ?></label>
							<input type="text"
								name="wph_<?php echo esc_attr( $module_type ); ?>_new_label"
								value="{{ cta_label }}"
								placeholder="<?php esc_attr_e( 'Vote Now', Opt_In::TEXT_DOMAIN ); ?>"
								id="wph_<?php echo esc_attr( $module_type ); ?>_new_label"
								class="sui-form-control"
								data-attribute="cta_label" />
							<span class="sui-error-message" style="display: none;"><?php esc_html_e( "You can't have a button without text.", Opt_In::TEXT_DOMAIN ); ?></span>

						</div>

					</div>

					<div class="sui-col-md-6">

						<div class="sui-form-field">

							<label class="sui-label"><?php esc_html_e( 'Open link in', Opt_In::TEXT_DOMAIN ); ?></label>

							<div class="sui-side-tabs">

								<div class="sui-tabs-menu">

									<label for="hustle-cta-target-blank" class="sui-tab-item {{ ( 'blank' === cta_target ) ? 'active' : '' }}">
										<input type="radio"
											name="cta_target"
											value="blank"
											data-attribute="cta_target"
											id="hustle-cta-target-blank"
											{{ _.checked( ( 'blank' === cta_target ), true) }} />
										<?php esc_html_e( 'New Tab', Opt_In::TEXT_DOMAIN ); ?>
									</label>

									<label for="hustle-cta-target-self" class="sui-tab-item {{ ( 'self' === cta_target ) ? 'active' : '' }}">
										<input type="radio"
											name="cta_target"
											value="self"
											data-attribute="cta_target"
											id="hustle-cta-target-self"
											{{ _.checked( ( 'self' === cta_target ), true) }} />
										<?php esc_html_e( 'Same Tab', Opt_In::TEXT_DOMAIN ); ?>
									</label>

								</div>

							</div>

						</div>

					</div>

				</div>

				<div class="sui-form-field">

					<label for="wph_<?php echo esc_attr( $module_type ); ?>_new_url" class="sui-label">Redirect URL</label>

					<input type="url"
						name="wph_<?php echo esc_attr( $module_type ); ?>_new_url"
						value="{{ cta_url }}"
						placeholder="<?php esc_attr_e( 'E.g. https://website.com', Opt_In::TEXT_DOMAIN ); ?>"
						id="wph_<?php echo esc_attr( $module_type ); ?>_new_url"
						class="sui-form-control"
						data-attribute="cta_url" />

					<span class="sui-error" style="display: none;"><?php esc_html_e( "That's not a valid URL. Please, try again.", Opt_In::TEXT_DOMAIN); ?></span>

				</div>

			</div>

		</div>

	</div>

</div>
