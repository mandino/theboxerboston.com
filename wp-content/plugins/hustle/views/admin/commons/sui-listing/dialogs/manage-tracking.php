<div id="hustle-dialog--manage-tracking" class="sui-dialog sui-dialog-alt sui-dialog-sm" aria-hidden="true" tabindex="-1">

	<div class="sui-dialog-overlay sui-fade-out" data-a11y-dialog-hide="hustle-dialog--manage-tracking"></div>

	<div
		role="dialog"
		class="sui-dialog-content sui-bounce-out"
		aria-labelledby="dialogTitle"
		aria-describedby="dialogDescription"
	>

		<div class="sui-box" role="document">

			<div class="sui-box-header sui-block-content-center">

				<h3 id="dialogTitle" class="sui-box-title"><?php esc_html_e( 'Manage Tracking', Opt_In::TEXT_DOMAIN ); ?></h3>

				<button class="sui-dialog-close" data-a11y-dialog-hide="hustle-dialog--manage-tracking">
					<span class="sui-screen-reader-text"><?php esc_html_e( 'Close this dialog window', Opt_In::TEXT_DOMAIN ); ?></span>
				</button>

			</div>

			<div class="sui-box-body sui-box-body-slim sui-block-content-center">

				<p id="dialogDescription"><?php esc_html_e( 'Manage the conversion tracking for all the display options of this module.', Opt_In::TEXT_DOMAIN ); ?></p>


				<form method="post" id="hustle-manage-tracking-form">

					<div id="hustle-manage-tracking-form-container"></div>

				</form>

			</div>

			<div class="sui-box-footer" style="padding-top: 0;">

				<button type="button" class="sui-button sui-button-ghost" data-a11y-dialog-hide="hustle-dialog--manage-tracking">
					<?php esc_attr_e( 'Cancel', Opt_In::TEXT_DOMAIN ); ?>
				</button>

				<button id="hustle-manage-tracking-types"
					class="sui-button"
					data-nonce="<?php echo esc_attr( wp_create_nonce( 'hustle_toggle_tracking' ) ); ?>"
				>
					<span class="sui-loading-text">
						<?php esc_attr_e( 'Update', Opt_In::TEXT_DOMAIN ); ?>
					</span>
					<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
				</button>

			</div>

		</div>

	</div>

</div>

<script id="hustle-manage-tracking-form-tpl" type="text/template">

	<table class="sui-table">

		<tbody>

			<?php foreach ( $multiple_charts as $chart_key => $chart ) : ?>

				<tr id="hustle-subtype-row-<?php echo esc_attr( $chart_key ); ?>">

					<th><?php echo esc_html( $chart ); ?></th>

					<td style="text-align: right;">

						<label
							for="hustle-module-tracking--<?php echo esc_attr( $chart_key ); ?>"
							class="sui-toggle"
							style="margin: 0;"
						>
							<input
								type="checkbox"
								name="tracking_sub_types[]"
								value="<?php echo esc_attr( $chart_key ); ?>"
								id="hustle-module-tracking--<?php echo esc_attr( $chart_key ); ?>"
								{{ _.checked( _.contains( enabledTrackings, '<?php echo esc_attr( $chart_key ); ?>' ), true ) }}
							/>
							<span aria-hidden="true" class="sui-toggle-slider"></span>
							<span class="sui-screen-reader-text"><?php printf( esc_html__( 'Enable %s tracking', Opt_In::TEXT_DOMAIN ), esc_html( $chart ) ); ?></span>
						</label>

					</td>

				</tr>

			<?php endforeach; ?>

		</tbody>

	</table>

	<input id="hustle-module-manage-trackind-id" type="hidden" name="id" value="{{ moduleID }}">

</script>
