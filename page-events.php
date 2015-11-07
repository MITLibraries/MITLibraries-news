<?php
/*
Template Name:Events 
*/

$pageRoot = getRoot($post);
$section = get_post($pageRoot);
$isRoot = $section->ID == $post->ID;
get_header(); ?>
<?php get_template_part('inc/sub-header'); ?>


  <div class="container container-fluid">

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
<div class="container container-fluid">
<?php 
	get_footer();

