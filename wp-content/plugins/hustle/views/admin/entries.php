<?php
// Email Lists: Images
$empty_image  = self::$plugin_url . 'assets/images/hustle-empty-message';
$choose_image = self::$plugin_url . 'assets/images/hustle-email-lists';
?>

<div class="sui-wrap<?php echo ! empty( $accessibility['accessibility_color'] ) ? ' sui-color-accessible' : ''; ?>">

	<div class="sui-header">
		<h1 class="sui-header-title"><?php esc_html_e( 'Email Lists', 'wordpress-popup' ); ?></h1>
		<?php $this->render( 'admin/commons/view-documentation' ); ?>
	</div>

	<?php
	// Search Bar
	$this->render(
		'admin/email-lists/search-bar',
		array(
			'admin' => $admin,
			'has_entries' => ( $is_module_selected && ! empty( $entries ) ),
			'module' => $module,
		)
	); ?>

	<?php if ( 0 === $global_entries ) { ?>

		<div class="sui-box sui-message">

			<?php Opt_In_Utils::hustle_image( $empty_image, 'png', '', true ); ?>

			<div class="sui-message-content">

				<h2><?php esc_html_e( 'Email Lists', 'wordpress-popup' ); ?></h2>

				<p><?php esc_html_e( "You haven't yet collected emails through email opt-ins inside any of your popup, slide-in or embed. When you do, you'll be able to view the email list here.", 'wordpress-popup' ); ?></p>

			</div>

		</div>

	<?php } else { ?>

		<?php
		// If a module is selected, get its entries. Show a placeholder message otherwise.
		if ( $is_module_selected ) : ?>

			<?php
			// If there are entries, show them. Show a placeholder message otherwise.
			if ( ! empty( $entries ) || $is_filtered ) : ?>

				<?php
				// List Emails
				$this->render(
					'admin/email-lists/emails-list',
					array(
						'admin' => $admin,
						'bulk_form_id' => 'hustle-actions-top',
						'module' => $module,
						'wizard_page' => add_query_arg(
							array(
								'page' => $module->get_wizard_page(),
								'id' => $module->module_id,
								'section' => 'integrations',
							),
							'admin.php'
						),
						'form_fields' => $module->get_form_fields(),
					)
				); ?>

			<?php else : ?>

				<div class="sui-box sui-message">

					<?php Opt_In_Utils::hustle_image( $empty_image, 'png', '', true ); ?>

					<div class="sui-message-content">

						<h2><?php esc_html_e( 'No Emails Collected!', 'wordpress-popup' ); ?></h2>

						<p><?php printf( esc_html__( "Your %s hasn't collected any emails yet. When it starts converting, you'll be able to view the collected emails here.", 'wordpress-popup' ), esc_html( $module_name ) ); ?></p>

					</div>

				</div>

			<?php endif; ?>

		<?php else : ?>

			<div class="sui-box sui-message">

				<?php Opt_In_Utils::hustle_image( $choose_image, 'png', '', true ); ?>

				<div class="sui-message-content">

					<h2><?php esc_html_e( 'Almost there!', 'wordpress-popup' ); ?></h2>

					<p><?php esc_html_e( 'Select the popup, slide-in or embed to view the corresponding email list.', 'wordpress-popup' ); ?></p>

				</div>

			</div>

		<?php endif; ?>

	<?php } ?>

	<?php 
	// Global Footer
	$this->render( 'admin/footer/footer' ); ?>

	<?php
	// DIALOG: Dialog Filter for MOBILE
	$this->render(
		'admin/email-lists/dialog-filter',
		array(
			'admin' => $admin,
			'module' => $module,
		)
	); ?>

	<?php
	// DIALOG: Delete Email
	$this->render( 'admin/commons/sui-listing/dialogs/delete-module', array() );

	// DIALOG: Dissmiss migrate tracking notice modal confirmation.
	if ( Hustle_Module_Admin::is_show_migrate_tracking_notice() ) {
		$this->render( 'admin/dashboard/dialogs/migrate-dismiss-confirmation' );
	}
	?>

</div>
