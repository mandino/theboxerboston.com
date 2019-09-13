<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label"><?php esc_html_e( 'Custom CSS', 'wordpress-popup' ); ?></span>
		<span class="sui-description"><?php esc_html_e( 'For more advanced customization options use custom CSS.', 'wordpress-popup' ); ?></span>
	</div>

	<div class="sui-box-settings-col-2">

		<label
			for="hustle-customize-css"
			class="sui-toggle"
		>
			<input
				type="checkbox"
				id="hustle-customize-css"
				data-attribute="customize_css"
				{{ _.checked( ( _.isTrue( customize_css ) ), true ) }}
			/>
			<span class="sui-toggle-slider" aria-hidden="true"></span>
		</label>

		<label for="hustle-customize-css"><?php esc_html_e( 'Enable custom CSS', 'wordpress-popup' ); ?></label>

		<div id="hustle-customize-css-toggle-wrapper" class="sui-background-frame {{ _.class( _.isFalse( customize_css ), 'sui-hidden' ) }}">

			<label class="sui-label"><?php esc_html_e( 'Modal selectors', 'wordpress-popup' ); ?></label>

			<div class="sui-ace-selectors">

				<# _.each( modalSelectors, function( name, stylable ) { #>
					<a href="#" class="sui-selector hustle-css-stylable" data-stylable="{{ stylable }}" >{{ name }}</a>
				<# }); #>

			</div>

			<?php if ( $is_optin ) { ?>

				<label class="sui-label"><?php esc_html_e( 'Form selectors', 'wordpress-popup' ); ?></label>

				<div class="sui-ace-selectors">

					<# _.each( formSelectors, function( name, stylable ) { #>
						<a href="#" class="sui-selector hustle-css-stylable" data-stylable="{{ stylable }}" >{{ name }}</a>
					<# }); #>

				</div>

				<label class="sui-label"><?php esc_html_e( 'Form options selectors', 'wordpress-popup' ); ?></label>
				<label class="sui-label" style="font-weight: 400;"><?php esc_html_e( 'These are added through "Integrations" like MailChimp that allow extra fields for users to select custom information requested.', 'wordpress-popup' ); ?></label>

				<div class="sui-ace-selectors">

					<# _.each( formExtraSelectors, function( name, stylable ) { #>
						<a href="#" class="sui-selector hustle-css-stylable" data-stylable="{{ stylable }}" >{{ name }}</a>
					<# }); #>

				</div>

			<?php } ?>

			<div id="hustle_custom_css" style="height: 210px;">{{ custom_css }}</div>

		</div>

	</div>

</div>
