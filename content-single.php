<?php
/**
 * The template for displaying content of a single post.
 *
 * @package MITLibraries-News
 * @since 1.0.0
 */

	$category = get_the_category();
	$type_post = get_post_type();
	$subtitle;
	$type;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-category="<?php echo $category[0]->slug; ?>">
	<div class="title-page  mySingle">
		<?php if ( get_field( 'mark_as_new' ) === true ) : ?>
		<span>New!</span>
		<?php endif; ?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		

		<div class="entry-meta">
			<span class="author">
				By <?php the_author_posts_link(); ?>
			</span>
			<span class="date-post">
				<?php echo ' on '; the_date(); ?>
			</span>
			<?php if ( has_category() ) : ?>
			<span class="category-post">
		   
				<?php
$category = get_the_category();
?>
				
				
				
			 
				<?php //echo ' in ' . array_slice($category, 0, 2); ?>
			</span>
			<?php endif; ?>
		</div><!-- .entry-meta -->
	</div><!-- .title-page -->

	<div class="entry-content mitContent">
	
		
		 <?php
			the_content();
			// Echo type of Feature, if Feature
			if ( $type_post === 'features' ) {
				$type = get_field( 'feature_type' );
				echo 'The feature type is' . $type;
			}
			// Echo start/end dates, if they exist
			if ( $type_post === 'exhibits' || $type_post === 'updates' ) {
				$date_start = get_field( 'date_start' );
				$date_end = get_field( 'date_end' );
				echo '<div>Start date is ' . $date_start . '</div>';
				echo '<div>End date is ' . $date_end . '</div>';
			} ?>
			
			
			<?php

			$date = DateTime::createFromFormat( 'Ymd', get_field( 'event_date' ) );
			//echo $date->format('d-m-Y');





			// Check for events
			if ( $type_post == 'post' && get_field( 'is_event' ) == 1 ) { ?>
			
			<div class="event"><span class="grey">Event date </span> <?php echo $date->format( 'F, j Y' ); ?><span class="grey"> starting at</span> <?php echo  get_field( 'event_start_time' ); ?> <span class="grey"><?php if ( get_field( 'event_end_time' ) != '' ) { ?> and ending at</span> <?php echo get_field( 'event_end_time' ); }?></div>
				
		
			<?php
								}
		?>
			

	</div><!-- .entry-content -->

</article><!-- #post-## -->
