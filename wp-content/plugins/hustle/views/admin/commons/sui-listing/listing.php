<?php
$entries_per_page = 20;
if ( isset( $page_title ) ) {
	$page_title = $page_title;
} else {
	$page_title = esc_html__( 'Module', Opt_In::TEXT_DOMAIN );
}
$sql_month_start_date = date( 'Y-m-d H:i:s', strtotime( '-30 days midnight' ) );
$tracking_model = Hustle_Tracking_Model::get_instance();
$tracking_types = Hustle_Settings_Admin::get_hustle_settings( 'selected_top_metrics' );
$can_create = Hustle_Module_Admin::can_create_new_module( $module_type );
?>

<main class="<?php echo implode( ' ', apply_filters( 'hustle_sui_wrap_class', null ) ); ?>">

	<div class="sui-header">

		<h1 class="sui-title"><?php echo esc_html( $page_title ); ?></h1>

		<?php if ( 0 < $total && $capability['hustle_create'] ) { ?>

			<div class="sui-actions-left">

				<button
					class="sui-button sui-button-blue hustle-create-module"
					<?php if ( ! $can_create ) echo 'data-enabled="false"'; ?>
				>
					<i class="sui-icon-plus" aria-hidden="true"></i> <?php esc_html_e( 'Create', Opt_In::TEXT_DOMAIN ); ?>
				</button>

				<button
					class="sui-button hustle-import-new-module"
					<?php if ( ! $can_create ) echo 'data-enabled="false"'; ?>
				>
					<i class="sui-icon-upload-cloud" aria-hidden="true"></i> <?php esc_html_e( 'Import', Opt_In::TEXT_DOMAIN ); ?>
				</button>

			</div>

		<?php } ?>

		<div class="sui-actions-right">

			<?php if ( false && 0 < count( $modules ) ) { ?>

				<div class="hui-reporting-period">

					<label><?php esc_html_e( 'Reporting Period', Opt_In::TEXT_DOMAIN ); ?></label>

					<select>
						<option value="7"><?php esc_html_e( 'Last 7 days', Opt_In::TEXT_DOMAIN ); ?></option>
						<option value="15"><?php esc_html_e( 'Last 15 days', Opt_In::TEXT_DOMAIN ); ?></option>
						<option value="30" selected><?php esc_html_e( 'Last 30 days', Opt_In::TEXT_DOMAIN ); ?></option>
					</select>

				</div>

			<?php } ?>

			<?php
			// Waiting for the docs to be completed.
			$hide = true; // apply_filters( 'wpmudev_branding_hide_doc_link', false );
			if ( ! $hide ) {
			?>
					<button class="sui-button sui-button-ghost">
						<i class="sui-icon-academy" aria-hidden="true"></i> <?php esc_html_e( 'View Documentation', Opt_In::TEXT_DOMAIN ); ?>
					</button>
			<?php } ?>

		</div>

	</div>

	<?php
	if ( 'module-does-not-exists' === $message ) {
		$this->render(
			'admin/notices/notice-non-exists',
			array(
				'total' => $total,
				'capability' => $capability,
			)
		);
	}
	?>

	<?php if ( 0 < count( $modules ) ) { ?>

		<?php
		// ELEMENT: Summary
		$this->render(
			'admin/commons/sui-listing/elements/summary',
			array(
				'active_modules_count' => $active,
				'singular' => $capitalize_singular,
				'plural'   => $capitalize_plural,
				'latest_entry_time' => Opt_In_Utils::get_latest_conversion_time( $module_type ),
				'latest_entries_count' => $tracking_model->count_newer_conversions_by_module_type( $module_type, $sql_month_start_date ),
				'sui'      => $sui,
			)
		); ?>

		<?php
		// ELEMENT: Pagination
		$this->render(
			'admin/commons/sui-listing/elements/pagination',
			array(
				'module_type'      => $module_type,
				'items'            => $modules,
				'total'            => $total,
				'page'             => $page,
				'paged'            => $paged,
				'entries_per_page' => $entries_per_page,
			)
		); ?>

		<div class="hustle-list sui-accordion sui-accordion-block">

            <?php
			foreach ( $modules as $key => $module ) {
			?>

				<?php
				// ELEMENT: Modules
				$this->render(
					'admin/commons/sui-listing/elements/module',
					array(
						'module'               => $module,
						'module_type'          => $module_type,
						'smallcaps_singular'   => $smallcaps_singular,
						'capability'           => $capability,
						'tracking_types'       => $tracking_types,
						'can_create'		   => $can_create,
					)
				); ?>

			<?php } ?>

		</div>

	<?php } else { ?>

		<?php
		// ELEMENT: Empty Message
		$this->render(
			'admin/commons/sui-listing/elements/empty-message',
			array(
				'count'            => $total,
				'is_free'          => $is_free,
				'capability'       => $capability,
				'message'          => $page_message,
			)
		);
}
	// ELEMENT: Footer
	$this->render( 'admin/footer/footer-simple', array() );

	// DIALOG: Create module
	$this->render(
		'admin/commons/sui-listing/dialogs/create-module',
		array(
			'module_type'         => $module_type,
			'capitalize_singular' => $capitalize_singular,
			'smallcaps_singular'  => $smallcaps_singular,
		)
	);

	// DIALOG: Import module
	$this->render(
		'admin/commons/sui-listing/dialogs/import-module',
		array(
			'capitalize_singular' => $capitalize_singular,
			'smallcaps_singular'  => $smallcaps_singular,
			'module_type'         => $module_type,
		)
	);

	// DIALOG: Delete module
	$this->render(
		'admin/commons/sui-listing/dialogs/delete-module',
		array()
	);

	// DIALOG: Manage tracking
	if ( isset( $multiple_charts ) ) {

		$this->render(
			'admin/commons/sui-listing/dialogs/manage-tracking',
			array(
				'multiple_charts' => isset( $multiple_charts ) ? $multiple_charts : false,
			)
		);
	}

	/**
	 * DIALOG: Reset Tracking Data Confirmation
	 */
	$this->render( 'admin/commons/sui-listing/dialogs/tracking-reset-data' );

	// DIALOG: Ugrade to pro.
	if ( Opt_In_Utils::_is_free() ) {
		$this->render( 'admin/commons/sui-listing/dialogs/pro-upgrade' );
	}

	// DIALOG: Preview
	// If embedded, show the preview dialog to embed the module into.
	if ( Hustle_Module_Model::EMBEDDED_MODULE === $module_type ) {
		$this->render( 'admin/dialogs/preview-dialog' );
	}

	// DIALOG: Dissmiss migrate tracking notice modal confirmation.
	if ( Hustle_Module_Admin::is_show_migrate_tracking_notice() ) {
		$this->render( 'admin/dashboard/dialogs/migrate-dismiss-confirmation' );
	}
?>
</main>
