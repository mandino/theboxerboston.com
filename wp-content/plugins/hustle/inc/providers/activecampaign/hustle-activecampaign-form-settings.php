<?php
if( !class_exists("Hustle_Activecampaign_Form_Settings") ):

/**
 * Class Hustle_Activecampaign_Form_Settings
 * Form Settings ActiveCampaign Process
 *
 */
class Hustle_Activecampaign_Form_Settings extends Hustle_Provider_Form_Settings_Abstract {

	private $is_empty_lists = false;

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
			// 1
			array(
				'callback'     => array( $this, 'second_step_callback' ),
				'is_completed' => array( $this, 'second_step_is_completed' ),
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
		return true;
	}

	/**
	 * Check if step is completed
	 *
	 * @since 4.0
	 * @return bool
	 */
	public function second_step_is_completed() {
		$this->addon_form_settings = $this->get_form_settings_values();
		$is_form = isset( $this->addon_form_settings['sign_up_to'] ) && 'form' === $this->addon_form_settings['sign_up_to'];

		if ( $is_form ) {
			if ( empty( $this->addon_form_settings['form_id'] ) ) {
				// preliminary value
				$this->addon_form_settings['form_id'] = 0;

				return false;
			}
		} else {
			if ( empty( $this->addon_form_settings['list_id'] ) ) {
				// preliminary value
				$this->addon_form_settings['list_id'] = 0;

				return false;
			}
		}

		return true;
	}

	/**
	 * Returns all settings and conditions for 1st step of Activecampaign settings
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
			'sign_up_to' => '',
		);
		$current_data = $this->get_current_data( $current_data, $submitted_data );

		$is_submit = ! empty( $submitted_data['is_submit'] );
		$options = $this->get_first_step_options( $current_data );

		$step_html = Hustle_Api_Utils::get_modal_title_markup( __( 'ActiveCampaign Forms or Lists', 'wordpress-popup' ), '' );
		$step_html .= Hustle_Api_Utils::get_html_for_options( $options );

		$buttons = array(
			'disconnect' => array(
				'markup' => Hustle_Api_Utils::get_button_markup( __( 'Disconnect', 'wordpress-popup' ), 'sui-button-ghost', 'disconnect_form', true ),
			),
			'save' => array(
				'markup' => Hustle_Api_Utils::get_button_markup( __( 'Continue', 'wordpress-popup' ), '', 'next', true ),
			),
		);

		$response = array(
			'html'       => $step_html,
			'buttons'    => $buttons,
			'has_errors' => false,
		);


		// Save only after the step has been validated
		if( $is_submit ){
			$this->save_form_settings_values( $current_data );
		}

		return $response;
	}

	/**
	 * Return an array of options used to display the settings of the 1st step.
	 *
	 * @since 4.0
	 *
	 * @param array $submitted_data
	 * @return array
	 */
	private function get_first_step_options( $submitted_data ) {
		$sign_up_to = $submitted_data['sign_up_to'];

		$options =  array(
			array(
				'type'     => 'wrapper',
				'elements' => array(
					'opt_in' => array(
						'type'        => 'checkbox',
						'name'        => 'sign_up_to',
						'value'       => 'form',
						'id'          => 'sign_up_to',
						'class'       => 'sui-checkbox-sm',
						'attributes'  => array(
							'checked' => 'form' === $sign_up_to ? 'checked' : '',
						),
						'label'       => __( 'Enable to choose from your existing forms instead of your existing lists.', 'wordpress-popup' ),
					),
				),
			),
			array(
				'type'     => 'wrapper',
				'style'    => 'margin-bottom: 0;',
				'elements' => array(
					array(
						'type' => 'notice',
						'value' => __( 'Double opt-in is only available when using forms.', 'wordpress-popup' ),
						'class' => 'sui-notice-warning',
					),
				),
			),
			array(
				'type'  => 'hidden',
				'name'  => 'is_submit',
				'value' => '1',
			),
		);

		return $options;
	}


	/**
	 * Returns all settings and conditions for 2st step of Activecampaign settings
	 *
	 * @since 3.0.5
	 * @since 4.0 param $validate removed.
	 *
	 * @param array $submitted_data
	 * @return array
	 */
	public function second_step_callback( $submitted_data ) {
		$this->addon_form_settings = $this->get_form_settings_values( false );
		$sign_up_to = isset( $this->addon_form_settings['sign_up_to'] ) ? $this->addon_form_settings['sign_up_to'] : '';
		$form = 'form' === $sign_up_to;
		$list_id = $form ? 'form_id' : 'list_id';
		$list_name = $form ? 'form_name' : 'list_name';
		$current_data = array(
			$list_id => '',
		);

		$current_data = $this->get_current_data( $current_data, $submitted_data );
		$is_submit = ! empty( $submitted_data['is_submit'] );

		if ( $is_submit && empty( $submitted_data[ $list_id ] ) ) {
			$error_message = $form ? __( 'The form is required.', 'wordpress-popup' ) : __( 'The email list is required.', 'wordpress-popup' );
		}

		$options = $this->get_second_step_options( $current_data, $form );

		$step_html = $form
			? Hustle_Api_Utils::get_modal_title_markup( __( 'Choose your form', 'wordpress-popup' ), __( 'Choose the form you want to send form data to.', 'wordpress-popup' ) )
			: Hustle_Api_Utils::get_modal_title_markup( __( 'Choose your list', 'wordpress-popup' ), __( 'Choose the list you want to send form data to.', 'wordpress-popup' ) );
		$step_html .= Hustle_Api_Utils::get_html_for_options( $options );

		if( ! isset( $error_message ) ) {
			$has_errors = false;
		} else {
			$step_html .= '<span class="sui-error-message">' . $error_message . '</span>';
			$has_errors = true;
		}


		$buttons = array(
			'cancel' => array(
				'markup' => Hustle_Api_Utils::get_button_markup( __( 'Back', 'wordpress-popup' ), '', 'prev', true ),
			),
			'save' => array(
				'markup' => Hustle_Api_Utils::get_button_markup( __( 'Save', 'wordpress-popup' ), '', 'next', true, $this->is_empty_lists ),
			),
		);

		$response = array(
			'html'       => $step_html,
			'buttons'    => $buttons,
			'has_errors' => $has_errors,
		);

		// Save only after the step has been validated and there are no errors
		if( $is_submit && ! $has_errors ){
			// Save additional data for submission's entry
			if ( !empty( $current_data[ $list_id ] ) ) {
				$current_data[ $list_name ] = !empty( $this->lists[ $current_data[ $list_id ] ]['label'] )
						? $this->lists[ $current_data[ $list_id ] ]['label'] . ' (' . $current_data[ $list_id ] . ')' : $current_data[ $list_id ];
			}
			$this->save_form_settings_values( $current_data );
		}

		return $response;
	}

