<?php
/**
 * Template Name: Test Template
 *
 * @package MITLibraries-News
 * @since 1.0.0
 */

get_header();
?>

<?php get_template_part( 'inc/sub-header' ); ?>



<div class="news-site container">
	<section class="bgGrey">
	
	<?php
$sticky = get_option( 'sticky_posts' );
$args = array(
	'posts_per_page'      => 1,
	'post__in'            => $sticky,
	'ignore_sticky_posts' => 1,
	'orderby'   	=> 'menu_order',
	'order'     	=> 'ASC',
	'suppress_filters' => false,
);
$query2 = new WP_Query( $args );
if ( $query2->have_posts() ) :
	while ( $query2->have_posts() ) : $query2->the_post(); ?>

<?php if ( isset( $sticky[0] ) ) { ?>
	<div class="row">
			  <div class="col-md-8" onClick='location.href="<?php echo get_post_permalink(); ?>"' style="padding-right:0px;" > <?php echo get_currentuserinfo(); ?>

					<img src="<?php the_field( 'featuredListImg' ) ?> "width="679" height="256" alt="<?php the_title(); ?>" /> 
			 </div>
	  		<div class="bgWhite col-xs-12 col-sm-4 col-md-4" onClick='location.href="<?php echo get_post_permalink(); ?>"'>
			 <h2><?php the_title();?> </h2>
		
		<?php if ( get_field( 'event_date' ) ) {  $mitDate = get_field( 'event_date' );
$mitDate = date( 'l t Y', strtotime( $mitDate ) ); ?>
		<div class="event"><?php echo $mitDate; ?>&nbsp;&nbsp; &nbsp; <span class="time">
		  <?php if ( get_field( 'event_start_time' ) ) {
			  			echo the_field( 'event_start_time' );
					} ?>
		  <?php if ( ( get_field( 'event_start_time' ) ) && ( get_field( 'event_end_time' ) ) ) {
				  				 echo '-';
					} ?>
		  <?php if ( get_field( 'event_end_time' ) ) {
			  				echo the_field( 'event_end_time' );
			}  ?>
		  </span> </div>
		<?php 	}	?>
		<!--EVENT --> 
		
		<!--/EVENT  DATE-->
		
		<div class="excerpt-post">
		  <p>
			<?php if ( excerpt() ) {
					 echo excerpt( 20 );
					} elseif ( content() ) {
	 				  echo content( 20 );
					}
			?>
		  </p>
		</div>
		<div class="category-post">
		  <?php
$category = get_the_category();
if ( $category[0] ) {
echo '<a title="' . $category[0]->cat_name . '" href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->cat_name . '</a>';
}
?>
		  <span class="mitDate">&nbsp;&nbsp;<?php echo get_the_date(); ?></span> 
		  <!--echo all the cat --> 
		  
		</div>
	  </div>
	</div>
	<?php wp_reset_postdata(); ?>
	<?php wp_reset_query(); ?>
	  <?php  } ?>
	<?php endwhile; ?>
	 <?php endif; ?>
	
	
	
	
	
	<div>
	
	
	
	  <?php
$args = array(
	'posts_per_page'      => 9,
	'post_type' => array( 'Spotlights','bibliotech', 'post' ),
	'post__not_in'            => get_option( 'sticky_posts' ),
	'ignore_sticky_posts' => 1,
	'orderby'   	=> 'menu_order',
	'order'     	=> 'ASC',
	'suppress_filters' => false,

);
$the_query = new WP_Query( $args );


?>
	
	
	
	
	
	
	<div class="row">
	  <?php if ( $the_query->have_posts() ) :  ?>
	  <?php
	  while ( $the_query->have_posts() ) : $the_query->the_post();


	  ?>
	<div class="col-xs-12 col-sm-4 col-md-4">
	  <div class="hentry flex-item blueTop eventsBox <?php if ( has_post_thumbnail() ) { echo 'has-image';
} elseif ( get_field( 'listImg' ) ) { echo 'has-image';
} else { echo 'no-image'; } ?>" onClick='location.href="<?php if ( (get_field( 'external_link' ) != '') && $post->post_type == 'spotlights' ) { the_field( 'external_link' );
} else { echo get_post_permalink();}  ?>"'>
	<?php if ( $post->post_type == 'spotlights' ) { ?>
		<div class="featuredCol">Featured collection</div>
		<?php } ?>
		<?php if ( $post->post_type == 'spotlights' ) { ?>
		<div class="featuredColImg"> <img src="/wp-content/themes/mit-libraries-news/images/info.png" alt="featured" width="31" height="27" /> </div>
		<?php } ?>
		<?php if ( get_field( 'mark_as_new' ) === true ) : ?>
		<div class="newIcon"></div>
		<?php endif; ?>
		<?php
