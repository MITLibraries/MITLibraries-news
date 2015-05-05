<?php
  // This partial is called by render() as it builds the cards on the news site
  $titleClasses = "entry-title title-post";
  $titleURL = "";
  if ($post->post_type == "spotlights") {
    $titleClasses .= " spotlights";
    $titleURL = get_field("external_link");
  } else {
    $titleURL = get_permalink();
  }
?>
<h2 class="inc <?php echo $titleClasses; ?>">
  <a href="<?php echo $titleURL; ?>"><?php the_title(); ?></a>
</h2>