<?php 
	get_header();
?>

<div class="content-main">

	<?php get_template_part('inc/sub-header'); ?>
	
	<section class="posts--preview flex-container">

	<?php  while ( have_posts() ): the_post(); ?>

	<a href="<?php echo get_post_permalink(); ?>" class="post flex-container <?php if (!has_post_thumbnail()) { echo "no-image"; } ?>">
		<?php if (get_field('mark_as_new') === true): ?>
		<span>New!</span>
		<?php endif; ?>
		<?php 
		if ( has_post_thumbnail() ) {
			the_post_thumbnail();
		}
		?>

		<h2 class="title-post"><?php the_title(); ?></h2>
		<div class="excerpt-post">
			<?php the_excerpt(); ?>
		</div>
		<div class="category-post">
			<?php
			$category = get_the_category(); 
			echo $category[0]->cat_name;
			echo $category[1]->cat_name;
			?>
		</div>
	</a>
	
	<?php endwhile; ?>

	</section>

</div>

<?php 
	get_footer();
?>