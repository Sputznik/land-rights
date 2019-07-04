<?php

class PDF_LAW extends ORBIT_BASE{

  private static $instance = null;

	// SINGLETON DESIGN PATTERN - NEEDS TO BE IMPLEMENTED IN EACH CHILD
	public static function getInstance(){

		if( self::$instance == null ){
			self::$instance = array();
		}

		$class = get_called_class();

		if( !isset( self::$instance[ $class ] ) ){
            // new $class() will work too
            self::$instance[ $class ] = new static();
        }

        return self::$instance[ $class ];
	}

  function getLink( $post_id ){

    $pdf_link = get_post_meta( $post->ID, 'law_pdf_link', true );

    if( !$pdf_link ){
      $citation = get_post_meta( $post_id, 'citation', true );

      if( $citation ){
        $pdf_file_name = $citation.".pdf";
        $pdf_link = self::getFileURL( $pdf_file_name );

        if( $pdf_link ){
          update_post_meta( $post_id, 'law_pdf_link', $pdf_link );
        }
      }
    }

    return $pdf_link;
  }

  function convertFilePathToURL( $filepath ){

    $upload_dir = wp_get_upload_dir();

    $url = '';

    $filepath = explode( "wp-content\\uploads", $filepath );
    if( is_array( $filepath ) && count( $filepath ) > 1 ){
      $url = $upload_dir[ 'baseurl' ] . $filepath[1];
    }

    return $url;
  }

  function getFileURL( $filename ){
    $upload_dir = wp_get_upload_dir();
    $it = new RecursiveDirectoryIterator( $upload_dir['basedir'] );
    $it = new PDFOnlyFilter($it);
    $it = new RecursiveIteratorIterator($it);

    foreach( $it as $file ){
      if( is_a( $file, 'SplFileInfo' ) ){

        $filepath = $file->getRealPath();

        echo "<pre>";
        print_r( $filepath );
        echo "</pre>";

        if( preg_match( "/[0-9a-zA-Z -]*".$filename."$/i", $filepath ) ){

          $url = $this->convertFilePathToURL( $filepath );

          return $url;
        }
      }
    }
  }
}



PDF_LAW::getInstance();
