<?php
/**
 * @var Opt_In $this
 */

$module_type = $module->module_type;
$module_name = $module->module_name;
//$appearance_settings = $module->get_design()->to_array();
$display_settings = $module->get_display()->to_array();
$content_settings = $module->get_content()->to_array();

$capitalize_singular = esc_html__( 'Social Share', Opt_In::TEXT_DOMAIN );
$capitalize_plural   = esc_html__( 'Social Shares', Opt_In::TEXT_DOMAIN );
$smallcaps_singular  = esc_html__( 'social share', Opt_In::TEXT_DOMAIN );
$smallcaps_plural    = esc_html__( 'social shares', Opt_In::TEXT_DOMAIN );

$this->render(
	'admin/commons/sui-wizard/wizard',
	array(
		'page_id'                => 'hustle-module-wizard-view',
		'page_tab'               => $section,
		'module'                 => $module,
		'module_id'              => $module_id,
		'module_name'            => $module->module_name,
		'module_status'          => $is_active,
		'module_type'            => $module_type,
		'capitalize_singular'    => $capitalize_singular,
		'smallcaps_singular'     => $smallcaps_singular,
		'is_recaptcha_available' => $is_recaptcha_available,
		'wizard_tabs'            => array(
			'services'     => array(
				'name'     => esc_html__( 'Services', Opt_In::TEXT_DOMAIN ),
				'template' => 'admin/sshare/services/template',
				'support'  => array(
					'section' => $section,
					'content_settings' => $content_settings,
				),
			),
			'display'     => array(
				'name'     => esc_html__( 'Display Options', Opt_In::TEXT_DOMAIN ),
				'template' => 'admin/sshare/display-options/template',
				'support'  => array(
					'section' => $section,
					'shortcode_id' => $module->get_shortcode_id(),
					'display_settings' => $display_settings,
				),
			),
			'appearance'   => array(
				'name'     => esc_html__( 'Appearance', Opt_In::TEXT_DOMAIN ),
				'template' => 'admin/sshare/appearance/template',
				'support'  => array(
					'section'             => $section,
					'module_type'         => $module_type,
					'capitalize_singular' => $capitalize_singular,
					'smallcaps_singular'  => $smallcaps_singular,
					'display_settings'    => $display_settings,
					'module'			  => $module,
				),
			),
			'visibility'   => array(
				'name'     => esc_html__( 'Visibility', Opt_In::TEXT_DOMAIN ),
				'template' => 'admin/commons/sui-wizard/templates/tab-visibility',
				'support'  => array(
					'section'     => $section,
					'capitalize_singular' => $capitalize_singular,
					'is_active'           => $is_active,
					'module_type'         => $module_type,
					'smallcaps_singular'  => $smallcaps_singular,
				),
			),
		),
	)
);

// Row: Platform Row template
$this->render( 'admin/sshare/services/platform-row', array() );

// Row: Platform Row template
$this->render( 'admin/commons/sui-wizard/dialogs/add-platform-li', array() );
