<script type="text/template" id="hustle-dialog--delete-tpl">

	<input type="hidden" name="hustle_action" value="{{ action }}" />
	<# if ( 'undefined' !== typeof id ) { #>
		<input type="hidden" name="id" value="{{ id }}" />
	<# } else { #>
		<input type="hidden" name="ids" value="{{ ids }}" />
	<# } #>
	<input type="hidden" id="hustle_nonce" name="hustle_nonce" value="{{ nonce }}" />

</script>

<script type="text/template" id="hustle-dialog--delete-title-tpl">
	<#
	window.hustle_plural = false;
	window.hustle_entry = false;
	window.hustle_entity = false;

	if ( 'undefined' !== typeof dialogQuality && 'plural' === dialogQuality ) {
		window.hustle_plural = true;
	}

	if ( 'popup' === dialogType ) {
		window.hustle_entity = window.hustle_plural ? '<?php esc_attr_e( 'Pop-ups', 'wordpress-popup' ); ?>' : '<?php esc_attr_e( 'Pop-up', 'wordpress-popup' ); ?>';
	} else if ( 'slidein' === dialogType ) {
		window.hustle_entity = window.hustle_plural ? '<?php esc_attr_e( 'Slide-ins', 'wordpress-popup' ); ?>' : '<?php esc_attr_e( 'Slide-in', 'wordpress-popup' ); ?>';
	} else if ( 'embedded' === dialogType ) {
		window.hustle_entity = window.hustle_plural ? '<?php esc_attr_e( 'Embeds', 'wordpress-popup' ); ?>' : '<?php esc_attr_e( 'Embed', 'wordpress-popup' ); ?>';
	} else if ( 'social_sharing' === dialogType ) {
		window.hustle_entity = window.hustle_plural ? '<?php esc_attr_e( 'Social Shares', 'wordpress-popup' ); ?>' : '<?php esc_attr_e( 'Social Sharing', 'wordpress-popup' ); ?>';
	} else {
		window.hustle_entity = window.hustle_plural ? '<?php esc_attr_e( 'entries', 'wordpress-popup' ); ?>' : '<?php esc_attr_e( 'entry', 'wordpress-popup' ); ?>';
		window.hustle_entry = true;
	} #>

	<?php printf( esc_html__( 'Delete %s', 'wordpress-popup' ), '{{window.hustle_entity}}' ); ?>
</script>

<script type="text/template" id="hustle-dialog--delete-description-tpl">
	<# if ( window.hustle_entry ) { #>
		<# if ( window.hustle_plural ) { #>
			<?php printf( esc_html__( 'Are you sure you wish to permanently delete these %s?', 'wordpress-popup' ), '{{window.hustle_entity}}' ); ?>
		<# } else { #>
			<?php printf( esc_html__( 'Are you sure you wish to permanently delete this %s?', 'wordpress-popup' ), '{{window.hustle_entity}}' ); ?>
		<# } #>
	<# } else { #>
		<# if ( window.hustle_plural ) { #>
			<?php printf( esc_html__( "Are you sure you wish to permanently delete these %s? Their additional data, like subscriptions and tracking data, will be deleted as well.", 'wordpress-popup' ), '{{window.hustle_entity}}' ); ?>
		<# } else { #>
			<?php printf( esc_html__( "Are you sure you wish to permanently delete this %s? Its additional data, like subscriptions and tracking data, will be deleted as well.", 'wordpress-popup' ), '{{window.hustle_entity}}' ); ?>
		<# } #>
	<# } #>
</script>

<div id="hustle-dialog--delete" class="sui-dialog sui-dialog-alt sui-dialog-sm" aria-hidden="true" tabindex="-1">

	<div class="sui-dialog-overlay sui-fade-out" data-a11y-dialog-hide="hustle-dialog--delete"></div>

	<div role="dialog"
		class="sui-dialog-content sui-bounce-out"
		aria-labelledby="dialogTitle"
		aria-describedby="dialogDescription">

		<div class="sui-box" role="document">

			<div class="sui-box-header sui-block-content-center">

				<h3 id="dialogTitle" class="sui-box-title"></h3>

				<button class="sui-dialog-close" data-a11y-dialog-hide="hustle-dialog--delete">
					<span class="sui-screen-reader-text"><?php esc_html_e( 'Close this dialog window', 'wordpress-popup' ); ?></span>
				</button>

			</div>

			<div class="sui-box-body sui-box-body-slim sui-block-content-center">

				<p id="dialogDescription" class="sui-description"></p>

				<form method="post" style="margin-bottom: 10px;">

					<div id="hustle-dialog--delete-form"></div>

					<button type="button" class="sui-button sui-button-ghost" data-a11y-dialog-hide="hustle-dialog--delete">
						<?php esc_attr_e( 'Cancel', 'wordpress-popup' ); ?>
					</button>

					<button class="sui-button sui-button-ghost sui-button-red hustle-delete-confirm">
						<span class="sui-loading-text">
							<i class="sui-icon-trash" aria-hidden="true"></i> <?php esc_attr_e( 'Delete', 'wordpress-popup' ); ?>
						</span>
						<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
					</button>

				</form>

			</div>

		</div>

	</div>

</div>
