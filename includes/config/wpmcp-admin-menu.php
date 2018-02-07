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

$wpmcp_admin_menu = array(

	'page' => array(
		'page_title' => WPMCP_NAME,
		'menu_title' => __( 'Movies', 'wpmoviescore' ),
		'capability' => 'edit_posts',
		'menu_slug'  => 'wpmoviescore',
		'function'   => null,
		'icon_url'   => 'none',
		'position'   => 6
	),

	'subpages' => array(

		'dashboard' => array(
			'page_title'  => __( 'Your library', 'wpmoviescore' ),
			'menu_title'  => __( 'Your library', 'wpmoviescore' ),
			'capability'  => 'read',
			'menu_slug'   => 'wpmoviescore',
			'function'    => 'WPMCP_Dashboard::dashboard',
			'condition'   => null,
			'hide'        => false,
			'actions'     => array(
				'load-{screen_hook}' => 'WPMCP_Dashboard::add_tabs'
			),
			'scripts'     => array(
				'dashboard' =>array(
					'file'    => sprintf( '%s/assets/js/admin/wpmcp-dashboard.js', WPMCP_URL ),
					'require' => array( WPMCP_SLUG . '-admin', 'jquery', 'jquery-ui-sortable' ),
					'footer'  => true
				)
			),
			'styles'      => array(
				'dashboard' => array(
					'file'    => sprintf( '%s/assets/css/admin/wpmcp-dashboard.css', WPMCP_URL ),
					'require' => array(),
					'global'  => false
				)
			)
		),

		'all_movies' => array(
			'page_title'  => __( 'All Movies', 'wpmoviescore' ),
			'menu_title'  => __( 'All Movies', 'wpmoviescore' ),
			'capability'  => 'edit_posts',
			'menu_slug'   => 'edit.php?post_type=movie',
			'function'    => null,
			'condition'   => null,
			'hide'        => false,
			'actions'     => array(),
			'scripts'     => array(),
			'styles'      => array()
		),

		'new_movie' => array(
			'page_title'  => __( 'Add New', 'wpmoviescore' ),
			'menu_title'  => __( 'Add New', 'wpmoviescore' ),
			'capability'  => 'publish_posts',
			'menu_slug'   => 'post-new.php?post_type=movie',
			'function'    => null,
			'condition'   => null,
			'hide'        => false,
			'actions'     => array(),
			'scripts'     => array(),
			'styles'      => array()
		),

		'collections' => array(
			'page_title'  => __( 'Collections', 'wpmoviescore' ),
			'menu_title'  => __( 'Collections', 'wpmoviescore' ),
			'capability'  => 'manage_categories',
			'menu_slug'   => 'edit-tags.php?taxonomy=collection&post_type=movie',
			'function'    => null,
			'condition'   => create_function('', 'return wpmcp_o( "enable-collection" );'),
			'hide'        => false,
			'actions'     => array(),
			'scripts'     => array(),
			'styles'      => array()
		),

		'genres' => array(
			'page_title'  => __( 'Genres', 'wpmoviescore' ),
			'menu_title'  => __( 'Genres', 'wpmoviescore' ),
			'capability'  => 'manage_categories',
			'menu_slug'   => 'edit-tags.php?taxonomy=genre&post_type=movie',
			'function'    => null,
			'condition'   => create_function('', 'return wpmcp_o( "enable-genre" );'),
			'hide'        => false,
			'actions'     => array(),
			'scripts'     => array(),
			'styles'      => array()
		),

		'actors' => array(
			'page_title'  => __( 'Actors', 'wpmoviescore' ),
			'menu_title'  => __( 'Actors', 'wpmoviescore' ),
			'capability'  => 'manage_categories',
			'menu_slug'   => 'edit-tags.php?taxonomy=actor&post_type=movie',
			'function'    => null,
			'condition'   => create_function('', 'return wpmcp_o( "enable-actor" );'),
			'hide'        => false,
			'actions'     => array(),
			'scripts'     => array(),
			'styles'      => array()
		),

		'importer' => array(
			'page_title'  => __( 'Import Movies', 'wpmoviescore' ),
			'menu_title'  => __( 'Import Movies', 'wpmoviescore' ),
			'capability'  => 'publish_posts',
			'menu_slug'   => 'wpmoviescore-import',
			'function'    => 'WPMCP_Import::import_page',
			'condition'   => null,
			'hide'        => false,
			'actions'     => array(
				'load-{screen_hook}' => 'WPMCP_Import::import_movie_list_add_options'
			),
			'scripts'     => array(
				
			),
			'styles'      => array(
				'importer' => array(
					'file'    => sprintf( '%s/assets/css/admin/wpmcp-importer.css', WPMCP_URL ),
					'require' => array()
				)
			)
		),

		'update_movies' => array(
			'page_title'  => __( 'Update movies to version 1.3', 'wpmoviescore' ),
			'menu_title'  => __( 'Update movies', 'wpmoviescore' ),
			'capability'  => 'manage_options',
			'menu_slug'   => 'wpmoviescore-update-movies',
			'function'    => 'WPMCP_Legacy::update_movies_page',
			'condition'   => null,
			'hide'        => true,
			'actions'     => array(),
			'scripts'     => array(
				'jquery-ajax-queue' => array(
					'file'    => sprintf( '%s/assets/js/vendor/jquery.ajaxQueue.js', WPMCP_URL ),
					'require' => array( 'jquery' ),
					'footer'  => true
				),
				'updates' => array(
					'file'    => sprintf( '%s/assets/js/admin/wpmcp-updates.js', WPMCP_URL ),
					'require' => array( WPMCP_SLUG . '-admin', 'jquery' ),
					'footer'  => true
				)
			),
			'styles'      => array(
				'roboto-font' => array(
					'file'    => '//fonts.googleapis.com/css?family=Roboto:100',
					'require' => array()
				),
				'legacy' => array(
					'file'    => sprintf( '%s/assets/css/admin/wpmcp-legacy.css', WPMCP_URL ),
					'require' => array()
				)
			)
		),

		'add_custom_pages' => array(
			'page_title'  => __( 'Add custom pages', 'wpmoviescore' ),
			'menu_title'  => __( 'Add custom pages', 'wpmoviescore' ),
			'capability'  => 'manage_options',
			'menu_slug'   => 'wpmoviescore-add-custom-pages',
			'function'    => 'WPMCP_Archives::create_pages',
			'condition'   => null,
			'hide'        => true,
			'actions'     => array(),
			'scripts'     => array(),
			'styles'      => array()
		)

	)

);

		