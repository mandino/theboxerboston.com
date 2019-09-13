<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label"><?php printf( esc_html__( 'Custom %s Size', 'wordpress-popup' ), esc_html( $capitalize_singular ) ); ?></span>
		<span class="sui-description"><?php printf( esc_html__( 'Choose a custom size for your %s.', 'wordpress-popup' ), esc_html( $smallcaps_singular ) ); ?></span>
	</div>

	<div class="sui-box-settings-col-2">

		<label for="hustle-customize-size" class="sui-toggle">
			<input type="checkbox"
				name="customize_size"
				data-attribute="customize_size"
				id="hustle-customize-size"
				{{ _.checked( _.isTrue( customize_size ), true ) }} />
			<span class="sui-toggle-slider"></span>
		</label>

		<label for="hustle-customize-size"><?php esc_html_e( 'Enable custom size', 'wordpress-popup' ); ?></label>

		<div id="hustle-customize-size-toggle-wrapper" class="sui-toggle-content{{ ( _.isTrue( customize_size ) ) ? '' : ' sui-hidden' }}">

			<div class="sui-border-frame" style="margin-bottom: 10px;">

				<div class="sui-form-field">

					<label class="sui-label"><?php esc_html_e( 'Apply to', 'wordpress-popup' ); ?></label>

					<div class="sui-side-tabs" style="margin-bottom: 10px;">

						<div class="sui-tabs-menu">

							<label for="hustle-module--desktop-custom-size" class="sui-tab-item{{ ( 'desktop' === apply_custom_size_to ) ? ' active' : '' }}">
								<input type="radio"
									name="apply_custom_size_to"
									data-attribute="apply_custom_size_to"
									value="desktop"
									id="hustle-module--desktop-custom-size"
									{{ _.checked( ( 'desktop' === apply_custom_size_to ), true ) }} />
								<?php esc_html_e( 'Desktop Only', 'wordpress-popup' ); ?>
							</label>

							<label for="hustle-module--all-custom-size" class="sui-tab-item{{ ( 'all' === apply_custom_size_to ) ? ' active' : '' }}">
								<input type="radio"
									name="apply_custom_size_to"
									data-attribute="apply_custom_size_to"
									value="all"
									id="hustle-module--all-custom-size"
									{{ _.checked( ( 'all' === apply_custom_size_to ), true ) }} />
								<?php esc_html_e( 'All Devices', 'wordpress-popup' ); ?>
							</label>

						</div>

					</div>

					<span class="sui-description"><?php printf( esc_html__( "We recommend applying the custom size to Desktop only. We'll resize the %s on the smaller devices and keep it responsive.", 'wordpress-popup' ), esc_html( $smallcaps_singular ) ); ?></span>

				</div>

				<div class="sui-row">

					<div class="sui-col-md-6">

						<div class="sui-form-field">

							<label class="sui-label"><?php esc_html_e( 'Width', 'wordpress-popup' ); ?> (px)</label>

							<input type="number"
								value="{{ custom_width }}"
								data-attribute="custom_width"
								class="sui-form-control" />

						</div>

					</div>

					<div class="sui-col-md-6">

						<div class="sui-form-field">

							<label class="sui-label"><?php esc_html_e( 'Height', 'wordpress-popup' ); ?> (px)</label>

							<input type="number"
								value="{{ custom_height }}"
								data-attribute="custom_height"
								class="sui-form-control" />

						</div>

					</div>

				</div>

			</div>

			<span class="sui-description"><?php printf( esc_html__( 'Use Preview to ensure your %s looks good on the choosen custom size.', 'wordpress-popup' ), esc_html( $smallcaps_singular ) ); ?></span>

		</div>

	</div>

</div>
