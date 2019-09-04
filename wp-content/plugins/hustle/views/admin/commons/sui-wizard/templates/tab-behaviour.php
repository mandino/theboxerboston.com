<div class="sui-box" <?php if ( 'behavior' !== $section ) echo 'style="display: none;"'; ?> data-tab="behavior">

	<div class="sui-box-header">

		<h2 class="sui-box-title"><?php esc_html_e( 'Behavior', Opt_In::TEXT_DOMAIN ); ?></h2>

	</div>

	<div id="hustle-wizard-behaviour" class="sui-box-body"></div>

	<div class="sui-box-footer">

		<button class="sui-button wpmudev-button-navigation" data-direction="prev"><i class="sui-icon-arrow-left" aria-hidden="true"></i> <?php esc_html_e( 'Visibility', Opt_In::TEXT_DOMAIN ); ?></button>

		<div class="sui-actions-right">

			<button
				class="hustle-publish-button sui-button sui-button-blue hustle-action-save"
				data-active="1">
				<span class="sui-loading-text">
					<i class="sui-icon-web-globe-world" aria-hidden="true"></i>
					<span class="button-text"><?php $is_active ? esc_html_e( 'Save changes', Opt_In::TEXT_DOMAIN ) : esc_html_e( 'Publish', Opt_In::TEXT_DOMAIN ); ?></span>
				</span>
				<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
			</button>

		</div>

	</div>

</div>

<script id="hustle-wizard-behaviour-tpl" type="text/template">

	<?php
	if ( isset( $setting_trigger ) && true === $setting_trigger ) {

		// SETTING: Trigger
		$this->render(
			'admin/commons/sui-wizard/tab-behaviour/trigger',
			array(
				'module_type'         => isset( $module_type ) ? $module_type : 'module',
				//'module_name'         => $module_name,
				'capitalize_singular' => isset( $capitalize_singular ) ? $capitalize_singular : esc_html__( 'Module', Opt_In::TEXT_DOMAIN ),
				'capitalize_plural'   => isset( $capitalize_plural ) ? $capitalize_plural : esc_html__( 'Modules', Opt_In::TEXT_DOMAIN ),
				'smallcaps_singular'  => isset( $smallcaps_singular ) ? $smallcaps_singular : esc_html__( 'module', Opt_In::TEXT_DOMAIN ),
				'shortcode_id'		  => $shortcode_id,
			)
		);
	} ?>

	<?php
	if ( isset( $setting_position ) && true === $setting_position ) {

		// SETTING: Trigger
		$this->render(
			'admin/commons/sui-wizard/tab-behaviour/position',
			array(
				'module_type'         => isset( $module_type ) ? $module_type : 'module',
				'capitalize_singular' => isset( $capitalize_singular ) ? $capitalize_singular : esc_html__( 'Module', Opt_In::TEXT_DOMAIN ),
				'smallcaps_singular'  => isset( $smallcaps_singular ) ? $smallcaps_singular : esc_html__( 'module', Opt_In::TEXT_DOMAIN ),
			)
		);
	} ?>

	<?php
	if (
		( isset( $setting_animation_entrance ) && true === $setting_animation_entrance ) ||
		( isset( $setting_animation_exit ) && true === $setting_animation_exit )
	 ) {

		// SETTING: Animation Settings
		$this->render(
			'admin/commons/sui-wizard/tab-behaviour/animation-settings',
			array(
				'capitalize_singular' => isset( $capitalize_singular ) ? $capitalize_singular : esc_html__( 'Module', Opt_In::TEXT_DOMAIN ),
				'smallcaps_singular'  => isset( $smallcaps_singular ) ? $smallcaps_singular : esc_html__( 'module', Opt_In::TEXT_DOMAIN ),
				'entrance_animation'  => isset( $setting_animation_entrance ) ? $setting_animation_entrance : false,
				'exit_animation'      => isset( $setting_animation_exit ) ? $setting_animation_exit : false,
			)
		);
	} ?>

	<?php
	if (
		( isset( $setting_methods_autoclose ) && true === $setting_methods_autoclose ) ||
		( isset( $setting_methods_onclick ) && true === $setting_methods_onclick )
	) {

		// SETTING: Additional Closing Methods
		$this->render(
			'admin/commons/sui-wizard/tab-behaviour/closing-methods',
			array(
				'smallcaps_singular' => isset( $smallcaps_singular ) ? $smallcaps_singular : esc_html__( 'module', Opt_In::TEXT_DOMAIN ),
				'autoclose'          => isset( $setting_methods_autoclose ) ? $setting_methods_autoclose : false,
				'onclick'            => isset( $setting_methods_onclick ) ? $setting_methods_onclick : false,
				'module_type'		 => $module_type,
			)
		);
	} ?>

	<?php
	if ( isset( $setting_behaviour ) && true === $setting_behaviour ) {

		// SETTING: Closing Behavior
		$this->render(
			'admin/commons/sui-wizard/tab-behaviour/closing-behaviour',
			array(
				'module_type'         => isset( $module_type ) ? $module_type : 'module',
				'capitalize_singular' => isset( $capitalize_singular ) ? $capitalize_singular : esc_html__( 'Module', Opt_In::TEXT_DOMAIN ),
				'smallcaps_singular'  => isset( $smallcaps_singular ) ? $smallcaps_singular : esc_html__( 'module', Opt_In::TEXT_DOMAIN ),
				'module_type'		  => $module_type,
			)
		);
	} ?>

	<?php
	if ( isset( $setting_additional ) && true === $setting_additional ) {

		// SETTING: Additional Settings
		$this->render(
			'admin/commons/sui-wizard/tab-behaviour/additional-settings',
			array(
				'is_optin'           => $is_optin,
				'module_type'        => isset( $module_type ) ? $module_type : 'module',
				'smallcaps_singular' => isset( $smallcaps_singular ) ? $smallcaps_singular : esc_html__( 'module', Opt_In::TEXT_DOMAIN )
			)
		);
	} ?>

</script>
