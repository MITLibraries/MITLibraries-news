<?php
/**
 * Template Name: Bibliotech
 *
 * This template is used to display
 * latest Bibliotech Posts
 *
 * @package MITLibraries-News
 * @since 1.0
 */

$pageRoot = getRoot( $post );
$section = get_post( $pageRoot );
$isRoot = $section->ID == $post->ID;
get_header(); ?>
<?php get_template_part( 'inc/sub-header' ); ?>
<?php get_template_part( 'inc/bib-header' ); ?>

	<!-- OPEN CONTAINER FOR MOBILE/STICKY CARD LAYOUT -->
				<div class="container container-fluid">
			
			<!-- OPEN ROW FOR MOBILE/STICKY CARD LAYOUT -->
				<div class="row">
<?php
$sticky = get_option( 'sticky_posts' );
$args = array(
	'posts_per_page'      => 1,
	'post__in'            => $sticky,
	'ignore_sticky_posts' => 1,
	'post_type' => 'bibliotech',
	'order'                  => 'DESC',
	'orderby'                => 'date',
	'suppress_filters' => false,
);
$query2 = new WP_Query( $args );
if ( $query2->have_posts() ) :
while ( $query2->have_posts() ) : $query2->the_post(); ?>
<?php if ( isset( $sticky[0] ) ) { ?>

	<!-- CALLS MOBILE CARDS -->
	<?php renderMobileBiblioCard( $i, $post ); ?>

	<!-- CALLS STICKY CARDS -->
	<?php renderFeatureCard( $i, $post ); ?>

	<!-- RESETS QUERY -->
	<?php wp_reset_postdata(); ?>

	<?php wp_reset_query(); ?>

<?php } // End if().
// Closes isset( $sticky[0] ). ?>
		 
					<?php endwhile; ?>
		
					<?php endif; ?> 
						<div class="container container-fluid">
			
			<!-- OPEN ROW FOR MOBILE/STICKY CARD LAYOUT -->
				<div class="row">  
	
			<?php
$args = array(
			'posts_per_page'      => 9,
			'post__not_in'        => get_option( 'sticky_posts' ),
			'ignore_sticky_posts' => 1,
			'post_type'       	  => 'bibliotech',
			'orderby'        	  => 'date',
			'order'          	  => 'DESC',
			'suppress_filters'    => false,
			);
$my_query = new WP_Query( $args );
$m = -1;
// Getting length.
$theLength = $my_query->post_count;
while ( $my_query->have_posts() ) {
$m++;
$my_query->the_post();
?>
	
	<?php renderBiblioCard( $i, $post ); ?>
					
	<?php } ?>
	</div>
	<!--closeMITContainer-->
	<?php


	if ( $theLength > 8 ) {

			get_template_part( 'inc/more-posts' );

		} ?> 
</div>
<script>
$(document).ready(function() {
	var theLength = "<?php echo $theLength; ?>";
	var offset = 11;
	var limit = 9;
	//$("#postContainer").load("/news/add-bibliotech-posts/");
	$("#another").click(function(){
		limit = limit+9;
		offset = offset+11;
		$("#postContainer")
			//.slideUp()
			.load("/news/add-bibliotech-posts/?offset="+offset+"&limit="+limit, function() {
			 //.load("/news/test/?offset="+offset, function() {
			   $(this).slideDown();
			   
				
				
			   
		});
		
	
			
		return false;
	});

});
</script>
<div class="container">
<?php get_footer(); ?>
