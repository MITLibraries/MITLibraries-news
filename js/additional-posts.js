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
		console.log('Query: ');
		var query = this.buildQuery(posts_per_page);
		console.log(query);
		jQuery.ajax({
			url: '/news/wp-json/posts',
			data: query,
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
	 * Build query
	 *
	 * This builds the data object used to query the JSON API.
	 */
	buildQuery : function(posts_per_page) {
		var query = {};
		var filter = {
			'posts_per_page': posts_per_page,
		};
		// If author mode, add that filter
		if ( this.postcontent === 'author' ) {
			filter.author = this.container.dataset.postauthor;
		} else if ( 'bibliotech' === this.postcontent ) {
			query.type = 'bibliotech';
		}
		query.filter = filter;
		query.page = this.page;
		return query;
	},

	/**
	 * Card Renderer
	 *
	 * This takes a JSON object representing a post, and returns relevant markup
	 */
	renderCard : function(post) {
		// Main card containers
		var card, cardBody, cardContainer, cardFooter;
		// Card content elements
		var cardTitle, cardLink, cardExcerpt, cardCategory, cardDate, cardDateContainer, cardDateValue, cardImage, cardIcon;
		// Bibliotech-specific containers
		var cardBibliotechIcon, cardBibliotechInner, cardBibliotechLink;
		// Random number
		var cardRandomIndex;
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

		// interiorCardContainer
		cardContainer = document.createElement( 'div' );
		jQuery(cardContainer).addClass( 'interiorCardContainer' );

		// Card image

		// Card icon

		// Card title
		// There are different classes for spotlights and other cards
		cardTitle = document.createElement( 'h2' );
		jQuery(cardTitle).addClass( 'entry-title title-post' );
		if ( 'spotlights' === post.type ) {
			jQuery(cardTitle).addClass( 'spotlights' );
		} else {
			jQuery(cardTitle).addClass( 'classCheck' );
		}

		// Card link
		// This is a custom field for spotlight cards, but a post URL otherwise
		cardLink = document.createElement( 'a' );
		if ( 'spotlight' === post.type ) {
			// Spotlights link to a custom field
			jQuery(cardLink).attr( 'href', post.meta.external_link );
		} else {
			jQuery(cardLink).attr( 'href', post.link );
		}
		jQuery(cardLink).append( document.createTextNode( post.title ) );

		// Card excerpt
		cardExcerpt = document.createElement( 'div' );
		jQuery(cardExcerpt)
			.addClass( 'excerpt-post classCheck' )
			.html( post.excerpt );

		// Card footer
		cardFooter = document.createElement( 'div' );
		jQuery(cardFooter).addClass( 'category-post' );

		// Card Bibliotech footer
		if ( 'bibliotech' === post.type ) {
			// Bibliotech icon
			cardBibliotechIcon = document.createElement( 'div' );
			// TODO: spelling error
			jQuery(cardBibliotechIcon).addClass( 'bilbioImg bilbioTechIcon' );

			// Bibliotech inner element
			cardBibliotechInner = document.createElement( 'div' );
			jQuery(cardBibliotechInner)
				.addClass( 'biblioPadding' )
				.append( document.createTextNode( '\u00A0' ) );

			// Bibliotech link
			cardBibliotechLink = document.createElement( 'a' );
			jQuery(cardBibliotechLink)
				.attr( 'href', '/news/bibliotech-index/' )
				.attr( 'title', 'Bibliotech' )
				.append( document.createTextNode( 'Bibliotech' ) );
		}

		// Card category link
		cardCategory = document.createElement( 'a' );
		// Pick a random category
		cardRandomIndex = Math.floor( Math.random() * post.terms.category.length );
		jQuery(cardCategory)
			.attr( 'title', post.terms.category[cardRandomIndex].name )
			.attr( 'href', post.terms.category[cardRandomIndex].link )
			.html( post.terms.category[cardRandomIndex].name );

		// Card date container
		cardDateContainer = document.createElement( 'span' );
		jQuery(cardDateContainer).addClass( 'mitDate' );
		// Card time
		cardDateValue = jQuery.datepicker.formatDate('MM d, yy', new Date( post.modified ) );
		cardDate = document.createElement( 'time' );
		jQuery(cardDate)
			.addClass( 'updated' )
			.attr( 'datetime', cardDateValue )
			.append( document.createTextNode( cardDateValue ) );

		// Assemble pieces
		jQuery(card).append( cardBody );
		jQuery(cardBody).append( cardContainer );
		jQuery(cardBody).append( cardFooter );
		jQuery(cardContainer).append( cardTitle );
		jQuery(cardContainer).append( cardExcerpt );
		jQuery(cardTitle).append( cardLink );
		// If bibliotech, append specific footer
		if ( 'bibliotech' === post.type ) {
			jQuery(cardFooter).addClass( 'Bibliotech' );
			jQuery(cardFooter).append( cardBibliotechIcon );
			jQuery(cardFooter).append( cardBibliotechInner );
			jQuery(cardBibliotechInner).append( cardBibliotechLink );
		} else {
			jQuery(cardFooter).append( cardCategory );
			jQuery(cardFooter).append( cardDateContainer );
			jQuery(cardDateContainer).append( cardDate );

		}

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
