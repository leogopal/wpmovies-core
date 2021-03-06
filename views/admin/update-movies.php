

		<div class="error hide-if-js">
			<p><?php _e( 'It seems you have JavaScript deactivated; the update tool will not work correctly without it, please check your browser\'s settings.', 'wpmoviescore' ); ?></p>
		</div>

		<div id="wpmcp-home" class="wrap">

			<h2><?php printf( '%s <small>v%s</small>', __( 'Welcome to WPMoviesCore ', 'wpmoviescore' ), WPMCP_VERSION ); ?></h2>

			<p><?php _e( 'This page will allow you update your library to the new metadata format introduced in WPMoviesCore 1.3.', 'wpmoviescore' ); ?></p>

			<?php wpmcp_nonce_field( 'update-movie', $referer = false ) ?>
			<?php wpmcp_nonce_field( 'update-movies', $referer = false ) ?>

			<div id="dashboard-widgets-wrap">
				<div id="dashboard-widgets" class="metabox-holder">
					<div id="postbox-container-1" class="postbox-container">
						<div id="normal-sortables" class="meta-box-sortables ui-sortable">
							<div id="wpmcp_dashboard_deprecated_movies" class="postbox">
								<h3 class="hndle"><span><?php _e( 'Update deprecated movie meta', 'wpmoviescore' ); ?></span></h3>
								<div class="inside">

									<div class="main">

										<div class="deprecated-movies">
<?php if ( $deprecated ) : ?>

											<table id="deprecated-movies">
												<thead>
													<tr>
														<th colspan="2"><?php echo _n( 'The following movie needs an update:', 'The following movies needs an update:', count( $deprecated ), 'wpmoviescore' ); ?></th>
													</tr>
													<tr>
														<th colspan="2" height="8"></th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td class="label"><span class="dashicons"><input id="select-all-movies" type="checkbox" onclick="$('.queue-movie > a').click()" /></span></td>
														<td><em><?php _e( 'Select all', 'wpmoviescore' ) ?></em></td>
													</tr>
<?php
	global $post;
	foreach ( $deprecated as $post ) :
		setup_postdata( $post );
?>
													<tr id="movie-<?php the_ID(); ?>">
														<td class="label"><span class="wpmolicon icon-arrow-right"></span></td>
														<td class="movie-title"><span><?php the_title(); ?></span></td>
														<td class="queue-movie"><a id="queue-movie-<?php the_ID(); ?>" href="#" onclick="wpmcp.updates.movies.enqueue( <?php the_ID(); ?> ); return false;"><span class="wpmolicon icon-yes"></span></a></td>
														<td class="update-movie"><a id="update-movie-<?php the_ID(); ?>" href="#" onclick="wpmcp.updates.movies.update( <?php the_ID(); ?> ); return false;"><span class="wpmolicon icon-update"></span></a></td>
													</tr>

<?php
	endforeach;
	wp_reset_postdata();
?>
												</tbody>
											</table>

<?php else : ?>
											<p><em><?php _e( 'No obsolete movie!', 'wpmoviescore' ) ?></em></p>

<?php endif; ?>
										</div>

										<div class="updated-movies">
											<table id="updated-movies">
												<thead>
													<tr>
														<th colspan="2"><?php printf( _n( 'The following movie is up to date:', 'The following movies are up to date:', $updated, 'wpmoviescore' ) ); ?></th>
													</tr>
													<tr>
														<th colspan="2" height="8"></th>
													</tr>
												</thead>
												<tbody>
<?php
global $post;
foreach ( $updated as $post ) :
	setup_postdata( $post );
?>
													<tr id="movie-<?php the_ID(); ?>">
														<td class="label"><span class="wpmolicon icon-yes"></span></td>
														<td class="movie-title"><span><?php the_title(); ?></span></td>
													</tr>

<?php
endforeach;
wp_reset_postdata();
?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div id="postbox-container-2" class="postbox-container">
						<div id="normal-sortables" class="meta-box-sortables ui-sortable">
							<div id="wpmcp_dashboard_deprecated_movies_update" class="postbox">
								<h3 class="hndle"><span><?php _e( 'Update movies', 'wpmoviescore' ); ?></span></h3>
								<div class="inside">
									<div class="main">
										<p><?php printf( __( 'You have a total of <strong>%s</strong> using a deprecated metadata format; you can use the present page to update your library to new format and access new features.', 'wpmoviescore' ), sprintf( _n( 'one movie', '%d movies', count( $deprecated ), 'wpmoviescore' ), count( $deprecated ) ) ); ?></p>
										<p><?php _e( 'You can update all your movies at once, select a few movies manually (<span class="wpmolicon icon-yes"></span> link) or update directly a specific movies (<span class="wpmolicon icon-update"></span> link).', 'wpmoviescore' ) ?></p>
										<p style="text-align:center"><a href="#" class="button button-hero button-primary button-wpmcp" id="launch-update" onclick="wpmcp.updates.movies.update_all(); return false;"><span class="wpmolicon icon-update"></span> <?php _e( 'Update movies', 'wpmoviescore' ) ?></a></p>
									</div>
								</div>
							</div>

							<div id="wpmcp_dashboard_deprecated_movies_update_status" class="postbox">
								<h3 class="hndle"><span><?php _e( 'Update status', 'wpmoviescore' ) ?></span></h3>
								<div class="inside">

									<div class="main">
										<div id="update-movies-progressbar-text"><span class="text"><?php _e( 'ready when you are!', 'wpmoviescore' ) ?></span><span class="value">0%</span><div style="clear:both"></div></div>
										<div id="update-movies-progressbar"><div id="update-movies-progress"></div></div>
										<p><strong><span id="update-movies-count">0</span></strong> <span id="update-movies-count-text"><?php _e( 'movie updated', 'wpmoviescore' ) ?></span>, <strong><span id="update-movies-total">0</span></strong> <span id="update-movies-total-text"><?php _e( 'selected', 'wpmoviescore' ) ?></span>. <a href="#" onclick="$( '#update-movies-log' ).toggle(); return false;"><?php _e( 'See details', 'wpmoviescore' ) ?></a></p>
										<p id="update-movies-log"></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
