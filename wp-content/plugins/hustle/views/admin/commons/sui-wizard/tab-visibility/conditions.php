<?php
$image_1x = self::$plugin_url . 'assets/images/hustle-visibility.png';
$image_2x = self::$plugin_url . 'assets/images/hustle-visibility@2x.png';
?>

<?php
// TEMPLATE: Visibility Group ?>
<script id="hustle-visibility-group-box-tpl" type="text/template">

	<div id="hustle-visibility-group-{{ group_id }}" class="sui-box-builder" style="margin-bottom: 0;">

		<div class="sui-box-builder-header">

			<div class="sui-builder-conditions">

				<div class="sui-builder-conditions-rule">

					<span class="sui-builder-text"><?php printf( esc_html__( 'Shows %s if the following conditions are met.', Opt_In::TEXT_DOMAIN ), esc_html( $smallcaps_singular ) ); ?></span>

					<input type="hidden" name="filter_type" data-attribute="filter_type" data-group-id="{{ group_id }}" value="any">

					<!-- <span class="sui-builder-text"><?php printf( esc_html__( 'Shows %s if', Opt_In::TEXT_DOMAIN ), esc_html( $smallcaps_singular ) ); ?></span>

					<select
						name="filter_type"
						class="sui-select-sm visibility-group-filter-type"
						data-group-id="{{ group_id }}"
					>
						<option value="all" {{ _.selected( ( 'all' === filter_type ), true) }}><?php esc_html_e( 'all' ); ?></option>
						<option value="any" {{ _.selected( ( 'any' === filter_type ), true) }}><?php esc_html_e( 'some' ); ?></option>
						<option value="none" {{ _.selected( ( 'none' === filter_type ), true) }}><?php esc_html_e( 'none' ); ?></option>
					</select>

					<span class="sui-builder-text"><?php esc_html_e( 'of the following conditions are met.', Opt_In::TEXT_DOMAIN ); ?></span> -->

				</div>

				<?php if ( false ) : // To be added. ?>
					<div class="sui-builder-conditions-actions">

						<button
							class="sui-button-icon sui-button-red hustle-remove-visibility-group"
							data-group-id="{{ group_id }}"
						>
							<i class="sui-icon-trash" aria-hidden="true"></i>
							<span class="sui-screen-reader-text"><?php esc_html_e( 'Delete visibility group', Opt_In::TEXT_DOMAIN ); ?></span>
						</button>

					</div>
				<?php endif; ?>

			</div>

			<?php if ( false && 'embedded' === $module_type ) { ?>
				<div class="sui-builder-options sui-options-inline">

					<span class="sui-builder-text"><?php esc_html_e( 'Apply on', Opt_In::TEXT_DOMAIN ); ?></span>

					<label
						for="hustle-apply-on-inline-{{ group_id }}"
						class="sui-checkbox sui-checkbox-sm"
					>
						<input
							type="checkbox"
							id="hustle-apply-on-inline-{{ group_id }}"
							class="visibility-group-apply-on hustle-group-element"
							data-property="apply_on_inline"
							data-group-id="{{ group_id }}"
							{{ _.checked( apply_on_inline, true ) }}
						/>
						<span aria-hidden="true"></span>
						<span><?php esc_html_e( 'Inline Content', Opt_In::TEXT_DOMAIN ); ?></span>
					</label>

					<label
						for="hustle-apply-on-widget-{{ group_id }}"
						class="sui-checkbox sui-checkbox-sm"
					>
						<input
							type="checkbox"
							id="hustle-apply-on-widget-{{ group_id }}"
							class="visibility-group-apply-on hustle-group-element"
							data-property="apply_on_widget"
							data-group-id="{{ group_id }}"
							{{ _.checked( apply_on_widget, true ) }}
						/>
						<span aria-hidden="true"></span>
						<span><?php esc_html_e( 'Widget', Opt_In::TEXT_DOMAIN ); ?></span>
					</label>

				</div>
			<?php } ?>

			<?php if ( false && 'social_sharing' === $module_type ) { ?>
				<div class="sui-builder-options sui-options-inline">

					<span class="sui-builder-text"><?php esc_html_e( 'Apply on', Opt_In::TEXT_DOMAIN ); ?></span>

					<label
						for="hustle-apply-on-float-{{ group_id }}"
						class="sui-checkbox sui-checkbox-sm"
					>
						<input
							type="checkbox"
							id="hustle-apply-on-float-{{ group_id }}"
							class="visibility-group-apply-on hustle-group-element"
							data-property="apply_on_float"
							data-group-id="{{ group_id }}"
							{{ _.checked( apply_on_float, true ) }}
						/>
						<span aria-hidden="true"></span>
						<span><?php esc_html_e( 'Floating Social', Opt_In::TEXT_DOMAIN ); ?></span>
					</label>

					<label
						for="hustle-apply-on-inline-{{ group_id }}"
						class="sui-checkbox sui-checkbox-sm"
					>
						<input
							type="checkbox"
							id="hustle-apply-on-inline-{{ group_id }}"
							class="visibility-group-apply-on hustle-group-element"
							data-property="apply_on_inline"
							data-group-id="{{ group_id }}"
							{{ _.checked( apply_on_inline, true ) }}
						/>
						<span aria-hidden="true"></span>
						<span><?php esc_html_e( 'Inline Content', Opt_In::TEXT_DOMAIN ); ?></span>
					</label>

					<label
						for="hustle-apply-on-widget-{{ group_id }}"
						class="sui-checkbox sui-checkbox-sm"
					>
						<input
							type="checkbox"
							id="hustle-apply-on-widget-{{ group_id }}"
							class="visibility-group-apply-on hustle-group-element"
							data-property="apply_on_widget"
							data-group-id="{{ group_id }}"
							{{ _.checked( apply_on_widget, true ) }}
						/>
						<span aria-hidden="true"></span>
						<span><?php esc_html_e( 'Widget', Opt_In::TEXT_DOMAIN ); ?></span>
					</label>

				</div>
			<?php } ?>

		</div>

		<div class="sui-box-builder-body">

			<div class="sui-builder-fields sui-accordion"></div>

			<button class="sui-button sui-button-dashed hustle-choose-conditions" data-group-id="{{ group_id }}">
				<i class="sui-icon-plus" aria-hidden="true"></i> <?php esc_html_e( 'Add Conditions', Opt_In::TEXT_DOMAIN ); ?>
			</button>

			<div class="sui-box-builder-message-block">

				<span class="sui-box-builder-message"><?php printf( esc_html__( 'You don’t have any visibility condition yet. Currently, the %s will be visible everywhere across your website.', Opt_In::TEXT_DOMAIN ), esc_html( $smallcaps_singular ) ); ?></span>

				<?php echo Opt_In_Utils::render_image_markup( esc_url( $image_1x ), esc_url( $image_2x ), 'sui-image sui-image-center' ); // WPCS: XSS ok. ?>

			</div>

		</div>

	</div>

