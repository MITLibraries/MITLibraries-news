<?php
    /*
        Template Name: Additional Posts Bibliotech
    */
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
	 
	
    $offset = htmlspecialchars(trim($_GET['offset']));
    if ($offset == '') {
        $offset = 10;
    }
	
	 $limit = htmlspecialchars(trim($_GET['limit']));
    if ($limit == '') {
        $limit = 9;
    }
    
    
	
	$args = array(
	 	'post_type' => array('bibliotech' ),
	 	'post__not_in' => array( 'sticky_posts'),
	 	'ignore_sticky_posts' => 1,
		'offset'    => 10,
		'posts_per_page'  => $limit,
		'orderby'   	=> 'date',
		'order'     	=> 'DESC',
		'suppress_filters' => false
				
		
);			
 $the_query = new WP_Query($args); 	


?>
  <div class="row">
<?php if( $the_query->have_posts() ):  ?>

<?php 
$i = -1;		
while ( $the_query->have_posts() ) : $the_query->the_post(); 
$i++; 
?>


  <div class="<?php if ($i % 3 == 0){ echo "third "; } ?> col-xs-12  col-xs-B-6 col-sm-4 col-md-4 no-padding-left-mobile">
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
	
				echo '<a title="'.$category[$r]->cat_name.'"  title="'.$category[$r]->cat_name.'" href="'.get_category_link($category[$r]->term_id ).'">'.$category[$r]->cat_name.'</a>';
		 ?>
          <span class="mitDate">
          <time class="updated"  datetime="<?php echo get_the_date(); ?>">&nbsp;&nbsp;<?php echo get_the_date(); ?></time>
          </span> </div>
      </div>
    </div>
<?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
</div>