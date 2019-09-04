<?php

/**
 * Class Hustle_Hubspot_Form_Hooks
 * Define the form hooks that are used by Hubspot
 *
 * @since 4.0
 */
class Hustle_Hubspot_Form_Hooks extends Hustle_Provider_Form_Hooks_Abstract {


	/**
	 * Add Hubspot data to entry.
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
			if ( empty( $submitted_data['email'] ) ) {
				throw new Exception( __('Required Field "email" was not filled by the user.', Opt_In::TEXT_DOMAIN ) );
			}

			$api = $addon->api();
			$list_id = $addon_setting_values['list_id'];
			$submitted_data = $this->check_legacy( $submitted_data );

			$is_sent = false;
			$member_status = __( 'Member could not be subscribed.', Opt_In::TEXT_DOMAIN );
			$details = __( 'Unable to add this subscriber', Opt_In::TEXT_DOMAIN );

			if ( !$api || $api->is_error ) {
				throw new Exception( __( 'Wrong API credentials', Opt_In::TEXT_DOMAIN ) );
			}

			// Extra fields
			$extra_data = array_diff_key( $submitted_data, array(
				'email' => '',
				'first_name' => '',
				'last_name' => '',
			) );
			$extra_data = array_filter( $extra_data );

			if ( !empty( $extra_data ) ) {
				$custom_fields = array();
				foreach ( $extra_data as $key => $value ) {
					$custom_fields[] = array(
						'name' => $key,
						'label' => $key,
					);

				}
				$addon->add_custom_fields( $custom_fields );
			}

			$email_exist = $api->email_exists( $submitted_data['email'] );
			
			if ( $email_exist && ! empty( $email_exist->vid ) ) {
				//Add to list
				$contact_id = '';

				if( ! empty( $email_exist->{'list-memberships'} ) ){
					$lists = wp_list_pluck( $email_exist->{'list-memberships'}, 'static-list-id' );
					if( ! in_array( absint( $list_id ), $lists, true) ){
						$contact_id = $email_exist->vid;
					}
				}

				$res = $api->update_contact( $email_exist->vid, $submitted_data );
				
				if ( is_wp_error( $res ) ) {
					$details = $res->get_error_message();
				} else if ( true !== $res ) {
					$details = __( 'Unable to update this contact to contact list.', Opt_In::TEXT_DOMAIN );
				} else {
					$is_sent = true;
					$member_status = __( 'OK', Opt_In::TEXT_DOMAIN );
					$details = __( 'Successfully updated member on Hubspot list', Opt_In::TEXT_DOMAIN );
				}

			} else {
				$contact_id = $api->add_contact( $submitted_data );

				if( is_wp_error( $contact_id ) ) {
					$details = $contact_id->get_error_message();
				} elseif ( isset( $contact_id->status ) && 'error' === $contact_id->status ) {
					$details = $contact_id->message;
				}
			}

			// Add contact to contact list
			if ( !empty( $contact_id ) && ! is_object( $contact_id ) && (int) $contact_id > 0 ) {
				$res = $api->add_to_contact_list( $contact_id, $submitted_data['email'], $list_id );

				if ( is_wp_error( $res ) ) {
					$details = $res->get_error_message();
				} else if ( true !== $res ) {
					$details = __( 'Unable to add this contact to contact list.', Opt_In::TEXT_DOMAIN );
				} else {
					$is_sent = true;
					$member_status = __( 'OK', Opt_In::TEXT_DOMAIN );
					$details = __( 'Successfully added or updated member on Hubspot list', Opt_In::TEXT_DOMAIN );
				}
			}

			$utils = Hustle_Provider_Utils::get_instance();
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
		$form_settings_instance 	= $this->form_settings_instance;
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
			 * @param Hustle_Hubspot_Form_Settings $form_settings_instance
			 */
			$submitted_data = apply_filters(
				'hustle_provider_hubspot_form_submitted_data_before_validation',
				$submitted_data,
				$module_id,
				$form_settings_instance
			);

			//triggers exception if not found.
			$api 				= $addon->api();
			$list_id 			= $addon_setting_values['list_id'];
			$existing_member 	= $this->_email_exists( $api, $submitted_data['email'], $list_id );
		
			if ( false !== $existing_member )
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
		 * @param Hustle_Hubspot_Form_Settings $form_settings_instance
		 */
		$is_success = apply_filters(
			'hustle_provider_hubspot_form_submitted_data_after_validation',
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

	/**
	 * Check if the email is present on the current list
	 * 
	 * @since 4.0
	 *
	 * @param $api
	 * @param $email
	 * @param $list_id
	 *
	 * @return bool
	 */
	private function _email_exists( $api, $email, $list_id ){

		$member = $api->email_exists( $email );

		if ( $member && ! empty( $member->vid ) && ! empty( $member->{'list-memberships'} ) ) {
			$lists = wp_list_pluck( $member->{'list-memberships'}, 'static-list-id' );
			
			return in_array( absint( $list_id ), $lists, true);
		}

		return false;
	}

}
