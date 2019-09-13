<div id="hustle-appearance-icons-style" class="sui-box-settings-row"<?php if ( $is_empty ) echo ' style="display: none;"'; ?>>

	<div class="sui-box-settings-col-1">

		<span class="sui-settings-label"><?php esc_html_e( 'Icons Style', 'wordpress-popup' ); ?></span>
		<span class="sui-description"><?php esc_html_e( 'Choose the style for your social icons as per your need.', 'wordpress-popup' ); ?></span>

	</div>

	<div class="sui-box-settings-col-2">

		<div class="sui-side-tabs">

			<div class="sui-tabs-menu">

				<label
					for="hustle-social-icon--default"
					class="sui-tab-item{{ ( 'flat' === icon_style ) ? ' active' : '' }}"
				>
					<input
						type="radio"
						name="icon_style"
						data-attribute="icon_style"
						value="flat"
						id="hustle-social-icon--default"
						{{ _.checked( 'flat' === icon_style, true) }}
					/>
					<i class="hui-icon-social-facebook hui-sm" aria-hidden="true"></i>
					<span class="sui-screen-reader-text"><?php esc_html_e( 'Default', 'wordpress-popup' ); ?></span>
				</label>

				<label
					for="hustle-social-icon--outlined"
					class="sui-tab-item{{ ( 'outline' === icon_style ) ? ' active' : '' }}"
				>
					<input
						type="radio"
						name="icon_style"
						data-attribute="icon_style"
						value="outline"
						id="hustle-social-icon--outlined"
						{{ _.checked( 'outline' === icon_style, true) }}
					/>
					<i class="hui-icon-social-facebook hui-icon-outlined hui-sm" aria-hidden="true"></i>
					<span class="sui-screen-reader-text"><?php esc_html_e( 'Outlined', 'wordpress-popup' ); ?></span>
				</label>

				<label
					for="hustle-social-icon--circle"
					class="sui-tab-item{{ ( 'rounded' === icon_style ) ? ' active' : '' }}"
				>
					<input
						type="radio"
						name="icon_style"
						data-attribute="icon_style"
						value="rounded"
						id="hustle-social-icon--circle"
						{{ _.checked( 'rounded' === icon_style, true) }}
					/>
					<i class="hui-icon-social-facebook hui-icon-circle hui-sm" aria-hidden="true"></i>
					<span class="sui-screen-reader-text"><?php esc_html_e( 'Circle', 'wordpress-popup' ); ?></span>
				</label>

				<label
					for="hustle-social-icon--square"
					class="sui-tab-item{{ ( 'squared' === icon_style ) ? ' active' : '' }}"
				>
					<input
						type="radio"
						name="icon_style"
						data-attribute="icon_style"
						value="squared"
						id="hustle-social-icon--square"
						{{ _.checked( 'squared' === icon_style, true) }}
					/>
					<i class="hui-icon-social-facebook hui-icon-square hui-sm" aria-hidden="true"></i>
					<span class="sui-screen-reader-text"><?php esc_html_e( 'Square', 'wordpress-popup' ); ?></span>
				</label>

			</div>

		</div>

	</div>

</div>
