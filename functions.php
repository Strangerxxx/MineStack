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
	return(!empty($headers['Name']))? $headers : false;
}
function includeStacks($stacks) {
	if($stacks){
		foreach($stacks as $stack){
			if(get_option($stack['Name'], 0) != 0){
				if(!get_option($stack['Name'])){
					echo include($stack['path']);
				}
			}
			else return add_option($stack['Name']);
		}
	}
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
				if(!empty($stack['Name'])){
					$stack[path] = $path;
					array_push($result, $stack);
				} else $result = false;
			}
		}
	}
	return $result;
}