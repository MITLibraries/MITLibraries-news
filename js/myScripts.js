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
	var APloader = window.mitlibnews.loader;
	// TODO: is initialization necessary?
	APloader.initialize();
	// TODO: add parameters for what type of load, and offset/posts_per_page
	APloader.loadPosts();

})(jQuery);






  
  


	

  
  
  
  

	


