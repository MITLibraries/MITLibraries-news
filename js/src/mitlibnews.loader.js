var document, jQuery;

function Loader(params) {
	"use strict";

	// Default parameters
	// Container is the HTML element to which everything is added.
	this.container = 'mitlibnews-container';
	// Postcontainer is DOM element corresponding to Container.
	this.postcontainer = '';
	// Page is the counter used for pagination.
	this.page = 1;
	// Pagesize sets how many articles are loaded in a page
	this.pagesize = 9;
	// Postcontent determines what type of content is loaded from the API
	this.postcontent = 'all';

	// Read param object, if passed, and set new values
	if ( params ) {
		if ( '' !== params.container ) {
			this.setContainer( params.container );
		}
		if ( '' !== params.page ) {
			this.setPage( params.page );
		}
		if ( '' !== params.pagesize ) {
			this.setPagesize( params.pagesize );
		}
		if ( '' !== params.postcontent ) {
			this.setPostcontent( params.postcontent );
		}
	}

	// Connect to markup, read data attributes
	this.initialize();

}

Loader.prototype = {
	constructor: Loader,

	// Initialization
	initialize : function() {
		// Look up specified post container in DOM
		console.log('Looking for ' + this.getContainer() );
		this.postcontainer = document.getElementById( this.getContainer() );

		// If no post container is found, then we quit and do nothing further.
		if( !this.postcontainer ) {
			console.log('Post container not found...');
			return false;
		} else {
			console.log('Post container found. Continuing...');
		}

		// Read data attributes
		this.loadAttributes();

		// Load posts
		this.loadPosts();
	},

	/**
	 * Build query
	 *
	 * This builds a JSON object that will be fed to the API in order to return posts
	 */
	buildQuery : function() {
		var query = {
			'page': this.getPage(),
		};
		var filter = {
			'posts_per_page': this.getPagesize(),
		};
		var type = ['post', 'bibliotech', 'spotlights'];
		// Context-specific values
		if ( this.getPostcontent() === 'author' ) {
			filter.author = this.postcontainer.dataset.postauthor;
			// Author indexes don't show Spotlights
			type = ['post', 'bibliotech'];
		} else if ( this.getPostcontent() === 'bibliotech' ) {
			// Only return bibliotech content
			type = ['bibliotech'];
		} else if ( this.getPostcontent() === 'category' ) {
			query.categories = [this.postcontainer.dataset.postcategory];
		} else if ( this.getPostcontent() === 'futureevents' ) {
			// Only return post content
			type = ['post'];
			filter.meta_query = [{
				'key': 'is_event',
				'value': true,
				'type': 'future',
			}];
		} else if ( this.getPostcontent() === 'issue' ) {
			query.issue = this.postcontainer.dataset.postissue;
			type = ['bibliotech'];
		} else if ( this.getPostcontent() === 'news' ) {
			// Only return post content
			type = ['post'];
			filter.meta_query = [{
				'key': 'is_event',
				'value': false,
			}];
		} else if ( this.getPostcontent() === 'pastevents' ) {
			// Only return post content
			type = ['post'];
			filter.meta_query = [{
				'key': 'is_event',
				'value': true,
				'type': 'past',
			}];
		} else if ( this.getPostcontent() === 'related' ) {
			// Related queries are sorted randomly
			filter.orderby = 'rand';
			query.categories = [this.postcontainer.dataset.postcategory];
		} else if ( this.getPostcontent() === 'search' ) {
			query.search = this.postcontainer.dataset.search;
		}
		// Assemble pieces into query object
		query.filter = filter;
		query.type = type;
		return query;
	},

	// Load attributes
	loadAttributes : function() {
		// If the post container doesn't have data attributes, then leave the defaults
		if ( !this.postcontainer || !this.postcontainer.dataset ) {
			return true;
		}

		if ( this.postcontainer.dataset.pagesize ) {
			this.setPagesize( this.postcontainer.dataset.pagesize );
		}

		if ( this.postcontainer.dataset.postcontent ) {
			this.setPostcontent( this.postcontainer.dataset.postcontent );
		}

		// At this point, the status of values like this.postcontent are set.

		return true;
	},

	// Load posts
	loadPosts : function() {

		// Assemble query object
		var query = this.buildQuery();

		console.log('Query object:');
		console.log(query);

		// Query the API
		jQuery.ajax({
			url: '/news/wp-json/mitlibnews/v1/cards',
			data: query,
			dataType: 'json',
			type: 'GET',
			context: this,
			success: function(data) {

				// Unsure of how to transfer context inside .each() properly - bind is deprecated, proxy ?
				// http://stackoverflow.com/questions/28347248/change-context-in-each
				var self = this;

				jQuery.each(data, function( index, value ) {
					console.log( ( index + '          ' + value.type ).slice( '-12' ) + ': ' + value.title.rendered );
					console.log(value);

					// Render
					self.renderCard(index, value);

				});

				// Increment pagination
				this.setPage( this.getPage() + 1 );
				console.log('Set page to ' + this.getPage() );
			},
			error: function() {
				console.log('Error');
			}
		});
	},

	// Render a JSON object into HTML
	renderCard: function(index, post) {
		// Card components
		var card, cardBody, cardContainer, cardFooter; // Structural components

		// Card outer element.
		card = document.createElement( 'div' );
		jQuery( card )
			.addClass( 'no-padding-left-mobile col-xs-12 col-xs-B-6 col-sm-6 col-md-4 col-lg-4' );

		// Card inner element.
		cardBody = document.createElement( 'div' );
		jQuery( cardBody )
			.addClass( 'flex-item blueTop eventsBox' )
			.attr( 'onClick', 'location.href="' + post.link + '"' );

		// Card container
		cardContainer = document.createElement( 'div' );
		jQuery( cardContainer )
			.addClass( 'interiorCardContainer' );

		// Card footer
		cardFooter = document.createElement( 'div' );
		jQuery( cardFooter )
			.addClass( 'category-post' );

		// Assemble pieces.
		jQuery( card ).append( cardBody );

		jQuery( cardBody ).append( cardContainer );
		jQuery( cardBody ).append( cardFooter );

		jQuery( this.postcontainer ).append( card );

	},

	// Container getter and setter
	getContainer : function() {
		return this.container;
	},

	setContainer : function(value) {
		this.container = value;
	},

	// Page getter and setter
	getPage : function() {
		return +this.page;
	},

	setPage : function(value) {
		this.page = +value;
	},

	// Pagesize getter and setter
	getPagesize : function() {
		return +this.pagesize;
	},

	setPagesize : function(value) {
		this.pagesize = +value;
	},

	// Postcontent getter and setter
	getPostcontent : function() {
		return this.postcontent;
	},

	setPostcontent : function(value) {
		this.postcontent = value;
	}
};