<?php

add_action('wp_enqueue_scripts',function(){
  wp_enqueue_style('landrights-style', get_stylesheet_directory_uri().'/assets/css/land-rights.css', array('sp-core-style'), '1.0.0' );
});

include('lib/cpt/cpt.php');

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

function getPDFLink( $post_id ){

  $pdf_link = get_post_meta( $post->ID, 'law_pdf_link', true );

  if( !$pdf_link ){
    $citation = get_post_meta( $post_id, 'citation', true );

    if( $citation ){
      $pdf_file_name = $citation.".pdf";
      $pdf_link = getFileUrl( $pdf_file_name );
      
      if( $pdf_link ){
        update_post_meta( $post_id, 'law_pdf_link', $pdf_link );
      }
    }
  }

  return $pdf_link;
}


function getFileUrl( $filename ){
  $upload_dir = wp_get_upload_dir();
  $it = new RecursiveDirectoryIterator( $upload_dir['basedir'] );
  $it = new PDFOnlyFilter($it);
  $it = new RecursiveIteratorIterator($it);
  foreach( $it as $file ){
    if( preg_match( "/[0-9a-zA-Z -]*".$filename."$/i", $file ) ){
      return $file;
    }
  }
}
