<?php
$unsubscription_email    = Hustle_Settings_Admin::get_unsubscribe_email_settings();
$unsubscription_messages = Hustle_Settings_Admin::get_unsubscribe_messages();
?>

<div id="unsubscribe-box" class="sui-box" data-tab="unsubscribe" <?php if ( 'unsubscribe' !== $section ) echo 'style="display: none;"'; ?>>

	<form id="unsubscribe-settings-form" data-nonce="<?php echo esc_attr( wp_create_nonce( 'hustle-settings' ) ); ?>">

		<div class="sui-box-header">
			<h2 class="sui-box-title"><?php esc_html_e( 'Unsubscribe', 'wordpress-popup' ); ?></h2>
		</div>

		<div class="sui-box-body">

			<?php
			// SETTINGS: Shortcode
			$this->render( 'admin/settings/unsubscribe/shortcode' ); ?>

			<?php
			// SETTINGS: Customize Unsubscribe Form
			$this->render(
				'admin/settings/unsubscribe/customize',
				array(
					'messages' => $unsubscription_messages
				)
			); ?>

			<?php
			// SETTINGS: Unsubscribe Email Copy
			$this->render(
				'admin/settings/unsubscribe/email-copy',
				array(
					'email'	=> $unsubscription_email
				)
			); ?>

		</div>

		<div class="sui-box-footer">
			<div class="sui-actions-right">
				<button type="submit" class="sui-button sui-button-blue">
					<span class="sui-loading-text"><?php esc_html_e( 'Save Settings', 'wordpress-popup' ); ?></span>
					<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
				</button>
			</div>
		</div>

	</form>

</div>
