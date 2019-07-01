<?php
add_action('wp_enqueue_scripts',function(){
  wp_enqueue_style('landrights-style', get_stylesheet_directory_uri().'/style.css', array('sp-core-style'), '1.0.0' );
});

include('cpt/laws.php');


function wpse_80027_manage_columns($columns) {

  $remove_taxonomies = array( 'machine-readable', 'gazetted-copy', 'lang', 'source', 'status', 'nature' );
  foreach( $remove_taxonomies as $tax ){
    unset( $columns[ 'taxonomy-'. $tax ] ); // prepend taxonomy name with 'taxonomy-'
  }

  return $columns;

}
add_filter('manage_edit-laws_columns', 'wpse_80027_manage_columns');
