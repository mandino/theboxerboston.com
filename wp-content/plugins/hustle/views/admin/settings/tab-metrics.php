<?php
$stored_metrics = isset( $hustle_settings['selected_top_metrics'] ) && is_array( $hustle_settings['selected_top_metrics'] ) ? $hustle_settings['selected_top_metrics'] : array();
?>
<div id="top-metrics-box" class="sui-box" data-tab="metrics" <?php if ( 'metrics' !== $section ) echo 'style="display: none;"'; ?>>

	<div class="sui-box-header">
		<h2 class="sui-box-title"><?php esc_html_e( 'Top 3 Metrics', Opt_In::TEXT_DOMAIN ); ?></h2>
	</div>

	<form id="top-metrics-form" data-nonce="<?php echo esc_attr( wp_create_nonce( 'hustle-settings' ) ); ?>">

		<div class="sui-box-body">

			<p><?php esc_html_e( 'Choose the top 3 metrics which are most relevant to your goals. These metrics will be visible on the Hustle’s main dashboard area.', Opt_In::TEXT_DOMAIN ); ?></p>

			<div class="sui-form-field">
				<label for="hustle-metrics-rate" class="sui-checkbox">
					<input type="checkbox"
						name="average_conversion_rate"
						value="1"
						id="hustle-metrics-rate"
						<?php checked( in_array( 'average_conversion_rate', $stored_metrics, true ) ); ?> />
					<span aria-hidden="true"
						data-tooltip="<?php esc_html_e( 'You can only select up to 3 metrics', Opt_In::TEXT_DOMAIN ); ?>"></span>
					<span><?php esc_html_e( 'Average Conversion Rate', Opt_In::TEXT_DOMAIN ); ?></span>
				</label>
				<span class="sui-description sui-checkbox-description"><?php esc_html_e( 'The average conversion rate is the total number of conversions divided by the total number of views on all the modules.', Opt_In::TEXT_DOMAIN ); ?></span>
			</div>

			<div class="sui-form-field">
				<label for="hustle-metrics-today" class="sui-checkbox">
					<input type="checkbox"
						name="today_conversions"
						value="1"
						id="hustle-metrics-today"
						<?php checked( in_array( 'today_conversions', $stored_metrics, true ) ); ?> />
					<span aria-hidden="true"
						data-tooltip="<?php esc_html_e( 'You can only select up to 3 metrics', Opt_In::TEXT_DOMAIN ); ?>"></span>
					<span><?php esc_html_e( "Today's Conversion", Opt_In::TEXT_DOMAIN ); ?></span>
				</label>
				<span class="sui-description sui-checkbox-description"><?php esc_html_e( 'The total number of conversions happened today from each module.', Opt_In::TEXT_DOMAIN ); ?></span>
			</div>

			<div class="sui-form-field">
				<label for="hustle-metrics-week" class="sui-checkbox">
					<input type="checkbox"
						name="last_week_conversions"
						value="1"
						id="hustle-metrics-week"
						<?php checked( in_array( 'last_week_conversions', $stored_metrics, true ) ); ?> />
					<span aria-hidden="true"
						data-tooltip="<?php esc_html_e( 'You can only select up to 3 metrics', Opt_In::TEXT_DOMAIN ); ?>"></span>
					<span><?php esc_html_e( "Last 7 Day's Conversion", Opt_In::TEXT_DOMAIN ); ?></span>
				</label>
				<span class="sui-description sui-checkbox-description"><?php esc_html_e( 'The total number of conversions happened in the last 7 days from each module', Opt_In::TEXT_DOMAIN ); ?></span>
			</div>

			<div class="sui-form-field">
				<label for="hustle-metrics-month" class="sui-checkbox">
					<input type="checkbox"
						name="last_month_conversions"
						value="1"
						id="hustle-metrics-month"
						<?php checked( in_array( 'last_month_conversions', $stored_metrics, true ) ); ?> />
					<span aria-hidden="true"
						data-tooltip="<?php esc_html_e( 'You can only select up to 3 metrics', Opt_In::TEXT_DOMAIN ); ?>"></span>
					<span><?php esc_html_e( "Last 1 Month's conversion", Opt_In::TEXT_DOMAIN ); ?></span>
				</label>
				<span class="sui-description sui-checkbox-description"><?php esc_html_e( 'The total number of conversions happened in the last month from each module.', Opt_In::TEXT_DOMAIN ); ?></span>
			</div>

			<div class="sui-form-field">
				<label for="hustle-metrics-total" class="sui-checkbox">
					<input type="checkbox"
						name="total_conversions"
						value="1"
						id="hustle-metrics-total"
						<?php checked( in_array( 'total_conversions', $stored_metrics, true ) ); ?> />
					<span aria-hidden="true"
						data-tooltip="<?php esc_html_e( 'You can only select up to 3 metrics', Opt_In::TEXT_DOMAIN ); ?>"></span>
					<span><?php esc_html_e( 'Total Conversions', Opt_In::TEXT_DOMAIN ); ?></span>
				</label>
				<span class="sui-description sui-checkbox-description"><?php esc_html_e( 'The sum of all the conversion happened up to today from each module.', Opt_In::TEXT_DOMAIN ); ?></span>
			</div>

			<div class="sui-form-field">
				<label for="hustle-metrics-most" class="sui-checkbox">
					<input type="checkbox"
						name="most_conversions"
						value="1"
						id="hustle-metrics-most"
						<?php checked( in_array( 'most_conversions', $stored_metrics, true ) ); ?> />
					<span aria-hidden="true"
						data-tooltip="<?php esc_html_e( 'You can only select up to 3 metrics', Opt_In::TEXT_DOMAIN ); ?>"></span>
					<span><?php esc_html_e( 'Most Conversions', Opt_In::TEXT_DOMAIN ); ?></span>
				</label>
				<span class="sui-description sui-checkbox-description"><?php esc_html_e( 'The module which has the highest number of conversions.', Opt_In::TEXT_DOMAIN ); ?></span>
			</div>

			<div class="sui-form-field">
				<label for="hustle-metrics-inactive-modules" class="sui-checkbox">
					<input type="checkbox"
						name="inactive_modules_count"
						value="1"
						id="hustle-metrics-inactive-modules"
						<?php checked( in_array( 'inactive_modules_count', $stored_metrics, true ) ); ?> />
					<span aria-hidden="true"
						data-tooltip="<?php esc_html_e( 'You can only select up to 3 metrics', Opt_In::TEXT_DOMAIN ); ?>"></span>
					<span><?php esc_html_e( 'Inactive Modules', Opt_In::TEXT_DOMAIN ); ?></span>
				</label>
				<span class="sui-description sui-checkbox-description"><?php esc_html_e( 'The total number of modules which are currently inactive. This will include all the drafts and unpublished modules.', Opt_In::TEXT_DOMAIN ); ?></span>
			</div>

			<div class="sui-form-field">
				<label for="hustle-metrics-total-modules" class="sui-checkbox">
					<input type="checkbox"
						name="total_modules_count"
						value="1"
						id="hustle-metrics-total-modules"
						<?php checked( in_array( 'total_modules_count', $stored_metrics, true ) ); ?> />
					<span aria-hidden="true"
						data-tooltip="<?php esc_html_e( 'You can only select up to 3 metrics', Opt_In::TEXT_DOMAIN ); ?>"></span>
					<span><?php esc_html_e( 'Total Modules', Opt_In::TEXT_DOMAIN ); ?></span>
				</label>
				<span class="sui-description sui-checkbox-description"><?php esc_html_e( 'The total number of modules regardless of their status.', Opt_In::TEXT_DOMAIN ); ?></span>
			</div>

		</div>

		<div class="sui-box-footer">
			<div class="sui-actions-right">
				<button type="submit" class="sui-button sui-button-blue">
					<span class="sui-loading-text"><?php esc_html_e( 'Save Settings', Opt_In::TEXT_DOMAIN ); ?></span>
					<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
				</button>
			</div>
		</div>

	</form>

</div>
