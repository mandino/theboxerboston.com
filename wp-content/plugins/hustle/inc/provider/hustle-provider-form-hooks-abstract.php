<?php

/**
 * Class Hustle_Provider_Form_Hooks_Abstract
 * Any change(s) to this file is subject to:
 * - Properly Written DocBlock! (what is this, why is that, how to be like those, etc, as long as you want!)
 * - Properly Written Changelog!
 *
 * If you override any of these method, please add necessary hooks in it,
 * Which you can see below, as a reference and keep the arguments signature.
 * If needed you can call these method, as parent::method_name(),
 * and add your specific hooks.
 *
 * @since 4.0
 */
abstract class Hustle_Provider_Form_Hooks_Abstract {

	/**
	 * Constant string for the common error when the user has already subscribed.
	 * 
	 * @since 4.0
	 */
	const ALREADY_SUBSCRIBED_ERROR = 'email_already_subscribed';
	
	protected $addon;

	/**
	 * Main provider Instance
	 *
	 * @since 4.0
	 * @var Hustle_Provider_Abstract
	 */
	protected $provider;

	/**
	 * Current Module ID
	 *
	 * @since 4.0
	 * @var int
	 */
	protected $module_id;

	/**
	 * Customizable submit form error message
	 *
	 * @since 4.0
	 * @var string
	 */
	protected $_submit_form_error_message = '';

	/**
	 * Form settings instance
	 *
	 * @since 4.0
	 * @var Hustle_Provider_Form_Settings_Abstract|null
	 *
	 */
	protected $form_settings_instance;


	/**
	 * Hustle_Provider_Form_Hooks_Abstract constructor.
	 *
	 * @param Hustle_Provider_Abstract $addon
	 * @param int $module_id
	 *
	 * @since 4.0
	 */
	public function __construct( Hustle_Provider_Abstract $addon, $module_id ) {
		$this->addon       = $addon; // TODO: replace this by $this->provider in 4.0.1 and adapt all providers to this.
		$this->provider 	 = $addon;
		$this->module_id     = $module_id;

		// get the form settings instance to be available throughout cycle
		$this->form_settings_instance = $this->addon->get_provider_form_settings( $this->module_id );
	}
	
	/**
	 * Override this function to execute an action on form submit.
	 *
	 * Returning true will continue the process,
	 * returning false will stop the process.
	 * Display an error message to user by using @see Hustle_Provider_Form_Hooks_Abstract::get_submit_form_error_message()
	 *
	 * @since 4.0
	 *
	 * @param $submitted_data
	 *
	 * @return bool
	 */
	public function on_form_submit( $submitted_data, $allow_subscribed ) {
		$addon_slug             = $this->addon->get_slug();
		$module_id              = $this->module_id;
		$form_settings_instance = $this->form_settings_instance;

		/**
		 * Filter the submitted form data to be processed by the addon.
		 *
		 * Although it can be used for all addons,
		 * keep in mind that if the addon overrides this method,
		 * then this filter won't be applied.
		 * To be sure please check the individual addon's documentations.
		 *
		 * @since 4.0
		 *
		 * @param array                                        $submitted_data
		 * @param int                                          $module_id                current module_id
		 * @param Hustle_Provider_Form_Settings_Abstract|null $form_settings_instance Addon Form Settings instance
		 */
		$submitted_data = apply_filters(
			'hustle_provider_' . $addon_slug . '_form_submitted_data_before_validation',
			$submitted_data,
			$module_id,
			$form_settings_instance,
			$allow_subscribed
		);

		$is_success = true;

		/**
		 * Check for duplicates here.
		 * Here, `$allow_subscribed` is triggered
		 * when duplicate entries is turned off
		 * for a module.
		 */
		if( ! $allow_subscribed ){ //phpcs:ignore
			/**
			 * Use your provider validation to check
			 * for duplicate entries and put a stop here.
			 * You can add a message on the`$is_success`
			 * variable to display your own custom message
			 */
		}

		/**
		 * Filter the result of form submit.
		 *
		 * Return `true` if success, or **(string) error message** on failure.
		 * Although it can be used for all addons,
		 * keep in mind that if the addon overrides this method,
		 * then this filter won't be applied.
		 * To be sure please check the individual addon's documentations.
		 *
		 * @since 4.0
		 *
		 * @param bool                                         $is_success
		 * @param int                                          $module_id                current module_id
		 * @param array                                        $submitted_data
		 * @param Hustle_Provider_Form_Settings_Abstract|null $form_settings_instance Addon Form Settings instance
		 */
		$is_success = apply_filters(
			'hustle_provider_' . $addon_slug . '_form_submit_data_after_validation',
			$is_success,
			$module_id,
			$submitted_data,
			$form_settings_instance,
			$allow_subscribed
		);

		// process filter
		if ( true !== $is_success ) {
			// only update `_submit_form_error_message` when not empty
			if ( ! empty( $is_success ) ) {
				$this->_submit_form_error_message = (string) $is_success;
			}

			return $is_success;
		}

		return $is_success;
	}

