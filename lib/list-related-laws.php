<?php
/**
* Setup query to show the ‘laws’ post type with all posts.
*/
  function related_laws( $post_id, $meta_value ){
   $args = array(
       'post_type' => 'laws',
       'post_status' => 'publish',
       'post__not_in' => array( $post_id ),
       'posts_per_page' => -1,
       'meta_query'=> array(
            array(
              'key' => 'related_citation',
              'value' => $meta_value,
            )),
       'orderby' => 'title',
       'order' => 'ASC',
   );
   $query = new WP_Query( $args );
   $count = $query->post_count;
   // wp_reset_postdata();
   if( $count >= 1 ){
     require get_stylesheet_directory().'/orbit-query/related-laws.php';
   }
 }
 ?>
