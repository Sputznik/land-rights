<?php

$metainfo = array(
  array(
    'icon'      => 'fa fa-map-marker',
    'label'     => '',
    'shortcode' => 'Passed by [orbit_terms taxonomy="authority"] of [orbit_terms taxonomy="state"] in the year <b>[orbit_terms taxonomy="passing-year"]</b>'
  ),
  array(
    'icon'      => '',
    'label'     => 'Type: &nbsp;',
    'shortcode' => '[orbit_terms taxonomy="type"]'
  ),
  array(
    'icon'      => '',
    'label'     => 'Source: &nbsp;',
    'shortcode' => '[orbit_terms taxonomy="source"]'
  ),
  array(
    'icon'      => '',
    'label'     => 'Machine Readable: &nbsp;',
    'shortcode' => '[orbit_terms taxonomy="machine-readable"]'
  ),
  array(
    'icon'      => '',
    'label'     => 'Language: &nbsp;',
    'shortcode' => '[orbit_terms taxonomy="lang"]'
  ),
  array(
    'icon'      => '',
    'label'     => 'Nature: &nbsp;',
    'shortcode' => '[orbit_terms taxonomy="nature"]'
  ),
  array(
    'icon'      => '',
    'label'     => 'Status: &nbsp;',
    'shortcode' => '[orbit_terms taxonomy="status"]'
  ),
  array(
    'icon'      => '',
    'label'     => 'Purpose: &nbsp;',
    'shortcode' => '[orbit_terms taxonomy="purpose"]'
  ),
  array(
    'icon'      => '',
    'label'     => 'Applicable States: &nbsp;',
    'shortcode' => '[orbit_terms taxonomy="applicable-states"]'
  ),
);

foreach ($metainfo as $meta) {
  if( $meta['shortcode'] ){

    $value = do_shortcode( $meta['shortcode'] );

    if( $value ){
      _e("<p class='small'>");
      if( $meta['icon'] ){ _e( "<i class='". $meta['icon'] ."'></i> &nbsp; " ); }
      if( $meta['label'] ){ _e( "<label>". $meta['label'] ."</label>" ); }
      echo $value;
      _e("</p>");
    }

  }

}
