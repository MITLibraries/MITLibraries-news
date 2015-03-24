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
    /*
        Template Name: Additional Posts Events
    */
    $offset = htmlspecialchars(trim($_GET['offset']));
    if ($offset == '') {
        $offset = 11;
    }
	
	 $limit = htmlspecialchars(trim($_GET['limit']));
    
	if ($limit == '') {
        $limit = 18;
    }	
?>
<?php
$date = DateTime::createFromFormat('Ymd', get_field('event_date'));
$args = array(
	
	
	'post_type'              => 'post',
	'posts_per_page'         =>	$limit,
	'offset'                 => 21,
	'ignore_sticky_posts'    => true,
	'meta_key'       => 'is_event',
	'meta_query'             => array(
	
		array(
			'meta_key'       => 'is_event',
			'meta_value'     => '1',
			'compare'        => '='
),

		array(
		 'meta_key'  =>'event_date',
		 'orderby'   =>'meta_value_num date',
	     'order'     => 'DESC',
),
		
		
	),
);

 $the_query = new WP_Query($args); 
?>
<?php
//removes button start
$ajaxLength = $the_query->post_count;
?>
<?php if ($ajaxLength < $limit){ ?>
<script>
$("#another").hide();
</script>
<?php } 
//removes button end ?>



      <?php if( $the_query->have_posts() ):  ?>
      
      
      <?php 
	  $o = -1;	
	  while ( $the_query->have_posts() )   : $the_query->the_post(); 
	   $o++;
	  ?>
    
      <div class="<?php if ($o % 3 == 0){ echo "third "; } ?>  col-xs-12  col-xs-B-6 col-sm-4 col-md-4 eventsPage no-padding-left-mobile">
      <div class="flex-item blueTop eventsBox <?php if (get_field("listImg")) { echo "has-image";} else { echo "no-image"; } ?>" onClick='location.href="<?php if((get_field("external_link") != "") && $post->post_type == 'spotlights'){ the_field("external_link");}else{ echo get_post_permalink();}  ?>"'>
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
		  <div class="event"> </div><?php echo $date->format('F, j Y'); ?>&nbsp;&nbsp; &nbsp; <span class="time">
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
              <?php get_template_part('inc/entry'); ?>
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
          <span class="mitDate">
          <time class="updated"  datetime="<?php echo get_the_date(); ?>">&nbsp;&nbsp;<?php echo get_the_date(); ?></time>
        </span> </div>
        </div>
      </div>
      <?php
	  
	   endwhile; ?>
      <?php endif;  ?>
      <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>