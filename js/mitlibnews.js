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

	// Rebuilt loader
	var foo = new Loader();

})(jQuery);