if ( get_field( 'listImg' ) != '' ) { ?>
		<img src="<?php the_field( 'listImg' ) ?>" width="100%" height="111"  alt="<?php the_title(); ?>"/>
		 <h2 class="entry-title title-post"><?php  the_title(); ?></h2>
			<!--/EVENT  DATE-->
		<?php if ( get_field( 'event_date' ) ) {
				$date = DateTime::createFromFormat( 'Ymd', get_field( 'event_date' ) );

			?>
		<div class="event"><?php echo $date->format( 'F, j Y' ); ?>&nbsp;&nbsp; &nbsp; <span class="time">
		  <?php if ( get_field( 'event_start_time' ) ) {
			  		echo the_field( 'event_start_time' );
					} ?>
		  <?php if ( ( get_field( 'event_start_time' ) ) && ( get_field( 'event_end_time' ) ) ) {
				  				 echo '-';
					} ?>
		  <?php if ( get_field( 'event_end_time' ) ) {
			  		echo the_field( 'event_end_time' );
			}  ?>
		  </span> </div>
		<?php 	}	?>
		<!--EVENT --> 
		
		<div class="excerpt-post">
		  <p class="entry-summary">
	<?php
			$newsTitle = get_the_content();
		$newsTitle = strlen( $newsTitle );


		if ( ($newsTitle >= 50) && has_excerpt( $post->ID ) ) {
						echo excerpt( 30 );
					echo 'excertp greater then';


			}


		?>  
		  
		   
		  </p>
		</div>
		
		
		
		
		<?php } elseif ( has_post_thumbnail() ) {
$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'thumbnail-size', true );
$thumb_url = $thumb_url_array[0];?>
		<img src="<?php echo $thumb_url; ?>" width="100%" height="200" />
		 <h2><?php the_title();  ?> </h2>
			<!--/EVENT  DATE-->
		<?php if ( get_field( 'event_date' ) ) {
				$date = DateTime::createFromFormat( 'Ymd', get_field( 'event_date' ) );

			?>
		<div class="event"><?php echo $date->format( 'F, j Y' ); ?>&nbsp;&nbsp; &nbsp; <span class="time">
		  <?php if ( get_field( 'event_start_time' ) ) {
			  		echo the_field( 'event_start_time' );
					} ?>
		  <?php if ( ( get_field( 'event_start_time' ) ) && ( get_field( 'event_end_time' ) ) ) {
				  				 echo '-';
					} ?>
		  <?php if ( get_field( 'event_end_time' ) ) {
			  		echo the_field( 'event_end_time' );
			}  ?>
		  </span> </div>
		<?php 	}	?>
		<!--EVENT --> 
		
		<div class="excerpt-post">
		  <p class="entry-summary">
			<?php if ( excerpt() ) {
					 echo excerpt( 15 );
					} elseif ( content() ) {
	 				  echo content( 15 );
					}
			?>
		  </p>
		</div>
		
		
		<!--final **** else-->
		<?php } else {  ?>
		<h2 class="entry-title title-postnoImg"> <?php the_title();?> </h2>
		
	
		
		 <!--/EVENT  DATE-->
		<?php if ( get_field( 'event_date' ) ) {
				$date = DateTime::createFromFormat( 'Ymd', get_field( 'event_date' ) );

			?>
		<div class="event">

		<?php echo $date->format( 'F, j Y' ); ?>&nbsp;&nbsp; &nbsp; <span class="time">
		  <?php if ( get_field( 'event_start_time' ) ) {
			  		echo the_field( 'event_start_time' );
					} ?>
		  <?php if ( ( get_field( 'event_start_time' ) ) && ( get_field( 'event_end_time' ) ) ) {
				  				 echo '-';
					} ?>
		  <?php if ( get_field( 'event_end_time' ) ) {
			  		echo the_field( 'event_end_time' );
			}  ?>
		  </span> </div>
		<?php 	}	?>
		<!--EVENT --> 
		
	   
		
		
		<div class="excerpt-post">
		  <p class="entry-summary">
			<?php if ( excerpt() ) {
					 echo excerpt( 30 );
					} elseif ( content() ) {
	 				  echo content( 30 );
					}
			?>
		  </p>
		</div>
		
		<?php } ?>
		
		<div class="category-post <?php  if ( get_post_type( get_the_ID() ) == 'bibliotech' ) { echo 'Bibliotech';} ?>">
		
		 <?php
	if ( get_post_type( get_the_ID() ) == 'bibliotech' ) {
	   echo "<div class='bilbioImg'><img src='wp-content/themes/mit-libraries-news/images/bilbioTechIcon.png' alt='bilbiotech icon' width='30' height='32' /></div>";
	   echo "<div class='biblioPadding'>&nbsp;<a href='/news/bibliotech/' title='Bibliotech'>Bibliotech</a>";


	  } else {



				$category = get_the_category();


				$rCat = count( $category );
				$r = rand( 0, $rCat -1 );
				echo '<a title="' . $category[ $r ]->cat_name . '"  title="' . $category[ $r ]->cat_name . '" href="' . get_category_link( $category[ $r ]->term_id ) . '">' . $category[ $r ]->cat_name . '</a>';

	  }
			?>
			
	
		  <span class="mitDate"> <time class="updated"  datetime="<?php echo get_the_date(); ?>">&nbsp;&nbsp;<?php echo get_the_date(); ?></time></span> </div>
	  </div>
	 </div> 
	 
	<?php  if ( get_post_type( get_the_ID() ) == 'bibliotech' ) { ?>   
	 </div><!--close div that opens in bilbio if statement-->
<?php } ?>	  
	
	

	 
	 
	  <?php endwhile; ?>
	  <?php endif; ?>
	  <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
	</div>
	</div><!--closes ROW-->
	</section>
</div>
<div class="container">
<div id="postContainer" class="row" style="display:none">... loading ...</div>

<div class="moreBtn">
	<button id="another">Show more</button>
</div>
</div>

<script>
var $j = jQuery.noConflict(); 
$j(function(){
	var offset = 9;
	var limit = 9;
	$j("#postContainer").load("/news/test/");
	$j("#another").click(function(){
		limit = limit+9;
		offset = offset+9;
		$j("#postContainer")
			//.slideUp()
			.load("/news/test/?offset="+offset+"&limit="+limit, function() {
			 //.load("/news/test/?offset="+offset, function() {
			   $j(this).slideDown();
			   //$j("#another").remove();
			   
		});
			
		return false;
	});

});
</script>
<?php
	get_footer();
?>
