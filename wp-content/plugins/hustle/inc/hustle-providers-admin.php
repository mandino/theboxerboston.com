<?php
/**
 * Class Hustle_Providers_Admin
 * This class handles the global "Integrations" page view.
 *
 * @since 4.0
 *
 */
class Hustle_Providers_Admin extends Hustle_Admin_Page_Abstract {

	public function init() {

		$this->page = 'hustle_integrations';

		$this->page_title = __( 'Hustle Integrations', 'wordpress-popup' );

		$this->page_menu_title = __( 'Integrations', 'wordpress-popup' );

		$this->page_capability = 'hustle_edit_integrations';

		$this->page_template_path = 'admin/integrations';
	}

	/**
	 * Get the arguments used when rendering the main page.
	 * 
	 * @since 4.0.1
	 * @return array
	 */
	public function get_page_template_args() {
		$accessibility = Hustle_Settings_Admin::get_hustle_settings( 'accessibility' );
		return array(
			'accessibility' => $accessibility,
			'sui' => Opt_In::get_sui_summary_config(),
		);
	}
}
