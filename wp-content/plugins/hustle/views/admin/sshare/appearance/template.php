<div class="sui-box" <?php if ( 'appearance' !== $section ) echo 'style="display: none;"'; ?> data-tab="appearance">

	<div id="hustle-wizard-appearance" class="sui-box-body"></div>

	<div class="sui-box-footer">

		<button class="sui-button wpmudev-button-navigation" data-direction="prev">
			<i class="sui-icon-arrow-left" aria-hidden="true"></i> <?php esc_html_e( 'Display Options', Opt_In::TEXT_DOMAIN ); ?>
		</button>

		<div class="sui-actions-right">

			<button class="sui-button sui-button-icon-right wpmudev-button-navigation" data-direction="next">
				<?php esc_html_e( 'Visibility', Opt_In::TEXT_DOMAIN ); ?> <i class="sui-icon-arrow-right" aria-hidden="true"></i>
			</button>

		</div>

	</div>

</div>

<script id="hustle-wizard-appearance-tpl" type="text/template">

	<?php
		$is_widget_enabled = ! empty( $display_settings['inline_enabled'] )
				|| ! empty( $display_settings['widget_enabled'] )
				|| ! empty( $display_settings['shortcode_enabled'] );

		$is_floating_enabled = ! empty( $display_settings['float_desktop_enabled'] )
				|| ! empty( $display_settings['float_mobile_enabled'] );

		$social_types = array(
			'floating' => array(
				'label'            => esc_html__( 'Floating Social', Opt_In::TEXT_DOMAIN ),
				'description'      => esc_html__( 'Style the floating social module as per your liking.', Opt_In::TEXT_DOMAIN ),
				'is_enabled'       => $is_floating_enabled,
				'display_settings' => $display_settings,
			),
			'widget' => array(
				'label'            => esc_html__( 'Inline / Widget / Shortcode', Opt_In::TEXT_DOMAIN ),
				'description'      => esc_html__( 'Style the inline module, widget and shortcode as per your liking.', Opt_In::TEXT_DOMAIN ),
				'is_enabled'       => $is_widget_enabled,
				'display_settings' => $display_settings,
			),
		);
	?>

	<?php

		$is_empty = ( ! $is_floating_enabled && ! $is_widget_enabled );
		$this->render(
			'admin/sshare/appearance/tpl--empty-message',
			array( 'is_empty' => $is_empty )
		);


		$this->render(
			'admin/sshare/appearance/tpl--icons-style',
			array( 'is_empty' => $is_empty )
		);

		foreach( $social_types as $skey => $social ) {

			$this->render(
				'admin/sshare/appearance/tpl--icons-appearance',
				array(
					'key'         => $skey,
					'label'       => $social['label'],
					'description' => $social['description'],
					'preview'     => 'floating' === $skey ? 'sidenav' : 'content',
					'module' 	  => $module,
					'is_enabled'  => $social['is_enabled'],
				)
			);
		}
	?>

</script>
