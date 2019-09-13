<?php if ( isset( $smallcaps_singular ) ) {
	$smallcaps_singular = $smallcaps_singular;
} else {
	$smallcaps_singular = esc_html__( 'module', 'wordpress-popup' );
}
$post_types = Opt_In_Utils::get_post_types();
?>

<div id="hustle-dialog--visibility-options" class="sui-dialog sui-dialog-alt" aria-hidden="true" tabindex="-1">

	<div class="sui-dialog-overlay sui-fade-out"></div>

	<div role="dialog"
		class="sui-dialog-content sui-bounce-out"
		aria-labelledby="dialogTitle"
		aria-describedby="dialogDescription">

		<div class="sui-box" role="document">

			<div class="sui-box-header sui-block-content-center">

				<h3 id="dialogTitle" class="sui-box-title"><?php esc_html_e( 'Choose Conditions', 'wordpress-popup' ); ?></h3>

				<button class="hustle-cancel-conditions sui-dialog-close">
					<span class="sui-screen-reader-text"><?php esc_html_e( 'Close this dialog window', 'wordpress-popup' ); ?></span>
				</button>

			</div>

			<div class="sui-box-body sui-box-body-slim sui-block-content-center">

				<p id="dialogTitle"><small><?php printf( esc_html__( 'Choose the visibility conditions which you want to apply on the %s.', 'wordpress-popup' ), esc_html( $smallcaps_singular ) ); ?></small></p>

			</div>

			<div class="sui-box-selectors sui-box-selectors-col-2">

				<ul class="sui-spacing-slim">

					<li><label for="hustle-condition--posts" class="sui-box-selector">
						<input type="checkbox"
							value="posts"
							name="visibility_options"
							id="hustle-condition--posts"
							class="hustle-visibility-condition-option" />
						<span><?php esc_html_e( 'Posts', 'wordpress-popup' ); ?></span>
					</label></li>

					<li><label for="hustle-condition--pages" class="sui-box-selector">
						<input type="checkbox"
							value="pages"
							name="visibility_options"
							id="hustle-condition--pages"
							class="hustle-visibility-condition-option" />
						<span><?php esc_html_e( 'Pages', 'wordpress-popup' ); ?></span>
					</label></li>

					<!-- CPT -->
					<?php foreach ( $post_types as $post_type => $data ) { ?>
						<li><label for="hustle-condition--<?php echo esc_attr($post_type); ?>" class="sui-box-selector">
							<input type="checkbox"
								value="<?php echo esc_attr($post_type); ?>"
								name="visibility_options"
								id="hustle-condition--<?php echo esc_attr($post_type); ?>"
								class="hustle-visibility-condition-option" />
							<span><?php echo esc_html($data['label']); ?></span>
						</label></li>
					<?php } ?>

					<li><label for="hustle-condition--categories" class="sui-box-selector">
						<input type="checkbox"
							value="categories"
							name="visibility_options"
							id="hustle-condition--categories"
							class="hustle-visibility-condition-option" />
						<span><?php esc_html_e( 'Category', 'wordpress-popup' ); ?></span>
					</label></li>

					<li><label for="hustle-condition--tags" class="sui-box-selector">
						<input type="checkbox"
							value="tags"
							name="visibility_options"
							id="hustle-condition--tags"
							class="hustle-visibility-condition-option" />
						<span><?php esc_html_e( 'Tags', 'wordpress-popup' ); ?></span>
					</label></li>

					<li><label for="hustle-condition--visitor_logged_in_status" class="sui-box-selector">
						<input type="checkbox"
							value="visitor_logged_in_status"
							name="visibility_options"
							id="hustle-condition--visitor_logged_in_status"
							class="hustle-visibility-condition-option" />
						<span><?php esc_html_e( "Visitor's logged in status", 'wordpress-popup' ); ?></span>
					</label></li>

					<li><label for="hustle-condition--shown_less_than" class="sui-box-selector">
						<input type="checkbox"
							value="shown_less_than"
							name="visibility_options"
							id="hustle-condition--shown_less_than"
							class="hustle-visibility-condition-option" />
						<span><?php esc_html_e( 'Number of times visitor has seen', 'wordpress-popup' ); ?></span>
					</label></li>

					<li><label for="hustle-condition--visitor_device" class="sui-box-selector">
						<input type="checkbox"
							value="visitor_device"
							name="visibility_options"
							id="hustle-condition--visitor_device"
							class="hustle-visibility-condition-option" />
						<span><?php esc_html_e( "Visitor's Device", 'wordpress-popup' ); ?></span>
					</label></li>

					<li><label for="hustle-condition--from_referrer" class="sui-box-selector">
						<input type="checkbox"
							value="from_referrer"
							name="visibility_options"
							id="hustle-condition--from_referrer"
							class="hustle-visibility-condition-option" />
						<span><?php esc_html_e( 'Referrer', 'wordpress-popup' ); ?></span>
					</label></li>

					<li><label for="hustle-condition--source_of_arrival" class="sui-box-selector">
						<input type="checkbox"
							value="source_of_arrival"
							name="visibility_options"
							id="hustle-condition--source_of_arrival"
							class="hustle-visibility-condition-option" />
						<span><?php esc_html_e( 'Source of Arrival', 'wordpress-popup' ); ?></span>
					</label></li>

					<li><label for="hustle-condition--on_url" class="sui-box-selector">
						<input type="checkbox"
							value="on_url"
							name="visibility_options"
							id="hustle-condition--on_url"
							class="hustle-visibility-condition-option" />
						<span><?php esc_html_e( 'Specific URL', 'wordpress-popup' ); ?></span>
					</label></li>

					<li><label for="hustle-condition--visitor_commented" class="sui-box-selector">
						<input type="checkbox"
							value="visitor_commented"
							name="visibility_options"
							id="hustle-condition--visitor_commented"
							class="hustle-visibility-condition-option" />
						<span><?php esc_html_e( 'Visitor Commented Before', 'wordpress-popup' ); ?></span>
					</label></li>

					<li><label for="hustle-condition--visitor_country" class="sui-box-selector">
						<input type="checkbox"
							value="visitor_country"
							name="visibility_options"
							id="hustle-condition--visitor_country"
							class="hustle-visibility-condition-option" />
						<span><?php esc_html_e( "Visitor's Country", 'wordpress-popup' ); ?></span>
					</label></li>
					<li><label for="hustle-condition--page_404" class="sui-box-selector">
						<input type="checkbox"
							value="page_404"
							name="visibility_options"
							id="hustle-condition--page_404"
							class="hustle-visibility-condition-option" />
						<span><?php esc_html_e( "404 page", 'wordpress-popup' ); ?></span>
					</label></li>

				</ul>

			</div>

			<div class="sui-box-footer">

				<button class="sui-button sui-button-ghost hustle-cancel-conditions">
					<?php esc_attr_e( 'Cancel', 'wordpress-popup'); ?>
				</button>

				<button id="hustle-add-conditions" class="sui-button">
					<span class="sui-loading-text"><?php esc_attr_e( 'Add Conditions', 'wordpress-popup'); ?></span>
					<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
				</button>

			</div>

		</div>

	</div>

</div>
