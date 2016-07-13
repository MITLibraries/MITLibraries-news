<?php
/**
 * Template-part for displaying the UI of the SEARCHBAR.
 *
 * @package MITLibraries-News
 * @since 1.0
 */

?>

<span class="hidden-xs">
<form action="<?php echo site_url(); ?>" method="get">
  <fieldset>
    <input type="text" name="s" id="search"  placeholder="Search news &amp; events" value="<?php the_search_query(); ?>" />
   
  </fieldset>
</form>
</span>

<span class="hidden-lg hidden-md hidden-sm">
<form action="<?php echo site_url(); ?>" method="get">
  <fieldset>
    <input type="text" name="s" id="search"  class="searchForm"  placeholder="Search news" value="<?php the_search_query(); ?>" />
   
  </fieldset>
</form>
</span>