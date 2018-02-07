<?php
/**
 * WPMoviesCore Metaboxes Class
 *
 * @package   WPMoviesCore
 * @author    Leo Gopal <leo@digitlab.co.za>
 * @license   GPL-3.0
 * @link      http://digitlab.co.za
 * @copyright 2016 Leo Gopal
 */

if ( ! class_exists( 'WPMoviesCore_Metaboxes' ) ) :

	/**
	* @package WPMoviesCore_Admin
	* @author  Leo Gopal <leo@digitlab.co.za>
	*/
	class WPMCP_Metaboxes extends WPMCP_Module {

		/**
		 * Plugin Metaboxes
		 *
		 * @since    2.1.4
		 * @var      array
		 */
		protected $metaboxes = array();

		/**
		 * Constructor
		 *
		 * @since    2.1.4
		 */
		protected function __construct() {

			if ( ! is_admin() )
				return false;

			$this->init();

			$this->register_hook_callbacks();
		}

		/**
		 * Initializes variables
		 *
		 * @since    2.1.4
		 */
		public function init() {

			$this->metaboxes = array(
				'movie' => array(
					'wpmcp' => array(
						'title'         => __( 'WordPress Movie Library', 'wpmoviescore' ),
						'callback'      => 'WPMCP_Edit_Movies::metabox',
						'screen'        => 'movie',
						'context'       => 'normal',
						'priority'      => 'high',
						'callback_args' => array(
							'panels' => array(
								'preview' => array(
									'title'    => __( 'Preview', 'wpmoviescore' ),
									'icon'     => 'wpmolicon icon-video',
									'callback' => 'WPMCP_Edit_Movies::render_preview_panel',
									'default'  => true
								),

								'meta' => array(
									'title'    => __( 'Metadata', 'wpmoviescore' ),
									'icon'     => 'wpmolicon icon-meta',
									'callback' => 'WPMCP_Edit_Movies::render_meta_panel',
									'default'  => false
								),

								'details' => array(
									'title'    => __( 'Details', 'wpmoviescore' ),
									'icon'     => 'wpmolicon icon-details',
									'callback' => 'WPMCP_Edit_Movies::render_details_panel',
									'default'  => false
								),

								'images' => array(
									'title'    => __( 'Images', 'wpmoviescore' ),
									'icon'     => 'wpmolicon icon-images-alt',
									'callback' => 'WPMCP_Edit_Movies::render_images_panel',
									'default'  => false
								),

								'posters' => array(
									'title'    => __( 'Posters', 'wpmoviescore' ),
									'icon'     => 'wpmolicon icon-poster',
									'callback' => 'WPMCP_Edit_Movies::render_posters_panel',
									'default'  => false
								)
							)
						),
						'condition'     => null
					),
				),
				'default' => array(
					'wpmcp' => array(
						'title'         => __( 'WordPress Movie Library', 'wpmoviescore' ),
						'callback'      => 'WPMCP_Edit_Movies::metabox',
						'screen'        => wpmcp_o( 'convert-post-types', array() ),
						'context'       => 'side',
						'priority'      => 'high',
						'callback_args' => null,
						'condition'     => ( '1' == wpmcp_o( 'convert-enable' ) )
					)
				),
			);
		}

		/**
		 * Register callbacks for actions and filters
		 * 
		 * @since    2.1.4
		 */
		public function register_hook_callbacks() {

			$post_types = array_keys( $this->metaboxes );
			unset( $post_types['default'] );

			foreach ( $post_types as $post_type )
				add_action( "add_meta_boxes_{$post_type}", array( $this, 'add_meta_box' ), 10 );

			add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ), 10 );
		}

		

		/**
		 * Register and enqueue admin-specific style sheet.
		 *
		 * @since    2.1.4
		 * 
		 * @param    string    $hook_suffix The current admin page.
		 */
		public function enqueue_admin_styles( $hook_suffix ) {

			
		}

		/**
		 * Register and enqueue global admin JavaScript.
		 * 
		 * @since    2.1.4
		 */
		public function enqueue_admin_scripts() {

			
		}

		/**
		 * Register WPMOLY Metabox
		 * 
		 * @since    2.0
		 * 
		 * @param    object|string    $post_type Current Post object or Current Post post_type
		 */
		public function add_meta_box( $post_type ) {

			$this->metaboxes = apply_filters( 'wpmcp_filter_metaboxes', $this->metaboxes );

			$metaboxes = $this->metaboxes['default'];
			if ( ! empty( $metaboxes ) ) {

				foreach ( $metaboxes as $id => $metabox ) {

					extract( $metabox );

					if ( ! is_array( $screen ) )
						$screen = array( $screen );

					if ( ! is_null( $condition ) && false === $condition )
						continue;

					foreach ( $screen as $s )
						add_meta_box( $id . '-metabox', $title, $callback, $s, $context, $priority, $callback_args );
				}
			}

			if ( is_object( $post_type ) )
				$post_type = $post_type->post_type;

			$metaboxes = $this->metaboxes[ $post_type ];
			if ( empty( $metaboxes ) )
				return false;

			foreach ( $metaboxes as $id => $metabox ) {
				extract( $metabox );
				add_meta_box( $id . '-metabox', $title, $callback, $screen, $context, $priority, $callback_args );
			}
		}

		/**
		 * Prepares sites to use the plugin during single or network-wide activation
		 *
		 * @since    2.1.4
		 *
		 * @param    bool    $network_wide
		 */
		public function activate( $network_wide ) {}

		/**
		 * Rolls back activation procedures when de-activating the plugin
		 *
		 * @since    2.1.4
		 */
		public function deactivate() {}

	}
endif;
