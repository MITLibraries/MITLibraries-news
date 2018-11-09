<?php
/**
 * This template-part loads the additional subheader for *bibliotech* PAGES.
 *
 * @package MITLibraries-News
 * @since 1.0
 */

?>

<div class="container biblio">
		<div class="row">
		<div class="biblioBox col-sm-6 col-md-4">
			<h1>
				<a href="/news/bibliotech-index/">
					<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 161.6 26.31"><defs><style>.cls-1{fill:#fff;}</style></defs><title>bibliotech-logo</title><path class="cls-1" d="M1.76,4.63H14.18a9.22,9.22,0,0,1,6,1.77,6.1,6.1,0,0,1,2.24,4.93,5.06,5.06,0,0,1-3.6,5v.11a6.37,6.37,0,0,1,4.6,6.3,6.81,6.81,0,0,1-2.62,5.76,10.13,10.13,0,0,1-6.34,1.83H1.76ZM13.25,14.82c1.83,0,3.09-.9,3.09-2.59s-1.19-2.56-3.06-2.56H8.06v5.15Zm.5,10.44c2.09,0,3.38-1.19,3.38-3,0-2.06-1.51-3.1-3.45-3.1H8.06v6.12Z" transform="translate(-1.76 -4.63)"/><path class="cls-1" d="M25.56,4.63h5.87V9.39H25.56Zm0,7.31h5.87V30.37H25.56Z" transform="translate(-1.76 -4.63)"/><path class="cls-1" d="M39.92,28h-.07v2.34H34.24V4.63H40.1V14h.11a6,6,0,0,1,5.26-2.63c4.78,0,7.88,4.21,7.88,9.76,0,6.12-3.1,9.79-7.85,9.79A6.19,6.19,0,0,1,39.92,28Zm7.49-6.91c0-3.17-1.26-5.26-3.64-5.26-2.59,0-3.85,2.27-3.85,5.3s1.51,5.14,3.93,5.14S47.41,24.32,47.41,21.12Z" transform="translate(-1.76 -4.63)"/><path class="cls-1" d="M55.37,4.63h5.94V30.37H55.37Z" transform="translate(-1.76 -4.63)"/><path class="cls-1" d="M64.15,4.63H70V9.39H64.15Zm0,7.31H70V30.37H64.15Z" transform="translate(-1.76 -4.63)"/><path class="cls-1" d="M72,21.19a9.44,9.44,0,0,1,9.86-9.75,9.39,9.39,0,0,1,9.83,9.75A9.4,9.4,0,0,1,81.86,31,9.44,9.44,0,0,1,72,21.19Zm13.75,0c0-3.35-1.37-5.61-3.92-5.61s-3.89,2.26-3.89,5.61,1.33,5.58,3.89,5.58S85.75,24.54,85.75,21.19Z" transform="translate(-1.76 -4.63)"/><path class="cls-1" d="M94.75,25.51v-9.9H92.3V11.94h2.45V6.11h5.72v5.83h3.35v3.67h-3.35v8.64c0,1.44.8,1.8,2.06,1.8.5,0,1.08,0,1.29,0V30.3a13.68,13.68,0,0,1-3.2.29C97.2,30.59,94.75,29.47,94.75,25.51Z" transform="translate(-1.76 -4.63)"/><path class="cls-1" d="M104.94,21.12c0-5.51,3.85-9.72,9.47-9.72a9.09,9.09,0,0,1,6.3,2.31c2.19,2,3.27,5.21,3.24,9H110.7c.36,2.48,1.73,4,4.14,4a3.06,3.06,0,0,0,3.06-1.84h5.72a7.47,7.47,0,0,1-3.09,4.36,9.75,9.75,0,0,1-5.76,1.69C108.68,30.91,104.94,26.7,104.94,21.12ZM118,19.18c-.22-2.2-1.59-3.6-3.5-3.6-2.23,0-3.38,1.4-3.78,3.6Z" transform="translate(-1.76 -4.63)"/><path class="cls-1" d="M125.1,21.19c0-5.54,3.82-9.75,9.65-9.75,5,0,8.2,2.91,8.74,7h-5.65a3,3,0,0,0-3-2.73c-2.52,0-3.78,2.08-3.78,5.43s1.26,5.37,3.78,5.37c1.83,0,3-1.08,3.2-3.17h5.62c-.15,4.25-3.53,7.56-8.75,7.56A9.36,9.36,0,0,1,125.1,21.19Z" transform="translate(-1.76 -4.63)"/><path class="cls-1" d="M145.51,4.63h5.87v9.58h.11A6.32,6.32,0,0,1,157,11.4c4,0,6.41,2.88,6.41,7v12H157.5V19.57c0-1.94-1-3.27-2.88-3.27s-3.24,1.62-3.24,3.88V30.37h-5.87Z" transform="translate(-1.76 -4.63)"/></svg>
				</a>
			</h1> 
		</div>
		<div class="biblioBox col-sm-6 col-md-4">
		<p>A biannual newsletter published by the MIT Libraries</p>
		</div>
		<div class="biblioBox col-sm-6 col-md-4 text-right">

<?php
$menu_name = 'BibliotechMenu';
$locations = get_nav_menu_locations();
$menu = wp_get_nav_menu_object( $menu_name );
$menuitems = wp_get_nav_menu_items(
	$menu->term_id,
	array(
		'order' => 'DESC',
	)
);
?>
<select name="bibMenu" id="bibMenu" onchange="window.location=this.value"><option value="">Select issue</option>
<?php
foreach ( $menuitems as $m ) {  ?>
<option
<?php if ( $_SERVER['SCRIPT_URI'] == $m->url ) { echo 'selected';} ?> value="<?php  echo $m->url; ?>"><?php  echo $m->title; ?></option>
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
		// Bind change event to select.
		jQuery('#bibMenu').bind('change', function () {
			var url = $(this).val(); // Get selected value.
			if (url) { // Require a URL.
				window.location = url; // Redirect.
			}
			return false;
		});
	});
</script>
