<?php
/*
    Plugin Name: MineStack
    Plugin URI: http://gamegen.org
    Description: Minecraft stack for WordPress
    Author: Stranger
    Version: 0.1
    Author URI: http://gamegen.org
*/
define('PLUGIN_URL', plugin_dir_url(__FILE__));
define('PLUGIN_PATH', plugin_dir_path(__FILE__));
include('functions.php');
include('admin-page.php');
function css_init() {
    wp_register_style('style.css', PLUGIN_PATH. 'style.css');
    wp_enqueue_style('style.css');
}
function create_menu() {
	add_menu_page('MineStack', 'MineStack', 'administrator','minestack', 'display_stacks', PLUGIN_URL.'/img/favicon.png');
}
add_action('init', 'includeStacks');
add_action('admin_init', 'css_init');
add_action('admin_menu', 'create_menu');