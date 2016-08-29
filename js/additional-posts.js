/*!
 * Additional Posts Loader
 *
 * This is called by markup at the bottom of certain page templates. It then
 * polls the WP JSON API for more news stories, and transforms the returned
 * JSON objects into rendered HTML.
 *
 */

window.mitlibnews = window.mitlibnews || {};

window.mitlibnews.loader = {

	/**
	 * Initialize
	 */
	initialize : function() {
		console.log('MIT Libraries News Loader initialized');
	},

	/**
	 * Simple Post Loader
	 */
	loadPosts : function(offset, posts_per_page) {
		$.ajax({
			url: '/news/wp-json/posts',
			data: {
				filter: {
					'posts_per_page': posts_per_page,
					'offset': offset,
				}
			},
			dataType: 'json',
			type: 'GET',
			success: function(data) {
				$.each(data, function( index, value ) {
					card = document.createElement( "div" );
					$(card).addClass( "no-padding-left-mobile col-xs-12 col-xs-B-6 col-sm-6 col-md-4 col-lg-4" );
					cardBody = document.createElement( "div" );
					$(cardBody).addClass( "flex-item blueTop eventsBox no-image" );
					$(card).append( cardBody );
					$(cardBody).append( document.createTextNode( value.ID ) );
					$(cardBody).append( document.createTextNode( "<br>" ) );
					$(cardBody).append( document.createTextNode( value.title ) );
					$("#mitlibnews").append( card );
				});
			},
			error: function() {
				console.log("Error");
			}
		});
	},

	/**
	 * Load More - Archive
	 */
	loadArchive : function() {
		console.log('Loading Archive posts...');
		$.ajax({
			url: '/news/wp-json/posts',
			data: {
				filter: {
					'posts_per_page': 9,
					'offset': 10,
				}
			},
			dataType: 'json',
			type: 'GET',
			success: function(data) {
				console.log(data);
			},
			error: function() {
				console.log("Error");
			}
		});
	},

	/**
	 * Load More - Bibliotech Posts
	 */

	/**
	 * Load More - by Category
	 */

	/**
	 * Load More - Event Posts
	 */

	/**
	 * Load More - Generic
	 */

	/**
	 * Load More - News Posts
	 */

	/**
	 * Load More - Search Results
	 */

}
