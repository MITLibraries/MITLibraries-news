<?php
/*
Template Name:Bibliotech 
*/
$pageRoot = getRoot($post);
$section = get_post($pageRoot);
$isRoot = $section->ID == $post->ID;
get_header(); ?>
<?php get_template_part('inc/sub-header'); ?>
<?php get_template_part('inc/bib-header'); ?>
<?php 
$sticky = get_option( 'sticky_posts' );
$args = array(
	'posts_per_page'      => 1,
	'post__in'            => $sticky,
	'ignore_sticky_posts' => 1,
	'post_type' => 'bibliotech',
	'orderby'   	=> 'menu_order',
	'order'     	=> 'ASC',
	'suppress_filters' => false
);
$query2 = new WP_Query( $args );
if( $query2->have_posts() ):  
while ( $query2->have_posts() ) : $query2->the_post(); ?>
<?php if ( isset($sticky[0]) ) { ?>

<div class="container">
<div class="row">
<!-- ////////////////////////ONLY VISIBLE ON MOBILE\\\\\\\\\\\\\\\\\\\\ -->
<div class="visible-xs visible-sm hidden-md hidden-lg col-xs-B-6 col-sm-4 col-md-4 col-lg-4">
  <div class="flex-item blueTop eventsBox <?php if (get_field("listImg")) { echo "has-image";} else { echo "no-image"; } ?>" onClick='location.href="<?php if((get_field("external_link") != "") && $post->post_type == 'spotlights'){ the_field("external_link");}else{ echo get_post_permalink();}  ?>"'>
    
    <?php
if (get_field("listImg") != "" ) { ?>
    <img data-original="<?php the_field("listImg") ?>" width="100%" height="111"  alt="<?php the_title(); ?>" class="img-responsive"  />
    <h2 class="entry-title title-post">
      <?php the_title(); ?>
    </h2>
    <!--/EVENT  DATE-->
    <?php if(get_field('event_date')){ 
				$date = DateTime::createFromFormat('Ymd', get_field('event_date'));
				
			?>
    <div class="event"><?php echo $date->format('F, j Y'); ?>&nbsp;&nbsp; &nbsp; <span class="time">
      <?php if( get_field('event_start_time') ){ 
			  		echo the_field('event_start_time'); 
					} ?>
      <?php if(( get_field('event_start_time') ) && ( get_field('event_end_time') )){
				  				 echo '-';
					} ?>
      <?php if( get_field('event_end_time') ){ 
			  		echo the_field('event_end_time'); 
			}  ?>
      </span> </div>
    <?php 	}	?>
     <div class="excerpt-post">
      <p class="entry-summary">
    <?php if(get_field("subtitle")){ ?>
   
      <?php  the_field("subtitle"); ?>
    
    <?php  }else{ ?>
  
        <?php if (excerpt()) {
   				 echo excerpt(15);
					} elseif (content()){
     				  echo content(15);
					}
			?>
     
    <?php }  ?>
     </p>
    </div>
    <?php } elseif ( has_post_thumbnail() ) { 
$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
$thumb_url = $thumb_url_array[0];?>
    <img src="<?php echo $thumb_url; ?>" width="100%" height="200" class="img-responsive"  />
    <h2 class="entry-title title-post">
      <?php the_title(); ?>
    </h2>
    <!--/EVENT  DATE-->
    <?php if(get_field('event_date')){ 
				$date = DateTime::createFromFormat('Ymd', get_field('event_date'));
				
			?>
    <div class="event"><?php echo $date->format('F, j Y'); ?>&nbsp;&nbsp; &nbsp; <span class="time">
      <?php if( get_field('event_start_time') ){ 
			  		echo the_field('event_start_time'); 
					} ?>
      <?php if(( get_field('event_start_time') ) && ( get_field('event_end_time') )){
				  				 echo '-';
					} ?>
      <?php if( get_field('event_end_time') ){ 
			  		echo the_field('event_end_time'); 
			}  ?>
      </span> </div>
    <?php 	}	?>
    <!--EVENT -->
    
    <div class="excerpt-post">
      <p class="entry-summary">
        <?php if (excerpt()) {
   				 echo excerpt(15);
					} elseif (content()){
     				  echo content(15);
					}
			?>
      </p>
    </div>
    
    <!--final **** else-->
    <?php }else{  ?>
    <h2 class="entry-title title-postnoImg">
      <?php the_title(); ?>
    </h2>
    
    <!--/EVENT  DATE-->
    <?php if(get_field('event_date')){ 
				$date = DateTime::createFromFormat('Ymd', get_field('event_date'));
				
			?>
    <div class="event"> <?php echo $date->format('F, j Y'); ?>&nbsp;&nbsp; &nbsp; <span class="time">
      <?php if( get_field('event_start_time') ){ 
			  		echo the_field('event_start_time'); 
					} ?>
      <?php if(( get_field('event_start_time') ) && ( get_field('event_end_time') )){
				  				 echo '-';
					} ?>
      <?php if( get_field('event_end_time') ){ 
			  		echo the_field('event_end_time'); 
			}  ?>
      </span> </div>
    <?php 	}	?>
    <!--EVENT -->
    
    <div class="excerpt-post">
      <p class="entry-summary">
        <?php if (excerpt()) {
   				 echo excerpt(30);
					} elseif (content()){
     				  echo content(30);
					}
			?>
      </p>
    </div>
    <?php } ?>
    <div class="category-post">
      <?php	
        		$category = get_the_category();     
				$rCat = count($category);
				$r = rand(0, $rCat -1);
				//echo $r;
				//echo "-";
				//echo $rCat; 
                
				//if($category[0]){
					
				echo '<a title="'.$category[$r]->cat_name.'"  title="'.$category[$r]->cat_name.'" href="'.get_category_link($category[$r]->term_id ).'">'.$category[$r]->cat_name.'</a>';
				
				//}
				
	
            ?>
      <span class="mitDate">
      <time class="updated"  datetime="<?php echo get_the_date(); ?>">&nbsp;&nbsp;<?php echo get_the_date(); ?></time>
      </span> </div>
  </div>
</div>
<!-- ////////////////////////ONLY VISIBLE ON MOBILE\\\\\\\\\\\\\\\\\\\\ -->
<?php 
// if FEATURED has a big  IMAGE
if(get_field("featuredListImg")){  ?>
<div class="hidden-xs hidden-sm col-md-12 clearfix">
  <div class="col-xs-7 col-sm-8  col-md-8" onClick='location.href="<?php echo get_post_permalink(); ?>"' style="padding-right:0px;" > <img data-original="<?php the_field("featuredListImg") ?>" class="img-responsive"  width="679" height="256" alt="<?php the_title(); ?>"   /> </div>
  <div class="bgWhite col-xs-5 col-sm-4 col-md-4" onClick='location.href="<?php echo get_post_permalink(); ?>"'>
    <h2>
      <?php the_title();?>
    </h2>
    <?php if(get_field('event_date')){  $mitDate = get_field('event_date'); $mitDate = date("l t Y", strtotime($mitDate)); ?>
    <div class="event"><?php echo $mitDate; ?>&nbsp;&nbsp; &nbsp; <span class="time">
      <?php if( get_field('event_start_time') ){ 
			  			echo the_field('event_start_time'); 
					} ?>
      <?php if(( get_field('event_start_time') ) && ( get_field('event_end_time') )){
				  				 echo '-';
					} ?>
      <?php if( get_field('event_end_time') ){ 
			  				echo the_field('event_end_time'); 
			}  ?>
      </span> </div>
    <?php 	}	?>
    <!--EVENT --> 
    
    <!--/EVENT  DATE-->
    <?php if(get_field("subtitle")){ ?>
    <?php  the_field("subtitle"); ?>
    <?php  }else{ ?>
    <div class="excerpt-post">
      <p>
        <?php if (excerpt()) {
   				 echo excerpt(20);
					} elseif (content()){
     				  echo content(20);
					}
			?>
        <?php } ?>
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
</div>
<?php 
//close the if statement for the big image
} ?> 


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
			'post__not_in'        => get_option( 'sticky_posts' ),
			'ignore_sticky_posts' => 1,
			'post_type'       	  => 'bibliotech',
			'orderby'        	  => 'menu_order',
			'order'          	  => 'ASC',
			'suppress_filters'    => false
			);
