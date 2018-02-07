
wpmcp = wpmcp || {};

var wpmcp_queue;

	wpmcp.queue = wpmcp_queue = {

		current_post_id: undefined,
		current_movie: undefined,
		current_queue: undefined,

		queued_list: '#wpmcp_import_queue',

		select: '#wpmcp-queued-list input[type=checkbox]',
		select_all: '#wpmcp-queued-list-header #post_all',
		
		progress: '#queue_progress',
		progress_block: '#queue_progress_block',
		progress_value: '#queue_progress_value',
		progress_status: '#queue_status',
		progress_status_message: '#queue_status_message',
		progress_queued: '#_queued_imported',
		progress_left: '#_queued_left',
	}

		wpmcp.queue.movies = wpmcp_movies_queue = {};

			/**
			* Handle Bulk actions
			* 
			* @since    1.0
			*/
			wpmcp.queue.movies.do = function() {

				var $action = $('select[name=queue-action]'),
				    movies = [];

				if ( 'delete' == $action.val() ) {
					$action.nextAll( '.spinner' ).css( { display: 'inline-block' } );
					$( wpmcp_queue.select + ':checked' ).each( function() {
						movies.push( this.id.replace( 'post_', '' ) );
					});
					wpmcp_import_movies.delete( movies );
				}
				else if ( 'dequeue' == $action.val() ) {
					$action.nextAll( '.spinner' ).css( { display: 'inline-block' } );
					$( wpmcp_queue.select + ':checked' ).each( function() {
						movies.push( this.id.replace( 'post_', '' ) );
					});
					wpmcp_movies_queue.remove( movies );
				}
				else {
					return false;
				}
			};

			/**
			 * Add Movies to the Queue
			 * 
			 * @since    1.0
			 * 
			 * @param    array|int    One or more movies to enqueue
			 */
			wpmcp.queue.movies.add = function( movies ) {

				var queue = [];

				if ( ! $.isArray( movies ) )
					var movies = [ movies ];

				for ( var i = 0; i < movies.length; i++ ) {

					var post_id = movies[ i ];
					wpmcp_queue.current_post_id = post_id;

					if ( post_id && '' != wpmcp_queue_utils.get_val( 'tmdb_id' ) ) {
						queue.push( wpmcp_queue_utils.prepare_queue() );

						$( '#enqueue_' + post_id + ' .wpmolicon' ).after( '<span class="spinner"></span>' );
						$( '#enqueue_' + post_id).addClass( 'loading' );
					}
				}

				if ( ! queue.length ) {
					wpmcp_state.clear();
					wpmcp_state.set( wpmcp_lang.missing_meta, 'warning' );
					return false;
				}

				wpmcp._post({
					data: {
						action: 'wpmcp_enqueue_movies',
						nonce: wpmcp.get_nonce( 'enqueue-movies' ),
						movies: queue
					},
					error: function( response ) {
						wpmcp_state.clear();
						$.each( response.responseJSON.errors, function() {
							wpmcp_state.set( this, 'error' );
						});
					},
					success: function( response ) {
						var message = ( response.data.length > 1 ? wpmcp_lang.enqueued_movies : wpmcp_lang.enqueued_movie );
						wpmcp_state.clear();
						wpmcp_state.set( message.replace( '%s', response.data.length ), 'updated' );
						wpmcp_import_view.reload( {} );
						wpmcp_import_view.reload( {}, 'queued' );
						$( '.spinner' ).hide();
						$( '#p_' + post_id + '_meta_data' ).remove();
					},
					complete: function( r ) {
						wpmcp.update_nonce( 'enqueue-movies', r.responseJSON.nonce );
					}
				});
			};

			/**
			 * Remove Movies from the Queue
			 * 
			 * @since    1.0
			 * 
			 * @param    array|int    One or more movies to dequeue
			 */
			wpmcp.queue.movies.remove = function( movies ) {

				var post_id = 0,
				    queue = [];

				if ( ! $.isArray( movies ) )
					var movies = [ movies ];

				for ( var i = 0; i <= movies.length - 1; i++ ) {
					post_id = movies[ i ];
					if ( post_id )
						queue.push( post_id );
				}

				wpmcp._post({
					data: {	action: 'wpmcp_dequeue_movies',
						nonce: wpmcp.get_nonce( 'dequeue-movies' ),
						movies: queue
					},
					error: function( response ) {
						wpmcp_state.clear();
						$.each( response.responseJSON.errors, function() {
							wpmcp_state.set( this, 'error' );
						});
					},
					success: function( response ) {

						$( response.data ).each(function() {
							$( '#post_' + this ).parents( 'tr, li' ).fadeToggle().remove();
						});

						var message = ( response.data.length > 1 ? wpmcp_lang.dequeued_movies : wpmcp_lang.dequeued_movie );
						wpmcp_state.clear();
						wpmcp_state.set( message.replace( '%s', response.data.length ), 'updated' );
						wpmcp_import_view.reload( {} );
						wpmcp_import_view.reload( {}, 'queued' );
						$( '.spinner' ).hide();
					},
					complete: function( r ) {
						wpmcp.update_nonce( 'dequeue-movies', r.responseJSON.nonce );
					}
				});
			};

			/**
			 * Import Queued Movies
			 * 
			 * @since    1.0
			 */
			wpmcp.queue.movies.import = function() {

				timer = undefined;

				wpmcp_queue.current_queue = $( wpmcp_queue.select + ':checked' );
				$( wpmcp_queue.current_queue ).each( function( i, movie ) {

					var index = i + 1,
					    post_id = $( this ).val(),
					    $li = $( 'li#p_' + post_id ),
					    $status = $li.find( '.column-status .movie_status' );

					wpmcp_queue.current_post_id = post_id;

					$.ajaxQueue({
						data: {
							action: 'wpmcp_import_queued_movie',
							nonce: wpmcp.get_nonce( 'import-queued-movies' ),
							post_id: post_id
						},
						beforeSend: function() {
							$status.text( wpmcp_lang.in_progress );
							window.clearTimeout( timer );
							timer = window.setTimeout(function() {
								var t = $status.text();
								if ( '...' != t.substring( t.length, t.length - 3 ) )
									$status.text( t + '.' );
								else
									$status.text( wpmcp_lang.in_progress );
							}, 1000 );
						},
						error: function( response ) {
							wpmcp_state.clear();
							$.each( response.responseJSON.errors, function() {
								wpmcp_state.set( this, 'error' );
							});
							$status.text( '' );
						},
						success: function( response ) {
							var progress = Math.ceil( ( index / wpmcp_queue.current_queue.length ) * 100 );
							$( wpmcp_queue.progress_value ).val( parseInt( $( wpmcp_queue.progress_value ).val() ) + 1 );
							$( wpmcp_queue.progress_queued ).text( index );
							$( wpmcp_queue.progress ).animate( { width:progress  + '%' }, 250 );
							if ( 100 == progress ) {
								$( wpmcp_queue.progress_status_message ).css( { display: 'inline-block' } ).text( wpmcp_lang.done );
								$( wpmcp_queue.progress_status ).hide();
							}
						},
						complete: function() {
							$status.text( wpmcp_lang.imported );
							wpmcp.update_nonce( 'import-queued-movies', r.responseJSON.nonce );
						},
					}).done( function() {
						window.clearTimeout( timer );
						timer = window.setTimeout( function() {
							wpmcp_import_view.reload( {}, 'queued' );
						}, 2000 );
					});
				});
			};

		/**
		 * Utils for Queue
		 */
		wpmcp.queue.utils = wpmcp_queue_utils = {};

			/**
			 * Prepare Metadata object
			 * 
			 * @since    1.0
			 */
			wpmcp.queue.utils.prepare_queue = function() {
				return metadata = {
					post_id: wpmcp_queue.utils.get_val('post_id'),
					tmdb_id: wpmcp_queue.utils.get_val('tmdb_id'),
					poster: wpmcp_queue.utils.get_val('poster'),
					title: wpmcp_queue.utils.get_val('title'),
					original_title: wpmcp_queue.utils.get_val('original_title'),
					overview: wpmcp_queue.utils.get_val('overview'),
					production_companies: wpmcp_queue.utils.get_val('production_companies'),
					production_countries: wpmcp_queue.utils.get_val('production_countries'),
					spoken_languages: wpmcp_queue.utils.get_val('spoken_languages'),
					runtime: wpmcp_queue.utils.get_val('runtime'),
					genres: wpmcp_queue.utils.get_val('genres'),
					release_date: wpmcp_queue.utils.get_val('release_date'),
					director: wpmcp_queue.utils.get_val('director'),
					producer: wpmcp_queue.utils.get_val('producer'),
					photography: wpmcp_queue.utils.get_val('photography'),
					composer: wpmcp_queue.utils.get_val('composer'),
					author: wpmcp_queue.utils.get_val('author'),
					writer: wpmcp_queue.utils.get_val('writer'),
					cast: wpmcp_queue.utils.get_val('cast')
				};
			};

			/**
			 * Get spectific field value
			 * 
			 * @since    1.0
			 */
			wpmcp.queue.utils.get_val = function( slug ) {
				return $('input#p_' + wpmcp_queue.current_post_id + '_meta_data_' + slug, '#meta_data_form').val() || '';
			};

			wpmcp.queue.utils.toggle_button = function() {

				if ( $( wpmcp_queue.select + ':checked' ).length != $( wpmcp_queue.select ).length )
					$( wpmcp_queue.select_all ).prop( 'checked', false );
				else
					$( wpmcp_queue.select_all ).prop( 'checked', true );
			};

			wpmcp.queue.utils.toggle_inputs = function() {

				if ( ! $( wpmcp_queue.select_all ).prop( 'checked' ) )
					$( wpmcp_queue.select ).prop( 'checked', false );
				else
					$( wpmcp_queue.select ).prop( 'checked', true );
			};

			wpmcp.queue.utils.update_progress = function() {

				var checked = $( wpmcp_queue.select + ':checked' ).length;
				if ( checked ) {
					$( wpmcp_queue.progress_left ).text( checked );
					$( wpmcp_queue.progress_block ).addClass('visible');
				}
				else {
					$( wpmcp_queue.progress_left ).text( '0' );
					$( wpmcp_queue.progress_block ).removeClass('visible');
				}
			};

			wpmcp.queue.utils.init = function() {
				$( wpmcp_queue.select + ', ' + wpmcp_queue.select_all ).on( 'click', function() {
					wpmcp_queue_utils.update_progress();
				});
			};

		wpmcp_queue_utils.init();
