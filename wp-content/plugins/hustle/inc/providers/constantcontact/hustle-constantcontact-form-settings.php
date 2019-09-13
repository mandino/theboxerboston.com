<?php
if( !class_exists("Hustle_ConstantContact_Form_Settings") ):

/**
 * Class Hustle_ConstantContact_Form_Settings
 * Form Settings ActiveCampaign Process
 *
 */
class Hustle_ConstantContact_Form_Settings extends Hustle_Provider_Form_Settings_Abstract {

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
	 * Returns all settings and conditions for 1st step of ConstantContact settings
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
			$error_message = __( 'The email list is required.', 'wordpress-popup' );
		} else {
			$error_message = '';
		}

		$options = $this->get_first_step_options( $current_data );

		$step_html = Hustle_Api_Utils::get_modal_title_markup(
			__( 'Choose your list', 'wordpress-popup' ),
			__( 'Choose the list you want to send form data to.', 'wordpress-popup' )
		);

		$step_html .= Hustle_Api_Utils::get_html_for_options( $options );

		if ( ! is_ssl() ) {
			$error_message .= __( 'Constant Contact requires your site to have SSL certificate.', 'wordpress-popup' );
		}

		if ( empty( $error_message ) ) {
			$has_errors = false;
		} else {
			$step_html .= '<div class="sui-notice sui-notice-error" style="margin-bottom: 0;"><p>' . $error_message . '</p></div>';
			$has_errors = true;
		}


		$disabled = !is_ssl();
		$buttons = array(
			'disconnect' => array(
				'markup' => Hustle_Api_Utils::get_button_markup( __( 'Disconnect', 'wordpress-popup' ), 'sui-button-ghost', 'disconnect_form', true ),
			),
			'save' => array(
				'markup' => Hustle_Api_Utils::get_button_markup( __( 'Save', 'wordpress-popup' ), '', 'next', true, $disabled ),
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
		$lists = array();

		try {
			$api = $this->provider->api();
			$is_authorize = (bool) $api->get_token( 'access_token' );

			if ( $is_authorize ) {
				$lists_data = $api->get_contact_lists();
				foreach( $lists_data as $list ){
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
		if( !empty( $first ) )
			$first = $first['value'];

		if( ! isset( $submitted_data['list_id'] ) ) {
			$selected_list = $first;
		} else {
			$selected_list = array_key_exists( $submitted_data['list_id'], $lists ) ? $submitted_data['list_id'] : $first;
		}

		$options =  array(
			'list_id_setup' => array(
				'type'     => 'wrapper',
				'style'    => 'margin-bottom: 0;',
				'elements' => array(
					'label' => array(
						'type'  => 'label',
						'for'   => 'list_id',
						'value' => __( 'Email List', 'wordpress-popup' ),
					),
					'choose_email_list' => array(
						'type'     => 'select',
						'name'     => 'list_id',
						'id'       => 'list_id',
						'class'    => 'sui-select',
						'default'  => '',
						'options'  => $lists,
						'value'    => $selected_list,
						'selected' => $selected_list,
					),
				),
			),
			'api_key' => array(
				'type'  => 'hidden',
				'name'  => 'is_submit',
				'value' => '1',
			),
		);

		return $options;
	}

} // Class end.

endif;
