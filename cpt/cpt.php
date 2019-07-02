<?php

// CREATES CUSTOM POST TYPE
add_filter( 'orbit_post_type_vars', function( $orbit_types ){

	$orbit_types['laws'] = array(
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
	return $orbit_types;
} );

//Creates a meta field for citation information
add_filter( 'orbit_meta_box_vars', function( $meta_box ){
	$meta_box['laws'] = array(
		array(
			'id'			=> 'laws-meta-fields',
			'title'		=> 'Additional Fields',
			'fields'	=> array(
				'citation' => array(
					'type' => 'text',
					'text' => 'Citation'
				),
			)
		)
	);
	return $meta_box;
});

/* PUSH INTO THE GLOBAL VARS OF ORBIT TAXNOMIES */
add_filter( 'orbit_taxonomy_vars', function( $orbit_tax ){

  $laws_taxonomies = array(
    'type'              => 'Type',
    'state'             => 'State',
    'machine-readable'  => 'Machine Readable',
    'gazetted-copy'     => 'Gazetted Copy',
    'source'            => 'Source',
    'lang'              => 'Language',
    'nature'            => 'Nature',
    'authority'         => 'Authority',
    'passing-year'      => 'Year',
    'status'            => 'Status',
    'applicable-states' => 'Applicable States',
    'purpose'           => 'Purpose'
  );

  foreach( $laws_taxonomies as $slug => $label ){
    $orbit_tax[ $slug ]	= array(
      'label'			  => $label,
      'slug' 			  => $slug,
      'post_types'	=> array( 'laws' )
    );
  }

  return $orbit_tax;

} );
