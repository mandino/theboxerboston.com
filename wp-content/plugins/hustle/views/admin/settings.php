<?php
/**
 * @var Opt_In $this
 */

$sections = array(
	'analytics' => array(
		'label' => __( 'Dashboard Analytics', Opt_In::TEXT_DOMAIN ),
		'status' => 'hide',
		'data' => array(
			'settings' => isset( $hustle_settings['analytics'] ) ? $hustle_settings['analytics'] : array(),
		),
	),
	'emails' => array(
		'label' => __( 'Emails', Opt_In::TEXT_DOMAIN ),
		'status' => 'show',
		'data' => array(
			'settings' => isset( $hustle_settings['emails'] ) ? $hustle_settings['emails'] : array(),
		),
	),
	'privacy' => array(
		'label' => __( 'Viewer\'s Privacy', Opt_In::TEXT_DOMAIN ),
		'status' => 'show',
		'data' => array(
			'settings' => isset( $hustle_settings['privacy'] ) ? $hustle_settings['privacy'] : array(),
		),
	),
	'permissions' => array(
		'label' => __( 'Permissions', Opt_In::TEXT_DOMAIN ),
		'status' => 'hide',
		'data' => array(
			'filter' => $filter,
			'modules' => $modules,
			'modules_count' => $modules_count,
			'modules_limit' => $modules_limit,
			'modules_page' => $modules_page,
			'modules_show_pager' => $modules_show_pager,
			'modules_edit_roles' => $modules_edit_roles,
			'hustle_settings' => $hustle_settings,
			'roles' => Opt_In_Utils::get_user_roles(),
		),
	),
	'recaptcha' => array(
		'label' => __( 'reCAPTCHA', Opt_In::TEXT_DOMAIN ),
		'status' => 'show',
		'data' => array(
			'settings' => isset( $hustle_settings['recaptcha'] ) ? $hustle_settings['recaptcha'] : array(),
		),
	),
	'accessibility' => array(
		'label' => __( 'Accessibility', Opt_In::TEXT_DOMAIN ),
		'status' => 'show',
		'data' => array(
			'settings' => isset( $hustle_settings['accessibility'] ) ? $hustle_settings['accessibility'] : array(),
		),
	),
	'metrics' => array(
		'label' => __( 'Top Metrics', Opt_In::TEXT_DOMAIN ),
		'status' => 'hide',
		'data' => array(
			'hustle_settings' => $hustle_settings,
		),
	),
	'unsubscribe' => array(
		'label' => __( 'Unsubscribe', Opt_In::TEXT_DOMAIN ),
		'status' => 'show',
		'data' => array(
			'messages' => $unsubscription_messages,
			'email'	   => $unsubscription_email,
		),
	),
);


?>
<main class="<?php echo implode( ' ', apply_filters( 'hustle_sui_wrap_class', null ) ); ?>">
	<div class="sui-header">
		<h1 class="sui-header-title"><?php esc_html_e( 'Settings', Opt_In::TEXT_DOMAIN ); ?></h1>
		<?php $this->render( 'admin/commons/view-documentation' ); ?>
	</div>
	<div class="sui-row-with-sidenav">
		<div class="sui-sidenav">
			<ul class="sui-vertical-tabs sui-sidenav-hide-md">
<?php
foreach ( $sections as $key => $value ) {
	if ( 'hide' === $value['status'] ) {
		continue;
	}
	$classes = array(
		'sui-vertical-tab',
	);
	if ( $section === $key ) {
		$classes[] = 'current';
	}
	printf(
		'<li class="%s"><a href="#" data-tab="%s">%s</a></li>',
		esc_attr( implode( ' ', $classes ) ),
		esc_attr( $key ),
		esc_html( $value['label'] )
	);
}
?>
			</ul>
		</div>
<?php
foreach ( $sections as $key => $value ) {
	if ( 'hide' === $value['status'] ) {
		continue;
	}
	$data = isset( $value['data'] )? $value['data']:array();
	$data['section'] = $section;
	$template = sprintf( 'admin/settings/tab-%s', esc_attr( $key ) );
	$this->render( $template, $data );
}
?>
	</div>
<?php
// Global Footer
$this->render( 'admin/footer/footer-simple' ); ?>

<?php
// DIALOG: Delete All IPs
$this->render( 'admin/settings/privacy/remove-ips-dialog', array() ); ?>

<?php
// NOTICE: Delete All IPs
$this->render( 'admin/notices/notice-delete-all-ips', array() );
// NOTICE: Delete selected IPs
$this->render( 'admin/notices/notice-delete-ips', array() ); 

// DIALOG: Dissmiss migrate tracking notice modal confirmation.
if ( Hustle_Module_Admin::is_show_migrate_tracking_notice() ) {
	$this->render( 'admin/dashboard/dialogs/migrate-dismiss-confirmation' );
}

?>

</main>
