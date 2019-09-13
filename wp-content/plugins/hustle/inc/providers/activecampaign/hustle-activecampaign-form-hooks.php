<?php

/**
 * Class Hustle_ActiveCampaign_Form_Hooks
 * Define the form hooks that are used by ActiveCampaign
 *
 * @since 4.0
 */
class Hustle_ActiveCampaign_Form_Hooks extends Hustle_Provider_Form_Hooks_Abstract {


	/**
	 * Add ActiveCampaign data to entry.
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

			$api_url = $addon->get_setting( 'api_url', '', $global_multi_id );
			$api_key = $addon->get_setting( 'api_key', '', $global_multi_id );
			$api = $addon::api( $api_url, $api_key );

			if ( empty( $submitted_data['email'] ) ) {
				throw new Exception( __( 'Required Field "email" was not filled by the user.', 'wordpress-popup' ) );
			}

			$submitted_data = $this->check_legacy( $submitted_data );
			$submitted_data = $this->_check_default_fields( $submitted_data );

			$module = Hustle_Module_Model::instance()->get( $module_id );
			if ( is_wp_error( $module ) ) {
				return $module;
			}

			$sign_up_to = ( empty( $addon_setting_values['sign_up_to'] ) || 'form' !== $addon_setting_values['sign_up_to'] ) ? 'list' : $addon_setting_values['sign_up_to'];

			$is_list = empty( $addon_setting_values['sign_up_to'] ) || 'form' !== $addon_setting_values['sign_up_to'];
			$id = $is_list
					? $addon_setting_values['list_id']
					: $addon_setting_values['form_id'];

			$custom_fields = array_diff_key( $submitted_data, array(
				'first_name' => '',
				'last_name' => '',
				'email' => '',
				'phone' => '',
			) );
			$orig_data = $submitted_data;

			$existed_custom_fields 	= $api->get_custom_fields();

			$extra_custom_fields 	= array_diff( array_keys( $custom_fields ), wp_list_pluck( $existed_custom_fields, 'perstag' ) );
			$reserved_fields 		= array( 'FIRSTNAME', 'LASTNAME', 'EMAIL', 'PHONE' );

			if ( $extra_custom_fields ) {
				$field_labels = wp_list_pluck( $module->get_form_fields(), 'label', 'name' );
				$prepared_fields = array();
				foreach ( $extra_custom_fields as $new_field ) {
					if( ! in_array( strtoupper( $new_field ), $reserved_fields, true ) ){
						$prepared_fields[ $new_field ] = !empty( $field_labels[ $new_field ] ) ? $field_labels[ $new_field ] : $new_field;
					}
				}
				$api->add_custom_fields( $prepared_fields, $id, $module );
			}

			if ( ! empty( $custom_fields ) ) {
				foreach ( $custom_fields as $key => $value ) {
					if( ! in_array( strtoupper( $key ), $reserved_fields, true ) ) {
						$key = 'field[%' . $key . '%,0]';
						$submitted_data[ $key ] = $value;
					}
				}
			}

			$res = $api->subscribe( $id, $submitted_data, $module, $orig_data, $sign_up_to );

			if ( is_wp_error( $res ) ) {
				$is_sent = false;
				$member_status = __( 'Member could not be subscribed.', 'wordpress-popup' );
				$error_detail = $res->get_error_message();
			} else {
				$member_status = $res['result_message'];
				$is_sent = true;
			}

			$utils = Hustle_Provider_Utils::get_instance();
			$entry_fields = array(
				array(
					'name'  => 'status',
					'value' => array(
						'is_sent'       => $is_sent,
						'description'   => $is_sent ? __( 'Successfully added or updated member on ActiveCampaign list', 'wordpress-popup' ) : $error_detail,
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

		if ( !empty( $is_list ) && !empty( $addon_setting_values['list_name'] ) ) {
			$entry_fields[0]['value']['list_name'] = $addon_setting_values['list_name'];
		}

		if ( isset( $is_list ) && !$is_list && !empty( $addon_setting_values['form_name'] ) ) {
			$entry_fields[0]['value']['form_name'] = $addon_setting_values['form_name'];
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
		$api_url = $addon->get_setting( 'api_url', '', $global_multi_id );
		$api_key = $addon->get_setting( 'api_key', '', $global_multi_id );
		$api = $addon::api( $api_url, $api_key );

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
			 * @param Hustle_ActiveCampaign_Form_Settings $form_settings_instance
			 */
			$submitted_data = apply_filters(
				'hustle_provider_activecampaign_form_submitted_data_before_validation',
				$submitted_data,
				$module_id,
				$form_settings_instance
			);

			//triggers exception if not found.
			$is_sub = $api->email_exist( $submitted_data['email'], $addon_setting_values['list_id'] );

				if ( true === $is_sub )
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
		 * @param Hustle_ActiveCampaign_Form_Settings $form_settings_instance
		 */
		$is_success = apply_filters(
			'hustle_provider_activecampaign_form_submitted_data_after_validation',
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
	 * Check for default API fields
	 *
	 * @since 4.0
	 *
	 * @return array
	 */
	private function _check_default_fields( $data ){
		$uppercase = array_change_key_case( $data, CASE_UPPER );
		if( isset( $uppercase['FIRSTNAME'] ) && ( ! isset( $data['first_name'] ) || empty( $data['first_name'] ) ) ){
			$data['first_name'] = $uppercase['FIRSTNAME'];
		}
		if( isset( $uppercase['LASTNAME'] ) && ( ! isset( $data['last_name'] ) || empty( $data['last_name'] ) ) ){
			$data['last_name'] = $uppercase['LASTNAME'];
		}
		if( isset( $uppercase['PHONE'] ) && ( ! isset( $data['phone'] ) || empty( $data['phone'] ) ) ){
			$data['phone'] = $uppercase['PHONE'];
		}

		return $data;
	}
}
