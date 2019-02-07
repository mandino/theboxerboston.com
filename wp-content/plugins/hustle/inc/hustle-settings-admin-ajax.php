<?php


class Hustle_Settings_Admin_Ajax
{
	private $_hustle;

	private $_admin;

	function __construct( Opt_In $hustle, Hustle_Settings_Admin $admin )
	{
		$this->_hustle = $hustle;
		$this->_admin = $admin;

		add_action("wp_ajax_inc_opt_get_enews_sync_setup", array( $this, "get_enews_sync_setup" ));
		add_action("wp_ajax_inc_opt_save_enews_sync_setup", array( $this, "save_enews_sync_setup" ));
		add_action("wp_ajax_inc_opt_toggle_enews_sync", array( $this, "toggle_enews_sync" ));
		add_action("wp_ajax_inc_opt_toggle_enews_double_optin", array( $this, "toggle_enews_double_opt_in" ));
		add_action("wp_ajax_hustle_toggle_module_for_user", array( $this, "toggle_module_for_user" ));
		add_action("wp_ajax_hustle_get_providers_edit_modal_content", array( $this, "get_providers_edit_modal_content" ));
		add_action("wp_ajax_hustle_save_providers_edit_modal", array( $this, "save_providers_edit_modal" ));
		add_action("wp_ajax_hustle_shortcode_render", array( $this, "shortcode_render" ));
	}

	/**
	 * Sends out json for sync setup box
	 *
	 * @since 1.1.1
	 */
	function get_enews_sync_setup(){
		Opt_In_Utils::validate_ajax_call("optin_sync_setup");

		$id = filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT );

		if( !$id )
			wp_send_json_error(__("Invalid Request", Opt_In::TEXT_DOMAIN));

		$module = Hustle_Module_Model::instance()->get( $id );

		if( !$module )
			wp_send_json_error(__("Invalid Request", Opt_In::TEXT_DOMAIN));

		$module_groups = $module->get_e_newsletter_groups();
		$groups = $this->_hustle->get_e_newsletter()->get_groups();

		foreach( $groups as $key => $group ){
			$groups[ $key ]['type'] = $group['public'] == "1" ? __("Public", Opt_In::TEXT_DOMAIN) : __("Private", Opt_In::TEXT_DOMAIN);

			if( in_array( $group['group_id'], $module_groups ) )
				$groups[ $key ]['selected'] = true;
			else
				$groups[ $key ]['selected'] = false;
		}

