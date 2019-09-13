<?php

/**
 * Tracking model.
 * Base model for all tracking data: views and conversions.
 *
 * @since 4.0
 */
class Hustle_Tracking_Model {

	/**
	 * The table name
	 *
		 * @since 4.0
	 * @var string
	 */
	protected $table_name;

	/**
	 * Tracking_Model instance
	 *
		 * @since 4.0
	 * @var null
	 */
	private static $instance = null;


	/**
	 * Return the Tracking_Model instance
	 *
	 * @since 4.0
	 * @return Hustle_Tracking_Model
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Hustle_Tracking_Model constructor.
	 *
	 * @since 4.0
	 */
	public function __construct() {
		$this->table_name = Hustle_Db::tracking_table();
	}

	/**
	 * Save conversion
	 *
	 * @since 4.0
	 * @param int $module_id
	 * @param array $data
	 * @param string $action - 'conversion' || 'view'
	 * @param string $date_created Created date, default null will be * completed.
	 */
	public function save_tracking( $module_id, $action, $module_type, $page_id, $module_sub_type = null, $date_created = null, $ip = null ) {
		global $wpdb;
		/**
		 * IP Tracking
		 */
		$ip_query = ' AND `ip` IS NULL';
		$settings = Hustle_Settings_Admin::get_hustle_settings( 'privacy' );
		$ip_tracking = ! isset( $settings['ip_tracking'] ) || 'on' === $settings['ip_tracking'];
		if ( $ip_tracking ) {
			$ip = $ip ? $ip : Opt_In_Geo::get_user_ip();
			$ip_query = ' AND `ip` = %s';
		}
		// TODO: sanitize.
		// 'conversion' || 'view'
		$action = 'conversion' === $action ? 'conversion' : 'view';
		// Store the subtype for embeddeds and social sharing. Whether they're "widget", "embedded", etc.
		if ( ! is_null( $module_sub_type ) ) {
			$module_type = $module_type . '_' . $module_sub_type;
		}
		$sql = "SELECT `tracking_id` FROM {$this->table_name} WHERE `module_id` = %d AND `page_id` = %d {$ip_query} AND `action` = %s AND `module_type` = %s AND `date_created` BETWEEN ";
		if ( empty( $date_created ) ) {
			$sql .= ' utc_date() AND utc_timestamp()';
		} else {
			$sql .= sprintf(
				"'%s' AND '%s 23:59:59'",
				substr( $date_created, 0, 10 ),
				substr( $date_created, 0, 10 )
			);
		}
		if ( $ip_tracking ) {
			$prepared_sql = $wpdb->prepare( $sql, $module_id, $page_id, $ip, $action, $module_type ); // WPCS: unprepared SQL ok. false positive
		} else {
			$prepared_sql = $wpdb->prepare( $sql, $module_id, $page_id, $action, $module_type ); // WPCS: unprepared SQL ok. false positive
		}
		$tracking_id = $wpdb->get_var( $prepared_sql ); // WPCS: unprepared SQL ok. false positive
		if ( $tracking_id ) {
			$this->_update( $tracking_id, $wpdb );
		} else {
			$this->_save( $module_id, $page_id, $module_type, $action, $ip, $wpdb, $date_created );
		}
		return true;
	}

	/**
	 * Used only to keep this data coming from 3.x.
	 *
	 * @since 4.0
	 *
	 * @param int $page_id
	 * @param int $count
	 * @return void
	 */
	public function save_old_migrated_sshare_page_count( $page_id, $count ) {

		// Exclude the counter for the pages that don't exist in this blog.
		if ( ! is_object( get_post( $page_id ) ) ) {
			return;
		}

		global $wpdb;
		$db = $wpdb;

		$date_created = Opt_In_Utils::get_current_date();

		$db->insert( $this->table_name, array(
			'module_id'     => 0,
			'page_id'       => $page_id,
			'module_type'   => Hustle_Module_Model::SOCIAL_SHARING_MODULE,
			'action' 		=> '_page_shares',
			'ip'            => null,
			'date_created'  => $date_created,
			'date_updated'  => $date_created,
			'counter'		=> $count
		) );
	}