</script>

<?php
// TEMPLATE: Visibility Rule ?>
<script id="hustle-visibility-rule-tpl" type="text/template">

	<div class="sui-accordion-item-header">

		<div class="sui-builder-field-label">
			<span>{{ title }}</span>
			<span class="sui-tag" style="margin-left: 10px;">{{ header }}</span>
		</div>

		<button
			class="sui-button-icon sui-button-red sui-hover-show sui-accordion-item-action hustle-remove-visibility-condition"
			data-group-id="{{ group_id }}"
			data-condition-id="{{ id }}"
		>
			<i class="sui-icon-trash" aria-hidden="true"></i>
			<span class="sui-screen-reader-text"><?php esc_html_e( 'Delete visibility rule', Opt_In::TEXT_DOMAIN ); ?></span>
		</button>

		<span class="sui-builder-field-border sui-hover-show" aria-hidden="true"></span>

		<button class="sui-button-icon sui-accordion-open-indicator">
			<i class="sui-icon-chevron-down" aria-hidden="true"></i>
			<span class="sui-screen-reader-text"><?php esc_html_e( 'Open visibility rule', Opt_In::TEXT_DOMAIN ); ?></span>
		</button>

	</div>

	<div class="sui-accordion-item-body">{{{ body }}}</div>

</script>

