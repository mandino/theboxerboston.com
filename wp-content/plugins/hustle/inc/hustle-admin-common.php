<?php
if ( ! class_exists( 'Hustle_Admin_Common' ) ) :
	/**
	 * Class Hustle_Module_Admin
	 */
	abstract class Hustle_Admin_Common {

		/**
	 * @var Opt_In
	 */
		protected $_hustle;

		/**
		 * Page slug
		 *
		 * @since 4.0.0
		 */
		protected $page_slug;

		public function __construct( Opt_In $hustle ) {
			$this->_hustle = $hustle;
		}

		/**
		 * Common hooks for all screens
		 *
		 * @since 4.0.0
		 */
		public function add_action_hooks() {
			// Filter built-in wpmudev branding script.
			add_filter( 'wpmudev_whitelabel_plugin_pages', array( $this, 'builtin_wpmudev_branding' ) );
		}

		/**
		 * Add more pages to builtin wpmudev branding.
		 *
		 * @since 4.0.0
		 *
		 * @param array $plugin_pages Nextgen pages is not introduced in built in wpmudev branding.
		 *
		 * @return array
		 */
		public function builtin_wpmudev_branding( $plugin_pages ) {
			$plugin_pages[ $this->page_slug ] = array(
				'wpmudev_whitelabel_sui_plugins_footer',
				'wpmudev_whitelabel_sui_plugins_doc_links',
			);
			return $plugin_pages;
		}
	}

endif;
