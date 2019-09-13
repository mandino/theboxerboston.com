<main class="<?php echo implode( ' ', apply_filters( 'hustle_sui_wrap_class', null ) ); ?>">
	<div class="sui-header">
		<h1 class="sui-header-title"><?php esc_html_e( 'Dashboard', 'wordpress-popup' ); ?></h1>
		<?php self::static_render( 'admin/commons/view-documentation' ); ?>
	</div>
	<div class="<?php echo esc_attr( implode( ' ', $sui['summary']['classes'] ) ); ?>">
		<div class="sui-summary-image-space" aria-hidden="true" style="<?php echo esc_attr( $sui['summary']['style'] ); ?>"></div>
		<div class="sui-summary-segment">
			<div class="sui-summary-details">
				<span class="sui-summary-large"><?php echo esc_html( $active_modules ); ?></span>
				<span class="sui-summary-sub"><?php esc_html_e( 'Active Modules', 'wordpress-popup' ); ?></span>
				<span class="sui-summary-detail"><?php echo esc_html( $last_conversion ); ?></span>
				<span class="sui-summary-sub"><?php esc_html_e( 'Last Conversion', 'wordpress-popup' ); ?></span>

			</div>

		</div>

		<div class="sui-summary-segment">
			<?php
			if ( is_array( $metrics ) && ! empty( $metrics ) ) {
				echo '<ul class="sui-list">';
				foreach ( $metrics as $key => $data ) {
					printf( '<li class="hustle-%s">', esc_attr( $key ) );
					printf( '<span class="sui-list-label">%s</span>', esc_html( $data['label'] ) );
					printf( '<span class="sui-list-detail">%s</span>', $data['value'] ); // XSS ok. Expected html.
					echo '</li>';
				}
				echo '</ul>';
			} else {
				esc_html_e( 'No data to display.', 'wordpress-popup' );
			}
			?>
		</div>

	</div>

	<div class="sui-row">

		<div class="sui-col-md-6">

			<?php
			// WIDGET: Pop-ups
			self::static_render(
				'admin/popup/dashboard',
				array(
					'capability' => $capability,
					'popups'     => $popups,
				)
			); ?>

			<?php
			// WIDGET: Embeds
			self::static_render(
				'admin/embedded/dashboard',
				array(
					'capability' => $capability,
					'embeds'     => $embeds,
				)
			); ?>

		</div>

		<div class="sui-col-md-6">

			<?php
			// WIDGET: Slide-ins
			self::static_render(
				'admin/slidein/dashboard',
				array(
					'capability' => $capability,
					'slideins'   => $slideins,
				)
			); ?>

			<?php
			// WIDGET: Social Shares
			self::static_render(
				'admin/sshare/dashboard',
				array(
					'sshares'       => $social_shares,
					'capability'    => $capability,
					'sshare_per_page_data' => $sshare_per_page_data,
				)
			); ?>

		</div>

	</div>

	<?php 
	// Global Footer
	$this->render( 'admin/footer/footer', array( 'is_large' => true ) ); ?>

	<?php
	// DIALOG: On Boarding (Welcome)
	if (
		( ! Hustle_Migration::did_hustle_exist() && ! Hustle_Settings_Admin::was_notification_dismissed( Hustle_Dashboard_Admin::WELCOME_MODAL_NAME ) && ! $has_modules )
		|| ! empty( $_GET['show-welcome'] ) // CSRF: ok.
	) {
		$current_user = wp_get_current_user();
		$username = ! empty( $current_user->user_firstname ) ? $current_user->user_firstname : $current_user->user_login;
		self::static_render( 'admin/dashboard/dialogs/fresh-install', array( 'username' => $username ) );
	}

	// DIALOG: On Boarding (Migrate)
	if ( ( $need_migrate && ! Hustle_Settings_Admin::was_notification_dismissed( Hustle_Dashboard_Admin::MIGRATE_MODAL_NAME ) )
		|| ! empty( $_GET['show-migrate'] ) // CSRF: ok.
	) {
		$current_user = wp_get_current_user();
		$username = ! empty( $current_user->user_firstname ) ? $current_user->user_firstname : $current_user->user_login;
		self::static_render( 'admin/dashboard/dialogs/migrate-data', array( 'username' => $username ) );
	}

	// DIALOG: Delete
	self::static_render(
		'admin/commons/sui-listing/dialogs/delete-module',
		array()
	);

	// DIALOG: Preview
	self::static_render( 'admin/dialogs/preview-dialog' );

	// DIALOG: Dissmiss migrate tracking notice modal confirmation.
	if ( Hustle_Module_Admin::is_show_migrate_tracking_notice() ) {
		self::static_render( 'admin/dashboard/dialogs/migrate-dismiss-confirmation' );
	}
?>
</main>
