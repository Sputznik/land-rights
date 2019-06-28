<?php
add_action('wp_enqueue_scripts',function(){
  wp_enqueue_style('landrights-style', get_stylesheet_directory_uri().'/style.css', array('sp-core-style'), '1.0.0' );
});

include('cpt/laws.php');
