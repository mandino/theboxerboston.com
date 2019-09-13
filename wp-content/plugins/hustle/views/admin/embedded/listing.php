<?php
$module_type         = Hustle_Module_Model::EMBEDDED_MODULE;
$multiple_charts     = Hustle_Module_Model::get_embedded_types( true );
$capitalize_singular = esc_html__( 'Embed', 'wordpress-popup' );
$capitalize_plural   = esc_html__( 'Embeds', 'wordpress-popup' );
$smallcaps_singular  = self::get_smallcaps_singular( $module_type );
$smallcaps_plural    = esc_html__( 'embeds', 'wordpress-popup' );

$this->render(
	'admin/commons/sui-listing/listing',
	array(
		'page_title'          => $capitalize_plural,
		'page_message'        => esc_html__( 'Embeds allow you to insert promotions or newsletter signups directly into your content automatically or with shortcodes.', 'wordpress-popup' ),
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
