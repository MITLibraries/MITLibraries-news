<?php
/*
Template Name:Events 
*/

$pageRoot = getRoot($post);
$section = get_post($pageRoot);
$isRoot = $section->ID == $post->ID;
get_header(); ?>
<?php get_template_part('inc/sub-header'); ?>

<div class="news-site">

  <div class="container">
 <?php
$events = array (

	'posts_per_page'         => '9',
	'post__not_in' => get_option('sticky_posts'),
	'meta_query'             => array(
		array(
			'key'       => 'is_event',
			'value'     =>'1',
			'orderby'    => 'meta_value_num',
			'order'      => 'DESC',
			
		),
	),
);

// The Query
$the_query = new WP_Query($events);
?>
    <?php //echo $GLOBALS['wp_query']->request; ?>

    <div class="row">
      <?php if( $the_query->have_posts() ):  ?>
      <?php 
	  $i = -1;	
	  while ( $the_query->have_posts() ) : $the_query->the_post();  
	  $i++; 
	  ?>
      <div class="<?php if ($i % 3 == 0){ echo "third "; } ?> col-xs-12  col-xs-B-6 col-sm-4 col-md-4 eventsPage no-padding-left-mobile">
        <div itemscope itemtype="http://data-vocabulary.org/Event" class="flex-item blueTop eventsBox <?php if (get_field("listImg")) { echo "has-image";} else { echo "no-image"; } ?>" onClick='location.href="<?php if((get_field("external_link") != "") && $post->post_type == 'spotlights'){ the_field("external_link");}else{ echo get_post_permalink();}  ?>"'>
          <?php
if (get_field("listImg") != "" ) { ?>
          <img data-original="<?php the_field("listImg") ?>" width="100%" height="111"  alt="<?php the_title(); ?>" itemprop="photo" class="img-responsive"  />
          <?php } ?>
          <h2 itemprop="summary" class="entry-title title-post">
           <a itemprop="url" href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
            </a> </h2>
          <!--/EVENT  DATE-->
          <?php            
$date = get_field('event_date');
// $date = 19881123 (23/11/1988)

// extract Y,M,D
$y = substr($date, 0, 4);
$m = substr($date, 4, 2);
$d = substr($date, 6, 2);

// create UNIX
$time = strtotime("{$d}-{$m}-{$y}");
// format date (23/11/1988)



?>
          <?php if(get_field('event_date')){  ?>
          <time itemprop="startDate" datetime="<?php	echo date('d/m/Y', $time);  ?>">
            <?php  	$date = DateTime::createFromFormat('Ymd', get_field('event_date'));?>
          </time>
              
          <div class="events">
		  <div class="event"> </div><?php echo $date->format('F j, Y'); ?>&nbsp;&nbsp; &nbsp; <span class="time">
            <?php if( get_field('event_start_time') ){  ?>
            <?php	echo the_field('event_start_time');  ?>
            <?php  } ?>
            <?php if(( get_field('event_start_time') ) && ( get_field('event_end_time') )){
				  				 echo '-';
					} ?>
            <?php if( get_field('event_end_time') ){  ?>
            <?php		echo the_field('event_end_time');  ?>
            <?php		}  ?>
            </span> </div>
          <?php 	}	?>
          <!--EVENT -->
          
          <div itemprop="description" class="excerpt-post">
             <?php get_template_part('inc/entry'); ?>
          </div>
          
          <!--final **** else-->
          <?php {  ?>
          <?php } ?>
          <div class="category-post"> <span  itemprop="eventType">
            <?php 
				$category = get_the_category();     
				$rCat = count($category);
				$r = rand(0, $rCat -1);
				echo '<a title="'.$category[$r]->cat_name.'"  title="'.$category[$r]->cat_name.'" href="'.get_category_link($category[$r]->term_id ).'">'.$category[$r]->cat_name.'</a>';
            ?>
           
           
           <span class="mitDate">
          <time class="updated"  datetime="<?php echo get_the_date(); ?>">&nbsp;&nbsp;<?php echo get_the_date(); ?></time>
          </span> 
            </div>
        </div>
      </div>
      <?php endwhile; ?>
      <?php endif; ?>
      <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
    </div>
   
    
  </div>
  <!-- #primary --> 
</div>
<!--close container-->
 <?php get_template_part('inc/more-posts'); ?>
 
 
 
 
<script>
var $j = jQuery.noConflict(); 
$j(function(){
    var offset = 11;
	var limit = 9;
    //$j("#postContainer").load("/news/add-posts-events/");
    $j("#another").click(function(){
		limit = limit+9;
        offset = offset+11;
        $j("#postContainer")
            //.slideUp()
					
            .load("/news/add-posts-events/?offset=1&limit="+limit, function() {
			 //.load("/news/test/?offset="+offset, function() {
			   $j(this).slideDown();
			   //$j("#another").remove();
			    //$j(".moreBtn").html(' No More Posts') // if there are none left 
			   $j('.moreBtn').length;
					   
			   
			
    	});
        return false;
    });


   

});
</script>
<div class="container">
<?php 
	get_footer();
?>
