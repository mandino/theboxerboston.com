<?php
$capitalize_singular = esc_html__( 'Embed', Opt_In::TEXT_DOMAIN );
$capitalize_plural   = esc_html__( 'Embeds', Opt_In::TEXT_DOMAIN );
$smallcaps_singular  = esc_html__( 'embed', Opt_In::TEXT_DOMAIN );
$smallcaps_plural    = esc_html__( 'embeds', Opt_In::TEXT_DOMAIN );

$this->render(
	'admin/dashboard/templates/widget-modules',
	array(
		'modules'     => $embeds,
		'widget_name' => $capitalize_plural,
		'widget_type' => Hustle_Module_Model::EMBEDDED_MODULE,
		'capability'  => $capability,
		'description' => esc_html__( 'Embeds allow you to insert promotions or newsletter signups directly into your content automatically or with shortcodes.', Opt_In::TEXT_DOMAIN ),
	)
);
