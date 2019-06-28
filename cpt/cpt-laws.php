<?php

// CREATES CUSTOM POST TYPE
add_filter( 'orbit_post_type_vars', function( $post_types ){

	$post_types['laws'] = array(
		'slug' 		=> 'laws',
		'labels'	=> array(
			'name' 					=> 'Laws',
			'singular_name' => 'Law',
      'add_new'       => 'Add New',
      'add_new_item'  => 'Add New Law',
      'all_items'     =>  'All Laws'
		),
		'public'		=> true,
		'supports'	=> array( 'title', 'editor','thumbnail' )
	);
	return $post_types;
} );
