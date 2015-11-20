<?php 

/**
 * 	IE 8 Support Media Queries and respondJS
 * 	@since Beruf 1.0
 * 	@return
 */
function ie_js_header () {
	echo '<!--[if lt IE 9]>'. "\n";
	echo '<script src="' . esc_url( get_template_directory_uri() . '/library/js/ie/html5shiv.min.js' ) . '"></script>'. "\n";
	echo '<![endif]-->'. "\n";
}
add_action( 'wp_head', 'ie_js_header' );

function ie_js_footer () {
	echo '<!--[if lt IE 9]>'. "\n";
	echo '<script src="' . esc_url( get_template_directory_uri() . '/library/js/ie/respond.js' ) . '"></script>'. "\n";
	echo '<![endif]-->'. "\n";
}
add_action( 'wp_footer', 'ie_js_footer', 20 );


 ?>