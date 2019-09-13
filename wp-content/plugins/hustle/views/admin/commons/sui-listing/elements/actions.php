<?php
$is_embedded_or_social = Hustle_Module_Model::EMBEDDED_MODULE === $module->module_type || Hustle_Module_Model::SOCIAL_SHARING_MODULE === $module->module_type;

// BUTTON: Open dropdown list ?>
<button class="sui-button-icon sui-dropdown-anchor" aria-expanded="false">
	<span class="sui-loading-text">
		<i class="sui-icon-widget-settings-config" aria-hidden="true"></i>
	</span>
	<span class="sui-screen-reader-text"><?php esc_html_e( 'More options', 'wordpress-popup' ); ?></span>
	<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
</button>

<ul>
	<?php if ( ! empty( $dashboard ) ) :
			// Edit module
			$url = $module->decorated->get_edit_url();
		?>
		<li><a href="<?php echo esc_url( $url ); ?>" class="hustle-onload-icon-action">
			<i class="sui-icon-pencil" aria-hidden="true"></i>
			<?php esc_html_e( 'Edit', 'wordpress-popup' ); ?>
		</a></li>
	<?php endif; ?>

	<?php if ( Hustle_Module_Model::SOCIAL_SHARING_MODULE !== $module->module_type ) :
		// Preview module ?>
		<li><button
			class="hustle-preview-module-button hustle-onload-icon-action"
			data-id="<?php echo esc_attr( $module->id ); ?>"
			data-type="<?php echo esc_attr( $module->module_type ); ?>">
			<i class="sui-icon-eye" aria-hidden="true"></i>
			<?php esc_html_e( 'Preview', 'wordpress-popup' ); ?>
		</button></li>
	<?php endif; ?>

	<?php // Copy shortcode
	if ( $is_embedded_or_social ) : ?>
		<li><button
			class="hustle-copy-shortcode-button"
			data-shortcode='[wd_hustle id="<?php echo esc_attr( $module->get_shortcode_id() ); ?>" type="<?php echo esc_attr( $module->module_type ); ?>"/]'>
			<i class="sui-icon-code" aria-hidden="true"></i>
			<?php esc_html_e( 'Copy Shortcode', 'wordpress-popup' ); ?>
		</button></li>
	<?php endif; ?>

	<?php
	// Toggle Status button
	$published = $module->active; ?>
	<li><button
		class="hustle-toggle-status-module-button hustle-onload-icon-action"
		data-id="<?php echo esc_attr( $module->id ); ?>"
		data-nonce="<?php echo esc_attr( wp_create_nonce( 'module_toggle_state' ) ); ?>"
		data-enabled="<?php echo esc_attr( $module->active ); ?>"
		data-type="<?php echo esc_attr( $module->module_type ); ?>"
	>
		<span class="<?php echo $published ? '' : 'sui-hidden'; ?>">
			<i class="sui-icon-unpublish" aria-hidden="true"></i>
			<?php esc_html_e( 'Unpublish', 'wordpress-popup' ); ?>
		</span>
		<span class="<?php echo $published ? ' sui-hidden' : ''; ?>">
			<i class="sui-icon-web-globe-world" aria-hidden="true"></i>
			<?php esc_html_e( 'Publish', 'wordpress-popup' ); ?>
		</span>
	</button></li>

<?php
	// View Email List
if (
		Hustle_Module_Model::SOCIAL_SHARING_MODULE !== $module->module_type
		&& $capability['hustle_access_emails']
		&& 'optin' === $module->module_mode
	) {
	$url = add_query_arg(
		array(
		'page' => Hustle_Module_Admin::ENTRIES_PAGE,
		'module_type' => $module->module_type,
		'module_id' => $module->module_id,
		),
		admin_url( 'admin.php' )
	);
	printf( '<li><a href="%s" class="hustle-onload-icon-action">', esc_url( $url ) );
	echo '<i class="sui-icon-community-people" aria-hidden="true"></i> ';
	esc_html_e( 'View Email List', 'wordpress-popup' );
	echo '</a></li>';
}
?>

<?php // Duplicate ?>
<?php if ( empty( $dashboard ) ) : ?>
	<li>
		<form method="post">
			<input type="hidden" name="hustle_action" value="duplicate">
			<input type="hidden" name="id" value="<?php echo esc_attr( $module->id ); ?>">
			<input type="hidden" name="hustle_nonce" value="<?php echo esc_attr( wp_create_nonce( 'hustle_listing_request' ) ); ?>">
			<button class="<?php echo $can_create ? 'hustle-onload-icon-action' : 'hustle-upgrade-modal-button'; ?>">
				<i class="sui-icon-copy" aria-hidden="true"></i>
				<?php esc_html_e( 'Duplicate', 'wordpress-popup' ); ?>
			</button>
		</form>
	</li>
