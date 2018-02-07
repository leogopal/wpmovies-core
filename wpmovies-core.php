<?php
/**
 * WordPress Movies Core Plugin
 *
 * WPMCP is a WordPress Plugin designed to handle a library of movies
 * WPMCP uses TMDb to gather movies' informations.
 *
 * @package   WPMoviesCore
 * @author    Leo Gopal <leo@digitlab.co.za>
 * @license   GPL-3.0
 * @link      http://www.digitlab.co.za/
 * @copyright 2018 Leo Gopal
 *
 * @wordpress-plugin
 * Plugin Name: WPMoviesCore
 * Plugin URI:  https://github.com/leogopal/wpmovies-core
 * Description: A WordPress Plugin to manage a movie database.
 * Version:     0.0.1
 * Author:      Leo Gopal
 * Author URI:  https://leogopal.com
 * Text Domain: wpmoviescore
 * License:     GPL-3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /languages
 * GitHub Plugin URI: https://github.com/leogopal/wpmovies-core
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'WPMCP_PLUGIN',                 plugin_basename( __FILE__ ) );
define( 'WPMCP_NAME',                   'WPMoviesCore' );
define( 'WPMCP_VERSION',                '0.0.1' );
define( 'WPMCP_SLUG',                   'wpmcp' );
define( 'WPMCP_URL',                    plugins_url( basename( __DIR__ ) ) );
define( 'WPMCP_PATH',                   plugin_dir_path( __FILE__ ) );
define( 'WPMCP_REQUIRED_PHP_VERSION',   '5.3' );
define( 'WPMCP_REQUIRED_WP_VERSION',    '4.2' );
define( 'WPMCP_DEFAULT_POSTER_URL',     plugins_url( basename( __DIR__ ) ) . '/assets/img/no_poster{size}.jpg' );
define( 'WPMCP_DEFAULT_POSTER_PATH',    WPMCP_PATH . '/assets/img/no_poster{size}.jpg' );
define( 'WPMCP_MAX_TAXONOMY_LIST',      50 );



/**
 * Checks if the system requirements are met
 *
 * @since    1.0.1
 *
 * @return   bool    True if system requirements are met, false if not
 */
function wpmcp_requirements_met() {

	global $wp_version;

	if ( version_compare( PHP_VERSION, WPMCP_REQUIRED_PHP_VERSION, '<' ) )
		return false;

	if ( version_compare( $wp_version, WPMCP_REQUIRED_WP_VERSION, '<' ) )
		return false;

	return true;
}

/**
 * Prints an error that the system requirements weren't met.
 *
 * @since    1.0.1
 */
function wpmcp_requirements_error() {
	global $wp_version;

	require_once WPMCP_PATH . 'views/admin/requirements-error.php';
}

/**
 * Prints an error that the system requirements weren't met.
 *
 * @since    1.0.1
 */
function wpmcp_l10n() {

	$domain = 'wpmoviescore';
	$domain_iso = 'wpmoviescore-iso';
	$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
	$locale_iso = apply_filters( 'plugin_locale', get_locale(), $domain_iso );

	load_textdomain( $domain, WPMCP_PATH . $domain . '/languages/'. $domain . '-' . $locale . '.mo' );
	load_textdomain( $domain_iso, WPMCP_PATH . $domain . '/languages/'. $domain_iso . '-' . $locale . '.mo' );
	load_plugin_textdomain( $domain, FALSE, basename( __DIR__ ) . '/languages/' );
	load_plugin_textdomain( $domain_iso, FALSE, basename( __DIR__ ) . '/languages/' );
}

wpmcp_l10n();

/*
 * Check requirements and load main class
 * The main program needs to be in a separate file that only gets loaded if the
 * plugin requirements are met. Otherwise older PHP installations could crash
 * when trying to parse it.
 */
