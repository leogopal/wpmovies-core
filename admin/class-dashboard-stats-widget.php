<?php
/**
 * WPMoviesCore Dashboard Class extension.
 * 
 * Create a Statistics Widget.
 *
 * @package   WPMoviesCore
 * @author    Leo Gopal <leo@digitlab.co.za>
 * @license   GPL-3.0
 * @link      http://digitlab.co.za
 * @copyright 2018 Leo Gopal
 */

if ( ! class_exists( 'WPMCP_Dashboard_Stats_Widget' ) ) :

	class WPMCP_Dashboard_Stats_Widget extends WPMCP_Dashboard {

		/**
		 * Widget ID
		 * 
		 * @since    1.0
		 * 
		 * @var      string
		 */
		protected $widget_id = 'wpmcp_dashboard_stats_widget';

		/**
		 * Constructor
		 *
		 * @since   1.0.0
		 */
		public function __construct() {}

		/**
		 * The Widget content.
		 * 
		 * @since    1.0
		 */
		public function dashboard_widget() {

			$count = (array) wp_count_posts( 'movie' );
			$count = array(
				'movie'       => $count['publish'],
				'imported'    => $count['import-draft'],
				'queued'      => $count['import-queued'],
				'draft'       => $count['draft'],
				'total'       => 0,
			);
			$count['total'] = array_sum( $count );
			$count['collections'] = wp_count_terms( 'collection' );
			$count['genres'] = wp_count_terms( 'genre' );
			$count['actors'] = wp_count_terms( 'actor' );
			$count = array_map( 'intval', $count );

			$links = array();
			$list = array(
				'movie' => array(
					'single' => __( 'One movie', 'wpmoviescore' ),
					'plural' => __( '%d movies', 'wpmoviescore' ),
					'empty'  => __( 'No movie added yet.', 'wpmoviescore' ),
					'url'    => admin_url( 'edit.php?post_type=movie' ),
					'icon'   => 'wpmolicon icon-movie',
					'string' => '<a href="%s">%s</a>'
				),
				'draft' => array(
					'single' => __( 'One movie draft', 'wpmoviescore' ),
					'plural' => __( '%d movies drafts', 'wpmoviescore' ),
					'empty'  => __( 'No draft', 'wpmoviescore' ),
					'url'    => admin_url( 'edit.php?post_status=draft&post_type=movie' ),
					'icon'   => 'wpmolicon icon-edit',
					'string' => '<a href="%s">%s</a>'
				),
				'queued' => array(
					'single' => __( 'One queued movie', 'wpmoviescore' ),
					'plural' => __( '%d queued movies', 'wpmoviescore' ),
					'empty'  => __( 'No queued movie.', 'wpmoviescore' ),
					'url'    => admin_url( 'admin.php?page=wpmoviescore-import&amp;wpmcp_section=wpmcp_import_queue' ),
					'icon'   => 'wpmolicon icon-queued',
					'string' => '<a href="%s">%s</a>'
				),
				'imported' => array(
					'single' => __( 'One imported movie', 'wpmoviescore' ),
					'plural' => __( '%d imported movies', 'wpmoviescore' ),
					'empty'  => __( 'No imported movie.', 'wpmoviescore' ),
					'url'    => admin_url( 'admin.php?page=wpmoviescore-import&amp;wpmcp_section=wpmcp_imported' ),
					'icon'   => 'wpmolicon icon-import',
					'string' => '<a href="%s">%s</a>'
				)
			);

			foreach ( $list as $status => $data ) {
				if ( isset( $count[ $status ] ) ) {
					$movies = $count[ $status ];
					if ( $movies ) {
						$plural = ( 1 < $movies ? sprintf( $data['plural'], $movies ) : $data['single'] );
						$link = sprintf( $data['string'], $data['url'], $plural, $movies );
					}
					else
						$link = $data['empty'];

					$links[] = '<li><span class="' . $data['icon'] . '"></span> ' . $link . '</li>';

				}
			}

			$links = implode( '', $links );
			extract( $count );

			$movies = sprintf( _n( '<strong>1</strong> movie', '<strong>%s</strong> movies', $movie, 'wpmoviescore' ), $movie );
			$movies = sprintf( '<a href="%s">%s</a>', admin_url( 'edit.php?post_type=movie' ), $movies );

			$collections = sprintf( _n( '<strong>1</strong> collection', '<strong>%s</strong> collections', $collections, 'wpmoviescore' ), $collections );
			$collections = sprintf( '<a href="%s">%s</a>', admin_url( 'edit-tags.php?taxonomy=collection&post_type=movie' ), $collections );

			$genres = sprintf( _n( '<strong>1</strong> genre', '<strong>%s</strong> genres', $genres, 'wpmoviescore' ), $genres );
			$genres = sprintf( '<a href="%s">%s</a>', admin_url( 'edit-tags.php?taxonomy=genre&post_type=movie' ), $genres );

			$actors = sprintf( _n( '<strong>1</strong> actor', '<strong>%s</strong> actors', $actors, 'wpmoviescore' ), $actors );
			$actors = sprintf( '<a href="%s">%s</a>', admin_url( 'edit-tags.php?taxonomy=actor&post_type=movie' ), $actors );

			$text = sprintf( __( 'All combined you have a total of %s in your library, regrouped in %s, %s and %s.', 'wpmoviescore' ), $movies, $collections, $genres, $actors );

			echo self::render_admin_template( '/dashboard-statistics/statistics.php', array( 'links' => $links, 'text' => $text ) );
		}

		/**
		 * Widget's configuration callback
		 * 
		 * @since    1.0
		 * 
		 * @param    string    $context box context
		 * @param    mixed     $object gets passed to the box callback function as first parameter
		 */
		public function dashboard_widget_handle( $context, $object ) {}

	}

endif;