<?php
$extra_class = ' sui-hidden-important';
$inline_styles = '';

if ( $is_enabled ) {
	$extra_class = '';

	if (
		'floating' === $key &&
		(
			empty( $display_settings['inline_enabled'] ) &&
			empty( $display_settings['widget_enabled'] ) &&
			empty( $display_settings['shortcode_enabled'] )
		)
	) {
		$inline_styles .= ' style="';
			$inline_styles .= 'margin-bottom: 0;';
			$inline_styles .= 'padding-bottom: 0;';
			$inline_styles .= 'border-bottom-width: 0;';
		$inline_styles .= '"';
	}
} ?>

<div id="hustle-appearance-<?php echo esc_attr( $key ); ?>-icons-row" class="sui-box-settings-row<?php echo $is_enabled ? '' : ' sui-hidden-important'; ?>"<?php echo $inline_styles; // phpcs:ignore ?>>

	<div class="sui-box-settings-col-1">

		<span class="sui-settings-label"><?php echo esc_html( $label ); ?></span>
		<span class="sui-description"><?php echo esc_html( $description ); ?></span>

		<?php if ( isset( $preview ) && 'sidenav' === $preview ) { ?>

			<div class="sui-form-field">

				<label class="sui-label"><?php esc_html_e( 'Preview module', Opt_In::TEXT_DOMAIN ); ?></label>

				<div class="hui-preview-social" id="hui-preview-social-shares-floating"></div>

			</div>

		<?php } ?>

	</div>

	<div class="sui-box-settings-col-2">

		<?php
		// SETTINGS: Colors Scheme ?>
		<div class="sui-form-field">

			<label class="sui-settings-label"><?php esc_html_e( 'Customize color scheme', Opt_In::TEXT_DOMAIN ); ?></label>

			<span class="sui-description"><?php esc_html_e( 'Adjust the default color scheme of your social bar to match your theme styling.', Opt_In::TEXT_DOMAIN ); ?></span>

			<div class="sui-accordion" style="margin-top: 10px;">

				<?php
				// COLORS: Social Icons ?>
				<div class="sui-accordion-item">

					<div class="sui-accordion-item-header">

						<div class="sui-accordion-item-title">
							<?php esc_html_e( 'Social Icons', Opt_In::TEXT_DOMAIN ); ?>
							<button
								class="sui-button-icon sui-accordion-open-indicator"
								aria-label="<?php esc_html_e( 'Open counter color options', Opt_In::TEXT_DOMAIN ); ?>"
							>
								<i class="sui-icon-chevron-down" aria-hidden="true"></i>
							</button>
						</div>

					</div>

					<div class="sui-accordion-item-body">

						<div class="sui-box">

							<div class="sui-box-body">

								<label class="sui-label"><?php esc_html_e( 'Colors', Opt_In::TEXT_DOMAIN ); ?></label>

								<div class="sui-side-tabs">

									<div class="sui-tabs-menu">

										<label
											for="hustle-<?php echo esc_html( $key ); ?>--default-colors"
											class="sui-tab-item {{ '0' === eval( '<?php echo esc_html( $key ); ?>' +  '_customize_colors' ) ? 'active' : '' }}"
										>
											<input
												type="radio"
												value="0"
												name="hustle-<?php echo esc_html( $key ); ?>--colors"
												id="hustle-<?php echo esc_html( $key ); ?>--default-colors"
												data-attribute="<?php echo esc_html( $key ); ?>_customize_colors"
											/>
											<?php esc_html_e( 'Use default colors', Opt_In::TEXT_DOMAIN ); ?>
										</label>

										<label
											for="hustle-<?php echo esc_html( $key ); ?>--custom-colors"
											class="sui-tab-item {{ '1' === eval( '<?php echo esc_html( $key ); ?>' +  '_customize_colors' ) ? 'active' : '' }}"
										>
											<input
												type="radio"
												value="1"
												name="hustle-<?php echo esc_html( $key ); ?>--colors"
												id="hustle-<?php echo esc_html( $key ); ?>--custom-colors"
												data-attribute="<?php echo esc_html( $key ); ?>_customize_colors"
												data-tab-menu="hustle-<?php echo esc_html( $key ); ?>--custom-palette"
											/>
											<?php esc_html_e( 'Custom', Opt_In::TEXT_DOMAIN ); ?>
										</label>

									</div>

									<div class="sui-tabs-content sui-tabs-content-lg">

										<div
											class="sui-tab-content {{ '1' === eval( '<?php echo esc_html( $key ); ?>' +  '_customize_colors' ) ? 'active' : 'sui-hidden' }}"
											data-tab-content="hustle-<?php echo esc_html( $key ); ?>--custom-palette"
										>

											<div class="sui-form-field">

												<label class="sui-label"><?php esc_html_e( 'Icon background', Opt_In::TEXT_DOMAIN ); ?></label>

												<?php Opt_In_Utils::sui_colorpicker( $key . '_icon_bg_color', $key . '_icon_bg_color', 'true' ); ?>

											</div>

											<div class="sui-form-field">

												<label class="sui-label"><?php esc_html_e( 'Icon color', Opt_In::TEXT_DOMAIN ); ?></label>

												<?php Opt_In_Utils::sui_colorpicker( $key . '_icon_color', $key . '_icon_color', 'true' ); ?>

											</div>

										</div>

									</div>

								</div>

							</div>

						</div>

					</div>

				</div>

				<?php
				// COLORS: Counter ?>
				<div class="sui-accordion-item">

					<div class="sui-accordion-item-header">
						<div class="sui-accordion-item-title">
							<?php esc_html_e( 'Counter', Opt_In::TEXT_DOMAIN ); ?>
							<button
								class="sui-button-icon sui-accordion-open-indicator"
								aria-label="<?php esc_html_e( 'Open counter color options', Opt_In::TEXT_DOMAIN ); ?>"
							>
								<i class="sui-icon-chevron-down" aria-hidden="true"></i>
							</button>
						</div>
					</div>

					<div class="sui-accordion-item-body">

						<div class="sui-box">

							<div class="sui-box-body">

								<div class="sui-form-field">

									<label class="sui-label"><?php esc_html_e( 'Text', Opt_In::TEXT_DOMAIN ); ?></label>

									<?php Opt_In_Utils::sui_colorpicker( $key . '_counter_color', $key . '_counter_color', 'true' ); ?>

								</div>

								<div class="sui-form-field">

									<label class="sui-label"><?php esc_html_e( 'Border', Opt_In::TEXT_DOMAIN ); ?></label>

									<?php Opt_In_Utils::sui_colorpicker( $key . '_counter_border', $key . '_counter_border', 'true' ); ?>

								</div>

							</div>

						</div>

					</div>

				</div>

				<?php
				// COLORS: Container ?>
				<div class="sui-accordion-item">

					<div class="sui-accordion-item-header">
						<div class="sui-accordion-item-title">
							<?php esc_html_e( 'Container', Opt_In::TEXT_DOMAIN ); ?>
							<button
								class="sui-button-icon sui-accordion-open-indicator"
								aria-label="<?php esc_html_e( 'Open container color options', Opt_In::TEXT_DOMAIN ); ?>"
							>
								<i class="sui-icon-chevron-down" aria-hidden="true"></i>
							</button>
						</div>
					</div>

					<div class="sui-accordion-item-body">

						<div class="sui-box">

							<div class="sui-box-body">

								<div class="sui-form-field">

									<label class="sui-label"><?php esc_html_e( 'Background color', Opt_In::TEXT_DOMAIN ); ?></label>

									<?php Opt_In_Utils::sui_colorpicker( $key . '_bg_color', $key . '_bg_color', 'true' ); ?>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

		<?php
		// SETTINGS: Drop Shadow ?>
		<div class="sui-form-field">

			<label for="hustle-icons--<?php echo esc_html( $key ); ?>-shadow" class="sui-toggle">
				<input
					type="checkbox"
					name="<?php echo esc_html( $key ); ?>_drop_shadow"
					data-attribute="<?php echo esc_html( $key ); ?>_drop_shadow"
					id="hustle-icons--<?php echo esc_html( $key ); ?>-shadow"
					{{ _.checked( ( _.isTrue( eval( '<?php echo esc_html( $key ); ?>' +  '_drop_shadow' ) ) ), true) }}
				/>
				<span class="sui-toggle-slider"></span>
			</label>

			<label for="hustle-icons--<?php echo esc_html( $key ); ?>-shadow"><?php esc_html_e( 'Drop shadow', Opt_In::TEXT_DOMAIN ); ?></label>

			<span class="sui-description sui-toggle-description"><?php esc_html_e( 'Add a shadow to the container.', Opt_In::TEXT_DOMAIN ); ?></span>

			<div id="hustle-<?php echo esc_html( $key ); ?>-shadow-toggle-wrapper" class="sui-border-frame sui-toggle-content{{ ( _.isTrue( eval( '<?php echo esc_html( $key ); ?>' +  '_drop_shadow' ) ) ) ? '' : ' sui-hidden' }}">

				<div class="sui-row">

					<div class="sui-col-md-3">

						<div class="sui-form-field">

							<label for="hustle-<?php echo esc_html( $key ); ?>-shadow--x-offset" class="sui-label"><?php esc_html_e( 'X-offset', Opt_In::TEXT_DOMAIN ); ?></label>

							<input
								type="number"
								name="<?php echo esc_html( $key ); ?>_drop_shadow_x"
								data-attribute="<?php echo esc_html( $key ); ?>_drop_shadow_x"
								value="{{ eval( '<?php echo esc_html( $key ); ?>' +  '_drop_shadow_x' ) }}"
								placeholder="0"
								id="hustle-<?php echo esc_html( $key ); ?>-shadow--x-offset"
								class="sui-form-control"
							/>

						</div>

					</div>

					<div class="sui-col-md-3">

						<div class="sui-form-field">

							<label for="hustle-<?php echo esc_html( $key ); ?>-shadow--y-offset" class="sui-label"><?php esc_html_e( 'Y-offset', Opt_In::TEXT_DOMAIN ); ?></label>

							<input
								type="number"
								name="<?php echo esc_html( $key ); ?>_drop_shadow_y"
								data-attribute="<?php echo esc_html( $key ); ?>_drop_shadow_y"
								value="{{ eval( '<?php echo esc_html( $key ); ?>' +  '_drop_shadow_y' ) }}"
								placeholder="0"
								id="hustle-<?php echo esc_html( $key ); ?>-shadow--y-offset"
								class="sui-form-control"
							/>

						</div>

					</div>

					<div class="sui-col-md-3">

						<div class="sui-form-field">

							<label for="hustle-<?php echo esc_html( $key ); ?>-shadow--blur" class="sui-label"><?php esc_html_e( 'Blur', Opt_In::TEXT_DOMAIN ); ?></label>

							<input
								type="number"
								name="<?php echo esc_html( $key ); ?>_drop_shadow_blur"
								data-attribute="<?php echo esc_html( $key ); ?>_drop_shadow_blur"
								value="{{ eval( '<?php echo esc_html( $key ); ?>' +  '_drop_shadow_blur' ) }}"
								placeholder="0"
								id="hustle-<?php echo esc_html( $key ); ?>-shadow--blur"
								class="sui-form-control"
							/>

						</div>

					</div>

					<div class="sui-col-md-3">

						<div class="sui-form-field">

							<label for="hustle-<?php echo esc_html( $key ); ?>-shadow--spread" class="sui-label"><?php esc_html_e( 'Spread', Opt_In::TEXT_DOMAIN ); ?></label>

							<input
								type="number"
								name="<?php echo esc_html( $key ); ?>_drop_shadow_spread"
								data-attribute="<?php echo esc_html( $key ); ?>_drop_shadow_spread"
								value="{{ eval( '<?php echo esc_html( $key ); ?>' +  '_drop_shadow_spread' ) }}"
								placeholder="0"
								id="hustle-<?php echo esc_html( $key ); ?>-shadow--spread"
								class="sui-form-control"
							/>

						</div>

					</div>

				</div>

				<div class="sui-row">

					<div class="sui-col">

						<div class="sui-form-field">

							<label class="sui-label"><?php esc_html_e( 'Color', Opt_In::TEXT_DOMAIN ); ?></label>

							<?php Opt_In_Utils::sui_colorpicker( $key . '_drop_shadow_color', $key . '_drop_shadow_color', 'true' ); ?>

						</div>

					</div>

				</div>

			</div>

		</div>

		<?php
		// SETTINGS: Inline Counter ?>
		<div class="sui-form-field">

			<label for="hustle-icons--<?php echo esc_html( $key ); ?>-inline-counter" class="sui-toggle">
				<input
					type="checkbox"
					name="<?php echo esc_html( $key ); ?>_inline_count"
					data-attribute="<?php echo esc_html( $key ); ?>_inline_count"
					id="hustle-icons--<?php echo esc_html( $key ); ?>-inline-counter"
					{{ _.checked( ( _.isTrue( eval( '<?php echo esc_html( $key ); ?>' +  '_inline_count' ) ) ), true) }}
				/>
				<span class="sui-toggle-slider"></span>
			</label>

			<label for="hustle-icons--<?php echo esc_html( $key ); ?>-inline-counter"><?php esc_html_e( 'Inline counter', Opt_In::TEXT_DOMAIN ); ?></label>

			<span class="sui-description sui-toggle-description"><?php esc_html_e( 'Enable this to make the counter text inline to the icon.', Opt_In::TEXT_DOMAIN ); ?></span>

		</div>

		<?php
		// SETTINGS: Animate Icons ?>
		<div class="sui-form-field">

			<label for="hustle-icons--<?php echo esc_html( $key ); ?>-animate" class="sui-toggle">
				<input
					type="checkbox"
					name="<?php echo esc_html( $key ); ?>_animate_icons"
					data-attribute="<?php echo esc_html( $key ); ?>_animate_icons"
					id="hustle-icons--<?php echo esc_html( $key ); ?>-animate"
					{{ _.checked( ( _.isTrue( eval( '<?php echo esc_html( $key ); ?>' +  '_animate_icons' ) ) ), true) }}
				/>
				<span class="sui-toggle-slider"></span>
			</label>

			<label for="hustle-icons--<?php echo esc_html( $key ); ?>-animate"><?php esc_html_e( 'Animate icons', Opt_In::TEXT_DOMAIN ); ?></label>

			<span class="sui-description sui-toggle-description"><?php esc_html_e( 'Animate the icons when visitor hovers over them.', Opt_In::TEXT_DOMAIN ); ?></span>

		</div>

		<?php if ( isset( $preview ) && 'content' === $preview ) { ?>

			<div class="sui-form-field">

				<label class="sui-label"><?php esc_html_e( 'Preview module', Opt_In::TEXT_DOMAIN ); ?></label>

				<div class="hui-preview-social" id="hui-preview-social-shares-widget"></div>

			</div>

		<?php } ?>

	</div>

</div>
