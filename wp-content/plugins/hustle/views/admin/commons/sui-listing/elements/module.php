<div class="sui-accordion-item">

	<?php
	$module_id = $module->module_id;
	$last_entry_time = Opt_In_Utils::get_latest_conversion_time_by_module_id( $module_id );
	if ( isset( $_GET['view-stats'] ) && intval( $module_id ) === intval( $_GET['view-stats'] ) ) { // WPCS CSRF: ok.
		$display_chart_class = ' hustle-display-chart hustle-scroll-to';
	} else {
		$display_chart_class = '';
	}

	// START: Item header ?>
	<div
		class="sui-accordion-item-header<?php echo esc_attr( $display_chart_class ); ?>"
		data-id="<?php echo esc_attr( $module->id ); ?>"
		data-nonce="<?php echo esc_attr( wp_create_nonce( 'module_get_tracking_data' . $module->id ) ); ?>"
	>

		<div class="sui-accordion-item-title sui-trim-title">

			<label for="hustle-module-<?php echo esc_html( $module_id ); ?>" class="sui-checkbox sui-accordion-item-action">
				<input
					type="checkbox"
					value="<?php echo esc_html( $module_id ); ?>"
					id="hustle-module-<?php echo esc_html( $module_id ); ?>"
					class="hustle-listing-checkbox"
				/>
				<span aria-hidden="true"></span>
				<span class="sui-screen-reader-text"><?php esc_html_e( 'Select this module', Opt_In::TEXT_DOMAIN ); ?></span>
			</label>

			<span class="sui-trim-text"><?php echo esc_html( $module->module_name ); ?></span>

			<span
				class="sui-tag<?php echo $module->active ? ' sui-tag-blue' : ''; ?>"
				data-status="<?php echo $module->active ? 'published' : 'draft'; ?>"
				data-draft="<?php esc_html_e( 'Draft', Opt_In::TEXT_DOMAIN ); ?>"
				data-publish="<?php esc_html_e( 'Published', Opt_In::TEXT_DOMAIN ); ?>"
			>
				<?php $module->active ? esc_html_e( 'Published', Opt_In::TEXT_DOMAIN ) : esc_html_e( 'Draft', Opt_In::TEXT_DOMAIN ); ?>
			</span>

		</div>

		<div class="sui-accordion-item-date">
			<strong><?php esc_html_e( 'Last conversion', Opt_In::TEXT_DOMAIN ); ?></strong>
			<?php echo esc_html( $last_entry_time ); ?>
		</div>

		<div class="sui-accordion-col-auto">

			<a
				href="<?php echo esc_url( $module->decorated->get_edit_url() ); ?>"
				class="sui-button sui-button-ghost sui-accordion-item-action sui-desktop-visible"
			>
				<i class="sui-icon-pencil" aria-hidden="true"></i> <?php esc_attr_e( 'Edit', Opt_In::TEXT_DOMAIN ); ?>
			</a>

			<a
				href="<?php echo esc_url( $module->decorated->get_edit_url() ); ?>"
				class="sui-button-icon sui-accordion-item-action sui-mobile-visible"
			>
				<i class="sui-icon-pencil" aria-hidden="true"></i>
				<span class="sui-screen-reader-text"><?php esc_attr_e( 'Edit', Opt_In::TEXT_DOMAIN ); ?></span>
			</a>

			<div class="sui-dropdown sui-accordion-item-action">

				<?php
				// ELEMENT: Actions
				$this->render(
					'admin/commons/sui-listing/elements/actions',
					array(
						'module' => $module,
						'capability' => $capability,
						'can_create' => $can_create,
					)
				); ?>

			</div>

			<button class="sui-button-icon sui-accordion-open-indicator">
				<i class="sui-icon-chevron-down" aria-hidden="true"></i>
				<span class="sui-screen-reader-text"><?php esc_html_e( 'View module stats', Opt_In::TEXT_DOMAIN ); ?></span>
			</button>

		</div>

	</div>

	<?php
	// START: Item body ?>
	<div class="sui-accordion-item-body">

		<?php
			// ELEMENT: Tracking data
			$this->render(
				'admin/commons/sui-listing/elements/tracking-data',
				array(
					'module' => $module,
					'multiple_charts' => false,
					'last_entry_time' => esc_html__( 'Never', Opt_In::TEXT_DOMAIN ),
					'total_module_views' => 0,
					'total_module_conversions' => 0,
					'rate' => 0,
					'smallcaps_singular' => $smallcaps_singular,
					'module_type' => $module_type,
	  				'tracking_types' => $tracking_types,
				)
			);
		?>

	</div>

</div>
