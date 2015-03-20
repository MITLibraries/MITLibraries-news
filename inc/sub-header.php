<div class="newsSubHeader">
<div class="innerPadding">
<div class="title-page row">
 <div class="no-padding-left col-xs-12  col-sm-12 col-md-5 col-lg-5">
	<?php 
	global $post;
	if (is_home()){ ?>
		 <h1 class="name-site">News &amp; events</h1>
	 <?php	}elseif ( is_single($post)){ ?>
    	<h2 class="name-site2"><a href="/news/">News &amp; events</a></h2>
      <?php }else{ ?>
    <h1 class="name-site"><a href="/news/">News &amp; events</a>
	<?php 
	if(is_category()){
	 printf('<span class="lowercase">'. ': ' . single_cat_title( '', false ) . '</span>' ); 
	}  ?>        
    </h1>
   <?php } ?>
  </div>
 <div class="socialNav col-xs-12 col-sm-12 col-md-7  col-lg-7 clearfix "> 
	
 <?php get_template_part('inc/social'); ?>



</div><!--row ends-->
</div><!--container ends-->
<hr class="hidden-xs news">
<div class="subNavH">
  <div class="row">
    <div class="no-padding-left  col-xs-6  col-sm-6  col-sm-6  col-md-6 col-lg-6  newsNav dropdown">
<?php
//main nav
$defaults = array(
	'theme_location'  => '',
	'menu'            => 'mainNav',
	'container'       => 'nav',
	'container_class' => '',
	'container_id'    => 'nav-main',
	'menu_class'      => 'menu',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s udClear nav nav-pills dropdown-menu" aria-labelledby="dropdownMenu1" role="menu">%3$s</ul>

	<button class="btn btn-default dropdown-toggle hidden-sm hidden-md hidden-lg" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
    MENU
    <span class="caret"></span>
  </button> ',
	'depth'           => 0,
	'walker'          => ''
);

wp_nav_menu( $defaults );
?>	    
  
    </div>
    
    

                                <!--only on mobile --> 
                                 <div class="col-xs-6 hidden-sm hidden-md hidden-lg">
                                    <div class=" pull-right clearfix "><?php get_search_form('true'); ?></div>
                                 </div>
                                <!--only on mobile ENDS -->  
 

 
    <div class="hidden-xs   col-sm-6  col-sm-6  col-md-6 col-lg-6 catNav">

<ul>


<li id="categories">
		<form id="category-select" class="category-select" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">

		<?php
		$args = array(
			'show_option_none' => __( 'Category' ),
			'show_count'       => 0,
			'orderby'            => 'name', 
			'order'              => 'ASC',
			'echo'             => 0,
			'exclude'		   => '44',
			'exclude_tree'     =>  '44'
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
	
</div> <!--innerpaddingends-->

<!--100%-->
</div>
</div><!--closes page wrap from header this is open on main page !important-->
<div class="clearfix newsBackGround">


