<?php
/**
 * Class Hustle_Providers_Admin
 * This class handles the global "Integrations" page view.
 *
 * @since 4.0
 *
 */
class Hustle_Providers_Admin extends Hustle_Admin_Common {

	/**
	 * Hustle_Providers_Admin constructor.
	 * @param Opt_In $hustle
	 */
	public function __construct( Opt_In $hustle ) {
		parent::__construct( $hustle );
		add_action( 'admin_menu', array( $this, 'register_menu' ), 99 );
		add_action( 'current_screen', array( $this, 'set_proper_current_screen' ) );
	}

	/**
	 * Register the "Integrations" menu page
	 *
	 * @since 4.0
	 */
	public function register_menu() {
		$this->page_slug = add_submenu_page( 'hustle', __( 'Hustle Integrations', Opt_In::TEXT_DOMAIN ) , __( 'Integrations', Opt_In::TEXT_DOMAIN ) , 'hustle_edit_integrations', 'hustle_integrations',  array( $this, 'render_page' ) );
		add_filter( 'load-'.$this->page_slug, array( $this, 'add_action_hooks' ) );
	}

	/**
	 * Remove "-pro" that came from the menu which causes template not to work
	 * @see Opt_In_Utils::clean_current_screen()
	 *
	 * @since 4.0
	 * @param WP_Screen $current
	 */
	public function set_proper_current_screen( $current ) {
		global $current_screen;
		if ( ! Opt_In_Utils::_is_free() ) {
			$current_screen->id = Opt_In_Utils::clean_current_screen( $current_screen->id );
		}
	}

	/**
	 * Render the "Integrations" page
	 *
	 * @since 4.0
	 */
	public function render_page() {
		$accessibility = Hustle_Settings_Admin::get_hustle_settings( 'accessibility' );
		$args = array(
			'accessibility' => $accessibility,
			'sui' => $this->_hustle->get_sui_summary_config(),
		);
		$this->_hustle->render( 'admin/integrations', $args );
	}
}
