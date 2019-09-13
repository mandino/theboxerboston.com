<?php
if ( ! class_exists( 'Hustle_Admin_Page_Abstract' ) ) :
	/**
	 * Class Hustle_Admin_Page_Abstract
	 * @since 4.0.1
	 */
	abstract class Hustle_Admin_Page_Abstract {

		/**
		 * @var Opt_In
		 */
		protected $_hustle;

		protected $page;

		protected $page_template_path;

		protected $page_title;

		protected $page_menu_title;

		protected $page_capability;

		protected $has_wizard_page = false;

		protected $page_edit;

		protected $page_edit_title;

		protected $page_edit_capability;

		protected $page_edit_template_path;

		protected $current_page;

		/**
		 * Page slug.
		 * @since 4.0
		 */
		protected $page_slug;

		public function __construct( Opt_In $hustle ) {

			$this->_hustle = $hustle;

			$this->current_page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING );

			$this->init();

			if ( ! $this->page_menu_title ) {
				$this->page_menu_title = $this->page_title;
			}

			// Add actions and properties required for the pages that have wizards only.
			if ( $this->has_wizard_page ) {
				$this->init_pages_with_wizard();
			}

			add_action( 'admin_menu', array( $this, 'register_admin_menu' ) );
		}

		protected function init() {
			// Extend to setup things on construct.
		}
		
		/**
		 * Register the admin menus.
		 * @since 4.0.1
		 */
		public function register_admin_menu() {

			$this->page_slug = add_submenu_page( 'hustle', $this->page_title, $this->page_menu_title, $this->page_capability, $this->page,  array( $this, 'render_main_page' ) );			

			// This is not used in integrations nor settings pages.
			add_action( 'load-' . $this->page_slug, array( $this, 'run_action_on_page_load' ) );

			if ( $this->has_wizard_page ) {
				add_submenu_page( 'hustle', $this->page_edit_title, $this->page_edit_title, $this->page_edit_capability, $this->page_edit,  array( $this, 'render_edit_page' ) );
			}
		}

		/**
		 * Render the main page.
		 * @since 4.0.1
		 */
		public function render_main_page() {

			$template_args = $this->get_page_template_args();
			$this->_hustle->render( $this->page_template_path, $template_args );
		}

		/**
		 * Method called when the action 'load-' . $this->page_slug runs.
		 *
		 * @since 4.0.0
		 */
		public function run_action_on_page_load() {
			Hustle_Modules_Common_Admin::process_request();
		}

		// ========================================|
		// METHODS FOR PAGES THAT HAVE WIZARD ONLY.
		// ========================================|

		/**
		 * Set up the properties and actions required by pages that have wizard only.
		 * That's popup, slidein, embeds and ssharing listing pages.
		 * 
		 * @since 4.0.1
		 */
		protected function init_pages_with_wizard() {

			$this->page = Hustle_Module_Admin::get_listing_page_by_module_type( $this->module_type );

			$this->page_capability = 'hustle_edit_module';
			
			$this->page_edit = Hustle_Module_Admin::get_wizard_page_by_module_type( $this->module_type );
			
			$this->page_edit_capability = 'hustle_create';

			$this->page_edit_title = sprintf( esc_html__( 'New %s', 'wordpress-popup' ), Opt_In_Utils::get_module_type_display_name( $this->module_type ) );

			if ( ! empty( $this->current_page ) ) {
				if ( $this->current_page === $this->page || $this->current_page === $this->page_edit ) {
					add_action( 'admin_init', array( $this, 'check_if_module_exists' ) );
					add_filter( 'hustle_optin_vars', array( $this, 'register_current_json' ) );
					add_filter( 'submenu_file', array( $this, 'admin_submenu_file' ), 10, 2 );

					add_action( 'admin_footer', array( $this, 'on_admin_footer' ) );
				}
			}
			
			add_action( 'admin_head', array( $this, 'hide_unwanted_submenus' ) );

			// admin-menu-editor compat
			add_action( 'admin_menu_editor-menu_replaced', array( $this, 'hide_unwanted_submenus' ) );
		}

		/**
		 * Get the arguments used when rendering the main page.
		 * 
		 * @since 4.0.1
		 * @return array
		 */
		protected function get_page_template_args() {

			$capability = array(
				'hustle_create' => current_user_can( 'hustle_create' ),
				'hustle_access_emails' => current_user_can( 'hustle_access_emails' ),
			);

			$paged = ! empty( $_GET['paged'] ) ? (int) $_GET['paged'] : 1; //don't use filter_input() here, because of see Hustle_Module_Admin::maybe_remove_paged function

			$modules = Hustle_Module_Collection::instance()->get_all( null, array(
					'module_type' => $this->module_type,
					'page' => $paged,
				), Hustle_Model::ENTRIES_PER_PAGE );
			
			$total_modules = Hustle_Module_Collection::instance()->get_all( null, array( 
					'module_type' => $this->module_type, 
					'count_only' => true 
				) );

			$active_modules = Hustle_Module_Collection::instance()->get_all( true, array( 
					'module_type' => $this->module_type, 
					'count_only' => true 
				) );
			
			return array(
				'total' => $total_modules,
				'active' => $active_modules,
				'modules' => $modules,
				'is_free' => Opt_In_Utils::_is_free(),
				'capability'  => $capability,
				'page' => $this->page,
				'paged' => $paged,
				'entries_per_page' => Hustle_Model::ENTRIES_PER_PAGE,
				'message' => filter_input( INPUT_GET, 'message', FILTER_SANITIZE_STRING ),
				'sui' => Opt_In::get_sui_summary_config( 'sui-summary-sm' ),
			);
		}

		/**
		 * Hide module's edit pages from the submenu on dashboard.
		 * @since 4.0.1
		 */
		public function hide_unwanted_submenus() {
			remove_submenu_page( 'hustle', $this->page_edit );
		}

		/**
		 * Highlight submenu's parent on admin page.
		 *
		 * @since 4.0.1
		 *
		 * @param $submenu_file
		 * @param $parent_file
		 *
		 * @return string
		 */
		public function admin_submenu_file( $submenu_file, $parent_file ) {
			global $plugin_page;

			if ( 'hustle' !== $parent_file ) {
				return $submenu_file;
			}

			if ( $this->page_edit === $plugin_page ) {
				$submenu_file = $this->page;
			}

			return $submenu_file;
		}

		/**
		 * Check whether the requested module exists.
		 * Redirect to the listing page if not.
		 * @since 4.0
		 */
		public function check_if_module_exists() {
			if ( isset( $_GET['page'] ) && $this->page_edit === $_GET['page'] ) { // WPCS: CSRF ok.

				$module_id = filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT );
				$module = Hustle_Module_Model::instance()->get( $module_id );
				if ( is_wp_error( $module ) ) {

					$url = add_query_arg( array(
						'page' => $this->page,
						'message' => 'module-does-not-exists',
					), 'admin.php' );

					wp_safe_redirect( $url );
					exit;
				}
			}
		}

		/**
		 * Add data to the current json array.
		 * 
		 * @since 4.0.1
		 *
		 * @param array $current_array
		 * @return void
		 */
		public function register_current_json( $current_array ) {

			if ( Hustle_Module_Admin::is_edit() && isset( $_GET['page'] ) && $this->page_edit === $_GET['page'] ) {

				$current_module_id = filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT );
				$module = Hustle_Module_Model::instance()->get( $current_module_id );

				if ( ! is_wp_error( $module ) ) {
					$data = $module->get_data();
					$module_metas = $module->get_module_metas_as_array();
					
					$current_array['current'] = array_merge( $module_metas, array(
						'listing_page' => $this->page,
						'wizard_page' => $this->page_edit,
						'section' => Hustle_Module_Admin::get_current_section(),
						'data' => $data,
						'shortcode_id' => $module->get_shortcode_id(),
						)
					);
				}

			} elseif ( $this->page === $_GET['page'] ) { // CSRF: ok.

				$current_array['current'] = array(
					'wizard_page' => $this->page_edit,
					'module_type' => $this->module_type,
				);
			}

			return $current_array;
		}

		/**
		 * Render the module's wizard page.
		 * @since 4.0.1
		 */
		public function render_edit_page() {

			if ( Hustle_Module_Model::SOCIAL_SHARING_MODULE !== $this->module_type ) {
				wp_enqueue_editor();
			}

			$template_args = $this->get_page_edit_template_args();
			$this->_hustle->render( $this->page_edit_template_path, $template_args );
		}

		/**
		 * Get the args for the wizard page.
		 * 
		 * @since 4.0.1
		 * @return array
		 */
		protected function get_page_edit_template_args() {
			
			$module_id = filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT );
			$current_section = Hustle_Module_Admin::get_current_section();
			$module = Hustle_Module_Collection::instance()->return_model_from_id( $module_id );

			return array(
				'section' => ( ! $current_section ) ? 'content' : $current_section,
				'module_id' => $module_id,
				'module' => $module,
				'is_active' => is_object( $module ) ? (bool) $module->active : false,
				'is_optin' => ( 'optin' === $module->module_mode ),
				'is_recaptcha_available' => Hustle_Settings_Admin::is_recaptcha_available(),
			);
		}

		/**
		 * Action on modules' wizard page.
		 * 
		 * @since 4.0.1
		 */
		public function on_admin_footer() {

			// Add Forminator's front styles and scripts for preview.
			if ( defined( 'FORMINATOR_VERSION' ) ) {
				forminator_print_front_styles( FORMINATOR_VERSION );
				forminator_print_front_scripts( FORMINATOR_VERSION );

			}
		}
	}

endif;
