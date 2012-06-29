<?php
/*
    Plugin Name: MineStack
    Plugin URI: http://gamegen.org
    Description: Minecraft stack for WordPress
    Author: Stranger
    Version: 0.1
    Author URI: http://gamegen.org
*/
define('STACK_URL', plugin_dir_url(__FILE__));
define('STACK_PATH', plugin_dir_path(__FILE__));
include('admin-page.php');
function css_init() {
    wp_register_style('style.css', STACK_PATH. 'style.css');
    wp_enqueue_style('style.css');
}
add_action('admin_init', 'css_init');
function create_menu() {
	add_menu_page('MineStack', 'MineStack', 'administrator','minestack', 'display_stacks', STACK_URL.'/img/favicon.png');
}
add_action('admin_menu', 'create_menu');