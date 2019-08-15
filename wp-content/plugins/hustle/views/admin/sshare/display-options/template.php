<div class="sui-box" <?php if ( 'display' !== $section ) echo 'style="display: none;"'; ?> data-tab="display">

	<div id="hustle-wizard-display" class="sui-box-body"></div>

	<div class="sui-box-footer">

		<button class="sui-button wpmudev-button-navigation" data-direction="prev">
			<i class="sui-icon-arrow-left" aria-hidden="true"></i> <?php esc_html_e( 'Services', Opt_In::TEXT_DOMAIN ); ?>
		</button>

		<div class="sui-actions-right">

			<button class="sui-button sui-button-icon-right wpmudev-button-navigation" data-direction="next">
				<?php esc_html_e( 'Appearance', Opt_In::TEXT_DOMAIN ); ?> <i class="sui-icon-arrow-right" aria-hidden="true"></i>
			</button>

		</div>

	</div>

</div>

<script id="hustle-wizard-display-tpl" type="text/template">

	<?php
	// SETTING: Floating Social
	$this->render(
		'admin/sshare/display-options/tpl--floating-social',
		array( 'display_settings' => $display_settings )
	); ?>

	<?php
	// SETTING: Inline Content
	$this->render(
		'admin/sshare/display-options/tpl--inline-content',
		array( 'display_settings' => $display_settings )
	); ?>

	<?php
	// SETTING: Widget
	$this->render(
		'admin/sshare/display-options/tpl--widget',
		array()
	); ?>

	<?php
	// SETTING: Shortcode
	$this->render(
		'admin/sshare/display-options/tpl--shortcode',
		array(
			'shortcode_id' => $shortcode_id,
		)
	); ?>

</script>
