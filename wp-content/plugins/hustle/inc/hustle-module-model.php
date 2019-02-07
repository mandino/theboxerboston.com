<?php

/**
 * Class Hustle_Module_Model
 *
 * @property Hustle_Module_Decorator $decorated
 */

class Hustle_Module_Model extends Hustle_Model {

	const POPUP_MODULE = 'popup';
	const SLIDEIN_MODULE = 'slidein';
	const WIDGET_MODULE = 'widget';
	const SHORTCODE_MODULE = 'shortcode';
	const EMBEDDED_MODULE = 'embedded';
	const SOCIAL_SHARING_MODULE = 'social_sharing';
	const SUBSCRIPTION              = "subscription";
	const E_NEWSLETTER_GROUPS       = "e_newsletter_groups";
	const SYNC_WITH_E_NEWSLETTER    = "sync_with_e_newsletter";
	const E_NEWSLETTER_DOUBLE_OPT_IN = "e_newsletter_double_opt_in";
	const HAS_LOCAL_SYNCED_WITH_E_NEWSLETTER = "has_local_synced_with_e_newsletter";
	const ERROR_LOG = "error_logs";

	/**
	 * @var $_provider_details object
	 */
	private $_provider_details;

	static function instance(){
		return new self;
	}

	static function get_embedded_types() {
		return array( 'after_content', 'widget', 'shortcode' );
	}

	/**
	 * Decorates current model
	 *
	 * @return Hustle_Module_Decorator
	 */
	function get_decorated(){

		if( !$this->_decorator )
			$this->_decorator = new Hustle_Module_Decorator( $this );

		return $this->_decorator;
	}

	/**
	 * Content Model based upon module type.
	 *
	 * @return Class
	 */

	function get_content($type = 'popup') {
 		switch ( $type ) {
			case 'popup':
				return new Hustle_Popup_Content( $this->get_settings_meta( self::KEY_CONTENT, '{}', true ), $this );
				break;
			case 'slidein':
				return new Hustle_Slidein_Content( $this->get_settings_meta( self::KEY_CONTENT, '{}', true ), $this );
				break;
			case 'embedded':
				return new Hustle_Embedded_Content( $this->get_settings_meta( self::KEY_CONTENT, '{}', true ), $this );
				break;
		}
	}

	function get_design() {
		return new Hustle_Popup_Design( $this->get_settings_meta( self::KEY_DESIGN, '{}', true ), $this );
	}

	function get_display_settings() {
		return new Hustle_Popup_Settings( $this->get_settings_meta( self::KEY_SETTINGS, '{}', true ), $this );
	}

	function get_shortcode_id() {
		return $this->get_meta( self::KEY_SHORTCODE_ID );
	}

