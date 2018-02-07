
$ = $ || jQuery;

wpmcp = wpmcp || {};

	wpmcp.editor = {}

		/**
		 * Handles 'All Movies' Table and Post Editor Movie Meta part
		 * 
		 * Add excerpt to actors lists, handles Quick/Bulk Edit in All
		 * Movies Table.
		 * 
		 * Populate Meta fields, taxonomies and featured images with the
		 * data fetched by wpmcp.editor.meta.search_movie().
		 */
		wpmcp.editor.movies = wpmcp_edit_movies = {

			actors: 'td.column-taxonomy-actor',
			visible: '.visible-actors',
			hidden: '.hidden-actors',

			_more: {
				element: '.more-actors',
				event: 'click'
			},

			init: function() {},
			short_actors: function() {},
			quick_edit: function() {}
		};

			/**
			 * Init Events and generate Actors Excerpt list
			 */
			wpmcp.editor.movies.init = function() {

				wpmcp_edit_movies.short_actors();

				$( wpmcp_edit_movies._more.element ).on( wpmcp_edit_movies._more.event, function( e ) {
					e.preventDefault();
					wpmcp_edit_movies.toggle_actors( this );
				});

			};

			/**
			 * Hide most of the actors in the All Movies view. Since
			 * movies can contain a large number of actors we limit
			 * the list length to the first five names and show a link
			 * to toggle the hidden rest on the list.
			 * 
			 * @since    1.0
			 */
			wpmcp.editor.movies.short_actors = function() {

				$( wpmcp_edit_movies.actors ).each( function() {

					var $links = $( this ).find('a');
					if ( $links.length ) {
						var visible = [],
						   _visible = $links.slice( 0, 5 ),
						     hidden = [],
						    _hidden = $links.slice( 5 );

						_visible.each( function() { visible.push( this.outerHTML ); } );
						_hidden.each( function() { hidden.push( this.outerHTML ); } );

						$( this ).html( '<span class="visible-actors"></span>, <span class="hidden-actors"></span> <a class="more-actors" href="#">' + wpmcp_lang.see_more + '</a>' );
						$( this ).find( wpmcp_edit_movies.visible ).html( visible.join( ', ' ) );
						$( this ).find( wpmcp_edit_movies.hidden ).html( hidden.join( ', ' ) );
					}
				});
			};

			/**
			 * Toggle the Show/Hide all actors link.
			 * 
			 * @since    1.0
			 * 
			 * @param    object    Link DOM object
			 */
			wpmcp.editor.movies.toggle_actors = function( link ) {

				$( link ).prev( wpmcp_edit_movies.hidden ).toggle();
				if ( 'none' != $( link ).prev( wpmcp_edit_movies.hidden ).css( 'display' ) )
					$( link ).text( wpmcp_lang.see_less );
				else
					$( link ).text( wpmcp_lang.see_more );
			};

			/**
			 * Fill the Quick Edit form with the correct Details.
			 * This can't be done in PHP so we have to get the data
			 * through AJAX and update the form manually.
			 * 
			 * @since    1.0
			 * 
			 * @param    object    Movie details: status, media, rating
			 * @param    string    Security Nonce
			 */
			wpmcp.editor.movies.quick_edit = function( details, nonce ) {

				var $wp_inline_edit = inlineEditPost.edit;

				inlineEditPost.edit = function( id ) {

					$wp_inline_edit.apply( this, arguments );

					var post_id = 0;

					if ( typeof( id ) == 'object' )
						post_id = parseInt( this.getId( id ) );

					if ( ! post_id )
						return false;

					wpmcp.update_nonce( 'set-quickedit-movie-details', nonce );

					$( '.inline-edit-movie-detail', '#edit-' + post_id ).each(function() {
						var detail = this.id.replace( 'movie-', '' );
						$( this ).children( 'option' ).each( function() {
							$option = $( this );
							if ( $.isArray( details[ detail ] ) ) {
								$.each( details[ detail ], function( i, _d ) {
									if ( _d == $option.val() )
										$option.prop( 'selected', true );
								});
							}
							else {
								$option.prop( 'selected', ( details[ detail ] == $option.val() ) );
							}
						});
					});
				};
			};

		wpmcp.editor.movies.init();