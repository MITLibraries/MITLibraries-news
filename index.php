    <?php
        $pageRoot = getRoot( $post );
        $section  = get_post( $pageRoot );
        $isRoot   = $section->ID == $post->ID;
    get_header();
    get_template_part( 'inc/sub-header' );
        $sticky = get_option( 'sticky_posts' );
        $args   = array(
            'posts_per_page' => 1,
            'post__in' => $sticky,
            'ignore_sticky_posts' => 1,
            'orderby' => 'menu_order',
            'order' => 'DESC',
            'suppress_filters' => false 
    );
        $query2 = new WP_Query( $args );
        if ( $query2->have_posts() ):
            while ( $query2->have_posts() ):
                $query2->the_post();
                if ( isset( $sticky[0] ) ) {
        ?>

<div class="wrap-sticky">
        <!-- OPEN CONTAINER FOR MOBILE/STICKY CARD LAYOUT -->
                <div class="container container-fluid">
            
            <!-- OPEN ROW FOR MOBILE/STICKY CARD LAYOUT -->
                <div class="row">
                    <h3 class="header-section sticky">Featured news</h3>

                <!-- CALLS MOBILE CARDS -->
        <?php renderMobileCard( $i, $post ); ?>

                <!-- CALLS STICKY CARDS -->
        <?php renderFeatureCard( $i, $post ); ?>

                <!-- RESETS QUERY -->
         <?php wp_reset_postdata(); ?>
            
                <?php wp_reset_query(); ?>
          
                    <?php } //isset( $sticky[0] ) ?>
         
                    <?php endwhile; ?>
        
                    <?php endif; ?> 
                    
        <!-- CLOSES CALLS/QUERIES FOR MOBILE/STICKY CARDS -->
            </div>
            </div>
</div>
<div class="wrap-regular">

        <!-- OPEN CONTAINER FOR REGULAR CARD LAYOUT -->
                <div class="container container-fluid">
            
            <!-- OPEN ROW FOR REGULAR CARD LAYOUT -->
                <div class="row"> 
 
      <?php
            $args = array(
             'posts_per_page' => 9,
            'post_type' => array(
                 'spotlights',
                'bibliotech',
                'post' 
	   ),
            'post__not_in' => get_option( 'sticky_posts' ),
            'ignore_sticky_posts' => 1,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'suppress_filters' => false 
            );
            $the_query = new WP_Query( $args );
            ?>
               <?php
            if ( $the_query->have_posts() ):
            // $theLength = $count_posts->publish;
            ?>
    
	
            <?php
            $i = -1;
            while ( $the_query->have_posts() ):
                $the_query->the_post();
                $i++;
                renderRegularCard( $i, $post ); // --- CALLS REGULAR CARDS --- //
        ?>
    
                   
                    
            <?php if ( get_post_type( get_the_ID() ) == 'bibliotech' ) { ?>
           
            <?php } //get_post_type( get_the_ID() ) == 'bibliotech' ?>
              
                    <?php  wp_reset_query(); // Restore global post data stomped by the_post(). ?>
           
                    <?php endwhile; ?>
            
                    <?php endif; ?>
  
              </div>
              <!--closes ROW-->
              </div>
              <!--closes NEWS-CONTAINER-->

        <?php
        if ( $i > 6 ) {
            get_template_part( 'inc/more-posts' );
        } //$i > 6
        ?>


  
  </div>
</div>

        <script>
        $(document).ready(function() {
            var offset = 9;
            var limit = 9;
            $("#postContainer").load("/news/test/");
            $("#another").click(function(){
                limit = limit+9;
                offset = offset+9;
                $("#postContainer")
                    //.slideUp()
                    .load("/news/test/?offset="+offset+"&limit="+limit, function() {
                     //.load("/news/test/?offset="+offset, function() {
                       $(this).slideDown();


                });

                return false;
            });
        });
        </script>

        <div class="container container-fluid">
        <?php
        get_footer();
        ?>
