<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label"><?php esc_html_e( 'Edit Existing Modules', Opt_In::TEXT_DOMAIN ); ?></span>
		<span class="sui-description"><?php esc_html_e( 'Choose the user roles which can edit the existing modules.', Opt_In::TEXT_DOMAIN ); ?></span>
	</div>

	<div class="sui-box-settings-col-2">

		<?php
		// TABLE: Modules
		$filtered = !empty( $filter['role'] ) && 'any' !== $filter['role'] || !empty( $filter['q'] )
				|| 4 > count( $filter['types'] ) && !empty( $filter['types'] );
		
		if ( 0 === count( $modules ) && !$filtered ) { ?>
				<div class="sui-notice">
					<p><?php esc_html_e( "You haven't created any module yet.", Opt_In::TEXT_DOMAIN ); ?></p>
				</div>

		<?php } else {

			// PAGINATION: Structure
			if ( 10 >= count( $modules ) ) {

				$this->render(
					'admin/commons/pagination',
					array(
						'count' => $modules_count,
						'limit' => $modules_limit,
						'page' => $modules_page,
						'show' => $modules_show_pager,
						'filterclass' => 'sui-pagination-open-filter',
						'filter' => $filter,
					)
				);

				// PAGINATION: Filter
				$values = array(
					'popup' => __( 'Pop-up', Opt_In::TEXT_DOMAIN ),
					'slidein' => __( 'Slide-in', Opt_In::TEXT_DOMAIN ),
					'embedded' => __( 'Embed', Opt_In::TEXT_DOMAIN ),
					'social_sharing' => __( 'Share', Opt_In::TEXT_DOMAIN ),
				); ?>

				<form method="get" class="sui-pagination-filter">

					<input type="hidden" name="page" value="hustle_settings" />
					<input type="hidden" name="section" value="permissions" />

					<?php
					// FILTER: Module Type ?>
					<div class="sui-row">

						<div class="sui-col-12">

							<div class="sui-form-field">

								<label class="sui-label"><?php esc_html_e( 'Module type', Opt_In::TEXT_DOMAIN ); ?></label>

								<?php foreach ( $values as $value => $module ) { ?>

									<label class="sui-checkbox">
										<input type="checkbox"
											name="filter[types][]"
											value="<?php echo esc_attr( $value ); ?>"
											<?php echo empty( $filter['types'] ) || in_array( $value, $filter['types'], true ) ? ' checked="checked"' : ''; ?>
											/>
										<span aria-hidden="true"></span>
										<span><?php echo esc_html( $module ); ?></span>
									</label>

								<?php } ?>

							</div>

						</div>

					</div>

					<?php
					// FILTER: Keyword ?>
					<div class="sui-row">

						<div class="sui-col-12">

							<div class="sui-form-field">

								<label for="forminator-filter-keyword" class="sui-label"><?php esc_html_e( 'Module name has keyword', Opt_In::TEXT_DOMAIN ); ?></label>

								<div class="sui-control-with-icon">

									<input type="text"
										name="filter[q]"
										placeholder="<?php esc_html_e( 'E.g. Discount', Opt_In::TEXT_DOMAIN ); ?>"
										value="<?php echo esc_attr( isset( $filter['q'] )? esc_attr( $filter['q'] ) : '' ); ?>"
										id="forminator-filter-keyword"
										class="sui-form-control" />

									<i class="sui-icon-magnifying-glass-search" aria-hidden="true"></i>

								</div>

							</div>

						</div>

					</div>

					<?php
					// FILTER(S): Role and Sort ?>
					<div class="sui-row">

						<?php
						// FILTER: Role Assigned ?>
						<div class="sui-col-md-6">

							<div class="sui-form-field">

								<label class="sui-label"><?php esc_html_e( 'Use role assigned for editing', Opt_In::TEXT_DOMAIN ); ?></label>

								<select name="filter[role]">
									<option value="any"><?php esc_html_e( 'Any', Opt_In::TEXT_DOMAIN ); ?></option>
									<?php foreach ( $roles as $value => $label ) {
										if ( 'administrator' === $value ) {
											continue;
										}
										printf(
											'<option value="%s" %s>%s</option>',
											esc_attr( $value ),
											isset( $filter['role'] ) && $filter['role'] === $value ? 'selected="selected"':'',
											esc_html( $label )
										);
									} ?>
								</select>

							</div>

						</div>

						<?php
						// FILTER: Sort By ?>
						<div class="sui-col-md-6">

							<div class="sui-form-field">

								<label class="sui-label"><?php esc_html_e( 'Sort by', Opt_In::TEXT_DOMAIN ); ?></label>

								<select name="filter[sort]">
									<?php
									$values = array(
										'module_name' => __( 'Name', Opt_In::TEXT_DOMAIN ),
										'module_id' => __( 'Id', Opt_In::TEXT_DOMAIN ),
										'module_type' => __( 'Type', Opt_In::TEXT_DOMAIN ),
									);

									foreach ( $values as $value => $label ) {
										printf(
											'<option value="%s" %s>%s</option>',
											esc_attr( $value ),
											isset( $filter['sort'] ) && $filter['sort'] === $value ? 'selected="selected"':'',
											esc_html( $label )
										);
									} ?>
								</select>

							</div>

						</div>

					</div>

					<?php
					// FILTER: Footer ?>
					<div class="sui-filter-footer">
						
						<div class="sui-actions-right">

							<input type="submit"
								value="<?php esc_attr_e( 'Apply', Opt_In::TEXT_DOMAIN ); ?>"
								class="sui-button" />

						</div>

					</div>

				</form>

			<?php } ?>

			<?php if ( 0 === count( $modules ) && $filtered ) { ?>

				<div class="sui-notice sui-notice-info">
					<p><?php esc_html_e( "You don't have any module corresponding to these filter parameters.", Opt_In::TEXT_DOMAIN ); ?></p>
				</div>

			<?php } else { ?>
				<table class="sui-table">

					<thead>
						<tr>
							<th><?php esc_html_e( 'Module', Opt_In::TEXT_DOMAIN ); ?></th>
							<th><?php esc_html_e( 'User Role', Opt_In::TEXT_DOMAIN ); ?></th>
						</tr>
					</thead>

					<tbody>

					<?php foreach ( $modules as $module ) : ?>
						<tr data-module-id="<?php echo esc_attr( $module->module_id ); ?>">
							<td class="sui-table-item-title"><i class="sui-icon-<?php echo esc_attr( $module->module_type ); ?>"></i> <?php echo esc_html( $module->module_name ); ?></td>
							<td><select class="sui-select-sm sui-select" data-index="module-<?php echo esc_attr( $module->module_id ); ?>" multiple>
								<?php
								$current = (array) $modules_edit_roles[ $module->id ];
								foreach ( $roles as $value => $label ) {
									$admin = 'administrator' === $value;
									printf(
										'<option value="%s" %s %s>%s</option>',
										esc_attr( $value ),
										selected( in_array($value, $current, true) || $admin, true, false ),
										disabled( $admin, true, false ),
										esc_html( $label )
									);
								}
								?>
						</tr>
					<?php endforeach; ?>
					</tbody>

				</table>
			<?php } ?>

		<?php } ?>

	</div>

</div>
