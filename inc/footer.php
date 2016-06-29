<?php
/**
* Template part for displaying Footer on cards.
*
* @package WordPress
* @subpackage MITLibraries-news
* @since v1.3.0
*/
?>

  <div class="category-post <?php  if(get_post_type( get_the_ID() ) == 'bibliotech'){ echo "Bibliotech";} ?>">
    <?php 
    if (is_page('bibliotech-index') || (is_page_template('additionalPosts-biblio.php')) || (is_category('bibliotech_issues') || (is_tax() ) || is_page_template('additionalPosts-archives.php'))) {
      echo "<div class='biblioPad'>&nbsp;<a href='/news/bibliotech-index/' title='Bibliotech'>Bibliotech</a></div>"; 
    } elseif ((get_post_type( get_the_ID() ) == 'bibliotech') && (!is_page_template('additionalPosts-biblio.php'))) {
      echo "<div class='bilbioImg bilbioTechIcon'> </div>";
      echo "<div class='biblioPadding'>&nbsp;<a href='/news/bibliotech-index/' title='Bibliotech'>Bibliotech</a>"; ?>
     
      <span class="mitDate">
        <time class="updated" datetime="<?php echo get_the_date(); ?>"><?php echo get_the_date(); ?></time>
      </span>
    <?php
    } else {
      $category = get_the_category();     
      $rCat = count($category);
      $r = rand(0, $rCat -1);
      echo '<a title="'.$category[$r]->cat_name.'"  title="'.$category[$r]->cat_name.'" href="'.get_category_link($category[$r]->term_id ).'">'.$category[$r]->cat_name.'</a>'; 
    ?>
      <span class="mitDate">
        <time class="updated"  datetime="<?php echo get_the_date(); ?>"><?php echo get_the_date(); ?></time>
      </span>
    <?php
    } 
    ?>
    </div> 