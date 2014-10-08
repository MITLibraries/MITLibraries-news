<?php
/**
 * @package MIT Libraries News
 */

	$type_post = get_post_type();
	$type;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if (get_field('mark_as_new') === true): ?>
		<span>New!</span>
		<?php endif; ?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<span class="author">
				<?php echo 'By '; the_author(); ?>
			</span>
			<span class="date-post">
				<?php echo ' on '; the_date(); ?>
			</span>
			<?php if(has_category()): ?>
			<span class="category-post">
				<?php echo ' in '; the_category(); ?>
			</span>
			<?php endif; ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			if (has_post_thumbnail()) {
				the_post_thumbnail();
			}
			the_content();
			
			if ($type_post === 'features') {
				$type = get_field('type');
				echo $type;
			}
		?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
