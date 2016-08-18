<?php
/**
 * This template-part displays EVENT date/times on CARDS.
 *
 * @package MITLibraries-News
 * @since 1.0
 */

?>

		  <?php if(get_field( 'event_date' )){ 
				$date = DateTime::createFromFormat( 'Ymd', get_field( 'event_date' ) );
				
			?>
		  <!--EVENT --> 
		  <div class="events classCheck">
	      <span class="bg-image"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px" x="0px" y="0px"
	 viewBox="-299 390 13 13" style="enable-background:new -299 390 13 13;" xml:space="preserve">
<style type="text/css">
	.st0{fill:#F58632;}
</style>
<g>
	<g id="XMLID_9_">
		<path id="XMLID_35_" class="st0" d="M-286.9,393.7v-0.8c0-0.4-0.4-0.8-0.8-0.8h-0.8v-0.8c0-0.4-0.4-0.8-0.8-0.8
			c-0.4,0-0.8,0.4-0.8,0.8v0.8h-4.8v-0.8c0-0.4-0.4-0.8-0.8-0.8c-0.4,0-0.8,0.4-0.8,0.8v0.8h-0.8c-0.4,0-0.8,0.4-0.8,0.8v0.8
			C-298.1,393.7-286.9,393.7-286.9,393.7z"/>
	</g>
	<g>
		<path id="XMLID_76_" class="st0" d="M-298.1,394.5v7.2c0,0.4,0.4,0.8,0.8,0.8h9.6c0.4,0,0.8-0.4,0.8-0.8v-7.2H-298.1z
			 M-294.9,400.9h-1.6v-1.6h1.6V400.9z M-294.9,397.7h-1.6v-1.6h1.6V397.7z M-291.7,400.9h-1.6v-1.6h1.6
			C-291.7,399.3-291.7,400.9-291.7,400.9z M-291.7,397.7h-1.6v-1.6h1.6C-291.7,396.1-291.7,397.7-291.7,397.7z M-288.5,400.9h-1.6
			v-1.6h1.6V400.9z M-288.5,397.7h-1.6v-1.6h1.6V397.7z"/>
	</g>
</g>
</svg>
</span>    
		  <span class="event"><?php echo $date->format( 'F j, Y' ); ?></span> 
		  <span class="time">
			<?php if( get_field( 'event_start_time' ) ){ 
			  		echo the_field( 'event_start_time' ); 
					} ?>
			<?php if(( get_field( 'event_start_time' ) ) && ( get_field( 'event_end_time' ) )){
				  				 echo '-';
					} ?>
			<?php if( get_field( 'event_end_time' ) ){ 
			  		echo the_field( 'event_end_time' ); 
			}  ?>
			</span> 
		  
		   </div>
		  <?php 	}	?>
		  <!--EVENT --> 