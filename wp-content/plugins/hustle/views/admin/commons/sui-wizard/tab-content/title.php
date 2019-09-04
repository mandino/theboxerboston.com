<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label"><?php esc_html_e( 'Title', Opt_In::TEXT_DOMAIN ); ?></span>
		<span class="sui-description"><?php printf( esc_html__( 'Add a title and a subtitle to your %s.', Opt_In::TEXT_DOMAIN ), esc_html( $smallcaps_singular ) ); ?></span>
	</div>

	<div class="sui-box-settings-col-2">

		<div class="sui-form-field">

			<label for="wph_<?php echo esc_attr( $module_type ); ?>_new_title" class="sui-label"><?php esc_html_e( 'Title (optional)', Opt_In::TEXT_DOMAIN ); ?></label>
			<input type="text"
				name="title"
				placeholder="<?php esc_html_e( "E.g. Weekly Newsletter", Opt_In::TEXT_DOMAIN ); ?>"
				value="{{ title }}"
				id="wph_<?php echo esc_attr( $module_type ); ?>_new_title"
				class="sui-form-control"
				data-attribute="title" />

		</div>

		<div class="sui-form-field">

			<label class="sui-label"><?php esc_html_e( 'Subtitle (optional)', Opt_In::TEXT_DOMAIN ); ?></label>
			<input type="text"
				name="sub_title"
				placeholder="<?php esc_html_e( "E.g. You don't want to miss this offer.", Opt_In::TEXT_DOMAIN ); ?>"
				value="{{ sub_title }}"
				data-attribute="sub_title"
				id="wph_<?php echo esc_attr( $module_type ); ?>_new_subtitle"
				class="sui-form-control" />

		</div>

	</div>

</div>
