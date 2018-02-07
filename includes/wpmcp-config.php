<?php
/**
 * WPMoviesCore Default Config
 *
 * @package   WPMoviesCore
 * @author    Leo Gopal <leo@digitlab.co.za>
 * @license   GPL-3.0
 * @link      http://digitlab.co.za
 * @copyright 2016 Leo Gopal
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) )
	wp_die();

require_once WPMCP_PATH . '/includes/l10n/wpmcp-languages.php';
require_once WPMCP_PATH . '/includes/config/wpmcp-settings.php';
require_once WPMCP_PATH . '/includes/config/wpmcp-movies.php';
require_once WPMCP_PATH . '/includes/config/wpmcp-admin-bar-menu.php';

if ( is_admin() ) {
	require_once WPMCP_PATH . '/includes/config/wpmcp-admin-menu.php';
	require_once WPMCP_PATH . '/includes/config/wpmcp-admin-dashboard.php';
}

