<?php

if ( ! class_exists( 'Hustle_SShare_Admin' ) ) :

	class Hustle_SShare_Admin extends Opt_In {

		/**
		 * Page slug
		 *
		 * @since 4.0.0
		 */
		protected $page_slug;

		public function __construct() {
			add_action( 'admin_init', array( $this, 'check_if_module_exists' ) );
			add_action( 'admin_menu', array( $this, 'register_admin_menu' ) );
			add_action( 'admin_head', array( $this, 'hide_unwanted_submenus' ) );
			add_filter( 'hustle_optin_vars', array( $this, 'register_current_json' ) );
		}

		public function register_admin_menu() {
			// Social Sharings
			$this->page_slug = add_submenu_page( 'hustle', __( 'Social Sharing', Opt_In::TEXT_DOMAIN ) , __( 'Social Sharing', Opt_In::TEXT_DOMAIN ) , 'hustle_edit_module', Hustle_Module_Admin::SOCIAL_SHARING_LISTING_PAGE,  array( $this, 'render_sshare_listing' ) );
			add_submenu_page( 'hustle', __( 'New Social Sharing', Opt_In::TEXT_DOMAIN ) , __( 'New Social Sharing', Opt_In::TEXT_DOMAIN ) , 'hustle_create', Hustle_Module_Admin::SOCIAL_SHARING_WIZARD_PAGE,  array( $this, 'render_sshare_wizard_page' ) );

			add_action( 'load-'.$this->page_slug, array( 'Hustle_Modules_Common_Admin', 'process_request' ) );
		    add_filter( 'load-'.$this->page_slug, array( $this, 'add_action_hooks' ) );
		}

		/**
		 * Removes the submenu entries for content creation
		 *
		 * @since 3.0
		 */
		public function hide_unwanted_submenus() {
			remove_submenu_page( 'hustle', Hustle_Module_Admin::SOCIAL_SHARING_WIZARD_PAGE );
		}

		/**
		 * Renders menu page based on if we already any optin
		 *
		 * @since 3.0
		 */
		public function render_sshare_wizard_page() {
			$module_id = filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT );
			$module = Hustle_Module_Collection::instance()->return_model_from_id( $module_id );
			if ( is_wp_error( $module ) ) {
				return;
			}
			$current_section = Hustle_Module_Admin::get_current_section();
			$this->render( '/admin/sshare/wizard', array(
				'section' => ( ! $current_section ) ? 'services' : $current_section,
				'module_id' => $module_id,
				'module' => $module,
				'widgets_page_url' => get_admin_url( null, 'widgets.php' ),
				'save_nonce' => wp_create_nonce( 'hustle_save_sshare_module' ),

				'is_active' => is_object( $module ) ? (bool) $module->active : false,
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
			if (  isset( $_GET['page'] ) && Hustle_Module_Admin::SOCIAL_SHARING_WIZARD_PAGE === $_GET['page'] ) { // WPCS: CSRF ok.

				$module_id = filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT );
				$module = Hustle_Module_Model::instance()->get( $module_id );
				if ( is_wp_error( $module ) ) {

					$url = add_query_arg( array(
						'page' => Hustle_Module_Admin::SOCIAL_SHARING_LISTING_PAGE,
						'message' => 'module-does-not-exists',
					), 'admin.php' );

					wp_safe_redirect( $url );
					exit;
				}
			}
		}

		/**
		 * Renders Social Sharing listing page
		 *
		 * @since 3.0
		 */
		public function render_sshare_listing() {
			$capability = array(
				'hustle_create' => current_user_can( 'hustle_create' ),
				'hustle_access_emails' => current_user_can( 'hustle_access_emails' ),
			);
			$current_user = wp_get_current_user();
			$new_module = isset( $_GET['module'] ) ? Hustle_SShare_Model::instance()->get( intval( $_GET['module'] ) ) : null;
			$updated_module = isset( $_GET['updated_module'] ) ? Hustle_SShare_Model::instance()->get( intval( $_GET['updated_module'] ) ) : null;
			$types = Hustle_SShare_Model::get_types();
			/**
			 * get
			 */
			$type = 'social_sharing';
			$paged = ! empty( $_GET['paged'] ) ? (int) $_GET['paged'] : 1; //don't use filter_input() here, because of see Hustle_Module_Admin::maybe_remove_paged function
			$args = array(
				'module_type' => $type,
				'page' => $paged,
			);
			$modules = Hustle_Module_Collection::instance()->get_all( null, $args, Hustle_Model::ENTRIES_PER_PAGE );
			$this->render('admin/sshare/listing', array(
				'total' => Hustle_Module_Collection::instance()->get_all( null, array( 'module_type' => $type, 'count_only' => true ) ),
				'active' => Hustle_Module_Collection::instance()->get_all( true, array( 'module_type' => $type, 'count_only' => true ) ),
				'modules' => $modules,
				'new_module' => $new_module,
				'updated_module' => $updated_module,
				'types' => $types,
				'add_new_url' => admin_url( 'admin.php?page=' . Hustle_Module_Admin::SOCIAL_SHARING_WIZARD_PAGE ),
				'user_name' => ucfirst( $current_user->display_name ),
				'is_free' => Opt_In_Utils::_is_free(),
				'capability' => $capability,
				'page' => Hustle_Module_Admin::SOCIAL_SHARING_LISTING_PAGE,
				'paged' => $paged,
				'entries_per_page' => Hustle_Model::ENTRIES_PER_PAGE,
				'message' => filter_input( INPUT_GET, 'message', FILTER_SANITIZE_STRING ),
				'sui' => $this->get_sui_summary_config( 'sui-summary-sm' ),
			));
		}

		private function _is_edit() {
			return  (bool) filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT ) && isset( $_GET['page'] ) && Hustle_Module_Admin::SOCIAL_SHARING_WIZARD_PAGE === $_GET['page'];
		}

		public function register_current_json( $current_array ) {
			if ( Hustle_Module_Admin::is_edit() && isset( $_GET['page'] ) && Hustle_Module_Admin::SOCIAL_SHARING_WIZARD_PAGE === $_GET['page'] ) {
				$ss = Hustle_SShare_Model::instance()->get( filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT ) );
				if ( ! is_wp_error( $ss ) ) {
					$all_ss = Hustle_Module_Collection::instance()->get_all( null, array( 'module_type' => 'social_sharing' ) );
					$total_ss = count( $all_ss );
					$current_section = Hustle_Module_Admin::get_current_section();
					$current_array['current'] = array(
						'listing_page' => Hustle_Module_Admin::SOCIAL_SHARING_LISTING_PAGE,
						'wizard_page' => Hustle_Module_Admin::SOCIAL_SHARING_WIZARD_PAGE,
						'data' => $ss->get_data(),
						'content' => $ss->get_content()->to_array(),
						'design' => $ss->get_design()->to_array(),
						'display' => $ss->get_display()->to_array(),
						'visibility' => $ss->get_visibility()->to_array(),
						//'types' => $ss->get_sshare_display_types()->to_array(),
						'section' => ( ! $current_section ) ? 'services' : $current_section,
						'is_ss_limited' => (int) ( Opt_In_Utils::_is_free() && '-1' === $_GET['id'] && $total_ss >= 3 ),
					);
				}
			} elseif ( Hustle_Module_Admin::SOCIAL_SHARING_LISTING_PAGE === $_GET['page'] ) { // CSRF: ok.
				$current_array['current'] = array( 'wizard_page' => Hustle_Module_Admin::SOCIAL_SHARING_WIZARD_PAGE );
			}

			// backwards compatibility for new counter types from 3.0.3
			if ( isset( $current_array['current']['content'] ) && isset( $current_array['current']['content']['click_counter'] ) ) {
				if ( '1' === $current_array['current']['content']['click_counter'] ) {
					$current_array['current']['content']['click_counter'] = 'click';
				} elseif ( '0' === $current_array['current']['content']['click_counter'] ) {
					$current_array['current']['content']['click_counter'] = 'none';
				}
			}
			return $current_array;
		}

		/**
		 * Common hooks for all screens
		 *
		 * @since 4.0.0
		 */
		public function add_action_hooks() {
			// Filter built-in wpmudev branding script.
			add_filter( 'wpmudev_whitelabel_plugin_pages', array( $this, 'builtin_wpmudev_branding' ) );
		}

		/**
		 * Add more pages to builtin wpmudev branding.
		 *
		 * @since 4.0.0
		 *
		 * @param array $plugin_pages Nextgen pages is not introduced in built in wpmudev branding.
		 *
		 * @return array
		 */
		public function builtin_wpmudev_branding( $plugin_pages ) {
			$plugin_pages[ $this->page_slug ] = array(
				'wpmudev_whitelabel_sui_plugins_footer',
				'wpmudev_whitelabel_sui_plugins_doc_links',
			);
			return $plugin_pages;
		}
	}

endif;
