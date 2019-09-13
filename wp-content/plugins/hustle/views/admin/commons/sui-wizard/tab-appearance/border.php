<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label"><?php esc_html_e( 'Border', 'wordpress-popup' ); ?></span>
		<span class="sui-description"><?php printf( esc_html__( 'This will add a customizable border to your %s.', 'wordpress-popup' ), esc_html( $smallcaps_singular ) ); ?></span>
	</div>

	<div class="sui-box-settings-col-2">

		<label for="hustle-module-border" class="sui-toggle">
			<input type="checkbox"
				name="border"
				data-attribute="border"
				id="hustle-module-border"
				{{ _.checked( _.isTrue( border ), true ) }} />
			<span class="sui-toggle-slider"></span>
		</label>

		<label for="hustle-module-border"><?php esc_html_e( 'Show border', 'wordpress-popup' ); ?></label>

		<div id="hustle-border-toggle-wrapper" class="sui-border-frame sui-toggle-content{{ ( _.isTrue( border ) ) ? '' : ' sui-hidden' }}">

			<div class="sui-row">

				<div class="sui-col-md-4">

					<div class="sui-form-field">

						<label for="hustle-module--border-radius" class="sui-label"><?php esc_html_e( 'Border radius', 'wordpress-popup' ); ?></label>

						<input type="number"
							value="{{ border_radius }}"
							data-attribute="border_radius"
							id="hustle-module--border-radius"
							class="sui-form-control" />

					</div>

				</div>

				<div class="sui-col-md-4">

					<div class="sui-form-field">

						<label for="hustle-module--border-weight" class="sui-label"><?php esc_html_e( 'Border weight', 'wordpress-popup' ); ?></label>

						<input type="number"
							value="{{ border_weight }}"
							data-attribute="border_weight"
							id="hustle-module--border-weight"
							class="sui-form-control" />

					</div>

				</div>

				<div class="sui-col-md-4">

					<div class="sui-form-field">

						<label for="hustle-module--border-type" class="sui-label"><?php esc_html_e( 'Border type', 'wordpress-popup' ); ?></label>

						<select id="hustle-module--border-type" data-attribute="border_type">
							<option value="solid" {{ ( 'solid' === border_type ) ? 'selected' : '' }} ><?php esc_attr_e( "Solid", 'wordpress-popup' ); ?></option>
							<option value="dotted" {{ ( 'dotted' === border_type ) ? 'selected' : '' }} ><?php esc_attr_e( "Dotted", 'wordpress-popup' ); ?></option>
							<option value="dashed" {{ ( 'dashed' === border_type ) ? 'selected' : '' }} ><?php esc_attr_e( "Dashed", 'wordpress-popup' ); ?></option>
							<option value="double" {{ ( 'double' === border_type ) ? 'selected' : '' }} ><?php esc_attr_e( "Double", 'wordpress-popup' ); ?></option>
							<option value="none" {{ ( 'none' === border_type ) ? 'selected' : '' }} ><?php esc_attr_e( "None", 'wordpress-popup' ); ?></option>
						</select>

					</div>

				</div>

			</div>

			<div class="sui-form-field">

				<label class="sui-label"><?php esc_html_e( 'Border color', 'wordpress-popup' ); ?></label>

				<?php Opt_In_Utils::sui_colorpicker( esc_attr( $module_type ) . '_modal_border', 'border_color', 'true' ); ?>

			</div>

		</div>

	</div>

</div>
