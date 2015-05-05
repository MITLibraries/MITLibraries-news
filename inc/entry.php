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

			$postType = get_post_type();

			if($postType === "spotlights") {
				// do nothing - spotlights have no entry text
			}elseif($mitSubtitle) {
				echo $mitSubtitle;
			
			}elseif(($mitlistImg) && ($newsTitle >= 90)) {
				//echo "HELLO";
				echo strip_tags(content(7));
			
			}elseif(($mitlistImg) && ($newsTitle >= 90)) {
				//echo "HELLO";
				echo strip_tags(excerpt(7));
			
			}elseif(($mitlistImg) && ($newsTitle <= 90)) {
				//echo "HELLO";
				echo strip_tags(content(7));
			
			}elseif(($mitlistImg) && ($newsTitle <= 90)) {
				//echo "HELLO";
				echo strip_tags(excerpt(20));
			
			}elseif(($newsTitle >= 90) && (excerpt(20))) {
				echo strip_tags(excerpt(20));
				 
			}elseif(($newsTitle >= 90) && (content(20))) {
				echo strip_tags(content(20));
					
			}elseif(($newsTitle <= 89) && (content(30))) {
				//echo "HELLO";
				echo strip_tags(content(30));
					
			}elseif(($newsTitle <= 89) && (excerpt(40))) {
				//echo "HELLO";
				echo strip_tags(excerpt(40));
			}
         
        ?>
          </p>
        </div>
       