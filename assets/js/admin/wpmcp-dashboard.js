
$ = $ || jQuery;

wpmcp = wpmcp || {};

wpmcp.dashboard = wpmcp_dashboard = {

	_home: '#wpmcp-home',
	_movies: '.wpmcp-movie',
	_screen_options: '#adv-settings input',
	_welcome_panel: '#wpmcp-welcome-panel',

	modal: {},
	widgets: {},

	init: function() {}
};

	/**
	 * Movie Showcase on Landing page
	 * 
	 * Display a nice popup that slides from the right of the screen to
	 * show some informations about movies: poster, title, meta, overview...
	 */
	wpmcp.dashboard.modal = wpmcp_modal = {

		_modal: '#wpmcp-movie-modal',
		_modal_bg: '#wpmcp-movie-modal-bg',
		_modal_open: '.wpmcp-movie > a',
		_modal_close: '#wpmcp-movie-modal-close',

		init: function() {},
		_open: function() {},
		_close: function() {},
		_resize: function() {},
		_update: function() {},
	};

		/**
		 * Slides in and shows the modal to visible area
		 */
		wpmcp.dashboard.modal._open = function() {
			$( wpmcp_modal._modal_bg ).show().animate( { right: 0 }, 250 );
		};

		/**
		 * Slides out and hide the modal
		 */
		wpmcp.dashboard.modal._close = function() {
			$( wpmcp_modal._modal_bg ).animate( { right: ( 0 - window.innerWidth ) }, 250, function() { $( this ).hide() } );
		};

		/**
		 * Automatically adapt the divs to the window's size
		 */
		wpmcp.dashboard.modal._resize = function() {

			$( wpmcp_modal._modal ).css({
				width: ( window.innerWidth - 214 ),
				height: ( window.innerHeight - 74 )
			});
		};

		/**
		 * Update modal box with wanted movie data
		 */
		wpmcp.dashboard.modal._update = function( link ) {
			var $link = $( link ),
			     data = $.parseJSON( $link.attr( 'data-movie-meta' ) ),
			       id = $link.parent( 'div' ).prop( 'id' ).replace( 'movie-', '' ),
			   poster = $link.attr( 'data-movie-poster' ),
			 backdrop = $link.attr( 'data-movie-backdrop' ),
			   rating = $link.attr( 'data-movie-rating' ),
			permalink = $link.attr( 'data-movie-permalink' );

			data.overview = data.overview.replace( '&amp;', '&' ).replace( '&lt;', '<' ).replace( '&gt;','>' );

			$( '#wpmcp-movie-modal-title' ).html( data.title );
			$( '#wpmcp-movie-modal-runtime' ).text( data.runtime );
			$( '#wpmcp-movie-modal-release_date' ).text( data.release_date );
			$( '#wpmcp-movie-modal-genres' ).text( data.genres );
			$( '#wpmcp-movie-modal-overview' ).html( data.overview );
			$( '#wpmcp-movie-modal-inner' ).css( { backgroundImage: 'url( ' + backdrop + ' )' } );
			$( '#wpmcp-movie-modal-poster img' ).attr( 'src', poster ).attr( 'alt', data.title );
			$( '#wpmcp-movie-modal-edit' ).attr( 'href', link.href );
			$( '#wpmcp-movie-modal-view' ).attr( 'href', permalink );

			$( '#wpmcp-movie-modal-rating .wpmcp-movie-rating' ).prop( 'id', 'wpmcp-movie-modal-rating-' + id );
			$( '#wpmcp-movie-modal-' + id ).removeClass().addClass( 'wpmcp-movie-rating wpmcp-movie-rating-' + rating.replace( '.', '-' ) );
			wpmcp_rating.update( $( '#wpmcp-movie-modal-rating-' + id ), rating );
		};

		/**
		 * Showcase and events init
		 */
		wpmcp.dashboard.modal.init = function() {

			$( wpmcp_modal._modal_open ).unbind( 'click' ).on( 'click', function( e ) {
				if ( ! $( this ).parent( '.wpmcp-movie' ).hasClass( 'modal' ) )
					return;
				e.preventDefault();
				wpmcp_modal._update( this );
				wpmcp_modal._open();
			});

			$( wpmcp_modal._modal_close ).unbind( 'click' ).on( 'click', function( e ) {
				e.preventDefault();
				wpmcp_modal._close();
			});

			$( window ).on( 'resize', function() {
				wpmcp_modal._resize();
			});

			wpmcp_modal._resize();
		};

	/**
	 * Plugin Dashboard Widgets
	 */
	wpmcp.dashboard.widgets = wpmcp_widgets = {

		_edit: '.edit-box',
		_handle: '.handlediv',
		_metabox: '.meta-box-sortables',

		widget_toggle: function() {},
		init: function() {}
	};

		/**
		 * Latest Movies Widget
		 */
		wpmcp.dashboard.widgets.latest_movies = wpmcp_latest_movies = {

			timer: undefined,
			delay: 500,
			action: 'wpmcp_save_dashboard_widget_settings',
			widget: 'WPMCP_Dashboard_Latest_Movies_Widget',
			nonce_name: 'save-wpmcp-dashboard-latest-movies-widget',

			_year: '.movie-year',
			_rating: '.movie-rating',
			_movies: '.wpmcp-movie',
			_movies_per_page: '#latest_movies_movies_per_page',
			_loadmore: '#latest_movies_load_more',
			_quickedit: '.movie-quickedit',
			_checkbox: '#wpmcp-latest-movies-widget-config input[type=checkbox]',
			_show_year: '#latest_movies_show_year',
			_container: '#wpmcp_dashboard_latest_movies_widget',
			_container_main: '#wpmcp_dashboard_latest_movies_widget .main',
		};

			/**
			 * Toggle Widget's settings
			 * 
			 * TODO: Nonce
			 * 
			 * @since    1.0
			 * 
			 * @param    string     Setting ID
			 * @param    boolean    Toggle status
			 */
			wpmcp.dashboard.widgets.latest_movies.toggle_setting = function( id, status ) {

				var action = id.replace( 'latest_movies_', '' );

				switch ( action ) {
					case 'show_year':
						$( wpmcp_latest_movies._year, wpmcp_latest_movies._container_main ).toggle( status );
						$( wpmcp_latest_movies._movies, wpmcp_latest_movies._container_main ).toggleClass( 'with-year', status );
						break;
					case 'show_rating':
						$( wpmcp_latest_movies._rating, wpmcp_latest_movies._container_main ).toggle( status );
						$( wpmcp_latest_movies._movies, wpmcp_latest_movies._container_main ).toggleClass( 'with-rating', status );
						break;
					case 'style_posters':
						console.log( status );
						$( wpmcp_latest_movies._movies, wpmcp_latest_movies._container_main ).toggleClass( 'stylized', status );
						break;
					case 'style_metabox':
						$( wpmcp_latest_movies._container ).toggleClass( 'no-style', status );
						break;
					case 'show_more':
						$( wpmcp_latest_movies._loadmore, wpmcp_latest_movies._container ).toggleClass( 'hide-if-js hide-if-no-js', ! status );
						break;
					case 'show_modal':
						$( wpmcp_latest_movies._movies, wpmcp_latest_movies._container_main ).toggleClass( 'modal', status );
						if ( ! status )
							$( wpmcp_modal._modal_open ).unbind( 'click' );
						else
							wpmcp.dashboard.modal.init();
						break;
					case 'show_quickedit':
						$( wpmcp_latest_movies._quickedit, wpmcp_latest_movies._container_main ).toggleClass( 'hide-if-js hide-if-no-js', ! status );
						break;
					default:
						break;
				};

				wpmcp._post({
					data: {
						action: wpmcp_latest_movies.action,
						widget: wpmcp_latest_movies.widget,
						nonce: wpmcp.get_nonce( wpmcp_latest_movies.nonce_name ),
						setting: action,
						value: ( true === status ? 1 : 0 )
					},
					complete: function( r ) {
						wpmcp.update_nonce( wpmcp_latest_movies.nonce_name, r.responseJSON.nonce );
					}
				});
			};

			/**
			 * Load more movies
			 * 
			 * Default limit is 8; if no offset is set, use the
			 * total number of movies currently showed in the Widget.
			 * 
			 * TODO: Nonce
			 * 
			 * @since    1.0
			 * 
			 * @param    int    Number of movies to load
			 * @param    int    Starting at which offset
			 */
			wpmcp.dashboard.widgets.latest_movies.load_more = function( limit, offset, replace ) {

				if ( null == limit )
					var limit = 8;
				if ( null == offset )
					var offset = $( wpmcp_latest_movies._movies, wpmcp_latest_movies._container_main ).length;

				var replace = ( true === replace ? true : false );

				wpmcp._get({
					data: {
						action: 'wpmcp_load_more_movies',
						widget: wpmcp_latest_movies.widget,
						nonce: wpmcp.get_nonce( 'load-more-widget-movies' ),
						offset: offset,
						limit: limit
					},
					beforeSend: function() {
						$( wpmcp_latest_movies._loadmore ).find( 'span' ).css( { opacity: 0 } );
						$( wpmcp_latest_movies._loadmore ).append( '<span class="spinner"></span>' );
					},
					success: function( data ) {
						if ( '2' == data ) {
							$( wpmcp_latest_movies._loadmore ).addClass( 'disabled' );
							return true;
						}

						if ( replace )
							$( wpmcp_latest_movies._container_main ).empty();

						$( wpmcp_latest_movies._container_main ).append( data );
						wpmcp_dashboard.resize_posters();
					},
					complete: function( r ) {
						$( wpmcp_latest_movies._loadmore ).find( 'span' ).css( { opacity: 1.0 } );
						$( wpmcp_latest_movies._loadmore ).find( '.spinner' ).remove();
						wpmcp.update_nonce( wpmcp_latest_movies.nonce_name, r.responseJSON.nonce );
					}
				});
			};

			/**
			 * Update movies per page value
			 * 
			 * TODO: Nonce
			 * 
			 * @since    1.0
			 * 
			 * @param    int    Movies per page
			 */
			wpmcp.dashboard.widgets.latest_movies.movies_per_page = function( n ) {

				var offset = $( wpmcp_latest_movies._movies, wpmcp_latest_movies._container_main ).length;
				if ( 0 > n || 999 < n || isNaN( n ) )
					var n = 8;
				
				if ( n < offset ) {
					$( wpmcp_latest_movies._movies, wpmcp_latest_movies._container_main ).each(function( i, movie ) {
						if ( i >= n )
							$(movie).remove();
					});
				}
				else {
					$( wpmcp_latest_movies._movies, wpmcp_latest_movies._container_main ).remove();
					wpmcp_latest_movies.load_more( n, 0, true );
				}

				wpmcp._post({
					data: {
						action: wpmcp_latest_movies.action,
						widget: wpmcp_latest_movies.widget,
						nonce: wpmcp.get_nonce( wpmcp_latest_movies.nonce_name ),
						setting: 'movies_per_page',
						value: n
					},
					complete: function( r ) {
						wpmcp.update_nonce( wpmcp_latest_movies.nonce_name, r.responseJSON.nonce );
					}
				});
			};

			/**
			 * Init Widget Events
			 */
			wpmcp.dashboard.widgets.latest_movies.init = function() {

				$( wpmcp_latest_movies._checkbox ).on( 'click', function() {
					wpmcp_latest_movies.toggle_setting( this.id, this.checked );
				});

				$( wpmcp_latest_movies._loadmore ).on( 'click', function( e ) {
					e.preventDefault();
					if ( $( this ).hasClass( 'disabled' ) )
						return;
					wpmcp_latest_movies.load_more( '', null, false );
				});

				$( wpmcp_latest_movies._movies_per_page ).on( 'input', function() {
					var n = this.value;
					window.clearTimeout( wpmcp_latest_movies.timer );
					wpmcp_latest_movies.timer = window.setTimeout( function() {
						wpmcp_latest_movies.movies_per_page( n );
					}, wpmcp_latest_movies.delay );
				});
			};

		/**
		 * Latest Movies Widget
		 */
		wpmcp.dashboard.widgets.most_rated_movies = wpmcp_most_rated_movies = {

			timer: undefined,
			delay: 500,
			action: 'wpmcp_save_dashboard_widget_settings',
			widget: 'WPMCP_Dashboard_Most_Rated_Movies_Widget',
			nonce_name: 'save-wpmcp-dashboard-most-rated-movies-widget',

			_year: '.movie-year',
			_rating: '.movie-rating',
			_movies: '.wpmcp-movie',
			_movies_per_page: '#most_rated_movies_movies_per_page',
			_loadmore: '#most_rated_movies_load_more',
			_quickedit: '.movie-quickedit',
			_checkbox: '#wpmcp-most-rated-movies-widget-config input[type=checkbox]',
			_show_year: '#most_rated_movies_show_year',
			_container: '#wpmcp_dashboard_most_rated_movies_widget',
			_container_main: '#wpmcp_dashboard_most_rated_movies_widget .main',
		};

			/**
			 * Toggle Widget's settings
			 * 
			 * TODO: Nonce
			 * 
			 * @since    1.0
			 * 
			 * @param    string     Setting ID
			 * @param    boolean    Toggle status
			 */
			wpmcp.dashboard.widgets.most_rated_movies.toggle_setting = function( id, status ) {

				var action = id.replace( 'most_rated_movies_', '' );

				switch ( action ) {
					case 'show_year':
						$( wpmcp_most_rated_movies._year, wpmcp_most_rated_movies._container_main ).toggle( status );
						$( wpmcp_most_rated_movies._movies, wpmcp_most_rated_movies._container_main ).toggleClass( 'with-year', status );
						break;
					case 'show_rating':
						$( wpmcp_most_rated_movies._rating, wpmcp_most_rated_movies._container_main ).toggle( status );
						$( wpmcp_most_rated_movies._movies, wpmcp_most_rated_movies._container_main ).toggleClass( 'with-rating', status );
						break;
					case 'style_posters':
						console.log( status );
						$( wpmcp_most_rated_movies._movies, wpmcp_most_rated_movies._container_main ).toggleClass( 'stylized', status );
						break;
					case 'style_metabox':
						$( wpmcp_most_rated_movies._container ).toggleClass( 'no-style', status );
						break;
					case 'show_more':
						$( wpmcp_most_rated_movies._loadmore, wpmcp_most_rated_movies._container ).toggleClass( 'hide-if-js hide-if-no-js', ! status );
						break;
					case 'show_modal':
						$( wpmcp_most_rated_movies._movies, wpmcp_most_rated_movies._container_main ).toggleClass( 'modal', status );
						if ( ! status )
							$( wpmcp_modal._modal_open ).unbind( 'click' );
						else
							wpmcp.dashboard.modal.init();
						break;
					case 'show_quickedit':
						$( wpmcp_most_rated_movies._quickedit, wpmcp_most_rated_movies._container_main ).toggleClass( 'hide-if-js hide-if-no-js', ! status );
						break;
					default:
						break;
				};

				wpmcp._post({
					data: {
						action: wpmcp_most_rated_movies.action,
						widget: wpmcp_most_rated_movies.widget,
						nonce: wpmcp.get_nonce( wpmcp_most_rated_movies.nonce_name ),
						setting: action,
						value: ( true === status ? 1 : 0 )
					},
					complete: function( r ) {
						wpmcp.update_nonce( wpmcp_most_rated_movies.nonce_name, r.responseJSON.nonce );
					}
				});
			};

			/**
			 * Load more movies
			 * 
			 * Default limit is 8; if no offset is set, use the
			 * total number of movies currently showed in the Widget.
			 * 
			 * TODO: Nonce
			 * 
			 * @since    1.0
			 * 
			 * @param    int    Number of movies to load
			 * @param    int    Starting at which offset
			 */
			wpmcp.dashboard.widgets.most_rated_movies.load_more = function( limit, offset, replace ) {

				if ( null == limit )
					var limit = 4;
				if ( null == offset )
					var offset = $( wpmcp_most_rated_movies._movies, wpmcp_most_rated_movies._container_main ).length;

				var replace = ( true === replace ? true : false );

				wpmcp._get({
					data: {
						action: 'wpmcp_load_more_movies',
						widget: wpmcp_most_rated_movies.widget,
						nonce: wpmcp.get_nonce( 'load-more-widget-movies' ),
						offset: offset,
						limit: limit
					},
					beforeSend: function() {
						$( wpmcp_most_rated_movies._loadmore ).find( 'span' ).css( { opacity: 0 } );
						$( wpmcp_most_rated_movies._loadmore ).append( '<span class="spinner"></span>' );
					},
					success: function( data ) {
						if ( '2' == data ) {
							$( wpmcp_most_rated_movies._loadmore ).addClass( 'disabled' );
							return true;
						}

						if ( replace )
							$( wpmcp_most_rated_movies._container_main ).empty();

						$( wpmcp_most_rated_movies._container_main ).append( data );
						wpmcp_dashboard.resize_posters();
					},
					complete: function( r ) {
						$( wpmcp_most_rated_movies._loadmore ).find( 'span' ).css( { opacity: 1.0 } );
						$( wpmcp_most_rated_movies._loadmore ).find( '.spinner' ).remove();
					}
				});
			};

			/**
			 * Update movies per page value
			 * 
			 * TODO: Nonce
			 * 
			 * @since    1.0
			 * 
			 * @param    int    Movies per page
			 */
			wpmcp.dashboard.widgets.most_rated_movies.movies_per_page = function( n ) {

				var offset = $( wpmcp_most_rated_movies._movies, wpmcp_most_rated_movies._container_main ).length;
				if ( 0 > n || 999 < n || isNaN( n ) )
					var n = 8;
				
				if ( n < offset ) {
					$( wpmcp_most_rated_movies._movies, wpmcp_most_rated_movies._container_main ).each(function( i, movie ) {
						if ( i >= n )
							$(movie).remove();
					});
				}
				else {
					$( wpmcp_most_rated_movies._movies, wpmcp_most_rated_movies._container_main ).remove();
					wpmcp_most_rated_movies.load_more( n, 0, true );
				}

				wpmcp._post({
					data: {
						action: wpmcp_most_rated_movies.action,
						widget: wpmcp_most_rated_movies.widget,
						nonce: wpmcp.get_nonce( wpmcp_most_rated_movies.nonce_name ),
						setting: 'movies_per_page',
						value: n
					},
					complete: function( r ) {
						wpmcp.update_nonce( wpmcp_most_rated_movies.nonce_name, r.responseJSON.nonce );
					}
				});
			};

			/**
			 * Init Widget Events
			 */
			wpmcp.dashboard.widgets.most_rated_movies.init = function() {

				$( wpmcp_most_rated_movies._checkbox ).on( 'click', function() {
					wpmcp_most_rated_movies.toggle_setting( this.id, this.checked );
				});

				$( wpmcp_most_rated_movies._loadmore ).on( 'click', function( e ) {
					e.preventDefault();
					if ( $( this ).hasClass( 'disabled' ) )
						return;
					wpmcp_most_rated_movies.load_more( '', null, false );
				});

				$( wpmcp_most_rated_movies._movies_per_page ).on( 'input', function() {
					var n = this.value;
					window.clearTimeout( wpmcp_most_rated_movies.timer );
					wpmcp_most_rated_movies.timer = window.setTimeout( function() {
						wpmcp_most_rated_movies.movies_per_page( n );
					}, wpmcp_most_rated_movies.delay );
				});
			};

		/**
		* Activate toggle for dashboard page widgets
		* 
		* @since    1.0
		* 
		* @param    object     Link's DOM Element
		*/
		wpmcp_widgets.toggle = function( link ) {

			var $link = $( link ),
			    $thisParent = $link.parent(),
			    $thisContent = $thisParent.find( '.inside' );

			if ( ! $thisParent.hasClass( 'exclude' ) ) {
				$( '.hndle' ).each( function() {
					var $parent = $link.parent();
					if ( ! $parent.hasClass( 'exclude' ) && ! $parent.hasClass( 'closed' ) ) {
						$parent.find( '.inside' ).slideUp( 250, function() {
							$parent.addClass( 'closed' );
						});
					}
				});
			}

			if ( $thisParent.hasClass( 'closed' ) )
				$thisContent.slideDown( 250, function() { $thisParent.removeClass( 'closed' ); });
			else
				$thisContent.slideUp( 250, function() { $thisParent.addClass( 'closed' ); });
		};

		/**
		* Show/Hide plugin Widgets config part 
		* 
		* @since    1.0
		* 
		* @param    object     Link's DOM Element
		* @param    boolean    True to show config part, false to hide
		*/
		wpmcp_widgets.config_toggle = function( link, status ) {

			var status = ( true === status ? true : false );

			var $link = $( link ),
			    $thisParent = $link.parents( '.postbox' ),
			    $main = $thisParent.find('.main'),
			$config = $thisParent.find('.main-config');

			if ( status ) {
				$config.slideDown( 250 );
				$thisParent.find( '.close-box' ).css( { display: 'inline' } );
				$thisParent.find( '.open-box' ).css( { display: 'none' } );
			}
			else {
				$config.slideUp( 250 );
				$thisParent.find( '.close-box' ).css( { display: 'none' } );
				$thisParent.find( '.open-box' ).css( { display: '' } );
			}
		};

		/**
		 * Init Widgets Events
		 */
		wpmcp_widgets.init = function() {

			$( wpmcp_widgets._handle ).on( 'click', function() {
				wpmcp_widgets.toggle( this );
			});

			$( wpmcp_widgets._edit, wpmcp_dashboard._home ).on( 'click', function( e ) {
				e.preventDefault();
				wpmcp_widgets.config_toggle( this, $( this ).hasClass( 'open-box' ) );
			});

			$( wpmcp_widgets._metabox ).sortable();

			wpmcp.dashboard.widgets.latest_movies.init();
			wpmcp.dashboard.widgets.most_rated_movies.init();
		};

	/**
	 * Update Plugin's Dashboard screen options
	 * 
	 * @since    1.0
	 * 
	 * @param    string     Option ID
	 * @param    boolean    Option value
	 */
	wpmcp.dashboard.update_screen_option = function( option, status ) {

		var option = option.replace( 'show_wpmcp_', '' )
		     $elem = $( '#wpmcp_dashboard_' + option + '_widget' ),
		    $input = $( '#show_wpmcp_' + option );

		if ( null == status )
			status = $input.prop( 'checked' );

		var visible = ( true === status ? 1 : 0 );

		if ( undefined == $elem )
			return;

		$elem.toggleClass( 'hidden hide-if-js', ! status );
		$input.prop( 'checked', status );

		wpmcp._post({
			data: {
				action: 'wpmcp_save_screen_option',
				screenoptionnonce: $( '#screenoptionnonce' ).val(),
				screenid: adminpage,
				option: option,
				visible: visible
			},
			complete: function( r ) {
				wpmcp.update_nonce( 'screenoptionnonce', r.responseJSON.nonce );
			}
		});
	};

	/**
	 * Resize Dashboard movie posters to fit screen size
	 */
	wpmcp.dashboard.resize_posters = function() {

		var $movies = $( wpmcp_dashboard._movies ),
		  container = $movies.parents('.postbox').width(),
		      width = $movies.width(),
		     height = $movies.height();

		if  ( 420 >= container )
			var _width = '49.5%';
		else if ( 700 >= container )
			var _width = '32.2%';
		else if ( 700 < container && 1024 >= container )
			var _width = '22%';
		else if ( 1024 < container )
			var _width = '18%';

		$movies.css( { width: _width } );
		$movies.css( { height: Math.ceil( $movies.width() * 1.5 ) } );
	};

	/**
	 * Init Landing page
	 */
	wpmcp.dashboard.init = function() {

		$( wpmcp_dashboard._screen_options ).on( 'click', function() {
			wpmcp_dashboard.update_screen_option( this.id, this.checked );
		});

		$( window ).on( 'resize', function() {
			wpmcp_dashboard.resize_posters();
		});

		wpmcp_dashboard.resize_posters();
		wpmcp_dashboard.modal.init();
		wpmcp_dashboard.widgets.init();
	};

wpmcp_dashboard.init();