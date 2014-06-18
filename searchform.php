<form action="<?php echo site_url(); ?>" method="get">
  <fieldset>
    <input type="text" name="s" id="search" placeholder="Search news &amp; events" value="<?php the_search_query(); ?>" />
    <input type="image" alt="Search" src="<?php bloginfo( 'template_url' ); ?>/images/search.png" />
  </fieldset>
</form>