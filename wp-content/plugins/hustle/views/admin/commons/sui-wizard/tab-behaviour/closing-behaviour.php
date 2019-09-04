<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label"><?php esc_html_e( 'Closing Behavior', Opt_In::TEXT_DOMAIN ); ?></span>
		<span class="sui-description"><?php printf( esc_html__( 'Choose how your %s will behave after it has been closed.', Opt_In::TEXT_DOMAIN ), esc_html( $smallcaps_singular ) ); ?></span>
	</div>

	<div class="sui-box-settings-col-2">

		<?php
		// SETTINGS: Closed by ?>
		<div class="sui-form-field">

			<label class="sui-settings-label"><?php esc_html_e( 'Closed by', Opt_In::TEXT_DOMAIN ); ?></label>
			<span class="sui-description"><?php esc_html_e( 'Choose the methods of closing for which the closing behaviour should apply.', Opt_In::TEXT_DOMAIN ); ?></span>

			<div style="margin-top: 10px;">

				<label id="hustle-closing-behaviour--icon-label" for="hustle-closing-behaviour--icon" class="sui-checkbox sui-checkbox-sm sui-checkbox-stacked">
					<input type="checkbox"
						value="click_close_icon"
						id="hustle-closing-behaviour--icon"
						name="after_close_trigger"
						data-attribute="after_close_trigger"
						{{ _.checked( _.contains( after_close_trigger, 'click_close_icon'  ), true ) }}/>
					<span aria-hidden="true"></span>
					<span><?php printf( esc_html__( '%s closed by the visitor by clicking on “x” icon', Opt_In::TEXT_DOMAIN ), esc_html( $capitalize_singular ) ); ?></span>
				</label>

				<label id="hustle-closing-behaviour--timer-label" for="hustle-closing-behaviour--timer" class="sui-checkbox sui-checkbox-sm sui-checkbox-stacked"{{ _.isTrue( auto_hide ) ? '' : ' style=display:none;' }}>
					<input type="checkbox"
						value="auto_hide"
						id="hustle-closing-behaviour--timer"
						name="after_close_trigger"
						data-attribute="after_close_trigger"
						{{ _.checked( _.contains( after_close_trigger, 'auto_hide'  ), true ) }} />
					<span aria-hidden="true"></span>
					<span><?php esc_html_e( 'Auto closed based on the auto close timer', Opt_In::TEXT_DOMAIN ); ?></span>
				</label>

				<?php if ( Hustle_Module_Model::POPUP_MODULE === $module_type ) : ?>

					<label id="hustle-closing-behaviour--mask-label" for="hustle-closing-behaviour--mask" class="sui-checkbox sui-checkbox-sm sui-checkbox-stacked"{{ _.isTrue( close_on_background_click ) ? '' : ' style=display:none;' }}>
						<input type="checkbox"
							value="click_outside"
							id="hustle-closing-behaviour--mask"
							name="after_close_trigger"
							data-attribute="after_close_trigger"
							{{ _.checked( _.contains( after_close_trigger, 'click_outside' ), true ) }} />
						<span aria-hidden="true"></span>
						<span><?php printf( esc_html__( '%1$s closed by clicking outisde of the %2$s', Opt_In::TEXT_DOMAIN ), esc_html( $capitalize_singular ), esc_html( $smallcaps_singular ) ); ?></span>
					</label>

				<?php endif; ?>

			</div>

		</div>

		<?php
		// SETTINGS: Behavior ?>
		<div class="sui-form-field">

			<label class="sui-settings-label"><?php esc_html_e( 'Behavior', Opt_In::TEXT_DOMAIN ); ?></label>
			<span class="sui-description"><?php printf( esc_html__( 'The following behavior will be applied to your %s when closed by any of the selected methods above.', Opt_In::TEXT_DOMAIN ), esc_html( $smallcaps_singular ) ); ?></span>

			<div style="margin: 10px 0;">

				<select name="after_close" data-attribute="after_close" >

					<option value="no_show_on_post"
						{{ _.selected( ( 'no_show_on_post' === after_close ), true) }}>
						<?php esc_attr_e( 'Do not show this message on this post / page', Opt_In::TEXT_DOMAIN ); ?>
					</option>

					<option value="no_show_all"
						{{ _.selected( ( 'no_show_all' === after_close ), true) }}>
						<?php esc_attr_e( 'Do not show this message across the site', Opt_In::TEXT_DOMAIN ); ?>
					</option>

					<option value="keep_show"
						{{ _.selected( ( 'keep_show' === after_close ), true) }}>
						<?php esc_attr_e( 'Keep showing this message', Opt_In::TEXT_DOMAIN ); ?>
					</option>

				</select>

			</div>

			<div class="sui-border-frame" style="margin-bottom: 5px;">

				<label class="sui-label"><?php esc_html_e( 'Reset this after', Opt_In::TEXT_DOMAIN ); ?></label>

				<div class="sui-row">

					<div class="sui-col-md-6">

						<input type="number"
							value="{{ expiration }}"
							min="0"
							class="sui-form-control"
							data-attribute="expiration" />

					</div>

					<div class="sui-col-md-6">

						<select data-attribute="expiration_unit" >

							<option value="days"
								{{ _.selected( ( 'days' === expiration_unit ), true) }}>
								<?php esc_html_e( 'day(s)', Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="weeks"
								{{ _.selected( ( 'weeks' === expiration_unit ), true) }}>
								<?php esc_html_e( 'week(s)', Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="months"
								{{ _.selected( ( 'months' === expiration_unit ), true) }}>
								<?php esc_html_e( 'month(s)', Opt_In::TEXT_DOMAIN ); ?>
							</option>

							<option value="years"
								{{ _.selected( ( 'years' === expiration_unit ), true) }}>
								<?php esc_html_e( 'year(s)', Opt_In::TEXT_DOMAIN ); ?>
							</option>

						</select>

					</div>

				</div>

			</div>

			<span class="sui-description"><?php printf( esc_html__( '%s will again be visible to the visitor after this much time has passed since the visitor closed it.', Opt_In::TEXT_DOMAIN ), esc_html( $capitalize_singular ) ); ?></span>

		</div>

	</div>

</div>
