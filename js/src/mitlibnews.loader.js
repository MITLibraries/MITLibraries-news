/**
 * This plugin handles loading posts from WordPress' JSON API. They are then
 * appended to a container as HTML in a card format.
 */
var document, jQuery;

function Loader(params) {
	"use strict";

	console.log('Loader called');

	// Set default parameters
	// Container is the HTML element to which cards are added.
	this.container = 'mitlibnews-container';
	// Page is the counter used to replicate pagination
	this.page = 1;
	// Postcontent is specified by the host markup, and influences how the API
	// is queried.
	this.postcontent = '';
	// Postcount determines the size of the standard batch of posts.
	this.postcount = 0;

	// Read parameter object, if present
	if ( params ) {
		console.log(params);
		if ( '' !== params.container ) {
			this.container = params.container;
		}
		if ( '' !== params.page ) {
			this.page = params.page;
		}
		if ( '' !== params.postcontent ) {
			this.postcontent = params.postcontent;
		}
		if ( '' !== params.postcount ) {
			this.postcount = params.postcount;
		}
	}

	this.container = this.setContainer( this.container );

	// If the passed parameters haven't set what type of content to load,
	// then we look it up from markup
	if ( '' === this.postcontent ) {
		console.log('Postcontent not set. Setting now...');
		this.postcontent = this.setPostContent();
	}
	if ( 0 === this.postcount ) {
		console.log('Post count not set. Setting now...');
		this.postcount = this.setPostCount();
	}

	console.log( this );

	this.loadPosts( this.postcount );

	console.log('End of loader being called');

	// Affix click listener
	jQuery( "#mitlibnews-another" ).click(function() {
		console.log('click');
		Loader.prototype.loadPosts( this.postcount );
		console.log('end click');
	});
}

Loader.prototype = {
	constructor: Loader,

	getPage : function() {
		return +this.page;
	},

	setPage : function(value) {
		this.page = +value;
	},

	setContainer : function(element) {
		console.log('Looking for ' + element);
		return document.getElementById(element);
	},

	setPostContent : function() {
		// The default value is 'all' for all posts
		var value = 'all';
		// If there isn't a valid data attribute on the declared container,
		// just keep the default
		if ( !this.container || !this.container.dataset || !this.container.dataset.postcontent ) {
			return value;
		}
		// If there is a valid data attribute, use that value
		return this.container.dataset.postcontent;
	},

	setPostCount : function() {
		// The default value is 'all' for all posts
		var value = 9;
		// If there isn't a valid data attribute on the declared container,
		// just keep the default
		if ( !this.container || !this.container.dataset || !this.container.dataset.postcount ) {
			return value;
		}
		// If there is a valid data attribute, use that value
		return this.container.dataset.postcount;
	},

	loadPosts : function( count ) {
		console.log('Loading ' + count + ' posts...');
	}

};
