<?php
if ( ! class_exists( 'Hustle_ConstantContact' ) ) :

	class Hustle_ConstantContact extends Hustle_Provider_Abstract {

		const SLUG = 'constantcontact';

		protected static $errors;

		/**
	 * Constant Contact Provider Instance
	 *
	 * @since 3.0.5
	 *
	 * @var self|null
	 */
		protected static $_instance 	   = null;

		/**
	 * @since 3.0.5
	 * @var string
	 */
		public static $_min_php_version	   = '5.3';

		/**
	 * @since 3.0.5
	 * @var string
	 */
		protected $_slug 				   = 'constantcontact';

		/**
	 * @since 3.0.5
	 * @var string
	 */
		protected $_version				   = '1.0';

		/**
	 * @since 3.0.5
	 * @var string
	 */
		protected $_class				   = __CLASS__;

		/**
	 * @since 3.0.5
	 * @var string
	 */
		protected $_title                  = 'Constant Contact';

	/**
	 * @since 4.0
	 * @var boolean
	 */
	protected $is_multi_on_global = false;

		/**
	 * @since 3.0.5
	 * @var bool
	 */
		protected $_supports_fields 	   = true;

		/**
	 * Class name of form settings
	 *
	 * @var string
	 */
		protected $_form_settings = 'Hustle_ConstantContact_Form_Settings';

		/**
	 * Class name of form hooks
	 *
	 * @since 4.0
	 * @var string
	 */
		protected $_form_hooks = 'Hustle_ConstantContact_Form_Hooks';

		/**
	 * Hustle_ConstantContact constructor.
	 */
		public function __construct() {
			$this->_icon_2x = plugin_dir_url( __FILE__ ) . 'images/icon.png';
			$this->_logo_2x = plugin_dir_url( __FILE__ ) . 'images/logo.png';

			if ( ! class_exists( 'Hustle_ConstantContact_Api' ) ) {
				require_once 'hustle-constantcontact-api.php';
			}
			// Instantiate the API on constructor because it's required after getting the authorization
			$hustle_constantcontact = new Hustle_ConstantContact_Api();
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
	 * Check if the settings are completed
	 *
	 * @since 4.0
	 * @return boolean
	 */
		protected function settings_are_completed( $multi_id = '' ) {
			$api = $this->api();
			$is_authorize = (bool) $api->get_token( 'access_token' );

			return $is_authorize;
		}

		/**
	 * @return bool|Opt_In_ConstantContact_Api
	 */
		public function api() {
			return self::static_api();
		}

		public static function static_api() {
			if ( ! class_exists( 'Hustle_ConstantContact_Api' ) ) {
				require_once 'hustle-constantcontact-api.php';
			}

			if ( class_exists( 'Hustle_ConstantContact_Api' ) ) {
				$api = new Hustle_ConstantContact_Api();
				return $api;
			} else {
				return new WP_Error( 'error', __( 'API Class could not be initialized', Opt_In::TEXT_DOMAIN ) );
			}

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
	 * @return array
	 */
		public function configure_api_key( $submitted_data, $module_id ) {
			$has_errors = false;

			$api = $this->api();
			$is_authorize = (bool) $api->get_token( 'access_token' );

			$is_submit = ! empty( $submitted_data['is_submit'] );

			if ( $is_submit ) {

				if ( $is_authorize && ! Hustle_Provider_Utils::is_provider_active( $this->_slug ) ) {
					// TODO: Wrap this in a friendlier method
					$activated = Hustle_Providers::get_instance()->activate_addon( $this->_slug );
					if ( ! $activated ) {
						$error_message = $this->provider_connection_falied();
						$has_errors = true;
					}
				}

				if ( ! $has_errors ) {
					return array(
						'html'         => Hustle_Api_Utils::get_modal_title_markup( __( 'Constant Contact Added', Opt_In::TEXT_DOMAIN ), __( 'You can now go to your forms and assign them to this integration', Opt_In::TEXT_DOMAIN ) ),
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

			if ( ! is_ssl() ) {
				$error_message = __( 'Constant Contact requires your site to have SSL certificate.', Opt_In::TEXT_DOMAIN );
				$has_errors = true;
			}

			$url = $api->get_authorization_uri( $module_id, true, Hustle_Module_Admin::INTEGRATIONS_PAGE );
			if ( $module_id ) {
				$module = Hustle_Module_Model::instance()->get( $module_id );
				if ( ! is_wp_error( $module ) ) {
					$url = $api->get_authorization_uri( $module_id, true, $module->get_wizard_page() );
				}
			}
			$link = '<a href="' . esc_url( $url ) . '">';

			if ( $is_authorize ) {
				$info = sprintf( __( 'You\'re successfully connected your Constant Contact account. Please, save this configuration or %1$sclick here%2$s to reconnect another Constant Contact account.', Opt_In::TEXT_DOMAIN ), $link, '</a>' );
			} else {
				$info = sprintf( __( 'Please %1$sclick here%2$s to connect your Constant Contact account.', Opt_In::TEXT_DOMAIN ), $link, '</a>' );
			}

			$info .= ' ' . __( 'You will be asked to give us access to your selected account and will be redirected back to this page.', Opt_In::TEXT_DOMAIN );

			$options = array(
			'wrapper' => array(
				'id'    => '',
				'class' => 'sui-form-field',
				'type'  => 'wrapper',
				'elements' => array(
					'api_key' => array(
						'name'          => 'is_submit',
						'type'          => 'hidden',
						'value'         => '1',
					),
				),
			),
			);

			$step_html = Hustle_Api_Utils::get_modal_title_markup( __( 'Configure Constant Contact', Opt_In::TEXT_DOMAIN ), $info );
			$step_html .= Hustle_Api_Utils::get_html_for_options( $options );

			if ( $has_errors ) {
				$step_html .= '<span class="sui-error-message">' . esc_html( $error_message ) . '</span>';
			}

			$is_edit = $this->is_connected() ? true : false;
			if ( $is_edit ) {
				$buttons = array(
				'disconnect' => array(
					'markup' => Hustle_Api_Utils::get_button_markup( __( 'Disconnect', Opt_In::TEXT_DOMAIN ), 'sui-button-ghost', 'disconnect', true ),
				),
				'save' => array(
					'markup' => Hustle_Api_Utils::get_button_markup( __( 'Save', Opt_In::TEXT_DOMAIN ), '', 'connect', true ),
				),
				);
			} else if ( $is_authorize ) {
				$buttons = array(
				'close' => array(
					'markup' => Hustle_Api_Utils::get_button_markup( __( 'Close', Opt_In::TEXT_DOMAIN ), 'sui-button-ghost', 'close' ),
				),
				'save' => array(
					'markup' => Hustle_Api_Utils::get_button_markup( __( 'Save', Opt_In::TEXT_DOMAIN ), '', 'connect', true ),
				),
				);
			} else {
				$buttons = array(
				'close' => array(
					'markup' => Hustle_Api_Utils::get_button_markup( __( 'Close', Opt_In::TEXT_DOMAIN ), 'sui-button-ghost', 'close' ),
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

		public function migrate_30( $module, $old_module ) {
			$migrated = parent::migrate_30( $module, $old_module );
			if ( ! $migrated ) {
				return false;
			}

			/*
			 * Our regular migration would've saved the provider settings in a format that's incorrect for constant contact
			 *
			 * Let's fix that now.
			 */
			$module_provider_settings = $module->get_provider_settings( $this->get_slug() );
			if ( ! empty( $module_provider_settings ) ) {
				// At provider level don't store anything (at least not in the regular option)
				delete_option( $this->get_settings_options_name() );

				// selected_global_multi_id not needed at module level
				unset( $module_provider_settings['selected_global_multi_id'] );
				$module->set_provider_settings( $this->get_slug(), $module_provider_settings );
			}

			return $migrated;
		}

		public function get_30_provider_mappings() {
			return array();
		}
	}
endif;
