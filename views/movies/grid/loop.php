<?php if ( ! is_null( $debug ) ) : ?>
				<div>
					<strong>$main_args:</strong><br />
					<pre><?php print_r( $debug['main_args'] ); ?></pre>
					<strong>$permalinks_args:</strong><br />
					<pre><?php print_r( $debug['permalinks_args'] ); ?></pre>
				</div>
<?php endif; ?>

				<div id="wpmcp-movie-grid" class="wpmcp movies grid grid-col-<?php echo $columns . $theme; ?><?php if ( $title || $year || $rating ) echo ' spaced'; ?>">

<?php
global $post;
if ( ! empty( $movies ) ) :
	foreach ( $movies as $post ) :
		setup_postdata( $post );

		$size = 'medium';
		if ( 1 == $columns )
			$size = 'large';

		$class = 'wpmcp movie';
		if ( $title )
			$class .= ' with-title';
		if ( $year )
			$class .= ' with-year';
		if ( $rating )
			$class .= ' with-rating';
?>
					<div id="wpmcp-movie-<?php the_ID(); ?>" <?php post_class( $class ) ?>>
						<a class="wpmcp grid movie link" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
							<?php if ( has_post_thumbnail() ) the_post_thumbnail( $size, array( 'class' => 'wpmcp grid movie poster' ) ); ?>
<?php 	if ( $title ) : ?>
							<h4 class="wpmcp grid movie title"><?php the_title(); ?></h4>
<?php 	endif; if ( $year ) : ?>
							<span class="wpmcp grid movie year"><?php echo apply_filters( 'wpmcp_format_movie_release_date', wpmcp_get_movie_meta( get_the_ID(), 'release_date' ), 'Y' ); ?></span>
<?php 	endif; if ( $rating ) : ?>
							<span class="wpmcp grid movie rating"><?php echo apply_filters( 'wpmcp_movie_rating_stars', wpmcp_get_movie_rating( get_the_ID() ) ); ?></span>
<?php 	endif; ?>
						</a>
					</div>

<?php
	endforeach;
	wp_reset_postdata();
else :
?>
					<h5><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'wpmoviescore' ); ?></h5>
					<p><?php _e( 'We could&rsquo;t find any movie matching your criteria.', 'wpmoviescore' ); ?></p>
<?php endif; ?>

				</div>
