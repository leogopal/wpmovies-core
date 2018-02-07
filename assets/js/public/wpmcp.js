
(function($) {

	window.wpmcp = window.wpmcp || {};

		wpmcp.init = function() {

			$( 'select.wpmcp.list' ).change(function() {
				if ( this.options[ this.selectedIndex ].value.length > 0 )
					location.href = this.options[ this.selectedIndex ].value;
			});

			if ( undefined != $( '#wpmcp-movie-grid.grid > .movie' ) )
				wpmcp.grid_resize();

			$( '.hide-if-js' ).hide();
			$( '.hide-if-no-js' ).removeClass( 'hide-if-no-js' );
		};

		wpmcp.headbox = wpmcp_headbox = {};

			wpmcp.headbox.toggle = function( item, post_id ) {

				var $tab = $( '#movie-headbox-' + item + '-' + post_id ),
				$parent = $( '#movie-headbox-' + post_id ),
				$tabs = $parent.find( '.wpmcp.headbox.movie.content > .content' ),
				$link = $( '#movie-headbox-' + item + '-link-' + post_id );

				if ( undefined != $tab ) {
					$tabs.hide();
					$tab.show();
					$parent.find( 'a.active' ).removeClass( 'active' );
					$link.addClass( 'active' );
				}
			};

		wpmcp.grid_resize = function() {

			var $movies = $( '#wpmcp-movie-grid.grid .movie' ),
			   $posters = $( '#wpmcp-movie-grid.grid .poster' ),
			 max_height = 0,
			  max_width = 0;

			$.each( $posters, function() {
				var $img = $( this ),
				   width = $img.width(),
				  height = $img.height();

				if ( height > max_height )
					max_height = height;
				if ( width > max_width )
					max_width = width;

			});

			if ( $( '#wpmcp-movie-grid.grid' ).hasClass( 'spaced' ) ) {
				var _poster = {
					height: Math.round( max_width * 1.33 ),
					width: max_width
				},
				     _movie = {
					width: max_width
				};
			} else {
				var _poster = {
					height: Math.round( max_width * 1.33 ),
					width: max_width
				},
				     _movie = _poster;
			}

			$posters.css( _poster );
			$movies.css( _movie );
		};

		wpmcp.init();
	
})(jQuery);