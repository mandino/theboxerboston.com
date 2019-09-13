<?php
$capitalize_singular = esc_html__( 'Slide-in', 'wordpress-popup' );
$capitalize_plural   = esc_html__( 'Slide-ins', 'wordpress-popup' );
$smallcaps_singular  = esc_html__( 'slide-in', 'wordpress-popup' );
$smallcaps_plural    = esc_html__( 'slide-in', 'wordpress-popup' );

self::static_render(
	'admin/dashboard/templates/widget-modules',
	array(
		'modules'     => $slideins,
		'widget_name' => $capitalize_plural,
		'widget_type' => Hustle_Module_Model::SLIDEIN_MODULE,
		'capability'  => $capability,
		'description' => esc_html__( 'Slide-ins can be used to highlight promotions without covering the whole screen.', 'wordpress-popup' ),
	)
);
