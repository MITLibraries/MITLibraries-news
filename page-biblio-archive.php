<?php
/**
 * Template Name: Bibliotech Archive
 *
 * This template is used to display the
 * Archive page of all Bibliotech issues
 *
 * @package MITLibraries-News
 * @since 1.0
 */

get_header(); 
get_template_part( 'inc/sub-header' );
get_template_part( 'inc/bib-header' ); 
?>
<div class="clearfix">
<div class="container subscribe">
<div class="row"> 
	<div class="col-md-12"> 
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php the_title( '<h1 class="entry-title single">', '</h1>' ); ?>
	 <?php if(get_field( "subtitle" )){ ?>
	  <h2 class="subtitle"><?php the_field( "subtitle" ); ?></h2>
	  <?php } ?>
	</div>




	<div class="col-xs-12 col-xs-B-6 col-sm-6 col-md-6">     
	<?php the_content();  ?> 
	<br><br>
	</div>   
	
	<div class="col-xs-12 col-xs-B-6 col-sm-6 col-md-6">     
	<?php if ( has_post_thumbnail() ) : ?>
	
	<a href="<?php the_field( "bibLink" ); ?>"><?php the_post_thumbnail(); ?></a>
	
	<?php if(get_field( "bibLink" )){ ?>
	<div class="caption"><?php the_field( "bibCaption" ); ?></div>
	<?php } ?>
<?php endif; ?>
	</div>   
</div>
</div>
<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
</div><!--close biblio about-->
<div class="container">
<?php get_footer(); ?>