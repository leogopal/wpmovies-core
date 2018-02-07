
if ( undefined == window.wpmcp ) window.wpmcp = {};
if ( undefined == window.redux ) window.redux = {};
if ( undefined == window.redux.field_objects ) window.redux.field_objects = {};
if ( undefined == window.redux.field_objects.select ) window.redux.field_objects.select = {};

$ = $ || jQuery;

wpmcp = {};

	wpmcp.init = function() {};

	wpmcp.editor = {};
	wpmcp.importer = {};
	wpmcp.queue = {};
	wpmcp.movies = {};
	wpmcp.media = {};
	wpmcp.landing = {};
	wpmcp.settings = {};

		/**
		 * Movies Post Editor page's Metadata part
		 * 
		 * @since    1.0
		 */
		wpmcp.editor.meta = {};
			wpmcp.editor.meta.search = function( post_id, title, caller ) {};
			wpmcp.editor.meta.select = function( movies, message ) {};
			wpmcp.editor.meta.get = function( tmdb_id ) {};
			wpmcp.editor.meta.set = function( data ) {};
			wpmcp.editor.meta.prefill_title = function( title ) {};

		/**
		 * Movies Post Editor page's Details part
		 * 
		 * @since    1.0
		 */
		wpmcp.editor.details = {};
			wpmcp.editor.details = {};
				wpmcp.editor.details.init = function() {};
				wpmcp.editor.details.save = function() {};
				wpmcp.editor.details.inline_editor = function( type, link ) {};
				wpmcp.editor.details.inline_edit = function( type, link ) {};

			wpmcp.editor.details.media = {};
				wpmcp.editor.details.init = function() {};
				wpmcp.editor.details.show = function() {};
				wpmcp.editor.details.update = function() {};
				wpmcp.editor.details.revert = function() {};

			wpmcp.editor.details.rating = {};
				wpmcp.editor.details.init = function() {};
				wpmcp.editor.details.show = function() {};
				wpmcp.editor.details.update = function() {};
				wpmcp.editor.details.revert = function() {};

		/**
		 * Handles the Imported part of the Importer: search for movies'
		 * metadata, select movies in lists, set data fields.
		 * 
		 * @since    1.0
		 */
		wpmcp.importer.meta = {};
			wpmcp.importer.meta.do = function( action ) {};
			wpmcp.importer.meta.search = function( post_id ) {};
			wpmcp.importer.meta.select = function( movies, message ) {};
			wpmcp.importer.meta.get = function( post_id, tmdb_id ) {};
			wpmcp.importer.meta.set = function( data ) {};

		/**
		 * Handles the Import part of the Importer: import lists of movies
		 * or delete movies
		 * 
		 * @since    1.0
		 */
		wpmcp.importer.movies = {};
			wpmcp.importer.movies.delete = function() {};
			wpmcp.importer.movies.import = function() {};

		/**
		 * Handles the Importer view alterations like AJAX nav or counter
		 * updates.
		 * 
		 * @since    1.0
		 */
		wpmcp.importer.view = {};
			wpmcp.importer.view.reload = function() {};
			wpmcp.importer.view.navigate = function() {};
			wpmcp.importer.view.paginate = function() {};
			wpmcp.importer.view.update_count = function() {};

		/**
		 * TODO
		 * 
		 * @since    1.0
		 */
		wpmcp.queue.movies = {};
			wpmcp.queue.movies.add = function() {};
			wpmcp.queue.movies.remove = function() {};
			wpmcp.queue.movies.prepare = function() {};
			wpmcp.queue.movies.import = function() {};

		/**
		 * TODO
		 * 
		 * @since    1.0
		 */
		wpmcp.queue.utils = {};
			wpmcp.queue.utils.toggle_button = function() {};
			wpmcp.queue.utils.toggle_inputs = function() {};

		/**
		 * Movie Images handling
		 * 
		 * @since    1.0
		 */
		wpmcp.media.images = {};
			wpmcp.media.images.init = function() {};
			wpmcp.media.images.frame = function() {};
			wpmcp.media.images.select = function() {};
			wpmcp.media.images.upload = function() {};
			wpmcp.media.images.close = function() {};

		/**
		 * Movie Posters handling
		 * 
		 * @since    1.0
		 */
		wpmcp.media.posters = {};
			wpmcp.media.posters.init = function() {};
			wpmcp.media.posters.frame = function() {};
			wpmcp.media.posters.select = function() {};
			wpmcp.media.posters.set_featured = function() {};
			wpmcp.media.posters.close = function() {};

		/**
		 * TODO
		 * 
		 * @since    1.0
		 */
		wpmcp.landing.modal = {};
			wpmcp.landing.modal.open = function() {};
			wpmcp.landing.modal.close = function() {};
			wpmcp.landing.modal.resize = function() {};
			wpmcp.landing.modal.update = function() {};

		/**
		 * TODO
		 * 
		 * @since    1.0
		 */
		wpmcp.landing.dashboard = {};
			wpmcp.landing.dashboard.handle_widget = function() {};

		/**
		 * Settings & Import Panels
		 * 
		 * @since    1.0
		 */
		wpmcp.settings.panels = {};
			wpmcp.settings.panels.init = function() {};
			wpmcp.settings.panels.switch_panel = function() {};

		/**
		 * Settings Metadata sorting part
		 * 
		 * @since    1.0
		 */
		wpmcp.settings.sortable = {};
			wpmcp.settings.sortable.init = function() {};
			wpmcp.settings.sortable.update_item_style = function() {};
			wpmcp.settings.sortable.update_item = function() {};

		/**
		 * 
		 * 
		 * @since    1.0
		 */
		wpmcp.settings.utils = {};
			wpmcp.settings.utils.details_select = function() {};
			wpmcp.settings.utils.api_check = function() {};
			wpmcp.settings.utils.toggle_radio = function() {};


jQuery(document).ready(function() {
	wpmcp.init();
});