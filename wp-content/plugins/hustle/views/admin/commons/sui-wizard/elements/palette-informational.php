<?php
$palette_info = array(
	'basic'      => array(
		'group_name' => esc_html__( 'Basic', Opt_In::TEXT_DOMAIN ),
		'colors'     => array(
			'main_background'  => array(
				'name'  => esc_html__( 'Main background', Opt_In::TEXT_DOMAIN ),
				'value' => 'main_bg_color',
				'alpha' => 'false',
			),
			'image_background' => array(
				'name'  => esc_html__( 'Image container BG', Opt_In::TEXT_DOMAIN ),
				'value' => 'image_container_bg',
				'alpha' => 'false',
			),
		),
	),
	'content'    => array(
		'group_name'   => esc_html__( 'Content', Opt_In::TEXT_DOMAIN ),
		'group_states' => array(
			'default' => array(
				'name'    => esc_html__( 'Default', Opt_In::TEXT_DOMAIN ),
				'current' => true,
				'colors'  => array(
					'module_title_color'    => array(
						'name'  => esc_html__( 'Title color', Opt_In::TEXT_DOMAIN ),
						'value' => 'title_color_alt',
						'alpha' => 'false',
					),
					'module_subtitle_color' => array(
						'name'  => esc_html__( 'Subtitle color', Opt_In::TEXT_DOMAIN ),
						'value' => 'subtitle_color_alt',
						'alpha' => 'false',
					),
					'module_content_color'  => array(
						'name'  => esc_html__( 'Content color', Opt_In::TEXT_DOMAIN ),
						'value' => 'content_color',
						'alpha' => 'false',
					),
					'module_ol_counter'     => array(
						'name'  => esc_html__( 'OL counter', Opt_In::TEXT_DOMAIN ),
						'value' => 'ol_counter',
						'alpha' => 'false',
					),
					'module_ul_bullets'     => array(
						'name'  => esc_html__( 'UL bullets', Opt_In::TEXT_DOMAIN ),
						'value' => 'ul_bullets',
						'alpha' => 'false',
					),
					'module_link_color'     => array(
						'name'  => esc_html__( 'Link color', Opt_In::TEXT_DOMAIN ),
						'value' => 'link_static_color',
						'alpha' => 'false',
					),
				)
			),
			'hover'   => array(
				'name'    => esc_html__( 'Hover', Opt_In::TEXT_DOMAIN ),
				'current' => false,
				'colors'  => array(
					'popup_link_color_hover' => array(
						'name'  => esc_html__( 'Link color', Opt_In::TEXT_DOMAIN ),
						'value' => 'link_hover_color',
						'alpha' => 'false',
					)
				)
			),
			'active'  => array(
				'name'    => esc_html__( 'Focus', Opt_In::TEXT_DOMAIN ),
				'current' => false,
				'colors'  => array(
					'popup_link_color_focus' => array(
						'name'  => esc_html__( 'Link color', Opt_In::TEXT_DOMAIN ),
						'value' => 'link_active_color',
						'alpha' => 'false',
					)
				)
			),
		),
	),
	'cta'        => array(
		'group_name'   => esc_html__( 'Call To Action', Opt_In::TEXT_DOMAIN ),
		'group_states' => array(
			'default' => array(
				'name'    => esc_html__( 'Default', Opt_In::TEXT_DOMAIN ),
				'current' => true,
				'colors'  => array(
					'cta_button_background' => array(
						'name'  => esc_html__( 'Background color', Opt_In::TEXT_DOMAIN ),
						'value' => 'cta_button_static_bg',
						'alpha' => 'true',
					),
					'cta_button_label'      => array(
						'name'  => esc_html__( 'Label color', Opt_In::TEXT_DOMAIN ),
						'value' => 'cta_button_static_color',
						'alpha' => 'false',
					),
				),
			),
			'hover'   => array(
				'name'    => esc_html__( 'Hover', Opt_In::TEXT_DOMAIN ),
				'current' => false,
				'colors'  => array(
					'cta_button_background_hover' => array(
						'name'  => esc_html__( 'Background color', Opt_In::TEXT_DOMAIN ),
						'value' => 'cta_button_hover_bg',
						'alpha' => 'true',
					),
					'cta_button_label_hover'      => array(
						'name'  => esc_html__( 'Label color', Opt_In::TEXT_DOMAIN ),
						'value' => 'cta_button_hover_color',
						'alpha' => 'false',
					),
				),
			),
			'active'  => array(
				'name'    => esc_html__( 'Active', Opt_In::TEXT_DOMAIN ),
				'current' => false,
				'colors'  => array(
					'cta_button_background_active' => array(
						'name'  => esc_html__( 'Background color', Opt_In::TEXT_DOMAIN ),
						'value' => 'cta_button_active_bg',
						'alpha' => 'true',
					),
					'cta_button_label_active'      => array(
						'name'  => esc_html__( 'Label color', Opt_In::TEXT_DOMAIN ),
						'value' => 'cta_button_active_color',
						'alpha' => 'false',
					),
				),
			),
		),
	),
	'additional' => array(
		'group_name'   => esc_html__( 'Additional Settings', Opt_In::TEXT_DOMAIN ),
	),
);

