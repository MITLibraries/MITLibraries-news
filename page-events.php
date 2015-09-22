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

$date = DateTime::createFromFormat('Ymd', get_field('event_date'));

/*
 * The event sort is two-fold:
 * 1) Events today and into the future, sorted closest-first
 * 2) Events yesterday and into the past, sorted closest-first
*/

$future = array(

  'posts_per_page' => -1,
  'ignore_sticky_posts' => true,

  'post_type' => 'post',
  'meta_query' => array(
    array(
      'key' => 'is_event',
      'value' => '1',
      'compare' => '=',
    ),
    array(
      'key' => 'event_date',
      'value' => date("Y-m-d"),
      'compare' => '>=',
      'type' => 'DATE'
    ),
  ),

  'meta_key' => 'event_date',
  'orderby' => array(
    'meta_value_num' => 'ASC',
  ),

);
$the_future = new WP_Query($future);
$future_posts = (array) $the_future->posts;

$past = array(

  'posts_per_page' => 9,
  'ignore_sticky_posts' => true,

  'post_type' => 'post',
  'meta_query' => array(
    array(
      'key' => 'is_event',
      'value' => '1',
      'compare' => '=',
    ),
    array(
      'key' => 'event_date',
      'value' => date("Y-m-d"),
      'compare' => '<',
      'type' => 'DATE'
    ),
  ),

  'meta_key' => 'event_date',
  'orderby' => array(
    'meta_value_num' => 'DESC',
  ),

);

$the_past = new WP_Query($past);
$past_posts = (array) $the_past->posts;

// Archived events tagged by "oldevents"
$archive = array(

  'posts_per_page' => 9,
  'ignore_sticky_posts' => true,

  'post_type' => 'post',
  'tag' => 'oldevents',

  'orderby' => 'post_date',

);
$the_archive = new WP_Query($archive);
$archive_posts = (array) $the_archive->posts;

?>
    <div class="row">
    <h1 class="events-header">Upcoming classes & events</h1>
      <?php
      if( count($future_posts) > 0 ) {
        $i = -1;
        foreach ($future_posts as $post) {
          $i++;
          renderEventCard($i, $post);
        } 
      } else {
        ?>
			<p class="left-padder">There are no upcoming classes or events at this time, but check back often.</p>
        <?php
      }
      ?>
    </div> <!-- close row for upcoming events-->

    <hr class="hidden-xs" />

    <h2 class="padding-header">Past classes & events</h2>
    <div class="row">
      <?php
      if( count($past_posts) > 0 ) {
        $i = -1;
        foreach ($past_posts as $post) {
          $i++;
          renderEventCard($i, $post);
        } 
      }
      ?>
    </div> <!-- close row for past events -->
    <?php if(count($past_posts) > 8){ 
      get_template_part('inc/more-posts'); 
    } ?>

<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
    
  </div>
  <!-- #primary --> 
</div>
<!--close container-->
 
 
 
 
<script type="text/javascript">
$(document).ready(function() {
    var offset = 11;
	var limit = 9;
    //$j("#postContainer").load("/news/add-posts-events/");
    $("#another").click(function(){
		limit = limit+9;
        offset = offset+11;
        $("#postContainer")
            //.slideUp()
					
            .load("/news/add-posts-events/?offset=1&limit="+limit, function() {
			 //.load("/news/test/?offset="+offset, function() {
			   $(this).slideDown();
			   //$j("#another").remove();
			    //$j(".moreBtn").html(' No More Posts') // if there are none left 
			   $('.moreBtn').length;
					   
			   
			
    	});
        return false;
    });


   

});
</script>
<div class="container">
<?php 
	get_footer();









function renderEventPost($i, $post) {
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
        </a> 
      </h2>
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

if(get_field('event_date')){  
?>
      <time itemprop="startDate" datetime="<?php  echo date('d/m/Y', $time);  ?>">
        <?php   $date = DateTime::createFromFormat('Ymd', get_field('event_date'));?>
      </time>
              
      <div class="events">
        <div class="event"> </div>
          <?php echo $date->format('F j, Y'); ?>&nbsp;&nbsp; &nbsp; 
          <span class="time">
            <?php if( get_field('event_start_time') ){  ?>
            <?php echo the_field('event_start_time');  ?>
            <?php  } ?>
            <?php if(( get_field('event_start_time') ) && ( get_field('event_end_time') )){
                   echo '-';
            } ?>
            <?php if( get_field('event_end_time') ){  ?>
            <?php   echo the_field('event_end_time');  ?>
            <?php   }  ?>
          </span> 
      </div>
<?php   } ?>
      <!--EVENT -->
          
      <div itemprop="description" class="excerpt-post">
        <?php get_template_part('inc/entry'); ?>
      </div>
          
      <div class="category-post">
        <span  itemprop="eventType">
<?php 
$category = get_the_category();     
$rCat = count($category);
$r = rand(0, $rCat -1);
echo '<a title="'.$category[$r]->cat_name.'"  title="'.$category[$r]->cat_name.'" href="'.get_category_link($category[$r]->term_id ).'">'.$category[$r]->cat_name.'</a>';
?>
        </span>

        <span class="mitDate">
          <time class="updated"  datetime="<?php echo get_the_date(); ?>">&nbsp;&nbsp;<?php echo get_the_date(); ?></time>
        </span> 
      </div>
    </div> <!-- close itemscope -->
  </div> <!-- close eventsPage -->
<?php
  };
?>
