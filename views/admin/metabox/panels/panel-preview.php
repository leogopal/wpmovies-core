
<?php if ( $empty ) : ?>
					<div id="wpmcp-movie-preview-message" class="wpmcp-movie-preview-message">
						<p><em><?php _e( 'Nothing to preview yet!', 'wpmoviescore' ) ?></em></p>
					</div>
<?php endif; ?>

					<div id="wpmcp-movie-preview" class="wpmcp-movie-preview<?php if ( $empty ) echo ' empty' ?>">
						<div id="wpmcp-movie-preview-poster" class="wpmcp-movie-preview-poster">
							<?php echo $thumbnail ?>
						</div>
						<span id="wpmcp-movie-preview-rating"><?php echo $rating ?></span>
						<h3 id="wpmcp-movie-preview-title"><?php echo $preview['title'] ?></h3>
						<h5 id="wpmcp-movie-preview-original_title"><?php echo $preview['original_title'] ?></h5>
						<p>
							<span class="wpmolicon icon-runtime"></span>&nbsp; <span id="wpmcp-movie-preview-runtime"><?php echo $preview['runtime'] ?></span> 
							<span class="wpmolicon icon-tag"></span>&nbsp; <span id="wpmcp-movie-preview-genres"><?php echo $preview['genres'] ?></span> 
							<span class="wpmolicon icon-date"></span>&nbsp; <span id="wpmcp-movie-preview-release_date"><?php echo $preview['release_date'] ?></span>
						</p>
						<p id="wpmcp-movie-preview-overview">
							<span class="wpmolicon icon-overview"></span>&nbsp; <?php echo apply_filters( 'wpmcp_format_movie_overview', $preview['overview'] ) ?>
						</p>
						<p>
							<span class="wpmolicon icon-director"></span>&nbsp; <?php _e ( 'Directed by:', 'wpmoviescore' ) ?>&nbsp; <span id="wpmcp-movie-preview-director"><?php echo $preview['director'] ?></span><br />
							<span class="wpmolicon icon-actor"></span>&nbsp; <?php _e ( 'Starring:', 'wpmoviescore' ) ?>&nbsp; <span id="wpmcp-movie-preview-cast"><?php echo $preview['cast'] ?></span>
						</p>
						<div style="clear:both"></div>
					</div>

