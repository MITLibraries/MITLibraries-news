<?php
/**
 * The template for displaying Category pages.
 *
 * Used to display archive-type pages for posts in a category.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
get_header(); 



$date = DateTime::createFromFormat('Ymd', get_field('event_date'));
?>
<?php get_template_part('inc/sub-header'); ?>


<section id="" class="">
  <div id="content" role="main">
    <?php if ( have_posts() ) : ?>
    <div class="container">
      <div class="row">
        <?php
			/* Start the Loop */
			$i = -1;
			while ( have_posts() ) : the_post();
			$i++; 
			?>
        <div class="<?php if ($i % 3 == 0){ echo "third "; } ?> col-xs-12  col-xs-B-6 col-sm-4 col-md-4 no-padding-left-mobile">
          <div class="hentry flex-item blueTop eventsBox <?php  if (get_field("listImg")) { echo "has-image";} else { echo "no-image"; } ?>" onClick='location.href="<?php if((get_field("external_link") != "") && $post->post_type == 'spotlights'){ the_field("external_link");}else{ echo get_post_permalink();}  ?>"'>
            <?php get_template_part('inc/spotlights'); ?>
            <?php
		if (get_field("listImg") != "" ) { ?>
            <img data-original="<?php the_field("listImg") ?>" width="100%" height="111" class="img-responsive"  alt="<?php the_title(); ?>"/>
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
				$categoryID = $category->cat_ID;
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
    </div><!--this div closes the open div in biblio padding-->
    <?php } ?>      
 <?php 
		 wp_reset_query();  
		endwhile; ?>
        <?php else : ?>
        <?php //get_template_part( 'content', 'none' ); ?>
        <?php endif; ?>
      </div>
      <!--closeMITcontainer--> 
    </div>
    <!--closes row-->
    
     <?php get_template_part('inc/more-posts'); ?>
  </div>
  <!-- #content --> 
</section>
<!-- #primary -->
<script>
<?php
if (is_category( )) {
  $cat = get_query_var('cat');
  $yourcat = get_category ($cat);
  $category2 = get_category_by_slug( $yourcat->slug);
  $categoryID2 = $category2->cat_ID;
 }
?>
var $j = jQuery.noConflict(); 
$j(function(){
    var offset = 21;
	var limit = 9;
    $j("#postContainer").load("/news/add-posts-category/");
    $j("#another").click(function(){
		limit = limit+9;
        offset = offset+21;
        $j("#postContainer")
            //.slideUp()
            .load("/news/add-posts-category/?offset="+offset+"&limit="+limit+"&categoryID="+<? echo $categoryID2 ?>+"", function() {
			 //.load("/news/test/?offset="+offset, function() {
			   $j(this).slideDown();
			   
			
			   $j('#another').click(function() {
			  // alert($j(this).load());
       });
			   
    	});
    	
    
            
        return false;
    });

});
</script>

<div class="container">
<?php get_footer(); ?>