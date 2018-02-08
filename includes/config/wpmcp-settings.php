<?php
/**
 * WPMoviesCore Config Settings definition
 *
 * @package   WPMoviesCore
 * @author    Leo Gopal <leo@digitlab.co.za>
 * @license   GPL-3.0
 * @link      http://digitlab.co.za
 * @copyright 2016 Leo Gopal
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	wp_die();
}

$wpmcp_config = array(

	// 'wpmcp' General settings section
	array(
		'icon'    => 'wpmolicon icon-cogs',
		'title'   => __( 'General', 'wpmoviescore' ),
		'heading' => __( 'General options', 'wpmoviescore' ),
		'fields'  => array()
	),

	// 'wpmcp-movies' Movies settings subsection
	array(
		'icon'       => 'wpmolicon icon-movie',
		'title'      => __( 'Movies', 'wpmoviescore' ),
		'desc'       => __( 'WPMoviesCore handles movies as regular WordPress posts, but you can define some specific behaviours movies only should have.', 'wpmoviescore' ),
		'subsection' => true,
		'fields'     => array(

			// Add movies to the main loop
			'frontpage'      => array(
				'id'      => 'wpmcp-frontpage',
				'type'    => 'switch',
				'title'   => __( 'Show Movies in Home Page', 'wpmoviescore' ),
				'desc'    => __( 'If enabled, movies will appear among other Posts in the Home Page.', 'wpmoviescore' ),
				'on'      => __( 'Enabled', 'wpmoviescore' ),
				'off'     => __( 'Disabled', 'wpmoviescore' ),
				'default' => 1
			),

			// Add movies to the main loop
			'search'         => array(
				'id'      => 'wpmcp-search',
				'type'    => 'switch',
				'title'   => __( 'Movies in search results', 'wpmoviescore' ),
				'desc'    => __( 'If enabled, the standard WordPress Search will return every movie matching the search in addition to regular posts. Search will include all available meta fields. Examples: a search with keywork <code>Sean Penn</code> will add the movies <em>Into The Wild</em> and <em>The Secret Life of Walter Mitty</em> to the search results; a search with keywork <code>Taiwan</code> will add the movie <em>Life of Pi</em>.', 'wpmoviescore' ),
				'on'      => __( 'Enabled', 'wpmoviescore' ),
				'off'     => __( 'Disabled', 'wpmoviescore' ),
				'default' => 0
			),

			// Replace excerpt by overview
			'excerpt'        => array(
				'id'      => 'wpmcp-excerpt',
				'type'    => 'switch',
				'title'   => __( 'Replace excerpt by overview', 'wpmoviescore' ),
				'desc'    => __( 'Replace movie excerpts by the movie overview if available. <a href="http://codex.wordpress.org/Excerpt">Learn more about Excerpt</a>.', 'wpmoviescore' ),
				'on'      => __( 'Enabled', 'wpmoviescore' ),
				'off'     => __( 'Disabled', 'wpmoviescore' ),
				'default' => 1
			),

			// Replace excerpt by overview
			'excerpt-length' => array(
				'id'       => 'wpmcp-excerpt-length',
				'type'     => 'text',
				'title'    => __( 'Excerpt overview length', 'wpmoviescore' ),
				'desc'     => __( 'Excerpt overview default number of words. This will override WordPress and Themes or Plugins default values for movies only.', 'wpmoviescore' ),
				'default'  => '75',
				'required' => array( 'wpmcp-excerpt', "=", 1 ),
				'indent'   => true
			)
		)
	),

	// 'wpmcp-meta' Meta settings subsection
	array(
		'icon'       => 'wpmolicon icon-meta',
		'title'      => __( 'Metadata', 'wpmoviescore' ),
		'heading'    => __( 'Metadata settings', 'wpmoviescore' ),
		'subsection' => true,
		'fields'     => array(

			'meta-start' => array(
				'id'       => 'meta-start',
				'type'     => 'section',
				'title'    => __( 'Movies metadata', 'wpmoviescore' ),
				'subtitle' => __( 'Metadata give you useful information about your movies: director, release date, runtime, prouction, actors, languages…', 'wpmoviescore' ),
				'indent'   => true
			),

			// Show movie meta in posts
			'show-meta'  => array(
				'id'      => 'wpmcp-show-meta',
				'type'    => 'select',
				'title'   => __( 'Show metadata', 'wpmoviescore' ),
				'desc'    => __( 'Add metadata to posts&rsquo; content: director, genres, runtime…', 'wpmoviescore' ),
				'options' => array(
					'everywhere' => __( 'Everywhere', 'wpmoviescore' ),
					'posts_only' => __( 'Only In Post Read', 'wpmoviescore' ),
					'nowhere'    => __( 'Don&rsquo;t Show', 'wpmoviescore' ),
				),
				'default' => 'posts_only'
			),

			'meta-links' => array(
				'id'       => 'wpmcp-meta-links',
				'type'     => 'select',
				'title'    => __( 'Add links to meta', 'wpmoviescore' ),
				'desc'     => __( 'If enabled, metadata will appear as links to meta pages.', 'wpmoviescore' ),
				'options'  => array(
					'everywhere' => __( 'Everywhere', 'wpmoviescore' ),
					'posts_only' => __( 'Only In Post Read', 'wpmoviescore' ),
					'nowhere'    => __( 'Don&rsquo;t Show', 'wpmoviescore' ),
				),
				'default'  => 'posts_only',
				'required' => array( 'wpmcp-show-meta', "!=", 'nowhere' ),
			),

			// Default movie meta to show
			'sort-meta'  => array(
				'id'       => 'wpmcp-sort-meta',
				'type'     => 'sorter',
				'title'    => __( 'Movie metadata', 'wpmoviescore' ),
				'desc'     => __( 'Which metadata to display in posts: director, genres, runtime, rating…', 'wpmoviescore' ),
				//'callback' => 'sorted_markup_fields',
				'compiler' => 'true',
				'options'  => array(
					'used'      => array(
						'director'     => __( 'Director', 'wpmoviescore' ),
						'runtime'      => __( 'Runtime', 'wpmoviescore' ),
						'release_date' => __( 'Release date', 'wpmoviescore' ),
						'genres'       => __( 'Genres', 'wpmoviescore' ),
						'overview'     => __( 'Overview', 'wpmoviescore' )
					),
					'available' => array(
						'title'                => __( 'Title', 'wpmoviescore' ),
						'original_title'       => __( 'Original Title', 'wpmoviescore' ),
						'production_companies' => __( 'Production', 'wpmoviescore' ),
						'production_countries' => __( 'Country', 'wpmoviescore' ),
						'spoken_languages'     => __( 'Languages', 'wpmoviescore' ),
						'producer'             => __( 'Producer', 'wpmoviescore' ),
						'release_date'         => __( 'Local release date', 'wpmoviescore' ),
						'photography'          => __( 'Director of Photography', 'wpmoviescore' ),
						'composer'             => __( 'Original Music Composer', 'wpmoviescore' ),
						'author'               => __( 'Author', 'wpmoviescore' ),
						'writer'               => __( 'Writer', 'wpmoviescore' ),
						'cast'                 => __( 'Actors', 'wpmoviescore' ),
						'certification'        => __( 'Certification', 'wpmoviescore' ),
						'budget'               => __( 'Budget', 'wpmoviescore' ),
						'revenue'              => __( 'Revenue', 'wpmoviescore' ),
						'tagline'              => __( 'Tagline', 'wpmoviescore' ),
						'imdb_id'              => __( 'IMDb Id', 'wpmoviescore' ),
						'adult'                => __( 'Adult', 'wpmoviescore' ),
						'homepage'             => __( 'Homepage', 'wpmoviescore' )
					)
				),
				'required' => array( 'wpmcp-show-meta', "!=", 'nowhere' ),
				'indent'   => true
			),

			'meta-end' => array(
				'id'     => 'meta-end',
				'type'   => 'section',
				'indent' => false,
			)
		)
	),

	// 'wpmcp-details' Details settings subsection
	array(
		'icon'       => 'wpmolicon icon-details',
		'title'      => __( 'Details', 'wpmoviescore' ),
		'heading'    => __( 'Details settings', 'wpmoviescore' ),
		'subsection' => true,
		'fields'     => array(

			'details-start' => array(
				'id'       => 'details-start',
				'type'     => 'section',
				'title'    => __( 'Movie details', 'wpmoviescore' ),
				'subtitle' => __( 'Details are a different way to manage your movies. You can specify and filter movies by rating, media, status, language, subtitles…', 'wpmoviescore' ),
				'indent'   => true
			),

			// Show movie details in posts
			'show-details'  => array(
				'id'      => 'wpmcp-show-details',
				'type'    => 'select',
				'title'   => __( 'Show details', 'wpmoviescore' ),
				'desc'    => __( 'Add details to posts&rsquo; content: movie status, media…', 'wpmoviescore' ),
				'options' => array(
					'everywhere' => __( 'Everywhere', 'wpmoviescore' ),
					'posts_only' => __( 'Only In Post Read', 'wpmoviescore' ),
					'nowhere'    => __( 'Don&rsquo;t Show', 'wpmoviescore' )
				),
				'default' => 'posts_only'
			),

			// Show movie details as icons
			'details-icons' => array(
				'id'       => 'wpmcp-details-icons',
				'type'     => 'switch',
				'title'    => __( 'Details as icons', 'wpmoviescore' ),
				'desc'     => __( 'If enabled, movie details will appear in the form of icons rather than default colored labels.', 'wpmoviescore' ),
				'on'       => __( 'Enabled', 'wpmoviescore' ),
				'off'      => __( 'Disabled', 'wpmoviescore' ),
				'default'  => 1,
				'required' => array( 'wpmcp-show-details', "!=", 'nowhere' ),
				'indent'   => true
			),

			// Default movie detail to show
			'sort-details'  => array(
				'id'       => 'wpmcp-sort-details',
				'type'     => 'sorter',
				'title'    => __( 'Movie details', 'wpmoviescore' ),
				'desc'     => __( 'Which detail to display in posts: movie status, media…', 'wpmoviescore' ),
				'compiler' => 'true',
				'options'  => array(
					'used'      => array(
						'media'  => __( 'Media', 'wpmoviescore' ),
						'status' => __( 'Status', 'wpmoviescore' ),
						'rating' => __( 'Rating', 'wpmoviescore' )
					),
					'available' => array(
						'language'  => __( 'Language', 'wpmoviescore' ),
						'subtitles' => __( 'Subtitles', 'wpmoviescore' ),
						'format'    => __( 'Format', 'wpmoviescore' )
					)
				),
				'required' => array( 'wpmcp-show-details', "!=", 'nowhere' ),
				'indent'   => true
			),

			'details-end' => array(
				'id'     => 'details-end',
				'type'   => 'section',
				'indent' => false,
			),
		)
	),

	// 'wpmcp-format' Formatting settings subsection
	array(
		'icon'       => 'wpmolicon icon-format',
		'title'      => __( 'Formatting', 'wpmoviescore' ),
		'heading'    => __( 'Formatting settings', 'wpmoviescore' ),
		'subsection' => true,
		'fields'     => array(

			// Release date formatting
			'format-date'   => array(
				'id'      => 'wpmcp-format-date',
				'type'    => 'text',
				'title'   => __( 'Release date format', 'wpmoviescore' ),
				'desc'    => __( 'Apply a custom date format to movies\' release dates. Leave empty to use the default API format. Check the <a href="http://codex.wordpress.org/Formatting_Date_and_Time">documentation on date and time formatting</a>.', 'wpmoviescore' ),
				'default' => 'j F Y'
			),

			// Release date formatting
			'format-time'   => array(
				'id'      => 'wpmcp-format-time',
				'type'    => 'text',
				'title'   => __( 'Runtime format', 'wpmoviescore' ),
				'desc'    => __( 'Apply a custom time format to movies\' runtimes. Leave empty to use the default API format.', 'wpmoviescore' ),
				'default' => 'G \h i \m\i\n'
			),

			// Release date formatting
			'format-rating' => array(
				'id'      => 'wpmcp-format-rating',
				'type'    => 'select',
				'title'   => __( 'Rating format', 'wpmoviescore' ),
				'desc'    => __( 'Should ratings be displayed using 5 or 10 stars.', 'wpmoviescore' ),
				'options' => array(
					'5'  => __( '5 stars', 'wpmoviescore' ),
					'10' => __( '10 stars', 'wpmoviescore' )
				),
				'default' => '5'
			),
		),
	),

	// 'wpmcp-converting' Formatting settings subsection
	array(
		'icon'       => 'wpmolicon icon-import',
		'title'      => __( 'Converting', 'wpmoviescore' ),
		'heading'    => __( 'Converting settings', 'wpmoviescore' ),
		'desc'       => __( 'This section allows you to configure the post types convertor tool. This can be usefull to convert regular posts, pages and possibly other custom post types into movies to avoid duplicate contents or having to manually recreate already existing contents. Note that this will most likely affect your SEO as it will change Posts’ URLs.', 'wpmoviescore' ),
		'subsection' => true,
		'fields'     => array(

			// Notice
			array(
				'id'     => 'wpmcp-convert-notice',
				'type'   => 'info',
				'notice' => true,
				'style'  => 'critical',
				'icon'   => 'wpmolicon icon-warning',
				'title'  => __( 'Experimental', 'wpmoviescore' ),
				'desc'   => __( 'Posts to Movies conversion is still experimental. Do not activate this unless you are sure of what you are doing, and make sure you have backups of your database before using this feature.', 'wpmoviescore' )
			),

			// Post type convert enable
			'convert-enable'     => array(
				'id'      => 'wpmcp-convert-enable',
				'type'    => 'switch',
				'title'   => __( 'Convert Post Types', 'wpmoviescore' ),
				'desc'    => __( 'Enable post types conversion tools.', 'wpmoviescore' ),
				'on'      => __( 'Enabled', 'wpmoviescore' ),
				'off'     => __( 'Disabled', 'wpmoviescore' ),
				'default' => 0
			),

			// Post type to convert
			'convert-post-types' => array(
				'id'       => 'wpmcp-convert-post-types',
				'type'     => 'select',
				'title'    => __( 'Post Types available to convert', 'wpmoviescore' ),
				'desc'     => __( 'Select which post types should be convertible to movie.', 'wpmoviescore' ),
				'data'     => 'post_types',
				'multi'    => true,
				'required' => array( 'wpmcp-convert-enable', "=", '1' ),
				'default'  => array( 'post', 'page', 'review' )
			),
		),
	),

	// 'wpmcp-images' Images and Posters section
	array(
		'icon'    => 'wpmolicon icon-image',
		'title'   => __( 'Images', 'wpmoviescore' ),
		'heading' => __( 'Images and Posters options', 'wpmoviescore' ),
		'fields'  => array()
	),

	// 'wpmcp-posters' Posters settings subsection
	array(
		'icon'       => 'wpmolicon icon-poster',
		'title'      => __( 'Posters', 'wpmoviescore' ),
		'heading'    => __( 'Posters settings', 'wpmoviescore' ),
		'subsection' => true,
		'fields'     => array(

			// Use posters as featured images
			'poster-featured'    => array(
				'id'      => 'wpmcp-poster-featured',
				'type'    => 'switch',
				'title'   => __( 'Posters as Thumbnails', 'wpmoviescore' ),
				'desc'    => __( 'Using posters as movies thumbnails will automatically import new movies&rsquo; poster and set them as post featured image. This setting doesn’t affect movie import by list where posters are automatically saved and set as featured image.', 'wpmoviescore' ),
				'on'      => __( 'Enabled', 'wpmoviescore' ),
				'off'     => __( 'Disabled', 'wpmoviescore' ),
				'default' => 1
			),

			// Movie posters size
			'poster-size'        => array(
				'id'      => 'wpmcp-poster-size',
				'type'    => 'select',
				'title'   => __( 'Posters Default Size', 'wpmoviescore' ),
				'desc'    => __( 'Movie Poster size. Default is TMDb&rsquo;s original size.', 'wpmoviescore' ),
				'options' => array(
					'xx-small' => __( 'Invisible (~100px)', 'wpmoviescore' ),
					'x-small'  => __( 'Tiny (~150px)', 'wpmoviescore' ),
					'small'    => __( 'Small (~200px)', 'wpmoviescore' ),
					'medium'   => __( 'Medium (~350px)', 'wpmoviescore' ),
					'large'    => __( 'Large (~500px)', 'wpmoviescore' ),
					'full'     => __( 'Full (~800px) ', 'wpmoviescore' ),
					'original' => __( 'Original', 'wpmoviescore' )
				),
				'default' => 'original'
			),

			// Delete posters when deleting movies
			'posters-delete'     => array(
				'id'      => 'wpmcp-posters-delete',
				'type'    => 'switch',
				'title'   => __( 'Delete posters with movies', 'wpmoviescore' ),
				'desc'    => __( 'Enable this if you want to delete posters along with movies.', 'wpmoviescore' ),
				'on'      => __( 'Enabled', 'wpmoviescore' ),
				'off'     => __( 'Disabled', 'wpmoviescore' ),
				'default' => 0
			),

			// Poster attachment title
			'poster-title'       => array(
				'id'       => 'wpmcp-poster-title',
				'type'     => 'text',
				'title'    => __( 'Posters image title', 'wpmoviescore' ),
				'desc'     => __( 'Title for the imported posters images.', 'wpmoviescore' ),
				'validate' => 'no_html',
				'default'  => sprintf( '%s "{title}"', __( 'Poster for the movie', 'wpmoviescore' ) )
			),

			// Poster attachment description
			'poster-description' => array(
				'id'       => 'wpmcp-poster-description',
				'type'     => 'text',
				'title'    => __( 'Posters image description', 'wpmoviescore' ),
				'desc'     => __( 'Description text for the imported posters images.', 'wpmoviescore' ),
				'validate' => 'no_html',
				'default'  => sprintf( '© {year} {production} − %s', __( 'All right reserved.', 'wpmoviescore' ) )
			)
		)
	),

	// 'wpmcp-images' Images settings subsection
	array(
		'icon'       => 'wpmolicon icon-images',
		'title'      => __( 'Images', 'wpmoviescore' ),
		'heading'    => __( 'Images settings', 'wpmoviescore' ),
		'subsection' => true,
		'fields'     => array(

			// Images size
			'images-size'       => array(
				'id'      => 'wpmcp-images-size',
				'type'    => 'select',
				'title'   => __( 'Images Default Size', 'wpmoviescore' ),
				'desc'    => __( 'Movie Image size. Default is TMDb&rsquo;s original size.', 'wpmoviescore' ),
				'options' => array(
					'small'    => __( 'Small (~300px)', 'wpmoviescore' ),
					'medium'   => __( 'Medium (~780px)', 'wpmoviescore' ),
					'full'     => __( 'Full (~1280px) ', 'wpmoviescore' ),
					'original' => __( 'Original', 'wpmoviescore' )
				),
				'default' => 'original'
			),

			// Maximum number of image to show
			'images-delete'     => array(
				'id'      => 'wpmcp-images-delete',
				'type'    => 'switch',
				'title'   => __( 'Delete images with movies', 'wpmoviescore' ),
				'desc'    => __( 'Enable this if you want to delete all imported images along with movies. Handy if you have a great number of movies to delete and possibly dozens of images attached.', 'wpmoviescore' ),
				'on'      => __( 'Enabled', 'wpmoviescore' ),
				'off'     => __( 'Disabled', 'wpmoviescore' ),
				'default' => 0
			),

			// Image attachment title
			'image-title'       => array(
				'id'       => 'wpmcp-image-title',
				'type'     => 'text',
				'title'    => __( 'Images title', 'wpmoviescore' ),
				'desc'     => __( 'Title for the imported movie images.', 'wpmoviescore' ),
				'validate' => 'no_html',
				'default'  => sprintf( '%s "{title}"', __( 'Image from the movie', 'wpmoviescore' ) )
			),

			// Image attachment description
			'image-description' => array(
				'id'       => 'wpmcp-image-description',
				'type'     => 'text',
				'title'    => __( 'Images description', 'wpmoviescore' ),
				'desc'     => __( 'Description text for the imported movie images.', 'wpmoviescore' ),
				'validate' => 'no_html',
				'default'  => sprintf( '© {year} {production} − %s', __( 'All right reserved.', 'wpmoviescore' ) )
			)
		),
	),

	// 'wpmcp-taxonomies' Taxonomies section
	array(
		'icon'    => 'wpmolicon icon-tags',
		'title'   => __( 'Taxonomies', 'wpmoviescore' ),
		'heading' => __( 'Built-in Taxonomies configuration', 'wpmoviescore' ),
		'fields'  => array()
	),

	// 'wpmcp-taxonomies' general settings subsection
	array(
		'icon'       => 'wpmolicon icon-folder',
		'title'      => __( 'General', 'wpmoviescore' ),
		'heading'    => __( 'General settings', 'wpmoviescore' ),
		'subsection' => true,
		'fields'     => array(

			// Notice
			array(
				'id'     => 'wpmcp-taxonomies-notice',
				'type'   => 'info',
				'notice' => true,
				'style'  => 'critical',
				'icon'   => 'wpmolicon icon-warning',
				'title'  => __( 'Experimental', 'wpmoviescore' ),
				'desc'   => __( 'Enabling Categories and Post tags for movies will result in your movies appearing in Categories and Post Tags archive pages, among regular WordPress Posts. This could also interfer with other plugins/themes dealing with Categories/Post Tags. Use it carefully.', 'wpmoviescore' )
			),

			// Enable Categories
			'enable-categories' => array(
				'id'          => 'wpmcp-enable-categories',
				'type'        => 'switch',
				'title'       => __( 'Enable Categories', 'wpmoviescore' ),
				'description' => __( 'Allow movies to use regular WordPress Categories.', 'wpmoviescore' ),
				'on'          => __( 'Enabled', 'wpmoviescore' ),
				'off'         => __( 'Disabled', 'wpmoviescore' ),
				'default'     => 0
			),

			// Enable Post Tags
			'enable-tags'       => array(
				'id'          => 'wpmcp-enable-tags',
				'type'        => 'switch',
				'title'       => __( 'Enable Post Tags', 'wpmoviescore' ),
				'description' => __( 'Allow movies to use regular WordPress Post Tags.', 'wpmoviescore' ),
				'on'          => __( 'Enabled', 'wpmoviescore' ),
				'off'         => __( 'Disabled', 'wpmoviescore' ),
				'default'     => 0
			)
		)
	),

	// 'wpmcp-collections' collections settings subsection
	array(
		'icon'       => 'wpmolicon icon-collection',
		'title'      => __( 'Collections', 'wpmoviescore' ),
		'heading'    => __( 'Collections settings', 'wpmoviescore' ),
		'subsection' => true,
		'fields'     => array(

			// Enable Collections Taxonomy
			'enable-collection'       => array(
				'id'          => 'wpmcp-enable-collection',
				'type'        => 'switch',
				'title'       => __( 'Enable Collections', 'wpmoviescore' ),
				'description' => __( 'Enable Collections Custom Taxonomy. Collections work for movies as Categories work for Posts: a hierarchical taxonomy to group your movies coherently. The default behavior is to use Collections to group movies by director, but you can use them differently at your will.', 'wpmoviescore' ),
				'on'          => __( 'Enabled', 'wpmoviescore' ),
				'off'         => __( 'Disabled', 'wpmoviescore' ),
				'default'     => 1
			),

			// Enable Collections Autocomplete
			'collection-autocomplete' => array(
				'id'       => 'wpmcp-collection-autocomplete',
				'type'     => 'switch',
				'title'    => __( 'Add Collections automatically', 'wpmoviescore' ),
				'desc'     => __( 'Automatically add custom taxonomies when adding/importing movies. If enabled, each added/imported movie will be automatically added to the collection corresponding to its director(s).', 'wpmoviescore' ),
				'on'       => __( 'Enabled', 'wpmoviescore' ),
				'off'      => __( 'Disabled', 'wpmoviescore' ),
				'default'  => 1,
				'required' => array( 'wpmcp-enable-collection', "=", 1 ),
				'indent'   => true
			),

			// Enable Collections for regular WordPress Posts
			'collection-posts'        => array(
				'id'       => 'wpmcp-collection-posts',
				'type'     => 'switch',
				'title'    => __( 'Posts Collections support', 'wpmoviescore' ),
				'desc'     => __( '<strong>Experimental</strong>: if enabled, allow regular WordPress Posts to use collection taxonomy.', 'wpmoviescore' ),
				'on'       => __( 'Enabled', 'wpmoviescore' ),
				'off'      => __( 'Disabled', 'wpmoviescore' ),
				'default'  => 0,
				'required' => array( 'wpmcp-enable-collection', "=", 1 ),
				'indent'   => true
			),

			// Collections Post Types
			'collection-post-types'   => array(
				'id'       => 'wpmcp-collection-post-types',
				'type'     => 'select',
				'title'    => __( 'Collections Post Types support', 'wpmoviescore' ),
				'desc'     => __( 'Select which post types should support collections.', 'wpmoviescore' ),
				'data'     => 'post_types',
				'multi'    => true,
				'required' => array( 'wpmcp-collection-posts', "=", '1' ),
				'default'  => array( 'post', 'page' ),
				'indent'   => true
			)
		)
	),

	// 'wpmcp-genres' Genres settings subsection
	array(
		'icon'       => 'wpmolicon icon-tag',
		'title'      => __( 'Genres', 'wpmoviescore' ),
		'heading'    => __( 'Genres settings', 'wpmoviescore' ),
		'subsection' => true,
		'fields'     => array(

			// Enable Genres Taxonomy
			'enable-genre'       => array(
				'id'      => 'wpmcp-enable-genre',
				'type'    => 'switch',
				'title'   => __( 'Enable Genres', 'wpmoviescore' ),
				'desc'    => __( 'Enable Genres Custom Taxonomy. Genres work for movies as Tags work for Posts: a non-hierarchical taxonomy to improve movies management.', 'wpmoviescore' ),
				'on'      => __( 'Enabled', 'wpmoviescore' ),
				'off'     => __( 'Disabled', 'wpmoviescore' ),
				'default' => 1
			),

			// Enable Genres Autocomplete
			'genre-autocomplete' => array(
				'id'       => 'wpmcp-genre-autocomplete',
				'type'     => 'switch',
				'title'    => __( 'Add Genres automatically', 'wpmoviescore' ),
				'desc'     => __( 'Automatically add Genres when adding/importing movies.', 'wpmoviescore' ),
				'on'       => __( 'Enabled', 'wpmoviescore' ),
				'off'      => __( 'Disabled', 'wpmoviescore' ),
				'default'  => 1,
				'required' => array( 'wpmcp-enable-genre', "=", 1 ),
				'indent'   => true
			),

			// Enable Genres for regular WordPress Posts
			'genre-posts'        => array(
				'id'       => 'wpmcp-genre-posts',
				'type'     => 'switch',
				'title'    => __( 'Posts Genres support', 'wpmoviescore' ),
				'desc'     => __( '<strong>Experimental</strong>: if enabled, allow regular WordPress Posts to use genre taxonomy.', 'wpmoviescore' ),
				'on'       => __( 'Enabled', 'wpmoviescore' ),
				'off'      => __( 'Disabled', 'wpmoviescore' ),
				'default'  => 0,
				'required' => array( 'wpmcp-enable-genre', "=", 1 ),
				'indent'   => true
			),

			// Genres Post Types
			'genre-post-types'   => array(
				'id'       => 'wpmcp-genre-post-types',
				'type'     => 'select',
				'title'    => __( 'Genres Post Types support', 'wpmoviescore' ),
				'desc'     => __( 'Select which post types should support genres.', 'wpmoviescore' ),
				'data'     => 'post_types',
				'multi'    => true,
				'required' => array( 'wpmcp-genre-posts', "=", '1' ),
				'default'  => array( 'post', 'page' ),
				'indent'   => true
			)
		)
	),

	// 'wpmcp-actors' Actors settings subsection
	array(
		'icon'       => 'wpmolicon icon-actor',
		'title'      => __( 'Actors', 'wpmoviescore' ),
		'heading'    => __( 'Actors settings', 'wpmoviescore' ),
		'subsection' => true,
		'fields'     => array(

			// Enable Actors Taxonomy
			'enable-actor'       => array(
				'id'      => 'wpmcp-enable-actor',
				'type'    => 'switch',
				'title'   => __( 'Enable Actors', 'wpmoviescore' ),
				'desc'    => __( 'Enable Actors Custom Taxonomy. Actors work for movies as Tags work for Posts: a non-hierarchical taxonomy to improve movies management. WPMoviesCore stores Actors in a custom order, the most important actors appearing in the top of the list, then the supporting roles, and so on.', 'wpmoviescore' ),
				'on'      => __( 'Enabled', 'wpmoviescore' ),
				'off'     => __( 'Disabled', 'wpmoviescore' ),
				'default' => 1
			),

			// Enable Actors Autocomplete
			'actor-autocomplete' => array(
				'id'       => 'wpmcp-actor-autocomplete',
				'type'     => 'switch',
				'title'    => __( 'Add Actors automatically', 'wpmoviescore' ),
				'desc'     => __( 'Automatically add Actors when adding/importing movies.', 'wpmoviescore' ),
				'on'       => __( 'Enabled', 'wpmoviescore' ),
				'off'      => __( 'Disabled', 'wpmoviescore' ),
				'default'  => 1,
				'required' => array( 'wpmcp-enable-actor', "=", 1 ),
				'indent'   => true
			),

			// Enable Actors Autocomplete
			'actor-limit'        => array(
				'id'       => 'wpmcp-actor-limit',
				'type'     => 'text',
				'title'    => __( 'Actors limit', 'wpmoviescore' ),
				'desc'     => __( 'Limit the number of actors per movie. This is useful if you\'re dealing with big libraries and don\'t want to have massive lists of actors created. Limiting the Actors will result in keeping only the most famous/important actors as taxonomies, while the complete list of actors will remained stored as a regular metadata. Set to 0 to disable.', 'wpmoviescore' ),
				'default'  => 0,
				'validate' => 'numeric',
				'required' => array( 'wpmcp-enable-actor', "=", 1 ),
				'indent'   => true
			),

			// Enable Actors for regular WordPress Posts
			'actor-posts'        => array(
				'id'       => 'wpmcp-actor-posts',
				'type'     => 'switch',
				'title'    => __( 'Posts Actors support', 'wpmoviescore' ),
				'desc'     => __( '<strong>Experimental</strong>: if enabled, allow regular WordPress Posts to use actor taxonomy.', 'wpmoviescore' ),
				'on'       => __( 'Enabled', 'wpmoviescore' ),
				'off'      => __( 'Disabled', 'wpmoviescore' ),
				'default'  => 0,
				'required' => array( 'wpmcp-enable-actor', "=", 1 ),
				'indent'   => true
			),

			// Actors Post Types
			'actor-post-types'   => array(
				'id'       => 'wpmcp-actor-post-types',
				'type'     => 'select',
				'title'    => __( 'Actors Post Types support', 'wpmoviescore' ),
				'desc'     => __( 'Select which post types should support actors.', 'wpmoviescore' ),
				'data'     => 'post_types',
				'multi'    => true,
				'required' => array( 'wpmcp-actor-posts', "=", '1' ),
				'default'  => array( 'post', 'page' ),
				'indent'   => true
			)
		),
	),

	// 'wpmcp-archives' Archives Pages section
	array(
		'icon'    => 'wpmolicon icon-archive',
		'title'   => __( 'Archives', 'wpmoviescore' ),
		'heading' => __( 'Archives Pages Settings', 'wpmoviescore' ),
		'fields'  => array()
	),

	// 'wpmcp-movie-archives' Movie Archives settings subsection
	array(
		'icon'       => 'wpmolicon icon-movie',
		'title'      => __( 'Movie Archives', 'wpmoviescore' ),
		'heading'    => __( 'Movie Archives page settings', 'wpmoviescore' ),
		'desc'       => __( 'This section allow you to define a custom page to use for movie archives.', 'wpmoviescore' ),
		'subsection' => true,
		'fields'     => array(

			// Notice
			/*array(
                            'id'     => 'wpmcp-archives-notice',
                            'type'   => 'info',
                            'notice' => true,
                            'style'  => 'info',
                            'icon'   => 'wpmolicon icon-info',
                            'title'  => __( 'Permalinks Required', 'wpmoviescore' ),
                            'desc'   => __( 'Custom Archives Pages require Permalinks to be activated; using the default permalink structure will prevent archives to work properly. Ignore this notice if you are already using custom permalinks.', 'wpmoviescore' )
                        ),*/

			// Movie archives page
			'movie-archives'               => array(
				'id'                => 'wpmcp-movie-archives',
				'type'              => 'select',
				'title'             => __( 'Movie Archives Page', 'wpmoviescore' ),
				'desc'              => __( 'Choose a page to use to display movie archives.', 'wpmoviescore' ),
				'data'              => 'pages',
				'validate_callback' => 'WPMCP_Utils::permalinks_changed',
				'default'           => ''
			),

			// Archives Position
			'movie-archives-position'      => array(
				'id'      => 'wpmcp-movie-archives-position',
				'type'    => 'select',
				'title'   => __( 'Archives Position', 'wpmoviescore' ),
				'desc'    => __( 'Where to display the Archives on the page.', 'wpmoviescore' ),
				'options' => array(
					'top'    => __( 'Top', 'wpmoviescore' ),
					'bottom' => __( 'Bottom', 'wpmoviescore' )
				),
				'default' => 'top',
			),

			// Movie archives page title rewrite
			'movie-archives-title-rewrite' => array(
				'id'      => 'wpmcp-movie-archives-title-rewrite',
				'type'    => 'switch',
				'title'   => __( 'Rewrite Movie Archives Page Titles', 'wpmoviescore' ),
				'desc'    => __( 'If enabled, movie archives page’s title and post title will be rewritten to feature currently browsed metas, details, and letters.', 'wpmoviescore' ),
				'on'      => __( 'Enabled', 'wpmoviescore' ),
				'off'     => __( 'Disabled', 'wpmoviescore' ),
				'default' => 1
			),

			// Movie archives page menu
			'menu'                         => array(
				'id'      => 'wpmcp-movie-archives-menu',
				'type'    => 'switch',
				'title'   => __( 'Archives Menu', 'wpmoviescore' ),
				'desc'    => __( 'If enabled, add an alphabetical menu and sorting options before the movies list.', 'wpmoviescore' ),
				'on'      => __( 'Enabled', 'wpmoviescore' ),
				'off'     => __( 'Disabled', 'wpmoviescore' ),
				'default' => 1
			),

			// Movie archives page grid columns
			'grid-columns'                 => array(
				'id'            => 'wpmcp-movie-archives-grid-columns',
				'type'          => 'slider',
				'title'         => __( 'Grid Columns', 'wpmoviescore' ),
				'desc'          => __( 'How many columns should the movie grid have.', 'wpmoviescore' ),
				'min'           => 1,
				'step'          => 1,
				'max'           => 8,
				'display_value' => 'text',
				'default'       => 4
			),

			// Movie archives page grid rows
			'grid-rows'                    => array(
				'id'            => 'wpmcp-movie-archives-grid-rows',
				'type'          => 'slider',
				'title'         => __( 'Grid Rows', 'wpmoviescore' ),
				'desc'          => __( 'How many rows should the movie grid have.', 'wpmoviescore' ),
				'min'           => 1,
				'step'          => 1,
				'max'           => 12,
				'display_value' => 'text',
				'default'       => 6
			),

			// Movie archives page grid default sorting order
			'movies-order'                 => array(
				'id'      => 'wpmcp-movie-archives-movies-order',
				'type'    => 'button_set',
				'title'   => __( 'Movies order', 'wpmoviescore' ),
				'desc'    => __( 'How movies should be ordered by default.', 'wpmoviescore' ),
				'options' => array(
					'ASC'  => __( 'Ascending' ),
					'DESC' => __( 'Descending' ),
				),
				'default' => 'ASC'
			),

			// Movie archives page grid default sorting order
			'movies-orderby'               => array(
				'id'      => 'wpmcp-movie-archives-movies-orderby',
				'type'    => 'button_set',
				'title'   => __( 'Movies Sorting', 'wpmoviescore' ),
				'desc'    => __( 'Default movies sorting.', 'wpmoviescore' ),
				'options' => array(
					'title'     => __( 'Title', 'wpmoviescore' ),
					'date'      => __( 'Release Date', 'wpmoviescore' ),
					'localdate' => __( 'Local Release Date', 'wpmoviescore' ),
					'rating'    => __( 'Rating', 'wpmoviescore' ),
				),
				'default' => 'title'
			),

			// Movie archives page max number of movies per page
			'movies-limit'                 => array(
				'id'       => 'wpmcp-movie-archives-movies-limit',
				'type'     => 'text',
				'title'    => __( 'Movies per page limit', 'wpmoviescore' ),
				'desc'     => __( 'Limit the number of movies per page to be listed. Can be useful if your dealing with massive numbers of movies.', 'wpmoviescore' ),
				'validate' => 'numeric',
				'default'  => 99
			),

			'movies-meta'            => array(
				'id'       => 'wpmcp-movie-archives-movies-meta',
				'type'     => 'sorter',
				'title'    => __( 'Grid Movies Meta', 'wpmoviescore' ),
				'desc'     => __( 'You can show some metadata along with posters in the grid.', 'wpmoviescore' ),
				'compiler' => 'true',
				'options'  => array(
					'used'      => array(),
					'available' => array(
						'title'  => __( 'Title', 'wpmoviescore' ),
						'year'   => __( 'Year', 'wpmoviescore' ),
						'rating' => __( 'Rating', 'wpmoviescore' )
					)
				)
			),

			// Movie archives page frontend edit inputs
			'frontend-edit'          => array(
				'id'      => 'wpmcp-movie-archives-frontend-edit',
				'type'    => 'switch',
				'title'   => __( 'Editable movies-per-page value', 'wpmoviescore' ),
				'desc'    => __( 'If enabled, allows movies-per-page value to be modified on frontend. The sorting menu will show an input where visitors can change the movies-per-page value to display more or less movies. It is recommended to set a limit above if this feature is to be activated.', 'wpmoviescore' ),
				'on'      => __( 'Enabled', 'wpmoviescore' ),
				'off'     => __( 'Disabled', 'wpmoviescore' ),
				'default' => 0
			),

			// Movie archives page frontend advanced edit settings
			'frontend-advanced-edit' => array(
				'id'      => 'wpmcp-movie-archives-frontend-advanced-edit',
				'type'    => 'switch',
				'title'   => __( 'Advanced Editable grid settings', 'wpmoviescore' ),
				'desc'    => __( 'If enabled, allows the grid sorting to be modified on frontend. The sorting menu will show a list of possible sortings (rating, release date, title, …) that visitors can select to sort the grid. <strong>This feature is experimental!</strong> Be sure to test it thoroughly before enabling it publicly.', 'wpmoviescore' ),
				'on'      => __( 'Enabled', 'wpmoviescore' ),
				'off'     => __( 'Disabled', 'wpmoviescore' ),
				'default' => 0
			),
		)
	),

	// 'wpmcp-movie-archives' Movie Archives settings subsection
	array(
		'icon'       => 'wpmolicon icon-tags',
		'title'      => __( 'Taxonomy Archives', 'wpmoviescore' ),
		'heading'    => __( 'Taxonomy Archives page settings', 'wpmoviescore' ),
		'desc'       => __( 'This section allow you to define a custom page to use for taxonomy archives.', 'wpmoviescore' ),
		'subsection' => true,
		'fields'     => array(

			// Collection archives page
			'collection-archives'    => array(
				'id'                => 'wpmcp-collection-archives',
				'type'              => 'select',
				'title'             => __( 'Collection Archives Page', 'wpmoviescore' ),
				'desc'              => __( 'Choose a page to use to display collection archives.', 'wpmoviescore' ),
				'data'              => 'pages',
				'validate_callback' => 'WPMCP_Utils::permalinks_changed',
				'default'           => '',
				'required'          => array( 'wpmcp-enable-collection', "=", 1 )
			),

			// Genre archives page
			'genre-archives'         => array(
				'id'                => 'wpmcp-genre-archives',
				'type'              => 'select',
				'title'             => __( 'Genre Archives Page', 'wpmoviescore' ),
				'desc'              => __( 'Choose a page to use to display genre archives.', 'wpmoviescore' ),
				'data'              => 'pages',
				'validate_callback' => 'WPMCP_Utils::permalinks_changed',
				'default'           => '',
				'required'          => array( 'wpmcp-enable-genre', "=", 1 )
			),

			// Actor archives page
			'actor-archives'         => array(
				'id'                => 'wpmcp-actor-archives',
				'type'              => 'select',
				'title'             => __( 'Actor Archives Page', 'wpmoviescore' ),
				'desc'              => __( 'Choose a page to use to display actor archives.', 'wpmoviescore' ),
				'data'              => 'pages',
				'validate_callback' => 'WPMCP_Utils::permalinks_changed',
				'default'           => '',
				'required'          => array( 'wpmcp-enable-actor', "=", 1 )
			),

			// Archives Position
			'archives-position'      => array(
				'id'      => 'wpmcp-tax-archives-position',
				'type'    => 'select',
				'title'   => __( 'Archives Position', 'wpmoviescore' ),
				'desc'    => __( 'Where to display the Archives on the page.', 'wpmoviescore' ),
				'options' => array(
					'top'    => __( 'Top', 'wpmoviescore' ),
					'bottom' => __( 'Bottom', 'wpmoviescore' )
				),
				'default' => 'top',
			),

			// Movie archives page title rewrite
			'archives-title-rewrite' => array(
				'id'      => 'wpmcp-tax-archives-title-rewrite',
				'type'    => 'switch',
				'title'   => __( 'Rewrite Archives Page Titles', 'wpmoviescore' ),
				'desc'    => __( 'If enabled, taxonomy archives page’s title and post title will be rewritten to feature currently browsed letter.', 'wpmoviescore' ),
				'on'      => __( 'Enabled', 'wpmoviescore' ),
				'off'     => __( 'Disabled', 'wpmoviescore' ),
				'default' => 1
			),

			// Taxonomy archives page menu
			'archives-menu'          => array(
				'id'      => 'wpmcp-tax-archives-menu',
				'type'    => 'switch',
				'title'   => __( 'Archives Menu', 'wpmoviescore' ),
				'desc'    => __( 'If enabled, add an alphabetical menu and sorting options before the terms list.', 'wpmoviescore' ),
				'on'      => __( 'Enabled', 'wpmoviescore' ),
				'off'     => __( 'Disabled', 'wpmoviescore' ),
				'default' => 1
			),

			// Taxonomy archives page don't show empty terms
			'hide-empty'             => array(
				'id'      => 'wpmcp-tax-archives-hide-empty',
				'type'    => 'switch',
				'title'   => __( 'Hide empty terms', 'wpmoviescore' ),
				'desc'    => __( 'If enabled, terms related to no movie will be excluded from the list.', 'wpmoviescore' ),
				'on'      => __( 'Enabled', 'wpmoviescore' ),
				'off'     => __( 'Disabled', 'wpmoviescore' ),
				'default' => 1
			),

			// Taxonomy archives page default term order
			'terms-orderby'          => array(
				'id'      => 'wpmcp-tax-archives-terms-orderby',
				'type'    => 'button_set',
				'title'   => __( 'Terms sort', 'wpmoviescore' ),
				'desc'    => __( 'How terms should be sorted by default.', 'wpmoviescore' ),
				'options' => array(
					'count' => __( 'Movie count', 'wpmoviescore' ),
					'title' => __( 'Title', 'wpmoviescore' ),
				),
				'default' => 'title'
			),

			// Taxonomy archives page sorting order
			'terms-order'            => array(
				'id'      => 'wpmcp-tax-archives-terms-order',
				'type'    => 'button_set',
				'title'   => __( 'Terms order', 'wpmoviescore' ),
				'desc'    => __( 'How terms should be ordered by default.', 'wpmoviescore' ),
				'options' => array(
					'ASC'  => __( 'Ascending' ),
					'DESC' => __( 'Descending' ),
				),
				'default' => 'ASC'
			),

			// Taxonomy archives page number of terms per page
			'terms-per-page'         => array(
				'id'       => 'wpmcp-tax-archives-terms-per-page',
				'type'     => 'text',
				'title'    => __( 'Terms per page', 'wpmoviescore' ),
				'desc'     => __( 'How many terms should be listed per archive page.', 'wpmoviescore' ),
				'validate' => 'numeric',
				'default'  => 50
			),

			// Taxonomy archives page max number of terms per page
			'terms-limit'            => array(
				'id'       => 'wpmcp-tax-archives-terms-limit',
				'type'     => 'text',
				'title'    => __( 'Terms per page limit', 'wpmoviescore' ),
				'desc'     => __( 'Limit the number of terms per page to be listed. Can be useful if your dealing with massive numbers of terms.', 'wpmoviescore' ),
				'validate' => 'numeric',
				'default'  => 999
			),

			// Taxonomy archives page frontend inputs
			'frontend-edit'          => array(
				'id'      => 'wpmcp-tax-archives-frontend-edit',
				'type'    => 'switch',
				'title'   => __( 'Editable terms-per-page value', 'wpmoviescore' ),
				'desc'    => __( 'If enabled, allows terms-per-page value to be modified on frontend. The sorting menu will show an input where visitors can change the terms-per-page value to display more or less terms. It is recommended to set a limit above if this feature is to be activated.', 'wpmoviescore' ),
				'on'      => __( 'Enabled', 'wpmoviescore' ),
				'off'     => __( 'Disabled', 'wpmoviescore' ),
				'default' => 0
			),
		)
	),

	// 'wpmcp-translate' Languages
	array(
		'icon'    => 'wpmolicon icon-language',
		'title'   => __( 'Languages', 'wpmoviescore' ),
		'heading' => __( 'Languages Support', 'wpmoviescore' ),
		'fields'  => array()
	),

	// 'wpmcp-translate' Translation settings subsection
	array(
		'icon'       => 'wpmolicon icon-flag',
		'title'      => __( 'Translation', 'wpmoviescore' ),
		'heading'    => __( 'Translation settings', 'wpmoviescore' ),
		'subsection' => true,
		'fields'     => array(

			'translate-countries' => array(
				'id'      => 'wpmcp-translate-countries',
				'type'    => 'switch',
				'title'   => __( 'Translate Countries', 'wpmoviescore' ),
				'desc'    => __( 'If enabled, countries names will be translated to the current WordPress language.', 'wpmoviescore' ),
				'on'      => __( 'Enabled', 'wpmoviescore' ),
				'off'     => __( 'Disabled', 'wpmoviescore' ),
				'default' => 1
			),

			'countries-format' => array(
				'id'       => 'wpmcp-countries-format',
				'type'     => 'select',
				'multi'    => true,
				'sortable' => true,
				'title'    => __( 'Country names format', 'wpmoviescore' ),
				'desc'     => sprintf( __( 'How production countries should be appear in your movies. Default is <code>Flag + translation</code> showing something like <code>%s</code>.', 'wpmoviescore' ), sprintf( '<span class="flag flag-ir"></span> %s', __( 'Ireland', 'wpmoviescore-iso' ) ) ),
				'options'  => array(
					'flag'        => __( 'Flag', 'wpmoviescore' ),
					'original'    => __( 'Original', 'wpmoviescore' ),
					'translated'  => __( 'Translation', 'wpmoviescore' ),
					'ptranslated' => sprintf( '(%s)', __( 'Translation', 'wpmoviescore' ) ),
					'poriginal'   => sprintf( '(%s)', __( 'Original', 'wpmoviescore' ) )
				),
				'default'  => array(
					'flag',
					'translated'
				),
				'required' => array( 'wpmcp-translate-countries', "=", 1 ),
			),

			'translate-languages' => array(
				'id'      => 'wpmcp-translate-languages',
				'type'    => 'switch',
				'title'   => __( 'Translate Languages', 'wpmoviescore' ),
				'desc'    => __( 'If enabled, languages names will be translated to the current WordPress language.', 'wpmoviescore' ),
				'on'      => __( 'Enabled', 'wpmoviescore' ),
				'off'     => __( 'Disabled', 'wpmoviescore' ),
				'default' => 1
			),

			'languages-format' => array(
				'id'       => 'wpmcp-languages-format',
				'type'     => 'select',
				'multi'    => true,
				'sortable' => true,
				'title'    => __( 'Languages names format', 'wpmoviescore' ),
				'desc'     => __( 'How spoken languages should be appear in your movies. Default is translated.', 'wpmoviescore' ),
				'options'  => array(
					'original'    => __( 'Original', 'wpmoviescore' ),
					'translated'  => __( 'Translation', 'wpmoviescore' ),
					'ptranslated' => sprintf( '(%s)', __( 'Translation', 'wpmoviescore' ) ),
					'poriginal'   => sprintf( '(%s)', __( 'Original', 'wpmoviescore' ) ),
					'atranslated' => __( 'Abbreviated translation', 'wpmoviescore' ),
					'aoriginal'   => __( 'Abbreviated original', 'wpmoviescore' )
				),
				'default'  => array(
					'translated'
				),
				'required' => array( 'wpmcp-translate-languages', "=", 1 ),
			),
		)
	),

	// 'wpmcp-rewrite' Permalinks settings subsection
	array(
		'icon'       => 'wpmolicon icon-link',
		'title'      => __( 'Permalinks', 'wpmoviescore' ),
		'heading'    => __( 'Rewrite rules & Permalinks', 'wpmoviescore' ),
		'desc'       => __( 'You can adapt the plugin’s permalinks to your local language.', 'wpmoviescore' ),
		'subsection' => true,
		'fields'     => array(

			// Movie URL Rewrite Rule
			'rewrite-enable'     => array(
				'id'      => 'wpmcp-rewrite-enable',
				'type'    => 'switch',
				'title'   => __( 'Translate permalinks', 'wpmoviescore' ),
				'desc'    => __( 'Although it can be very tempting to customize your URLs, <strong>beware</strong>: you probably shouldn\'t modify this more than once if your site relies on search engines; changing URLs too often will could badly affect your site’s referencing.', 'wpmoviescore' ),
				'on'      => __( 'Enabled', 'wpmoviescore' ),
				'off'     => __( 'Disabled', 'wpmoviescore' ),
				'default' => 1,
				'indent'  => true
			),

			// Movie URL Rewrite Rule
			'rewrite-movie'      => array(
				'id'                => 'wpmcp-rewrite-movie',
				'type'              => 'text',
				'title'             => __( 'Movies URL Rewrite', 'wpmoviescore' ),
				'desc'              => __( 'URL Rewrite Rule to apply on movies. Default is <code>movies</code>, resulting in URL like <code>http://yourblog/movies/fight-club</code>. You can use this field to translate URLs to your language.', 'wpmoviescore' ),
				'validate_callback' => 'WPMCP_Utils::permalinks_changed',
				'default'           => 'movies',
				'required'          => array( 'wpmcp-rewrite-enable', "=", 1 ),
				'indent'            => true
			),

			// Collections URL Rewrite Rule
			'rewrite-collection' => array(
				'id'                => 'wpmcp-rewrite-collection',
				'type'              => 'text',
				'title'             => __( 'Collections URL Rewrite', 'wpmoviescore' ),
				'desc'              => __( 'URL Rewrite Rule to apply on collections. Default is <code>collection</code>, resulting in URL like <code>http://yourblog/collection/david-fincher</code>. You can use this field to translate URLs to your language.', 'wpmoviescore' ),
				'validate_callback' => 'WPMCP_Utils::permalinks_changed',
				'default'           => 'collection',
				'required'          => array(
					array( 'wpmcp-rewrite-enable', "=", 1 ),
					array( 'wpmcp-enable-collection', "=", 1 )
				),
				'indent'            => true
			),

			// Genres URL Rewrite Rule
			'rewrite-genre'      => array(
				'id'                => 'wpmcp-rewrite-genre',
				'type'              => 'text',
				'title'             => __( 'Genres URL Rewrite', 'wpmoviescore' ),
				'desc'              => __( 'URL Rewrite Rule to apply on genres. Default is <code>genre</code>, resulting in URL like <code>http://yourblog/genre/thriller</code>. You can use this field to translate URLs to your language.', 'wpmoviescore' ),
				'validate_callback' => 'WPMCP_Utils::permalinks_changed',
				'default'           => 'genre',
				'required'          => array(
					array( 'wpmcp-rewrite-enable', "=", 1 ),
					array( 'wpmcp-enable-genre', "=", 1 )
				),
				'indent'            => true
			),

			// Actors URL Rewrite Rule
			'rewrite-actor'      => array(
				'id'                => 'wpmcp-rewrite-actor',
				'type'              => 'text',
				'title'             => __( 'Actors URL Rewrite', 'wpmoviescore' ),
				'desc'              => __( 'URL Rewrite Rule to apply on actors. Default is <code>actor</code>, resulting in URL like <code>http://yourblog/actor/brad-pitt</code>. You can use this field to translate URLs to your language.', 'wpmoviescore' ),
				'validate_callback' => 'WPMCP_Utils::permalinks_changed',
				'default'           => 'actor',
				'required'          => array(
					array( 'wpmcp-rewrite-enable', "=", 1 ),
					array( 'wpmcp-enable-actor', "=", 1 )
				),
				'indent'            => true
			),

			// Movie URL Rewrite Rule
			/*'rewrite-details' => array(
				'id'       => 'wpmcp-rewrite-details',
				'type'     => 'switch',
				'title'    => __( 'Movie Details URL Rewrite', 'wpmoviescore' ),
				'desc'     => __( 'Use localized URLs for Movie Details. Enable this to have URLs like <code>http://yourblog/films/disponible</code> for French rather than the default <code>http://yourblog/movies/available</code>.', 'wpmoviescore' ),
				'on'       => __( 'Enabled', 'wpmoviescore' ),
				'off'      => __( 'Disabled', 'wpmoviescore' ),
				'validate_callback' => 'WPMCP_Utils::permalinks_changed',
				'default'  => 0,
				'required' => array( 'wpmcp-rewrite-enable', "=", 1 ),
				'indent'   => true
			),*/

		)

	),

	// 'wpmcp-translate' Languages
	array(
		'icon'    => 'wpmolicon icon-style',
		'title'   => __( 'Appearance', 'wpmoviescore' ),
		'heading' => __( 'Styling and customization', 'wpmoviescore' ),
		'fields'  => array()
	),

	// 'wpmcp-translate' Translation settings subsection
	array(
		'icon'       => 'wpmolicon icon-video-format',
		'title'      => __( 'Headbox', 'wpmoviescore' ),
		'heading'    => __( 'Styling the movie headbox', 'wpmoviescore' ),
		'subsection' => true,
		'fields'     => array(

			// Replace excerpt by overview
			'headbox-enable'    => array(
				'id'      => 'wpmcp-headbox-enable',
				'type'    => 'switch',
				'title'   => __( 'Enable Headbox', 'wpmoviescore' ),
				'desc'    => __( 'If enabled, movies will use the Headbox introduced with version 2. Disable to show old metadata display from WPMoviesCore 1.x instead.', 'wpmoviescore' ),
				'on'      => __( 'Enabled', 'wpmoviescore' ),
				'off'     => __( 'Disabled', 'wpmoviescore' ),
				'default' => 1
			),

			// Headbox Position
			'headbox-position'  => array(
				'id'      => 'wpmcp-headbox-position',
				'type'    => 'select',
				'title'   => __( 'Headbox Position', 'wpmoviescore' ),
				'desc'    => __( 'Where to display the Headbox on posts.', 'wpmoviescore' ),
				'options' => array(
					'top'    => __( 'Top', 'wpmoviescore' ),
					'bottom' => __( 'Bottom', 'wpmoviescore' )
				),
				'default' => 'top',
			),

			// Notice
			array(
				'id'     => 'wpmcp-headbox-notice',
				'type'   => 'info',
				'notice' => true,
				'style'  => 'critical',
				'icon'   => 'wpmolicon icon-warning',
				'title'  => __( 'Experimental', 'wpmoviescore' ),
				'desc'   => __( 'The Headbox Themes are still experimental: although they should work correctly they are not fully customisable and have spots for some unimplemented yet features such as actors images. Just so you know!', 'wpmoviescore' )
			),

			// Headbox theme
			'headbox-theme'     => array(
				'id'      => 'wpmcp-headbox-theme',
				'type'    => 'select',
				'title'   => __( 'Headbox Theme', 'wpmoviescore' ),
				'desc'    => __( 'Select a Theme to use for your Headbox.', 'wpmoviescore' ),
				'options' => array(
					'wpmcp'    => __( 'WPMoviesCore', 'wpmoviescore' ),
					'imdb'     => __( 'IMDb', 'wpmoviescore' ),
					'allocine' => __( 'Allociné', 'wpmoviescore' ),
				),
				'default' => 'wpmcp'
			),

			// Default Headbox Tabs
			'headbox-tabs'      => array(
				'id'       => 'wpmcp-headbox-tabs',
				'type'     => 'select',
				'title'    => __( 'Headbox Tabs', 'wpmoviescore' ),
				'desc'     => __( 'Which tabs should appear in the headbox and in which order.', 'wpmoviescore' ) . '<br /><br /><img class="wpmcp-helper" src="' . WPMCP_URL . '/assets/img/headbox_tabs.jpg" alt="" />',
				'multi'    => true,
				'sortable' => true,
				'options'  => array(
					'overview' => __( 'Overview', 'wpmoviescore' ),
					'meta'     => __( 'Metadata', 'wpmoviescore' ),
					'details'  => __( 'Details', 'wpmoviescore' ),
					'actors'   => __( 'Actors', 'wpmoviescore' ),
					'images'   => __( 'Images', 'wpmoviescore' )
				),
				'default'  => array( 'overview', 'meta', 'details', 'images', 'actors' ),
				'required' => array( 'wpmcp-headbox-theme', "=", 'wpmcp' )
			),

			// Title Content
			'headbox-title'     => array(
				'id'       => 'wpmcp-headbox-title',
				'type'     => 'select',
				'title'    => __( 'Headbox Title', 'wpmoviescore' ),
				'desc'     => __( 'Content of the Headbox Title line.', 'wpmoviescore' ) . '<br /><br /><img class="wpmcp-helper" src="' . WPMCP_URL . '/assets/img/headbox_title.jpg" alt="" />',
				'multi'    => true,
				'sortable' => true,
				'options'  => array(),
				'default'  => array( 'title' ),
				'required' => array( 'wpmcp-headbox-theme', "=", 'wpmcp' )
			),

			// Subtitle Content
			'headbox-subtitle'  => array(
				'id'       => 'wpmcp-headbox-subtitle',
				'type'     => 'select',
				'title'    => __( 'Headbox Subtitle', 'wpmoviescore' ),
				'desc'     => __( 'Content of the Headbox Subtitle line.', 'wpmoviescore' ) . '<br /><br /><img class="wpmcp-helper" src="' . WPMCP_URL . '/assets/img/headbox_subtitle.jpg" alt="" />',
				'multi'    => true,
				'sortable' => true,
				'options'  => array(),
				'default'  => array( 'tagline' ),
				'required' => array( 'wpmcp-headbox-theme', "=", 'wpmcp' )
			),

			//  Content
			'headbox-details-1' => array(
				'id'       => 'wpmcp-headbox-details-1',
				'type'     => 'select',
				'title'    => __( 'Headbox Details 1', 'wpmoviescore' ),
				'desc'     => __( 'Content of the Headbox first details line.', 'wpmoviescore' ) . '<br /><br /><img class="wpmcp-helper" src="' . WPMCP_URL . '/assets/img/headbox_details_1.jpg" alt="" />',
				'multi'    => true,
				'sortable' => true,
				'options'  => array(),
				'default'  => array( 'status', 'media' ),
				'required' => array( 'wpmcp-headbox-theme', "=", 'wpmcp' )
			),

			//  Content
			'headbox-details-2' => array(
				'id'       => 'wpmcp-headbox-details-2',
				'type'     => 'select',
				'title'    => __( 'Headbox Details 2', 'wpmoviescore' ),
				'desc'     => __( 'Content of the Headbox second details line.', 'wpmoviescore' ) . '<br /><br /><img class="wpmcp-helper" src="' . WPMCP_URL . '/assets/img/headbox_details_2.jpg" alt="" />',
				'multi'    => true,
				'sortable' => true,
				'options'  => array(),
				'default'  => array( 'release_date', 'runtime' ),
				'required' => array( 'wpmcp-headbox-theme', "=", 'wpmcp' )
			),

			//  Content
			'headbox-details-3' => array(
				'id'       => 'wpmcp-headbox-details-3',
				'type'     => 'select',
				'title'    => __( 'Headbox Details 3', 'wpmoviescore' ),
				'desc'     => __( 'Content of the Headbox third details line.', 'wpmoviescore' ) . '<br /><br /><img class="wpmcp-helper" src="' . WPMCP_URL . '/assets/img/headbox_details_3.jpg" alt="" />',
				'multi'    => true,
				'sortable' => true,
				'options'  => array(),
				'default'  => array( 'rating' ),
				'required' => array( 'wpmcp-headbox-theme', "=", 'wpmcp' )
			)
		)
	),

	// 'wpmcp-cache' Caching
	array(
		'icon'    => 'wpmolicon icon-cache',
		'title'   => __( 'Cache', 'wpmoviescore' ),
		'heading' => __( 'Caching', 'wpmoviescore' ),
		'fields'  => array(

			// Results caching
			'enable' => array(
				'id'      => 'wpmcp-enable-cache',
				'type'    => 'switch',
				'title'   => __( 'Enable Caching', 'wpmoviescore' ),
				'desc'    => __( 'If enabled, WPMoviesCore will cache movie related data to prevent too frequent queries to the database. <strong>This feature is experimental!</strong> Enabling this could generate <strong>huge</strong> amounts of entries in your database. It is recommended to use this feature sparingly, ideally not in production. <a href="http://wpmoviescore.com/documentation/performance">Learn more about caching</a>.', 'wpmoviescore' ),
				'on'      => __( 'Enabled', 'wpmoviescore' ),
				'off'     => __( 'Disabled', 'wpmoviescore' ),
				'default' => 0
			),

			// Results caching
			'user'   => array(
				'id'       => 'wpmcp-user-cache',
				'type'     => 'switch',
				'title'    => __( 'User Caching', 'wpmoviescore' ),
				'desc'     => __( 'If enabled, caching will be activated for logged in users as well as guests.', 'wpmoviescore' ),
				'on'       => __( 'Enabled', 'wpmoviescore' ),
				'off'      => __( 'Disabled', 'wpmoviescore' ),
				'default'  => 0,
				'required' => array( 'wpmcp-enable-cache', "=", 1 ),
				'indent'   => true
			),

			// Caching delay
			'expire' => array(
				'id'       => 'wpmcp-cache-expire',
				'type'     => 'text',
				'title'    => __( 'Caching Time', 'wpmoviescore' ),
				'desc'     => __( 'Time of validity for cached data, in seconds. Default is 3600 (one hour)', 'wpmoviescore' ),
				'validate' => 'numeric',
				'default'  => 3600,
				'required' => array( 'wpmcp-enable-cache', "=", 1 ),
				'indent'   => true
			)
		)
	),

	// 'wpmcp-legacy' Legacy
	array(
		'icon'    => 'wpmolicon icon-legacy',
		'title'   => __( 'Legacy', 'wpmoviescore' ),
		'heading' => __( 'Compatibility settings for WPMoviesCore 1.x', 'wpmoviescore' ),
		'fields'  => array(

			// Results caching
			'legacy-mode'   => array(
				'id'          => 'wpmcp-legacy-mode',
				'type'        => 'switch',
				'title'       => __( 'Enable Legacy mode', 'wpmoviescore' ),
				'subtitle'    => __( 'WPMoviesCore 1.x compatibility mode', 'wpmoviescore' ),
				'description' => __( 'If enabled, WPMoviesCore will automatically update all movies to the new metadata format introduced by version 1.3. Each time a metadata is access, the plugin will look for obsolete metadata and will update it if needed. Once all movies are updated the plugin will stop looking, but you should deactivate this anyway. <a href="http://wpmoviescore.com/development/release-notes/#version-1.3">Learn more about this change</a>.', 'wpmoviescore' ),
				'on'          => __( 'Enabled', 'wpmoviescore' ),
				'off'         => __( 'Disabled', 'wpmoviescore' ),
				'default'     => 0
			),

			// Delete deprecated safety
			'legacy-safety' => array(
				'id'          => 'wpmcp-legacy-safety',
				'type'        => 'switch',
				'title'       => __( 'Enable Legacy Safety mode', 'wpmoviescore' ),
				'subtitle'    => __( 'WPMoviesCore 1.x compatibility safety mode', 'wpmoviescore' ),
				'description' => __( 'If enabled, WPMoviesCore will update deprecated metadata to the new format but will <em>not</em> delete the deprecated metadata for safety.', 'wpmoviescore' ),
				'on'          => __( 'Enabled', 'wpmoviescore' ),
				'off'         => __( 'Disabled', 'wpmoviescore' ),
				'default'     => 1,
				'required'    => array( 'wpmcp-legacy-mode', '=', 1 )
			)
		)
	),

	// 'wpmcp-api' API Settings
	array(
		'icon'    => 'wpmolicon icon-api',
		'title'   => __( 'API', 'wpmoviescore' ),
		'heading' => __( 'TheMovieDB API settings', 'wpmoviescore' ),
		'fields'  => array(

			// API internal mode
			'personnal'   => array(
				'id'       => 'wpmcp-api-internal',
				'type'     => 'switch',
				'title'    => __( 'Personal API Key', 'wpmoviescore' ),
				'subtitle' => __( 'Optional: use your own TMDb API key', 'wpmoviescore' ),
				'desc'     => __( 'A valid TMDb API key is required to fetch informations on the movies you add to WPMoviesCore. Leave deactivated if you do not have a personnal API key. <a href="http://tmdb.caercam.org/">Learn more</a> about the API key or <a href="https://www.themoviedb.org/">get your own</a>.', 'wpmoviescore' ) . ' ' . __( 'If you do not have an API key or do not want to use yours right now, WPMoviesCore will use just its own.', 'wpmoviescore' ),
				'on'       => __( 'Enabled', 'wpmoviescore' ),
				'off'      => __( 'Disabled', 'wpmoviescore' )
			),

			// API Key
			'api_key'     => array(
				'id'                => 'wpmcp-api-key',
				'type'              => 'text',
				'title'             => __( 'API Key', 'wpmoviescore' ),
				'subtitle'          => __( 'Set up your own API key', 'wpmoviescore' ),
				'desc'              => __( 'Using your own API key is a more privacy-safe choice as it will avoid WPMoviesCore to filter queries sent to the API through its own relay server at tmdb.caercam.org. You will also be able to access statistics on your API usage in your TMDb user account.', 'wpmoviescore' ),
				'validate'          => 'no_special_chars',
				'validate_callback' => array( 'WPMCP_TMDb', 'check_api_key' ),
				'default'           => null,
				'required'          => array( 'wpmcp-api-internal', "=", 1 ),
				'indent'            => true
			),

			// API Scheme
			'scheme'      => array(
				'id'      => 'wpmcp-api-scheme',
				'type'    => 'select',
				'title'   => __( 'API Scheme', 'wpmoviescore' ),
				'desc'    => __( 'Default scheme used to contact TMDb API. Default is HTTPS.', 'wpmoviescore' ),
				'options' => array(
					'http'  => __( 'HTTP', 'wpmoviescore' ),
					'https' => __( 'HTTPS', 'wpmoviescore' )
				),
				'default' => 'https'
			),

			// API Language
			'language'    => array(
				'id'      => 'wpmcp-api-language',
				'type'    => 'select',
				'title'   => __( 'API Language', 'wpmoviescore' ),
				'desc'    => __( 'Default language to use when fetching informations from TMDb. Default is english. You can always change this manually when add a new movie.', 'wpmoviescore' ),
				'options' => $wpmcp_supported_languages,
				'default' => 'en'
			),

			// API Country
			'country'     => array(
				'id'      => 'wpmcp-api-country',
				'type'    => 'select',
				'title'   => __( 'API Country', 'wpmoviescore' ),
				'desc'    => __( 'Default country to use when fetching release informations from TMDb. Default is United States. This is mostly used to get movie certifications corresponding to your country.', 'wpmoviescore' ),
				'options' => $wpmcp_supported_countries,
				'default' => 'US'
			),

			// API Alternative Country
			'country-alt' => array(
				'id'      => 'wpmcp-api-country-alt',
				'type'    => 'select',
				'title'   => __( 'API Alternative Country', 'wpmoviescore' ),
				'desc'    => __( 'You can select an alternative country to use when fetching release informations from TMDb. If primary country leaves empty results, the alternative country will be used to fill the blank.', 'wpmoviescore' ),
				'options' => $wpmcp_supported_countries,
				'default' => 'US'
			),
		)
	),

	// 'wpmcp-advanced' Advanced Settings
	array(
		'icon'    => 'wpmolicon icon-advanced',
		'title'   => __( 'Advanced Settings', 'wpmoviescore' ),
		'heading' => __( 'Advanced Plugin Settings & Tools', 'wpmoviescore' ),
		'fields'  => array(

			// API internal mode
			'personnal' => array(
				'id'      => 'wpmcp-debug-mode',
				'type'    => 'switch',
				'title'   => __( 'Debug Mode', 'wpmoviescore' ),
				'desc'    => __( 'Log specific information for debugging purpose.', 'wpmoviescore' ),
				'on'      => __( 'Enabled', 'wpmoviescore' ),
				'off'     => __( 'Disabled', 'wpmoviescore' ),
				'default' => 0
			),
		)
	),

	// Divider
	array(
		'type' => 'divide',
	),

	// 'wpmcp-deactivate' What to do on deactivation
	array(
		'icon'    => 'wpmolicon icon-deactivate',
		'title'   => __( 'Deactivate', 'wpmoviescore' ),
		'heading' => __( 'Deactivation options', 'wpmoviescore' ),
		'fields'  => array(

			'movies' => array(
				'id'      => 'wpmcp-deactivate-movies',
				'type'    => 'select',
				'title'   => __( 'Movie Post Type', 'wpmoviescore' ),
				'desc'    => __( 'How to handle Movies when WPMoviesCore is deactivated.', 'wpmoviescore' ),
				'options' => array(
					'conserve' => __( 'Conserve (recommended)', 'wpmoviescore' ),
					'convert'  => __( 'Convert to Posts', 'wpmoviescore' ),
					'remove'   => __( 'Delete (irreversible)', 'wpmoviescore' ),
					'delete'   => __( 'Delete Completely (irreversible)', 'wpmoviescore' ),
				),
				'default' => 'conserve'
			),

			'collections' => array(
				'id'      => 'wpmcp-deactivate-collections',
				'type'    => 'select',
				'title'   => __( 'Collections Taxonomy', 'wpmoviescore' ),
				'desc'    => __( 'How to handle Collections Taxonomy when WPMoviesCore is deactivated.', 'wpmoviescore' ),
				'options' => array(
					'conserve' => __( 'Conserve (recommended)', 'wpmoviescore' ),
					'convert'  => __( 'Convert to Categories', 'wpmoviescore' ),
					'delete'   => __( 'Delete (irreversible)', 'wpmoviescore' ),
				),
				'default' => 'conserve'
			),

			'genres' => array(
				'id'      => 'wpmcp-deactivate-genres',
				'type'    => 'select',
				'title'   => __( 'Genres Taxonomy', 'wpmoviescore' ),
				'desc'    => __( 'How to handle Genres Taxonomy when WPMoviesCore is deactivated.', 'wpmoviescore' ),
				'options' => array(
					'conserve' => __( 'Conserve (recommended)', 'wpmoviescore' ),
					'convert'  => __( 'Convert to Tags', 'wpmoviescore' ),
					'delete'   => __( 'Delete (irreversible)', 'wpmoviescore' ),
				),
				'default' => 'conserve'
			),

			'actors' => array(
				'id'      => 'wpmcp-deactivate-actors',
				'type'    => 'select',
				'title'   => __( 'Actors Taxonomy', 'wpmoviescore' ),
				'desc'    => __( 'How to handle Actors Taxonomy when WPMoviesCore is deactivated.', 'wpmoviescore' ),
				'options' => array(
					'conserve' => __( 'Conserve (recommended)', 'wpmoviescore' ),
					'convert'  => __( 'Convert to Tags', 'wpmoviescore' ),
					'delete'   => __( 'Delete (irreversible)', 'wpmoviescore' ),
				),
				'default' => 'conserve'
			),

			'cache' => array(
				'id'      => 'wpmcp-deactivate-cache',
				'type'    => 'select',
				'title'   => __( 'Cache', 'wpmoviescore' ),
				'desc'    => __( 'How to handle Cached data when WPMoviesCore is deactivated.', 'wpmoviescore' ),
				'options' => array(
					'conserve' => __( 'Conserve', 'wpmoviescore' ),
					'empty'    => __( 'Empty (recommended)', 'wpmoviescore' ),
				),
				'default' => 'empty'
			)
		)
	),

	// 'wpmcp-uninstall' What to do on uninstallation
	array(
		'icon'    => 'wpmolicon icon-no',
		'title'   => __( 'Uninstall', 'wpmoviescore' ),
		'heading' => __( 'Uninstallation options', 'wpmoviescore' ),
		'fields'  => array(

			'movies' => array(
				'id'      => 'wpmcp-uninstall-movies',
				'type'    => 'select',
				'title'   => __( 'Movie Post Type', 'wpmoviescore' ),
				'desc'    => __( 'How to handle Movies when WPMoviesCore is uninstalled.', 'wpmoviescore' ),
				'options' => array(
					'conserve' => __( 'Conserve', 'wpmoviescore' ),
					'convert'  => __( 'Convert to Posts (recommended)', 'wpmoviescore' ),
					'delete'   => __( 'Delete Completely (irreversible)', 'wpmoviescore' ),
				),
				'default' => 'convert'
			),

			'collections' => array(
				'id'      => 'wpmcp-uninstall-collections',
				'type'    => 'select',
				'title'   => __( 'Collections Taxonomy', 'wpmoviescore' ),
				'desc'    => __( 'How to handle Collections Taxonomy when WPMoviesCore is uninstalled.', 'wpmoviescore' ),
				'options' => array(
					'conserve' => __( 'Conserve', 'wpmoviescore' ),
					'convert'  => __( 'Convert to Categories (recommended)', 'wpmoviescore' ),
					'delete'   => __( 'Delete (irreversible)', 'wpmoviescore' ),
				),
				'default' => 'convert'
			),

			'genres' => array(
				'id'      => 'wpmcp-uninstall-genres',
				'type'    => 'select',
				'title'   => __( 'Genres Taxonomy', 'wpmoviescore' ),
				'desc'    => __( 'How to handle Genres Taxonomy when WPMoviesCore is uninstalled.', 'wpmoviescore' ),
				'options' => array(
					'conserve' => __( 'Conserve', 'wpmoviescore' ),
					'convert'  => __( 'Convert to Tags (recommended)', 'wpmoviescore' ),
					'delete'   => __( 'Delete (irreversible)', 'wpmoviescore' ),
				),
				'default' => 'convert'
			),

			'actors' => array(
				'id'      => 'wpmcp-uninstall-actors',
				'type'    => 'select',
				'title'   => __( 'Actors Taxonomy', 'wpmoviescore' ),
				'desc'    => __( 'How to handle Actors Taxonomy when WPMoviesCore is uninstalled.', 'wpmoviescore' ),
				'options' => array(
					'conserve' => __( 'Conserve', 'wpmoviescore' ),
					'convert'  => __( 'Convert to Tags (recommended)', 'wpmoviescore' ),
					'delete'   => __( 'Delete (irreversible)', 'wpmoviescore' ),
				),
				'default' => 'convert'
			),

			'cache' => array(
				'id'      => 'wpmcp-uninstall-cache',
				'type'    => 'select',
				'title'   => __( 'Cache', 'wpmoviescore' ),
				'desc'    => __( 'How to handle Cached data when WPMoviesCore is uninstalled.', 'wpmoviescore' ),
				'options' => array(
					'conserve' => __( 'Conserve', 'wpmoviescore' ),
					'empty'    => __( 'Empty (recommended)', 'wpmoviescore' ),
				),
				'default' => 'empty'
			)
		)
	),

	// 'wpmcp-import-export' Import/Export
	array(
		'icon'    => 'wpmolicon icon-update',
		'title'   => __( 'Import / Export', 'wpmoviescore' ),
		'heading' => __( 'Import and Export your settings.', 'wpmoviescore' ),
		'fields'  => array(

			'import-export' => array(
				'id'         => 'wpmcp-import-export',
				'type'       => 'import_export',
				'title'      => 'Import Export',
				'subtitle'   => 'Save and restore your settings',
				'full_width' => false,
			)

		),
	),

	// Divider
	/*array(
		'type' => 'divide',
	),*/

	// 'wpmcp-about' About Plugin
	/*array(
		'icon'   => 'wpmolicon icon-info',
		'title'  => __( 'Information', 'wpmoviescore' ),
		'desc'   => __( '<p class="description">This is the Description. Again HTML is allowed</p>', 'wpmoviescore' ),
		'fields' => array(
			array(
				'id'      => 'wpmcp-raw-info',
				'type'    => 'raw',
				'content' => '',
			)
		),
	)*/
);

