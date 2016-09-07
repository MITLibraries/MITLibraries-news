/*!
   --------------------------------
   Scroll Posts
   --------------------------------
*/

var $j = jQuery.noConflict(); 

$j(function(){

    var offset = 10;

    $j("#postContainer").load("/news/test/?offset="+offset);
    $j("#another").click(function(){

        offset = offset+10;

        $j("#postContainer")
            .slideUp()
            .load("/news/test/?offset="+offset, function() {
               $j("#mitContainer").css("display", "none");
          $j(this).slideDown();
        $j( "#postContainer" ).scrollTop( 300 );
            });

        return false;
    });

});
