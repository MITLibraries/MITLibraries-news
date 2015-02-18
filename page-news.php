<?php
/*
Template Name:News
*/


$pageRoot = getRoot($post);
$section = get_post($pageRoot);
$isRoot = $section->ID == $post->ID;
get_header(); ?>
<?php get_template_part('inc/sub-header'); ?>

<div class="wrap-page">

<div id="primary" class="content-area">
  <main id="main" class="content-main" role="main">
   <?php
	
$sticky = get_option( 'sticky_posts' );
// args
$args = array(
'post_type'  				=> 'post',
'post__not_in' => array($sticky),
	'posts_per_page'        => '9',
	'ignore_sticky_posts'   => true,
	'order'                 => 'DESC',
	'orderby'               => 'date',
			'meta_query'             => array(
					array(
						'key'       => 'is_event',
						'value'     => '1',
						'compare'   => '!=',
						'type'      => 'NUMERIC',
					),
				),
	
	);



// get results
$the_query = new WP_Query( $args );	
	
	
	
	
?>


    <div class="news-site container">
  <section class="bgGrey">

    <div>
      
      <?php //print_r($the_query); 
 
  flush_rewrite_rules();
  ?>
  <div class="row">
      <?php if( $the_query->have_posts() ):  ?>
      <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
   <div class="col-xs-12  col-xs-B-6 col-sm-4 col-md-4">
      <div class="flex-item blueTop eventsBox <?php if(has_post_thumbnail()){ echo "has-image"; }elseif (get_field("listImg")) { echo "has-image";} else { echo "no-image"; } ?>" onClick='location.href="<?php if((get_field("external_link") != "") && $post->post_type == 'spotlights'){ the_field("external_link");}else{ echo get_post_permalink();}  ?>"'>
   <?php if($post->post_type == 'spotlights'){ ?>
        <div class="featuredCol">Featured collection</div>
        <?php } ?>
        <?php if($post->post_type == 'spotlights'){ ?>
        <div class="featuredColImg"> <img src="/wp-content/themes/mit-libraries-news/images/info.png" alt="featured" /> </div>
        <?php } ?>
        <?php if (get_field('mark_as_new') === true): ?>
        <div class="newIcon"></div>
        <?php endif; ?>
        <?php
if (get_field("listImg") != "" ) { ?>
        <img data-original="<?php the_field("listImg") ?>" class="img-responsive" width="100%" height="111"  alt="<?php the_title(); ?>"/>
         <h2 class="title-post">
          <?php the_title();  ?>
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
          <p>
            <?php if (excerpt()) {
   				 echo excerpt(15);
					} elseif (content()){
     				  echo content(15);
					}
			?>
          </p>
        </div>
        
        
        
        
        <?php } elseif ( has_post_thumbnail() ) { 
$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
$thumb_url = $thumb_url_array[0];?>
        <img src="<?php echo $thumb_url; ?>" width="100%" height="200" />
         <h2 class="title-post">
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
          <p>
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
        <h2 class="title-postnoImg">
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
          <p>
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
				$category = get_the_category();     if($category[0]){
				echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
				}
            ?>
          <span class="mitDate">&nbsp;&nbsp;<?php echo get_the_date(); ?></span> </div>
      </div>
     </div> 
      <?php endwhile; ?>
      <?php endif; ?>
      <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
    </div>
    </div><!--closes ROW-->
  </section>
</div>
<div class="container">
<div id="postContainer" class="row" style="display:none">... loading ...</div>

<div class="moreBtn">
  <button id="another">Show more</button>
</div>
</div>

<script>
var $j = jQuery.noConflict(); 
$j(function(){
    var offset = 10;
	var limit = 0;
    $j("#postContainer").load("/news/more-news-stories/");
    $j("#another").click(function(){
		limit = limit+9;
        offset = offset+10;
        $j("#postContainer")
            //.slideUp()
            .load("/news/more-news-stories/?offset="+offset+"&limit="+limit, function() {
			 //.load("/news/test/?offset="+offset, function() {
			   $j(this).slideDown();
			   //$j("#another").remove();
			   
    	});
            
        return false;
    });

});
</script>
<?php 
	get_footer();
?>
