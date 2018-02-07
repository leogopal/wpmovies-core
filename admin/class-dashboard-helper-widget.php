<?php
/**
 * WPMoviesCore Dashboard Class extension.
 * 
 * Create a Help & Doc Widget.
 *
 * @package   WPMoviesCore
 * @author    Leo Gopal <leo@digitlab.co.za>
 * @license   GPL-3.0
 * @link      http://digitlab.co.za
 * @copyright 2016 CaerCam.org
 */

if ( ! class_exists( 'WPMCP_Dashboard_Helper_Widget' ) ) :

	class WPMCP_Dashboard_Helper_Widget extends WPMCP_Dashboard {

		/**
		 * Widget ID
		 * 
		 * @since    1.0
		 * 
		 * @var      string
		 */
		protected $widget_id = 'wpmcp_dashboard_helper_widget';

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
				'support' => array(
					'url'   => 'http://wordpress.org/support/plugin/wpmoviescore',
					'title' => __( 'Support', 'wpmoviescore' ),
					'icon'  => 'wpmolicon icon-help'
				),
				'report' => array(
					'url'   => 'https://github.com/wpmoviescore/wpmoviescore/issues/new',
					'title' => __( 'Report a bug', 'wpmoviescore' ),
					'icon'  => 'wpmolicon icon-bug'
				),
				'contribute' => array(
					'url'   => 'https://github.com/wpmoviescore/wpmoviescore',
					'title' => __( 'Contribute', 'wpmoviescore' ),
					'icon'  => 'wpmolicon icon-code'
				),
				'donate' => array(
					'url'   => 'http://wpmoviescore.com/contribute/#donate',
					'title' => __( 'Donate', 'wpmoviescore' ),
					'icon'  => 'wpmolicon icon-heart'
				),
				'documentation' => array(
					'url'   => 'http://wpmoviescore.com/documentation/',
					'title' => __( 'Documentation', 'wpmoviescore' ),
					'icon'  => 'wpmolicon icon-doc'
				),
				'homepage' => array(
					'url'   => 'http://wpmoviescore.com/',
					'title' => __( 'Official website', 'wpmoviescore' ),
					'icon'  => 'wpmolicon icon-home'
				)
			);

			foreach ( $list as $slug => $data )
				$links[] = sprintf( '<li><a href="%s"><span class="%s"></span><span class="link">%s</span></a></li>', $data['url'], $data['icon'], $data['title'] );

			$links = implode( '', $links );

			echo self::render_admin_template( '/dashboard-help/help.php', array( 'links' => $links ) );
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