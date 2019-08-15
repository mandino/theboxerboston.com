<?php

class Hustle_Settings_Admin_Ajax {
	private $_hustle;

	private $_admin;

	public function __construct( Opt_In $hustle, Hustle_Settings_Admin $admin ) {
		$this->_hustle = $hustle;
		$this->_admin = $admin;

		add_action( 'wp_ajax_hustle_remove_ips', array( $this, 'remove_ip_from_tracking_data' ) );
		add_action( 'wp_ajax_hustle_toggle_module_for_user', array( $this, 'toggle_module_for_user' ) );
		// This is used in wizards. Should be moved into popup-admin-ajax instead, since there's where common ajax actions from wizards are.
		add_action( 'wp_ajax_hustle_shortcode_render', array( $this, 'shortcode_render' ) );

		/**
		 * save settings
		 */
		add_action( 'wp_ajax_hustle_save_settings', array( $this, 'ajax_settings_save' ) );
	}

	/**
	 * Filter IPs
	 *
	 * @since 4.0
	 * @param string $ip_string
	 * @return array valid IPs
	 */
	private function filter_ips( $ip_string ) {

		// Create an array with their values.
		$ip_array = preg_split( '/[\s,]+/', $ip_string, null, PREG_SPLIT_NO_EMPTY );

		// Remove from the array the IPs that are not valid IPs.
		foreach ( $ip_array as $key => $ip ) {
			if ( ! filter_var( $ip, FILTER_VALIDATE_IP ) ) {
				unset( $ip_array[ $key ] );
				continue;
			}
		}

		return $ip_array;
	}

