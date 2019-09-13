<div class="sui-box" <?php if ( 'appearance' !== $section ) echo 'style="display: none;"'; ?> data-tab="appearance">

	<div class="sui-box-header">

		<h2 class="sui-box-title"><?php esc_html_e( 'Appearance', 'wordpress-popup' ); ?></h2>

	</div>

	<div id="hustle-wizard-appearance" class="sui-box-body"></div>

	<div class="sui-box-footer">

		<button class="sui-button wpmudev-button-navigation" data-direction="prev">
			<i class="sui-icon-arrow-left" aria-hidden="true"></i> <?php echo $is_optin ? esc_html__( 'Integrations', 'wordpress-popup' ) : esc_html__( 'Content', 'wordpress-popup' ); ?>
		</button>

		<div class="sui-actions-right">

			<?php if ( 'embedded' === $module_type ) { ?>

				<button class="sui-button sui-button-icon-right wpmudev-button-navigation" data-direction="next">
					<?php esc_html_e( 'Display Options', 'wordpress-popup' ); ?> <i class="sui-icon-arrow-right" aria-hidden="true"></i>
				</button>

			<?php } else { ?>

				<button class="sui-button sui-button-icon-right wpmudev-button-navigation" data-direction="next">
					<?php esc_html_e( 'Visibility', 'wordpress-popup' ); ?> <i class="sui-icon-arrow-right" aria-hidden="true"></i>
				</button>

			<?php } ?>

		</div>

	</div>

</div>

<script id="hustle-wizard-appearance-tpl" type="text/template">

	<?php
	// SETTING: Layout
	self::static_render(
		'admin/commons/sui-wizard/tab-appearance/layout',
		array(
			'is_optin'           => $is_optin,
			'smallcaps_singular' => isset( $smallcaps_singular ) ? $smallcaps_singular : esc_html__( 'module', 'wordpress-popup' ),
		)
	); ?>

	<?php
	// SETTING: Feature Image
	self::static_render(
		'admin/commons/sui-wizard/tab-appearance/feature-image',
		array(
			'is_optin'           => $is_optin,
			'smallcaps_singular' => isset( $smallcaps_singular ) ? $smallcaps_singular : esc_html__( 'module', 'wordpress-popup' ),
			'settings'			 => $settings,
			'feature_image'		 => $feature_image,
		)
	); ?>

	<?php if ( $is_optin ) {

		// SETTING: Form Design
		self::static_render(
			'admin/commons/sui-wizard/tab-appearance/form-design',
			array()
		);

	} ?>

	<?php
	// SETTING: Colors Palette
	self::static_render(
		'admin/commons/sui-wizard/tab-appearance/colors-palette',
		array(
			'is_optin'           => $is_optin,
			'module_type'		 => $module_type,
			'smallcaps_singular' => isset( $smallcaps_singular ) ? $smallcaps_singular : esc_html__( 'module', 'wordpress-popup' ),
		)
	); ?>

	<?php
	// SETTING: Border
	self::static_render(
		'admin/commons/sui-wizard/tab-appearance/border',
		array(
			'module_type'        => $module_type,
			'smallcaps_singular' => isset( $smallcaps_singular ) ? $smallcaps_singular : esc_html__( 'module', 'wordpress-popup' ),
		)
	); ?>

	<?php
	// SETTING: Drop Shadow
	self::static_render(
		'admin/commons/sui-wizard/tab-appearance/drop-shadow',
		array(
			'module_type'        => $module_type,
			'smallcaps_singular' => isset( $smallcaps_singular ) ? $smallcaps_singular : esc_html__( 'module', 'wordpress-popup' ),
		)
	); ?>

	<?php
	// SETTING: Custom Size
	self::static_render(
		'admin/commons/sui-wizard/tab-appearance/custom-size',
		array(
			'capitalize_singular' => isset( $capitalize_singular ) ? $capitalize_singular : esc_html__( 'Module', 'wordpress-popup' ),
			'smallcaps_singular'  => isset( $smallcaps_singular ) ? $smallcaps_singular : esc_html__( 'module', 'wordpress-popup' ),
		)
	); ?>

	<?php
	// SETTING: Custom CSS
	self::static_render(
		'admin/commons/sui-wizard/tab-appearance/custom-css',
		array( 'is_optin' => $is_optin )
	); ?>

</script>
