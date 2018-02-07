
wpmcp = wpmcp || {};

wpmcp.settings = wpmcp_settings = {}

	wpmcp.settings.init = function() {

		$( '#wpmcp-sort-meta_used h3, #wpmcp-sort-details_used h3, #wpmcp-movie-archives-movies-meta_used h3' ).text( wpmcp_lang.used );
		$( '#wpmcp-sort-meta_available h3, #wpmcp-sort-details_available h3, #wpmcp-movie-archives-movies-meta_available h3' ).text( wpmcp_lang.available );

		$( '#wpmcp-sort-details_disabled li' ).appendTo( '#wpmcp-sort-details_available' );
		$( '#wpmcp-sort-details_disabled' ).remove();

	};

	wpmcp.settings.init();
