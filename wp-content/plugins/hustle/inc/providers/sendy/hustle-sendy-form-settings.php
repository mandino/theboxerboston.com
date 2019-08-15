<?php
if ( ! class_exists( 'Hustle_Sendy_Form_Settings' ) ) :

	/**
 * Class Hustle_Sendy_Form_Settings
 * Form Settings Sendy Process
 *
 */
	class Hustle_Sendy_Form_Settings extends Hustle_Provider_Form_Settings_Abstract {

		/**
	 * For settings Wizard steps
	 *
	 * @since 3.0.5
	 * @return array
	 */
		public function form_settings_wizards() {
			// already filtered on Abstract
			// numerical array steps
			return array(
				// 0
				array(
					'callback'     => array( $this, 'first_step_callback' ),
					'is_completed' => array( $this, 'is_multi_global_select_step_completed' ),
				),
			);
		}

	/**
	 * Returns all settings and conditions for 1st step of Mautic settings
	 *
	 * @since 3.0.5
	 * @since 4.0 param $validate removed.
	 *
	 * @param array $submitted_data
	 * @return array
	 */
	public function first_step_callback( $submitted_data ) {

		$step_html = Hustle_Api_Utils::get_modal_title_markup( __( 'Sendy', Opt_In::TEXT_DOMAIN ), __( 'Sendy is activated for this module.', Opt_In::TEXT_DOMAIN ) );

		$buttons = array(
			'disconnect' => array(
				'markup' => Hustle_Api_Utils::get_button_markup( __( 'Disconnect', Opt_In::TEXT_DOMAIN ), 'sui-button-ghost', 'disconnect_form', true ),
			),
			'close' => array(
				'markup' => Hustle_Api_Utils::get_button_markup( __( 'Save', Opt_In::TEXT_DOMAIN ), '', 'close', true ),
			),
		);

		$response = array(
			'html'       => $step_html,
			'buttons'    => $buttons,
			'has_errors' => false,
		);

		return $response;
	}

} // Class end.

endif;
