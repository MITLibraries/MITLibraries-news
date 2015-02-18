<div class="container biblio">
    	<div class="row">
      <div class="biblioBox col-sm-6 col-md-4">
      <a href="/news/bibliotech/"> 
      <img src="http://libraries-dev.mit.edu/news/files/2014/11/biblioHeader.png" alt="Bibliotech Header" width="331" height="75" />
      </a> </div>
      <div class="biblioBox col-sm-6 col-md-4">
        <p>A biannual newsletter published by the MIT Libraries</p>
      </div>
      <div class="biblioBox col-sm-6 col-md-4 text-right">
 <?php
     // Nav Menu Dropdown Class
//include( get_stylesheet_directory() . '/lib/classes/nav-menu-dropdown.php');

?>

<?php
$menu_name = 'BibliotechMenu';
$locations = get_nav_menu_locations();
$menu = wp_get_nav_menu_object($menu_name);
$menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) ); 
//print_r($menuitems);
?>
<select name="bibMenu" id="bibMenu" onchange="window.location=this.value"><option value="">Please select</option>
<?php
foreach($menuitems as $m){  ?>
<option
<?php if($_SERVER['SCRIPT_URI'] == $m->url ){ echo "selected";} ?> value="<?php  echo $m->url; ?>"><?php  echo $m->title; ?></option>
<?php	}    ?>
</select>
      </div><!--bibliobox-->
    </div><!--flexcontainer-->
 	</div>  
   <?php //$select  = wp_dropdown_categories($args); ?>
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
      jQuery('#bibMenu').bind('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>