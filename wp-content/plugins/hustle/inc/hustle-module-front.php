<?php
class Hustle_Module_Front {

	private $_hustle;

	private $_modules = array();
	private $_non_inline_modules = array();
	private $_inline_modules = array();

	private $_styles;

	const AFTERCONTENT_CSS_CLASS = 'hustle_module_after_content_wrap';
	const WIDGET_CSS_CLASS = 'hustle_module_widget_wrap';
	const SHORTCODE_CSS_CLASS = 'hustle_module_shortcode_wrap';
	const SHORTCODE_TRIGGER_CSS_CLASS = 'hustle_module_shortcode_trigger';
	const SSHARE_WIDGET_CSS_CLASS = 'hustle_sshare_module_widget_wrap';
	const SSHARE_SHORTCODE_CSS_CLASS = 'hustle_sshare_module_shortcode_wrap';

	const SHORTCODE = 'wd_hustle';

	public function __construct( Opt_In $hustle ) {

		$this->_hustle = $hustle;

		add_action( 'widgets_init', array( $this, 'register_widget' ) );
		add_shortcode( self::SHORTCODE, array( $this, 'shortcode' ) );

		// Legacy custom content support
		add_shortcode(
			'wd_hustle_cc',
			array( $this, 'shortcode' )
		);

		// Legacy social sharing support
		add_shortcode(
			'wd_hustle_ss',
			array( $this, 'shortcode' )
		);

		// Unsubscribe shortcode
		add_shortcode(
			'wd_hustle_unsubscribe',
			array( $this, 'unsubscribe_shortcode' )
		);

		if ( is_admin() ) {
			return;
		}

		add_action(
			'wp_enqueue_scripts',
			array( $this, 'register_scripts' )
		);

		// Enqueue it in the footer to overrider all the css that comes with the popup
		add_action(
			'wp_footer',
			array( $this, 'register_styles' )
		);

		add_action(
			'template_redirect',
			array( $this, 'create_modules' ),
			0
		);

		add_action(
			'wp_footer',
			array( $this, 'render_non_inline_modules' )
		);

		add_filter(
			'the_content',
			array( $this, 'show_after_page_post_content' ),
			20
		);

		// NextGEN Gallery compat
		add_filter(
			'run_ngg_resource_manager',
			array( $this, 'nextgen_compat' )
		);
	}

	public function register_widget() {
		register_widget( 'Hustle_Module_Widget' );
		register_widget( 'Hustle_Module_Widget_Legacy' );
	}

	public function register_scripts() {
		$is_on_upfront_builder = class_exists( 'UpfrontThemeExporter' ) && function_exists( 'upfront_exporter_is_running' ) && upfront_exporter_is_running();
		if ( ! $is_on_upfront_builder ) {
			if ( is_customize_preview() || ! $this->has_modules() || isset( $_REQUEST['fl_builder'] ) ) { // CSRF: ok.
				/**
				 * Check for shortcode wd_hustle_unsubscribe
				 */
				$is_singular = is_singular();
				if ( ! $is_singular ) {
					return;
				}
				global $post;
				if ( ! preg_match( '/wd_hustle_unsubscribe/', $post->post_content ) ) {
					return;
				}
			}
		}

		/**
		 * Register popup requirements
		 */

		//Register popup requirements
		wp_register_script(
			'hustle_front',
			$this->_hustle->get_static_var( 'plugin_url' ) . 'assets/js/front.min.js',
			array( 'jquery', 'underscore' ),
			'1.1',
			$this->_hustle->get_const_var( 'VERSION' ),
			false
		);

		wp_register_script(
			'hustle_front_fitie',
			$this->_hustle->get_static_var( 'plugin_url' ) . 'assets/js/vendor/fitie/fitie.js',
			array(),
			$this->_hustle->get_const_var( 'VERSION' ),
			false
		);
		$modules = apply_filters( 'hustle_front_modules', $this->_modules );
		wp_localize_script( 'hustle_front', 'Modules', $modules );

		$vars = apply_filters('hustle_front_vars', array(
			'is_admin' => is_admin(),
			'native_share_enpoints' => Hustle_Sshare_Model::get_sharing_endpoints( false ),
			'ajaxurl' => admin_url( 'admin-ajax.php', is_ssl() ? 'https' : 'http' ),
			'page_id' => get_queried_object_id(), // Used in many places to decide whether to show the module and cookies.
			'is_upfront' => class_exists( 'Upfront' ) && isset( $_GET['editmode'] ) && 'true' === $_GET['editmode'], // Used.
		) );
		wp_localize_script( 'hustle_front', 'inc_opt', $vars );

		self::maybe_add_recaptcha_script();

		do_action( 'hustle_register_scripts' );

		self::add_hui_scripts();
		wp_enqueue_script( 'hustle_front' );
		wp_enqueue_script( 'hustle_front_fitie' );

		add_filter(
			'script_loader_tag',
			array( 'Hustle_Module_Front', 'handle_specific_script' ),
			10,
			2
		);

		add_filter(
			'style_loader_tag',
			array( 'Hustle_Module_Front', 'handle_specific_style' ),
			10,
			2
		);
	}

