<!--spotlight -->
<?php $field = get_field_object('feature_type');
			$value = get_field('feature_type');
			$label = $field['choices'][ $value ];
			//print_r($label);
			if(($field['choices'][ $value ]) == "Tip"){
				$featImg = '<div class="info"></div>';
				}
			if(($field['choices'][ $value ]) == "Fact"){
				$featImg ='<div class="info"></div>';
				}
			if(($field['choices'][ $value ]) == "Update"){
			$featImg ='<div class="update"></div>';
				}
			if(($field['choices'][ $value ]) == "Featured Resource"){
					$featImg ='<div class="or_star-25"></div>';
				}
			if(($field['choices'][ $value ]) == "Featured Collection"){
				$featImg ='<div class="or_star-25"></div>';
				}
			if(($field['choices'][ $value ]) == "Featured Location"){
					$featImg ='<div class="or_star-25"></div>';
				}
			if(($field['choices'][ $value ]) == "Featured Service"){
					$featImg ='<div class="or_star-25"></div>';
				}
			if(($field['choices'][ $value ]) == "Featured Exhibit"){
				$featImg ='<div class="or_star-25"></div>';
				}
		  ?>
<?php if($post->post_type == 'spotlights'){ ?>
<div class="featuredCol"><?php echo $label; ?></div>
<?php } ?>
<?php if($post->post_type == 'spotlights'){ ?>
<div class="featuredColImg"> <?php echo $featImg; ?> </div>
<?php } ?><!--//spotlight --> 