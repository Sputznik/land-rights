<?php
// THIS CONDITION CHECKS IF THE ORBIT-BUNDLE HAS BEEN LOADED FIRST, IF NOT THEN WAIT FOR IT TO LOAD COMPLETELY
if( class_exists('ORBIT_BASE') ){
  include('cpt-laws.php');
  include('tax-laws.php');
  include('meta-laws.php');
}
else{
  add_action('orbit-bundle-loaded', function(){
    include('cpt-laws.php');
    include('tax-laws.php');
    include('meta-laws.php');
  });
}
