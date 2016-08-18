<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package MITLibraries-News
 * @since Twenty Twelve 1.0
 */

?>
	
	<div id="sidebarContent" class="sidebar span3">
		<div class="sidebarWidgets">
			<?php dynamic_sidebar( 'subscribe' ); ?>
		</div>
	</div>		
