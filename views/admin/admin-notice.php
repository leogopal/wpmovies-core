
<?php if ( 'api-key-error' == $notice ) : ?>
	<div class="update-nag wpmcp">
		<?php _e( 'You haven\'t specified a valid <acronym title="TheMovieDB">TMDb</acronym> API key in your Settings; this is required for the plugin to search a get movies metadata. WPMoviesCore will use an internal API key, but you may consider getting your own personnal one at <a href="https://www.themoviedb.org/">TMDb</a> to get better results.', 'wpmoviescore' ) ?><br />
		<span style="float:right">
			<a class="button-secondary" href="http://tmdb.caercam.org/"><?php _e( 'Learn more about the internal API key', 'wpmoviescore' ) ?></a>
			<a class="button-primary" href="<?php echo wp_nonce_url( admin_url( '/admin.php?page=wpmoviescore&amp;hide_wpmcp_api_key_notice=1' ), 'hide-wpmcp-api-key-notice', '_nonce' ) ?>"><?php _e( 'Do not notify me again', 'wpmoviescore' ) ?></a>
		</span>
	</div>
<?php endif; if ( 'missing-archive' == $notice ) : ?>

	<div class="update-nag">
		<?php _e( 'WPMoviesCore couldn\'t find an archive page; this page is required to provide archives of your collections, genres and actors.', 'wpmoviescore' ) ?><br /><br />
		<span style="float:right">
			<a class="button-primary" href="<?php echo wp_nonce_url( admin_url( '/admin.php?page=wpmoviescore&amp;wpmcp_set_archive_page=1' ), 'wpmcp-set-archive-page', '_nonce' ) ?>"><?php _e( 'Create an archive page', 'wpmoviescore' ) ?></a>
		</span>
	</div>
<?php endif; if ( 'deprecated-meta' == $notice ) : ?>

	<div class="update-nag warning wpmcp">
		<div class="label"><span class="wpmolicon icon-wpmcp"></span></div>
		<div class="content"><?php printf( __( '<strong>WPMoviesCore found deprecated movie metadata</strong>; since version 1.3 movies metadata are stored and managed differently to provide extended search and filtering features. Therefore, you will need to update your movies to the new standard format. <strong>Not doing so will produce bugs and random behaviours when using the plugin</strong>. Please proceed to <a href="%s">update your movies</a> using the dedicated tool. <a href="http://wpmoviescore.com/development/release-notes/#version-1.3">Learn more about this change</a>.', 'wpmoviescore' ), admin_url( '/admin.php?page=wpmoviescore-update-movies' ) ) ?></div>
	</div>
<?php endif; if ( 'permalinks-changed' == $notice ) : ?>

	<div class="update-nag wpmcp">
		<div class="label"><span class="wpmolicon icon-wpmcp"></span></div>
		<div class="content"><?php printf( __( 'Changes were made that affects the Permalinks. You should visit <a href="%s">WordPress Permalink</a> page to update the Rewrite rules; you may experience errors when trying to load pages using the new URL if the structures are not update correctly. Tip: you don\'t need to change anything in the Permalink page: simply loading it will update the rules.', 'wpmoviescore' ), admin_url( '/options-permalink.php' ) ) ?></div>
	</div>
<?php endif; if ( 'custom-pages' == $notice ) : ?>

	<div class="update-nag wpmcp">
		<div class="label"><span class="wpmolicon icon-wpmcp"></span></div>
		<div class="content">
			<a id="dismiss-custom-pages-notice" href="<?php echo wpmcp_nonce_url( admin_url( '/admin.php?page=wpmoviescore-add-custom-pages&amp;dismiss-custom-pages-notice=1' ), 'dismiss-custom-pages-notice' ) ?>"><span class="wpmolicon icon-no-alt"></span> <?php _e( 'Dismiss', 'wpmoviescore' ); ?></a>
			<?php printf( __( '<strong>New</strong>: you can now use custom pages to display movies and taxonomies archives pages. Go to the new "Archives" tab in your <a href="%s">Settings panel</a> to set up your own pages, or let WPMoviesCore <a href="%s">create them</a> automatically.', 'wpmoviescore' ), admin_url( '/admin.php?page=wpmoviescore-settings' ), admin_url( '/admin.php?page=wpmoviescore-add-custom-pages' ) ) ?>
		</div>
	</div>
<?php endif; if ( 'dismiss-custom-pages' == $notice ) : ?>

	<div class="update-nag updated wpmcp">
		<div class="label"><span class="wpmolicon icon-wpmcp"></span></div>
		<div class="content">
			<?php _e( 'Notice dismissed!', 'wpmoviescore' ) ?>
		</div>
	</div>
<?php endif; ?>
