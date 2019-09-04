<?php
/** @var $admin Hustle_Entries_Admin */
$count = $admin->filtered_total_entries();
$is_filter_enabled = $admin->is_filter_box_enabled();
$date_range = '';
$date_created = isset( $admin->filters['date_created'] ) ? $admin->filters['date_created'] : '';

if ( is_array( $date_created ) && isset( $date_created[0] ) && isset( $date_created[1] ) ) {
	$date_created[0] = date( 'm/d/Y', strtotime($date_created[0]) );
	$date_created[1] = date( 'm/d/Y', strtotime($date_created[1]) );
	$date_range = implode(' - ', $date_created);
}

$search_email = isset( $admin->filters['search_email'] ) ? $admin->filters['search_email'] : '';
$order_by = isset( $admin->order['order_by'] ) ? $admin->order['order_by'] : '';

$order_by_array = array(
	'entries.entry_id' => esc_html__( 'Id', Opt_In::TEXT_DOMAIN ),
	'entries.date_created' => esc_html__( 'Date submitted', Opt_In::TEXT_DOMAIN ),
);
?>

<div class="hui-box-actions<?php echo isset( $actions_class ) ? ' ' . esc_attr( $actions_class ) : ''; ?>">

	<div class="hui-actions-bar">

		<?php
		// ELEMENT: Bulk Actions
		if ( $is_top ) :
			$formid = isset( $id ) ? ' id=' . esc_attr( $id ) . '' : '';
			echo '<form method="post"' . esc_html( $formid ) . ' class="hui-bulk-actions">';
		else :
			echo '<div class="hui-bulk-actions">';
		endif; ?>

			<select
				name="hustle_action<?php if ( ! $is_top ) echo '_bottom'; ?>"
				class="sui-select-sm"
				<?php if ( isset( $input_id ) ) echo ' form="' . esc_attr( $input_id ) . '"'; ?>
			>
				<option value=""><?php esc_html_e( 'Bulk actions', Opt_In::TEXT_DOMAIN ); ?></option>
				<option value="delete-all"><?php esc_html_e( 'Delete', Opt_In::TEXT_DOMAIN ); ?></option>
			</select>

			<input
				type="hidden"
				name="hustle_nonce"
				value="<?php echo esc_attr( wp_create_nonce( 'hustle_entries_request' ) ); ?>"
				id="hustle_nonce"
			/>

			<button
				id="hustle-apply-button"
				class="sui-button"
				<?php echo isset( $input_id ) ? 'form="' . esc_attr( $input_id ) . '"' : ''; ?>
				<?php disabled( true ); ?>
			>
				<?php esc_html_e( 'Apply', Opt_In::TEXT_DOMAIN ); ?>
			</button>

		<?php
		if ( $is_top ) :
			echo '</form>';
		else :
			echo '</div>';
		endif; ?>

		<?php
		// ELEMENT: Pagination (Desktop) ?>
		<div class="hui-pagination hui-pagination-desktop">

			<?php
			$limit = $admin->get_per_page();
			$page = intval( filter_input( INPUT_GET, 'paged', FILTER_VALIDATE_INT ) ); // phpcs:ignore

			$this->render(
				'admin/commons/pagination',
				array(
					'count' => $count,
					'limit' => $limit,
					'page' => $page,
					'show' => ( $count > $limit ),
					'filterclass' => 'hustle-open-inline-filter',
					'filter' => array(),
				)
			); ?>

		</div>

	</div>

	<div class="sui-pagination-filter">

		<form method="get">

			<input type="hidden" name="page" value="hustle_entries">
			<input type="hidden" name="module_type" value="<?php echo esc_attr( $admin->get_module_type() ); ?>">
			<input type="hidden" name="module_id" value="<?php echo esc_attr( $admin->get_module_id() ); ?>">

			<div class="sui-row">

				<div class="sui-col-md-6">

					<div class="sui-form-field">
						<label class="sui-label"><?php esc_html_e( 'Email id has keyword', Opt_In::TEXT_DOMAIN ); ?></label>
						<div class="sui-control-with-icon">
							<input type="text"
								name="search_email"
								placeholder="<?php esc_html_e( 'E.g. gmail', Opt_In::TEXT_DOMAIN ); ?>"
								class="sui-form-control"
								value="<?php echo esc_attr( $search_email ); ?>" />
							<i class="sui-icon-magnifying-glass-search" aria-hidden="true"></i>
						</div>
					</div>

				</div>

				<div class="sui-col-md-6">

					<div class="sui-form-field">
						<label class="sui-label"><?php esc_html_e( 'Sort by', Opt_In::TEXT_DOMAIN ); ?></label>
						<select name="order_by">
							<?php foreach ( $order_by_array as $key => $name ) { ?>
								<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $order_by ); ?>><?php echo esc_html( $name ); ?></option>
							<?php } ?>
						</select>
					</div>

				</div>

			</div>

			<div class="sui-row">

				<div class="sui-col-md-6">

					<div class="sui-form-field">
						<label class="sui-label"><?php esc_html_e( 'Conversion date range', Opt_In::TEXT_DOMAIN ); ?></label>
						<div class="sui-date">
							<i class="sui-icon-calendar" aria-hidden="true"></i>
							<input type="text"
								name="date_range"
								value="<?php echo esc_attr( $date_range ); ?>"
								placeholder="<?php esc_html_e( 'Pick a date range', Opt_In::TEXT_DOMAIN ); ?>"
								class="hustle-entries-filter-date sui-form-control" />
						</div>
					</div>

				</div>

			</div>

			<div class="sui-filter-footer">

				<button type="button" class="sui-button sui-button-ghost hustle-entries-clear-filter">
					<?php esc_html_e( 'Clear Filters', Opt_In::TEXT_DOMAIN ); ?>
				</button>

				<button class="sui-button">
					<?php esc_html_e( 'Apply', Opt_In::TEXT_DOMAIN ); ?>
				</button>

			</div>

		</form>

	</div>

	<?php
	$get_order_by = filter_input(INPUT_GET, 'order_by', FILTER_SANITIZE_STRING );
	$ordered = !is_null( $get_order_by ) && key_exists( $get_order_by, $order_by_array );

	if ( $ordered || $search_email || $date_range ) { ?>

		<div class="sui-pagination-filters-list">

			<label class="sui-label"><?php esc_html_e( 'Active filters', Opt_In::TEXT_DOMAIN ); ?></label>

			<div class="sui-pagination-active-filters">

				<?php if ( $search_email ) { ?>
					<span class="sui-active-filter">
						<?php esc_html_e( 'Has keyword:', Opt_In::TEXT_DOMAIN ); ?> <?php echo esc_html( $search_email ); ?>
					<span class="sui-active-filter-remove" data-filter="search_email" role="button"><span class="sui-screen-reader-text"><?php esc_html_e( 'Remove this filter', Opt_In::TEXT_DOMAIN ); ?></span></span></span>
				<?php } ?>

				<?php if ( $ordered ) { ?>
					<span class="sui-active-filter">
						<?php esc_html_e( 'Sort by:', Opt_In::TEXT_DOMAIN ); ?> <?php echo esc_html( $order_by_array[ $get_order_by ] ); ?>
					<span class="sui-active-filter-remove" data-filter="order_by" role="button"><span class="sui-screen-reader-text"><?php esc_html_e( 'Remove this filter', Opt_In::TEXT_DOMAIN ); ?></span></span></span>
				<?php } ?>

				<?php if ( $date_range ) { ?>
					<?php $date_range_to = str_replace( ' - ', __( ' to ', Opt_In::TEXT_DOMAIN ), $date_range ); ?>
					<span class="sui-active-filter">
						<?php esc_html_e( 'Submission date range:', Opt_In::TEXT_DOMAIN ); ?> <?php echo esc_html( $date_range_to ); ?>
					<span class="sui-active-filter-remove" data-filter="date_range" role="button"><span class="sui-screen-reader-text"><?php esc_html_e( 'Remove this filter', Opt_In::TEXT_DOMAIN ); ?></span></span></span>
				<?php } ?>

			</div>

		</div>

	<?php } ?>

</div>
