<?php
/**
 * WPMoviesCore Dashboard Class extension.
 * 
 * Create a Promotional Widget.
 *
 * @package   WPMoviesCore
 * @author    Leo Gopal <leo@digitlab.co.za>
 * @license   GPL-3.0
 * @link      http://digitlab.co.za
 * @copyright 2018 Leo Gopal
 */

if ( ! class_exists( 'WPMCP_Dashboard_Vendor_Widget' ) ) :

	class WPMCP_Dashboard_Vendor_Widget extends WPMCP_Dashboard {

		/**
		 * Widget ID
		 * 
		 * @since    1.0
		 * 
		 * @var      string
		 */
		protected $widget_id = 'wpmcp_dashboard_vendor_widget';

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
				'facebook' => array(
					'url'   => 'http://facebook.com/wpmoviescore',
					'title' => 'Facebook',
					'icon'  => 'wpmolicon icon-facebook'
				),
				'twitter' => array(
					'url'   => 'https://twitter.com/WPMoviesCore',
					'title' => 'Twitter',
					'icon'  => 'wpmolicon icon-twitter'
				),
				'google' => array(
					'url'   => 'https://www.google.com/+Wpmovielibraryplugin',
					'title' => 'Google+',
					'icon'  => 'wpmolicon icon-googleplus'
				)
			);

			foreach ( $list as $slug => $data )
				$links[] = sprintf( '<li><a href="%s"><span class="%s"></span><span class="link">%s</span></a></li>', $data['url'], $data['icon'], $data['title'] );

			$links = implode( '', $links );

			echo self::render_admin_template( '/dashboard-vendor/vendor.php', array( 'links' => $links ) );
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