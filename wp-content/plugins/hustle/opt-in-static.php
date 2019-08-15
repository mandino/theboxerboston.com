<?php
/**
 * A class to serve static data
 *
 * Class Opt_In_Static
 */
if ( ! class_exists( 'Opt_In_Static', false ) ) {

	class Opt_In_Static {

		/**
		 * Returns animations
		 * Returns Popup Pro animations if it's installed and active
		 *
		 *
		 * @return object
		 */
		public function get_animations() {

			$animations_in = array(
				''                                        => array(
					'' => __( 'No Animation', Opt_In::TEXT_DOMAIN ),
				),
				__( 'Bouncing Entrances', Opt_In::TEXT_DOMAIN ) => array(
					'bounceIn'      => __( 'Bounce In', Opt_In::TEXT_DOMAIN ),
					'bounceInUp'    => __( 'Bounce In Up', Opt_In::TEXT_DOMAIN ),
					'bounceInRight' => __( 'Bounce In Right', Opt_In::TEXT_DOMAIN ),
					'bounceInDown'  => __( 'Bounce In Down', Opt_In::TEXT_DOMAIN ),
					'bounceInLeft'  => __( 'Bounce In Left', Opt_In::TEXT_DOMAIN ),
				),
				__( 'Fading Entrances', Opt_In::TEXT_DOMAIN ) => array(
					'fadeIn'      => __( 'Fade In', Opt_In::TEXT_DOMAIN ),
					'fadeInUp'    => __( 'Fade In Up', Opt_In::TEXT_DOMAIN ),
					'fadeInRight' => __( 'Fade In Right', Opt_In::TEXT_DOMAIN ),
					'fadeInDown'  => __( 'Fade In Down', Opt_In::TEXT_DOMAIN ),
					'fadeInLeft'  => __( 'Fade In Left', Opt_In::TEXT_DOMAIN ),
				),
				__( 'Falling Entrances', Opt_In::TEXT_DOMAIN )  => array(
					'fall'     => __( 'Fall In', Opt_In::TEXT_DOMAIN ), // MISSING
					'sidefall' => __( 'Fade In Side', Opt_In::TEXT_DOMAIN ), // MISSING
				),
				__( 'Rotating Entrances', Opt_In::TEXT_DOMAIN ) => array(
					'rotateIn'          => __( 'Rotate In', Opt_In::TEXT_DOMAIN ),
					'rotateInDownLeft'  => __( 'Rotate In Down Left', Opt_In::TEXT_DOMAIN ),
					'rotateInDownRight' => __( 'Rotate In Down Right', Opt_In::TEXT_DOMAIN ),
					'rotateInUpLeft'    => __( 'Rotate In Up Left', Opt_In::TEXT_DOMAIN ),
					'rotateInUpRight'   => __( 'Rotate In Up Right', Opt_In::TEXT_DOMAIN ),
				),
				__( 'Sliding Entrances', Opt_In::TEXT_DOMAIN ) => array(
					'slideInUp'    => __( 'Slide In Up', Opt_In::TEXT_DOMAIN ),
					'slideInRight' => __( 'Slide In Right', Opt_In::TEXT_DOMAIN ),
					'slideInDown'  => __( 'Slide In Down', Opt_In::TEXT_DOMAIN ),
					'slideInLeft'  => __( 'Slide In Left', Opt_In::TEXT_DOMAIN ),
				),
				__( 'Zoom Entrances', Opt_In::TEXT_DOMAIN ) => array(
					'zoomIn'      => __( 'Zoom In', Opt_In::TEXT_DOMAIN ),
					'zoomInUp'    => __( 'Zoom In Up', Opt_In::TEXT_DOMAIN ),
					'zoomInRight' => __( 'Zoom In Right', Opt_In::TEXT_DOMAIN ),
					'zoomInDown'  => __( 'Zoom In Down', Opt_In::TEXT_DOMAIN ),
					'zoomInLeft'  => __( 'Zoom In Left', Opt_In::TEXT_DOMAIN ),
					'scaled'      => __( 'Super Scaled', Opt_In::TEXT_DOMAIN ), // MISSING
				),
				__( '3D Entrances', Opt_In::TEXT_DOMAIN ) => array(
					'sign wpoi-modal'    => __( '3D Sign', Opt_In::TEXT_DOMAIN ), // MISSING
					'slit wpoi-modal'    => __( '3D Slit', Opt_In::TEXT_DOMAIN ), // MISSING
					'flipx wpoi-modal'   => __( '3D Flip (Horizontal)', Opt_In::TEXT_DOMAIN ), // MISSING
					'flipy wpoi-modal'   => __( '3D Flip (Vertical)', Opt_In::TEXT_DOMAIN ), // MISSING
					'rotatex wpoi-modal' => __( '3D Rotate (Left)', Opt_In::TEXT_DOMAIN ), // MISSING
					'rotatey wpoi-modal' => __( '3D Rotate (Bottom)', Opt_In::TEXT_DOMAIN ), // MISSING
				),
				__( 'Special Entrances', Opt_In::TEXT_DOMAIN ) => array(
					'rollIn'       => __( 'Roll In', Opt_In::TEXT_DOMAIN ),
					'lightSpeedIn' => __( 'Light Speed In', Opt_In::TEXT_DOMAIN ),
					'newspaperIn'  => __( 'Newspaper In', Opt_In::TEXT_DOMAIN ),
				),
			);

			$animations_out = array(
				''                                         => array(
					'' => __( 'No Animation', Opt_In::TEXT_DOMAIN ),
				),
				__( 'Bouncing Exits', Opt_In::TEXT_DOMAIN ) => array(
					'bounceOut'      => __( 'Bounce Out', Opt_In::TEXT_DOMAIN ),
					'bounceOutUp'    => __( 'Bounce Out Up', Opt_In::TEXT_DOMAIN ),
					'bounceOutRight' => __( 'Bounce Out Right', Opt_In::TEXT_DOMAIN ),
					'bounceOutDown'  => __( 'Bounce Out Down', Opt_In::TEXT_DOMAIN ),
					'bounceOutLeft'  => __( 'Bounce Out Left', Opt_In::TEXT_DOMAIN ),
				),
				__( 'Fading Exits', Opt_In::TEXT_DOMAIN )  => array(
					'fadeOut'      => __( 'Fade Out', Opt_In::TEXT_DOMAIN ),
					'fadeOutUp'    => __( 'Fade Out Up', Opt_In::TEXT_DOMAIN ),
					'fadeOutRight' => __( 'Fade Out Right', Opt_In::TEXT_DOMAIN ),
					'fadeOutDown'  => __( 'Fade Out Down', Opt_In::TEXT_DOMAIN ),
					'fadeOutLeft'  => __( 'Fade Out Left', Opt_In::TEXT_DOMAIN ),
				),
				__( 'Rotating Exits', Opt_In::TEXT_DOMAIN ) => array(
					'rotateOut'      => __( 'Rotate In', Opt_In::TEXT_DOMAIN ),
					'rotateOutUp'    => __( 'Rotate In Up', Opt_In::TEXT_DOMAIN ),
					'rotateOutRight' => __( 'Rotate In Right', Opt_In::TEXT_DOMAIN ),
					'rotateOutDown'  => __( 'Rotate In Down', Opt_In::TEXT_DOMAIN ),
					'rotateOutLeft'  => __( 'Rotate In Left', Opt_In::TEXT_DOMAIN ),
				),
				__( 'Sliding Exits', Opt_In::TEXT_DOMAIN ) => array(
					'slideOutUp'    => __( 'Slide Out Up', Opt_In::TEXT_DOMAIN ),
					'slideOutRight' => __( 'Slide Out Left', Opt_In::TEXT_DOMAIN ),
					'slideOutDown'  => __( 'Slide Out Down', Opt_In::TEXT_DOMAIN ),
					'slideOutLeft'  => __( 'Slide Out Right', Opt_In::TEXT_DOMAIN ),
				),
				__( 'Zoom Exits', Opt_In::TEXT_DOMAIN )    => array(
					'zoomOut'      => __( 'Zoom Out', Opt_In::TEXT_DOMAIN ),
					'zoomOutUp'    => __( 'Zoom Out Up', Opt_In::TEXT_DOMAIN ),
					'zoomOutRight' => __( 'Zoom Out Right', Opt_In::TEXT_DOMAIN ),
					'zoomOutDown'  => __( 'Slide Out Down', Opt_In::TEXT_DOMAIN ),
					'zoomOutLeft'  => __( 'Slide Out Left', Opt_In::TEXT_DOMAIN ),
					'scaled'       => __( 'Super Scaled', Opt_In::TEXT_DOMAIN ), // MISSING
				),
				__( '3D Effects', Opt_In::TEXT_DOMAIN )    => array(
					'sign wpoi-modal'    => __( '3D Sign', Opt_In::TEXT_DOMAIN ), // MISSING
					'flipx wpoi-modal'   => __( '3D Flip (Horizontal)', Opt_In::TEXT_DOMAIN ), // MISSING
					'flipy wpoi-modal'   => __( '3D Flip (Vertical)', Opt_In::TEXT_DOMAIN ), // MISSING
					'rotatex wpoi-modal' => __( '3D Rotate (Left)', Opt_In::TEXT_DOMAIN ), // MISSING
					'rotatey wpoi-modal' => __( '3D Rotate (Bottom)', Opt_In::TEXT_DOMAIN ), // MISSING
				),
				__( 'Special Exits', Opt_In::TEXT_DOMAIN ) => array(
					'rollOut'       => __( 'Roll Out', Opt_In::TEXT_DOMAIN ),
					'lightSpeedOut' => __( 'Light Speed Out', Opt_In::TEXT_DOMAIN ),
					'newspaperOut'  => __( 'Newspaper Out', Opt_In::TEXT_DOMAIN ),
				),
			);

			return (object) array(
				'in'  => $animations_in,
				'out' => $animations_out,
			);
		}

		/**
		 * Returns palete name by slug.
		 *
		 * @since 3.0.6
		 *
		 * @param string $slug Palette slug.
		 *
		 * @return string Palette name.
		 */
		protected function pallets_ref( $slug ) {

			switch( $slug ) {
				case 'gray_slate': return 'Gray Slate';
				case 'coffee': return 'Coffee';
				case 'ectoplasm': return 'Ectoplasm';
				case 'blue': return 'Blue';
				case 'sunrise': return 'Sunrise';
				case 'midnight': return 'Midnight';
			}

			return $slug;
		}

		/**
		 * Load a palette array.
		 *
		 * @param string $name  Palette name = file name.
		 *
		 * @return string
		 */
		public function get_palette_file( $name ) {
			$file    = trailingslashit( dirname( __FILE__ ) ) . "palettes/{$name}.php";
			$content = array();

			if ( is_file( $file ) ) {
				/* @noinspection PhpIncludeInspection */
				$content = include $file;
			}

			return $content;

		}

		/**
		 * Returns palettes used to color optins
		 *
		 * @return array
		 */
		public function get_palettes() {

			return array(
				'gray_slate' => $this->get_palette_array( 'gray_slate' ),
				'coffee'     => $this->get_palette_array( 'coffee' ),
				'ectoplasm'  => $this->get_palette_array( 'ectoplasm' ),
				'blue'       => $this->get_palette_array( 'blue' ),
				'sunrise'    => $this->get_palette_array( 'sunrise' ),
				'midnight'   => $this->get_palette_array( 'midnight' ),
			);
		}

		/**
		 * Get the names of the existing color palettes.
		 *
		 * @since 4.0
		 * @return array
		 */
		public static function get_palettes_names() {
			return array(
				'gray_slate', 'coffee', 'ectoplasm', 'blue', 'sunrise', 'midnight',
			);
		}

		/**
		 * Returns palette array for palette name
		 *
		 * @param string $palette_name e.g. "gray_slate"
		 *
		 * @return array
		 */
		public function get_palette_array( $palette_name ) {

			$palette_arr = array();
			$palette_data = $this->get_palette_file( $palette_name );

			foreach ( $palette_data as $key => $value ) {
				$palette_arr[$key] = $value;
			}

			return $palette_arr;
		}

		/**
		 * Default form filds for a new form
		 *
		 * @since the beginning of time
		 * @since 4.0 is static
		 *
		 */
		public static function default_form_fields() {

			return array(
				'first_name' => array(
					'required'    => 'false',
					'label'       => __( 'First Name', Opt_In::TEXT_DOMAIN ),
					'name'        => 'first_name',
					'type'        => 'name',
					'placeholder' => 'John',
					'can_delete'  => true,
				),
				'last_name'  => array(
					'required'    => 'false',
					'label'       => __( 'Last Name', Opt_In::TEXT_DOMAIN ),
					'name'        => 'last_name',
					'type'        => 'name',
					'placeholder' => 'Smith',
					'can_delete'  => true,
				),
				'email'      => array(
					'required'    => 'true',
					'label'       => __( 'Your email', Opt_In::TEXT_DOMAIN ),
					'name'        => 'email',
					'type'        => 'email',
					'placeholder' => 'johnsmith@example.com',
					'validate'	  => 'true',
					'can_delete'  => false,
				),
				'submit'     => array(
					'required'     => 'true',
					'label'        => __( 'Submit', Opt_In::TEXT_DOMAIN ),
					'error_message'=> __( 'Please fill out all required fields.', Opt_In::TEXT_DOMAIN ),
					'name'         => 'submit',
					'type'         => 'submit',
					'placeholder'  => __( 'Subscribe', Opt_In::TEXT_DOMAIN ),
					'can_delete'   => false,
				),
			);
		}

		/**
		 * Returns array of countries
		 *
		 * @return array|mixed|null|void
		 */
		public function get_countries() {

			return apply_filters(
				'opt_in-country-list',
				array(
					'AU' => __( 'Australia', Opt_In::TEXT_DOMAIN ),
					'AF' => __( 'Afghanistan', Opt_In::TEXT_DOMAIN ),
					'AL' => __( 'Albania', Opt_In::TEXT_DOMAIN ),
					'DZ' => __( 'Algeria', Opt_In::TEXT_DOMAIN ),
					'AS' => __( 'American Samoa', Opt_In::TEXT_DOMAIN ),
					'AD' => __( 'Andorra', Opt_In::TEXT_DOMAIN ),
					'AO' => __( 'Angola', Opt_In::TEXT_DOMAIN ),
					'AI' => __( 'Anguilla', Opt_In::TEXT_DOMAIN ),
					'AQ' => __( 'Antarctica', Opt_In::TEXT_DOMAIN ),
					'AG' => __( 'Antigua and Barbuda', Opt_In::TEXT_DOMAIN ),
					'AR' => __( 'Argentina', Opt_In::TEXT_DOMAIN ),
					'AM' => __( 'Armenia', Opt_In::TEXT_DOMAIN ),
					'AW' => __( 'Aruba', Opt_In::TEXT_DOMAIN ),
					'AT' => __( 'Austria', Opt_In::TEXT_DOMAIN ),
					'AZ' => __( 'Azerbaijan', Opt_In::TEXT_DOMAIN ),
					'BS' => __( 'Bahamas', Opt_In::TEXT_DOMAIN ),
					'BH' => __( 'Bahrain', Opt_In::TEXT_DOMAIN ),
					'BD' => __( 'Bangladesh', Opt_In::TEXT_DOMAIN ),
					'BB' => __( 'Barbados', Opt_In::TEXT_DOMAIN ),
					'BY' => __( 'Belarus', Opt_In::TEXT_DOMAIN ),
					'BE' => __( 'Belgium', Opt_In::TEXT_DOMAIN ),
					'BZ' => __( 'Belize', Opt_In::TEXT_DOMAIN ),
					'BJ' => __( 'Benin', Opt_In::TEXT_DOMAIN ),
					'BM' => __( 'Bermuda', Opt_In::TEXT_DOMAIN ),
					'BT' => __( 'Bhutan', Opt_In::TEXT_DOMAIN ),
					'BO' => __( 'Bolivia', Opt_In::TEXT_DOMAIN ),
					'BA' => __( 'Bosnia and Herzegovina', Opt_In::TEXT_DOMAIN ),
					'BW' => __( 'Botswana', Opt_In::TEXT_DOMAIN ),
					'BV' => __( 'Bouvet Island', Opt_In::TEXT_DOMAIN ),
					'BR' => __( 'Brazil', Opt_In::TEXT_DOMAIN ),
					'IO' => __( 'British Indian Ocean Territory', Opt_In::TEXT_DOMAIN ),
					'BN' => __( 'Brunei', Opt_In::TEXT_DOMAIN ),
					'BG' => __( 'Bulgaria', Opt_In::TEXT_DOMAIN ),
					'BF' => __( 'Burkina Faso', Opt_In::TEXT_DOMAIN ),
					'BI' => __( 'Burundi', Opt_In::TEXT_DOMAIN ),
					'KH' => __( 'Cambodia', Opt_In::TEXT_DOMAIN ),
					'CM' => __( 'Cameroon', Opt_In::TEXT_DOMAIN ),
					'CA' => __( 'Canada', Opt_In::TEXT_DOMAIN ),
					'CV' => __( 'Cape Verde', Opt_In::TEXT_DOMAIN ),
					'KY' => __( 'Cayman Islands', Opt_In::TEXT_DOMAIN ),
					'CF' => __( 'Central African Republic', Opt_In::TEXT_DOMAIN ),
					'TD' => __( 'Chad', Opt_In::TEXT_DOMAIN ),
					'CL' => __( 'Chile', Opt_In::TEXT_DOMAIN ),
					'CN' => __( 'China, People\'s Republic of', Opt_In::TEXT_DOMAIN ),
					'CX' => __( 'Christmas Island', Opt_In::TEXT_DOMAIN ),
					'CC' => __( 'Cocos Islands', Opt_In::TEXT_DOMAIN ),
					'CO' => __( 'Colombia', Opt_In::TEXT_DOMAIN ),
					'KM' => __( 'Comoros', Opt_In::TEXT_DOMAIN ),
					'CD' => __( 'Congo, Democratic Republic of the', Opt_In::TEXT_DOMAIN ),
					'CG' => __( 'Congo, Republic of the', Opt_In::TEXT_DOMAIN ),
					'CK' => __( 'Cook Islands', Opt_In::TEXT_DOMAIN ),
					'CR' => __( 'Costa Rica', Opt_In::TEXT_DOMAIN ),
					'CI' => __( 'Côte d\'Ivoire', Opt_In::TEXT_DOMAIN ),
					'HR' => __( 'Croatia', Opt_In::TEXT_DOMAIN ),
					'CU' => __( 'Cuba', Opt_In::TEXT_DOMAIN ),
					'CW' => __( 'Curaçao', Opt_In::TEXT_DOMAIN ),
					'CY' => __( 'Cyprus', Opt_In::TEXT_DOMAIN ),
					'CZ' => __( 'Czech Republic', Opt_In::TEXT_DOMAIN ),
					'DK' => __( 'Denmark', Opt_In::TEXT_DOMAIN ),
					'DJ' => __( 'Djibouti', Opt_In::TEXT_DOMAIN ),
					'DM' => __( 'Dominica', Opt_In::TEXT_DOMAIN ),
					'DO' => __( 'Dominican Republic', Opt_In::TEXT_DOMAIN ),
					'TL' => __( 'East Timor', Opt_In::TEXT_DOMAIN ),
					'EC' => __( 'Ecuador', Opt_In::TEXT_DOMAIN ),
					'EG' => __( 'Egypt', Opt_In::TEXT_DOMAIN ),
					'SV' => __( 'El Salvador', Opt_In::TEXT_DOMAIN ),
					'GQ' => __( 'Equatorial Guinea', Opt_In::TEXT_DOMAIN ),
					'ER' => __( 'Eritrea', Opt_In::TEXT_DOMAIN ),
					'EE' => __( 'Estonia', Opt_In::TEXT_DOMAIN ),
					'ET' => __( 'Ethiopia', Opt_In::TEXT_DOMAIN ),
					'FK' => __( 'Falkland Islands', Opt_In::TEXT_DOMAIN ),
					'FO' => __( 'Faroe Islands', Opt_In::TEXT_DOMAIN ),
					'FJ' => __( 'Fiji', Opt_In::TEXT_DOMAIN ),
					'FI' => __( 'Finland', Opt_In::TEXT_DOMAIN ),
					'FR' => __( 'France', Opt_In::TEXT_DOMAIN ),
					'FX' => __( 'France, Metropolitan', Opt_In::TEXT_DOMAIN ),
					'GF' => __( 'French Guiana', Opt_In::TEXT_DOMAIN ),
					'PF' => __( 'French Polynesia', Opt_In::TEXT_DOMAIN ),
					'TF' => __( 'French South Territories', Opt_In::TEXT_DOMAIN ),
					'GA' => __( 'Gabon', Opt_In::TEXT_DOMAIN ),
					'GM' => __( 'Gambia', Opt_In::TEXT_DOMAIN ),
					'GE' => __( 'Georgia', Opt_In::TEXT_DOMAIN ),
					'DE' => __( 'Germany', Opt_In::TEXT_DOMAIN ),
					'GH' => __( 'Ghana', Opt_In::TEXT_DOMAIN ),
					'GI' => __( 'Gibraltar', Opt_In::TEXT_DOMAIN ),
					'GR' => __( 'Greece', Opt_In::TEXT_DOMAIN ),
					'GL' => __( 'Greenland', Opt_In::TEXT_DOMAIN ),
					'GD' => __( 'Grenada', Opt_In::TEXT_DOMAIN ),
					'GP' => __( 'Guadeloupe', Opt_In::TEXT_DOMAIN ),
					'GU' => __( 'Guam', Opt_In::TEXT_DOMAIN ),
					'GT' => __( 'Guatemala', Opt_In::TEXT_DOMAIN ),
					'GN' => __( 'Guinea', Opt_In::TEXT_DOMAIN ),
					'GW' => __( 'Guinea-Bissau', Opt_In::TEXT_DOMAIN ),
					'GY' => __( 'Guyana', Opt_In::TEXT_DOMAIN ),
					'HT' => __( 'Haiti', Opt_In::TEXT_DOMAIN ),
					'HM' => __( 'Heard Island And Mcdonald Island', Opt_In::TEXT_DOMAIN ),
					'HN' => __( 'Honduras', Opt_In::TEXT_DOMAIN ),
					'HK' => __( 'Hong Kong', Opt_In::TEXT_DOMAIN ),
					'HU' => __( 'Hungary', Opt_In::TEXT_DOMAIN ),
					'IS' => __( 'Iceland', Opt_In::TEXT_DOMAIN ),
					'IN' => __( 'India', Opt_In::TEXT_DOMAIN ),
					'ID' => __( 'Indonesia', Opt_In::TEXT_DOMAIN ),
					'IR' => __( 'Iran', Opt_In::TEXT_DOMAIN ),
					'IQ' => __( 'Iraq', Opt_In::TEXT_DOMAIN ),
					'IE' => __( 'Ireland', Opt_In::TEXT_DOMAIN ),
					'IL' => __( 'Israel', Opt_In::TEXT_DOMAIN ),
					'IT' => __( 'Italy', Opt_In::TEXT_DOMAIN ),
					'JM' => __( 'Jamaica', Opt_In::TEXT_DOMAIN ),
					'JP' => __( 'Japan', Opt_In::TEXT_DOMAIN ),
					'JT' => __( 'Johnston Island', Opt_In::TEXT_DOMAIN ),
					'JO' => __( 'Jordan', Opt_In::TEXT_DOMAIN ),
					'KZ' => __( 'Kazakhstan', Opt_In::TEXT_DOMAIN ),
					'KE' => __( 'Kenya', Opt_In::TEXT_DOMAIN ),
					'XK' => __( 'Kosovo', Opt_In::TEXT_DOMAIN ),
					'KI' => __( 'Kiribati', Opt_In::TEXT_DOMAIN ),
					'KP' => __( 'Korea, Democratic People\'s Republic of', Opt_In::TEXT_DOMAIN ),
					'KR' => __( 'Korea, Republic of', Opt_In::TEXT_DOMAIN ),
					'KW' => __( 'Kuwait', Opt_In::TEXT_DOMAIN ),
					'KG' => __( 'Kyrgyzstan', Opt_In::TEXT_DOMAIN ),
					'LA' => __( 'Lao People\'s Democratic Republic', Opt_In::TEXT_DOMAIN ),
					'LV' => __( 'Latvia', Opt_In::TEXT_DOMAIN ),
					'LB' => __( 'Lebanon', Opt_In::TEXT_DOMAIN ),
					'LS' => __( 'Lesotho', Opt_In::TEXT_DOMAIN ),
					'LR' => __( 'Liberia', Opt_In::TEXT_DOMAIN ),
					'LY' => __( 'Libya', Opt_In::TEXT_DOMAIN ),
					'LI' => __( 'Liechtenstein', Opt_In::TEXT_DOMAIN ),
					'LT' => __( 'Lithuania', Opt_In::TEXT_DOMAIN ),
					'LU' => __( 'Luxembourg', Opt_In::TEXT_DOMAIN ),
					'MO' => __( 'Macau', Opt_In::TEXT_DOMAIN ),
					'MK' => __( 'Macedonia', Opt_In::TEXT_DOMAIN ),
					'MG' => __( 'Madagascar', Opt_In::TEXT_DOMAIN ),
					'MW' => __( 'Malawi', Opt_In::TEXT_DOMAIN ),
					'MY' => __( 'Malaysia', Opt_In::TEXT_DOMAIN ),
					'MV' => __( 'Maldives', Opt_In::TEXT_DOMAIN ),
					'ML' => __( 'Mali', Opt_In::TEXT_DOMAIN ),
					'MT' => __( 'Malta', Opt_In::TEXT_DOMAIN ),
					'MH' => __( 'Marshall Islands', Opt_In::TEXT_DOMAIN ),
					'MQ' => __( 'Martinique', Opt_In::TEXT_DOMAIN ),
					'MR' => __( 'Mauritania', Opt_In::TEXT_DOMAIN ),
					'MU' => __( 'Mauritius', Opt_In::TEXT_DOMAIN ),
					'YT' => __( 'Mayotte', Opt_In::TEXT_DOMAIN ),
					'MX' => __( 'Mexico', Opt_In::TEXT_DOMAIN ),
					'FM' => __( 'Micronesia', Opt_In::TEXT_DOMAIN ),
					'MD' => __( 'Moldova', Opt_In::TEXT_DOMAIN ),
					'MC' => __( 'Monaco', Opt_In::TEXT_DOMAIN ),
					'MN' => __( 'Mongolia', Opt_In::TEXT_DOMAIN ),
					'ME' => __( 'Montenegro', Opt_In::TEXT_DOMAIN ),
					'MS' => __( 'Montserrat', Opt_In::TEXT_DOMAIN ),
					'MA' => __( 'Morocco', Opt_In::TEXT_DOMAIN ),
					'MZ' => __( 'Mozambique', Opt_In::TEXT_DOMAIN ),
					'MM' => __( 'Myanmar', Opt_In::TEXT_DOMAIN ),
					'NA' => __( 'Namibia', Opt_In::TEXT_DOMAIN ),
					'NR' => __( 'Nauru', Opt_In::TEXT_DOMAIN ),
					'NP' => __( 'Nepal', Opt_In::TEXT_DOMAIN ),
					'NL' => __( 'Netherlands', Opt_In::TEXT_DOMAIN ),
					'AN' => __( 'Netherlands Antilles', Opt_In::TEXT_DOMAIN ),
					'NC' => __( 'New Caledonia', Opt_In::TEXT_DOMAIN ),
					'NZ' => __( 'New Zealand', Opt_In::TEXT_DOMAIN ),
					'NI' => __( 'Nicaragua', Opt_In::TEXT_DOMAIN ),
					'NE' => __( 'Niger', Opt_In::TEXT_DOMAIN ),
					'NG' => __( 'Nigeria', Opt_In::TEXT_DOMAIN ),
					'NU' => __( 'Niue', Opt_In::TEXT_DOMAIN ),
					'NF' => __( 'Norfolk Island', Opt_In::TEXT_DOMAIN ),
					'MP' => __( 'Northern Mariana Islands', Opt_In::TEXT_DOMAIN ),
					'MP' => __( 'Mariana Islands, Northern', Opt_In::TEXT_DOMAIN ),
					'NO' => __( 'Norway', Opt_In::TEXT_DOMAIN ),
					'OM' => __( 'Oman', Opt_In::TEXT_DOMAIN ),
					'PK' => __( 'Pakistan', Opt_In::TEXT_DOMAIN ),
					'PW' => __( 'Palau', Opt_In::TEXT_DOMAIN ),
					'PS' => __( 'Palestine, State of', Opt_In::TEXT_DOMAIN ),
					'PA' => __( 'Panama', Opt_In::TEXT_DOMAIN ),
					'PG' => __( 'Papua New Guinea', Opt_In::TEXT_DOMAIN ),
					'PY' => __( 'Paraguay', Opt_In::TEXT_DOMAIN ),
					'PE' => __( 'Peru', Opt_In::TEXT_DOMAIN ),
					'PH' => __( 'Philippines', Opt_In::TEXT_DOMAIN ),
					'PN' => __( 'Pitcairn Islands', Opt_In::TEXT_DOMAIN ),
					'PL' => __( 'Poland', Opt_In::TEXT_DOMAIN ),
					'PT' => __( 'Portugal', Opt_In::TEXT_DOMAIN ),
					'PR' => __( 'Puerto Rico', Opt_In::TEXT_DOMAIN ),
					'QA' => __( 'Qatar', Opt_In::TEXT_DOMAIN ),
					'RE' => __( 'Réunion', Opt_In::TEXT_DOMAIN ),
					'RO' => __( 'Romania', Opt_In::TEXT_DOMAIN ),
					'RU' => __( 'Russia', Opt_In::TEXT_DOMAIN ),
					'RW' => __( 'Rwanda', Opt_In::TEXT_DOMAIN ),
					'SH' => __( 'Saint Helena', Opt_In::TEXT_DOMAIN ),
					'KN' => __( 'Saint Kitts and Nevis', Opt_In::TEXT_DOMAIN ),
					'LC' => __( 'Saint Lucia', Opt_In::TEXT_DOMAIN ),
					'PM' => __( 'Saint Pierre and Miquelon', Opt_In::TEXT_DOMAIN ),
					'VC' => __( 'Saint Vincent and the Grenadines', Opt_In::TEXT_DOMAIN ),
					'WS' => __( 'Samoa', Opt_In::TEXT_DOMAIN ),
					'SM' => __( 'San Marino', Opt_In::TEXT_DOMAIN ),
					'ST' => __( 'Sao Tome and Principe', Opt_In::TEXT_DOMAIN ),
					'SA' => __( 'Saudi Arabia', Opt_In::TEXT_DOMAIN ),
					'SN' => __( 'Senegal', Opt_In::TEXT_DOMAIN ),
					'CS' => __( 'Serbia', Opt_In::TEXT_DOMAIN ),
					'SC' => __( 'Seychelles', Opt_In::TEXT_DOMAIN ),
					'SL' => __( 'Sierra Leone', Opt_In::TEXT_DOMAIN ),
					'SG' => __( 'Singapore', Opt_In::TEXT_DOMAIN ),
					'MF' => __( 'Sint Maarten', Opt_In::TEXT_DOMAIN ),
					'SK' => __( 'Slovakia', Opt_In::TEXT_DOMAIN ),
					'SI' => __( 'Slovenia', Opt_In::TEXT_DOMAIN ),
					'SB' => __( 'Solomon Islands', Opt_In::TEXT_DOMAIN ),
					'SO' => __( 'Somalia', Opt_In::TEXT_DOMAIN ),
					'ZA' => __( 'South Africa', Opt_In::TEXT_DOMAIN ),
					'GS' => __( 'South Georgia and the South Sandwich Islands', Opt_In::TEXT_DOMAIN ),
					'ES' => __( 'Spain', Opt_In::TEXT_DOMAIN ),
					'LK' => __( 'Sri Lanka', Opt_In::TEXT_DOMAIN ),
					'XX' => __( 'Stateless Persons', Opt_In::TEXT_DOMAIN ),
					'SD' => __( 'Sudan', Opt_In::TEXT_DOMAIN ),
					'SD' => __( 'Sudan, South', Opt_In::TEXT_DOMAIN ),
					'SR' => __( 'Suriname', Opt_In::TEXT_DOMAIN ),
					'SJ' => __( 'Svalbard and Jan Mayen', Opt_In::TEXT_DOMAIN ),
					'SZ' => __( 'Swaziland', Opt_In::TEXT_DOMAIN ),
					'SE' => __( 'Sweden', Opt_In::TEXT_DOMAIN ),
					'CH' => __( 'Switzerland', Opt_In::TEXT_DOMAIN ),
					'SY' => __( 'Syria', Opt_In::TEXT_DOMAIN ),
					'TW' => __( 'Taiwan, Republic of China', Opt_In::TEXT_DOMAIN ),
					'TJ' => __( 'Tajikistan', Opt_In::TEXT_DOMAIN ),
					'TZ' => __( 'Tanzania', Opt_In::TEXT_DOMAIN ),
					'TH' => __( 'Thailand', Opt_In::TEXT_DOMAIN ),
					'TG' => __( 'Togo', Opt_In::TEXT_DOMAIN ),
					'TK' => __( 'Tokelau', Opt_In::TEXT_DOMAIN ),
					'TO' => __( 'Tonga', Opt_In::TEXT_DOMAIN ),
					'TT' => __( 'Trinidad and Tobago', Opt_In::TEXT_DOMAIN ),
					'TN' => __( 'Tunisia', Opt_In::TEXT_DOMAIN ),
					'TR' => __( 'Turkey', Opt_In::TEXT_DOMAIN ),
					'TM' => __( 'Turkmenistan', Opt_In::TEXT_DOMAIN ),
					'TC' => __( 'Turks and Caicos Islands', Opt_In::TEXT_DOMAIN ),
					'TV' => __( 'Tuvalu', Opt_In::TEXT_DOMAIN ),
					'UG' => __( 'Uganda', Opt_In::TEXT_DOMAIN ),
					'UA' => __( 'Ukraine', Opt_In::TEXT_DOMAIN ),
					'AE' => __( 'United Arab Emirates', Opt_In::TEXT_DOMAIN ),
					'GB' => __( 'United Kingdom', Opt_In::TEXT_DOMAIN ),
					'US' => __( 'United States of America (USA)', Opt_In::TEXT_DOMAIN ),
					'UM' => __( 'US Minor Outlying Islands', Opt_In::TEXT_DOMAIN ),
					'UY' => __( 'Uruguay', Opt_In::TEXT_DOMAIN ),
					'UZ' => __( 'Uzbekistan', Opt_In::TEXT_DOMAIN ),
					'VU' => __( 'Vanuatu', Opt_In::TEXT_DOMAIN ),
					'VA' => __( 'Vatican City', Opt_In::TEXT_DOMAIN ),
					'VE' => __( 'Venezuela', Opt_In::TEXT_DOMAIN ),
					'VN' => __( 'Vietnam', Opt_In::TEXT_DOMAIN ),
					'VG' => __( 'Virgin Islands, British', Opt_In::TEXT_DOMAIN ),
					'VI' => __( 'Virgin Islands, U.S.', Opt_In::TEXT_DOMAIN ),
					'WF' => __( 'Wallis And Futuna', Opt_In::TEXT_DOMAIN ),
					'EH' => __( 'Western Sahara', Opt_In::TEXT_DOMAIN ),
					'YE' => __( 'Yemen', Opt_In::TEXT_DOMAIN ),
					'ZM' => __( 'Zambia', Opt_In::TEXT_DOMAIN ),
					'ZW' => __( 'Zimbabwe', Opt_In::TEXT_DOMAIN ),
				)
			);
		}
	}
}
