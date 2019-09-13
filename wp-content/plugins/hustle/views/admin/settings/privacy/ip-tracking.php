<?php $ip_tracking = !isset( $settings['ip_tracking'] ) || 'on' === $settings['ip_tracking']; ?>
<?php // $excluded_ips = !empty( $settings['excluded_ips'] ) && is_array( $settings['excluded_ips'] ) ? implode( "\n", $settings['excluded_ips'] ) : ''; ?>

<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label"><?php esc_html_e( 'IP Tracking', 'wordpress-popup' ); ?></span>
		<span class="sui-description"><?php esc_html_e( 'Choose whether you want to track IP addresses of viewers for the modules where tracking is enabled.', 'wordpress-popup' ); ?></span>
	</div>

	<div class="sui-box-settings-col-2">

		<div class="sui-side-tabs">

			<div class="sui-tabs-menu">

				<label class="sui-tab-item<?php echo $ip_tracking ? ' active':''; ?>">
					<input type="radio"
					name="hustle-ip-tracking"
					id="hustle-ip-tracking--on"
					value="on"
					data-tab-menu="exclude-ips"
					checked="checked" />
					<?php esc_html_e( 'Enable', 'wordpress-popup' ); ?>
				</label>

				<label class="sui-tab-item<?php echo ! $ip_tracking ? ' active':''; ?>">
					<input type="radio"
					name="hustle-ip-tracking"
					id="hustle-ip-tracking--off"
					value="off" />
					<?php esc_html_e( 'Disable', 'wordpress-popup' ); ?>
				</label>

			</div>

<!--			<div class="sui-tabs-content">

				<div class="sui-tab-boxed<?php // echo $ip_tracking ? ' active':''; ?>" data-tab-content="exclude-ips">

					<p><strong><?php // esc_html_e( 'Exclude IPs', 'wordpress-popup' ); ?></strong></p>
					<p class="sui-description"><?php // esc_html_e( 'Choose the IP address which you want to exclude from tracking.', 'wordpress-popup' ); ?></p>

					<textarea name="hustle-excluded-ips" rows="16"
						placeholder="<?php // esc_html_e( 'Enter your IP address here...', 'wordpress-popup' ); ?>"
						class="sui-form-control"><?php // echo esc_html( $excluded_ips ); ?></textarea>

					<span class="sui-description"><?php // esc_html_e( 'Type one IP address per line. Both IPv4 and IPv6 are supported. IP ranges are also accepted in format xxx.xxx.xxx.xxx-xxx.xxx.xxx.xxx.', 'wordpress-popup' ); ?></span>

				</div>

			</div>-->

		</div>

	</div>

</div>