	/**
	 * Save tracking to database
	 *
	 * @since 4.0
	 *
	 * @param int $module_id
	 * @param int $page_id
	 * @param string $module_type popup | slidein | embedded
	 * @param string $action view | conversion
	 * @param string $ip - the user ip
	 * @param bool|object $db - the wp db object
	 * @param string $date_created Created date, default null will be * completed.
	 */
	private function _save( $module_id, $page_id, $module_type, $action, $ip, $db = false, $date_created = null ) {
		if ( ! $db ) {
			global $wpdb;
			$db = $wpdb;
		}
		if ( empty( $date_created ) ) {
			$date_created = Opt_In_Utils::get_current_date();
		}
		$db->insert( $this->table_name, array(
			'module_id'     => $module_id,
			'page_id'       => $page_id,
			'module_type'   => $module_type,
			'action' 		=> $action,
			'ip'            => $ip,
			'date_created'  => $date_created,
			'date_updated'  => $date_created,
		) );
	}

	/**
	 * Update tracking
	 *
	 * @since 4.0
	 * @param int $id - tracking id
	 * @param bool|object $db - the wp db object
	 *
	 */
	private function _update( $id, $db = false ) {
		if ( ! $db ) {
			global $wpdb;
			$db = $wpdb;
		}
		$date = Opt_In_Utils::get_current_date();
		$db->query( $db->prepare(
			"UPDATE {$this->table_name} SET `counter` = `counter`+1, `date_updated` = %s WHERE `tracking_id` = %d",
			$date,
			$id
		));
	}

	/**
	 * Count conversions
	 *
	 * @since 4.0
	 * @param int $module_id
	 * @param string $action - view | conversion
	 * @param string $module_subtype - the module subtype
	 * @param string $starting_date - the start date (dd-mm-yyy)
	 * @param string $ending_date - the end date (dd-mm-yyy)
	 *
	 * @return int - total views based on parameters
	 */
	public function count_tracking_data( $module_id, $action, $module_subtype = null, $starting_date = null, $ending_date = null ) {
		$action = 'conversion' === $action ? 'conversion' : 'view';
		return $this->_count( $action, $module_id, $module_subtype, $starting_date, $ending_date );
	}

	/**
	 * Count tracking data according to arguments.
	 *
	 * @since 4.0
	 *
	 * @param string $action view | conversion
	 * @param int $module_id - the module id
	 * @param string $module_subtype - the module subtype
	 * @param string $starting_date - the start date (dd-mm-yyy)
	 * @param string $ending_date - the end date (dd-mm-yyy)
	 *
	 * @return int - total counts based on parameters
	 */
	private function _count( $action, $module_id = null, $module_subtype = null, $starting_date = null, $ending_date = null ) {
		global $wpdb;
		$where_query = $wpdb->prepare( 'WHERE `action` = %s', $action );
		if ( $module_id ) {
			$where_query .= $wpdb->prepare( ' AND `module_id` = %d', $module_id );
		}
		if ( $module_subtype ) {
			if ( in_array( $module_subtype, [ 'social_sharing', 'embedded' ], true ) ) {
				$where_query .=  ' AND `module_type` like \'' . $module_subtype . '%\'';
			} else {
				$where_query .= $wpdb->prepare( ' AND `module_type` = %s', $module_subtype );
			}
		}
		$action = 'conversion' === $action ? 'conversion' : 'view';
		$date_query = $this->_generate_date_query( $wpdb, $starting_date, $ending_date );
		$sql = "SELECT SUM(`counter`) FROM {$this->table_name} {$where_query} $date_query";
		$counts = $wpdb->get_var( $sql ); // WPCS: unprepared SQL ok. false positive
		if ( $counts ) {
			return $counts;
		}
		return 0;
	}

