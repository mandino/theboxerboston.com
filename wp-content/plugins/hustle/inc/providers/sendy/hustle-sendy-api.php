<?php

class Hustle_Sendy_API {
	const SUBSCRIBE = 'subscribe';
	const SUBSCRIBER_COUNT = 'api/subscribers/active-subscriber-count.php';
	const SUBSCRIBER_STATUS = 'api/subscribers/subscription-status.php';

	private $base_url;
	private $api_key;
	private $list_id;

	public function __construct( $base_url, $api_key, $list_id ) {
		$this->base_url = trim( strval( $base_url ) );
		$this->api_key = trim( strval( $api_key ) );
		$this->list_id = trim( strval( $list_id ) );
	}

	private function get_endpoint_url( $endpoint ) {
		return sprintf( '%s%s', trailingslashit( $this->base_url ), $endpoint );
	}

	/**
	 * @param $endpoint
	 * @param array $args
	 *
	 * @return string|WP_Error Response body or WP_Error
	 */
	private function make_request( $endpoint, $args = array(), $verb = 'POST' ) {
		$url = $this->get_endpoint_url( $endpoint );

		if( 'GET' === $verb ){
			$response = wp_remote_get( $url, array(
				'timeout' => 10,
				'body'    => array_merge( array(
					'api_key' => $this->api_key,
					'list_id' => $this->list_id,
				), $args ),
			) );


		}else{
			$response = wp_remote_post( $url, array(
				'timeout' => 10,
				'body'    => array_merge( array(
					'api_key' => $this->api_key,
					'list_id' => $this->list_id,
				), $args ),
			) );
		}

		$utils = Hustle_Provider_Utils::get_instance();
		$utils->_last_url_request = $url;
		$utils->_last_data_received = $response;
		$utils->_last_data_sent = $args;

		if (
			is_wp_error( $response )
			|| wp_remote_retrieve_response_code( $response ) > 200
		) {
			return new WP_Error(
				'remote_error',
				esc_html__( 'Could not talk to your Sendy installation. Please check the installation URL!', Opt_In::TEXT_DOMAIN )
			);
		}

		return wp_remote_retrieve_body( $response );
	}

	public function get_subscriber_count() {
		$response = $this->make_request( self::SUBSCRIBER_COUNT );
		if ( is_wp_error( $response ) ) {
			return $response;
		}

		if ( ! is_numeric( $response ) ) {
			return new WP_Error( 'remote_subscriber_count_error', $this->error_string( $response ) );
		}

		return intval( $response );
	}

	public function subscribe( $data ) {
		$response = $this->make_request( self::SUBSCRIBE, array_filter( array_merge( $data, array(
			'list'      => $this->list_id,
			'boolean'   => 'true',
		) ) ) );

		if ( is_wp_error( $response ) ) {
			return $response;
		}

		if ( '1' === $response ) {
			return true;
		}

		return new WP_Error( 'remote_error', $this->error_string( $response ) );
	}

	public function subscriber_status( $email ) {
		$response = $this->make_request( self::SUBSCRIBER_STATUS, array_filter( array(
			'email'   	=> $email,
		) ), 'POST' );

		if ( is_wp_error( $response ) ) {
			return $response;
		}

		return new WP_Error( 'remote_user_status', $response );
	}

	private function error_string( $string ) {
		$strings = array(
			// Subscribe
			'Some fields are missing.' => esc_html__( 'Some fields are missing.', Opt_In::TEXT_DOMAIN ),
			'Invalid email address.'   => esc_html__( 'Invalid email address.', Opt_In::TEXT_DOMAIN ),
			'Invalid list ID.'         => esc_html__( 'Invalid list ID.', Opt_In::TEXT_DOMAIN ),
			'Already subscribed.'      => esc_html__( 'This email address has already subscribed.', Opt_In::TEXT_DOMAIN ),
			// Subscriber count
			'No data passed'           => esc_html__( 'No data passed', Opt_In::TEXT_DOMAIN ),
			'API key not passed'       => esc_html__( 'API key not passed', Opt_In::TEXT_DOMAIN ),
			'Invalid API key'          => esc_html__( 'Invalid API key', Opt_In::TEXT_DOMAIN ),
			'List ID not passed'       => esc_html__( 'List ID not passed', Opt_In::TEXT_DOMAIN ),
			'List does not exist'      => esc_html__( 'List does not exist', Opt_In::TEXT_DOMAIN ),
			'List does not exist'      => esc_html__( 'List does not exist', Opt_In::TEXT_DOMAIN ),
		);

		return empty( $strings[ $string ] )
			? $string
			: $strings[ $string ];
	}
}
