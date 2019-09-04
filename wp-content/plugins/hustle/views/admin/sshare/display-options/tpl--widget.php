<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">

		<span class="sui-settings-label"><?php esc_html_e( 'Widget', Opt_In::TEXT_DOMAIN ); ?></span>

		<span class="sui-description"><?php esc_html_e( 'Add a social bar to the sidebars of your website.', Opt_In::TEXT_DOMAIN ); ?></span>

	</div>

	<div class="sui-box-settings-col-2">

		<div class="sui-form-field">

			<label for="hustle-settings--widget-enable" class="sui-toggle">
				<input
					type="checkbox"
					name="widget_enabled"
					data-attribute="widget_enabled"
					id="hustle-settings--widget-enable"
					{{ _.checked( _.isTrue( widget_enabled ), true ) }}
				/>
				<span class="sui-toggle-slider"></span>
			</label>

			<label for="hustle-settings--widget-enable"><?php esc_html_e( 'Enable widget module', Opt_In::TEXT_DOMAIN ); ?></label>

			<div id="hustle-widget-toggle-wrapper" class="sui-toggle-content{{ ( _.isTrue( widget_enabled ) ) ? '' : ' sui-hidden' }}">
				<span class="sui-description"><?php printf( esc_html__( 'Enabling this will add a new widget named "Hustle" under the Available Widgets list. You can go to %1$sAppreance > %2$s%3$s and configure this widget to show your social bar in the sidebars.', Opt_In::TEXT_DOMAIN ), '<strong>', '<a href="">Widgets</a>', '</strong>' ); ?></span>
			</div>

		</div>

	</div>

</div>
