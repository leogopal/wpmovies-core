
$ = jQuery;

wpmcp = wpmcp || {};

	wpmcp.updates = wpmcp_updates = {

		_number: '#update-movies-count',
		__number: '#update-movies-count-text',
		_total: '#update-movies-total',
		__total: '#update-movies-total-text',
		_percent: '#update-movies-progressbar-text .value',
		_status: '#update-movies-progressbar-text .text',
		_progress: '#update-movies-progress'
	};

		wpmcp.updates.movies = wpmcp_update_movies = {};

			wpmcp.updates.movies.enqueue = function( id ) {

				var $link = $( '#queue-movie-' + id ),
				    $tr = $( 'tr#movie-' + id );

				$link.attr( 'onclick', 'wpmcp.updates.movies.dequeue( ' + id + ' ); return false;' );
				$link.find( '.wpmolicon' ).removeClass( 'icon-yes' ).addClass( 'icon-no' );
				$tr.toggleClass( 'active' );

				wpmcp_update_progress.update_total( $( '#deprecated-movies tr.active' ).length );

				
			};

			wpmcp.updates.movies.dequeue = function( id ) {

				var $link = $( '#queue-movie-' + id ),
				    $tr = $( 'tr#movie-' + id );

				$link.attr( 'onclick', 'wpmcp.updates.movies.enqueue( ' + id + ' ); return false;' );
				$link.find( '.wpmolicon' ).removeClass( 'icon-no' ).addClass( 'icon-yes' );
				$tr.toggleClass( 'active' );

				wpmcp_update_progress.update_total( $( '#deprecated-movies tr.active' ).length );
			};

			wpmcp.updates.movies.update = function( id ) {

				wpmcp._post({
					data: {
						action: 'wpmcp_update_movie',
						nonce: wpmcp.get_nonce( 'update-movie' ),
						movie_id: id
					},
					error: function( response ) {
						wpmcp_state.clear();
						$.each( response.responseJSON.errors, function() {
							wpmcp_state.set( this, 'error' );
						});
						$( '#update-movies-log' ).append( '<span class="wpmolicon icon-no"></span> Movie #' + id + ' « <em>' + $tr.find( '.movie-title' ).text() + '</em> » not updated' );
					},
					success: function( response ) {
						var $tr = $( 'tr#movie-' + id );

						$tr.find( '.wpmolicon.icon-arrow-right' ).removeClass( 'icon-arrow-right' ).addClass( 'icon-yes' );
						$tr.find( '.update-movie, .queue-movie' ).remove();
						$( '#updated-movies' ).append( $tr );
						$( '#update-movies-log' ).append( '<span class="update-movies-log-entry"><span class="wpmolicon icon-yes"></span> Movie #' + id + ' « <em>' + $tr.find( '.movie-title' ).text() + '</em> » updated succesfully</span>' );
						$( '#update-movies-log' ).scrollTop( Math.round( $( '.update-movies-log-entry' ).last().position().top + $( '.update-movies-log-entry' ).last().height() ) );
					},
					complete: function( r ) {
						wpmcp.update_nonce( 'update-movie', r.responseJSON.nonce );
					}
				});
			};

			wpmcp.updates.movies.update_all = function() {

				var $movies = $( 'tr.active' );
				$.each( $movies, function() {

					var id = $( this ).prop( 'id' ).replace( 'movie-', '' );

					$( wpmcp_updates._status ).text( wpmcp_lang.updating );

					$.ajaxQueue({
						data: {
							action: 'wpmcp_update_movie',
							nonce: wpmcp.get_nonce( 'update-movie' ),
							movie_id: id
						},
						beforeSend: function() {},
						error: function( response ) {
							wpmcp_state.clear();
							$.each( response.responseJSON.errors, function() {
								wpmcp_state.set( this, 'error' );
							});
							$( '#update-movies-log' ).append( '<span class="wpmolicon icon-no"></span> ' + wpmcp_lang.movie.charAt( 0 ).toUpperCase() + wpmcp_lang.movie.slice( 1 ) + ' #' + id + ' « <em>' + $tr.find( '.movie-title' ).text() + '</em> » ' + wpmcp_lang.not_updated );
						},
						success: function( response ) {
							var $tr = $( 'tr#movie-' + id );

							$tr.find( '.wpmolicon.icon-arrow-right' ).removeClass( 'icon-arrow-right' ).addClass( 'icon-yes' );
							$tr.find( '.update-movie, .queue-movie' ).remove();
							$( '#updated-movies' ).append( $tr );
							$( '#update-movies-log' ).append( '<span class="update-movies-log-entry"><span class="wpmolicon icon-yes"></span> ' + wpmcp_lang.movie.charAt( 0 ).toUpperCase() + wpmcp_lang.movie.slice( 1 ) + ' #' + id + ' « <em>' + $tr.find( '.movie-title' ).text() + '</em> » ' + wpmcp_lang.updated + '</span>' );
							$( '#update-movies-log' ).scrollTop( Math.round( $( '.update-movies-log-entry' ).last().position().top + $( '.update-movies-log-entry' ).last().height() ) );
						},
						complete: function() {
							wpmcp_update_progress.update_counter( $( '#updated-movies tr.active' ).length );
							if ( ! $( '#deprecated-movies .active' ).length )
								$( wpmcp_updates._status ).text( wpmcp_lang.done );
						}
					});
				} );
			};

		wpmcp.updates.progress = wpmcp_update_progress = {};

			wpmcp.updates.progress.update_counter = function( number ) {

				var total = $( wpmcp_updates._total ).text(),
				 progress = Math.round( ( number * 100 ) / total ) + '%';
				$( wpmcp_updates._number ).text( number );
				$( wpmcp_updates.__number ).text( ( 1 < number ? wpmcp_lang.movies_updated : wpmcp_lang.movie_updated ) );
				$( wpmcp_updates._percent ).text( progress );
				$( wpmcp_updates._progress ).animate( { width: progress }, 25 );
			};

			wpmcp.updates.progress.update_total = function( total ) {

				$( wpmcp_updates._total ).text( total );
				$( wpmcp_updates.__total ).text( ( 1 < total ? wpmcp_lang.x_selected : wpmcp_lang.selected ) );
			};
