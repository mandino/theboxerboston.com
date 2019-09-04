<?php
$capitalize_singular = esc_html__( 'Social Sharing', Opt_In::TEXT_DOMAIN );
$capitalize_plural   = esc_html__( 'Social Shares', Opt_In::TEXT_DOMAIN );
$smallcaps_singular  = esc_html__( 'social sharing', Opt_In::TEXT_DOMAIN );
$smallcaps_plural    = esc_html__( 'social shares', Opt_In::TEXT_DOMAIN );

$this->render(
	'admin/dashboard/templates/widget-pages',
	array(
		'modules'     => $sshares,
		'sshare_per_page_data' => $sshare_per_page_data,
		'widget_name' => $capitalize_plural,
		'widget_type' => Hustle_Module_Model::SOCIAL_SHARING_MODULE,
		'capability'  => $capability,
		'description' => esc_html__( 'Make it easy for your visitors to share your content by adding floating or inline social sharing prompts. Once your modules start converting, your top converting pages will appear here.', Opt_In::TEXT_DOMAIN ),
	)
);