	/**
	 * Return an array of options used to display the settings of the 2st step.
	 *
	 * @since 4.0
	 *
	 * @param array $submitted_data
	 * @param bool $is_form
	 * @return array
	 */
	private function get_second_step_options( $submitted_data, $is_form ) {
		$provider = $this->provider;
		$settings = $this->get_form_settings_values( false );

		$global_multi_id = $settings['selected_global_multi_id'];
		$api_url = $provider->get_setting( 'api_url', '', $global_multi_id );
		$api_key = $provider->get_setting( 'api_key', '', $global_multi_id );

		$lists = array();

		try {

			$api = $provider::api( $api_url, $api_key );

			// Retrieve lists if "sign_up_to" is not set to "forms".
			if ( !$is_form ) {

				$_lists = $api->get_lists();

				if ( ! is_wp_error( $_lists ) && ! empty( $_lists ) ) {

					foreach (  ( array) $_lists as $list ) {

						$list = (object) (array) $list;

						$lists[ $list->id ] = array(
							'value' => $list->id,
							'label' => $list->name,
						);

					}
				}
			} else {

				// Retrieve forms otherwise
				$_forms = $api->get_forms();

				if ( ! is_wp_error( $_forms ) && !empty( $_forms ) ) {

					foreach( $_forms as $form => $data ) {

						$lists[ $data['id'] ] = array(
							'value' => $data['id'],
							'label' => $data['name'],
						);
					}

				}
			}
		} catch ( Exception $e ) {
			// TODO: handle this properly
			return array();
		}

		$this->lists = $lists;
		$total_lists = count( $lists );

		$first = $total_lists > 0 ? reset( $lists ) : "";

		if ( !empty( $first ) )
			$first = $first['value'];

		if ( $is_form && isset( $submitted_data['form_id'] ) ) {
			$selected = array_key_exists( $submitted_data['form_id'], $lists ) ? $submitted_data['form_id'] : $first;
		} else if ( ! $is_form && isset( $submitted_data['list_id'] ) ) {
			$selected = array_key_exists( $submitted_data['list_id'], $lists ) ? $submitted_data['list_id'] : $first;
		} else {
			$selected = $first;
		}

		$this->is_empty_lists = empty( $lists );

		if ( ! $is_form ) {

			if ( empty( $lists ) ) {

				$options =  array(
					array(
						'type'     => 'wrapper',
						'style'    => 'margin-bottom: 0;',
						'elements' => array(
							'options' => array(
								'type'  => 'notice',
								'class' => 'sui-notice-error',
								'value' => __( "You can't sync this provider because your account doesn't have any email list added. Please, go to your ActiveCampaign account to add one before retrying.", 'wordpress-popup' ),
							),
						),
					),
				);
			} else {

				$options =  array(
					array(
						'type'     => 'wrapper',
						'style'    => 'margin-bottom: 0;',
						'elements' => array(
							'label'   => array(
								'type'  => 'label',
								'for'   => 'list_id',
								'value' => __( 'Email List', 'wordpress-popup' ),
							),
							'options' => array(
								'type'     => 'select',
								'name'     => 'list_id',
								'default'  => '',
								'options'  => $lists,
								'value'    => $selected,
								'selected' => $selected,
							),
						),
					),
					array(
						'type'  => 'hidden',
						'name'  => 'is_submit',
						'value' => '1',
					),
				);
			}
		} else {

			if ( empty( $lists ) ) {

				$options =  array(
					array(
						'type'     => 'wrapper',
						'style'    => 'margin-bottom: 0;',
						'elements' => array(
							'options' => array(
								'type'  => 'notice',
								'class' => 'sui-notice-error',
								'value' => __( "You don't have any form added to your account to sync here.", 'wordpress-popup' ),
							),
						),
					),
				);
			} else {

				$options =  array(
					array(
						'type'     => 'wrapper',
						'style'    => 'margin-bottom: 0;',
						'elements' => array(
							'label'   => array(
								'type'  => 'label',
								'for'   => 'form_id',
								'value' => __( 'Choose Form', 'wordpress-popup' ),
							),
							'options' => array(
								'type'     => 'select',
								'name'     => 'form_id',
								'default'  => '',
								'options'  => $lists,
								'value'    => $selected,
								'selected' => $selected,
							),
						),
					),
					array(
						'type'  => 'hidden',
						'name'  => 'is_submit',
						'value' => '1',
					),
				);
			}
		}

		return $options;
	}

} // Class end.

endif;
