<?php
/**
 * This template loads additional Events posts if any exist.
 *
 * @package MITLibraries-News
 * @since 1.0
 */

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

	$offset = htmlspecialchars( trim( $_GET['offset'] ) );
	if ( $offset == '' ) {
		$offset = 11;
	}

	 $limit = htmlspecialchars( trim( $_GET['limit'] ) );

	if ( $limit == '' ) {
		$limit = 18;
	}
?>
<?php
$date = DateTime::createFromFormat( 'Ymd', get_field( 'event_date' ) );
$args = array(

	'posts_per_page' => $limit,
	'ignore_sticky_posts' => true,
	'offset' => 9,

	'post_type' => 'post',
	'meta_query' => array(
	array(
	  'key' => 'is_event',
	  'value' => '1',
	  'compare' => '=',
	),
	array(
	  'key' => 'event_date',
	  'value' => date( 'Y-m-d' ),
	  'compare' => '<',
	  'type' => 'DATE',
	),
	),

	'meta_key' => 'event_date',
	'orderby' => array(
	'meta_value_num' => 'DESC',
	),

);

	$the_query = new WP_Query( $args );

// Removes button start.
$ajaxLength = $the_query->post_count;

if ( $ajaxLength < $limit ) {
?>
<script>
$("#another").hide();
</script>
<?php
}
// Removes button end.
if ( $the_query->have_posts() ) :
	$o = -1;
	while ( $the_query->have_posts() ) : $the_query->the_post();
	$o++;
	renderEventCard( $o, $post );
	endwhile;
endif;

wp_reset_query();  // Restore global post data stomped by the_post().

?>
