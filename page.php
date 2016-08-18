<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package MITLibraries-News
 * @since Twenty Twelve 1.0
 */

$pageRoot = getRoot( $post );
$section = get_post( $pageRoot );
$isRoot = $section->ID == $post->ID;



get_header(); ?>
	<?php get_template_part( 'inc/sub-headerSingle' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<div class="container">
		<div class="row">
		<div id="stage" class="inner column3 tertiaryPage  subscribe clearfix" role="main">
			

		
<div class="col-xs-12 col-xs-B-12 col-sm-9 col-md-9 col-lg-9">
	
			<div class="title-page">
				<?php if ( $isRoot ) : ?>
				<h2><?php echo $section->post_title; ?></h2>
				<?php else : ?>
				<h2><a href="<?php echo get_permalink( $section->ID ) ?>"><?php echo $section->post_title; ?></a></h2>
				<?php endif; ?>
			</div>
			
			<div class="">
				<div class="col-1 content-page">
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="featuredImage">
			<?php echo the_post_thumbnail( 700, 300 ); ?>
		
		</div>	
		<?php endif; ?>
		
		
		<div class="entry-content">
			<?php if ( ! $isRoot ) : ?>
			<h2><?php the_title(); ?></h2>
			<?php endif; ?>
			<?php the_content(); ?>
			
		</div>
		
</div>
			</div>
			</div>
	
	
	<div class="col-xs-12 col-xs-B-11 col-sm-3 col-md-3 col-lg-3">
<?php if ( ! dynamic_sidebar() ) : ?>
	
		<div id="sidebarContent" class="sidebar span3">
		<div class="sidebarWidgets">
			<?php // dynamic_sidebar( 'subscribe' ); ?>
		</div>
	</div>		

<?php endif; ?>	


</div>

		</div>
		</div>
		</div>
		<?php endwhile; // end of the loop. ?>
<div class="container">
<?php get_footer(); ?>