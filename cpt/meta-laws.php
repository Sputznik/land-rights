<?php

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
