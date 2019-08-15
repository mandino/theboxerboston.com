<?php
$module_type         = Hustle_Module_Model::SOCIAL_SHARING_MODULE;
$multiple_charts     = Hustle_Module_Model::get_sshare_types( true );
$capitalize_singular = esc_html__( 'Social Sharing', Opt_In::TEXT_DOMAIN );
$capitalize_plural   = esc_html__( 'Social Shares', Opt_In::TEXT_DOMAIN );
$smallcaps_singular  = self::get_smallcaps_singular( $module_type );
$smallcaps_plural    = esc_html__( 'social shares', Opt_In::TEXT_DOMAIN );

$this->render(
	'admin/commons/sui-listing/listing',
	array(
		'page_title'          => $capitalize_singular,
		'page_message'        => esc_html__( 'Make it easy for your visitors to share your content by adding floating or inline social sharing prompts.', Opt_In::TEXT_DOMAIN ),
		'total'               => $total,
		'active'              => $active,
		'modules'             => $modules,
		'module_type'         => $module_type,
		'is_free'             => $is_free,
		'capability'          => $capability,
		'capitalize_singular' => $capitalize_singular,
		'capitalize_plural'   => $capitalize_plural,
		'smallcaps_singular'  => $smallcaps_singular,
		'multiple_charts'     => $multiple_charts,
		'page'                => $page,
		'paged'               => $paged,
		'message'             => $message,
		'sui'                 => $sui,
	)
);
