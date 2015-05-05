<?php
  // This partial is called by render() as it builds the cards displayed throughout the news site
  $image = "";
  if (get_field("listImg") != "") {
    $image = '<img data-original="' . get_field("listImg") . '" width="100%" height="111" class="img-responsive" alt="' . get_the_title() . '"/>';
  }
  echo $image;
?>