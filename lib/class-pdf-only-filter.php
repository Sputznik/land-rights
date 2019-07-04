<?php

/*
* FILTERS THE LIST OF PDF FILES IN THE FOLDER
*/


class PDFOnlyFilter extends RecursiveFilterIterator{
  public function __construct($iterator){
    parent::__construct($iterator);
  }
  public function accept(){
    if( is_dir( $this->current() ) || ( $this->current()->isFile() && preg_match("/\.pdf$/ui", $this->getFilename()) ) ){
      return true;
    }
    return false;
  }
  public function __toString(){
    return $this->current()->getFilename();
  }
}