	/**
	 * Add Hustle UI scripts.
	 * Used for displaying and previewing modules.
	 *
	 * @since 4.0
	 */
	public static function add_hui_scripts() {

		// Load jQuery UI on front
		wp_enqueue_script(
			'jquery-ui',
			'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js',
			array( 'jquery' ),
			'1.12.1',
			false
		);

		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-datepicker' );

		// Register Hustle UI functions
		wp_register_script(
			'hui_scripts',
			Opt_In::$plugin_url . 'assets/hustle-ui/js/hustle-ui.min.js',
			array( 'jquery' ),
			Opt_In::VERSION,
			true
		);

		wp_enqueue_script( 'hui_scripts' );
	}

	/**
	 * Enqueue the recaptcha script if recaptcha is globally configured.
	 * @since 4.0
	 */
	public static function maybe_add_recaptcha_script() {

		$recaptcha_settings = Hustle_Settings_Admin::get_recaptcha_settings();
		if ( ! empty( $recaptcha_settings['sitekey'] ) ) {
			$language = ! empty( $recaptcha_settings['language'] ) && 'automatic' !== $recaptcha_settings['language']
					? '&hl=' . $recaptcha_settings['language'] : '&hl=' . determine_locale();
			wp_enqueue_script(
				'recaptcha',
				'https://www.google.com/recaptcha/api.js?render=explicit' . $language
			);
		}
	}

