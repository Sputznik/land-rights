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


function getListOfTerms( $taxonomy, $posts, $query_atts ){

  $orbit_wp = ORBIT_WP::getInstance();

  $terms_list = array();

  $terms = wp_get_object_terms( $posts,  $taxonomy );

  foreach( $terms as $term ){
    array_push( $terms_list, $term->name . " (" . $orbit_wp->get_term_count_by_query( $term, $query_atts ) . ")" );
  }

  return $terms_list;

}


add_action( 'orbit_query_heading', function( $query_atts ){

  $searchFlag = false;

  if( isset( $query_atts['post_type'] ) && in_array( 'laws', $query_atts['post_type'] ) ){

    $orbit_wp = ORBIT_WP::getInstance();

    $posts = $orbit_wp->get_post_ids( $query_atts );

    $total_posts = count( $posts );

    if( isset( $_GET ) && count( $_GET ) ){ $searchFlag = true; }

    $total_count_title = 'Total ' . $total_posts . ' laws available';

    if( $searchFlag ){ $total_count_title = 'Total ' . $total_posts . ' laws found for your query'; }

    _e( '<div class="orbit-query-heading">' );

    _e('<h3>' . $total_count_title . '</h3>');

    if( $searchFlag ){
      $taxonomies = array(
        'type'  => 'Type',
        'state' => 'States'
      );

      foreach( $taxonomies as $taxonomy_slug => $taxonomy_label ){
        $terms_list = getListOfTerms( $taxonomy_slug, $posts, $query_atts );
        if( count( $terms_list ) ){
          echo "<div class='orbit-terms-count'><b>" . $taxonomy_label . "</b>: " . implode( ', ', $terms_list ) . "</div>";
        }
      }
    }

    _e('<hr>');

    _e( '</div>' );
  }



} );
