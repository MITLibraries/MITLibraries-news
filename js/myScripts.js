

//lazy loading
var $j = jQuery.noConflict(); 
$j(function() {
  $j("img.img-responsive").lazyload({ 
    effect : "fadeIn", 
    effectspeed: 450 ,
	failure_limit: 999999
  }); 
});	
	
