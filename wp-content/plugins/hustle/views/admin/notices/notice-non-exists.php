<div class="sui-notice-top sui-notice-error sui-can-dismiss sui-can-dismiss">
    <div class="sui-notice-content">
<p><?php esc_html_e( 'Oops! The module you are looking for doesn\'t exist.', Opt_In::TEXT_DOMAIN ); ?>
<?php
if ( 0 < $total && $capability['hustle_create'] ) {
	printf(
		__(
			' You can <a href="#"%s>create</a> a new module or <a href="#"%s>import</a> an existing module.',
			Opt_In::TEXT_DOMAIN
		),
		'data-a11y-dialog-show="hustle-dialog--add-new-module"',
		'data-a11y-dialog-show="hustle-dialog--import"'
	);
}
?></p>
    </div>

	<span class="sui-notice-dismiss">
		<a role="button" href="#" aria-label="<?php esc_html_e( 'Dismiss', Opt_In::TEXT_DOMAIN ); ?>" class="sui-icon-check"></a>
	</span>
</div>
