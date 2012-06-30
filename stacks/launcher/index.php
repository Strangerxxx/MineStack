<?php
/*
Plugin Name: Name Of The Plugin
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: The Plugin's Version Number, e.g.: 1.0
Author: Name Of The Plugin Author
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/
define( 'STACKPATH', stack_dir_path(__FILE__) );
function getContent() {
	global $wpdb;
	include(STACKPATH."/pages/".$_GET['mine'].".php");
	//return $return;
}
function getTemplate() {
	include("blank.php");
	exit;
}
if ($_GET['mine'] == 'launcher') {
	add_filter('the_content','getContent');
	add_action('template_redirect', 'getTemplate');
}