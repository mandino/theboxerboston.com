<div class="sui-box sui-box-sticky">

	<div class="sui-box-status">

		<div class="sui-status">

			<div class="sui-status-module">

				<?php esc_html_e( 'Status', Opt_In::TEXT_DOMAIN ); ?>

				<?php if ( $is_active ) : ?>
					<span class="sui-tag sui-tag-blue"><?php esc_html_e( 'Published', Opt_In::TEXT_DOMAIN ); ?></span>
				<?php else : ?>
					<span class="sui-tag"><?php esc_html_e( 'Draft', Opt_In::TEXT_DOMAIN ); ?></span>
				<?php endif; ?>

			</div>

			<div id="hustle-unsaved-changes-status" class="sui-status-changes sui-hidden">
				<i class="sui-icon-update" aria-hidden="true"></i>
				<?php esc_html_e( 'Unsaved changes', Opt_In::TEXT_DOMAIN ); ?>
			</div>

			<div id="hustle-saved-changes-status" class="sui-status-changes">
				<i class="sui-icon-check-tick" aria-hidden="true"></i>
				<?php esc_html_e( 'Saved', Opt_In::TEXT_DOMAIN ); ?>
			</div>

		</div>

		<div class="sui-actions">

			<button id="hustle-draft-button"
				class="sui-button hustle-action-save"
				data-active="0">
				<span class="sui-loading-text">
					<i class="sui-icon-save" aria-hidden="true"></i>
					<span class="button-text"><?php $is_active ? esc_html_e( 'Unpublish', Opt_In::TEXT_DOMAIN ) : esc_html_e( 'Save draft', Opt_In::TEXT_DOMAIN ); ?></span>
				</span>
				<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
			</button>

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
