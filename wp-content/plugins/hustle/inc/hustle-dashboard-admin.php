<?php

/**
 * Hustle_Dashboard_Admin.
 */
class Hustle_Dashboard_Admin extends Hustle_Admin_Page_Abstract {

	const WELCOME_MODAL_NAME = 'welcome_modal';
	const MIGRATE_MODAL_NAME = 'migrate_modal';
	const MIGRATE_NOTICE_NAME = 'migrate_notice';

	protected function init() {

		$this->page = 'hustle';

		$this->page_title = __( 'Dashboard', 'wordpress-popup' );

		$this->page_capability = 'hustle_menu';

		$this->page_template_path = 'admin/dashboard';

		if ( ! empty( $this->current_page ) && $this->current_page === $this->page ) {
			add_action( 'admin_footer', array( $this, 'on_admin_footer' ) );
		}
	}

	/**
	 * Register Hustle's parent menu.
	 * Call the parent method to add the submenu page for Dashboard.
	 *
	 * @since 4.0.1
	 */
	public function register_admin_menu() {

		$parent_menu_title = Opt_In_Utils::_is_free() ? __( 'Hustle', 'wordpress-popup' ) : __( 'Hustle Pro', 'wordpress-popup' );

		// Parent menu
		add_menu_page( $parent_menu_title , $parent_menu_title , $this->page_capability, 'hustle', array( $this, 'render_main_page' ), Opt_In::$plugin_url . 'assets/images/icon.svg' );

		parent::register_admin_menu();
	}

	/**
	 * Get the arguments used when rendering the main page.
	 * 
	 * @since 4.0.1
	 * @return array
	 */
	public function get_page_template_args() {

		$collection_instance = Hustle_Module_Collection::instance();

		$capability = array(
			'hustle_create' => current_user_can( 'hustle_create' ),
			'hustle_access_emails' => current_user_can( 'hustle_access_emails' ),
		);

		$popups = $collection_instance->get_all( null, array( 'module_type' => 'popup' ) );
		$slideins = $collection_instance->get_all( null, array( 'module_type' => 'slidein' ) );
		$embeds = $collection_instance->get_all( null, array( 'module_type' => 'embedded' ) );
		$social_sharings = $collection_instance->get_all( null, array( 'module_type' => 'social_sharing' ) );

		$active_modules = $collection_instance->get_all( true, array(
			'except_types' => array( 'social_sharing' ),
			'count_only' => true,
		));

		$modules_except_ss = count( $popups ) + count( $slideins ) + count( $embeds );

		$last_conversion = Hustle_Tracking_Model::get_instance()->get_latest_conversion_date( 'all' );

		return array(
			'metrics' => $this->get_3_top_metrics(),
			'active_modules' => $active_modules,
			'popups' => $popups,
			'slideins' => $slideins,
			'embeds' => $embeds,
			'social_shares' => $social_sharings,
			'last_conversion' => $last_conversion ? date_i18n( 'j M Y @ H:i A', strtotime( $last_conversion ) ) : __( 'Never', 'wordpress-popup' ),
			'sshare_per_page_data' => $this->get_sshare_per_page_conversions(),
			'has_modules' => ( $modules_except_ss > 0 ) ? true : false,
			'capability' => $capability,
			'need_migrate' => Hustle_Migration::check_tracking_needs_migration(),
			'sui' => Opt_In::get_sui_summary_config(),
		);
	}

	/**
	 * Get the data for listing the ssharing modules conversions per page.
	 *
	 * @since 4.0.0
	 * @return array
	 */
	private function get_sshare_per_page_conversions() {

		$tracking_model = Hustle_Tracking_Model::get_instance();
		$tracking_data = $tracking_model->get_ssharing_per_page_conversion_count();

		$data_array = array();
		foreach ( $tracking_data as $data ) {

			if ( '0' !== $data->page_id ) {
				$title = get_the_title( $data->page_id );
				$url = get_permalink( $data->page_id );
			} else {
				$title = get_bloginfo( 'name', 'display' );
				$url = get_home_url();
			}

			if ( empty( $url ) ) {
				continue;
			}
			$data_array[] = array(
				'title' => $title,
				'url' => $url,
				'count' => $data->tracked_count,
			);
		}

		return $data_array;
	}

	/**
	 * Get 3 Top Metrics
	 *
	 * @since 4.0.0
	 *
	 * @return array $data Array of 4 top metrics.
	 */
	private function get_3_top_metrics() {
		global $hustle;
		$names = array(
			'average_conversion_rate' => __( 'Average Conversion Rate', 'wordpress-popup' ),
			'total_conversions' => __( 'Total Conversions', 'wordpress-popup' ),
			'most_conversions' => __( 'Most Conversions', 'wordpress-popup' ),
			'today_conversions' => __( 'Today\'s Conversion', 'wordpress-popup' ),
			'last_week_conversions' => __( 'Last 7 Day\'s Conversion', 'wordpress-popup' ),
			'last_month_conversions' => __( 'Last 1 Month\'s Conversion', 'wordpress-popup' ),
			'inactive_modules_count' => __( 'Inactive Modules', 'wordpress-popup' ),
			'total_modules_count' => __( 'Total Modules', 'wordpress-popup' ),
		);
		$keys = array_keys( $names );
		$metrics = Hustle_Settings_Admin::get_hustle_settings( 'selected_top_metrics' );
		$metrics = array_values( array_intersect( $keys, $metrics ) );

		while ( 3 > count( $metrics ) ) {
			$key = array_shift( $keys );
			if ( ! in_array( $key, $metrics ) ) {
				$metrics[] = $key;
			}
		}
		$data = array();
		$tracking = Hustle_Tracking_Model::get_instance();
		$module_instance = Hustle_Module_Collection::instance();
		foreach ( $metrics as $key ) {

			switch ( $key ) {
				case 'average_conversion_rate':
					$value = $tracking->get_average_conversion_rate();
				break;
				case 'total_conversions':
					$value = $tracking->get_total_conversions();
				break;
				case 'most_conversions':
					$module_id = $tracking->get_most_conversions_module_id();
					$module = Hustle_Module_Model::instance()->get( $module_id );
					if ( ! is_wp_error( $module ) ) {
						$value = $module->module_name;
						$url = add_query_arg( 'page', $module->get_wizard_page() );
						if ( ! empty( $url ) ) {
							$url = add_query_arg( 'id', $module->module_id, $url );
							$value = sprintf(
								'<a href="%s">%s</a>',
								esc_url( $url ),
								esc_html( $value )
							);
						}
					}
				break;
				case 'today_conversions':
					$value = $tracking->get_today_conversions();
				break;
				case 'last_week_conversions':
					$value = $tracking->get_last_week_conversions();
				break;
				case 'last_month_conversions':
					$value = $tracking->get_last_month_conversions();
				break;
				case 'inactive_modules_count':
					$value = $module_instance->get_all( false, array( 'count_only' => true ) );
				break;
				case 'total_modules_count':
					$value = $module_instance->get_all( 'any', array( 'count_only' => true ) );
				break;
				default:
					$value = __( 'Unknown', 'wordpress-popup' );
			}
			if ( 0 === $value ) {
				$value = __( 'None', 'wordpress-popup' );
			}
			$data[ $key ] = array(
				'label' => $names[ $key ],
				'value' => $value,
			);
		}
		return $data;
	}
}
