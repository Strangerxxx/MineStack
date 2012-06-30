<?php
/*

	Functions file
	@package: WordPress
	@subpackage: MineStack
	
*/
function getHeaders($file) {
	$default_headers = array(
		'Name' => 'Stack Name',
		'PluginURI' => 'Stack URI',
		'Version' => 'Version',
		'Description' => 'Description',
		'Author' => 'Author',
		'AuthorURI' => 'Author URI',
		'License' => 'License'
	);
	$headers = get_file_data($file, $default_headers);
	//return(!empty($headers['Name']))? $headers : false;
	return $headers;
}
function includeStacks() {
	$stacks = getStacks();
	if($stacks){
		foreach($stacks as $stack){
			if(!isRegisterStack($stack['Name'])) add_option($stack['Name'], false);
			if(get_option($stack['Name'])) include($stack['path']);
		}
	}
}
function isRegisterStack($name){
	return (get_option($name, 0) != 0)? true : false;
}
function stack_dir_path($file){
	return trailingslashit(dirname($file));
}
function getStacks() {
$result = array();
	if($handle = opendir(PLUGIN_PATH.'/stacks')){
		while (false !== ($entry = readdir($handle))) {
			if($entry != "." && $entry != "..") {
				if(is_dir(PLUGIN_PATH.'/stacks/'.$entry)){
					$entry_handle = opendir(PLUGIN_PATH.'/stacks/'.$entry);
					while(false !== ($file = readdir($entry_handle))){
						if($file != "." && $file != "..") {
							$path = PLUGIN_PATH.'stacks/'.$entry.'/'.$file;
						}
					}
				} else {
					$path = PLUGIN_PATH.'/stacks/'.$entry;
				}
				$stack = getHeaders($path);
				echo $path;
				if(!empty($stack['Name'])){
					$stack[path] = $path;
					array_push($result, $stack);
				} else $result = false;
			}
		}
	}
	return $result;
}