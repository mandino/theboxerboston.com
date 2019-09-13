<?php
if( !class_exists("Hustle_Icontact_Form_Settings") ):

/**
 * Class Hustle_Icontact_Form_Settings
 * Form Settings iContact Process
 *
 */
class Hustle_Icontact_Form_Settings extends Hustle_Provider_Form_Settings_Abstract {

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
			// 1
			array(
				'callback'     => array( $this, 'second_step_callback' ),
				'is_completed' => array( $this, 'second_step_is_completed' ),
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
	 * Returns all settings and conditions for 1st step of iContact settings
	 *
	 * @since 3.0.5
	 *
	 * @param array $submitted_data
	 * @return array
	 */
	public function first_step_callback( $submitted_data ) {
		$this->addon_form_settings = $this->get_form_settings_values();
		$current_data = array(
			'list_id' => '',
			'auto_optin' => '',
		);
		$current_data = $this->get_current_data( $current_data, $submitted_data );
		$is_submit = ! empty( $submitted_data['is_submit'] ) && empty( $submitted_data['page'] );

		if ( $is_submit && empty( $submitted_data['list_id'] ) ) {
			$error_message = __( 'The list is required.', 'wordpress-popup' );
		}
		if ( !$is_submit && ! empty( $submitted_data['page'] ) ) {
			$settings = array();
			$settings['page'] = $submitted_data['page'];
			$this->save_form_settings_values( $settings );
		}

		$options = $this->get_first_step_options( $current_data );

		$step_html = Hustle_Api_Utils::get_modal_title_markup( __( 'Choose list', 'wordpress-popup' ), __( 'Choose the list you want to send form data to.', 'wordpress-popup' ) );
		$step_html .= Hustle_Api_Utils::get_html_for_options( $options );

		if( ! isset( $error_message ) ) {
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
				'markup' => Hustle_Api_Utils::get_button_markup( __( 'Continue', 'wordpress-popup' ), '', 'next', true ),
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
		$app_id = $provider->get_setting( 'app_id', '', $global_multi_id );
		$username = $provider->get_setting( 'username', '', $global_multi_id );
		$password = $provider->get_setting( 'password', '', $global_multi_id );
		$auto_optin = $provider->get_setting( 'auto_optin', '', $global_multi_id );

		$saved_auto_optin = 'pending' === $auto_optin ? 'pending' : '';
		$checked = ! isset( $submitted_data['auto_optin'] ) ? $saved_auto_optin : $submitted_data['auto_optin'];
		$is_double_optin_enabled = 'pending' === $checked;

		//Load more function
		$load_more = !empty( $settings['page'] );
		$page = $load_more ? (int)$settings['page'] : 1;
		$page_limit = 20;
		$offset = ($page-1)*$page_limit;

		$lists = array();

		try {
			$api = $provider::api( $app_id, $password, $username );
			$_lists = !is_wp_error( $api ) ? $api->get_lists( $offset ) : array();

			if( ! is_wp_error( $_lists ) && count( $_lists ) && isset( $_lists['lists'] ) ) {
				foreach( $_lists['lists'] as $list ) {
					$list = (array) $list;
					$lists[ $list['listId'] ]['value'] = $list['listId'];
					$lists[ $list['listId'] ]['label'] = $list['name'];
					// Save it in order to get the selected list name before saving first step
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
			array(
				'type'     => 'wrapper',
				'elements' => array(
					'label' => array(
						'type'  => 'label',
						'for'   => 'list_id',
						'value' => __( 'Email List', 'wordpress-popup' ),
					),
					'list'  => array(
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
			array(
				'type'     => 'wrapper',
				'style'    => 'margin-bottom: 0;',
				'elements' => array(
					array(
						'type'  => 'label',
						'for'   => 'list_id',
						'value' => __( 'Double Opt-in', 'wordpress-popup' ),
					),
					array(
						'type'       => 'checkbox',
						'name'       => 'auto_optin',
						'id'         => 'auto_optin',
						'class'      => 'sui-checkbox-sm',
						'value'      => 'pending',
						'attributes' => array(
							'checked' => $is_double_optin_enabled ? 'checked' : '',
						),
						'label'      => __( 'Enable double opt-in for this list.', 'wordpress-popup' ),
					),
				),
			),
			array(
				'type'  => 'hidden',
				'name'  => 'is_submit',
				'value' => '1',
			),
		);

		$navigation_elements = array();
		if ( 1 < $page ) {
			$navigation_elements['navigation_prev'] = $this->get_previous_button( $page );
		}

		if ( $page_limit === $total_lists ) {
			$navigation_elements['navigation_next'] = $this->get_next_button( $page );
		}
		
		if ( ! empty( $navigation_elements ) ) {
			$options[0]['elements']['navigation_wrapper'] = array(
				'type' => 'wrapper',
				'class' => 'hui-email-list-navigation',
				'is_not_field_wrapper' => true,
				'elements' => $navigation_elements,
			);
		}

		return $options;
	}

	/**
	 * Returns all settings and conditions for 2nd step of iContact settings
	 *
	 * @since 3.0.5
	 *
	 * @param array $submitted_data
	 * @return array
	 */
	public function second_step_callback( $submitted_data ) {

		$this->addon_form_settings = $this->get_form_settings_values( false );

		// If the Double Opt-in option is disabled, close the modal. No need for this step.
		if( empty( $this->addon_form_settings['auto_optin'] ) ) {
			return array(
				'html' => '',
				'notification' => array(
					'type' => 'success',
					'text' => '<strong>' . $this->provider->get_title() . '</strong> ' . __( 'successfully connected to your form', 'wordpress-popup' ),
				),
				'is_close' => true,
			);
		}
		$current_data = array(
			'confirmation_message_id' => '',
		);

		$current_data = $this->get_current_data( $current_data, $submitted_data );
		$is_submit = ! empty( $submitted_data['is_submit'] );

		if ( $is_submit && empty( $submitted_data['confirmation_message_id'] ) ) {
			$error_message = __( 'The confirmation message is required when double opt-in is enabled.', 'wordpress-popup' );
		}

		$options = $this->get_second_step_options( $current_data );

		$step_html = Hustle_Api_Utils::get_modal_title_markup( __( 'Choose confirmation message', 'wordpress-popup' ), '' );
		$step_html .= Hustle_Api_Utils::get_html_for_options( $options );

		if( ! isset( $error_message ) ) {
			$has_errors = false;
		} else {
			$step_html .= '<span class="sui-error-message">' . $error_message . '</span>';
			$has_errors = true;
		}


		$buttons = array(
			'cancel' => array(
				'markup' => Hustle_Api_Utils::get_button_markup( __( 'Back', 'wordpress-popup' ), '', 'prev', true ),
			),
			'save' => array(
				'markup' => Hustle_Api_Utils::get_button_markup( __( 'Save', 'wordpress-popup' ), '', 'next', true ),
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
			if ( !empty( $current_data['confirmation_message_id'] ) ) {
				$current_data['confirmation_message_name'] = !empty( $options['list_id_setup']['elements']['choose_email_list']['options'][ $current_data['confirmation_message_id'] ]['label'] )
						? $options['list_id_setup']['elements']['choose_email_list']['options'][ $current_data['confirmation_message_id'] ]['label'] : '';
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
	private function get_second_step_options( $submitted_data ) {
		$provider = $this->provider;
		$settings = $this->get_form_settings_values( false );

		$global_multi_id = $settings['selected_global_multi_id'];
		$app_id = $provider->get_setting( 'app_id', '', $global_multi_id );
		$username = $provider->get_setting( 'username', '', $global_multi_id );
		$password = $provider->get_setting( 'password', '', $global_multi_id );

		$confirmation_messages_list = array();

		try {
			$api = $provider::api( $app_id, $password, $username );
			$existing_messages = !is_wp_error( $api ) ? $api->get_existing_messages() : array();


			if ( ! empty( $existing_messages['messages'] ) ) {
				foreach( $existing_messages['messages'] as $message ) {
					if( 'confirmation' === $message['messageType'] ) {
						$confirmation_messages_list[ $message['messageId'] ]['label'] = $message['messageName'];
						$confirmation_messages_list[ $message['messageId'] ]['value'] = $message['messageId'];
					}
				}

			}
		} catch ( Exception $e ) {
			// TODO: handle this properly
			return array();
		}

		$total_lists = count( $confirmation_messages_list );

		$first = $total_lists > 0 ? reset( $confirmation_messages_list ) : "";
		if( !empty( $first ) )
			$first = $first['value'];

		if( ! isset( $submitted_data['confirmation_message_id'] ) ) {
			$selected_list = $first;
		} else {
			$selected_list = array_key_exists( $submitted_data['confirmation_message_id'], $confirmation_messages_list ) ? $submitted_data['confirmation_message_id'] : $first;
		}

		$options =  array(
			"list_id_setup" => array(
				"class" => "sui-form-field",
				"type"  => "wrapper",
				"elements" => array(
					"label" => array(
						"id"    => "list_id_label",
						"for"   => "confirmation_message_id",
						"value" => __("Choose message:", 'wordpress-popup'),
						"type"  => "label",
					),
					"choose_email_list" => array(
						"type"          => 'select',
						'name'          => "confirmation_message_id",
						'id'			=> "confirmation_message_id",
						"default"       => "",
						'options'       => $confirmation_messages_list,
						'value'         => $selected_list,
						'selected'      => $selected_list,
						'class'			=> 'sui-select sui-styled',
					),
				),
			),
			"wrapper" => array(
				"id"    => "",
				"class" => "sui-form-field",
				"type"  => "wrapper",
				"elements" => array(
					"api_key" => array(
						"name"          => "is_submit",
						"type"          => "hidden",
						"value"         => '1',
					),
				)
			),
		);

		return $options;
	}

	/**
	 * Check if step is completed
	 *
	 * @since 3.0.5
	 * @return bool
	 */
	public function second_step_is_completed() {
		$done = $this->first_step_is_completed() &&
			empty( $this->addon_form_settings['auto_optin'] ) || isset( $this->addon_form_settings['confirmation_message_id'] );

		return $done;
	}

}

endif;
