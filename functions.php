<?php

add_action('wp_enqueue_scripts',function(){
  wp_enqueue_style('landrights-style', get_stylesheet_directory_uri().'/assets/css/land-rights.css', array('sp-core-style'), '1.0.6' );
});

include('lib/cpt/cpt.php');
include( 'lib/list-related-laws.php' );
include( 'lib/search-form-shortcode.php' );
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

// Checks the state name and gets an image corresponding to the url retrieved
function getMap(){
  global $post;

  $url = get_stylesheet_directory_uri().'/assets/img-map/';
  $getTerm = wp_get_post_terms( $post->ID, 'state' );
  $mapurl = $url.$getTerm[0]->slug.'.png';

  return $mapurl;
}

//Shortcode gets url of the map-image corresponding to the state
add_shortcode( 'laws-map', function(){
  $laws_url = getMap();
  $laws_map_img = '<div class="laws-map"><img src="'.$laws_url.'"/></div>';
  return $laws_map_img;
});

//Exclude pages from WordPress Search
function remove_pages_from_search() {
    global $wp_post_types;
    $wp_post_types['page']->exclude_from_search = true;
}
add_action('init', 'remove_pages_from_search');
