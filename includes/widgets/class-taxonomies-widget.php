<?php
/**
 * @package   WPMoviesCore
 * @author    Leo Gopal <leo@digitlab.co.za>
 * @license   GPL-3.0
 * @link      http://digitlab.co.za
 * @copyright 2018 Leo Gopal
 */


/**
 * Taxonomies Widget.
 * 
 * Display a list of the Movies Taxonomies: Collections, Genres or Actors. This
 * replace the previous  Collections, Genres and Actors Widgets.
 * 
 * @since    1.2
 */
class WPMCP_Taxonomies_Widget extends WPMCP_Widget {

	/**
	 * Specifies the classname and description, instantiates the widget. No
	 * stylesheets or JavaScript needed, localization loaded in public class.
	 */
	public function __construct() {

		$this->widget_name        = __( 'WPMoviesCore Taxonomies', 'wpmoviescore' );
		$this->widget_description = __( 'Display a list of terms from a specific taxonomy: collections, genres or actors.', 'wpmoviescore' );
		$this->widget_css         = 'wpmcp taxonomies';
		$this->widget_id          = 'wpmoviescore-taxonomies-widget';
		$this->widget_form        = 'taxonomies-widget/taxonomies-admin.php';

		$this->widget_params      = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Movie Taxonomies', 'wpmoviescore' )
			),
			'description' => array(
				'type'  => 'text',
				'std' => ''
			),
			'taxonomy' => array(
				'type' => 'select',
				'std' => ''
			),
			'list' => array(
				'type' => 'checkbox',
				'std' => 0
			),
			'count' => array(
				'type' => 'checkbox',
				'std' => 0
			),
			'orderby' =>  array(
				'type' => 'select',
				'std'  => 'count'
			),
			'order' =>  array(
				'type' => 'select',
				'std'  => 'DESC'
			),
			'css' => array(
				'type' => 'checkbox',
				'std' => 0
			),
			'limit' => array(
				'type' => 'number',
				'std' => WPMCP_MAX_TAXONOMY_LIST
			)
		);

		$this->taxonomies = array(
			'collection' => array(
				'default'  => __( 'Select a collection', 'wpmoviescore' ),
				'view_all' => __( 'View all collections', 'wpmoviescore' ),
				'empty'    => __( 'Nothing to display for "Collection" taxonomy.', 'wpmoviescore' )
			),
			'genre' => array(
				'default'  => __( 'Select a genre', 'wpmoviescore' ),
				'view_all' => __( 'View all genres', 'wpmoviescore' ),
				'empty'    => __( 'Nothing to display for "Genre" taxonomy.', 'wpmoviescore' )
			),
			'actor' => array(
				'default'  => __( 'Select an actor', 'wpmoviescore' ),
				'view_all' => __( 'View all actors', 'wpmoviescore' ),
				'empty'    => __( 'Nothing to display for "Actor" taxonomy.', 'wpmoviescore' )
			),
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
		$name = apply_filters( 'wpmcp_cache_name', 'taxonomies_widget', $args );
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

		if ( ! in_array( $instance['taxonomy'], array( 'collection', 'genre', 'actor' ) ) )
			return false;

		$defaults = array(
			'title'       => __( 'Movie Taxonomies', 'wpmoviescore' ),
			'description' => '',
			'taxonomy'    => '',
			'list'        => 0,
			'count'       => 0,
			'orderby'     => 'count',
			'order'       => 'DESC',
			'css'         => 0,
			'limit'       => WPMCP_MAX_TAXONOMY_LIST
		);
		$args = wp_parse_args( $args, $defaults );

		extract( $args, EXTR_SKIP );
		extract( $instance );

		$title = apply_filters( 'widget_title', $title );
		$archive = wpmcp_o( "rewrite-{$taxonomy}" );

		if ( 'ASC' != $order )
			$order = 'DESC';
		if ( 'name' != $orderby )
			$orderby = 'count';

		$args = array( "order={$order}", "orderby={$orderby}" );
		if ( 0 < $limit )
			$args[] = "number={$limit}";

		$args = implode( '&', $args );
		$taxonomies = get_terms( array( $taxonomy ), $args );

		if ( $taxonomies && ! is_wp_error( $taxonomies ) ) {

			$items = array();
			$this->widget_css .= " $taxonomy list";

			if ( $css )
				$this->widget_css .= ' custom';

			foreach ( $taxonomies as $term )
				$items[] = array(
					'attr_title'  => sprintf( __( 'Permalink for &laquo; %s &raquo;', 'wpmoviescore' ), $term->name ),
					'link'        => get_term_link( sanitize_term( $term, $taxonomy ), $taxonomy ),
					'title'       => esc_attr( $term->name . ( $count ? sprintf( '&nbsp;(%d)', $term->count ) : '' ) )
				);

			if ( $limit ) {
				$url = WPMCP_Utils::get_taxonomy_permalink( $archive, $value = false );
				if ( '' != $url ) {
					$items[] = array(
						'attr_title'  => $this->taxonomies[ $taxonomy ]['view_all'],
						'link'        => $url,
						'title'       => __( 'View the complete list', 'wpmoviescore' )
					);
				}
			}

			$items = apply_filters( 'wpmcp_widget_collection_list', $items, $list, $css );
			$attributes = array( 'items' => $items, 'description' => $description, 'default_option' => $this->taxonomies[ $taxonomy ]['default'], 'style' => $this->widget_css );

			if ( $list )
				$html = WPMoviesCore::render_template( 'taxonomies-widget/taxonomies-dropdown-list.php', $attributes, $require = 'always' );
			else
				$html = WPMoviesCore::render_template( 'taxonomies-widget/taxonomies-list.php', $attributes, $require = 'always' );
		}
		else {
			$html = WPMoviesCore::render_template( 'empty.php', array( 'message' => $this->taxonomies[ $taxonomy ]['empty'] ), $require = 'always' );
		}

		return $before_widget . $before_title . $title . $after_title . $html . $after_widget;
	}

}
