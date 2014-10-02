<?php 
	get_header();
?>

<div class="content-all">

	<?php  while ( have_posts() ): the_post(); ?>
	
	<div class="post">
		<?php if (get_field('mark_as_new') === true): ?>
		<span>New!</span>
		<?php endif; ?>
		<h2 class="title-post"><?php the_title(); ?>test</h2>
		<?php the_content(); ?>
	</div>
	
<?php endwhile; ?>

</div>

<?php 
	get_footer();
?>