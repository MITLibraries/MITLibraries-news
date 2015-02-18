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
<div>
  <div class="container">
    


<?php 
// WP_Query arguments
$args = array (
	'tag_name'               => 'oldevents',
	'posts_per_page'         => '9',
	'ignore_sticky_posts'    => true,
);

// The Query
$the_query = new WP_Query( $args );


?>

<?php echo $GLOBALS['wp_query']->request; ?>



    <pre>
<?php //print_r($the_query); ?>
</pre>
    <div class="row">
      <?php if( $the_query->have_posts() ):  ?>
      <?php while ( $the_query->have_posts() ) : $the_query->the_post();  ?>
      <div class="col-xs-12  col-xs-B-6 col-sm-4 col-md-4 eventsPage">
        <div itemscope itemtype="http://data-vocabulary.org/Event" class="flex-item blueTop eventsBox <?php if (get_field("listImg")) { echo "has-image";} else { echo "no-image"; } ?>" onClick='location.href="<?php if((get_field("external_link") != "") && $post->post_type == 'spotlights'){ the_field("external_link");}else{ echo get_post_permalink();}  ?>"'>
          <?php
if (get_field("listImg") != "" ) { ?>
          <img data-original="<?php the_field("listImg") ?>" width="100%" height="111"  alt="<?php the_title(); ?>" itemprop="photo" class="img-responsive"  />
          <?php } ?>
          <h2 itemprop="summary" class="entry-title title-post"> <a itemprop="url" href="<?php the_permalink(); ?>">
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
          <div class="event"><?php echo $date->format('F, j Y'); ?>&nbsp;&nbsp; &nbsp; <span class="time">
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
          <?php {  ?>
          <?php } ?>
          <div class="category-post"> <span  itemprop="eventType">
            <?php 
				$category = get_the_category();     
				$rCat = count($category);
				$r = rand(0, $rCat -1);
				echo '<a title="'.$category[$r]->cat_name.'"  title="'.$category[$r]->cat_name.'" href="'.get_category_link($category[$r]->term_id ).'">'.$category[$r]->cat_name.'</a>';
            ?>
            </span> </div>
        </div>
      </div>
      <?php endwhile; ?>
      <?php endif; ?>
      <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
    </div>
    </main>
    <!-- #main --> 
    
  </div>
  <!-- #primary --> 
</div>
<!--close container-->
<div class="container">
  <div id="postContainer" class="row" style="display:none">... loading ...</div>
  <div class="moreBtn">
    <button id="another">Show more</button>
  </div>
</div>
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
<?php 
	get_footer();
?>
