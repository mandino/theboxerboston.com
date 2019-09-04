<?php
if ( ! class_exists( 'Hustle_Modules_Common_Admin_Ajax' ) ) :
	/**
 * Class Hustle_Modules_Common_Admin_Ajax.
 * Intended for Pop-up, Slide-in, Embeds, and Social sharing modules common ajax actions on admin side.
 *
 * @since 4.0
 *
 */
	class Hustle_Modules_Common_Admin_Ajax {

		private $_hustle;
		private $_admin;

		public function __construct( Opt_In $hustle, Hustle_Modules_Common_Admin $admin ) {

			$this->_hustle = $hustle;
			$this->_admin = $admin;

			add_action( 'wp_ajax_hustle_save_module', array( $this, 'save_module' ) );
			add_action( 'wp_ajax_hustle_create_new_module', array( $this, 'create_new_module' ) );
			add_action( 'wp_ajax_hustle_toggle_module_state', array( $this, 'toggle_module_state' ) );
			add_action( 'wp_ajax_hustle_toggle_module_tracking', array( $this, 'toggle_module_tracking' ) );
			add_action( 'wp_ajax_hustle_import_module', array( $this, 'import_module' ) );
			add_action( 'wp_ajax_hustle_preview_module', array( $this, 'preview_module' ) );
			add_action( 'wp_ajax_hustle_listing_bulk', array( $this, 'bulk' ) );
            add_action( 'wp_ajax_hustle_tracking_data', array( $this, 'get_tracking_data' ) );
			add_action( 'wp_ajax_hustle_module_tracking_reset', array( $this, 'module_tracking_reset' ) );

			// Used for Gutenberg.
			add_action( 'wp_ajax_hustle_render_module', array( $this, 'render_module' ) );
			add_action( 'wp_ajax_hustle_get_module_id_by_shortcode', array( $this, 'get_module_id_by_shortcode' ) );
		}

		/**
		 * Saves new optin to db
		 *
		 * @since 1.0
		 */
		public function save_module() {

			// TODO: sanitize!
			Opt_In_Utils::validate_ajax_call( 'hustle_save_module_wizard' );

			$id = filter_input( INPUT_POST, 'id', FILTER_VALIDATE_INT );
			Opt_In_Utils::is_user_allowed_ajax( 'hustle_edit_module', $id );

			$_post = stripslashes_deep( $_POST ); // CSRF: ok

			if ( ! isset( $_post['id'] ) ) {
				return false;
			}
			$module = Hustle_Module_Model::instance()->get( $_post['id'] );
			if ( is_wp_error( $module ) ) {
				return false;
			}

			$res = $module->update_module( $_post );

			wp_send_json( array(
				'success' => false === $res ? false: true,
				'data' => $res,
			) );
		}

		/**
		 * Create a new module of any type
		 *
		 * @since 4.0
		 *
		 */
		public function create_new_module() {
			Opt_In_Utils::validate_ajax_call( 'hustle_create_new_module' );
			Opt_In_Utils::is_user_allowed_ajax( 'hustle_create' );

			$data = stripslashes_deep( $_POST['data'] ); // CSRF: ok.
			$data = Opt_In_Utils::validate_and_sanitize_fields( $data, array( 'module_name', 'module_type' ) );
			if ( isset( $data['errors'] ) ) {
				wp_send_json_error();
			}

			// If it's Free, check we're not passing the limits.
			if ( ! Hustle_Module_Admin::can_create_new_module( $data['module_type'] ) ) {

				$listing_page = Hustle_Module_Admin::get_listing_page_by_module_type( $data['module_type'] );

				$url = add_query_arg( array(
					'page' => $listing_page,
					Hustle_Module_Admin::UPGRADE_MODAL_PARAM => 'true',
				), 'admin.php' );

				wp_send_json_error( array(
					'redirect_url' => $url
				) );

			}

			$module_id = $this->_admin->create_new( $data );

			if ( $module_id ) {

				$wizard_page = Hustle_Module_Admin::get_wizard_page_by_module_type( $data['module_type'] );
				$url = add_query_arg( array(
					'page' => $wizard_page,
					'id' => $module_id,
					'new' => 'true',
				), 'admin.php' );

				wp_send_json_success( array(
					'redirect_url' => $url
				) );

			} else {
				wp_send_json_error();
			}

		}

		/**
		 * Callback for the module import in listing pages.
		 * @since 4.0
		 */
		public function import_module() {

			$module_type = trim( filter_input( INPUT_POST, 'type', FILTER_SANITIZE_STRING ) );
			if ( ! $module_type ) {
				wp_send_json_error( __( 'Invalid Request', Opt_In::TEXT_DOMAIN ) );
			}

			Opt_In_Utils::validate_ajax_call( 'hustle_module_import' . $module_type );

			$module_id = filter_input( INPUT_POST, 'module_id', FILTER_VALIDATE_INT );
			if ( ! $module_id && ! Hustle_Module_Admin::can_create_new_module( $module_type ) ) {

				$url = add_query_arg( array(
					'page' => Hustle_Module_Admin::get_listing_page_by_module_type( $module_type ),
					Hustle_Module_Admin::UPGRADE_MODAL_PARAM => 'true',
				), 'admin.php' );

				wp_send_json_error( array( 'redirect_url' => $url ) );
			}

			// Get the file containing the module data.
			$file = isset( $_FILES['file'] ) ? $_FILES['file'] : false;
			if ( ! $file ) {
				wp_send_json_error( array( 'error_message' => __( 'The file is required', Opt_In::TEXT_DOMAIN ) ) );

			} else if ( ! empty( $file['error'] ) ) {
				wp_send_json_error( array( 'error_message' => sprintf( __( 'Error: %s', Opt_In::TEXT_DOMAIN ), esc_html( $file['error'] ) ) ) );
			}
			$overrides = array(
				'test_form' => false,
				'test_type' => false,
			);
			$wp_file = wp_handle_upload( $file, $overrides );
			$filename = $wp_file['file'];
			$file_content = file_get_contents( $filename );

			// Import file if it's json format
			$data = array();
			if ( strpos( $filename, '.json' ) || strpos( $filename, '.JSON' ) ) {
				$data = json_decode( $file_content, true );
			}
			$version = $this->_hustle->get_const_var( 'VERSION' );
			$type_from_file = 'unknown';

			// Check data
			if ( isset( $data['plugin'] ) && isset( $data['plugin']['version'] ) ) {

				// Import from 4.0.0
				$compare = version_compare( $data['plugin']['version'], '4.0', '>=' );
				if ( ! $compare ) {
					wp_send_json_error( array( 'error_message' => __( 'The module must come from a Hustle 4.0 or newer version.', Opt_In::TEXT_DOMAIN ) ) );
				}

				// Get imported module type
				if ( isset( $data['data'] ) && isset( $data['data']['module_type'] ) ) {
					$type_from_file = $data['data']['module_type'];
				}
			} else {

				// TODO: maybe check required data.

				// Get imported module type.
				if ( isset( $data['module_type'] ) ) {
					$type_from_file = $data['module_type'];
				} else {
					$type_from_file = $data['type'];
				}
			}

			// Check module type.
			if ( $type_from_file !== $module_type ) {
				wp_send_json_error( array( 'error_message' => sprintf( __( 'Invalid environment: %s', Opt_In::TEXT_DOMAIN ), $type_from_file ) ) );
			}

			// Store the module as 'draft'.
			$data['attributes']['active'] = '0';
			$data['data']['active'] = '0';

			// Import a new module.
			if ( ! $module_id ) {
				$this->import_new_module( $module_type, $data );

			} else {
				// Import the settings into an existing module.
				$this->import_module_settings( $module_id, $module_type, $data );
			}

		}

		private function import_module_settings( $module_id, $type, $data ) {
			/**
			 * get module
			 */
			$module = Hustle_Module_Model::instance()->get( $module_id );
			if ( is_wp_error( $module ) ) {
				wp_send_json_error( sprintf( __( 'Invalid module!', Opt_In::TEXT_DOMAIN ) ) );
			}
			/**
			 * Check permissions
			 */
			$is_allowed = $module->is_allowed_for_current_user();
			if ( ! $is_allowed ) {
				wp_send_json_error( sprintf( __( 'Access denied. You do not have permission to perform this action.', Opt_In::TEXT_DOMAIN ) ) );
			}
			/**
			 * Import from 3.x export
			 */
			$meta_names = $module->get_module_meta_names();
			foreach ( $meta_names as $meta_key ) {
				if ( isset( $data[ $meta_key ] ) ) {
					$module->update_meta( $meta_key, $data[ $meta_key ] );
				}
			}
			if ( isset( $data['module_name'] ) ) {
				$module->module_name = $data['module_name'];
			}
			/**
			 * Import from 4.0.0 export
			 */
			if ( isset( $data['meta'] ) ) {
				foreach ( $data['meta'] as $meta_key => $meta_value ) {
					$module->update_meta( $meta_key, $meta_value );
				}
			}
			if ( isset( $data['data'] ) ) {
				foreach ( $data['data'] as $key => $value ) {
					if ( 'module_id' === $key ) {
						continue;
					}
					$module->$key = $value;
				}
			}
			$module->save();
			$module->clean_module_cache();
			wp_send_json_success();
		}

		private function import_new_module( $type, $data ) {
			Opt_In_Utils::is_user_allowed_ajax( 'hustle_create' );
			$module_data = !empty( $data['data'] ) ? $data['data'] : array();
			if ( !empty( $data['meta'] ) ) {
				$module_data = array_merge( $module_data, $data['meta'] );
			}
			$module_id = $this->_admin->create_new( $module_data );

			if ( ! empty( $module_id ) ) {
				$module = Hustle_Module_Model::instance()->get( $module_id );
				$module->clean_module_cache();
				wp_send_json_success( __( 'Successful', Opt_In::TEXT_DOMAIN ) );
			}


			wp_send_json_error( __( 'Creating a new module went wrong', Opt_In::TEXT_DOMAIN ) );
		}

		/**
		 * Toggle module status.
		 */
		public function toggle_module_state() {
			Opt_In_Utils::validate_ajax_call( 'module_toggle_state' );
			$id = filter_input( INPUT_POST, 'id', FILTER_VALIDATE_INT );
			Opt_In_Utils::is_user_allowed_ajax( 'hustle_edit_module', $id );
			$type = trim( filter_input( INPUT_POST, 'type', FILTER_SANITIZE_STRING ) );
			$enabled = trim( filter_input( INPUT_POST, 'enabled', FILTER_VALIDATE_INT ) );
			if ( ! $id || ! $type ) {
				wp_send_json_error( __( 'Invalid Request', Opt_In::TEXT_DOMAIN ) );
			}
			$module = Hustle_Module_Model::instance()->get( $id );
			if ( is_wp_error( $module ) ) {
				wp_send_json_error( __( 'Invalid module', Opt_In::TEXT_DOMAIN ) );
			}
			if ( $module->module_type !== $type && in_array( $type, array( 'popup', 'embedded', 'slidein' ), true ) ) {
				wp_send_json_error( __( 'Invalid environment: %s', Opt_In::TEXT_DOMAIN ), $type );
			}
			$current_state = $module->active;

			if ( $enabled === $current_state ) {
				$result = $module->toggle_state();
			} else {
				$result = true; // all is well
			}

			if ( $result ) {
				wp_send_json_success( __( 'Successful', Opt_In::TEXT_DOMAIN ) );
			} else {
				wp_send_json_error( __( 'Failed', Opt_In::TEXT_DOMAIN ) );
			}
		}

		/**
		 * Toggle module tracking.
		 */
		public function toggle_module_tracking() {
			Opt_In_Utils::validate_ajax_call( 'hustle_toggle_tracking' );
			$id = filter_input( INPUT_POST, 'id', FILTER_VALIDATE_INT );
			Opt_In_Utils::is_user_allowed_ajax( 'hustle_edit_module', $id );
			$enabled = (bool)filter_input( INPUT_POST, 'enabled', FILTER_VALIDATE_INT );
			$types = filter_input( INPUT_POST, 'types', FILTER_SANITIZE_STRING );
			if ( ! $id ) {
				wp_send_json_error( __( 'Invalid Request', Opt_In::TEXT_DOMAIN ) );
			}
			$module = Hustle_Module_Model::instance()->get( $id );
			if ( is_wp_error( $module ) ) {
				wp_send_json_error( __( 'Invalid module', Opt_In::TEXT_DOMAIN ) );
			}
			$current_tracking = $module->get_tracking_types();

			if ( ! is_null( $types ) ) {
				// for Embeds and Social Sharing
				$types = explode( ',', $types );
				$result = $module->update_submitted_tracking_types( $types );

			} else if ( $enabled && !empty( $current_tracking ) || !$enabled && empty( $current_tracking ) ) {
				$result = $module->toggle_type_track_mode( $module->module_type );
			} else {
				$result = true; // all is well
			}

			if ( $result ) {
				wp_send_json_success( __( 'Successful', Opt_In::TEXT_DOMAIN ) );
			} else {
				wp_send_json_error( __( 'Failed', Opt_In::TEXT_DOMAIN ) );
			}
		}

		public function preview_module() {

			$type = filter_input( INPUT_POST, 'type', FILTER_SANITIZE_STRING );

			Hustle_Renderer_Abstract::ajax_load_module();

			wp_send_json_error( __( 'Invalid module type', Opt_In::TEXT_DOMAIN ) );
		}

		/**
		 * Handle getting tracking data from listing
		 */
		public function get_tracking_data() {
			$id = filter_input( INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT );
			Opt_In_Utils::validate_ajax_call( 'module_get_tracking_data' . $id );
			$module = Hustle_Module_Model::instance()->get( $id );
			$data = $module->get_tracking_data( $this->_hustle );

			wp_send_json_success( $data );
		}

		/**
		 * Handle bulk action from listings
		 */
		public function bulk() {
			Opt_In_Utils::validate_ajax_call( 'hustle-bulk-action' );
			$type = filter_input( INPUT_POST, 'type', FILTER_SANITIZE_STRING );
			$hustle = filter_input( INPUT_POST, 'hustle', FILTER_SANITIZE_STRING );
			$ids = isset( $_POST['ids'] )? $_POST['ids']:array();
			if ( ! is_array( $ids ) || empty( $ids ) ) {
				wp_send_json_error( __( 'Failed', Opt_In::TEXT_DOMAIN ) );
			}
			foreach ( $ids as $id ) {
				$id = intval( $id );
				$module = Hustle_Module_Model::instance()->get( $id );
				if ( is_wp_error( $module ) ) {
					continue;
				}
				if ( $module->module_type !== $type && in_array( $type, array( 'popup', 'embedded', 'slidein' ), true ) ) {
					continue;
				}
				switch ( $hustle ) {
					case 'publish':
						$module->activate();
					break;

					case 'unpublish':
						$module->deactivate();
					break;

					case 'clone':
						$module->duplicate_module();
					break;

					case 'delete':
						$module->delete();
					break;

					case 'disable-tracking':
						$module->disable_type_track_mode( $type, true );
					break;

					case 'enable-tracking':
						$module->enable_type_track_mode( $type, true );
					break;

					case 'reset-tracking':
						$tracking = Hustle_Tracking_Model::get_instance();
						$tracking->delete_data( $id );
					break;

					default:
						wp_send_json_error( __( 'Failed', Opt_In::TEXT_DOMAIN ) );
				}
			}
			wp_send_json_success();
		}

		/**
		 * Delete (reset) tracking data
		 *
		 * @since 4.0.0
		 */
		public function module_tracking_reset() {
			Opt_In_Utils::validate_ajax_call( 'hustle_module_tracking_reset' );
			$id = filter_input( INPUT_POST, 'id', FILTER_VALIDATE_INT );
			if ( 0 < $id ) {
				$tracking = Hustle_Tracking_Model::get_instance();
				$tracking->delete_data( $id );
				wp_send_json_success();
			}
			wp_send_json_error();
		}


		public function render_module() {
			Opt_In_Utils::validate_ajax_call( 'hustle_gutenberg_get_module' );

			$shortcode_id = filter_input( INPUT_GET, 'shortcode_id', FILTER_SANITIZE_STRING );
			$module_type = filter_input( INPUT_GET, 'type', FILTER_SANITIZE_STRING );

			if ( ! $shortcode_id  ) {
				wp_send_json_error();
			}

			$enforce_type = ( 'embedded' === $module_type || 'social_sharing' === $module_type ) ? true : false;
			$module = Hustle_Module_Model::instance()->get_by_shortcode( $shortcode_id, $enforce_type );

			if ( is_wp_error( $module ) ) {
				wp_send_json_error();
			}

			if ( Hustle_Module_Model::EMBEDDED_MODULE === $module->module_type || Hustle_Module_Model::SOCIAL_SHARING_MODULE === $module->module_type ) {
				$sub_type = Hustle_Module_Model::SHORTCODE_MODULE;

				// TODO: improve the get_by_shortcode() method so this isn't needed.
				if ( Hustle_Module_Model::SOCIAL_SHARING_MODULE === $module->module_type ) {
					$module = Hustle_Sshare_Model::instance()->get( $module->module_id );
				}
			} else {
				$sub_type = '';
			}
			ob_start();

			$module->display( $sub_type, '', true );

			$html = ob_get_clean();

			$style = '<style type="text/css" class="hustle-module-styles-' . $module->id . '">' . $module->get_decorated()->get_module_styles( $module->module_type ) . '</style>';

			$response = array(
				'data' => array(
					'module_id' => $module->module_id,
					'shortcode_id' => $shortcode_id,
				),
				'html' => $html,
				'style' => $style,
			);

			wp_send_json_success( $response );
		}

		/**
		 * Get the module_id by the shortcode_id provided.
		 * Used by Gutenberg to create blocks.
		 *
		 * @since 3.0.7
		 *
		 * @return void
		 */
		public function get_module_id_by_shortcode() {
			Opt_In_Utils::validate_ajax_call( 'hustle_gutenberg_get_module' );

			$shortcode_id = filter_input( INPUT_GET, 'shortcode_id', FILTER_SANITIZE_STRING );
			$module_type = filter_input( INPUT_GET, 'type', FILTER_SANITIZE_STRING );

			$enforce_type = ( 'embedded' === $module_type || 'social_sharing' === $module_type ) ? true : false;
			$module = Hustle_Module_Model::instance()->get_by_shortcode( $shortcode_id, $enforce_type );
			if ( is_wp_error( $module ) ) {
				wp_send_json_error();
			}
			wp_send_json_success( array( 'module_id' => $module->id ) );
		}

	}

endif;
