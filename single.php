<?php
/**
 * The template for displaying all single posts.
 *
 * @package MITLibraries-News
 * @since Twenty Twelve 1.0
 */

get_header();
$category = get_the_category();
	$type_post = get_post_type();
	$subtitle;
	$type;
?>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=mitlib" async="async"></script>
<?php get_template_part( 'inc/sub-headerSingle' ); ?>
<?php
if ( (get_post_type( get_the_ID() ) == 'bibliotech') || (cat_is_ancestor_of( 73, $cat ) or is_category( 73 )) ) {  ?>
<?php get_template_part( 'inc/bib-header' ); ?>
<?php  } ?>
<div class="container">
<div id="primary" class="content-area">
<main id="main" class="content-main" role="main">
<div class="row">
<?php while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-category="<?php echo $category[0]->slug; ?>">
	<div class="title-page  mySingle">     
	  <?php the_title( '<h1 class="entry-title single">', '</h1>' ); ?>
	  <?php if ( get_field( 'subtitle' ) ) { ?>
	  <h2 class="subtitle"><?php the_field( 'subtitle' ); ?></h2>
	  <?php } ?>
	  <div class="entry-meta"> <span class="author"> By
		<?php
		if ( get_field( 'pauthor' ) ) {
			the_field( 'pauthor' );
		} elseif ( get_field( 'bauthor' ) ) {
			the_field( 'bauthor' );
		} else {
			the_author_posts_link();
			}
		 ?>
		</span> <span class="date-post"> <?php echo ' on ';
