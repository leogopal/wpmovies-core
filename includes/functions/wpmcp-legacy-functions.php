<?php
/**
 * WPMoviesCore Legacy functions.
 * 
 * Deal with old WordPress/WPMoviesCore versions.
 * 
 * @since     1.3
 * 
 * @package   WPMoviesCore
 * @author    Leo Gopal <charlie.merland@gmail.com>
 * @license   GPL-3.0
 * @link      http://digitlab.co.za
 * @copyright 2018 Leo Gopal
 */

if ( ! defined( 'ABSPATH' ) )
	exit;


/**
 * Simple function to check WordPress version. This is mainly
 * used for styling as WP3.8 introduced a brand new dashboard
 * look n feel.
 *
 * @since    1.0
 *
 * @return   boolean    Older/newer than WordPress 3.8?
 */
function wpmcp_modern_wp() {
	return version_compare( get_bloginfo( 'version' ), '3.8', '>=' );
}

/**
 * Simple function to check for deprecated movie metadata. Prior to version 1.3
 * metadata are stored in a unique meta field and must be converted to be used
 * in latest versions.
 *
 * @since    2.0
 *
 * @return   boolean    Deprecated meta?
 */
function wpmcp_has_deprecated_meta( $post_id = null ) {

	if ( ! is_null( $post_id ) && class_exists( 'WPMCP_Legacy' ) )
		return WPMCP_Legacy::has_deprecated_meta( $post_id );

	// Option not set, simultate deprecated to update counter
	$deprecated = get_option( 'wpmcp_has_deprecated_meta' );
	if ( false === $deprecated )
		return true;

	// transient set but count to 0 means we don't do anything
	$deprecated = ( '0' == $deprecated ? false : true );

	return $deprecated;
}