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
	 * Post Loader
	 */
	loadPosts : function() {
		console.log('Loading more posts...');
	}

}
