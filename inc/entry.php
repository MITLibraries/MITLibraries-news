<?php
/**
* Template part for displaying Excerpt on cards.
*
* @package WordPress
* @subpackage MITLibraries-news
* @since v1.3.0
*/
?>
	<div class="excerpt-post classCheck">
        <p class="entry-summary">
			<?php
				echo strip_tags(excerpt(25));
				?>
        </p>
    </div> 