<?php
// RULE: Posts ?>
<script id="hustle-visibility-rule-tpl--posts" type="text/template">

	<label class="sui-label"><?php printf( esc_html__( "Show %s on", Opt_In::TEXT_DOMAIN ), '{{ type_name }}' ); ?></label>

	<div class="sui-side-tabs">

		<div class="sui-tabs-menu">

			<label for="{{ group_id }}-{{ type }}-filter_type-posts-except"
				class="sui-tab-item{{ _.class( 'except' === filter_type, ' active' ) }}">
				<input type="radio"
					name="{{ group_id }}-{{ type }}-filter_type-posts"
					value="except"
					id="{{ group_id }}-{{ type }}-filter_type-posts-except"
					data-tab-menu="except"
					data-attribute="filter_type"
					{{ _.checked( filter_type, 'except' ) }} />
				<?php esc_html_e( 'All posts except', Opt_In::TEXT_DOMAIN ); ?>
			</label>

			<label for="{{ group_id }}-{{ type }}-filter_type-posts-only"
				class="sui-tab-item{{ _.class( 'only' === filter_type, ' active' ) }}">
				<input type="radio"
					name="{{ group_id }}-{{ type }}-filter_type-posts"
					value="only"
					id="{{ group_id }}-{{ type }}-filter_type-posts-only"
					data-tab-menu="only"
					data-attribute="filter_type"
					{{ _.checked( filter_type, 'only' ) }} />
				<?php esc_html_e( 'Only these posts', Opt_In::TEXT_DOMAIN ); ?>
			</label>

		</div>

		<div class="sui-tabs-content">

			<div class="sui-tab-content active">

				<select name=""
					id="{{ group_id }}-{{ type }}-filter_type-posts"
					class="sui-select sui-select-lg hustle-select-ajax"
					multiple="multiple"
					data-val="{{ posts }}"
					data-attribute="posts"
					placeholder="<?php esc_html_e( 'Start typing the name of posts...', Opt_In::TEXT_DOMAIN ); ?>">

					<# _.each( optin_vars.posts, function( post ) { #>
						<option value="{{ post.id }}"
							{{ _.selected( _.contains( posts, post.id.toString() ), true ) }}>
							{{ post.text }}
						</option>
					<# }); #>

				</select>

			</div>

		</div>

	</div>

</script>

<?php
// RULE: Pages ?>
<script id="hustle-visibility-rule-tpl--pages" type="text/template">

	<label class="sui-label"><?php printf( esc_html__( "Show %s on", Opt_In::TEXT_DOMAIN ), '{{ type_name }}' ); ?></label>

	<div class="sui-side-tabs">

		<div class="sui-tabs-menu">

			<label for="{{ group_id }}-{{ type }}-filter_type-pages-except"
				class="sui-tab-item{{ _.class( 'except' === filter_type, ' active' ) }}">
				<input type="radio"
					name="{{ group_id }}-{{ type }}-filter_type-pages"
					value="except"
					id="{{ group_id }}-{{ type }}-filter_type-pages-except"
					data-tab-menu="except"
					data-attribute="filter_type"
					{{ _.checked( filter_type, 'except' ) }} />
				<?php esc_html_e( 'All pages except', Opt_In::TEXT_DOMAIN ); ?>
			</label>

			<label for="{{ group_id }}-{{ type }}-filter_type-pages-only"
				class="sui-tab-item{{ _.class( 'only' === filter_type, ' active' ) }}">
				<input type="radio"
					name="{{ group_id }}-{{ type }}-filter_type-pages"
					value="only"
					id="{{ group_id }}-{{ type }}-filter_type-pages-only"
					data-tab-menu="only"
					data-attribute="filter_type"
					{{ _.checked( filter_type, 'only' ) }} />
				<?php esc_html_e( 'Only these pages', Opt_In::TEXT_DOMAIN ); ?>
			</label>

		</div>

		<div class="sui-tabs-content">

			<div class="sui-tab-content active">

				<select name=""
					id="{{ group_id }}-{{ type }}-filter_type-pages"
					class="sui-select sui-select-lg hustle-select-ajax"
					multiple="multiple"
					data-val="{{ pages }}"
					data-attribute="pages"
					placeholder="<?php esc_html_e( 'Start typing the name of pages...', Opt_In::TEXT_DOMAIN ); ?>">

					<# _.each( optin_vars.pages, function( page ) { #>
						<option value="{{ page.id }}"
							{{ _.selected( _.contains( pages, page.id.toString() ), true ) }}>
							{{ page.text }}
						</option>
					<# }); #>

				</select>

			</div>

		</div>

	</div>

