<?php
if ( !class_exists( 'Hustle_Local_List_Form_Settings' ) ) :

/**
 * Class Hustle_Local_List_Form_Settings
 * Form Settings Local List Process
 *
 */
class Hustle_Local_List_Form_Settings extends Hustle_Provider_Form_Settings_Abstract {

	/**
	 * For settings Wizard steps
	 *
	 * @since 4.0
	 * @return array
	 */
	public function form_settings_wizards() {
		// already filtered on Abstract
		// numerical array steps
		return array(
			// 0
			array(
				'callback'     => array( $this, 'first_step_callback' ),
				'is_completed' => array( $this, 'first_step_is_completed' ),
			),
		);
	}

	/**
	 * Check if step is completed
	 *
	 * @since 4.0
	 * @return bool
	 */
	public function first_step_is_completed() {
		$this->addon_form_settings = $this->get_form_settings_values();

		return !empty( $this->addon_form_settings['local_list_name'] );
	}

	/**
	 * Returns all settings and conditions for 1st step of Local List settings
	 *
	 * @since 3.0.5
	 * @since 4.0 param $validate removed.
	 *
	 * @param array $submitted_data
	 * @return array
	 */
	public function first_step_callback( $submitted_data ) {

		$this->addon_form_settings = $this->get_form_settings_values();

		$current_data = array(
			'local_list_name' 	=> '',
		);

		$is_submit = ! empty( $submitted_data['is_submit'] );
		
		$current_data = $this->get_current_data( $current_data, $submitted_data );

		if ( $is_submit && empty( $submitted_data['local_list_name'] ) ) {
			$error_message = __( 'Please add a valid list name.', 'wordpress-popup' );
		}

		$options = $this->get_first_step_options( $current_data );

		$step_html = Hustle_Api_Utils::get_modal_title_markup( __( 'Setup your list', 'wordpress-popup' ), __( 'Will save email addresses to an exportable CSV list.', 'wordpress-popup' ) );

		$step_html .= Hustle_Api_Utils::get_html_for_options( $options );

		if ( ! isset( $error_message ) ) {
			$has_errors = false;
		} else {
			$step_html .= '<span class="sui-error-message">' . $error_message . '</span>';
			$has_errors = true;
		}

		$buttons = array(
			'disconnect' => array(
				'markup' => Hustle_Api_Utils::get_button_markup( __( 'Disconnect', 'wordpress-popup' ), 'sui-button-ghost', 'disconnect_form', true ),
			),
			'save' => array(
				'markup' => Hustle_Api_Utils::get_button_markup( __( 'Save', 'wordpress-popup' ), '', 'connect', true ),
			),
		);

		$response = array(
			'html'       => $step_html,
			'buttons'    => $buttons,
			'has_errors' => $has_errors,
		);

		// Save only after the step has been validated and there are no errors
		if( $is_submit && ! $has_errors ){
			$this->save_form_settings_values( $current_data );
		}

		return $response;
	}

	/**
	 * Return an array of options used to display the settings of the 1st step.
	 *
	 * @since 4.0
	 *
	 * @param array $submitted_data
	 * @return array
	 */
	private function get_first_step_options( $submitted_data ) {
		$name 		= !empty( $submitted_data['local_list_name'] ) ? $submitted_data['local_list_name'] : '' ;
	
		$options =  array(
			'list_id_setup' => array(
				'type'  => 'wrapper',
				'style' => 'margin-bottom: 0;',
				'elements' => array(
					'label' => array(
						'type'  => 'label',
						'for'   => 'local_list_name',
						'value' => __( 'List name', 'wordpress-popup' ),
					),
					'local_list_name' => array(
						'type'  => 'text',
						'name'  => 'local_list_name',
						'value' => $name,
						'id'    => 'local_list_name',
					),
					'description' => array(
						'type'  => 'description',
						'value' => __( 'This will be visible to the visitors while unsubscribing.', 'wordpress-popup' ),
					),
				),
			),
			'api_key'       => array(
				'name'          => 'is_submit',
				'type'          => 'hidden',
				'value'         => '1',
			),
		);

		return $options;
	}

} // Class end.

endif;
