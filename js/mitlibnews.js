var window, jQuery, APloader, Loader;

(function($) {

	//lazy loading
	$("img.img-responsive").lazyload({
		effect : "fadeIn",
		effectspeed: 450 ,
		failure_limit: 999999
	});

	//category force selection of all news
	$('input:checkbox[id=in-category-43]').attr('checked',true);



	// Additional Posts loader
	APloader = window.mitlibnews.loader;
	// TODO: is initialization necessary?
	APloader.initialize();
	// TODO: add parameters for what type of load, and offset/posts_per_page
	APloader.loadPosts(9);

	$("#mitlibnews-another").click(function() {
		// TODO: read data attribute in 'show more' markup that determines what type of 'more' to show
		APloader.loadPosts(9);
	});

	// Rebuilt loader
	var foo = new Loader();

})(jQuery);
