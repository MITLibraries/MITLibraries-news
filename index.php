<?php
/**
 * This is the main index of news posts, divided into two sections. The
 * first is for sticky posts, followed by everything else. The two sections
 * are separated into two adjacent div elements.
 *
 * @package WordPress
 * @subpackage MITLibraries-news
 * @since v1.3.0
 */

$pageRoot = getRoot( $post );
$section  = get_post( $pageRoot );
$isRoot   = $section->ID == $post->ID;

/**
 * The $post_count variable is used to record how many stories were loaded
 * on the initial page load (since the number of sticky stories is variable).
 * This is then passed to the pagination routine to ensure smooth progression
 * from the first to second pages.
 */
$post_count = 0;

get_header();

get_template_part( 'inc/sub-header' );

// This sets up the upper region of the list, for "Featured" posts.
?>
<div class="wrap-sticky">

	<!-- OPEN CONTAINER FOR MOBILE/STICKY CARD LAYOUT -->
	<div class="container container-fluid">

		<!-- OPEN ROW FOR MOBILE/STICKY CARD LAYOUT -->
		<div class="row">

			<h3 class="header-section sticky">Featured news</h3>
<?php

// This builds the query for the upper region.
$sticky = get_option( 'sticky_posts' );
$args   = array(
	'posts_per_page' => 7,
	'post__in' => $sticky,
	'post_type' => array(
		'spotlights',
		'bibliotech',
		'post',
	),
	'ignore_sticky_posts' => 1,
	'orderby' => 'post_date',
	'order' => 'DESC',
	'suppress_filters' => false,
);
$sticky_query = new WP_Query( $args );

if ( $sticky_query->have_posts() ) :
	$i = 1; // $i is a counter variable.
	while ( $sticky_query->have_posts() ) :
		$sticky_query->the_post();

		if ( 1 == $i ) {
			// The first card is rendered as a feature.
			renderMobileCard( $i, $post );
			renderFeatureCard( $i, $post );
		} else {
			// All other cards are rendered normally.
			renderRegularCard( $i, $post );
		}

		$i++;
		$post_count++;

	endwhile;

	// This resets the query.
	wp_reset_postdata();
	wp_reset_query();

endif;
?>
		</div> <!-- Closes row. -->
	</div> <!-- Closes container. -->
</div> <!-- Closes wrap-sticky. -->

<div class="wrap-regular">

	<!-- OPEN CONTAINER FOR REGULAR CARD LAYOUT -->
	<div class="container container-fluid">

		<!-- OPEN ROW FOR REGULAR CARD LAYOUT -->
		<div class="row">

<?php
$args = array(
	'posts_per_page' => 9,
	'post__not_in' => $sticky,
	'post_type' => array(
		'spotlights',
		'bibliotech',
		'post',
	),
	'ignore_sticky_posts' => 1,
	'orderby' => 'post_date',
	'order' => 'DESC',
	'suppress_filters' => false,
);

$standard_query = new WP_Query( $args );

if ( $standard_query->have_posts() ) :
	// $theLength = $count_posts->publish;
	$i = -1;
	while ( $standard_query->have_posts() ) :
		$standard_query->the_post();
		$i++;
		renderRegularCard( $i, $post ); // --- CALLS REGULAR CARDS --- //

		$post_count++;

	endwhile;

	wp_reset_query(); // Restore global post data stomped by the_post().

endif;
?>
		</div>
		<!--closes ROW-->

	</div>
	<!--closes NEWS-CONTAINER-->

<?php
if ( $i > 6 ) {
	get_template_part( 'inc/more-posts' );
} //$i > 6
?>

	</div>
</div>

<script>
$(document).ready(function() {
	var offset = <?php echo esc_js( $post_count ); ?>;
	var limit = 9;
	$("#postContainer").load("/news/test/");
	$("#another").click(function(){
		limit = limit+9;
		offset = offset+9;

		$("#postContainer")
			//.slideUp()
			.load("/news/test/?offset="+offset+"&limit="+limit, function() {
				//.load("/news/test/?offset="+offset, function() {
				$(this).slideDown();
			});

		return false;
	});
});
</script>

<div class="container container-fluid">
<?php get_footer(); ?>
