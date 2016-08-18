<?php
/**
 * Template-part for displaying IMAGES on CARDS.
 *
 * @package MITLibraries-News
 * @since 1.0
 */

?>

	<?php
	
		if (get_field("listImg") != "" ) { ?>
			<div class="card-image classCheck">
		<img src="<?php the_field("listImg") ?>" width="100%" height="111" alt="<?php the_title();?>"/>
			</div>
		<?php } ?>