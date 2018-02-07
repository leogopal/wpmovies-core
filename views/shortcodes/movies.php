<?php
/**
 * Movies Shortcode view Template
 * 
 * Showing a list of movies.
 * 
 * @since    1.2
 * 
 * @uses    $movies
 */
?>

	<div class="wpmcp shortcode block movies">
<?php foreach ( $movies as $movie ) : ?>
		<div class="wpmcp shortcode inline-block movie">
<?php if ( '' != $movie['poster'] ) : ?>
			<div class="wpmcp shortcode poster">
				<a href="<?php echo $movie['url']; ?>"><?php echo $movie['poster']; ?></a>
			</div>
<?php endif; ?>

			<a class="wpmcp shortcode link" href="<?php echo $movie['url']; ?>"><h4><?php echo $movie['title']; ?></h4></a>

			<div class="wpmcp shortcode meta">
<?php
	if ( ! is_null( $movie['meta'] ) ) :
		foreach ( $movie['meta'] as $slug => $meta ) :
?>
				<dt class="wpmcp shortcode meta <?php echo $slug ?> title"><?php echo $meta['title'] ?></dt>
				<dd class="wpmcp shortcode meta <?php echo $slug ?> value"><?php echo $meta['value'] ?></dd>
<?php
		endforeach;
	endif;
?>
			</div>

			<div class="wpmcp shortcode details">
<?php
	if ( ! is_null( $movie['details'] ) )
			echo $movie['details'];
?>
			</div>
		</div>

<?php endforeach; ?>
	</div>