</script>

<?php
// RULE: CPT ?>
<script id="hustle-visibility-rule-tpl--post_type" type="text/template">
	<label class="sui-label"><?php printf( esc_html__( "Show %s on", Opt_In::TEXT_DOMAIN ), '{{ type_name }}' ); ?></label>

	<div class="sui-side-tabs">

		<div class="sui-tabs-menu">

			<label for="{{ group_id }}-{{ type }}-filter_type-{{post_type}}-except"
				class="sui-tab-item{{ _.class( 'except' === filter_type, ' active' ) }}">
				<input type="radio"
					name="{{ group_id }}-{{ type }}-filter_type-{{post_type}}"
					value="except"
					id="{{ group_id }}-{{ type }}-filter_type-{{post_type}}-except"
					data-tab-menu="except"
					data-attribute="filter_type"
					{{ _.checked( filter_type, 'except' ) }} />
				<?php printf( esc_html__( 'All %s except', Opt_In::TEXT_DOMAIN ), '{{ post_type_label }}' ); ?>
			</label>

			<label for="{{ group_id }}-{{ type }}-filter_type-{{post_type}}-only"
				class="sui-tab-item{{ _.class( 'only' === filter_type, ' active' ) }}">
				<input type="radio"
					name="{{ group_id }}-{{ type }}-filter_type-{{post_type}}"
					value="only"
					id="{{ group_id }}-{{ type }}-filter_type-{{post_type}}-only"
					data-tab-menu="only"
					data-attribute="filter_type"
					{{ _.checked( filter_type, 'only' ) }} />
				<?php printf( esc_html__( 'Only these %s', Opt_In::TEXT_DOMAIN ), '{{ post_type_label }}' ); ?>
			</label>

		</div>

		<div class="sui-tabs-content">

			<div class="sui-tab-content active">

				<select name=""
					id="{{ group_id }}-{{ type }}-filter_type-{{post_type}}"
					class="sui-select sui-select-lg hustle-select-ajax"
					multiple="multiple"
					data-val="{{ selected_cpts }}"
					data-attribute="selected_cpts"
					placeholder="<?php printf( esc_html__( 'Start typing the name of %s...', Opt_In::TEXT_DOMAIN ), '{{ post_type_label }}' ); ?>">

					<# _.each( optin_vars.post_types[post_type].data, function( post ) { #>
						<option value="{{ post.id }}"
							{{ _.selected( _.contains( selected_cpts, post.id.toString() ), true ) }}>
							{{ post.text }}
						</option>
					<# }); #>

				</select>

			</div>

		</div>

	</div>

</script>

<?php
// RULE: Categories ?>
<script id="hustle-visibility-rule-tpl--categories" type="text/template">

	<label class="sui-label"><?php printf( esc_html__( "Show %s on", Opt_In::TEXT_DOMAIN ), '{{ type_name }}' ); ?></label>

	<div class="sui-side-tabs">

		<div class="sui-tabs-menu">

			<label for="{{ group_id }}-{{ type }}-filter_type-categories-except"
				class="sui-tab-item{{ _.class( 'except' === filter_type, ' active' ) }}">
				<input type="radio"
					name="{{ group_id }}-{{ type }}-filter_type-categories"
					value="except"
					id="{{ group_id }}-{{ type }}-filter_type-categories-except"
					data-tab-menu="except"
					data-attribute="filter_type"
					{{ _.checked( filter_type, 'except' ) }} />
				<?php esc_html_e( 'All categories except', Opt_In::TEXT_DOMAIN ); ?>
			</label>

			<label for="{{ group_id }}-{{ type }}-filter_type-categories-only"
				class="sui-tab-item{{ _.class( 'only' === filter_type, ' active' ) }}">
				<input type="radio"
					name="{{ group_id }}-{{ type }}-filter_type-categories"
					value="only"
					id="{{ group_id }}-{{ type }}-filter_type-categories-only"
					data-tab-menu="only"
					data-attribute="filter_type"
					{{ _.checked( filter_type, 'only' ) }} />
				<?php esc_html_e( 'Only these categories', Opt_In::TEXT_DOMAIN ); ?>
			</label>

		</div>

		<div class="sui-tabs-content">

			<div class="sui-tab-content active">

				<select name=""
					id="{{ group_id }}-{{ type }}-filter_type-categories"
					class="sui-select sui-select-lg hustle-select-ajax"
					multiple="multiple"
					data-val="{{ categories }}"
					data-attribute="categories"
					placeholder="<?php esc_html_e( 'Start typing the name of categories...', Opt_In::TEXT_DOMAIN ); ?>">

					<# _.each( optin_vars.cats, function( cat ) { #>
						<option value="{{ cat.id }}" {{ _.selected( _.contains( categories, cat.id.toString() ), true ) }}>
							{{ cat.text }}
						</option>
					<# } ); #>

				</select>

			</div>

		</div>

	</div>

