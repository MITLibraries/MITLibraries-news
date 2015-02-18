 <!--/EVENT  DATE-->
          <?php if(get_field('event_date')){ 
				$date = DateTime::createFromFormat('Ymd', get_field('event_date'));
				
			?>
          
          
          <div class="events">
		  <div class="event"> </div>
		  <?php echo $date->format('F j, Y'); ?>&nbsp;&nbsp; &nbsp; 
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