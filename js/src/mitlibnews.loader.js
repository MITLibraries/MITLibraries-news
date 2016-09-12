function Loader(params) {
	"use strict";

	console.log('Loader here');

	// Default parameters
	// Container is the HTML element to which everything is added.
	this.container = 'mitlibnews-container';
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
}

Loader.prototype = {
	constructor: Loader,

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