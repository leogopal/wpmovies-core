<?php
/**
 * WPMoviesCore Settings Class extension.
 * 
 * Manage WPMoviesCore settings
 *
 * @package   WPMoviesCore
 * @author    Leo Gopal <leo@digitlab.co.za>
 * @license   GPL-3.0
 * @link      http://digitlab.co.za
 * @copyright 2018 Leo Gopal
 */

require_once( WPMCP_PATH . 'includes/wpmcp-config.php' );

if ( ! class_exists( 'WPMCP_Settings' ) ) :

	/**
	 * WPMOLY Settings class
	 *
	 * @package WPMoviesCore
	 * @author  Leo Gopal <leo@digitlab.co.za>
	 */
	class WPMCP_Settings extends WPMCP_Module {

		/**
		 * Constructor
		 *
		 * @since    1.0
		 */
		public function __construct() {

			$this->init();
		}

		/**
		 * Magic!
		 * 
		 * @since    2.0
		 * 
		 * @param    string    $name Called method name
		 * @param    array     $arguments Called method arguments
		 * 
		 * @return   mixed    Callback function return value
		 */
		public static function __callStatic( $name, $arguments ) {

			if ( false !== strpos( $name, 'get_available_movie_' ) ) {
				$name = str_replace( 'get_available_movie_', '', $name );
				return call_user_func( __CLASS__ . '::get_movie_details', $name );
			}

			if ( false !== strpos( $name, 'get_default_movie_' ) ) {
				$name = str_replace( 'get_default_movie_', '', $name );
				return call_user_func( __CLASS__ . '::get_movie_details_default', $name );
			}
		}

		/**
		 * Return the plugin settings.
		 *
		 * @since    1.0
		 *
		 * @return   array    Plugin Settings
		 */
		public static function get_settings() {

			global $wpmcp_settings;

			if ( is_null( $wpmcp_settings ) )
				$wpmcp_settings = get_option( 'wpmcp_settings' );

			return $wpmcp_settings;
		}

		/** * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
		 *
		 *                         Hooks setup
		 *
		 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

		private static function get_config() {

			global $wpmcp_config;

			$wpmcp_config = apply_filters( 'wpmcp_filter_config', $wpmcp_config );

			return $wpmcp_config;
		}

		private static function get_movie_details( $detail = null ) {

			global $wpmcp_movie_details;

			if ( is_null( $wpmcp_movie_details ) )
				require WPMCP_PATH . 'includes/config/wpmcp-movies.php';

			/**
			 * Filter the Details list to add/remove details.
			 *
			 * This should be used through Plugins to create additionnal
			 * details or edit existing.
			 *
			 * @since    2.0
			 *
			 * @param    array    $wpmcp_movie_details Existing details
			 */
			$details = apply_filters( 'wpmcp_pre_filter_details', $wpmcp_movie_details );

			if ( ! is_null( $detail ) && isset( $details[ "movie_{$detail}" ] ) ) {
				$details = apply_filters( "wpmcp_filter_detail_{$detail}", $details[ "movie_{$detail}" ]['options'] );
			} else {
				foreach ( $details as $slug => $data ) {
					if ( 'select' == $data['type'] && ! empty( $data['options'] ) ) {
						$details[ $slug ]['options'] = apply_filters( "wpmcp_filter_detail_{$slug}", $data['options'] );
					}
				}
			}

			/**
			 * Filter the Details list to add/remove details.
			 *
			 * This should be used through Plugins to create additionnal
			 * details or edit existing.
			 *
			 * @since    2.0
			 *
			 * @param    array    $wpmcp_movie_details Existing details
			 */
			$_details = apply_filters( 'wpmcp_filter_details', $details );

			if ( ! is_null( $detail ) )
				return $details[ $detail ]['options'];

			return $details;
		}

		/**
		 * Return the default value for a specitif Movie Detail
		 *
		 * @since    2.0
		 * 
		 * @param    string    $detail
		 *
		 * @return   array    WPMOLY Movie details default value.
		 */
		private static function get_movie_details_default( $detail ) {

			$_detail = self::get_movie_details( $detail );
			$default = $_detail['default'];

			return $default;
		}

		/**
		 * Return all available shortcodes
		 *
		 * @since    1.1
		 *
		 * @return   array    Available shortcodes
		 */
		public static function get_available_shortcodes() {

			global $wpmcp_shortcodes;

			/**
			 * Filter the Shortcodes list to add/remove shortcodes.
			 *
			 * This should be used through Plugins to create additionnal
			 * Shortcodes.
			 *
			 * @since    1.2
			 *
			 * @param    array    $wpmcp_shortcodes Existing Shortcodes
			 */
			$wpmcp_shortcodes = apply_filters( 'wpmcp_filter_shortcodes', $wpmcp_shortcodes );

			return $wpmcp_shortcodes;
		}

		/**
		 * Return all supported language names for translation
		 *
		 * @since    2.0
		 *
		 * @return   array    Available languages
		 */
		public static function get_available_languages() {

			global $wpmcp_languages;

			/**
			 * Filter the Languages list to add/remove shortcodes.
			 *
			 * This should be used through Plugins to create additionnal
			 * Languages.
			 *
			 * @since    1.2
			 *
			 * @param    array    $wpmcp_languages Existing languages
			 */
			$wpmcp_languages = apply_filters( 'wpmcp_filter_languages', $wpmcp_languages );

			return $wpmcp_languages;
		}

		/**
		 * Return a limited number of language names supported by TMDb API
		 *
		 * @since    2.0
		 *
		 * @return   array    Supported languages
		 */
		public static function get_supported_languages() {

			global $wpmcp_supported_languages;

			/**
			 * Filter the supported languages list to add/remove languages.
			 *
			 * This should be used through Plugins to add additionnal
			 * languages.
			 *
			 * @since    2.0
			 *
			 * @param    array    $wpmcp_supported_languages Existing languages
			 */
			$wpmcp_supported_languages = apply_filters( 'wpmcp_filter_supported_languages', $wpmcp_supported_languages );

			return $wpmcp_supported_languages;
		}

		/**
		 * Return all available country names for translation
		 *
		 * @since    2.0
		 *
		 * @return   array    Supported 
		 */
		public static function get_supported_countries() {

			global $wpmcp_countries;

			/**
			 * Filter the supported country names list to add/remove countries.
			 *
			 * This should be used through Plugins to add additionnal
			 * countries.
			 *
			 * @since    2.0
			 *
			 * @param    array    $wpmcp_countries Existing countries
			 */
			$wpmcp_countries = apply_filters( 'wpmcp_filter_countries', $wpmcp_countries );

			return $wpmcp_countries;
		}

		/**
		 * Return Available Movie tags
		 *
		 * @since    2.1
		 *
		 * @return   array    WPMOLY Panels
		 */
		public static function get_available_movie_tags() {

			global $wpmcp_tags;

			/**
			 * Filter the available movie tags
			 *
			 * @since    2.1
			 *
			 * @param    array    $wpmcp_tags Existing Panels
			 */
			$wpmcp_tags = apply_filters( 'wpmcp_filter_movie_tags', $wpmcp_tags );

			return $wpmcp_tags;
		}

		/**
		 * Return Admin Menu config array data
		 *
		 * @since    2.0
		 *
		 * @return   array    WPMOLY Admin Menu array
		 */
		public static function get_admin_menu() {

			global $wpmcp_admin_menu;

			/**
			 * Filter the Admin menu list to edit/add/remove subpages.
			 *
			 * This should be used through Plugins to create additionnal
			 * subpages.
			 *
			 * @since    2.0
			 *
			 * @param    array    $wpmcp_admin_menu Admin menu
			 */
			$wpmcp_admin_menu = apply_filters( 'wpmcp_filter_admin_menu', $wpmcp_admin_menu );

			return $wpmcp_admin_menu;
		}

		/**
		 * Return Admin Bar Menu config array data
		 *
		 * @since    2.0
		 *
		 * @return   array    WPMOLY Admin Bar Menu array
		 */
		public static function get_admin_bar_menu() {

			global $wpmcp_admin_bar_menu;

			/**
			 * Filter the Admin menu list before permission check.
			 *
			 * This should be used through Plugins to create additionnal
			 * subpages.
			 *
			 * @since    2.0
			 *
			 * @param    array    $wpmcp_admin_menu Admin menu
			 */
			$wpmcp_admin_bar_menu = apply_filters( 'wpmcp_pre_filter_admin_bar_menu', $wpmcp_admin_bar_menu );

			$submenu = array();
			foreach ( $wpmcp_admin_bar_menu['submenu'] as $key => $item ) {
				if ( ! empty( $item['capability'] ) && current_user_can( $item['capability'] ) ) {
					$submenu[ $key ] = $item;
				}
			}

			$wpmcp_admin_bar_menu['submenu'] = $submenu;

			/**
			 * Filter the Admin menu list to edit/add/remove subpages.
			 *
			 * This should be used through Plugins to create additionnal
			 * subpages.
			 *
			 * @since    2.0
			 *
			 * @param    array    $wpmcp_admin_menu Admin menu
			 */
			$wpmcp_admin_bar_menu = apply_filters( 'wpmcp_filter_admin_bar_menu', $wpmcp_admin_bar_menu );

			return $wpmcp_admin_bar_menu;
		}

		/** * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
		 *
		 *                         Accessors
		 *
		 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

		/**
		 * Load default settings.
		 * 
		 * @since    1.0
		 * 
		 * @param    boolean    $minify Should we return only default values?
		 *
		 * @return   array      The Plugin Settings
		 */
		public static function get_default_settings( $minify = false ) {

			$wpmcp_config = self::get_config();

			if ( true !== $minify )
				return $wpmcp_config;

			$defauts = array();
			foreach ( $wpmcp_config as $section ) {
				if ( isset( $section['fields'] ) ) {
					foreach ( $section['fields'] as $slug => $field ) {
						if ( 'sorter' == $field['type'] )
							$defauts[ $slug ] = $field['used'];
						else
							$defauts[ $slug ] = $field['default'];
					}
				}
			}

			return $defauts;
		}

		/**
		 * General settings accessor
		 *
		 * @since    1.0
		 * 
		 * @param    string        $setting Requested setting slug
		 * 
		 * @return   mixed         Requested setting
		 */
		public static function get( $setting = '', $default = false ) {

			$wpmcp_settings = self::get_settings();

			$shorter = str_replace( 'wpmcp-', '', $setting );
			if ( isset( $wpmcp_settings[ $shorter ] ) )
				return $wpmcp_settings[ $shorter ];

			$longer = "wpmcp-$setting";
			if ( isset( $wpmcp_settings[ $longer ] ) )
				return $wpmcp_settings[ $longer ];

			if ( isset( $wpmcp_settings[ $setting ] ) )
				return $wpmcp_settings[ $setting ];

			return $default;
		}

		/**
		 * Return all supported Movie Details fields
		 *
		 * @since    1.0
		 *
		 * @return   array    WPMOLY Supported Movie Details fields.
		 */
		public static function get_supported_movie_details() {

			$wpmcp_movie_details = self::get_movie_details();

			return $wpmcp_movie_details;
		}

		/**
		 * Return all supported Movie Meta fields
		 *
		 * @since    1.0
		 *
		 * @return   array    WPMOLY Supported Movie Meta fields.
		 */
		public static function get_supported_movie_meta( $type = null ) {

			global $wpmcp_movie_meta;

			if ( is_null( $wpmcp_movie_meta ) )
				require WPMCP_PATH . 'includes/config/wpmcp-movies.php';

			if ( ! is_null( $type ) ) {
				$meta = array();
				foreach ( $wpmcp_movie_meta as $slug => $data )
					if ( $data['group'] == $type )
						$meta[ $slug ] = $data;

				return $meta;
			}

			return $wpmcp_movie_meta;
		}

		/**
		 * Return all supported Shortcodes aliases
		 *
		 * @since    1.1
		 *
		 * @return   array    WPMOLY Supported Shortcodes aliases.
		 */
		public static function get_supported_movie_meta_aliases() {

			global $wpmcp_movie_meta_aliases;

			return $wpmcp_movie_meta_aliases;
		}

		/**
		 * Delete stored settings.
		 * 
		 * This is irreversible, but shouldn't be used anywhere else than
		 * when uninstalling the plugin.
		 * 
		 * @since    1.0
		 */
		public static function clean_settings() {

			delete_option( 'wpmcp_settings' );
		}

		/**
		 * Update WPMOLY 1.x Settings to ReduxFramework.
		 * 
		 * @since    2.0
		 */
		public static function update_1x_settings() {

			global $legacy_config;

			if ( is_null( $legacy_config ) )
				require WPMCP_PATH . 'includes/config/wpmcp-settings.php';

			if ( is_null( $legacy_config ) )
				return false;

			$new_settings = array();
			$old_settings = get_option( 'wpml_settings' );
			$cur_settings = get_option( 'wpmcp_settings', array() );
			if ( ! $old_settings )
				return false;

			foreach ( $legacy_config as $slug => $section )
				foreach ( $section as $setting => $match )
					if ( isset( $old_settings[ $slug ][ $setting ] ) )
						$new_settings[ $match ] = $old_settings[ $slug ][ $setting ];

			$cur_settings = wp_parse_args( $cur_settings, $new_settings );
			$cur_settings = update_option( 'wpmcp_settings', $cur_settings );

			delete_option( 'wpml_settings' );
		}

		/**
		 * Prepares sites to use the plugin during single or network-wide activation
		 *
		 * @since    1.0
		 *
		 * @param    bool    $network_wide
		 */
		public function activate( $network_wide ) {

			self::update_1x_settings();
		}

		/**
		 * Rolls back activation procedures when de-activating the plugin
		 *
		 * @since    1.0
		 */
		public function deactivate() {}

		/**
		 * Set the uninstallation instructions
		 *
		 * @since    1.0
		 */
		public static function uninstall() {

			self::clean_settings();
		}

		/**
		 * Initializes variables
		 *
		 * @since    1.0
		 */
		public function init() {}

		/**
		 * Register callbacks for actions and filters
		 * 
		 * @since    1.0
		 */
		public function register_hook_callbacks() {}

	}

endif;

/**
 * General settings accessor
 *
 * @since    2.0
 * 
 * @param    string        $setting Requested setting slug
 * 
 * @return   mixed         Requested setting
 */
function wpmcp_o( $search, $default = false ) {

	return WPMCP_Settings::get( $search, $default );
}