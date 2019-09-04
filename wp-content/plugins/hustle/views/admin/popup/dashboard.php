<?php
$capitalize_singular = esc_html__( 'Pop-up', Opt_In::TEXT_DOMAIN );
$capitalize_plural   = esc_html__( 'Pop-ups', Opt_In::TEXT_DOMAIN );
$smallcaps_singular  = esc_html__( 'pop-up', Opt_In::TEXT_DOMAIN );
$smallcaps_plural    = esc_html__( 'pop-ups', Opt_In::TEXT_DOMAIN );

$this->render(
	'admin/dashboard/templates/widget-modules',
	array(
		'modules'     => $popups,
		'widget_name' => $capitalize_plural,
		'widget_type' => Hustle_Module_Model::POPUP_MODULE,
		'capability'  => $capability,
		'description' => esc_html__( 'Pop-ups show up over your page content automatically and can be used to highlight promotions and gain email subscribers.', Opt_In::TEXT_DOMAIN ),
	)
);
