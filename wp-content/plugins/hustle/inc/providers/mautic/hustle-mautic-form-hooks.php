<?php

/**
 * Class Hustle_MauticForm_Hooks
 * Define the form hooks that are used by Mautic
 *
 * @since 4.0
 */
class Hustle_Mautic_Form_Hooks extends Hustle_Provider_Form_Hooks_Abstract {


	/**
	 * Add Mautic data to entry.
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
				throw new Exception( __( 'Required Field "email" was not filled by the user.', Opt_In::TEXT_DOMAIN ) );
			}

			$list_id = $addon_setting_values['list_id'];

			$submitted_data = $this->check_legacy( $submitted_data );
			$global_multi_id = $addon_setting_values['selected_global_multi_id'];

			$url = $addon->get_setting( 'url', '', $global_multi_id );
			$username = $addon->get_setting( 'username', '', $global_multi_id );
			$password = $addon->get_setting( 'password', '', $global_multi_id );

			if ( isset( $submitted_data['first_name'] ) ) {
				$submitted_data['firstname'] = $submitted_data['first_name'];
				unset( $submitted_data['first_name'] );
			}
			if ( isset( $submitted_data['last_name'] ) ) {
				$submitted_data['lastname'] = $submitted_data['last_name'];
				unset( $submitted_data['last_name'] );
			}

			$submitted_data['ipAddress'] = Opt_In_Geo::get_user_ip();

			$is_sent = false;
			$updated = false;

			$member_status = __( 'Member could not be subscribed.', Opt_In::TEXT_DOMAIN );

			$api = $addon::api( $url, $username, $password );

			$existing_member = $api->email_exist( $submitted_data['email'] );


			// Add extra fields
			$extra_data = array_diff_key( $submitted_data, array(
				'email' => '',
				'firstname' => '',
				'lastname' => '',
			) );
			$extra_data = array_filter( $extra_data );

			if ( ! empty( $extra_data ) ) {
				$custom_fields = array();
				foreach ( $extra_data as $key => $value ) {
					$custom_fields[] = array(
						'label' => $key,
						'name' => $key,
						'type' => 'text',
					);

				}
				$addon->add_custom_fields( $custom_fields, $api );
			}

			if ( false !== $existing_member && ! is_wp_error( $existing_member ) ) {
				$contact_id = $api->update_contact( $existing_member, $submitted_data );
				$updated = true;
			} else {
				$contact_id = $api->add_contact( $submitted_data );
			}

			if ( is_wp_error( $contact_id ) ) {
				// Remove ipAddress
				unset( $submitted_data['ipAddress'] );
				$error_code = $contact_id->get_error_code();

				$details = $contact_id->get_error_message( $error_code );
			} elseif( ! $updated ) {

				$api->add_contact_to_segment( $list_id, $contact_id );

				$is_sent = true;
				$details = __( 'Successfully added member on Mautic list', Opt_In::TEXT_DOMAIN );
				$member_status = __( 'Added', Opt_In::TEXT_DOMAIN );
			} else {

				$is_sent = true;
				$details = __( 'Successfully updated member on Mautic list', Opt_In::TEXT_DOMAIN );
				$member_status = __( 'Updated', Opt_In::TEXT_DOMAIN );
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
			 * @param Hustle_Mautic_Form_Settings $form_settings_instance
			 */
			$submitted_data = apply_filters(
				'hustle_provider_mautic_form_submitted_data_before_validation',
				$submitted_data,
				$module_id,
				$form_settings_instance
			);

			//triggers exception if not found.
			$global_multi_id 	= $addon_setting_values['selected_global_multi_id'];
			$url 				= $addon->get_setting( 'url', '', $global_multi_id );
			$username 			= $addon->get_setting( 'username', '', $global_multi_id );
			$password 			= $addon->get_setting( 'password', '', $global_multi_id );
			$api 				= $addon::api( $url, $username, $password );
			$existing_member 	= $api->email_exist( $submitted_data['email'] );

			if( false !== $existing_member && ! is_wp_error( $existing_member ) )
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
		 * @param Hustle_Mautic_Form_Settings $form_settings_instance
		 */
		$is_success = apply_filters(
			'hustle_provider_mautic_form_submitted_data_after_validation',
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
