
<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Twelve already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
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
<?php
if((get_post_type( get_the_ID() ) == 'bibliotech') || (cat_is_ancestor_of(73, $cat) or is_category(73))){  ?>
<?php get_template_part('inc/bib-header'); ?>
<?php  } ?>



<section id="" class="site-content">
  <div id="content" role="main">
    <?php if ( have_posts() ) : ?>
    
    <!-- .archive-header -->
    <div class="container">
    <div class="row">
      <?php 
	  $i = -1;	
	  while ( have_posts() ) : the_post(); 
	  	$i++;
	  ?>
      <div class="<?php if ($i % 3 == 0){ echo "third "; } ?> col-xs-12  col-xs-B-6 col-sm-4 col-md-4 no-padding-left-mobile">
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
				$category = get_the_category();     if($category[0]){
				echo '<a title="'.$category[0]->cat_name.'"  title="'.$category[0]->cat_name.'" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
				}
            ?>
            
         </div>
      </div>
     </div>
      <!-- eventsBox -->
      <?php 	endwhile; ?>
      <?php else : ?>
      <?php get_template_part( 'content', 'none' ); ?>
      <?php endif; ?>
    </div>
    <!-- MITContainer --> 
    </div><!--closes row-->
  </div>
  <!-- #content --> 
</section>
<!-- #primary -->
<div class="container">
<?php get_sidebar(); ?>
<?php get_footer(); ?>
