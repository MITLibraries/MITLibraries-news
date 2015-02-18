 <div class="excerpt-post">
          <p class="entry-summary">
            <?php     
  			$newsTitle = get_the_title();
        	$newsTitle = strlen($newsTitle); 
			?>
		<!--<strong> <?php echo $newsTitle; ?></strong> -->
        
 			<?php		
 
 			$mitSubtitle = get_field("subtitle");
			$mitlistImg = get_field("listImg");
 	
 			if($mitSubtitle) {
				
				echo $mitSubtitle;
			
			}elseif(($mitlistImg) && ($newsTitle >= 90)) {
   					//echo "HELLO";
					echo strip_tags(content(7));
			
			}elseif(($mitlistImg) && ($newsTitle >= 90)) {
   					//echo "HELLO";
					echo strip_tags(excerpt(7));
			
			}elseif(($mitlistImg) && ($newsTitle <= 90)) {
   					//echo "HELLO";
					echo strip_tags(content(20));
			
			}elseif(($mitlistImg) && ($newsTitle <= 90)) {
   					//echo "HELLO";
					echo strip_tags(excerpt(20));
			
			
			
			}elseif(($newsTitle >= 90) && (excerpt())) {
   					
					echo strip_tags(excerpt(20));
				 
			}elseif(($newsTitle >= 90) && (content())) {
   					
					echo strip_tags(content(20));
					
			}elseif(($newsTitle <= 89) && (content())) {
   					
					echo  strip_tags(content(40));
					
			}elseif(($newsTitle <= 89) && (excerpt())) {
   					
					echo strip_tags(excerpt(40));
			}
         
        ?>
          </p>
        </div>
       