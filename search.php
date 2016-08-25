<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package MITLibraries-News
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
<?php get_template_part( 'inc/sub-header' ); ?>




<div id="primary" class="content-area">
	<main id="main" class="content-main" role="main">
	<div class="container">
	<div class="row">
	
	<h2 class="search">Search results for <strong><?php echo $_GET['s'] ?></strong></h2>

	 <?php  if ( '' == $post ) { ?>
		
		
		
	 <?php	echo "<p class='search'>" . "Sorry, we didn't find anything matching your search. Please try a different search term." . '</p>' ; ?>
		
		
	
	
	<?php	} ?>
		
	
		
	  <?php

	  	$L = -1;
	   	// $theLength = $count_posts->publish;
	 	 while ( have_posts() ) : the_post();
$L++;
	  	?>
	  <!--//////////// -->
	  <div id="theBox" class="<?php if ( 0 == $L % 3 ) { echo 'third '; } ?>col-xs-12 col-xs-B-6 col-sm-4 col-md-4 col-lg-4 no-padding-left-mobile">
	  <div class="hentry flex-item blueTop  eventsBox <?php if ( get_field( 'listImg' ) ) { echo 'has-image';
} else { echo 'no-image'; } ?>" onClick='location.href="<?php if ( ( '' != get_field( 'external_link' ) ) && 'spotlights' == $post->post_type ) { the_field( 'external_link' );
} else { echo get_post_permalink();}  ?>"'>
		  
		  
		  <?php get_template_part( 'inc/spotlights' ); ?>
	   
		<?php
		if ( get_field( 'listImg' ) != '' ) { ?>
		<img data-original="<?php the_field( 'listImg' ) ?>" width="100%" height="111" class="img-responsive"  alt="<?php the_title(); ?>"/>
		<?php } ?>
		
		
	   <?php if ( 'spotlights' == $post->post_type ) { ?>
			 <h2 class="entry-title title-post spotlights">
		  <a href="<?php the_field( 'external_link' ); ?>"><?php the_title();?></a>
		</h2> 
		<?php } else { ?>
		<h2 class="entry-title title-post">
		  <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
		</h2>
		<?php 	} ?>
		
		
		 <?php get_template_part( 'inc/events' ); ?>
		
		<?php get_template_part( 'inc/entry' ); ?>

		<!--final **** else-->
		<?php {  ?>
		<!--EVENT -->
		<?php } ?>
	<div class="category-post <?php  if ( get_post_type( get_the_ID() ) == 'bibliotech' ) { echo 'Bibliotech';} ?>">
<?php
	if ( get_post_type( get_the_ID() ) == 'bibliotech' ) {
	   echo "<div class='bilbioImg bilbioTechIcon'>
	   </div>";
	   echo "<div class='biblioPadding'>&nbsp;<a href='/news/bibliotech-index/' title='Bibliotech'>Bibliotech</a>"; ?>
	   
	    <span class="mitDate">
		  <time class="updated"  datetime="<?php echo get_the_date(); ?>">&nbsp;&nbsp;<?php echo get_the_date(); ?></time>
		  </span> </div> 
	  
	<?php 	  } else {
				$category = get_the_category();
				$rCat = count( $category );
				$r = rand( 0, $rCat -1 );
				echo '<a title="' . $category[ $r ]->cat_name . '"  title="' . $category[ $r ]->cat_name . '" href="' . get_category_link( $category[ $r ]->term_id ) . '">' . $category[ $r ]->cat_name . '</a>'; ?>
	 
		  <span class="mitDate">
		  <time class="updated"  datetime="<?php echo get_the_date(); ?>">&nbsp;&nbsp;<?php echo get_the_date(); ?></time>
		  </span> </div> 
		<?php  } ?>
	   </div><!--last-->
	</div>
	<?php  if ( get_post_type( get_the_ID() ) == 'bibliotech' ) { ?>
	</div><!--this div closes the open div in biblio padding-->
	<?php } ?>
	  
	  <!--//////////// -->
	  <?php endwhile;?>
	</div> <!--closeFLexContainer--> 
	</div><!--closes row-->

<?php
	if ( $L > 7 ) {

			get_template_part( 'inc/more-posts' );

		} ?> 


	
	</main>
	<!-- #main --> 
	
</div>
<script type="text/javascript">
$(document).ready(function() {
	var offset = 9;
	var limit = 0;
	var car = "<?php echo $_GET[ s ]; ?>";
	var car = encodeURIComponent(car);
	$("#another").click(function(){
	limit = limit + 18;
	$("#postContainer")
	  .load("/news/search-results/?offset="+offset+"&limit="+limit+"&search="+car, function() {
		$(this).slideDown();
	  });
	return false;
	});
});
</script>

<!-- #primary -->
	<div class="container">
<?php get_footer(); ?>
