<?php

/**
 * Class Hustle_Campaignmonitor_Form_Hooks
 * Define the form hooks that are used by Campaignmonitor
 *
 * @since 4.0
 */
class Hustle_Campaignmonitor_Form_Hooks extends Hustle_Provider_Form_Hooks_Abstract {


	/**
	 * Add Campaignmonitor data to entry.
	 *
	 * @since 4.0
	 *
	 * @param array $submitted_data
	 * @return array
	 */
	public function add_entry_fields( $submitted_data ) {

		$addon = $this->addon;
		$module_id = $this->module_id;
		$form_settings_instance = $this->form_settings_instance;

		/**
		 * @since 4.0
		 */
		$submitted_data = apply_filters( 'hustle_provider_' . $addon->get_slug() . '_form_submitted_data', $submitted_data, $module_id, $form_settings_instance );

		$addon_setting_values = $form_settings_instance->get_form_settings_values();

		try {

			$global_multi_id = $addon_setting_values['selected_global_multi_id'];
			$api_key = $addon->get_setting( 'api_key', '', $global_multi_id );

			if ( empty( $submitted_data['email'] ) ) {
				throw new Exception( __('Required Field "email" was not filled by the user.', 'wordpress-popup' ) );
			}

			$list_id = $addon_setting_values['list_id'];

			$submitted_data = $this->check_legacy( $submitted_data );

			$email = $submitted_data['email'];
			$name = array();

			if ( isset( $submitted_data['first_name'] ) ) {
				$name['first_name'] = $submitted_data['first_name'];
			}
			if ( isset( $submitted_data['last_name'] ) ) {
				$name['last_name'] = $submitted_data['last_name'];
			}
			$name = implode( ' ', $name );

			// Remove unwanted fields
			$custom_data = array_diff_key( $submitted_data, array(
				'first_name' => '',
				'last_name' => '',
				'email' => '',
			) );

			$custom_fields = array();
			foreach( $custom_data as $key => $d ){
				$custom_fields[] = array(
					'Key' => $key,
					'Value' => $d,
				);
			}

			$api = new CS_REST_Subscribers( $list_id, array('api_key' => $api_key ));
			$data_to_send = $email;
			$res = $api->get( $data_to_send );

			$is_sent = false;

			if ( $res->was_successful() ) {

				$data_to_send = array(
					'EmailAddress' => $email,
					'Name'         => $name,
					'Resubscribe'  => true,
					'CustomFields' => $custom_fields
				);

				$res = $api->update( $email, $data_to_send );
				$url_request = $api->_subscribers_base_route . '.json?email=' . rawurlencode($email);

				if( ! $res->was_successful() ) {
					$details = __( 'Something went wrong. Unable to add subscriber.', 'wordpress-popup' );
				} else {
					$is_sent = true;
					$details = __( 'Successfully updated member on Campaign Monitor list', 'wordpress-popup' );
				}

			} else {
				// Add new Custom Fields
				$cf_api = new CS_REST_Lists( $list_id, array('api_key' => $api_key ) );
				$existed_custom_fields = $cf_api->get_custom_fields();
				$new_fields = is_object( $existed_custom_fields ) && isset( $existed_custom_fields->response )
						? array_diff( array_keys( $custom_data ), array_map( 'trim', wp_list_pluck( $existed_custom_fields->response, 'Key' ), array( '[]' ) ) )
						: array_keys( $custom_data );
				foreach ( $new_fields as $new_key ) {
					$custom_field_details = array(
						'FieldName' => $new_key,
						'DataType' => CS_REST_CUSTOM_FIELD_TYPE_TEXT, //we only support text type for now
						'Options' => array(),
						'VisibleInPreferenceCenter' => false,
					);
					$cf_api->create_custom_field( $custom_field_details );
				}

				$data_to_send = array(
					'EmailAddress' => $email,
					'Name'         => $name,
					'Resubscribe'  => true,
					'CustomFields' => $custom_fields
				);
				$res = $api->add( $data_to_send );
				$url_request = $api->_subscribers_base_route . '.json';

				if( ! $res->was_successful() ) {
					$details = __( 'Something went wrong. Unable to add subscriber.', 'wordpress-popup' );
				} else {
					$is_sent = true;
					$details = __( 'Successfully added or updated member on Campaign Monitor list', 'wordpress-popup' );
				}
			}
			$response = array(
				'code' => $res->http_status_code,
				'response' => $res->response,
			);

			$subscriber = $api->get( $email );
			if ( !empty( $subscriber->response->State ) ) {
				$member_status = $subscriber->response->State;
			} elseif ( !empty( $subscriber->response->Message ) ) {
				$member_status = $subscriber->response->Message;
			}


			$entry_fields = array(
				array(
					'name'  => 'status',
					'value' => array(
						'is_sent'       => $is_sent,
						'description'   => $details,
						'member_status' => $member_status,
						'data_sent'     => $data_to_send,
						'data_received' => $response,
						'url_request'   => $url_request,
					),
				),
			);
		} catch ( Exception $e ) {
			$entry_fields = $this->exception( $e );
		}

		if ( !empty( $addon_setting_values['list_name'] ) ) {
			$entry_fields[0]['value']['list_name'] = $addon_setting_values['list_name'];
		}

		$entry_fields = apply_filters( 'hustle_provider_' . $addon->get_slug() . '_entry_fields',
			$entry_fields,
			$module_id,
			$submitted_data,
			$form_settings_instance
		);

		return $entry_fields;
	}

