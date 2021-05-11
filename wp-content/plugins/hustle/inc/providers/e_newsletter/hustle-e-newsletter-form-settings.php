<?php
if ( ! class_exists( 'Hustle_E_Newsletter_Form_Settings' ) ) :

	/**
 * Class Hustle_E_Newsletter_Form_Settings
 * Form Settings e-Newsletter Process
 *
 */
	class Hustle_E_Newsletter_Form_Settings extends Hustle_Provider_Form_Settings_Abstract {

		/**
	 * For settings Wizard steps
	 *
	 * @since 3.0.5
	 * @return array
	 */
		public function form_settings_wizards() {
			// already filtered on Abstract
			// numerical array steps
			return array(
			// 0
			array(
				'callback'     => array( $this, 'first_step_callback' ),
				'is_completed' => array( $this, 'first_step_is_completed' ),
			),
			);
		}

		/**
	 * Check if step is completed
	 *
	 * @since 3.0.5
	 * @return bool
	 */
		public function first_step_is_completed() {
			$this->addon_form_settings = $this->get_form_settings_values();
			if ( ! isset( $this->addon_form_settings['list_id'] ) ) {
				// preliminary value
				$this->addon_form_settings['list_id'] = array();

				return false;
			}

			if ( empty( $this->addon_form_settings['list_id'] ) ) {
				return false;
			}

			return true;
		}

		/**
	 * Returns all settings and conditions for 1st step of e-Newsletter settings
	 *
	 * @since 3.0.5
	 * @since 4.0 param $validate removed.
	 *
	 * @param array $submitted_data
	 * @return array
	 */
		public function first_step_callback( $submitted_data ) {
			$this->addon_form_settings = $this->get_form_settings_values();
			$current_data = array(
			'list_id' => '',
			'auto_optin' => '',
			);
			$current_data = $this->get_current_data( $current_data, $submitted_data );
			$is_submit = ! empty( $submitted_data['is_submit'] );
			if ( $is_submit && empty( $submitted_data['list_id'] ) ) {
				$error_message = __( 'The email list is required.', 'wordpress-popup' );
			}

			$options = $this->get_first_step_options( $current_data, $is_submit );

			$step_html = Hustle_Api_Utils::get_modal_title_markup(
				__( 'e-Newsletter List', 'wordpress-popup' ),
				__( 'Choose the list you want to send form data to.', 'wordpress-popup' )
			);

			$step_html .= Hustle_Api_Utils::get_html_for_options( $options );

			if ( ! isset( $error_message ) ) {
				$has_errors = false;
			} else {
				$step_html .= '<span class="sui-error-message">' . $error_message . '</span>';
				$has_errors = true;
			}

			$buttons = array(
			'disconnect' => array(
				'markup' => Hustle_Api_Utils::get_button_markup( __( 'Disconnect', 'wordpress-popup' ), 'sui-button-ghost', 'disconnect_form', true ),
			),
			'save' => array(
				'markup' => Hustle_Api_Utils::get_button_markup( __( 'Save', 'wordpress-popup' ), '', 'next', true ),
			),
			);

			$response = array(
			'html'       => $step_html,
			'buttons'    => $buttons,
			'has_errors' => $has_errors,
			);

			// Save only after the step has been validated and there are no errors
			if ( $is_submit && ! $has_errors ) {
				error_log( wp_json_encode( $this->_lists ) );
				$current_data['list_name'] = $this->get_selected_list_names( $current_data );
				$this->save_form_settings_values( $current_data );
			}

			return $response;
		}

		/**
		 * Get the group name by id.
		 *
		 * @since 4.0
		 *
		 * @param array $current_data
		 * @return string
		 */
		private function get_selected_list_names( $current_data ) {

			if ( ! is_array( $this->_lists ) || empty( $this->_lists ) ) {
				return '';
			}

			$lists = array();
			foreach( $current_data['list_id'] as $list ) {
				$lists[] = $this->_lists[ $list ]['label'];
			}

			return implode( ', ', $lists );
		}

		/**
	 * Return an array of options used to display the settings of the 1st step.
	 *
	 * @since 4.0
	 *
	 * @param array $submitted_data
	 * @return array
	 */
	private function get_first_step_options( $submitted_data, $is_submit ) {

		$lists = array();

		try {

			$_lists = $this->provider->get_groups();

			if ( is_array( $_lists ) && ! empty( $_lists ) ) {

				foreach ( $_lists as $list ) {
					$list = (array) $list;
					$lists[ $list['group_id'] ]['value'] = $list['group_id'];
					$lists[ $list['group_id'] ]['label'] = $list['group_name'];
				}

				$this->_lists = $lists;

			}
		} catch ( Exception $e ) {

			// TODO: handle this properly
			return array();

		}

		$total_lists = count( $lists );

		$first = $total_lists > 0 ? reset( $lists ) : '';

		if ( ! empty( $first ) ) {

			$first = $first['value']; }

			$selected_lists = isset( $submitted_data['list_id'] ) && is_array( $submitted_data['list_id'] ) ?
				array_intersect( $submitted_data['list_id'], array_keys( $lists ) ) :
				array();

			if ( $is_submit ) {

				$module_id = $this->module_id;
				$module = Hustle_Module_Model::instance()->get( $module_id );

				if ( ! is_wp_error( $module ) ) {
					$synced = Hustle_E_Newsletter::get_synced( $module );
					$saved_auto_optin = ! empty( $this->addon_form_settings['auto_optin'] ) && 'pending' !== $this->addon_form_settings['auto_optin'] ? 'subscribed' : 'pending';
				}
			} else {
				$synced = 0;
				$saved_auto_optin = 'pending';
			}

			$checked = ! isset( $submitted_data['auto_optin'] ) ? $saved_auto_optin : $submitted_data['auto_optin'];

			$options = array(
				array(
					'type'     => 'wrapper',
					'elements' => array(
						array(
							'type'  => 'label',
							'value' => __( 'Email List(s)', 'wordpress-popup' ),
						),
						array(
							'type'     => 'checkboxes',
							'name'     => 'list_id[]',
							'id'       => 'wph-email-provider-lists',
							'selected' => $selected_lists,
							'options'  => $lists,
							'class'    => 'sui-checkbox-sm sui-checkbox-stacked'
						),
					),
				),
				array(
					'type'     => 'wrapper',
					'style'    => 'margin-bottom: 0;',
					'elements' => array(
						array(
							'type'  => 'label',
							'value' => __( 'Extra Settings', 'wordpress-popup' ),
						),
						array(
							'type'       => 'checkbox',
							'name'       => 'auto_optin',
							'value'      => 'subscribed',
							'label'      => __( 'Automatically opt-in new users to the mailing list.', 'wordpress-popup' ),
							'attributes' => array(
								'checked' => ( 'subscribed' === $checked || '1' === $checked ) ? 'checked' : '',
							),
							'id'         => 'auto_optin',
							'class'      => 'sui-checkbox-sm sui-checkbox-stacked',
						),
					),
				),
				array(
					'type'  => 'hidden',
					'name'  => 'synced',
					'value' => $synced ? 1 : 0,
					'id'    => 'synced',
				),
				array(
					'type'  => 'hidden',
					'name'  => 'is_submit',
					'value' => '1',
				),
			);

			return $options;
		}
	} // Class end.

endif;