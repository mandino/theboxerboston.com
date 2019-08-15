<div class="sui-box">

	<div class="sui-box-header">

		<h2 class="sui-box-title">
			<i class="sui-icon-<?php echo esc_attr( $widget_type ); ?>" aria-hidden="true"></i>
			<?php echo esc_html( $widget_name ); ?>
		</h2>

	</div>

	<div class="sui-box-body">

		<p><?php echo esc_html( $description ); ?></p>

		<?php if ( count( $modules ) && count( $sshare_per_page_data ) ) { ?>

			</div>

			<table class="sui-table sui-table-flushed hui-table-dashboard">

				<thead>

					<tr>

						<th><?php esc_html_e( 'Page Name', Opt_In::TEXT_DOMAIN ); ?></th>
						<th><?php esc_html_e( 'Total Shares', Opt_In::TEXT_DOMAIN ); ?></th>

					</tr>

				</thead>

				<tbody>

					<?php foreach ( $sshare_per_page_data as $page_data ) {
						?>

						<tr>

							<td class="sui-table-item-title"><a href="<?php echo esc_url( $page_data['url'] ); ?>" target="_blank">
								<?php echo esc_html( $page_data['title'] ); ?>
							</a></td>

							<td><?php echo esc_html( $page_data['count'] ); ?></td>

						</tr>

					<?php } ?>

				</tbody>

			</table>

			<div class="sui-box-footer">

		<?php } ?>

		<?php if ( $capability['hustle_create'] ) { ?>
			<a
				href="
					<?php
					$query_array = array( 'page' => Hustle_Module_Admin::get_listing_page_by_module_type( $widget_type ) );
					if ( Hustle_Module_Admin::can_create_new_module( $widget_type ) ) {
						$query_array['create-module'] = 'true';
					} else {
						$query_array['requires-pro'] = 'true';
					}
					echo esc_url( add_query_arg( $query_array, 'admin.php' ) );
					?>
				"
				class="sui-button sui-button-blue"
			>
				<i class="sui-icon-plus" aria-hidden="true"></i>
				<?php esc_html_e( 'Create', Opt_In::TEXT_DOMAIN ); ?>
			</a>
		<?php } ?>

	</div>

</div>
