<?php
/**
 * Template Name: Last Year Archive
 *
 * @package MITLibraries-News
 * @since 1.0
 */

$pageRoot = getRoot( $post );
$section = get_post( $pageRoot );
$isRoot = $section->ID == $post->ID;
get_header(); ?>
<?php
the_excerpt_max_charlength( 140 );
function the_excerpt_max_charlength( $charlength ) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			return $subex;
		}
		echo '[...]' ;
	} else {
		return $excerpt;
	}
}

?>
<?php get_template_part( 'inc/sub-header' ); ?>

<div class="wrap-page">
<div id="primary" class="content-area">
	<main id="main" class="content-main" role="main">
	<?php
// query selects posts from the last 30-60 days
// aug - sept - oct
$args = array(
	'date_query' => array(

		array(

			'column' => 'post_date_gmt',
			'before' => '210 days ago',

		),
		array(

			'column' => 'post_date_gmt',
			'after'  => 'last year',

		),
	),
);

$the_query = new WP_Query( $args );


?>

	<div class="mit-container">
	  <?php if ( $the_query->have_posts() ) :   ?>
	  <?php while ( $the_query->have_posts() ) : $the_query->the_post();  ?>
	  <div class="flex-item eventsBox <?php if ( ! has_post_thumbnail() ) { echo 'no-image';
} else { echo 'has-image'; } ?>" onClick='location.href="<?php echo get_post_permalink(); ?>"'>
		<?php if ( get_field( 'mark_as_new' ) === true ) : ?>
		<?php endif; ?>
		<?php if ( has_post_thumbnail() ) {
$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'thumbnail-size', true );
$thumb_url = $thumb_url_array[0];

?>
		<img src="<?php echo $thumb_url; ?>" width="100%" height="200" />
		<?php	} 	?>
		<h2 class="title-post">
		  <?php the_title(); ?>
		</h2>
		<br />
		<div class="excerpt-post">
		  <?php the_excerpt_max_charlength( 140 ); ?>
		</div>
		<?php

				$mitDate = get_field( 'event_date' );
				// echo $mitDate;
				$mitDate = date( 'l t Y', strtotime( $mitDate ) );

			?>
		<div class="event"><?php echo $mitDate; ?>&nbsp;&nbsp; &nbsp; <span class="time">
		  <?php if ( get_field( 'event_start_time' ) ) {
			  			echo the_field( 'event_start_time' );
					} ?>
		  <?php if ( ( get_field( 'event_start_time' ) ) && ( get_field( 'event_end_time' ) ) ) {
				  				 echo '-';
					} ?>
		  <?php if ( get_field( 'event_end_time' ) ) {
			  				echo the_field( 'event_end_time' );
			  }
				?>
		  </span> </div>
		<!--EVENT --> 
		
		<!--/EVENT  DATE-->
		
		<div class="category-post">
		  <?php
			$category = get_the_category();
			if ( $category[0] ) {
			echo '<a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->cat_name . '</a>';
			}
			?>
		  <span class="mitDate">&nbsp;&nbsp;<?php echo get_the_date(); ?></span> </div>
	  </div>
	  <?php  // if($i % 3 == 0) {echo '</div><div class="mit-container"> ';}  ?>
	  <?php endwhile; else : ?>
	  
	  <!-- The very first "if" tested to see if there were any Posts to --> 
	  <!-- display.  This "else" part tells what do if there weren't any. -->
	  <p>
		<?php _e( 'Sorry, no posts matched your criteria.' ); ?>
	  </p>
	  <!-- REALLY stop The Loop. -->
	  <?php endif; ?>
	  <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
	</div>
	<!--closes flexcontainer--> 
	</main>
	<!-- #main --> 
</div>
<!-- #primary -->
<div class="moreBtn" style="">
	<?php get_template_part( 'inc/related' ); ?>
</div>
<?php get_footer(); ?>
