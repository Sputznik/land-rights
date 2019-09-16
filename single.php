<?php
   $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )[0];
?>
<?php get_header();?>
<div class="container" style="padding-top: 80px; padding-bottom: 80px;">
  <div class="single-post-layout">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <p style="color: darkgrey;">
      <a href="<?php _e( home_url() )?>"><?php _e( bloginfo('description') );?>&nbsp;&gt;&nbsp;<?php the_title();?></a>
    </p>
    <hr class="single-post-border" style="margin-top: 15px;">
    <div class="single-post-body">
      <div class="single-post-title">
         <h1><?php the_title();?></h1>
           <p class="post-grey" style="padding-top: 30px;">Published on <?php the_time('j F Y');?></p>
           <h3 class="post-grey" style="font-weight: bold;">By <?php _e( get_the_author() );?></h3>
           <?php
             global $post;
             $get_post_id = $post->ID;
             $pdf_law = PDF_LAW::getInstance();
             $pdf_link = $pdf_law->getLink( $post->ID );
             ?>
             <?php if( $pdf_link ):?>
             <a href="<?php _e( $pdf_link );?>" target="_blank" class="btn btn-lg button">DOWNLOAD PDF</a>
             <?php endif;?>
      </div>

       <div class="single-post-thumbnail">
         <img src="<?php _e( $image ); ?>" style="max-width: 100%; height: auto;" />
       </div>
    </div>
    <hr  class="single-post-border">
    <div class="single-post-content">
      <?php the_content();?>
    </div>
    <?php endwhile; endif; ?>
  </div>
</div>
<?php get_footer();?>
