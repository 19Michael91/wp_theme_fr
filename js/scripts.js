(function( $ ) {
	$( 'document' ).ready( function(){
		$( '.fooderecipe-menu-close' ).click( function(){
			$( '.navbar-toggle' ).trigger( 'click' );
		} );
  	$( '.count-display select' ).change( function(){
  		$( '.btn-info' ).trigger( 'click' );
        $.ajax({
          url: foodrecipe_var.ajax_url,
          method: "POST",
          data: { count : $(this).val(), action : 'foodrecipe_count_display', url: window.location.href },
          dataType: 'json',
          success: function (data) {    // обрабатываем полученные данные
                     if( 'success' == data.action ) {
                       window.location.href = data.url;
                     }
                   } 
        });  
  	} );
    $( '.sort-display select' ).change( function(){
      $( '.btn-info' ).trigger( 'click' );
      $.ajax({
          url: foodrecipe_var.ajax_url,
          method: "POST",
          data: { sort : $( this ).val(), action : 'foodrecipe_sort_display' },
          success: function ( data ) {
              if ( 'success' == data ) {
                window.location.href = window.location.href;
              };
          }
        });
    } );
    $( function() {  
      $( '.cpr-center' ).click( function() {
        $( 'body,html' ).animate( { scrollTop : 0 }, 800 );
      }); 
    } )
  } ); 
})( jQuery );
