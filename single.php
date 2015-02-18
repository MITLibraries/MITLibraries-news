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
<?php get_template_part('inc/sub-headerSingle'); ?>
<?php
if((get_post_type( get_the_ID() ) == 'bibliotech') || (cat_is_ancestor_of(73, $cat) or is_category(73))){  ?>
<?php get_template_part('inc/bib-header'); ?>
<?php  } ?>

<div id="primary" class="content-area">
<main id="main" class="content-main" role="main">
<div class="row">
<?php while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-category="<?php echo $category[0]->slug; ?>">
  <div class="title-page  mySingle">
  
      
      <?php the_title( '<h1 class="entry-title single">', '</h1>' ); ?>
      <h2 class="subtitle"><?php the_field("subtitle"); ?></h2>
      <div class="entry-meta"> <span class="author"> By
        <?php the_author_posts_link(); ?>
        </span> <span class="date-post"> <?php echo ' on '; the_date(); ?> </span>
        <?php if(has_category()): ?>
        <span class="category-post-single"> in
        <?php 
				$category = get_the_category();     
				$rCat = count($category);
				$r = rand(0, $rCat -1);
				echo '<a title="'.$category[$r]->cat_name.'"  title="'.$category[$r]->cat_name.'" href="'.get_category_link($category[$r]->term_id ).'">'.$category[$r]->cat_name.'</a>';
            ?>
        <?php //echo ' in ' . array_slice($category, 0, 2); ?>
        </span>
        <?php endif; ?>
      </div>
   
    
  
    <div class="clearfix"></div>
    <!-- .entry-meta --> 
  </div>
  <!-- .title-page -->
  
  <div class="entry-content inlineHeader mitContent clearfix">
    
	   <?php 
			
			$date = DateTime::createFromFormat('Ymd', get_field('event_date'));
			//echo $date->format('d-m-Y');
			// Check for events
			if ($type_post == 'post' && get_field('is_event') == 1) { ?>
    <div class="event"><span class="grey">Event date </span> <?php echo $date->format('F, j Y'); ?><span class="grey"> starting at</span>
      <?php //echo  get_field('event_start_time'); ?>
      <span class="grey">
      <?php if(get_field('event_end_time') != ""){ ?>
      and ending at</span> <?php echo get_field('event_end_time'); }?></div>
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
  </div>
  <!--close row--> 
</article>
<div class="row">
  <div class="text-center moreIn"> More in <span class="lowercase"><?php echo $category[$r]->cat_name; ?></span><br />
   
   <span class="smallerTxt"> <?php echo '<a title="'.$category[$r]->cat_name.'"  title="'.$category[$r]->cat_name.'" href="'.get_category_link($category[$r]->term_id ).'">'.$category[$r]->cat_name.'</a>'; ?></span>
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
$category = get_the_category(); 
$category[0]->cat_name; ?>

<?php 
$myCatId = $category[0]->cat_ID;
echo $myCatId;
$args = array(
	'posts_per_page'   => 3,
	'offset'           => 4,
	'category'         => '$myCatId',
	'category_name'    => '',
	'orderby'          => 'post_date',
	'order'            => 'DESC',
	'include'          => '',
	'exclude'          => '',
	'meta_key'         => '',
	'meta_value'       => '',
	'post_type' => array( 'post', 'bibliotech', 'spotlights'),
	'post_mime_type'   => '',
	'post_parent'      => '',
	'post_status'      => 'publish',
	'suppress_filters' => true ); 
	?>
    

<div class="row">
<?php      
$myposts = get_posts($args);
foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
<?php //echo $GLOBALS['wp_query']->request; ?>
    <div class="col-xs-12 col-sm-4 col-md-4">
      <div class="hentry flex-item blueTop eventsBox <?php if (get_field("listImg")) { echo "has-image";} else { echo "no-image"; } ?>" onClick='location.href="<?php if((get_field("external_link") != "") && $post->post_type == 'spotlights'){ the_field("external_link");}else{ echo get_post_permalink();}  ?>"'>
	  
		  <?php get_template_part('inc/spotlights'); ?>
       
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
			
					
				echo '<a title="'.$category[$r]->cat_name.'"  title="'.$category[$r]->cat_name.'" href="'.get_category_link($category[$r]->term_id ).'">'.$category[$r]->cat_name.'</a>';
				
			
            ?>
         </div>
      </div>
    </div>
    <?php endforeach; 
wp_reset_postdata();?>
  </div>
  </main>
  <!-- #main --> 
  
</div>
<!-- #primary -->

<?php get_footer(); ?>
<script>
select = document.getElementById("#bibMenu");
select.onload= function(){
	alert(this.options[this.selectedIndex].text);
};</script>