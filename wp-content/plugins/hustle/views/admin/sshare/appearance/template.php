<div class="sui-box" <?php if ( 'appearance' !== $section ) echo 'style="display: none;"'; ?> data-tab="appearance">

	<div class="sui-box-header">

		<h2 class="sui-box-title"><?php esc_html_e( 'Appearance', 'wordpress-popup' ); ?></h2>

	</div>

	<div id="hustle-wizard-appearance" class="sui-box-body"></div>

	<div class="sui-box-footer">

		<button class="sui-button wpmudev-button-navigation" data-direction="prev">
			<i class="sui-icon-arrow-left" aria-hidden="true"></i> <?php esc_html_e( 'Display Options', 'wordpress-popup' ); ?>
		</button>

		<div class="sui-actions-right">

			<button class="sui-button sui-button-icon-right wpmudev-button-navigation" data-direction="next">
				<?php esc_html_e( 'Visibility', 'wordpress-popup' ); ?> <i class="sui-icon-arrow-right" aria-hidden="true"></i>
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

		$is_empty = ( ! $is_floating_enabled && ! $is_widget_enabled );

		$social_types = array(
			'floating' => array(
				'label'            => esc_html__( 'Floating Social', 'wordpress-popup' ),
				'description'      => esc_html__( 'Style the floating social module as per your liking.', 'wordpress-popup' ),
				'is_empty' 		   => $is_empty,
				'is_enabled'       => $is_floating_enabled,
				'display_settings' => $display_settings,
				'disabled_message' => esc_html__( 'Floating Social is disabled, enable it from the "Display Options".', 'wordpress-popup' ),
			),
			'widget' => array(
				'label'            => esc_html__( 'Inline / Widget / Shortcode', 'wordpress-popup' ),
				'description'      => esc_html__( 'Style the inline module, widget and shortcode as per your liking.', 'wordpress-popup' ),
				'is_empty' 		   => $is_empty,
				'is_enabled'       => $is_widget_enabled,
				'display_settings' => $display_settings,
				'disabled_message' => esc_html__( 'Inline module, widget and shortcode is disabled, enable them from the "Display Options".', 'wordpress-popup' ),
			),
		);
	?>

	<?php

		self::static_render(
			'admin/sshare/appearance/tpl--empty-message',
			array( 'is_empty' => $is_empty )
		);


		self::static_render(
			'admin/sshare/appearance/tpl--icons-style',
			array( 'is_empty' => $is_empty )
		);

		foreach( $social_types as $skey => $social ) {

			self::static_render(
				'admin/sshare/appearance/tpl--icons-appearance',
				array(
					'key'         		  => $skey,
					'label'       		  => $social['label'],
					'description' 		  => $social['description'],
					'preview'     		  => 'floating' === $skey ? 'sidenav' : 'content',
					'module' 	  		  => $module,
					'is_enabled'  		  => $social['is_enabled'],
					'is_empty'    		  => $social['is_empty'],
					'disabled_message'	  => $social['disabled_message'],
					'content_settings'    => $content_settings,
					'appearance_settings' => $appearance_settings,
				)
			);
		}
	?>

</script>