		wp_send_json_success( array(
			"optin_id" => $module->id,
			"optin_name" => $module->optin_name,
			"groups" => $groups,
			"save_nonce" => wp_create_nonce("optin_sync_save_settings")
		) );
	}

	/**
	 * Saves sync settings
	 *
	 * @since 1.1.1
	 */
	function save_enews_sync_setup(){
		Opt_In_Utils::validate_ajax_call("optin_sync_save_settings");

		$id = filter_input( INPUT_POST, 'id', FILTER_VALIDATE_INT );
		$groups = filter_input( INPUT_POST, 'groups', FILTER_DEFAULT , FILTER_REQUIRE_ARRAY );

		if( !$id )
			wp_send_json_error(__("Invalid Request", Opt_In::TEXT_DOMAIN));

		$module = Hustle_Module_Model::instance()->get( $id );

		if( !$module )
			wp_send_json_error(__("Invalid Request", Opt_In::TEXT_DOMAIN));

		$module->toggle_sync_with_e_newsletter( true );

		$this->_hustle->get_e_newsletter()->sync_with_current_local_collection( $module, $groups );

		if( $groups && is_array( $groups ) )
			$module->set_e_newsletter_groups( $groups );
		else
			$module->set_e_newsletter_groups( array() );

		wp_send_json_success( array(
			"html" => $this->_hustle->render("admin/settings/e-news-sync-front", array(
				"optins" => Opt_In_Collection::instance()->get_all_optins( null ),
				"enews_sync_state_toggle_nonce" => wp_create_nonce( "optin_sync_toggle" ),
				"enews_sync_setup_nonce" => wp_create_nonce( "optin_sync_setup" )
			), true)
		) );

	}

	/**
	 * Toggles sync ability
	 *
	 * @since 1.1.1
	 */
	function toggle_enews_sync(){
		Opt_In_Utils::validate_ajax_call("optin_sync_toggle");

		$id = filter_input( INPUT_POST, 'id', FILTER_VALIDATE_INT );
		$state = filter_input( INPUT_POST, 'state', FILTER_VALIDATE_BOOLEAN );

		if( !$id )
			wp_send_json_error(__("Invalid Request", Opt_In::TEXT_DOMAIN));

		$module = Hustle_Module_Model::instance()->get( $id );

		if( !$module )
			wp_send_json_error(__("Invalid Request", Opt_In::TEXT_DOMAIN));

		$module->toggle_sync_with_e_newsletter( $state );

		if( $state ){
			$this->_hustle->get_e_newsletter()->sync_with_current_local_collection( $module );
		} else {
			//disable double opt-in if sync is turned off
			$module->toggle_e_newsletter_double_opt_in( false );
		}

		wp_send_json_success( __("Successfully toggled", Opt_In::TEXT_DOMAIN) );
	}

	/**
	 * Toggles double opt-in ability
	 *
	 * @since 3.0
	 */
	function toggle_enews_double_opt_in(){
		Opt_In_Utils::validate_ajax_call("optin_double_optin_toggle");

		$id = filter_input( INPUT_POST, 'id', FILTER_VALIDATE_INT );
		$state = filter_input( INPUT_POST, 'state', FILTER_VALIDATE_BOOLEAN );

		if( !$id )
			wp_send_json_error(__("Invalid Request", Opt_In::TEXT_DOMAIN));

		$module = Hustle_Module_Model::instance()->get( $id );

		if( !$module )
			wp_send_json_error(__("Invalid Request", Opt_In::TEXT_DOMAIN));

		$module->toggle_e_newsletter_double_opt_in( $state );

		wp_send_json_success( __("Successfully toggled", Opt_In::TEXT_DOMAIN) );
	}

	function toggle_module_for_user(){
		Opt_In_Utils::validate_ajax_call("hustle_modules_toggle");

		$id = filter_input( INPUT_POST, 'id', FILTER_VALIDATE_INT );
		$user_type = filter_input( INPUT_POST, 'user_type', FILTER_SANITIZE_STRING );

		$module = Hustle_Module_Model::instance()->get( $id );

		$result = $module->toggle_activity_for_user( $user_type );

		if( is_wp_error( $result ) )
			wp_send_json_error( $result->get_error_messages() );

		wp_send_json_success( sprintf( __("Successfully toggled for user type %s", Opt_In::TEXT_DOMAIN), $user_type ) );
	}

	function get_providers_edit_modal_content(){
		Opt_In_Utils::validate_ajax_call("hustle_edit_providers");

		$id = filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT );
		$source = filter_input( INPUT_GET, 'source', FILTER_SANITIZE_STRING );

		if( !$id || !$source )
			wp_send_json_error(__("Invalid Request", Opt_In::TEXT_DOMAIN));


		if( $source === "optin" ){
			$module = Hustle_Module_Model::instance()->get( $id );

			$html = $this->_hustle->render("admin/settings/providers-edit-modal-content", array(
				"providers" => $this->_hustle->get_providers(),
				// "selected_provider" => $module->optin_provider,
				"optin" => $module
			), true);

			wp_send_json_success( array(
				"html" => $html,
				"provider_options_nonce" => wp_create_nonce("change_provider_name")
			) );
		}


	}

	function save_providers_edit_modal(){
		Opt_In_Utils::validate_ajax_call("hustle-edit-service-save");

		var_dump($_POST);die;
		$id = filter_input( INPUT_POST, 'id', FILTER_VALIDATE_INT );
		$source = filter_input( INPUT_POST, 'source', FILTER_SANITIZE_STRING );

		if( !$id || !$source )
			wp_send_json_error(__("Invalid Request", Opt_In::TEXT_DOMAIN));


		if( $source === "optin" ){
			$module = Hustle_Module_Model::instance()->get( $id );

			$html = $this->_hustle->render("admin/settings/providers-edit-modal-content", array(
				"providers" => $this->_hustle->get_providers(),
				// "selected_provider" => $module->optin_provider,
				"optin" => $module
			), true);

			wp_send_json_success( array(
				"html" => $html,
				"provider_options_nonce" => wp_create_nonce("change_provider_name")
			) );
		}
	}

	function shortcode_render() {
		Opt_In_Utils::validate_ajax_call("hustle_shortcode_render");

		$content = filter_input( INPUT_POST, 'content' );
		$rendered_content = apply_filters( 'the_content', $content );

		wp_send_json_success( array(
			"content" => $rendered_content
		));
	}
}