</script>

<?php
// RULE: Tags ?>
<script id="hustle-visibility-rule-tpl--tags" type="text/template">

	<label class="sui-label"><?php printf( esc_html__( "Show %s on", Opt_In::TEXT_DOMAIN ), '{{ type_name }}' ); ?></label>

	<div class="sui-side-tabs">

		<div class="sui-tabs-menu">

			<label for="{{ group_id }}-{{ type }}-filter_type-tags-except"
				class="sui-tab-item{{ _.class( 'except' === filter_type, ' active' ) }}">
				<input type="radio"
					name="{{ group_id }}-{{ type }}-filter_type-tags"
					value="except"
					id="{{ group_id }}-{{ type }}-filter_type-tags-except"
					data-tab-menu="except"
					data-attribute="filter_type"
					{{ _.checked( filter_type, 'except' ) }} />
				<?php esc_html_e( 'All tags except', Opt_In::TEXT_DOMAIN ); ?>
			</label>

			<label for="{{ group_id }}-{{ type }}-filter_type-tags-only"
				class="sui-tab-item{{ _.class( 'only' === filter_type, ' active' ) }}">
				<input type="radio"
					name="{{ group_id }}-{{ type }}-filter_type-tags"
					value="only"
					id="{{ group_id }}-{{ type }}-filter_type-tags-only"
					data-tab-menu="only"
					data-attribute="filter_type"
					{{ _.checked( filter_type, 'only' ) }} />
				<?php esc_html_e( 'Only these tags', Opt_In::TEXT_DOMAIN ); ?>
			</label>

		</div>

		<div class="sui-tabs-content">

			<div class="sui-tab-content active">

				<select name=""
					id="{{ group_id }}-{{ type }}-filter_type-tags"
					class="sui-select sui-select-lg hustle-select-ajax"
					multiple="multiple"
					data-val="{{ tags }}"
					data-attribute="tags"
					placeholder="<?php esc_html_e( 'Start typing the name of tags...', Opt_In::TEXT_DOMAIN ); ?>">

					<# _.each( optin_vars.tags, function( tag ) {  #>
						<option value="{{ tag.id }}" {{ _.selected( _.contains( tags, tag.id.toString() ), true ) }}>
							{{ tag.text }}
						</option>
					<# } ); #>

				</select>

			</div>

		</div>

	</div>

</script>

<?php
// RULE: Visitor's logged in status ?>
<script id="hustle-visibility-rule-tpl--visitor_logged_in_status" type="text/template">

	<label class="sui-label"><?php esc_html_e( "Visitor's status", Opt_In::TEXT_DOMAIN ); ?></label>

	<div class="sui-side-tabs">

		<div class="sui-tabs-menu">

			<label for="visitor-logged-status--logged_in"
				class="sui-tab-item{{ _.class( 'logged_in' === show_to, ' active' ) }}">
				<input type="radio"
					name="show_to"
					value="logged_in"
					id="visitor-logged-status--logged_in"
					data-attribute="show_to"
					{{ _.checked( show_to, 'logged_in' ) }} />
				<?php esc_html_e( 'Logged in', Opt_In::TEXT_DOMAIN ); ?>
			</label>

			<label for="visitor-logged-status--logged_out"
				class="sui-tab-item{{ _.class( 'logged_out' === show_to, ' active' ) }}">
				<input type="radio"
					name="show_to"
					value="logged_out"
					id="visitor-logged-status--logged_out"
					data-attribute="show_to"
					{{ _.checked( show_to, 'logged_out' ) }} />
				<?php esc_html_e( 'Logged out', Opt_In::TEXT_DOMAIN ); ?>
			</label>

		</div>

	</div>

