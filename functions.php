<?php

add_action('wp_enqueue_scripts',function(){
  wp_enqueue_style('landrights-style', get_stylesheet_directory_uri().'/assets/css/land-rights.css', array('sp-core-style'), '1.0.0' );
});

include('lib/cpt/cpt.php');
include('lib/class-pdf-only-filter.php');
include( 'lib/class-pdf-law.php' );

add_filter( 'orbit_tax_query_params_passing-year', function( $type ){
  $type = 'name';
  return $type;
} );

add_filter('manage_edit-laws_columns', function( $columns ){

  $remove_taxonomies = array( 'machine-readable', 'gazetted-copy', 'lang', 'source', 'status', 'nature' );
  foreach( $remove_taxonomies as $tax ){
    unset( $columns[ 'taxonomy-'. $tax ] ); // prepend taxonomy name with 'taxonomy-'
  }

  return $columns;
} );


add_action( 'orbit_query_heading', function( $orbit_wp_query ){

  if( isset( $orbit_wp_query->query['post_type'] ) && in_array( 'laws', $orbit_wp_query->query['post_type'] ) && isset( $orbit_wp_query->found_posts ) ){

    $total_posts = $orbit_wp_query->found_posts;

    _e('<h3>' . $total_posts . ' Laws were found</h3>');
    _e('<hr>');
  }



} );
