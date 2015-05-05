<?php 
function render($post, $i, $type) {
  // default outer classes
  $outerClasses = "padding-right-mobile col-xs-12 col-xs-B-6 col-sm-4 col-md-4 col-lg-4";
  if ($i % 3 == 0) {
    $outerClasses .= " third";
  }

  // default inner classes
  $innerClasses = "flex-item blueTop eventsBox render-confirm-" . $type;
  if (get_field("listImg")) {
    $innerClasses .= " has-image";
  } else {
    $innerClasses .= " no-image";
  }

  // inner onClick
  $innerOnClick = "";
  if ( get_field("external_link") != "" && $post->post_type == 'spotlights') {
    $innerOnClick = get_field("external_link");
  } else {
    $innerOnClick = get_permalink();
  }

  // image handled by inc/card-image

  // title handled by inc/card-title

  // event handled by inc/events

  // entry handled by inc/entry

  // category
  $categoryClasses = "category-post";
  $categoryMarkup = "";
  $dateMarkup = "";
  /*
  Not sure this check is needed 
  if ($post->post_type == 'bibliotech') {
    $categoryClasses .= " Bibliotech";
  }
  */
  if (is_page('bibliotech-index') || (is_page_template('additionalPosts-biblio.php')) || (is_category('bibliotech_issues') || (is_tax() ) || is_page_template('additionalPosts-archives.php'))) {

    // Bibliotech articles without icon
    $categoryMarkup = "<div class='biblioPad'>&nbsp;<a href='/news/bibliotech/' title='Bibliotech'>Bibliotech</a></div>"; 

  } elseif ( ( $post->post_type == 'bibliotech') && (!is_page_template('additionalPosts-biblio.php')) ) {

    // Bibliotech articles with icon    
    $categoryMarkup = "<div class='bilbioImg bilbioTechIcon'> </div>"; 
    $categoryMarkup .= "<div class='biblioPad'>&nbsp;<a href='/news/bibliotech/' title='Bibliotech'>Bibliotech</a>"; 

    $dateMarkup = "<span class='mitDate'>" .
    "<time class='updated' datetime='" . get_the_date() . "'>&nbsp;&nbsp;" . get_the_date() . "</time>" .
    "</span>" .
    "</div>";

  } else {

    // Non-biliotech articles
    $category = get_the_category();     
    $rCat = count($category);
    $r = rand(0, $rCat -1);

    $categoryMarkup = '<a title="'.$category[$r]->cat_name.'"  title="'.$category[$r]->cat_name.'" href="'.get_category_link($category[$r]->term_id ).'">'.$category[$r]->cat_name.'</a>';

    $dateMarkup = "<span class='mitDate'>" .
    "<time class='updated' datetime='" . get_the_date() . "'>&nbsp;&nbsp;" . get_the_date() . "</time>" .
    "</span>";

  }

?>
  <div id="theBox" class="<?php echo $outerClasses; ?>">
    <div class="<?php echo $innerClasses; ?>" onClick='location.href="<?php echo $innerOnClick; ?>"'>

      <?php get_template_part('inc/spotlights'); ?>

      <?php get_template_part('inc/card-image'); ?>

      <?php get_template_part('inc/card-title'); ?>

      <?php get_template_part('inc/events'); ?>

      <?php get_template_part('inc/entry'); ?>

      <div class="<?php echo $categoryClasses; ?>">
        <?php echo $categoryMarkup; ?>
        <?php echo $dateMarkup; ?>
      </div>

    </div>
  </div>
<?php
}


function renderRegularCard($i, $post) {
?>
<div class="flex-item blueTop eventsBox <?php if (get_field("listImg")) { echo "has-image";} else { echo "no-image"; } ?>" 
  onClick='location.href="<?php if((get_field("external_link") != "") && $post->post_type == 'spotlights'){ the_field("external_link");}else{ echo get_post_permalink();}  ?>"'
  >
  <?php 
  get_template_part('inc/spotlights');

  if (get_field("listImg") != "" ) {
  ?>
    <img data-original="<?php the_field("listImg") ?>" width="100%" height="111" class="img-responsive"  alt="<?php the_title();?>"/>
  <?php 
  }

  if ($post->post_type == 'spotlights') { 
  ?>
    <h2 class="entry-title title-post spotlights">
      <a href="<?php the_field("external_link"); ?>"><?php the_title();?></a>
    </h2> 
  <?php
  } else {
  ?>
    <h2 class="entry-title title-post">
      <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
    </h2>
  <?php
  }

  get_template_part('inc/events');

  if ($post->post_type == 'spotlights') {
  } else {
    get_template_part('inc/entry');
  }
  ?>

  <div class="category-post <?php  if(get_post_type( get_the_ID() ) == 'bibliotech'){ echo "Bibliotech";} ?>">
    <?php 
    if (is_page('bibliotech-index') || (is_page_template('additionalPosts-biblio.php')) || (is_category('bibliotech_issues') || (is_tax() ) || is_page_template('additionalPosts-archives.php'))) {

      echo "<div class='biblioPad'>&nbsp;<a href='/news/bibliotech/' title='Bibliotech'>Bibliotech</a></div>"; 

    } elseif ((get_post_type( get_the_ID() ) == 'bibliotech') && (!is_page_template('additionalPosts-biblio.php'))) {

      echo "<div class='bilbioImg bilbioTechIcon'> </div>";
      echo "<div class='biblioPadding'>&nbsp;<a href='/news/bibliotech/' title='Bibliotech'>Bibliotech</a>"; ?>
     
      <span class="mitDate">
        <time class="updated" datetime="<?php echo get_the_date(); ?>">&nbsp;&nbsp;<?php echo get_the_date(); ?></time>
      </span>
    <?php

    } else {

      $category = get_the_category();     
      $rCat = count($category);
      $r = rand(0, $rCat -1);
      echo '<a title="'.$category[$r]->cat_name.'"  title="'.$category[$r]->cat_name.'" href="'.get_category_link($category[$r]->term_id ).'">'.$category[$r]->cat_name.'</a>'; 
    ?>
      <span class="mitDate">
        <time class="updated"  datetime="<?php echo get_the_date(); ?>">&nbsp;&nbsp;<?php echo get_the_date(); ?></time>
      </span>
    <?php

    } 

    ?>
    </div> 
  </div><!--last-->
</div>
  <?php
  if (get_post_type( get_the_ID() ) == 'bibliotech') {
  ?>
    </div><!--this div closes the open div in biblio padding-->
  <?php
  }

}

