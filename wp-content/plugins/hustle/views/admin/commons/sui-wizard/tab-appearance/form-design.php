<div class="sui-box-settings-row">

	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label"><?php esc_html_e( 'Form Design', Opt_In::TEXT_DOMAIN ); ?></span>
		<span class="sui-description"><?php esc_html_e( 'Choose the settings for your optin form as per your liking.', Opt_In::TEXT_DOMAIN ); ?></span>
	</div>

	<div class="sui-box-settings-col-2">

		<?php
		// SETTING: Form fields style ?>
		<div class="sui-form-field">

			<label class="sui-label"><?php esc_html_e( 'Form fields style', Opt_In::TEXT_DOMAIN ); ?></label>

			<div class="sui-side-tabs">

				<div class="sui-tabs-menu">

					<label for="hustle-field-style--flat" class="sui-tab-item{{ ( 'flat' === form_fields_style ) ? ' active' : '' }}">
						<input type="radio"
							name="form_fields_style"
							data-attribute="form_fields_style"
							value="flat"
							id="hustle-field-style--flat"
							{{ _.checked( 'flat' === form_fields_style, true ) }} />
						<?php esc_html_e( 'Flat', Opt_In::TEXT_DOMAIN ); ?>
					</label>

					<label for="hustle-field-style--outlined" class="sui-tab-item{{ ( 'outlined' === form_fields_style ) ? ' active' : '' }}">
						<input type="radio"
							name="form_fields_style"
							data-attribute="form_fields_style"
							value="outlined"
							id="hustle-field-style--outlined"
							data-tab-menu="hustle-field-style"
							{{ _.checked( 'outlined' === form_fields_style, true ) }}/>
						<?php esc_html_e( 'Outlined', Opt_In::TEXT_DOMAIN ); ?>
					</label>

				</div>

				<div class="sui-tabs-content">

					<div class="sui-tab-content sui-tab-boxed {{ ( 'flat' !== form_fields_style ) ? 'active' : '' }}" data-tab-content="hustle-field-style">

						<div class="sui-row">

							<div class="sui-col-md-4">

								<div class="sui-form-field">

									<label for="hustle-module--form-border-radius" class="sui-label"><?php esc_html_e( 'Radius', Opt_In::TEXT_DOMAIN ); ?></label>

									<input type="number"
										value="{{ form_fields_border_radius }}"
										data-attribute="form_fields_border_radius"
										id="hustle-module--form-border-radius"
										class="sui-form-control" />

								</div>

							</div>

							<div class="sui-col-md-4">

								<div class="sui-form-field">

									<label for="hustle-module--form-border-weight" class="sui-label"><?php esc_html_e( 'Weight', Opt_In::TEXT_DOMAIN ); ?></label>

									<input type="number"
										value="{{ form_fields_border_weight }}"
										data-attribute="form_fields_border_weight"
										id="hustle-module--form-border-weight"
										class="sui-form-control" />

								</div>

							</div>

							<div class="sui-col-md-4">

								<div class="sui-form-field">

									<label for="hustle-module--form-border-type" class="sui-label"><?php esc_html_e( 'Border type', Opt_In::TEXT_DOMAIN ); ?></label>

									<select id="hustle-module--form-border-type" data-attribute="form_fields_border_type">
										<option value="solid" {{ ( 'solid' === form_fields_border_type ) ? 'selected' : '' }} ><?php esc_attr_e( "Solid", Opt_In::TEXT_DOMAIN ); ?></option>
										<option value="dotted" {{ ( 'dotted' === form_fields_border_type ) ? 'selected' : '' }} ><?php esc_attr_e( "Dotted", Opt_In::TEXT_DOMAIN ); ?></option>
										<option value="dashed" {{ ( 'dashed' === form_fields_border_type ) ? 'selected' : '' }} ><?php esc_attr_e( "Dashed", Opt_In::TEXT_DOMAIN ); ?></option>
										<option value="double" {{ ( 'double' === form_fields_border_type ) ? 'selected' : '' }} ><?php esc_attr_e( "Double", Opt_In::TEXT_DOMAIN ); ?></option>
										<option value="none" {{ ( 'none' === form_fields_border_type ) ? 'selected' : '' }} ><?php esc_attr_e( "None", Opt_In::TEXT_DOMAIN ); ?></option>
									</select>

								</div>

							</div>

						</div>

						<span class="sui-description"><?php esc_html_e( 'Note: Set the color of the border in the Colors Palette area below.', Opt_In::TEXT_DOMAIN ); ?></span>

					</div>

				</div>

			</div>

		</div>

		<?php
		// SETTING: Form field icon ?>
		<div class="sui-form-field">

			<label class="sui-label"><?php esc_html_e( 'Form field icon', Opt_In::TEXT_DOMAIN ); ?></label>

			<div class="sui-side-tabs">

				<div class="sui-tabs-menu">

					<label for="hustle-field-icon--none" class="sui-tab-item{{ ( 'none' === form_fields_icon ) ? ' active' : '' }}">
						<input type="radio"
							name="form_fields_icon"
							data-attribute="form_fields_icon"
							value="none"
							id="hustle-field-icon--none"
							{{ _.checked( ( 'none' === form_fields_icon ) , true ) }} />
						<?php esc_html_e( 'No icon', Opt_In::TEXT_DOMAIN ); ?>
					</label>

					<label for="hustle-field-icon--static" class="sui-tab-item{{ ( 'static' === form_fields_icon ) ? ' active' : '' }}">
						<input type="radio"
							name="form_fields_icon"
							data-attribute="form_fields_icon"
							value="static"
							id="hustle-field-icon--static"
							{{ _.checked( ( 'static' === form_fields_icon ) , true ) }} />
						<?php esc_html_e( 'Static icon', Opt_In::TEXT_DOMAIN ); ?>
					</label>

					<label for="hustle-field-icon--animated" class="sui-tab-item{{ ( 'animated' === form_fields_icon ) ? ' active' : '' }}">
						<input type="radio"
							name="form_fields_icon"
							data-attribute="form_fields_icon"
							value="animated"
							id="hustle-field-icon--animated"
							{{ _.checked( ( 'animated' === form_fields_icon ) , true ) }} />
						<?php esc_html_e( 'Animated icon', Opt_In::TEXT_DOMAIN ); ?>
					</label>

				</div>

			</div>

		</div>

		<?php
		// SETTING: Form fields proximity ?>
		<div class="sui-form-field">

			<label class="sui-label"><?php esc_html_e( 'Form fields proximity', Opt_In::TEXT_DOMAIN ); ?></label>

			<div class="sui-side-tabs">

				<div class="sui-tabs-menu">

					<label for="hustle-field-proximity--separated" class="sui-tab-item{{ ( 'separated' === form_fields_proximity ) ? ' active' : '' }}">
						<input type="radio"
							name="form_fields_proximity"
							data-attribute="form_fields_proximity"
							value="separated"
							id="hustle-field-proximity--separated"
							{{ _.checked( ( 'separated' === form_fields_proximity ) , true ) }} />
						<?php esc_html_e( 'Separated', Opt_In::TEXT_DOMAIN ); ?>
					</label>

					<label for="hustle-field-proximity--joined" class="sui-tab-item{{ ( 'joined' === form_fields_proximity ) ? ' active' : '' }}">
						<input type="radio"
							name="form_fields_proximity"
							data-attribute="form_fields_proximity"
							value="joined"
							id="hustle-field-proximity--joined"
							{{ _.checked( ( 'joined' === form_fields_proximity ) , true ) }} />
						<?php esc_html_e( 'Joined', Opt_In::TEXT_DOMAIN ); ?>
					</label>

				</div>

			</div>

		</div>

		<?php
		// SETTING: Button style ?>
		<div class="sui-form-field">

			<label class="sui-label"><?php esc_html_e( 'Button style', Opt_In::TEXT_DOMAIN ); ?></label>

			<div class="sui-side-tabs">

				<div class="sui-tabs-menu">

					<label for="hustle-button-style--flat" class="sui-tab-item{{ ( 'flat' === button_style ) ? ' active' : '' }}">
						<input type="radio"
							name="button_style"
							data-attribute="button_style"
							value="flat"
							id="hustle-button-style--flat"
							{{ _.checked( 'flat' === button_style, true ) }} />
						<?php esc_html_e( 'Flat', Opt_In::TEXT_DOMAIN ); ?>
					</label>

					<label for="hustle-button-style--outlined" class="sui-tab-item{{ ( 'outlined' === button_style ) ? ' active' : '' }}">
						<input type="radio"
							name="button_style"
							data-attribute="button_style"
							value="outlined"
							id="hustle-button-style--outlined"
							data-tab-menu="hustle-button-style"
							{{ _.checked( 'outlined' === button_style, true ) }}/>
						<?php esc_html_e( 'Outlined', Opt_In::TEXT_DOMAIN ); ?>
					</label>

				</div>

				<div class="sui-tabs-content">

					<div class="sui-tab-content sui-tab-boxed {{ ( 'flat' !== button_style ) ? 'active' : '' }}" data-tab-content="hustle-button-style">

						<div class="sui-row">

							<div class="sui-col-md-4">

								<div class="sui-form-field">

									<label for="hustle-module--button-border-radius" class="sui-label"><?php esc_html_e( 'Radius', Opt_In::TEXT_DOMAIN ); ?></label>

									<input type="number"
										value="{{ button_border_radius }}"
										data-attribute="button_border_radius"
										id="hustle-module--button-border-radius"
										class="sui-form-control" />

								</div>

							</div>

							<div class="sui-col-md-4">

								<div class="sui-form-field">

									<label for="hustle-module--button-border-weight" class="sui-label"><?php esc_html_e( 'Weight', Opt_In::TEXT_DOMAIN ); ?></label>

									<input type="number"
										value="{{ button_border_weight }}"
										data-attribute="button_border_weight"
										id="hustle-module--button-border-weight"
										class="sui-form-control" />

								</div>

							</div>

							<div class="sui-col-md-4">

								<div class="sui-form-field">

									<label for="hustle-module--button-border-type" class="sui-label"><?php esc_html_e( 'Border type', Opt_In::TEXT_DOMAIN ); ?></label>

									<select id="hustle-module--button-border-type"
										data-attribute="button_border_type">

										<option value="solid"
											{{ ( 'solid' === button_border_type ) ? 'selected' : '' }}>
											<?php esc_attr_e( 'Solid', Opt_In::TEXT_DOMAIN ); ?>
										</option>

										<option value="dotted"
											{{ ( 'dotted' === button_border_type ) ? 'selected' : '' }}>
											<?php esc_attr_e( 'Dotted', Opt_In::TEXT_DOMAIN ); ?>
										</option>

										<option value="dashed"
											{{ ( 'dashed' === button_border_type ) ? 'selected' : '' }}>
											<?php esc_attr_e( 'Dashed', Opt_In::TEXT_DOMAIN ); ?>
										</option>

										<option value="double"
											{{ ( 'double' === button_border_type ) ? 'selected' : '' }}>
											<?php esc_attr_e( 'Double', Opt_In::TEXT_DOMAIN ); ?>
										</option>

										<option value="none"
											{{ ( 'none' === button_border_type ) ? 'selected' : '' }}>
											<?php esc_attr_e( 'None', Opt_In::TEXT_DOMAIN ); ?>
										</option>

									</select>

								</div>

							</div>

						</div>

						<span class="sui-description"><?php esc_html_e( 'Note: Set the color of the border in the Colors Palette area below.', Opt_In::TEXT_DOMAIN ); ?></span>

					</div>

				</div>

			</div>

		</div>

		<?php
		// SETTING: GDPR checkbox style ?>
		<div class="sui-form-field">

			<label class="sui-label"><?php esc_html_e( 'GDPR checkbox style', Opt_In::TEXT_DOMAIN ); ?></label>

			<div class="sui-side-tabs">

				<div class="sui-tabs-menu">

					<label for="hustle-gdpr-style--flat" class="sui-tab-item {{ _.class( 'flat' === gdpr_checkbox_style, 'active' ) }}">
						<input type="radio"
							name="gdpr_checkbox_style"
							data-attribute="gdpr_checkbox_style"
							value="flat"
							id="hustle-gdpr-style--flat"
							{{ _.checked( 'flat' === gdpr_checkbox_style, true ) }} />
						<?php esc_html_e( 'Flat', Opt_In::TEXT_DOMAIN ); ?>
					</label>

					<label for="hustle-gdpr-style--outlined" class="sui-tab-item {{ _.class( 'outlined' === gdpr_checkbox_style, 'active' ) }}">
						<input type="radio"
							name="gdpr_checkbox_style"
							data-attribute="gdpr_checkbox_style"
							value="outlined"
							id="hustle-gdpr-style--outlined"
							data-tab-menu="hustle-gdpr-style"
							{{ _.checked( 'outlined' === gdpr_checkbox_style, true ) }}/>
						<?php esc_html_e( 'Outlined', Opt_In::TEXT_DOMAIN ); ?>
					</label>

				</div>

				<div class="sui-tabs-content">

					<div class="sui-tab-content sui-tab-boxed {{ _.class( 'flat' !== gdpr_checkbox_style, 'active' ) }}" data-tab-content="hustle-gdpr-style">

						<div class="sui-row">

							<div class="sui-col-md-4">

								<div class="sui-form-field">

									<label for="hustle-module--gdpr-border-radius" class="sui-label"><?php esc_html_e( 'Radius', Opt_In::TEXT_DOMAIN ); ?></label>

									<input type="number"
										value="{{ gdpr_border_radius }}"
										data-attribute="gdpr_border_radius"
										id="hustle-module--gdpr-border-radius"
										class="sui-form-control" />

								</div>

							</div>

							<div class="sui-col-md-4">

								<div class="sui-form-field">

									<label for="hustle-module--gdpr-border-weight" class="sui-label"><?php esc_html_e( 'Weight', Opt_In::TEXT_DOMAIN ); ?></label>

									<input type="number"
										value="{{ gdpr_border_weight }}"
										data-attribute="gdpr_border_weight"
										id="hustle-module--gdpr-border-weight"
										class="sui-form-control" />

								</div>

							</div>

							<div class="sui-col-md-4">

								<div class="sui-form-field">

									<label for="hustle-module--gdpr-border-type" class="sui-label"><?php esc_html_e( 'Border type', Opt_In::TEXT_DOMAIN ); ?></label>

									<select id="hustle-module--gdpr-border-type"
										data-attribute="gdpr_border_type">

										<option value="solid"
											{{ _.selected( 'solid' === gdpr_border_type, true ) }}>
											<?php esc_attr_e( 'Solid', Opt_In::TEXT_DOMAIN ); ?>
										</option>

										<option value="dotted"
											{{ _.selected( 'dotted' === gdpr_border_type, true ) }}>
											<?php esc_attr_e( 'Dotted', Opt_In::TEXT_DOMAIN ); ?>
										</option>

										<option value="dashed"
											{{ _.selected( 'dashed' === gdpr_border_type, true ) }}>
											<?php esc_attr_e( 'Dashed', Opt_In::TEXT_DOMAIN ); ?>
										</option>

										<option value="double"
											{{ _.selected( 'double' === gdpr_border_type, true ) }}>
											<?php esc_attr_e( 'Double', Opt_In::TEXT_DOMAIN ); ?>
										</option>

										<option value="none"
											{{ _.selected( 'none' === gdpr_border_type, true ) }}>
											<?php esc_attr_e( 'None', Opt_In::TEXT_DOMAIN ); ?>
										</option>

									</select>

								</div>

							</div>

						</div>

						<span class="sui-description"><?php esc_html_e( 'Note: Set the color of the border in the Colors Palette area below.', Opt_In::TEXT_DOMAIN ); ?></span>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>
