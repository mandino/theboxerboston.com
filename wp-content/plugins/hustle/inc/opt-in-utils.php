<?php

/**
 * Conditions utils
 *
 * Most of the methods are courtesy Philipp Stracker
 *
 * Class Opt_In_Utils
 */
class Opt_In_Utils {

	/**
	 * Instance of Opt_In_Geo
	 *
	 * @var Opt_In_Geo
	 */
	private $_geo;

	/**
	 * CPT
	 *
	 * @var array
	 */
	private static $post_types;

	public function __construct( Opt_In_Geo $geo ) {
		$this->_geo = $geo;
	}

	/**
	 * Checks if user has already commented
	 *
	 * @return bool|int
	 */
	public function has_user_commented() {
		global $wpdb;
		static $comment = null;

		if ( null === $comment ) {
			// Guests (and maybe logged in users) are tracked via a cookie.
			$comment = isset( $_COOKIE[ 'comment_author_' . COOKIEHASH ] ) ? 1 : 0;

			if ( ! $comment && is_user_logged_in() ) {
				// For logged-in users we can also check the database.
				$count = absint( $wpdb->get_var( $wpdb->prepare(
					"SELECT COUNT(1) FROM {$wpdb->comments} WHERE user_id = %s",
				get_current_user_id() ) ) );
				$comment = $count > 0;
			}
		}
		return $comment;
	}

	/**
	 * Returns the referrer.
	 *
	 * @return string
	 */
	public function get_referrer() {
		$referrer = '';

		$is_ajax = (defined( 'DOING_AJAX' ) && DOING_AJAX)
			|| ( ! empty( $_POST['_po_method_'] ) && 'raw' === $_POST['_po_method_'] ); // WPCS: CSRF ok.

		if ( isset( $_REQUEST['thereferrer'] ) ) { // WPCS: CSRF ok.
			$referrer = $_REQUEST['thereferrer']; // WPCS: CSRF ok.
		} else if ( ! $is_ajax && isset( $_SERVER['HTTP_REFERER'] ) ) {
			// When doing Ajax request we NEVER use the HTTP_REFERER!
			$referrer = $_SERVER['HTTP_REFERER'];
		}

		return $referrer;
	}

	/**
	 * Tests if the current referrer is one of the referers of the list.
	 * Current referrer has to be specified in the URL param "thereferer".
	 *
	 *
	 * @param  array $list List of referers to check.
	 * @return bool
	 */
	public function test_referrer( $list ) {
		$response = false;
		if ( is_string( $list ) ) {
			$list = array( $list );
		}
		if ( ! is_array( $list ) ) {
			return true;
		}

		$referrer = $this->get_referrer();

		if ( empty( $referrer ) ) {
			$response = false;
		} else {
			foreach ( $list as $item ) {
				$item = trim( $item );
				$res = stripos( $referrer, $item );
				if ( false !== $res ) {
					$response = true;
					break;
				}
			}
		}

		return $response;
	}

	/**
	 * Tests if the $test_url matches any pattern defined in the $list.
	 *
	 * @since  4.6
	 * @param  string $test_url The URL to test.
	 * @param  array $list List of URL-patterns to test against.
	 * @return bool
	 */
	public function check_url( $test_url, $list ) {
		$response = false;

		$list = array_map( 'trim', (array) $list );
		$test_url = strtok( $test_url, '#' );
		if ( empty( $list ) ) {
			$response = true;
		} else {
			foreach ( $list as $match ) {
				$match = strtok( $match, '#' );

				// We're using '%' at the beggining of the string in visibility conditions to differentiate
				// regular urls from regex. If it's not regex, use regular url check.
				if ( 0 !== strpos( $match, '%' ) ) {

					// Check if we're using a wildcard.
					if ( false === strpos( $match, '*' ) ) {
						$match = preg_quote( $match, null );
						if ( false === strpos( $match, '://' ) ) {
							$match = '\w+://' . $match;
						}
						if ( '/' !== substr( $match, -1 ) ) {
							$match .= '/?';
						} else {
							$match .= '?';
						}
						$exp = '#^' . $match . '$#i';

						$res = preg_match( $exp, $test_url );

					} else {
						// Check wildcards.
						$res = fnmatch( $match, $test_url );
					}
				} else {
					// Check for regex urls.
					$match = ltrim( $match, '%' );
					$exp = $match;

					$res = preg_match( $exp, $test_url );
				}

				if ( $res ) {
					$response = true;
					break;
				}
			}
		}

		return $response;
	}

