<?php
/**
 * The template for displaying all single posts.
 *
 * @package MIT Libraries News
 */
get_header(); 
$category = get_the_category();
	$type_post = get_post_type();
	$subtitle;
	$type;
?>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=mitlib" async="async"></script>
<?php get_template_part('inc/sub-headerSingle'); ?>
<?php
if((get_post_type( get_the_ID() ) == 'bibliotech') || (cat_is_ancestor_of(73, $cat) or is_category(73))){  ?>
<?php get_template_part('inc/bib-header'); ?>
<?php  } ?>
<div class="container">
<div id="primary" class="content-area">
<main id="main" class="content-main" role="main">
<div class="row">
<?php while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-category="<?php echo $category[0]->slug; ?>">
  <div class="title-page  mySingle">     
      <?php the_title( '<h1 class="entry-title single">', '</h1>' ); ?>
      <?php if (get_field("subtitle")){ ?>
      <h2 class="subtitle"><?php the_field("subtitle"); ?></h2>
      <?php } ?>
      <div class="entry-meta"> <span class="author"> By
        <?php 
		if (get_field("bauthor")){
			the_field("bauthor");
		}else{
			the_author_posts_link();
			}
		 ?>
        </span> <span class="date-post"> <?php echo ' on '; the_date(); ?> </span>
        
        <?php if(has_category()): ?>
        <span class="category-post-single"> in
        <?php 
				$category = get_the_category();  
				?>
               
                 <?php   
				$rCat = count($category);
				
				$r = rand(0, $rCat -1);
			
				echo '<a title="'.$category[$r]->cat_name.'"  title="'.$category[$r]->cat_name.'" href="'.get_category_link($category[$r]->term_id ).'">'.$category[$r]->cat_name.'</a>';
            ?>
        <?php //echo ' in ' . array_slice($category, 0, 2); ?>
        </span>
        <?php endif; ?>
      </div> 
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<div class="addthis_sharing_toolbox"></div>
    <div class="clearfix"></div>
    <!-- .entry-meta --> 
  </div>
  <!-- .title-page -->  
  <div class="entry-content inlineHeader mitContent clearfix">
	
	
	
<?php 
		$date = DateTime::createFromFormat('Ymd', get_field('event_date'));
   if (($type_post == 'post') && get_field('is_event') == 1) { ?>
    <div class="events">
    <?php if(get_field("event_date")){ ?>
		  <div class="event"> </div>
      <?php }  ?>
     <?php if(get_field("event_date")){ ?>
    	<span class="time">Event date </span> <?php echo $date->format('F j, Y'); ?>
     <?php } ?>
     <?php if(get_field("event_start_time")){ ?>
        <span class="time"><?php echo  get_field('event_start_time'); ?></span>
     <?php } ?>
	 <?php if(get_field('event_end_time') != ""){ ?>
        <span class="time"> <?php echo get_field('event_end_time'); ?></span>
	<?php } ?>
      </div>
<?php } ?>

 <!--=================image=================== -->       
    <?php if (get_field('image')){ ?>
     <div class="mySinglePicMobile hidden-md hidden-lg col-xs-12">
       <img data-original="<?php echo  get_field('image');?> "width="100%" alt="<?php the_title(); ?>" class="thumbnail img-responsive"  /> 
       <?php if(get_field("caption")){ ?>
       <div class="mitCaption"><?php the_field("caption");  ?></div>
       <?php }  ?>
     </div>
     <?php } ?>
 <!--=================image=================== --> 	
 <!--=================image=================== -->  
   <?php if (get_field('image')){ ?>         
      <div class="mySinglePic hidden-sm hidden-xs">
       <img data-original="<?php echo  get_field('image');?> "width="679" alt="<?php the_title(); ?>" class="thumbnail img-responsive"  /> 
        <?php if(get_field("caption")){ ?>
       <div class="mitCaption"><?php the_field("caption");  ?></div>
       <?php }  ?>
     </div>   
      <?php } ?>   
 <!--=================image=================== --> 
 
 
 <?php the_content();  ?>
 
 
 <?php
			
			// Echo type of Feature, if Feature
			if ($type_post === 'features') {
				$type = get_field('feature_type');
				echo 'The feature type is' . $type;
			}
			// Echo start/end dates, if they exist
			if ($type_post === 'exhibits' || $type_post === 'updates') {
				$date_start = get_field('date_start');
				$date_end = get_field('date_end');
				echo '<div>Start date is ' . $date_start . '</div>';
				echo '<div>End date is ' . $date_end . '</div>';
			} ?>
  </div>
  <!-- .entry-content -->
  </div> <!--close row-->
  </div><!--closes container that is open in the header to allow for the grey box fof the more in section -->
