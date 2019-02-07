<?php

if ( !class_exists ('Opt_In_E_Newsletter', false ) ) {
	class Opt_In_E_Newsletter {

		/**
		 * @var $_email_newsletter Email_Newsletter
		 */
		private $_email_newsletter;

		/**
		 * @var $_email_builder Email_Newsletter_Builder
		 */
		private $_email_builder;

		public function __construct(){
			global $email_newsletter, $email_builder;
			$this->_email_builder = $email_builder;
			$this->_email_newsletter = $email_newsletter;

			add_action("enewsletter_create_update_member_user", array( $this, "optin_member_from_e_newsletter" ), 10 );
		}

		/**
		 * Subscribes to E-Newsletter
		 *
		 *
		 * @param array $data
		 * @param array $groups
		 * @param int $subscribe
		 *
		 * @since 1.1.1
		 * @return array
		 */
		public function subscribe( array $data,  array $groups = array(), $subscribe = 1 ){
			$data['is_hustle'] = true;
			$e_newsletter = $this->_email_newsletter;

			if( !$this->is_member( $data['member_email'] ) ){
				$insert_data = $e_newsletter->create_update_member_user( "",  $data, $subscribe );

				if( isset( $insert_data['results'] ) && in_array( "member_inserted", (array) $insert_data['results'] )  ) {
					$e_newsletter->add_members_to_groups( $insert_data['member_id'], $groups );

					if( isset( $e_newsletter->settings['subscribe_newsletter'] ) && $e_newsletter->settings['subscribe_newsletter'] ) {
						$send_details = $e_newsletter->add_send_email_info( $e_newsletter->settings['subscribe_newsletter'], $insert_data['member_id'], 0, 'waiting_send' );
						$e_newsletter->send_email_to_member($send_details['send_id']);
					}

					//$subscribe parameter was always equals to 1 before. It was added only to be 0 when double opt-in is enabled
					if ( !$subscribe ){
						$status = $e_newsletter->do_double_opt_in( $insert_data['member_id'] );
					}
				}
			}

			return new WP_Error("member_exists", __("Member exists", Opt_In::TEXT_DOMAIN), $data);
		}

		/**
		 * Checks if E-Newsletter plugin is active
		 *
		 * @since 1.1.1
		 * @return bool
		 */
		function is_plugin_active(){
			return class_exists( 'Email_Newsletter' ) && isset( $this->_email_newsletter ) && isset( $this->_email_builder );
		}

		/**
		 * Returns groups
		 *
		 * @since 1.1.1
		 * @return array
		 */
		function get_groups(){
			return (array) $this->_email_newsletter->get_groups();
		}

		/**
		 * Returns member data from member_id
		 *
		 * @since 1.1.1
		 *
		 * @param $member_id
		 * @return array
		 */
		function get_member_data( $member_id ){
			$data =  $this->_email_newsletter->get_member( $member_id );
			return $data === 0 ? array() : (array) $data;
		}

		/**
		 * Checks if member with given email already exits
		 *
		 *
		 * @since 1.1.1
		 *
		 * @param $email
		 * @return bool
		 */
		function is_member( $email ){
			$member = $this->_email_newsletter->get_member_by_email( $email );
			return !!$member;
		}


		/**
		 * Returns member groups
		 *
		 * @param $member_id
		 * @return array
		 */
		function get_memeber_groups( $member_id ){
			return (array) $this->_email_newsletter->get_memeber_groups( $member_id );
		}

		/**
		 * Optin member from e-newsletter
		 *
		 * @since 1.1.1
		 *
		 * @action enewsletter_after_user_add
		 * @param $member_data
		 */
		function optin_member_from_e_newsletter( $member_data ){

			/**
			 * Make sure member is actually inserted
			 */
			if( !isset( $member_data['results'] ) || !in_array( "member_inserted", (array) $member_data['results'] )  ) return;

			if( isset( $member_data['is_hustle'] ) && $member_data['is_hustle']  ) return;


			$modules = Hustle_Module_Collection::instance()->get_all(true, array(
				'except_types' => array( 'social_sharing' )
			));
			if( $modules === array() ) return;

			/**
			 * @var $module Hustle_Module_Model
			 */
			foreach( $modules as $module ){
				/**
				 * Add subscriber to Hustle if
				 * 1) sync is active
				 * 2) Either sync groups are empty or they have common members with the member groups
				 */
				$module_enews_groups = $module->get_e_newsletter_groups();
				if( $module->sync_with_e_newsletter && ( array() === $module_enews_groups || !isset( $_REQUEST['e_newsletter_groups_id'] ) || array() !== array_intersect( $module_enews_groups, (array) $_REQUEST['e_newsletter_groups_id'] ) ) ){

					$data = array(
						"email" => $member_data['member_email'],
						"l_name" => $member_data['member_lname'],
						"f_name" => $member_data['member_fname'],
						"optin_type" => "e-newsletter",
						"time" => current_time("timestamp")
					);

					if( $module->save_to_collection )
						$module->add_local_subscription( $data );

					if( $module->optin_provider ){
						unset( $data['optin_type'] );
						unset( $data['time'] );
						$provider = Opt_In::get_provider_by_id( $module->optin_provider );
						$provider = Opt_In::provider_instance( $provider );

						$provider->subscribe( $module, $data );
					}

				}
			}
		}

		/**
		 * Subscribes $modules's subscribers to e-newsletter
		 *
		 * @since 1.1.2
		 *
		 * @param Hustle_Module_Model $module
		 * @param array $groups
		 */
		function sync_with_current_local_collection( Hustle_Module_Model $module, $groups = array() ){

			$groups = array() === $groups ?  $module->get_e_newsletter_groups() : $groups;

			foreach( $module->get_local_subscriptions() as $subscription ){

				if( isset( $subscription->optin_type  ) && "e-newsletter"  === $subscription->optin_type  ) return;

				$data = array(
					"is_hustle" => true,
					"member_email" => $subscription->email,
					"member_fname" => isset( $subscription->f_name ) ? $subscription->f_name : "",
					"member_lname" => isset( $subscription->l_name ) ? $subscription->l_name : ""
				);

				$insert_data = $this->_email_newsletter->create_update_member_user( "",  $data, 1 );

				if( isset( $insert_data['results'] ) && in_array( "member_inserted", (array) $insert_data['results'] )  )
					$this->_email_newsletter->add_members_to_groups( $insert_data['member_id'],  $groups );
			}

		}

	}
}