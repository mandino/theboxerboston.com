<?php

/**
 * Class Hustle_Sendgrid_Form_Hooks
 * Define the form hooks that are used by Sendgrid
 *
 * @since 4.0
 */
class Hustle_Sendgrid_Form_Hooks extends Hustle_Provider_Form_Hooks_Abstract {


	/**
	 * Add SendGrid data to entry.
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

			$global_multi_id = $addon_setting_values['selected_global_multi_id'];
			$api_key = $addon->get_setting( 'api_key', '', $global_multi_id );
			$api = $addon::api( $api_key );

			$list_id = $addon_setting_values['list_id'];

			$submitted_data = $this->check_legacy( $submitted_data );
			$is_sent = false;
			$member_status = __( 'Member could not be subscribed.', Opt_In::TEXT_DOMAIN );

			$existing_member = $api->email_exists( $submitted_data['email'], $list_id );

			// Add extra fields
			$extra_data = array_diff_key( $submitted_data, array(
				'email' => '',
				'first_name' => '',
				'last_name' => '',
			) );

			$extra_data 	= array_filter( $extra_data );
			$submitted_data = array_filter( $submitted_data );

			if ( ! empty( $extra_data ) ) {
				$custom_fields = array();
				foreach ( $extra_data as $key => $value ) {
					$custom_fields[] = array(
						'name' => $key,
						'type' => 'text',
					);

				}
				$addon->add_custom_fields( $custom_fields, $api );
			}

			if ( $existing_member ) {
				$res = $api->update_recipient( $submitted_data );
			} else {
				$res = $api->create_and_add_recipient_to_list( $list_id, $submitted_data );
			}

			if ( is_wp_error( $res ) ) {
				$details = $res->get_error_message();
			} else {
				$is_sent = true;
				$details = __( 'Successfully added or updated member on SendGrid list', Opt_In::TEXT_DOMAIN );
				$member_status = __( 'OK', Opt_In::TEXT_DOMAIN );
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
			 * @param Hustle_Sendgrid_Form_Settings $form_settings_instance
			 */
			$submitted_data = apply_filters(
				'hustle_provider_sendgrid_form_submitted_data_before_validation',
				$submitted_data,
				$module_id,
				$form_settings_instance
			);

			//triggers exception if not found.
			$global_multi_id 	= $addon_setting_values['selected_global_multi_id'];
			$api_key 			= $addon->get_setting( 'api_key', '', $global_multi_id );
			$api 				= $addon::api( $api_key );
			$list_id 			= $addon_setting_values['list_id'];
			$existing_member 	= $api->email_exists( $submitted_data['email'], $list_id );

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
		 * @param Hustle_Sendgrid_Form_Settings $form_settings_instance
		 */
		$is_success = apply_filters(
			'hustle_provider_sendgrid_form_submitted_data_after_validation',
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
