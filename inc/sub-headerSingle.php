<div class="newsSubHeader clearfix">
<div class="innerPadding clearfix">
<div class="title-page no-padding-left col-xs-12  col-sm-12 col-md-5 col-lg-5">
	
    <?php if( is_single($post)){ ?>
    	<h2 class="name-site2"><a href="/news/">News &amp; events</a></h2>
      <?php }else{ ?>
    
    <h1 class="name-site"><a href="/news/">News &amp; events</a>
	<?php 
	if(is_category()){
	 printf('<span>'. ': ' . single_cat_title( '', false ) . '</span>' ); 
	}  ?>        
    </h1>
	
   <?php } ?>
    
 </div>   
<div class="socialNav singleSocialNav hidden-xs not_on_phone socialNav col-xs-12 col-sm-12 col-md-7  col-lg-7 clearfix ">


 <?php get_template_part('inc/social'); ?>







<?php /*?><a href="">Subscribe</a>
<?php previous_post('%','Previous story', 'no'); ?>
<span class="not_on_phone">|</span> 
<?php next_post('%','Next story ', 'no'); ?><?php */?>
</div>


<hr class="news hidden-xs col-sm-12 col-md-12 col-lg-12 clearfix">


<?php /*?><div class="flex-container subNavH">
  <div class="leftNav">
    <div class="box-row newsNav">
	 
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
  </div>
  <div class="rightNav">
    <div class="box-row" style="width:330px;">

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
</div><?php */?>
</div><!--innerpadding-->
</div><!--news-->
</div>
<div class="clearfix newsBackGround">

