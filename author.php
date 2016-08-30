<?php
/**
 * The template for displaying archive-type pages for posts by an author.
 *
 * @package MITLibraries-News
 * @since Twenty Twelve 1.0
 */

get_header();

get_template_part( 'inc/sub-header' );
?>

<div id="content" role="main">

	<?php if ( have_posts() ) : ?>

	<div class="container">
		<div class="row">

			<?php

				/*
				 Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				 *
				 * We reset this later so we can run the loop
				 * properly with a call to rewind_posts().
				 */
				the_post();
			?>

			<header class="author-archive-header">
				<h1 class="lib-header"><?php printf( 'Author: ' . '<strong>' . get_the_author( '', false ) . '</strong>' ); ?></h1>
			</header><!-- .archive-header -->

			<div class="row" id="mitlibnews-container" data-postcontent="author" data-postauthor="<?php the_author_id(); ?>"></div>

		</div>
	</div>

	<?php endif; ?>

	<?php get_template_part( 'inc/more-posts' ); ?>

</div><!-- #content -->

<div class="container">
<?php get_footer(); ?>
