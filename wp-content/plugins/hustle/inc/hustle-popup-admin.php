<?php
if ( ! class_exists( 'Hustle_Popup_Admin' ) ) :

	/**
	 * Class Hustle_Popup_Admin
	 */
	class Hustle_Popup_Admin extends Hustle_Admin_Common {

		public function __construct( Opt_In $hustle ) {
			$this->_hustle = $hustle;
			add_action( 'admin_init', array( $this, 'check_if_module_exists' ) );
			add_action( 'admin_menu', array( $this, 'register_admin_menu' ) );
			add_action( 'admin_head', array( $this, 'hide_unwanted_submenus' ) );
			add_filter( 'hustle_optin_vars', array( $this, 'register_current_json' ) );
		}

		/**
		 * Registers admin menu page
		 *
		 * @since 1.0
		 */
		public function register_admin_menu() {
			// Optins
			$this->page_slug = add_submenu_page( 'hustle', __( 'Pop-ups', Opt_In::TEXT_DOMAIN ) , __( 'Pop-ups', Opt_In::TEXT_DOMAIN ) , 'hustle_edit_module', Hustle_Module_Admin::POPUP_LISTING_PAGE,  array( $this, 'render_popup_listing' ) );
			add_submenu_page( 'hustle', __( 'New Pop-up', Opt_In::TEXT_DOMAIN ) , __( 'New Pop-up', Opt_In::TEXT_DOMAIN ) , 'hustle_create', Hustle_Module_Admin::POPUP_WIZARD_PAGE,  array( $this, 'render_popup_wizard_page' ) );
			add_action( 'load-'.$this->page_slug, array( 'Hustle_Modules_Common_Admin', 'process_request' ) );
		    add_filter( 'load-'.$this->page_slug, array( $this, 'add_action_hooks' ) );
		}

		/**
		 * Removes the submenu entries for content creation
		 *
		 * @since 2.0
		 */
		public function hide_unwanted_submenus() {
			remove_submenu_page( 'hustle', Hustle_Module_Admin::POPUP_WIZARD_PAGE );
		}

		public function register_current_json( $current_array ) {
			if ( Hustle_Module_Admin::is_edit() && isset( $_GET['page'] ) && Hustle_Module_Admin::POPUP_WIZARD_PAGE === $_GET['page'] ) {  // WPCS: CSRF ok.
				$module = Hustle_Module_Model::instance()->get( filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT ) );
				if ( ! is_wp_error( $module ) ) {
					$data = $module->get_data();
					$current_array['current'] = array(
						'listing_page' => Hustle_Module_Admin::POPUP_LISTING_PAGE,
						'wizard_page' => Hustle_Module_Admin::POPUP_WIZARD_PAGE,
						'data' => $data,
						'content' => $module->get_content()->to_array(),
						'emails' => $module->get_emails()->to_array(),
						'design' => $module->get_design()->to_array(),
						'integrations' => $module->get_integrations_settings()->to_array(),
						'visibility' => $module->get_visibility()->to_array(),
						'settings' => $module->get_settings()->to_array(),
						'shortcode_id' => $module->get_shortcode_id(),
						'section' => Hustle_Module_Admin::get_current_section(),
						'providers' => $this->_hustle->get_providers(),
					);
				}
				// TODO: show a proper error message or something if the module_id is incorrect.
			} elseif ( Hustle_Module_Admin::POPUP_LISTING_PAGE === $_GET['page'] ) { // CSRF: ok.
				$current_array['current'] = array( 'wizard_page' => Hustle_Module_Admin::POPUP_WIZARD_PAGE );
			}
			return $current_array;
		}

		/**
		 * Renders menu page based on if we already any optin
		 *
		 * @since 1.0
		 */
		public function render_popup_wizard_page() {

			wp_enqueue_editor();
			$module_id = filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT );
			$current_section = Hustle_Module_Admin::get_current_section();
			if ( ! Opt_In_Utils::is_user_allowed( 'hustle_edit_module', $module_id ) ) {
				wp_die( esc_html__( 'Sorry, you are not allowed to access this page.', Opt_In::TEXT_DOMAIN ), 403 );
			}
			$module = $module_id ? Hustle_Module_Model::instance()->get( $module_id ) : $module_id;
			if ( is_wp_error( $module ) ) {
				return;
			}
			$this->_hustle->render( '/admin/popup/wizard', array(
				'section' => ( ! $current_section ) ? 'content' : $current_section,
				'is_edit' => Hustle_Module_Admin::is_edit(),
				'module_id' => $module_id,
				'module' => $module,
				'is_optin' => ( 'optin' === $module->module_mode ),
				'is_active' => is_object( $module ) ? (bool) $module->active : false,
				'providers' => $this->_hustle->get_providers(),
				'animations' => $this->_hustle->get_animations(),
				'countries' => $this->_hustle->get_countries(),
				//'widgets_page_url' => get_admin_url( null, 'widgets.php' ),
				'shortcode_render_nonce' => wp_create_nonce( 'hustle_shortcode_render' ),
				/**
				 * reCaptcha
				 */
				'is_recaptcha_available' => Hustle_Settings_Admin::is_recaptcha_available(),
			));
		}

		/**
		 * Check if using free version then redirect to upgrade page
		 *
		 * @since 3.0
		 */
		public function check_if_module_exists() {
			if (  isset( $_GET['page'] ) && Hustle_Module_Admin::POPUP_WIZARD_PAGE === $_GET['page'] ) { // WPCS: CSRF ok.

				$module_id = filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT );
				$module = Hustle_Module_Model::instance()->get( $module_id );
				if ( is_wp_error( $module ) ) {

					$url = add_query_arg( array(
						'page' => Hustle_Module_Admin::POPUP_LISTING_PAGE,
						'message' => 'module-does-not-exists',
					), 'admin.php' );

					wp_safe_redirect( $url );
					exit;
				}
			}
		}

		/**
		 * Renders Popup listing page
		 *
		 * @since 2.0
		 */
		public function render_popup_listing() {
			$current_user = wp_get_current_user();
			$new_module = isset( $_GET['module'] ) ? Hustle_Module_Model::instance()->get( intval( $_GET['module'] ) ) : null; // WPCS: CSRF ok.
			$updated_module = isset( $_GET['updated_module'] ) ? Hustle_Module_Model::instance()->get( intval( $_GET['updated_module'] ) ) : null; // WPCS: CSRF ok.
			$capability = array(
				'hustle_create' => current_user_can( 'hustle_create' ),
				'hustle_access_emails' => current_user_can( 'hustle_access_emails' ),
			);
			/**
			 * get
			 */
			$type = 'popup';
			$paged = ! empty( $_GET['paged'] ) ? (int) $_GET['paged'] : 1; //don't use filter_input() here, because of see Hustle_Module_Admin::maybe_remove_paged function
			$args = array(
				'module_type' => $type,
				'page' => $paged,
			);
			$modules = Hustle_Module_Collection::instance()->get_all( null, $args, Hustle_Model::ENTRIES_PER_PAGE );
			$this->_hustle->render('admin/popup/listing', array(
				'total' => Hustle_Module_Collection::instance()->get_all( null, array( 'module_type' => $type, 'count_only' => true ) ),
				'active' => Hustle_Module_Collection::instance()->get_all( true, array( 'module_type' => $type, 'count_only' => true ) ),
				'modules' => $modules,
				'new_module' => $new_module,
				'updated_module' => $updated_module,
				'add_new_url' => admin_url( 'admin.php?page=hustle_popup' ),
				'user_name' => ucfirst( $current_user->display_name ),
				'is_free' => Opt_In_Utils::_is_free(),
				'capability' => $capability,
				'page' => Hustle_Module_Admin::POPUP_LISTING_PAGE,
				'paged' => $paged,
				'entries_per_page' => Hustle_Model::ENTRIES_PER_PAGE,
				'message' => filter_input( INPUT_GET, 'message', FILTER_SANITIZE_STRING ),
				'sui' => $this->_hustle->get_sui_summary_config( 'sui-summary-sm' ),
			));
		}
	}

endif;
