<div class="sui-form-field">

	<label for="hustle-settings--<?php echo esc_html( $prefix ); ?>-enable" class="sui-toggle">
		<input
			type="checkbox"
			name="<?php echo esc_html( $prefix ); ?>_enabled"
			data-attribute="<?php echo esc_html( $prefix ); ?>_enabled"
			id="hustle-settings--<?php echo esc_html( $prefix ); ?>-enable"
			{{ _.checked( _.isTrue( eval( '<?php echo esc_html( $prefix ); ?>' +  '_enabled' ) ), true) }}
		/>
		<span class="sui-toggle-slider"></span>
	</label>

	<label for="hustle-settings--<?php echo esc_html( $prefix ); ?>-enable"><?php printf( esc_html__( 'Enable %s', 'wordpress-popup' ), esc_html( $label ) ); ?></label>

	<div id="hustle-<?php echo esc_html( $prefix ); ?>-toggle-wrapper" class="sui-toggle-content{{ ( _.isTrue( eval( '<?php echo esc_html( $prefix ); ?>' +  '_enabled' ) ) ) ? '' : ' sui-hidden' }}">

		<span class="sui-description"><?php echo esc_html( $description ); ?></span>

		<div class="sui-border-frame">

			<?php
			// SETTINGS: Horizontal Position ?>
			<div class="sui-form-field">

				<?php if ( 'inline' !== $prefix ) { ?>

					<label class="sui-settings-label"><?php esc_html_e( 'Horizontal Position', 'wordpress-popup' ); ?></label>
					<span class="sui-description"><?php esc_html_e( 'Choose the horizontal position of the Floating Social.', 'wordpress-popup' ); ?></span>

				<?php } else { ?>

					<label class="sui-settings-label"><?php esc_html_e( 'Position', 'wordpress-popup' ); ?></label>
					<span class="sui-description"><?php esc_html_e( 'Choose the position for the Floating Social.', 'wordpress-popup' ); ?></span>

				<?php } ?>

				<?php if ( isset( $positions ) && ( '' !== $positions ) ) { ?>

					<div style="margin-top: 10px;">

						<?php foreach( $positions as $pkey => $position ) { ?>

							<label
								for="hustle-position-<?php echo esc_html( $prefix ); ?>-<?php echo esc_html( $pkey ); ?>"
								class="sui-radio-image"
							>

								<?php echo Opt_In_Utils::render_image_markup(
									esc_url( self::$plugin_url . 'assets/images/' . $position['image1x'] ),
									esc_url( self::$plugin_url . 'assets/images/' . $position['image2x'] ),
									''
								); // WPCS: XSS ok. ?>

								<span class="sui-radio">
									<input
										type="radio"
										name="<?php echo esc_html( $prefix ); ?>_position"
										data-attribute="<?php echo esc_html( $prefix ); ?>_position"
										value="<?php echo esc_html( $pkey ); ?>"
										id="hustle-position-<?php echo esc_html( $prefix ); ?>-<?php echo esc_html( $pkey ); ?>"
										{{ _.checked( '<?php echo esc_html( $pkey ); ?>' === eval( '<?php echo esc_html( $prefix ); ?>' + '_position' ) , true)}}
									/>
									<span aria-hidden="true"></span>
									<span><?php echo esc_html( $position['label'] ); ?></span>
								</span>

							</label>

						<?php } ?>

					</div>

				<?php } ?>

			</div>

			<?php
			// SETTINGS: Vertical Position
			if ( isset( $offset_y ) && ( true === $offset_y ) ) { ?>

				<div class="sui-form-field">

					<label class="sui-settings-label"><?php esc_html_e( 'Vertical Position', 'wordpress-popup' ); ?></label>
					<span class="sui-description" style="margin-bottom: 10px;"><?php esc_html_e( 'Choose the vertical position of the Floating Social.', 'wordpress-popup' ); ?></span>

					<div class="sui-side-tabs">

						<div class="sui-tabs-menu">

							<label
								for="hustle-<?php echo esc_html( $prefix ); ?>-offset--top"
								class="sui-tab-item {{ ( 'top' === eval( '<?php echo esc_html( $prefix ); ?>' + '_position_y' ) ) ? 'active' : '' }}"
							>
								<input
									type="radio"
									name="<?php echo esc_html( $prefix ); ?>_position_y"
									data-attribute="<?php echo esc_html( $prefix ); ?>_position_y"
									value="top"
									id="hustle-<?php echo esc_html( $prefix ); ?>-offset--top"
									{{ _.checked( 'top' === eval( '<?php echo esc_html( $prefix ); ?>' + '_position_y' ), true) }}
								/>
								<?php esc_html_e( 'Top', 'wordpress-popup' ); ?>
							</label>

							<label
								for="hustle-<?php echo esc_html( $prefix ); ?>-offset--bottom"
								class="sui-tab-item {{ ( 'bottom' === eval( '<?php echo esc_html( $prefix ); ?>' + '_position_y' ) ) ? 'active' : '' }}"
							>
								<input
									type="radio"
									name="<?php echo esc_html( $prefix ); ?>_position_y"
									data-attribute="<?php echo esc_html( $prefix ); ?>_position_y"
									value="bottom"
									id="hustle-<?php echo esc_html( $prefix ); ?>-offset--bottom"
									{{ _.checked( 'bottom' === eval( '<?php echo esc_html( $prefix ); ?>' + '_position_y' ), true) }}
								/>
								<?php esc_html_e( 'Bottom', 'wordpress-popup' ); ?>
							</label>

						</div>

					</div>

				</div>

			<?php } ?>

			<?php
			// SETTINGS: Offset
			if (
				( isset( $offset_x ) && ( true === $offset_x ) ) ||
				( isset( $offset_y ) && ( true === $offset_y ) )
			) { ?>

				<div class="sui-form-field">

					<span class="sui-settings-label"><?php esc_html_e( 'Offset', 'wordpress-popup' ); ?></span>
					<span class="sui-description"><?php esc_html_e( "You can choose to offset the Floating Social relative to the screen of visitor's device or a specific CSS selector.", 'wordpress-popup' ); ?></span>

				</div>

				<?php
				// SETTINGS: Relative to ?>
				<div class="sui-form-field">

					<label class="sui-label"><?php esc_html_e( 'Relative to', 'wordpress-popup' ); ?></label>

					<div class="sui-side-tabs">

						<div class="sui-tabs-menu">

							<label
								for="hustle-<?php echo esc_html( $prefix ); ?>-offset--screen"
								class="sui-tab-item {{ ( 'screen' === eval( '<?php echo esc_html( $prefix ); ?>' + '_offset' ) ) ? 'active' : '' }}"
							>
								<input
									type="radio"
									name="<?php echo esc_html( $prefix ); ?>_offset"
									data-attribute="<?php echo esc_html( $prefix ); ?>_offset"
									value="screen"
									id="hustle-<?php echo esc_html( $prefix ); ?>-offset--screen"
									data-tab-menu="offset-screen"
									{{ _.checked( 'screen' === eval( '<?php echo esc_html( $prefix ); ?>' + '_offset' ) , true)}}
								/>
								<?php esc_html_e( 'Screen', 'wordpress-popup' ); ?>
							</label>

							<label
								for="hustle-<?php echo esc_html( $prefix ); ?>-offset--css"
								class="sui-tab-item {{ ( 'css_selector' === eval( '<?php echo esc_html( $prefix ); ?>' + '_offset' ) ) ? 'active' : '' }}"
							>
								<input
									type="radio"
									name="<?php echo esc_html( $prefix ); ?>_offset"
									data-attribute="<?php echo esc_html( $prefix ); ?>_offset"
									value="css_selector"
									id="hustle-<?php echo esc_html( $prefix ); ?>-offset--css"
									data-tab-menu="offset-css"
									{{ _.checked( 'css_selector' === eval( '<?php echo esc_html( $prefix ); ?>' + '_offset' ) , true)}}
								/>
								<?php esc_html_e( 'CSS selector', 'wordpress-popup' ); ?>
							</label>

						</div>

						<div class="sui-tabs-content sui-tabs-content-lg">

							<div
								class="sui-tab-content {{ ( 'css_selector' === eval( '<?php echo esc_html( $prefix ); ?>' + '_offset' ) ) ? 'active' : '' }}"
								data-tab-content="offset-css"
							>

								<div class="sui-form-field">

									<label for="hustle-offset--<?php echo esc_html( $prefix ); ?>-selector" class="sui-label"><?php esc_html_e( 'CSS selector of the element', 'wordpress-popup' ); ?></label>

									<input
										type="text"
										name="<?php echo esc_html( $prefix ); ?>_css_selector"
										data-attribute="<?php echo esc_html( $prefix ); ?>_css_selector"
										value="{{eval( '<?php echo esc_html( $prefix ); ?>' + '_css_selector' )}}"
										placeholder="#css-id"
										id="hustle-offset--<?php echo esc_html( $prefix ); ?>-selector"
										class="sui-form-control"
									/>

									<span class="sui-error-message" style="display: none;"><?php esc_html_e( 'The selector you entered is not valid.', 'wordpress-popup' ); ?></span>

								</div>

							</div>

						</div>

					</div>

				</div>

				<?php
				// SETTINGS: Offset value ?>
				<div class="sui-row">

					<div 
						id="hustle-<?php echo esc_attr( $prefix ); ?>-offset-x-wrapper" 
						class="sui-col<?php if ( 'center' === $display_settings[ $prefix . '_position' ] ) echo ' sui-hidden'; ?>"
					>

						<div class="sui-form-field">

							<label
								for="hustle-<?php echo esc_html( $prefix ); ?>-offset-pixels-x" 
								id="hustle-<?php echo esc_attr( $prefix ); ?>-left-offset-label" 
								class="sui-label<?php if ( 'right' === $display_settings[ $prefix . '_position' ] ) echo ' sui-hidden'; ?>"
							>
								<?php esc_html_e( 'Left offset value (px)', 'wordpress-popup' ); ?>
							</label>

							<label
								for="hustle-<?php echo esc_html( $prefix ); ?>-offset-pixels-x" 
								id="hustle-<?php echo esc_attr( $prefix ); ?>-right-offset-label" 
								class="sui-label<?php if ( 'right' !== $display_settings[ $prefix . '_position' ] ) echo ' sui-hidden'; ?>"
							>
								<?php esc_html_e( 'Right offset value (px)', 'wordpress-popup' ); ?>
							</label>

							<input
								type="number"
								name="<?php echo esc_html( $prefix ); ?>_offset_x"
								value="{{eval('<?php echo esc_html( $prefix ); ?>' + '_offset_x')}}"
								placeholder="0"
								id="hustle-<?php echo esc_html( $prefix ); ?>-offset-pixels-x"
								class="sui-form-control"
								data-attribute="<?php echo esc_html( $prefix ); ?>_offset_x"
							/>

						</div>

					</div>

					<div class="sui-col">

						<div class="sui-form-field">

							<label 
								for="hustle-<?php echo esc_html( $prefix ); ?>-offset-pixels-y" 
								id="hustle-<?php echo esc_attr( $prefix ); ?>-top-offset-label" 
								class="sui-label<?php if ( 'top' !== $display_settings[ $prefix . '_position_y' ] ) echo ' sui-hidden'; ?>"
							>
									<?php esc_html_e( 'Top offset value (px)', 'wordpress-popup' ); ?>
							</label>

							<label 
								for="hustle-<?php echo esc_html( $prefix ); ?>-offset-pixels-y" 
								id="hustle-<?php echo esc_attr( $prefix ); ?>-bottom-offset-label" 
								class="sui-label<?php if ( 'top' === $display_settings[ $prefix . '_position_y' ] ) echo ' sui-hidden'; ?>"
							>
								<?php esc_html_e( 'Bottom offset value (px)', 'wordpress-popup' ); ?>
							</label>

							<input
								type="number"
								name="<?php echo esc_html( $prefix ); ?>_offset_y"
								data-attribute="<?php echo esc_html( $prefix ); ?>_offset_y"
								value="{{eval('<?php echo esc_html( $prefix ); ?>' + '_offset_y')}}"
								placeholder="0"
								id="hustle-<?php echo esc_html( $prefix ); ?>-offset-pixels-y"
								class="sui-form-control"
							/>

						</div>

					</div>

				</div>

			<?php } ?>

			<?php
			// SETTINGS: Alignment
			if ( isset( $alignment ) && ( true === $alignment ) ) { ?>

				<div class="sui-form-field">

					<label class="sui-settings-label"><?php esc_html_e( 'Alignment', 'wordpress-popup' ); ?></label>
					<span class="sui-description"><?php esc_html_e( 'You can choose between Left align, Middle or Right align. For example, choosing the left align will push the social bar to the left of the parent container.', 'wordpress-popup' ); ?></span>

					<div class="sui-side-tabs" style="margin-top: 10px;">

						<div class="sui-tabs-menu">

							<label
								for="hustle-<?php echo esc_html( $prefix ); ?>-align--left"
								class="sui-tab-item {{ ( 'left' === eval( '<?php echo esc_html( $prefix ); ?>' + '_align' ) ) ? 'active' : '' }}"
							>
								<input
									type="radio"
									name="<?php echo esc_html( $prefix ); ?>_align"
									data-attribute="<?php echo esc_html( $prefix ); ?>_align"
									value="left"
									id="hustle-<?php echo esc_html( $prefix ); ?>-align--left"
									{{ _.checked( 'left' === eval( '<?php echo esc_html( $prefix ); ?>' + '_align' ), true) }}
								/>
								<i class="sui-icon-align-left sui-md" aria-hidden="true"></i>
								<span class="sui-screen-reader-text"><?php esc_html_e( 'Left', 'wordpress-popup' ); ?></span>
							</label>

							<label
								for="hustle-<?php echo esc_html( $prefix ); ?>-align--center"
								class="sui-tab-item {{ ( 'center' === eval( '<?php echo esc_html( $prefix ); ?>' + '_align' ) ) ? 'active' : '' }}"
							>
								<input
									type="radio"
									name="<?php echo esc_html( $prefix ); ?>_align"
									data-attribute="<?php echo esc_html( $prefix ); ?>_align"
									value="center"
									id="hustle-<?php echo esc_html( $prefix ); ?>-align--center"
									{{ _.checked( 'center' === eval( '<?php echo esc_html( $prefix ); ?>' + '_align' ), true) }}
								/>
								<i class="sui-icon-align-center sui-md" aria-hidden="true"></i>
								<span class="sui-screen-reader-text"><?php esc_html_e( 'Center', 'wordpress-popup' ); ?></span>
							</label>

							<label
								for="hustle-<?php echo esc_html( $prefix ); ?>-align--right"
								class="sui-tab-item {{ ( 'right' === eval( '<?php echo esc_html( $prefix ); ?>' + '_align' ) ) ? 'active' : '' }}"
							>
								<input
									type="radio"
									name="<?php echo esc_html( $prefix ); ?>_align"
									data-attribute="<?php echo esc_html( $prefix ); ?>_align"
									value="right"
									id="hustle-<?php echo esc_html( $prefix ); ?>-align--right"
									{{ _.checked( 'right' === eval( '<?php echo esc_html( $prefix ); ?>' + '_align' ), true) }}
								/>
								<i class="sui-icon-align-right sui-md" aria-hidden="true"></i>
								<span class="sui-screen-reader-text"><?php esc_html_e( 'Right', 'wordpress-popup' ); ?></span>
							</label>

						</div>

					</div>

				</div>

			<?php } ?>

		</div>

	</div>

</div>
