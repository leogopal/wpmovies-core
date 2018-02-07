
wpmcp = wpmcp || {};

var wpmcp_images, wpmcp_posters;

	wpmcp.media = wpmcp_media = {

		_movie_id: $('#post_ID').val(),
		_movie_title: $('#meta_data_title').val(),
		_movie_tmdb_id: $('#meta_data_tmdb_id').val(),
		
		init: function() {},
		images: {},
		posters: {}
	};

		/**
		 * WPMOLY Movie Media: Movie Images
		 */
		wpmcp.media.images = wpmcp_images = {

			init: function() {},
			frame: function() {},
			select: function() {},
			upload: function() {},
			close: function() {}
		};

			/**
			 * Init WPMOLY Media Images
			 */
			wpmcp.media.images.init = function() {
				wpmcp_images.frame().open();
			};

			/**
			 * Open editor modal when clicking on imported movies
			 */
			wpmcp.media.images.editor = function( attachment_id ) {

				// Avoid loading upload.php in background
				Backbone.history.stop();

				// current library and requested attachment
				var library = wp.media.frame.library || wp.media.frame.state().get('library'),
				       item = library.model.get( attachment_id );

				// open a new editor modal
				this._editor = wp.media( {
					frame: 'edit-attachments',
					controller: new wp.media.view.MediaFrame.Manage(),
					library: wp.media.frame.library || wp.media.frame.state().get( 'library' ),
					model: item
				} );

			};

			/**
			 * Media Images Modal. Extends WP Media Modal to show
			 * movie images from external API instead of regular WP
			 * Attachments.
			 */
			wpmcp.media.images.frame = function() {

				if ( this._frame )
					return this._frame;

				this._frame = wp.media({
					title: wpmcp_lang.import_images_title.replace( '%s', wpmcp.editor._movie_title ),
					frame: 'select',
					searchable: false,
					library: {
						// Dummy: avoid any image to be loaded
						type: 'images',
						post__in:[ wpmcp.editor._movie_id ],
						post__not_in:[0],
						s: 'TMDb_ID=' + wpmcp.editor._movie_tmdb_id + ',type=image'
					},
					multiple: true,
					button: {
						text: wpmcp_lang.import_images
					}
				});

				this._frame.options.button.reset = false;
				this._frame.options.button.close = false;
				this._frame.state('library').unbind( 'select' ).on( 'select', this.select );
				this._frame.on( 'open', this.ready );
				this._frame.state('library').get('selection').on( 'selection:single', function() {
					$( wpmcp_images._frame.content.selector ).find( '.attachments-browser' ).removeClass( 'hide-sidebar' );
				} );

				return this._frame;
			};

			/**
			 * Set the modal to browse mode
			 */
			wpmcp.media.images.ready = function() {

				wpmcp_images._frame.content.mode( 'browse' );
				$( wpmcp_images._frame.content.selector ).find( '.attachments-browser' ).addClass( 'hide-sidebar' );
			};

			/**
			 * Select override for Modal
			 * 
			 * Handle selected images and custom progress bar
			 */
			wpmcp.media.images.select = function() {

				var $content = $( wpmcp_images._frame.content.selector );

				if ( ! $('#progressbar_bg').length )
					$content.append('<div id="progressbar_bg"><div id="progressbar"><div id="progress" style="width:5%"></div></div><div id="progress_status">' + wpmcp_lang.import_images_wait + '</div>');

				$('#progressbar_bg, #progressbar').show();

				var settings = wp.media.view.settings,
				    selection = this.get('selection'),
				    total = selection.length;

				$('.added').remove();

				wpmcp_images.total = total;
				selection.map( wpmcp_images.upload );
				wpmcp_images._frame.state('library').get('selection').reset();

				return;
			};

			/**
			 * Upload select images.
			 * 
			 * @param    object    Image to upload
			 * @param    int       Image index to update the progress bar
			 */
			wpmcp.media.images.upload = function( image, i ) {

				var index = i + 1;
				var progress = index == wpmcp_images.total ? 100 : Math.round( ( index * 100 ) / wpmcp_images.total );

				$.ajaxQueue({
					data: {
						action: 'wpmcp_upload_image',
						nonce: wpmcp.get_nonce( 'upload-movie-image' ),
						image: image.attributes.metadata,
						title: wpmcp.editor._movie_title,
						post_id: wpmcp.editor._movie_id,
						tmdb_id: wpmcp.editor._movie_tmdb_id
					},
					beforeSend: function() {},
					error: function( response ) {
						wpmcp_state.clear();
						$.each( response.responseJSON.errors, function() {
							wpmcp_state.set( this, 'error' );
						});
					},
					success: function( response ) {
						if ( ! isNaN( response.data ) && parseInt( response.data ) == response.data ) {
							$('#tmdb_load_images').parent('.tmdb_movie_images').before('<div class="tmdb_movie_images tmdb_movie_imported_image"><img width="' + image.attributes.sizes.medium.width + '" height="' + image.attributes.sizes.medium.height + '" src="' + image.attributes.sizes.medium.url + '" class="attachment-medium" class="attachment-medium" alt="' + wpmcp.editor._movie_title + '" /></div>');
						}
					},
					complete: function() {
						$('#progressbar #progress').animate( { width: '' + progress + '%' }, 250 );
						if ( index == wpmcp_images.total ) {
							$('#progress_status').text( wpmcp_lang.done );
							window.setTimeout( wpmcp_images.close(), 2000 );
						}
						else {
							var t = $('#progress_status').text();
							$('#progress_status').text(t+'.');
						}
					}
				});
			};

			/**
			 * Close the Modal
			 */
			wpmcp.media.images.close = function() {
				$('#progressbar_bg, #progressbar').remove();
				if ( undefined != wpmcp_images._frame )
					wpmcp_images._frame.close();
			};

		/**
		 * WPMOLY Movie Media: Movie Posters
		 */
		wpmcp.media.posters = wpmcp_posters = {

			init: function() {},
			frame: function() {},
			select: function() {},
			set_featured: function() {},
			close: function() {}
		}

			/**
			 * Init WPMOLY Media Posters
			 */
			wpmcp.media.posters.init = function() {
				wpmcp_posters.frame().open();
			};

			/**
			 * Media Posters Modal. Extends WP Media Modal to show
			 * movie posters from external API instead of regular WP
			 * Attachments.
			 */
			wpmcp.media.posters.frame = function() {

				if ( this._frame )
					return this._frame;

				this._frame = wp.media({
					title: wpmcp_lang.import_poster_title.replace( '%s', wpmcp.editor._movie_title ),
					frame: 'select',
					searchable: false,
					library: {
						// Dummy: avoid any image to be loaded
						type : 'image',
						post__in:[ wpmcp.editor._movie_id ],
						post__not_in:[0],
						s: 'TMDb_ID=' + wpmcp.editor._movie_tmdb_id + ',type=poster'
					},
					multiple: false,
					button: {
						text: wpmcp_lang.import_poster
					}
				});

				this._frame.options.button.event = 'import_poster';
				this._frame.options.button.reset = false;
				this._frame.options.button.close = false;

				this._frame.state('library').unbind('select').on('import_poster', this.select);
				this._frame.on( 'open', this.ready );
				this._frame.state('library').get('selection').on( 'selection:single', function() {
					$( wpmcp_posters._frame.content.selector ).find( '.attachments-browser' ).removeClass( 'hide-sidebar' );
				} );

				return this._frame;
			};

			/**
			 * Set the modal to browse mode
			 */
			wpmcp.media.posters.ready = function() {

				wpmcp_posters._frame.content.mode( 'browse' );
				$( wpmcp_posters._frame.content.selector ).find( '.attachments-browser' ).addClass( 'hide-sidebar' );
			};

			/**
			 * Select override for Modal
			 * 
			 * Handle selected poster and custom progress bar
			 */
			wpmcp.media.posters.select = function() {


				var $content = $(wpmcp_posters._frame.content.selector);

				if ( ! $('#progressbar_bg').length )
					$content.append('<div id="progressbar_bg"><div id="progressbar"><div id="progress"></div></div><div id="progress_status">' + wpmcp_lang.import_poster_wait + '</div>');

				$('#progressbar_bg, #progressbar').show();
				$('#progressbar #progress').width('40%');

				var settings = wp.media.view.settings,
				    selection = this.get('selection'),
				    total = selection.length;

				$('.added').remove();

				wpmcp_posters.total = total;
				selection.map( wpmcp_posters.set_featured );
				wpmcp_posters._frame.state('library').get('selection').reset();

				return;
			};

			/**
			 * Set Poster as featured image.
			 * 
			 * Upload the selected image and set it as the post's
			 * featured image.
			 */
			wpmcp.media.posters.set_featured = function( image ) {

				if ( undefined != image.attributes && undefined != image.attributes.metadata ) {
					var _image = {file_path: image.attributes.metadata.file_path};
				}
				else {
					if ( 0 <= parseInt( wp.media.featuredImage.get() ) ) {
						$('#progressbar #progress').width('100%');
						$('#progress_status').text( wpmcp_lang.done );
						window.setTimeout( wpmcp_posters.close(), 2000 );
						return false;
					}

					var _image = {file_path: image};
				}

				wpmcp._post({
					data: {
						action: 'wpmcp_set_featured',
						nonce: wpmcp.get_nonce( 'set-movie-poster' ),
						image: _image,
						title: wpmcp.editor._movie_title,
						post_id: wpmcp.editor._movie_id,
						tmdb_id: wpmcp.editor._movie_tmdb_id
					},
					error: function( response ) {
						wpmcp_state.clear();
						$.each( response.responseJSON.errors, function() {
							wpmcp_state.set( this, 'error' );
						});
					},
					success: function( response ) {
						if ( response ) {
							wp.media.featuredImage.set( response.data );
							if ( undefined != image.attributes ) {
								$( '#wpmcp-movie-preview-poster > img' ).prop( 'src', image.attributes.url );
							}
						}
					},
					complete: function() {
						$('#progress_status').text( wpmcp_lang.done );
						window.setTimeout( wpmcp_posters.close(), 2000 );
					}
				});

			};

			/**
			 * Close the Modal
			 */
			wpmcp.media.posters.close = function() {
				$('#progressbar_bg, #progressbar').remove();
				if ( undefined != wpmcp_posters._frame )
					wpmcp_posters._frame.close();
			};

		wpmcp.media.no_movie = function() {

			wpmcp_state.clear();
			wpmcp_state.set( wpmcp_lang.media_no_movie, 'error' );
		};

		wpmcp.media.init = function() {

			$('#tmdb_load_images').on( 'click', function( e ) {
				e.preventDefault();

				if ( undefined == wpmcp.editor._movie_tmdb_id || '' == wpmcp.editor._movie_tmdb_id ) {
					wpmcp.media.no_movie();
					return false;
				}

				wpmcp_images.init();
				wpmcp_images._frame.$el.addClass('movie-images');
				if ( undefined != wpmcp_images._frame.content.get('library').collection )
					wpmcp_images._frame.content.get('library').collection.props.set({ignore: (+ new Date())});
			});

			$('#postimagediv').on( 'click', '#tmdb_load_posters', function( e ) {
				e.preventDefault();

				if ( undefined == wpmcp.editor._movie_tmdb_id || '' == wpmcp.editor._movie_tmdb_id ) {
					wpmcp.media.no_movie();
					return false;
				}

				wpmcp_posters.init();
				wpmcp_posters._frame.$el.addClass('movie-posters');
				if ( undefined != wpmcp_posters._frame.content.get('library').collection )
					wpmcp_posters._frame.content.get('library').collection.props.set({ignore: (+ new Date())});
			});

			// Don't try to open editor modal on old WP versions
			if ( 4 == $( '#wp-version' ).val() ) {

				$( '.tmdb_movie_images a.open-editor' ).each( function() {
					var href = $( this ).prop( 'href' );
					$( this ).attr( 'data-href', href );
					$( this ).prop( 'href', '' );
				} );

				/*$( '.tmdb_movie_images a.open-editor' ).on( 'click', function( e ) {
					e.preventDefault();

					var id = $( this ).attr( 'data-id' );
					wpmcp_images.editor( id );
				} );*/
			}
		};

	wpmcp.media.init();
