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
		<div class="biblio-archive">

<?php
if ( have_posts() ) {
	while ( have_posts() ) : the_post();
?>

			<div class="col-md-12">
				<?php the_title( '<h1>', '</h1>' );
				if ( get_field( 'subtitle' ) ) { ?>
					<h2 class="subtitle"><?php the_field( 'subtitle' ); ?></h2>
				<?php } ?>
			</div>

			<div class="col-xs-12 col-xs-B-6 col-sm-6 col-md-6">
				<?php the_content(); ?>
				<br><br>
			</div>
	
			<div class="col-xs-12 col-xs-B-6 col-sm-6 col-md-6">
			<?php if ( has_post_thumbnail() ) :

				if ( get_field( 'bibLink' ) ) {
					?><a href="<?php the_field( 'bibLink' ); ?>"><?php
				}

				the_post_thumbnail();

				if ( get_field( 'bibLink' ) ) {
					?></a><?php
				}

				if ( get_field( 'bibCaption' ) ) {
					?><div class="caption"><?php the_field( 'bibCaption' ); ?></div><?php
				}
			endif; ?>
			</div>

<?php
	endwhile;
} else {
?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php
} // End else clause.
?>

		</div><!-- news-content -->
	</div><!-- container -->
</div><!--close biblio about-->
<div class="container">
<?php get_footer(); ?>
