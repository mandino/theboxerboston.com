<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label"><?php esc_html_e( 'Additional Settings', Opt_In::TEXT_DOMAIN ); ?></span>
		<span class="sui-description"><?php printf( esc_html__( 'These settings will add some extra control on your %s.', Opt_In::TEXT_DOMAIN ), esc_html( $smallcaps_singular ) ); ?></span>
	</div>

	<div class="sui-box-settings-col-2">

		<?php
		if ( 'popup' === $module_type ) {
			// SETTINGS: Allow page scrolling ?>
			<div class="sui-form-field">

				<label class="sui-settings-label"><?php esc_html_e( 'Page scrolling', Opt_In::TEXT_DOMAIN ); ?></label>

				<span class="sui-description"><?php printf( esc_html__( 'Choose whether to enable page scrolling in the background while the %s is visible to the users.', Opt_In::TEXT_DOMAIN ), esc_html( $smallcaps_singular ) ); ?></span>

				<div class="sui-side-tabs" style="margin-top: 10px;">

					<div class="sui-tabs-menu">

						<label
							for="hustle-settings--scroll-on"
							class="sui-tab-item {{ _.isTrue( allow_scroll_page ) ? 'active' : '' }}"
						>
							<input
								type="radio"
								data-attribute="allow_scroll_page"
								value="1"
								id="hustle-settings--scroll-on"
								{{ _.checked( ( _.isTrue( allow_scroll_page ) ), true) }}
							/>
							<?php esc_html_e( 'Enable', Opt_In::TEXT_DOMAIN ); ?>
						</label>

						<label
							for="hustle-settings--scroll-off"
							class="sui-tab-item {{ _.isFalse( allow_scroll_page ) ? 'active' : '' }}"
						>
							<input
								type="radio"
								data-attribute="allow_scroll_page"
								value="0"
								id="hustle-settings--scroll-off"
								{{ _.checked( ( _.isFalse( allow_scroll_page ) ), true) }}
							/>
							<?php esc_html_e( 'Disable', Opt_In::TEXT_DOMAIN ); ?>
						</label>

					</div>

				</div>

			</div>

		<?php }

		if ( $is_optin ) { ?>

			<?php // SETTINGS: Visibility after opt-in ?>
			<div class="sui-form-field">

				<label class="sui-settings-label"><?php esc_html_e( 'Visibility after opt-in', Opt_In::TEXT_DOMAIN ); ?></label>

				<span class="sui-description" style="margin-bottom: 10px;"><?php printf( esc_html__( "Choose the %s visibility once a visitor has opted-in using Hustle's form.", Opt_In::TEXT_DOMAIN ), esc_html( $smallcaps_singular ) ); ?></span>

				<select data-attribute="hide_after_subscription">
					<option value="keep_show" {{ _.selected( ( 'keep_show' === hide_after_subscription ), true) }}><?php esc_html_e( 'Keep showing this module', Opt_In::TEXT_DOMAIN ); ?></option>
					<option value="no_show_all" {{ _.selected( ( 'no_show_all' === hide_after_subscription ), true) }}><?php esc_html_e( 'No longer show this module across the site', Opt_In::TEXT_DOMAIN ); ?></option>
					<option value="no_show_on_post" {{ _.selected( ( 'no_show_on_post' === hide_after_subscription ), true) }}><?php esc_html_e( 'No longer show this module on this post/page', Opt_In::TEXT_DOMAIN ); ?></option>
				</select>

			</div>

		<?php } ?>

		<?php // SETTINGS: External form conversion behavior ?>

		<div class="sui-form-field">

			<label class="sui-settings-label"><?php esc_html_e( 'External form conversion behavior', Opt_In::TEXT_DOMAIN ); ?></label>

			<span class="sui-description"><?php printf( esc_html__( 'If you have an external form in your %1$s, choose how your %1$s will behave on conversion of that form.', Opt_In::TEXT_DOMAIN ), esc_html( $smallcaps_singular ) ); ?></span>

			<div style="margin-top: 10px;">

				<div style="margin-bottom: 10px;">

					<select data-attribute="on_submit" >

						<?php if ( 'embedded' !== $module_type ) { ?>
							<option value="close"
								{{ _.selected( ( 'close' === on_submit ), true) }}>
								<?php printf( esc_html__( 'Close the %s', Opt_In::TEXT_DOMAIN ), esc_html( $smallcaps_singular ) ); ?>
							</option>
						<?php } ?>

						<option value="redirect"
							{{ _.selected( ( 'redirect' === on_submit ), true) }}>
							<?php esc_html_e( 'Re-direct to form target URL', Opt_In::TEXT_DOMAIN ); ?>
						</option>

						<option value="nothing"
							{{ _.selected( ( 'nothing' === on_submit ), true) }}>
							<?php esc_html_e( 'Do nothing (use for Ajax Forms)', Opt_In::TEXT_DOMAIN ); ?>
						</option>

					</select>

				</div>

				<div id="hustle-on-submit-delay-wrapper" class="sui-border-frame{{ _.class( ( 'nothing' === on_submit ), ' sui-hidden' ) }}">

					<label class="sui-label"><?php esc_html_e( 'Add delay', Opt_In::TEXT_DOMAIN ); ?></label>

					<div class="sui-row">

						<div class="sui-col-md-6">

							<input
								type="number"
								value="{{ on_submit_delay }}"
								min="0"
								class="sui-form-control"
								data-attribute="on_submit_delay"
							/>

						</div>

						<div class="sui-col-md-6">

							<select data-attribute="on_submit_delay_unit">

								<option
									value="seconds"
									{{ _.selected( ( 'seconds' === on_submit_delay_unit ), true) }}
								>
									<?php esc_html_e( 'seconds', Opt_In::TEXT_DOMAIN ); ?>
								</option>

								<option
									value="minutes"
									{{ _.selected( ( 'minutes' === on_submit_delay_unit ), true) }}
								>
									<?php esc_html_e( 'minutes', Opt_In::TEXT_DOMAIN ); ?>
								</option>

							</select>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>
