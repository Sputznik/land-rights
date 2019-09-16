<ul id="<?php _e( $atts['id'] );?>" data-target="<?php _e('li.orbit-article-grid');?>" data-url="<?php _e( $atts['url'] );?>" class="list-unstyled grid-page">
  <?php while( $this->query->have_posts() ) : $this->query->the_post();?>
	<li class="orbit-article-grid">
    <?php get_template_part("partials/content", "grid"); ?>
  </li>
  <?php endwhile;?>
</ul>
