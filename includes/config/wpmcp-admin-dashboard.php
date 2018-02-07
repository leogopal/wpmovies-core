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

$wpmcp_dashboard_widgets = array(
	'statistics' => array(
		'class'    => 'Stats',
		'title'    => __( 'Statistics', 'wpmoviescore' ),
		'name'     => __( 'Your library', 'wpmoviescore' ),
		'location' => 'side'
	),
	'quickaction' => array(
		'class'    => 'Quickaction',
		'title'    => __( 'Quick Actions', 'wpmoviescore' ),
		'name'     => __( 'Quick Actions', 'wpmoviescore' ),
		'location' => 'side'
	),
	'helper' => array(
		'class'    => 'Helper',
		'title'    => __( 'Help', 'wpmoviescore' ),
		'name'     => __( 'Help', 'wpmoviescore' ),
		'location' => 'side'
	),
	'vendor' => array(
		'class'    => 'Vendor',
		'title'    => __( 'Rate me!', 'wpmoviescore' ),
		'name'     => __( 'Rate me!', 'wpmoviescore' ),
		'location' => 'side'
	),
	'latest_movies' => array(
		'class' => 'Latest_Movies',
		'title' => __( 'Latest Movies', 'wpmoviescore' ),
		'name'  => __( 'Movies you recently added', 'wpmoviescore' ),
		'location' => 'normal'
	),
	'most_rated_movies' => array(
		'class' => 'Most_Rated_Movies',
		'title' => __( 'Most Rated Movies', 'wpmoviescore' ),
		'name'  => __( 'Your most rated movies', 'wpmoviescore' ),
		'location' => 'normal'
	),
);
