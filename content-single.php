<?php
/**
 * @package MIT Libraries News
 */
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
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content();
			if (has_post_thumbnail()) {
				the_post_thumbnail();
			}
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
