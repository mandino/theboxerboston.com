<div class="sui-box sui-box-sticky">

	<div class="sui-box-status">

		<div class="sui-status">

			<div class="sui-status-module">

				<?php esc_html_e( 'Status', 'wordpress-popup' ); ?>

				<?php if ( $is_active ) : ?>
					<span class="sui-tag sui-tag-blue"><?php esc_html_e( 'Published', 'wordpress-popup' ); ?></span>
				<?php else : ?>
					<span class="sui-tag"><?php esc_html_e( 'Draft', 'wordpress-popup' ); ?></span>
				<?php endif; ?>

			</div>

			<div id="hustle-unsaved-changes-status" class="sui-status-changes sui-hidden">
				<i class="sui-icon-update" aria-hidden="true"></i>
				<?php esc_html_e( 'Unsaved changes', 'wordpress-popup' ); ?>
			</div>

			<div id="hustle-saved-changes-status" class="sui-status-changes">
				<i class="sui-icon-check-tick" aria-hidden="true"></i>
				<?php esc_html_e( 'Saved', 'wordpress-popup' ); ?>
			</div>

		</div>

		<div class="sui-actions">

			<button id="hustle-draft-button"
				class="sui-button hustle-action-save"
				data-active="0">
				<span class="sui-loading-text">
					<i class="sui-icon-save" aria-hidden="true"></i>
					<span class="button-text"><?php $is_active ? esc_html_e( 'Unpublish', 'wordpress-popup' ) : esc_html_e( 'Save draft', 'wordpress-popup' ); ?></span>
				</span>
				<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
			</button>

			<button
				class="hustle-publish-button sui-button sui-button-blue hustle-action-save"
				data-active="1">
				<span class="sui-loading-text">
					<i class="sui-icon-web-globe-world" aria-hidden="true"></i>
					<span class="button-text"><?php $is_active ? esc_html_e( 'Save changes', 'wordpress-popup' ) : esc_html_e( 'Publish', 'wordpress-popup' ); ?></span>
				</span>
				<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
			</button>

		</div>

	</div>

</div>
