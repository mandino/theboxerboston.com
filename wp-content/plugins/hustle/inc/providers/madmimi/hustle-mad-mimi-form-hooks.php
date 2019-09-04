<?php

/**
 * Class Hustle_Mad_Mimi_Form_Hooks
 * Define the form hooks that are used by Mad Mimi
 *
 * @since 4.0
 */
class Hustle_Mad_Mimi_Form_Hooks extends Hustle_Provider_Form_Hooks_Abstract {


	/**
	 * Add Mad Mimi data to entry.
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
			$username = $addon->get_setting( 'username', '', $global_multi_id );

			$list_id = $addon_setting_values['list_id'];
			$submitted_data = $this->check_legacy( $submitted_data );
			$subscribe_data = array();
			$subscribe_data['email'] =  $submitted_data['email'];

			$email_exist = $this->email_exist( $subscribe_data['email'], $api_key, $username, $list_id );

			$is_sent = false;
			$member_status = __( 'Member could not be subscribed.', Opt_In::TEXT_DOMAIN );

			if( $email_exist ){

				$email = $subscribe_data['email']; 
				unset( $subscribe_data['email'] );

				// Add extra fields
				$extra_data = array_diff_key( $submitted_data, array(
					'email' => '',
				) );
				$extra_data = array_filter( $extra_data );

				if ( ! empty( $extra_data ) ) {
					$subscribe_data = array_merge( $subscribe_data, $extra_data );
				}
				$res = $addon::api( $username, $api_key )->update_subscriber( $email, $subscribe_data );
				
			} else {

				$name = array();

				if ( ! empty( $submitted_data['first_name'] ) ) {
					$name['first_name'] = $submitted_data['first_name'];
				}
				if ( ! empty( $submitted_data['last_name'] ) ) {
					$name['last_name'] = $submitted_data['last_name'];
				}

				if( count( $name ) )
					$subscribe_data['name'] = implode(" ", $name);

				// Add extra fields
				$extra_data = array_diff_key( $submitted_data, array(
					'email' => '',
					'first_name' => '',
					'last_name' => '',
				) );

				$extra_data = array_filter( $extra_data );

				if ( ! empty( $extra_data ) ) {
					$subscribe_data = array_merge( $subscribe_data, $extra_data );
				}

				$res = $addon::api( $username, $api_key )->subscribe( $list_id, $subscribe_data );
			}

			if ( is_wp_error( $res ) ) {
				$details = $res->get_error_message();
			} else {
				$is_sent = true;
				$member_status = __( 'OK', Opt_In::TEXT_DOMAIN );
				$details = __( 'Successfully added or updated member on Mad Mimi list', Opt_In::TEXT_DOMAIN );
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
			 * @param Hustle_Mad_Mimi_Form_Settings $form_settings_instance
			 */
			$submitted_data = apply_filters(
				'hustle_provider_mad_mimi_form_submitted_data_before_validation',
				$submitted_data,
				$module_id,
				$form_settings_instance
			);

			//triggers exception if not found.
			$global_multi_id 	= $addon_setting_values['selected_global_multi_id'];
			$list_id 			= $addon_setting_values['list_id'];
			$api_key 			= $addon->get_setting( 'api_key', '', $global_multi_id );
			$username 			= $addon->get_setting( 'username', '', $global_multi_id );
			$existing_member 	= $this->email_exist( $submitted_data['email'], $api_key, $username, $list_id );
			
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
		 * @param Hustle_Mad_Mimi_Form_Settings $form_settings_instance
		 */
		$is_success = apply_filters(
			'hustle_provider_mad_mimi_form_submitted_data_after_validation',
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
	 * Validate if email already subscribe
	 *
	 * @param string $email - Current guest user email address.
	 * @param $api_key
	 * @param $username
	 * @param $list_id
	 *
	 * @return bool Returns true if the specified email already subscribe otherwise false.
	 */
	private function email_exist( $email, $api_key, $username, $list_id ) {
		$addon = $this->addon;
		$api = $addon::api( $username, $api_key );
		$res = $api->search_by_email( $email );

		if ( is_object( $res ) && ! empty( $res->member ) && $email === (string)$res->member->email ) {
			$_lists = $api->search_email_lists( $email );
			if( !is_wp_error( $_lists ) && !empty( $_lists ) ) {
				if ( !is_array( $_lists ) ) {
					$_lists = array( $_lists );
				}
				foreach( $_lists as $list ){
					$list = (object) (array) $list;
					$list = $list->{'@attributes'};
					if ( $list['id'] === $list_id ) {
						return true;
					}
				}
			}

		}
		return false;
	}

}
