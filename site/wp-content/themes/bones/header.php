<!doctype html>  

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	
	<head>
		<meta charset="utf-8">
		
		<title><?php wp_title(''); ?></title>
		
		<!-- Google Chrome Frame for IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<!-- mobile meta (hooray!) -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
		
		<!-- icons & favicons (for more: http://themble.com/support/adding-icons-favicons/) -->
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
				
  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		
		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->
			
		<!-- drop Google Analytics Here -->
		<!-- end analytics -->
		
	</head>
	
	<body <?php body_class(); ?>>
	
		<div id="container">
			
			<header class="header" role="banner">
			
				<div id="inner-header" class="wrap clearfix">
					<div class="preheader">
						<div class="login-register">
							<?php if ( !is_user_logged_in() ) { ?>
							<a href="<?php echo home_url(); ?>/login/" class="login">Login</a> or <a href="<?php echo home_url(); ?>/registration-choice/" class="register">Register</a>
							<?php } else { ?>
							<a href="<?php echo home_url(); ?>/user-profile/" class="register">Profile</a>
							<?php } ?>
						</div>
					</div>

					<!-- to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> -->
					<a href="<?php echo home_url(); ?>" rel="nofollow"><div id="logo"><?php bloginfo('name'); ?></div></a>
					
					<!-- if you'd like to use the site description you can un-comment it below -->
					<?php // bloginfo('description'); ?>
					
					
					<nav role="navigation">
						<?php bones_main_nav(); ?>
					</nav>
				
					<?php if(is_home()||is_front_page()) { ?>
					<div class="splash s-full clearfix">
						<div class="cta-text">
							<h3>Just because you can vote, doesn’t mean you should.</h3>
							<h4>The future of your freedom is worth (3) minutes<br />(We hope!)</h4>
						</div>
						<a class="cta-arrow" href="<?php echo home_url(); ?>/	issues-candidates/"><span class="font-white">Get</span> <span class="font-red">Informed</span></a>
					</div>
					<?php } else { ?>
					<div class="splash clearfix"></div>
					<?php } ?>
				</div> <!-- end #inner-header -->

			
			</header> <!-- end header -->