</article>
</div><!--trying to break that container-->
 <div style="background-color:rgb(233, 233, 233);padding-bottom:28px;border-top:4px solid rgb(224,224,224)">
 <div class="container">

<div class="row singleMargin">
  <div class="text-center moreIn"> More in <span class="lowercase"> <?php echo '<a title="'.$category[$r]->cat_name.'"  title="'.$category[$r]->cat_name.'" href="'.get_category_link($category[$r]->term_id ).'">'.$category[$r]->cat_name.'</a>'; ?></span>
  </div>
</div>
  <?php   //print_r(get_post_custom($post_id)); 
$custom_fields = get_post_custom($post_id);
  $my_custom_field = $custom_fields['feature_type'];
  foreach ( $my_custom_field as $key => $value ) {
	 //echo $key . " => " . $value . "<br />";
	}
	if($key == 'true'){
		//echo $key;
	}
?>
<?php wp_reset_postdata(); ?>
<?php wp_reset_query(); ?>
  <?php endwhile; // end of the loop. ?>
  <?php //get_template_part('inc/related'); ?>
  <?php
$catName = $category[$r]->cat_name;
$currentPost = get_the_ID();


$myCatId = $category[$r]->cat_ID;

$args = array(
	'post_type' => array( 'post', 'bibliotech', 'spotlights'),
	'cat'          => $myCatId,
	'posts_per_page'         => '3',
	'order'                  => 'DESC',
	'orderby'                => 'date',
	'post__not_in'       => array($currentPost),
);
	?>
    

<div class="row singleMargin">
<?php      
$myposts = get_posts($args);
$y = 1 ;
foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
<?php //echo $GLOBALS['wp_query']->request; ?>
    <div id="singleBox"  class="no-padding-left-mobile col-xs-12 col-xs-B-6 col-sm-6 col-md-4 col-lg-4 <?php //if($y == 2){ echo "hidden-sm hidden-xs-b";} ?>">
      <div class="flex-item blueTop eventsBox <?php if (get_field("listImg")) { echo "has-image";} else { echo "no-image"; } ?>" onClick='location.href="<?php if((get_field("external_link") != "") && $post->post_type == 'spotlights'){ the_field("external_link");}else{ echo get_post_permalink();}  ?>"'>
	  
		  <?php get_template_part('inc/spotlights'); ?>
       
        <?php
		if (get_field("listImg") != "" ) { ?>
        <img src="<?php the_field("listImg") ?>" width="100%" height="111" class="img-responsive"  alt="<?php the_title(); ?>"/>
        <?php } ?>
         <?php if($post->post_type == 'spotlights'){ ?>
			 <h2 class="entry-title title-post spotlights">
          <a href="<?php the_field("external_link"); ?>"><?php the_title();?></a>
        </h2> 
		<?php }else{ ?>
        <h2 class="entry-title title-post">
          <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
        </h2>
        <?php 	} ?>
    	<?php get_template_part('inc/events'); ?>
        <?php get_template_part('inc/entry'); ?>
        <!--final **** else-->
        <?php {  ?>
        <!--EVENT -->
        <?php } ?>
        <div class="category-post">
        <?php 	
			echo '<a title="'.$category[$r]->cat_name.'"  title="'.$category[$r]->cat_name.'" href="'.get_category_link($category[$r]->term_id ).'">'.$category[$r]->cat_name.'</a>';
		 ?>
         <span class="mitDate">
          <time class="updated"  datetime="<?php echo get_the_date(); ?>">&nbsp;&nbsp;<?php echo get_the_date(); ?></time>
          </span></div>
      </div>
    </div>
   
    <?php 
	$y = $y + 1;
	endforeach; 
wp_reset_postdata();?>
  </div>
  </main>
  <!-- #main -->   
</div>
<!-- #primary -->

</div><!--greybackground 100% width-->
 <div style="background-color:rgb(233, 233, 233);padding-bottom:28px;">
<div class="container">
<?php get_footer(); ?>
