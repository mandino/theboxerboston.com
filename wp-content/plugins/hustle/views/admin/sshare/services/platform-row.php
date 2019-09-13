<script id="hustle-platform-row-tpl" type="text/template">

	<div class="sui-builder-field sui-accordion-item sui-can-move" id="hustle-platform-{{platform}}" data-platform="{{platform}}">

		<div class="sui-accordion-item-header">

			<i class="sui-icon-drag" aria-hidden="true"></i>

			<div class="sui-builder-field-label">

				<span class="sui-icon-social" aria-hidden="true">

					<span class="hui-icon-social-{{platform_style}} hui-icon-circle"></span>

				</span>

				<span>{{label}}</span>

			</div>

			<button class="sui-button-icon sui-button-red hustle-remove-social-service" data-platform="{{platform}}">
				<i class="sui-icon-trash" aria-hidden="true"></i>
				<span class="sui-screen-reader-text"><?php esc_html_e( 'Remove platform', 'wordpress-popup' ); ?></span>
			</button>

			<div class="sui-builder-field-border" aria-hidden="true"></div>

			<button class="sui-button-icon sui-accordion-open-indicator">
				<i class="sui-icon-chevron-down" aria-hidden="true"></i>
				<span class="sui-screen-reader-text"><?php esc_html_e( 'Open platform settings', 'wordpress-popup' ); ?></span>
			</button>

		</div>

		<div class="sui-accordion-item-body">

			<div class="sui-form-field {{ ( '0' === counter_enabled ) ? 'sui-hidden' : '' }}">

				<label class="sui-label"><?php esc_html_e( 'Counter type', 'wordpress-popup' ); ?></label>

				<# if ( hasCounter ) { #>

					<div class="sui-side-tabs">

						<div class="sui-tabs-menu">

							<label for="hustle-{{platform}}-counter--click" class="sui-tab-item{{ ( 'click' === type ) ? ' active' : '' }}">
								<input
									type="radio"
									value="click"
									name="{{platform}}_type"
									data-attribute="{{platform}}_type"
									data-tab-menu="{{platform}}-type-click"
									id="hustle-{{platform}}-counter--click"
									{{ _.selected( ( 'click' === type ), true) }}
								/>
								<?php esc_html_e( 'Click', 'wordpress-popup' ); ?>
							</label>

							<label for="hustle-{{platform}}-counter--native" class="sui-tab-item{{ ( 'native' === type ) ? ' active' : '' }}">
								<input
									type="radio"
									value="native"
									name="{{platform}}_type"
									data-attribute="{{platform}}_type"
									data-tab-menu="{{platform}}-type-native"
									id="hustle-{{platform}}-counter--native"
									{{ _.selected( ( 'native' === type ), true) }}
								/>
								<?php esc_html_e( 'Native', 'wordpress-popup' ); ?>
							</label>

						</div>

						<# if ( 'twitter' === platform ) { #>
							<div class="sui-tabs-content">
								<div class="sui-tab-content {{ ( 'native' === type ) ? 'active' : '' }}" data-tab-content="{{platform}}-type-native">
									<span class="sui-description">
										<?php printf(
												esc_html__( 'Twitter deprecated its native counter functionality. Sign-up to %1$sthis service%2$s in order to retrieve your Twitter stats. Keep in mind that this only tracks new shares after you register your site.', 'wordpress-popup' ),
											'<a href="http://www.twitcount.com/" target="_blank">', '</a>'
										); ?>
									</span>
								</div>
							</div>
						<# } #>

					</div>

				<# } else { #>

					<div class="sui-notice" style="margin-top: 10px;">

						<p style="margin: 0;"><?php esc_html_e( 'This social service only supports Click counter as there is no API support for Native counter.', 'wordpress-popup' ); ?></p>

					</div>

				<# } #>

			</div>

			<div class="sui-form-field {{ ( '0' === counter_enabled ) ? 'sui-hidden' : '' }}">

				<label class="sui-label"><?php esc_html_e( 'Default counter', 'wordpress-popup' ); ?></label>

				<input
					type="number"
					name="{{platform}}_counter"
					data-attribute="{{platform}}_counter"
					value="{{counter}}"
					placeholder="<?php esc_html_e( 'E.g. 0', 'wordpress-popup' ); ?>"
					class="sui-form-control"
				/>

			</div>

			<div class="sui-form-field">

				<# if ( hasEndpoint ) { #>

					<label class="sui-label"><?php esc_html_e( 'Custom URL (optional)', 'wordpress-popup' ); ?></label>

				<# } else { #>

					<label class="sui-label"><?php esc_html_e( 'Custom URL', 'wordpress-popup' ); ?></label>

				<# } #>

				<input
					type="url"
					name="{{platform}}_link"
					data-attribute="{{platform}}_link"
					value="{{link}}"
					placeholder="<?php esc_html_e( 'Type the custom URL here', 'wordpress-popup' ); ?>"
					class="sui-form-control"
				/>

				<# if ( hasEndpoint ) { #>

					<span class="sui-description"><?php esc_html_e( 'Redirect visitors to this URL when they click the icon. Leaving this blank will share the page link instead.', 'wordpress-popup' ); ?></span>

				<# } else { #>

					<span class="sui-description"><?php esc_html_e( 'Redirect visitors to this URL when they click the icon. Note that a valid redirect URL is required to show this icon to your visitors.', 'wordpress-popup' ); ?></span>

				<# } #>

			</div>

		</div>

	</div>

</script>
