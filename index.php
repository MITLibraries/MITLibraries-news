<?php  
$pageRoot = getRoot($post);$section = get_post($pageRoot);$isRoot = $section->ID == $post->ID; get_header(); get_template_part('inc/sub-header');
$sticky = get_option( 'sticky_posts' );
$args = array(
	'posts_per_page'      => 1,
	'post__in'            => $sticky,
	'ignore_sticky_posts' => 1,
	'orderby'   	=> 'menu_order',
	'order'     	=> 'DESC',
	'suppress_filters' => false
);
$query2 = new WP_Query( $args );
if( $query2->have_posts() ):  
while ( $query2->have_posts() ) : $query2->the_post(); 
if ( isset($sticky[0]) ) { ?>
<div class="container">
<div class="row">
<!-- ////////////////////////ONLY VISIBLE ON MOBILE\\\\\\\\\\\\\\\\\\\\ -->
<div  class="visible-xs visible-sm hidden-md hidden-lg no-padding-left-mobile no-padding-left-tablet col-xs-B-6 col-sm-4 col-md-4 col-lg-4">
<div class="flex-item blueTop eventsBox <?php if (get_field("listImg")) { echo "has-image";} else { echo "no-image"; } ?>" onClick='location.href="<?php if((get_field("external_link") != "") && $post->post_type == 'spotlights'){ the_field("external_link");}else{ echo get_post_permalink();}  ?>"'>
 <?php get_template_part('inc/spotlights'); ?>
       
        <?php
		if (get_field("listImg") != "" ) { ?>
        <img data-original="<?php the_field("listImg") ?>" width="100%" height="111" class="img-responsive"  alt="<?php the_title();?>"/>
        <?php } ?>
     	
        
         <?php if($post->post_type == 'spotlights'){ ?>
			 <h2 class="entry-title title-post spotlights">
          <a href="<?php the_field("external_link"); ?>"><?php the_title();?></a>
        </h2> 
		<?php }else{ ?>
        <h2 class="entry-title title-post">
          <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
        </h2>
        <?php 	} ?>
    	
        <?php get_template_part('inc/events'); ?>
        <?php get_template_part('inc/entry'); ?>

 
        <div class="category-post <?php  if(get_post_type( get_the_ID() ) == 'bibliotech'){ echo "Bibliotech";} ?>">
<?php 
  if(get_post_type( get_the_ID() ) == 'bibliotech'){
	   echo "<div class='bilbioImg'>
	   <img src='wp-content/themes/mit-libraries-news/images/bilbioTechIcon.png' alt='bilbiotech icon' width='30' height='32' /></div>";
	   echo "<div class='biblioPadding'>&nbsp;<a href='/news/bibliotech/' title='Bibliotech'>Bibliotech</a></div>";
	 	  }else{
				$category = get_the_category();     
				$rCat = count($category);
				$r = rand(0, $rCat -1);
				echo '<a title="'.$category[$r]->cat_name.'"  title="'.$category[$r]->cat_name.'" href="'.get_category_link($category[$r]->term_id ).'">'.$category[$r]->cat_name.'</a>';
	  } ?>
          <span class="mitDate">
          <time class="updated"  datetime="<?php echo get_the_date(); ?>">&nbsp;&nbsp;<?php echo get_the_date(); ?></time>
          </span> </div>
      </div>
</div>
<!-- ////////////////////////END END ONLY VISIBLE ON MOBILE\\\\\\\\\\\\\\\\\\\\ -->


 <div class="sticky  hidden-xs hidden-sm col-md-12 clearfix">
    <div class="no-padding-left-mobile sticky col-xs-3 col-xs-B-6 col-sm-8 col-lg-8 col-md-8" onClick='location.href="<?php echo get_post_permalink(); ?>"' style="padding-right:0px;" > <img src="<?php the_field("featuredListImg"); ?>" class="img-responsive" width="679" height="260" alt="<?php the_title();?>" /> </div>
    <div class=" hidden-xs bgWhite col-xs-12 col-xs-B-6 col-sm-4 col-md-4 col-lg-4" onClick='location.href="<?php if((get_field("external_link") != "") && $post->post_type == 'spotlights'){ the_field("external_link");}else{ echo get_post_permalink();}  ?>"'>
      <?php if($post->post_type == 'spotlights'){ ?>
			 <h2 class="entry-title title-post spotlights">
          <a href="<?php the_field("external_link"); ?>"><?php the_title();?></a>
        </h2> 
		<?php }else{ ?>
        <h2 class="entry-title title-post">
          <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
        </h2>
        <?php 	} ?>
     
     
     
      <?php get_template_part('inc/events'); ?>
     
     
      <div class="excerpt-post">
        <p>
          <?php if (excerpt()) {
   				 echo excerpt(20);
					} elseif (content()){
     				  echo content(20);
					}
			?>
        </p>
      </div>
      <div class="category-post">
        <?php 
$category = get_the_category(); 
if($category[0]){
echo '<a title="'.$category[0]->cat_name.'" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
}
?>
        <span class="mitDate">&nbsp;&nbsp;<?php echo get_the_date(); ?></span> 
        <!--echo all the cat --> 
      </div>
    </div>
</div><!--closes the entire first sitcky container--> 
 <?php wp_reset_postdata(); ?>
  <?php wp_reset_query(); ?>
  <?php  } ?>
  <?php endwhile; ?>
  <?php endif; ?> 
 <div class="news-site container">
  <div class="row">
 
 
  <?php

