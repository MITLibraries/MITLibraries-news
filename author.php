<?php
/**
 * The template for displaying Author Archive pages.
 *
 * Used to display archive-type pages for posts by an author.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>

			<?php
				/* Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				 *
				 * We reset this later so we can run the loop
				 * properly with a call to rewind_posts().
				 */
				the_post();
			?>

			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Author Archives: %s', 'twentytwelve' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
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
			if ( get_the_author_meta( 'description' ) ) : ?>
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

			
			
            
            
			<?php while ( have_posts() ) : the_post(); ?>
				
               <div class="col-xs-12 col-sm-4 col-md-4">
      <div class="hentry flex-item blueTop eventsBox <?php if(has_post_thumbnail()){ echo "has-image"; }elseif (get_field("listImg")) { echo "has-image";} else { echo "no-image"; } ?>" onClick='location.href="<?php if((get_field("external_link") != "") && $post->post_type == 'spotlights'){ the_field("external_link");}else{ echo get_post_permalink();}  ?>"'>
   <?php if($post->post_type == 'spotlights'){ ?>
        <div class="featuredCol">Featured collection</div>
        <?php } ?>
        <?php if($post->post_type == 'spotlights'){ ?>
        <div class="featuredColImg"> <img src="/wp-content/themes/mit-libraries-news/images/info.png" alt="featured" width="31" height="27" /> </div>
        <?php } ?>
        <?php if (get_field('mark_as_new') === true): ?>
        <div class="newIcon"></div>
        <?php endif; ?>
        <?php
if (get_field("listImg") != "" ) { ?>
        <img src="<?php the_field("listImg") ?>" width="100%" height="111"  alt="<?php the_title(); ?>"/>
         <h2 class="entry-title title-post">
          <?php the_title(); ?>
        </h2>
            <!--/EVENT  DATE-->
        <?php if(get_field('event_date')){ 
				$date = DateTime::createFromFormat('Ymd', get_field('event_date'));
				
			?>
        <div class="event"><?php echo $date->format('F, j Y'); ?>&nbsp;&nbsp; &nbsp; <span class="time">
          <?php if( get_field('event_start_time') ){ 
			  		echo the_field('event_start_time'); 
					} ?>
          <?php if(( get_field('event_start_time') ) && ( get_field('event_end_time') )){
				  				 echo '-';
					} ?>
          <?php if( get_field('event_end_time') ){ 
			  		echo the_field('event_end_time'); 
			}  ?>
          </span> </div>
        <?php 	}	?>
        <!--EVENT --> 
        
        <div class="excerpt-post">
          <p class="entry-summary">
            <?php if (excerpt()) {
   				 echo excerpt(15);
					} elseif (content()){
     				  echo content(15);
					}
			?>
          </p>
        </div>
        
        
        
        
        <?php } elseif ( has_post_thumbnail() ) { 
$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
$thumb_url = $thumb_url_array[0];?>
        <img src="<?php echo $thumb_url; ?>" width="100%" height="200" />
         <h2 class="entry-title title-post">
          <?php the_title(); ?>
        </h2>
            <!--/EVENT  DATE-->
        <?php if(get_field('event_date')){ 
				$date = DateTime::createFromFormat('Ymd', get_field('event_date'));
				
			?>
        <div class="event"><?php echo $date->format('F, j Y'); ?>&nbsp;&nbsp; &nbsp; <span class="time">
          <?php if( get_field('event_start_time') ){ 
			  		echo the_field('event_start_time'); 
					} ?>
          <?php if(( get_field('event_start_time') ) && ( get_field('event_end_time') )){
				  				 echo '-';
					} ?>
          <?php if( get_field('event_end_time') ){ 
			  		echo the_field('event_end_time'); 
			}  ?>
          </span> </div>
        <?php 	}	?>
        <!--EVENT --> 
        
        <div class="excerpt-post">
          <p class="entry-summary">
            <?php if (excerpt()) {
   				 echo excerpt(15);
					} elseif (content()){
     				  echo content(15);
					}
			?>
          </p>
        </div>
        
        
        <!--final **** else-->
        <?php }else{  ?>
        <h2 class="entry-title title-postnoImg">
          <?php the_title(); ?>
        </h2>
        
  
        
         <!--/EVENT  DATE-->
        <?php if(get_field('event_date')){ 
				$date = DateTime::createFromFormat('Ymd', get_field('event_date'));
				
			?>
        <div class="event">

		<?php echo $date->format('F, j Y'); ?>&nbsp;&nbsp; &nbsp; <span class="time">
          <?php if( get_field('event_start_time') ){ 
			  		echo the_field('event_start_time'); 
					} ?>
          <?php if(( get_field('event_start_time') ) && ( get_field('event_end_time') )){
				  				 echo '-';
					} ?>
          <?php if( get_field('event_end_time') ){ 
			  		echo the_field('event_end_time'); 
			}  ?>
          </span> </div>
        <?php 	}	?>
        <!--EVENT --> 
        
       
        
        
        <div class="excerpt-post">
          <p class="entry-summary">
            <?php if (excerpt()) {
   				 echo excerpt(30);
					} elseif (content()){
     				  echo content(30);
					}
			?>
          </p>
        </div>
        
        <?php } ?>
        
        <div class="category-post">
          <?php 
				$category = get_the_category();     
				$rCat = count($category);
				$r = rand(0, $rCat -1);
				//echo $r;
				//echo "-";
				//echo $rCat; 
                
				//if($category[0]){
					
				echo '<a title="'.$category[$r]->cat_name.'"  title="'.$category[$r]->cat_name.'" href="'.get_category_link($category[$r]->term_id ).'">'.$category[$r]->cat_name.'</a>';
				
				//}
            ?>
            
          <span class="author vcard"><span class="fn"><?php echo get_the_author_link(); ?></span></span>
          <span class="mitDate"> <time class="updated"  datetime="<?php echo get_the_date(); ?>">&nbsp;&nbsp;<?php echo get_the_date(); ?></time></span> </div>
      </div>
     </div>
                
                
                
                
                
			<?php endwhile; ?>
            </div>
load more posts
			<?php // twentytwelve_content_nav( 'nav-below' ); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>