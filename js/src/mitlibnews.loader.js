/**
 * This plugin handles loading posts from WordPress' JSON API. They are then
 * appended to a container as HTML in a card format.
 */
function Loader(params) {
	"use strict";

	// Container is the HTML element to which cards are added.
	this.container = '';
	// Page is the counter used to replicate pagination
	this.page = 1;
	// Postcontent is specified by the host markup, and influences how the API
	// is queried.
	this.postcontent = '';

	this.getPage = function() {
		return +this.page;
	};

	this.setPage = function(value) {
		this.page = +value;
	};

}
