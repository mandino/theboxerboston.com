<?php

if( !class_exists("Hustle_Mad_Mimi") ):

include_once 'hustle-mad-mimi-api.php';

class Hustle_Mad_Mimi extends Hustle_Provider_Abstract {

	const SLUG = "mad_mimi";
	//const NAME = "Mad Mimi";

	/**
	 * @var $api Mad Mimi
	 */
	protected  static $api;
	protected  static $errors;

	/**
	 * Provider Instance
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
	protected $_slug 				   = 'mad_mimi';

	/**
	 * @since 3.0.5
	 * @var string
	 */
	protected $_version				   = '1.0';

	/**
	 * @since 3.0.5
	 * @var string
	 */
	protected $_class 				   = __CLASS__;

	/**
	 * @since 3.0.5
	 * @var string
	 */
	protected $_title                  = 'Mad Mimi';

	/**
	 * @since 3.0.5
	 * @var bool
	 */
	protected $_supports_fields 	   = true;

	/**
	 * Class name of form hooks
	 *
	 * @since 4.0
	 * @var string
	 */
	protected $_form_hooks = 'Hustle_Mad_Mimi_Form_Hooks';

	/**
	 * Class name of form settings
	 *
	 * @var string
	 */
	protected $_form_settings = 'Hustle_Mad_Mimi_Form_Settings';

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
	 * @param $username
	 * @param $api_key
	 * @return Hustle_Mad_Mimi_Api
	 */
	public static function api( $username, $api_key ){

		if( empty( self::$api ) ){
			try {
				self::$api = new Hustle_Mad_Mimi_Api( $username, $api_key );
				self::$errors = array();
			} catch (Exception $e) {
				self::$errors = array("api_error" => $e) ;
			}

		}

		return self::$api;
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
			'username' => '',
			'name' => '',
		);
		$current_data = $this->get_current_data( $default_data, $submitted_data );
		$is_submit = isset( $submitted_data['api_key'] ) && isset( $submitted_data['username'] );
		$global_multi_id = $this->get_global_multi_id( $submitted_data );

		$api_username_valid = $api_key_valid = true;

		if ( $is_submit ) {

			$api_username_valid = ! empty( trim( $current_data['username'] ) );
			$api_key_valid = ! empty( trim( $current_data['api_key'] ) );
			$is_validated = $api_key_valid
			                && $api_username_valid
			                && $this->validate_credentials( $submitted_data['username'], $submitted_data['api_key'] );

			if ( ! $is_validated ) {
				$error_message = $this->provider_connection_falied();
				$has_errors = true;
			}

			if ( ! $has_errors ) {
				$settings_to_save = array(
					'api_key' => $current_data['api_key'],
					'username' => $current_data['username'],
					'name' => $current_data['name'],
				);
				// If not active, activate it.
				// TODO: Wrap this in a friendlier method
				if ( Hustle_Provider_Utils::is_provider_active( $this->_slug )
						|| Hustle_Providers::get_instance()->activate_addon( $this->_slug ) ) {
					$this->save_multi_settings_values( $global_multi_id, $settings_to_save );
				} else {
					$error_message = __( "Provider couldn't be activated.", 'wordpress-popup' );
					$has_errors = true;
				}

			}

			if ( ! $has_errors ) {

				return array(
					'html'         => Hustle_Api_Utils::get_modal_title_markup( __( 'Mad Mimi Added', 'wordpress-popup' ), __( 'You can now go to your forms and assign them to this integration', 'wordpress-popup' ) ),
					'buttons'      => array(
						'close' => array(
							'markup' => Hustle_Api_Utils::get_button_markup( __( 'Close', 'wordpress-popup' ), 'sui-button-ghost', 'close' ),
						),
					),
					'redirect'     => false,
					'has_errors'   => false,
					'notification' => array(
						'type' => 'success',
						'text' => '<strong>' . $this->get_title() . '</strong> ' . __( 'Successfully connected', 'wordpress-popup' ),
					),
				);

			}

		}