	/**
	 * Get Submit form error message
	 *
	 * @since 4.0
	 * @return string
	 */
	public function get_submit_form_error_message() {
		$addon_slug             = $this->addon->get_slug();
		$module_id                = $this->module_id;
		$form_settings_instance = $this->form_settings_instance;

		$error_message = $this->_submit_form_error_message;

		// Set a common error message for when an already subscribed user can't subscribe again.
		if ( self::ALREADY_SUBSCRIBED_ERROR === $error_message ) {

			// TODO: make this a field in the integration's settings.
			// This way users can edit it without having to touch .po files.
			$error_message = __( 'This email address has already subscribed.', Opt_In::TEXT_DOMAIN );
		}
		/**
		 * Filter the submit form error message.
		 *
		 * Although it can be used for all addons,
		 * keep in mind that if the addon overrides this method,
		 * then this filter won't be applied.
		 * To be sure please check the individual addon's documentations.
		 *
		 * @since 4.0
		 *
		 * @param string                                        $error_message         error message to be shown
		 * @param int                                          $module_id                current module_id
		 * @param Hustle_Provider_Form_Settings_Abstract|null $form_settings_instance of Addon Form Settings
		 */
		$error_message = apply_filters(
			'hustle_provider_' . $addon_slug . '_submit_form_error_message',
			$error_message,
			$module_id,
			$form_settings_instance
		);

		return $error_message;
	}

	/**
	 * Override this function to add another entry field to storage.
	 * Return an multi array with format. It will be skipped otherwise.
	 * [
	 *  'name' => NAME,
	 *  'value' => VALUE', => can be array/object/scalar, it will serialized on storage
	 * ],
	 * [
	 *  'name' => NAME,
	 *  'value' => VALUE'
	 * ]
	 *
	 * @since 4.0
	 *
	 * @param array $submitted_data
	 * @return array
	 */
	public function add_entry_fields( $submitted_data ) {
		$addon_slug             = $this->addon->get_slug();
		$module_id                = $this->module_id;
		$form_settings_instance = $this->form_settings_instance;

		$entry_fields = array();

		return $entry_fields;
	}

	/**
	 * Override this function to display another sub-row on entry detail
	 *
	 * Return a multi array with this format (at least, or it will skipped)
	 * [
	 *  'label' => LABEL,
	 *  'value' => VALUE (string) => its output is on html mode, so you can do styling, but please don't forgot to escape its html when needed
	 * ],
	 * [
	 *  'label' => LABEL,
	 *  'value' => VALUE
	 * ]
	 *
	 * @since 4.0
	 *
	 * @param Hustle_Entry_Model $entry_model
	 * @param array $addon_meta_data specific meta_data added by the provider at @see: add_entry_fields()
	 *
	 * @return array
	 */
	public function on_render_entry( Hustle_Entry_Model $entry_model, $addon_meta_data ) {
		$addon_slug = $this->addon->get_slug();
		$module_id = $this->module_id;
		$form_settings_instance = $this->form_settings_instance;

		/**
		 *
		 * Filter addon metadata that previously saved on db to be processed
		 *
		 * Although it can be used for all addon.
		 * Please keep in mind that if the addon override this method,
		 * then this filter probably won't be applied.
		 * To be sure please check individual addon documentations.
		 *
		 * @since 4.0
		 */
		$addon_meta_data = apply_filters(
			'hustle_provider_' . $addon_slug . '_metadata', $addon_meta_data, $module_id, $entry_model, $form_settings_instance
		);

		$entry_items = $this->format_metadata_for_entry( $entry_model, $addon_meta_data );

		/**
		 * Filter row(s) to be displayed on entries page
		 *
		 * Although it can be used for all addons.
		 * Please keep in mind that if the addon override this method,
		 * then this filter probably won't be applied.
		 * To be sure please check individual addon documentations.
		 *
		 * @since 4.0
		 */
		$entry_items = apply_filters(
			'hustle_provider_' . $addon_slug . '_entry_items', $entry_items, $module_id, $entry_model, $addon_meta_data, $form_settings_instance
		);

		return $entry_items;
	}

