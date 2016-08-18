<?php
/**
 * This template-part displays the TITLE on CARDS.
 *
 * @package MITLibraries-News
 * @since 1.1.11
 */

?>

		<?php if ( $post->post_type == 'spotlights' ) { ?>
			 <h2 class="entry-title title-post spotlights">
			 <a href="<?php the_field( 'external_link' ); ?>"><?php the_title();?></a>
			</h2> 
		<?php } else { ?>
			<h2 class="entry-title title-post classCheck">
			<a href="<?php the_permalink(); ?>"><?php the_title();?></a>
			</h2>
		<?php } ?>