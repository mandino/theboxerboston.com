<?php
$capitalize_singular = esc_html__( 'Embed', 'wordpress-popup' );
$capitalize_plural   = esc_html__( 'Embeds', 'wordpress-popup' );
$smallcaps_singular  = esc_html__( 'embed', 'wordpress-popup' );
$smallcaps_plural    = esc_html__( 'embeds', 'wordpress-popup' );

self::static_render(
	'admin/dashboard/templates/widget-modules',
	array(
		'modules'     => $embeds,
		'widget_name' => $capitalize_plural,
		'widget_type' => Hustle_Module_Model::EMBEDDED_MODULE,
		'capability'  => $capability,
		'description' => esc_html__( 'Embeds allow you to insert promotions or newsletter signups directly into your content automatically or with shortcodes.', 'wordpress-popup' ),
	)
);
