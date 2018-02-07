<?php
/**
 * WPMoviesCore Config Movies definition
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

$wpmcp_movie_details = array(
	'status' => array(
		'id'       => 'wpmcp-movie-status',
		'name'     => 'wpmcp_details[status]',
		'type'     => 'select',
		'title'    => __( 'Movie Status', 'wpmoviescore' ),
		'desc'     => __( 'Select a status for this movie', 'wpmoviescore' ),
		'icon'     => 'wpmolicon icon-status',
		'options'  => array(
			'available'   => __( 'Available', 'wpmoviescore' ),
			'loaned'      => __( 'Loaned', 'wpmoviescore' ),
			'scheduled'   => __( 'Scheduled', 'wpmoviescore' ),
			'unavailable' => __( 'Unvailable', 'wpmoviescore' ),
		),
		'default'  => '',
		'multi'    => false,
		'rewrite'  => array( 'status' => __( 'status', 'wpmoviescore' ) )
	),
	'media' => array(
		'id'       => 'wpmcp-movie-media',
		'name'     => 'wpmcp_details[media]',
		'type'     => 'select',
		'title'    => __( 'Movie Media', 'wpmoviescore' ),
		'desc'     => __( 'Select a media for this movie', 'wpmoviescore' ),
		'icon'     => 'wpmolicon icon-video',
		'options'  => array(
			'dvd'     => __( 'DVD', 'wpmoviescore' ),
			'bluray'  => __( 'Blu-ray', 'wpmoviescore' ),
			'vod'     => __( 'VoD', 'wpmoviescore' ),
			'divx'    => __( 'DivX', 'wpmoviescore' ),
			'vhs'     => __( 'VHS', 'wpmoviescore' ),
			'cinema'  => __( 'Cinema', 'wpmoviescore' ),
			'other'   => __( 'Other', 'wpmoviescore' ),
		),
		'default'  => 'dvd',
		'multi'    => true,
		'rewrite'  => array( 'media' => __( 'media', 'wpmoviescore' ) )
	),
	'rating' => array(
		'id'       => 'wpmcp-movie-rating',
		'name'     => 'wpmcp_details[rating]',
		'type'     => 'select',
		'title'    => __( 'Movie Rating', 'wpmoviescore' ),
		'desc'     => __( 'Select a rating for this movie', 'wpmoviescore' ),
		'icon'     => 'wpmolicon icon-star-half',
		'options'  => array(
			'0.0' => __( 'Not rated', 'wpmoviescore' ),
			'0.5' => __( 'Junk', 'wpmoviescore' ),
			'1.0' => __( 'Very bad', 'wpmoviescore' ),
			'1.5' => __( 'Bad', 'wpmoviescore' ),
			'2.0' => __( 'Not that bad', 'wpmoviescore' ),
			'2.5' => __( 'Average', 'wpmoviescore' ),
			'3.0' => __( 'Not bad', 'wpmoviescore' ),
			'3.5' => __( 'Good', 'wpmoviescore' ),
			'4.0' => __( 'Very good', 'wpmoviescore' ),
			'4.5' => __( 'Excellent', 'wpmoviescore' ),
			'5.0' => __( 'Masterpiece', 'wpmoviescore' )
		),
		'default'  => '0.0',
		'multi'    => false,
		'rewrite'  => array( 'rating' => __( 'rating', 'wpmoviescore' ) )
	),
	'language' => array(
		'id'       => 'wpmcp-movie-language',
		'name'     => 'wpmcp_details[language]',
		'type'     => 'select',
		'title'    => __( 'Movie Language', 'wpmoviescore' ),
		'desc'     => __( 'Select a language for this movie', 'wpmoviescore' ),
		'icon'     => 'wpmolicon icon-lang',
		'options'  => $wpmcp_supported_languages,
		'default'  => '',
		'multi'    => true,
		'rewrite'  => array( 'lang' => __( 'lang', 'wpmoviescore' ) )
	),
	'subtitles' => array(
		'id'       => 'wpmcp-movie-subtitles',
		'name'     => 'wpmcp_details[subtitles]',
		'type'     => 'select',
		'title'    => __( 'Movie Subtitles', 'wpmoviescore' ),
		'desc'     => __( 'Select a subtitle for this movie', 'wpmoviescore' ),
		'icon'     => 'wpmolicon icon-subtitles',
		'options'  => array_merge( array( 'none' => __( 'None', 'wpmoviescore' ) ), $wpmcp_supported_languages ),
		'default'  => 'none',
		'multi'    => true,
		'rewrite'  => array( 'subtitles' => __( 'subtitles', 'wpmoviescore' ) )
	),
	'format' => array(
		'id'       => 'wpmcp-movie-format',
		'name'     => 'wpmcp_details[format]',
		'type'     => 'select',
		'title'    => __( 'Movie Format', 'wpmoviescore' ),
		'desc'     => __( 'Select a format for this movie', 'wpmoviescore' ),
		'icon'     => 'wpmolicon icon-format',
		'options'  => array(
			'3d' => __( '3D', 'wpmoviescore' ),
			'sd' => __( 'SD', 'wpmoviescore' ),
			'hd' => __( 'HD', 'wpmoviescore' ),
		),
		'default'  => '',
		'multi'    => true,
		'rewrite'  => array( 'format' => __( 'format', 'wpmoviescore' ) )
	)
);

$wpmcp_movie_meta = array(
	'tmdb_id' => array(
		'title' => __( 'TMDb ID', 'wpmoviescore' ),
		'type' => 'hidden',
		'filter' => 'intval',
		'filter_args' => null,
		'size' => 'hidden',
		'group' => 'meta',
		'rewrite'  => array( 'tmdb' => __( 'tmdb', 'wpmoviescore' ) )
	),
	'title' => array(
		'title' => __( 'Title', 'wpmoviescore' ),
		'type' => 'text',
		'filter' => 'wp_kses',
		'filter_args' => array( 'b' => array(), 'i' => array(), 'em' => array(), 'strong' => array(), 'sup' => array(), 'sub' => array() ),
		'size' => 'half',
		'group' => 'meta',
		'rewrite'  => array( 'title' => __( 'title', 'wpmoviescore' ) )
	),
	'original_title' => array(
		'title' => __( 'Original Title', 'wpmoviescore' ),
		'type' => 'text',
		'filter' => 'wp_kses',
		'filter_args' => array( 'b' => array(), 'i' => array(), 'em' => array(), 'strong' => array(), 'sup' => array(), 'sub' => array() ),
		'size' => 'half',
		'group' => 'meta',
		'rewrite'  => array( 'originaltitle' => __( 'originaltitle', 'wpmoviescore' ) )
	),
	'tagline' => array(
		'title' => __( 'Tagline', 'wpmoviescore' ),
		'type' => 'text',
		'filter' => 'esc_html',
		'filter_args' => null,
		'size' => 'full',
		'group' => 'meta',
		'rewrite'  => array( 'tagline' => __( 'tagline', 'wpmoviescore' ) )
	),
	'overview' => array(
		'title' => __( 'Overview', 'wpmoviescore' ),
		'type' => 'textarea',
		'filter' => 'wp_kses',
		'filter_args' => array( 'b' => array(), 'i' => array(), 'em' => array(), 'strong' => array(), 'sup' => array(), 'sub' => array(), 'ul' => array(), 'ol' => array(), 'li' => array(), 'br' => array(), 'span' => array() ),
		'size' => 'full',
		'group' => 'meta',
		'rewrite'  => array( 'overview' => __( 'overview', 'wpmoviescore' ) )
	),
	'release_date' => array(
		'title' => __( 'Release Date', 'wpmoviescore' ),
		'type' => 'text',
		'filter' => 'esc_html',
		'filter_args' => null,
		'size' => 'half',
		'group' => 'meta',
		'rewrite'  => array( 'date' => __( 'date', 'wpmoviescore' ) )
	),
	'local_release_date' => array(
		'title' => __( 'Local Release Date', 'wpmoviescore' ),
		'type' => 'text',
		'filter' => 'esc_html',
		'filter_args' => null,
		'size' => 'half',
		'group' => 'meta',
		'rewrite'  => array( 'local_date' => __( 'localdate', 'wpmoviescore' ) )
	),
	'runtime' => array(
		'title' => __( 'Runtime', 'wpmoviescore' ),
		'type' => 'text',
		'filter' => 'esc_html',
		'filter_args' => null,
		'size' => 'half',
		'group' => 'meta',
		'rewrite'  => array( 'runtime' => __( 'runtime', 'wpmoviescore' ) )
	),
	'production_companies' => array(
		'title' => __( 'Production', 'wpmoviescore' ),
		'type' => 'text',
		'filter' => 'esc_html',
		'filter_args' => null,
		'size' => 'half',
		'group' => 'meta',
		'rewrite'  => array( 'production' => __( 'production', 'wpmoviescore' ) )
	),
	'production_countries' => array(
		'title' => __( 'Country', 'wpmoviescore' ),
		'type' => 'text',
		'filter' => 'esc_html',
		'filter_args' => null,
		'size' => 'half',
		'group' => 'meta',
		'rewrite'  => array( 'country' => __( 'country', 'wpmoviescore' ) )
	),
	'spoken_languages' => array(
		'title' => __( 'Languages', 'wpmoviescore' ),
		'type' => 'text',
		'filter' => 'esc_html',
		'filter_args' => null,
		'size' => 'half',
		'group' => 'meta',
		'rewrite'  => array( 'language' => __( 'language', 'wpmoviescore' ) )
	),
	'genres' => array(
		'title' => __( 'Genres', 'wpmoviescore' ),
		'type' => 'text',
		'filter' => 'esc_html',
		'filter_args' => null,
		'size' => 'full',
		'group' => 'meta',
		'rewrite'  => array( 'genres' => __( 'genres', 'wpmoviescore' ) )
	),

	'director' => array(
		'job' => 'Director',
		'title' => __( 'Director', 'wpmoviescore' ),
		'type' => 'text',
		'filter' => 'esc_html',
		'filter_args' => null,
		'size' => 'half',
		'group' => 'crew',
		'rewrite'  => array( 'director' => __( 'director', 'wpmoviescore' ) )
	),
	'producer' => array(
		'job' => 'Producer',
		'title' => __( 'Producer', 'wpmoviescore' ),
		'type' => 'text',
		'filter' => 'esc_html',
		'filter_args' => null,
		'size' => 'half',
		'group' => 'crew',
		'rewrite'  => array( 'producer' => __( 'producer', 'wpmoviescore' ) )
	),
	'cast' => array(
		'title' => __( 'Actors', 'wpmoviescore' ),
		'type' => 'textarea',
		'filter' => 'esc_html',
		'filter_args' => null,
		'size' => 'full',
		'group' => 'crew',
		'rewrite'  => array( 'actor' => __( 'actor', 'wpmoviescore' ) )
	),
	'photography' => array(
		'job' => 'Director of Photography',
		'title' => __( 'Director of Photography', 'wpmoviescore' ),
		'type' => 'text',
		'filter' => 'esc_html',
		'filter_args' => null,
		'size' => 'half',
		'group' => 'crew',
		'rewrite'  => array( 'photography' => __( 'photography', 'wpmoviescore' ) )
	),
	'composer' => array(
		'job' => 'Original Music Composer',
		'title' => __( 'Original Music Composer', 'wpmoviescore' ),
		'type' => 'text',
		'filter' => 'esc_html',
		'filter_args' => null,
		'size' => 'half',
		'group' => 'crew',
		'rewrite'  => array( 'composer' => __( 'composer', 'wpmoviescore' ) )
	),
	'author' => array(
		'job' => 'Author',
		'title' => __( 'Author', 'wpmoviescore' ),
		'type' => 'text',
		'filter' => 'esc_html',
		'filter_args' => null,
		'size' => 'half',
		'group' => 'crew',
		'rewrite'  => array( 'author' => __( 'author', 'wpmoviescore' ) )
	),
	'writer' => array(
		'job' => 'Writer',
		'title' => __( 'Writer', 'wpmoviescore' ),
		'type' => 'text',
		'filter' => 'esc_html',
		'filter_args' => null,
		'size' => 'half',
		'group' => 'crew',
		'rewrite'  => array( 'writer' => __( 'writer', 'wpmoviescore' ) )
	),

	'certification' => array(
		'title' => __( 'Certification', 'wpmoviescore' ),
		'type' => 'text',
		'filter' => 'esc_html',
		'filter_args' => null,
		'size' => 'half',
		'group' => 'meta',
		'rewrite'  => array( 'certification' => __( 'certification', 'wpmoviescore' ) )
	),
	'budget' => array(
		'title' => __( 'Budget', 'wpmoviescore' ),
		'type' => 'text',
		'filter' => 'esc_html',
		'filter_args' => null,
		'size' => 'half',
		'group' => 'meta',
		'rewrite'  => array( 'budget' => __( 'budget', 'wpmoviescore' ) )
	),
	'revenue' => array(
		'title' => __( 'Revenue', 'wpmoviescore' ),
		'type' => 'text',
		'filter' => 'esc_html',
		'filter_args' => null,
		'size' => 'half',
		'group' => 'meta',
		'rewrite'  => array( 'revenue' => __( 'revenue', 'wpmoviescore' ) )
	),
	'imdb_id' => array(
		'title' => __( 'IMDb Id', 'wpmoviescore' ),
		'type' => 'text',
		'filter' => 'esc_html',
		'filter_args' => null,
		'size' => 'half',
		'group' => 'meta',
		'rewrite'  => array( 'imdb' => __( 'imdb', 'wpmoviescore' ) )
	),
	'adult' => array(
		'title' => __( 'Adult', 'wpmoviescore' ),
		'type' => 'text',
		'filter' => 'esc_html',
		'filter_args' => null,
		'size' => 'half',
		'group' => 'meta',
		'rewrite'  => array( 'adult' => __( 'adult', 'wpmoviescore' ) )
	),
	'homepage' => array(
		'title' => __( 'Homepage', 'wpmoviescore' ),
		'type' => 'text',
		'filter' => 'esc_html',
		'filter_args' => null,
		'size' => 'half',
		'group' => 'meta',
		'rewrite'  => null
	)
);

$wpmcp_movie_meta_aliases = array(

	'country'    => 'production_countries',
	'production' => 'production_companies',
	'lang'       => 'spoken_languages',
	'language'   => 'spoken_languages',
	'languages'  => 'spoken_languages',
	'actors'     => 'cast',
	'resume'     => 'overview',
	'date'       => 'release_date',
	'musician'   => 'composer'
);

$wpmcp_tags = array(
	'media'              => __( 'Media', 'wpmoviescore' ),
	'status'             => __( 'Status', 'wpmoviescore' ),
	'rating'             => __( 'Rating', 'wpmoviescore' ),
	'language'           => __( 'Language (detail)', 'wpmoviescore' ),
	'subtitles'          => __( 'Subtitles', 'wpmoviescore' ),
	'format'             => __( 'Video Format', 'wpmoviescore' ),
	'director'           => __( 'Director', 'wpmoviescore' ),
	'runtime'            => __( 'Runtime', 'wpmoviescore' ),
	'release_date'       => __( 'Release date', 'wpmoviescore' ),
	'genres'             => __( 'Genres', 'wpmoviescore' ),
	'overview'           => __( 'Overview', 'wpmoviescore' ),
	'title'              => __( 'Title', 'wpmoviescore' ),
	'original_title'     => __( 'Original Title', 'wpmoviescore' ),
	'production'         => __( 'Production', 'wpmoviescore' ),
	'countries'          => __( 'Country', 'wpmoviescore' ),
	'languages'          => __( 'Languages', 'wpmoviescore' ),
	'producer'           => __( 'Producer', 'wpmoviescore' ),
	'local_release_date' => __( 'Local release date', 'wpmoviescore' ),
	'photography'        => __( 'Director of Photography', 'wpmoviescore' ),
	'composer'           => __( 'Original Music Composer', 'wpmoviescore' ),
	'author'             => __( 'Author', 'wpmoviescore' ),
	'writer'             => __( 'Writer', 'wpmoviescore' ),
	'cast'               => __( 'Actors', 'wpmoviescore' ),
	'certification'      => __( 'Certification', 'wpmoviescore' ),
	'budget'             => __( 'Budget', 'wpmoviescore' ),
	'revenue'            => __( 'Revenue', 'wpmoviescore' ),
	'tagline'            => __( 'Tagline', 'wpmoviescore' ),
	'imdb_id'            => __( 'IMDb Id', 'wpmoviescore' ),
	'adult'              => __( 'Adult', 'wpmoviescore' ),
	'homepage'           => __( 'Homepage', 'wpmoviescore' )
);
