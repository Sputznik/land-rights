<?php
/* PUSH INTO THE GLOBAL VARS OF ORBIT TAXNOMIES */
add_filter( 'orbit_taxonomy_vars', function( $taxonomies ){

  $taxonomies['type']	= array(
    'label'			=> 'Type',
    'slug' 			=> 'type',
    'post_types'	=> array( 'laws' )
  );

	$taxonomies['state']	= array(
		'label'			=> 'State',
		'slug' 			=> 'state',
		'post_types'	=> array( 'laws' )
	);

  $taxonomies['machine-readable']	= array(
  	'label'			=> 'Machine Readable',
  	'slug' 			=> 'machine-readable',
  	'post_types'	=> array( 'laws' )
  );

  $taxonomies['gazetted-copy']	= array(
  	'label'			=> 'Gazetted Copy',
  	'slug' 			=> 'gazetted-copy',
  	'post_types'	=> array( 'laws' )
  );

  $taxonomies['source']	= array(
    'label'			=> 'Source',
    'slug' 			=> 'source',
    'post_types'	=> array( 'laws' )
  );

  $taxonomies['lang']	= array(
    'label'			=> 'Language',
    'slug' 			=> 'lang',
    'post_types'	=> array( 'laws' )
  );

  $taxonomies['nature']	= array(
    'label'			=> 'Nature',
    'slug' 			=> 'nature',
    'post_types'	=> array( 'laws' )
  );

  $taxonomies['authority']	= array(
    'label'			=> 'Authority',
    'slug' 			=> 'authority',
    'post_types'	=> array( 'laws' )
  );

  $taxonomies['year']	= array(
    'label'			=> 'Year',
    'slug' 			=> 'year',
    'post_types'	=> array( 'laws' )
  );

  $taxonomies['status']	= array(
    'label'			=> 'Status',
    'slug' 			=> 'status',
    'post_types'	=> array( 'laws' )
  );

  $taxonomies['applicable-states']	= array(
    'label'			=> 'Applicable States',
    'slug' 			=> 'applicable-states',
    'post_types'	=> array( 'laws' )
  );

  $taxonomies['purpose']	= array(
    'label'			=> 'Purpose',
    'slug' 			=> 'purpose',
    'post_types'	=> array( 'laws' )
  );

	return $taxonomies;

} );
