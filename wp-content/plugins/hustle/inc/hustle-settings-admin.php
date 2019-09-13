<?php
/**
 * Class Hustle_Settings_Admin
 *
 */
class Hustle_Settings_Admin extends Hustle_Admin_Page_Abstract {

	/**
	 * Key of the Hustle's settings in wp_options.
	 * @since 4.0
	 */
	const SETTINGS_OPTION_KEY = 'hustle_settings';

	const DISMISSED_USER_META = 'hustle_dismissed_notifications';

	public function init() {

		$this->page = 'hustle_settings';

		$this->page_title = __( 'Hustle Settings', 'wordpress-popup' );

		$this->page_menu_title = __( 'Settings', 'wordpress-popup' );

		$this->page_capability = 'hustle_edit_settings';

		$this->page_template_path = 'admin/settings';

        /**
         * Add visual settings classes
         */
        add_filter( 'hustle_sui_wrap_class', array( $this, 'sui_wrap_class' ) );
	}

	public function get_page_template_args() {
		$current_user = wp_get_current_user();
		$email_settings = self::get_email_settings();
		$modules = Hustle_Module_Collection::instance()->get_all_paginated();
		$accessibility = self::get_hustle_settings( 'accessibility' );
		return array(
			'user_name' => ucfirst( $current_user->display_name ),
			'filter' => $modules['filter'],
			'modules' => $modules['modules'],
			'modules_count' => $modules['count'],
			'modules_page' => $modules['page'],
			'modules_limit' => $modules['limit'],
			'modules_show_pager' => $modules['show_pager'],
			'modules_edit_roles' => $modules['edit_roles'],
			'email_name' => $email_settings['sender_email_name'],
			'email_address' => $email_settings['sender_email_address'],
			'unsubscription_messages' => self::get_unsubscribe_messages(),
			'unsubscription_email' => self::get_unsubscribe_email_settings(),
			'hustle_settings' => self::get_hustle_settings(),
			'section' => Hustle_Module_Admin::get_current_section( 'emails' ),
			'accessibility' => $accessibility,
			'migrate' => apply_filters( 'hustle_settings_migrate_data', array() ),
		);
	}

	/**
	 * Gets the saved or default global unsubscription messages.
	 *
	 * @since 3.0.5
	 * @return array
	 */
	public static function get_unsubscribe_messages() {

		$settings = self::get_hustle_settings( 'unsubscribe' );

		// Default unsubscription messages
		$default = array(
			'enabled' => '0',
			'get_lists_button_text' => __( 'Get Lists', 'wordpress-popup' ),
			'submit_button_text' => __( 'Unsubscribe!', 'wordpress-popup' ),
			'invalid_email' => __( 'Please enter a valid email address.', 'wordpress-popup' ),
			'email_not_found' => __( "Looks like you're not in our list!", 'wordpress-popup' ),
			'invalid_data' => __( "The unsubscription data doesn't seem to be correct.", 'wordpress-popup' ),
			'email_submitted' => __( 'Please check your email to confirm your unsubscription.', 'wordpress-popup' ),
			'successful_unsubscription' => __( "You've been successfully unsubscribed.", 'wordpress-popup' ),
			'email_not_processed' => __( 'Something went wrong submitting the email. Please make sure a list is selected.', 'wordpress-popup' ),
		);

		$messages = $default;

		// Use customized unsubscribe messages if they're set, and if it's enabled (for frontend), or is_admin() (for settings page)
		if ( ! empty( $settings['messages'] ) ) {

			$saved_messages = $settings['messages'];
			if ( is_string( $saved_messages ) ) {
				$saved_messages = json_decode( $saved_messages );
			}

			if ( is_admin() || '0' !== (string) $saved_messages['enabled'] ) {
				$messages = stripslashes_deep( array_merge( $default, $saved_messages ) );
			}
		}

		return apply_filters( 'hustle_get_unsubscribe_messages', $messages );
	}

	/**
	 * Gets the saved or default global unsubscription email settings.
	 *
	 * @since 3.0.5
	 * @return array
	 */
	public static function get_unsubscribe_email_settings() {

		$default_email_body = sprintf( 
			esc_html__(
				'%1$sHi%2$s
				%3$sWe\'re sorry to see you go!%4$s
				%5$sClick on the link below to unsubscribe:%6$s
				{hustle_unsubscribe_link}%7$s',
				'wordpress-popup'
			),
			'<p><strong>',
			'</strong></p>',
			'<p><strong>',
			'</strong></p>',
			'<p><strong>',
			'<br />',
			'</strong></p>'
		);

		$default_email_settings = array(
			'enabled' => '0',
			'email_subject' => __( 'Unsubscribe', 'wordpress-popup' ),
			'email_body' => $default_email_body,
		);

		$settings = self::get_hustle_settings( 'unsubscribe' );

		// Use customized unsubscribe email messages if they're set, and if it's enabled (for frontend), or is_admin() (for settings page)
		$saved_settings = isset( $settings['email'] ) && ( ( isset( $settings['email']['enabled'] ) && '0' !== (string) $settings['email']['enabled'] ) || is_admin() ) ?
			$settings['email'] : array();

		$stored_email_settings = array();
		if ( ! empty( $saved_settings ) ) {
			$saved_settings['email_body'] = isset( $saved_settings['email_body'] ) ? json_decode( $saved_settings['email_body'] ) : '';
			$stored_email_settings = stripslashes_deep( $saved_settings );
		}

		$email_settings = array_merge( $default_email_settings, $stored_email_settings );

		return apply_filters( 'hustle_get_unsubscribe_email', $email_settings );
	}

