<div class="sui-focal">

	<div class="hustle-focal-point-position-item">

		<span class="sui-description"><?php esc_html_e( 'Adjust the position of your feature image within the image container.', 'wordpress-popup' ); ?></span>

		<div class="sui-focal-position-x">

			<div class="sui-form-field">

				<label class="sui-label"><?php esc_html_e( 'Horizontal', 'wordpress-popup' ); ?></label>

				<div class="sui-side-tabs" style="margin-top: 5px;">

					<div class="sui-tabs-menu">

						<label

							for="hustle-in-container-image-positionX--left"
							class="sui-tab-item {{ _.class( ( 'left' === feature_image_horizontal ), 'active' ) }}"
						>
							<input
								type="radio"
								data-attribute="feature_image_horizontal"
								value="left"
								id="hustle-in-container-image-positionX--left"
								{{ _.checked( ( 'left' === feature_image_horizontal ), true ) }}
							/>
							<span class="hui-position-icon-left" aria-hidden="true"></span>
							<span class="sui-screen-reader-text"><?php esc_html_e( 'Left', 'wordpress-popup' ); ?></span>
						</label>

						<label
							for="hustle-in-container-image-positionX--center"
							class="sui-tab-item {{ _.class( ( 'center' === feature_image_horizontal ), 'active' ) }}"
						>
							<input
								type="radio"
								data-attribute="feature_image_horizontal"
								value="center"
								id="hustle-in-container-image-positionX--center"
								{{ _.checked( ( 'center' === feature_image_horizontal ), true ) }}
							/>
							<span class="hui-position-icon-center" aria-hidden="true"></span>
							<span class="sui-screen-reader-text"><?php esc_html_e( 'Center', 'wordpress-popup' ); ?></span>
						</label>

						<label
							for="hustle-in-container-image-positionX--right"
							class="sui-tab-item {{ _.class( ( 'right' === feature_image_horizontal ), 'active' ) }}"
						>
							<input
								type="radio"
								data-attribute="feature_image_horizontal"
								value="right"
								id="hustle-in-container-image-positionX--right"
								{{ _.checked( ( 'right' === feature_image_horizontal ), true ) }}
							/>
							<span class="hui-position-icon-right" aria-hidden="true"></span>
							<span class="sui-screen-reader-text"><?php esc_html_e( 'Right', 'wordpress-popup' ); ?></span>
						</label>

						<label
							for="hustle-in-container-image-positionX--custom"
							class="sui-tab-item {{ _.class( ( 'custom' === feature_image_horizontal ), 'active' ) }}"
						>
							<input
								type="radio"
								data-attribute="feature_image_horizontal"
								value="custom"
								id="hustle-in-container-image-positionX--custom"
								{{ _.checked( ( 'custom' === feature_image_horizontal ), true ) }}
							/>
							<?php esc_html_e( 'Custom', 'wordpress-popup' ); ?>
						</label>

					</div>

				</div>

			</div>

			<div class="sui-form-field">

				<label class="sui-label" for="hustle-image-custom-position-horizontal">
					<span class="sui-label-note"><?php esc_html_e( 'In px', 'wordpress-popup' ); ?></span>
				</label>

				<input
					type="number"
					placeholder="E.g. 50"
					data-attribute="feature_image_horizontal_px"
					value="{{ feature_image_horizontal_px }}"
					class="sui-form-control"
					id="hustle-image-custom-position-horizontal"
					{{ 'custom' !== feature_image_horizontal ? 'disabled=disabled' : '' }}
				/>

				<span class="sui-error-message" style="display: none;"><?php esc_html_e( 'Invalid', 'wordpress-popup' ); ?></span>

			</div>

		</div>

		<div class="sui-focal-position-y">

			<div class="sui-form-field">

				<label class="sui-label"><?php esc_html_e( 'Vertical', 'wordpress-popup' ); ?></label>

				<div class="sui-side-tabs" style="margin-top: 5px;">

					<div class="sui-tabs-menu">

						<label
							for="hustle-in-container-image-positionY--top"
							class="sui-tab-item {{ _.class( ( 'top' === feature_image_vertical ), 'active' ) }}"
						>
							<input
								type="radio"
								data-attribute="feature_image_vertical"
								value="top"
								id="hustle-in-container-image-positionY--top"
								{{ _.checked( ( 'top' === feature_image_vertical ), true ) }}
							/>
							<span class="hui-position-icon-top" aria-hidden="true"></span>
							<span class="sui-screen-reader-text"><?php esc_html_e( 'Top', 'wordpress-popup' ); ?></span>
						</label>

						<label
							for="hustle-in-container-image-positionY--middle"
							class="sui-tab-item {{ _.class( ( 'center' === feature_image_vertical ), 'active' ) }}"
						>
							<input
								type="radio"
								data-attribute="feature_image_vertical"
								value="center"
								id="hustle-in-container-image-positionY--middle"
								{{ _.checked( ( 'center' === feature_image_vertical ), true ) }}
							/>
							<span class="hui-position-icon-middle" aria-hidden="true"></span>
							<span class="sui-screen-reader-text"><?php esc_html_e( 'Middle', 'wordpress-popup' ); ?></span>
						</label>

						<label
							for="hustle-in-container-image-positionY--bottom"
							class="sui-tab-item {{ _.class( ( 'bottom' === feature_image_vertical ), 'active' ) }}"
						>
							<input
								type="radio"
								data-attribute="feature_image_vertical"
								value="bottom"
								id="hustle-in-container-image-positionY--bottom"
								{{ _.checked( ( 'bottom' === feature_image_vertical ), true ) }}
							/>
							<span class="hui-position-icon-bottom" aria-hidden="true"></span>
							<span class="sui-screen-reader-text"><?php esc_html_e( 'Bottom', 'wordpress-popup' ); ?></span>
						</label>

						<label
							for="hustle-in-container-image-positionY--custom"
							class="sui-tab-item {{ _.class( ( 'custom' === feature_image_vertical ), 'active' ) }}"
						>
							<input
								type="radio"
								data-attribute="feature_image_vertical"
								value="custom"
								id="hustle-in-container-image-positionY--custom"
								{{ _.checked( ( 'custom' === feature_image_vertical ), true ) }}
							/>
							<?php esc_html_e( 'Custom', 'wordpress-popup' ); ?>
						</label>

					</div>

				</div>

			</div>

			<div class="sui-form-field">

				<label class="sui-label" for="hustle-image-custom-position-vertical">
					<span class="sui-label-note"><?php esc_html_e( 'In px', 'wordpress-popup' ); ?></span>
				</label>

				<input
					type="number"
					value="{{ feature_image_vertical_px }}"
					data-attribute="feature_image_vertical_px"
					placeholder="E.g. 50"
					class="sui-form-control"
					id="hustle-image-custom-position-vertical"
					{{ 'custom' !== feature_image_vertical ? 'disabled=disabled' : '' }}
				/>

				<span class="sui-error-message" style="display: none;"><?php esc_html_e( 'Invalid', 'wordpress-popup' ); ?></span>

			</div>

		</div>

	</div>

</div>
