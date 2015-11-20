<?php
/*************** AJAX ACTION **************/
add_action('wp_ajax_nopriv_do_ajax', 'ajax_case_function');
add_action('wp_ajax_do_ajax', 'ajax_case_function');
function ajax_case_function(){
     // now we'll write what the server should do with our request here

   // the first part is a SWTICHBOARD that fires specific functions
   // according to the value of Query Var 'fn'

     switch($_REQUEST['case']){
          case 'case1':
              // $output ='test';
              // $cat = $_REQUEST['cat'];
              // $offset = $_REQUEST['offset'];
              $output = ajax_get_data();
          break;
          // case 'case2':
          //     // $output ='test';
          //     $offset = $_REQUEST['offset'];
          //     $output = ajax_get_data2();
          // break;
          default:
              $output = 'No function specified, check your jQuery.ajax() call';
          break;
     }
 
   // at this point, $output contains some sort of valuable data!
   // Now, convert $output to JSON and echo it to the browser
   // That way, we can recapture it with jQuery and run our success function
    $output=json_encode($output);
    if(is_array($output)){
        print_r($output);
    }
    else{
        echo $output;
    }
    die;

}

function ajax_get_data(){
	//put in array
	$allObjects = array();
	$args= array(
	        'post_type'=> 'posttype',
		    'posts_per_page'=>-1,
		    'orderby' => 'date',
		    'order' => 'DESC',
	    );

	    $posts = new WP_Query($args);
	    
	    //$foundposts = $posts->found_posts;
	    
	    if ( $posts->have_posts() ) {
	          while ( $posts->have_posts() ) {
	            $posts->the_post(); 
	            
	            //$permalink = get_permalink();
	            $theTitle = get_the_title();
	            $theContent = get_the_content();
	            $eventId = get_the_id();
				$feat_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	            
	            $SingleObj = array();
	     
	            $SingleObj[postid] = $eventId;
	            $SingleObj[Title] = $theTitle;
	            $SingleObj[content] = $theContent;
	            $SingleObj[fetured_image] = $feat_img;

	            array_push($allObjects , $SingleObj);
        	}
        
	}
	wp_reset_postdata();
	return $allObjects;
}


?>