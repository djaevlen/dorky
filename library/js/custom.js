// as the page loads, call these scripts
jQuery(document).ready(function($) {

 
    //getting viewport width
    var responsive_viewport = $(window).width();
    
    // if is below 481px
    if (responsive_viewport < 481) {
    
    } 
    
    //if is larger than 481px 
    if (responsive_viewport > 481) {
        
    }
    
    // if is above or equal to 768px 
    if (responsive_viewport >= 768) {
      
        // load gravatars
        $('.comment img[data-gravatar]').each(function(){
            $(this).attr('src',$(this).attr('data-gravatar'));
        });
        
    }
    
    // off the bat large screen actions
    if (responsive_viewport > 1030) {
        
    }

});


jQuery(document).ready(function($) {
	
	$("#mobile-menu").mmenu({
         // Options
  	});
    console.log('adassd');

	var API = $("#mobile-menu").data( "mmenu" );
	$("#mobile-menu-button").click(function() {
	 	API.open();
	});
});
