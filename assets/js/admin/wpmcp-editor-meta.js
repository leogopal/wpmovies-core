
wpmcp = wpmcp || {};

	wpmcp.editor = {

		_movie_id: $('#post_ID').val(),
		_movie_title: $('#meta_data_title').val(),
		_movie_tmdb_id: $('#meta_data_tmdb_id').val(),
		$spinner: $( '#wpmcp-tmdb .spinner' ),

		autocomplete: {
			collection: $( '#wpmcp-autocomplete-collection' ).val(),
			genre: $( '#wpmcp-autocomplete-genre' ).val(),
			actor: $( '#wpmcp-autocomplete-actor' ).val()
		}

	};

		/**
		 * Movies Post Editor page's Metadata part
		 * 
		 * @since    1.0
		 */
		wpmcp.editor.meta = wpmcp_edit_meta = {

			// Search option
			type: $( '#tmdb_search_type option:selected' ).val(),
			lang: $( '#tmdb_search_lang option:selected' ).val(),
			title: $( '#tmdb_query' ).val(),
			post_id: parseInt( $( '#post_ID' ).val() ),
			tmdb_id: undefined,
			poster_featured: $( '#wpmcp_poster_featured' ).val(),

			updating: false,

			// Events
			_search: {
				element: '#tmdb_search',
				event: 'click'
			},
			_title: {
				element: '#title',
				event: 'input'
			},
			_empty: {
				element: '#tmdb_empty',
				event: 'click'
			},
			_query: {
				element: '#tmdb_query',
				event: 'input'
			},
			_clean: {
				element: '#tmdb_search_clean',
				event: 'click'
			},

			fields: '#meta_data',
		};

			/**
			 * Init Events
			 */
			wpmcp.editor.meta.init = function() {

				redux.field_objects.select.init();

				$( '.add-new-h2' ).on( 'click', function() {
					document.location.href = this.href;
				});

				if ( window.innerWidth < 1180 )
					wpmcp_meta_panel.resize();

				/*$( wpmcp_edit_meta._search.element ).on( wpmcp_edit_meta._search.event, function( e ) {
					e.preventDefault();
					wpmcp_edit_meta.search();
				});*/

				$( wpmcp_edit_meta._title.element ).on( wpmcp_edit_meta._title.event, function( e ) {
					wpmcp_edit_meta.prefill_title( $(this).val() );
				});
			
				/*$( wpmcp_edit_meta._empty.element ).on( wpmcp_edit_meta._empty.event, function( e ) {
					e.preventDefault();
					wpmcp_edit_meta.empty_results();
				});*/

				$( wpmcp_edit_meta._query.element ).on( wpmcp_edit_meta._query.event, function() {
					wpmcp_edit_meta.title = $(this).val();
				});

				$( wpmcp_edit_meta._clean.element ).on( wpmcp_edit_meta._clean.event, function( event ) {

					event.preventDefault();

					$( wpmcp_edit_meta._query.element ).val( '' );
					wpmcp_edit_meta.title = '';
				});

				wpmcp_edit_meta.poster_featured = ( undefined != wpmcp_edit_meta.poster_featured && '1' == wpmcp_edit_meta.poster_featured );
			};

			/**
			 * Search a movie by its title.
			 * 
			 * If a single match if found, set it; if multiple matches
			 * are found, display a selection menu.
			 * 
			 * @since    1.0
			 */
			wpmcp.editor.meta.search = function() {

				if ( '' == wpmcp_edit_meta.title )
					wpmcp_edit_meta.title = $( '#tmdb_query' ).val();

				if ( '' == wpmcp_edit_meta.title ) {
					return false;
				}

				wpmcp.editor.$spinner.css({display: 'inline-block'});
				$( wpmcp_edit_meta.fields ).empty().hide();

				wpmcp_state.clear();
				if ( wpmcp_edit_meta.type == 'title' )
					wpmcp_state.set( wpmcp_lang.search_movie_title + ' "' + wpmcp_edit_meta.title + '"', 'warning' );
				else if ( wpmcp_edit_meta.type == 'id' )
					wpmcp_state.set( wpmcp_lang.search_movie + ' #' + wpmcp_edit_meta.tmdb_id, 'success' );

				wpmcp._get({
					data: {
						action: 'wpmcp_search_movie',
						nonce: wpmcp.get_nonce( 'search-movies' ),
						type: wpmcp_edit_meta.type,
						data: ( wpmcp_edit_meta.type == 'title' ? wpmcp_edit_meta.title : wpmcp_edit_meta.tmdb_id ),
						lang: wpmcp_edit_meta.lang
					},
					error: function( response ) {
						wpmcp_state.clear();
						$.each( response.responseJSON.errors, function() {
							wpmcp_state.set( this, 'error' );
						});
					},
					success: function( response ) {
						if ( 'movie' == response.data.result ) {
							wpmcp_edit_meta.set( response.data.movies[ 0 ] );
							if ( wpmcp_edit_meta.poster_featured )
								wpmcp_posters.set_featured( response.data.movies[ 0 ].poster_path );
						}
						else if ( 'movies' == response.data.result ) {
							wpmcp_edit_meta.select( response.data.movies, response.data.message );
						}
						else if ( 'empty' == response.data.result ) {
							wpmcp_state.set( response.data.message, 'error' );
						}
					},
					complete: function( r ) {
						wpmcp.editor.$spinner.hide();
						wpmcp.update_nonce( 'search-movies', r.responseJSON.nonce );
					}
				});
			};

			/**
			 * Update current movie
			 * 
			 * @since    2.0
			 */
			wpmcp.editor.meta.update = function() {

				if ( undefined == wpmcp.editor._movie_tmdb_id )
					wpmcp_state.set( wpmcp_lang.media_no_movie, 'error' );

				wpmcp_edit_meta.updating = true;
				wpmcp_edit_meta.empty_results();
				wpmcp_edit_meta.get( wpmcp.editor._movie_tmdb_id );
			};

			/**
			 * Display a list of movies matching the search.
			 * 
			 * @since    1.0
			 * 
			 * @param    object    Movies to add to the selection list
			 * @param    string    Notice message to display
			 */
			wpmcp.editor.meta.select = function( movies, message ) {

				var html = '', message = message || '';

				if ( '' != message )
					$( wpmcp_edit_meta.fields ).addClass('update success' ).append('<p>' + message + '</p>' ).show();

				$.each( movies, function() {
					var $movie = $( '<div class="tmdb_select_movie"><a id="tmdb_' + this.id + '" href="#" onclick="wpmcp_edit_meta.get( ' + this.id + ' ); return false;"><img src="' + this.poster + '" alt="' + this.title + '" /><em>' + this.title + '</em> (' + this.year + ')</a><input type=\'hidden\' value=\'' + this.json + '\' /></div>' );
					$( wpmcp_edit_meta.fields ).append( $movie );
				});

			};
			
			/**
			 * Get a movie by its ID.
			 * 
			 * @since    1.0
			 * 
			 * @param    int       Movie TMDb ID
			 */
			wpmcp.editor.meta.get = function( tmdb_id ) {
				wpmcp._get({
					data: {
						action: 'wpmcp_search_movie',
						nonce: wpmcp.get_nonce( 'search-movies' ),
						type: 'id',
						data: tmdb_id,
						lang: wpmcp_edit_meta.lang
					},
					beforeSend: function() {
						wpmcp.editor.$spinner.css( { display: 'inline-block' } );
					},
					error: function( response ) {
						wpmcp_state.clear();
						$.each( response.responseJSON.errors, function() {
							wpmcp_state.set( this, 'error' );
						});
					},
					success: function( response ) {
						$( wpmcp_edit_meta.fields ).empty().hide();
						wpmcp_edit_meta.tmdb_id = response.data._tmdb_id;
						wpmcp_edit_meta.set( response.data );
						wpmcp_edit_meta.save();
						if ( ! wpmcp_edit_meta.updating && wpmcp_edit_meta.poster_featured )
							wpmcp_posters.set_featured( response.data.poster_path );
					},
					complete: function( r ) {
						wpmcp.editor.$spinner.hide();
						wpmcp.update_nonce( 'search-movies', r.responseJSON.nonce );
					}
				});
			};
			
			/**
			 * Fill in the meta fields.
			 * 
			 * @since    1.0
			 * 
			 * @param    object    Movie metadata
			 */
			wpmcp.editor.meta.set = function( data ) {

				wpmcp.editor._movie_tmdb_id = data._tmdb_id;
				wpmcp.editor._movie_title   = data.meta.title;

				if ( '' == $( wpmcp_edit_meta._title.element ).val() ) {
					$( '#title-prompt-text' ).trigger( 'click' );
					$( wpmcp_edit_meta._title.element ).val( wpmcp.editor._movie_title );
				}

				$( '#meta_data_tmdb_id' ).val( data._tmdb_id );
				$( '.meta-data-field' ).each( function() {

					var field = this,
					    value = '',
					     type = field.type,
					     slug = this.id.replace( 'meta_data_', '' ),
					    _data = data.meta;
					field.value = '';

					if ( 'object' == typeof _data[ slug ] ) {
						if ( Array.isArray( _data[ slug ] ) ) {
							_v = [];
							$.each( _data[ slug ], function() {
								_v.push( field.value + this );
							});
							value = _v.join( ', ' );
						}
					}
					else
						value = ( _data[ slug ] != null ? _data[ slug ] : '' );

					$( field ).val( value );
				});

				    if ( undefined != data.taxonomy.actors && '1' == wpmcp.editor.autocomplete.actor ) {
					    var limit = parseInt( $( '#wpmcp_actor_limit' ).val() ) || 0,
						actors = ( limit ? data.taxonomy.actors.splice( 0, limit ) : data.taxonomy.actors );

					    $.each( actors, function(i) {
						    $( '#tagsdiv-actor .tagchecklist' ).append( '<span><a id="actor-check-num-' + i + '" class="ntdelbutton">X</a>&nbsp;' + this + '</span>' );
						    tagBox.flushTags( $( '#actor.tagsdiv' ), $( '<span>' + this + '</span>' ) );
					    });
				    }

				    if ( undefined != data.taxonomy.genres && '1' == wpmcp.editor.autocomplete.genre ) {
					    $.each( data.taxonomy.genres, function(i) {
						    $( '#tagsdiv-genre .tagchecklist' ).append( '<span><a id="genre-check-num-' + i + '" class="ntdelbutton">X</a>&nbsp;' + this + '</span>' );
						    tagBox.flushTags( $( '#genre.tagsdiv' ), $( '<span>' + this + '</span>' ) );
					    });
				    }

				    if ( undefined != data.meta.director && '1' == wpmcp.editor.autocomplete.collection ) {
					    
					    $.each( data.meta.director, function( i, val ) {
						    $( '#newcollection' ).delay( 1000 ).queue( function( next ) {
							    $( this ).prop( 'value', val );
							    $( '#collection-add-submit' ).click();
							    next();
						    });
					    });
				    }

				wpmcp_meta_preview.set( data );

				$( '#tmdb_query' ).focus();
				wpmcp_state.clear();
				wpmcp_state.set( wpmcp_lang.done, 'success' );
			};

			/**
			 * Save metadata to the database..
			 * 
			 * @since    2.0.3
			 */
			wpmcp.editor.meta.save = function() {

				var $fields = $( '#wpmcp-movie-meta .meta-data-field' ),
				       data = {};

				_.each( $fields, function( field ) {
					var id = field.id.replace( 'meta_data_', '' ),
					 value = $( field ).val();
					data[ id ] = value;
				});

				wpmcp._post({
					data: {
						action: 'wpmcp_save_meta',
						nonce: wpmcp.get_nonce( 'save-movie-meta' ),
						post_id: wpmcp_edit_meta.post_id,
						data: data,
					},
					beforeSend: function() {
						wpmcp.editor.$spinner.css( { display: 'inline-block' } );
					},
					error: function( response ) {
						wpmcp_state.clear();
						$.each( response.responseJSON.errors, function() {
							wpmcp_state.set( this, 'error' );
						});
					},
					success: function( response ) {
						wpmcp_state.clear();
						wpmcp_state.set( wpmcp_lang.metadata_saved, 'success' );
					},
					complete: function( r ) {
						wpmcp.editor.$spinner.hide();
						wpmcp.update_nonce( 'save-movie-meta', r.responseJSON.nonce );
					}
				});
			}

			/**
			 * Prefill the Movie Meta Metabox search input with the
			 * page title.
			 * 
			 * @since    1.0
			 * 
			 * @param    string    Movie Title
			 */
			wpmcp.editor.meta.prefill_title = function( title ) {
				if ( '' != title )
					wpmcp_edit_meta.title = title;
					$( '#tmdb_query' ).val( title );
			};

			/**
			 * Empty all Movie search result fields, reset all taxonomies 
			 * and remove the featured image.
			 * 
			 * @since    1.0
			 */
			wpmcp.editor.meta.empty_results = function() {

				$( '.meta-data-field' ).val( '' );
				$( '#meta_data' ).empty().hide();

				if ( ! wpmcp_edit_meta.updating )
					$( '#remove-post-thumbnail' ).trigger( 'click' );

				wpmcp._post({
					data: {
						action: 'wpmcp_empty_meta',
						nonce: wpmcp.get_nonce( 'empty-movie-meta' ),
						post_id: wpmcp_edit_meta.post_id
					},
					beforeSend: function() {
						wpmcp.editor.$spinner.css( { display: 'inline-block' } );
					},
					error: function( response ) {
						wpmcp_state.clear();
						$.each( response.responseJSON.errors, function() {
							wpmcp_state.set( this, 'error' );
						});
					},
					success: function( response ) {
						$( '.categorydiv input[type=checkbox]' ).prop( 'checked', false );
						$( '.tagchecklist' ).empty();
					},
					complete: function( r ) {
						wpmcp.editor.$spinner.hide();
						wpmcp.update_nonce( 'empty-meta', r.responseJSON.nonce );
					}
				});

				wpmcp_state.clear();
			};

			wpmcp.editor.meta.panel = wpmcp_meta_panel = {};

				/**
				 * Navigate between Metabox Panels
				 * 
				 * @since    2.0
				 * 
				 * @param    string    panel slug
				 */
				wpmcp.editor.meta.panel.navigate = function( panel ) {

					// nasty Arthemia theme fix
					if ( undefined == $ ) $ = jQuery;

					var $panels = $( '.panel' ),
					    $panel = $( '#wpmcp-meta-' + panel + '-panel' ),
					    $tabs = $( '.tab' ),
					    $tab = $( '#wpmcp-meta-' + panel );

					if ( undefined == $panel || undefined == $tab )
						return false;

					$panels.removeClass( 'active' );
					$tabs.removeClass( 'active' );
					$panel.addClass( 'active' );
					$tab.addClass( 'active' );
				};

				/**
				 * Resize Metabox Panel
				 * 
				 * @since    2.0
				 */
				wpmcp.editor.meta.panel.resize = function() {

					$( '#wpmcp-meta' ).toggleClass( 'small' );
				};

			wpmcp.editor.meta.preview = wpmcp_meta_preview = {};

				wpmcp.editor.meta.preview.set = function( data ) {

					var fields = [
						'title',
						'original_title',
						'genres',
						'release_date',
						'overview',
						'director',
						'cast'
					];

					_.each( fields, function( name ) {
						var value = data.meta[ name ]
						if ( Array.isArray( value ) )
							value = value.join( ', ' );
						$( '#wpmcp-movie-preview-' + name ).html( value );
					}, fields );

					$( '#wpmcp-movie-preview-poster > img' ).attr({
						alt: data.meta.title,
						src: data.poster
					});

					$( '#wpmcp-movie-preview' ).removeClass( 'empty' );
				}

		wpmcp_edit_meta.init();

function redux_change( useless ) {}