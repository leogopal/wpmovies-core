
	<div class="wrap about-wrap">

		<h1><?php printf( __( 'Welcome to WordPress Movie Library&nbsp;%s', 'wpmoviescore' ), WPMCP_VERSION ); ?></h1>

		<div class="about-text"><?php _e( 'Thank you for updating! Discover what this new version of WordPress Movie Library brought you.', 'wpmoviescore' ); ?></div>

		<div class="wp-badge wpmcp-badge"><span class="wpmolicon icon-wpmcp"></span><?php printf( __( 'Version %s', 'wpmoviescore' ), WPMCP_VERSION ); ?></div>

		<h2 class="nav-tab-wrapper">
			<a href="#features" class="nav-tab nav-tab-active">
				<?php _e( 'Features', 'wpmoviescore' ); ?>
			</a><a href="#recommended" class="nav-tab">
				<?php _e( 'Recommendations', 'wpmoviescore' ); ?>
			</a><a href="#credits" class="nav-tab">
				<?php _e( 'Credits', 'wpmoviescore' ); ?>
			</a>
		</h2>

		<div id="features" class="changelog">

			<div class="feature-section col two-col">
				<div class="col-1">
					<h3><?php _e( 'Find the essential', 'wpmoviescore' ); ?></h3>
					<p><?php _e( 'Because your visitors and users want to know everything about your movies in a sight, the public movie information box has been remodeled to show you all you need to see in a single glimpse.', 'wpmoviescore' ); ?></p>
					<p><?php _e( 'Furthermore, metadata have been completely reviewed to make you able to list all movies by a composer, a specific year or langague…', 'wpmoviescore' ); ?></p>
				</div>
				<div class="col-2 last-feature">
					<img src="http://wpmoviescore.com/media/2.0/newheadbox.jpg" />
				</div>
			</div>

			<hr />

			<div class="feature-section col two-col">
				<div class="col-1">
					<img src="http://wpmoviescore.com/media/2.0/newmetabox.jpg" />
				</div>
				<div class="col-2 last-feature">
					<h3><?php _e( 'Smooth metadata editing', 'wpmoviescore' ); ?></h3>
					<p><?php _e( 'Just as you want to find key information quickly, you do not want to spend hours editing your movies. The new metabox makes all the more easier for you to edit whatever information you want: metadata, details, images… The built-in preview tab gives you a nice glimpse of what you have collected so far.', 'wpmoviescore' ); ?></p>
				</div>
			</div>

			<hr />

			<div class="feature-section col two-col">
				<div class="col-1">
					<h3><?php _e( 'Introducing the grid', 'wpmoviescore' ); ?></h3>
					<p><?php _e( 'WordPress Movie Library 2.0 introduces a highly requested feature that will be enhanced add extended in forthcoming versions: the Grid. Show all your movies in an alphabetically sorted grid view and browse through you library.', 'wpmoviescore' ); ?></p>
				</div>
				<div class="col-2 last-feature">
					<img src="http://wpmoviescore.com/media/2.0/thegrid.jpg" />
				</div>
			</div>

			<hr />

			<div class="feature-section col two-col">
				<div class="col-1">
					<img src="http://wpmoviescore.com/media/2.0/settingspanel.jpg" />
				</div>
				<div class="col-2 last-feature">
					<h3><?php _e( 'You own the place', 'wpmoviescore' ); ?></h3>
					<p><?php printf( __( 'And therefore you should be able to tune your library as you please. That is now possible with the new Settings panel powered by the powerful <a href="%s">ReduxFramework</a>.', 'wpmoviescore' ), 'http://reduxframework.com/' ); ?></p>
				</div>
			</div>

			<hr />

			<h3><?php _e( 'Other features include:', 'wpmoviescore' ); ?></h3>

			<div class="feature-section col three-col">
				<div>
					<h4><?php _e( 'Multiple details selection', 'wpmoviescore' ); ?></h4>
					<p><?php _e( 'You can now set multiple medias, languages or subtitles for movies you own on different format or language, or movies you saw in theater before buying DVDs.', 'wpmoviescore' ); ?></p>
				</div>
				<div>
					<h4><?php _e( 'New extendable details', 'wpmoviescore' ); ?></h4>
					<p><?php _e( 'WordPress Movie Library 2.0 includes three new avalaible details: Language, Subtitles and Video Format. Details have also been reorganized to make it easier to programmatically add your own personal details.', 'wpmoviescore' ); ?></p>
				</div>
				<div class="last-feature">
					<h4><?php _e( 'Dedicated icon font', 'wpmoviescore' ); ?></h4>
					<p><?php _e( 'WordPress Movie Library now uses a customized 100+ icons font to ensure compatibility with older WordPress versions that lack Dashicons.', 'wpmoviescore' ); ?></p>
				</div>
			</div>

			<div class="feature-section col three-col">
				<div>
					<h4><?php _e( 'Search support', 'wpmoviescore' ); ?></h4>
					<p><?php _e( 'You can now chose to include movies to your search results and search movies by meta along with other WordPress regular contents.', 'wpmoviescore' ); ?></p>
				</div>
				<div>
					<h4><?php _e( 'Countries and languages translation', 'wpmoviescore' ); ?></h4>
					<p><?php _e( 'Country and language names can now be translated to your own language.', 'wpmoviescore' ); ?></p>
				</div>
				<div class="last-feature">
					<h4><?php _e( 'Translated permalinks', 'wpmoviescore' ); ?></h4>
					<p><?php _e( 'All meta permalinks can now be translated in your own language as well.', 'wpmoviescore' ); ?></p>
				</div>
			</div>
		</div>

		<hr />

		<div class="changelog under-the-hood">
			<h3 id="recommended"><?php _e( 'Recommendations', 'wpmoviescore' ); ?></h3>

			<div class="feature-section col two-col">
				<div class="col-1">
					<img src="http://wpmoviescore.com/media/2.0/updatemovies.jpg" />
				</div>
				<div class="col-2 last-feature">
					<h3><?php _e( 'WordPress Movie Library 1.x movies update', 'wpmoviescore' ); ?></h3>
					<p><?php _e( 'The movie metadata changes in WordPress Movie Library 2.0 require that you update all your movies to the new metadata format in order to access new features. You can use the builtin updater tool to update your movies in a few seconds.', 'wpmoviescore' ); ?></p>
					<p><?php printf( __( '<strong>Make backups of your data before updating your movies</strong>. You should always do this before updating a plugin to the next major release, but in this particular it is most recommended that you backup your site before anything. <a href="%s">Learn why</a>.', 'wpmoviescore' ), 'http://wpmoviescore.com/development/release-notes/#version-1.3' ); ?></p>
				</div>
			</div>

			<hr />

			<h3 id="credits"><?php _e( 'Credits', 'wpmoviescore' ); ?></h3>

			<div class="feature-section">
				<div>
					<strong><?php _e( 'Lead developer', 'wpmoviescore' ); ?></strong>: <a href="http://digitlab.co.za">Leo Gopal</a><br />
					<strong><?php _e( 'Faithful Contributors', 'wpmoviescore' ); ?></strong>: lesurfeur, Ravavamouna, xdarkevil, zack06007, stargatehome, Fjellz, raicabogdan, mstashev, andyshears<br />
					<strong><?php _e( 'German translation', 'wpmoviescore' ); ?></strong>: Mario Winkler<br />
				</div>
			</div>

		</div>

	</div>