the_date(); ?> </span>
		
		<?php if ( has_category() ) : ?>
		<span class="category-post-single"> in
		<?php
				$category = get_the_category();
				?>
			   
				 <?php
				$rCat = count( $category );

				$r = rand( 0, $rCat -1 );

				echo '<a title="' . $category[ $r ]->cat_name . '"  title="' . $category[ $r ]->cat_name . '" href="' . get_category_link( $category[ $r ]->term_id ) . '">' . $category[ $r ]->cat_name . '</a>';
			?>
		</span>
		<?php endif; ?>
	  </div> 
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<div class="addthis_sharing_toolbox"></div>
	<div class="clearfix"></div>
	<!-- .entry-meta --> 
	</div>
	<!-- .title-page -->  
	<div class="entry-content inlineHeader mitContent clearfix">
	
	
	
	<?php if ( get_field( 'event_date' ) ) {
				$date = DateTime::createFromFormat( 'Ymd', get_field( 'event_date' ) );

			?>
		  <!--EVENT --> 
		  <div class="single-page events">
	      <span class="gray">Event date</span><span class="bg-image"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px" x="0px" y="0px"
	 viewBox="-299 390 13 13" style="enable-background:new -299 390 13 13;" xml:space="preserve">
<style type="text/css">
	.st0{fill:#F58632;}
</style>
<g>
	<g id="XMLID_9_">
		<path id="XMLID_35_" class="st0" d="M-286.9,393.7v-0.8c0-0.4-0.4-0.8-0.8-0.8h-0.8v-0.8c0-0.4-0.4-0.8-0.8-0.8
			c-0.4,0-0.8,0.4-0.8,0.8v0.8h-4.8v-0.8c0-0.4-0.4-0.8-0.8-0.8c-0.4,0-0.8,0.4-0.8,0.8v0.8h-0.8c-0.4,0-0.8,0.4-0.8,0.8v0.8
			C-298.1,393.7-286.9,393.7-286.9,393.7z"/>
	</g>
	<g>
		<path id="XMLID_76_" class="st0" d="M-298.1,394.5v7.2c0,0.4,0.4,0.8,0.8,0.8h9.6c0.4,0,0.8-0.4,0.8-0.8v-7.2H-298.1z
			 M-294.9,400.9h-1.6v-1.6h1.6V400.9z M-294.9,397.7h-1.6v-1.6h1.6V397.7z M-291.7,400.9h-1.6v-1.6h1.6
			C-291.7,399.3-291.7,400.9-291.7,400.9z M-291.7,397.7h-1.6v-1.6h1.6C-291.7,396.1-291.7,397.7-291.7,397.7z M-288.5,400.9h-1.6
			v-1.6h1.6V400.9z M-288.5,397.7h-1.6v-1.6h1.6V397.7z"/>
	</g>
</g>
</svg></span>    
		  <span class="event"><?php echo $date->format( 'F j, Y' ); ?></span> 
		  <span class="time">
			<?php if ( get_field( 'event_start_time' ) ) {
			  		echo the_field( 'event_start_time' );
					} ?>
			<?php if ( ( get_field( 'event_start_time' ) ) && ( get_field( 'event_end_time' ) ) ) {
				  				 echo '-';
					} ?>
			<?php if ( get_field( 'event_end_time' ) ) {
			  		echo the_field( 'event_end_time' );
			}  ?>
			</span> 
		  
		   </div>
		  <?php 	} // End if(). ?>

	<!--=================image=================== -->       
	<?php if ( get_field( 'image' ) ) { ?>
	 <div class="mySinglePicMobile hidden-md hidden-lg col-xs-12">
	   <img data-original="<?php echo  get_field( 'image' );?> "width="100%" alt="<?php the_title(); ?>" class="thumbnail img-responsive"  /> 
	   <?php if ( get_field( 'caption' ) ) { ?>
	   <div class="mitCaption"><?php the_field( 'caption' );  ?></div>
	   <?php }  ?>
	 </div>
	 <?php } ?>
	<!--=================image=================== --> 	
	<!--=================image=================== -->  
	<?php if ( get_field( 'image' ) ) { ?>         
	  <div class="mySinglePic hidden-sm hidden-xs">
	   <img data-original="<?php echo  get_field( 'image' );?> "width="679" alt="<?php the_title(); ?>" class="thumbnail img-responsive"  /> 
		<?php if ( get_field( 'caption' ) ) { ?>
	   <div class="mitCaption"><?php the_field( 'caption' );  ?></div>
	   <?php }  ?>
	 </div>   
	  <?php } ?>   
	<!--=================image=================== --> 
	
	
	<?php the_content();  ?>
	
	
	<?php

			// Echo type of Feature, if Feature.
			if ( 'features' === $type_post ) {
				$type = get_field( 'feature_type' );
				echo 'The feature type is' . $type;
			}
			// Echo start/end dates, if they exist.
			if ( 'exhibits' === $type_post || 'updates' === $type_post ) {
				$date_start = get_field( 'date_start' );
				$date_end = get_field( 'date_end' );
				echo '<div>Start date is ' . $date_start . '</div>';
				echo '<div>End date is ' . $date_end . '</div>';
			} ?>
	</div>
	<!-- .entry-content -->
	</div> <!--close row-->
	</div><!--closes container that is open in the header to allow for the grey box fof the more in section -->
</article>
</div><!--trying to break that container-->
	<div style="background-color:rgb(233, 233, 233);padding-bottom:28px;border-top:4px solid rgb(224,224,224)">
	<div class="container">

<div class="row singleMargin">
	<div class="text-center moreIn"> More in <span class="lowercase"> <?php echo '<a title="' . $category[ $r ]->cat_name . '"  title="' . $category[ $r ]->cat_name . '" href="' . get_category_link( $category[ $r ]->term_id ) . '">' . $category[ $r ]->cat_name . '</a>'; ?></span>
	</div>
</div>
<?php wp_reset_postdata(); ?>
<?php wp_reset_query(); ?>
	<?php endwhile; // end of the loop. ?>
	<?php
$catName = $category[ $r ]->cat_name;
$currentPost = get_the_ID();


$myCatId = $category[ $r ]->cat_ID;

$args = array(
	'post_type' => array( 'post', 'bibliotech', 'spotlights' ),
	'cat'          => $myCatId,
	'posts_per_page'         => '3',
	'order'                  => 'DESC',
	'orderby'                => 'date',
	'post__not_in'       => array( $currentPost ),
);
	?>
	

<div class="row">
<?php
$myposts = get_posts( $args );
$y = 1 ;
foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
	
			  <?php renderRegularCard( $i, $post ); // --- CALLS REGULAR CARDS --- // ?>
	
	<?php
	$y = $y + 1;
	endforeach;
wp_reset_postdata();?>
	</div>
	</main>
	<!-- #main -->   
</div>
<!-- #primary -->

</div><!--greybackground 100% width-->
	<div style="background-color:rgb(233, 233, 233);">
<div class="container">
<?php get_footer(); ?>