if ( wpmcp_requirements_met() ) {

	/*----------------------------------------------------------------------------*
	 * Public-Facing Functionality
	 *----------------------------------------------------------------------------*/

	// Core
	require_once( WPMCP_PATH . 'includes/functions/wpmcp-core-functions.php' );
	require_once( WPMCP_PATH . 'includes/classes/class-module.php' );
	require_once( WPMCP_PATH . 'public/class-wpmoviescore.php' );

	// Basics
	require_once( WPMCP_PATH . 'includes/classes/class-wpmcp-settings.php' );
	if ( ! class_exists( 'ReduxFramework' ) )
		require_once( WPMCP_PATH . 'includes/framework/redux/ReduxCore/framework.php' );
	if ( ! isset( $wpmcp_settings ) )
		require_once( WPMCP_PATH . 'includes/classes/class-wpmcp-redux.php' );
	//require_once( WPMCP_PATH . 'includes/framework/redux/sample-config.php' );
	require_once( WPMCP_PATH . 'includes/classes/class-wpmcp-cache.php' );
	require_once( WPMCP_PATH . 'includes/classes/class-wpmcp-l10n.php' );
	require_once( WPMCP_PATH . 'includes/classes/class-wpmcp-utils.php' );

	// CPT and Taxo
	require_once( WPMCP_PATH . 'public/class-wpmcp-movies.php' );
	require_once( WPMCP_PATH . 'public/class-wpmcp-headbox.php' );
	require_once( WPMCP_PATH . 'public/class-wpmcp-grid.php' );
	require_once( WPMCP_PATH . 'public/class-wpmcp-search.php' );
	require_once( WPMCP_PATH . 'public/class-wpmcp-collections.php' );
	require_once( WPMCP_PATH . 'public/class-wpmcp-genres.php' );
	require_once( WPMCP_PATH . 'public/class-wpmcp-actors.php' );
	require_once( WPMCP_PATH . 'public/class-wpmcp-archives.php' );

	// Self-speaking
	require_once( WPMCP_PATH . 'public/class-wpmcp-shortcodes.php' );

	// Widgets
	require_once( WPMCP_PATH . 'includes/classes/class-wpmcp-widget.php' );
	require_once( WPMCP_PATH . 'includes/widgets/class-statistics-widget.php' );
	require_once( WPMCP_PATH . 'includes/widgets/class-taxonomies-widget.php' );
	require_once( WPMCP_PATH . 'includes/widgets/class-details-widget.php' );
	require_once( WPMCP_PATH . 'includes/widgets/class-movies-widget.php' );

	// Legacy
	require_once( WPMCP_PATH . 'includes/classes/legacy/class-wpmcp-legacy.php' );

	/*
	 * Register hooks that are fired when the plugin is activated or deactivated.
	 * When the plugin is deleted, the uninstall.php file is loaded.
	 */
	if ( class_exists( 'WPMoviesCore' ) ) {
		$GLOBALS['wpmcp'] = WPMoviesCore::get_instance();
		register_activation_hook(   __FILE__, array( $GLOBALS['wpmcp'], 'activate' ) );
		register_deactivation_hook( __FILE__, array( $GLOBALS['wpmcp'], 'deactivate' ) );
	}


	/*----------------------------------------------------------------------------*
	 * Dashboard and Administrative Functionality
	 *----------------------------------------------------------------------------*/

	/*
	 * The code below is intended to to give the lightest footprint possible.
	 */
	if ( is_admin() ) {

		require_once( WPMCP_PATH . 'includes/classes/class-wpmcp-ajax.php' );
		require_once( WPMCP_PATH . 'admin/class-wpmcp-admin.php' );
		require_once( WPMCP_PATH . 'admin/class-dashboard.php' );
		require_once( WPMCP_PATH . 'admin/class-dashboard-stats-widget.php' );
		require_once( WPMCP_PATH . 'admin/class-dashboard-latest-movies-widget.php' );
		require_once( WPMCP_PATH . 'admin/class-dashboard-most-rated-movies-widget.php' );
		require_once( WPMCP_PATH . 'admin/class-dashboard-quickaction-widget.php' );
		require_once( WPMCP_PATH . 'admin/class-dashboard-helper-widget.php' );
		require_once( WPMCP_PATH . 'admin/class-dashboard-vendor-widget.php' );
		require_once( WPMCP_PATH . 'admin/class-wpmcp-api.php' );
		require_once( WPMCP_PATH . 'admin/class-wpmcp-api-wrapper.php' );
		require_once( WPMCP_PATH . 'admin/class-wpmcp-diagnose.php' );
		require_once( WPMCP_PATH . 'admin/class-wpmcp-metaboxes.php' );
		require_once( WPMCP_PATH . 'admin/class-wpmcp-edit-movies.php' );
		require_once( WPMCP_PATH . 'admin/class-wpmcp-media.php' );
		require_once( WPMCP_PATH . 'admin/class-wpmcp-list-table.php' );
		require_once( WPMCP_PATH . 'admin/class-wpmcp-import-table.php' );
		require_once( WPMCP_PATH . 'admin/class-wpmcp-import-queue.php' );
		require_once( WPMCP_PATH . 'admin/class-wpmcp-import.php' );

		add_action( 'plugins_loaded', array( 'WPMoviesCore_Admin', 'get_instance' ) );

	}
}
else {
	add_action( 'admin_notices', 'wpmcp_requirements_error' );
}
