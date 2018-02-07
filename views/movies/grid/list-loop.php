<?php if ( ! is_null( $debug ) ) : ?>
				<div>
					<strong>$main_args:</strong><br />
					<pre><?php print_r( $debug['main_args'] ); ?></pre>
					<strong>$permalinks_args:</strong><br />
					<pre><?php print_r( $debug['permalinks_args'] ); ?></pre>
				</div>
<?php endif; ?>

				<div id="wpmcp-movie-grid" class="wpmcp movies list<?php echo $theme; ?>">

<?php
global $post;
if ( ! empty( $movies ) ) :
	foreach ( $movies as $letter => $block ) :
?>
					<h5><?php echo $letter ?></h5>
					<ul id="wpmcp-movie-list-<?php echo $letter ?>">
<?php
		foreach ( $block as $movie ) :
?>
						<li id="wpmcp-movie-<?php echo $movie['id']; ?>" class="wpmcp movie">
							<a class="wpmcp list movie link" href="<?php echo $movie['url']; ?>"><?php echo $movie['title']; ?></a>
						</li>

<?php
		endforeach;
?>
					</ul>
<?php
	endforeach;
else :
?>
					<h5><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'wpmoviescore' ); ?></h5>
					<p><?php _e( 'We could&rsquo;t find any movie matching your criteria.', 'wpmoviescore' ); ?></p>
<?php endif; ?>

				</div>
