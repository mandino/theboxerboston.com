<?php
$module_type         = Hustle_Module_Model::SLIDEIN_MODULE;
$capitalize_singular = esc_html__( 'Slide-in', Opt_In::TEXT_DOMAIN );
$capitalize_plural   = esc_html__( 'Slide-ins', Opt_In::TEXT_DOMAIN );
$smallcaps_singular  = self::get_smallcaps_singular( $module_type );
$smallcaps_plural    = esc_html__( 'slide-in', Opt_In::TEXT_DOMAIN );

$this->render(
	'admin/commons/sui-listing/listing',
	array(
		'page_title'          => $capitalize_plural,
		'page_message'        => esc_html__( 'Slide-ins can be used to highlight promotions without covering the whole screen.', Opt_In::TEXT_DOMAIN ),
		'total'               => $total,
		'active'              => $active,
		'modules'             => $modules,
		'module_type'         => $module_type,
		'is_free'             => $is_free,
		'capability'          => $capability,
		'capitalize_singular' => $capitalize_singular,
		'capitalize_plural'   => $capitalize_plural,
		'smallcaps_singular'  => $smallcaps_singular,
		'page'                => $page,
		'paged'               => $paged,
		'message'             => $message,
		'sui'                 => $sui,
	)
);
