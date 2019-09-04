<?php
$inline_below = self::$plugin_url . 'assets/images/embed-position-below';
$inline_above = self::$plugin_url . 'assets/images/embed-position-above';
$inline_both = self::$plugin_url . 'assets/images/embed-position-both';

?>

<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">

		<span class="sui-settings-label"><?php esc_html_e( 'Manage Display Options', Opt_In::TEXT_DOMAIN ); ?></span>

		<span class="sui-description"><?php printf( esc_html__( 'Enable/Disable the various options available to display your embed on the front-end.', Opt_In::TEXT_DOMAIN ), 'aaa' ); ?></span>

	</div>

	<div class="sui-box-settings-col-2">

		<div>

			<label for="hustle-module-inline" class="sui-toggle">
				<input type="checkbox"
					name="inline_enabled"
					data-attribute="inline_enabled"
					id="hustle-module-inline"
					{{ _.checked( _.isTrue( inline_enabled ), true ) }} />
				<span class="sui-toggle-slider"></span>
			</label>

			<label for="hustle-module-inline"><?php esc_html_e( 'Inline Content', Opt_In::TEXT_DOMAIN ); ?></label>

			<div id="hustle-inline-toggle-wrapper" class="sui-toggle-content{{ ( _.isTrue( inline_enabled ) ) ? '' : ' sui-hidden' }}">
				<span class="sui-description"><?php esc_html_e( 'Enable this to add your embed above, below or at both positions within the content of your posts and pages.', Opt_In::TEXT_DOMAIN ); ?></span>

				<div class="sui-border-frame">
					<span class="sui-settings-label"><?php esc_html_e( 'Position', Opt_In::TEXT_DOMAIN ); ?></span>
					<span class="sui-description" style="margin-bottom: 10px;"><?php esc_html_e( 'Choose the position for the inline embed with respect to the content.', Opt_In::TEXT_DOMAIN ); ?></span>

					<label for="hustle-inline-below" class="sui-radio-image">

						<?php Opt_In_Utils::hustle_image( $inline_below, 'png', '', true ); ?>

						<span class="sui-radio sui-radio-sm">
							<input type="radio"
								name="inline_position"
								value="below"
								id="hustle-inline-below"
								data-attribute="inline_position"
								{{_.checked( ( 'below' === inline_position ) , true)}} />
							<span aria-hidden="true"></span>
							<span><?php esc_html_e( 'Below', Opt_In::TEXT_DOMAIN ); ?></span>
						</span>

					</label>

					<label for="hustle-inline-above" class="sui-radio-image">

						<?php Opt_In_Utils::hustle_image( $inline_above, 'png', '', true ); ?>

						<span class="sui-radio sui-radio-sm">
							<input type="radio"
								name="inline_position"
								value="above"
								id="hustle-inline-above"
								data-attribute="inline_position"
								{{_.checked( ( 'above' === inline_position ) , true)}} />
							<span aria-hidden="true"></span>
							<span><?php esc_html_e( 'Above', Opt_In::TEXT_DOMAIN ); ?></span>
						</span>

					</label>

					<label for="hustle-inline-both" class="sui-radio-image">

						<?php Opt_In_Utils::hustle_image( $inline_both, 'png', 'sui-graphic', true ); ?>

						<span class="sui-radio sui-radio-sm">
							<input type="radio"
								name="inline_position"
								value="both"
								id="hustle-inline-both"
								data-attribute="inline_position"
								{{_.checked( ( 'both' === inline_position ) , true)}} />
							<span aria-hidden="true"></span>
							<span><?php esc_html_e( 'Both', Opt_In::TEXT_DOMAIN ); ?></span>
						</span>

					</label>

				</div>

			</div>

		</div>


		<div style="margin-top: 20px;">

			<label for="hustle-module-widget" class="sui-toggle">
				<input type="checkbox"
					name="widget_enabled"
					data-attribute="widget_enabled"
					id="hustle-module-widget"
					{{ _.checked( _.isTrue( widget_enabled ), true ) }} />
				<span class="sui-toggle-slider"></span>
			</label>

			<label for="hustle-module-widget"><?php esc_html_e( 'Widget', Opt_In::TEXT_DOMAIN ); ?></label>

			<div id="hustle-widget-toggle-wrapper" class="sui-toggle-content{{ ( _.isTrue( widget_enabled ) ) ? '' : ' sui-hidden' }}">
				<span class="sui-description">
					<?php printf(
						esc_html__( 'Enabling this will add a new widget named "Hustle" under the Available Widgets list. You can go to %s and configure this widget to show your embed in the sidebars.', Opt_In::TEXT_DOMAIN ),
						sprintf(
							'<strong>%1$s > %2$s</strong>',
							esc_html__('Appearance', Opt_In::TEXT_DOMAIN),
							sprintf(
								'<a href="%1$s" target="_blank">%2$s</a>',
								esc_url( admin_url( 'widgets.php' ) ),
								esc_html__('Widgets', Opt_In::TEXT_DOMAIN)
							)
						)
					); ?>
				</span>
			</div>

		</div>


		<div style="margin-top: 20px;">

			<label for="hustle-module-shortcode" class="sui-toggle">
				<input type="checkbox"
					name="shortcode_enabled"
					data-attribute="shortcode_enabled"
					id="hustle-module-shortcode"
					{{ _.checked( _.isTrue( shortcode_enabled ), true ) }} />
				<span class="sui-toggle-slider"></span>
			</label>

			<label for="hustle-module-shortcode"><?php esc_html_e( 'Shortcode', Opt_In::TEXT_DOMAIN ); ?></label>

			<div id="hustle-shortcode-toggle-wrapper" class="sui-toggle-content{{ ( _.isTrue( shortcode_enabled ) ) ? '' : ' sui-hidden' }}">
				<span class="sui-description"><?php esc_html_e( 'Use shortcode to display your embed anywhere you want to. Just copy the shortcode and paste it wherever you want to render your embed.', Opt_In::TEXT_DOMAIN ); ?></span>

				<div class="sui-border-frame">
					<span class="sui-description"><?php esc_html_e( 'Shortcode to render your embed', Opt_In::TEXT_DOMAIN ); ?></span>

					<div class="sui-with-button sui-with-button-inside">
						<input type="text"
							class="sui-form-control"
							value='[wd_hustle id="<?php echo esc_attr( $shortcode_id ); ?>" type="embedded"]'
							readonly="readonly">
						<button class="sui-button-icon hustle-copy-shortcode-button">
							<i aria-hidden="true" class="sui-icon-copy"></i>
							<span class="sui-screen-reader-text"><?php esc_html_e( 'Copy shortcode', Opt_In::TEXT_DOMAIN ); ?></span>
						</button>
					</div>

				</div>

				<div class="sui-notice sui-notice-info">
					<p><?php esc_html_e( 'You have full control over the shortcode. Visibility rules in the following section won\'t affect shortcode.', Opt_In::TEXT_DOMAIN ); ?></p>
				</div>
			</div>

		</div>

	</div>

</div>
