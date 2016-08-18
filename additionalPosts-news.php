<?php
/**
 * This template loads additional News posts if any exist.
 *
 * @package MITLibraries-News
 * @since 1.0
 */

?>
		<?php
		  
			$offset = htmlspecialchars( trim( $_GET['offset'] ) );
				if ($offset == '') {
					$offset = 9;
				}

			 $limit = htmlspecialchars( trim( $_GET['limit'] ) );
				if ($limit == '') {
					$limit = 9;
				}	
		?>

		<script type="text/javascript">
		$(document).ready(function() {
		  $("img.img-responsive").lazyload({ 
			effect : "fadeIn", 
			effectspeed: 450 ,
			failure_limit: 999999
		  }); 
		});	
		</script>

		<?php

		$sticky = get_option( 'sticky_posts' );
		// args
		$args2 = array(
		'post_type'  				=> 'post',
		'post__not_in' => array($sticky),
			'posts_per_page'        => $limit,
			'offset'					 =>'10',
			'ignore_sticky_posts'   => true,
			'order'                 => 'DESC',
			'orderby'               => 'date',
					'meta_query'             => array(
							array(
								'key'       => 'is_event',
								'value'     => '1',
								'compare'   => '!=',
								'type'      => 'NUMERIC',
							),
						),

			);

		 $the_query = new WP_Query( $args2 ); 
		?>


		  <?php if( $the_query->have_posts() ):  ?>
		  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

			<?php renderRegularCard( $i, $post ); // --- CALLS REGULAR CARDS --- // ?>

		  <?php endwhile; ?>
		  <?php endif;  ?>

		  <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>