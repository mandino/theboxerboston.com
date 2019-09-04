<?php
if( !class_exists("Hustle_SendGrid_Form_Settings") ):

/**
 * Class Hustle_SendGrid_Form_Settings
 * Form Settings SendGrid Process
 *
 */
class Hustle_SendGrid_Form_Settings extends Hustle_Provider_Form_Settings_Abstract {

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
				'is_completed' => array( $this, 'first_step_is_completed' ),
			),
		);
	}

	/**
	 * Check if step is completed
	 *
	 * @since 3.0.5
	 * @return bool
	 */
	public function first_step_is_completed() {
		$this->addon_form_settings = $this->get_form_settings_values();
		if ( ! isset( $this->addon_form_settings['list_id'] ) ) {
			// preliminary value
			$this->addon_form_settings['list_id'] = 0;

			return false;
		}

		if ( empty( $this->addon_form_settings['list_id'] ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Returns all settings and conditions for 1st step of SendGrid settings
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
			'list_id' => '',
		);
		$current_data = $this->get_current_data( $current_data, $submitted_data );

		$is_submit = ! empty( $submitted_data['is_submit'] );
		if ( $is_submit && empty( $submitted_data['list_id'] ) ) {
			$error_message = __( 'The email list is required.', Opt_In::TEXT_DOMAIN );
		}

		$options = $this->get_first_step_options( $current_data );

		$step_html = Hustle_Api_Utils::get_modal_title_markup( __( 'Choose your list', Opt_In::TEXT_DOMAIN ), __( 'Choose the list you want to send form data to.', Opt_In::TEXT_DOMAIN ) );
		$step_html .= Hustle_Api_Utils::get_html_for_options( $options );

		if( ! isset( $error_message ) ) {
			$has_errors = false;
		} else {
			$step_html .= '<span class="sui-error-message">' . $error_message . '</span>';
			$has_errors = true;
		}


		$buttons = array(
			'disconnect' => array(
				'markup' => Hustle_Api_Utils::get_button_markup( __( 'Disconnect', Opt_In::TEXT_DOMAIN ), 'sui-button-ghost', 'disconnect_form', true ),
			),
			'save' => array(
				'markup' => Hustle_Api_Utils::get_button_markup( __( 'Save', Opt_In::TEXT_DOMAIN ), '', 'next', true ),
			),
		);

		$response = array(
			'html'       => $step_html,
			'buttons'    => $buttons,
			'has_errors' => $has_errors,
		);

		// Save only after the step has been validated and there are no errors
		if( $is_submit && ! $has_errors ){
			// Save additional data for submission's entry
			if ( !empty( $current_data['list_id'] ) ) {
				$current_data['list_name'] = !empty( $this->lists[ $current_data['list_id'] ]['label'] )
						? $this->lists[ $current_data['list_id'] ]['label'] . ' (' . $current_data['list_id'] . ')' : $current_data['list_id'];
			}
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
		$provider = $this->provider;
		$settings = $this->get_form_settings_values( false );

		$global_multi_id = $settings['selected_global_multi_id'];
		$api_key = $provider->get_setting( 'api_key', '', $global_multi_id );
		$lists = array();

		try {
			$api = $provider::api( $api_key );

			if ( $api ) {
				$_lists =  $api->get_all_lists();
			}

			if( is_array( $_lists ) ) {
				foreach( $_lists as $list ) {
					$list = (array) $list;
					$lists[ $list['id'] ]['value'] = $list['id'];
					$lists[ $list['id'] ]['label'] = $list['name'];
				}
			}
		} catch ( Exception $e ) {
			// TODO: handle this properly
			return array();
		}

		$this->lists = $lists;
		$total_lists = count( $lists );

		$first = $total_lists > 0 ? reset( $lists ) : "";

		if ( !empty( $first ) )
			$first = $first['value'];

		if( ! isset( $submitted_data['list_id'] ) ) {
			$selected_list = $first;
		} else {
			$selected_list = array_key_exists( $submitted_data['list_id'], $lists ) ? $submitted_data['list_id'] : $first;
		}

		$options =  array(
			array(
				'type'     => 'wrapper',
				'style'    => 'margin-bottom: 0;',
				'elements' => array(
					array(
						'type'  => 'label',
						'for'   => 'list_id',
						'value' => __( 'Email List', Opt_In::TEXT_DOMAIN ),
					),
					array(
						'type'     => 'select',
						'name'     => 'list_id',
						'value'    => $selected_list,
						'id'       => 'list_id',
						'options'  => $lists,
						'selected' => $selected_list,
					),
				),
			),
			array(
				'type'  => 'hidden',
				'name'  => 'is_submit',
				'value' => 1,
			),
		);

		return $options;
	}

} // Class end.

endif;
