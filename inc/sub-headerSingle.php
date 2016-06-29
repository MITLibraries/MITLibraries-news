<?php
/**
* Template part for displaying subheaderSingle on single-posts.
*
* @package WordPress
* @subpackage MITLibraries-news
* @since v1.3.0
*/
?>

<div class="newsSubHeader clearfix">
	<div class="innerPadding clearfix">
		<div class="title-page no-padding-left col-xs-12  col-sm-4 col-md-5 col-lg-5">
	
			<?php if( is_single($post)) { ?>
	    		<h2 class="name-site"><a href="/news/">News &amp; events</a></h2>
			<?php }else{ ?>
	    
		    <h1 class="name-site"><a href="/news/">News &amp; events</a>
				<?php 
			if(is_category()) {
				printf('<span>'. ': ' . single_cat_title( '', false ) . '</span>' ); 
				}  
				?>        
		    </h1>
	
			<?php } ?>
    
		</div><!--.title-page-->   
		
		<div class="socialNav singleSocialNav hidden-xs not_on_phone socialNav col-xs-12 col-sm-8 col-md-7  col-lg-7 clearfix ">

		<?php get_template_part('inc/social'); ?>

		</div><!--.socialNav-->

		<hr class="news hidden-xs col-sm-12 col-md-12 col-lg-12 clearfix">

	</div><!--.innerpadding-->

</div><!--.newsSubHeader-->
</div>

<div class="clearfix newsBackGround">

