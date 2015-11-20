<?php
/**
 * 	Adding all the dependencies
 * 	@since Beruf 1.0
 * 	@return 
 */

// Navwalker
require_once( 'library/lib/navwalker.php' ); 

// Register custom post types
require_once( 'library/lib/custom-post-type.php' ); 

// Register menus
require_once( 'library/lib/menu.php' ); 

// Register sidebars
require_once( 'library/lib/sidebar.php' );

// Cleanup
require_once( 'library/lib/cleanup.php' ); 

// Add IE support
require_once( 'library/lib/ie.php' );

// Admin functions
require_once( 'library/lib/admin.php' );

// Advanced Custom Fields options
require_once( 'library/lib/acf.php' ); 

// Adding translations
//require_once( 'library/lib/translation/translation.php' ); 

// AJAX for WordPress goes here
//require_once( 'library/lib/ajax.php' ); // this comes turned off by default



/**
 * 	Initial all at start up
 * 	@since Beruf 1.0
 * 	@return
 */
add_action( 'after_setup_theme', 'bones_ahoy', 16 );
function bones_ahoy() {
    // launching operation cleanup
    add_action( 'init', 'head_cleanup' );
    // remove WP version from RSS
    add_filter( 'the_generator', 'remove_rss_version' );
    // remove pesky injected css for recent comments widget
    add_filter( 'wp_head', 'remove_wp_widget_recent_comments_style', 1 );
    // clean up comment styles in the head
    add_action( 'wp_head', 'remove_recent_comments_style', 1 );
    // clean up gallery output in wp
    add_filter( 'gallery_style', 'remove_gallery_style' );
    // enqueue base scripts and styles
    add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );

    theme_support();

    register_menu();

    // adding sidebars to Wordpress (these are created in functions.php)
    add_action( 'widgets_init', 'bones_register_sidebars' );
    // cleaning up random code around images
    add_filter( 'the_content', 'bones_filter_ptags_on_images' );
   
}



/**
 * 	Enqueueing scripts and styles for frontend
 * 	@since Beruf 1.0
 * 	@return
 */
function bones_scripts_and_styles() {
  global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
  if (!is_admin()) {

    //***** Styles **************
   
    // register main stylesheet
    wp_register_style( 'main-stylesheet', get_template_directory_uri() . '/library/css/style.css', array(), '', 'all' );

    // register main stylesheet
    wp_register_style( 'mmenu-stylesheet', get_template_directory_uri() . '/library/css/jquery.mmenu.all.css', array(), '', 'all' );

    // ie-only style sheet
    wp_register_style( 'ie-only', get_template_directory_uri() . '/library/css/ie.css', array(), '' );

    // enqueue styles
    wp_enqueue_style( 'main-stylesheet' );
    wp_enqueue_style( 'mmenu-stylesheet' );
    wp_enqueue_style( 'ie-only' );
    

    //***** Scripts **************

    // comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
		wp_enqueue_script( 'comment-reply' );
    }

    // download a custom file @ getbootstrap.com/customize/ if you don't want all js components
    wp_register_script( 'bones-bootstrap', get_template_directory_uri() . '/library/js/libs/bootstrap.min.js', array(), '3.0.0', true );

    // modernizr (without media query polyfill)
    wp_register_script( 'bones-modernizr', get_template_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '', false );

    // fitvids
    wp_register_script( 'bones-fitvids', get_template_directory_uri() . '/library/js/libs/jquery.fitvids.js', array(), '', false );

    // mmenu - mobile menu
    wp_register_script( 'bones-mmenu', get_template_directory_uri() . '/library/js/libs/jquery.mmenu.min.all.js', array(), '5.5.2', false );

    // angular CDN
    wp_register_script( 'angular', get_template_directory_uri() . '/library/js/libs/angular.min.js', array(), '1.4.8', false );

    // angular bootstrap CDN
    wp_register_script( 'angular-bootstrap', get_template_directory_uri() . '/library/js/libs/angular-ui.min.js', array(), '0.14.3', false );

    //adding scripts file in the footer
    wp_register_script( 'helper-js', get_template_directory_uri() . '/library/js/helper.js', array( 'jquery' ), '', true );

    //adding customs file in the footer
    wp_register_script( 'custom-js', get_template_directory_uri() . '/library/js/custom.js', array( 'jquery' ), '', true );

    // enqueue scripts
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'bones-bootstrap' );
    wp_enqueue_script( 'bones-modernizr' );
    wp_enqueue_script( 'bones-fitvids' );
    wp_enqueue_script( 'bones-mmenu' );
    wp_enqueue_script( 'custom-js' );
    wp_enqueue_script( 'helper-js' );

    // To activate AngularJS uncomment these two lines
    wp_enqueue_script( 'angular' );
    wp_enqueue_script( 'angular-bootstrap' );
    

  }
}



