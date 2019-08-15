<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label"><?php esc_html_e( 'Feature Image', Opt_In::TEXT_DOMAIN ); ?></span>
		<span class="sui-description"><?php esc_html_e( 'Choose the feature image settings as per your liking.', Opt_In::TEXT_DOMAIN ); ?></span>
	</div>

	<div class="sui-box-settings-col-2">


		<?php
		// SETTING: Position ?>
		<div id="hustle-feature-image-position-option" class="sui-form-field">

			<span class="sui-settings-label"><?php esc_html_e( 'Position', Opt_In::TEXT_DOMAIN ); ?></span>
			<span class="sui-description"><?php printf( esc_html__( 'Choose the position of your feature image relative to the content of the %s in your chosen layout.', Opt_In::TEXT_DOMAIN ), esc_html( $smallcaps_singular ) ); ?></span>

			<div class="sui-side-tabs"
				style="margin-top: 10px;">

				<div class="sui-tabs-menu">

					<label id="hustle-feature-image-left-label" for="hustle-feature-image-left" class="sui-tab-item{{ _.class( 'left' === feature_image_position,' active' ) }}">
						<input type="radio"
							name="feature_image_position"
							value="left"
							data-attribute="feature_image_position"
							id="hustle-feature-image-left"
							{{ _.checked( ( 'left' === feature_image_position ), true) }} />
						<?php esc_attr_e( "Left", Opt_In::TEXT_DOMAIN ); ?>
					</label>

					<?php if ( $is_optin ) { ?>

						<label id="hustle-feature-image-above-label" for="hustle-feature-image-above" class="sui-tab-item{{ _.class( 'above' === feature_image_position,' active' ) }}{{ _.class( 'one' !== form_layout, ' sui-hidden' ) }}">
							<input type="radio"
								name="feature_image_position"
								value="above"
								data-attribute="feature_image_position"
								id="hustle-feature-image-above"
								{{ _.checked( ( 'above' === feature_image_position ), true) }} />
							<?php esc_attr_e( "Above Content", Opt_In::TEXT_DOMAIN ); ?>
						</label>

						<label id="hustle-feature-image-below-label" for="hustle-feature-image-below" class="sui-tab-item{{ _.class( 'below' === feature_image_position,' active' ) }}{{ _.class( 'one' !== form_layout, ' sui-hidden' ) }}">
							<input type="radio"
								name="feature_image_position"
								value="below"
								data-attribute="feature_image_position"
								id="hustle-feature-image-below"
								{{ _.checked( ( 'below' === feature_image_position ), true) }} />
							<?php esc_attr_e( "Below Content", Opt_In::TEXT_DOMAIN ); ?>
						</label>

					<?php } ?>

					<label id="hustle-feature-image-right-label" for="hustle-feature-image-right" class="sui-tab-item{{ _.class( 'right' === feature_image_position,' active' ) }}">
						<input type="radio"
							name="feature_image_position"
							value="right"
							data-attribute="feature_image_position"
							id="hustle-feature-image-right"
							{{ _.checked( ( 'right' === feature_image_position ), true) }} />
						<?php esc_attr_e( "Right", Opt_In::TEXT_DOMAIN ); ?>
					</label>

				</div>

			</div>

		</div>

		<div id="hustle-appearance-feature-image-settings" <?php if ( empty( $feature_image ) ) echo ' style="display:none;"'; ?>>
		
			<?php
			// SETTING: Fitting ?>
			<div class="sui-form-field">

				<span class="sui-settings-label"><?php esc_html_e( 'Fitting', Opt_In::TEXT_DOMAIN ); ?></span>
				<span class="sui-description"><?php printf( esc_html__( 'Choose the feature image fitting type. You can preview the %s to check how each option affects the feature image.', Opt_In::TEXT_DOMAIN ), esc_html( $smallcaps_singular ) ); ?></span>

				<div class="sui-side-tabs"
					style="margin-top: 10px;">

					<div class="sui-tabs-menu">

						<label for="hustle-feature-image-cover" class="sui-tab-item{{ ( 'cover' === feature_image_fit ) ? ' active' : '' }}">
							<input type="radio"
								name="feature_image_fit"
								data-attribute="feature_image_fit"
								value="cover"
								id="hustle-feature-image-cover"
								data-tab-menu="hustle-focus-image"
								{{ _.checked( ( 'cover' === feature_image_fit ), true) }} />
							<?php esc_attr_e( "Cover", Opt_In::TEXT_DOMAIN ); ?>
						</label>

						<label for="hustle-feature-image-fill" class="sui-tab-item{{ ( 'fill' === feature_image_fit ) ? ' active' : '' }}">
							<input type="radio"
								name="feature_image_fit"
								data-attribute="feature_image_fit"
								value="fill"
								id="hustle-feature-image-fill"
								{{ _.checked( ( 'fill' === feature_image_fit ), true) }} />
							<?php esc_attr_e( "Fill", Opt_In::TEXT_DOMAIN ); ?>
						</label>

						<label for="hustle-feature-image-contain" class="sui-tab-item{{ ( 'contain' === feature_image_fit ) ? ' active' : '' }}">
							<input type="radio"
								name="feature_image_fit"
								data-attribute="feature_image_fit"
								value="contain"
								id="hustle-feature-image-contain"
								data-tab-menu="hustle-focus-image"
								{{ _.checked( ( 'contain' === feature_image_fit ), true) }} />
							<?php esc_attr_e( "Contain", Opt_In::TEXT_DOMAIN ); ?>
						</label>

						<label for="hustle-feature-image-none" class="sui-tab-item{{ ( 'none' === feature_image_fit ) ? ' active' : '' }}">
							<input type="radio"
								name="feature_image_fit"
								data-attribute="feature_image_fit"
								value="none"
								id="hustle-feature-image-none"
								{{ _.checked( ( 'none' === feature_image_fit ), true) }} />
							<?php esc_attr_e( "None", Opt_In::TEXT_DOMAIN ); ?>
						</label>

					</div>

					<div class="sui-tabs-content">

						<div class="sui-tab-content sui-tab-boxed {{ _.class( ( 'contain' === feature_image_fit || 'cover' === feature_image_fit), 'active' ) }}" data-tab-content="hustle-focus-image">

							<?php $this->render( 'admin/commons/sui-wizard/elements/focal-point', array( 'feature_image' => $feature_image ) ); ?>

						</div>

					</div>

				</div>

			</div>

			<?php
			// OPTION: Visibility on mobile ?>
			<div class="sui-form-field">

				<span class="sui-settings-label"><?php esc_html_e( 'Visibility on mobile', Opt_In::TEXT_DOMAIN ); ?></span>
				<span class="sui-description"><?php esc_html_e( 'Make the feature image visibile or hidden on mobile devices.', Opt_In::TEXT_DOMAIN ); ?></span>

				<div class="sui-side-tabs"
					style="margin-top: 10px;">

					<div class="sui-tabs-menu">

						<label for="hustle-feature-image-visible" class="sui-tab-item {{ ! _.isTrue( feature_image_hide_on_mobile ) ? 'active' : '' }}">
							<input type="radio"
								name="feature_image_hide_on_mobile"
								data-attribute="feature_image_hide_on_mobile"
								value="0"
								id="hustle-feature-image-visible"
								{{ _.checked( ! _.isTrue( feature_image_hide_on_mobile ), true) }} />
							<?php esc_attr_e( "Visible", Opt_In::TEXT_DOMAIN ); ?>
						</label>

						<label for="hustle-feature-image-hidden" class="sui-tab-item {{ _.isTrue( feature_image_hide_on_mobile ) ? 'active' : '' }}">
							<input type="radio"
								name="feature_image_hide_on_mobile"
								data-attribute="feature_image_hide_on_mobile"
								value="1"
								id="hustle-feature-image-hidden"
								{{ _.checked( _.isTrue( feature_image_hide_on_mobile ), true) }} />
							<?php esc_attr_e( "Hidden", Opt_In::TEXT_DOMAIN ); ?>
						</label>

					</div>

				</div>

			</div>

		</div>

		<div id="hustle-appearance-feature-image-placeholder"<?php if ( ! empty( $feature_image ) ) echo ' style="display:none;"'; ?>>

			<div class="sui-notice">
				<p><?php esc_html_e( "There's no feature image. Upload an image in the \"Content\" tab to adjust fitting and image visibility on mobiles." ); ?></p>
			</div>

		</div>

	</div>

</div>
