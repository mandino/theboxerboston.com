<?php

if ( ! class_exists( 'Hustle_HubSpot' ) ) :

	require_once 'hustle-hubspot-api.php';

	/**
 * Class Hustle_HubSpot
 */
	class Hustle_HubSpot extends Hustle_Provider_Abstract {
		const SLUG = 'hubspot';
		//const NAME = "HubSpot";

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
		protected $_slug 				   = 'hubspot';

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
		protected $_title                  = 'HubSpot';

	/**
	 * @since 4.0
	 * @var boolean
	 */
	protected $is_multi_on_global = false;

		/**
	 * Class name of form settings
	 *
	 * @var string
	 */
		protected $_form_settings = 'Hustle_HubSpot_Form_Settings';

		/**
	 * Class name of form hooks
	 *
	 * @since 4.0
	 * @var string
	 */
		protected $_form_hooks = 'Hustle_HubSpot_Form_Hooks';

	/**
	 * Provider constructor.
	 */
		public function __construct() {
			$this->_icon_2x = plugin_dir_url( __FILE__ ) . 'images/icon.png';
			$this->_logo_2x = plugin_dir_url( __FILE__ ) . 'images/logo.png';

			// Instantiate API when instantiating because it's used after getting the authorization
			$hustle_hubpost = new Hustle_HubSpot_Api();
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
			$is_authorize = $api && ! $api->is_error && $api->is_authorized();

			return $is_authorize;
		}

		/**
	 * @return bool|Hustle_HubSpot_Api
	 */
		public function api() {
			return self::static_api();
		}

		public static function static_api() {
			if ( ! class_exists( 'Hustle_HubSpot_Api' ) ) {
				require_once 'opt-in-hubspot-api.php'; }

			$api = new Hustle_HubSpot_Api();

			return $api;
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
			$is_authorize = $api && ! $api->is_error && $api->is_authorized();

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
					'html'         => Hustle_Api_Utils::get_modal_title_markup( __( 'HubSpot Added', 'wordpress-popup' ), __( 'You can now go to your forms and assign them to this integration', 'wordpress-popup' ) ),
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

			$url = $api->get_authorization_uri( $module_id, true, Hustle_Module_Admin::INTEGRATIONS_PAGE );
			if ( $module_id ) {
				$module = Hustle_Module_Model::instance()->get( $module_id );
				if ( ! is_wp_error( $module ) ) {
					$url = $api->get_authorization_uri( $module_id, true, $module->get_wizard_page() );
				}
			}
			$link = '<a href="' . esc_url( $url ) . '">';

			if ( $is_authorize ) {
				$info = sprintf( __( 'You\'re successfully connected your HubSpot account. Please, save this configuration or %1$sclick here%2$s to reconnect another HubSpot account.', 'wordpress-popup' ), $link, '</a>' );
			} else {
				$info = sprintf( __( 'Please %1$sclick here%2$s to connect your HubSpot account.', 'wordpress-popup' ), $link, '</a>' );
			}

			$info .= ' ' . __( 'You will be asked to give us access to your selected account and will be redirected back to this page.', 'wordpress-popup' );

			$options = array(
				array(
					'type'  => 'hidden',
					'name'  => 'is_submit',
					'value' => '1',
				),
			);

			$step_html = Hustle_Api_Utils::get_modal_title_markup( __( 'Configure HubSpot', 'wordpress-popup' ), $info );
			$step_html .= Hustle_Api_Utils::get_html_for_options( $options );

			if ( $has_errors ) {
				$step_html .= '<span class="sui-error-message">' . esc_html( $error_message ) . '</span>';
			}

			$is_edit = $this->is_connected() ? true : false;
			if ( $is_edit ) {
				$buttons = array(
				'disconnect' => array(
					'markup' => Hustle_Api_Utils::get_button_markup( __( 'Disconnect', 'wordpress-popup' ), 'sui-button-ghost', 'disconnect', true ),
				),
				'save' => array(
					'markup' => Hustle_Api_Utils::get_button_markup( __( 'Save', 'wordpress-popup' ), '', 'connect', true ),
				),
				);
			} else if ( $is_authorize ) {
				$buttons = array(
				'close' => array(
					'markup' => Hustle_Api_Utils::get_button_markup( __( 'Close', 'wordpress-popup' ), 'sui-button-ghost', 'close' ),
				),
				'save' => array(
					'markup' => Hustle_Api_Utils::get_button_markup( __( 'Save', 'wordpress-popup' ), '', 'connect', true ),
				),
				);
			} else {
				$buttons = array(
				'close' => array(
					'markup' => Hustle_Api_Utils::get_button_markup( __( 'Close', 'wordpress-popup' ), 'sui-button-ghost', 'close' ),
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
			 * Our regular migration would've saved the provider settings in a format that's incorrect for HubSpot
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

		public function add_custom_fields( $fields ) {
			$api 	= $this->api();
			$error 	= false;

			if ( $api && ! $api->is_error ) {
				// Get the existing fields
				$props = $api->get_properties();

				$new_fields = array();
				foreach ( $fields as $field ) {
					if ( !isset( $props[ $field['name'] ] ) ) {
						$new_fields[] = $field;
					}
				}

				foreach ( $new_fields as $field ) {
					// Add the new field as property
					$property = array(
						'name' => $field['name'],
						'label' => $field['label'],
						'type' => 'string',
						'fieldType' => 'text',
						'groupName' => 'contactinformation',
					);

					if ( !$api->add_property( $property ) ) {
						$error = true;
					}
				}
			}

			if ( !$error ) {
				return array(
					'success' => true,
					'field' => $fields,
				);
			} else {
				return array(
					'error' => true,
					'code' => 'cannot_create_custom_field',
				);
			}
		}
	}

endif;
