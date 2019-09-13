<?php
if( !class_exists("Hustle_MailerLite_Form_Settings") ):

/**
 * Class Hustle_MailerLite_Form_Settings
 * Form Settings MailerLite Process
 *
 */
class Hustle_MailerLite_Form_Settings extends Hustle_Provider_Form_Settings_Abstract {

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
			$this->addon_form_settings['list_id'] = 0;

			return false;
		}

		if ( empty( $this->addon_form_settings['list_id'] ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Returns all settings and conditions for 1st step of MailerLite settings
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
		);
		$current_data = $this->get_current_data( $current_data, $submitted_data );

		$is_submit = ! empty( $submitted_data['is_submit'] ) && empty( $submitted_data['page'] );
		if ( $is_submit && empty( $submitted_data['list_id'] ) ) {
			$error_message = __( 'The email list is required.', 'wordpress-popup' );
		}
		if ( !$is_submit && ! empty( $submitted_data['page'] ) ) {
			$settings = array();
			$settings['page'] = $submitted_data['page'];
			$this->save_form_settings_values( $settings );
		}

		$options = $this->get_first_step_options( $current_data );

		$step_html = Hustle_Api_Utils::get_modal_title_markup(
			__( 'MailerLite List', 'wordpress-popup' ),
			__( 'Choose the list you want to send form data to.', 'wordpress-popup' )
		);
		$step_html .= Hustle_Api_Utils::get_html_for_options( $options );

		if( ! isset( $error_message ) ) {
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
		if( $is_submit && ! $has_errors ){
			// Save additional data for submission's entry
			if ( !empty( $current_data['list_id'] ) ) {
				$current_data['list_name'] = !empty( $this->lists[ $current_data['list_id'] ]['label'] )
						? $this->lists[ $current_data['list_id'] ]['label'] . ' (' . $current_data['list_id'] . ')' : $current_data['list_id'];
			}
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
		$provider = $this->provider;
		$settings = $this->get_form_settings_values( false );

		$global_multi_id = $settings['selected_global_multi_id'];
		$api_key = $provider->get_setting( 'api_key', '', $global_multi_id );
		$lists = array();

		try {
			$api = $provider::api( $api_key );

			//Load more function
			$load_more = !empty( $settings['page'] );
			$page = $load_more ? (int)$settings['page'] : 1;
			$page_limit = 100;
			$offset = ($page-1)*$page_limit;

			// Check if API key is valid
			if ( $api ) {
				$_lists = $api->list_groups( $offset );
			}

			if( ! is_wp_error( $_lists ) && ! isset( $_lists['error'] ) && ! empty( $_lists ) ) {

				if( is_array( $_lists ) ) {
					foreach( $_lists as $list ) {
						$lists[ $list['id'] ]['value'] = $list['id'];
						$lists[ $list['id'] ]['label'] = $list['name'];
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
		if( !empty( $first ) )
			$first = $first['value'];

		if( ! isset( $submitted_data['list_id'] ) ) {
			$selected_list = $first;
		} else {
			$selected_list = array_key_exists( $submitted_data['list_id'], $lists ) ? $submitted_data['list_id'] : $first;
		}

		$options =  array(
			'list_id_setup' => array(
				'type'     => 'wrapper',
				'style'    => 'margin-bottom: 0;',
				'elements' => array(
					'label' => array(
						'type'  => 'label',
						'for'   => 'list_id',
						'value' => __( 'Email List', 'wordpress-popup'),
					),
					'choose_email_list' => array(
						'type'          => 'select',
						'name'          => 'list_id',
						'default'       => '',
						'options'       => $lists,
						'value'         => $selected_list,
						'selected'      => $selected_list,
					),
				),
			),
			'api_key' => array(
				'type'  => 'hidden',
				'name'  => 'is_submit',
				'value' => '1',
			),
		);

		$navigation_elements = array();
		if ( 1 < $page ) {
			$navigation_elements['navigation_prev'] = $this->get_previous_button( $page );
		}

		if ( $page_limit === $total_lists ) {
			$navigation_elements['navigation_next'] = $this->get_next_button( $page );
		}
		
		if ( ! empty( $navigation_elements ) ) {
			$options['list_id_setup']['elements']['navigation_wrapper'] = array(
				'type' => 'wrapper',
				'class' => 'hui-email-list-navigation',
				'is_not_field_wrapper' => true,
				'elements' => $navigation_elements,
			);
		}

		return $options;
	}

} // Class end.

endif;
