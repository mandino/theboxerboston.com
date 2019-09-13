<?php

if ( ! class_exists( 'Hustle_SShare_Admin' ) ) :

	class Hustle_SShare_Admin extends Hustle_Admin_Page_Abstract {

		protected function init() {

			$this->has_wizard_page = true;

			$this->module_type = Hustle_Module_Model::SOCIAL_SHARING_MODULE;

			$this->page_title = Opt_In_Utils::get_module_type_display_name( $this->module_type, false, true );

			$this->page_template_path = '/admin/sshare/listing';
			$this->page_edit_template_path = '/admin/sshare/wizard';
		}

		/**
		 * Get the args for the wizard page.
		 * 
		 * @since 4.0.1
		 * @return array
		 */
		protected function get_page_edit_template_args() {

			$module_id = filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT );
			$current_section = Hustle_Module_Admin::get_current_section();
			$module = Hustle_Module_Collection::instance()->return_model_from_id( $module_id );

			return array(
				'section' => ( ! $current_section ) ? 'services' : $current_section,
				'module_id' => $module_id,
				'module' => $module,
				'is_active' => is_object( $module ) ? (bool) $module->active : false,
			);
		}
	}

endif;
