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
		this.postcontainer = document.getElementById( this.getContainer() );

		// If no post container is found, then we quit and do nothing further.
		if( !this.postcontainer ) {
			return false;
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
		// Context-specific values
		if ( this.getPostcontent() === 'author' ) {
			filter.author = this.postcontainer.dataset.postauthor;
		}
		// Assemble pieces into query object
		query.filter = filter;
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
			url: '/news/wp-json/posts',
			data: query,
			dataType: 'json',
			type: 'GET',
			success: function(data) {
				jQuery.each(data, function( index, value ) {
					console.log(value);
				});
			},
			error: function() {
				console.log('Error');
			}
		});
	},

	// Render a JSON object into HTML
	renderCard: function(index, post) {
		console.log(index);
		console.log(post);
		jQuery( this.postContainer ).append( post );
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