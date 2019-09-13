<?php
$capitalize_singular = esc_html__( 'Pop-up', 'wordpress-popup' );
$capitalize_plural   = esc_html__( 'Pop-ups', 'wordpress-popup' );
$smallcaps_singular  = esc_html__( 'pop-up', 'wordpress-popup' );
$smallcaps_plural    = esc_html__( 'pop-ups', 'wordpress-popup' );

self::static_render(
	'admin/dashboard/templates/widget-modules',
	array(
		'modules'     => $popups,
		'widget_name' => $capitalize_plural,
		'widget_type' => Hustle_Module_Model::POPUP_MODULE,
		'capability'  => $capability,
		'description' => esc_html__( 'Pop-ups show up over your page content automatically and can be used to highlight promotions and gain email subscribers.', 'wordpress-popup' ),
	)
);