<?php endif; ?>

<?php // Tracking ?>
<?php if ( empty( $dashboard ) ) : ?>
	<?php $is_tracking_enabled = $module->is_tracking_enabled( $module->module_type ); ?>
	<li>
		<?php if ( ! $is_embedded_or_social ) : ?>
			<button
				class="hustle-toggle-tracking-module-button hustle-onload-icon-action"
				data-id="<?php echo esc_attr( $module->id ); ?>"
				data-nonce="<?php echo esc_attr( wp_create_nonce( 'hustle_toggle_tracking' ) ); ?>"
				data-enabled="<?php echo esc_attr( $is_tracking_enabled ); ?>"
				data-module-name="<?php echo esc_attr( $module->module_name ); ?>"
			>
				<span class="<?php echo $is_tracking_enabled ? '' : 'sui-hidden'; ?>">
					<i class="sui-icon-tracking-disabled" aria-hidden="true"></i>
					<?php esc_html_e( 'Disable Tracking', 'wordpress-popup' ); ?>
				</span>
				<span class="<?php echo $is_tracking_enabled ? ' sui-hidden' : ''; ?>">
					<i class="sui-icon-graph-line" aria-hidden="true"></i>
					<?php esc_html_e( 'Enable Tracking', 'wordpress-popup' ); ?>
				</span>
			</button>
		<?php
		else :
			$trackings = $module->get_tracking_types();
			$enabled_trackings = $trackings ? implode( ',', array_keys( $trackings ) ) : '';
			?>
			<button
				class="hustle-manage-tracking-button"
				data-module-id="<?php echo esc_attr( $module->id ); ?>"
				data-module-type="<?php echo esc_attr( $module->module_type ); ?>"
				data-tracking-types="<?php echo esc_attr( $enabled_trackings ); ?>"
			>
				<i class="sui-icon-graph-line" aria-hidden="true"></i>
				<?php esc_html_e( 'Manage Tracking', 'wordpress-popup' ); ?>
			</button>
		<?php endif; ?>
	</li>

	<li>
		<button class="hustle-module-tracking-reset-button"
				data-nonce="<?php echo esc_attr( wp_create_nonce( 'hustle_module_tracking_reset' ) ); ?>"
				data-id="<?php echo esc_attr( $module->id ); ?>"
				data-dialog-id="hustle-dialog--tracking-reset-data"
			>
			<i class="sui-icon-undo" aria-hidden="true"></i> <?php esc_html_e( 'Reset Tracking Data', 'wordpress-popup' ); ?>
		</button>
	</li>

<?php endif; ?>

	<?php // Export ?>
	<li>
		<form method="post">
			<input type="hidden" name="hustle_action" value="export">
			<input type="hidden" name="id" value="<?php echo esc_attr( $module->id ); ?>">
			<?php wp_nonce_field( 'hustle_module_export' ); ?>
			<button>
				<i class="sui-icon-cloud-migration" aria-hidden="true"></i>
				<?php esc_html_e( 'Export', 'wordpress-popup' ); ?>
			</button>
		</form>
	</li>

	<?php // Import ?>
	<?php if ( empty( $dashboard ) ) : ?>
		<li><button
			class="hustle-module-import-button"
			data-id="<?php echo esc_attr( $module->id ); ?>"
			data-type="<?php echo esc_attr( $module->module_type ); ?>"
		>
			<span>
				<i class="sui-icon-upload-cloud" aria-hidden="true"></i>
				<?php esc_html_e( 'Import', 'wordpress-popup' ); ?>
			</span>
		</button></li>
	<?php endif; ?>

	<?php
	// Delete module ?>
	<li><button class="sui-option-red hustle-delete-module-button"
		data-nonce="<?php echo esc_attr( wp_create_nonce( 'hustle_listing_request' ) ); ?>"
		data-type="<?php echo esc_attr( $module->module_type ); ?>"
		data-id="<?php echo esc_attr( $module->id ); ?>">
			<i class="sui-icon-trash" aria-hidden="true"></i> <?php esc_html_e( 'Delete', 'wordpress-popup' ); ?>
		</button>
	</li>

</ul>
