
		<div id="wpmcp_dashboard_welcome_panel_widget" class="<?php if ( in_array( 'wpmcp_dashboard_welcome_panel_widget', $hidden ) ) echo ' hidden hide-if-js'; ?>">
			<div id="wpmcp-welcome-panel" class="welcome-panel">
				<a id="wpmcp-welcome-panel-close" href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=wpmoviescore&amp;show_wpmcp_welcome_panel=1' ), 'show-wpmcp-welcome-panel', 'show_wpmcp_welcome_panel_nonce' ) ?>" class="welcome-panel-close" onclick="wpmcp_dashboard.update_screen_option( 'welcome_panel', false ); return false;"><span class="wpmolicon icon-no-alt"></span><?php _e( 'Dismiss', 'wpmoviescore' ); ?></a>
				<div class="welcome-panel-content">
					<h3><?php _e( 'Welcome to WordPress Movie Core Plugin!', 'wpmoviescore' ); ?></h3>
					<p class="about-description">
						<?php _e( 'Thank you for using WPMoviesCore.', 'wpmoviescore' ); ?>
					</p>
					<div class="welcome-panel-column-container">
						<div class="welcome-panel-column">
							<h4><?php _e( 'Get Started', 'wpmoviescore' ); ?></h4>
							<p><?php printf( __( 'and you may want to look at the <a href="%s">plugin settings</a>.', 'wpmoviescore' ), admin_url( 'admin.php?page=wpmoviescore-settings' ) ) ?></p>
						</div>

						<div class="welcome-panel-column">
							<h4><?php _e( 'Start building your library', 'wpmoviescore' ); ?></h4>
							<ul>
								<li><span class="wpmolicon icon-add-page"></span><a href="<?php echo admin_url( 'post-new.php?post_type=movie' ) ?>"><?php _e( 'Create a movie', 'wpmoviescore' ); ?></a></li>
								<li><span class="wpmolicon icon-import"></span><a href="<?php echo admin_url( 'admin.php?page=wpmoviescore-import' ) ?>"><?php _e( 'Import lists of movies', 'wpmoviescore' ); ?></a></li>
								<li><span class="wpmolicon icon-movie"></span><a href="<?php echo admin_url( 'edit.php?post_type=movie' ) ?>"><?php _e( 'Manage your movies', 'wpmoviescore' ); ?></a></li>
							</ul>
						</div>

						<div class="welcome-panel-column">
							<h4><?php _e( 'Furthermore', 'wpmoviescore' ); ?></h4>
							<ul>
								<li><span class="wpmolicon icon-collection"></span><a href="<?php echo admin_url( 'edit-tags.php?taxonomy=collection&amp;post_type=movie' ) ?>"><?php _e( 'Create and manage Collections', 'wpmoviescore' ); ?></a></li>
								<li><span class="wpmolicon icon-tag"></span><?php printf( __( 'Create and manage <a href="%s">Genres</a> and <a href="%s">Actors</a>', 'wpmoviescore' ), admin_url( 'edit-tags.php?taxonomy=genre&amp;post_type=movie' ), admin_url( 'edit-tags.php?taxonomy=actor&amp;post_type=movie' ) ) ?></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div> 
