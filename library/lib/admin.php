<?php
/**
 * 	Removes widgets from dashboard in admin
 * 	@since Beruf 1.0
 * 	@return Remove widgets from dashboard in admin
 */

// disable default dashboard widgets
function disable_default_dashboard_widgets() {
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'core' );    		// Right Now Widget
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'core' ); 	// Comments Widget
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'core' );  	// Incoming Links Widget
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'core' );         	// Plugins Widget
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'core' );  		// Quick Press Widget
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'core' );   	// Recent Drafts Widget
	remove_meta_box( 'dashboard_primary', 'dashboard', 'core' );         	//
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'core' );       	//
	remove_meta_box( 'dashboard_activity', 'dashboard', 'core' );       	// Activity Widget
}

// removing the dashboard widgets
add_action( 'admin_menu', 'disable_default_dashboard_widgets' );

// remove "Welcome to WordPress"
remove_action( 'welcome_panel', 'wp_welcome_panel' );



/**
 * 	Login Styles and Scripts
 * 	@since Beruf 1.0
 * 	@return Enqueue all scripts and styles in login
 */

function login_css() {
	wp_enqueue_style( 'login_css', get_template_directory_uri() . '/library/css/login.css', false );
}
function login_js() {
    wp_enqueue_script( 'login_js', get_template_directory_uri() . '/library/js/login.js', null, null, true );
    wp_enqueue_script( 'jquery' );
}
add_action( 'login_enqueue_scripts', 'login_css', 10 );
add_action( 'login_enqueue_scripts', 'login_js' );

// changing the logo link from wordpress.org to your site
function login_url() {  return home_url(); }

// changing the alt text on the logo to show your site name
function login_title() { return get_option( 'blogname' ); }

add_filter( 'login_headerurl', 'login_url' );
add_filter( 'login_headertitle', 'login_title' );



/**
 * 	Admin Styles and Scripts
 * 	@since Beruf 1.0
 * 	@return Enqueue all scripts and styles in admin
 */

function admin_css() {
	wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/library/css/admin.css', false );
}
function admin_js() {
    wp_enqueue_script( 'admin_js', get_template_directory_uri() . '/library/js/admin.js', null, null, true );
    wp_enqueue_script( 'jquery' );
}
add_action( 'admin_enqueue_scripts', 'admin_css', 10 );
add_action( 'admin_enqueue_scripts', 'admin_js' );



/**
 * 	Footer area in admin
 * 	@since Beruf 1.0
 * 	@return Change the text in the footer area in admin
 */

function bones_custom_admin_footer() {
	_e( '<span id="footer-thankyou">Udviklet af <a href="https://beruf.dk" target="_blank">Beruf</a></span>', 'bonestheme' );
}
add_filter( 'admin_footer_text', 'bones_custom_admin_footer' );



/**
 * 	Adding custom widget to the dashboard area in admin
 * 	@since Beruf 1.0
 * 	@return Change the text in the footer area in admin
 */

// Register the widget
function velkommen_add_dashboard_widgets() {
	wp_add_dashboard_widget(
                 'welcome_widget',         				// Widget slug.
                 'Velkommen til din hjemmeside',        // Title.
                 'velkommen_dashboard_widget_function' 	// Display function.
        );	
}
add_action( 'wp_dashboard_setup', 'velkommen_add_dashboard_widgets' );

// Widget content
function velkommen_dashboard_widget_function() { ?>
	<div class="welcome-panel">
		<p class="about-description">
			Velkommen til administrations området for din hjemmeside. Her kan du oprette sider/indlæg, rette tekster, ændre menuen, skifte billeder, mm.  
		</p>
		<div class="welcome-panel-column" style="width: 100%;">
			<h4>Næste trin</h4>
			<ul>
				<li><a href="<?php echo get_site_url(); ?>/wp-admin/post-new.php" class="welcome-icon welcome-write-blog">Skriv dit første indlæg/nyhed</a></li>
				<li><a href="<?php echo get_site_url(); ?>/wp-admin/post-new.php?post_type=page" class="welcome-icon welcome-add-page">Tilføj en ny side</a></li>
				<li><a href="<?php echo get_site_url(); ?>" class="welcome-icon welcome-view-site">Se dit websted</a></li>
				<li><div class="welcome-icon welcome-widgets-menus"><a href="<?php echo get_site_url(); ?>/wp-admin/nav-menus.php">Ændre din menu</a></div></li>
			</ul>
		</div>
	</div>
<?php }

// Register the widget
function support_add_dashboard_widgets() {
	wp_add_dashboard_widget(
                 'support_widget',         				// Widget slug.
                 'Support',        // Title.
                 'support_dashboard_widget_function' 	// Display function.
        );	
}
add_action( 'wp_dashboard_setup', 'support_add_dashboard_widgets' );

// Widget content
function support_dashboard_widget_function() { ?>
	<div class="welcome-panel">
		<div class="support">
			<h4>Brug for hjælp?</h4>
			<p class="about-description">Kontakt os hvis du brug for hjælp eller support. <br>Vi sidder altid klar til at hjælpe dig. </p>
			<!-- Skift til .michael for andet billede -->
			<div class="portrait martin"> 
			</div>
			<div class="text">
				<h5>Martin Jespersen</h5>
				<p>Webudvikler</p>
				<p>
					<a href="tel:+4530303030">+45 30 30 30 30</a>
				</p>
				<p>
					<a href="mailto:mj@beruf.dk">mj@beruf.dk</a>
				</p>
			</div>
		</div>
	</div>
<?php }


/**
 * 	Add new format dropdown to the TinyMCE editor
 * 	@since Beruf 1.0
 * 	@return Adds an class to the marked element
 */
// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'my_mce_buttons_2');

// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {  
    // Define the style_formats array
    $style_formats = array(  
        // Each array child is a format with it's own settings
        array(  
            'title' => 'Lav et link om til en knap',  
            'selector' => 'a',  
            'classes' => 'btn btn-primary btn-content'             
        )
    );  
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );  

    return $init_array;  

} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );


/**
 * 	
 * 	@since Beruf 1.0
 * 	@return 
 */
function custom_menu_order($menu_ord) {
    if (!$menu_ord) return true;
    return array(
		'index.php', // Dashboard
		'separator1', // First separator
		'edit.php',
		'edit.php?post_type=page',
		'formidable', 
		'mermaid-general-settings', // options
		'separator2', // Second separator
		'themes.php', // Appearance
		'upload.php', // Media
		'plugins.php', // Plugins
		'users.php', // Users
		'tools.php', // Tools
		'options-general.php', // Settings
		'separator-last' // Last separator
    );
}
//add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order
//add_filter('menu_order', 'custom_menu_order');

//add_action('admin_menu', 'my_remove_sub_menus');

function my_remove_sub_menus() {
    remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
}

function remove_menus(){

	//remove_menu_page( 'edit.php' );                   //Posts
	//remove_menu_page( 'edit.php?post_type=page' );    //Pages
	//remove_menu_page( 'edit-comments.php' );          //Comments
  
}
add_action( 'admin_menu', 'remove_menus' );


// Disable comments

?>
