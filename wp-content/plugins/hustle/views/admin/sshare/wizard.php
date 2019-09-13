<?php
/**
 * @var Opt_In $this
 */

$module_type = $module->module_type;
$module_name = $module->module_name;
$appearance_settings = $module->get_design()->to_array();
$display_settings = $module->get_display()->to_array();
$content_settings = $module->get_content()->to_array();

$capitalize_singular = esc_html__( 'Social Share', 'wordpress-popup' );
$capitalize_plural   = esc_html__( 'Social Shares', 'wordpress-popup' );
$smallcaps_singular  = esc_html__( 'social share', 'wordpress-popup' );
$smallcaps_plural    = esc_html__( 'social shares', 'wordpress-popup' );

self::static_render(
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
		'wizard_tabs'            => array(
			'services'     => array(
				'name'     => esc_html__( 'Services', 'wordpress-popup' ),
				'template' => 'admin/sshare/services/template',
				'support'  => array(
					'section' => $section,
					'content_settings' => $content_settings,
				),
			),
			'display'     => array(
				'name'     => esc_html__( 'Display Options', 'wordpress-popup' ),
				'template' => 'admin/sshare/display-options/template',
				'support'  => array(
					'section' => $section,
					'shortcode_id' => $module->get_shortcode_id(),
					'display_settings' => $display_settings,
				),
			),
			'appearance'   => array(
				'name'     => esc_html__( 'Appearance', 'wordpress-popup' ),
				'template' => 'admin/sshare/appearance/template',
				'support'  => array(
					'section'             => $section,
					'module_type'         => $module_type,
					'capitalize_singular' => $capitalize_singular,
					'smallcaps_singular'  => $smallcaps_singular,
					'content_settings'    => $content_settings,
					'display_settings'    => $display_settings,
					'appearance_settings' => $appearance_settings,
					'module'			  => $module,
				),
			),
			'visibility'   => array(
				'name'     => esc_html__( 'Visibility', 'wordpress-popup' ),
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
self::static_render( 'admin/sshare/services/platform-row', array() );

// Row: Platform Row template
self::static_render( 'admin/commons/sui-wizard/dialogs/add-platform-li', array() );
