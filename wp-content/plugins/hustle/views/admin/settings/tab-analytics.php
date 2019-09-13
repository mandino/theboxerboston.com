<?php
$is_enabled = isset( $settings['enabled'] ) && '1' === $settings['enabled'] ? true : false;
?>

<div id="analytics-box" class="sui-box hustle-settings-tab-analytics" data-tab="analytics" <?php if ( $section && 'analytics' !== $section ) echo 'style="display: none;"'; ?>>

	<form data-nonce="<?php echo esc_attr( wp_create_nonce( 'hustle-settings' ) ); ?>">
	
		<div class="sui-box-header">
			<h2 class="sui-box-title"><?php esc_html_e( 'Dashboard Analytics Tracking', 'wordpress-popup' ); ?></h2>
		</div>

		<div class="sui-box-body">

			<p><?php esc_html_e( "Add analytics tracking for your Hustle modules that doesn't require any third party integration, and display the data in the WordPress Admin Dashboard area.", 'wordpress-popup' ); ?>

			<?php if ( $is_enabled ) { ?>

				<div class="sui-box-settings-row">

					<div class="sui-box-settings-col-2">

						<div class="sui-notice sui-notice-success">
							<p><?php echo esc_html( sprintf( __( 'Analytics are now being tracked and the widget is being displayed to users with the "%s" role and above in the Dashboard area.', 'wordpress-popup' ), ( isset( $settings['role'] ) && $settings['role'] ? ucfirst( $settings['role'] ) : 'Administrator' ) ) ); ?></p>
						</div>

					</div>

				</div>

				<?php
				/**
				 * Widget Title
				 */
				$this->render(
					'admin/settings/analytics/widget-title',
					array(
						'value' => isset( $settings['title'] ) && $settings['title']? $settings['title']:'',
					)
				);

				/**
				 * User Role
				 */
				$this->render(
					'admin/settings/analytics/user-role',
					array(
					 'value' => !empty( $settings['role'] ) && is_array( $settings['role'] )? $settings['role']:array(),
					)
				);

				/**
				 * Modules
				 */
				$this->render(
					'admin/settings/analytics/modules',
					array(
						'values' => isset( $settings['modules'] ) && $settings['modules']? $settings['modules']:array(),
					)
				);

			} else { ?>

				<p>
					<button class="sui-button sui-button-blue hustle-settings-save-analytics" data-enabled="1">
						<span class="sui-loading-text"><?php esc_html_e( 'Activate', 'wordpress-popup' ); ?></span>
						<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
					</button>
				</p>

			<?php } ?>

		</div>

		<?php if ( $is_enabled ) { ?>

			<div class="sui-box-footer">

				<button class="sui-button sui-button-ghost hustle-settings-save-analytics" data-enabled="0">
					<span class="sui-loading-text"><?php esc_html_e( 'Deactivate', 'wordpress-popup' ); ?></span>
					<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
				</button>
			
				<div class="sui-actions-right">
				
					<button class="sui-button sui-button-blue hustle-settings-save-analytics">
						<span class="sui-loading-text"><?php esc_html_e( 'Save Settings', 'wordpress-popup' ); ?></span>
						<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
					</button>
					
				</div>
				
			</div>
			
		<?php } ?>
		
	</form>

</div>
