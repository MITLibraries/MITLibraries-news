<?php
/**
 * This template loads additional Posts from search-results page if any exist.
 * Template Name: Additional Posts - Search
 *
 * @package MITLibraries-News
 * @since 1.0
 */

?>

<?php
/**
 * This sets the is_search flag to true.
 *
 * @param object $q The query object.
 */
function set_search( $q ) {
	$q->set( 'is_search', true );
}

?>
<script type="text/javascript">
$(document).ready(function() {
	$("img.img-responsive").lazyload({ 
	effect : "fadeIn", 
	effectspeed: 450 ,
	failure_limit: 999999
	}); 
});	
</script>
<?php
$date = DateTime::createFromFormat( 'Ymd', get_field( 'event_date' ) );
?>
<?php

	$offset = htmlspecialchars( trim( $_GET['offset'] ) );
	if ( '' == $offset ) {
		$offset = 9;
	}

	 $limit = htmlspecialchars( trim( $_GET['limit'] ) );
	if ( '' == $limit ) {
		$limit = 9;
	}

// Build $search_args based on passed parameters
// Based on https://codex.wordpress.org/Creating_a_Search_Page.
$query_args = explode( '&', $_SERVER['QUERY_STRING'] );
$search_args = array(
	'posts_per_page' => $limit,
);

foreach ( $query_args as $key => $string ) {
	$query_split = explode( '=', $string );
	$search_args[ $query_split[0] ] = urldecode( $query_split[1] );
	if ( 'search' == $query_split[0] ) {
	$search_args['s'] = urldecode( $query_split[1] );
	}
} // foreach

$the_query = new WP_Query( $search_args );
// The set_search() function is defined above.
set_search( $the_query );


// Removes button start.
$ajaxLength = $the_query->post_count;
?>
<?php if ( $ajaxLength < $limit ) { ?>
<script>
$("#another").hide();
</script>
<?php }
// Removes button end. ?>



<?php if ( $the_query->have_posts() ) :  ?>


<?php
$o = -1;

while ( $the_query->have_posts() ) : $the_query->the_post();
	$o++;
?>


	<div id="theBox" class="<?php if ( 0 == $o % 3 ) { echo 'third '; } ?> col-xs-12  col-xs-B-6 col-sm-4 col-md-4 no-padding-left-mobile">
	  <div class="flex-item blueTop  eventsBox <?php echo esc_attr( check_image() ); ?>"
		onClick='location.href="<?php if ( ( '' != get_field( 'external_link' ) ) && 'spotlights' == $post->post_type ) { the_field( 'external_link' );
} else { echo get_post_permalink();}  ?>"'> 
		<?php get_template_part( 'inc/spotlights' ); ?>
	   
		<?php
		if ( get_field( 'listImg' ) != '' ) { ?>
		<img data-original="<?php the_field( 'listImg' ) ?>" width="100%" height="111" class="img-responsive"  alt="<?php the_title(); ?>"/>
		<?php } ?>
		
		
		<h2 class="entry-title title-post  <?php if ( 'spotlights' == $post->post_type ) { echo 'spotlights'; } ?>">
		  <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
		</h2>
		
		
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
	   echo "<div class='biblioPadding'>&nbsp;<a href='/news/bibliotech/' title='Bibliotech'>Bibliotech</a>"; ?>
	   
	    <span class="mitDate">
		  <time class="updated"  datetime="<?php echo get_the_date(); ?>">&nbsp;&nbsp;<?php echo get_the_date(); ?></time>
		  </span> </div> 
	  </div>
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
	</div>
	<!--close div that opens in bilbio if statement-->
	<?php } ?>
<?php
endwhile;
else :
endif;
wp_reset_query();  // Restore global post data stomped by the_post(). ?>
