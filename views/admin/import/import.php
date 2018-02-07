<div id="wpmcp-import" class="wrap">
	<h2><?php _e( 'Movies Import', 'wpmoviescore' ); ?></h2>

	<div class="no-js-alert hide-if-js"><?php _e( 'It seems you have JavaScript deactivated; the import feature will not work correctly without it, please check your browser\'s settings.', 'wpmoviescore' ); ?></div>

	<div id="wpmcp-tabs">

		<div id="wpmcp_status"></div>

		<ul class="wpmcp-tabs-nav">
		    <li class="wpmcp-tabs-nav<?php if ( '' == $_section || 'wpmcp_imported' == $_section ) echo ' active'; ?>"><a id="_wpmcp_imported" href="" data-section="wpmcp_section=wpmcp_imported"><h4><?php _e( 'Imported Movies', 'wpmoviescore' ); ?><span><?php echo $_imported; ?></span></h4></a></li>
		    <li class="wpmcp-tabs-nav<?php if ( 'wpmcp_import_queue' == $_section ) echo ' active'; ?> hide-if-no-js"><a id="_wpmcp_import_queue" href="" data-section="wpmcp_section=wpmcp_import_queue"><h4><?php _e( 'Import Queue', 'wpmoviescore' ); ?><span><?php echo $_queued; ?></span></h4></a></li>
		    <li class="wpmcp-tabs-nav<?php if ( 'wpmcp_import' == $_section ) echo ' active'; ?>"><a id="_wpmcp_import" href="" data-section="wpmcp_section=wpmcp_import"><h4><?php _e( 'Import New Movies', 'wpmoviescore' ); ?></h4></a></li>
		</ul>

		<div class="wpmcp-tabs-panels">

			<div id="wpmcp_imported" class="form-table hide-if-js<?php if ( '' == $_section || 'wpmcp_imported' == $_section ) echo ' active'; ?>">

				<div id="import-intro">
					<p><?php _e( 'Here are the movies you previously updated but didn’t save. You can save them, edit them individually or apply bulk actions. Posters are automatically saved and set as featured images, but images are not. Use the bulk action to import, but be aware that it can take some time if you select a lot of movies. Don’t forget to save your imports when you’re done!', 'wpmoviescore' ); ?></p>
				</div>

				<?php WPMCP_Import::display_import_movie_list(); ?>

				<form method="post" id="meta_data_form">

					<div id="meta_data" style="display:none"></div>

					<p style="text-align:right">
						<?php wpmcp_nonce_field( 'save-imported-movies', $referer = false ) ?>
						<input type="hidden" id="wpmcp_imported_ids" name="wpmcp_imported_ids" value="" />
						<input type="button" id="wpmcp_empty" name="wpmcp_empty" class="button button-secondary button-large" value="<?php _e( 'Empty All', 'wpmoviescore' ); ?>" />
						<input type="submit" id="wpmcp_save_imported" name="wpmcp_save_imported" class="button button-primary button-large" value="<?php _e( 'Save Movies', 'wpmoviescore' ); ?>" />
					</p>

				</form>

			</div>

			<div id="wpmcp_import_queue" class="form-table hide-if-no-js<?php if ( 'wpmcp_import_queue' == $_section ) echo ' active'; ?>">

				<form method="post">
					<input type="hidden" name="page" value="import" />
					<div class="tablenav top hide-if-no-js">
						<div class="alignleft actions bulkactions">
							<select name="queue-action">
								<option value="-1" selected="selected"><?php _e( 'Bulk Actions', 'wpmoviescore' ); ?></option>
									<option value="delete"><?php _e( 'Delete Movie', 'wpmoviescore' ); ?></option>
									<option value="dequeue"><?php _e( 'Dequeue Movie', 'wpmoviescore' ); ?></option>
							</select>
							<input type="submit" name="" id="do-queue-action" class="button action" value="<?php _e( 'Apply', 'wpmoviescore' ); ?>" onclick="wpmcp_movies_queue.do(); return false;">
							<span class="spinner"></span>
						</div>
						<div class="tablenav-pages"><span class="displaying-num"><?php if ( $_queued ) printf( _n( '1 item', '%s items', $_queued ), number_format_i18n( $_queued ) ); else _e( 'No item', 'wpmoviescore' ); ?></span></div>
					</div>
					<div id="wpmcp-queued-list-header" class="hide-if-no-js">
						<div class="check-column"><input type="checkbox" id="post_all" value="" onclick="wpmcp_queue_utils.toggle_inputs();" /></div>
							<div class="movietitle column-movietitle"><?php _e( 'Title', 'wpmoviescore' ) ?></div>
							<div class="director column-director"><?php _e( 'Director', 'wpmoviescore' ) ?></div>
							<div class="actions column-actions"><?php _e( 'Actions', 'wpmoviescore' ) ?></div>
							<div class="status column-status"><?php _e( 'Status', 'wpmoviescore' ) ?></div>
					</div>

					<?php WPMCP_Queue::display_queued_movie_list(); ?>
				</form>

				<form method="post" action="">

					<p style="text-align:right">
						<input type="submit" id="wpmcp_import_queued" name="wpmcp_import_queued" class="button button-primary button-large" value="<?php _e( 'Import Queued Movies', 'wpmoviescore' ); ?>" onclick="wpmcp_movies_queue.import(); return false;" />
						<input type="hidden" id="queue_progress_value" value="0" />
						<div id="queue_progress_block">
							<div id="queue_progressbar"><div id="queue_progress"></div></div>
							<div id="queue_status"><?php printf( '<span id="_queued_imported">%d</span> %s <span id="_queued_left">%d</span> %s', 0, __( 'of', 'wpmoviescore' ), 0, __( 'imported', 'wpmoviescore' ) ); ?></div>
							<div id="queue_status_message"></div>
						</div>
					</p>

				</form>

			</div>

			<div id="wpmcp_import" class="form-table hide-if-js<?php if ( 'wpmcp_import' == $_section ) echo ' active'; ?>">

				<form method="post" action="">

					<table class="form-table wpmcp-settings">
						<tbody>
							<tr valign="top">
								<th scope="row">
									<label for="wpmcp_import_list"><?php _e( 'Input a list of movies to search and import separated by commas:', 'wpmoviescore' ); ?></label>
									<p><em><?php _e( 'Titles don’t have to be exact, but try to be specific to get better results.<br /> Ex: interview with the vampire, Se7en, Twelve Monkeys, joe black, fight club, snatch, babel, inglourious basterds', 'wpmoviescore' ); ?></em></p>
								</th>
								<td>
									<textarea id="wpmcp_import_list" name="wpmcp_import_list" placeholder="<?php _e( 'List of movie titles separated by commas', 'wpmoviescore' ) ?>"></textarea>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"></th>
								<td style="text-align:right">
									<?php wpmcp_nonce_field( 'import-movies-list', $referer = false ) ?>
									<span class="spinner"></span>
									<input type="submit" id="wpmcp_importer" name="wpmcp_importer" class="button button-secondary button-large" value="<?php _e( 'Import Movies', 'wpmoviescore' ); ?>" onclick="wpmcp_import_movies.import(); return false;" />
								</td>
							</tr>
						</tbody>
					</table>

				</form>

				<?php wpmcp_nonce_field( 'imported-movies', $referer = false ) ?>
				<?php wpmcp_nonce_field( 'search-movies', $referer = false ) ?>
				<?php wpmcp_nonce_field( 'enqueue-movies', $referer = false ) ?>
				<?php wpmcp_nonce_field( 'delete-movies', $referer = false ) ?>
				<?php wpmcp_nonce_field( 'queued-movies', $referer = false ) ?>
				<?php wpmcp_nonce_field( 'dequeue-movies', $referer = false ) ?>
				<?php wpmcp_nonce_field( 'import-queued-movies', $referer = false ) ?>

			</div>

		</div>

	</div>

</div>