	/**
	 * Generate the date query
	 *
	 * @since 4.0
	 * @param object $wpdb - the WordPress database object
	 * @param string $starting_date - the start date (dd-mm-yyy)
	 * @param string $ending_date - the end date (dd-mm-yyy)
	 *
	 * @return string $date_query
	 */
	private function _generate_date_query( $wpdb, $starting_date = null, $ending_date = null, $prefix = '', $clause = 'AND' ) {
		$date_query = '';
		$date_format = '%%Y-%%m-%%d';
		if ( ! is_null( $starting_date ) && ! is_null( $ending_date ) && ! empty( $starting_date ) && ! empty( $ending_date ) ) {
			$date_query = $wpdb->prepare( "$clause DATE_FORMAT($prefix`date_created`, '$date_format') >= %s AND DATE_FORMAT($prefix`date_created`, '$date_format') <= %s", $starting_date, $ending_date ); // WPCS: unprepared SQL OK.
		} else {
			if ( ! is_null( $starting_date ) && ! empty( $starting_date ) ) {
				$date_query = $wpdb->prepare( "$clause DATE_FORMAT($prefix`date_created`, '$date_format') >= %s", $starting_date ); // WPCS: unprepared SQL OK.
			} elseif ( ! is_null( $ending_date ) && ! empty( $ending_date ) ) {
				$date_query = $wpdb->prepare( "$clause DATE_FORMAT($prefix`date_created`, '$date_format') <= %s", $starting_date ); // WPCS: unprepared SQL OK.
			}
		}
		return $date_query;
	}

