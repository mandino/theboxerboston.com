<?php

/**
 * Class Hustle_Mailchimp_Form_Hooks
 * Define the form hooks that are used by Mailchimp
 *
 * @since 4.0
 */
class Hustle_Mailchimp_Form_Hooks extends Hustle_Provider_Form_Hooks_Abstract {

	public function __construct( Hustle_Provider_Abstract $addon, $module_id ) {
		parent::__construct( $addon, $module_id );
		add_filter( 'hustle_format_submitted_data', array( $this, 'format_submitted_data' ), 10, 2 );
	}

	/**
	 * Add Mailchimp data to entry.
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

		$global_multi_id = $addon_setting_values['selected_global_multi_id'];
		$api_key = $addon->get_setting( 'api_key', '', $global_multi_id );

		try {
			$api = $addon->get_api( $api_key );

			if ( empty( $submitted_data['email'] ) ) {
				throw new Exception( __('Required Field "email" was not filled by the user.', Opt_In::TEXT_DOMAIN ) );
			}

			$list_id = $addon_setting_values['list_id'];
			$list_id = apply_filters(
				'hustle_provider_mailchimp_add_update_member_request_mail_list_id',
				$list_id,
				$module_id,
				$submitted_data,
				$form_settings_instance
			);
			$sub_status = 'subscribed' === $addon_setting_values['auto_optin'] ? 'subscribed' : 'pending';

			$email =  $submitted_data['email'];
			$submitted_data = $this->check_legacy( $submitted_data );
			$merge_vals = array();
			$interests = array();

			if ( isset( $submitted_data['first_name'] ) ) {
				$merge_vals['MERGE1'] = $submitted_data['first_name'];
				$merge_vals['FNAME'] = $submitted_data['first_name'];
			}
			if ( isset( $submitted_data['last_name'] ) ) {
				$merge_vals['MERGE2'] = $submitted_data['last_name'];
				$merge_vals['LNAME'] = $submitted_data['last_name'];
			}
			// Add extra fields
			$merge_data = array_diff_key( $submitted_data, array(
				'email' => '',
				'first_name' => '',
				'last_name' => '',
				'mailchimp_group_id' => '',
				'mailchimp_group_interest' => '',
			) );
			$merge_data = array_filter( $merge_data );


			if ( ! empty( $merge_data ) ) {
				$merge_vals = array_merge( $merge_vals, $merge_data );
			}
			$merge_vals = array_change_key_case($merge_vals, CASE_UPPER);

			/**
			 * Add args for interest groups
			 */
			if( ! empty( $submitted_data['mailchimp_group_id'] ) && ! empty( $submitted_data['mailchimp_group_interest'] ) ){
				$data_interest = (array) $submitted_data['mailchimp_group_interest'];
				foreach( $data_interest as $interest ) {
					$interests[$interest] = true;
				}
			}

			$subscribe_data = array(
				'email_address' => $email,
				'status'        => $sub_status
			);
			if ( ! empty( $merge_vals ) ) {
				$subscribe_data['merge_fields'] = $merge_vals;
			}
			if ( ! empty( $interests ) ) {
				$subscribe_data['interests'] = $interests;
			}

			$error_detail = __( 'Something went wrong.', Opt_In::TEXT_DOMAIN );
			try {
				$existing_member = $addon->get_member( $email, $list_id, $submitted_data, $api_key );
				if ( ! is_wp_error( $existing_member ) && $existing_member ) {
					$member_interests = isset($existing_member->interests) ? (array) $existing_member->interests : array();
					$can_subscribe = true;
					if ( isset( $subscribe_data['interests'] ) ) {

						$local_interest_keys = array_keys( $subscribe_data['interests'] );
						if ( !empty( $member_interests ) ) {
							foreach( $member_interests as $member_interest => $subscribed ){
								if( !$subscribed && in_array( $member_interest, $local_interest_keys, true ) ){
									$can_subscribe = true;
								}
							}
						} else {
							$can_subscribe = true;
						}
					}

					if ( 'pending' === $existing_member->status ) {
						$can_subscribe = true;
					}

					if ( 'unsubscribed' === $existing_member->status ) {
						// Resend Confirm Subscription Email even if `Automatically opt-in new users to the mailing list` is set
						$subscribe_data['status'] = 'pending';
						$can_subscribe = true;
					} else {
						unset( $subscribe_data['status'] );
					}

					if ( $can_subscribe ) {
						unset( $subscribe_data['email_address'] );

						$subscribe_data = apply_filters(
							'hustle_provider_mailchimp_update_member_request_args',
							$subscribe_data,
							$module_id,
							$submitted_data,
							$form_settings_instance,
							$list_id,
							$email
						);
						do_action( 'hustle_provider_mailchimp_before_update_member',
							$subscribe_data,
							$module_id,
							$submitted_data,
							$form_settings_instance,
							$list_id,
							$email
						);

						$response = $api->update_subscription_patch( $list_id, $email, $subscribe_data );
					} else {
						$error_message = __( 'This email address has already subscribed', Opt_In::TEXT_DOMAIN );
						throw new Exception( $error_message );
					}

					// TODO: translate.
					$member_status = $existing_member->status;

				} elseif ( is_wp_error( $existing_member ) ) {
					$error_data = json_decode( $existing_member->get_error_data(), true );
					$error_message = __( 'Error', Opt_In::TEXT_DOMAIN ) . ': ' . $error_data['status'] . ' - ' . $error_data['title'] . '. ' . $error_data['detail'];
					throw new Exception( $error_message );

				} else {
					$subscribe_data = apply_filters(
						'hustle_provider_mailchimp_add_member_request_args',
						$subscribe_data,
						$module_id,
						$submitted_data,
						$form_settings_instance,
						$list_id
					);
					do_action( 'hustle_provider_mailchimp_before_update_member',
						$subscribe_data,
						$module_id,
						$submitted_data,
						$form_settings_instance,
						$list_id
					);
					$response = $api->subscribe( $list_id, $subscribe_data );

					// TODO: handle errors here.

					$member_status = $subscribe_data['status'];
				}

				$is_sent = true;

			} catch( Exception $e ) {
				$is_sent = false;
				$member_status = __( 'Member could not be subscribed.', Opt_In::TEXT_DOMAIN );
				$error_detail = $e->getMessage();
			}

