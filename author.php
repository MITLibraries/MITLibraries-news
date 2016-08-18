<?php
/**
 * The template for displaying archive-type pages for posts by an author.
 *
 * @package MITLibraries-News
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<?php get_template_part( 'inc/sub-header' ); ?>


		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>
		    <div class="container">
	  <div class="row">

			<?php
				/* Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				 *
				 * We reset this later so we can run the loop
				 * properly with a call to rewind_posts().
				 */
				the_post();
			?>

			<header class="author-archive-header">
				<h1 class="lib-header"><?php printf( 'Author: ' . '<strong>' . get_the_author( '', false ) . '</strong>' ); ?></h1>
			</header><!-- .archive-header -->

			<?php
				/* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();
			?>

			<?php twentytwelve_content_nav( 'nav-above' ); ?>

			<?php
			// If a user has filled out their description, show a bio on their entries.
/*			if ( get_the_author_meta( 'description' ) ) : ?>
			<div class="author-info">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentytwelve_author_bio_avatar_size', 60 ) ); ?>
				</div><!-- .author-avatar -->
				<div class="author-description">
					<h2><?php printf( __( 'About %s', 'twentytwelve' ), get_the_author() ); ?></h2>
					<p><?php the_author_meta( 'description' ); ?></p>
				</div><!-- .author-description	-->
			</div><!-- .author-info -->
			<?php endif; ?>

			<?php /* Start the Loop */ ?>
			<div class="row">

			
			
			
				
			<?php
			$i = -1;
			while ( have_posts() ) : the_post();
			$i ++;
			?>
				
				   <div id="theBox" class="<?php if ( $i % 3 == 0 ) { echo 'third '; } ?>no-padding-left-mobile col-xs-12 col-xs-B-6 col-sm-4 col-md-4 col-lg-4">
	  <div class="flex-item blueTop  eventsBox <?php if ( get_field( 'listImg' ) ) { echo 'has-image';
} else { echo 'no-image'; } ?>" onClick='location.href="<?php if ( (get_field( 'external_link' ) != '') && $post->post_type == 'spotlights' ) { the_field( 'external_link' );
} else { echo get_post_permalink();}  ?>"'>
		  
		  
		  <?php get_template_part( 'inc/spotlights' ); ?>
	   
		<?php
		if ( get_field( 'listImg' ) != '' ) { ?>
		<img data-original="<?php the_field( 'listImg' ) ?>" width="100%" height="111" class="img-responsive"  alt="<?php the_title();?>"/>
		<?php } ?>
		
		
	   <?php if ( $post->post_type == 'spotlights' ) { ?>
			 <h2 class="entry-title title-post spotlights">
		  <a href="<?php the_field( 'external_link' ); ?>"><?php the_title();?></a>
		</h2> 
		<?php } else { ?>
		<h2 class="entry-title title-post">
		  <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
		</h2>
		<?php 	} ?>
		
		
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
	   echo "<div class='biblioPadding'>&nbsp;<a href='/news/bibliotech/' title='Bibliotech'>Bibliotech</a>";
	 	  } else {
				$category = get_the_category();
				$rCat = count( $category );
				$r = rand( 0, $rCat -1 );
				echo '<a title="' . $category[ $r ]->cat_name . '"  title="' . $category[ $r ]->cat_name . '" href="' . get_category_link( $category[ $r ]->term_id ) . '">' . $category[ $r ]->cat_name . '</a>';
	  } ?>
		  <span class="mitDate">
		  <time class="updated"  datetime="<?php echo get_the_date(); ?>">&nbsp;&nbsp;<?php echo get_the_date(); ?></time>
		  </span> </div>
	  </div><!--last-->
	</div>
	<?php  if ( get_post_type( get_the_ID() ) == 'bibliotech' ) { ?>
	</div><!--this div closes the open div in biblio padding-->
	<?php } ?>
				
				
				
				
				
			<?php endwhile; ?>
			</div>

			<?php // twentytwelve_content_nav( 'nav-below' ); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
		    </div>
		    </div>
		</div><!-- #content -->

<div class="container">
<?php get_footer(); ?>
