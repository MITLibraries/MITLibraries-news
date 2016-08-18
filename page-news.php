<?php
/**
 * Template Name: Bibliotech
 *
 * This template is used to display
 * latest News Posts
 *
 * @package MITLibraries-News
 * @since 1.0
 */

$pageRoot = getRoot( $post );
$section = get_post( $pageRoot );
$isRoot = $section->ID == $post->ID;
get_header(); ?>
<?php get_template_part( 'inc/sub-header' ); ?>



	  
	 <!-- OPEN CONTAINER FOR REGULAR CARD LAYOUT -->
				<div class="container container-fluid">
			
			<!-- OPEN ROW FOR REGULAR CARD LAYOUT -->
				<div class="row"> 
	                
	                <h1 class="events-header">News</h1>
	
		<?php

		$sticky = get_option( 'sticky_posts' );
		// args
		$args = array(
		'post_type'  				=> 'post',
		'post__not_in' => array($sticky),
			'posts_per_page'        => '9',
			'ignore_sticky_posts'   => true,
			'order'                 => 'DESC',
			'orderby'               => 'date',
					'meta_query'             => array(
							array(
								'key'       => 'is_event',
								'value'     => '1',
								'compare'   => '!=',
								'type'      => 'NUMERIC',
							),
						),

			);
			$the_query = new WP_Query( $args );
			?>
			   <?php
			if ( $the_query->have_posts() ) :
			// $theLength = $count_posts->publish;
			?>
	
	
			<?php
			$i = -1;
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				$i++;
				renderRegularCard( $i, $post ); // --- CALLS REGULAR CARDS --- //
		?>
	
	
		   
			  
		   
					<?php endwhile; ?>
			
					<?php endif; ?>
	   
	
			  </div>
			  <!--closes ROW-->

			  </div>
			  <!--closes CONTAINER-->

		<?php
			if ( $i > 6 ) {
				get_template_part( 'inc/more-posts' );
			}
		?>

					<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>


<script type="text/javascript">
$(document).ready(function() {
	var offset = 10;
	var limit = 0;
	$("#postContainer").load("/news/more-news-stories/");
	$("#another").click(function(){
		limit = limit+9;
		offset = offset+10;
		$("#postContainer")
			//.slideUp()
			.load("/news/more-news-stories/?offset="+offset+"&limit="+limit, function() {
			 //.load("/news/test/?offset="+offset, function() {
			   $(this).slideDown();
			   //$j("#another").remove();
			   
		});
			
		return false;
	});

});
</script>
<div class="container container-fluid">
<?php
	get_footer();
?>
