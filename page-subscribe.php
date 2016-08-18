<?php
/**
 * Template Name: Subscribe
 *
 * @package MITLibraries-News
 * @since 1.0.0
 */

$pageRoot = getRoot( $post );
$section = get_post( $pageRoot );
$isRoot = $section->ID == $post->ID;



get_header(); ?>
	<div class="newsSubHeader clearfix">
<div class="innerPadding clearfix">
<div class="title-page no-padding-left col-xs-12  col-sm-12 col-md-5 col-lg-5">
	
	<?php if ( is_single( $post ) ) { ?>
		<h2 class="name-site2"><a href="/news/">News &amp; events</a></h2>
	  <?php }else { ?>
	
	<h1 class="name-site"><a href="/news/">News &amp; events</a>
	<?php
	if ( is_category() ) {
	 printf( '<span>' . ': ' . single_cat_title( '', false ) . '</span>' );
	}  ?>        
	</h1>
	
	<?php } ?>
	
	</div>   
<div class="socialNav singleSocialNav hidden-xs not_on_phone socialNav col-xs-12 col-sm-12 col-md-7  col-lg-7 clearfix ">

	<?php get_template_part( 'inc/social' ); ?>
</div>


<hr class="news hidden-xs col-sm-12 col-md-12 col-lg-12 clearfix">

</div><!--innerpadding-->
</div><!--news-->
</div>
<div class="clearfix">



	<?php while ( have_posts() ) : the_post(); ?>
		<div class="container">
		<div class="row">
		
			

		
<div class="col-xs-12 col-xs-B-12 col-xs-B-12 col-sm-9 col-lg-9">
	
			<div class="title-page">
				<?php if ( $isRoot ) : ?>
				<h2><?php echo $section->post_title; ?></h2>
				<?php else : ?>
				<h2><a href="<?php echo get_permalink( $section->ID ) ?>"><?php echo $section->post_title; ?></a></h2>
				<?php endif; ?>
			</div>
			
		
				
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="featuredImage">
			<?php echo the_post_thumbnail( 700, 300 ); ?>
		
		</div>	
		<?php endif; ?>
		
		
		<div class="entry-content">
			<?php if ( ! $isRoot ) : ?>
			<h2><?php the_title(); ?></h2>
			<?php endif; ?>
			<?php the_content(); ?>
			
		</div>
		

			
			</div>
	
	
	<div class="col-xs-12 col-xs-B-11 col-sm-3 col-md-3 col-lg-3">
<?php if ( ! dynamic_sidebar() ) : ?>
	
		<div id="sidebarContent" class="sidebar span3">
		<div class="sidebarWidgets">
			<?php dynamic_sidebar( 'subscribe' ); ?>
		</div>
	</div>		

<?php endif; ?>	


</div>
</div>
</div>
		<?php endwhile; // end of the loop. ?>
<div class="container">
<?php get_footer(); ?>