<div class="sui-sidenav">

	<div class="sui-sidenav-sticky sui-sidenav-hide-md">

		<ul class="sui-vertical-tabs sui-alt-design">

			<?php foreach ( $wizard_tabs as $key => $option ) {

				$tab_name = $key;

				if ( isset( $option['name'] ) && '' !== $option['name'] ) {
					$tab_name = $option['name'];
				}

				if ( isset( $option['is_optin'] ) ) {

					if ( $is_optin ) : ?>

						<li class="sui-vertical-tab">
							<a href="#" data-tab="<?php echo esc_html( $key ); ?>" class="<?php echo $key === $section ? 'current' : ''; ?>">
								<?php echo esc_html( $tab_name ); ?>
							</a>
						</li>

					<?php endif;

				} else { ?>

					<li class="sui-vertical-tab">
						<a href="#" data-tab="<?php echo esc_html( $key ); ?>" class="<?php echo $key === $section ? 'current' : ''; ?>">
							<?php echo esc_html( $tab_name ); ?>
						</a>
					</li>

				<?php }

			} ?>

		</ul>

		<?php if ( 'social_sharing' !== $module_type ) { ?>

			<div class="sui-sidenav-settings">

				<button id="hustle-preview-module" class="sui-button sui-sidenav-hide-md">
					<span class="sui-loading-text">
						<i class="sui-icon-eye" aria-hidden="true"></i>
						<span class="button-text"><?php esc_html_e( 'Preview', 'wordpress-popup' ); ?></span>
					</span>
					<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
				</button>

			</div>

		<?php } ?>

	</div>

	<div class="sui-sidenav-settings">

		<div id="hustle-module-name-wrapper" class="sui-form-field sui-with-floating-input">

			<input type="text"
				id="hustle-module-name"
				name="module_name"
				data-attribute="module_name"
				value="<?php echo esc_attr( $module_name ); ?>"
				placeholder="<?php esc_html_e( 'E.g. Newsletter', 'wordpress-popup' ); ?>"
				class="sui-form-control" />

			<span id="hustle-module-name-error" class="sui-error-message" style="display: none;"><?php esc_html_e( 'This field is required.', 'wordpress-popup' ); ?></span>

		</div>

		<?php if ( 'social_sharing' !== $module_type ) { ?>

			<div class="sui-sidenav-hide-lg">

				<button id="hustle-preview-module" class="sui-button">
					<span class="sui-loading-text">
						<i class="sui-icon-eye" aria-hidden="true"></i>
						<span class="button-text"><?php esc_html_e( 'Preview', 'wordpress-popup' ); ?></span>
					</span>
					<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
				</button>

			</div>

		<?php } ?>

	</div>

</div>
