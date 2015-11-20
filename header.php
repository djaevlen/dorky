<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // Google Chrome Frame for IE ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php if (is_front_page()) { bloginfo('name'); } else { wp_title(''); } ?></title>

		<?php // mobile meta ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> <!--320-->

		<?php // icons & favicons http://www.favicon-generator.org/ ?>
		
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>
	
	</head>

	<body <?php body_class(); ?>>

		<div class="mmenu-body"> <!-- mmenu start -->

		    <header class="header">

		    	<nav id="mobile-menu">
		    		<?php mobile_nav(); ?>
		    	</nav>

		      	<nav id="main-menu" role="navigation">
		        	<div class="navbar navbar-default navbar-fixed-top Fixed">
		          		<div class="container">
			            	<div class="navbar-header">
			              		<button type="button" class="navbar-toggle" id="mobile-menu-button">
		                			<span class="icon-bar"></span>
			                		<span class="icon-bar"></span>
			                		<span class="icon-bar"></span>
			              		</button>

			              		<a class="navbar-brand" href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="homepage"><?php bloginfo('name'); ?></a>

			            	</div>

			            	<div class="navbar-collapse collapse navbar-responsive-collapse">
			              		<?php main_nav(); ?>
			            	</div>
			          	</div>
		        	</div> 
		      	</nav>

			</header> 