</script>

<?php
// RULE: Number of times visitor has seen ?>
<script id="hustle-visibility-rule-tpl--shown_less_than" type="text/template">

	<label class="sui-label"><?php esc_html_e( 'Less than the specified number', Opt_In::TEXT_DOMAIN ); ?></label>

	<input
		type="number"
		min="1"
		max="999"
		maxlength="3"
		value="{{ less_than }}"
		placeholder="<?php esc_html_e( 'E.g. 10', Opt_In::TEXT_DOMAIN ); ?>"
		id="shown_less_than_value"
		class="sui-form-control"
		data-attribute="less_than"
	/>

</script>

<?php
// RULE: Visitor's Device ?>
<script id="hustle-visibility-rule-tpl--visitor_device" type="text/template">

	<label class="sui-label"><?php esc_html_e( 'Device', Opt_In::TEXT_DOMAIN ); ?></label>

	<div class="sui-side-tabs">

		<div class="sui-tabs-menu">

			<label
				for="hustle-{{ type }}-rule--visitor-device-mobiles"
				class="sui-tab-item{{ _.class( 'mobile' === filter_type, ' active' ) }}"
			>
				<input
					type="radio"
					name="hustle-{{ type }}-rule--visitor-device"
					value="mobile"
					id="hustle-{{ type }}-rule--visitor-device-mobiles"
					data-tab-menu="mobiles"
					data-attribute="filter_type"
					{{ _.checked( filter_type, 'mobile' ) }}
				/>
				<?php esc_html_e( 'Mobile only', Opt_In::TEXT_DOMAIN ); ?>
			</label>

			<label
				for="hustle-{{ type }}-rule--visitor-device-desktops"
				class="sui-tab-item{{ _.class( 'not_mobile' === filter_type, ' active' ) }}"
			>
				<input
					type="radio"
					name="hustle-{{ type }}-rule--visitor-device"
					value="not_mobile"
					id="hustle-{{ type }}-rule--visitor-device-desktops"
					data-attribute="filter_type"
					{{ _.checked( filter_type, 'not_mobile' ) }}
				/>
				<?php esc_html_e( 'Desktop only', Opt_In::TEXT_DOMAIN ); ?>
			</label>

		</div>

		<div class="sui-tabs-content">

			<div class="sui-tab-content{{ _.class( 'mobile' === filter_type, ' active' ) }}" data-tab-content="mobiles">

				<div class="sui-notice">
					<p style="margin: 0;"><?php esc_html_e( 'Mobile devices include both Phone and Tablet.', Opt_In::TEXT_DOMAIN ); ?></p>
				</div>

			</div>

		</div>

	</div>

</script>

