<?php

/**
 * Class Hustle_ConvertKit_Form_Hooks
 * Define the form hooks that are used by ConvertKit
 *
 * @since 4.0
 */
class Hustle_ConvertKit_Form_Hooks extends Hustle_Provider_Form_Hooks_Abstract {


	/**
	 * Add ConvertKit data to entry.
	 *
	 * @since 4.0
	 *
	 * @param array $submitted_data
	 * @return array
	 */
	public function add_entry_fields( $submitted_data ) {

		$addon = $this->addon;
		$module_id = $this->module_id;
		$module = Hustle_Module_Model::instance()->get( $module_id );
		if ( is_wp_error( $module ) ) {
			return;
		}
		$form_settings_instance = $this->form_settings_instance;
		$utils = Hustle_Provider_Utils::get_instance();

		/**
		 * @since 4.0
		 */
		$submitted_data = apply_filters( 'hustle_provider_' . $addon->get_slug() . '_form_submitted_data', $submitted_data, $module_id, $form_settings_instance );

		$addon_setting_values = $form_settings_instance->get_form_settings_values();

		try {
			$global_multi_id = $addon_setting_values['selected_global_multi_id'];
			$api_key = $addon->get_setting( 'api_key', '', $global_multi_id );
			$api_secret = $addon->get_setting( 'api_secret', '', $global_multi_id );
			$api = $addon::api( $api_key, $api_secret );

			if ( empty( $submitted_data['email'] ) ) {
				throw new Exception( __( 'Required Field "email" was not filled by the user.', Opt_In::TEXT_DOMAIN ) );
			}

			$list_id = $addon_setting_values['list_id'];
			$submitted_data = $this->check_legacy( $submitted_data );
			$existing_member = $api->is_form_subscriber( $submitted_data['email'], $list_id );
			$is_sent = false;
			$member_status = __( 'Member could not be subscribed.', Opt_In::TEXT_DOMAIN );

			// deal with custom fields first
			$custom_fields = array(
				'ip_address' => array(
					'label' => 'IP Address',
				),
			);
			// Extra fields
			$additional_fields = array_diff_key( $submitted_data, array(
				'email' => '',
				'first_name' => '',
			) );
			$additional_fields = array_filter( $additional_fields );
			$subscribe_data_fields = array();

			if ( $additional_fields && is_array( $additional_fields ) && count( $additional_fields ) > 0 ) {
				foreach ( $additional_fields as $field_name => $value ) {
					$meta_key 	= 'cv_field_' . $field_name;
					$meta_value = $module->get_meta( $meta_key );

					if ( ! $meta_value || $meta_value !== $field_name ) {
						$custom_fields[ $field_name ] = array(
							'label' => $field_name,
						);
					}

					if ( isset( $submitted_data[ $field_name ] ) ) {
						$subscribe_data_fields[ $field_name ] = $submitted_data[ $field_name ];
					}
				}
			}

			if ( ! $addon->maybe_create_custom_fields( $global_multi_id, $custom_fields ) ) {
				$details = __( 'Unable to add custom field.', Opt_In::TEXT_DOMAIN );
			} else {
				// subscription
				$name = isset( $submitted_data['first_name'] ) ? $submitted_data['first_name'] : '';

				$subscribe_data = array(
					'api_key' 	=> $api_key,
					'first_name'=> $name,
					'email' 	=> $submitted_data['email'],
					'fields' 	=> array(
						'ip_address' => Opt_In_Geo::get_user_ip(),
					),
				);
				$subscribe_data['fields'] = wp_parse_args( $subscribe_data_fields, $subscribe_data['fields'] );
				if ( false !== $existing_member ) {
					$res = $api->update_subscriber( $existing_member, $subscribe_data );
				} else {
					$res = $api->subscribe( $list_id, $subscribe_data );
				}

				if ( is_wp_error( $res ) ) {
					$details = $res->get_error_message();
				} else {
					$is_sent = true;
					$details = __( 'Successfully added or updated member on ConvertKit list', Opt_In::TEXT_DOMAIN );

				}

				if ( !empty( $res->subscription->subscriber->state ) ) {
					$member_status = $res->subscription->subscriber->state;
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
			 * @param Hustle_ConvertKit_Form_Settings $form_settings_instance
			 */
			$submitted_data = apply_filters(
				'hustle_provider_convertkit_form_submitted_data_before_validation',
				$submitted_data,
				$module_id,
				$form_settings_instance
			);

			//triggers exception if not found.
			$global_multi_id = $addon_setting_values['selected_global_multi_id'];
			$api_key = $addon->get_setting( 'api_key', '', $global_multi_id );
			$api_secret = $addon->get_setting( 'api_secret', '', $global_multi_id );
			$api = $addon::api( $api_key, $api_secret );
			$list_id = $addon_setting_values['list_id'];
			$existing_member = $api->is_form_subscriber( $submitted_data['email'], $list_id );

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
		 * @param Hustle_ConvertKit_Form_Settings $form_settings_instance
		 */
		$is_success = apply_filters(
			'hustle_provider_convertkit_form_submitted_data_after_validation',
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
