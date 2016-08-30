/*!
 * Additional Posts Loader
 *
 * This is called by markup at the bottom of certain page templates. It then
 * polls the WP JSON API for more news stories, and transforms the returned
 * JSON objects into rendered HTML.
 *
 */

var window, document, jQuery;

window.mitlibnews = window.mitlibnews || {};

window.mitlibnews.loader = {

	/**
	 * Properties
	 */
	container : '',
	offset: 0,
	page: 1,
	postcontent: '',

	/**
	 * Initialize
	 */
	initialize : function() {
		console.log('MIT Libraries News Loader initializing...');
		// Identify container that will receive post cards.
		this.container = document.getElementById('mitlibnews-container');
		// The type of query is identified by data attribute on the container.
		this.setPostcontent();
		console.log('Initialization complete.');
	},

	/**
	 * Simple Post Loader
	 */
	loadPosts : function(posts_per_page) {
		console.log('Loading ' + posts_per_page + ' posts');
		console.log('Filter: ');
		var filter = {
			'posts_per_page': posts_per_page,
		};
		console.log(filter);
		jQuery.ajax({
			url: '/news/wp-json/posts',
			data: {
				filter: filter,
				page: this.page,
			},
			dataType: 'json',
			type: 'GET',
			success: function(data) {
				console.log(posts_per_page + ' posts loaded');
				// identify targeted container
				var target = window.mitlibnews.loader.getContainer();
				jQuery.each(data, function( index, value ) {
					jQuery(target).append( window.mitlibnews.loader.renderCard(value) );
				});
				window.mitlibnews.loader.setPage( window.mitlibnews.loader.getPage() + 1);
				console.log('New page: ');
				console.log(window.mitlibnews.loader.getPage());
			},
			error: function() {
				console.log("Error");
			}
		});
		console.log('');
	},

	/**
	 * Load More - Archive
	 */
	loadArchive : function() {
		console.log('Loading Archive posts...');
		jQuery.ajax({
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

	/**
	 * Card Renderer
	 *
	 * This takes a JSON object representing a post, and returns relevant markup
	 */
	renderCard : function(post) {
		var card, cardBody, cardContainer, cardCategory;
		console.log(post);

		// Card outer element
		card = document.createElement( 'div' );
		// TODO: Is this string of classes standard?
		jQuery(card).addClass( 'no-padding-left-mobile col-xs-12 col-xs-B-6 col-sm-6 col-md-4 col-lg-4' );

		// Card inner element
		cardBody = document.createElement( 'div' );
		// TODO: Is this string of classes standard?
		jQuery(cardBody).addClass( 'flex-item blueTop eventsBox no-image' );
		// TODO: need an onClick attribute?
		jQuery(card).append( cardBody );

		// interiorCardContainer
		cardContainer = document.createElement( 'div' );
		jQuery(cardContainer).addClass( 'interiorCardContainer' );
		jQuery(cardBody).append( cardContainer );

		jQuery(cardContainer).append( document.createTextNode( post.ID ) );
		jQuery(cardContainer).append( document.createElement( 'br' ) );
		jQuery(cardContainer).append( document.createTextNode( post.title ) );

		// category element
		cardCategory = document.createElement( 'div' );
		jQuery(cardCategory).addClass( 'category-post' );
		// TODO: Bibliotech class
		jQuery(cardBody).append( cardCategory );

		return card;
	},

	/**
	 * Get Container
	 */
	getContainer : function() {
		return document.getElementById('mitlibnews-container');
	},

	/**
	 * Get Offset
	 */
	getOffset : function() {
		console.log("Retrieving offset value of " + this.offset);
		return this.offset;
	},

	/**
	 * Get Page
	 */
	getPage : function() {
		return this.page;
	},

	/**
	 * Get Container
	 */
	getPostcontent : function() {
		return this.postcontent;
	},

	/**
	 * Set Offset
	 */
	setOffset : function(value) {
		console.log("Replacing offset value of " + this.offset + " with " + value);
		this.offset = value;
		return this.getOffset();
	},

	/**
	 * Set Page
	 */
	setPage : function(value) {
		console.log("Replacing page value of " + this.page + " with " + value);
		this.page = value;
	},

	/**
	 * Set Post Content
	 */
	setPostcontent : function(value) {
		// The default value is 'all'.
		this.postcontent = 'all';
		// If everything is not set, just use the default.
		if ( !this.container || !this.container.dataset || !this.container.dataset.postcontent ) {
			console.log( 'Post content attribute not found! Using default value.' );
			return true;
		}
		// If we're still here, use the real value.
		this.postcontent = this.container.dataset.postcontent;
		return true;
	}
};
