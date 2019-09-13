<div class="sui-box" <?php if ( 'display' !== $section ) echo 'style="display: none;"'; ?> data-tab="display">

	<div class="sui-box-header">

		<h2 class="sui-box-title"><?php esc_html_e( 'Display Options', 'wordpress-popup' ); ?></h2>

	</div>

	<div id="hustle-wizard-display" class="sui-box-body"></div>

	<div class="sui-box-footer">

		<button class="sui-button wpmudev-button-navigation" data-direction="prev">
			<i class="sui-icon-arrow-left" aria-hidden="true"></i> <?php esc_html_e( 'Services', 'wordpress-popup' ); ?>
		</button>

		<div class="sui-actions-right">

			<button class="sui-button sui-button-icon-right wpmudev-button-navigation" data-direction="next">
				<?php esc_html_e( 'Appearance', 'wordpress-popup' ); ?> <i class="sui-icon-arrow-right" aria-hidden="true"></i>
			</button>

		</div>

	</div>

</div>

<script id="hustle-wizard-display-tpl" type="text/template">

	<?php
	// SETTING: Floating Social
	self::static_render(
		'admin/sshare/display-options/tpl--floating-social',
		array( 'display_settings' => $display_settings )
	); ?>

	<?php
	// SETTING: Inline Content
	self::static_render(
		'admin/sshare/display-options/tpl--inline-content',
		array( 'display_settings' => $display_settings )
	); ?>

	<?php
	// SETTING: Widget
	self::static_render(
		'admin/sshare/display-options/tpl--widget',
		array()
	); ?>

	<?php
	// SETTING: Shortcode
	self::static_render(
		'admin/sshare/display-options/tpl--shortcode',
		array(
			'shortcode_id' => $shortcode_id,
		)
	); ?>

</script>
