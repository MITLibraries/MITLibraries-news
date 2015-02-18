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

<section id="" class="site-content">
  <div id="content" role="main">
    <?php if ( have_posts() ) : ?>
    <?php /*?><header class="archive-header">
				<h2><?php printf( __( 'Category Archives: %s', 'twentytwelve' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h2>

			<?php if ( category_description() ) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
			<?php endif; ?>
			</header><!-- .archive-header --><?php */?>
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
            ?> <span class="mitDate">
          <time class="updated"  datetime="<?php echo get_the_date(); ?>">&nbsp;&nbsp;<?php echo get_the_date(); ?></time>
          </span>
            </div>
          </div>
        </div>
        <!--closeEventsBox-->
        
        <?php endwhile; ?>
        <?php else : ?>
        <?php get_template_part( 'content', 'none' ); ?>
        <?php endif; ?>
      </div>
      <!--closeMITcontainer--> 
    </div>
    <!--closes row--> 
  </div>
  <!-- #content --> 
</section>
<!-- #primary -->

<?php get_sidebar(); ?>
<div class="container">
<?php get_footer(); ?>
