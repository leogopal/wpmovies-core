<?php
/**
 * @package   WPMoviesCore
 * @author    Leo Gopal <leo@digitlab.co.za>
 * @license   GPL-3.0
 * @link      http://digitlab.co.za
 * @copyright 2018 Leo Gopal
 */


/**
 * Movie Details Widget.
 * 
 * Display a list of the Movies Details: Status, Media and Rating. This
 * replace the previous Status, Media and Most Rated Movies Widgets.
 * 
 * @since    1.2
 */
class WPMCP_Details_Widget extends WPMCP_Widget {

	/**
	 * Specifies the classname and description, instantiates the widget. No
	 * stylesheets or JavaScript needed, localization loaded in public class.
	 */
	public function __construct() {

		$this->widget_name        = __( 'WPMoviesCore Details', 'wpmoviescore' );
		$this->widget_description = __( 'Display a list of the available details: status, media and rating.', 'wpmoviescore' );
		$this->widget_css         = 'wpmcp details';
		$this->widget_id          = 'wpmoviescore-details-widget';
		$this->widget_form        = 'details-widget/details-admin.php';

		$this->widget_params      = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Movie Details', 'wpmoviescore' )
			),
			'description' => array(
				'type'  => 'text',
				'std' => ''
			),
			'detail' => array(
				'type' => 'select',
				'std' => ''
			),
			'list' => array(
				'type' => 'checkbox',
				'std' => 0
			),
			'css' => array(
				'type' => 'checkbox',
				'std' => 0
			)
		);

		$this->details = array();

		$supported = WPMCP_Settings::get_supported_movie_details();
		foreach ( $supported as $slug => $detail )
			$this->details[ $slug ] = array(
				'default'  => sprintf( __( 'Select a %s', 'wpmoviescore' ), $slug ),
				'empty'    => sprintf( __( 'No %s to display.', 'wpmoviescore' ), $slug )
			);

		parent::__construct();
	}

	/**
	 * Output the Widget content.
	 * 
	 * @since    1.2
	 *
	 * @param    array    $args The array of form elements
	 * @param    array    $instance The current instance of the widget
	 * 
	 * @return   void
	 */
	public function widget( $args, $instance ) {

		// Caching
		$name = apply_filters( 'wpmcp_cache_name', 'details_widget', $args );
		// Naughty PHP 5.3 fix
		$widget = &$this;
		$content = WPMCP_Cache::output( $name, function() use ( $widget, $args, $instance ) {

			return $widget->widget_content( $args, $instance );
		});

		echo $content;
	}

	/**
	 * Generate the content of the widget.
	 * 
	 * @since    1.2
	 *
	 * @param    array    $args The array of form elements
	 * @param    array    $instance The current instance of the widget
	 * 
	 * @return   string   The Widget Content
	 */
	public function widget_content( $args, $instance ) {

		$defaults = array(
			'title'       => __( 'Movie Details', 'wpmoviescore' ),
			'description' => '',
			'detail'      => '',
			'list'        => 0,
			'css'         => 0
		);
		$args = wp_parse_args( $args, $defaults );

		extract( $args, EXTR_SKIP );
		extract( $instance );

		$title = apply_filters( 'widget_title', $title );

		$details = call_user_func( "WPMCP_Settings::get_available_movie_{$detail}" );
		$rewrite = wpmcp_o( 'rewrite-details' );
		$movies  = wpmcp_o( 'rewrite-movie' );

		if ( ! empty( $details ) ) {

			$baseurl = trailingslashit( get_post_type_archive_link( 'movie' ) );

			$this->widget_css .= " wpmcp {$detail}";

			if ( $css )
				$this->widget_css .= ' list custom';

			$items = array();
			foreach ( $details as $slug => $_title ) {

				$item = array(
					'attr_title'  => sprintf( __( 'Permalink for &laquo; %s &raquo;', 'wpmoviescore' ), __( $_title, 'wpmoviescore' ) ),
					'link'        => WPMCP_Utils::get_meta_permalink(
						array(
							'key'     => $detail,
							'value'   => $slug,
							'type'    => 'detail',
							'format'  => 'raw',
							'baseurl' => $baseurl
						)
					)
				);

				if ( 'rating' != $detail )
					$item['title'] = __( $_title, 'wpmoviescore' );
				else if ( 'rating' == $detail && $list )
					$item['title'] = esc_attr__( $_title, 'wpmoviescore' ) . ' (' . $slug . '&#9733;)';
				else
					$item['title'] = '<div class="movie-rating-display">' . apply_filters( 'wpmcp_movie_rating_stars', $slug, null, null, true ) . '<span class="rating-label">' . esc_attr__( $_title, 'wpmoviescore' ) . '</span></div>';

				$items[] = $item;
			}

			$attributes = array( 'items' => $items, 'description' => $description, 'default_option' => $this->details[ $detail ]['default'], 'style' => $this->widget_css );

			if ( $list )
				$html = WPMoviesCore::render_template( 'details-widget/details-dropdown-list.php', $attributes, $require = 'always' );
			else
				$html = WPMoviesCore::render_template( 'details-widget/details-list.php', $attributes, $require = 'always' );
		}
		else {
			$html = WPMoviesCore::render_template( 'empty.php', array( 'message' => __( 'No detail no show', 'wpmoviescore' ) ), $require = 'always' );
		}

		return $before_widget . $before_title . $title . $after_title . $html . $after_widget;
	}

}