	function is_embedded_type_active($type) {
		$settings = $this->get_display_settings()->to_array();
		if ( isset( $settings[ $type . '_enabled' ] ) && $settings[ $type . '_enabled' ] == 'true' ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Save log to DB for every failed subscription.
	 *
	 * @param (array) $data			Submitted field data.
	 **/
	function log_error( $data ) {
		$data = wp_parse_args( array( 'date' => date( 'Y-m-d' ) ), $data );
		$this->add_meta( self::ERROR_LOG, json_encode( $data ) );
	}

	/**
	 * Returns total error count
	 *
	 * @return int
	 */
	function get_total_log_errors(){
		return (int) $this->_wpdb->get_var( $this->_wpdb->prepare( "SELECT COUNT(meta_id) FROM " . $this->get_meta_table() . " WHERE `module_id`=%d AND `meta_key`=%s AND `meta_value` != '' ", $this->id, self::ERROR_LOG )  );
	}

	/**
	 * Retrieve logs
	 **/
	function get_error_log() {
		return array_map( "json_decode", $this->_wpdb->get_col( $this->_wpdb->prepare( "SELECT `meta_value` FROM " . $this->get_meta_table()  . " WHERE `meta_key`=%s AND `module_id`=%d AND `meta_value` != '' ",
			self::ERROR_LOG,
			$this->id
		)));
	}

	/**
	 * Clear error logs.
	 **/
	function clear_error_log() {
		$this->_wpdb->query( $this->_wpdb->prepare( "DELETE FROM " . $this->get_meta_table() . " WHERE `meta_key`=%s AND `module_id`=%d", self::ERROR_LOG, $this->id ) );
	}

	/**
	 * Adds new subscription to the local collection
	 *
	 * @since 1.1.0
	 * @param array $data
	 * @return bool
	 */
	function add_local_subscription(array $data ){
		if( !$this->has_subscribed( $data['email'] ) )
			return $this->add_meta( self::SUBSCRIPTION, json_encode( $data ) );

		return new WP_Error("email_already_added", __("This email address has already subscribed.", Opt_In::TEXT_DOMAIN));
	}

	function has_subscribed( $email ){
		$email_like = '%"' . $email .'"%';
		$sql = $this->_wpdb->prepare( "SELECT `meta_id` FROM " . $this->get_meta_table() . " WHERE `module_id`=%d AND `meta_key`=%s AND `meta_value`  LIKE %s ", $this->id, self::SUBSCRIPTION, $email_like  );
		return $this->_wpdb->get_var( $sql);
	}

	/**
	 * Returns locally collected subscriptions saved to the local collection
	 *
	 * @return array
	 */
	function get_local_subscriptions(){

		return array_map( "json_decode", $this->_wpdb->get_col( $this->_wpdb->prepare( "SELECT `meta_value` FROM " . $this->get_meta_table()  . " WHERE `meta_key`=%s AND `module_id`=%d AND `meta_value` != '' ",
			self::SUBSCRIPTION,
			$this->id
		)));
	}

	/**
	 * Returns total conversion count
	 *
	 * @return int
	 */
	function get_total_subscriptions(){
		return (int) $this->_wpdb->get_var( $this->_wpdb->prepare( "SELECT COUNT(meta_id) FROM " . $this->get_meta_table() . " WHERE `module_id`=%d AND `meta_key`=%s AND `meta_value` != '' ", $this->id, self::SUBSCRIPTION )  );
	}



	/**
	 * Wheather this optin should sync with e-newsletter
	 *
	 * @since 1.1.1
	 * @return bool|null
	 */
	function get_sync_with_e_newsletter(){
		return $this->get_meta( self::SYNC_WITH_E_NEWSLETTER );
	}

	/**
	 * Toggles sync with e-newsletter
	 *
	 * @since 1.1.1
	 * @var bool $val
	 * @return false|int
	 */
	function toggle_sync_with_e_newsletter( $val = null ){
		return $this->update_meta( self::SYNC_WITH_E_NEWSLETTER, is_null( $val ) ? (int) !$this->get_sync_with_e_newsletter() : (int) $val );
	}

	/**
	 * Whether this opt-in should have double opt-in for e-newsletter or not
	 *
	 * @since 3.0
	 * @return bool|null
	 */
	function get_e_newsletter_double_opt_in(){
		return $this->get_meta( self::E_NEWSLETTER_DOUBLE_OPT_IN );
	}

	/**
	 * Toggles sync with e-newsletter
	 *
	 * @since 3.0
	 * @var bool $val
	 * @return false|int
	 */
	function toggle_e_newsletter_double_opt_in( $val = null ){
		return $this->update_meta( self::E_NEWSLETTER_DOUBLE_OPT_IN, is_null( $val ) ? (int) !$this->get_e_newsletter_double_opt_in() : (int) $val );
	}

	/**
	 * Returns e_newsletter groups
	 *
	 * @since 1.1.1
	 * @return array
	 */
	function get_e_newsletter_groups(){
		return (array) json_decode( $this->get_meta( self::E_NEWSLETTER_GROUPS ), true );
	}

	/**
	 * Sets e-newsletter groups
	 *
	 *
	 * @since 1.1.1
	 * @param array $groups
	 * @return false|int
	 */
	function set_e_newsletter_groups( array $groups = array() ){
		return $this->update_meta( self::E_NEWSLETTER_GROUPS, json_encode( $groups ) );
	}

	/**
	 * Checks if this optin has synced it's local-collection with e-newsletter before
	 * This kind of sync is usually only done when admin toggles sync on only for the first time
	 *
	 * @since 1.1.2
	 * @return bool
	 */
	function get_has_local_collection_synced_with_e_newsletter(){
		return (bool) $this->get_meta( self::HAS_LOCAL_SYNCED_WITH_E_NEWSLETTER );
	}

	/**
	 * Sets HAS_LOCAL_SYNCED_WITH_E_NEWSLETTER
	 *
	 * @since 1.1.2
	 *
	 * @param bool|true $val
	 * @return false|int
	 */
	function set_has_local_collection_synced_with_e_newsletter( $val = true ){
		return $this->update_meta( self::HAS_LOCAL_SYNCED_WITH_E_NEWSLETTER, $val );
	}

	/**
	 * Checks if this module is allowed to be displayed
	 *
	 * @return bool
	 */
	function is_allowed_to_display( $settings, $type ) {

		// if Disabled for current user type or test mode, do not display
		if ( !$this->get_display() || ($this->is_test_type_active($type) && !current_user_can('administrator')) ) {
			return false;
		}

		if ( !isset( $settings['conditions'] ) || empty( $settings['conditions'] ) ) {
			return true;
		}

		global $post;
		$conditions = $settings['conditions'];
		$skip_all_cpt = false;
		$display = true;

		if ( is_singular() ) {
			// unset not needed post_type
			if ( $post->post_type == 'post' ) {
				unset($conditions['pages']);
				$skip_all_cpt = true;
			} elseif ( $post->post_type == 'page' ) {
				unset($conditions['posts']);
				unset($conditions['categories']);
				unset($conditions['tags']);
				$skip_all_cpt = true;
			} else {
				// unset posts and pages since this is CPT
				unset($conditions['posts']);
				unset($conditions['pages']);
			}
		} else {
			if( class_exists('woocommerce') ) {
				if ( is_shop() ){
					//unset the same from pages since shop should be treated as page
					unset($conditions['posts']);
					unset($conditions['categories']);
					unset($conditions['tags']);
					$skip_all_cpt = true;
				}
			} else {
				// unset posts and pages
				unset($conditions['posts']);
				unset($conditions['pages']);
				$skip_all_cpt = true;
			}
			// unset not needed taxonomy
			if ( is_category() ) {
				unset($conditions['tags']);
			}
			if ( is_tag() ) {
				unset($conditions['categories']);
			}
		}

		// $display is TRUE if all conditions were met
		foreach ($conditions as $condition_key => $args) {
			// only cpt have 'post_type' and 'post_type_label' properties
			if ( is_array($args) && isset($args['post_type']) && isset($args['post_type_label']) ) {

				// skip ms_invoice
				if ( $args['post_type'] === 'ms_invoice' ) {
					continue;
				}

				// handle ms_membership
				if ( $args['post_type'] === 'ms_membership' ) {
					// do nothing so this will went through
				} else if ( $skip_all_cpt || $post->post_type != $args['post_type'] ) {
					continue;
				}

				$condition = Hustle_Condition_Factory::build('cpt', $args);

			} else {
				$condition = Hustle_Condition_Factory::build($condition_key, $args);
			}
			if ( $condition ) {
				$condition->set_type($type);
				$display = ( $display && $condition->is_allowed($this) );
			}
		}

		return $display;
	}

	/**
	 * Returns array of active conditions objects
	 *
	 * @param $type
	 * @return array
	 */
	function get_obj_conditions( $settings ){
		$conditions = array();
		// defaults
		$_conditions = array(
			'posts' => array(),
			'pages' => array(),
			'categories' => array(),
			'tags' => array()
		);

		if ( !isset( $settings['conditions'] ) ) {
			return $conditions;
		}

		$_conditions = wp_parse_args( $settings['conditions'], $_conditions );

		if ( isset($_conditions['scalar']) ) {
			unset($_conditions['scalar']);
		}

		if( !empty( $_conditions ) ){
			foreach( $_conditions as $condition_key => $args ){
				// only cpt have 'post_type' and 'post_type_label' properties
				if ( is_array($args) && isset($args['post_type']) && isset($args['post_type_label']) ) {
					$conditions[$condition_key] = Hustle_Condition_Factory::build( 'cpt', $args );
				} else {
					$conditions[$condition_key] = Hustle_Condition_Factory::build( $condition_key, $args );
				}
				if( $conditions[$condition_key] ) $conditions[$condition_key]->set_type( $this->module_type );
			}
		}

		return $conditions;
	}
}