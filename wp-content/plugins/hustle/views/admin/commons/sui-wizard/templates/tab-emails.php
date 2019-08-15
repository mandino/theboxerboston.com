<div class="sui-box" <?php if ( 'emails' !== $section ) echo 'style="display: none;"'; ?> data-tab="emails">

	<div class="sui-box-header">

		<h2 class="sui-box-title"><?php esc_html_e( 'Emails', Opt_In::TEXT_DOMAIN ); ?></h2>

	</div>

	<div id="hustle-wizard-emails" class="sui-box-body"></div>

	<div class="sui-box-footer">

		<button class="sui-button wpmudev-button-navigation" data-direction="prev"><i class="sui-icon-arrow-left" aria-hidden="true"></i> <?php esc_html_e( 'Content', Opt_In::TEXT_DOMAIN ); ?></button>

		<div class="sui-actions-right">
			<button class="sui-button sui-button-icon-right wpmudev-button-navigation" data-direction="next"><?php esc_html_e( 'Integrations', Opt_In::TEXT_DOMAIN ); ?> <i class="sui-icon-arrow-right" aria-hidden="true"></i></button>
		</div>

	</div>

</div>


<script id="hustle-wizard-emails-tpl" type="text/template">

	<?php
	// SETTING: Opt-in Form Fields
	$this->render(
		'admin/commons/sui-wizard/tab-emails/form-fields',
		array( 'module' => $module )
	); ?>

	<?php
	// SETTING: Submission Behavior
	$this->render(
		'admin/commons/sui-wizard/tab-emails/submission-behaviour',
		array()
	); ?>

	<?php
	// SETTING: Automated Email
	$this->render(
		'admin/commons/sui-wizard/tab-emails/automated-email',
		array()
	); ?>

</script>
