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
	page: 1,
	postcontent: '',

	/**
	 * Initialize
	 */
	initialize : function() {
		// Identify container that will receive post cards.
		this.container = document.getElementById('mitlibnews-container');
		// The type of query is identified by data attribute on the container.
		this.setPostcontent();
		return true;
	},

	/**
	 * Simple Post Loader
	 */
	loadPosts : function(posts_per_page) {
		var query = this.buildQuery(posts_per_page);
		jQuery.ajax({
			url: '/news/wp-json/posts',
			data: query,
			dataType: 'json',
			type: 'GET',
			success: function(data) {
				if ( data.length < posts_per_page) {
					window.mitlibnews.loader.hideMore();
				}
				// identify targeted container
				var target = window.mitlibnews.loader.getContainer();
				jQuery.each(data, function( index, value ) {
					jQuery(target).append( window.mitlibnews.loader.renderCard(value) );
				});
				window.mitlibnews.loader.setPage( window.mitlibnews.loader.getPage() + 1);
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
		var cardEventContainer, cardEventDate, cardEventTime, cardEventDateValue, cardEventTimeValue;
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
		jQuery(cardBody).addClass( 'flex-item blueTop eventsBox' );
		// TODO: need an onClick attribute?

		// interiorCardContainer
		cardContainer = document.createElement( 'div' );
		jQuery(cardContainer).addClass( 'interiorCardContainer' );

		// Card image
		if ( post.meta.listImg ) {
			// Image has been declared
			jQuery(cardBody).addClass( 'has-image' );
			cardImage = document.createElement( 'img' );
			jQuery(cardImage)
				.attr( 'src', post.meta.listImg)
				.attr( 'width', '100%' )
				.attr( 'height', '111' )
				.attr( 'alt', post.title )
				.addClass('img-responsive');
		} else {
			// No image
			jQuery(cardBody).addClass( 'no-image' );
		}

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
		jQuery(cardLink).html( post.title );

		// Card event
		if ( post.meta.event_date ) {
			// The event_date field is stored as YYYYMMDD, which is not a format that js Date objects can parse
			// So we do this ourselves, remembering that month is zero-based.
			cardEventDateValue = new Date(
				post.meta.event_date.substring(0,4),
				post.meta.event_date.substring(4,6) - 1,
				post.meta.event_date.substring(6,8)
			);
			// Event container
			cardEventContainer = document.createElement( 'div' );
			jQuery(cardEventContainer)
				.addClass( 'events classCheck' )
				.html( '<span class="bg-image"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px" x="0px" y="0px" viewBox="-299 390 13 13" style="enable-background:new -299 390 13 13;" xml:space="preserve"><style type="text/css">.st0{fill:#F58632;}</style><g><g id="XMLID_9_"><path id="XMLID_35_" class="st0" d="M-286.9,393.7v-0.8c0-0.4-0.4-0.8-0.8-0.8h-0.8v-0.8c0-0.4-0.4-0.8-0.8-0.8 c-0.4,0-0.8,0.4-0.8,0.8v0.8h-4.8v-0.8c0-0.4-0.4-0.8-0.8-0.8c-0.4,0-0.8,0.4-0.8,0.8v0.8h-0.8c-0.4,0-0.8,0.4-0.8,0.8v0.8 C-298.1,393.7-286.9,393.7-286.9,393.7z"/></g><g><path id="XMLID_76_" class="st0" d="M-298.1,394.5v7.2c0,0.4,0.4,0.8,0.8,0.8h9.6c0.4,0,0.8-0.4,0.8-0.8v-7.2H-298.1z M-294.9,400.9h-1.6v-1.6h1.6V400.9z M-294.9,397.7h-1.6v-1.6h1.6V397.7z M-291.7,400.9h-1.6v-1.6h1.6 C-291.7,399.3-291.7,400.9-291.7,400.9z M-291.7,397.7h-1.6v-1.6h1.6C-291.7,396.1-291.7,397.7-291.7,397.7z M-288.5,400.9h-1.6 v-1.6h1.6V400.9z M-288.5,397.7h-1.6v-1.6h1.6V397.7z"/></g></g></svg></span>' );
			// Event date
			cardEventDate = document.createElement( 'span' );
			jQuery(cardEventDate)
				.addClass( 'event' )
				.append( document.createTextNode( jQuery.datepicker.formatDate('MM d, yy', new Date( cardEventDateValue ) ) ) );
			// Event time
			cardEventTimeValue = '';
			if ( post.meta.event_start_time ) {
				cardEventTimeValue += post.meta.event_start_time;
			}
			if ( post.meta.event_start_time && post.meta.event_end_time ) {
				cardEventTimeValue += ' - ';
			}
			if ( post.meta.event_end_time ) {
				cardEventTimeValue += post.meta.event_end_time;
			}
			cardEventTime = document.createElement( 'span' );
			jQuery(cardEventTime)
				.addClass( 'time' )
				.html( cardEventTimeValue );
		}

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
		if ( post.meta.listImg ) {
			jQuery(cardContainer).append( cardImage );
		}
		jQuery(cardContainer).append( cardTitle );
		if ( post.meta.event_date ) {
			jQuery(cardContainer).append( cardEventContainer );
			jQuery(cardEventContainer).append( cardEventDate );
			jQuery(cardEventContainer).append( cardEventTime );
		}
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
	 * Hide "Show more" button
	 */
	hideMore : function() {
		jQuery("#mitlibnews-another").remove();
	},

	/**
	 * Get Container
	 */
	getContainer : function() {
		return document.getElementById('mitlibnews-container');
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
	 * Set Page
	 */
	setPage : function(value) {
		this.page = value;
	},

	/**
	 * Set Post Content
	 */
	setPostcontent : function() {
		// The default value is 'all'.
		this.postcontent = 'all';
		// If everything is not set, just use the default.
		if ( !this.container || !this.container.dataset || !this.container.dataset.postcontent ) {
			return true;
		}
		// If we're still here, use the real value.
		this.postcontent = this.container.dataset.postcontent;
		return true;
	}
};