// Unset non existent elements for module types.
if ( Hustle_Module_Model::EMBEDDED_MODULE !== $module_type ) {

	$palette_info['additional']['group_states'] = array(
		'default' => array(
			'name'    => esc_html__( 'Default', Opt_In::TEXT_DOMAIN ),
			'current' => true,
			'colors'  => array(
				'close_button'  => array(
					'name'  => esc_html__( 'Close button', Opt_In::TEXT_DOMAIN ),
					'value' => 'close_button_static_color',
					'alpha' => 'true',
				),
				'nsa_link'      => array(
					'name'  => esc_html__( 'Never see link', Opt_In::TEXT_DOMAIN ),
					'value' => 'never_see_link_static',
					'alpha' => 'true',
				),
				'overlay_color' => array(
					'name'  => esc_html__( 'Pop-up mask', Opt_In::TEXT_DOMAIN ),
					'value' => 'overlay_bg',
					'alpha' => 'true',
				),
				'success_icon'  => array(
					'name'  => esc_html__( 'Success icon', Opt_In::TEXT_DOMAIN ),
					'value' => 'optin_success_tick_color',
					'alpha' => 'false',
				),
			),
		),
		'hover' => array(
			'name'    => esc_html__( 'Hover', Opt_In::TEXT_DOMAIN ),
			'current' => false,
			'colors'  => array(
				'close_button'  => array(
					'name'  => esc_html__( 'Close button', Opt_In::TEXT_DOMAIN ),
					'value' => 'close_button_hover_color',
					'alpha' => 'true',
				),
				'nsa_link'      => array(
					'name'  => esc_html__( 'Never see link', Opt_In::TEXT_DOMAIN ),
					'value' => 'never_see_link_hover',
					'alpha' => 'true',
				),
			),
		),
		'active' => array(
			'name'    => esc_html__( 'Active', Opt_In::TEXT_DOMAIN ),
			'current' => false,
			'colors'  => array(
				'close_button'  => array(
					'name'  => esc_html__( 'Close button', Opt_In::TEXT_DOMAIN ),
					'value' => 'close_button_active_color',
					'alpha' => 'true',
				),
				'nsa_link'      => array(
					'name'  => esc_html__( 'Never see link', Opt_In::TEXT_DOMAIN ),
					'value' => 'never_see_link_active',
					'alpha' => 'true',
				),
			),
		),
	);
	
	if ( Hustle_Module_Model::SLIDEIN_MODULE === $module_type ) {
		unset( $palette_info['additional']['group_states']['default']['colors']['overlay_color'] );
	}

} else { 

	$palette_info['additional']['colors'] = array(
		'success_icon'  => array(
			'name'  => esc_html__( 'Success icon', Opt_In::TEXT_DOMAIN ),
			'value' => 'optin_success_tick_color',
			'alpha' => 'false',
		),
	);
}
?>

<div id="hustle-color-palette" class="sui-form-field">

	<div class="sui-accordion">

		<?php foreach ( $palette_info as $group => $palette ) { ?>

			<div class="sui-accordion-item">

				<div class="sui-accordion-item-header">

					<div class="sui-accordion-item-title"><?php echo esc_attr( $palette['group_name'], Opt_In::TEXT_DOMAIN ); ?></div>

					<div class="sui-accordion-col-auto">
						<button class="sui-button-icon sui-accordion-open-indicator">
							<i class="sui-icon-chevron-down" aria-hidden="true"></i>
							<span class="sui-screen-reader-text"><?php esc_html_e( 'Edit colors', Opt_In::TEXT_DOMAIN ); ?></span>
						</button>
					</div>

				</div>

				<div class="sui-accordion-item-body">

					<div class="sui-box">

						<div class="sui-box-body">

							<?php if ( isset( $palette['group_states'] ) && 1 < count( $palette['group_states'] ) ) { ?>

								<div class="sui-tabs sui-tabs-flushed">

									<div data-tabs>

										<?php foreach ( $palette['group_states'] as $key_state => $state ) { ?>

											<div <?php if ( true === $state['current'] ) { echo ' class="active"'; } ?>><?php echo esc_attr( $state['name'] ); ?></div>

										<?php } ?>

									</div>

									<div data-panes>

										<?php foreach ( $palette['group_states'] as $key_state => $state ) { ?>

											<div <?php if ( true === $state['current'] ) { echo ' class="active"'; } ?>>

												<?php foreach ( $state['colors'] as $key_color => $color ) { ?>

													<div class="sui-form-field">

														<label class="sui-label"><?php echo esc_attr( $color['name'] ); ?></label>

														<?php Opt_In_Utils::sui_colorpicker( $key_color, $color['value'], $color['alpha'] ); ?>

													</div>

												<?php } ?>

											</div>

										<?php } ?>

									</div>

								</div>

							<?php } else { ?>

								<?php foreach ( $palette['colors'] as $key_color => $color ) { ?>

									<div class="sui-form-field">

										<label class="sui-label"><?php echo esc_attr( $color['name'] ); ?></label>

										<?php Opt_In_Utils::sui_colorpicker( $key_color, $color['value'], $color['alpha'] ); ?>

									</div>

								<?php } ?>

							<?php } ?>

						</div>

					</div>

				</div>

			</div>

		<?php } ?>

		<!-- Reset Button -->
		<div class="sui-accordion-footer">

			<div class="sui-accordion-col-12">

				<button class="sui-button sui-button-ghost hustle-reset-color-palette">
					<span class="sui-loading-text"><?php esc_attr_e( 'Reset', Opt_In::TEXT_DOMAIN ); ?></span>
					<i class="sui-icon-loader sui-loading" aria-hidden="true"></i></button>


			</div>

		</div>

	</div>

</div>
