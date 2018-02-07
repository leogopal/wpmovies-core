<?php
/**
 * WPMoviesCore Dashboard Class extension.
 * 
 * Create a Quick Action Widget.
 *
 * @package   WPMoviesCore
 * @author    Leo Gopal <leo@digitlab.co.za>
 * @license   GPL-3.0
 * @link      http://digitlab.co.za
 * @copyright 2016 CaerCam.org
 */

if ( ! class_exists( 'WPMCP_Dashboard_Quickaction_Widget' ) ) :

	class WPMCP_Dashboard_Quickaction_Widget extends WPMCP_Dashboard {

		/**
		 * Widget ID
		 * 
		 * @since    1.0
		 * 
		 * @var      string
		 */
		protected $widget_id = 'wpmcp_dashboard_quickaction_widget';

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

			$links = array();
			$list = array(
				'new_movie' => array(
					'url'   => admin_url( 'post-new.php?post_type=movie' ),
					'title' => __( 'New movie', 'wpmoviescore' ),
					'icon'  => 'wpmolicon icon-add-page'
				),
				'import'    => array(
					'url'   => admin_url( 'admin.php?page=wpmoviescore-import' ),
					'title' => __( 'Import movies', 'wpmoviescore' ),
					'icon'  => 'wpmolicon icon-import'
				),
				'settings'  => array(
					'url'   => admin_url( 'edit.php?post_type=movie' ),
					'title' => __( 'Manage movies', 'wpmoviescore' ),
					'icon'  => 'wpmolicon icon-movie'
				)
			);

			foreach ( $list as $slug => $data )
				$links[] = sprintf( '<li><a href="%s"><span class="%s"></span><span class="link">%s</span></a></li>', $data['url'], $data['icon'], $data['title'] );

			$links = implode( '', $links );

			echo self::render_admin_template( '/dashboard-quickaction/quickaction.php', array( 'links' => $links ) );
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