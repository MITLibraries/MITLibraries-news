<?php
/**
 * @package MIT Libraries News
 */
	
	$category = get_the_category();
	$type_post = get_post_type();
	$subtitle;
	$type;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-category="<?php echo $category[0]->slug; ?>">
	<header class="title-page">
		<?php if (get_field('mark_as_new') === true): ?>
		<span>New!</span>
		<?php endif; ?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php if($type_post === 'post') {
			$subtitle = get_field('subtitle');
			echo '<h2 class=subtitle>' . $subtitle . '</h2>';
		} ?>

		<div class="entry-meta">
			<span class="author">
				<?php echo 'By '; the_author(); ?>
			</span>
			<span class="date-post">
				<?php echo ' on '; the_date(); ?>
			</span>
			<?php if(has_category()): ?>
			<span class="category-post">
				<?php echo ' in ' . array_slice($category, 0, 2); ?>
			</span>
			<?php endif; ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			if (has_post_thumbnail()) {
				the_post_thumbnail();
				echo '<span>' . get_post(get_post_thumbnail_id())->post_excerpt . '</span>';
			}
			the_content();
			// Echo type of Feature, if Feature
			if ($type_post === 'features') {
				$type = get_field('feature_type');
				echo 'The feature type is' . $type;
			}
			// Echo start/end dates, if they exist
			if ($type_post === 'exhibits' || $type_post === 'updates') {
				$date_start = get_field('date_start');
				$date_end = get_field('date_end');
				echo '<div>Start date is ' . $date_start . '</div>';
				echo '<div>End date is ' . $date_end . '</div>';
			}
		?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