<?php
// RULE: Referrer ?>
<script id="hustle-visibility-rule-tpl--from_referrer" type="text/template">

	<div class="sui-side-tabs">

		<div class="sui-tabs-menu">

			<label for="hustle-{{ type }}-rule--visitor-referrer-true"
				class="sui-tab-item{{ _.class( 'true' === filter_type, ' active' ) }}">
				<input type="radio"
					name="hustle-{{ type }}-rule--visitor-referrer"
					value="true"
					id="hustle-{{ type }}-rule--visitor-referrer-true"
					data-tab-menu="true"
					data-attribute="filter_type" />
				<?php esc_html_e( 'Specific referrer', Opt_In::TEXT_DOMAIN ); ?>
			</label>

			<label for="hustle-{{ type }}-rule--visitor-referrer-false"
				class="sui-tab-item{{ _.class( 'false' === filter_type, ' active' ) }}">
				<input type="radio"
					name="hustle-{{ type }}-rule--visitor-referrer"
					value="false"
					id="hustle-{{ type }}-rule--visitor-referrer-false"
					data-tab-menu="false"
					data-attribute="filter_type" />
				<?php esc_html_e( 'Not a specific referrer', Opt_In::TEXT_DOMAIN ); ?>
			</label>

		</div>

		<div class="sui-tabs-content">

			<div class="sui-tab-content active">

				<textarea placeholder="<?php esc_html_e( 'Enter the referrer URL', Opt_In::TEXT_DOMAIN ); ?>"
					class="sui-form-control"
					data-attribute="refs">{{{ refs }}}</textarea>

				<span class="sui-description"><?php esc_html_e( 'It can be a full URL or a pattern like “.website.com”. Enter one pattern/URL per line.', Opt_In::TEXT_DOMAIN ); ?></span>

			</div>

		</div>

	</div>

</script>

<?php
// RULE: Source of Arrival ?>
<script id="hustle-visibility-rule-tpl--source_of_arrival" type="text/template">

	<label class="sui-label"><?php printf( esc_html__( 'Show %s if', Opt_In::TEXT_DOMAIN ), '{{ type_name }}' ); ?></label>

	<div style="margin-top: 10px;">

		<label for="hustle-{{ type }}-rule--source-external"
			class="sui-checkbox sui-checkbox-sm sui-checkbox-stacked">
			<input type="checkbox"
				data-attribute="source_external"
				{{ _.checked( source_external, true ) }}
				id="hustle-{{ type }}-rule--source-external" />
			<span aria-hidden="external"></span>
			<span><?php esc_html_e( 'User didn’t arrive from an internal page', Opt_In::TEXT_DOMAIN ); ?></span>
		</label>

		<label for="hustle-{{ type }}-rule--source-search"
			class="sui-checkbox sui-checkbox-sm sui-checkbox-stacked">
			<input type="checkbox"
				data-attribute="source_search"
				{{ _.checked( source_search, true ) }}
				id="hustle-{{ type }}-rule--source-search" />
			<span aria-hidden="search"></span>
			<span><?php esc_html_e( 'User arrived via a search engine', Opt_In::TEXT_DOMAIN ); ?></span>
		</label>

	</div>

</script>

<?php
// RULE: Specific URL ?>
<script id="hustle-visibility-rule-tpl--on_url" type="text/template">

	<label class="sui-label"><?php printf( esc_html__( 'Show %s on', Opt_In::TEXT_DOMAIN ), '{{ type_name }}' ); ?></label>

	<div class="sui-side-tabs">

		<div class="sui-tabs-menu">

			<label for="hustle-{{ type }}-rule--specific-url-except"
				class="sui-tab-item{{ _.class( 'except' === filter_type, ' active' ) }}">
				<input type="radio"
					name="hustle-{{ type }}-rule--specific-url"
					value="except"
					id="hustle-{{ type }}-rule--specific-url-except"
					data-tab-menu="except"
					data-attribute="filter_type" />
				<?php esc_html_e( 'All URLs except', Opt_In::TEXT_DOMAIN ); ?>
			</label>

			<label for="hustle-{{ type }}-rule--specific-url-only"
				class="sui-tab-item{{ _.class( 'only' === filter_type, ' active' ) }}">
				<input type="radio"
					name="hustle-{{ type }}-rule--specific-url"
					value="only"
					id="hustle-{{ type }}-rule--specific-url-only"
					data-tab-menu="only"
					data-attribute="filter_type" />
				<?php esc_html_e( 'Only these URLs', Opt_In::TEXT_DOMAIN ); ?>
			</label>

		</div>

		<div class="sui-tabs-content">

			<div class="sui-tab-content active">

				<textarea placeholder="<?php esc_html_e( 'Enter the URLs', Opt_In::TEXT_DOMAIN ); ?>"
					class="sui-form-control"
					data-attribute="urls">{{{ urls }}}</textarea>

				<span class="sui-description"><?php esc_html_e( 'Enter only one URL per line and URLs should not include "http://" or "https://". You can also use wildcards in URLs.', Opt_In::TEXT_DOMAIN ); ?></span>

			</div>

		</div>

	</div>

