<?php
/**
 * This template-part displays the EXCERPT on CARDS.
 *
 * @package MITLibraries-News
 * @since 1.1.11
 */

?>
		
<div class="excerpt-post classCheck">
	<p class="entry-summary">
		
		<?php
			echo strip_tags( excerpt( 25 ) );
		?>
		
	</p>
</div>