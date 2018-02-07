<?php
/**
 * WPMoviesCore Config Admin menu definition
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

$wpmcp_admin_bar_menu = array(

	'menu' => array(
		'id'    => 'wpmoviescore',
		'title' => '<span class="wpmolicon icon-wpmcp"></span>&nbsp;' . __( 'Movie Library', 'wpmoviescore' ),
		'href'  => admin_url( 'admin.php?page=wpmoviescore' )
	),

	'submenu' => array(
	
		array(
			'parent'     => 'wpmoviescore',
			'id'         => 'wpmcp-library',
			'title'      => __( 'Your movie library', 'wpmoviescore' ),
			'href'       => admin_url( 'admin.php?page=wpmoviescore' ),
			'capability' => 'read'
		),

		array(
			'parent'     => 'wpmcp-movies',
			'id'         => 'wpmcp-all-movies',
			'title'      => __( 'View all movies', 'wpmoviescore' ),
			'href'       => admin_url( 'edit.php?post_type=movie' ),
			'capability' => 'edit_posts'
		),

		array(
			'parent'     => 'wpmcp-movies',
			'id'         => 'wpmcp-new-movie',
			'title'      => __( 'Add new movie', 'wpmoviescore' ),
			'href'       => admin_url( 'post-new.php?post_type=movie' ),
			'capability' => 'publish_posts'
		),

		array(
			'parent'     => 'wpmcp-movies',
			'id'         => 'wpmcp-import-movies',
			'title'      => __( 'Import movies', 'wpmoviescore' ),
			'href'       => admin_url( 'admin.php?page=wpmoviescore-import' ),
			'capability' => 'publish_posts'
		),

		array(
			'parent'     => 'wpmcp-utils',
			'id'         => 'wpmcp-settings',
			'title'      => __( 'Library Settings', 'wpmoviescore' ),
			'href'       => admin_url( 'admin.php?page=wpmoviescore-settings' ),
			'capability' => 'manage_options'
		),

		array(
			'parent'     => 'wpmcp-utils',
			'id'         => 'wpmcp-about',
			'title'      => __( 'About  WPMoviesCore', 'wpmoviescore' ),
			'href'       => admin_url( 'index.php?page=wpmoviescore-about' ),
			'capability' => 'read'
		),

		array(
			'parent'     => 'wpmcp-utils',
			'id'         => 'wpmcp-movie-update',
			'title'      => __( 'Update movies', 'wpmoviescore' ),
			'href'       => admin_url( 'admin.php?page=wpmoviescore-update-movies' ),
			'capability' => 'manage_options',
			'meta'       => array(
				'class' => 'active',
			),
			'condition'  => wpmcp_has_deprecated_meta()
		),

	),

	'group' => array(
		array(
			'parent' => 'wpmoviescore',
			'id'     => 'wpmcp-movies',
			'meta'   => array(
				'class' => 'ab-sub-secondary',
			),
		),

		array(
			'parent' => 'wpmoviescore',
			'id'     => 'wpmcp-utils',
			'meta'   => array(
				'class' => 'ab-sub-third',
			),
		),
	)
);

?>