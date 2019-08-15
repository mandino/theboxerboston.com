<?php

/**
 * Class Hustle_Aweber_Form_Hooks
 * Define the form hooks that are used by Aweber
 *
 * @since 4.0
 */
class Hustle_Aweber_Form_Hooks extends Hustle_Provider_Form_Hooks_Abstract {


	/**
	 * Add Aweber data to entry.
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
		$utils = Hustle_Provider_Utils::get_instance();

		/**
		 * @since 4.0
		 */
		$submitted_data = apply_filters( 'hustle_provider_' . $addon->get_slug() . '_form_submitted_data', $submitted_data, $module_id, $form_settings_instance );

		$addon_setting_values = $form_settings_instance->get_form_settings_values();

		try {
			$account = $addon->get_account();
			$account_id =  isset( $account->data, $account->data['id'] ) ? $account->data['id'] : false;

			if ( empty( $submitted_data['email'] ) ) {
				throw new Exception( __('Required Field "email" was not filled by the user.', Opt_In::TEXT_DOMAIN ) );
			}

			$list_id = $addon_setting_values['list_id'];

			$url = "/accounts/{$account_id}/lists/{$list_id}";
			$list = $account->loadFromUrl($url);
			$submitted_data = $this->check_legacy( $submitted_data );
			$subscribe_data = $submitted_data;
			$name = array();

			if ( ! empty( $submitted_data['first_name'] ) ) {// Check first_name field first
				$name['first_name'] = $submitted_data['first_name'];
				unset( $subscribe_data['first_name'] );
			}
			if ( ! empty( $submitted_data['last_name'] ) ) { // Add last_name
				$name['last_name'] = $submitted_data['last_name'];
				unset( $subscribe_data['last_name'] );
			}
			$subscribe_data['name'] = implode( ' ', $name );
			$custom_fields = array_diff_key( $submitted_data, array(
				'first_name' => '',
				'last_name' => '',
				'email' => '',
			) );

			if ( ! empty( $custom_fields ) ) {
				$subscribe_data['custom_fields'] = array();

				foreach ( $custom_fields as $key => $value ) {

					//$field = $module->get_custom_field( 'name', $key );
					$api_custom_fields = $list->custom_fields;
					//$name = $field['name'];
					//$subscribe_data['custom_fields'][ $name ] = $value;
					$subscribe_data['custom_fields'][ $key ] = $value;
					unset( $subscribe_data[ $key ] );
				}
			}

			$search_data = array( 'email' => $subscribe_data['email'] );
			$find_by_email = $list->subscribers->find( $search_data );

			$is_sent = false;
			$member_status = __( 'Member could not be subscribed.', Opt_In::TEXT_DOMAIN );

			//not updating the subscriber because update method not found
			if ( ! empty( $find_by_email ) && ! empty( $find_by_email->data ) && ! empty( $find_by_email->data['entries'] ) ) {
				$utils->_last_url_request = $find_by_email->url;
				$utils->_last_data_received = $find_by_email->data;
				$utils->_last_data_sent = $search_data;
				$details = __( 'This email address has already subscribed.', Opt_In::TEXT_DOMAIN );
			} else {
				$subscriber = $list->subscribers->create($subscribe_data);

				$member_status = $subscriber->status;
				$utils->_last_url_request = $subscriber->url;
				$utils->_last_data_received = $subscriber->data;
				$utils->_last_data_sent = $subscribe_data;

				if ( empty( $subscriber ) ) {
					$details = __( 'Something went wrong. Unable to add subscriber.', Opt_In::TEXT_DOMAIN );
				} else{
					$is_sent = true;
					$details = __( 'Successfully added or updated member on Aweber list', Opt_In::TEXT_DOMAIN );
					if( ! empty( $subscriber->data ) && ! empty( $subscribe_data['custom_fields'] ) ) {
						// Let's double check if all custom fields are successfully added
						$found_missing_field = 0;

						foreach ( array_filter( $subscribe_data['custom_fields'] ) as $label => $field ) {
							if ( ! isset( $subscriber->data['custom_fields'][ $label ] ) || empty( $subscriber->data['custom_fields'][ $label ] ) ) {
								$found_missing_field++;
							}
						}

						if ( $found_missing_field > 0 ) {
							$details = __( 'Some fields are not successfully added.', Opt_In::TEXT_DOMAIN );
						}
					}
				}
			}

			$entry_fields = array(
				array(
					'name'  => 'status',
					'value' => array(
						'is_sent'       => $is_sent,
						'description'   => $details,
						'member_status' => $member_status,
						'data_sent'     => $utils->get_last_data_sent(),
						'data_received' => $utils->get_last_data_received(),
						'url_request'   => $utils->get_last_url_request(),
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

		if ( empty( $submitted_data['email'] ) ) {
			return __( 'Required Field "email" was not filled by the user.', Opt_In::TEXT_DOMAIN );
		}

		if ( ! $allow_subscribed ) {

			/**
			 * Filter submitted form data to be processed
			 *
			 * @since 4.0
			 *
			 * @param array                                    $submitted_data
			 * @param int                                      $module_id                current module_id
			 * @param Hustle_Aweber_Form_Settings $form_settings_instance
			 */
			$submitted_data = apply_filters(
				'hustle_provider_aweber_form_submitted_data_before_validation',
				$submitted_data,
				$module_id,
				$form_settings_instance
			);

			//TODO: Handle this better once API lib is updated
			//triggers exception if not found.
			$account = $addon->get_account();
			$account_id =  isset( $account->data, $account->data['id'] ) ? $account->data['id'] : false;
			$list_id = $addon_setting_values['list_id'];
			$url = "/accounts/{$account_id}/lists/{$list_id}";
			$list = $account->loadFromUrl($url);
			$search_data = array( 'email' => $submitted_data['email'] );
			$find_by_email = $list->subscribers->find( $search_data );

			if ( ! empty( $find_by_email ) && ! empty( $find_by_email->data ) && ! empty( $find_by_email->data['entries'] ) ) {
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
		 * @param Hustle_Aweber_Form_Settings $form_settings_instance
		 */
		$is_success = apply_filters(
			'hustle_provider_aweber_form_submitted_data_after_validation',
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
