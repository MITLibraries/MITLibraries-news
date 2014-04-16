<form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
<div><input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" />
<input type="submit" id="searchsubmit" value="Search News" />
</div>
</form>