			$utils = Hustle_Provider_Utils::get_instance();

			$entry_fields = array(
				array(
					'name'  => 'status',
					'value' => array(
						'is_sent'       => $is_sent,
						'description'   => $is_sent ? __( 'Successfully added or updated member on MailChimp list', Opt_In::TEXT_DOMAIN ) : $error_detail,
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

		if ( !empty( $addon_setting_values['group_name'] ) ) {
			$entry_fields[0]['value']['group_name'] = $addon_setting_values['group_name'];
		}

		if ( ! empty( $interests ) ) {
			$interest_name = array();
			foreach( $interests as $key => $interest ) {
				$interest_name[] = !empty( $addon_setting_values['interest_options'][ $key ] )
					? $addon_setting_values['interest_options'][ $key ] : __( 'Noname', Opt_In::TEXT_DOMAIN );
			}
			$entry_fields[0]['value']['group_interest_name'] = implode( ', ', $interest_name );
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
	 * Add the groups' and interests' form fields in front.
	 *
	 * @since 4.0
	 *
	 * @param Hustle_Module_Model $module
	 * @return string
	 */
	public function add_front_form_fields( Hustle_Module_Model $module ) {

		$settings = $this->form_settings_instance->get_form_settings_values();

		if ( ! isset( $settings['group'] ) || '-1' === $settings['group'] ) {
			return '';
		}

		$template_path = plugin_dir_path( __FILE__ ) . 'views/front-fields-template.php';
		$interest_options = Hustle_Mailchimp::get_instance()->get_interest_options( $module );
		$default_interest = 'checkboxes' !== $settings['group_type'] ? '' : array();

		$args = array(
			'module_id' => $module->module_id,
			'group_id' => $settings['group'],
			'group_name' => $settings['group_name'],
			'group_type' => $settings['group_type'],
			'interest_options' => $interest_options,
			'selected_interest' => ! empty( $settings['group_interest'] ) ? $settings['group_interest'] : $default_interest,
		);

		return Opt_In::static_render( $template_path, $args, true );
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
		$api 						= $addon->get_api( $addon->get_setting( 'api_key', '', $global_multi_id ) );

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
			 * @param Hustle_Mailchimp_Form_Settings $form_settings_instance
			 */
			$submitted_data = apply_filters(
				'hustle_provider_mailchimp_form_submitted_data_before_validation',
				$submitted_data,
				$module_id,
				$form_settings_instance
			);

			//triggers exception if not found.
			$is_sub = $api->check_email( $addon_setting_values['list_id'], $submitted_data['email'] );

			if( ! is_wp_error( $is_sub ) )
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
		 * @param Hustle_Mailchimp_Form_Settings $form_settings_instance
		 */
		$is_success = apply_filters(
			'hustle_provider_mailchimp_form_submitted_data_after_validation',
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
	 * Format submitted data
	 *
	 * @since 4.0
	 * @param array $submitted_data
	 * @param string $slug Provider slug
	 * @return array
	 */
	public function format_submitted_data( $submitted_data, $slug ) {
		if ( 'mailchimp' !== $slug ) {
			unset( $submitted_data['mailchimp_group_id'], $submitted_data['mailchimp_group_interest'] );
		}

		return $submitted_data;
	}
}