function renderEventCard($i, $post) {
?>
  <div class="<?php if ($i % 3 == 0){ echo "third "; } ?> col-xs-12 col-xs-B-6 col-sm-4 col-md-4 eventsPage padding-right-mobile">
    <div itemscope itemtype="http://data-vocabulary.org/Event" class="flex-item blueTop eventsBox <?php if (get_field("listImg")) { echo "has-image";} else { echo "no-image"; } ?>" onClick='location.href="<?php if((get_field("external_link") != "") && $post->post_type == 'spotlights'){ the_field("external_link");}else{ echo get_post_permalink();}  ?>"'>
    <?php
    if (get_field("listImg") != "" ) { 
    ?>
      <img data-original="<?php the_field("listImg") ?>" width="100%" height="111"  alt="<?php the_title(); ?>" itemprop="photo" class="img-responsive"  />
    <?php 
    } 
    ?>
      <h2 itemprop="summary" class="entry-title title-post">
        <a itemprop="url" href="<?php the_permalink(); ?>">
          <?php the_title(); ?>
        </a> 
      </h2>
      <!--/EVENT  DATE-->
    <?php
    $date = get_field('event_date');
    // $date = 19881123 (23/11/1988)

    // extract Y,M,D
    $y = substr($date, 0, 4);
    $m = substr($date, 4, 2);
    $d = substr($date, 6, 2);

    // create UNIX
    $time = strtotime("{$d}-{$m}-{$y}");
    // format date (23/11/1988)

    if (get_field('event_date')) {  
    ?>
      <time itemprop="startDate" datetime="<?php  echo date('d/m/Y', $time);  ?>">
        <?php   $date = DateTime::createFromFormat('Ymd', get_field('event_date'));?>
      </time>
      <div class="events">
        <div class="event"> </div>
        <?php 
        echo $date->format('F j, Y'); 
        $startTime = get_field('event_start_time'); 
        $myDash = '&ndash;';
        $endTime = get_field('event_end_time'); 
        ?>
        &nbsp;&nbsp;
        <span class="time">
          <?php 
          if (($startTime) && ($endTime)) {
            echo $startTime;
            echo "&ndash;";
            echo $endTime;
          } elseif ($startTime) {
            echo $startTime;
          }
          ?>
        </span> 
      </div>
    <?php   
    } 
    ?>
    <!--EVENT -->

    <div itemprop="description" class="excerpt-post">
      <?php get_template_part('inc/entry'); ?>
    </div>

    <div class="category-post">
      <span  itemprop="eventType">
        <?php 
        $category = get_the_category();     
        $rCat = count($category);
        $r = rand(0, $rCat -1);
        echo '<a title="'.$category[$r]->cat_name.'"  title="'.$category[$r]->cat_name.'" href="'.get_category_link($category[$r]->term_id ).'">'.$category[$r]->cat_name.'</a>';
        ?>
      </span>

      <span class="mitDate">
        <time class="updated"  datetime="<?php echo get_the_date(); ?>">&nbsp;&nbsp;<?php echo get_the_date(); ?></time>
      </span> 
    </div>
  </div> <!-- close itemscope -->
</div> <!-- close eventsPage -->
<?php
}

function renderFeatureCard($i, $post) {
?>
  <div class="padding-right-mobile sticky col-xs-3 col-xs-B-6 col-sm-8 col-lg-8 col-md-8" onClick='location.href="<?php echo get_post_permalink(); ?>"' style="padding-right:0px;" > 
    <img src="<?php the_field("featuredListImg"); ?>" class="img-responsive" width="679" height="260" alt="<?php the_title();?>" /> 
  </div>
  <div class="hidden-xs bgWhite col-xs-12 col-xs-B-6 col-sm-4 col-md-4 col-lg-4" onClick='location.href="<?php if((get_field("external_link") != "") && $post->post_type == 'spotlights'){ the_field("external_link");}else{ echo get_post_permalink();}  ?>"'>
    <?php 
    if ($post->post_type == 'spotlights') { 
    ?>
      <h2 class="entry-title title-post spotlights">
        <a href="<?php the_field("external_link"); ?>"><?php the_title();?></a>
      </h2>
    <?php
    } else {
    ?>
      <h2 class="entry-title title-post">
        <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
      </h2>
    <?php
    }
    
    get_template_part('inc/events');

    if ($post->post_type == 'spotlights') {
    } else {
      get_template_part('inc/entry');
    }
    ?>
    <div class="category-post">
      <?php 
      $category = get_the_category(); 
      if ($category[0]) {
        echo '<a title="'.$category[0]->cat_name.'" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
      }
      ?>
      <span class="mitDate">&nbsp;&nbsp;<?php echo get_the_date(); ?></span> 
      <!--echo all the cat --> 
    </div>
  </div>
</div>
<?php 
} 


?>