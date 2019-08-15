<?php
if ( !class_exists("Hustle_Init") ) :

/**
 * Class Hustle_Init
 */
class Hustle_Init {

	public function __construct( Opt_In $hustle ){

		Hustle_Db::maybe_create_tables();

		// Hustle Migration.
		$hustle_migration = new Hustle_Migration( $hustle );

		// Admin
		if( is_admin() ) {
			$module_admin = new Hustle_Module_Admin( $hustle );

			$popup_admin = new Hustle_Popup_Admin( $hustle );
			new Hustle_Popup_Admin_Ajax( $hustle, $popup_admin );
			
			$modules_common_admin = new Hustle_Modules_Common_Admin( $hustle );
			new Hustle_Modules_Common_Admin_Ajax( $hustle, $modules_common_admin );

			$hustle_dashboard_admin = new Hustle_Dashboard_Admin();

			// Global Integrations page
			$hustle_providers_admin = new Hustle_Providers_Admin( $hustle );

			new Hustle_Entries_Admin( $hustle );

			$hustle_settings_admin = new Hustle_Settings_Admin( $hustle );
			new Hustle_Settings_Admin_Ajax($hustle, $hustle_settings_admin );

			new Hustle_Slidein_Admin( $hustle );

			new Hustle_Embedded_Admin( $hustle );

			new Hustle_SShare_Admin();
		}

		// Front
		$module_front = new Hustle_Module_Front($hustle);
		$module_front_ajax = new Hustle_Module_Front_Ajax($hustle);
	}
}

endif;