	/**
	 * Format saved metadata before rendering it on entry.
	 *
	 * @since 4.0
	 *
	 * @param Hustle_Entry_Model $entry_model
	 * @param $addon_meta_data
	 * @return array
	 */
	private function format_metadata_for_entry( Hustle_Entry_Model $entry_model, $addon_meta_data ) {
		// only process first addon meta datas since we only save one
		// no entry fields was added before
		if ( ! isset( $addon_meta_data[0] ) || ! is_array( $addon_meta_data[0] ) ) {
			return array();
		}

		$addon_meta_data = $addon_meta_data[0];
		$settings = $this->form_settings_instance->get_form_settings_values();

		// make sure its `status`, because we only add this
		if ( 'status' !== $addon_meta_data['name'] ) {
			return array();
		}

		if ( ! isset( $addon_meta_data['value'] ) || ! is_array( $addon_meta_data['value'] ) ) {
			return array();
		}

		$status = $addon_meta_data['value'];

		$additional_entry_item = array(
			'name'  => $this->addon->get_title(),
			'icon' => $this->addon->get_icon_2x(),
			'data_sent' => $status['is_sent'],
		);

		$posible_data = array(
			'account_name' => __( 'Account name', Opt_In::TEXT_DOMAIN ),
			'description' => __( 'Info', Opt_In::TEXT_DOMAIN ),
			'member_status' => __( 'Member status', Opt_In::TEXT_DOMAIN ),
			'list_name' => __( 'List name', Opt_In::TEXT_DOMAIN ),
			'form_name' => __( 'Form name', Opt_In::TEXT_DOMAIN ),
			'confirmation_message_name' => __( 'Confirmation message', Opt_In::TEXT_DOMAIN ),
		);

		$sub_entries = array();
		foreach ( $posible_data as $key => $label ) {
			if ( isset( $status[ $key ] ) ) {
				$sub_entries[] = array(
					'label' => $label,
					'value' => $status[ $key ],
				);
			}
		}

		if ( isset( $status['group_name'] ) ) {
			$sub_entries[] = array(
				'label' => $status['group_name'],
				'value' => isset( $status['group_interest_name'] ) ? $status['group_interest_name'] : '-',
			);
		}

		$additional_entry_item['sub_entries'] = $sub_entries;

		return array( $additional_entry_item );
	}

	public function add_front_form_fields( Hustle_Module_Model $module ) {
		$addon_slug = $this->addon->get_slug();
		$module_id = $this->module_id;
		$form_settings_instance = $this->form_settings_instance;

		$html = '';

		/**
		 *
		 * Filter the markup that will add the addon's fields in frontend.
		 *
		 * Keep in mind that if the addon overrides this method,
		 * then this filter probably won't be applied.
		 * To be sure please check the individual addons' documentation.
		 *
		 * @since 4.0
		 */
		$html = apply_filters(
			'hustle_provider_' . $addon_slug . '_form_fields_markup', $html, $module_id, $form_settings_instance
		);

		return $html;
	}

	/**
	 * Change legacy data
	 * 
	 * NOTE: this has been changed during migration, so we shouldn't need this anymore.
	 *
	 * @param array $data
	 * @return array changed data
	 */
	protected function check_legacy( $data ) {
		if ( empty( $data['first_name'] ) && isset( $data['f_name'] ) ) {
			$data['first_name'] = $data['f_name'];
		}

		if ( empty( $data['last_name'] ) && isset( $data['l_name'] ) ) {
			$data['last_name'] = $data['l_name'];
		}
		unset( $data['f_name'], $data['l_name'] );

		return $data;
	}

	/**
	 * Handle exceptions
	 *
	 * @param object $e
	 * @return array
	 */
	protected function exception( $e ) {
		$trace = $e->getTrace();
		$method = !empty( $trace[0]['class'] ) ? $trace[0]['class'] . '::' : '';
		$method .= $trace[0]['function'] . '() ';

		$entry_fields = array(
			array(
				'name'  => 'status',
				'value' => array(
					'is_sent'       => false,
					'description'   => $method . 'Failed to add member - ' . $e->getMessage(),
					'data_sent'     => 'nope',
					'data_received' => 'nope',
					'url_request'   => 'nope',
				),
			),
		);

		return $entry_fields;
	}

}
