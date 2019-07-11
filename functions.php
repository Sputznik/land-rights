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

function get_term_count_by_query( $term, $query_atts ){

  if( !isset( $query_atts['tax_query'] ) ){
    $query_atts['tax_query'] = array();
  }

  array_push( $query_atts['tax_query'], array(
    'taxonomy'  => $term->taxonomy,
    'field'     => 'slug',
    'terms'     => array( $term->slug )
  ) );

  $query_atts['fields'] = 'ids';
  $query_atts['posts_per_page'] = -1;

  $ps = get_posts( $query_atts );

  if( count( $ps ) > 0 ){ return count( $ps ); }

  return 0;


}

function getListOfTerms( $taxonomy, $posts, $query_atts ){

  $terms_list = array();

  $terms = wp_get_object_terms( $posts,  $taxonomy );

  foreach( $terms as $term ){
    array_push( $terms_list, $term->name . " (" . get_term_count_by_query( $term, $query_atts ) . ")" );
  }

  return $terms_list;

}


add_action( 'orbit_query_heading', function( $query_atts ){

  $query_atts['posts_per_page'] = -1;

  $orbit_wp = ORBIT_WP::getInstance();

  $orbit_wp_query = $orbit_wp->query( $query_atts );

  $searchFlag = false;

  if( isset( $orbit_wp_query->query['post_type'] ) && in_array( 'laws', $orbit_wp_query->query['post_type'] ) && isset( $orbit_wp_query->found_posts ) ){

    $posts = wp_list_pluck( $orbit_wp_query->posts, 'ID' );

    $total_posts = $orbit_wp_query->found_posts;

    if( isset( $_GET ) && count( $_GET ) ){ $searchFlag = true; }

    $total_count_title = 'Total ' . $total_posts . ' laws available';

    if( $searchFlag ){
      $total_count_title = 'Total ' . $total_posts . ' laws found for your query';
    }

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
