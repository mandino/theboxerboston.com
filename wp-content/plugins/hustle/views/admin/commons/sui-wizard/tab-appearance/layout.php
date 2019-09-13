<?php
$info_default = self::$plugin_url . 'assets/images/layouts/layout-info-default';
$info_compact = self::$plugin_url . 'assets/images/layouts/layout-info-compact';
$info_stacked = self::$plugin_url . 'assets/images/layouts/layout-info-stacked';

$optin_default = self::$plugin_url . 'assets/images/layouts/layout-optin-default';
$optin_compact = self::$plugin_url . 'assets/images/layouts/layout-optin-compact';
$optin_focus   = self::$plugin_url . 'assets/images/layouts/layout-optin-focus';
$content_focus = self::$plugin_url . 'assets/images/layouts/layout-content-focus';
?>

<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label"><?php esc_html_e( 'Layout', 'wordpress-popup' ); ?></span>

		<?php if ( $is_optin ) { ?>
			<span class="sui-description"><?php printf( esc_html__( 'Select from one of the pre-built layouts for your %s as per your liking.', 'wordpress-popup' ), esc_html( $smallcaps_singular ) ); ?></span>
		<?php } else { ?>
			<span class="sui-description"><?php printf( esc_html__( 'Choose one of the pre-built layouts for your %s content.', 'wordpress-popup' ), esc_html( $smallcaps_singular ) ); ?></span>
		<?php } ?>
	</div>

	<div class="sui-box-settings-col-2">

		<?php if ( $is_optin ) { ?>

			<label for="hustle-layout-one" class="sui-radio-image">

				<?php Opt_In_Utils::hustle_image( $optin_default, 'png', '', true ); ?>

				<span class="sui-radio sui-radio-sm">
					<input type="radio"
						name="form_layout"
						value="one"
						id="hustle-layout-one"
						data-attribute="form_layout"
						{{_.checked( ( 'one' === form_layout ) , true)}} />
					<span aria-hidden="true"></span>
					<span><?php esc_html_e( 'Default', 'wordpress-popup' ); ?></span>
				</span>

			</label>

			<label for="hustle-layout-two" class="sui-radio-image">

				<?php Opt_In_Utils::hustle_image( $optin_compact, 'png', '', true ); ?>

				<span class="sui-radio sui-radio-sm">
					<input type="radio"
						name="form_layout"
						value="two"
						id="hustle-layout-two"
						data-attribute="form_layout"
						{{_.checked( ( 'two' === form_layout ) , true)}} />
					<span aria-hidden="true"></span>
					<span><?php esc_html_e( 'Compact', 'wordpress-popup' ); ?></span>
				</span>

			</label>

			<label for="hustle-layout-three" class="sui-radio-image">

				<?php Opt_In_Utils::hustle_image( $optin_focus, 'png', 'sui-graphic', true ); ?>

				<span class="sui-radio sui-radio-sm">
					<input type="radio"
						name="form_layout"
						value="three"
						id="hustle-layout-three"
						data-attribute="form_layout"
						{{_.checked( ( 'three' === form_layout ) , true)}} />
					<span aria-hidden="true"></span>
					<span><?php esc_html_e( 'Opt-in Focus', 'wordpress-popup' ); ?></span>
				</span>

			</label>

			<label for="hustle-layout-four" class="sui-radio-image">

				<?php Opt_In_Utils::hustle_image( $content_focus, 'png', 'sui-graphic', true ); ?>

				<span class="sui-radio sui-radio-sm">
					<input type="radio"
						name="form_layout"
						value="four"
						id="hustle-layout-four"
						data-attribute="form_layout"
						{{_.checked( ( 'four' === form_layout ) , true)}} />
					<span aria-hidden="true"></span>
					<span><?php esc_html_e( 'Content Focus', 'wordpress-popup' ); ?></span>
				</span>

			</label>

		<?php } else { ?>

			<label for="hustle-layout-minimal" class="sui-radio-image">

				<?php Opt_In_Utils::hustle_image( $info_default, 'png', 'sui-graphic', true ); ?>

				<span class="sui-radio sui-radio-sm">
					<input type="radio"
						name="style"
						value="minimal"
						id="hustle-layout-minimal"
						data-attribute="style"
						{{ _.checked( ( 'minimal' === style ), true ) }} />
					<span aria-hidden="true"></span>
					<span><?php esc_html_e( 'Default', 'wordpress-popup' ); ?></span>
				</span>

			</label>

			<label for="hustle-layout-simple" class="sui-radio-image">

				<?php Opt_In_Utils::hustle_image( $info_compact, 'png', 'sui-graphic', true ); ?>

				<span class="sui-radio sui-radio-sm">
					<input type="radio"
						name="style"
						value="simple"
						id="hustle-layout-simple"
						data-attribute="style"
						{{_.checked( ( 'simple' === style ) , true)}} />
					<span aria-hidden="true"></span>
					<span><?php esc_html_e( 'Compact', 'wordpress-popup' ); ?></span>
				</span>

			</label>

			<label for="hustle-layout-cabriolet" class="sui-radio-image">

				<?php Opt_In_Utils::hustle_image( $info_stacked, 'png', 'sui-graphic', true ); ?>

				<span class="sui-radio sui-radio-sm">
					<input type="radio"
						name="style"
						value="cabriolet"
						id="hustle-layout-cabriolet"
						data-attribute="style"
						{{_.checked( ( 'cabriolet' === style ) , true)}} />
					<span aria-hidden="true"></span>
					<span><?php esc_html_e( 'Stacked', 'wordpress-popup' ); ?></span>
				</span>

			</label>

		<?php } ?>

	</div>

</div>