	/**
	 * Gets the saved or default global email settings.
	 *
	 * @since 3.0.5
	 * @return array
	 */
	public static function get_email_settings() {

		$default_email_settings = array(
			'sender_email_name' => get_bloginfo( 'name' ),
			'sender_email_address' => get_option( 'admin_email', '' ),
		);

		$email_settings = $default_email_settings;
		$saved_settings = self::get_hustle_settings( 'emails' );

		if ( ! empty( $saved_settings ) ) {
			$saved_email_settings = array_filter( $saved_settings, 'strlen' );
			$email_settings = array_merge( $default_email_settings, $saved_email_settings );
		}

		return apply_filters( 'hustle_get_email_settings', $email_settings );
	}

	/**
	 * Gets the saved or default global reCaptcha settings.
	 *
	 * @since 3.0.5
	 * @return array
	 */
	public static function get_recaptcha_settings() {

		$default = array(
			'sitekey' => '',
			'secret' => '',
			'language' => 'automatic',
		);

		$recaptcha_settings = $default;
		$saved_settings = self::get_hustle_settings( 'recaptcha' );
		
		if ( ! empty( $saved_settings ) ) {
			$recaptcha_settings = array_merge( $default, $saved_settings );
		}

		return apply_filters( 'hustle_get_recaptcha_settings', $recaptcha_settings );
	}

	/**
	 * Is reCaptcha ready to use?
	 *
	 * @since 4.0.0
	 *
	 * @return boolean
	 */
	public static function is_recaptcha_available() {
		$settings = self::get_recaptcha_settings();
		if ( ! isset( $settings['sitekey'] ) ) {
			return false;
		}
		$empty = empty( $settings['sitekey'] );
		if ( $empty ) {
			return false;
		}
		if ( ! isset( $settings['secret'] ) ) {
			return false;
		}
		$empty = empty( $settings['secret'] );
		if ( $empty ) {
			return false;
		}
		return true;
	}

	/**
	 * Get settings
	 *
	 * @since 4.0.0
	 *
	 * @param string $key Key from settings, can be null, then whole * settings is returned.
	 */
	public static function get_hustle_settings( $key = null ) {

		$settings = get_option( self::SETTINGS_OPTION_KEY, array() );

		if ( ! empty( $key ) ) {

			if ( isset( $settings[ $key ] ) ) {
				
				$specific_setting = $settings[ $key ];

				if ( ! is_array( $specific_setting ) ) {
					$specific_setting = json_decode( $specific_setting, true );
				}

				return $specific_setting;
			}

			return array();
		}

		return $settings;
	}
	
	/**
	 * Update Hustle Settings
	 * @since 4.0.0
	 *
	 * @param mixed $value Value to store
	 * @param string $key Key from settings, can be null, then whole settings will be saved.
	 */
	public static function update_hustle_settings( $value, $key = null ) {
		if ( empty( $key ) ) {
			update_option( self::SETTINGS_OPTION_KEY, $value );
			return;
		}
		$settings = self::get_hustle_settings();
		$settings[ $key ] = $value;
		update_option( self::SETTINGS_OPTION_KEY, $settings );
	}

	/**
	 * Add a notification to the dismissed list.
	 * 
	 * @since 4.0
	 *
	 * @param string $notification_name
	 */
	public static function add_dismissed_notification( $notification_name ) {
		
		$dismissed = get_user_meta( get_current_user_id(), self::DISMISSED_USER_META, true );

		if ( is_array( $dismissed ) ) {
			if ( in_array( $notification_name, $dismissed, true ) ) {
				return;
			}
			$dismissed[] = $notification_name;
		
		} else {
			$dismissed = array( $notification_name );
		}

		update_user_meta( get_current_user_id(), self::DISMISSED_USER_META, $dismissed );
	}

	/**
	 * Check if the given notification was dismissed.
	 * 
	 * @since 4.0
	 *
	 * @param string $notification_name
	 * @return bool
	 */
	public static function was_notification_dismissed( $notification_name ) {
		$dismissed = get_user_meta( get_current_user_id(), self::DISMISSED_USER_META, true );

		return ( is_array( $dismissed ) && in_array( $notification_name, $dismissed, true ) );
    }

		/**
		 * Handle SUI wrapper container classes.
		 *
		 * @since 4.0.06
		 */
    public function sui_wrap_class( $classes ) {
        if ( is_string( $classes ) ) {
            $classes = array( $classes );
        }
        if ( ! is_array( $classes ) ) {
            $classes = array();
        }
        $classes[] = 'sui-wrap';
        $classes[] = 'sui-wrap-hustle';
        /**
         * Add high contrast mode.
         */
        $accessibility = self::get_hustle_settings( 'accessibility' );
        $is_high_contrast_mode = !empty( $accessibility['accessibility_color'] );
        if ( $is_high_contrast_mode ) {
            $classes[] = 'sui-color-accessible';
        }
        /**
         * Set hide branding
         *
         * @since 4.0.0
         */
        $hide_branding = apply_filters( 'wpmudev_branding_hide_branding', false );
        if ( $hide_branding ) {
            $classes[] = 'no-hustle';
        }
        /**
         * hero image
         *
         * @since 4.0.0
         */
        $image = apply_filters( 'wpmudev_branding_hero_image', 'hustle-default' );
        if ( empty( $image ) ) {
            $classes[] = 'no-hustle-hero';
        }
        return $classes;
    }
}
