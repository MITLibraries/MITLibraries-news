<div class="newsSubHeader">
<div class="container">
<div class="title-page row">
 <div class="col-xs-12  col-sm-6  col-sm-6  col-md-6 col-lg-6">
    <?php if( is_single($post)){ ?>
    	<h2 class="name-site2">News &amp; events</h2>
      <?php }else{ ?>
    <h1 class="name-site">News &amp; events
	<?php 
	if(is_category()){
	 printf('<span>'. ': ' . single_cat_title( '', false ) . '</span>' ); 
	}  ?>        
    </h1>
   <?php } ?>
  </div>
   
  
 <div class="socialNav col-xs-12  col-sm-push-1 col-sm-6  col-sm-6 col-md-push-1  col-md-6 col-lg-push-1 col-lg-6 clearfix "> 
   <?php
$defaults = array(
	'theme_location'  => '',
	'menu'            => 'subscribe',
	'container'       => '<div>',
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
 <ul class="anotherMenu clearfix">
 <li>

		<a href="http://twitter.com/mitlibraries" class="twitterLink"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/twitter.jpg" /></a>
        </li>
        
        <li>
    
		<a href="http://libraries.mit.edu/facebook" class="facebookLink"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/facebook.jpg" /></a>
    	</li>
	<?php /*?>	<a href="https://plus.google.com/+mit/posts"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/google.jpg" /></a><?php */?>
   
     <li>
   <?php get_search_form('true'); ?>
   </li>
   
   </ul>


</div><!--row ends-->
</div><!--container ends-->
<hr class="news">
<div class="container subNavH">
  <div class="row">
    <div class="col-xs-6  col-sm-6  col-sm-6  col-md-6 col-lg-6  newsNav">
<?php
//main nav
$defaults = array(
	'theme_location'  => '',
	'menu'            => 'mainNav',
	'container'       => 'nav',
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
	'items_wrap'      => '<ul id="%1$s" class="%2$s udClear nav nav-pills" role="tablist">%3$s</ul><a href="#" id="pull">Menu</a>',
	'depth'           => 0,
	'walker'          => ''
);

wp_nav_menu( $defaults );
?>	    
    </div>
 
 

 
    <div class="col-xs-6  col-sm-6  col-sm-6  col-md-6 col-lg-6 catNav">

<ul>


<li id="categories">
		<form id="category-select" class="category-select" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">

		<?php
		$args = array(
			'show_option_none' => __( 'Category' ),
			'show_count'       => 0,
			'orderby'          => 'name',
			'echo'             => 0,
			'exclude'		   => '53, 54, 55, 57, 58, 59, 45, 61,44, 46, 47, 48, 49, 50',
			'exclude_tree'     =>  '73'
		);
		?>

		<?php $select  = wp_dropdown_categories($args); ?>
		<?php $replace = "<select$1 onchange='return this.form.submit()'>"; ?>
		<?php $select  = preg_replace( '#<select([^>]*)>#', $replace, $select ); ?>

		<?php echo $select; ?>

		<noscript>
			<input type="submit" value="View" />
		</noscript>

	</form>
</li>

</ul>

<script>
    jQuery(function(){
      // bind change event to select
      jQuery('#dynamic_select').bind('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>
 </div>
 
</div>
  </div><!--row -->
	</div><!--close container -->
</div><!--100%-->
</div>
<div class="udClear newsBackGround" >

<div class="container">
