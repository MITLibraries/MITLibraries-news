<?php
/**
 * This template-part displays the TITLE on CARDS.
 *
 * @package MITLibraries-News
 * @since 1.1.11
 */

?>

		<?php if ( 'spotlights' == $post->post_type ) { ?>
			 <h2 class="entry-title title-post spotlights">
			 <a href="<?php the_field( 'external_link' ); ?>"><?php the_title();?></a>
			</h2> 
		<?php } else { 

		$eventLink = get_post_permalink();

		if ( get_field( 'calendar_url' ) ) { 
			$eventLink  = 	get_field( 'calendar_url' );
		}
		 ?>
			<h2 class="entry-title title-post classCheck">
			<a href="<?php echo $eventLink; ?>"><?php the_title();?></a>
			</h2>
		<?php } ?>
