<?php
/**
* The sub-header for the Bibliotech page.
*
*
* @package WordPress
* @subpackage MITLibraries-news
* @since v1.3.0
*/
?>
<div class="container biblio">
    <div class="row">
      <div class="biblioBox col-sm-6 col-md-4">
      	<h1><a href="/news/bibliotech-index/"> 
		  	<img class="centered" src="<?php echo get_theme_root_uri(); ?>/mit-libraries-news/images/biblioHeader.png" alt="Bibliotech Header" class="img-responsive" width="331" height="75">
      	</a></h1>
      </div>
      <div class="biblioBox col-sm-6 col-md-4">
        <p>A biannual newsletter published by the MIT Libraries</p>
      </div>
      	<div class="biblioBox col-sm-6 col-md-4 text-right">


	<?php
	$menu_name = 'BibliotechMenu';
	$locations = get_nav_menu_locations();
	$menu = wp_get_nav_menu_object($menu_name);
	$menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) ); 
	//print_r($menuitems);
	?>
	<select name="bibMenu" id="bibMenu" onchange="window.location=this.value"><option value="">Select issue</option>
	<?php
	foreach($menuitems as $m){  ?>
	<option
	<?php if($_SERVER['SCRIPT_URI'] == $m->url ){ echo "selected";} ?> value="<?php  echo $m->url; ?>"><?php  echo $m->title; ?></option>
	<?php	}    ?>
</select>
      </div><!--bibliobox-->
    </div><!--flexcontainer-->
 	</div>  
    
		<noscript>
			<input type="submit" value="View" />
		</noscript>

	</form>
</li>

</ul>

<script>
    jQuery(function(){
      // bind change event to select
      jQuery('#bibMenu').bind('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>