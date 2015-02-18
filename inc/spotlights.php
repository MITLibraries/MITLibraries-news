  <!--spotlight -->
          <?php if($post->post_type == 'spotlights'){ 
        	$field = get_field_object('feature_type');
			$value = get_field('feature_type');
			$label = $field['choices'][ $value ];
    ?>
          <div class="featuredCol"><?php echo $label; ?></div>
          <?php } ?>
          <?php if($post->post_type == 'spotlights'){ ?>
          <div class="featuredColImg"> <img src="/wp-content/themes/mit-libraries-news/images/info.png" alt="featured" width="31" height="27" class="img-responsive" /> </div>
          <?php } ?>
          
          <!--//spotlight --> 