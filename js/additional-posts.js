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
	loadPosts : function() {
		console.log('Loading more posts...');
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
