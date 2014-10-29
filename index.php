<?php 
	get_header();
?>

<div class="content-main">

	<?php get_template_part('inc/sub-header'); ?>
	
	<section class="posts--preview flex-container--wrap--3-col space-between">
	<?php

	// WP Query args
	$args = array(
		'post_type' => 'any'
	);

	// The Query
	$the_query = new WP_Query( $args );

	// The loop
	while ( $the_query->have_posts() ): $the_query->the_post();
	
	?>

	<a href="<?php echo get_post_permalink(); ?>" class="post--full-bleed <?php if (!has_post_thumbnail()) { echo "no-image"; } else { echo "has-image"; } ?>">
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
	
	<?php

	endwhile;

	/* Restore original Post Data */
	wp_reset_postdata();

	?>

	</section>

</div>

<?php 
	get_footer();
?>