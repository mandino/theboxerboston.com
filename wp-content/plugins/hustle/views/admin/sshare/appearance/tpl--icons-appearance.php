<div id="hustle-appearance-<?php echo esc_attr( $key ); ?>-icons-row" class="sui-box-settings-row" <?php if ( ! $is_enabled ) echo ' style="display: none;"'; ?>>

	<div class="sui-box-settings-col-1">

		<span class="sui-settings-label"><?php echo esc_html( $label ); ?></span>
		<span class="sui-description"><?php echo esc_html( $description ); ?></span>

		<?php if ( isset( $preview ) && 'sidenav' === $preview ) { ?>

			<div class="sui-form-field">

				<label class="sui-label"><?php esc_html_e( 'Preview module', 'wordpress-popup' ); ?></label>

				<div class="hui-preview-social" id="hui-preview-social-shares-floating"></div>

			</div>

		<?php } ?>

	</div>

	<div class="sui-box-settings-col-2">

		<?php
		// SETTINGS: Colors Scheme ?>
		<div class="sui-form-field">

			<label class="sui-settings-label"><?php esc_html_e( 'Customize color scheme', 'wordpress-popup' ); ?></label>

			<span class="sui-description"><?php esc_html_e( 'Adjust the default color scheme of your social bar to match your theme styling.', 'wordpress-popup' ); ?></span>

			<div class="sui-accordion" style="margin-top: 10px;">

				<?php
				// COLORS: Social Icons ?>
				<div class="sui-accordion-item">

					<div class="sui-accordion-item-header">

						<div class="sui-accordion-item-title">
							<?php esc_html_e( 'Social Icons', 'wordpress-popup' ); ?>
							<button
								class="sui-button-icon sui-accordion-open-indicator"
								aria-label="<?php esc_html_e( 'Open counter color options', 'wordpress-popup' ); ?>"
							>
								<i class="sui-icon-chevron-down" aria-hidden="true"></i>
							</button>
						</div>

					</div>

					<div class="sui-accordion-item-body">

						<div class="sui-box">

							<div class="sui-box-body">

								<label class="sui-label"><?php esc_html_e( 'Colors', 'wordpress-popup' ); ?></label>

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
											<?php esc_html_e( 'Use default colors', 'wordpress-popup' ); ?>
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
											<?php esc_html_e( 'Custom', 'wordpress-popup' ); ?>
										</label>

									</div>

									<div class="sui-tabs-content sui-tabs-content-lg">

										<div
											class="sui-tab-content {{ '1' === eval( '<?php echo esc_html( $key ); ?>' +  '_customize_colors' ) ? 'active' : 'sui-hidden' }}"
											data-tab-content="hustle-<?php echo esc_html( $key ); ?>--custom-palette"
										>

											<div id="hustle-<?php echo esc_html( $key ); ?>-icons-custom-background" class="sui-form-field{{ ( 'flat' === icon_style ) ? ' sui-hidden' : '' }}">

												<?php if ( 'outline' === $appearance_settings['icon_style'] ) { ?>
													<label class="sui-label"><?php esc_html_e( 'Icon border', 'wordpress-popup' ); ?></label>
												<?php } else { ?>
													<label class="sui-label"><?php esc_html_e( 'Icon background', 'wordpress-popup' ); ?></label>
												<?php } ?>

												<?php Opt_In_Utils::sui_colorpicker( $key . '_icon_bg_color', $key . '_icon_bg_color', 'true' ); ?>

											</div>

											<div class="sui-form-field">

												<label class="sui-label"><?php esc_html_e( 'Icon color', 'wordpress-popup' ); ?></label>

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
				<div id="hustle-<?php echo esc_html( $key ); ?>-counter-colors" class="sui-accordion-item" <?php if ( '0' === $content_settings['counter_enabled'] ) echo 'style="display:none;"'; ?>>

					<div class="sui-accordion-item-header">
						<div class="sui-accordion-item-title">
							<?php esc_html_e( 'Counter', 'wordpress-popup' ); ?>
							<button
								class="sui-button-icon sui-accordion-open-indicator"
								aria-label="<?php esc_html_e( 'Open counter color options', 'wordpress-popup' ); ?>"
							>
								<i class="sui-icon-chevron-down" aria-hidden="true"></i>
							</button>
						</div>
					</div>

					<div class="sui-accordion-item-body">

						<div class="sui-box">

							<div class="sui-box-body">

								<div id="hustle-<?php echo esc_html( $key ); ?>-counter-border" class="sui-form-field{{ ( 'outline' === icon_style || '0' === eval( '<?php echo esc_html( $key ); ?>' +  '_customize_colors' ) ) ? ' sui-hidden' : '' }}">

									<label class="sui-label"><?php esc_html_e( 'Border', 'wordpress-popup' ); ?></label>

									<?php Opt_In_Utils::sui_colorpicker( $key . '_counter_border', $key . '_counter_border', 'true' ); ?>

								</div>

								<div class="sui-form-field">

									<label class="sui-label"><?php esc_html_e( 'Text', 'wordpress-popup' ); ?></label>

									<?php Opt_In_Utils::sui_colorpicker( $key . '_counter_color', $key . '_counter_color', 'true' ); ?>

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
							<?php esc_html_e( 'Container', 'wordpress-popup' ); ?>
							<button
								class="sui-button-icon sui-accordion-open-indicator"
								aria-label="<?php esc_html_e( 'Open container color options', 'wordpress-popup' ); ?>"
							>
								<i class="sui-icon-chevron-down" aria-hidden="true"></i>
							</button>
						</div>
					</div>

					<div class="sui-accordion-item-body">

						<div class="sui-box">

							<div class="sui-box-body">

								<div class="sui-form-field">

									<label class="sui-label"><?php esc_html_e( 'Background color', 'wordpress-popup' ); ?></label>

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

			<label for="hustle-icons--<?php echo esc_html( $key ); ?>-shadow"><?php esc_html_e( 'Drop shadow', 'wordpress-popup' ); ?></label>

			<span class="sui-description sui-toggle-description"><?php esc_html_e( 'Add a shadow to the container.', 'wordpress-popup' ); ?></span>

			<div id="hustle-<?php echo esc_html( $key ); ?>-shadow-toggle-wrapper" class="sui-border-frame sui-toggle-content{{ ( _.isTrue( eval( '<?php echo esc_html( $key ); ?>' +  '_drop_shadow' ) ) ) ? '' : ' sui-hidden' }}">

				<div class="sui-row">

					<div class="sui-col-md-3">

						<div class="sui-form-field">

							<label for="hustle-<?php echo esc_html( $key ); ?>-shadow--x-offset" class="sui-label"><?php esc_html_e( 'X-offset', 'wordpress-popup' ); ?></label>

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

							<label for="hustle-<?php echo esc_html( $key ); ?>-shadow--y-offset" class="sui-label"><?php esc_html_e( 'Y-offset', 'wordpress-popup' ); ?></label>

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

							<label for="hustle-<?php echo esc_html( $key ); ?>-shadow--blur" class="sui-label"><?php esc_html_e( 'Blur', 'wordpress-popup' ); ?></label>

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

							<label for="hustle-<?php echo esc_html( $key ); ?>-shadow--spread" class="sui-label"><?php esc_html_e( 'Spread', 'wordpress-popup' ); ?></label>

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

							<label class="sui-label"><?php esc_html_e( 'Color', 'wordpress-popup' ); ?></label>

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

			<label for="hustle-icons--<?php echo esc_html( $key ); ?>-inline-counter"><?php esc_html_e( 'Inline counter', 'wordpress-popup' ); ?></label>

			<span class="sui-description sui-toggle-description"><?php esc_html_e( 'Enable this to make the counter text inline to the icon.', 'wordpress-popup' ); ?></span>

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

			<label for="hustle-icons--<?php echo esc_html( $key ); ?>-animate"><?php esc_html_e( 'Animate icons', 'wordpress-popup' ); ?></label>

			<span class="sui-description sui-toggle-description"><?php esc_html_e( 'Animate the icons when visitor hovers over them.', 'wordpress-popup' ); ?></span>

		</div>

		<?php if ( isset( $preview ) && 'content' === $preview ) { ?>

			<div class="sui-form-field">

				<label class="sui-label"><?php esc_html_e( 'Preview module', 'wordpress-popup' ); ?></label>

				<div class="hui-preview-social" id="hui-preview-social-shares-widget"></div>

			</div>

		<?php } ?>

	</div>

</div>

<div id="hustle-appearance-<?php echo esc_attr( $key ); ?>-icons-placeholder" class="sui-box-settings-row"<?php if ( $is_enabled || $is_empty  ) echo ' style="display: none;"'; ?>>

	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label"><?php echo esc_html( $label ); ?></span>
		<span class="sui-description"><?php echo esc_html( $description ); ?></span>
	</div>

	<div class="sui-box-settings-col-2">
		<div class="sui-notice">
			<p><?php echo esc_html( $disabled_message ); ?></p>
		</div>
	</div>

</div>
