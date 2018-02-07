<?php
/**
 * Movie Headbox Images Tab Template view
 * 
 * Showing a movie's headbox images tab, Allociné style.
 * 
 * @since    2.1.4
 * 
 * @uses    $posters
 * @uses    $images
 */
?>

					<div id="movie-headbox-<?php echo $id ?>-posters" class="wpmcp headbox allocine movie section images">
						<h3 class="wpmcp headbox allocine movie meta sub-title"><?php _e( 'Posters', 'wpmoviescore' ); ?></h3>
<?php echo $posters; ?>

					</div>
					<hr />
					<div id="movie-headbox-<?php echo $id ?>-images" class="wpmcp headbox allocine movie section images">
						<h3 class="wpmcp headbox allocine movie meta sub-title"><?php _e( 'Movie Pictures', 'wpmoviescore' ); ?></h3>
<?php echo $images; ?>

					</div>
