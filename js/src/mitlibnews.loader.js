var document;

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
		// Connect to markup
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

	// Load attributes
	loadAttributes : function() {
		// If the post container doesn't have data attributes, then leave the defaults
		if ( !this.postcontainer || !this.postcontainer.dataset ) {
			console.log('Container or data attributes not found - leaving defaults');
			return true;
		}

		if ( this.postcontainer.dataset.pagesize ) {
			console.log('Overriding page size');
			this.setPagesize( this.postcontainer.dataset.pagesize );
		}

		if ( this.postcontainer.dataset.postcontent ) {
			console.log('Overriding post content');
			this.setPostcontent( this.postcontainer.dataset.postcontent );
		}

		return true;
	},

	// Load posts
	loadPosts : function() {
		console.log('Loading ' + this.getPagesize() + ' posts (page ' + this.getPage() + ')');
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