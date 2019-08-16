jQuery(document).ready(function(){

  if( $(window).width() >= 960 ){
    var target = jQuery(".orbit-results-header").offset().top;
    // updateBottomTarget();
    jQuery(window).scroll( function(){

      if( $(this).scrollTop() > 200 ){
        jQuery( '.orbit-search-container' ).addClass( 'is-fixed' );
      }
      else{
        jQuery( '.orbit-search-container' ).removeClass( 'is-fixed' );
      }

    } );
  }
});
