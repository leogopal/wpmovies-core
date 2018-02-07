
$ = $ || jQuery;

wpmcp = wpmcp || {};

	/**
	* WPMOLY Movie editor
	*/
	wpmcp.editor = {};

		/**
		 * WPMOLY Movie Editor: Movie Details
		 */
		wpmcp.editor.details = wpmcp_edit_details = {};

			/**
			 * Edit Movie Rating
			 */
			wpmcp.editor.details.rating = wpmcp_rating = {};

				/**
				 * Update the rating
				 * 
				 * @since    2.0
				 */
				wpmcp.editor.details.rating.update = function( $container, rating ) {

					if ( ! $container.hasClass( 'wpmcp-movie-editable-rating' ) && ! $container.hasClass( 'wpmcp-movie-modal-rating' ) )
						return false;

					var $stars = $container.find( '.wpmolicon' ),
					   is_half = ( Math.floor( rating ) < rating && rating < Math.ceil( rating ) ),
					    filled = Math.floor( rating ),
					      half = is_half ? filled + 1 : -1;

					$stars.removeClass().addClass( 'wpmolicon icon-star-empty' );
					$.each( $stars, function( i ) {
						if ( i < filled )
							$( this ).removeClass( 'icon-star-empty' ).addClass( 'icon-star-filled' );
						else if ( 0 <= half && i < half )
							$( this ).removeClass( 'icon-star-empty' ).addClass( 'icon-star-half' );
					} );
				};

				/**
				 * Show the stars
				 * 
				 * @since    1.0
				 */
				wpmcp.editor.details.rating.change_in = function( e, post_id ) {

					var $container = $( '#wpmcp-movie-rating-' + post_id );

					if ( ! $container.hasClass( 'wpmcp-movie-editable-rating' ) )
						return false;

					var current_class = 'wpmolicon icon-star-filled',
					           median = e.target.offsetLeft + ( e.target.offsetWidth / 2 ),
					         $current = $( e.target, $container ),
					            $prev = $current.prevAll(),
					            $next = $current.nextAll();

					if ( ! e.layerX )
						current_class = 'wpmolicon icon-star-empty';
					else if ( e.layerX <= median )
						current_class = 'wpmolicon icon-star-half';

					$current.removeClass().addClass( current_class );
					   $prev.removeClass().addClass( 'wpmolicon icon-star-filled' );
					   $next.removeClass().addClass( 'wpmolicon icon-star-empty' );

					var rating = $( '.icon-star-filled', $container ).length + ( $( '.icon-star-half', $container ).length / 2 );
					$container.attr( 'data-rated', rating );
				};

				/**
				 * Revert the stars to default/previous
				 * 
				 * @since    1.0
				 */
				wpmcp.editor.details.rating.change_out = function( post_id ) {

					var $container = $( '#wpmcp-movie-rating-' + post_id ),
					        rating = $container.attr( 'data-rating' );

					if ( ! $container.hasClass( 'wpmcp-movie-editable-rating' ) )
						return false;

					wpmcp_rating.update( $container, rating );
				};

				/**
				 * Update the rating and fix the stars
				 * 
				 * @since    1.0
				 */
				wpmcp.editor.details.rating.rate = function( post_id ) {

					var $container = $( '#wpmcp-movie-rating-' + post_id ),
					        rating = $container.attr( 'data-rated' );

					console.log( $container );
					if ( ! $container.hasClass( 'wpmcp-movie-editable-rating' ) )
						return false;

					$container.attr( 'data-rating', rating );
					wpmcp_edit_details.inline_edit( 'rating', $container );

				};

			wpmcp.editor.details.rating.init = function() {
				$( '.wpmcp-movie-editable-rating' ).removeClass( 'wpmcp-movie-editable-rating' );
			};

		wpmcp.editor.details.rating.init();
