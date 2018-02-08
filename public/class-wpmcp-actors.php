<?php
/**
 * WPMoviesCore Actor Class extension.
 * 
 * Add and manage an Actor Custom Taxonomy
 *
 * @package   WPMoviesCore
 * @author    Leo Gopal <leo@digitlab.co.za>
 * @license   GPL-3.0
 * @link      http://digitlab.co.za
 * @copyright 2018 Leo Gopal
 */

if ( ! class_exists( 'WPMCP_Actors' ) ) :

	class WPMCP_Actors extends WPMCP_Module {

		protected $widgets;

		/**
		 * Constructor
		 *
		 * @since    1.0
		 */
		public function __construct() {

			if ( ! wpmcp_o( 'enable-actor' ) )
				return false;

			$this->register_hook_callbacks();
		}

		/**
		 * Register callbacks for actions and filters
		 * 
		 * @since    1.0
		 */
		public function register_hook_callbacks() {

			add_action( 'init', array( $this, 'register_actor_taxonomy' ) );
		}

		/**
		 * Register an 'Actor' custom taxonomy.
		 * 
		 * Actors are Tag-like taxonomies: not-hierarchical, tagcloud, and
		 * are displayed by a custom way in admin columns. This is meant
		 * to override WordPress default ordering of Taxonomies.
		 * 
		 * @see wpmcp_movies_columns_head()
		 * @see wpmcp_movies_columns_content()
		 *
		 * @since    1.0
		 */
		public function register_actor_taxonomy() {

			$taxonomy    = 'actor';
			$object_type = array( 'movie' );

			$slug = 'actor';
			if ( '1' == wpmcp_o( 'rewrite-enable' ) ) {
				$rewrite = wpmcp_o( 'rewrite-actor' );
				if ( '' != $slug )
					$slug = $rewrite;
			}

			if ( wpmcp_o( 'actor-posts' ) )
				$object_type[] = 'post';

			$args = array(
				'labels'   => array(
					'name'          => __( 'Actors', 'wpmoviescore' ),
					'add_new_item'  => __( 'New Actor', 'wpmoviescore' )
				),
				'show_ui'           => true,
				'show_tagcloud'     => true,
				'show_admin_column' => true,
				'hierarchical'      => false,
				'query_var'         => true,
				'sort'              => true,
				'rewrite'           => array( 'slug' => $slug )
			);

			register_taxonomy( $taxonomy, $object_type, $args );

		}

		/**
		 * Handle Deactivation/Uninstallation actions.
		 * 
		 * Depending on the Plugin settings, conserve, convert, remove
		 * or delete completly all movies created while using the plugin.
		 * 
		 * @param    string    $action Are we deactivating or uninstalling
		 *                             the plugin?
		 * 
		 * @return   boolean   Did everything go smooth or not?
		 */
		public static function clean_actors( $action ) {

			if ( ! in_array( $action, array( 'deactivate', 'uninstall' ) ) )
				return false;

			global $wpdb;
			$wpdb->hide_errors();

			$_action = get_option( 'wpmcp_settings' );
			if ( ! $_action || ! isset( $_action[ "wpmcp-{$action}-actors" ] ) )
				return false;

			$action = $_action[ "wpmcp-{$action}-actors" ];
			if ( is_array( $action ) )
				$action = $action[0];

			$contents = get_terms( array( 'actor' ), array() );

			switch ( $action ) {
				case 'convert':
					foreach ( $contents as $term ) {
						wp_update_term( $term->term_id, 'actor', array( 'slug' => 'wpmcp_actor-' . $term->slug ) );
						$wpdb->update(
							$wpdb->term_taxonomy,
							array( 'taxonomy' => 'post_tag' ),
							array( 'taxonomy' => 'actor' ),
							array( '%s' )
						);
					}
					break;
				case 'delete':
					foreach ( $contents as $term ) {
						wp_delete_term( $term->term_id, 'actor' );
					}
					break;
				default:
					break;
			}
		}

		/**
		 * Prepares sites to use the plugin during single or network-wide activation
		 *
		 * @since    1.0
		 *
		 * @param    bool    $network_wide
		 */
		public function activate( $network_wide ) {

			global $wpdb, $wp_rewrite;
			$wpdb->hide_errors();

			$contents = $wpdb->get_results( 'SELECT term_id, slug FROM ' . $wpdb->terms . ' WHERE slug LIKE "wpmcp_actor%"' );
			$actors      = array();

			foreach ( $contents as $term )
				if ( false !== strpos( $term->slug, 'wpmcp_actor' ) )
					$actors[] = $term->term_id;

			if ( ! empty( $actors ) )
				$wpdb->query( 'UPDATE ' . $wpdb->term_taxonomy . ' SET taxonomy = "actor" WHERE term_id IN (' . implode( ',', $actors ) . ') AND taxonomy = "post_tag"' );

			$wpdb->query(
				'UPDATE ' . $wpdb->terms . ' SET slug = REPLACE(slug, "wpmcp_actor-", "")'
			);

			self::register_actor_taxonomy();

		}

		/**
		 * Rolls back activation procedures when de-activating the plugin
		 *
		 * @since    1.0
		 */
		public function deactivate() {

			self::clean_actors( 'deactivate' );
		}

		/**
		 * Set the uninstallation instructions
		 *
		 * @since    1.0
		 */
		public static function uninstall() {

			self::clean_actors( 'uninstall' );
		}

		/**
		 * Initializes variables
		 *
		 * @since    1.0
		 */
		public function init() {}

	}

endif;