<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label"><?php esc_html_e( 'Modules', Opt_In::TEXT_DOMAIN ); ?></span>
		<span class="sui-description"><?php esc_html_e( 'Select the Hustle modules for which the selected User Roles will see analytics in their WordPress Admin area.', Opt_In::TEXT_DOMAIN ); ?></span>
	</div>

	<div class="sui-box-settings-col-2">
	
		<?php
		$checkboxes = array(
			'overall'        => __( 'Overall Analytics', Opt_In::TEXT_DOMAIN ),
			'popup'          => __( 'Pop-ups', Opt_In::TEXT_DOMAIN ),
			'slidein'        => __( 'Slide-ins', Opt_In::TEXT_DOMAIN ),
			'embedded'       => __( 'Embeds', Opt_In::TEXT_DOMAIN ),
			'social_sharing' => __( 'Social Share', Opt_In::TEXT_DOMAIN ),
		);

		foreach ( $checkboxes as $value => $label ) { ?>
			<label class="sui-checkbox sui-checkbox-stacked">
				<input type="checkbox" value="<?php echo esc_attr( $value ); ?>" name="modules[]" <?php echo in_array( $value, $values ) ? ' checked="checked"':''; ?> />
				<span></span>
				<span class="sui-description"><?php echo esc_html( $label ); ?></span>
			</label>
		<?php } ?>

	</div>

</div>
