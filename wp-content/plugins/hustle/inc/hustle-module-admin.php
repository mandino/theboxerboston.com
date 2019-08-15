<?php
if ( ! class_exists( 'Hustle_Module_Admin' ) ) :

	/**
 * Class Hustle_Module_Admin
 */
	class Hustle_Module_Admin {

		const ADMIN_PAGE = 'hustle';
		const DASHBOARD_PAGE = 'hustle_dashboard';
		const POPUP_LISTING_PAGE = 'hustle_popup_listing';
		const POPUP_WIZARD_PAGE = 'hustle_popup';
		const SLIDEIN_LISTING_PAGE = 'hustle_slidein_listing';
		const SLIDEIN_WIZARD_PAGE = 'hustle_slidein';
		const EMBEDDED_LISTING_PAGE = 'hustle_embedded_listing';
		const EMBEDDED_WIZARD_PAGE = 'hustle_embedded';
		const SOCIAL_SHARING_LISTING_PAGE = 'hustle_sshare_listing';
		const SOCIAL_SHARING_WIZARD_PAGE = 'hustle_sshare';
		const INTEGRATIONS_PAGE = 'hustle_integrations';
		const ENTRIES_PAGE = 'hustle_entries';
		const SETTINGS_PAGE = 'hustle_settings';
		const UPGRADE_MODAL_PARAM = 'requires-pro';

		private $_hustle;

		public function __construct( Opt_In $hustle ) {

			$this->_hustle = $hustle;

			add_action( 'admin_init', array( $this, 'init' ) );
			add_action( 'current_screen', array( $this, 'set_proper_current_screen' ) );

			add_action( 'wp_ajax_hustle_dismiss_notification', array( $this, 'dismiss_notification' ) );

			if ( $this->_is_admin_module() ) {
				add_action( 'admin_enqueue_scripts', array( $this, 'sui_scripts' ), 99 );
				add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts' ), 99 );
				add_action( 'admin_print_styles', array( $this, 'register_styles' ) );
				add_filter( 'admin_body_class', array( $this, 'admin_body_class' ), 99 );
				add_filter( 'user_can_richedit', '__return_true' ); // allow rich editor in
				add_filter( 'tiny_mce_before_init', array( $this, 'set_tinymce_settings' ), 10, 2 );
				add_filter( 'wp_default_editor', array( $this, 'set_editor_to_tinymce' ) );
				add_filter( 'tiny_mce_plugins', array( $this, 'remove_despised_editor_plugins' ) );
				add_filter( 'mce_external_plugins', array( $this, 'remove_all_mce_external_plugins' ), -1 );
				add_filter( 'mce_buttons', array( $this, 'register_buttons' ) );

				$this->load_notices();

				add_filter( 'removable_query_args', array( $this, 'maybe_remove_paged' ) );
			}

			add_filter( 'w3tc_save_options', array( $this, 'filter_w3tc_save_options' ), 10, 1 );
			add_filter( 'plugin_action_links', array( $this, 'add_plugin_action_links' ), 10, 5 );
			add_filter( 'network_admin_plugin_action_links', array( $this, 'add_plugin_action_links' ), 10, 5 );
		}

		/**
		 * Remove paged get attribute if there isn't a module and it's not the first page
		 *
		 * @param array $removable_query_args
		 * @return array
		 */
		public function maybe_remove_paged( $removable_query_args ) {
			$paged = filter_input( INPUT_GET, 'paged', FILTER_VALIDATE_INT );
			$module_type = $this->get_modyle_type_by_page();

			if ( $paged && 1 !== $paged && $module_type ) {
				$args = array(
					'module_type' => $module_type,
					'page' => $paged,
				);
				$modules = Hustle_Module_Collection::instance()->get_all( null, $args, Hustle_Model::ENTRIES_PER_PAGE );
				if ( empty( $modules ) ) {
					$_SERVER['REQUEST_URI'] = remove_query_arg( 'paged' );
					$removable_query_args[] = 'paged';
					unset( $_GET['paged'] );
				}
			}

			return $removable_query_args;
		}

		/**
		* Removing all MCE external plugins which often break our pages
		*
		* @since 3.0.8
		* @param array $external_plugins External plugins
		* @return array
		*/
		public function remove_all_mce_external_plugins( $external_plugins ) {
			remove_all_filters( 'mce_external_plugins' );

			$external_plugins = array();
			$external_plugins['hustle'] = $this->_hustle->get_static_var( 'plugin_url' ) . 'assets/js/vendor/tiny-mce-button.js';
			add_action( 'admin_footer', array( $this, 'add_tinymce_variables' ) );

			return $external_plugins;
		}

		/**
		 * Queue the admin notices.
		 * @since 4.0
		 */
		private function load_notices() {

			// Show upgrade notice only if this is free, and Hustle Pro is not already installed.
			if ( Opt_In_Utils::_is_free() && ! file_exists( WP_PLUGIN_DIR . '/hustle/opt-in.php' ) ) {
				add_action( 'admin_notices', array( $this, 'show_hustle_pro_available_notice' ) );
			}

			if ( Hustle_Migration::check_tracking_needs_migration() ) {
				add_action( 'admin_notices', array( $this, 'show_migrate_tracking_notice' ) );
			}

			if ( /*! Hustle_Settings_Admin::was_notification_dismissed( '40_custom_style_review' ) &&*/ Hustle_Migration::did_hustle_exist() ) {
				add_action( 'admin_notices', array( $this, 'show_review_css_after_migration_notice' ) );
			}

		}

		/**
		 * Display a notice for reviewing the modules' custom css after migration.
		 * @since 4.0
		 */
		public function show_review_css_after_migration_notice() {
			if ( Hustle_Settings_Admin::was_notification_dismissed( '40_custom_style_review' ) ) {
				return;
			}

			$current_user = wp_get_current_user();
			$username = ! empty( $current_user->user_firstname ) ? $current_user->user_firstname : $current_user->user_login;
			?>
			<div class="hustle-notice notice notice-warning is-dismissible" data-name="40_custom_style_review" data-nonce="<?php echo esc_attr( wp_create_nonce( 'hustle_dismiss_notification' ) ); ?>">
				<p>
				<?php printf(
					esc_html__( "Hey %s, we have improved Hustle’s front-end code in this update, which included modifying some CSS classes. Any custom CSS you were using may have been affected. We recommend reviewing the modules (which were using custom CSS) to ensure they don't need any adjustments.", Opt_In::TEXT_DOMAIN ),
					esc_html( $username )
				); ?>
				</p>
				<p><a href="#" class="dismiss-notice"><?php esc_html_e( 'Dismiss this notice', Opt_In::TEXT_DOMAIN ); ?></a></p>
			</div>
			<?php
		}

		/**
		 * Display the notice to migrate tracking and subscriptions data.
		 * @since 4.0
		 */
		public function show_migrate_tracking_notice() {

			if ( ! self::is_show_migrate_tracking_notice() ) {
				return;
			}

			$migrate_url = add_query_arg( array(
				'page' => self::ADMIN_PAGE,
				'show-migrate' => 'true',
			), 'admin.php' );

			$current_user = wp_get_current_user();
			$username = ! empty( $current_user->user_firstname ) ? $current_user->user_firstname : $current_user->user_login;
			?>
			<div id="hustle-tracking-migration-notice" class="notice notice-warning">
				<p><?php printf( esc_html__( 'Hey %s, nice work on updating the Hustle! However, you need to migrate the data of your existing modules such as tracking data and email list manually.', Opt_In::TEXT_DOMAIN ), esc_html( $username ) ); ?></p>
				<p><a href="<?php echo esc_url( $migrate_url ); ?>" class="button-primary"><?php esc_html_e( 'Migrate Data', Opt_In::TEXT_DOMAIN ); ?></a><a href="#" class="hustle-notice-dismiss" style="margin-left:20px;">Dismiss</a></p>
			</div>
			<?php
		}

		public static function is_show_migrate_tracking_notice() {

			if ( ! Hustle_Migration::check_tracking_needs_migration() ) {
				return false;
			}

			$page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING );
			$show_modal = filter_input( INPUT_GET, 'show-migrate', FILTER_VALIDATE_BOOLEAN );

			if ( $show_modal || ( self::ADMIN_PAGE === $page && ! Hustle_Settings_Admin::was_notification_dismissed( Hustle_Dashboard_Admin::MIGRATE_MODAL_NAME ) ) ) {
				return false;
			}

			return true;
		}

		/**
		 * Dismiss the given notification.
		 * @since 4.0
		 */
		public function dismiss_notification() {
			Opt_In_Utils::validate_ajax_call( 'hustle_dismiss_notification' );
			$notification_name = filter_input( INPUT_POST, 'name', FILTER_SANITIZE_STRING );

			if ( Hustle_Dashboard_Admin::MIGRATE_NOTICE_NAME !== $notification_name ) {
				Hustle_Settings_Admin::add_dismissed_notification( $notification_name );
			} else {
				Hustle_Migration::mark_tracking_migration_as_completed();
			}

			wp_send_json_success();
		}

		public function register_buttons( $buttons ) {
			array_unshift( $buttons, 'hustlefields' );
			return $buttons;
		}

		public function add_tinymce_variables() {

			$var_button = array();

			$module = Hustle_Module_Model::instance()->get( filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT ) );
			if ( ! is_wp_error( $module ) ) {

				$saved_fields = $module->get_form_fields();

				if ( is_array( $saved_fields ) && ! empty( $saved_fields ) ) {
					$fields = array();
					$ignored_fields = Hustle_Entry_Model::ignored_fields();

					foreach( $saved_fields as $field_name => $data ) {
						if ( ! in_array( $data['type'], $ignored_fields ) ) {
							$fields[ $field_name ] = $data['label'];
						}
					}

					$available_editors = array( 'success_message', 'email_body' );

					/**
					 * Print JS details for the custom TinyMCE "Insert Variable" button
					 *
					 * @see assets/js/vendor/tiny-mce-button.js
					 */
					$var_button = array(
						'button_title' => __( 'Add Hustle Fields', Opt_In::TEXT_DOMAIN ),
						'fields' => $fields,
						'available_editors' => $available_editors,
					);
				}
			}

			printf(
				'<script>window.hustleData = %s;</script>',
				wp_json_encode( $var_button )
			);
		}

		// force reject minify for hustle js and css
		public function filter_w3tc_save_options( $config ) {

			// reject js
			$defined_rejected_js = $config['new_config']->get( 'minify.reject.files.js' );
			$reject_js = array(
			$this->_hustle->get_static_var( 'plugin_url' ) . 'assets/js/admin.min.js',
			$this->_hustle->get_static_var( 'plugin_url' ) . 'assets/js/ad.js',
			$this->_hustle->get_static_var( 'plugin_url' ) . 'assets/js/front.min.js',
			);
			foreach ( $reject_js as $r_js ) {
				if ( ! in_array( $r_js, $defined_rejected_js, true ) ) {
					array_push( $defined_rejected_js, $r_js );
				}
			}
			$config['new_config']->set( 'minify.reject.files.js', $defined_rejected_js );

			// reject css
			$defined_rejected_css = $config['new_config']->get( 'minify.reject.files.css' );
			$reject_css = array(
				$this->_hustle->get_static_var( 'plugin_url' ) . 'assets/css/front.min.css',
			);
			foreach ( $reject_css as $r_css ) {
				if ( ! in_array( $r_css, $defined_rejected_css, true ) ) {
					array_push( $defined_rejected_css, $r_css );
				}
			}
			$config['new_config']->set( 'minify.reject.files.css', $defined_rejected_css );

			return $config;
		}

		/**
	 * Add Gravity Form MCE button to our admin pages
	 *
	 * @since 3.0.8
	 * @param bool $bool
	 * @return boolean
	 */
		public function add_gravity_mce_button( $bool ) {
			return true;
		}

		/**
	 * Removes unnecessary editor plugins
	 *
	 * @param $plugins
	 * @return mixed
	 */
		public function remove_despised_editor_plugins( $plugins ) {
			$k = array_search( 'fullscreen', $plugins, true );
			if ( false !== $k ) {
				unset( $plugins[ $k ] );
			}
			$plugins[] = 'paste';
			return $plugins;
		}

		/**
	 * Sets default editor to tinymce for opt-in admin
	 *
	 * @param $editor_type
	 * @return string
	 */
		public function set_editor_to_tinymce( $editor_type ) {
			return 'tinymce';
		}

		/**
	 * Inits admin
	 *
	 * @since 3.0
	 */
		public function init() {
			$this->add_privacy_message();
			$this->export();
		}

		/**
	 *
	 * @since 3.0.7
	 * @param array $settings Display settings
	 * @param string $type posts|pages|tags|categories|{cpt}
	 * @return array
	 */
		private function get_conditions_ids( $settings, $type ) {
			$ids = array();
			if ( ! empty( $settings['conditions'] ) ) {
				foreach ( $settings['conditions'] as $conditions ) {
					if ( ! empty( $conditions[ $type ] )
						&& ( ! empty( $conditions[ $type ][ $type ] )
						|| ! empty( $conditions[ $type ]['selected_cpts'] ) ) ) {
						$new_ids = ! empty( $conditions[ $type ][ $type ] )
						? $conditions[ $type ][ $type ]
						: $conditions[ $type ]['selected_cpts'];

						$ids = array_merge( $ids, $new_ids );
					}
				}
			}

			return array_unique( $ids );
		}


		/**
		 * Register scripts for the admin page
		 *
		 * @since 1.0
		 */
		public function register_scripts( $page_slug ) {

			/**
			 * Register popup requirements
			 */
			wp_enqueue_script( 'thickbox' );
			wp_enqueue_media();
			wp_enqueue_script( 'media-upload' );
			wp_enqueue_script( 'jquery-ui-sortable' );

			wp_register_script(
				'optin_admin_ace',
				$this->_hustle->get_static_var( 'plugin_url' ) . 'assets/js/vendor/ace/ace.js',
				array(),
				$this->_hustle->get_const_var( 'VERSION' ),
				true
			);
			wp_register_script(
				'optin_admin_fitie',
				$this->_hustle->get_static_var( 'plugin_url' ) . 'assets/js/vendor/fitie/fitie.js',
				array(),
				$this->_hustle->get_const_var( 'VERSION' ),
				true
			);

			wp_enqueue_script( 'optin_admin_ace' );
			wp_enqueue_script( 'optin_admin_popup' );
			wp_enqueue_script( 'optin_admin_select2' );

			wp_enqueue_script( 'optin_admin_fitie' );
			add_filter( 'script_loader_tag', array( $this, 'handle_specific_script' ), 10, 2 );
			add_filter( 'style_loader_tag', array( $this, 'handle_specific_style' ), 10, 2 );

			$is_edit = self::is_edit();
			$post_ids = array();
			$page_ids = array();
			$tag_ids = array();
			$cat_ids = array();
			$tags = array();
			$cats = array();
			if ( $is_edit ) {
				$module = Hustle_Module_Model::instance()->get( filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT ) );
				if ( ! is_wp_error( $module ) ) {
					$settings = $module->get_visibility()->to_array();

					$post_ids = $this->get_conditions_ids( $settings, 'posts' );
					$page_ids = $this->get_conditions_ids( $settings, 'pages' );
					$tag_ids = $this->get_conditions_ids( $settings, 'tags' );
					$cat_ids = $this->get_conditions_ids( $settings, 'categories' );
				}
			}

			if ( $tag_ids ) {
				$tags = array_map( array( $this, 'terms_to_select2_data' ), get_categories( array(
					'hide_empty' => false,
					'include' => $tag_ids,
					'taxonomy' => 'post_tag',
				)));
			}

			if ( $cat_ids ) {
				$cats = array_map( array( $this, 'terms_to_select2_data' ), get_categories( array(
					'include' => $cat_ids,
					'hide_empty' => false,
				)));
			}

			$posts = $this->get_select2_data( 'post', $post_ids );

			/**
		 * Add all posts
		 */
			$all_posts = new stdClass();
			$all_posts->id = 'all';
			$all_posts->text = __( 'All Posts' );
			array_unshift( $posts, $all_posts );

			$pages = $this->get_select2_data( 'page', $page_ids );

			/**
		 * Add all pages
		 */
			$all_pages = new stdClass();
			$all_pages->id = 'all';
			$all_pages->text = __( 'All Pages' );
			array_unshift( $pages, $all_pages );

			/**
		 * Add all custom post types
		 */
			$post_types = array();
			$cpts = get_post_types( array(
				'public'   => true,
				'_builtin' => false,
			), 'objects' );
			foreach ( $cpts as $cpt ) {

				// skip ms_invoice
				if ( 'ms_invoice' === $cpt->name ) {
					continue;
				}
				if ( $is_edit ) {
					$cpt_ids = $this->get_conditions_ids( $settings, $cpt->label );
				} else {
					$cpt_ids = array();
				}

				$cpt_array['name'] = $cpt->name;
				$cpt_array['label'] = $cpt->label;
				$cpt_array['data'] = $this->get_select2_data( $cpt->name, $cpt_ids );

				// all posts under this custom post type
				$all_cpt_posts = new stdClass();
				$all_cpt_posts->id = 'all';
				$all_cpt_posts->text = ! empty( $cpt->labels ) && ! empty( $cpt->labels->all_items )
					? $cpt->labels->all_items : __( 'All Items', Opt_In::TEXT_DOMAIN );
				array_unshift( $cpt_array['data'], $all_cpt_posts );

				$post_types[ $cpt->name ] = $cpt_array;
			}

			$optin_vars = array(
				'social_platforms' => Opt_In_Utils::get_social_platform_names(),
				'social_platforms_with_endpoints' => Hustle_Sshare_Model::get_sharing_endpoints(),
				'social_platforms_with_api' => Hustle_Sshare_Model::get_networks_counter_endpoint(),
				'module_name' => array(
					'popup'           => __( 'Popup', Opt_In::TEXT_DOMAIN ),
					'slidein'         => __( 'Slide-in', Opt_In::TEXT_DOMAIN ),
					'embedded'        => __( 'Embed', Opt_In::TEXT_DOMAIN ),
					'social_sharing'  => __( 'Social Sharing', Opt_In::TEXT_DOMAIN ),
				),
				'module_page' => array(
					'popup'           => self::POPUP_LISTING_PAGE,
					'slidein'         => self::SLIDEIN_LISTING_PAGE,
					'embedded'        => self::EMBEDDED_LISTING_PAGE,
					'social_sharing'  => self::SOCIAL_SHARING_LISTING_PAGE,
				),
				'labels' => array(
					'submissions' => __( '%d Conversions', Opt_In::TEXT_DOMAIN ),
					'views' => __( '%d Views', Opt_In::TEXT_DOMAIN ),
				),
				'messages' => array(
					'settings_rows_updated' => __( ' number of IPs removed from database successfully.', Opt_In::TEXT_DOMAIN ),
					'settings_saved' => __( 'Settings saved.' , Opt_In::TEXT_DOMAIN ),
					'dont_navigate_away' => __( 'Changes are not saved, are you sure you want to navigate away?', Opt_In::TEXT_DOMAIN ),
					'ok' => __( 'Ok', Opt_In::TEXT_DOMAIN ),
					'something_went_wrong' => '<label class="wpmudev-label--notice"><span>' . __( 'Something went wrong. Please try again.', Opt_In::TEXT_DOMAIN ) . '</span></label>',
					// Used in visibility condtitions. Maybe can be removed
					// LEIGH: No we can't remove this because we need to show module type(name) :)
					// Well, fine...
					'settings' => array(
						'popup'           => __( 'popup', Opt_In::TEXT_DOMAIN ),
						'slide_in'        => __( 'slide in', Opt_In::TEXT_DOMAIN ),
						'after_content'   => __( 'after content', Opt_In::TEXT_DOMAIN ),
						'floating_social' => __( 'floating social', Opt_In::TEXT_DOMAIN ),
					),
					'conditions' => array(
						'visitor_logged_in'           => __( "Visitor's logged in status", Opt_In::TEXT_DOMAIN ),
						'shown_less_than'             => __( 'Number of times visitor has seen', Opt_In::TEXT_DOMAIN ),
						'only_on_mobile'              => __( "Visitor's Device", Opt_In::TEXT_DOMAIN ),
						'from_specific_ref'           => __( 'Referrer', Opt_In::TEXT_DOMAIN ),
						'from_search_engine'          => __( 'Source of Arrival', Opt_In::TEXT_DOMAIN ),
						'on_specific_url'             => __( 'Specific URL', Opt_In::TEXT_DOMAIN ),
						'visitor_has_never_commented' => __( 'Visitor Commented Before', Opt_In::TEXT_DOMAIN ),
						'not_in_a_country'            => __( "Visitor's Country", Opt_In::TEXT_DOMAIN ),

						// OLD
						'only_on_not_found'      => __( '404 page', Opt_In::TEXT_DOMAIN ),
						'visitor_not_logged_in'  => __( 'Visitor not logged in', Opt_In::TEXT_DOMAIN ),
						'not_on_mobile'          => __( 'Not on mobile devices', Opt_In::TEXT_DOMAIN ),
						'not_from_specific_ref'  => __( 'Not from a specific referrer', Opt_In::TEXT_DOMAIN ),
						'not_from_internal_link' => __( 'Not from an internal link', Opt_In::TEXT_DOMAIN ),
						'not_on_specific_url'    => __( 'Not on specific URL', Opt_In::TEXT_DOMAIN ),
						'visitor_has_commented'  => __( 'Visitor has commented before', Opt_In::TEXT_DOMAIN ),
						'in_a_country' => __( 'In a specific Country', Opt_In::TEXT_DOMAIN ),
						'posts' => __( 'Posts', Opt_In::TEXT_DOMAIN ),
						'pages' => __( 'Pages', Opt_In::TEXT_DOMAIN ),
						'categories' => __( 'Categories', Opt_In::TEXT_DOMAIN ),
						'tags' => __( 'Tags', Opt_In::TEXT_DOMAIN ),
					),
					'condition_labels' => array(
						'only_on_not_found' => __( 'Only on 404 page', Opt_In::TEXT_DOMAIN ),
						'visitor_logged_in' => __( 'Only when visitor has logged in', Opt_In::TEXT_DOMAIN ),
						'visitor_not_logged_in' => __( 'Only when visitor has not logged in', Opt_In::TEXT_DOMAIN ),
						'shown_less_than' => __( '{type_name} shown less than a certain times', Opt_In::TEXT_DOMAIN ),
						'mobile_only' => __( 'Mobile only', Opt_In::TEXT_DOMAIN ),
						'desktop_only' => __( 'Desktop only', Opt_In::TEXT_DOMAIN ),
						'from_specific_ref' => __( 'From a specific referrer', Opt_In::TEXT_DOMAIN ),
						'not_from_specific_ref' => __( 'Not from a specific referrer', Opt_In::TEXT_DOMAIN ),
						'not_from_internal_link' => __( 'Not from an internal link', Opt_In::TEXT_DOMAIN ),
						'from_search_engine' => __( 'From a search engine', Opt_In::TEXT_DOMAIN ),
						'any_conditions' => __( 'Any with {number} conditions', Opt_In::TEXT_DOMAIN ),
						'on_specific_url' => __( 'On specific URLs', Opt_In::TEXT_DOMAIN ),
						'not_on_specific_url' => __( 'Not on specific URLs', Opt_In::TEXT_DOMAIN ),
						'visitor_has_commented' => __( 'Visitor has commented before', Opt_In::TEXT_DOMAIN ),
						'visitor_has_never_commented' => __( 'Visitor has never commented', Opt_In::TEXT_DOMAIN ),
						'in_a_country' => __( 'In specific countries', Opt_In::TEXT_DOMAIN ),
						'not_in_a_country' => __( 'Not in specific countries', Opt_In::TEXT_DOMAIN ),
						'posts' => __( 'On certain posts', Opt_In::TEXT_DOMAIN ),
						'all_posts' => __( 'All posts', Opt_In::TEXT_DOMAIN ),
						'number_views' => '< {number}',
						'any' => __( 'Any', Opt_In::TEXT_DOMAIN ),
						'all' => __( 'All', Opt_In::TEXT_DOMAIN ),
						'no' => __( 'No', Opt_In::TEXT_DOMAIN ),
						'none' => __( 'None', Opt_In::TEXT_DOMAIN ),
						'true' => __( 'True', Opt_In::TEXT_DOMAIN ),
						'false' => __( 'False', Opt_In::TEXT_DOMAIN ),
						'logged_in' => __( 'Logged in', Opt_In::TEXT_DOMAIN ),
						'logged_out' => __( 'Logged out', Opt_In::TEXT_DOMAIN ),
						'only_these' => __( 'Only {number}', Opt_In::TEXT_DOMAIN ),
						'except_these' => __( 'Any except {number}', Opt_In::TEXT_DOMAIN ),
						'except_these_countries' => __( 'Any except {number}', Opt_In::TEXT_DOMAIN ),
						'only_on_these_countries' => __( 'Only {number} countries', Opt_In::TEXT_DOMAIN ),
						'except_these_refs' => __( 'Any except {number} referrer', Opt_In::TEXT_DOMAIN ),
						'only_on_these_refs' => __( 'From {number} referrer', Opt_In::TEXT_DOMAIN ),
						'all_urls' => __( 'All URLs', Opt_In::TEXT_DOMAIN ),
						'except_these_urls' => __( 'All URLs except {number}', Opt_In::TEXT_DOMAIN ),
						'only_on_these_urls' => __( 'Only {number} URLs', Opt_In::TEXT_DOMAIN ),
						'no_posts' => __( 'No posts', Opt_In::TEXT_DOMAIN ),
						'only_on_these_posts' => __( 'Only {number} posts', Opt_In::TEXT_DOMAIN ),
						'number_posts' => __( '{number} posts', Opt_In::TEXT_DOMAIN ),
						'except_these_posts' => __( 'All posts except {number}', Opt_In::TEXT_DOMAIN ),
						'pages' => __( 'On certain pages', Opt_In::TEXT_DOMAIN ),
						'all_pages' => __( 'All pages', Opt_In::TEXT_DOMAIN ),
						'no_pages' => __( 'No pages', Opt_In::TEXT_DOMAIN ),
						'only_on_these_pages' => __( 'Only {number} pages', Opt_In::TEXT_DOMAIN ),
						'number_pages' => __( '{number} pages', Opt_In::TEXT_DOMAIN ),
						'except_these_pages' => __( 'All pages except {number}', Opt_In::TEXT_DOMAIN ),
						'categories' => __( 'On certain categories', Opt_In::TEXT_DOMAIN ),
						'all_categories' => __( 'All categories', Opt_In::TEXT_DOMAIN ),
						'no_categories' => __( 'No categories', Opt_In::TEXT_DOMAIN ),
						'only_on_these_categories' => __( 'Only {number} categories', Opt_In::TEXT_DOMAIN ),
						'number_categories' => __( '{number} categories', Opt_In::TEXT_DOMAIN ),
						'except_these_categories' => __( 'All categories except {number}', Opt_In::TEXT_DOMAIN ),
						'tags' => __( 'On certain tags', Opt_In::TEXT_DOMAIN ),
						'all_tags' => __( 'All tags', Opt_In::TEXT_DOMAIN ),
						'no_tags' => __( 'No tags', Opt_In::TEXT_DOMAIN ),
						'only_on_these_tags' => __( 'Only {number} tags', Opt_In::TEXT_DOMAIN ),
						'number_tags' => __( '{number} tags', Opt_In::TEXT_DOMAIN ),
						'except_these_tags' => __( 'All tags except {number}', Opt_In::TEXT_DOMAIN ),
						'everywhere' => __( 'Show everywhere', Opt_In::TEXT_DOMAIN ),
					),
					'conditions_body' => array(
						'only_on_not_found' => __( 'Shows the {type_name} on the 404 page.', Opt_In::TEXT_DOMAIN ),
						'visitor_has_commented' => __( 'Shows the {type_name} if the user has already left a comment. You may want to combine this condition with either "Visitor is logged in" or "Visitor is not logged in".', Opt_In::TEXT_DOMAIN ),
						'visitor_has_never_commented' => __( 'Shows the {type_name} if the user has never left a comment. You may want to combine this condition with either "Visitor is logged in" or "Visitor is not logged in".', Opt_In::TEXT_DOMAIN ),
						'from_search_engine' => __( 'Shows the {type_name} if the user arrived via a search engine.', Opt_In::TEXT_DOMAIN ),
						'not_from_internal_link' => __( 'Shows the {type_name} if the user did not arrive on this page via another page on your site.', Opt_In::TEXT_DOMAIN ),
						'not_on_mobile' => __( 'Shows the {type_name} to visitors that are using a normal computer or laptop (i.e. not a Phone or Tablet).', Opt_In::TEXT_DOMAIN ),
						'only_on_mobile' => __( '<label class="wph-label--alt">Shows the {type_name} to visitors that are using a mobile device (Phone or Tablet).</label>', Opt_In::TEXT_DOMAIN ),
						'visitor_not_logged_in' => __( '<label class="wph-label--alt">Shows the {type_name} if the user is not logged in to your site.</label>', Opt_In::TEXT_DOMAIN ),
						'visitor_logged_in' => __( '<label class="wph-label--alt">Shows the {type_name} if the user is logged in to your site.</label>', Opt_In::TEXT_DOMAIN ),
					),
					'form_fields' => array(
						'errors' => array(
							'no_fileds_info' => '<div class="sui-notice"><p>' . __( 'You don\'t have any {field_type} field in your opt-in form.', Opt_In::TEXT_DOMAIN ) . '</p></div>',
							'custom_field_not_supported' => __( 'Custom fields are not supported by the active provider', Opt_In::TEXT_DOMAIN ),
						),
						'label' => array(
							'placeholder' => __( 'Enter placeholder here', Opt_In::TEXT_DOMAIN ),
							'name_label' => __( 'Name', Opt_In::TEXT_DOMAIN ),
							'name_placeholder' => __( 'E.g. John', Opt_In::TEXT_DOMAIN ),
							'email_label' => __( 'Email Address', Opt_In::TEXT_DOMAIN ),
							'enail_placeholder' => __( 'E.g. john@doe.com', Opt_In::TEXT_DOMAIN ),
							'phone_label' => __( 'Phone Number', Opt_In::TEXT_DOMAIN ),
							'phone_placeholder' => __( 'E.g. +1 300 400 500', Opt_In::TEXT_DOMAIN ),
							'address_label' => __( 'Address', Opt_In::TEXT_DOMAIN ),
							'address_placeholder' => '',
							'url_label' => __( 'Website', Opt_In::TEXT_DOMAIN ),
							'url_placeholder' => __( 'E.g. https://example.com', Opt_In::TEXT_DOMAIN ),
							'text_label' => __( 'Text', Opt_In::TEXT_DOMAIN ),
							'text_placeholder' => __( 'E.g. Enter your nick name', Opt_In::TEXT_DOMAIN ),
							'number_label' => __( 'Number', Opt_In::TEXT_DOMAIN ),
							'number_placeholder' => __( 'E.g. 1', Opt_In::TEXT_DOMAIN ),
							'datepicker_label' => __( 'Date', Opt_In::TEXT_DOMAIN ),
							'datepicker_placeholder' => __( 'Choose date', Opt_In::TEXT_DOMAIN ),
							'timepicker_label' => __( 'Time', Opt_In::TEXT_DOMAIN ),
							'timepicker_placeholder' => '',
							'recaptcha_label' => 'reCAPTCHA',
							'recaptcha_placeholder' => '',
							'gdpr_label' => __( 'GDPR', Opt_In::TEXT_DOMAIN ),
							'gdpr_placeholder' => '',
						),
						'gdpr_message' => sprintf( __( 'I\'ve read and accept the %1$sterms & conditions%2$s', Opt_In::TEXT_DOMAIN ), '<a href="#">', '</a>' ),
					),
					'media_uploader' => array(
						'select_or_upload' => __( 'Select or Upload Image', Opt_In::TEXT_DOMAIN ),
						'use_this_image' => __( 'Use this image', Opt_In::TEXT_DOMAIN ),
					),
					'dashboard' => array(
						'not_enough_data' => __( 'There is no enough data yet, please try again later.', Opt_In::TEXT_DOMAIN ),
					),
					'commons' => array(
						'published' => __( 'Published', Opt_In::TEXT_DOMAIN ),
						'draft' => __( 'Draft', Opt_In::TEXT_DOMAIN ),
						'unpublish' => __( 'Unpublish', Opt_In::TEXT_DOMAIN ),
						'save_changes' => __( 'Save changes', Opt_In::TEXT_DOMAIN ),
						'save_draft' => __( 'Save draft', Opt_In::TEXT_DOMAIN ),
						'publish' => __( 'Publish', Opt_In::TEXT_DOMAIN ),
						'dismiss' => __( 'Dismiss', Opt_In::TEXT_DOMAIN ),
						//'never_see_link_text' => __( 'Never see this message again.', Opt_In::TEXT_DOMAIN ),
						'module_created' => __( '{type_name} created successfully. Get started by adding content to your new {type_name} below.', Opt_In::TEXT_DOMAIN ),
						'new_integration' => __( "You're successfully connected your {provider} account and you need to Save this configuration.", Opt_In::TEXT_DOMAIN ),
						'tracking_enabled' => sprintf( __( 'Tracking is enabled on %s', Opt_In::TEXT_DOMAIN ), '<strong>{module-name}</strong>' ),
						'tracking_disabled' => sprintf( __( 'Tracking is disabled on %s', Opt_In::TEXT_DOMAIN ), '<strong>{module-name}</strong>' ),
					),
				),
				'url' => get_home_url(),
				'includes_url' => includes_url(),
				'palettes' => $this->_hustle->get_palettes(),
				'preview_image' => '',
				'cats' => $cats,
				'tags' => $tags,
				'posts' => $posts,
				'post_types' => Opt_In_Utils::get_post_types(),
				'pages' => $pages,
				'is_edit' => self::is_edit(),
				'is_new' => self::is_new(),
				'new_integration' => self::get_new_integrated_provider(),
				'current' => array(),
				'is_admin' => (int) is_admin(),
				'providers_action_nonce' => wp_create_nonce( 'hustle_provider_action' ),
				'fetching_list' => __( 'Fetching integration list…', Opt_In::TEXT_DOMAIN ),
				'daterangepicker' => array(
					'daysOfWeek' => Opt_In_Utils::get_short_days_names(),
					'monthNames' => Opt_In_Utils::get_months_names(),
				),
			);

			$ap_vars = array(
			'url' => get_home_url(),
			'includes_url' => includes_url(),
			);

			$optin_vars['countries'] = $this->_hustle->get_countries();
			//$optin_vars['animations'] = $this->_hustle->get_animations();
			$optin_vars['providers'] = $this->_hustle->get_providers();

			$optin_vars = apply_filters( 'hustle_optin_vars', $optin_vars );

			$optin_vars['is_free'] = (int) Opt_In_Utils::_is_free();

			$page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING );
			if ( 'hustle' === $page ) {
				wp_enqueue_script( 'jquery-sortable' );
			}
			if ( !is_null( $page ) && 'hustle' !== $page ) {
				wp_enqueue_script( 'wp-color-picker-alpha', $this->_hustle->get_static_var( 'plugin_url' ) . 'assets/js/vendor/wp-color-picker-alpha.min.js', array( 'wp-color-picker' ), '1.2.2', true );
			}
			if ( 'hustle_entries' === $page ) {
				$this->enqueue_entries_scripts();
			}
			wp_register_script(
				'optin_admin_scripts',
				$this->_hustle->get_static_var( 'plugin_url' ) . 'assets/js/admin.min.js',
				array( 'jquery', 'backbone', 'jquery-effects-core' ),
				$this->_hustle->get_const_var( 'VERSION' ),
				true
			);
			wp_localize_script( 'optin_admin_scripts', 'optin_vars', $optin_vars );
			wp_enqueue_script( 'optin_admin_scripts' );

			$is_page_with_preview = ! preg_match( '/hustle_(integrations|entries|settings)/', $page_slug );
			if ( $is_page_with_preview ) {
				Hustle_Module_Front::maybe_add_recaptcha_script();
				Hustle_Module_Front::add_hui_scripts( $this->_hustle );
			}
		}

		/**
		 * Custom scripts that only used on submissions page
		 *
		 * @since 4.0
		 */
		public function enqueue_entries_scripts() {
			wp_enqueue_script( 'hustle-entries-moment',
							   $this->_hustle->get_static_var( 'plugin_url' ) . 'assets/js/vendor/moment.min.js',
							   array( 'jquery' ),
							   '4.0',
							   true );
			wp_enqueue_script( 'hustle-entries-datepicker-range',
							   $this->_hustle->get_static_var( 'plugin_url' ) . 'assets/js/vendor/daterangepicker.min.js',
							   array( 'hustle-entries-moment' ),
							   '4.0',
							   true );
			wp_enqueue_style( 'hustle-entries-datepicker-range',
							  $this->_hustle->get_static_var( 'plugin_url' ) . 'assets/css/daterangepicker.min.css',
							  array(),
							  '4.0' );

			// use inline script to allow hooking into this
			$daterangepicker_ranges
				= sprintf(
				"
				var hustle_entries_datepicker_ranges = {
					'%s': [moment(), moment()],
					'%s': [moment().subtract(1,'days'), moment().subtract(1,'days')],
					'%s': [moment().subtract(6,'days'), moment()],
					'%s': [moment().subtract(29,'days'), moment()],
					'%s': [moment().startOf('month'), moment().endOf('month')],
					'%s': [moment().subtract(1,'month').startOf('month'), moment().subtract(1,'month').endOf('month')]
				};",
				__( 'Today', Opt_In::TEXT_DOMAIN ),
				__( 'Yesterday', Opt_In::TEXT_DOMAIN ),
				__( 'Last 7 Days', Opt_In::TEXT_DOMAIN ),
				__( 'Last 30 Days', Opt_In::TEXT_DOMAIN ),
				__( 'This Month', Opt_In::TEXT_DOMAIN ),
				__( 'Last Month', Opt_In::TEXT_DOMAIN )
			);

			/**
			 * Filter ranges to be used on submissions date range
			 *
			 * @since 4.0
			 *
			 * @param string $daterangepicker_ranges
			 */
			$daterangepicker_ranges = apply_filters( 'hustle_entries_datepicker_ranges', $daterangepicker_ranges );

			wp_add_inline_script( 'hustle-entries-datepicker-range', $daterangepicker_ranges );

		}

		/**
		 * Register shared-ui scripts
		 *
		 * @since 4.0.0
		 */
		public function sui_scripts() {

			$sanitize_version = str_replace( '.', '-', HUSTLE_SUI_VERSION );
			$sui_body_class   = "sui-$sanitize_version";

			wp_enqueue_script(
				'sui-scripts',
				$this->_hustle->get_static_var( 'plugin_url' ) . 'assets/js/shared-ui.min.js',
				array( 'jquery' ),
				$sui_body_class,
				true
			);

			wp_enqueue_script(
				'chartjs',
				$this->_hustle->get_static_var( 'plugin_url' ) . 'assets/js/vendor/chartjs/Chart.bundle.min.js',
				'2.7.2',
				true
			);
		}

		/**
	 * Is the admin page being viewed in edit mode
	 *
	 * @since 1.0.0.
	 *
	 * @return bool
	 */
		public static function is_edit() {
			return  (bool) filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT );
		}

		/**
	 * Is the admin page being viewed in new mode
	 *
	 * @since 4.0
	 *
	 * @return bool
	 */
		public static function is_new() {
			return filter_input( INPUT_GET, 'new', FILTER_VALIDATE_BOOLEAN );
		}

		/**
		 * Get new integrated provider
		 *
		 * @return string
		 */
		public static function get_new_integrated_provider() {
			$provider = '';
			$message = filter_input ( INPUT_GET, 'message', FILTER_SANITIZE_STRING );

			if ( 'hubspot_new_integration' === $message ) {
				$provider = 'Hubspot';
			} elseif ( 'constant_contact_new_integration' === $message ) {
				$provider = 'ConstantContact';
			}

			return $provider;
		}

		/**
	 * Determine what admin section for Pop-up module
	 *
     * @since 3.0.0.
     *
	 * @param boolean/string $default Default value.
	 *
	 * @return mixed, string or boolean
	 */
		public static function get_current_section( $default = false ) {
			$section = filter_input( INPUT_GET, 'section', FILTER_SANITIZE_STRING );
			return ( is_null( $section ) || empty( $section ) )
			? $default
			: $section;
		}

		/**
	 * Handling specific scripts for each scenario
	 *
	 */
		public function handle_specific_script( $tag, $handle ) {
			if ( 'optin_admin_fitie' === $handle ) {
				$tag = "<!--[if IE]>$tag<![endif]-->";
			}
			return $tag;
		}

		/**
	 * Handling specific style for each scenario
	 *
	 */
		public function handle_specific_style( $tag, $handle ) {
			if ( 'hustle_admin_ie' === $handle ) {
				$tag = '<!--[if IE]>'. $tag .'<![endif]-->';
			}
			return $tag;
		}

		public function set_proper_current_screen( $current ) {
			global $current_screen;
			if ( ! Opt_In_Utils::_is_free() ) {
				$current_screen->id = Opt_In_Utils::clean_current_screen( $current_screen->id );
			}
		}

		/**
	 * Registers styles for the admin
	 *
	 *
	 */
		public function register_styles( $page_slug ) {

			$sanitize_version = str_replace( '.', '-', HUSTLE_SUI_VERSION );
			$sui_body_class   = "sui-$sanitize_version";

			wp_enqueue_style( 'thickbox' );

			wp_register_style(
				'hstl-roboto',
				'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i',
				array(),
				$this->_hustle->get_const_var( 'VERSION' )
			);
			wp_register_style(
				'hstl-opensans',
				'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i',
				array(),
				$this->_hustle->get_const_var( 'VERSION' )
			);
			wp_register_style(
				'hstl-source',
				'https://fonts.googleapis.com/css?family=Source+Code+Pro',
				array(),
				$this->_hustle->get_const_var( 'VERSION' )
			);

			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'wdev_ui' );
			wp_enqueue_style( 'wdev_notice' );
			wp_enqueue_style( 'hstl-roboto' );
			wp_enqueue_style( 'hstl-opensans' );
			wp_enqueue_style( 'hstl-source' );

			wp_enqueue_style(
				'sui_styles',
				$this->_hustle->get_static_var( 'plugin_url' ) . 'assets/css/shared-ui.min.css',
				array(),
				$sui_body_class
			);

			$is_page_with_render = ! preg_match( '/hustle_(integrations|entries|settings)/', $page_slug );
			if ( $is_page_with_render ) {
				Hustle_Module_Front::print_front_styles( $this->_hustle );
			}

		}

		/**
	 * Converts term object to usable object for select2
	 * @param $term Term
	 * @return stdClass
	 */
		public static function terms_to_select2_data( $term ) {
			$obj = new stdClass();
			$obj->id = $term->term_id;
			$obj->text = $term->name;
			return $obj;
		}

		/**
	 * Get usable objects for select2
	 *
	 * @param string $post_type post type
	 * @param array $include_ids IDs
	 * @return array
	 */
		private function get_select2_data( $post_type, $include_ids ) {
			if ( empty( $include_ids ) ) {
				$data = array();
			} else {
				global $wpdb;
				$data = $wpdb->get_results( $wpdb->prepare( "SELECT ID as id, post_title as text FROM {$wpdb->posts} "
				. "WHERE post_type = %s AND post_status = 'publish' AND ID IN ('" . implode( "','", $include_ids ) . "')", $post_type ) ); //phpcs:ignore
			}

			return $data;
		}


		/**
	 * Checks if it's module admin page
	 *
	 * @return bool
	 */
		private function _is_admin_module() {
			$page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING );
			return in_array( $page, array(
				self::ADMIN_PAGE,
				self::DASHBOARD_PAGE,
				self::POPUP_LISTING_PAGE,
				self::POPUP_WIZARD_PAGE,
				self::SLIDEIN_LISTING_PAGE,
				self::SLIDEIN_WIZARD_PAGE,
				self::EMBEDDED_LISTING_PAGE,
				self::EMBEDDED_WIZARD_PAGE,
				self::SOCIAL_SHARING_LISTING_PAGE,
				self::SOCIAL_SHARING_WIZARD_PAGE,
				self::INTEGRATIONS_PAGE,
				self::ENTRIES_PAGE,
				self::SETTINGS_PAGE,
			), true );

		}

		/**
		 * Get module type by page
		 *
		 * @param string $page
		 * @return string
		 */
		private function get_modyle_type_by_page() {
			$page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING );
			switch ( $page ) {
				case self::POPUP_LISTING_PAGE:
					$module_type = Hustle_Model::POPUP_MODULE;
					break;

				case self::SLIDEIN_LISTING_PAGE:
					$module_type = Hustle_Model::SLIDEIN_MODULE;
					break;

				case self::EMBEDDED_LISTING_PAGE:
					$module_type = Hustle_Model::EMBEDDED_MODULE;
					break;

				case self::SOCIAL_SHARING_LISTING_PAGE:
					$module_type = Hustle_Model::SOCIAL_SHARING_MODULE;
					break;

				default:
					$module_type = '';
					break;
			}

			return $module_type;
		}

		/**
	 * Modify admin body class to our own advantage!
	 *
	 * @param $classes
	 * @return mixed
	 */
		public function admin_body_class( $classes ) {

			$sanitize_version = str_replace( '.', '-', HUSTLE_SUI_VERSION );
			$sui_body_class   = "sui-$sanitize_version";

			$screen = get_current_screen();

			$classes = '';

			// Do nothing if not a hustle page
			if ( strpos( $screen->base, '_page_hustle' ) === false ) {
				return $classes;
			}

			$classes .= $sui_body_class;

			return $classes;

		}

		/**
	 * Modify tinymce editor settings
	 *
	 * @param $settings
	 * @param $editor_id
	 */
		public function set_tinymce_settings( $settings, $editor_id ) {
			$settings['paste_as_text'] = 'true';

			return $settings;
		}

		/**
	 * Add Privacy Messages
	 *
	 * @since 3.0.6
	 */
		public function add_privacy_message() {
			if ( function_exists( 'wp_add_privacy_policy_content' ) ) {
				$external_integrations_list = '';
				$external_integrations_privacy_url_list = '';
				$params = array(
				'external_integrations_list' => apply_filters( 'hustle_privacy_external_integrations_list', $external_integrations_list ),
				'external_integrations_privacy_url_list' => apply_filters( 'hustle_privacy_url_external_integrations_list', $external_integrations_privacy_url_list ),
				);
				// TODO: get the name from a variable instead
				$content = $this->_hustle->render( 'general/policy-text', $params, true );
				wp_add_privacy_policy_content( 'Hustle', wp_kses_post( $content ) );
			}
		}

		/**
	 * Adds custom links on plugin page
	 *
	 */
		public function add_plugin_action_links( $actions, $plugin_file ) {
			static $plugin;

			if ( ! isset( $plugin ) ) {
				$plugin = Opt_In::$plugin_base_file; }

			if ( $plugin === $plugin_file ) {
				$settings = array();
				if ( ! is_network_admin() ) {
					$dashboard_url = 'admin.php?page=hustle';
					$settings = array( 'settings' => '<a href="'. $dashboard_url .'">' . __( 'Settings', Opt_In::TEXT_DOMAIN ) . '</a>' );
				}
				$actions = array_merge( $actions, $settings );

				// Upgrade link.
				if ( Opt_In_Utils::_is_free() ) {
					if ( ! lib3()->is_member() ) {
						$url = lib3()->get_link( 'hustle', 'plugin', 'hustle_pluginlist_upgrade' );
					} else {
						$url = lib3()->get_link( 'hustle', 'install_plugin', '' );
					}
					if ( is_network_admin() || ! is_multisite() ) {
						$actions['upgrade'] = '<a href="' . esc_url( $url ) . '" aria-label="' . esc_attr( __( 'Upgrade to Hustle Pro', Opt_In::TEXT_DOMAIN ) ) . '" target="_blank" style="color: #1ABC9C;">' . esc_html__( 'Upgrade', Opt_In::TEXT_DOMAIN ) . '</a>';
					}
				}
			}

			return $actions;
		}

		/**
	 * Displays an admin notice when the user is an active member and doesn't have Hustle Pro installed
	 *
	 * @since 3.0.6
	 */
		public function show_hustle_pro_available_notice() {
			// Show the notice only to super admins who are members.
			if ( ! is_super_admin() || ! lib3()->is_member() ) {
				return;
			}

			// The notice was already dismissed.
			$dismissed_notices = array_filter( explode( ',', (string) get_user_meta( get_current_user_id(), 'hustle_dismissed_admin_notices', true ) ) );
			if ( in_array( 'hustle_pro_is_available', $dismissed_notices, true ) ) {
				return;
			}

			$link = lib3()->html->element( array(
				'type' => 'html_link',
				'value' => esc_html__( 'Upgrade' ),
				'url' => esc_url( lib3()->get_link( 'hustle', 'install_plugin', '' ) ),
				'class' => 'button-primary',
			), true );

			$profile = get_option( 'wdp_un_profile_data', '' );
			$name = ! empty( $profile ) ? $profile['profile']['name'] : 'Hey';

			$message = esc_html( sprintf( __( '%s, it appears you have an active WPMU DEV membership but haven\'t upgraded Hustle to the pro version. You won\'t lose an any settings upgrading, go for it!', Opt_In::TEXT_DOMAIN ), $name ) );

			$html = '<div id="hustle-notice-pro-is-available" class="notice notice-info is-dismissible"><p>' . $message . '</p><p>' . $link . '</p></div>';

			echo $html; // WPCS: XSS ok.

		}

		/**
		 * Export single module
		 *
		 * @sicne 4.0.0
		 */
		private function export() {
			$nonce = filter_input( INPUT_POST, '_wpnonce', FILTER_SANITIZE_STRING );
			if ( ! wp_verify_nonce( $nonce, 'hustle_module_export' ) ) {
				return;
			}
			$id = filter_input( INPUT_POST, 'id', FILTER_VALIDATE_INT );
			if ( ! $id ) {
				return;
			}
			/**
			 * plugin data
			 */
			$plugin = get_plugin_data( WP_PLUGIN_DIR.'/'.Opt_In::$plugin_base_file );
			/**
			 * get module
			 */
			$module = Hustle_Module_Model::instance()->get( $id );
			if ( is_wp_error( $module ) ) {
				return;
			}
			/**
			 * Export data
			 */
			$settings = array(
				'plugin' => array(
					'name' => $plugin['Name'],
					'version' => Opt_In::VERSION,
					'network' => $plugin['Network'],
				),
				'timestamp' => time(),
				'attributes' => $module->get_attributes(),
				'data' => $module->get_data(),
				'meta' => array(),
			);

			if ( 'optin' === $module->module_mode ) {
				$integrations = array();
				$providers = Hustle_Providers::get_instance()->get_providers();
				foreach ( $providers as $slug => $provider ) {
					$provider_data = $module->get_provider_settings( $slug, false );
					if ( $provider_data && $provider->is_connected()
							&& $provider->is_form_connected( $id ) ) {
						$integrations[ $slug ] = $provider_data;
					}
				}

				$settings['meta']['integrations'] = $integrations;
			}

			$meta_names = $module->get_module_meta_names();
			foreach ( $meta_names as $meta_key ) {
				$settings['meta'][ $meta_key ] = json_decode( $module->get_meta( $meta_key ) );
			}
			/**
			 * Filename
			 */
			$filename = sprintf(
				'hustle-%s-%s-%s-%s.json',
				$module->module_type,
				date( 'Ymd-his' ),
				get_bloginfo( 'name' ),
				$module->module_name
			);
			$filename = strtolower( $filename );
			$filename = sanitize_file_name( $filename );
			/**
			 * Print HTTP headers
			 */
			header( 'Content-Description: File Transfer' );
			header( 'Content-Disposition: attachment; filename=' . $filename );
			header( 'Content-Type: application/bin; charset=' . get_option( 'blog_charset' ), true );
			/**
			 * Check PHP version, for PHP < 3 do not add options
			 */
			$version = phpversion();
			$compare = version_compare( $version, '5.3', '<' );
			if ( $compare ) {
				echo wp_json_encode( $settings );
				exit;
			}
			$option = defined( 'JSON_PRETTY_PRINT' )? JSON_PRETTY_PRINT : null;
			echo wp_json_encode( $settings, $option );
			exit;
		}

		/**
		 * Get the listing page by the module type.
		 *
		 * @since 4.0
		 *
		 * @param string $module_type
		 * @return string
		 */
		public static function get_listing_page_by_module_type( $module_type ) {

			switch ( $module_type ) {
				case Hustle_Module_Model::POPUP_MODULE:
					return self::POPUP_LISTING_PAGE;

				case Hustle_Module_Model::SLIDEIN_MODULE:
					return self::SLIDEIN_LISTING_PAGE;

				case Hustle_Module_Model::EMBEDDED_MODULE:
					return self::EMBEDDED_LISTING_PAGE;

				case Hustle_Module_Model::SOCIAL_SHARING_MODULE:
					return self::SOCIAL_SHARING_LISTING_PAGE;

				default:
					return self::POPUP_LISTING_PAGE;
			}
		}

		/**
		 * Get the wizard page by the module type.
		 *
		 * @since 4.0
		 *
		 * @param string $module_type
		 * @return string
		 */
		public static function get_wizard_page_by_module_type( $module_type ) {

			switch ( $module_type ) {
				case Hustle_Module_Model::POPUP_MODULE:
					return self::POPUP_WIZARD_PAGE;

				case Hustle_Module_Model::SLIDEIN_MODULE:
					return self::SLIDEIN_WIZARD_PAGE;

				case Hustle_Module_Model::EMBEDDED_MODULE:
					return self::EMBEDDED_WIZARD_PAGE;

				case Hustle_Module_Model::SOCIAL_SHARING_MODULE:
					return self::SOCIAL_SHARING_WIZARD_PAGE;

				default:
					return self::POPUP_WIZARD_PAGE;
			}
		}

		/**
		 * Check whether a new module of this type can be created.
		 * If it's free and there's already 3 modules of this type, then it's a nope.
		 *
		 * @since 4.0
		 *
		 * @param string $module_type
		 * @return boolean
		 */
		public static function can_create_new_module( $module_type ) {

			// If it's Pro, the sky's the limit.
			if ( ! Opt_In_Utils::_is_free() ) {
				return true;
			}

			// Check the Module's type is valid.
			if ( ! in_array( $module_type, Hustle_Module_Model::get_module_types(), true ) ) {
				return false;
			}

			$collection_args = array(
				'module_type' => $module_type,
				'count_only' => true,
			);
			$total_modules = Hustle_Module_Collection::instance()->get_all( null, $collection_args );

			// If we have less than 3 modules of this type, can create another one.
			if ( $total_modules >= 3 ) {
				return false;
			} else {
				return true;
			}
		}
	}

endif;
