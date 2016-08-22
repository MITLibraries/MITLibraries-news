<?php
/**
 * This template loads additional Bibliotech posts if any exist.
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
	if ( '' == $offset ) {
		$offset = 10;
	}

	 $limit = htmlspecialchars( trim( $_GET['limit'] ) );
	if ( '' == $limit ) {
		$limit = 9;
	}



	$args = array(
	 	'post_type' => array( 'bibliotech' ),
	 	'post__not_in'   => array( 'sticky_posts' ),
	 	'ignore_sticky_posts' => 1,
		'offset'          => 10,
		'posts_per_page'  => $limit,
		'order'                  => 'DESC',
		'orderby'                => 'date',
		'suppress_filters' => false,


);
	$the_query = new WP_Query( $args );


?>
	
	
	<?php
// Removes button start.
$ajaxLength = $the_query->post_count;
?>
<?php if ( $ajaxLength < $limit ) { ?>
<script>
$("#another").hide();
</script>


<?php } // Removes button end. ?>
	
	
	
<?php if ( $the_query->have_posts() ) :  ?>

<?php
$i = -1;
while ( $the_query->have_posts() ) : $the_query->the_post();
$theLength = $my_query->post_count;
$i++;
?>

	<?php renderBiblioCard( $i, $post ); ?>
	
<?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
