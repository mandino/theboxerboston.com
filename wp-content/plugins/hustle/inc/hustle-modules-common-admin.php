<?php
if ( ! class_exists( 'Hustle_Modules_Common_Admin' ) ) :

	/**
	 * Class Hustle_Modules_Common_Admin
	 * Handle actions that are common among module types.
	 *
	 * @since 4.0
	 *
	 */
	class Hustle_Modules_Common_Admin {

		/**
		 * Process the current request
		 * Used in:
		 * -Dashboard page.
		 * -Popup listing.
		 * -Slidein listing.
		 * -Embedded listing.
		 * -Social sharing listing.
		 *
		 * @since 4.0
		 */
		//private function process_request() {
		public static function process_request() {

			// Start modifying data.
			if ( ! isset( $_REQUEST['hustle_nonce'] ) ) {
				return;
			}

			$nonce = $_REQUEST['hustle_nonce']; // WPCS: CSRF OK
			if ( ! wp_verify_nonce( $nonce, 'hustle_listing_request' ) ) {
				return;
			}

			$action = $_REQUEST['hustle_action'];

			$id = filter_input( INPUT_POST, 'id', FILTER_VALIDATE_INT );

			if ( ! $id ) {
				return;
			}
			$module = Hustle_Module_Model::instance()->get( $id );
			if ( is_wp_error( $module ) ) {
				return;
			}
			switch ( $action ) {

				case 'delete':
					$module->delete();
					break;

				case 'duplicate':
					if ( ! Hustle_Module_Admin::can_create_new_module( $module->module_type ) ) {
						$url = add_query_arg( array(
							'page' => Hustle_Module_Admin::get_listing_page_by_module_type( $module->module_type ),
							Hustle_Module_Admin::UPGRADE_MODAL_PARAM => 'true',
						), 'admin.php' );
						wp_safe_redirect( $url );
						exit;
					}
					$module->duplicate_module();
					break;

				case 'tracking_reset_data':
					$tracking = Hustle_Tracking_Model::get_instance();
					$tracking->delete_data( $id );
					break;

				default:
					return;
			}
		}

		/**
		 * Create a new module of the provided mode and type.
		 *
		 * @since 4.0
		 *
		 * @param array $data Must contain the Module's 'mode', 'name' and 'type.
		 * @return int|false Module ID if successfully saved. False otherwise.
		 */
		public function create_new( $data ) {

			// Verify it's a valid module type.
			if ( ! in_array( $data['module_type'], array( Hustle_Module_Model::POPUP_MODULE, Hustle_Module_Model::SLIDEIN_MODULE, Hustle_Module_Model::EMBEDDED_MODULE, Hustle_Module_Model::SOCIAL_SHARING_MODULE ), true ) ) {
				return false;
			}

			$is_social_share = ( Hustle_Module_Model::SOCIAL_SHARING_MODULE === $data['module_type'] );

			// Abort if it's not a Social Share module and the mode isn't set.
			if ( ! $is_social_share && ! in_array( $data['module_mode'], array( 'optin', 'informational' ), true ) ) {
				return false;
			}

			if ( ! $is_social_share ) {
				$module = Hustle_Module_Model::instance();
			} else {
				$module = Hustle_SShare_Model::instance();
			}

			// save to modules table
			$module->module_name = sanitize_text_field( $data['module_name'] );
			$module->module_type = $data['module_type'];
			$module->active = 0;
			$module->module_mode = ! $is_social_share ? $data['module_mode'] : '';
			$module->save();

			// Save the new module's meta.
			$this->store_new_module_meta( $module, $data );

			// Activate providers
			$module->activate_providers( $data );

			return $module->id;
		}

		/**
		 * Store the defaults meta when creating a new module.
		 *
		 * @since 4.0
		 *
		 * @param Hustle_Module_Model $module
		 */
		public function store_new_module_meta( Hustle_Module_Model $module, $data ) {

			// All modules types except Social sharing modules. //
			if ( Hustle_Module_Model::SOCIAL_SHARING_MODULE !== $module->module_type ) {
	
				$def_content = apply_filters( 'hustle_module_get_' . Hustle_Module_Model::KEY_CONTENT . '_defaults', $module->get_content()->to_array(), $module, $data );
				$content_data = empty( $data['content'] ) ? $def_content : array_merge( $def_content, $data['content'] );

				$def_emails = apply_filters( 'hustle_module_get_' . Hustle_Module_Model::KEY_EMAILS . '_defaults', $module->get_emails()->to_array(), $module, $data );
				$emails_data = empty( $data['emails'] ) ? $def_emails : array_merge( $def_emails, $data['emails'] );

				$def_design = apply_filters( 'hustle_module_get_' . Hustle_Module_Model::KEY_DESIGN . '_defaults', $module->get_design()->to_array(), $module, $data );
				$design_data = empty( $data['design'] ) ? $def_design : array_merge( $def_design, $data['design'] );

				$def_integrations_settings = apply_filters( 'hustle_module_get_' . Hustle_Module_Model::KEY_INTEGRATIONS_SETTINGS . '_defaults', $module->get_integrations_settings()->to_array(), $module, $data );
				$integrations_settings_data = empty( $data['integrations_settings'] ) ? $def_integrations_settings : array_merge( $def_integrations_settings, $data['integrations_settings'] );

				$def_settings = apply_filters( 'hustle_module_get_' . Hustle_Module_Model::KEY_SETTINGS . '_defaults', $module->get_settings()->to_array(), $module, $data );
				$settings_data = empty( $data['settings'] ) ? $def_settings : array_merge( $def_settings, $data['settings'] );

				// save to meta table
				$module->update_meta( Hustle_Module_Model::KEY_CONTENT, $content_data );
				$module->update_meta( Hustle_Module_Model::KEY_EMAILS, $emails_data );
				$module->update_meta( Hustle_Module_Model::KEY_INTEGRATIONS_SETTINGS, $integrations_settings_data );
				$module->update_meta( Hustle_Module_Model::KEY_DESIGN, $design_data );
				$module->update_meta( Hustle_Module_Model::KEY_SETTINGS, $settings_data );

			} else {

				// Social sharing only. //
				$def_content = apply_filters( 'hustle_module_get_' . Hustle_Module_Model::KEY_CONTENT . '_defaults', $module->get_content()->to_array(), $module, $data );
				$content_data = empty( $data['content'] ) ? $def_content : array_merge( $def_content, $data['content'] );

				$def_design = apply_filters( 'hustle_module_get_' . Hustle_Module_Model::KEY_DESIGN . '_defaults', $module->get_design()->to_array(), $module, $data );
				$design_data = empty( $data['design'] ) ? $def_design : array_merge( $def_design, $data['design'] );

				// save to meta table
				$module->update_meta( Hustle_Module_Model::KEY_CONTENT, $content_data );
				$module->update_meta( Hustle_Module_Model::KEY_DESIGN, $design_data );
			}

			// Embedded and Social sharing only. //
			if ( Hustle_Module_Model::EMBEDDED_MODULE === $module->module_type ||  Hustle_Module_Model::SOCIAL_SHARING_MODULE === $module->module_type ) {

				// Display options.
				$def_display = apply_filters( 'hustle_module_get_' . Hustle_Module_Model::KEY_DISPLAY_OPTIONS . '_defaults', $module->get_display()->to_array(), $module, $data );
				$display_data = empty( $data['display'] ) ? $def_display : array_merge( $def_display, $data['display'] );
				
				// Save Display to meta table.
				$module->update_meta( Hustle_Module_Model::KEY_DISPLAY_OPTIONS, $display_data );
			}

			// For all module types. //

			// Visibility settings.
			$def_visibility = apply_filters( 'hustle_module_get_' . Hustle_Module_Model::KEY_VISIBILITY . '_defaults', $module->get_visibility()->to_array(), $module, $data );
			$visibility_data = empty( $data['visibility'] ) ? $def_visibility : array_merge( $def_visibility, $data['visibility'] );
			$module->update_meta( Hustle_Module_Model::KEY_VISIBILITY, $visibility_data );

			// Shortcode ID. Get a new and unique id.
			$shortcode_id = $module->get_new_shortcode_id( $module->module_name );
			$module->update_meta( Hustle_Module_Model::KEY_SHORTCODE_ID, $shortcode_id );

			// Module's permissions.
			$module->update_meta( Hustle_Module_Model::KEY_MODULE_META_PERMISSIONS, $this->get_new_edit_roles() );
		}

		/**
		 * Get roles for Edit Existing Modules capability
		 *
		 * @since 4.0
		 *
		 * @return array
		 */
		private function get_new_edit_roles() {
			$user = wp_get_current_user();
			$roles = (array) $user->roles;

			$roles_can_create = Hustle_Settings_Admin::get_hustle_settings( 'permission_create' );
			$roles_can_create = $roles_can_create ? (array) $roles_can_create : array();

			$edit_roles = array_intersect( $roles_can_create, $roles );
			return array_values( $edit_roles );
		}
	}

endif;
