<?php
/**
 * WPMoviesCore Utils Formatting_Details Class extension.
 * 
 * This class contains only Details formatting methods.
 * 
 * @package   WPMoviesCore
 * @author    Leo Gopal <leo@digitlab.co.za>
 * @license   GPL-3.0
 * @link      http://digitlab.co.za
 * @copyright 2018 Leo Gopal
 */

if ( ! class_exists( 'WPMCP_Formatting_Details' ) ) :

	class WPMCP_Formatting_Details {

		/**
		 * Hooks priority.
		 * 
		 * @since    2.0
		 * @var      int
		 */
		public static $priority = 10;

		/**
		 * Format a Movie's media. If format is HTML, will return a
		 * HTML formatted string; will return the value without change
		 * if raw is asked.
		 * 
		 * @since    1.1
		 * 
		 * @param    string     $data detail value
		 * @param    string     $format data format, raw or HTML
		 * @param    boolean    $icon Show as icon or text
		 * 
		 * @return   string    Formatted output
		 */
		public static function format_movie_media( $data, $format = 'html', $icon = false ) {

			return self::format_movie_detail( 'media', $data, $format, $icon );
		}

		/**
		 * Format a Movie's status. If format is HTML, will return a
		 * HTML formatted string; will return the value without change
		 * if raw is asked.
		 * 
		 * @since    1.1
		 * 
		 * @param    string     $data detail value
		 * @param    string     $format data format, raw or HTML
		 * @param    boolean    $icon Show as icon or text
		 * 
		 * @return   string    Formatted output
		 */
		public static function format_movie_status( $data, $format = 'html', $icon = false ) {

			return self::format_movie_detail( 'status', $data, $format, $icon );
		}

		/**
		 * Format a Movie's rating. If format is HTML, will return a
		 * HTML formatted string; will return the value without change
		 * if raw is asked.
		 * 
		 * @since    1.1
		 * 
		 * @param    string     $data detail value
		 * @param    string     $format data format, raw or HTML
		 * 
		 * @return   string    Formatted output
		 */
		public static function format_movie_rating( $data, $format = 'html' ) {

			$format = ( 'raw' == $format ? 'raw' : 'html' );

			if ( '' == $data )
				return $data;

			if ( 'html' == $format ) {
				$data = apply_filters( 'wpmcp_movie_rating_stars', $data );
				$data = WPMoviesCore::render_template( 'shortcodes/rating.php', array( 'data' => $data ), $require = 'always' );
			}

			return $data;
		}

		/**
		 * Format a Movie's language. If format is HTML, will return a
		 * HTML formatted string; will return the value without change
		 * if raw is asked.
		 * 
		 * @since    2.0
		 * 
		 * @param    string     $data detail value
		 * @param    string     $format data format, raw or HTML
		 * 
		 * @return   string    Formatted output
		 */
		public static function format_movie_language( $data, $format = 'html' ) {

			$format = ( 'raw' == $format ? 'raw' : 'html' );

			if ( '' == $data )
				return $data;

			if ( wpmcp_o( 'details-icons' ) && 'html' == $format  ) {
				$view = 'shortcodes/detail-icon-title.php';
			} else if ( 'html' == $format ) {
				$view = 'shortcodes/detail.php';
			}

			$title = array();
			$lang  = WPMCP_Settings::get_available_movie_language();

			if ( ! is_array( $data ) )
				$data = array( $data );

			foreach ( $data as $d )
				if ( isset( $lang[ $d ] ) )
					$title[] = __( $lang[ $d ], 'wpmoviescore' );

			$data = WPMoviesCore::render_template( $view, array( 'detail' => 'lang', 'data' => 'lang', 'title' => implode( ', ', $title ) ), $require = 'always' );

			return $data;
		}

		/**
		 * Format a Movie's . If format is HTML, will return a
		 * HTML formatted string; will return the value without change
		 * if raw is asked.
		 * 
		 * @since    2.0
		 * 
		 * @param    string     $data detail value
		 * @param    string     $format data format, raw or HTML
		 * 
		 * @return   string    Formatted output
		 */
		public static function format_movie_subtitles( $data, $format = 'html' ) {

			$format = ( 'raw' == $format ? 'raw' : 'html' );

			if ( '' == $data )
				return $data;

			if ( wpmcp_o( 'details-icons' ) && 'html' == $format  ) {
				$view = 'shortcodes/detail-icon-title.php';
			} else if ( 'html' == $format ) {
				$view = 'shortcodes/detail.php';
			}

			$title = array();
			$lang  = WPMCP_Settings::get_available_movie_language();

			if ( ! is_array( $data ) )
				$data = array( $data );

			foreach ( $data as $d ) {
				if ( 'none' == $d ) {
					$title = array( __( 'None', 'wpmoviescore' ) );
					break;
				} elseif ( isset( $lang[ $d ] ) ) {
					$title[] = __( $lang[ $d ], 'wpmoviescore' );
				}
			}

			$data = WPMoviesCore::render_template( $view, array( 'detail' => 'subtitle', 'data' => 'subtitles', 'title' => implode( ', ', $title ) ), $require = 'always' );

			return $data;
		}

		/**
		 * Format a Movie's . If format is HTML, will return a
		 * HTML formatted string; will return the value without change
		 * if raw is asked.
		 * 
		 * @since    2.0
		 * 
		 * @param    string     $data detail value
		 * @param    string     $format data format, raw or HTML
		 * @param    boolean    $icon Show as icon or text
		 * 
		 * @return   string    Formatted output
		 */
		public static function format_movie_format( $data, $format = 'html', $icon = false ) {

			return self::format_movie_detail( 'format', $data, $format, $icon );
		}

		/**
		 * Format a Movie detail. If format is HTML, will return a
		 * HTML formatted string; will return the value without change
		 * if raw is asked.
		 * 
		 * @since    2.0
		 * 
		 * @param    string     $detail details slug
		 * @param    string     $data detail value
		 * @param    string     $format data format, raw or HTML
		 * @param    boolean    $icon Show as icon or text
		 * 
		 * @return   string    Formatted output
		 */
		public static function format_movie_detail( $detail, $data, $format = 'html', $icon = false ) {

			$format = ( 'raw' == $format ? 'raw' : 'html' );

			if ( '' == $data )
				return $data;

			if ( true === $icon || ( wpmcp_o( 'details-icons' ) && 'html' == $format ) ) {
				$view = 'shortcodes/detail-icon.php';
			} else {
				$view = 'shortcodes/detail.php';
			}

			$title = '';
			$default_fields = call_user_func( "WPMCP_Settings::get_available_movie_{$detail}" );

			if ( ! is_array( $data ) )
				$data = array( $data );

			$_data = '';
			foreach ( $data as $d ) {
				if ( isset( $default_fields[ $d ] ) ) {
					$title = __( $default_fields[ $d ], 'wpmoviescore' );
					$_data .= WPMoviesCore::render_template( $view, array( 'detail' => $detail, 'data' => $d, 'title' => $title ), $require = 'always' );
				}
			}

			return $_data;
		}

	}

endif;
