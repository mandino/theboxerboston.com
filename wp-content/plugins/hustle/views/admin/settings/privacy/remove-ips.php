<?php $remove_all_ips = ! isset( $settings['remove_all_ip'] ) || $settings['remove_all_ip']; ?>
<?php $remove_ips = ! empty( $settings['remove_ips'] ) && is_array( $settings['remove_ips'] ) ? implode( "\n", $settings['remove_ips'] ) : ''; ?>

<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label"><?php esc_html_e( 'Remove IPs From Database', Opt_In::TEXT_DOMAIN ); ?></span>
		<span class="sui-description"><?php esc_html_e( "You can delete the IP addresses you've collected so far while tracking data for your modules.", Opt_In::TEXT_DOMAIN ); ?></span>
	</div>

	<div class="sui-box-settings-col-2">

		<div class="sui-side-tabs">

			<div class="sui-tabs-menu">

				<label class="sui-tab-item<?php echo $remove_all_ips ? ' active':''; ?>">
					<input type="radio"
					name="hustle-remove-all-ip"
					id="hustle-remove-all-ip--on"
					value="on"
					data-tab-menu="all-ips"
					<?php checked( $remove_all_ips ); ?>
					/>
					<?php esc_html_e( 'All IPs', Opt_In::TEXT_DOMAIN ); ?>
				</label>

				<label class="sui-tab-item<?php echo ! $remove_all_ips ? ' active':''; ?>">
					<input type="radio"
					name="hustle-remove-all-ip"
					id="hustle-remove-all-ip--off"
					value="off"
					data-tab-menu="only-ips"
					<?php checked( ! $remove_all_ips ); ?>
					/>
					<?php esc_html_e( 'Specific IPs Only', Opt_In::TEXT_DOMAIN ); ?>
				</label>

			</div>

			<div class="sui-tabs-content">

				<div class="sui-tab-boxed<?php echo $remove_all_ips ? ' active':''; ?>" data-tab-content="all-ips">

					<button id="hustle-dialog-open--delete-ips"
						class="sui-button sui-button-red sui-button-ghost"
						data-notice="hustle-notice-success--delete-all-ips"
						data-range="all"
						data-dialog-title="<?php esc_html_e( 'Delete All IPs', Opt_In::TEXT_DOMAIN ); ?>"
						data-dialog-info="<?php esc_html_e( 'Are you sure you wish to permanently delete all IP addresses  collected so far.', Opt_In::TEXT_DOMAIN ); ?>">
						<i class="sui-icon-trash" aria-hidden="true"></i> <?php esc_html_e( 'Delete All IPs', Opt_In::TEXT_DOMAIN ); ?>
					</button>

					<span class="sui-description" style="margin-top: 10px;"><?php esc_html_e( 'This will delete only the IP addresses from the database. Rest of the tracking data will remain untouched.', Opt_In::TEXT_DOMAIN ); ?></span>

				</div>

				<div class="sui-tab-boxed<?php echo ! $remove_all_ips ? ' active' : ''; ?>"
					data-tab-content="only-ips">

					<label for="hustle-remove-specific-ips" class="sui-label"><?php esc_html_e( 'IP Addresses', Opt_In::TEXT_DOMAIN ); ?></label>

					<textarea name="hustle-remove-ips"
						rows="16"
						placeholder="<?php esc_html_e( 'Enter your IP addresses here...', Opt_In::TEXT_DOMAIN ); ?>"
						id="hustle-remove-specific-ips"
						class="sui-form-control"><?php echo esc_html( $remove_ips ); ?></textarea>

					<span class="sui-description" style="margin-bottom: 20px;"><?php esc_html_e( 'Type one IP address per line. Both IPv4 and IPv6 are supported. IP ranges are also accepted in format xxx.xxx.xxx.xxx-xxx.xxx.xxx.xxx.', Opt_In::TEXT_DOMAIN ); ?></span>

					<button id="hustle-dialog-open--delete-ips"
						class="sui-button sui-button-red sui-button-ghost"
						data-notice="hustle-notice-success--delete-ips"
						data-range="range"
						data-dialog-title="<?php esc_html_e( 'Delete Selected IPs', Opt_In::TEXT_DOMAIN ); ?>"
						data-dialog-info="<?php esc_html_e( 'Are you sure you wish to permanently delete all the selected IP addresses.', Opt_In::TEXT_DOMAIN ); ?>">
						<i class="sui-icon-trash" aria-hidden="true"></i> <?php esc_html_e( 'Delete IPs', Opt_In::TEXT_DOMAIN ); ?>
					</button>

				</div>

			</div>

		</div>

	</div>

</div>
