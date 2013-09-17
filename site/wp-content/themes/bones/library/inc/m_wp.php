<?php
	//Metabox based path
	define('M_METAPATH', M_TOOLPATH . 'inc/wp/metaboxes/');	
	include (M_METAPATH .'MediaAccess.php'); //Custom Meta Data Class
	include (M_METAPATH .'MetaBox.php'); //Custom Meta Data Class
	include (M_METAPATH .'metaSetup.php'); //Setup Custom Meta Data 
	
	include_once ('wp/m_post.php');
	include_once ('wp/m_image.php');
	include_once ('wp/m_metabox.php'); //additional WP Alchemy functions
?>