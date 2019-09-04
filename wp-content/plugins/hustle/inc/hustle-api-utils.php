<?php

/**
 * Wrapper for the utils expected to be used by external integrations.
 *
 * Class Hustle_Api_Utils
 */
class Hustle_Api_Utils {

	/**
	 * Adds an entry to debug log
	 *
	 * By default it will check `WP_DEBUG` to decide whether to add the log,
	 * then will check `filters`.
	 *
	 * @since 3.0.5
	 */
	public static function maybe_log() {
		$enabled = ( defined( 'WP_DEBUG' ) && WP_DEBUG );

		/**
		 * Filter to enable or disable log for Hustle
		 *
		 * By default it will check `WP_DEBUG`
		 *
		 * @since 3.0.5
		 *
		 * @param bool $enabled current enabled status
		 */
		$enabled = apply_filters( 'hustle_enable_log', $enabled );

		if ( $enabled ) {
			$args    = func_get_args();
			$message = wp_json_encode( $args );
			if ( false !== $message ) {
				error_log( '[Hustle] ' . $message ); // phpcs:ignore
			}

		}
	}

	/**
	 * Used for sanitizing form submissions.
	 * This method will do a simple sanitation of $post_data. It applies sanitize_text_field() to the keys and values of the first level array.
	 * The keys from second level arrays are converted to numbers, and their values are sanitized with sanitize_text_field() as well.
	 * This method doesn’t do an exhaustive sanitation, so you should handled special cases if your integration requires something different.
	 * The names passed on $required_fields are searched into $post_data array keys. If the key is not set, an array with the key “errors” is returned.
	 *
	 * @since 3.0.5
	 * @uses Opt_In_Utils::validate_and_sanitize_fields()
	 * @param array $post_data The data to be sanitized and validated.
	 * @param array $required_fields Fields that must exist on $post_data so the validation doesn't fail.
	 * @return array
	 */
	public static function validate_and_sanitize_fields( $post_data, $required_fields = array() ) {
		return Opt_In_Utils::validate_and_sanitize_fields( $post_data, $required_fields );
	}

	/**
	 * Used for checking required fields on form submissions.
	 * The names passed on $required_fields are searched into $post_data array keys. If the key is not set, an array with the key “errors” is returned.
	 *
	 * @since 3.0.5
	 * @param array $submitted_data The data to be validated.
	 * @param array $required_fields Fields that must exist on $post_data so the validation doesn't fail. It must be an associative array, with the field name as the keys.
	 * @param string $error_message Error message to be used on sprintf to retrieve user friendly error messages for each fields.
	 * @return array Empty if everything is good. Filled if there are errors.
	 */
	public static function check_for_required_fields( $submitted_data, $required_fields, $error_message = '' ) {
		$errors = array();
		$error_message = empty( $error_message ) ? __( '%s is required.', Opt_In::TEXT_DOMAIN ) : $error_message;
		foreach ( $required_fields as $key => $required_field ) {
			if ( ! isset( $submitted_data[ $key ] ) || ( empty( $submitted_data[ $key ] ) && '0' !== $submitted_data[ $key ] ) ) {
				$errors[ $key ] = sprintf( $error_message, $required_field );
				continue;
			}
		}
		return $errors;
	}

	// Markup helpers section

	/**
	 * Retrieves the HTML markup given an array of options.
	 * Renders it from the file "general/option.php", which is a template.
	 * The array should be something like:
	 * array(
	 * 		"optin_url_label" => array(
	 *			"id"    => "optin_url_label",
	 *			"for"   => "optin_url",
	 *			"value" => "Enter a Webhook URL:",
	 *			"type"  => "label",
	 *		),
	 *		"optin_url_field_wrapper" => array(
	 *			"id"        => "optin_url_id",
	 *			"class"     => "optin_url_id_wrapper",
	 *			"type"      => "wrapper",
	 *			"elements"  => array(
	 *				"optin_url_field" => array(
	 *					"id"            => "optin_url",
	 *					"name"          => "api_key",
	 *					"type"          => "text",
	 *					"default"       => "",
	 *					"value"         => "",
	 *					"placeholder"   => "",
	 *					"class"         => "wpmudev-input_text",
	 *				)
	 *			)
	 *		),
	 *	);
	 *
	 * @since 4.0
	 * @uses Opt_In::static_render()
	 * @param array $options
	 * @return string
	 */
	public static function get_html_for_options( $options ) {
		$html = '';
		foreach( $options as $key =>  $option ){
			$html .= Opt_In::static_render("general/option", array_merge( $option, array( "key" => $key ) ), true);
		}
		return $html;
	}

	/**
	 * Return the markup for buttons.
	 *
	 * @param string $value
	 * @param string $class
	 * @param string $action next/prev/close/connect/disconnect. Action that this button triggers.
	 * @param bool $loading whether the button should have the 'loading' markup.
	 * @return string
	 */
	public static function get_button_markup( $value = '', $class = '', $action = '', $loading = false, $disabled = false ) {

		if ( ! empty( $action ) ) {
			switch( $action ) {
				case 'next':
					$action_class =	'hustle-provider-next ';
					break;
				case 'prev':
					$action_class =	'hustle-provider-back ';
					break;
				case 'close':
					$action_class =	'hustle-provider-close ';
					break;
				case 'connect':
					$action_class =	'hustle-provider-connect ';
					break;
				case 'disconnect':
					$action_class =	'hustle-provider-disconnect ';
					break;
				case 'disconnect_form':
					$action_class =	'hustle-provider-form-disconnect ';
					break;
				default:
					$action_class = '';
			}
		}

		$inner = $loading ? '<span class="sui-loading-text">' . esc_html( $value ) . '</span><i class="sui-icon-loader sui-loading" aria-hidden="true"></i>' : esc_html( $value );
		// Maybe render this from "options" template.
		$html = '<button type="button" class="sui-button '. esc_attr( $action_class ) . esc_attr( $class ) . '" ' . disabled( $disabled, true, false  ) . '>' . $inner . '</button>';

		return $html;
	}

	/**
	 * Return the markup used for the title of Integrations modal
	 *
	 * @param string $title
	 * @param string $subtitle
	 * @param string $class
	 * @return string
	 */
	public static function get_modal_title_markup( $title = '', $subtitle = '', $class = '' ) {

		$html = '<div class="integration-header ' . esc_attr( $class ) . '">';

			if ( ! empty( $title ) ) {
				$html .= '<h3 class="sui-box-title" id="dialogTitle2">' . esc_html( $title ) . '</h3>';
			}

			if ( ! empty( $subtitle ) ){
				$html .= '<p class="sui-description">' . $subtitle . '</p>';
			}

		$html .= '</div>';

		return $html;
	}

}
