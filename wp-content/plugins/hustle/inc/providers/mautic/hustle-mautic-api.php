<?php
/**
 * Mautic API Helper
 **/
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

if ( ! class_exists( 'Hustle_Mautic_Api' ) ) :
	require_once Opt_In::$vendor_path . 'mautic/api-library/lib/MauticApi.php';

	class Hustle_Mautic_Api {
		/**
		 * @var (string) Mautic installation URL
		 **/
		private $base_url;

		/**
		 * @var (string) The username use to login.
		 **/
		private $username;

		/**
		 * @var (string) The password use to authenticate.
		 **/
		private $password;

		/**
		 * @var (object) \MauticApi class instance
		 **/
		private $api;

		/**
		 * @var (object) \Mautic\Auth\ApiAuth class instance.
		 **/
		private $auth;

		public function __construct( $base_url, $username, $password ) {
			$this->base_url = $base_url;
			$this->username = $username;
			$this->password = $password;

			if ( ! empty( $base_url ) && ! empty( $username ) && ! empty( $password ) ) {
				$params = array(
					'baseUrl' => $this->base_url,
					'userName' => $this->username,
					'password' => $this->password,
				);

				$init_auth = new Mautic\Auth\ApiAuth();
				$this->auth = $init_auth->newAuth( $params, 'BasicAuth' );
				$this->api = new Mautic\MauticApi( $this->auth, $this->base_url );
			}
		}

		/**
		 * Retrieve the list of segments from Mautic installation.
		 **/
		public function get_segments( $offset = 0 ) {
			if ( ! $this->api ) {
				return false;
			}

			$segment_api = $this->api->newApi( 'segments', $this->auth, $this->base_url );

			try {
				$segments = $segment_api->getList( '', intval( $offset ) );

				if ( ! empty( $segments ) && ! empty( $segments['lists'] ) ) {
					return $segments;
				}
			} catch( Exception $e ) {
				return false;
			}
			return false;
		}

		/**
		 * Add contact to Mautic installation.
		 *
		 * @param (associative_array) $data			An array of contact details to add.
		 * @return Returns contact ID on success or WP_Error.
		 **/
		public function add_contact( $data ) {
			$err = new WP_Error();
			if ( ! $this->api ) {
				$err->add( 'subscribe_error', __( 'The API is not properly configured. Please contact the admin.', Opt_In::TEXT_DOMAIN ) );
				return $err;
			}
			$path = 'contacts';
			$contact_api = $this->api->newApi( $path, $this->auth, $this->base_url );

			try {
				$res = $contact_api->create( $data );

				$utils = Hustle_Provider_Utils::get_instance();
				$utils->_last_data_sent = $data;
				$utils->_last_url_request = $path . '/new';
				$utils->_last_data_received = $res;

				if ( $res && ! empty( $res['contact'] ) ) {
					$contact_id = $res['contact']['id'];

					// Double check custom fields
					if ( ! empty( $res['contact']['fields'] ) && ! empty( $res['contact']['fields']['core'] ) ) {
						$found_missing = 0;

						$contact_fields = array_keys( $res['contact']['fields']['core'] );
						$common_fields = array( 'firstname', 'lastname', 'email', 'ipAddress' );

						foreach ( $data as $key => $value ) {
							// Check only uncommon fields
							if ( ! in_array( $key, $common_fields, true ) && ! in_array( $key, $contact_fields, true ) ) {
								$found_missing++;
							}
						}

						if ( $found_missing > 0 ) {
							$data['error'] = __( 'Some fields are not added.', Opt_In::TEXT_DOMAIN );
							unset( $data['ipAddress'] );
						}
					}

					return $contact_id;
				} else {
					$err->add( 'subscribe_error', __( 'Something went wrong. Please try again', Opt_In::TEXT_DOMAIN ) );
				}
			} catch( Exception $e ) {
				$error = $e->getMessage();
				$err->add( 'subscribe_error', $error );
			}

			return $err;
		}		

		/**
		 * Add contact to Mautic installation.
		 *
		 * @param (associative_array) $data			An array of contact details to add.
		 * @return Returns contact ID on success or WP_Error.
		 **/
		public function update_contact( $id, $data ) {
			$err = new WP_Error();
			if ( ! $this->api ) {
				$err->add( 'subscribe_error', __( 'The API is not properly configured. Please contact the admin.', Opt_In::TEXT_DOMAIN ) );
				return $err;
			}
			$path = 'contacts';
			$contact_api = $this->api->newApi( $path, $this->auth, $this->base_url );

			try {
				$res = $contact_api->edit( $id, $data );
				
				$utils = Hustle_Provider_Utils::get_instance();
				$utils->_last_data_sent = $data;
				$utils->_last_url_request = $path . '/new';
				$utils->_last_data_received = $res;

				if ( $res && ! empty( $res['contact'] ) ) {
					$contact_id = $res['contact']['id'];

					// Double check custom fields
					if ( ! empty( $res['contact']['fields'] ) && ! empty( $res['contact']['fields']['core'] ) ) {
						$found_missing = 0;

						$contact_fields = array_keys( $res['contact']['fields']['core'] );
						$common_fields = array( 'firstname', 'lastname', 'email', 'ipAddress' );

						foreach ( $data as $key => $value ) {
							// Check only uncommon fields
							if ( ! in_array( $key, $common_fields, true ) && ! in_array( $key, $contact_fields, true ) ) {
								$found_missing++;
							}
						}

						if ( $found_missing > 0 ) {
							$data['error'] = __( 'Some fields are not added.', Opt_In::TEXT_DOMAIN );
							unset( $data['ipAddress'] );
						}
					}

					return $contact_id;
				} else {
					$err->add( 'subscribe_error', __( 'Something went wrong. Please try again', Opt_In::TEXT_DOMAIN ) );
				}
			} catch( Exception $e ) {
				$error = $e->getMessage();
				$err->add( 'subscribe_error', $error );
			}

			return $err;
		}

		/**
		 * Check if an email is already used.
		 *
		 * @param (string) $email
		 * @return Returns true if the given email already in use otherwise false.
		 **/
		public function email_exist( $email ) {
			$err = new WP_Error();
			if ( ! $this->api ) {
				$err->add( 'subscribe_error', __( 'The API is not properly configured. Please contact the admin.', Opt_In::TEXT_DOMAIN ) );
				return $err;
			}
			$path = 'contacts';
			$contact_api = $this->api->newApi( $path, $this->auth, $this->base_url );

			try {
				$res = $contact_api->getList( $email, 0, 1000 );
				$contact_id = '';
				if ( $res && ! empty( $res['contacts'] ) ) {
					$contact_id = wp_list_pluck( $res['contacts'], 'id' );
				}
				$utils = Hustle_Provider_Utils::get_instance();
				$utils->_last_data_sent = $email;
				$utils->_last_url_request = $path;
				$utils->_last_data_received = $res;
				
				return ! empty( $contact_id ) ? key( $contact_id ) : false;
			} catch( Exception $e ) {
				$err->add( 'server_error', $e->getMessage() );
			}

			return $err;
		}

		/**
		 * Add contact to segment list.
		 *
		 * @param (int) $segment_id
		 * @param (int) $contact_id
		 **/
		public function add_contact_to_segment( $segment_id, $contact_id ) {
			$err = new WP_Error();
			if ( ! $this->api ) {
				$err->add( 'subscribe_error', __( 'The API is not properly configured. Please contact the admin.', Opt_In::TEXT_DOMAIN ) );
				return $err;
			}
			$path = 'segments';
			$segment_api = $this->api->newApi( $path, $this->auth, $this->base_url );

			try {
				$add = $segment_api->addContact( $segment_id, $contact_id );

				$utils = Hustle_Provider_Utils::get_instance();
				$utils->_last_data_sent = '';
				$utils->_last_url_request = $path . '/'.$segment_id.'/contact/'.$contact_id.'/add';
				$utils->_last_data_received = $add;

				return $add;
			} catch( Exception $e ) {
				$err->add( 'subscribe_error', $e->getMessage() );
			}
			return $err;
		}

		/**
		 * Get the list of available contact custom fields.
		 **/
		public function get_custom_fields() {
			if ( ! $this->api ) {
				return false;
			}
			$contact_api = $this->api->newApi( 'contacts', $this->auth, $this->base_url );
			$fields = $contact_api->getFieldList();

			return $fields;
		}

		/**
		 * Add custom contact field.
		 *
		 * @param (array) $field
		 **/
		public function add_custom_field( $field ) {
			if ( ! $this->api ) {
				return false;
			}
			$field_api = $this->api->newApi( 'contactFields', $this->auth, $this->base_url );
			$res = $field_api->create( $field );

			return ! empty( $res ) && ! empty( $res['field'] );
		}
	}
endif;
