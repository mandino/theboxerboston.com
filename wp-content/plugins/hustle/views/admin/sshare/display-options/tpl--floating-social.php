<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">

		<span class="sui-settings-label"><?php esc_html_e( 'Floating Social', 'wordpress-popup' ); ?></span>

		<span class="sui-description"><?php esc_html_e( 'Add a floating social bar to your website and also customize its location.', 'wordpress-popup' ); ?></span>

	</div>

	<div class="sui-box-settings-col-2">

		<?php
		// SETTINGS: Enable on desktop
		self::static_render(
			'admin/sshare/display-options/tpl--position-settings',
			array(
				'label'       => esc_html__( 'on desktop', 'wordpress-popup' ),
				'description' => esc_html__( 'Enabling this will add a floating social bar to your website when visitors are  on a desktop.', 'wordpress-popup' ),
				'prefix'      => 'float_desktop',
				'positions'   => array(
					'left' => array(
						'label'   => esc_html__( 'Left', 'wordpress-popup' ),
						'image1x' => 'social-position/float-desktop-left.png',
						'image2x' => 'social-position/float-desktop-left@2x.png',
					),
					'right' => array(
						'label'   => esc_html__( 'Right', 'wordpress-popup' ),
						'image1x' => 'social-position/float-desktop-right.png',
						'image2x' => 'social-position/float-desktop-right@2x.png',
					),
					'center' => array(
						'label'   => esc_html__( 'Centered', 'wordpress-popup' ),
						'image1x' => 'social-position/float-desktop-center.png',
						'image2x' => 'social-position/float-desktop-center@2x.png',
					)
				),
				'display_settings' => $display_settings,
				'offset_x'    => true,
				'offset_y'    => true
			)
		); ?>

		<?php
		// SETTINGS: Enable on mobile
		self::static_render(
			'admin/sshare/display-options/tpl--position-settings',
			array(
				'label'       => esc_html__( 'on mobile', 'wordpress-popup' ),
				'description' => esc_html__( 'Enabling this will add a floating social bar to your website when visitors are  on a mobile device.', 'wordpress-popup' ),
				'prefix'      => 'float_mobile',
				'positions'   => array(
					'left' => array(
						'label'   => esc_html__( 'Left', 'wordpress-popup' ),
						'image1x' => 'social-position/float-mobile-left.png',
						'image2x' => 'social-position/float-mobile-left@2x.png',
					),
					'right' => array(
						'label'   => esc_html__( 'Right', 'wordpress-popup' ),
						'image1x' => 'social-position/float-mobile-right.png',
						'image2x' => 'social-position/float-mobile-right@2x.png',
					),
					'center' => array(
						'label'   => esc_html__( 'Centered', 'wordpress-popup' ),
						'image1x' => 'social-position/float-mobile-center.png',
						'image2x' => 'social-position/float-mobile-center@2x.png',
					)
				),
				'display_settings' => $display_settings,
				'offset_x'    => true,
				'offset_y'    => true
			)
		); ?>

	</div>

</div>
