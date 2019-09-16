<?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');?>
<div class="article-grid-img" style="">
  <img src="<?php _e( $featured_img_url ); ?>" style="max-width:100%;height:auto;"/>
</div>
<div class="article-grid-content">
  <h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
  <p>Published on <?php the_time('j F Y');?></p>
</div>
