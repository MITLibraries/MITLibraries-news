<?php
/**
 * Template part for displaying EVENTS on cards.
 *
 *
 */
?>

          <?php if(get_field('event_date')){ 
				$date = DateTime::createFromFormat('Ymd', get_field('event_date'));
				
			?>
          <!--EVENT --> 
          <div class="events classCheck">
	      <span class="bg-image"><img src="/wp-content/themes/libraries/images/calendar.svg" width="15px" height="15px"></span>    
		  <span class="event"><?php echo $date->format('F j, Y'); ?></span> 
          <span class="time">
            <?php if( get_field('event_start_time') ){ 
			  		echo the_field('event_start_time'); 
					} ?>
            <?php if(( get_field('event_start_time') ) && ( get_field('event_end_time') )){
				  				 echo '-';
					} ?>
            <?php if( get_field('event_end_time') ){ 
			  		echo the_field('event_end_time'); 
			}  ?>
            </span> 
          
           </div>
          <?php 	}	?>
          <!--EVENT --> 