	/**
	 * Remove the requested IPs from views and conversions on batches.
	 *
	 * @since 3.0.6
	 */
	public function remove_ip_from_tracking_data() {
		Opt_In_Utils::validate_ajax_call( 'hustle_remove_ips' );
		Opt_In_Utils::is_user_allowed_ajax( 'hustle_edit_settings' );

		/**
		 * From Tracking
		 */
		$range = filter_input( INPUT_POST, 'range', FILTER_SANITIZE_STRING );
		$tracking = Hustle_Tracking_Model::get_instance();
		global $hustle;
		$hustle_entries_admin = new Hustle_Entries_Admin( $hustle );
		if ( 'all' === $range ) {
			$tracking->set_null_on_all_ips();
			$hustle_entries_admin->delete_all_ip();
		} else {
			if ( ! empty( $range ) ) {
				$range = preg_replace( '/ /', '', $range );
				$r = preg_split( '/[\r\n]/', $range );
				$ios = array();
				foreach ( $r as $one ) {
					$is_valid = filter_var( $one, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
					if ( $is_valid ) {
						$ips[] = $one;
						continue;
					}
					$a = explode( '-', $one );
					if ( 2 !== sizeof( $a ) ) {
						continue;
					}
					$is_valid = filter_var( $a[0], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
					if ( ! $is_valid ) {
						continue;
					}
					$is_valid = filter_var( $a[1], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
					if ( ! $is_valid ) {
						continue;
					}
					$ips[] = array_map( 'ip2long', $a );
				}
				$tracking->set_null_on_selected_ips( $ips );
				$hustle_entries_admin->delete_selected_ips( $ips );
			}
		}

		/**
		 * TODO: entries!
		 */

		$module = Hustle_Module_Model::instance();

		// Define the transient name.
		$transient = 'hustle_removing_ip_data';

		// Get this request offset.
		$offset = absint( filter_input( INPUT_POST, 'offset', FILTER_SANITIZE_NUMBER_INT ) );

		// Amount of database entries checked by request.
		$increment = 50;

		if ( 0 === $offset ) {
			// Starting the first batch.
			// Set the array of the provided IPs, the meta_id list of all existing entries,
			// and the amount of entries we'll be checking to match the IPs so we know when to stop.

			// Make sure the transient is not already set.
			delete_transient( $transient );

			// Get a meta_id array containing all views and conversions entries.
			$id_array = $module->get_all_views_and_conversions_meta_id();
			$total = count( $id_array );

			// Get the string containing all the ips to be removed.
			$ip_string = filter_input( INPUT_POST, 'delete_ip', FILTER_SANITIZE_STRING );

			$ip_array = $this->filter_ips( $ip_string );

			// Limit the number of IPs.
			$ip_array = array_slice( $ip_array, 0, apply_filters( 'hustle_remove_selected_ips_from_tracking_limit', 10, $ip_array, $id_array ) );

			$api = new Opt_In_WPMUDEV_API();
			$salt = $api->get_nonce_value();

			$data_to_save = array(
				'total' => $total,
				'ip_array' => $ip_array,
				'id_array' => $id_array,
				'salt' => $salt,
			);
			set_transient( $transient, $data_to_save );

		} else {
			// If it's not the first batch, retrieve the values already stored on the first batch.
			$saved_data = get_transient( $transient );
			$total = absint( $saved_data['total'] );
			$ip_array = $saved_data['ip_array'];
			$id_array = $saved_data['id_array'];
			$salt = $saved_data['salt'];

		}

		// Retrieve the amount of rows updated on the previous batches
		// to retrieve it if we're done, or keep adding rows otherwise.
		$updated_rows = filter_input( INPUT_POST, 'updated', FILTER_SANITIZE_NUMBER_INT );

		// Slice the array to get the current batch.
		$batch = array_slice( $id_array, $offset, $increment );

		// If the batch is empty, or the offset is greater than the amount of metas,
		// delete the transient and finish the loop.
		if ( $offset > $total || empty( $batch ) ) {
			delete_transient( $transient );
			wp_send_json_success( array(
				'offset' => 'done',
				'updated' => $updated_rows,
			) );

		} else {
			// Process this batch of metas.
			// Get the meta_id and meta_value from this batch that matches the passed IPs.
			$metas = $module->get_metas_for_matching_meta_values_in_a_range( $batch, $ip_array );

			foreach ( $metas as $key => $value ) {
				// Update the IP of this meta_value and save it again.
				$stored_value = json_decode( $value['meta_value'], true );

				if ( isset( $stored_value['ip'] ) && in_array( $stored_value['ip'], $ip_array, true ) ) {
					$stored_ip = $stored_value['ip'];
					$stored_value['ip'] = md5( $salt . $stored_ip );
					$updated = $module->update_any_meta( $value['meta_id'], $stored_value );

					if ( $updated ) {
						// Increase the updated_rows number to display in front at the end of the process.
						$updated_rows++;
					}
				}
			}

			// Increment the offset to run the next batch.
			$offset += $increment;
			$response = array(
				'offset' => $offset,
				'updated' => $updated_rows,
			);
			wp_send_json_success( $response );

		}
	}

	public function toggle_module_for_user() {
		Opt_In_Utils::validate_ajax_call( 'hustle_modules_toggle' );
		Opt_In_Utils::is_user_allowed_ajax( 'hustle_edit_settings' );

		$id = filter_input( INPUT_POST, 'id', FILTER_VALIDATE_INT );
		$user_type = filter_input( INPUT_POST, 'user_type', FILTER_SANITIZE_STRING );

		$module = Hustle_Module_Model::instance()->get( $id );
		if ( is_wp_error( $module ) ) {
			wp_send_json_error();
		}
		$result = $module->toggle_activity_for_user( $user_type );
		if ( is_wp_error( $result ) ) {
			wp_send_json_error( $result->get_error_messages() );
		}
		wp_send_json_success( sprintf( __( 'Successfully toggled for user type %s', Opt_In::TEXT_DOMAIN ), $user_type ) );
	}

	/**
	 * Saves the global privacy settings.
	 *
	 * @since 4.0
	 */
	public function save_global_privacy_settings( $data ) {

		$ip_tracking = null;
		if ( isset( $data['ip_tracking'] ) ) {
			$ip_tracking = filter_var( $data['ip_tracking'], FILTER_SANITIZE_STRING );
			if ( ! preg_match( '/^(on|off)$/', $ip_tracking ) ) {
				$ip_tracking = 'on';
			}
		}
		//      $excluded_ips = array();
		//      if ( isset( $data['excluded_ips'] ) ) {
		//          $excluded_ips = $this->filter_ips( $data['excluded_ips'] );
		//      }
		$remove_all_ip = null;
		if ( isset( $data['remove_all_ip'] ) ) {
			$remove_all_ip = filter_var( $data['remove_all_ip'], FILTER_VALIDATE_BOOLEAN );
		}
		$remove_ips = array();
		if ( isset( $data['remove_ips'] ) ) {
			$remove_ips = $this->filter_ips( $data['remove_ips'] );
		}
		if ( is_null( $ip_tracking ) || is_null( $remove_all_ip ) ) {
			wp_send_json_error();
		}
		$value = array(
			'ip_tracking' => $ip_tracking,
			'remove_all_ip' => $remove_all_ip,
			'remove_ips' => $remove_ips,
		//          'excluded_ips' => $excluded_ips,
		);
		Hustle_Settings_Admin::update_hustle_settings( $value, 'privacy' );
		$this->send_success_notification();
	}

	/**
	 * Saves the global email sender name and email address.
	 *
	 * @since 3.0.5
	 */
	public function save_global_email_settings() {
		if (
			! isset( $_POST['data'] )
			|| ! isset( $_POST['data']['email'] )
		) {
			wp_send_json_error();
		}
		$name = '';
		if ( isset( $_POST['data']['title'] ) ) {
			$name = filter_var( $_POST['data']['title'], FILTER_SANITIZE_STRING );
		}
		$email = filter_var( $_POST['data']['email'], FILTER_SANITIZE_EMAIL );
		if ( ! is_email( $email ) ) {
			wp_send_json_error();
		}
		$value = array(
			'sender_email_name' => $name,
			'sender_email_address' => $email,
		);
		Hustle_Settings_Admin::update_hustle_settings( $value, 'emails' );
	}

	public function shortcode_render() {
		Opt_In_Utils::validate_ajax_call( 'hustle_shortcode_render' );
		Opt_In_Utils::is_user_allowed_ajax( 'hustle_edit_settings' );
		$content = filter_input( INPUT_POST, 'content' );
		$rendered_content = apply_filters( 'the_content', $content );
		wp_send_json_success( array(
			'content' => $rendered_content,
		));
	}

	/**
	 * Save the data under the Top Metric tab.
	 *
	 * @since 4.0
	 *
	 * @param array $data
	 * @return bool
	 */
	private function save_top_metrics_settings( $data ) {

		// Only 3 metrics can be selected. No more.
		if ( 3 < count( $data ) ) {
			return false;
		}

		$allowed_metric_keys = array( 'average_conversion_rate', 'today_conversions', 'last_week_conversions', 'last_month_conversions', 'total_conversions', 'most_conversions', 'inactive_modules_count', 'total_modules_count' );

		$data_to_store = array();
		foreach ( $data as $key => $value ) {
			if ( in_array( $key, $allowed_metric_keys, true ) ) {
				$data_to_store[] = $key;
			}
		}

		Hustle_Settings_Admin::update_hustle_settings( $data_to_store, 'selected_top_metrics' );

		return true;
	}

	/**
	 * Save the reCaptcha settings.
	 *
	 * @since 4.0
	 *
	 * @param array $data Submitted data to be saved
	 */
	private function save_recaptcha_settings( $data ) {
		$sitekey = '';
		if ( isset( $data['sitekey'] ) ) {
			$sitekey = filter_var( $data['sitekey'], FILTER_SANITIZE_STRING );
		}
		$secret = '';
		if ( isset( $data['secret'] ) ) {
			$secret = filter_var( $data['secret'], FILTER_SANITIZE_STRING );
		}
		$language = '';
		if ( isset( $data['language'] ) ) {
			$language = filter_var( $data['language'], FILTER_SANITIZE_STRING );
		}
		$value = array(
			'sitekey' => $sitekey,
			'secret' => $secret,
			'language' => $language,
		);
		Hustle_Settings_Admin::update_hustle_settings( $value, 'recaptcha' );
	}

	/**
	 * Save the Accessibility settings.
	 *
	 * @since 4.0
	 *
	 * @param array $data Submitted data to be saved
	 */
	private function save_accessibility_settings( $data ) {
		$color = null;
		if ( isset( $data['accessibility_color'] ) ) {
			$color = filter_var( $data['accessibility_color'], FILTER_VALIDATE_BOOLEAN );
		}
		if ( is_null( $color ) ) {
			wp_send_json_error();
		}
		$value = array(
			'accessibility_color' => $color,
		);
		Hustle_Settings_Admin::update_hustle_settings( $value, 'accessibility' );
	}

	/**
	 * Save the Unsubscribe settings.
	 *
	 * @since 4.0
	 *
	 * @param array $data Submitted data to be saved
	 * @return bool
	 */
	private function save_unsubscribe_settings( $data ) {

		$email_body = wp_json_encode( $data['email_message'] );
		$sanitized_data = Opt_In_Utils::validate_and_sanitize_fields( $data );

		// Save the messages to be displayed in the unsubscription process.
		$messages_data = array(
			'enabled' => isset( $sanitized_data['messages_enabled'] ) ? $sanitized_data['messages_enabled'] : '0',
			'get_lists_button_text' => $sanitized_data['get_lists_button_text'],
			'submit_button_text' => $sanitized_data['submit_button_text'],
			'invalid_email' => $sanitized_data['invalid_email'],
			'email_not_found' => $sanitized_data['email_not_found'],
			'invalid_data' => $sanitized_data['invalid_data'],
			'email_submitted' => $sanitized_data['email_submitted'],
			'successful_unsubscription' => $sanitized_data['successful_unsubscription'],
			'email_not_processed' => $sanitized_data['email_not_processed'],
		);

		// Save the unsubscription email settings.
		$email_data = array(
			'enabled' => isset( $sanitized_data['email_enabled'] ) ? $sanitized_data['email_enabled'] : '0',
			'email_subject' => $sanitized_data['email_subject'],
			'email_body' => $email_body,
		);

		$value = array(
			'messages' => $messages_data,
			'email' => $email_data,
		);
		Hustle_Settings_Admin::update_hustle_settings( $value, 'unsubscribe' );

		return true;

	}

	/**
	 * Save Hustle settings
	 *
	 * @since 4.0
	 *
	 * @todo Handle error messages
	 */
	public function ajax_settings_save() {
		Opt_In_Utils::validate_ajax_call( 'hustle-settings' );
		Opt_In_Utils::is_user_allowed_ajax( 'hustle_edit_settings' );

		$tab = filter_input( INPUT_POST, 'target', FILTER_SANITIZE_STRING );

		switch ( $tab ) {
			case 'permissions':
				$data = isset( $_POST['data'] ) ? $_POST['data'] : array(); // WPCS: CSRF ok.
				$roles = Opt_In_Utils::get_user_roles();

				foreach ( $data as $key => $value ) {

					$permission = '';
					$value = ! empty( $value ) ? $value : array();

					// "Edit" permission role for each module.
					if ( preg_match( '/^module\-(\d+)$/', $key, $matches ) ) {
						$update_edit_module = true;
						$id = $matches[1];
						$module = Hustle_Module_Model::instance()->get( $id );
						if ( ! is_wp_error( $module ) ) {
							$module->update_edit_role( $value );
						}

					} elseif ( 'create' === $key ) {
						// Global "Create" permission role.
						$permission = 'permission_create';
						Hustle_Settings_Admin::update_hustle_settings( $value, $permission );

					} elseif ( 'edit_integrations' === $key ) {
						// Global "Edit Integration" role.
						$permission = 'permission_edit_integrations';
						Hustle_Settings_Admin::update_hustle_settings( $value, $permission );

					} elseif ( 'access_emails' === $key ) {
						// Global "Access Email List" role.
						$permission = 'permission_access_emails';
						Hustle_Settings_Admin::update_hustle_settings( $value, $permission );

					} elseif ( 'edit_settings' === $key ) {
						// Global "Edit Settings" role.
						$permission = 'permission_edit_settings';
						Hustle_Settings_Admin::update_hustle_settings( $value, $permission );

					} else {
						continue;
					}

					if ( ! empty( $permission ) ) {
						$cap = str_replace( 'permission_', 'hustle_', $permission );
						foreach ( $roles as $role_key => $role_name ) {
							if ( 'administrator' === $role_key ) {
								continue;
							}
							// get the role object
							$role = get_role( $role_key );

							if ( ! $role ) {
								continue;
							}

							if ( in_array( $role_key, $value, true ) ) {
								// add capability
								$role->add_cap( $cap );
							} else {
								// remove capability
								$role->remove_cap( $cap );
							}
						}
					}
				}

				if ( ! empty( $update_edit_module ) ) {
					// add/remove hustle_edit_module capability
					Opt_In_Utils::update_hustle_edit_module_capability();
				}

				// add/remove hustle_menu capability
				$hustle_capabilities = array(
					'hustle_edit_module',
					'hustle_create',
					'hustle_edit_integrations',
					'hustle_access_emails',
					'hustle_edit_settings',
				);

				foreach ( $roles as $role_key => $role_name ) {
					$role = get_role( $role_key );
					$capabilities = $role->capabilities;
					if ( ! empty( array_intersect( array_keys( $capabilities ), $hustle_capabilities ) ) ) {
						$role->add_cap( 'hustle_menu' );
					} else {
						$role->remove_cap( 'hustle_menu' );
					}
				}
				/**
				 * success
				 */
				$this->send_success_notification();
				break;

			case 'top_metrics':
				parse_str( $_POST['data'], $data ); // WPCS: CSRF ok.
				$saved = $this->save_top_metrics_settings( $data );
				if ( $saved ) {
					$this->send_success_notification();
				} else {
					wp_send_json_error();
				}
				break;

			case 'analytics':
				$data = isset( $_POST['data'] ) ? $_POST['data'] : array(); // WPCS: CSRF ok.
				if ( isset( $data['enabled'] ) ) {
					$value = Hustle_Settings_Admin::get_hustle_settings( 'analytics' );
					$value['enabled'] = $data['enabled'];
					$reload = true;
				} else {
					$value = array(
						'enabled' => '1',
						'title' => isset( $data['title'] )? filter_var( $data['title'], FILTER_SANITIZE_STRING ):'',
						'role' => isset( $data['role'] )? filter_var( $data['role'], FILTER_SANITIZE_STRING ):'',
						'modules' => isset( $data['modules'] )? $data['modules']:array(),
					);
					$reload = false;
				}

				Hustle_Settings_Admin::update_hustle_settings( $value, 'analytics' );
				$this->send_success_notification( '', $reload );
				break;

			case 'recaptcha':
				$data = isset( $_POST['data'] ) ? $_POST['data'] : array(); // WPCS: CSRF ok.
				$this->save_recaptcha_settings( $data );
				$success_message = __( "reCAPTCHA configured successfully. You can now add reCAPTCHA field to your opt-in forms where you want the reCAPTCHA to appear.", Opt_In::TEXT_DOMAIN );
				$this->send_success_notification( $success_message );
				break;

			case 'accessibility':
				$data = isset( $_POST['data'] ) ? $_POST['data'] : array(); // WPCS: CSRF ok.
				$this->save_accessibility_settings( $data );
				$this->send_success_notification();
				break;

			case 'unsubscribe':
				parse_str( $_POST['data'], $data ); // WPCS: CSRF ok.
				$this->save_unsubscribe_settings( $data );
				$this->send_success_notification();
				break;

			case 'emails':
				$this->save_global_email_settings();
				$this->send_success_notification();
				break;

			case 'privacy':
				$data = isset( $_POST['data'] ) ? $_POST['data'] : array(); // WPCS: CSRF ok.
				$this->save_global_privacy_settings( $data );
				break;

			default: // Failed
				wp_send_json_error();
		}

		wp_send_json_error();
	}

	/**
	 * Call wp_send_json_success with the expected response
	 *
	 * @since 4.0
	 *
	 * @param string $message
	 * @param boolean $reload
	 */
	private function send_success_notification( $message = '', $reload = false ) {
		$response = array(
			'message' => $message, //if it's empty - use optin_vars.messages.settings_saved
			'reload'  => $reload,
		);
		wp_send_json_success( $response );
	}
}
