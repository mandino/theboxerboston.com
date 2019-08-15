<?php
$capitalize_singular = esc_html__( 'Slide-in', Opt_In::TEXT_DOMAIN );
$capitalize_plural   = esc_html__( 'Slide-ins', Opt_In::TEXT_DOMAIN );
$smallcaps_singular  = esc_html__( 'slide-in', Opt_In::TEXT_DOMAIN );
$smallcaps_plural    = esc_html__( 'slide-in', Opt_In::TEXT_DOMAIN );

$this->render(
	'admin/dashboard/templates/widget-modules',
	array(
		'modules'     => $slideins,
		'widget_name' => $capitalize_plural,
		'widget_type' => Hustle_Module_Model::SLIDEIN_MODULE,
		'capability'  => $capability,
		'description' => esc_html__( 'Slide-ins can be used to highlight promotions without covering the whole screen.', Opt_In::TEXT_DOMAIN ),
	)
);
