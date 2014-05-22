<?php 
	get_header();

	$i= 0;
?>

<?php  while ( have_posts() ): the_post(); ?>
	
	<div class="post" data-post-number="<?php echo $i; $i++; ?>">
		<h2 class="title-post"><?php the_title(); ?></h2>
		<?php the_content(); ?>
	</div>
<?php endwhile; ?>

<?php 
	get_footer();
?>