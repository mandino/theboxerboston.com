<div class="sui-box" <?php if ( 'content' !== $section ) echo ' style="display: none;"'; ?> data-tab="content">

	<div class="sui-box-header">

		<h2 class="sui-box-title"><?php esc_html_e( 'Content', 'wordpress-popup' ); ?></h2>

	</div>

	<div id="hustle-wizard-content" class="sui-box-body"></div>

	<div class="sui-box-footer">

		<div class="sui-actions-right">
			<button class="sui-button sui-button-icon-right wpmudev-button-navigation" data-direction="next">
				<span class="sui-loading-text">
					<?php echo $is_optin ? esc_html__( 'Emails', 'wordpress-popup' ) : esc_html__( 'Appearance', 'wordpress-popup' ); ?> <i class="sui-icon-arrow-right" aria-hidden="true"></i>
				</span>
				<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
			</button>
		</div>

	</div>

</div>

<script id="hustle-wizard-content-tpl" type="text/template">

	<?php
	// SETTING: Title
	self::static_render(
		'admin/commons/sui-wizard/tab-content/title',
		array(
			'module_type'        => isset( $module_type ) ? $module_type : 'module',
			'smallcaps_singular' => isset( $smallcaps_singular ) ? $smallcaps_singular : esc_html__( 'module', 'wordpress-popup' ),
		)
	); ?>

	<?php
	// SETTING: Feature Image
	self::static_render(
		'admin/commons/sui-wizard/tab-content/feature-image',
		array(
			'is_optin'           => $is_optin,
			'smallcaps_singular' => isset( $smallcaps_singular ) ? $smallcaps_singular : esc_html__( 'module', 'wordpress-popup' ),
		)
	); ?>

	<?php
	// SETTING: Main Content
	self::static_render(
		'admin/commons/sui-wizard/tab-content/main-content',
		array()
	); ?>

	<?php
	// SETTING: Call To Action
	self::static_render(
		'admin/commons/sui-wizard/tab-content/call-to-action',
		array(
			'module_type'        => isset( $module_type ) ? $module_type : 'module',
			'smallcaps_singular' => isset( $smallcaps_singular ) ? $smallcaps_singular : esc_html__( 'module', 'wordpress-popup' ),
		)
	); ?>

	<?php
	if ( !empty( $module_type ) && 'embedded' !== $module_type ) {
		// SETTING: "Never See This Link" Again
		self::static_render(
			'admin/commons/sui-wizard/tab-content/never-see-link',
			array()
		);
	} ?>

</script>
