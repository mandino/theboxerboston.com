<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">

		<span class="sui-settings-label"><?php esc_html_e( 'Inline Content', Opt_In::TEXT_DOMAIN ); ?></span>

		<span class="sui-description"><?php esc_html_e( 'Add a social bar inline to your website’s posts and pages.', Opt_In::TEXT_DOMAIN ); ?></span>

	</div>

	<div class="sui-box-settings-col-2">

		<?php
		// SETTINGS: Enable inline module
		$this->render(
			'admin/sshare/display-options/tpl--position-settings',
			array(
				'label'       => esc_html__( 'inline module', Opt_In::TEXT_DOMAIN ),
				'description' => esc_html__( "By enabling this you can add a social bar above, below or both above and below of your website's posts, pages etc.", Opt_In::TEXT_DOMAIN ),
				'prefix'      => 'inline',
				'positions'   => array(
					'below' => array(
						'label'   => esc_html__( 'Below', Opt_In::TEXT_DOMAIN ),
						'image1x' => 'social-position/inline-below.png',
						'image2x' => 'social-position/inline-below@2x.png',
					),
					'above' => array(
						'label'   => esc_html__( 'Above', Opt_In::TEXT_DOMAIN ),
						'image1x' => 'social-position/inline-above.png',
						'image2x' => 'social-position/inline-above@2x.png',
					),
					'both' => array(
						'label'   => esc_html__( 'Both', Opt_In::TEXT_DOMAIN ),
						'image1x' => 'social-position/inline-both.png',
						'image2x' => 'social-position/inline-both@2x.png',
					)
				),
				'display_settings' => $display_settings,
				'alignment'   => true
			)
		); ?>

	</div>

</div>