$my_query = new WP_Query($args);
while ($my_query->have_posts()){
$my_query->the_post();
?>
    
    <!--//////////// -->
    <div class="col-xs-12  col-xs-B-6 col-sm-4 col-md-4">
      <div class="flex-item blueTop eventsBox <?php if (get_field("listImg")) { echo "has-image";} else { echo "no-image"; } ?>" onClick='location.href="<?php if((get_field("external_link") != "") && $post->post_type == 'spotlights'){ the_field("external_link");}else{ echo get_post_permalink();}  ?>"'>
       
     <?php
		if (get_field("listImg") != "" ) { ?>
        <img data-original="<?php the_field("listImg") ?>" width="100%" height="111" class="img-responsive"  alt="<?php the_title(); ?>"/>
        <?php } ?>
        
        
        <h2 class="entry-title title-post  <?php if($post->post_type == 'spotlights'){ echo "spotlights"; } ?>">
          <?php  the_title(); ?>
        </h2>
        
        
    	 <?php get_template_part('inc/events'); ?>
        
        <?php get_template_part('inc/entry'); ?>

        <!--final **** else-->
        <?php {  ?>
        <!--EVENT -->
        <?php } ?>
        
        
        
        <div class="category-post">
          <?php	
        		$category = get_the_category();     
				$rCat = count($category);
				$r = rand(0, $rCat -1);
				//echo $r;
				//echo "-";
				//echo $rCat; 
                
				//if($category[0]){
					
				echo '<a title="'.$category[$r]->cat_name.'"  title="'.$category[$r]->cat_name.'" href="'.get_category_link($category[$r]->term_id ).'">'.$category[$r]->cat_name.'</a>';
				
				//}
				
	
            ?>
          <span class="mitDate">
          <time class="updated"  datetime="<?php echo get_the_date(); ?>">&nbsp;&nbsp;<?php echo get_the_date(); ?></time>
          </span> </div>
      </div>
    </div>
    
    <!--//////////// -->
    <?php } ?>
  </div>
  <!--closeMITContainer-->
  
  <div id="postContainer" class="" style="display:none">... loading ...</div>
  <div class="moreBtn">
    <button id="another">Show more</button>
  </div>
</div>
<!-- wrap --> 

<script>
var $j = jQuery.noConflict(); 
$j(function(){
    var offset = 11;
	var limit = 9;
    $j("#postContainer").load("/news/add-bibliotech-posts/");
    $j("#another").click(function(){
		limit = limit+9;
        offset = offset+11;
        $j("#postContainer")
            //.slideUp()
            
				
            .load("/news/add-bibliotech-posts/?offset="+offset+"&limit="+limit, function() {
			 //.load("/news/test/?offset="+offset, function() {
			   $j(this).slideDown();
			   //$j("#another").remove();
			   //$j('#another').click(function() {
			  // alert($j(this).load());
       // });
			   
    	});
    	
    
            
        return false;
    });

});




</script>
<?php get_footer(); ?>
