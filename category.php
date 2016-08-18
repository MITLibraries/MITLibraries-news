<?php
/**
 * The template for displaying archive-type pages for posts in a category.
 *
 * @package MITLibraries-News
 * @since Twenty Twelve 1.0
 */

get_header();



$date = DateTime::createFromFormat( 'Ymd', get_field( 'event_date' ) );
?>
<?php get_template_part( 'inc/sub-header' ); ?>


	<div id="content" role="main">
	<?php if ( have_posts() ) : ?>
	<div class="container container-fluid">
	  <div class="row">
	      <?php
	if ( is_category() ) {
	 printf( '<h1 class="lib-header">' . 'Category: ' . '<strong>' . single_cat_title( '', false ) . '</strong>' . '</h1>' );
	}  ?> 
		<?php
			/* Start the Loop */
			$i = -1;
			while ( have_posts() ) : the_post();
			$i++;
				renderRegularCard( $i, $post ); // --- CALLS REGULAR CARDS --- //
			?>
	
			<?php if ( get_post_type( get_the_ID() ) == 'bibliotech' ) { ?>
		   
			<?php } //get_post_type( get_the_ID() ) == 'bibliotech' ?>
			  
					<?php  wp_reset_query(); // Restore global post data stomped by the_post(). ?>
		   
					<?php endwhile; ?>
			
					<?php endif; ?>
	
			  </div>
			  <!--closes ROW-->
			  </div>
			  <!--closes NEWS-CONTAINER-->
	
	 <?php get_template_part( 'inc/more-posts' ); ?>
	</div>
	<!-- #content --> 
<!-- #primary -->
<script>
<?php
if ( is_category( ) ) {
	$cat = get_query_var( 'cat' );
	$yourcat = get_category( $cat );
	$category2 = get_category_by_slug( $yourcat->slug );
	$categoryID2 = $category2->cat_ID;
	}
?>
$(document).ready(function() {
	var offset = 21;
	var limit = 9;
	//$("#postContainer").load("/news/add-posts-category/");
	$("#another").click(function(){
		limit = limit+9;
		offset = offset+21;
		$("#postContainer")
			//.slideUp()
			.load("/news/add-posts-category/?offset="+offset+"&limit="+limit+"&categoryID="+<?php echo $categoryID2; ?>+"", function() {
			 //.load("/news/test/?offset="+offset, function() {
			   $(this).slideDown();
			   
			
			   $('#another').click(function() {
			  // alert($j(this).load());
	   });
			   
		});
		
	
			
		return false;
	});

});
</script>

<div class="container">
<?php get_footer(); ?>