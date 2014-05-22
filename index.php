<?php 
	get_header();

	$i= 0;
?>

<?php  while ( have_posts() ): the_post(); ?>

	<h2 class="title-post" data-post-number="<?php echo $i; $i++; ?>"><?php the_title(); ?></h2>

<?php endwhile; ?>

<?php 
	get_footer();
?>