<?php
    /*
        Template Name: Additional Posts News
    */
    $offset = htmlspecialchars(trim($_GET['offset']));
    if ($offset == '') {
        $offset = 9;
    }
	
	 $limit = htmlspecialchars(trim($_GET['limit']));
    if ($limit == '') {
        $limit = 9;
    }	
?>
<script type="text/javascript">
$(document).ready(function() {
  $("img.img-responsive").lazyload({ 
    effect : "fadeIn", 
    effectspeed: 450 ,
	failure_limit: 999999
  }); 
});	
</script>

<?php

$sticky = get_option( 'sticky_posts' );
// args
$args2 = array(
'post_type'  				=> 'post',
'post__not_in' => array($sticky),
	'posts_per_page'        => $limit,
	'offset'					 =>'10',
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



 $the_query = new WP_Query($args2); 
?>


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
        <img data-original="<?php the_field("listImg") ?>" width="100%" height="111" class="img-responsive"  alt="<?php the_title(); ?>"/>
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
				$category = get_the_category();     
				$rCat = count($category);
				$r = rand(0, $rCat -1);
				echo '<a title="'.$category[$r]->cat_name.'"  title="'.$category[$r]->cat_name.'" href="'.get_category_link($category[$r]->term_id ).'">'.$category[$r]->cat_name.'</a>';
            ?>
          <span class="mitDate">&nbsp;&nbsp;<?php echo get_the_date(); ?></span> </div>
      </div>
  </div>
      <?php endwhile; ?>
      <?php endif;  ?>
      <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>