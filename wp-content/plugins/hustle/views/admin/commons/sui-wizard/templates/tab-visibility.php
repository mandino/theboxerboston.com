<?php
if ( isset( $capitalize_singular ) ) {
	$capitalize_singular = $capitalize_singular;
} else {
	$capitalize_singular = esc_html__( 'Module', 'wordpress-popup' );
}

if ( isset( $smallcaps_singular ) ) {
	$smallcaps_singular = $smallcaps_singular;
} else {
	$smallcaps_singular = esc_html__( 'module', 'wordpress-popup' );
} ?>

<div class="sui-box" <?php if ( 'visibility' !== $section ) echo 'style="display: none;"'; ?> data-tab="visibility">

	<div class="sui-box-header">

		<h2 class="sui-box-title"><?php esc_html_e( 'Visibility', 'wordpress-popup' ); ?></h2>

	</div>

	<div class="sui-box-body">

		<div class="sui-box-settings-row">

			<div class="sui-box-settings-col-1">

				<span class="sui-settings-label"><?php printf( esc_html__( '%s Visibility Rules', 'wordpress-popup' ), esc_html( $capitalize_singular ) ); ?></span>

				<span class="sui-description"><?php printf( esc_html__( 'Select posts, pages and other conditions under which you want to display this %s.', 'wordpress-popup' ), esc_html( $smallcaps_singular ) ); ?><br />&nbsp;<br /><?php printf( esc_html__( 'By default, your %s will be shown on every post & page if no condition is applied.', 'wordpress-popup' ), esc_html( $smallcaps_singular ) ); ?></span>

				<?php if ( isset( $description_line1 ) && '' !== $description_line1 ) { ?>

					<?php if ( isset( $description_line2 ) && '' !== $description_line2 ) {
						$line2 = '<br />&nbsp;<br />' . $description_line2;
					} ?>

					<span class="sui-description"><?php echo esc_attr( $description_line1 ); ?><?php echo $line2; // WPCS: XSS ok. ?></span>

				<?php } ?>

			</div>

			<div id="hustle-conditions-group" class="sui-box-settings-col-2">

				<div id="hustle-visibility-conditions-box">

					<div class="hustle-add-new-visibility-group"></div>

					<?php /*
					<button class="sui-button sui-button-ghost hustle-add-new-visibility-group">
						<i class="sui-icon-plus" aria-hidden="true"></i>
						<?php esc_html_e( 'Add Condition Group', 'wordpress-popup' ); ?>
					</button>
					*/ ?>

				</div>

			</div>

		</div>

	</div>

	<div class="sui-box-footer">

		<button class="sui-button wpmudev-button-navigation" data-direction="prev">
			<i class="sui-icon-arrow-left" aria-hidden="true"></i> <?php esc_html_e( 'Appearance', 'wordpress-popup' ); ?>
		</button>

		<div class="sui-actions-right">

			<?php if ( 'social_sharing' !== $module_type ) { ?>

				<button class="sui-button sui-button-icon-right wpmudev-button-navigation">
					<?php esc_html_e( 'Behavior', 'wordpress-popup' ); ?> <i class="sui-icon-arrow-right" aria-hidden="true"></i>
				</button>

			<?php } else { ?>

				<button
					class="hustle-publish-button sui-button sui-button-blue hustle-action-save"
					data-active="1">
					<span class="sui-loading-text">
						<i class="sui-icon-web-globe-world" aria-hidden="true"></i>
						<span class="button-text"><?php $is_active ? esc_html_e( 'Save changes', 'wordpress-popup' ) : esc_html_e( 'Publish', 'wordpress-popup' ); ?></span>
					</span>
					<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
				</button>

			<?php } ?>
		</div>

	</div>

</div>
