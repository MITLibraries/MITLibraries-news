<?php
/**
 * Template part for displaying FOOTER on featured/sticky + Bibliotech cards.
 *
*
* @package WordPress
* @subpackage MITLibraries-news
* @since v1.3.0
*/
?>

<div class="category-post">
      <?php 
      $category = get_the_category(); 
      if ($category[0]) {
        echo '<a title="'.$category[0]->cat_name.'" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
      }
      ?>
      <span class="mitDate"><?php echo get_the_date(); ?></span> 
      <!--echo all the cat --> 
    </div>