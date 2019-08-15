<?php
$empty_icon = self::$plugin_url . 'assets/images/hustle-empty-icon.png';

$module_id = isset( $module_id ) ? $module_id : 0;

$show_action = false;

$icon_class_action = 'sui-icon-plus';
$tooltip = __( 'Configure Integration', Opt_In::TEXT_DOMAIN );
$action = 'hustle_provider_settings';

$multi_id   = 0;
$global_multi_id = 0;
$multi_name = false;

if ( ! empty( $module_id ) ) {

	// On wizards
	$action = 'hustle_provider_form_settings';
	$show_action = false;
	$icon_class_action = 'sui-icon-plus';

	if (
		isset( $provider['is_form_settings_available'] ) &&
		! empty( $provider['is_form_settings_available'] ) &&
		true === $provider['is_form_settings_available']
	) {

		$show_action = true;

		if ( $provider['is_allow_multi_on_form'] ) {

			if ( isset( $provider['multi_name'] ) ) {

				$icon_class_action = 'sui-icon-widget-settings-config';
				$tooltip           = __( 'Configure Integration', Opt_In::TEXT_DOMAIN );
				$multi_id          = $provider['multi_id'];
				$multi_name        = $provider['multi_name'];

			} else {

				if ( isset( $provider['multi_id'] ) ) {
					$multi_id = $provider['multi_id'];
				}

				$icon_class_action = 'sui-icon-plus';
				$tooltip           = __( 'Add Integration', Opt_In::TEXT_DOMAIN );

			}
		} else {

			if ( $provider['is_form_connected'] ) {

				$icon_class_action = 'sui-icon-widget-settings-config';
				$tooltip           = __( 'Configure Integration', Opt_In::TEXT_DOMAIN );

			} else {

				$icon_class_action = 'sui-icon-plus';
				$tooltip           = __( 'Add Integration', Opt_In::TEXT_DOMAIN );

			}
		}
	}

} else {

	// On integrations page
	if (
		isset( $provider['is_settings_available'] ) &&
		! empty( $provider['is_settings_available'] ) &&
		true === $provider['is_settings_available']
	) {

		$show_action = true;

		if ( $provider['is_multi_on_global'] ) {

			if ( isset( $provider['multi_name'] ) ) {

				$icon_class_action = 'sui-icon-widget-settings-config';
				$tooltip = __( 'Configure Integration', Opt_In::TEXT_DOMAIN );
				$global_multi_id = $provider['global_multi_id'];
				$multi_name = $provider['multi_name'];

			} else {

				if ( isset( $provider['global_multi_id'] ) ) {
					$global_multi_id = $provider['global_multi_id'];
				}

				$icon_class_action = 'sui-icon-plus';
				$tooltip           = __( 'Add Integration', Opt_In::TEXT_DOMAIN );

			}
		} else {

			if ( $provider['is_connected'] ) {

				$icon_class_action = 'sui-icon-widget-settings-config';
				$tooltip           = __( 'Configure Integration', Opt_In::TEXT_DOMAIN );

			} else {

				$icon_class_action = 'sui-icon-plus';
				$tooltip           = __( 'Add Integration', Opt_In::TEXT_DOMAIN );

			}
		}
	}
} ?>

<tr>

	<td class="sui-table-item-title">

		<span>

			<?php if ( ! empty( $provider['icon_2x'] ) ) {
				echo Opt_In_Utils::render_image_markup( $provider['icon_2x'], '', 'sui-image', '', '', false ); // WPCS: XSS ok.
			} else {
				echo '<span class="hui-noicon" aria-hidden="true">' . esc_html__( 'Icon', Opt_In::TEXT_DOMAIN ) . '</span>';
			} ?>

			<span><?php echo $provider['title'] . ( ! empty( $provider['multi_name'] ) ? ' – ' . $provider['multi_name'] : '' ); // WPCS: XSS ok. ?></span>

			<?php if ( $show_action ) : ?>

				<button class="sui-button-icon sui-tooltip sui-tooltip-top-right connect-integration"
					data-tooltip="<?php echo esc_html( $tooltip ); ?>"
					data-a11y-dialog-show="my-accessible-dialog"
					data-slug="<?php echo esc_attr( $provider['slug'] ); ?>"
					data-image="<?php echo esc_attr( $provider['logo_2x'] ); ?>"
					data-module_id="<?php echo esc_attr( $module_id ); ?>"
					data-multi_id="<?php echo esc_attr( $multi_id ); ?>"
					data-global_multi_id="<?php echo esc_attr( $global_multi_id ); ?>"
					data-action="<?php echo esc_attr( $action ); ?>"
					data-nonce="<?php echo esc_attr( wp_create_nonce( 'hustle_provider_action' ) ); ?>">
					<i class="<?php echo esc_attr( $icon_class_action ); ?>" aria-hidden="true"></i>
				</button>

			<?php endif; ?>

		</span>

	</td>

</tr>
