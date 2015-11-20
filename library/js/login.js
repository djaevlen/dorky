
jQuery(document).ready(function($) {
//Add Stuff to Wp admin login Page
    loginpage = $('body').hasClass('login');
    if(loginpage == true){
        $('#login').after('<div class="berufinfo"><a class="Beruf-logo" target="_blank" href="http://beruf.dk"></a><p>Hvis du har brug for support er du altid velkommen til at kontakte os. (klik på logo)</p></div>');
    }
});