	/**
	 * Get tracking data newer than $date_created of module_id grouped by date_created Day
	 *
	 * @since 4.0
	 *
	 * @param int $module_id
	 * @param $date_created
	 *
	 * @return array
	 */
	public function get_form_latest_tracking_data_count_grouped_by_day( $module_id, $date_created, $action, $module_type = null, $module_sub_type = null ) {
		global $wpdb;
		$table_name = $this->table_name;
		$action = 'conversion' === $action ? 'conversion' : 'view';
		$sub_type_query = '';
		if ( $module_type && $module_sub_type ) {
			if ( Hustle_Module_Model::EMBEDDED_MODULE === $module_type ) {
				$sub_types_array = Hustle_Module_Model::get_embedded_types();
			} elseif ( Hustle_Module_Model::SOCIAL_SHARING_MODULE === $module_type ) {
				$sub_types_array = Hustle_Module_Model::get_sshare_types();
			} else {
				return false;
			}
			$module_sub_type = in_array( $module_sub_type, $sub_types_array, true ) ? $module_type . '_' . $module_sub_type : false;
			if ( ! $module_sub_type ) {
				return false;
			}
			$sub_type_query = $wpdb->prepare( 'AND e.module_type = %s', $module_sub_type );
		}
		$date_query = $this->_generate_date_query( $wpdb, $date_created );
		$sql = "SELECT SUM(`counter`) AS tracked_count,
			DATE(e.date_created) AS date_created
			FROM {$table_name} e
			WHERE e.module_id = %d
			AND e.action = %s
			{$sub_type_query}
			{$date_query}
			GROUP BY DATE(e.date_created)
			ORDER BY e.date_created DESC";
		$sql = $wpdb->prepare( $sql, // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
		$module_id, $action );
		$conversions_amount = $wpdb->get_results( $sql ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
		return $conversions_amount;
	}

	/**
	 * Get latest conversion date
	 *
	 * @since 4.0
	 *
	 * @param string $module_type
	 * @return string
	 */
	public function get_latest_conversion_date( $module_type = 'popup' ) {
		$available_entry_types = array(
			'popup',
			'slidein',
			'embedded',
			'social_sharing',
			'all',
		);
		if ( ! in_array( $module_type, $available_entry_types, true ) ) {
			return null;
		}
		global $wpdb;
		$entry = null;
		if ( 'all' !== $module_type ) {
			if ( in_array( $module_type, [ 'social_sharing', 'embedded' ], true ) ) {
				$where_query = 'WHERE `module_type` like \'' . $module_type . '%\'';
			} else {
				$where_query = $wpdb->prepare( 'WHERE `module_type` = %s', $module_type );
			}
			$sql = "SELECT `date_updated` FROM {$this->table_name} {$where_query} AND `action` = 'conversion' ORDER BY `date_updated` DESC";
		} else {
			$sql = "SELECT `date_updated` FROM {$this->table_name} WHERE `action` = 'conversion' ORDER BY `date_updated` DESC";
		}
		$date = $wpdb->get_var( $sql ); // WPCS: unprepared SQL ok. false positive
		return $date;
	}

	/**
	 * Get latest tracked conversion date by module_id
	 *
	 * @since 4.0
	 *
	 * @param $module_id
	 * @param string $sub_type Optional
	 * @return Hustle_Entry_Model|null
	 */
	public function get_latest_conversion_date_by_module_id( $module_id, $sub_type = '' ) {
		global $wpdb;
		$and_subtype = '';
		if ( !empty( $sub_type ) ) {
			$and_subtype = $wpdb->prepare( " AND `module_type` = %s", $sub_type );
		}
		$sql = "SELECT `date_updated` FROM {$this->table_name} WHERE `module_id` = %d AND `action` = 'conversion' {$and_subtype} ORDER BY `date_updated` DESC";
		$date = $wpdb->get_var( $wpdb->prepare( $sql, $module_id ) ); // WPCS: unprepared SQL ok. false positive
		return $date;
	}

	/**
	 * Count conversions newer than $date_created
	 *
	 * @since 4.0
	 *
	 * @param $module_type
	 * @param $date_created
	 *
	 * @return array
	 */
	public function count_newer_conversions_by_module_type( $module_type, $date_created ) {
		$count = $this->_count( 'conversion', null, $module_type, $date_created, null );
		return $count;
	}

	/**
	 * Get the tracking count by module type (can omit sub-type), and action
	 * grouped by the page id.
	 *
	 * @since 4.0
	 *
	 * @param string $module_type
	 * @param string $action
	 * @param array $pages
	 * @return array
	 */
	public function get_module_type_tracking_count_per_page( $module_type, $action, $limit = 5, $offset = 0 ) {
		global $wpdb;

		$table_name = $this->table_name;
		if ( ! in_array( $module_type, Hustle_Module_Model::get_module_types(), true ) ) {
			$module_type = '';
		}

		$sql = " AND e.action = %s
			GROUP BY e.page_id
			ORDER BY tracked_count DESC
			LIMIT %d";

		$sql = $wpdb->prepare( $sql, $action, $limit );// phpcs:ignore

		$sql = "SELECT SUM(`counter`) AS tracked_count,
			e.page_id AS page_id
			FROM {$table_name} e
			WHERE e.module_type LIKE '{$module_type}%'" . $sql;
		$conversions_amount = $wpdb->get_results( $sql ); // phpcs:ignore

		return $conversions_amount;
	}

	public function get_ssharing_per_page_conversion_count() {

		global $wpdb;

		$table_name = $this->table_name;

		$query = $wpdb->prepare(
			"SELECT SUM(`counter`) AS tracked_count, `page_id` AS page_id
			FROM {$table_name}
			WHERE `action` = '_page_shares'
			OR ( `module_type` LIKE %s AND `action` = 'conversion' )
			GROUP BY `page_id`
			ORDER BY `counter` DESC
			LIMIT 5",
			Hustle_Module_Model::SOCIAL_SHARING_MODULE .'%'
		);

		return $wpdb->get_results( $query ); // phpcs:ignore
	}

	/**
	 * Get the paged tracking count by module type and page id.
	 *
	 * @since 4.0
	 *
	 * @param string $module_type
	 * @param array $pages_ids
	 * @param string $action
	 * @param array $pages
	 * @return array
	 */
	public function get_tracking_count_by_page_id_and_module_type( $module_type, $pages_ids, $action ) {
		global $wpdb;

		$table_name = $this->table_name;
		if ( ! in_array( $module_type, Hustle_Module_Model::get_module_types(), true ) ) {
			$module_type = '';
		}

		$pages_ids_placeholders = implode( ', ', array_fill( 0, count( $pages_ids ), '%d' ) );
		$pages_ids_query = $wpdb->prepare( "WHERE page_id IN ({$pages_ids_placeholders})", $pages_ids ); // phpcs:ignore

		$sql = $wpdb->prepare(
			"SELECT SUM(`counter`) AS tracked_count, `page_id` AS page_id
			FROM {$table_name}
			{$pages_ids_query}
			AND module_type LIKE %s AND `action` = %s",
			$module_type . '%',
			$action
		);
		$conversions_amount = $wpdb->get_results( $sql ); // phpcs:ignore

		return $conversions_amount;
	}

	/**
	 * Delete tracking data
	 *
	 * @since 4.0.0
	 */
	public function delete_data( $module_id ) {
		global $wpdb;
		$wpdb->delete(
			$this->table_name,
			array( 'module_id' => $module_id ),
			array( '%d' )
		);
	}

	/**
	 * Get Average Conversion Rate
	 *
	 * @since 4.0.0
	 *
	 * @return number $value Percent of conversions.
	 */
	public function get_average_conversion_rate() {
		$conversions = $this->_count( 'conversion' );
		$views = $this->_count( 'view' );
		if ( 0 < $views ) {
			return sprintf( '%.2f%%', 100 * $conversions / $views );
		}
		return 0;
	}

	/**
	 * Ger number of total conversions.
	 *
	 * @since 4.0.0
	 *
	 * @return integer $value Number of conversions.
	 */
	public function get_total_conversions() {
		return $this->_count( 'conversion' );
	}

	/**
	 * Get module id of most conversions module.
	 *
	 * @since 4.0.0
	 *
	 * @return integer $value Module ID.
	 */
	public function get_most_conversions_module_id() {
		global $wpdb;

		$value = intval( $wpdb->get_var( // WPCS: unprepared SQL OK.
			"SELECT `module_id` FROM " . $this->table_name . " WHERE `action` = 'conversion' GROUP BY `module_id` ORDER BY sum(`counter`) DESC LIMIT 1"
		) );

		return $value;
	}

	/**
	 * Get Today Conversions
	 *
	 * @since 4.0.0
	 *
	 * @return integer $value Number of conversions.
	 */
	public function get_today_conversions() {
		global $wpdb;
		$sql = sprintf(
			'SELECT COUNT(*) FROM `%s` WHERE `date_created` > DATE_SUB( NOW(), INTERVAL 24 hour )',
			$this->table_name
		);
		$value = intval( $wpdb->get_var( $sql ) );
		return $value;
	}

	/**
	 * Get Last Week Conversions
	 *
	 * @since 4.0.0
	 *
	 * @return integer $value Number of conversions.
	 */
	public function get_last_week_conversions() {
		global $wpdb;
		$sql = sprintf(
			'SELECT COUNT(*) FROM `%s` WHERE `date_created` > DATE_SUB( NOW(), INTERVAL 7 DAY )',
			$this->table_name
		);
		$value = intval( $wpdb->get_var( $sql ) );
		return $value;
	}

	/**
	 * Get Last Month Conversions
	 *
	 * @since 4.0.0
	 *
	 * @return integer $value Number of conversions.
	 */
	public function get_last_month_conversions() {
		global $wpdb;
		$sql = sprintf(
			'SELECT COUNT(*) FROM `%s` WHERE `date_created` > DATE_SUB( NOW(), INTERVAL 1 MONTH )',
			$this->table_name
		);
		$value = intval( $wpdb->get_var( $sql ) );
        return $value;
    }

    /**
	 * Set null on all IP
	 *
	 * @since 4.0.0
	 */
	public function set_null_on_all_ips() {
		global $wpdb;
		$query = sprintf(
			'UPDATE `%s` SET `ip` = NULL WHERE `ip` IS NOT NULL',
			$this->table_name
		);
		$wpdb->query( $query );
	}

	/**
	 * Set null on selected IP
	 *
	 * @since 4.0.0
	 *
	 * @param array $ips Array of IPs to remove.
	 */
	public function set_null_on_selected_ips( $ips ) {
		if ( empty( $ips ) || ! is_array( $ips ) ) {
			return;
		}
		global $wpdb;
		$in = array();
		$ranges = array();
		foreach ( $ips as $one ) {
			if ( is_array( $one ) ) {
				$ranges[] = sprintf(
					'( INET_ATON( `ip` ) BETWEEN %d AND %d )',
					$one[0],
					$one[1]
				);
			} else {
				$in[] = $one;
			}
		}
		$query = sprintf( 'UPDATE `%s` SET `ip` = NULL WHERE ', $this->table_name );
		if ( ! empty( $in ) ) {
			$query .= sprintf(
				'`ip` IN ( %s ) ', implode( ', ', array_map( array( $this, 'wrap_ip' ), $in ) )
			);
			if ( ! empty( $ranges ) ) {
				$query .= 'OR ';
			}
		}
		if ( ! empty( $ranges ) ) {
			$query .= implode( ' OR ', $ranges );
		}
		$wpdb->query( $query );
	}

	/**
	 * Helper to wrap IP into "''"
	 */
	private function wrap_ip( $a ) {
		return sprintf( '\'%s\'', $a );
	}
}
