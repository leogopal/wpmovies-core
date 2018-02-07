
$ = $ || jQuery;

wpmcp = wpmcp || {};

	wpmcp.importer = {};
	
		wpmcp.importer.movies = wpmcp_import_movies = {

			list: '#wpmcp_import_list',
			button: '#wpmcp_importer',
		};

			/**
			 * Delete one or more movie import drafts
			 * 
			 * @since    1.0
			 * 
			 * @param    array    Movies to delete
			 */
			wpmcp.importer.movies.delete = function( movies ) {

				if ( ! $.isArray( movies ) )
					var movies = [ movies ];

				$.each( movies, function() {
					$( 'tr#p_' + this ).next( '.wpmcp-import-movie-select' ).remove();
				} );

				wpmcp._get({
					data: {
						action: 'wpmcp_delete_movies',
						nonce: wpmcp.get_nonce( 'delete-movies' ),
						movies: movies
					},
					error: function( response ) {
						wpmcp_state.clear();
						$.each( response.responseJSON.errors, function() {
							wpmcp_state.set( this, 'error' );
						});
					},
					success: function( response ) {

						$(response.data).each( function() {
							$( '#post_' + this ).parents( 'tr, li' ).fadeToggle().remove();
						});

						var message = ( response.data.length > 1 ? wpmcp_lang.deleted_movies : wpmcp_lang.deleted_movie );
						wpmcp_state.clear();
						wpmcp_state.set( message.replace( '%s', response.data.length ), 'error');

						if ( ! $( wpmcp_import_meta.selected + ':checked' ).length ) {
							wpmcp_import_view.reload( {}, 'queued' );
							wpmcp_import_view.reload( {} );
						}
						$( '.spinner' ).hide();
					},
					complete: function( r ) {
						wpmcp.update_nonce( 'delete-movies', r.responseJSON.nonce );
					}
				});
			};

			/**
			 * Import a list of movies by title.
			 * 
			 * Call WPMCP_Import::import_movies_callback() to create movie draft
			 * for each title submitted and update the table
			 * 
			 * @since    1.0
			 */
			wpmcp.importer.movies.import = function() {

				if ( undefined == $( wpmcp_import_movies.list ) || '' == $( wpmcp_import_movies.list ).val() )
					return false;

				wpmcp._post({
					dataType: 'json',
					data: {
						action: 'wpmcp_import_movies',
						nonce: wpmcp.get_nonce( 'import-movies-list' ),
						movies: $( wpmcp_import_movies.list ).val(),
					},
					beforeSend: function() {
						$( wpmcp_import_movies.button ).prev( '.spinner' ).addClass( 'spinning' );
					},
					error: function( response ) {
						wpmcp_state.clear();
						if ( undefined != response.responseJSON.errors ) {
							$.each( response.responseJSON.errors, function() {
								if ( $.isArray( this ) ) {
									$.each( this, function() {
										wpmcp_state.set( this, 'error' );
									});
								}
								else {
									wpmcp_state.set( this, 'error' );
								}
							});
						}
						else
							wpmcp_state.set( wpmcp_lang.oops, 'error' );

						$( wpmcp_import_movies.list ).val( '' );
						wpmcp_import_view.reload({});
					},
					success: function( response ) {

						if ( undefined != response.errors ) {
							wpmcp_state.clear();
							if ( undefined != response.errors ) {
								$.each( response.errors, function() {
									if ( $.isArray( this ) ) {
										$.each( this, function() {
											wpmcp_state.set( this, 'error' );
										});
									}
									else {
										wpmcp_state.set( this, 'error' );
									}
								});
							}
							else
								wpmcp_state.set( wpmcp_lang.oops, 'error' );

							$( wpmcp_import_movies.list ).val( '' );
							wpmcp_import_view.reload({});
						} else {
							var message = ( response.data.length > 1 ? wpmcp_lang.imported_movies : wpmcp_lang.imported_movie );
							$( wpmcp_import_movies.list ).val('');
							wpmcp_state.clear();
							wpmcp_state.set( message.replace( '%s', response.data.length ), 'updated' );
							$( '#_wpmcp_imported' ).trigger( 'click' );
							wpmcp_import_view.reload( {} );
						}
					},
					complete: function( r ) {
						wpmcp.update_nonce( 'import-movies-list', r.responseJSON.nonce );
						$( wpmcp_import_movies.button ).prev( '.spinner' ).removeClass( 'spinning' );
					}
				});
			};