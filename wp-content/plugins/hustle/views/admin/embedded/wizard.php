<?php
/**
 * @var Opt_In $this
 */

$module_type = $module->module_type;
$module_name = $module->module_name;
$appearance_settings = $module->get_design()->to_array();
$content_settings = $module->get_content()->to_array();
$email_settings = $module->get_emails()->to_array();
$form_elements = !empty( $email_settings['form_elements'] ) ? $email_settings['form_elements'] : array();

$capitalize_singular = esc_html__( 'Embed', 'wordpress-popup' );
$capitalize_plural   = esc_html__( 'Embeds', 'wordpress-popup' );
$smallcaps_singular  = esc_html__( 'embed', 'wordpress-popup' );
$smallcaps_plural    = esc_html__( 'embeds', 'wordpress-popup' );

$this->render(
	'admin/commons/sui-wizard/wizard',
	array(
		'page_id'                => 'hustle-module-wizard-view',
		'page_tab'               => $section,
		'module'                 => $module,
		'module_id'              => $module_id,
		'module_name'            => $module->module_name,
		'module_mode'            => $is_optin,
		'module_status'          => $is_active,
		'module_type'            => $module_type,
		'capitalize_singular'    => $capitalize_singular,
		'smallcaps_singular'     => $smallcaps_singular,
		'form_elements'          => $form_elements,
		'is_recaptcha_available' => $is_recaptcha_available,
		'wizard_tabs'            => array(
			'content'      => array(
				'name'     => esc_html__( 'Content', 'wordpress-popup' ),
				'template' => 'admin/commons/sui-wizard/templates/tab-content',
				'support'  => array(
					'section'            => $section,
					'is_optin'           => $is_optin,
					'module_type'        => $module_type,
					'smallcaps_singular' => $smallcaps_singular,
				),
			),
			'emails'       => array(
				'name'     => esc_html__( 'Emails', 'wordpress-popup' ),
				'template' => 'admin/commons/sui-wizard/templates/tab-emails',
				'support'  => array(
					'module'  => $module,
					'section' => $section,
				),
				'is_optin' => true,
			),
			'integrations' => array(
				'name'     => esc_html__( 'Integrations', 'wordpress-popup' ),
				'template' => 'admin/commons/sui-wizard/templates/tab-integrations',
				'support'  => array(
					'section'            => $section,
					'smallcaps_singular' => $smallcaps_singular,
					'settings'			 => $module->get_integrations_settings()->to_array(),
				),
				'is_optin' => true,
			),
			'appearance'   => array(
				'name'     => esc_html__( 'Appearance', 'wordpress-popup' ),
				'template' => 'admin/commons/sui-wizard/templates/tab-appearance',
				'support'  => array(
					'section'             => $section,
					'is_optin'            => $is_optin,
					'module_type'         => $module_type,
					'capitalize_singular' => $capitalize_singular,
					'smallcaps_singular'  => $smallcaps_singular,
					'feature_image'		  => $content_settings['feature_image'],
					'settings'			  => $appearance_settings,
				),
			),
			'display'      => array(
				'name'     => esc_html__( 'Display Options', 'wordpress-popup' ),
				'template' => 'admin/commons/sui-wizard/templates/tab-display',
				'support'  => array(
					'section'      => $section,
					'shortcode_id' => $module->get_shortcode_id(),
				),
			),
			'visibility'   => array(
				'name'     => esc_html__( 'Visibility', 'wordpress-popup' ),
				'template' => 'admin/commons/sui-wizard/templates/tab-visibility',
				'support'  => array(
					'section'             => $section,
					'capitalize_singular' => $capitalize_singular,
					'module_type'         => $module_type,
					'smallcaps_singular'  => $smallcaps_singular
				),
			),
			'behavior'    => array(
				'name'     => esc_html__( 'Behavior', 'wordpress-popup' ),
				'template' => 'admin/commons/sui-wizard/templates/tab-behaviour',
				'support'  => array(
					'section'                    => $section,
					'is_optin'                   => $is_optin,
					'is_active'                  => $is_active,
					'module_type'                => $module_type,
					'module_name'                => $module_name,
					'capitalize_singular'        => $capitalize_singular,
					'capitalize_plural'          => $capitalize_plural,
					'smallcaps_singular'         => $smallcaps_singular,
					'shortcode_id'				 => $module->get_shortcode_id(),
					'setting_animation_entrance' => true,
					'setting_additional'          => true,
				),
			),
		),
	)
);
