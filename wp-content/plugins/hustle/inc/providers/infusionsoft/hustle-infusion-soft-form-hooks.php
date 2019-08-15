<?php

/**
 * Class Hustle_InfusionSoft_Form_Hooks
 * Define the form hooks that are used by InfusionSoft
 *
 * @since 4.0
 */
class Hustle_InfusionSoft_Form_Hooks extends Hustle_Provider_Form_Hooks_Abstract {


	/**
	 * Add InfusionSoft data to entry.
	 *
	 * @since 4.0
	 *
	 * @param array $submitted_data
	 *
	 * @return array
	 */
	public function add_entry_fields( $submitted_data ) {

		$module_id = $this->module_id;
		$form_settings_instance = $this->form_settings_instance;

		$response = array(
			'is_sent'       => false,
			'description'   => '',
			'data_sent'     => '',
			'data_received' => '',
			'url_request'   =>  '',
		);

		/**
		 * @since 4.0
		 */
		$submitted_data = apply_filters( 'hustle_provider_' . $this->addon->get_slug() . '_form_submitted_data', $submitted_data, $module_id, $form_settings_instance );

		$addon_setting_values = $form_settings_instance->get_form_settings_values();

		try {
			$addon = $this->addon;
			$global_multi_id = $addon_setting_values['selected_global_multi_id'];
			$api_key = $addon->get_setting( 'api_key', '', $global_multi_id );
			$account_name = $addon->get_setting( 'account_name', '', $addon_setting_values['selected_global_multi_id'] );
			$api = Hustle_Infusion_Soft::api( $api_key, $account_name );

			if ( empty( $submitted_data['email'] ) ) {
				throw new Exception( __( 'Required Field "email" was not filled by the user.', Opt_In::TEXT_DOMAIN ) );
			}

			$submitted_data = $this->check_legacy( $submitted_data );

			if ( isset( $submitted_data['email'] ) ) {
				$submitted_data['Email'] = $submitted_data['email'];
			}
			if ( isset( $submitted_data['first_name'] ) ) {
				$submitted_data['FirstName'] = $submitted_data['first_name'];
			}
			if ( isset( $submitted_data['last_name'] ) ) {
				$submitted_data['LastName'] = $submitted_data['last_name'];
			}
			$submitted_data = array_diff_key( $submitted_data, array(
				'email'      => '',
				'first_name' => '',
				'last_name'  => '',
			) );

			$module = Hustle_Module_Model::instance()->get( $module_id );
			if ( is_wp_error( $module ) ) {
				return $module;
			}

			$utils = Hustle_Provider_Utils::get_instance();
			$custom_fields = $api->get_custom_fields();

			// If there were errors when connecting to the api.
			if ( isset( $custom_fields->errors ) ) {

				$response = array(
					'is_sent'       => false,
					'description'   => '',
					'data_sent'     => $utils->get_last_data_sent(),
					'data_received' => $utils->get_last_data_received(),
					'url_request'   =>  $utils->get_last_url_request(),
				);

			} else { // If there weren't errors.
 
				$extra_custom_fields = array_diff_key( $submitted_data, array_fill_keys( $custom_fields, 1 ) );
				$found_extra = array();
	
				if ( ! empty( $extra_custom_fields ) ) {
	
					foreach ( $extra_custom_fields as $key => $value ) {
	
						$label = str_replace( ' ', '', ucwords( $key ) );
	
						// Attempt to check the label
						if ( in_array( $label, $custom_fields, true ) ) {
							$submitted_data[ $label ] = $value;
						} else {
							$found_extra[ $key ] = $value;
						}
						unset( $submitted_data[ $key ] );
					}
				}
	
				if ( ! empty( $found_extra ) ) {
	
					$response = array(
						'is_sent'       => false,
						'description'   => __( 'Some fields are not successfully added.', Opt_In::TEXT_DOMAIN ),
						'data_sent'     => $utils->get_last_data_sent(),
						'data_received' => $utils->get_last_data_received(),
						'url_request'   =>  $utils->get_last_url_request(),
					);
				}

				$email_exists = $api->email_exist( $submitted_data['Email'] );
	
				if ( $email_exists ) {
					$contact_id = $api->update_contact( $submitted_data );
				} else {
					$contact_id = $api->add_contact( $submitted_data );
				}
	
				if ( is_wp_error( $contact_id ) ) {
					$response = array(
						'is_sent'       => false,
						'description'   => $contact_id->get_error_message(),
						'data_sent'     => $utils->get_last_data_sent(),
						'data_received' => $utils->get_last_data_received(),
						'url_request'   => $utils->get_last_url_request(),
					);
	
				} else {
	
					$response = array(
						'is_sent'       => true,
						'description'   => __( 'Successfully added or updated member on InfusionSoft list', Opt_In::TEXT_DOMAIN ),
						'data_sent'     => $utils->get_last_data_sent(),
						'data_received' => $utils->get_last_data_received(),
						'url_request'   => $utils->get_last_url_request(),
					);
				}

			}

		} catch ( Exception $e ) {
			$entry_fields = $this->exception( $e );
		}

		if ( ! isset( $entry_fields ) ) {
			$entry_fields = array(
				array(
					'name'  => 'status',
					'value' => $response,
				),
			);
		}

		return apply_filters( 'hustle_provider_' . $this->addon->get_slug() . '_entry_fields',
			$entry_fields,
			$module_id,
			$submitted_data,
			$form_settings_instance
		);
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
			 * @param Hustle_InfusionSoft_Form_Settings $form_settings_instance
			 */
			$submitted_data = apply_filters(
				'hustle_provider_infusionsoft_form_submitted_data_before_validation',
				$submitted_data,
				$module_id,
				$form_settings_instance
			);

			//triggers exception if not found.
			$global_multi_id 	= $addon_setting_values['selected_global_multi_id'];
			$api_key 			= $addon->get_setting( 'api_key', '', $global_multi_id );
			$account_name 		= $addon->get_setting( 'account_name', '', $addon_setting_values['selected_global_multi_id'] );
			$api 				= Hustle_Infusion_Soft::api( $api_key, $account_name );
			$existing_member 	= $api->email_exist( $submitted_data['email'] );
			
			if ( $existing_member )
				$is_success = self::ALREADY_SUBSCRIBED_ERROR;
		}
		
		/**
		 * Return `true` if success, or **(string) error message** on fail
		 *
		 * @since 4.0
		 *
		 * @param bool                                     $is_success
		 * @param int                                      $module_id                current module_id
		 * @param array                                    $submitted_data
		 * @param Hustle_InfusionSoft_Form_Settings $form_settings_instance
		 */
		$is_success = apply_filters(
			'hustle_provider_infusionsoft_form_submitted_data_after_validation',
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
