<script>
$j(function() {
  $j("img.img-responsive").lazyload({ 
    effect : "fadeIn", 
    effectspeed: 450 ,
	failure_limit: 999999
  }); 
});	

</script>

<?php
$date = DateTime::createFromFormat('Ymd', get_field('event_date'));

?>
<?php
    /*
        Template Name: Additional Posts
    */
    $offset = htmlspecialchars(trim($_GET['offset']));
    if ($offset == '') {
        $offset = 9;
    }
	
	 $limit = htmlspecialchars(trim($_GET['limit']));
    if ($limit == '') {
        $limit = 9;
    }
	
	
	$args = array(
	'posts_per_page'      => $limit,
	'post_type' => array('Spotlights','bibliotech', 'post'),
	'offset'  			  => 9,
	'post__not_in'            => get_option( 'sticky_posts' ),
	'ignore_sticky_posts' => 1,
	'orderby'   	=> 'date',
	'order'     	=> 'DESC',
	'suppress_filters' => false

);

$the_query = new WP_Query($args); 


?>
<?php
//removes button start
$ajaxLength = $the_query->post_count;
?>
<?php if ($ajaxLength < $limit){ ?>
<script>
$j("#another").hide();
</script>
<?php } 
//removes button end ?>



<?php if( $the_query->have_posts() ):  ?>


<?php 
$o = -1;	

while ( $the_query->have_posts() ) : $the_query->the_post(); 
 $o++;
?>


 <div id="theBox" class="<?php if ($o % 3 == 0){ echo "third "; } ?> col-xs-12  col-xs-B-6 col-sm-4 col-md-4 no-padding-left-mobile">
      <div class="flex-item blueTop  eventsBox <?php if (get_field("listImg")) { echo "has-image";} else { echo "no-image"; } ?>" onClick='location.href="<?php if((get_field("external_link") != "") && $post->post_type == 'spotlights'){ the_field("external_link");}else{ echo get_post_permalink();}  ?>"'> 
        <?php get_template_part('inc/spotlights'); ?>
       
        <?php
		if (get_field("listImg") != "" ) { ?>
        <img data-original="<?php the_field("listImg") ?>" width="100%" height="111" class="img-responsive"  alt="<?php the_title(); ?>"/>
        <?php } ?>
        
        
        <h2 class="entry-title title-post  <?php if($post->post_type == 'spotlights'){ echo "spotlights"; } ?>">
          <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
        </h2>
        
        
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
	   
	   
	   
	   </div>
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
    </div>
    <!--close div that opens in bilbio if statement-->
    <?php } ?>
    

<?php

 endwhile; 

else : ?>

<script>
alert("NONE");
	$j(".moreBtn").html("no more posts to load");
	
	
</script>
<?php	
endif;
?>

<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
