<?php if ( ! $multiple_charts ) { ?>

	<ul class="sui-accordion-item-data">

		<li data-col="large">
			<strong><?php esc_html_e( 'Last Conversion', 'wordpress-popup' ); ?></strong>
			<span><?php echo esc_html( $last_entry_time ); ?></span>
		</li>

		<li data-col="small">
			<strong><?php esc_html_e( 'Views', 'wordpress-popup' ); ?></strong>
			<span><?php echo esc_html( $total_module_views ); ?></span>
		</li>

		<li>
			<strong><?php esc_html_e( 'Conversions', 'wordpress-popup' ); ?></strong>
			<span><?php echo esc_html( $total_module_conversions ); ?></span>
		</li>

		<li>
			<strong><?php esc_html_e( 'Conversion Rate', 'wordpress-popup' ); ?></strong>
			<span><?php echo esc_html( $rate ); ?>%</span>
		</li>

	</ul>

	<div class="sui-chartjs sui-chartjs-animated">

		<div class="sui-chartjs-message sui-chartjs-message--loading">

			<p><i class="sui-icon-loader sui-loading" aria-hidden="true"></i> <?php esc_html_e( 'Loading data...', 'wordpress-popup' ); ?></p>

		</div>

		<?php if ( ! $module->active ) { ?>

			<?php if ( 0 === $total_module_views && 0 === $total_module_conversions ) { ?>

				<div class="sui-chartjs-message sui-chartjs-message--empty">

					<p><i class="sui-icon-info" aria-hidden="true"></i> <?php printf( esc_html__( "This %1\$s is still in draft state. You can test your %1\$s, but we won't start collecting conversion data until you publish it live.", 'wordpress-popup' ), esc_html( $smallcaps_singular ) ); ?></p>

				</div>

				<div class="sui-chartjs-canvas"></div>

			<?php } else { ?>

				<div class="sui-chartjs-message">

					<p><i class="sui-icon-info" aria-hidden="true"></i> <?php printf( esc_html__( "This %1\$s is in draft state, so we've paused collecting data until you publish it live.", 'wordpress-popup' ), esc_html( $smallcaps_singular ) ); ?></p>

				</div>

				<div class="sui-chartjs-canvas">

					<canvas id="hustle-<?php echo esc_html( $module_type ); ?>-<?php echo esc_attr( $module->id ); ?>-stats"></canvas>

				</div>

			<?php } ?>

		<?php } else { ?>

			<?php if ( empty( $tracking_types ) ) { ?>

				<div class="sui-chartjs-message">

					<p><i class="sui-icon-info" aria-hidden="true"></i> <?php printf( esc_html__( "This %1\$s has tracking disabled. Enable tracking to start collecting data.", 'wordpress-popup' ), esc_html( $smallcaps_singular ) ); ?></p>

				</div>

			<?php } ?>

			<div class="sui-chartjs-canvas">

				<canvas id="hustle-<?php echo esc_html( $module_type ); ?>-<?php echo esc_attr( $module->id ); ?>-stats"></canvas>

			</div>

		<?php } ?>

	</div>

<?php } else { ?>

	<div class="sui-tabs sui-tabs-flushed">

		<div data-tabs style="border-top: 1px solid #E6E6E6;">

			<div class="active"><?php esc_html_e( 'Overall', 'wordpress-popup' ); ?></div>

			<?php foreach ( $multiple_charts as $chart ) { ?>

				<div><?php echo esc_html( $chart ); ?></div>

			<?php } ?>

		</div>

		<div data-panes>

			<div class="active">

				<ul class="sui-accordion-item-data">

					<li data-col="large">
						<strong><?php esc_html_e( 'Last Conversion', 'wordpress-popup' ); ?></strong>
						<span><?php echo esc_html( $last_entry_time ); ?></span>
					</li>

					<li data-col="small">
						<strong><?php esc_html_e( 'Views', 'wordpress-popup' ); ?></strong>
						<span><?php echo esc_html( $total_module_views ); ?></span>
					</li>

					<li>
						<strong><?php esc_html_e( 'Conversions', 'wordpress-popup' ); ?></strong>
						<span><?php echo esc_html( $total_module_conversions ); ?></span>
					</li>

					<li>
						<strong><?php esc_html_e( 'Conversion Rate', 'wordpress-popup' ); ?></strong>
						<span><?php echo esc_html( $rate ); ?>%</span>
					</li>

				</ul>

				<div class="sui-chartjs sui-chartjs-animated">

					<div class="sui-chartjs-message sui-chartjs-message--loading">

						<p><i class="sui-icon-loader sui-loading" aria-hidden="true"></i> <?php esc_html_e( 'Loading data...', 'wordpress-popup' ); ?></p>

					</div>

					<?php if ( ! $module->active ) { ?>

						<?php if (
								0 === $total_module_views && 0 === $total_module_conversions
							) { ?>

							<div class="sui-chartjs-message sui-chartjs-message--empty">

								<p><i class="sui-icon-info" aria-hidden="true"></i> <?php printf( esc_html__( "This %1\$s is still in draft state. You can test your %1\$s, but we won't start collecting conversion data until you publish it live.", 'wordpress-popup' ), esc_html( $smallcaps_singular ) ); ?></p>

							</div>

							<div class="sui-chartjs-canvas"></div>

						<?php } else { ?>

							<div class="sui-chartjs-message">

								<p><i class="sui-icon-info" aria-hidden="true"></i> <?php printf( esc_html__( "This %1\$s is in draft state, so we've paused collecting data until you publish it live.", 'wordpress-popup' ), esc_html( $smallcaps_singular ) ); ?></p>

							</div>

							<div class="sui-chartjs-canvas">

								<canvas id="hustle-<?php echo esc_html( $module_type ); ?>-<?php echo esc_attr( $module->id ); ?>-stats"></canvas>

							</div>

						<?php } ?>

					<?php } else { ?>

						<?php if ( empty( $tracking_types ) ) { ?>

							<div class="sui-chartjs-message">

								<p><i class="sui-icon-info" aria-hidden="true"></i> <?php printf( esc_html__( "This %1\$s has tracking disabled. Enable tracking to start collecting data.", 'wordpress-popup' ), esc_html( $smallcaps_singular ) ); ?></p>

							</div>

						<?php } ?>

						<div class="sui-chartjs-canvas">

							<canvas id="hustle-<?php echo esc_html( $module_type ); ?>-<?php echo esc_attr( $module->id ); ?>-stats"></canvas>

						</div>

					<?php } ?>

				</div>

			</div>

			<?php foreach ( $multiple_charts as $chart_key => $chart ) { ?>

				<div>

					<ul class="sui-accordion-item-data">

						<li data-col="large">
							<strong><?php esc_html_e( 'Last Conversion', 'wordpress-popup' ); ?></strong>
							<span><?php echo esc_html( $multiple_data[ $chart_key ]['last_entry_time'] ); ?></span>
						</li>

						<li data-col="small">
							<strong><?php esc_html_e( 'Views', 'wordpress-popup' ); ?></strong>
							<span><?php echo esc_html( $multiple_data[ $chart_key ]['views'] ); ?></span>
						</li>

						<li>
							<strong><?php esc_html_e( 'Conversions', 'wordpress-popup' ); ?></strong>
							<span><?php echo esc_html( $multiple_data[ $chart_key ]['conversions'] ); ?></span>
						</li>

						<li>
							<strong><?php esc_html_e( 'Conversion Rate', 'wordpress-popup' ); ?></strong>
							<span><?php echo esc_html( $multiple_data[ $chart_key ]['conversion_rate'] ); ?>%</span>
						</li>

					</ul>

					<div class="sui-chartjs sui-chartjs-animated">

						<div class="sui-chartjs-message sui-chartjs-message--loading">

							<p><i class="sui-icon-loader sui-loading" aria-hidden="true"></i> <?php esc_html_e( 'Loading data...', 'wordpress-popup' ); ?></p>

						</div>

						<?php if ( ! $module->active ) { ?>

							<?php if (
									0 === $total_module_views && 0 === $total_module_conversions
								) { ?>

								<div class="sui-chartjs-message sui-chartjs-message--empty">

									<p><i class="sui-icon-info" aria-hidden="true"></i> <?php printf( esc_html__( "This %1\$s is still in draft state. You can test your %1\$s, but we won't start collecting conversion data until you publish it live.", 'wordpress-popup' ), esc_html( $smallcaps_singular ) ); ?></p>

								</div>

								<div class="sui-chartjs-canvas"></div>

							<?php } else { ?>

								<div class="sui-chartjs-message">

									<p><i class="sui-icon-info" aria-hidden="true"></i> <?php printf( esc_html__( "This %1\$s is in draft state, so we've paused collecting data until you publish it live.", 'wordpress-popup' ), esc_html( $smallcaps_singular ) ); ?></p>

								</div>

								<div class="sui-chartjs-canvas">

									<canvas id="hustle-<?php echo esc_html( $module_type ); ?>-<?php echo esc_attr( $module->id ); ?>-stats"></canvas>

								</div>

							<?php } ?>

						<?php } else { ?>


							<?php if ( empty( $tracking_types ) || ! isset( $tracking_types[ $chart_key ] ) ) { ?>

								<div class="sui-chartjs-message">

									<p><i class="sui-icon-info" aria-hidden="true"></i> <?php printf( esc_html__( "This %1\$s has tracking disabled. Enable tracking to start collecting data.", 'wordpress-popup' ), esc_html( $smallcaps_singular ) ); ?></p>

								</div>

							<?php } ?>
							<div class="sui-chartjs-canvas">

								<canvas id="hustle-<?php echo esc_html( $module_type ); ?>-<?php echo esc_attr( $module->id ); ?>-stats--<?php echo esc_html( $chart_key ); ?>"></canvas>

							</div>

						<?php } ?>

					</div>

				</div>

			<?php } ?>

		</div>

	</div>

<?php }
