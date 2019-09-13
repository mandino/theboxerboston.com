<div class="sui-box" <?php if ( 'display' !== $section ) echo 'style="display: none;"'; ?> data-tab="display">

	<div class="sui-box-header">

		<h2 class="sui-box-title"><?php esc_html_e( 'Display Options', 'wordpress-popup' ); ?></h2>

	</div>

	<div id="hustle-wizard-display" class="sui-box-body"></div>

	<div class="sui-box-footer">

		<button class="sui-button wpmudev-button-navigation" data-direction="prev">
			<i class="sui-icon-arrow-left" aria-hidden="true"></i> <?php esc_html_e( 'Appearance', 'wordpress-popup' ); ?>
		</button>

		<div class="sui-actions-right">

			<button class="sui-button sui-button-icon-right wpmudev-button-navigation" data-direction="next">
				<?php esc_html_e( 'Visibility', 'wordpress-popup' ); ?> <i class="sui-icon-arrow-right" aria-hidden="true"></i>
			</button>

		</div>

	</div>

</div>

<script id="hustle-wizard-display-tpl" type="text/template">

	<?php
	// SETTING: Display Options
	self::static_render(
		'admin/commons/sui-wizard/tab-display-options/display-options',
		array(
			'shortcode_id' => $shortcode_id,
		)
	); ?>

</script>
