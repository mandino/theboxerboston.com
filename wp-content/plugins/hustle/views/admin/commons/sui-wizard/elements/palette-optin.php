<?php
$palette_optin = array(
	'basic'      => array(
		'group_name'   => esc_html__( 'Basic', Opt_In::TEXT_DOMAIN ),
		'colors'  => array(
			'popup_main_background' => array(
				'name'  => esc_html__( 'Main background', Opt_In::TEXT_DOMAIN ),
				'value' => 'main_bg_color',
				'alpha' => 'false',
			),
			'popup_image_background' => array(
				'name'  => esc_html__( 'Image container BG', Opt_In::TEXT_DOMAIN ),
				'value' => 'image_container_bg',
				'alpha' => 'true',
			),
			'popup_form_background' => array(
				'name'  => esc_html__( 'Form area background', Opt_In::TEXT_DOMAIN ),
				'value' => 'form_area_bg',
				'alpha' => 'true',
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
					'popup_title_color'    => array(
						'name'  => esc_html__( 'Title color', Opt_In::TEXT_DOMAIN ),
						'value' => 'title_color',
						'alpha' => 'false',
					),
					'popup_subtitle_color' => array(
						'name'  => esc_html__( 'Subtitle color', Opt_In::TEXT_DOMAIN ),
						'value' => 'subtitle_color',
						'alpha' => 'false',
					),
					'popup_content_color'  => array(
						'name'  => esc_html__( 'Content color', Opt_In::TEXT_DOMAIN ),
						'value' => 'content_color',
						'alpha' => 'false',
					),
					'popup_ol_counter'     => array(
						'name'  => esc_html__( 'OL counter', Opt_In::TEXT_DOMAIN ),
						'value' => 'ol_counter',
						'alpha' => 'false',
					),
					'popup_ul_bullets'     => array(
						'name'  => esc_html__( 'UL bullets', Opt_In::TEXT_DOMAIN ),
						'value' => 'ul_bullets',
						'alpha' => 'false',
					),
					'popup_blockquote'     => array(
						'name'  => esc_html__( 'Blockquote border', Opt_In::TEXT_DOMAIN ),
						'value' => 'blockquote_border',
						'alpha' => 'false',
					),
					'popup_link_color'     => array(
						'name'  => esc_html__( 'Link color', Opt_In::TEXT_DOMAIN ),
						'value' => 'link_static_color',
						'alpha' => 'false',
					),
				),
			),
			'hover'   => array(
				'name'    => esc_html__( 'Hover', Opt_In::TEXT_DOMAIN ),
				'current' => false,
				'colors'  => array(
					'popup_link_color_hover' => array(
						'name'  => esc_html__( 'Link color', Opt_In::TEXT_DOMAIN ),
						'value' => 'link_hover_color',
						'alpha' => 'false',
					),
				),
			),
			'active'  => array(
				'name'    => esc_html__( 'Active', Opt_In::TEXT_DOMAIN ),
				'current' => false,
				'colors'  => array(
					'popup_link_color_focus' => array(
						'name'  => esc_html__( 'Link color', Opt_In::TEXT_DOMAIN ),
						'value' => 'link_active_color',
						'alpha' => 'false',
					),
				),
			),
		)
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
	'inputs'     => array(
		'group_name'   => esc_html__( 'Inputs', Opt_In::TEXT_DOMAIN ),
		'group_states' => array(
			'default' => array(
				'name'    => esc_html__( 'Default', Opt_In::TEXT_DOMAIN ),
				'current' => true,
				'colors'  => array(
					'popup_field_icon'        => array(
						'name'  => esc_html__( 'Icon color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_input_icon',
						'alpha' => 'true',
					),
					'popup_field_border'      => array(
						'name'  => esc_html__( 'Border color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_input_static_bo',
						'alpha' => 'true',
					),
					'popup_field_background'  => array(
						'name'  => esc_html__( 'Background color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_input_static_bg',
						'alpha' => 'true',
					),
					'popup_field_color'       => array(
						'name'  => esc_html__( 'Text color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_form_field_text_static_color',
						'alpha' => 'false',
					),
					'popup_placeholder_color' => array(
						'name'  => esc_html__( 'Placeholder', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_placeholder_color',
						'alpha' => 'false',
					),
				)
			),
			'hover'   => array(
				'name'    => esc_html__( 'Hover', Opt_In::TEXT_DOMAIN ),
				'current' => false,
				'colors'  => array(
					'popup_field_icon_hover'       => array(
						'name'  => esc_html__( 'Icon color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_input_icon_hover',
						'alpha' => 'true',
					),
					'popup_field_border_hover'     => array(
						'name'  => esc_html__( 'Border color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_input_hover_bo',
						'alpha' => 'true',
					),
					'popup_field_background_hover' => array(
						'name'  => esc_html__( 'Background color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_input_hover_bg',
						'alpha' => 'true',
					),
				)
			),
			'focus'   => array(
				'name'    => esc_html__( 'Focus', Opt_In::TEXT_DOMAIN ),
				'current' => false,
				'colors'  => array(
					'popup_field_icon_focus'       => array(
						'name'  => esc_html__( 'Icon color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_input_icon_focus',
						'alpha' => 'true',
					),
					'popup_field_border_focus'     => array(
						'name'  => esc_html__( 'Border color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_input_active_bo',
						'alpha' => 'true',
					),
					'popup_field_background_focus' => array(
						'name'  => esc_html__( 'Background color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_input_active_bg',
						'alpha' => 'true',
					),
				)
			),
			'error'   => array(
				'name'    => esc_html__( 'Error', Opt_In::TEXT_DOMAIN ),
				'current' => false,
				'colors'  => array(
					'popup_field_icon_error'       => array(
						'name'  => esc_html__( 'Icon color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_input_icon_error',
						'alpha' => 'true',
					),
					'popup_field_border_error'     => array(
						'name'  => esc_html__( 'Border color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_input_error_border',
						'alpha' => 'true',
					),
					'popup_field_background_error' => array(
						'name'  => esc_html__( 'Background color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_input_error_background',
						'alpha' => 'true'
					),
				)
			),
		),
	),
	'checkbox'   => array(
		'group_name'   => esc_html__( 'Radio and Checkbox', Opt_In::TEXT_DOMAIN ),
		'group_states' => array(
			'default' => array(
				'name'    => esc_html__( 'Default', Opt_In::TEXT_DOMAIN ),
				'current' => true,
				'colors'  => array(
					'checkbox_border'     => array(
						'name'  => esc_html__( 'Border color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_check_radio_bo',
						'alpha' => 'true',
					),
					'checkbox_background' => array(
						'name'  => esc_html__( 'Background color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_check_radio_bg',
						'alpha' => 'true',
					),
					'checkbox_label'      => array(
						'name'  => esc_html__( 'Label color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_mailchimp_labels_color',
						'alpha' => 'false',
					),
				),
			),
			'checked' => array(
				'name'    => esc_html__( 'Checked', Opt_In::TEXT_DOMAIN ),
				'current' => false,
				'colors'  => array(
					'checkbox_border_checked'     => array(
						'name'  => esc_html__( 'Border color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_check_radio_bo_checked',
						'alpha' => 'true',
					),
					'checkbox_background_checked' => array(
						'name'  => esc_html__( 'Background color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_check_radio_bg_checked',
						'alpha' => 'true',
					),
					'checkbox_icon'               => array(
						'name'  => esc_html__( 'Icon color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_check_radio_tick_color',
						'alpha' => 'false',
					),
				),
			),
		),
	),
	'gdpr'       => array(
		'group_name'   => esc_html__( 'GDPR Checkbox', Opt_In::TEXT_DOMAIN ),
		'group_states' => array(
			'default' => array(
				'name'    => esc_html__( 'Default', Opt_In::TEXT_DOMAIN ),
				'current' => true,
				'colors'  => array(
					'gdpr_border'     => array(
						'name'  => esc_html__( 'Border color', Opt_In::TEXT_DOMAIN ),
						'value' => 'gdpr_chechbox_border_static',
						'alpha' => 'true',
					),
					'gdpr_background' => array(
						'name'  => esc_html__( 'Background color', Opt_In::TEXT_DOMAIN ),
						'value' => 'gdpr_chechbox_background_static',
						'alpha' => 'true',
					),
					'gdpr_label'      => array(
						'name'  => esc_html__( 'Label color', Opt_In::TEXT_DOMAIN ),
						'value' => 'gdpr_content',
						'alpha' => 'false',
					),
					'gdpr_label_link' => array(
						'name'  => esc_html__( 'Label link color', Opt_In::TEXT_DOMAIN ),
						'value' => 'gdpr_content_link',
						'alpha' => 'false',
					),
				),
			),
			'checked' => array(
				'name'    => esc_html__( 'Checked', Opt_In::TEXT_DOMAIN ),
				'current' => false,
				'colors'  => array(
					'gdpr_border_checked'     => array(
						'name'  => esc_html__( 'Border color', Opt_In::TEXT_DOMAIN ),
						'value' => 'gdpr_chechbox_border_active',
						'alpha' => 'true',
					),
					'gdpr_background_checked' => array(
						'name'  => esc_html__( 'Background color', Opt_In::TEXT_DOMAIN ),
						'value' => 'gdpr_checkbox_background_active',
						'alpha' => 'true',
					),
					'gdpr_icon'               => array(
						'name'  => esc_html__( 'Icon color', Opt_In::TEXT_DOMAIN ),
						'value' => 'gdpr_checkbox_icon',
						'alpha' => 'false',
					),
				),
			),
			'error'   => array(
				'name'    => esc_html__( 'Error', Opt_In::TEXT_DOMAIN ),
				'current' => false,
				'colors'  => array(
					'gdpr_border_error'     => array(
						'name'  => esc_html__( 'Border color', Opt_In::TEXT_DOMAIN ),
						'value' => 'gdpr_checkbox_border_error',
						'alpha' => 'true',
					),
					'gdpr_background_error' => array(
						'name'  => esc_html__( 'Background color', Opt_In::TEXT_DOMAIN ),
						'value' => 'gdpr_checkbox_background_error',
						'alpha' => 'true',
					),
				),
			),
		),
	),
	'select'     => array(
		'group_name'   => esc_html__( 'Select', Opt_In::TEXT_DOMAIN ),
		'group_states' => array(
			'default' => array(
				'name'    => esc_html__( 'Default', Opt_In::TEXT_DOMAIN ),
				'current' => true,
				'colors'  => array(
					'select_border'      => array(
						'name'  => esc_html__( 'Border color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_select_border',
						'alpha' => 'true',
					),
					'select_background'  => array(
						'name'  => esc_html__( 'Background color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_select_background',
						'alpha' => 'true',
					),
					'select_icon'        => array(
						'name'  => esc_html__( 'Icon color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_select_icon',
						'alpha' => 'true',
					),
					'select_label'       => array(
						'name'  => esc_html__( 'Label color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_select_label',
						'alpha' => 'false',
					),
					'select_placeholder' => array(
						'name'  => esc_html__( 'Placeholder', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_select_placeholder',
						'alpha' => 'true',
					),
				),
			),
			'hover'   => array(
				'name'    => esc_html__( 'Hover', Opt_In::TEXT_DOMAIN ),
				'current' => false,
				'colors'  => array(
					'select_border_hover'     => array(
						'name'  => esc_html__( 'Border color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_select_border_hover',
						'alpha' => 'true',
					),
					'select_background_hover' => array(
						'name'  => esc_html__( 'Background color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_select_background_hover',
						'alpha' => 'true',
					),
					'select_icon_hover'       => array(
						'name'  => esc_html__( 'Icon color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_select_icon_hover',
						'alpha' => 'true',
					),
				),
			),
			'open'    => array(
				'name'    => esc_html__( 'Open', Opt_In::TEXT_DOMAIN ),
				'current' => false,
				'colors'  => array(
					'select_border_open'     => array(
						'name'  => esc_html__( 'Border color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_select_border_open',
						'alpha' => 'true',
					),
					'select_background_open' => array(
						'name'  => esc_html__( 'Background color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_select_background_open',
						'alpha' => 'true',
					),
					'select_icon_open'       => array(
						'name'  => esc_html__( 'Icon color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_select_icon_open',
						'alpha' => 'true',
					),
				),
			),
			'error'   => array(
				'name'    => esc_html__( 'Error', Opt_In::TEXT_DOMAIN ),
				'current' => false,
				'colors'  => array(
					'select_background_error' => array(
						'name'  => esc_html__( 'Border color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_select_border_error',
						'alpha' => 'true',
					),
					'select_background_error' => array(
						'name'  => esc_html__( 'Background color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_select_background_error',
						'alpha' => 'true',
					),
					'select_icon_error'       => array(
						'name'  => esc_html__( 'Icon color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_select_icon_error',
						'alpha' => 'true',
					),
				),
			),
		),
	),
	'dropdown'   => array(
		'group_name'   => esc_html__( 'Dropdown', Opt_In::TEXT_DOMAIN ),
		'group_states' => array(
			'default'  => array(
				'name'    => esc_html__( 'Default', Opt_In::TEXT_DOMAIN ),
				'current' => true,
				'colors'  => array(
					'dropdown_background'   => array(
						'name'  => esc_html__( 'Container BG', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_dropdown_background',
						'alpha' => 'false',
					),
					'dropdown_option_color' => array(
						'name'  => esc_html__( 'Label color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_dropdown_option_color',
						'alpha' => 'false',
					),
				),
			),
			'hover'    => array(
				'name'    => esc_html__( 'Hover', Opt_In::TEXT_DOMAIN ),
				'current' => false,
				'colors'  => array(
					'dropdown_option_bg_hover'    => array(
						'name'  => esc_html__( 'Label background', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_dropdown_option_bg_hover',
						'alpha' => 'true',
					),
					'dropdown_option_color_hover' => array(
						'name'  => esc_html__( 'Label color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_dropdown_option_color_hover',
						'alpha' => 'false',
					),
				),
			),
			'selected' => array(
				'name'    => esc_html__( 'Selected', Opt_In::TEXT_DOMAIN ),
				'current' => false,
				'colors'  => array(
					'dropdown_option_bg_active'    => array(
						'name'  => esc_html__( 'Label background', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_dropdown_option_bg_active',
						'alpha' => 'true',
					),
					'dropdown_option_color_active' => array(
						'name'  => esc_html__( 'Label color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_dropdown_option_color_active',
						'alpha' => 'false',
					),
				),
			),
		),
	),
	'calendar'   => array(
		'group_name'   => esc_html__( 'Calendar', Opt_In::TEXT_DOMAIN ),
		'group_states' => array(
			'default' => array(
				'name'    => esc_html__( 'Default', Opt_In::TEXT_DOMAIN ),
				'current' => true,
				'colors'  => array(
					'calendar_background'       => array(
						'name'  => esc_html__( 'Container background', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_calendar_background',
						'alpha' => 'false',
					),
					'optin_calendar_title'      => array(
						'name'  => esc_html__( 'Title color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_calendar_title',
						'alpha' => 'false',
					),
					'optin_calendar_arrows'     => array(
						'name'  => esc_html__( 'Navigation arrows', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_calendar_arrows',
						'alpha' => 'true',
					),
					'optin_calendar_thead'      => array(
						'name'  => esc_html__( 'Table head color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_calendar_thead',
						'alpha' => 'false',
					),
					'optin_calendar_cell_bg'    => array(
						'name'  => esc_html__( 'Table cell background', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_calendar_cell_background',
						'alpha' => 'true',
					),
					'optin_calendar_cell_color' => array(
						'name'  => esc_html__( 'Table cell color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_calendar_cell_color',
						'alpha' => 'true',
					),
				),
			),
			'hover'   => array(
				'name'    => esc_html__( 'Hover', Opt_In::TEXT_DOMAIN ),
				'current' => false,
				'colors'  => array(
					'optin_calendar_arrows_hover'  => array(
						'name'  => esc_html__( 'Navigation arrows', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_calendar_arrows_hover',
						'alpha' => 'true',
					),
					'optin_calendar_cell_bg_hover' => array(
						'name'  => esc_html__( 'Table cell background', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_calendar_cell_bg_hover',
						'alpha' => 'true',
					),
					'optin_calendar_cell_color' => array(
						'name'  => esc_html__( 'Table cell color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_calendar_cell_color_hover',
						'alpha' => 'true',
					),
				),
			),
			'active'  => array(
				'name'    => esc_html__( 'Active', Opt_In::TEXT_DOMAIN ),
				'current' => false,
				'colors'  => array(
					'optin_calendar_arrows_active'     => array(
						'name'  => esc_html__( 'Navigation arrows', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_calendar_arrows_active',
						'alpha' => 'true',
					),
					'optin_calendar_cell_bg_active'    => array(
						'name'  => esc_html__( 'Table cell background', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_calendar_cell_bg_active',
						'alpha' => 'true',
					),
					'optin_calendar_cell_color_active' => array(
						'name'  => esc_html__( 'Table cell color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_calendar_cell_color_active',
						'alpha' => 'true',
					),
				),
			),
		),
	),
	'submit'     => array(
		'group_name'   => esc_html__( 'Submit Button', Opt_In::TEXT_DOMAIN ),
		'group_states' => array(
			'default' => array(
				'name'    => esc_html__( 'Default', Opt_In::TEXT_DOMAIN ),
				'current' => true,
				'colors'  => array(
					'submit_border'     => array(
						'name'  => esc_html__( 'Border color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_submit_button_static_bo',
						'alpha' => 'true',
					),
					'submit_background' => array(
						'name'  => esc_html__( 'Background color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_submit_button_static_bg',
						'alpha' => 'true',
					),
					'submit_label'      => array(
						'name'  => esc_html__( 'Label color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_submit_button_static_color',
						'alpha' => 'false',
					),
				),
			),
			'hover'   => array(
				'name'    => esc_html__( 'Hover', Opt_In::TEXT_DOMAIN ),
				'current' => false,
				'colors'  => array(
					'submit_border_hover'     => array(
						'name'  => esc_html__( 'Border color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_submit_button_hover_bo',
						'alpha' => 'true',
					),
					'submit_background_hover' => array(
						'name'  => esc_html__( 'Background color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_submit_button_hover_bg',
						'alpha' => 'true',
					),
					'submit_label_hover'      => array(
						'name'  => esc_html__( 'Label color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_submit_button_hover_color',
						'alpha' => 'false',
					),
				),
			),
			'active'  => array(
				'name'    => esc_html__( 'Active', Opt_In::TEXT_DOMAIN ),
				'current' => false,
				'colors'  => array(
					'submit_border_active'     => array(
						'name'  => esc_html__( 'Border color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_submit_button_active_bo',
						'alpha' => 'true',
					),
					'submit_background_active' => array(
						'name'  => esc_html__( 'Background color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_submit_button_active_bg',
						'alpha' => 'true',
					),
					'submit_label_active'      => array(
						'name'  => esc_html__( 'Label color', Opt_In::TEXT_DOMAIN ),
						'value' => 'optin_submit_button_active_color',
						'alpha' => 'false',
					),
				),
			)
		),
	),
	'options'    => array(
		'group_name' => esc_html__( 'Form Options', Opt_In::TEXT_DOMAIN ),
		'colors'     => array(
			'form_options_title'      => array(
				'name'  => esc_html__( 'Title color', Opt_In::TEXT_DOMAIN ),
				'value' => 'optin_mailchimp_title_color',
				'alpha' => 'false',
			),
			'form_options_background' => array(
				'name'  => esc_html__( 'Container background', Opt_In::TEXT_DOMAIN ),
				'value' => 'custom_section_bg',
				'alpha' => 'true',
			),
		),
	),
	'error'      => array(
		'group_name' => esc_html__( 'Error Message', Opt_In::TEXT_DOMAIN ),
		'colors'     => array(
			'error_message_border'     => array(
				'name'  => esc_html__( 'Border color', Opt_In::TEXT_DOMAIN ),
				'value' => 'optin_error_text_border',
				'alpha' => 'true',
			),
			'error_message_background' => array(
				'name'  => esc_html__( 'Background color', Opt_In::TEXT_DOMAIN ),
				'value' => 'optin_error_text_bg',
				'alpha' => 'true',
			),
			'error_message_label'      => array(
				'name'  => esc_html__( 'Message color', Opt_In::TEXT_DOMAIN ),
				'value' => 'optin_error_text_color',
				'alpha' => 'false',
			),
		),
	),
	'success'    => array(
		'group_name' => esc_html__( 'Success Message', Opt_In::TEXT_DOMAIN ),
		'colors'     => array(
			'success_icon'  => array(
				'name'  => esc_html__( 'Icon color', Opt_In::TEXT_DOMAIN ),
				'value' => 'optin_success_tick_color',
				'alpha' => 'false',
			),
			'success_color' => array(
				'name'  => esc_html__( 'Content color', Opt_In::TEXT_DOMAIN ),
				'value' => 'optin_success_content_color',
				'alpha' => 'false',
			),
		),
	),
	'additional' => array(
		'group_name'   => esc_html__( 'Additional Settings', Opt_In::TEXT_DOMAIN ),

	),
);

// Unset non existent elements for module types.
if ( Hustle_Module_Model::EMBEDDED_MODULE !== $module_type ) {

	$palette_optin['additional']['group_states'] = array(
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
		unset( $palette_optin['additional']['group_states']['default']['colors']['overlay_color'] );
	}

} else {

	unset( $palette_optin['additional'] );

}
?>

<div id="hustle-color-palette" class="sui-form-field">

	<div class="sui-accordion">

		<?php foreach ( $palette_optin as $group => $palette ) { ?>

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

</div><?php // #hustle-color-palette ?>
