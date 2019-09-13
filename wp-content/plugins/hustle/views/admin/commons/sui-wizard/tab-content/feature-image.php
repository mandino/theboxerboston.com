<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">

		<span class="sui-settings-label"><?php esc_html_e( 'Feature Image', 'wordpress-popup' ); ?></span>

		<span class="sui-description"><?php esc_html_e( 'We recommend adding a feature image related clearly to your offering to convert more visitors.', 'wordpress-popup' ); ?></span>

	</div>

	<div class="sui-box-settings-col-2">

		<div class="sui-form-field">

			<label class="sui-label"><?php esc_html_e( 'Upload Feature Image (optional)', 'wordpress-popup' ); ?></label>

			<?php self::static_render( 'admin/commons/sui-wizard/elements/image-upload', array() ); ?>

		</div>

	</div>

</div>
