<?php
/*
	Stack Name: Launcher
	Stack URI: http://gamegen.org
	Description: Launcher
	Version: 0.1
	Author: Stranger
	Author URI: http://gamegen.org
	License: GPLv2
*/
define( 'LAUNCHER_STACKPATH', stack_dir_path(__FILE__) );
function getContent() {
	global $wpdb;
	include(LAUNCHER_STACKPATH."/pages/".$_GET['mine'].".php");
}
function getTemplate() {
	include(LAUNCHER_STACKPATH."/blank.php");
	exit;
}
if ($_GET['mine'] == 'launcher') {
	add_filter('the_content','getContent');
	add_action('template_redirect', 'getTemplate');
}