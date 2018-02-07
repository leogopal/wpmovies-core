<?php if ( ! is_null( $debug ) ) : ?>
				<div>
					<strong>$main_args:</strong><br />
					<pre><?php print_r( $debug['main_args'] ); ?></pre>
					<strong>$permalinks_args:</strong><br />
					<pre><?php print_r( $debug['permalinks_args'] ); ?></pre>
				</div>
<?php endif; ?>

				<div id="wpmcp-movie-grid" class="wpmcp movies archives<?php echo $theme; ?>">

<?php
global $post;

$headbox_enable = wpmcp_o( 'headbox-enable' );

if ( ! empty( $movies ) ) :
	foreach ( $movies as $post ) :
		setup_postdata( $post );

		if ( '1' == $headbox_enable ) {
			echo WPMCP_Movies::movie_content();
		} else {
?>
					<div id="post-<?php the_ID(); ?>" class="wpmcp movies archives movie">
						<h2><?php the_title(); ?></h2>
<?php
						echo WPMCP_Movies::movie_vintage_content();
?>
					</div>
<?php
		}

	endforeach;
	wp_reset_postdata();
else :
?>
					<h5><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'wpmoviescore' ); ?></h5>
					<p><?php _e( 'We could&rsquo;t find any movie matching your criteria.', 'wpmoviescore' ); ?></p>
<?php endif; ?>

				</div>
