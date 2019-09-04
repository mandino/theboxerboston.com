<?php
if ( ! class_exists( 'Hustle_Aweber' ) ) :

	if ( ! class_exists( 'AWeberAPI' ) ) {
		require_once Opt_In::$vendor_path . 'aweber/aweber/aweber_api/aweber_api.php'; }

	class Hustle_Aweber extends Hustle_Provider_Abstract {

		const SLUG = 'aweber';
		//const NAME = "AWeber";

		const APP_ID = 'b0cd0152';

		const AUTH_CODE = 'aut_code';
		const CONSUMER_KEY = 'consumer_key';
		const CONSUMER_SECRET = 'consumer_secret';
		const ACCESS_TOKEN = 'access_token';
		const ACCESS_SECRET = 'access_secret';

	/**
	 * @var $api AWeberAPI
	 */
		protected  static $api;
		protected  static $errors;

	/**
	 * Aweber Provider Instance
	 *
	 * @since 3.0.5
	 *
	 * @var self|null
	 */
		protected static $_instance = null;

	/**
	 * @since 3.0.5
	 * @var string
	 */
	protected $_slug = 'aweber';

	/**
	 * @since 3.0.5
	 * @var string
	 */
		protected $_version = '1.0';

	/**
	 * @since 3.0.5
	 * @var string
	 */
		protected $_class = __CLASS__;

	/**
	 * @since 3.0.5
	 * @var string
	 */
		protected $_title = 'Aweber';

	/**
	 * @since 3.0.5
	 * @var bool
	 */
		protected $_supports_fields = true;

	/**
	 * Class name of form settings
	 *
	 * @var string
	 */
		protected $_form_settings = 'Hustle_Aweber_Form_Settings';

	/**
	 * Class name of form hooks
	 *
	 * @since 4.0
	 * @var string
	 */
	protected $_form_hooks = 'Hustle_Aweber_Form_Hooks';

	/**
	 * Provider constructor.
	 */
	public function __construct() {
		$this->_icon_2x = plugin_dir_url( __FILE__ ) . 'images/icon.png';
		$this->_logo_2x = plugin_dir_url( __FILE__ ) . 'images/logo.png';
	}

	/**
	 * Get Instance
	 *
	 * @return self|null
	 */
	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * @param $api_key
	 * @param $secret
	 * @return AWeberAPI
	 */
	public static function api( $api_key, $secret ) {

		if ( empty( self::$api ) ) {
			try {
				self::$api = new AWeberAPI( $api_key, $secret );
				self::$errors = array();
			} catch ( AWeberException $e ) {
				self::$errors = array( 'api_error' => $e ) ;
			}

		}
		self::$api->adapter->debug = false;
		return self::$api;
	}

	/**
	 * Gets the Aweber account object, instance of AWeberEntry
	 *
	 * @since 3.0.6
	 *
	 */
	public function get_account( $api_key = null ) {

		if ( ! is_null( $api_key ) && $this->get_provider_option( self::AUTH_CODE, '' ) !== $api_key ) {

			// Check if API key is valid
			try {
				$aweber_data = AWeberAPI::getDataFromAweberID( $api_key );
			} catch ( AWeberException $e ) {
				Hustle_Api_Utils::maybe_log( $e->getMessage() );
				return false;
			}

			list($consumer_key, $consumer_secret, $access_token, $access_secret) = $aweber_data;

			$this->update_provider_option( self::CONSUMER_KEY, $consumer_key );
			$this->update_provider_option( self::CONSUMER_SECRET, $consumer_secret );
			$this->update_provider_option( self::ACCESS_TOKEN, $access_token );
			$this->update_provider_option( self::ACCESS_SECRET, $access_secret );

			$this->update_provider_option( self::AUTH_CODE, $api_key );

		} else {
			$consumer_key = $this->get_provider_option( self::CONSUMER_KEY, '' );
			$consumer_secret = $this->get_provider_option( self::CONSUMER_SECRET, '' );
			$access_token = $this->get_provider_option( self::ACCESS_TOKEN, '' );
			$access_secret = $this->get_provider_option( self::ACCESS_SECRET, '' );
		}

		// Check if account is valid
		try {
			$account = self::api( $consumer_key, $consumer_secret )->getAccount( $access_token, $access_secret );
		} catch ( AWeberException $e ) {
			Hustle_Api_Utils::maybe_log( $e->getMessage() );
			return false;
		}

		return $account;

	}

	/**
	 * Get the wizard callbacks for the global settings.
	 *
	 * @since 4.0
	 *
	 * @return array
	 */
	public function settings_wizards() {
		return array(
			array(
				'callback'     => array( $this, 'configure_api_key' ),
				'is_completed' => array( $this, 'is_connected' ),
			),
		);
	}


	/**
	 * Configure the API key settings. Global settings.
	 *
	 * @since 4.0
	 *
	 * @param array $submitted_data
	 * @return array
	 */
	public function configure_api_key( $submitted_data ) {
		$has_errors = false;
		$default_data = array(
			'api_key' => '',
			'name' => '',
		);
		$current_data = $this->get_current_data( $default_data, $submitted_data );
		$is_submit = isset( $submitted_data['api_key'] );
		$global_multi_id = $this->get_global_multi_id( $submitted_data );

		$api_key_validated = true;
		if ( $is_submit ) {

			$api_key_validated = $this->validate_api_key( $submitted_data['api_key'] );
			if ( ! $api_key_validated ) {
				$error_message = $this->provider_connection_falied();
				$has_errors = true;
			}

			if ( ! $has_errors ) {
				$settings_to_save = array(
					'api_key' => $current_data['api_key'],
					'name' => $current_data['name'],
				);
				// If not active, activate it.
				// TODO: Wrap this in a friendlier method
				if ( Hustle_Provider_Utils::is_provider_active( $this->_slug )
						|| Hustle_Providers::get_instance()->activate_addon( $this->_slug ) ) {
					$this->save_multi_settings_values( $global_multi_id, $settings_to_save );
				} else {
					$error_message = __( "Provider couldn't be activated.", Opt_In::TEXT_DOMAIN );
					$has_errors = true;
				}
			}

			if ( ! $has_errors ) {

				return array(
					'html'         => Hustle_Api_Utils::get_modal_title_markup( __( 'Aweber Added', Opt_In::TEXT_DOMAIN ), __( 'You can now go to your forms and assign them to this integration', Opt_In::TEXT_DOMAIN ) ),
					'buttons'      => array(
						'close' => array(
							'markup' => Hustle_Api_Utils::get_button_markup( __( 'Close', Opt_In::TEXT_DOMAIN ), 'sui-button-ghost', 'close' ),
						),
					),
					'redirect'     => false,
					'has_errors'   => false,
					'notification' => array(
						'type' => 'success',
						'text' => '<strong>' . $this->get_title() . '</strong> ' . __( 'Successfully connected', Opt_In::TEXT_DOMAIN ),
					),
				);

			}

		}

		$options = array(
			array(
				'type'     => 'wrapper',
				'class'    => $api_key_validated ? '' : 'sui-form-field-error',
				'elements' => array(
					'label'   => array(
						'type'  => 'label',
						'for'   => 'api_key',
						'value' => __( 'Authorization code', Opt_In::TEXT_DOMAIN ),
					),
					'api_key' => array(
						'type'        => 'text',
						'name'        => 'api_key',
						'value'       => $current_data['api_key'],
						'placeholder' => __( 'Enter Code', Opt_In::TEXT_DOMAIN ),
						'id'          => 'api_key',
						'icon'        => 'key',
					),
					'error' => array(
						'type'  => 'error',
						'class' => $api_key_validated ? 'sui-hidden' : '',
						'value' => __( 'Please enter a valid Aweber authorization code', Opt_In::TEXT_DOMAIN ),
					),
				)
			),
			array(
				'type'     => 'wrapper',
				'style'    => 'margin-bottom: 0;',
				'elements' => array(
					'label' => array(
						'type'  => 'label',
						'for'   => 'instance-name-input',
						'value' => __( 'Identifier', Opt_In::TEXT_DOMAIN ),
					),
					'name' => array(
						'type'        => 'text',
						'name'        => 'name',
						'value'       => $current_data['name'],
						'placeholder' => __( 'E.g. Business Account', Opt_In::TEXT_DOMAIN ),
						'id'          => 'instance-name-input',
					),
					'message' => array(
						'type'  => 'description',
						'value' => __( 'Helps to distinguish your integrations if you have connected to the multiple accounts of this integration.', Opt_In::TEXT_DOMAIN ),
					),
				)
			),
		);

		$step_html = Hustle_Api_Utils::get_modal_title_markup( __( 'Configure Aweber', Opt_In::TEXT_DOMAIN ), sprintf( __("Please %1\$sclick here%2\$s to connect to Aweber service to get your authorization code.", Opt_In::TEXT_DOMAIN), '<a href="https://auth.aweber.com/1.0/oauth/authorize_app/' . self::APP_ID .'" target="_blank">', '</a>' ) );
		if ( $has_errors ) {
			$step_html .= '<span class="sui-notice sui-notice-error"><p>' . esc_html( $error_message ) . '</p></span>';
		}
		$step_html .= Hustle_Api_Utils::get_html_for_options( $options );

		$is_edit = $this->settings_are_completed( $global_multi_id );
		if ( $is_edit ) {
			$buttons = array(
				'disconnect' => array(
					'markup' => Hustle_Api_Utils::get_button_markup( __( 'Disconnect', Opt_In::TEXT_DOMAIN ), 'sui-button-ghost', 'disconnect', true ),
				),
				'save' => array(
					'markup' => Hustle_Api_Utils::get_button_markup( __( 'Save', Opt_In::TEXT_DOMAIN ), '', 'connect', true ),
				),
			);
		} else {
			$buttons = array(
				'connect' => array(
					'markup' => Hustle_Api_Utils::get_button_markup( __( 'Connect', Opt_In::TEXT_DOMAIN ), '', 'connect', true ),
				),
			);

		}

		$response = array(
			'html'       => $step_html,
			'buttons'    => $buttons,
			'has_errors' => $has_errors,
		);

		return $response;
	}

	/**
	 * Validate the provided API key.
	 *
	 * @since 4.0
	 *
	 * @param string $api_key
	 * @return bool
	 */
	private function validate_api_key( $api_key ) {
		if ( empty( trim( $api_key ) ) ) {
			return false;
		}

		// Check API Key by validating it on get_info request
		try {
			$account = $this->get_account( $api_key );

			if ( !$account ) {
				Hustle_Api_Utils::maybe_log( __METHOD__, __( 'Invalid Aweber authorization code.', Opt_In::TEXT_DOMAIN ) );
				return false;
			}

		} catch ( Exception $e ) {
			Hustle_Api_Utils::maybe_log( __METHOD__, $e->getMessage() );
			return false;
		}

		return true;
	}

	public function get_30_provider_mappings() {
		return array(
			'api_key' => 'api_key',
		);
	}
}
endif;
