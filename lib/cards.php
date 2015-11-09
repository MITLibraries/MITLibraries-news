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
    $categoryMarkup = "<div class='biblioPad'>&nbsp;<a href='/news/bibliotech-index/' title='Bibliotech'>Bibliotech</a></div>"; 
  } elseif ( ( $post->post_type == 'bibliotech') && (!is_page_template('additionalPosts-biblio.php')) ) {
    // Bibliotech articles with icon    
    $categoryMarkup = "<div class='bilbioImg bilbioTechIcon'> </div>"; 
    $categoryMarkup .= "<div class='biblioPad'>&nbsp;<a href='/news/bibliotech-index/' title='Bibliotech'>Bibliotech</a>"; 
    $dateMarkup = "<span class='mitDate'>" .
    "<time class='updated' datetime='" . get_the_date() . "'>" . get_the_date() . "</time>" .
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

<!-- RENDER FUNCTION FOR MOBILE CARDS -->

<?php
}
function renderMobileCard($i, $post) {
?>
<div  class="visible-xs visible-sm hidden-md hidden-lg no-padding-left-mobile no-padding-left-tablet col-xs-12 col-xs-B-6 col-sm-6 col-md-4 col-lg-4 ">
<div class="flex-item blueTop eventsBox <?php if (get_field("listImg")) { echo "has-image";} else { echo "no-image"; } ?>" onClick='location.href="<?php if((get_field("external_link") != "") && $post->post_type == 'spotlights'){ the_field("external_link");}else{ echo get_post_permalink();}  ?>"'>
    
       		<!-- INTERNAL CONTAINER TO CONTROL FOR OVERFLOW -->   
			 <div class="interiorCardContainer">
				 
				<!-- CHECKS FOR SPOTLIGHT -->   
				<?php if($post->post_type == 'spotlights'){ ?>
				<?php get_template_part('inc/spotlights'); ?>
		        <?php 	} ?><!-- SPOTLIGHT -->  
				
				<!-- CHECKS FOR IMAGE -->   
		        <?php
				if (get_field("listImg") != "" ) { ?>
		    	<?php get_template_part('inc/image'); ?>
		        <?php } ?><!-- .listImg -->  
		         
				<!-- CALLS TITLE FOR REGULAR/SPOTLIGHT POST-TYPES -->   
		        <?php get_template_part('inc/title'); ?>
		        <!-- TITLE -->  
		        
				<!-- CHECKS IF EVENT TYPE -->   
		        <?php if (get_field('event_date')){ ?>
		    	<?php get_template_part('inc/events'); ?>
		        <?php } ?><!-- EVENT -->
		    	
				<!-- CHECKS FOR SUBTITLE -->
		        <?php if (get_field('subtitle')){ ?>
		        	<?php get_template_part('inc/subtitle'); ?>
				<?php } ?><!-- .subtitle -->    	
		        
				<!-- CALLS FOR EXCERPT -->   
		        <?php get_template_part('inc/entry'); ?>
		
			</div> <!--.interiorCardBox -->  
				
                <!-- CALLS FOR FOOTER -->   
		        <?php get_template_part('inc/footer'); ?>

  </div><!--last-->
</div>

<?php
}
function renderMobileBiblioCard($i, $post) {
?>
<div  class="visible-xs visible-sm hidden-md hidden-lg no-padding-left-mobile no-padding-left-tablet col-xs-12 col-xs-B-6 col-sm-6 col-md-4 col-lg-4 ">
<div class="flex-item blueTop eventsBox <?php if (get_field("listImg")) { echo "has-image";} else { echo "no-image"; } ?>" onClick='location.href="<?php if((get_field("external_link") != "") && $post->post_type == 'spotlights'){ the_field("external_link");}else{ echo get_post_permalink();}  ?>"'>
    
       		<!-- INTERNAL CONTAINER TO CONTROL FOR OVERFLOW -->   
			 <div class="interiorCardContainer">
				
				<!-- CHECKS FOR IMAGE -->   
		        <?php
				if (get_field("listImg") != "" ) { ?>
		    	<?php get_template_part('inc/image'); ?>
		        <?php } ?><!-- .listImg -->  
		         
				<!-- CALLS TITLE FOR REGULAR/SPOTLIGHT POST-TYPES -->   
		        <?php get_template_part('inc/title'); ?>
		        <!-- TITLE -->  
		    	
				<!-- CHECKS FOR SUBTITLE -->
		        <?php if (get_field('subtitle')){ ?>
		        	<?php get_template_part('inc/subtitle'); ?>
				<?php } ?><!-- .subtitle -->    	
		        
				<!-- CALLS FOR EXCERPT -->   
		        <?php get_template_part('inc/entry'); ?>
		
			</div> <!--.interiorCardBox -->  
				
                <!-- CALLS FOR FOOTER -->   
		        <?php get_template_part('inc/catFooter'); ?>

  </div><!--last-->
</div>

<?php
}
function renderBiblioCard($m, $post) {
?>
<div  class="no-padding-left-mobile col-xs-12 col-xs-B-6 col-sm-6 col-md-4 col-lg-4">
<div class="flex-item blueTop eventsBox <?php if (get_field("listImg")) { echo "has-image";} else { echo "no-image"; } ?>" onClick='location.href="<?php if((get_field("external_link") != "") && $post->post_type == 'spotlights'){ the_field("external_link");}else{ echo get_post_permalink();}  ?>"'>
    
       		<!-- INTERNAL CONTAINER TO CONTROL FOR OVERFLOW -->   
			 <div class="interiorCardContainer">
				 				
				<!-- CHECKS FOR IMAGE -->   
		        <?php
				if (get_field("listImg") != "" ) { ?>
		    	<?php get_template_part('inc/image'); ?>
		        <?php } ?><!-- .listImg -->  
		         
				<!-- CALLS TITLE FOR REGULAR/SPOTLIGHT POST-TYPES -->   
		        <?php get_template_part('inc/title'); ?>
		        <!-- TITLE -->  
		    	
				<!-- CHECKS FOR SUBTITLE -->
		        <?php if (get_field('subtitle')){ ?>
		        	<?php get_template_part('inc/subtitle'); ?>
				<?php } ?><!-- .subtitle -->    	
		        
				<!-- CALLS FOR EXCERPT -->   
		        <?php get_template_part('inc/entry'); ?>
		
			</div> <!--.interiorCardBox -->  
				
                <!-- CALLS FOR FOOTER -->   
		        <?php get_template_part('inc/catFooter'); ?>

  </div><!--last-->
</div>

<!-- RENDER FUNCTION FOR REGULAR CARDS -->

<?php
}
function renderRegularCard($i, $post) {
?>
<div id="theBox" class="no-padding-left-mobile col-xs-12 col-xs-B-6 col-sm-6 col-md-4 col-lg-4">
<div class="flex-item blueTop eventsBox <?php if (get_field("listImg")) { echo "has-image";} else { echo "no-image"; } ?>" 
  onClick='location.href="<?php if((get_field("external_link") != "") && $post->post_type == 'spotlights'){ the_field("external_link");}else{ echo get_post_permalink();}  ?>"'
  >
       		<!-- INTERNAL CONTAINER TO CONTROL FOR OVERFLOW -->   
			 <div class="interiorCardContainer">
				 
				<!-- CHECKS FOR SPOTLIGHT -->   
				<?php if($post->post_type == 'spotlights'){ ?>
				<?php get_template_part('inc/spotlights'); ?>
		        <?php 	} ?><!-- SPOTLIGHT -->  
				
				<!-- CHECKS FOR IMAGE -->   
		        <?php
				if (get_field("listImg") != "" ) { ?>
		    	<?php get_template_part('inc/image'); ?>
		        <?php } ?><!-- .listImg -->  
		         
				<!-- CALLS TITLE FOR REGULAR/SPOTLIGHT POST-TYPES -->   
		        <?php get_template_part('inc/title'); ?>
		        <!-- TITLE -->  
		        
				<!-- CHECKS IF EVENT TYPE -->   
		        <?php if (get_field('event_date')){ ?>
		    	<?php get_template_part('inc/events'); ?>
		        <?php } ?><!-- EVENT -->
		    	
				<!-- CHECKS FOR SUBTITLE -->
		        <?php if (get_field('subtitle')){ ?>
		        	<?php get_template_part('inc/subtitle'); ?>
				<?php } ?><!-- .subtitle -->    	
		        
				<!-- CALLS FOR EXCERPT -->   
		        <?php get_template_part('inc/entry'); ?>
		
			</div> <!--.interiorCardBox -->  
				
                <!-- CALLS FOR FOOTER -->   
		        <?php get_template_part('inc/footer'); ?>

  </div><!--last-->
</div>
  <?php
  if (get_post_type( get_the_ID() ) == 'bibliotech') {
  ?>
  </div>

<!-- RENDER FUNCTION FOR EVENT CARDS -->

<?php
  }
}
function renderEventCard($i, $post) {
?>
  <div id="theBox" class="col-xs-12 col-xs-B-6 col-sm-6 col-md-4 col-lg-4">
    <div itemscope itemtype="http://data-vocabulary.org/Event" class="flex-item blueTop eventsBox <?php if (get_field("listImg")) { echo "has-image";} else { echo "no-image"; } ?>" onClick='location.href="<?php if((get_field("external_link") != "") && $post->post_type == 'spotlights'){ the_field("external_link");}else{ echo get_post_permalink();}  ?>"'>
   <!-- INTERNAL CONTAINER TO CONTROL FOR OVERFLOW -->   
			 <div class="interiorCardContainer">
				 
				<!-- CHECKS FOR IMAGE -->   
		        <?php
				if (get_field("listImg") != "" ) { ?>
		    	<?php get_template_part('inc/image'); ?>
		        <?php } ?><!-- .listImg -->  
		         
				<!-- CALLS TITLE FOR REGULAR/SPOTLIGHT POST-TYPES -->   
		        <?php get_template_part('inc/title'); ?>
		        <!-- TITLE -->  
		        
				<!-- CHECKS IF EVENT TYPE -->   
		        <?php if (get_field('event_date')){ ?>
		    	<?php get_template_part('inc/events'); ?>
		        <?php } ?><!-- EVENT -->
		    	
				<!-- CHECKS FOR SUBTITLE -->
		        <?php if (get_field('subtitle')){ ?>
		        	<?php get_template_part('inc/subtitleEvents'); ?>
				<?php } ?><!-- .subtitle -->    	
		        
				<!-- CALLS FOR EXCERPT -->   
		        <?php get_template_part('inc/entry'); ?>
		
			</div> <!--.interiorCardBox -->  
				
                <!-- CALLS FOR FOOTER -->   
		        <?php get_template_part('inc/catFooter'); ?>
  </div> <!-- close itemscope -->
</div> <!-- close eventsPage -->

<!-- RENDER FUNCTION FOR STICKY/FEATURED CARDS -->

<?php
}
function renderFeatureCard($i, $post) {
?>
  <div class="sticky  hidden-xs hidden-sm col-md-12 clearfix">
    <div class="no-padding-left-mobile sticky col-xs-3 col-xs-B-6 col-sm-8 col-lg-8 col-md-8" onClick='location.href="<?php echo get_post_permalink(); ?>"' style="padding-right:0px; padding-left:6px !important;" > <img src="<?php the_field("featuredListImg"); ?>" class="img-responsive" width="679" height="260" alt="<?php the_title();?>" /> </div>
    <div class=" hidden-xs bgWhite col-xs-12 col-xs-B-6 col-sm-4 col-md-4 col-lg-4" onClick='location.href="<?php if((get_field("external_link") != "") && $post->post_type == 'spotlights'){ the_field("external_link");}else{ echo get_post_permalink();}  ?>"'>
        
                <!-- CHECKS FOR SPOTLIGHT -->   
				<?php if($post->post_type == 'spotlights'){ ?>
				<?php get_template_part('inc/spotlights'); ?>
		        <?php 	} ?><!-- SPOTLIGHT -->  
		         
				<!-- CALLS TITLE FOR REGULAR/SPOTLIGHT POST-TYPES -->   
		        <?php get_template_part('inc/title'); ?>
		        <!-- TITLE -->  
		        
				<!-- CHECKS IF EVENT TYPE -->   
		        <?php if (get_field('event_date')){ ?>
		    	<?php get_template_part('inc/events'); ?>
		        <?php } ?><!-- EVENT -->
		    	
				<!-- CHECKS FOR SUBTITLE -->
		        <?php if (get_field('subtitle')){ ?>
		        	<?php get_template_part('inc/subtitle'); ?>
				<?php } ?><!-- .subtitle -->    	
		        
				<!-- CALLS FOR EXCERPT -->   
		        <?php get_template_part('inc/entry'); ?>
		
                <!-- CALLS FOR FOOTER --> 
		        <?php get_template_part('inc/catFooter'); ?>
   
  </div>
</div>
<?php 
} 
?>