$legacy_config = array(
	'tmdb'       => array(
		'apikey'       => 'wpmcp-api-key',
		'internal_api' => 'wpmcp-api-internal',
		'lang'         => 'wpmcp-api-language',
		'scheme'       => 'wpmcp-api-scheme'
	),
	'wpml'       => array(
		'show_in_home'     => 'wpmcp-frontpage',
		'movie_rewrite'    => 'wpmcp-rewrite-movie',
		'meta_in_posts'    => 'wpmcp-show-meta',
		'details_in_posts' => 'wpmcp-show-details',
		'details_as_icons' => 'wpmcp-details-icons',
		'date_format'      => 'wpmcp-format-date',
		'time_format'      => 'wpmcp-format-time'
	),
	'images'     => array(
		'poster_featured' => 'wpmcp-poster-featured',
		'poster_size'     => 'wpmcp-poster-size',
		'images_size'     => 'wpmcp-images-size',
		'delete_images'   => 'wpmcp-images-delete',
		'delete_posters'  => 'wpmcp-posters-delete'
	),
	'taxonomies' => array(
		'enable_collection'       => 'wpmcp-enable-collection',
		'collection_rewrite'      => 'wpmcp-rewrite-collection',
		'collection_autocomplete' => 'wpmcp-collection-autocomplete',
		'enable_genre'            => 'wpmcp-enable-genre',
		'genre_rewrite'           => 'wpmcp-rewrite-genre',
		'genre_autocomplete'      => 'wpmcp-genre-autocomplete',
		'enable_actor'            => 'wpmcp-enable-actor',
		'actor_rewrite'           => 'wpmcp-rewrite-actor',
		'actor_autocomplete'      => 'wpmcp-actor-autocomplete',
		'actor_limit'             => 'wpmcp-actor-limit'
	),
	'deactivate' => array(
		'movies'      => 'wpmcp-deactivate-movies',
		'collections' => 'wpmcp-deactivate-collections',
		'genres'      => 'wpmcp-deactivate-genres',
		'actors'      => 'wpmcp-deactivate-actors',
		'cache'       => 'wpmcp-deactivate-cache'
	),
	'uninstall'  => array(
		'movies'      => 'wpmcp-uninstall-movies',
		'collections' => 'wpmcp-uninstall-collections',
		'genres'      => 'wpmcp-uninstall-genres',
		'actors'      => 'wpmcp-uninstall-actors',
		'cache'       => 'wpmcp-uninstall-cache'
	),
	'cache'      => array(
		'caching'      => 'wpmcp-enable-cache',
		'user_caching' => 'wpmcp-user-cache',
		'caching_time' => 'wpmcp-cache-expire'
	)
);