	/**
	 * Check whether the email is already subscribed.
	 *
	 * @since 4.0
	 *
	 * @param $submitted_data
	 * @return bool
	 */
	public function on_form_submit( $submitted_data, $allow_subscribed = true ) {

		$is_success 				= true;
		$module_id                	= $this->module_id;
		$form_settings_instance 	= $this->form_settings_instance;
		$addon 						= $this->addon;
		$addon_setting_values 		= $form_settings_instance->get_form_settings_values();
		$global_multi_id 			= $addon_setting_values['selected_global_multi_id'];
		$api_key 					= $addon->get_setting( 'api_key', '', $global_multi_id );
		if ( empty( $submitted_data['email'] ) ) {
			return __( 'Required Field "email" was not filled by the user.', 'wordpress-popup' );
		}

		if ( ! $allow_subscribed ) {

			/**
			 * Filter submitted form data to be processed
			 *
			 * @since 4.0
			 *
			 * @param array                                    $submitted_data
			 * @param int                                      $module_id                current module_id
			 * @param Hustle_Campaignmonitor_Form_Settings $form_settings_instance
			 */
			$submitted_data = apply_filters(
				'hustle_provider_campaignmonitor_form_submitted_data_before_validation',
				$submitted_data,
				$module_id,
				$form_settings_instance
			);

			//TODO: Handle this better once API lib is updated
			//triggers exception if not found.
			$list_id = $addon_setting_values['list_id'];
			$api = new CS_REST_Subscribers( $list_id, array('api_key' => $api_key ));
			$res = $api->get( $submitted_data['email'] );

			if ( $res->was_successful() ) {
				$is_success = self::ALREADY_SUBSCRIBED_ERROR;
			}
		}

		/**
		 * Return `true` if success, or **(string) error message** on fail
		 *
		 * @since 4.0
		 *
		 * @param bool                                     $is_success
		 * @param int                                      $module_id                current module_id
		 * @param array                                    $submitted_data
		 * @param Hustle_Campaignmonitor_Form_Settings $form_settings_instance
		 */
		$is_success = apply_filters(
			'hustle_provider_campaignmonitor_form_submitted_data_after_validation',
			$is_success,
			$module_id,
			$submitted_data,
			$form_settings_instance
		);

		// process filter
		if ( true !== $is_success ) {
			// only update `_submit_form_error_message` when not empty
			if ( ! empty( $is_success ) ) {
				$this->_submit_form_error_message = (string) $is_success;
			}
			return $is_success;
		}

		return true;

	}


}
