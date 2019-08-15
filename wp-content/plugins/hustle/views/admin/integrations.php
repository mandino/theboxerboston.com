<?php
/**
 * @var Opt_In $this
 */
?>

<main class="<?php echo implode( ' ', apply_filters( 'hustle_sui_wrap_class', null ) ); ?>">

	<div class="sui-header">

		<h1 class="sui-header-title"><?php esc_html_e( 'Integrations', Opt_In::TEXT_DOMAIN ); ?></h1>
		<?php $this->render( 'admin/commons/view-documentation' ); ?>
	</div>

	<!-- BOX: Summary -->
	<?php $this->render( 'admin/integrations-page/summary', array( 'sui' => $sui ) ); ?>

	<div class="sui-row">

		<!-- BOX: Connected Apps -->
		<div class="sui-col-md-6">

			<?php $this->render( 'admin/integrations-page/connected-apps' ); ?>

		</div>

		<!-- BOX: Available Apps -->
		<div class="sui-col-md-6">

			<?php $this->render( 'admin/integrations-page/available-apps' ); ?>

		</div>

	</div>

	<!-- Integrations modal -->
	<?php $this->render( 'admin/dialogs/modal-integration' ); ?>

	<!-- Footer -->
	<?php $this->render( 'admin/footer/footer-simple' ); ?>

	<?php
	// DIALOG: Dissmiss migrate tracking notice modal confirmation.
	if ( Hustle_Module_Admin::is_show_migrate_tracking_notice() ) {
		$this->render( 'admin/dashboard/dialogs/migrate-dismiss-confirmation' );
	}
	?>
</main>
