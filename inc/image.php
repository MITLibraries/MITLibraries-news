<?php
/**
* Template part for displaying Images on cards.
*
* @package WordPress
* @subpackage MITLibraries-news
* @since v1.3.0
*/
?>

    <?php
    
		if (get_field("listImg") != "" ) { ?>
            <div class="card-image classCheck">
        <img src="<?php the_field("listImg") ?>" width="100%" height="111" alt="<?php the_title();?>"/>
            </div>
        
     <?php } ?>