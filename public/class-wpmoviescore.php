<?php
/**
 * WPMoviesCore
 *
 * @package   WPMoviesCore
 * @author    Leo Gopal <leo@digitlab.co.za>
 * @license   GPL-3.0
 * @link      http://digitlab.co.za
 * @copyright 2016 Leo Gopal
 */

if ( ! class_exists( 'WPMoviesCore' ) ) :

	/**
	* Plugin class
	*
	* @package WPMoviesCore
	* @author  Leo Gopal <leo@digitlab.co.za>
	*/
	class WPMoviesCore extends WPMCP_Module {

		protected $modules;

		protected $widgets;

		/**
		 * Initialize the plugin by setting localization and loading public scripts
		 * and styles.
		 *
		 * @since    1.0
		 */
		protected function __construct() {

			$this->register_hook_callbacks();

			$this->modules = array(
				'WPMCP_Settings'    => WPMCP_Settings::get_instance(),
				'WPMCP_Cache'       => WPMCP_Cache::get_instance(),
				'WPMCP_L10n'        => WPMCP_L10n::get_instance(),
				'WPMCP_Utils'       => WPMCP_Utils::get_instance(),
				'WPMCP_Movies'      => WPMCP_Movies::get_instance(),
				'WPMCP_Headbox'     => WPMCP_Headbox::get_instance(),
				'WPMCP_Search'      => WPMCP_Search::get_instance(),
				'WPMCP_Collections' => WPMCP_Collections::get_instance(),
				'WPMCP_Genres'      => WPMCP_Genres::get_instance(),
				'WPMCP_Actors'      => WPMCP_Actors::get_instance(),
				'WPMCP_Archives'    => WPMCP_Archives::get_instance(),
				'WPMCP_Shortcodes'  => WPMCP_Shortcodes::get_instance(),
				'WPMCP_Legacy'      => WPMCP_Legacy::get_instance()
			);

			$this->widgets = array(
				'WPMCP_Statistics_Widget',
				'WPMCP_Taxonomies_Widget',
				'WPMCP_Details_Widget',
				'WPMCP_Movies_Widget'
			);

		}

		/**
		 * Register callbacks for actions and filters
		 * 
		 * @since    1.0
		 */
		public function register_hook_callbacks() {

			// Widgets
			add_action( 'widgets_init', array( $this, 'register_widgets' ) );

			// Enqueue scripts and styles
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

			// Add link to WP Admin Bar
			add_action( 'wp_before_admin_bar_render', array( $this, 'admin_bar_menu' ), 999 );
		}

		/** * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
		 *
		 *                     Plugin  Activate/Deactivate
		 * 
		 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

		/**
		 * Fired when the plugin is activated.
		 * 
		 * Restore previously converted contents. If WPMOLY was previously
		 * deactivated or uninstalled using the 'convert' option, Movies and
		 * Custom Taxonomies should still be in the database. If they are, we
		 * convert them back to WPMOLY contents.
		 * 
		 * Call Movie Custom Post Type and Collections, Genres and Actors custom
		 * Taxonomies' registering functions and flush rewrite rules to update
		 * the permalinks.
		 *
		 * @since    1.0
		 *
		 * @param    boolean    $network_wide    True if WPMU superadmin uses
		 *                                       "Network Activate" action, false if
		 *                                       WPMU is disabled or plugin is
		 *                                       activated on an individual blog.
		 */
		public function activate( $network_wide ) {

			global $wpdb;

			if ( function_exists( 'is_multisite' ) && is_multisite() ) {
				if ( $network_wide ) {
					$blogs = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );

					foreach ( $blogs as $blog ) {
						switch_to_blog( $blog );
						$this->single_activate( $network_wide );
					}

					restore_current_blog();
				} else {
					$this->single_activate( $network_wide );
				}
			} else {
				$this->single_activate( $network_wide );
			}

		}

		/**
		 * Fired when the plugin is deactivated.
		 * 
		 * When deactivatin/uninstalling WPMOLY, adopt different behaviors depending
		 * on user options. Movies and Taxonomies can be kept as they are,
		 * converted to WordPress standars or removed. Default is conserve on
		 * deactivation, convert on uninstall.
		 *
		 * @since    1.0
		 */
		public function deactivate() {

			foreach ( $this->modules as $module )
				$module->deactivate();
		}

		/**
		 * Runs activation code on a new WPMS site when it's created
		 *
		 * @since    1.0
		 *
		 * @param    int    $blog_id
		 */
		public function activate_new_site( $blog_id ) {
			switch_to_blog( $blog_id );
			$this->single_activate( true );
			restore_current_blog();
		}

		/**
		 * Prepares a single blog to use the plugin
		 *
		 * @since    1.0
		 *
		 * @param    bool    $network_wide
		 */
		protected function single_activate( $network_wide ) {

			foreach ( $this->modules as $module )
				$module->activate( $network_wide );

			flush_rewrite_rules();
		}

		/**
		 * Register and enqueue public-facing style sheet.
		 *
		 * @since    1.0
		 */
		public function enqueue_styles() {

			wp_enqueue_style( WPMCP_SLUG, WPMCP_URL . '/assets/css/public/wpmcp.css', array(), WPMCP_VERSION );
			wp_enqueue_style( WPMCP_SLUG . '-flags', WPMCP_URL . '/assets/css/public/wpmcp-flags.css', array(), WPMCP_VERSION );
			wp_enqueue_style( WPMCP_SLUG . '-font', WPMCP_URL . '/assets/fonts/wpmovielibrary/style.css', array(), WPMCP_VERSION );
		}

		/**
		 * Register and enqueue public-facing style sheet.
		 *
		 * @since    1.0
		 */
		public function enqueue_scripts() {

			wp_enqueue_script( WPMCP_SLUG, WPMCP_URL . '/assets/js/public/wpmcp.js', array( 'jquery' ), WPMCP_VERSION, true );
			wp_localize_script(
				WPMCP_SLUG, 'wpmcp',
				array(
					'lang' => array(
						'grid' => __( 'grid', 'wpmoviescore' )
					)
				)
			);
		}

		/**
		 * Register the Class Widgets
		 * 
		 * @since    1.0 
		 */
		public function register_widgets() {

			foreach ( $this->widgets as $widget )
				if ( class_exists( $widget ) )
					register_widget( $widget );
		}

		/**
		 * Add a New Movie link to WP Admin Bar.
		 * 
		 * WordPress 3.8 introduces Dashicons, for older versions we use
		 * a PNG icon instead.
		 * 
		 * This method is in the public part because the Admin Bar shows
		 * on the frontend as well, so although it is admin related this
		 * must be public.
		 *
		 * @since    1.0
		 */
		public function admin_bar_menu() {

			global $wp_admin_bar;
			$admin_bar_menu = WPMCP_Settings::get_admin_bar_menu();

			$wp_admin_bar->add_menu( $admin_bar_menu['menu'] );

			foreach ( $admin_bar_menu['submenu'] as $menu )
				if ( ! isset( $menu['condition'] ) || ( isset( $menu['condition'] ) && false != $menu['condition'] ) )
					$wp_admin_bar->add_menu( $menu );

			foreach ( $admin_bar_menu['group'] as $group )
				$wp_admin_bar->add_group( $group );
		}

		/**
		 * Uninstall the plugin, network wide.
		 *
		 * @since    1.0
		 */
		public static function uninstall() {

			global $wpdb;

			if ( function_exists( 'is_multisite' ) && is_multisite() ) {

				$blogs = $wpdb->get_col( "SELECT blog_id FROM {$wpdb->blogs}" );

				foreach ( $blogs as $blog ) {
					switch_to_blog( $blog );
					self::_uninstall();
				}

				restore_current_blog();
			}
			else {
				self::_uninstall();
			}
		}

		/**
		 * Set the uninstallation instructions
		 *
		 * @since    1.0
		 */
		private static function _uninstall() {

			WPMCP_Utils::uninstall();
			WPMCP_Movies::uninstall();
			WPMCP_Collections::uninstall();
			WPMCP_Genres::uninstall();
			WPMCP_Actors::uninstall();
			WPMCP_Settings::uninstall();
		}

		/**
		 * Initializes variables
		 *
		 * @since    1.0
		 */
		public function init() {}

	}
endif;