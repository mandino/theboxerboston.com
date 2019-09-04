<div class="sui-box" <?php if ( 'services' !== $section ) echo ' style="display: none;"'; ?> data-tab="services">

	<div id="hustle-wizard-content" class="sui-box-body"></div>

	<div class="sui-box-footer">

		<div class="sui-actions-right">
			<button class="sui-button sui-button-icon-right wpmudev-button-navigation" data-direction="next">
				<span class="sui-loading-text">
					<?php esc_html_e( 'Display Options', Opt_In::TEXT_DOMAIN ); ?> <i class="sui-icon-arrow-right" aria-hidden="true"></i>
				</span>
				<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
			</button>
		</div>

	</div>

</div>

<script id="hustle-wizard-content-tpl" type="text/template">

	<?php
	// SETTING: Counter
	$this->render(
		'admin/sshare/services/tpl--counter',
		array()
	); ?>

	<?php
	// SETTING: Social Services
	$this->render(
		'admin/sshare/services/tpl--social-services',
		array(
			'content_settings' => $content_settings,
		)
	); ?>

</script>
