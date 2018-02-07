
$ = $ || jQuery;

wpmcp = wpmcp || {};

	wpmcp.importer = {};
	
		/**
		 * Movies Importer Metadata part
		 * 
		 * @since    1.0
		 */
		wpmcp.importer.meta = wpmcp_import_meta = {

			target: undefined,
			current_post_id: 0,
			current_parent: undefined,

			movie_title: '.movietitle span.movie_title',
			select_list: '.wpmcp-import-movie-select',
			select_all: '.movies > thead input[type=checkbox], .movies > tfoot input[type=checkbox]',
			selected: '.movies > tbody input[type=checkbox]',
			imported: '#wpmcp_imported_ids',
		};

			wpmcp.importer.meta.init = function() {

				$( wpmcp_import_meta.selected ).on( 'click', function() {
					wpmcp_import_meta.update_ids();
				});
			};

			/**
			* Update the imported IDs list
			*/
			wpmcp.importer.meta.update_ids = function( id ) {
				var ids = [];
				if ( undefined != $( '#p_' + id ) ) {
					ids = $( wpmcp_import_meta.imported ).val().split( ',' );
					ids.push( id );
				}
				else {
					$( wpmcp_import_meta.selected + ':checked' ).each( function( i ) {
						ids.push( this.value );
					});
				}
				$( wpmcp_import_meta.imported ).val( ids );
			};

			/**
			* Handle Bulk actions
			*/
			wpmcp.importer.meta.do = function( action ) {

				var $action = $( 'select[name=' + action + ']' ),
				    movies = [];

				if ( 'search' == $action.val() ) {

					$( wpmcp_import_meta.selected + ':checked' ).each( function( i ) {

						var post_id = this.value;
						if ( ! post_id.length || '' != $('#p_' + post_id + '_meta_data_tmdb_id').val() )
							return false;

						var $parent = $( this ).parents( 'tr' );

						$parent.prop( 'id', 'p_' + post_id );
						$parent.find( '.poster' ).addClass( 'loading' );
						wpmcp_import_meta.search( post_id );
					});
				}
				else if ( 'delete' == $action.val() ) {
					$( wpmcp_import_meta.selected + ':checked' ).each( function() {
						movies.push( this.id.replace( 'post_', '' ) );
					});
					$action.nextAll( '.spinner' ).css( { display: 'inline-block' } );
					wpmcp_import_movies.delete( movies );
				}
				else if ( 'enqueue' == $action.val() ) {
					$( wpmcp_import_meta.selected + ':checked' ).each( function() {
						movies.push( this.id.replace( 'post_', '' ) );
					});
					$action.nextAll( '.spinner' ).css( { display: 'inline-block' } );
					wpmcp_movies_queue.add( movies );
				}
				else {
					return false;
				}
			};

			/**
			 * Search movie by its title, update the table row with
			 * Poster and Director and fill the data fields.
			 * 
			 * @since    1.0
			 * 
			 * @param    int       Movie Post ID
			 */
			wpmcp.importer.meta.search = function( post_id ) {

				var post_id = post_id || 0,
				   _post_id = '#p_' + post_id,
				    $parent = $( '#post_' + post_id ).parents( 'tr' ),
				      title = $parent.find( wpmcp_import_meta.movie_title ).text();

				if ( ! post_id || '' != $( '#p_' + post_id + '_meta_data_tmdb_id' ).val() )
					return false;

				$parent.prop( 'id', _post_id.replace( '#', '' ) );
				$parent.find( '.poster' ).addClass( 'loading' );

				wpmcp._get({
					data: {
						action: 'wpmcp_search_movie',
						nonce: wpmcp.get_nonce( 'search-movies' ),
						type: 'title',
						data: title,
						lang: wpmcp_lang.language,
						post_id: post_id
					},
					error: function( response ) {
						wpmcp_state.clear();
						$.each( response.responseJSON.errors, function() {
							wpmcp_state.set( this, 'error' );
						});
					},
					success: function( response ) {

						if ( 'empty' == response.data.result ) {
							$( _post_id ).find( wpmcp_import_meta.movie_title ).after('<div class="import-error">' + response.data.message + '</div>');
							$( _post_id ).find('.loading').removeClass('loading');
						}
						else if ( 'movie' == response.data.result ) {
							wpmcp_import_meta.set( response.data.movies[ 0 ] );
						}
						else if ( 'movies' == response.data.result ) {
							wpmcp_import_meta.select( post_id, response.data.movies, response.data.message );
						}
					},
					complete: function( r ) {
						wpmcp.update_nonce( 'search-movies', r.responseJSON.nonce );
					}
				});

			};

			/**
			 * Display a list of movies matching the search.
			 * 
			 * @since    1.0
			 * 
			 * @param    int       Movies Post ID
			 * @param    object    Movies to add to the selection list
			 * @param    string    Notice message to display
			 */
			wpmcp.importer.meta.select = function( post_id, movies, message ) {

				var post_id = post_id || 0,
				     movies = movies || [],
				    message = message || '',
				    $target = $( '#p_' + post_id ),
				      $next = $target.next(),
				   $tmdb_id = $target.find( '.movie_tmdb_id' );

				if ( ( undefined != $next && $next.hasClass( 'wpmcp-import-movie-select' ) ) || ( undefined != $tmdb_id && '' != $tmdb_id.text() ) )
					return false;

				if ( '' != message ) {
					wpmcp_state.clear();
					wpmcp_state.set( message, 'success' );
				}

				var $movies = $( '<tr class="wpmcp-import-movie-select"><td colspan="7"><div class="tmdb_select_movies"></div></td></tr>' );
				$.each( movies, function() {
					$( '.tmdb_select_movies', $movies ).append( '<div class="tmdb_select_movie"><a href="#" onclick="wpmcp_import_meta.get( ' + post_id + ', ' + this.id + ' ); return false;"><img src="' + this.poster + '" alt="' + this.title + '" /><em>' + this.title + '</em> (' + this.year + ')</a><input type=\'hidden\' value=\'' + this.json + '\' /></div>' );
				});

				$target.after( $movies );
			};

			/**
			 * Display a list of movies matching the search.
			 * 
			 * @since    1.0
			 * 
			 * @param    int    Movie Post ID
			 * @param    int    Movie TMDb ID
			 */
			wpmcp.importer.meta.get = function( post_id, tmdb_id ) {

				var post_id = post_id || 0,
				    tmdb_id = tmdb_id || 0;
	
				wpmcp._get({
					data: {
						action: 'wpmcp_search_movie',
						nonce: wpmcp.get_nonce( 'search-movies' ),
						type: 'id',
						data: tmdb_id,
						post_id: post_id
					},
					beforeSend: function() {
						$( '#p_' + post_id ).next( wpmcp_import_meta.select_list ).remove();
					},
					error: function( response ) {
						wpmcp_state.clear();
						$.each( response.responseJSON.errors, function() {
							wpmcp_state.set( this, 'error' );
						});
					},
					success: function( response ) {
						wpmcp_import_meta.set( response.data );
					},
					complete: function( r ) {
						wpmcp.update_nonce( 'search-movies', r.responseJSON.nonce );
					}
				});
		
			};

			/**
			 * Populate newly fetched movie fields
			 * 
			 * @param    object    Movie TMDb data object
			 */
			wpmcp.importer.meta.set = function( data ) {

				var _post_id = '#p_' + data._id,
				    fields = $( _post_id + '_meta_data input' ),
				    $parent = $( _post_id );

				data.images = [];
				fields.each(function(i, field) {

					var $field = $( field ),
					    f_name = field.id.replace( 'p_' + data._id + '_meta_data_', '' ),
					       sub = wpmcp.switch_data( f_name ),
					     _data = data.meta;

					if ( Array.isArray( _data[ f_name ] ) && _data[ f_name ].length ) {
						var _v = [];
						$.each( _data[ f_name ], function() {
							_v.push( field.value + this );
						});
						_v = _v.join( ', ' );
					}
					else {
						var _v = ( _data[ f_name ] != null ? _data[ f_name ] : '' );
					}

					$field.val( _v );
				});

				$( _post_id + '_meta_data_tmdb_id' ).val( data._tmdb_id );
				$( _post_id + '_meta_data_post_id' ).val( data._id );
				$( _post_id + '_meta_data_poster' ).val( data.poster_path );

				$parent.find( '.poster' ).html( '<img src="' + data.poster + '" alt="' + data.meta.title + '" />' );
				$parent.find( '.movie_title' ).text( data.meta.title );
				$parent.find( '.movie_director' ).text( $( _post_id + '_meta_data_director' ).val() );
				$parent.find( '.movie_tmdb_id' ).html( '<a href="http://www.themoviedb.org/movie/' + data._tmdb_id + '">' + data._tmdb_id + '</a>' );

				$( _post_id + '_meta_data' ).appendTo( '#meta_data' );
				wpmcp_import_meta.update_ids( data._id );
				$parent.find( '.loading' ).removeClass( 'loading' );
			};

		wpmcp_import_meta.init();