	/**
	 * Handling specific scripts for each scenario
	 *
	 */
	public static function handle_specific_script( $tag, $handle ) {
		if ( 'hustle_front_fitie' === $handle ) {
			if ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) {
				$user_agent = $_SERVER['HTTP_USER_AGENT'];
			} else {
				return $tag;
			}
			
			$is_ie = (
				// IE 10 or older
				false !== stripos( $user_agent, 'MSIE' ) ||
				// IE 11
				false !== stripos( $user_agent, 'Trident' ) ||
				// Edge (IE 12+)
				false !== stripos( $user_agent, 'Edge' )
			);
			if ( ! $is_ie ) {
				$tag = '';
			}
		}
		return $tag;
	}

	/**
	 * Handling specific style for each scenario
	 *
	 */
	public static function handle_specific_style( $tag, $handle ) {
		if ( 'hustle_front_ie' === $handle ) {
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
			$is_ie = (
				// IE 10 or older
				false !== stripos( $user_agent, 'MSIE' ) ||
				// IE 11
				false !== stripos( $user_agent, 'Trident' ) ||
				// Edge (IE 12+)
				false !== stripos( $user_agent, 'Edge' )
			);
			if ( ! $is_ie ) {
				$tag = '';
			}
		}
		return $tag;
	}

	public function register_styles() {
		$is_on_upfront_builder = class_exists( 'UpfrontThemeExporter' ) && function_exists( 'upfront_exporter_is_running' ) && upfront_exporter_is_running();

		if ( ! $is_on_upfront_builder ) {
			if ( ! $this->has_modules() || isset( $_REQUEST['fl_builder'] ) ) { // CSRF ok.
				return;
			}
		}

		self::print_front_styles( $this->_hustle );
		self::print_front_fonts( $this->_hustle );
	}

	public static function print_front_styles( Opt_In $hustle ) {

		wp_register_style(
			'hustle_icons',
			$hustle->get_static_var( 'plugin_url' )  . 'assets/hustle-ui/css/hustle-icons.min.css',
			array(),
			$hustle->get_const_var( 'VERSION' )
		);

		wp_register_style(
			'hustle_popup',
			$hustle->get_static_var( 'plugin_url' )  . 'assets/hustle-ui/css/hustle-popup.min.css',
			array(),
			$hustle->get_const_var( 'VERSION' )
		);

		wp_register_style(
			'hustle_slidein',
			$hustle->get_static_var( 'plugin_url' )  . 'assets/hustle-ui/css/hustle-slidein.min.css',
			array(),
			$hustle->get_const_var( 'VERSION' )
		);

		wp_register_style(
			'hustle_inline',
			$hustle->get_static_var( 'plugin_url' )  . 'assets/hustle-ui/css/hustle-inline.min.css',
			array(),
			$hustle->get_const_var( 'VERSION' )
		);

		wp_register_style(
			'hustle_float',
			$hustle->get_static_var( 'plugin_url' )  . 'assets/hustle-ui/css/hustle-float.min.css',
			array(),
			$hustle->get_const_var( 'VERSION' )
		);

		wp_register_style(
			'hustle_optin',
			$hustle->get_static_var( 'plugin_url' )  . 'assets/hustle-ui/css/hustle-optin.min.css',
			array(),
			$hustle->get_const_var( 'VERSION' )
		);

		wp_register_style(
			'hustle_info',
			$hustle->get_static_var( 'plugin_url' )  . 'assets/hustle-ui/css/hustle-info.min.css',
			array(),
			$hustle->get_const_var( 'VERSION' )
		);

		wp_register_style(
			'hustle_social',
			$hustle->get_static_var( 'plugin_url' )  . 'assets/hustle-ui/css/hustle-social.min.css',
			array(),
			$hustle->get_const_var( 'VERSION' )
		);

		wp_enqueue_style( 'hustle_icons' );
		wp_enqueue_style( 'hustle_popup' );
		wp_enqueue_style( 'hustle_slidein' );
		wp_enqueue_style( 'hustle_inline' );
		wp_enqueue_style( 'hustle_float' );
		wp_enqueue_style( 'hustle_optin' );
		wp_enqueue_style( 'hustle_info' );
		wp_enqueue_style( 'hustle_social' );

	}

	public static function print_front_fonts( $hustle ) {

		$load_google_fonts = apply_filters( 'hustle_load_google_fonts', true );
		if ( ! $load_google_fonts ) {
			return;
		}
		wp_register_style(
			'hstl-roboto',
			'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i',
			array(),
			$hustle->get_const_var( 'VERSION' )
		);
		wp_register_style(
			'hstl-opensans',
			'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i',
			array(),
			$hustle->get_const_var( 'VERSION' )
		);
		wp_register_style(
			'hstl-source-code-pro',
			'https://fonts.googleapis.com/css?family=Source+Code+Pro',
			array(),
			$hustle->get_const_var( 'VERSION' )
		);

		wp_enqueue_style( 'hstl-roboto' );
		wp_enqueue_style( 'hstl-opensans' );
		wp_enqueue_style( 'hstl-source-code-pro' );

	}

	/**
	 * Enqueue modules to be displayed on Frontend.
	 */
	public function create_modules() {

		// Retrieve all active modules.
		$modules = apply_filters( 'hustle_sort_modules', Hustle_Module_Collection::instance()->get_all( true ) );
		$enqueue_adblock = false;

		foreach ( $modules as $module ) {

			if ( ! $module instanceof Hustle_Module_Model ) {
				continue;
			}
			
			$is_non_inline_module = ( Hustle_Module_Model::POPUP_MODULE === $module->module_type || Hustle_Module_Model::SLIDEIN_MODULE === $module->module_type );
			
			if ( ! $module->is_allowed_to_display( $module->module_type ) ) {
				
				// If shortcode is enabled for inline modules, don't abort.
				// Shortcodes shouldn't follow the visibility conditions.
				if ( ! $is_non_inline_module ) {
					$display_options = $module->get_display()->to_array();
					if ( '1' !== $display_options['shortcode_enabled'] ) {
						continue;
					}

				} else {
					continue;
				}
			}

			if ( $is_non_inline_module ) {
				$this->_non_inline_modules[] = $module;

				if ( ! $enqueue_adblock ) {

					$settings = $module->get_settings()->to_array();
					if (
						// If Trigger exists.
						! empty( $settings['triggers']['trigger'] )
						// If trigger is adblock.
						&& 'adblock' === $settings['triggers']['trigger']
						// If on_adblock toggle is enabled.
						&& ! empty( $settings['triggers']['on_adblock'] )
					) {
						$enqueue_adblock = true;
					}
				}
			
			} elseif ( Hustle_Module_Model::EMBEDDED_MODULE === $module->module_type ) {
				$this->_inline_modules[] = $module;

			} else { // Social sharing modules.
				$this->_inline_modules[] = $module;
				$this->_non_inline_modules[] = $module;
			}

			$this->_modules[] = $module->get_module_data_to_display();
		}

		// Look for adblocker.
		if ( $enqueue_adblock ) {
			wp_enqueue_script(
				'hustle_front_ads',
				$this->_hustle->get_static_var( 'plugin_url' ) . 'assets/js/ads.js',
				array(),
				$this->_hustle->get_const_var( 'VERSION' ),
				true
			);
		}
	}

	/**
	 * Check if current page has renderable opt-ins.
	 **/
	public function has_modules() {
		$has_modules = ! empty( $this->_non_inline_modules ) || ! empty( $this->_inline_modules );
		return apply_filters( 'hustle_front_handler', $has_modules );
	}

	/**
	 * By-pass NextGEN Gallery resource manager
	 *
	 * @return false
	 */
	public function nextgen_compat() {
		return false;
	}

	public function render_non_inline_modules() {

		foreach ( $this->_non_inline_modules as $module ) {

			if ( Hustle_Module_Model::SOCIAL_SHARING_MODULE !== $module->module_type ) {
				$module->display();

			} elseif ( $module->is_display_type_active( Hustle_SShare_Model::FLOAT_DESKTOP ) || $module->is_display_type_active( Hustle_SShare_Model::FLOAT_MOBILE ) ) {
				$module->display( Hustle_SShare_Model::FLOAT_MODULE );
			}
		}
	}

	/**
	 * Handles the data for the unsubscribe shortcode
	 *
	 * @since 3.0.5
	 * @param array $atts The values passed through the shortcode attributes
	 * @return string The content to be rendered within the shortcode.
	 */
	public function unsubscribe_shortcode( $atts ) {
		$messages = Hustle_Settings_Admin::get_unsubscribe_messages();
		if ( isset( $_GET['token'] ) && isset( $_GET['email'] ) ) { // WPCS: CSRF ok.
			$error_message = $messages['invalid_data'];
			$sanitized_data = Opt_In_Utils::validate_and_sanitize_fields( $_GET ); // WPCS: CSRF ok.
			$email = $sanitized_data['email'];
			$nonce = $sanitized_data['token'];
			// checking if email is valid
			if ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
				return $error_message;
			}
			$entry = new Hustle_Entry_Model();
			$unsubscribed = $entry->unsubscribe_email( $email, $nonce );
			if ( $unsubscribed ) {
				return $messages['successful_unsubscription'];
			} else {
				return $error_message;
			}
		}
		// Show all modules' lists by default.
		$attributes = shortcode_atts( array( 'id' => '-1' ), $atts );
		$params = array(
			'ajax_step' => false,
			'shortcode_attr_id' => $attributes['id'],
			'messages' => $messages,
			);
		$html = $this->_hustle->render( 'general/unsubscribe-form', $params, true );
		apply_filters( 'hustle_render_unsubscribe_form_html', $html, $params );
		return $html;
	}

	/**
	 * Render the modules' wrapper to render the actual module using their shortcodes.
	 *
	 * @since the beginning of time.
	 * @since 3.0.7 Now the shortcode accepts using the module_id using the attribute 'module_id'.
	 * Before, it used the attribute 'id' but it was actually the module's name.
	 *
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	public function shortcode( $atts, $content ) {
		$atts = shortcode_atts( array(
			'id' => '',
			'type' => 'embedded',
			'css_class' => '',
		), $atts, self::SHORTCODE );

		if ( empty( $atts['id'] ) ) {
			return '';
		}

		$type = $atts['type'];

		// If shortcode type is not embed or sshare.
		if ( 'embedded' !== $type && 'social_sharing' !== $type ) {
			// Do not enforce embedded/social_sharing type.
			$enforce_type = false;
		} else {
			// Enforce embedded/social_sharing type.
			$enforce_type = true;
		}

		// Get the module data.
		$module = Hustle_Module_Model::instance()->get_by_shortcode( $atts['id'], $enforce_type );
		if ( is_wp_error( $module ) ) {
			return '';
		}
		if ( ! $module || ! $module->active ) {
			return '';
		}

		$module = Hustle_Module_Collection::instance()->return_model_from_id( $module->module_id );

		if ( ! $module->is_display_type_active( Hustle_Module_Model::SHORTCODE_MODULE ) ) {
			return '';
		}

		$custom_classes = esc_attr( $atts['css_class'] );

		// Maybe display trigger link (For popups and slideins).
		if ( ! empty( $content ) && ( 'popup' === $type || 'slidein' === $type ) ) {

			// If shortcode click trigger is disabled, print nothing.
			$settings = $module->get_settings()->to_array();
			if ( ! isset( $settings['triggers']['enable_on_click_shortcode'] ) || '0' === $settings['triggers']['enable_on_click_shortcode'] ) {
				return '';
			}

			return sprintf(
				'<a href="#" class="%s hustle_module_%s %s" data-id="%s" data-type="%s">%s</a>',
				self::SHORTCODE_TRIGGER_CSS_CLASS,
				esc_attr( $module->id ),
				esc_attr( $custom_classes ),
				esc_attr( $module->id ),
				esc_attr( $type ),
				wp_kses_post( $content )
			);
		}

		$preview = Hustle_Renderer_Abstract::$is_preview;

		// Display the module.
		ob_start();

		$module->display( Hustle_Module_Model::SHORTCODE_MODULE, $custom_classes, $preview );

		if ( $preview ) {
			$view = $module->get_renderer();
			$view->module = $module->load();
			$view->print_styles( $preview );
		}

		return ob_get_clean();
	}

	/**
	 * Display inline modules.
	 * Embedded and Social Sharing modules only.
	 *
	 * @since the beginning of time.
	 *
	 * @param $content
	 * @return string
	 */
	public function show_after_page_post_content( $content ) {

		// Return the content immediately if there are no modules or the page doesn't have a content to embed into.
		if ( ! count( $this->_inline_modules ) || isset( $_REQUEST['fl_builder'] ) || is_home() || is_archive() ) { // CSRF: ok.
			return $content;
		}

		$modules = apply_filters( 'hustle_inline_modules_to_display', $this->_inline_modules );

		foreach ( $modules as $module ) {

			// Skip if "inline" display is disabled.
			if ( ! $module->is_display_type_active( Hustle_Module_Model::INLINE_MODULE ) ) {
				continue;
			}

			$custom_classes = apply_filters( 'hustle_inline_module_custom_classes', '', $module );

			ob_start();
			$module->display( Hustle_Module_Model::INLINE_MODULE, $custom_classes );
			$module_markup = ob_get_clean();

			$display = $module->get_display()->to_array();
			$display_position = $display['inline_position'];

			if ( 'both' === $display_position ) {
				$content = $module_markup . $content . $module_markup;

			} elseif ( 'above' === $display_position ) {
				$content = $module_markup . $content;

			} else { // For "below".
				$content .= $module_markup;

			}
		}

		remove_filter( 'the_content', array( $this, 'show_after_page_post_content' ) );

		return $content;
	}
}
