<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<style>
.leftNav{
display: -webkit-flex;
	display: flex;
	-webkit-flex-direction: row;
	flex-direction: row;
	-webkit-flex: 2 0 0;
	flex: 2 0 0;	
	}
.rightNav{
	
	display: -webkit-flex;
	display: flex;
	-webkit-flex-direction: row;
	flex-direction: row;
	-webkit-justify-content: flex-end;
	justify-content: flex-end;
	-webkit-flex: 2 0 0;
	flex: 2 0 0;}
</style>
<div class="newsSubHeader">
	<div class="wrap-page">
<div class="title-page flex-container">
	<h1 class="name-site">Search results for <strong><?php echo $_GET["s"] ?></strong></h1>
	<div class="flex-container">
		
<!-- Begin MailChimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/classic-081711.css" rel="stylesheet" type="text/css">
<style type="text/css">
	#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
	/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>






		   <?php
$defaults = array(
	'theme_location'  => '',
	'menu'            => 'subscribe',
	'container'       => '',
	'container_class' => '',
	'container_id'    => '',
	'menu_class'      => '',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s udClear">%3$s</ul>',
	'depth'           => 0,
	'walker'          => ''
);
wp_nav_menu( $defaults );
?>	    

		<a href="http://twitter.com/mitlibraries"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/twitter.jpg" /></a>
		<a href="http://libraries.mit.edu/facebook"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/facebook.jpg" /></a>
		<a href="https://plus.google.com/+mit/posts"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/google.jpg" /></a>
		<div class="search"><?php get_search_form('true'); ?></div>
	</div>
</div>

<hr class="news">

<div class="flex-container">
  <div class="leftNav">
    <div class="box-row newsNav">
	    
	   <?php
//main nav
$defaults = array(
	'theme_location'  => '',
	'menu'            => 'mainNav',
	'container'       => 'div',
	'container_class' => '',
	'container_id'    => '',
	'menu_class'      => 'menu',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s udClear">%3$s</ul>',
	'depth'           => 0,
	'walker'          => ''
);

wp_nav_menu( $defaults );

?>	    
    </div>
  </div>
  <div class="rightNav">
    <div class="box-row" style="width:330px;">
    </div>
  </div>
</div>
	</div><!--close div -->
</div><!--100%-->
<div style="background-color:rgb(233, 233, 233);" class="udClear">

<div class="wrap-page">
<div id="primary" class="content-area">
  <main id="main" class="content-main" role="main">
    <div class="container">
    <div class="row">
      <?php while (have_posts()) : the_post(); ?>
      <!--//////////// -->
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
				$category = get_the_category();     if($category[0]){
				echo '<a title="'.$category[0]->cat_name.'"  title="'.$category[0]->cat_name.'" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
				}
            ?>
            
          <span class="author vcard"><span class="fn"><?php echo get_the_author_link(); ?></span></span>
          <span class="mitDate"> <time class="updated"  datetime="<?php echo get_the_date(); ?>">&nbsp;&nbsp;<?php echo get_the_date(); ?></time></span> </div>
      </div>
     </div>
      
      <!--//////////// -->
      <?php endwhile;?>
    </div> <!--closeFLexContainer--> 
    </div><!--closes row-->
   
    
  </main>
  <!-- #main --> 
  
</div>

<!-- #primary -->

<?php get_footer(); ?>
