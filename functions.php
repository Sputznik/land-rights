<?php

add_action('wp_enqueue_scripts',function(){
  wp_enqueue_style('landrights-style', get_stylesheet_directory_uri().'/assets/css/land-rights.css', array('sp-core-style'), '1.0.2' );
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'scroll', get_stylesheet_directory_uri().'/assets/js/scroll.js', array( 'jquery' ), '1.0.0', true );
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

add_filter('term_link', function( $termlink, $term, $taxonomy ){

	if( $taxonomy == 'state' || $taxonomy == 'purpose' ){
		$taxonomy .= "[]";
	}

	$url = site_url('list-of-laws') . "?tax_" . $taxonomy . "=" . $term->name;

	return $url;
}, 10, 3);



//Exclude pages from WordPress Search
function remove_pages_from_search() {
    global $wp_post_types;
    $wp_post_types['page']->exclude_from_search = true;
}
add_action('init', 'remove_pages_from_search');
