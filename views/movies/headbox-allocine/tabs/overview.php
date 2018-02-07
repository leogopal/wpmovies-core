<?php
/**
 * Movie Headbox Overview Tab Template view
 * 
 * Showing a movie's headbox overview tab, Allociné style.
 * 
 * @since    2.1.4
 * 
 * @uses    $overview
 */
?>

					<div class="wpmcp headbox allocine movie poster">
<?php if ( ! empty( $poster ) ) : ?>
						<?php echo $poster; ?>

<?php endif; ?>
					</div>
					<div class="wpmcp headbox allocine movie section main">
<?php if ( ! empty( $meta['release_date'] ) ) : ?>
						<div class="wpmcp headbox allocine movie meta release_date">
							<span class="wpmcp headbox allocine movie meta label"><?php _e( 'Release Date', 'wpmoviescore' ); ?>&nbsp;</span>
							<span class="wpmcp headbox allocine movie meta value"><strong><?php echo $meta['release_date']; ?></strong></span>
<?php if ( ! empty( $meta['runtime'] ) && '&mdash;' != $meta['runtime'] ) : ?>
							<span class="wpmcp headbox allocine movie meta value">(<?php echo $meta['runtime']; ?>)</span>
<?php endif; ?>
						</div>
<?php endif; ?>
						<div class="wpmcp headbox allocine movie meta director">
							<span class="wpmcp headbox allocine movie meta label"><?php _e( 'Directed by', 'wpmoviescore' ); ?>&nbsp;</span>
							<span class="wpmcp headbox allocine movie meta value"><?php echo $meta['director']; ?></span>
						</div>
						<div class="wpmcp headbox allocine movie meta cast">
							<span class="wpmcp headbox allocine movie meta label"><?php _e( 'Starring', 'wpmoviescore' ); ?>&nbsp;</span>
							<span class="wpmcp headbox allocine movie meta value"><?php echo $meta['cast']; ?></span>
						</div>
						<div class="wpmcp headbox allocine movie meta writer">
							<span class="wpmcp headbox allocine movie meta label"><?php _e( 'Writer', 'wpmoviescore' ); ?>&nbsp;</span>
							<span class="wpmcp headbox allocine movie meta value"><?php echo $meta['writer']; ?></span>
						</div>
						<div class="wpmcp headbox allocine movie meta composer">
							<span class="wpmcp headbox allocine movie meta label"><?php _e( 'Composer', 'wpmoviescore' ); ?>&nbsp;</span>
							<span class="wpmcp headbox allocine movie meta value"><?php echo $meta['composer']; ?></span>
						</div>
						<div class="wpmcp headbox allocine movie meta genres">
							<span class="wpmcp headbox allocine movie meta label"><?php _e( 'Genres', 'wpmoviescore' ); ?>&nbsp;</span>
							<span class="wpmcp headbox allocine movie meta value"><?php echo $meta['genres']; ?></span>
						</div>
						<div class="wpmcp headbox allocine movie meta production_countries">
							<span class="wpmcp headbox allocine movie meta label"><?php _e( 'Country', 'wpmoviescore' ); ?>&nbsp;</span>
							<span class="wpmcp headbox allocine movie meta value"><?php echo $meta['production_countries']; ?></span>
						</div>
						<div class="wpmcp headbox allocine movie meta rating">
							<span class="wpmcp headbox allocine movie meta label"><?php _e( 'Rating', 'wpmoviescore' ); ?>&nbsp;</span>
							<span class="wpmcp headbox allocine movie meta value"><?php echo $rating; ?></span>
						</div>
					</div>
					<div id="movie-headbox-<?php echo $id ?>-details" class="wpmcp headbox allocine movie section details">
						<h3 class="wpmcp headbox allocine movie meta sub-title"><?php _e( 'Synopsis and Details', 'wpmoviescore' ); ?></h3>
						<p><?php echo $meta['overview']; ?></p>
						<div class="wpmcp headbox allocine movie subsection">
							<ul>
								<li>
									<span class="wpmcp headbox allocine movie meta label"><?php _e( 'Year of production', 'wpmoviescore' ); ?>&nbsp;</span>
									<span class="wpmcp headbox allocine movie meta value"><?php echo $meta['year']; ?></span>
								</li>
								<li>
									<span class="wpmcp headbox allocine movie meta label"><?php _e( 'Release Date', 'wpmoviescore' ); ?>&nbsp;</span>
									<span class="wpmcp headbox allocine movie meta value"><?php echo $meta['release_date']; ?></span>
								</li>
								<li>
									<span class="wpmcp headbox allocine movie meta label"><?php _e( 'Local Release Date', 'wpmoviescore' ); ?>&nbsp;</span>
									<span class="wpmcp headbox allocine movie meta value"><?php echo $meta['local_release_date']; ?></span>
								</li>
							</ul>
						</div>
						<div class="wpmcp headbox allocine movie subsection">
							<ul>
								<li>
									<span class="wpmcp headbox allocine movie meta label"><?php _e( 'Revenue', 'wpmoviescore' ); ?>&nbsp;</span>
									<span class="wpmcp headbox allocine movie meta value"><?php echo $meta['revenue']; ?></span>
								</li>
								<li>
									<span class="wpmcp headbox allocine movie meta label"><?php _e( 'Budget', 'wpmoviescore' ); ?>&nbsp;</span>
									<span class="wpmcp headbox allocine movie meta value"><?php echo $meta['budget']; ?></span>
								</li>
								<li>
									<span class="wpmcp headbox allocine movie meta label"><?php _e( 'Language', 'wpmoviescore' ); ?>&nbsp;</span>
									<span class="wpmcp headbox allocine movie meta value"><?php echo $meta['spoken_languages']; ?></span>
								</li>
							</ul>
						</div>
						<div style="clear:both"></div>
						<div class="wpmcp headbox allocine movie meta more"><a href="#" title="More Details" onclick="wpmcp_headbox.toggle( 'details', <?php echo $id ?> ); return false;"><span class="wpmolicon icon-plus"></span></a></div>
					</div>
					<hr />
					<div id="movie-headbox-<?php echo $id ?>-casting" class="wpmcp headbox allocine movie section cast">
						<h3 class="wpmcp headbox allocine movie meta sub-title"><?php _e( 'Casting', 'wpmoviescore' ); ?></h3>
						<div class="wpmcp headbox allocine movie meta casting">
<?php
foreach ( $casting as $actor ) :
	if ( '&mdash;' != $meta['runtime'] ) :
?>
							<div class="wpmcp headbox allocine movie meta actor">
								<div class="wpmcp headbox allocine movie meta photo"><span class="wpmolicon icon-camera"></span></div>
								<div class="wpmcp headbox allocine movie meta name"><?php echo $actor ?></div>
							</div>

<?php
	endif;
endforeach;
?>
						</div>
						<div class="wpmcp headbox allocine movie meta more"><a href="#" title="Full Casting" onclick="wpmcp_headbox.toggle( 'casting', <?php echo $id ?> ); return false;"><span class="wpmolicon icon-plus"></span></a></div>
					</div>
					<hr />
					<div id="movie-headbox-<?php echo $id ?>-photos" class="wpmcp headbox allocine movie section images">
						<h3 class="wpmcp headbox allocine movie meta sub-title"><?php _e( 'Photos', 'wpmoviescore' ); ?></h3>
<?php echo $images; ?>

						<div class="wpmcp headbox allocine movie meta more"><a href="#" title="More Images" onclick="wpmcp_headbox.toggle( 'photos', <?php echo $id ?> ); return false;"><span class="wpmolicon icon-plus"></span></a></div>
					</div>
 