		$options = array(
			array(
				'type'     => 'wrapper',
				'class'    => $api_username_valid ? '' : 'sui-form-field-error',
				'elements' => array(
					'label' => array(
						'type'  => 'label',
						'for'   => 'username',
						'value' => __( 'Email', 'wordpress-popup' ),
					),
					'username' => array(
						'type'        => 'email',
						'name'        => 'username',
						'value'       => $current_data['username'],
						'placeholder' => __( 'Enter Email', 'wordpress-popup' ),
						'icon'        => 'mail',
					),
					'error' => array(
						'type'  => 'error',
						'class' => $api_username_valid ? 'sui-hidden' : '',
						'value' => __( 'Please add a valid email address registered on Mad Mimi', 'wordpress-popup' ),
					),
				)
			),
			array(
				'type'     => 'wrapper',
				'class'    => $api_key_valid ? '' : 'sui-form-field-error',
				'elements' => array(
					'label' => array(
						'type'  => 'label',
						'for'   => 'api_key',
						'value' => __( 'API Key', 'wordpress-popup' ),
					),
					'api_key' => array(
						'type'        => 'email',
						'name'        => 'api_key',
						'value'       => $current_data['api_key'],
						'placeholder' => __( 'Enter Key', 'wordpress-popup' ),
						'icon'        => 'key',
					),
					'error' => array(
						'type'  => 'error',
						'class' => $api_key_valid ? 'sui-hidden' : '',
						'value' => __( 'Please enter a valid Mad Mimi API key', 'wordpress-popup' ),
					),
				)
			),
			array(
				'type'  => 'wrapper',
				'style' => 'margin-bottom: 0;',
				'elements' => array(
					'label'   => array(
						'type'  => 'label',
						'for'   => 'instance-name-input',
						'value' => __( 'Identifier', 'wordpress-popup' ),
					),
					'name'    => array(
						'type'        => 'text',
						'name'        => 'name',
						'value'       => $current_data['name'],
						'placeholder' => __( 'E.g. Business Account', 'wordpress-popup' ),
						'id'          => 'instance-name-input',
					),
					'message' => array(
						'type'  => 'description',
						'value' => __( 'Helps to distinguish your integrations if you have connected to the multiple accounts of this integration.', 'wordpress-popup' ),
					),
				)
			),
		);

		$step_html = Hustle_Api_Utils::get_modal_title_markup(
			__( 'Configure Mad Mimi', 'wordpress-popup' ),
			sprintf(
				__( 'Log in to your %1$sMad Mimi account%2$s to get your API Key.', 'wordpress-popup' ),
				'<a href="https://madmimi.com" target="_blank">',
				'</a>'
			)
		);
		if ( $has_errors ) {
			$step_html .= '<span class="sui-notice sui-notice-error"><p>' . esc_html( $error_message ) . '</p></span>';
		}
		$step_html .= Hustle_Api_Utils::get_html_for_options( $options );

		$is_edit = $this->settings_are_completed( $global_multi_id );

		if ( $is_edit ) {
			$buttons = array(
				'disconnect' => array(
					'markup' => Hustle_Api_Utils::get_button_markup( __( 'Disconnect', 'wordpress-popup' ), 'sui-button-ghost', 'disconnect', true ),
				),
				'save' => array(
					'markup' => Hustle_Api_Utils::get_button_markup( __( 'Save', 'wordpress-popup' ), '', 'connect', true ),
				),
			);
		} else {
			$buttons = array(
				'connect' => array(
					'markup' => Hustle_Api_Utils::get_button_markup( __( 'Connect', 'wordpress-popup' ), '', 'connect', true ),
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
	 * Validate the provided username and API key.
	 *
	 * @since 4.0
	 *
	 * @param string $username
	 * @param string $api_key
	 * @return bool
	 */
	private function validate_credentials( $username, $api_key ) {
		if ( empty( $api_key ) ) {
			return false;
		}

		// Check API Key by validating it on get_info request
		try {
			// Check if API key is valid
			$_lists = self::api( $username, $api_key )->get_lists();

			if ( is_wp_error( $_lists ) ) {
				Hustle_Api_Utils::maybe_log( __METHOD__, __( 'Invalid Mad Mimi API key or username.', 'wordpress-popup' ) );
				return false;
			}

		} catch ( Exception $e ) {
			Hustle_Api_Utils::maybe_log( __METHOD__, $e->getMessage() );
			return false;
		}

		return true;
	}


	/**
	 * Get currently saved username
	 *
	 * @since 4.0
	 *
	 * @return string|null
	 */
	public function get_username() {

		/** @var array $setting_values */
		$setting_values = $this->get_settings_values();
		if ( isset( $setting_values['username'] ) ) {
			return $setting_values['username'];
		}

		return null;
	}

	public function get_30_provider_mappings() {
		return array(
			'api_key'  => 'api_key',
			'username' => 'username',
		);
	}
}

endif;
