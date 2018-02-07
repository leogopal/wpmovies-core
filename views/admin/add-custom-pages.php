/
		<div id="wpmcp-home" class="wrap">

			<h2><?php _e( 'WPMoviesCore Custom Page creation tool', 'wpmoviescore' ); ?></h2>

			<p><?php _e( 'This page will allow you create custom pages to display your library’s taxonomies and movies archives.', 'wpmoviescore' ); ?></p>

			<div id="dashboard-widgets-wrap">
				<div id="dashboard-widgets" class="metabox-holder">
					<div id="postbox-container-1" class="postbox-container">
						<div id="normal-sortables" class="meta-box-sortables ui-sortable">

<?php if ( ! empty( $existing ) ) : ?>
							<div id="wpmcp_dashboard_missing_pages" class="postbox">
								<h3 class="hndle"><span><?php _e( 'Missing pages', 'wpmoviescore' ); ?></span></h3>
								<div class="inside">

									<div class="main">

										<div class="missing-pages">
<?php if ( ! empty( $missing ) ) : ?>
											<p><?php echo _n( 'The following archive page has no page set:', 'The following archives pages have no pages set:', count( $missing ), 'wpmoviescore' ); ?></p>

											<table id="missing-pages" style="width:100%">
												<tbody>
<?php
foreach ( $missing as $slug => $page ) :
	$title = ucwords( $slug ) . 's';
?>
													<tr>
														<td><?php _e( $title, 'wpmoviescore' ); ?></td>
														<td><a href="<?php echo wpmcp_nonce_url( admin_url( '/admin.php?page=wpmoviescore-add-custom-pages&create_pages=' . $slug ), 'create-custom-pages' ); ?>" class="button button-default"><?php _e( 'Create page', 'wpmoviescore' ); ?></a></td>
													</tr>

<?php endforeach; ?>
												</tbody>
											</table>

<?php else : ?>
											<p><em><?php _e( 'No missing page!', 'wpmoviescore' ) ?></em></p>

<?php endif; ?>
										</div>
									</div>
								</div>
							</div>

							<div id="wpmcp_dashboard_existing_pages" class="postbox">
								<h3 class="hndle"><span><?php _e( 'Existing pages', 'wpmoviescore' ); ?></span></h3>
								<div class="inside">

									<div class="main">

										<div class="existing-pages">
<?php if ( ! empty( $existing ) ) : ?>
											<p><?php echo _n( 'The following page as been set as archive page:', 'The following pages as been set as archive pages:', count( $existing ), 'wpmoviescore' ); ?></p>

											<table id="existing-pages" style="width:100%">
												<thead>
													<tr>
														<th><?php _e( 'Page ID', 'wpmoviescore' ); ?></th>
														<th><?php _e( 'Page Title', 'wpmoviescore' ); ?></th>
														<th><?php _e( 'Archive Type', 'wpmoviescore' ); ?></th>
													</tr>
												</thead>
												<tbody>
<?php
foreach ( $existing as $slug => $page ) :
	$title = ucwords( $slug ) . 's';
?>
													<tr>
														<td>#<?php echo $page->ID; ?></td>
														<td><a href="<?php echo get_permalink( $page->ID ); ?>"><?php echo get_the_title( $page->ID ); ?></a></td>
														<td><?php _e( $title, 'wpmoviescore' ); ?></td>
													</tr>

<?php endforeach; ?>
												</tbody>
											</table>

<?php else : ?>
											<p><em><?php _e( 'No page set yet!', 'wpmoviescore' ) ?></em></p>

<?php endif; ?>
										</div>
									</div>
								</div>
							</div>

<?php else : ?>
							<div id="wpmcp_dashboard_existing_pages" class="postbox">
								<h3 class="hndle"><span><?php _e( 'Create Archives Pages', 'wpmoviescore' ); ?></span></h3>
								<div class="inside">
									<div class="main">
										<p></p>
										<p style="text-align:center"><a href="<?php echo wpmcp_nonce_url( admin_url( '/admin.php?page=wpmoviescore-add-custom-pages&create_pages=all' ), 'create-custom-pages' ); ?>" class="button button-primary button-hero button-wpmcp"><?php _e( 'Create Archives Pages', 'wpmoviescore' ); ?></a></p>
										<p><?php _e( 'This will add four new pages to your site and set them as archives pages: "Movies", "Collections", "Genres" and "Actors".', 'wpmoviescore' ); ?></p>
									</div>
								</div>
							</div>

<?php endif; ?>
						</div>
					</div>

					<div id="postbox-container-2" class="postbox-container">
						<div id="normal-sortables" class="meta-box-sortables ui-sortable">
							<div id="wpmcp_dashboard_create_pages_info" class="postbox">
								<h3 class="hndle"><span><?php _e( 'Custom Archives Pages', 'wpmoviescore' ); ?></span></h3>
								<div class="inside">
									<div class="main">
										<p><?php _e( 'Custom Archives Pages are used to replace WordPress’ default archives pages with more customized views. Taxonomies will appear as list, movies will appear in a poster grid. Both movie and taxonomy archives can be manipulated with an alphabetical menu and sorting options.', 'wpmoviescore' ); ?></p>
										<p><?php printf( __( 'WPMoviesCore can automatically create pages and set them as archive pages, but you can add your own pages and set them manually as archive pages in the "Archives" section of your <a href="%s">Settings panel</a>.', 'wpmoviescore' ), admin_url( '/admin.php?page=wpmoviescore-settings' ) ); ?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
