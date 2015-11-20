<?php 
/**
 * 	Menu registrations
 * 	@since Beruf 1.0
 * 	@return 
 */
function register_menu() {
	// wp menus
	add_theme_support( 'menus' );

	// registering wp3+ menus
	register_nav_menus(
		array(
			'main-nav' => __( 'The Main Menu', 'bonestheme' ),   // main nav in header
			'mobile-nav' => __( 'The Mobile Menu', 'bonestheme' )   // main nav in header
		)
	);

}
	
// the main menu
function main_nav() {
	// display the wp3 menu if available
    wp_nav_menu(array(
    	'container' 		=> false, // remove nav container
    	'container_class' 	=> 'menu clearfix', // class of container (should you choose to use it)
    	'menu' 				=> __( 'The Main Menu', 'bonestheme' ), // nav name
    	'menu_class' 		=> 'nav navbar-nav navbar-right', // adding custom nav class
    	'theme_location' 	=> 'main-nav', // where it's located in the theme
    	'before' 			=> '', // before the menu
      	'after' 			=> '', // after the menu
      	'link_before' 		=> '', // before each link
      	'link_after' 		=> '', // after each link
      	'depth' 			=> 2, // limit the depth of the nav
      	'fallback_cb' 		=> 'wp_bootstrap_navwalker::fallback', // fallback
    	 'walker' 			=> new wp_bootstrap_navwalker() // for bootstrap nav
	));
}
// this is the fallback for the main menu
function main_nav_fallback() {
	wp_page_menu( array(
		'show_home' 	=> true,
    	'menu_class' 	=> 'nav top-nav clearfix', // adding custom nav class
		'include'     	=> '',
		'exclude'     	=> '',
		'echo'        	=> true,
        'link_before' 	=> '', // before each link
        'link_after' 	=> '' // after each link
	) );
}
// the mobile menu
function mobile_nav() {
	// display the wp3 menu if available
    wp_nav_menu(array(
    	'container' 		=> false, // remove nav container
    	'container_class' 	=> '', // class of container (should you choose to use it)
    	'menu' 				=> __( 'Mobile Menu', 'bonestheme' ), // nav name
    	'menu_class' 		=> '', // adding custom nav class
    	'theme_location' 	=> 'mobile-nav', // where it's located in the theme
    	'before' 			=> '', // before the menu
  		'after' 			=> '', // after the menu
      	'link_before' 		=> '', // before each link
      	'link_after' 		=> '', // after each link
      	'depth' 			=> 2, // limit the depth of the nav
      	//'fallback_cb' 		=> 'wp_bootstrap_navwalker::fallback', // fallback
    	//'walker' 			=> new wp_bootstrap_navwalker() // for bootstrap nav
	));
} 
// this is the fallback for the mobile menu
function mobile_nav_fallback() {
	wp_page_menu( array(
		'show_home' 	=> true,
    	'menu_class' 	=> '', // adding custom nav class
		'include'     	=> '',
		'exclude'     	=> '',
		'echo'        	=> true,
        'link_before' 	=> '', // before each link
        'link_after' 	=> '' // after each link
	) );
}

 ?>