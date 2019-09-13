<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label"><?php esc_html_e( 'Counter', 'wordpress-popup' ); ?></span>
		<span class="sui-description"><?php esc_html_e( 'Display the number of clicks or shares on the social plaforms.', 'wordpress-popup' ); ?></span>
	</div>

	<div class="sui-box-settings-col-2">

		<label class="sui-toggle">
			<input
				type="checkbox"
				name="counter_enabled"
				data-attribute="counter_enabled"
				id="hustle-settings--counter-enable"
				{{ _.checked( _.isTrue( counter_enabled ), true) }}
			/>
			<span class="sui-toggle-slider"></span>
		</label>

		<label for="hustle-settings--counter-enable"><?php esc_html_e( 'Enable counter', 'wordpress-popup' ); ?></label>

		<span class="sui-description sui-toggle-description"><?php esc_html_e( "You can either show the number of times a social icon has been clicked or retrieve the number of shares from each network's API when available.", 'wordpress-popup' ); ?></span>

	</div>

</div>
