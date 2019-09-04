<?php


class Hustle_Dashboard_Admin extends Opt_In {

	private $_settings;

	const WELCOME_MODAL_NAME = 'welcome_modal';
	const MIGRATE_MODAL_NAME = 'migrate_modal';
	const MIGRATE_NOTICE_NAME = 'migrate_notice';

	/**
	 * Top page slug
	 *
	 * @since 4.0.0
	 */
	private $page_slug;

	public function __construct() {

		add_action( 'admin_menu', array( $this, 'register_menus' ), 1 );
		//add_filter( 'hustle_optin_vars', array( $this, 'register_dashboard_vars' ) );
	}

	public function __get( $name ) {
		if ( '_data' === $name ) {
			$this->_data = new Hustle_Dashboard_Data();
			return $this->_data;
		}
	}


	public function register_menus() {

		$parent_menu_title = ( Opt_In_Utils::_is_free() )
			? __( 'Hustle', Opt_In::TEXT_DOMAIN )
			: __( 'Hustle Pro', Opt_In::TEXT_DOMAIN );

		$capability = 'hustle_menu';

		// Parent menu
		$this->page_slug = add_menu_page( $parent_menu_title , $parent_menu_title , $capability, 'hustle', array( $this, 'render_dashboard' ), self::$plugin_url . 'assets/images/icon.svg' );

		add_action( 'load-'.$this->page_slug, array( 'Hustle_Modules_Common_Admin', 'process_request' ) );
		add_filter( 'load-'.$this->page_slug, array( $this, 'add_action_hooks' ) );

		// Dashboard
		add_submenu_page( 'hustle', __( 'Dashboard', Opt_In::TEXT_DOMAIN ) , __( 'Dashboard', Opt_In::TEXT_DOMAIN ) , $capability, 'hustle',  array( $this, 'render_dashboard' ) );
	}
	/**
	 * Renders Hustle Dashboard
	 *
	 * @since 2.0
	 */
	public function render_dashboard() {

		$current_user = wp_get_current_user();
		$capability = array(
			'hustle_create' => current_user_can( 'hustle_create' ),
			'hustle_access_emails' => current_user_can( 'hustle_access_emails' ),
		);
		$modules_except_ss = count( $this->_data->popups ) + count( $this->_data->slideins ) + count( $this->_data->embeds );

		$accessibility = Hustle_Settings_Admin::get_hustle_settings( 'accessibility' );
		$last_conversion = Hustle_Tracking_Model::get_instance()->get_latest_conversion_date( 'all' );

		$this->render(
			'admin/dashboard',
			array(
				'metrics' => $this->_data->metrics,
				'user_name' => ucfirst( $current_user->display_name ),
				'top_active_modules' => $this->_data->top_active_modules,
				'active_modules' => $this->_data->active_modules,
				'popups' => $this->_data->popups,
				'slideins' => $this->_data->slideins,
				'embeds' => $this->_data->embeds,
				'social_shares' => $this->_data->social_sharings,
				'last_conversion' => $last_conversion ? date_i18n( 'j M Y @ H:i A', strtotime( $last_conversion ) ) : __( 'Never', Opt_In::TEXT_DOMAIN ),
				'sshare_per_page_data' => $this->get_sshare_per_page_conversions(),
				'ss_total_share_stats' => $this->_data->ss_total_share_stats,
				'accessibility' => $accessibility,
				'has_modules' => ( $modules_except_ss > 0 ) ? true : false,
				'is_free' => Opt_In_Utils::_is_free(),
				'capability' => $capability,
				'need_migrate' => Hustle_Migration::check_tracking_needs_migration(),
				'sui' => $this->get_sui_summary_config(),
			)
		);
	}

	/**
	 * Get the data for listing the ssharing modules conversions per page.
	 *
	 * @since 4.0
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
