<div id="permissions-box" class="sui-box" data-tab="permissions" <?php if ( 'permissions' !== $section ) echo 'style="display: none;"'; ?>>

	<div class="sui-box-body">

		<?php
		// SETTINGS: Create Modules
		$this->render(
			'admin/settings/permissions/create-modules',
			array(
				'hustle_settings' => $hustle_settings,
				'roles' => $roles,
			)
		); ?>

		<?php
		// SETTINGS: Edit Existing Modules
		$this->render(
			'admin/settings/permissions/edit-modules',
			array(
				'filter' => $filter,
				'modules' => $modules,
				'modules_count' => $modules_count,
				'modules_limit' => $modules_limit,
				'modules_page' => $modules_page,
				'modules_show_pager' => $modules_show_pager,
				'modules_edit_roles' => $modules_edit_roles,
				'roles' => $roles,
			)
		); ?>

		<?php
		// SETTINGS: Access Email List
		$this->render(
			'admin/settings/permissions/access-emails',
			array(
				'settings' => $hustle_settings,
				'roles' => $roles,
			)
		); ?>

		<?php
		// SETTINGS: Edit Integrations
		$this->render(
			'admin/settings/permissions/edit-integrations',
			array(
				'hustle_settings' => $hustle_settings,
				'roles' => $roles,
			)
		); ?>

		<?php
		// SETTINGS: Edit Settings
		$this->render(
			'admin/settings/permissions/edit-settings',
			array(
				'hustle_settings' => $hustle_settings,
				'roles' => $roles,
			)
		); ?>

	</div>

	<div class="sui-box-footer">

		<div class="sui-actions-right">

        	<button class="sui-button sui-button-blue hustle-settings-save" data-nonce="<?php echo esc_attr( wp_create_nonce( 'hustle-settings' ) ); ?>">
				<span class="sui-loading-text"><?php esc_html_e( 'Save Settings', 'wordpress-popup' ); ?></span>
				<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
			</button>

		</div>

	</div>

</div>
