

					<div id="wpmcp-tmdb" class="wpmcp-tmdb">

						<div id="wpmcp-movie-meta-search" class="wpmcp-movie-meta-search">

							<p><strong><?php _e( 'Find movie on TMDb:', 'wpmoviescore' ); ?></strong></p>

							<div>
								<?php wpmcp_nonce_field( 'search-movies' ) ?>
								<select id="tmdb_search_lang" name="wpmcp[lang]" onchange="wpmcp_edit_meta.lang=this.value;">
<?php foreach ( $languages as $code => $lang ) : ?>
									<option value="<?php echo $code ?>" <?php selected( wpmcp_o( 'api-language' ), $code ); ?>><?php echo $lang ?></option>
<?php endforeach; ?>
								</select>
								<select id="tmdb_search_type" name="wpmcp[tmdb_search_type]">
									<option value="title" selected="selected"><?php _e( 'Movie Title', 'wpmoviescore' ); ?></option>
									<option value="id"><?php _e( 'TMDb ID', 'wpmoviescore' ); ?></option>
								</select>
								<input id="tmdb_query" type="text" name="wpmcp[tmdb_query]" value="" size="30" maxlength="32" placeholder="<?php _e( 'ex: The Secret Life of Walter Mitty', 'wpmoviescore' ); ?>" />
								<a id="tmdb_search_clean" title="<?php _e( 'Clean Search', 'wpmoviescore' ); ?>" href="#"><span class="wpmolicon icon-no-alt"></span></a>
								<a id="tmdb_search" name="wpmcp[tmdb_search]" title="<?php _e( 'Search', 'wpmoviescore' ); ?>" href="<?php echo get_edit_post_link() ?>&amp;wpmcp_auto_fetch=1" onclick="wpmcp.editor.meta.search(); return false;" class="button button-secondary button-icon"><span class="wpmolicon icon-search"></span></a>
								<a id="tmdb_update" name="wpmcp[tmdb_update]" title="<?php _e( 'Update', 'wpmoviescore' ); ?>" href="<?php echo get_edit_post_link() ?>&amp;wpmcp_auto_fetch=1" onclick="wpmcp.editor.meta.update(); return false;" class="button button-secondary button-icon"><span class="wpmolicon icon-update"></span></a>
								<span class="spinner"></span>
								<?php wpmcp_nonce_field( 'empty-movie-meta' ) ?>
								<?php wpmcp_nonce_field( 'save-movie-meta' ) ?>
								<a id="tmdb_empty" name="wpmcp[tmdb_empty]" title="<?php _e( 'Empty Results', 'wpmoviescore' ); ?>" href="<?php echo get_edit_post_link() ?>&amp;wpmoviescore-empty-meta=1" onclick="wpmcp.editor.meta.empty_results(); return false;" class="button button-secondary button-empty button-icon hide-if-no-js"><span class="wpmolicon icon-erase"></span></a>
							</div>

							<div id="wpmcp_status"></div>

							<div id="meta_data"></div>

							<input type="hidden" id="wpmcp_actor_limit" class="hide-if-js hide-if-no-js" value="<?php echo wpmcp_o( 'actor-limit' ) ?>" />
							<input type="hidden" id="wpmcp_poster_featured" class="hide-if-js hide-if-no-js" value="<?php echo ( 1 == wpmcp_o( 'poster-featured' ) ? '1' : '0' ) ?>" />

						</div>

						<div id="wpmcp-movie-meta" class="wpmcp-movie-meta">
<?php 
foreach ( $metas as $slug => $meta ) :
	$value = '';
	if ( ! $empty && isset( $metadata[ $slug ] ) )
		$value = apply_filters( 'wpmcp_stringify_array', $metadata[ $slug ] );
?>
							<div class="wpmcp-movie-meta-edit wpmcp-movie-meta-edit-<?php echo $slug; ?> <?php echo $meta['size'] ?>">
								<div class="wpmcp-movie-meta-label">
									<label for="meta_data_<?php echo $slug; ?>"><?php _e( $meta['title'], 'wpmoviescore' ) ?></label>
								</div>
								<div class="wpmcp-movie-meta-value">
<?php if ( 'textarea' == $meta['type'] ) : ?>
									<textarea id="meta_data_<?php echo $slug; ?>" name="meta[<?php echo $slug; ?>]" class="meta-data-field" rows="6"><?php echo $value ?></textarea>
<?php elseif ( in_array( $meta['type'], array( 'text', 'hidden' ) ) ) : ?>
									<input type="<?php echo $meta['type']; ?>" id="meta_data_<?php echo $slug; ?>" name="meta[<?php echo $slug; ?>]" class="meta-data-field" value="<?php echo $value ?>" />
<?php endif; ?>
								</div>
							</div>
<?php endforeach; ?>

						</div>

					</div>