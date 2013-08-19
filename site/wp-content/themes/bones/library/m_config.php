<?php
	// path definition used internally for the tool kit
	// Requires the folder structure to remain intact
	
	$path_parts = pathinfo(__FILE__);
	define('M_TOOLPATH', $path_parts['dirname'] . '/'); //system based path	
	//define('TOOLURL', currentBaseURI().'/wp-content/themes/rodrigoMaia/m_toolbox/'); //OFFLINE HTTP based path (for image manipulation)		
	define('M_TOOLURL', get_bloginfo('template_url').'/library/'); //ONLINE HTTP based path (for image manipulation)	
	
	//Required for Google TinyURL
	define('GOOGLE_API_KEY', 'AIzaSyBLxv3xZgvL-MyMHGCupCydYMnuUsrCU14');
	define('GOOGLE_ENDPOINT', 'https://www.googleapis.com/urlshortener/v1');
	
	//Default cropping sizes for placement and timthumb
	define('CROP_HEIGHT', 500);
	define('CROP_WIDTH', 960);
	define('CROP_ZC', 1);
	
	//required for Facebook apps (Like Box, Comment Box)
	define('FB_ID', '484903678202954');
	define('FB_ADMINS', '100002548638400,100001690880856,519928988');
	define('FB_SECRET', '');
	define('FB_APP_URL', '');
	define('FB_BASEURL', '');
	
	// OG defaults settings 
	define('OG_TITLE', 'Myocracy');
	define('OG_DESCRIPTION', 'Goverment by design');
	define('OG_URL', 'http://myocracy.org/');
	define('OG_TYPE', 'website');
	define('OG_IMAGE', 'http://preview.myocracy.org/wp-content/themes/bones/library/images/logo.png');
