<?php


class Hustle_Dashboard_Data {

	const CURRENT_COLOR_INDEX = 'hustle_color_index';
	const MODULE_GRAPH_COLOR = 'graph_color';

	public $modules = array();
	public $popups = array();
	public $slideins = array();
	public $embeds = array();
	public $social_sharings = array();
	public $active_modules = array();
	public $top_active_modules = array();
	public $conversions_today = 0;
	public $ss_share_stats_data = array();
	public $ss_total_share_stats = 0;
	public $graph_date_conversions = array();
	public $graph_dates = array();
	public $metrics = array();

	public $color = 0;
	public $types = array();
	public $colors = array(
		'#FF0000',
		'#FFFF00',
		'#00EAFF',
		'#AA00FF',
		'#FF7F00',
		'#BFFF00',
		'#0095FF',
		'#FF00AA',
		'#FFD400',
		'#6AFF00',
		'#0040FF',
		'#EDB9B9',
		'#B9D7ED',
		'#E7E9B9',
		'#DCB9ED',
		'#B8EDE0',
		'#8F2323',
		'#2362BF',
		'#8F6A23',
		'#6B238F',
		'#4F8F23',
		'#000000',
	);


	public function __construct() {
		$this->_prepare_data();
	}

	private function _prepare_data() {
		$module_instance = Hustle_Module_Collection::instance();

		$this->popups = $module_instance->get_all( null, array( 'module_type' => 'popup' ) );
		$this->slideins = $module_instance->get_all( null, array( 'module_type' => 'slidein' ) );
		$this->embeds = $module_instance->get_all( null, array( 'module_type' => 'embedded' ) );
		$this->social_sharings = $module_instance->get_all( null, array( 'module_type' => 'social_sharing' ) );

		$this->active_modules = $module_instance->get_all(true, array(
			'except_types' => array( 'social_sharing' ),
			'count_only' => true,
		));

		// to be replaced
		$temp_index = 0;
		$this->color = (int) get_option( self::CURRENT_COLOR_INDEX, 0 );

		/**
		 * metrics
		 */
		$this->metrics = $this->get_3_top_metrics();

		// Update color index
		update_option( self::CURRENT_COLOR_INDEX, $this->color );

		// parse data for graph
		if ( ! empty( $this->graph_dates ) ) {
			$this->_parse_conversions_for_graph( $this->top_active_modules );
		}
	}

	private function _parse_total_conversion( $conversions ) {
		$sum = 0;
		foreach ( $conversions as $conversion ) {
			$sum += (int) $conversion->conversions;
		}
		return $sum;
	}

	private function _parse_most_converted( $most_converted ) {
		$module_id = 0;
		if ( isset( $most_converted[0] ) && isset( $most_converted[0]->module_id ) ) {
			$module_id = $most_converted[0]->module_id;
		}
		if ( $module_id ) {
			$module = Hustle_Module_Model::instance()->get( $module_id );
			if ( ! is_wp_error( $module ) ) {
				return $module->module_name;
			}
		}
		return '-';
	}

	private function _parse_today_conversions( $today_conversions ) {
		$total = 0;
		if ( isset( $today_conversions->conversions ) ) {
			$total = (int) $today_conversions->conversions;
		}
		return $total;
	}

	private function _parse_conversions_for_graph( $top_active_modules ) {
		$this->graph_date_conversions = array();
		foreach ( $this->graph_dates as $key => $dates ) {
			$conversions = array();
			foreach ( $top_active_modules as $module ) {
				if ( isset( $module['conversion_list'] ) ) {
					if ( array_key_exists( $key, $module['conversion_list'] ) ) {
						$total_module_conversion = $module['conversion_list'][ $key ]['conversions'];
						array_push( $conversions, (int) $total_module_conversion );
					} else {
						array_push( $conversions, 0 );
					}
				}
			}
			$this->graph_date_conversions[ $key ] = array(
				'formatted' => $dates,
				'conversions' => $conversions,
			);
		}
	}

	private function _parse_dates_for_graph( $conversions ) {
		$updated_conversions = array();
		foreach ( $conversions as $key => $conversion ) {
			$format_date = substr( $conversion['dates'], 0, 4 ) . '-' . substr( $conversion['dates'], 4, 2 ) . '-' . substr( $conversion['dates'], 6, 2 );
			$this->graph_dates[ $conversion['dates'] ] = $format_date;
			$updated_conversions[ $conversion['dates'] ] = $conversion;
		}
		return $updated_conversions;
	}

	public static function uasort( $a, $b ) {
		if ( (int) $a['month'] === (int) $b['month'] ) {
			return 0;
		} elseif ( $a['month'] > $b['month'] ) {
			return 1;
		} else {
			return -1;
		}
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
			'average_conversion_rate' => __( 'Average Conversion Rate', Opt_In::TEXT_DOMAIN ),
			'total_conversions' => __( 'Total Conversions', Opt_In::TEXT_DOMAIN ),
			'most_conversions' => __( 'Most Conversions', Opt_In::TEXT_DOMAIN ),
			'today_conversions' => __( 'Today\'s Conversion', Opt_In::TEXT_DOMAIN ),
			'last_week_conversions' => __( 'Last 7 Day\'s Conversion', Opt_In::TEXT_DOMAIN ),
			'last_month_conversions' => __( 'Last 1 Month\'s Conversion', Opt_In::TEXT_DOMAIN ),
			'inactive_modules_count' => __( 'Inactive Modules', Opt_In::TEXT_DOMAIN ),
			'total_modules_count' => __( 'Total Modules', Opt_In::TEXT_DOMAIN ),
		);
		$keys = array_keys( $names );
		$metrics = Hustle_Settings_Admin::get_hustle_settings( 'selected_top_metrics' );
		$metrics = array_values( array_intersect( $keys, $metrics ) );
		while ( 3 > sizeof( $metrics ) ) {
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
					$value = __( 'Unknown', Opt_In::TEXT_DOMAIN );
			}
			if ( 0 === $value ) {
				$value = __( 'None', Opt_In::TEXT_DOMAIN );
			}
			$data[ $key ] = array(
				'label' => $names[ $key ],
				'value' => $value,
			);
		}
		return $data;
	}
}
