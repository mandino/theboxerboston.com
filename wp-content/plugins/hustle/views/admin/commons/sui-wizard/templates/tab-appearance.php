<div class="sui-box" <?php if ( 'appearance' !== $section ) echo 'style="display: none;"'; ?> data-tab="appearance">

	<div class="sui-box-header">

		<h2 class="sui-box-title"><?php esc_html_e( 'Appearance', Opt_In::TEXT_DOMAIN ); ?></h2>

	</div>

	<div id="hustle-wizard-appearance" class="sui-box-body"></div>

	<div class="sui-box-footer">

		<button class="sui-button wpmudev-button-navigation" data-direction="prev">
			<i class="sui-icon-arrow-left" aria-hidden="true"></i> <?php echo $is_optin ? esc_html__( 'Integrations', Opt_In::TEXT_DOMAIN ) : esc_html__( 'Content', Opt_In::TEXT_DOMAIN ); ?>
		</button>

		<div class="sui-actions-right">

			<?php if ( 'embedded' === $module_type ) { ?>

				<button class="sui-button sui-button-icon-right wpmudev-button-navigation" data-direction="next">
					<?php esc_html_e( 'Display Options', Opt_In::TEXT_DOMAIN ); ?> <i class="sui-icon-arrow-right" aria-hidden="true"></i>
				</button>

			<?php } else { ?>

				<button class="sui-button sui-button-icon-right wpmudev-button-navigation" data-direction="next">
					<?php esc_html_e( 'Visibility', Opt_In::TEXT_DOMAIN ); ?> <i class="sui-icon-arrow-right" aria-hidden="true"></i>
				</button>

			<?php } ?>

		</div>

	</div>

</div>

<script id="hustle-wizard-appearance-tpl" type="text/template">

	<?php
	// SETTING: Layout
	$this->render(
		'admin/commons/sui-wizard/tab-appearance/layout',
		array(
			'is_optin'           => $is_optin,
			'smallcaps_singular' => isset( $smallcaps_singular ) ? $smallcaps_singular : esc_html__( 'module', Opt_In::TEXT_DOMAIN ),
		)
	); ?>

	<?php
	// SETTING: Feature Image
	$this->render(
		'admin/commons/sui-wizard/tab-appearance/feature-image',
		array(
			'is_optin'           => $is_optin,
			'smallcaps_singular' => isset( $smallcaps_singular ) ? $smallcaps_singular : esc_html__( 'module', Opt_In::TEXT_DOMAIN ),
			'settings'			 => $settings,
			'feature_image'		 => $feature_image,
		)
	); ?>

	<?php if ( $is_optin ) {

		// SETTING: Form Design
		$this->render(
			'admin/commons/sui-wizard/tab-appearance/form-design',
			array()
		);

	} ?>

	<?php
	// SETTING: Colors Palette
	$this->render(
		'admin/commons/sui-wizard/tab-appearance/colors-palette',
		array(
			'is_optin'           => $is_optin,
			'module_type'		 => $module_type,
			'smallcaps_singular' => isset( $smallcaps_singular ) ? $smallcaps_singular : esc_html__( 'module', Opt_In::TEXT_DOMAIN ),
		)
	); ?>

	<?php
	// SETTING: Border
	$this->render(
		'admin/commons/sui-wizard/tab-appearance/border',
		array(
			'module_type'        => $module_type,
			'smallcaps_singular' => isset( $smallcaps_singular ) ? $smallcaps_singular : esc_html__( 'module', Opt_In::TEXT_DOMAIN ),
		)
	); ?>

	<?php
	// SETTING: Drop Shadow
	$this->render(
		'admin/commons/sui-wizard/tab-appearance/drop-shadow',
		array(
			'module_type'        => $module_type,
			'smallcaps_singular' => isset( $smallcaps_singular ) ? $smallcaps_singular : esc_html__( 'module', Opt_In::TEXT_DOMAIN ),
		)
	); ?>

	<?php
	// SETTING: Custom Size
	$this->render(
		'admin/commons/sui-wizard/tab-appearance/custom-size',
		array(
			'capitalize_singular' => isset( $capitalize_singular ) ? $capitalize_singular : esc_html__( 'Module', Opt_In::TEXT_DOMAIN ),
			'smallcaps_singular'  => isset( $smallcaps_singular ) ? $smallcaps_singular : esc_html__( 'module', Opt_In::TEXT_DOMAIN ),
		)
	); ?>

	<?php
	// SETTING: Custom CSS
	$this->render(
		'admin/commons/sui-wizard/tab-appearance/custom-css',
		array( 'is_optin' => $is_optin )
	); ?>

</script>