	/**
	 * Returns current url
	 * should only be called after plugins_loaded hook is fired
	 *
	 * @return string
	 */
	public static function get_current_url() {
		if ( ! did_action( 'plugins_loaded' ) ) {
			new Exception( 'This method should only be called after plugins_loaded hook is fired' ); }

		global $wp;
		return add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
	}

	/**
	 * Returns current actual url, the one seen on browser
	 *
	 * @return string
	 */
	public function get_current_actual_url() {
		if ( ! did_action( 'plugins_loaded' ) ) {
			new Exception( 'This method should only be called after plugins_loaded hook is fired' ); }

		return 'http' . ( isset( $_SERVER['HTTPS'] ) ? 's' : '' ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	}



	/**
	 * Checks if the current user IP belongs to one of the countries defined in
	 * country_codes list.
	 *
	 * @param  array $country_codes List of country codes.
	 * @return bool
	 */
	public function test_country( $country_codes ) {
		$response = true;
		$country = $this->_geo->get_user_country();

		if ( 'XX' === $country ) {
			return $response;
		}

		return in_array( $country, (array) $country_codes, true );
	}

	/**
	 * Checks if user is allowed to perform the ajax actions
	 *
	 * @since 4.0
	 * @param array $capability Hustle capability
	 * @param int $module_id Optional. Module id
	 */
	public static function is_user_allowed_ajax( $capability, $module_id = null ) {
		$allowed = self::is_user_allowed( $capability, $module_id );

		if ( ! $allowed ) {
			wp_send_json_error( __( 'Invalid request, you are not allowed to make this request', Opt_In::TEXT_DOMAIN ) );
		}
	}

	/**
	 * Get short days names html escaped and translated
	 *
	 * @since 4.0
	 * @return array
	 */
	public static function get_short_days_names() {
		return array(
			esc_html__( 'Su', Opt_In::TEXT_DOMAIN ),
			esc_html__( 'Mo', Opt_In::TEXT_DOMAIN ),
			esc_html__( 'Tu', Opt_In::TEXT_DOMAIN ),
			esc_html__( 'We', Opt_In::TEXT_DOMAIN ),
			esc_html__( 'Th', Opt_In::TEXT_DOMAIN ),
			esc_html__( 'Fr', Opt_In::TEXT_DOMAIN ),
			esc_html__( 'Sa', Opt_In::TEXT_DOMAIN ),
		);
	}

	/**
	 * Get months names html escaped and translated
	 *
	 * @since 4.0
	 * @return array
	 */
	public static function get_months_names() {
		return array(
			esc_html__( 'January', Opt_In::TEXT_DOMAIN ),
			esc_html__( 'February', Opt_In::TEXT_DOMAIN ),
			esc_html__( 'March', Opt_In::TEXT_DOMAIN ),
			esc_html__( 'April', Opt_In::TEXT_DOMAIN ),
			esc_html__( 'May', Opt_In::TEXT_DOMAIN ),
			esc_html__( 'June', Opt_In::TEXT_DOMAIN ),
			esc_html__( 'July', Opt_In::TEXT_DOMAIN ),
			esc_html__( 'August', Opt_In::TEXT_DOMAIN ),
			esc_html__( 'September', Opt_In::TEXT_DOMAIN ),
			esc_html__( 'October', Opt_In::TEXT_DOMAIN ),
			esc_html__( 'November', Opt_In::TEXT_DOMAIN ),
			esc_html__( 'December', Opt_In::TEXT_DOMAIN ),
		);
	}

	/**
	 * Checks if user has the capability
	 *
	 * @since 4.0
	 * @param array $capability Hustle capability
	 * @param int $module_id Optional. Module id
	 * @return bool
	 */
	public static function is_user_allowed( $capability, $module_id = null ) {

		if ( is_null( $module_id ) ) {
			/**
			 * check permissions
			 */
			$allowed = current_user_can( $capability );
		} elseif ( empty( (int) $module_id ) ) {
			$allowed = false;
		} elseif ( current_user_can( 'manage_options' ) ) {
			$allowed = true;
		} else {
			$user = wp_get_current_user();
			$roles = ( array ) $user->roles;

			$module = Hustle_Module_Model::instance()->get( $module_id );
			if ( is_wp_error( $module ) ) {
				return false;
			}
			$allowed_roles = $module->get_meta( $module::KEY_MODULE_META_PERMISSIONS );
			$allowed_roles = ! empty( $allowed_roles ) ? json_decode( $allowed_roles ) : array();

			$allowed = (bool) array_intersect( $allowed_roles, $roles );
		}

		return $allowed;
	}

	/**
	 * Checks if the ajax
	 *
	 * @since 1.0
	 * @param $action string ajax call action name
	 */
	public static function validate_ajax_call( $action ) {
		if ( ! check_ajax_referer( $action, false, false ) ) {
			wp_send_json_error( __( 'Invalid request, you are not allowed to make this request', Opt_In::TEXT_DOMAIN ) ); }
	}

	/**
	 * Verify if current version is FREE
	 **/
	public static function _is_free() {
		$is_free = ! file_exists( Opt_In::$plugin_path . 'lib/wpmudev-dashboard/wpmudev-dash-notification.php' );

		return $is_free;
	}

	/**
	 * Remove "-pro" that came from the menu which causes template not to work
	 **/
	public static function clean_current_screen( $screen ) {
		return str_replace( 'hustle-pro', 'hustle', $screen );
	}

	/**
	 * Add/remove hustle_edit_module capability.
	 *
	 * @since 4.0
	 * @param array $roles Roles
	 */
	public static function update_hustle_edit_module_capability( $roles = null ) {
		global $wpdb;
		$cap = 'hustle_edit_module';
		$table = Hustle_Db::modules_meta_table();

		if ( is_null( $roles ) ) {
			$roles = array_keys( self::get_user_roles() );
		}
		foreach ( $roles as $role_key ) {
			if ( 'administrator' === $role_key ) {
				continue;
			}
			$result = $wpdb->get_var( $wpdb->prepare( "SELECT module_id FROM `{$table}` WHERE `meta_key`='edit_roles' AND meta_value LIKE %s LIMIT 1", '%"' . $role_key . '"%' ) ); // WPCS: unprepared SQL OK. False positive.

			// get the role object
			$role = get_role( $role_key );
			if ( $result || $role->has_cap( 'hustle_create' ) ) {
				// add capability
				$role->add_cap( $cap );
			} else {
				// remove capability
				$role->remove_cap( $cap );
			}
		}

	}

	/**
	 * Get the user roles options.
	 *
	 * @since 4.0
	 *
	 * @return array
	 */
	public static function get_user_roles() {

		global $wp_roles;
		$roles = $wp_roles->get_names();

		return apply_filters( 'hustle_get_module_permissions_roles', $roles );
	}

	// ====================================
	// INTEGRATIONS
	// ====================================

	/**
	 * Used for sanitizing form submissions.
	 * This method will do a simple sanitation of $post_data. It applies sanitize_text_field() to the keys and values of the first level array.
	 * The keys from second level arrays are converted to numbers, and their values are sanitized with sanitize_text_field() as well.
	 * This method doesn’t do an exhaustive sanitation, so you should handled special cases if your integration requires something different.
	 * The names passed on $required_fields are searched into $post_data array keys. If the key is not set, an array with the key “errors” is returned.
	 *
	 * @since 3.0.5
	 * @param array $post_data The data to be sanitized and validated.
	 * @param array $required_fields Fields that must exist on $post_data so the validation doesn't fail.
	 * @return array
	 */
	public static function validate_and_sanitize_fields( $post_data, $required_fields = array() ) {
		//for serialized data or form
		if ( ! is_array( $post_data ) && is_string( $post_data ) ) {
			$post_string = $post_data;
			$post_data   = array();
			wp_parse_str( $post_string, $post_data );
		}

		$errors = array();
		foreach ( $required_fields as $key => $required_field ) {
			if ( ! isset( $post_data[ $required_field ] ) || ( empty( trim( $post_data[ $required_field ] ) ) && '0' !== $post_data[ $required_field ] ) ) {
				/* translators: ... */
				$errors[ $required_field ] = sprintf( __( 'Field %s is required.', Opt_In::TEXT_DOMAIN ), $required_field );
				continue;
			}
		}

		if ( ! empty( $errors ) ) {
			return array( 'errors' => $errors );
		}

		$sanitized_data = array();
		foreach ( $post_data as $key => $post_datum ) {
			/**
			 * Sanitize here every request so we dont need to sanitize it again on other methods,
			 *  unless special treatment is required.
			 */
			$sanitized_data[ sanitize_text_field( $key ) ] = self::sanitize_text_input_deep( $post_datum );
		}

		return $sanitized_data;
	}

	/**
	 * Sanitizes the values of a multi-dimensional array.
	 * The keys of the sub-arrays are converted to numerical arrays.
	 * Sub-arrays are expected to have numerical indexes.
	 *
	 * @since 3.0.5
	 * @param array|string $value
	 * @return string
	 */
	public static function sanitize_text_input_deep( $value, $key = null ) {
		$value = is_array( $value ) ?
					array_map( array( 'Opt_In_Utils', 'sanitize_text_input_deep' ), $value, array_keys( $value ) ) :
					sanitize_text_field( $value );

		return $value;
	}

	/**
	 * Adds an entry to debug log
	 *
	 * By default it will check `WP_DEBUG` and HUSTLE_DEBUG to decide whether to add the log,
	 * then will check `filters`.
	 *
	 * @since 3.0.5
	 * @since 4.0 also checks HUSTLE_DEBUG
	 */
	public static function maybe_log() {

		$wp_debug_enabled = ( defined( 'WP_DEBUG' ) && WP_DEBUG );

		$enabled = ( defined( 'HUSTLE_DEBUG' ) && HUSTLE_DEBUG );

		$enabled = ( $wp_debug_enabled && $enabled );

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


	// ====================================
	// MARKUPS
	// ====================================

	/**
	 * Image function
	 *
	 * Return image element with 2x and 1x support.
	 *
	 * @since 4.0.0
	 */
	public static function hustle_image( $image_path, $image_suffix, $image_class, $support ) {
		$image = '';
		/**
		 * Whitelabeling based on Dash Plugin Settings
		 */
		$hide_branding = apply_filters( 'wpmudev_branding_hide_branding', false );
		if ( $hide_branding ) {
			return $image;
		}
		$image_name   = esc_html__( 'Hustle image', Opt_In::TEXT_DOMAIN );
		if ( ( true === $support ) || ( '2x' === $support ) ) {
			if ( '' !== $image_class ) {
				$image = '<img src="' . $image_path . '.' . $image_suffix . '" srcset="' . $image_path . '.' . $image_suffix . ' 1x, ' . $image_path . '@2x' . '.' . $image_suffix . ' 2x" alt="' . $image_name . '" class="' . $image_class . '" aria-hidden="true">';
			} else {
				$image = '<img src="' . $image_path . '.' . $image_suffix . '" srcset="' . $image_path . '.' . $image_suffix . ' 1x, ' . $image_path . '@2x' . '.' . $image_suffix . ' 2x" alt="' . $image_name . '" aria-hidden="true">';
			}
		} else {
			if ( '' !== $image_class ) {
				$image = '<img src="' . $image_path . '.' . $image_suffix . '" alt="' . $image_name . '" class="' . $image_class . '" aria-hidden="true">';
			} else {
				$image = '<img src="' . $image_path . '.' . $image_suffix . '" alt="' . $image_name . '" aria-hidden="true">';
			}
		}
		echo $image; // phpcs:ignore
	}

	/**
	 * Color Picker
	 *
	 * Return the correct color picker markup that's compatible with Shared UI 2.0
	 *
	 * @since 4.0.0
	 *
	 * @param string $id "id" attribute of the input.
	 * @param string $value "name" attribute of the input.
	 * @param string $alpha "false"/"true". Enables or disables the alpha selector in the colorpicker.
	 */
	public static function sui_colorpicker( $id, $value, $alpha = 'false' ) {

		echo '<div class="sui-colorpicker-wrap">

			<div class="sui-colorpicker" aria-hidden="true">
				<div class="sui-colorpicker-value">
					<span role="button">
						<span style="background-color: {{ ' . esc_attr( $value ) . ' }}"></span>
					</span>
					<input type="text"
						value="{{ ' . esc_attr( $value ) . ' }}"
						readonly="readonly" />
					<button><i class="sui-icon-close" aria-hidden="true"></i></button>
				</div>
				<button class="sui-button">' . esc_html__( 'Select', Opt_In::TEXT_DOMAIN ) . '</button>
			</div>

			<input type="text"
				value="{{ ' . esc_attr( $value ) . ' }}"
				id="' . esc_attr( $id ) . '"
				class="sui-colorpicker-input"
				data-alpha="' . esc_attr( $alpha ) . '"
				data-attribute="' . esc_attr( $value ) . '" />

		</div>';

	}

	/**
	 * Return the image markup for retina and no retina images
	 *
	 * @since 4.0
	 *
	 * @param string $image_path
	 * @param string $class
	 * @param string $retina_image_path
	 * @return string
	 */
	public static function render_image_markup( $image_path, $retina_image_path = '', $class = '', $max_width = '', $max_height = '', $branding = true ) {
		$image = '';
		/**
		 * Whitelabeling based on Dash Plugin Settings
		 */
		$hide_branding = false;
		if ( $branding ) {
			$hide_branding = apply_filters( 'wpmudev_branding_hide_branding', $hide_branding );
		}
		if ( $hide_branding ) {
			return $image;
		}
		$image_name = esc_html__( 'Hustle image', Opt_In::TEXT_DOMAIN );
		$image_path = esc_url( $image_path );
		$retina_image_path = esc_url( $retina_image_path );
		$styles = '';
		if ( '' !== $max_width || '' !== $max_height ) {
			$styles .= ' style="';
			if ( '' !== $max_width ) {
				$styles .= 'max-width: ' . $max_width . ';';
				if ( '' !== $max_height ) {
					$styles .= ' ';
				}
			}
			if ( '' !== $max_height ) {
				$styles .= 'max-height: ' . $max_height . ';';
			}
			$styles .= '"';
		}
		$image .= '<img';
		$image .= ' src="' . $image_path . '"';
		if ( ! empty( $retina_image_path ) || '' !== $retina_image_path ) {
			$image .= ' srcset="' . esc_url( $image_path ) . ' 1x, ' . esc_url( $retina_image_path ) . ' 2x"';
		}
		$image .= ' alt="' . $image_name . '"';
		if ( ! empty( $class ) || '' !== $class ) {
			$image .= ' class="' . esc_attr( $class ) . '"';
		}
		$image .= $styles;
		$image .= ' aria-hidden="true"';
		$image .= '/>';
		return $image;
	}


	// ====================================
	// MISC?
	// ====================================

	/**
	 * Returns list of optin providers based on their declared classes that implement Opt_In_Provider_Interface
	 *
	 * @return array
	 */
	public static function get_post_types() {
		if ( empty( self::$post_types ) ) {
			/**
			 * Add all custom post types
			 */
			$post_types = array();
			$cpts = get_post_types( array(
				'public'   => true,
				'_builtin' => false,
			), 'objects' );
			foreach ( $cpts as $cpt ) {

				// skip ms_invoice
				if ( 'ms_invoice' === $cpt->name ) {
					continue;
				}

				$cpt_array['name'] = $cpt->name;
				$cpt_array['label'] = $cpt->label;
				$cpt_array['data'] = self::get_select2_data( $cpt->name );

				// all posts under this custom post type
				$all_cpt_posts = new stdClass();
				$all_cpt_posts->id = 'all';
				$all_cpt_posts->text = __( 'ALL ', Opt_In::TEXT_DOMAIN ) . $cpt->label;
				array_unshift( $cpt_array['data'], $all_cpt_posts );

				$post_types[ $cpt->name ] = $cpt_array;
			}
			self::$post_types = $post_types;
		}
		return self::$post_types;
	}


	/**
	 * Get usable object for select2
	 *
	 * @param $post_type post type
	 * @return stdClass
	 */
	public static function get_select2_data( $post_type ) {
		global $wpdb;
		$data = $wpdb->get_results( $wpdb->prepare( "SELECT ID as id, post_title as text FROM {$wpdb->posts} "
		. "WHERE post_type = %s and post_status = 'publish'", $post_type ) );

		return $data;
	}


	/**
	 * Return time periods (AM,PM)
	 *
	 * @since 4.0
	 * @return array
	*/
	public static function get_time_periods() {
		$periods = array(
			'am' => __( 'AM', Opt_In::TEXT_DOMAIN ),
			'pm' => __( 'PM', Opt_In::TEXT_DOMAIN ),
			);

		return $periods;
	}


	/**
	 * Return date formats
	 *
	 * @since 4.0
	 * @return array
	*/
	public static function get_date_formats() {
		$formats = array(
			'Y/m/d' => __( 'Y/m/d', Opt_In::TEXT_DOMAIN ),
			'm/d/Y' => __( 'm/d/Y', Opt_In::TEXT_DOMAIN ),
			'd/m/Y' => __( 'd/m/Y', Opt_In::TEXT_DOMAIN ),
			);

		$formats = apply_filters( 'hustle_date_formats', $formats );

		return $formats;
	}

	/**
	 * Convert some unit of time to microseconds.
	 *
	 * @since 4.0
	 *
	 * @param int $value
	 * @param string $unit
	 * @return int
	 */
	public static function to_microseconds( $value, $unit ) {

		if ( 'seconds' === $unit ) {
			return intval( $value, 10 ) * 1000;

		} else if ( 'minutes' === $unit ) {
			return intval( $value, 10 ) * 60 * 1000;

		} else {
			return intval( $value, 10 ) * 60 * 60 * 1000;
		}
	}

	/**
	 * Get social patform names
	 *
	 * @return array
	 */
	public static function get_social_platform_names() {
		$social_platform_names = array(
			'facebook' => esc_html__( 'Facebook', Opt_In::TEXT_DOMAIN ),
			'twitter' => esc_html__( 'Twitter', Opt_In::TEXT_DOMAIN ),
			'pinterest' => esc_html__( 'Pinterest', Opt_In::TEXT_DOMAIN ),
			'reddit' => esc_html__( 'Reddit', Opt_In::TEXT_DOMAIN ),
			'linkedin' => esc_html__( 'LinkedIn', Opt_In::TEXT_DOMAIN ),
			'vkontakte' => esc_html__( 'Vkontakte', Opt_In::TEXT_DOMAIN ),
			'fivehundredpx' => esc_html__( '500px', Opt_In::TEXT_DOMAIN ),
			'houzz' => esc_html__( 'Houzz', Opt_In::TEXT_DOMAIN ),
			'instagram' => esc_html__( 'Instagram', Opt_In::TEXT_DOMAIN ),
			'twitch' => esc_html__( 'Twitch', Opt_In::TEXT_DOMAIN ),
			'youtube' => esc_html__( 'YouTube', Opt_In::TEXT_DOMAIN ),
			'telegram' => esc_html__( 'Telegram', Opt_In::TEXT_DOMAIN ),
			'whatsapp' => esc_html__( 'WhatsApp', Opt_In::TEXT_DOMAIN ),
		);

		return $social_platform_names;
	}

	/**
	 * Return reCAPTCHA languages
	 *
	 * @since 4.0
	 * @return array
	*/
	public static function get_captcha_languages() {
		return apply_filters(
			'hustle_captcha_languages',
			array(
				'ar' => esc_html__( 'Arabic', Opt_In::TEXT_DOMAIN ),
				'af' => esc_html__( 'Afrikaans', Opt_In::TEXT_DOMAIN ),
				'am' => esc_html__( 'Amharic', Opt_In::TEXT_DOMAIN ),
				'hy' => esc_html__( 'Armenian', Opt_In::TEXT_DOMAIN ),
				'az' => esc_html__( 'Azerbaijani', Opt_In::TEXT_DOMAIN ),
				'eu' => esc_html__( 'Basque', Opt_In::TEXT_DOMAIN ),
				'bn' => esc_html__( 'Bengali', Opt_In::TEXT_DOMAIN ),
				'bg' => esc_html__( 'Bulgarian', Opt_In::TEXT_DOMAIN ),
				'ca' => esc_html__( 'Catalan', Opt_In::TEXT_DOMAIN ),
				'zh-HK' => esc_html__( 'Chinese (Hong Kong)', Opt_In::TEXT_DOMAIN ),
				'zh-CN' => esc_html__( 'Chinese (Simplified)', Opt_In::TEXT_DOMAIN ),
				'zh-TW' => esc_html__( 'Chinese (Traditional)', Opt_In::TEXT_DOMAIN ),
				'hr' => esc_html__( 'Croatian', Opt_In::TEXT_DOMAIN ),
				'cs' => esc_html__( 'Czech', Opt_In::TEXT_DOMAIN ),
				'da' => esc_html__( 'Danish', Opt_In::TEXT_DOMAIN ),
				'nl' => esc_html__( 'Dutch', Opt_In::TEXT_DOMAIN ),
				'en-GB' => esc_html__( 'English (UK)', Opt_In::TEXT_DOMAIN ),
				'en' => esc_html__( 'English (US)', Opt_In::TEXT_DOMAIN ),
				'et' => esc_html__( 'Estonian', Opt_In::TEXT_DOMAIN ),
				'fil' => esc_html__( 'Filipino', Opt_In::TEXT_DOMAIN ),
				'fi' => esc_html__( 'Finnish', Opt_In::TEXT_DOMAIN ),
				'fr' => esc_html__( 'French', Opt_In::TEXT_DOMAIN ),
				'fr-CA' => esc_html__( 'French (Canadian)', Opt_In::TEXT_DOMAIN ),
				'gl' => esc_html__( 'Galician', Opt_In::TEXT_DOMAIN ),
				'ka' => esc_html__( 'Georgian', Opt_In::TEXT_DOMAIN ),
				'de' => esc_html__( 'German', Opt_In::TEXT_DOMAIN ),
				'de-AT' => esc_html__( 'German (Austria)', Opt_In::TEXT_DOMAIN ),
				'de-CH' => esc_html__( 'German (Switzerland)', Opt_In::TEXT_DOMAIN ),
				'el' => esc_html__( 'Greek', Opt_In::TEXT_DOMAIN ),
				'gu' => esc_html__( 'Gujarati', Opt_In::TEXT_DOMAIN ),
				'iw' => esc_html__( 'Hebrew', Opt_In::TEXT_DOMAIN ),
				'hi' => esc_html__( 'Hindi', Opt_In::TEXT_DOMAIN ),
				'hu' => esc_html__( 'Hungarain', Opt_In::TEXT_DOMAIN ),
				'is' => esc_html__( 'Icelandic', Opt_In::TEXT_DOMAIN ),
				'id' => esc_html__( 'Indonesian', Opt_In::TEXT_DOMAIN ),
				'it' => esc_html__( 'Italian', Opt_In::TEXT_DOMAIN ),
				'ja' => esc_html__( 'Japanese', Opt_In::TEXT_DOMAIN ),
				'kn' => esc_html__( 'Kannada', Opt_In::TEXT_DOMAIN ),
				'ko' => esc_html__( 'Korean', Opt_In::TEXT_DOMAIN ),
				'lo' => esc_html__( 'Laothian', Opt_In::TEXT_DOMAIN ),
				'lv' => esc_html__( 'Latvian', Opt_In::TEXT_DOMAIN ),
				'lt' => esc_html__( 'Lithuanian', Opt_In::TEXT_DOMAIN ),
				'ms' => esc_html__( 'Malay', Opt_In::TEXT_DOMAIN ),
				'ml' => esc_html__( 'Malayalam', Opt_In::TEXT_DOMAIN ),
				'mr' => esc_html__( 'Marathi', Opt_In::TEXT_DOMAIN ),
				'mn' => esc_html__( 'Mongolian', Opt_In::TEXT_DOMAIN ),
				'no' => esc_html__( 'Norwegian', Opt_In::TEXT_DOMAIN ),
				'fa' => esc_html__( 'Persian', Opt_In::TEXT_DOMAIN ),
				'pl' => esc_html__( 'Polish', Opt_In::TEXT_DOMAIN ),
				'pt' => esc_html__( 'Portuguese', Opt_In::TEXT_DOMAIN ),
				'pt-BR' => esc_html__( 'Portuguese (Brazil)', Opt_In::TEXT_DOMAIN ),
				'pt-PT' => esc_html__( 'Portuguese (Portugal)', Opt_In::TEXT_DOMAIN ),
				'ro' => esc_html__( 'Romanian', Opt_In::TEXT_DOMAIN ),
				'ru' => esc_html__( 'Russian', Opt_In::TEXT_DOMAIN ),
				'sr' => esc_html__( 'Serbian', Opt_In::TEXT_DOMAIN ),
				'si' => esc_html__( 'Sinhalese', Opt_In::TEXT_DOMAIN ),
				'sk' => esc_html__( 'Slovak', Opt_In::TEXT_DOMAIN ),
				'sl' => esc_html__( 'Slovenian', Opt_In::TEXT_DOMAIN ),
				'es' => esc_html__( 'Spanish', Opt_In::TEXT_DOMAIN ),
				'es-419' => esc_html__( 'Spanish (Latin America)', Opt_In::TEXT_DOMAIN ),
				'sw' => esc_html__( 'Swahili', Opt_In::TEXT_DOMAIN ),
				'sv' => esc_html__( 'Swedish', Opt_In::TEXT_DOMAIN ),
				'ta' => esc_html__( 'Tamil', Opt_In::TEXT_DOMAIN ),
				'te' => esc_html__( 'Telugu', Opt_In::TEXT_DOMAIN ),
				'th' => esc_html__( 'Thai', Opt_In::TEXT_DOMAIN ),
				'tr' => esc_html__( 'Turkish', Opt_In::TEXT_DOMAIN ),
				'uk' => esc_html__( 'Ukrainian', Opt_In::TEXT_DOMAIN ),
				'ur' => esc_html__( 'Urdu', Opt_In::TEXT_DOMAIN ),
				'vi' => esc_html__( 'Vietnamese', Opt_In::TEXT_DOMAIN ),
				'zu' => esc_html__( 'Zulu', Opt_In::TEXT_DOMAIN ),
			)
		);
	}

	// ====================================
	// MODULES HELPERS
	// ====================================


	/**
	 * Get Time of latest tracked conversion based on $module_id
	 *
	 * @since 4.0
	 *
	 * @param $module_id
	 * @param string $subtype
	 * @return string
	 */
	public static function get_latest_conversion_time_by_module_id( $module_id, $subtype = '' ) {
		$tracking_model = Hustle_Tracking_Model::get_instance();
		$latest_entry = $tracking_model->get_latest_conversion_date_by_module_id( $module_id, $subtype );
		if ( $latest_entry ) {
			$entry_date = date_i18n( 'j M Y @ H:i A', strtotime( $latest_entry ) );
			return $entry_date;
		} else {
			return esc_html__( 'Never', Opt_In::TEXT_DOMAIN );
		}
	}

	/**
	 * Get the time of the latest tracked conversion based on $entry_type
	 * [popup,slide-in,embedded]
	 *
	 * @since 4.0
	 *
	 * @param $entry_type
	 * @return string
	 */
	public static function get_latest_conversion_time( $entry_type ) {
		$tracking_model = Hustle_Tracking_Model::get_instance();
		$date = $tracking_model->get_latest_conversion_date( $entry_type );

		if ( $date ) {
			$last_entry_time = mysql2date( 'U', $date );
			$time_diff       = human_time_diff( current_time( 'timestamp' ), $last_entry_time );
			$last_entry_time = sprintf( __( '%s ago', Opt_In::TEXT_DOMAIN ), $time_diff );

			return $last_entry_time;
		} else {
			return __( 'Never', Opt_In::TEXT_DOMAIN );
		}
	}

	/**
	 * Get Time of latest entry created based on $module_id
	 *
	 * @since 4.0
	 *
	 * @param $module_id
	 * @return string
	 */
	public static function get_latest_entry_time_by_module_id( $module_id ) {
		$latest_entry = Hustle_Entry_Model::get_latest_entry_by_module_id( $module_id );
		if ( $latest_entry instanceof Hustle_Entry_Model ) {
			return $latest_entry->time_created;
		} else {
			return esc_html__( 'Never', Opt_In::TEXT_DOMAIN );
		}
	}

	/**
	 * Get Time of latest entry created based on $entry_type
	 * [popup,slide-in,embedded]
	 *
	 * @since 4.0
	 *
	 * @param $entry_type
	 * @return string
	 */
	public static function get_latest_entry_time( $entry_type ) {
		$latest_entry = Hustle_Entry_Model::get_latest_entry( $entry_type );
		if ( $latest_entry instanceof Hustle_Entry_Model ) {
			$last_entry_time = mysql2date( 'U', $latest_entry->date_created_sql );
			$time_diff       = human_time_diff( current_time( 'timestamp' ), $last_entry_time );
			$last_entry_time = sprintf( __( '%s ago', Opt_In::TEXT_DOMAIN ), $time_diff );

			return $last_entry_time;
		} else {
			return __( 'Never', Opt_In::TEXT_DOMAIN );
		}
	}

	/**
	 * Get current post id
	 *
	 * @since 4.0
	 *
	 * @return int|string
	 */
	public static function get_post_id() {
		return get_post() ? get_the_ID() : '0';
	}

	/**
	 * get formated date
	 *
	 * @since 4.0.0
	 *
	 * return string $date Current date, formated bu i18n.
	 */
	public static function get_current_date() {
		$date = date_i18n( 'Y-m-d H:i:s' );
		return $date;
	}

	/**
	 * Replace a key in an array without changing its order.
	 *
	 * @since 4.0
	 *
	 * @param string $old_key
	 * @param string $new_key
	 * @param array $array
	 * @return array
	 */
	public static function replace_array_key( $old_key, $new_key, $array ) {

		// Replace the name without changing the array's order.
		$keys_array = array_keys( $array );
		$index = array_search( $old_key, $keys_array, true );

		if ( false === $index ) {
			return $array;
		}

		$keys_array[ $index ] = $new_key;

		$new_array = array_combine( $keys_array, array_values( $array ) );

		return $new_array;
	}

	/**
	 * Get the display name of a module type.
	 * 
	 * @since 4.0
	 *
	 * @param string $module_type
	 * @param boolean $plural
	 * @param boolean $capitalized
	 * @return string
	 */
	public static function get_module_type_display_name( $module_type, $plural = false, $capitalized = false ) {

		$display_name = '';

		if ( Hustle_Module_Model::POPUP_MODULE === $module_type ) {
			if ( ! $plural ) {
				$display_name = __( 'pop-up', Opt_In::TEXT_DOMAIN );
			} else {
				$display_name = __( 'pop-ups', Opt_In::TEXT_DOMAIN );
			}

		} elseif ( Hustle_Module_Model::SLIDEIN_MODULE === $module_type ) {
			if ( ! $plural ) {
				$display_name = __( 'slide-in', Opt_In::TEXT_DOMAIN );
			} else {
				$display_name = __( 'slide-ins', Opt_In::TEXT_DOMAIN );
			}

		} elseif ( Hustle_Module_Model::EMBEDDED_MODULE === $module_type ) {
			if ( ! $plural ) {
				$display_name = __( 'embed', Opt_In::TEXT_DOMAIN );
			} else {
				$display_name = __( 'embeds', Opt_In::TEXT_DOMAIN );
			}

		} elseif ( Hustle_Module_Model::SOCIAL_SHARING_MODULE === $module_type ) {
			if ( ! $plural ) {
				$display_name = __( 'social sharing', Opt_In::TEXT_DOMAIN );
			} else {
				$display_name = __( 'social shares', Opt_In::TEXT_DOMAIN );
			}

		}

		if ( $capitalized ) {
			$display_name = ucfirst( $display_name );
		}

		return $display_name;
	}
}
