<?php 
	get_header();
?>

<div class="content-all">

	<?php  while ( have_posts() ): the_post(); ?>
	
	<div class="post">
		<h2 class="title-post"><?php the_title(); ?></h2>
		<?php the_content(); ?>
	</div>
	
<?php endwhile; ?>

</div>

<?php 
	get_footer();
?>