</script>

<?php
// RULE: Visitor Commented Before ?>
<script id="hustle-visibility-rule-tpl--visitor_commented" type="text/template">

	<label class="sui-label"><?php esc_html_e( 'If the visitor has ever commented before is', Opt_In::TEXT_DOMAIN ); ?></label>

	<div class="sui-side-tabs"
		style="margin-bottom: 20px;">

		<div class="sui-tabs-menu">

			<label for="hustle-{{ type }}-rule--comments-true"
				class="sui-tab-item{{ _.class( 'true' === filter_type, ' active' ) }}">
				<input type="radio"
					name="hustle-{{ type }}-rule--comments"
					value="true"
					id="hustle-{{ type }}-rule--comments-true"
					data-tab-menu="true"
					data-attribute="filter_type" />
				<?php esc_html_e( 'True', Opt_In::TEXT_DOMAIN ); ?>
			</label>

			<label for="hustle-{{ type }}-rule--comments-false"
				class="sui-tab-item{{ _.class( 'false' === filter_type, ' active' ) }}">
				<input type="radio"
					name="hustle-{{ type }}-rule--comments"
					value="false"
					id="hustle-{{ type }}-rule--comments-false"
					data-tab-menu="false"
					data-attribute="filter_type" />
				<?php esc_html_e( 'False', Opt_In::TEXT_DOMAIN ); ?>
			</label>

		</div>

	</div>

	<div class="sui-notice" style="margin-top: 20px;">
		<p style="margin-bottom: 0;"><?php printf( esc_html__( "You might also want to combine this condition along with %1\$s%2\$s%3\$s.", Opt_In::TEXT_DOMAIN ), '<strong>', esc_html__( "Visitor's logged in status", Opt_In::TEXT_DOMAIN ), '</strong>' ); ?></p>
	</div>

</script>

<?php
// RULE: Visitor's Country ?>
<script id="hustle-visibility-rule-tpl--visitor_country" type="text/template">

	<label class="sui-label"><?php esc_html_e( 'Visitor’s country', Opt_In::TEXT_DOMAIN ); ?></label>

	<div class="sui-side-tabs">

		<div class="sui-tabs-menu">

			<label for="hustle-{{ type }}-rule--country-except"
				class="sui-tab-item{{ _.class( 'except' === filter_type, ' active' ) }}">
				<input type="radio"
					name="hustle-{{ type }}-rule--country"
					value="except"
					id="hustle-{{ type }}-rule--country-except"
					data-tab-menu="except"
					data-attribute="filter_type" />
				<?php esc_html_e( 'Any country except', Opt_In::TEXT_DOMAIN ); ?>
			</label>

			<label for="hustle-{{ type }}-rule--country-only"
				class="sui-tab-item{{ _.class( 'only' === filter_type, ' active' ) }}">
				<input type="radio"
					name="hustle-{{ type }}-rule--country"
					value="only"
					id="hustle-{{ type }}-rule--country-only"
					data-tab-menu="only"
					data-attribute="filter_type" />
				<?php esc_html_e( 'Only these countries', Opt_In::TEXT_DOMAIN ); ?>
			</label>

		</div>

		<div class="sui-tabs-content">

			<div class="sui-tab-content active">

				<select multiple="multiple"
					placeholder="<?php esc_attr_e( 'Start typing the name of countries...', Opt_In::TEXT_DOMAIN ); ?>"
					id="not_in_a_country_countries"
					class="sui-select sui-select-lg"
					data-val="countries"
					data-attribute="countries">

						<# _.each( _.keys( optin_vars.countries ), function( key ) { #>

							<option value="{{ key }}">{{ optin_vars.countries[key] }}</option>

						<# }); #>

				</select>

			</div>

		</div>

	</div>

</script>

<?php
// RULE: 404 page ?>
<script id="hustle-visibility-rule-tpl--page_404" type="text/template">

	<label class="sui-label"><?php printf( esc_html__( 'Shows the %s on the 404 page.', Opt_In::TEXT_DOMAIN ), esc_html( $smallcaps_singular ) ); ?></label>

</script>
