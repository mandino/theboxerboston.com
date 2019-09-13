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
					'' => __( 'No Animation', 'wordpress-popup' ),
				),
				__( 'Bouncing Entrances', 'wordpress-popup' ) => array(
					'bounceIn'      => __( 'Bounce In', 'wordpress-popup' ),
					'bounceInUp'    => __( 'Bounce In Up', 'wordpress-popup' ),
					'bounceInRight' => __( 'Bounce In Right', 'wordpress-popup' ),
					'bounceInDown'  => __( 'Bounce In Down', 'wordpress-popup' ),
					'bounceInLeft'  => __( 'Bounce In Left', 'wordpress-popup' ),
				),
				__( 'Fading Entrances', 'wordpress-popup' ) => array(
					'fadeIn'      => __( 'Fade In', 'wordpress-popup' ),
					'fadeInUp'    => __( 'Fade In Up', 'wordpress-popup' ),
					'fadeInRight' => __( 'Fade In Right', 'wordpress-popup' ),
					'fadeInDown'  => __( 'Fade In Down', 'wordpress-popup' ),
					'fadeInLeft'  => __( 'Fade In Left', 'wordpress-popup' ),
				),
				__( 'Falling Entrances', 'wordpress-popup' )  => array(
					'fall'     => __( 'Fall In', 'wordpress-popup' ), // MISSING
					'sidefall' => __( 'Fade In Side', 'wordpress-popup' ), // MISSING
				),
				__( 'Rotating Entrances', 'wordpress-popup' ) => array(
					'rotateIn'          => __( 'Rotate In', 'wordpress-popup' ),
					'rotateInDownLeft'  => __( 'Rotate In Down Left', 'wordpress-popup' ),
					'rotateInDownRight' => __( 'Rotate In Down Right', 'wordpress-popup' ),
					'rotateInUpLeft'    => __( 'Rotate In Up Left', 'wordpress-popup' ),
					'rotateInUpRight'   => __( 'Rotate In Up Right', 'wordpress-popup' ),
				),
				__( 'Sliding Entrances', 'wordpress-popup' ) => array(
					'slideInUp'    => __( 'Slide In Up', 'wordpress-popup' ),
					'slideInRight' => __( 'Slide In Right', 'wordpress-popup' ),
					'slideInDown'  => __( 'Slide In Down', 'wordpress-popup' ),
					'slideInLeft'  => __( 'Slide In Left', 'wordpress-popup' ),
				),
				__( 'Zoom Entrances', 'wordpress-popup' ) => array(
					'zoomIn'      => __( 'Zoom In', 'wordpress-popup' ),
					'zoomInUp'    => __( 'Zoom In Up', 'wordpress-popup' ),
					'zoomInRight' => __( 'Zoom In Right', 'wordpress-popup' ),
					'zoomInDown'  => __( 'Zoom In Down', 'wordpress-popup' ),
					'zoomInLeft'  => __( 'Zoom In Left', 'wordpress-popup' ),
					'scaled'      => __( 'Super Scaled', 'wordpress-popup' ), // MISSING
				),
				__( '3D Entrances', 'wordpress-popup' ) => array(
					'sign wpoi-modal'    => __( '3D Sign', 'wordpress-popup' ), // MISSING
					'slit wpoi-modal'    => __( '3D Slit', 'wordpress-popup' ), // MISSING
					'flipx wpoi-modal'   => __( '3D Flip (Horizontal)', 'wordpress-popup' ), // MISSING
					'flipy wpoi-modal'   => __( '3D Flip (Vertical)', 'wordpress-popup' ), // MISSING
					'rotatex wpoi-modal' => __( '3D Rotate (Left)', 'wordpress-popup' ), // MISSING
					'rotatey wpoi-modal' => __( '3D Rotate (Bottom)', 'wordpress-popup' ), // MISSING
				),
				__( 'Special Entrances', 'wordpress-popup' ) => array(
					'rollIn'       => __( 'Roll In', 'wordpress-popup' ),
					'lightSpeedIn' => __( 'Light Speed In', 'wordpress-popup' ),
					'newspaperIn'  => __( 'Newspaper In', 'wordpress-popup' ),
				),
			);

			$animations_out = array(
				''                                         => array(
					'' => __( 'No Animation', 'wordpress-popup' ),
				),
				__( 'Bouncing Exits', 'wordpress-popup' ) => array(
					'bounceOut'      => __( 'Bounce Out', 'wordpress-popup' ),
					'bounceOutUp'    => __( 'Bounce Out Up', 'wordpress-popup' ),
					'bounceOutRight' => __( 'Bounce Out Right', 'wordpress-popup' ),
					'bounceOutDown'  => __( 'Bounce Out Down', 'wordpress-popup' ),
					'bounceOutLeft'  => __( 'Bounce Out Left', 'wordpress-popup' ),
				),
				__( 'Fading Exits', 'wordpress-popup' )  => array(
					'fadeOut'      => __( 'Fade Out', 'wordpress-popup' ),
					'fadeOutUp'    => __( 'Fade Out Up', 'wordpress-popup' ),
					'fadeOutRight' => __( 'Fade Out Right', 'wordpress-popup' ),
					'fadeOutDown'  => __( 'Fade Out Down', 'wordpress-popup' ),
					'fadeOutLeft'  => __( 'Fade Out Left', 'wordpress-popup' ),
				),
				__( 'Rotating Exits', 'wordpress-popup' ) => array(
					'rotateOut'      => __( 'Rotate In', 'wordpress-popup' ),
					'rotateOutUp'    => __( 'Rotate In Up', 'wordpress-popup' ),
					'rotateOutRight' => __( 'Rotate In Right', 'wordpress-popup' ),
					'rotateOutDown'  => __( 'Rotate In Down', 'wordpress-popup' ),
					'rotateOutLeft'  => __( 'Rotate In Left', 'wordpress-popup' ),
				),
				__( 'Sliding Exits', 'wordpress-popup' ) => array(
					'slideOutUp'    => __( 'Slide Out Up', 'wordpress-popup' ),
					'slideOutRight' => __( 'Slide Out Left', 'wordpress-popup' ),
					'slideOutDown'  => __( 'Slide Out Down', 'wordpress-popup' ),
					'slideOutLeft'  => __( 'Slide Out Right', 'wordpress-popup' ),
				),
				__( 'Zoom Exits', 'wordpress-popup' )    => array(
					'zoomOut'      => __( 'Zoom Out', 'wordpress-popup' ),
					'zoomOutUp'    => __( 'Zoom Out Up', 'wordpress-popup' ),
					'zoomOutRight' => __( 'Zoom Out Right', 'wordpress-popup' ),
					'zoomOutDown'  => __( 'Slide Out Down', 'wordpress-popup' ),
					'zoomOutLeft'  => __( 'Slide Out Left', 'wordpress-popup' ),
					'scaled'       => __( 'Super Scaled', 'wordpress-popup' ), // MISSING
				),
				__( '3D Effects', 'wordpress-popup' )    => array(
					'sign wpoi-modal'    => __( '3D Sign', 'wordpress-popup' ), // MISSING
					'flipx wpoi-modal'   => __( '3D Flip (Horizontal)', 'wordpress-popup' ), // MISSING
					'flipy wpoi-modal'   => __( '3D Flip (Vertical)', 'wordpress-popup' ), // MISSING
					'rotatex wpoi-modal' => __( '3D Rotate (Left)', 'wordpress-popup' ), // MISSING
					'rotatey wpoi-modal' => __( '3D Rotate (Bottom)', 'wordpress-popup' ), // MISSING
				),
				__( 'Special Exits', 'wordpress-popup' ) => array(
					'rollOut'       => __( 'Roll Out', 'wordpress-popup' ),
					'lightSpeedOut' => __( 'Light Speed Out', 'wordpress-popup' ),
					'newspaperOut'  => __( 'Newspaper Out', 'wordpress-popup' ),
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
					'label'       => __( 'First Name', 'wordpress-popup' ),
					'name'        => 'first_name',
					'type'        => 'name',
					'placeholder' => 'John',
					'can_delete'  => true,
				),
				'last_name'  => array(
					'required'    => 'false',
					'label'       => __( 'Last Name', 'wordpress-popup' ),
					'name'        => 'last_name',
					'type'        => 'name',
					'placeholder' => 'Smith',
					'can_delete'  => true,
				),
				'email'      => array(
					'required'    => 'true',
					'label'       => __( 'Your email', 'wordpress-popup' ),
					'name'        => 'email',
					'type'        => 'email',
					'placeholder' => 'johnsmith@example.com',
					'validate'	  => 'true',
					'can_delete'  => false,
				),
				'submit'     => array(
					'required'     => 'true',
					'label'        => __( 'Submit', 'wordpress-popup' ),
					'error_message'=> __( 'Please fill out all required fields.', 'wordpress-popup' ),
					'name'         => 'submit',
					'type'         => 'submit',
					'placeholder'  => __( 'Subscribe', 'wordpress-popup' ),
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
					'AU' => __( 'Australia', 'wordpress-popup' ),
					'AF' => __( 'Afghanistan', 'wordpress-popup' ),
					'AL' => __( 'Albania', 'wordpress-popup' ),
					'DZ' => __( 'Algeria', 'wordpress-popup' ),
					'AS' => __( 'American Samoa', 'wordpress-popup' ),
					'AD' => __( 'Andorra', 'wordpress-popup' ),
					'AO' => __( 'Angola', 'wordpress-popup' ),
					'AI' => __( 'Anguilla', 'wordpress-popup' ),
					'AQ' => __( 'Antarctica', 'wordpress-popup' ),
					'AG' => __( 'Antigua and Barbuda', 'wordpress-popup' ),
					'AR' => __( 'Argentina', 'wordpress-popup' ),
					'AM' => __( 'Armenia', 'wordpress-popup' ),
					'AW' => __( 'Aruba', 'wordpress-popup' ),
					'AT' => __( 'Austria', 'wordpress-popup' ),
					'AZ' => __( 'Azerbaijan', 'wordpress-popup' ),
					'BS' => __( 'Bahamas', 'wordpress-popup' ),
					'BH' => __( 'Bahrain', 'wordpress-popup' ),
					'BD' => __( 'Bangladesh', 'wordpress-popup' ),
					'BB' => __( 'Barbados', 'wordpress-popup' ),
					'BY' => __( 'Belarus', 'wordpress-popup' ),
					'BE' => __( 'Belgium', 'wordpress-popup' ),
					'BZ' => __( 'Belize', 'wordpress-popup' ),
					'BJ' => __( 'Benin', 'wordpress-popup' ),
					'BM' => __( 'Bermuda', 'wordpress-popup' ),
					'BT' => __( 'Bhutan', 'wordpress-popup' ),
					'BO' => __( 'Bolivia', 'wordpress-popup' ),
					'BA' => __( 'Bosnia and Herzegovina', 'wordpress-popup' ),
					'BW' => __( 'Botswana', 'wordpress-popup' ),
					'BV' => __( 'Bouvet Island', 'wordpress-popup' ),
					'BR' => __( 'Brazil', 'wordpress-popup' ),
					'IO' => __( 'British Indian Ocean Territory', 'wordpress-popup' ),
					'BN' => __( 'Brunei', 'wordpress-popup' ),
					'BG' => __( 'Bulgaria', 'wordpress-popup' ),
					'BF' => __( 'Burkina Faso', 'wordpress-popup' ),
					'BI' => __( 'Burundi', 'wordpress-popup' ),
					'KH' => __( 'Cambodia', 'wordpress-popup' ),
					'CM' => __( 'Cameroon', 'wordpress-popup' ),
					'CA' => __( 'Canada', 'wordpress-popup' ),
					'CV' => __( 'Cape Verde', 'wordpress-popup' ),
					'KY' => __( 'Cayman Islands', 'wordpress-popup' ),
					'CF' => __( 'Central African Republic', 'wordpress-popup' ),
					'TD' => __( 'Chad', 'wordpress-popup' ),
					'CL' => __( 'Chile', 'wordpress-popup' ),
					'CN' => __( 'China, People\'s Republic of', 'wordpress-popup' ),
					'CX' => __( 'Christmas Island', 'wordpress-popup' ),
					'CC' => __( 'Cocos Islands', 'wordpress-popup' ),
					'CO' => __( 'Colombia', 'wordpress-popup' ),
					'KM' => __( 'Comoros', 'wordpress-popup' ),
					'CD' => __( 'Congo, Democratic Republic of the', 'wordpress-popup' ),
					'CG' => __( 'Congo, Republic of the', 'wordpress-popup' ),
					'CK' => __( 'Cook Islands', 'wordpress-popup' ),
					'CR' => __( 'Costa Rica', 'wordpress-popup' ),
					'CI' => __( 'Côte d\'Ivoire', 'wordpress-popup' ),
					'HR' => __( 'Croatia', 'wordpress-popup' ),
					'CU' => __( 'Cuba', 'wordpress-popup' ),
					'CW' => __( 'Curaçao', 'wordpress-popup' ),
					'CY' => __( 'Cyprus', 'wordpress-popup' ),
					'CZ' => __( 'Czech Republic', 'wordpress-popup' ),
					'DK' => __( 'Denmark', 'wordpress-popup' ),
					'DJ' => __( 'Djibouti', 'wordpress-popup' ),
					'DM' => __( 'Dominica', 'wordpress-popup' ),
					'DO' => __( 'Dominican Republic', 'wordpress-popup' ),
					'TL' => __( 'East Timor', 'wordpress-popup' ),
					'EC' => __( 'Ecuador', 'wordpress-popup' ),
					'EG' => __( 'Egypt', 'wordpress-popup' ),
					'SV' => __( 'El Salvador', 'wordpress-popup' ),
					'GQ' => __( 'Equatorial Guinea', 'wordpress-popup' ),
					'ER' => __( 'Eritrea', 'wordpress-popup' ),
					'EE' => __( 'Estonia', 'wordpress-popup' ),
					'ET' => __( 'Ethiopia', 'wordpress-popup' ),
					'FK' => __( 'Falkland Islands', 'wordpress-popup' ),
					'FO' => __( 'Faroe Islands', 'wordpress-popup' ),
					'FJ' => __( 'Fiji', 'wordpress-popup' ),
					'FI' => __( 'Finland', 'wordpress-popup' ),
					'FR' => __( 'France', 'wordpress-popup' ),
					'FX' => __( 'France, Metropolitan', 'wordpress-popup' ),
					'GF' => __( 'French Guiana', 'wordpress-popup' ),
					'PF' => __( 'French Polynesia', 'wordpress-popup' ),
					'TF' => __( 'French South Territories', 'wordpress-popup' ),
					'GA' => __( 'Gabon', 'wordpress-popup' ),
					'GM' => __( 'Gambia', 'wordpress-popup' ),
					'GE' => __( 'Georgia', 'wordpress-popup' ),
					'DE' => __( 'Germany', 'wordpress-popup' ),
					'GH' => __( 'Ghana', 'wordpress-popup' ),
					'GI' => __( 'Gibraltar', 'wordpress-popup' ),
					'GR' => __( 'Greece', 'wordpress-popup' ),
					'GL' => __( 'Greenland', 'wordpress-popup' ),
					'GD' => __( 'Grenada', 'wordpress-popup' ),
					'GP' => __( 'Guadeloupe', 'wordpress-popup' ),
					'GU' => __( 'Guam', 'wordpress-popup' ),
					'GT' => __( 'Guatemala', 'wordpress-popup' ),
					'GN' => __( 'Guinea', 'wordpress-popup' ),
					'GW' => __( 'Guinea-Bissau', 'wordpress-popup' ),
					'GY' => __( 'Guyana', 'wordpress-popup' ),
					'HT' => __( 'Haiti', 'wordpress-popup' ),
					'HM' => __( 'Heard Island And Mcdonald Island', 'wordpress-popup' ),
					'HN' => __( 'Honduras', 'wordpress-popup' ),
					'HK' => __( 'Hong Kong', 'wordpress-popup' ),
					'HU' => __( 'Hungary', 'wordpress-popup' ),
					'IS' => __( 'Iceland', 'wordpress-popup' ),
					'IN' => __( 'India', 'wordpress-popup' ),
					'ID' => __( 'Indonesia', 'wordpress-popup' ),
					'IR' => __( 'Iran', 'wordpress-popup' ),
					'IQ' => __( 'Iraq', 'wordpress-popup' ),
					'IE' => __( 'Ireland', 'wordpress-popup' ),
					'IL' => __( 'Israel', 'wordpress-popup' ),
					'IT' => __( 'Italy', 'wordpress-popup' ),
					'JM' => __( 'Jamaica', 'wordpress-popup' ),
					'JP' => __( 'Japan', 'wordpress-popup' ),
					'JT' => __( 'Johnston Island', 'wordpress-popup' ),
					'JO' => __( 'Jordan', 'wordpress-popup' ),
					'KZ' => __( 'Kazakhstan', 'wordpress-popup' ),
					'KE' => __( 'Kenya', 'wordpress-popup' ),
					'XK' => __( 'Kosovo', 'wordpress-popup' ),
					'KI' => __( 'Kiribati', 'wordpress-popup' ),
					'KP' => __( 'Korea, Democratic People\'s Republic of', 'wordpress-popup' ),
					'KR' => __( 'Korea, Republic of', 'wordpress-popup' ),
					'KW' => __( 'Kuwait', 'wordpress-popup' ),
					'KG' => __( 'Kyrgyzstan', 'wordpress-popup' ),
					'LA' => __( 'Lao People\'s Democratic Republic', 'wordpress-popup' ),
					'LV' => __( 'Latvia', 'wordpress-popup' ),
					'LB' => __( 'Lebanon', 'wordpress-popup' ),
					'LS' => __( 'Lesotho', 'wordpress-popup' ),
					'LR' => __( 'Liberia', 'wordpress-popup' ),
					'LY' => __( 'Libya', 'wordpress-popup' ),
					'LI' => __( 'Liechtenstein', 'wordpress-popup' ),
					'LT' => __( 'Lithuania', 'wordpress-popup' ),
					'LU' => __( 'Luxembourg', 'wordpress-popup' ),
					'MO' => __( 'Macau', 'wordpress-popup' ),
					'MK' => __( 'Macedonia', 'wordpress-popup' ),
					'MG' => __( 'Madagascar', 'wordpress-popup' ),
					'MW' => __( 'Malawi', 'wordpress-popup' ),
					'MY' => __( 'Malaysia', 'wordpress-popup' ),
					'MV' => __( 'Maldives', 'wordpress-popup' ),
					'ML' => __( 'Mali', 'wordpress-popup' ),
					'MT' => __( 'Malta', 'wordpress-popup' ),
					'MH' => __( 'Marshall Islands', 'wordpress-popup' ),
					'MQ' => __( 'Martinique', 'wordpress-popup' ),
					'MR' => __( 'Mauritania', 'wordpress-popup' ),
					'MU' => __( 'Mauritius', 'wordpress-popup' ),
					'YT' => __( 'Mayotte', 'wordpress-popup' ),
					'MX' => __( 'Mexico', 'wordpress-popup' ),
					'FM' => __( 'Micronesia', 'wordpress-popup' ),
					'MD' => __( 'Moldova', 'wordpress-popup' ),
					'MC' => __( 'Monaco', 'wordpress-popup' ),
					'MN' => __( 'Mongolia', 'wordpress-popup' ),
					'ME' => __( 'Montenegro', 'wordpress-popup' ),
					'MS' => __( 'Montserrat', 'wordpress-popup' ),
					'MA' => __( 'Morocco', 'wordpress-popup' ),
					'MZ' => __( 'Mozambique', 'wordpress-popup' ),
					'MM' => __( 'Myanmar', 'wordpress-popup' ),
					'NA' => __( 'Namibia', 'wordpress-popup' ),
					'NR' => __( 'Nauru', 'wordpress-popup' ),
					'NP' => __( 'Nepal', 'wordpress-popup' ),
					'NL' => __( 'Netherlands', 'wordpress-popup' ),
					'AN' => __( 'Netherlands Antilles', 'wordpress-popup' ),
					'NC' => __( 'New Caledonia', 'wordpress-popup' ),
					'NZ' => __( 'New Zealand', 'wordpress-popup' ),
					'NI' => __( 'Nicaragua', 'wordpress-popup' ),
					'NE' => __( 'Niger', 'wordpress-popup' ),
					'NG' => __( 'Nigeria', 'wordpress-popup' ),
					'NU' => __( 'Niue', 'wordpress-popup' ),
					'NF' => __( 'Norfolk Island', 'wordpress-popup' ),
					'MP' => __( 'Northern Mariana Islands', 'wordpress-popup' ),
					'MP' => __( 'Mariana Islands, Northern', 'wordpress-popup' ),
					'NO' => __( 'Norway', 'wordpress-popup' ),
					'OM' => __( 'Oman', 'wordpress-popup' ),
					'PK' => __( 'Pakistan', 'wordpress-popup' ),
					'PW' => __( 'Palau', 'wordpress-popup' ),
					'PS' => __( 'Palestine, State of', 'wordpress-popup' ),
					'PA' => __( 'Panama', 'wordpress-popup' ),
					'PG' => __( 'Papua New Guinea', 'wordpress-popup' ),
					'PY' => __( 'Paraguay', 'wordpress-popup' ),
					'PE' => __( 'Peru', 'wordpress-popup' ),
					'PH' => __( 'Philippines', 'wordpress-popup' ),
					'PN' => __( 'Pitcairn Islands', 'wordpress-popup' ),
					'PL' => __( 'Poland', 'wordpress-popup' ),
					'PT' => __( 'Portugal', 'wordpress-popup' ),
					'PR' => __( 'Puerto Rico', 'wordpress-popup' ),
					'QA' => __( 'Qatar', 'wordpress-popup' ),
					'RE' => __( 'Réunion', 'wordpress-popup' ),
					'RO' => __( 'Romania', 'wordpress-popup' ),
					'RU' => __( 'Russia', 'wordpress-popup' ),
					'RW' => __( 'Rwanda', 'wordpress-popup' ),
					'SH' => __( 'Saint Helena', 'wordpress-popup' ),
					'KN' => __( 'Saint Kitts and Nevis', 'wordpress-popup' ),
					'LC' => __( 'Saint Lucia', 'wordpress-popup' ),
					'PM' => __( 'Saint Pierre and Miquelon', 'wordpress-popup' ),
					'VC' => __( 'Saint Vincent and the Grenadines', 'wordpress-popup' ),
					'WS' => __( 'Samoa', 'wordpress-popup' ),
					'SM' => __( 'San Marino', 'wordpress-popup' ),
					'ST' => __( 'Sao Tome and Principe', 'wordpress-popup' ),
					'SA' => __( 'Saudi Arabia', 'wordpress-popup' ),
					'SN' => __( 'Senegal', 'wordpress-popup' ),
					'CS' => __( 'Serbia', 'wordpress-popup' ),
					'SC' => __( 'Seychelles', 'wordpress-popup' ),
					'SL' => __( 'Sierra Leone', 'wordpress-popup' ),
					'SG' => __( 'Singapore', 'wordpress-popup' ),
					'MF' => __( 'Sint Maarten', 'wordpress-popup' ),
					'SK' => __( 'Slovakia', 'wordpress-popup' ),
					'SI' => __( 'Slovenia', 'wordpress-popup' ),
					'SB' => __( 'Solomon Islands', 'wordpress-popup' ),
					'SO' => __( 'Somalia', 'wordpress-popup' ),
					'ZA' => __( 'South Africa', 'wordpress-popup' ),
					'GS' => __( 'South Georgia and the South Sandwich Islands', 'wordpress-popup' ),
					'ES' => __( 'Spain', 'wordpress-popup' ),
					'LK' => __( 'Sri Lanka', 'wordpress-popup' ),
					'XX' => __( 'Stateless Persons', 'wordpress-popup' ),
					'SD' => __( 'Sudan', 'wordpress-popup' ),
					'SD' => __( 'Sudan, South', 'wordpress-popup' ),
					'SR' => __( 'Suriname', 'wordpress-popup' ),
					'SJ' => __( 'Svalbard and Jan Mayen', 'wordpress-popup' ),
					'SZ' => __( 'Swaziland', 'wordpress-popup' ),
					'SE' => __( 'Sweden', 'wordpress-popup' ),
					'CH' => __( 'Switzerland', 'wordpress-popup' ),
					'SY' => __( 'Syria', 'wordpress-popup' ),
					'TW' => __( 'Taiwan, Republic of China', 'wordpress-popup' ),
					'TJ' => __( 'Tajikistan', 'wordpress-popup' ),
					'TZ' => __( 'Tanzania', 'wordpress-popup' ),
					'TH' => __( 'Thailand', 'wordpress-popup' ),
					'TG' => __( 'Togo', 'wordpress-popup' ),
					'TK' => __( 'Tokelau', 'wordpress-popup' ),
					'TO' => __( 'Tonga', 'wordpress-popup' ),
					'TT' => __( 'Trinidad and Tobago', 'wordpress-popup' ),
					'TN' => __( 'Tunisia', 'wordpress-popup' ),
					'TR' => __( 'Turkey', 'wordpress-popup' ),
					'TM' => __( 'Turkmenistan', 'wordpress-popup' ),
					'TC' => __( 'Turks and Caicos Islands', 'wordpress-popup' ),
					'TV' => __( 'Tuvalu', 'wordpress-popup' ),
					'UG' => __( 'Uganda', 'wordpress-popup' ),
					'UA' => __( 'Ukraine', 'wordpress-popup' ),
					'AE' => __( 'United Arab Emirates', 'wordpress-popup' ),
					'GB' => __( 'United Kingdom', 'wordpress-popup' ),
					'US' => __( 'United States of America (USA)', 'wordpress-popup' ),
					'UM' => __( 'US Minor Outlying Islands', 'wordpress-popup' ),
					'UY' => __( 'Uruguay', 'wordpress-popup' ),
					'UZ' => __( 'Uzbekistan', 'wordpress-popup' ),
					'VU' => __( 'Vanuatu', 'wordpress-popup' ),
					'VA' => __( 'Vatican City', 'wordpress-popup' ),
					'VE' => __( 'Venezuela', 'wordpress-popup' ),
					'VN' => __( 'Vietnam', 'wordpress-popup' ),
					'VG' => __( 'Virgin Islands, British', 'wordpress-popup' ),
					'VI' => __( 'Virgin Islands, U.S.', 'wordpress-popup' ),
					'WF' => __( 'Wallis And Futuna', 'wordpress-popup' ),
					'EH' => __( 'Western Sahara', 'wordpress-popup' ),
					'YE' => __( 'Yemen', 'wordpress-popup' ),
					'ZM' => __( 'Zambia', 'wordpress-popup' ),
					'ZW' => __( 'Zimbabwe', 'wordpress-popup' ),
				)
			);
		}
	}
}
