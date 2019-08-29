<!-- Related Laws Posts-->
<div class="container">
  <div class="related-laws">
    <h2 class="text-center">Related Laws</h2>
    <hr>
    <ul id="<?php _e( $atts['id'] );?>" data-target="<?php _e('li.sp-post');?>" data-url="<?php _e( $atts['url'] );?>" class="sp-posts list-unstyled sp-posts-3">
      <?php while( $query->have_posts() ) : $query->the_post();?>
        <li class="sp-post">
          <div class="single-list-law-img"><?php echo do_shortcode( '[laws-map]' );?>
            <div class="laws-detail">
              <h4><a href="<?php echo do_shortcode( '[orbit_link]' );?>"><?php echo do_shortcode( '[orbit_title]' );?></a></h4>
              <p class="small">Passed by <b><?php echo do_shortcode( '[orbit_terms taxonomy="authority"]' );?></b> of <b><?php echo do_shortcode( '[orbit_terms taxonomy="state"]' );?></b> in
                the year <b><?php echo do_shortcode( '[orbit_terms taxonomy="passing-year"]' );?></b></p>
                <p class="small">Type: <?php echo do_shortcode( '[orbit_terms taxonomy="type"]' );?></p>
                <p class="small">Purpose: <?php echo do_shortcode( '[orbit_terms taxonomy="purpose"]' );?></p>
              </div>
            </div>
          </li>
      <?php endwhile;?>
    </ul>
  </div>
</div>