$args = array(
	'posts_per_page'      => 9,
	'post_type' => array('spotlights','bibliotech', 'post'),
	'post__not_in'            => get_option( 'sticky_posts' ),
	'ignore_sticky_posts' => 1,
	'orderby'   	=> 'post_date',
	'order'     	=> 'DESC',
	'suppress_filters' => false
	
);
$the_query = new WP_Query( $args );	




?>
   <?php if( $the_query->have_posts() ):  
   
   $theLength = $count_posts->publish;
   ?>
    
	
	<?php   	
	$i = -1;		
	while ( $the_query->have_posts() ) : $the_query->the_post();  
	$i++; 
	
     ?>
    
    <div id="theBox" class="<?php if ($i % 3 == 0){ echo "third "; } ?>no-padding-left-mobile col-xs-12 col-xs-B-6 col-sm-4 col-md-4 col-lg-4">
      <div class="flex-item blueTop  eventsBox <?php if (get_field("listImg")) { echo "has-image";} else { echo "no-image"; } ?>" onClick='location.href="<?php if((get_field("external_link") != "") && $post->post_type == 'spotlights'){ the_field("external_link");}else{ echo get_post_permalink();}  ?>"'>
          
		  
		  <?php get_template_part('inc/spotlights'); ?>
       
        <?php
		if (get_field("listImg") != "" ) { ?>
        <img data-original="<?php the_field("listImg") ?>" width="100%" height="111" class="img-responsive"  alt="<?php the_title();?>"/>
        <?php } ?>
         
       <?php if($post->post_type == 'spotlights'){ ?>
			 <h2 class="entry-title title-post spotlights">
          <a href="<?php the_field("external_link"); ?>"><?php the_title();?></a>
        </h2> 
		<?php }else{ ?>
        <h2 class="entry-title title-post">
          <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
        </h2>
        <?php 	} ?>
        
    	 <?php get_template_part('inc/events'); ?>
        
        <?php get_template_part('inc/entry'); ?>

        <!--final **** else-->
        <?php {  ?>
        <!--EVENT -->
        <?php } ?>
        <div class="category-post <?php  if(get_post_type( get_the_ID() ) == 'bibliotech'){ echo "Bibliotech";} ?>">
<?php 
  if(get_post_type( get_the_ID() ) == 'bibliotech'){
	   echo "<div class='bilbioImg bilbioTechIcon'>
	   </div>";
	   echo "<div class='biblioPadding'>&nbsp;<a href='/news/bibliotech/' title='Bibliotech'>Bibliotech</a>"; ?>
	   
	    <span class="mitDate">
          <time class="updated"  datetime="<?php echo get_the_date(); ?>">&nbsp;&nbsp;<?php echo get_the_date(); ?></time>
          </span> </div> 
	   
	   
	<?php 	  }else{
				$category = get_the_category();     
				$rCat = count($category);
				$r = rand(0, $rCat -1);
				echo '<a title="'.$category[$r]->cat_name.'"  title="'.$category[$r]->cat_name.'" href="'.get_category_link($category[$r]->term_id ).'">'.$category[$r]->cat_name.'</a>'; ?>
	 
          <span class="mitDate">
          <time class="updated"  datetime="<?php echo get_the_date(); ?>">&nbsp;&nbsp;<?php echo get_the_date(); ?></time>
          </span> </div> 
            
        <?php  } ?>
        
       </div><!--last-->
    </div>
    <?php  if(get_post_type( get_the_ID() ) == 'bibliotech'){ ?>
    </div><!--this div closes the open div in biblio padding-->
    <?php } ?>
      <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
    <?php endwhile; ?>
    <?php endif; ?>
  
  </div>
  <!--closes ROW-->
  </div>

<?php  if($i > 6){ 
 get_template_part('inc/more-posts'); 
 } ?>


  
  </div>
  

<script>
$(document).ready(function() {


    var offset = 9;
	var limit = 9;
    $("#postContainer").load("/news/test/");
    $("#another").click(function(){
		limit = limit+9;
        offset = offset+9;
        $("#postContainer")
            //.slideUp()
            .load("/news/test/?offset="+offset+"&limit="+limit, function() {
			 //.load("/news/test/?offset="+offset, function() {
			   $(this).slideDown();
			 	
			   
    	});
            
        return false;
    });

});



</script>
<div class="container">
<?php 
	get_footer();
?>