/**
 * 	Adding WP 3+ Functions & Theme Support
 * 	@since Beruf 1.0
 * 	@return Its still under going work
 */
function theme_support() {

	add_theme_support( 'post-thumbnails' );

	// default thumb size
	set_post_thumbnail_size(125, 125, true);

	// rss thingy
	add_theme_support('automatic-feed-links');	
} 



/**
 * 	Thumbnail sizes
 * 	@since Beruf 1.0
 * 	@return 
 */
//add_image_size( 'big-thumb', 600, 150, true );




/**
 * 	Modify the content "Read more" link
 * 	@since Beruf 1.0
 * 	@return 
 */
function mod_content_more( $link, $link_button ) {   
    return str_replace( $link_button, '<p><a href="' . get_permalink() . '" class="readmore btn btn-sm btn-primary ">' . __( 'Continue Reading...', 'bonestheme' ) . ' </a> </p>', $link );
}
add_filter( 'the_content_more_link', 'mod_content_more', 10, 2 );



/**
 * 	Modify the excerpt "Read more" link
 * 	@since Beruf 1.0
 * 	@return 
 */
function mod_excerpt_more($more) {
	global $post;
	return '...</p><p><a class="excerpt-read-more btn btn-primary" href="'. get_permalink($post->ID) . '" title="'. __( 'Read', 'bonestheme' ) . get_the_title($post->ID).'">'. __( 'Read More', 'bonestheme' ) .'</a>';
}
add_filter( 'excerpt_more', 'mod_excerpt_more' );



/**
 * 	Hide the admin bar on frontend
 * 	@since Beruf 1.0
 * 	@return 
 */
//add_filter('show_admin_bar', '__return_false');



/**
 *  Checking if comment navigation is enabled
 * 	@since Beruf 1.0
 * 	@return 
 */
function page_has_comments_nav() {
 global $wp_query;
 return ($wp_query->max_num_comment_pages > 1);
}



/**
 * 	Comments layout 
 * 	@since Beruf 1.0
 * 	@return 
 */
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix comment-container">
			<div class="comment-author vcard">
				<?php
				/*
					this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='32',$default='<path_to_url>' );
				*/
				?>
				<?php // custom gravatar call ?>
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=64" class="load-gravatar avatar avatar-48 photo" height="64" width="64" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
				<?php // end custom gravatar call ?>
			</div>
      <div class="comment-content">
        <?php printf(__( '<cite class="fn">%s</cite>', 'bonestheme' ), get_comment_author_link()) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>
        <?php edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ?>
  			<?php if ($comment->comment_approved == '0') : ?>
  				<div class="alert alert-info">
  					<p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
  				</div>
  			<?php endif; ?>
  			<section class="comment_content clearfix">
  				<?php comment_text() ?>
  			</section>
  			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div> <!-- END comment-content -->
		</article>
	<?php // </li> is added by WordPress automatically ?>
<?php
} 


/**
 * 	Pings layout
 * 	@since Beruf 1.0
 * 	@return 
 */
function list_pings( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
	<li id="comment-<?php comment_ID(); ?>">
		<span class="pingcontent">
			<?php printf(__('<cite class="fn">%s</cite> <span class="says"></span>'), get_comment_author_link()) ?>
			<?php comment_text(); ?>
		</span>
	</li>
<?php }




