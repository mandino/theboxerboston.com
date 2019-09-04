<?php
if ( ! class_exists( 'Hustle_Popup_Admin_Ajax' ) ) :
	/**
 * Class Hustle_Popup_Admin_Ajax
 * Takes care of all the ajax calls to admin pages
 *
 */
	class Hustle_Popup_Admin_Ajax {

		private $_hustle;
		private $_admin;

		public function __construct( Opt_In $hustle, Hustle_Popup_Admin $admin ) {

			$this->_hustle = $hustle;
			$this->_admin = $admin;

			add_action( 'wp_ajax_get_new_condition_ids', array( $this, 'get_new_condition_ids' ) );

			if ( Opt_In_Utils::_is_free() && ! file_exists( WP_PLUGIN_DIR . '/hustle/opt-in.php' ) ) {
				add_action( 'wp_ajax_hustle_dismiss_admin_notice', array( $this, 'dismiss_admin_notice' ) );
			}
		}

		/**
	 * Finds and repares select2 options
	 *
	 * @global type $wpdb
	 * @since 3.0.7
	 */
		public function get_new_condition_ids() {
			$post_type = filter_input( INPUT_POST, 'post_type', FILTER_SANITIZE_STRING );
			$search = filter_input( INPUT_POST, 'search' );
			$result = array();
			$limit = 30;
			if ( ! empty( $post_type ) ) {
				if ( in_array( $post_type, array( 'tag', 'category' ), true ) ) {
					$args = array(
					'hide_empty' => false,
					'search' => $search,
					'number' => $limit,
					);
					if ( 'tag' === $post_type ) {
						$args['taxonomy'] = 'post_tag';
					}
					$result = array_map( array( 'Hustle_Module_Admin', 'terms_to_select2_data' ), get_categories( $args ) );
				} else {
					global $wpdb;
					$result = $wpdb->get_results( $wpdb->prepare( "SELECT ID as id, post_title as text FROM {$wpdb->posts} "
					. "WHERE post_type = %s AND post_status = 'publish' AND post_title LIKE %s LIMIT " . intval( $limit ), $post_type, '%'. $search . '%' ) );

					$obj = get_post_type_object( $post_type );
					$all_items = ! empty( $obj ) && ! empty( $obj->labels->all_items )
						? $obj->labels->all_items : __( 'All Items', Opt_In::TEXT_DOMAIN );
					/**
				 * Add ALL Items option
				 */
					$all = new stdClass();
					$all->id = 'all';
					$all->text = $all_items;
					if ( empty( $search ) || false !== stripos( $all_items, $search ) ) {
						array_unshift( $result, $all );
					}
				}
			}

			wp_send_json_success( $result );
		}

		/**
	 * Sets an user meta to prevent admin notice from showing up again after dismissed.
	 *
	 * @since 3.0.6
	 */
		public function dismiss_admin_notice() {
			$user_id = get_current_user_id();
			$notice = filter_input( INPUT_POST, 'dismissed_notice', FILTER_SANITIZE_STRING );

			$dismissed_notices = get_user_meta( $user_id, 'hustle_dismissed_admin_notices', true );
			$dismissed_notices = array_filter( explode( ',', (string) $dismissed_notices ) );

			if ( $notice && ! in_array( $notice, $dismissed_notices, true ) ) {
				$dismissed_notices[] = $notice;
				$to_store = implode( ',', $dismissed_notices );
				update_user_meta( $user_id, 'hustle_dismissed_admin_notices', $to_store );
			}

			wp_send_json_success();
		}

	}
endif;
