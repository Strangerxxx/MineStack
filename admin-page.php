<?php
/*

	Admin page file
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
function getStacks() {
$result = array();
	if($handle = opendir(STACK_PATH.'/stacks')){
		while (false !== ($entry = readdir($handle))) {
			if($entry != "." && $entry != "..") {
				if(is_dir(STACK_PATH.'/stacks/'.$entry)){
					$entry_handle = opendir(STACK_PATH.'/stacks/'.$entry);
					while(false !== ($file = readdir($entry_handle))){
						if($file != "." && $file != "..") {
							$headers = getHeaders(STACK_PATH.'stacks/'.$entry.'/'.$file);
							if($headers){
								array_push($result, $headers);
							}
						}
					}
				} else {
					$headers = getHeaders(STACK_PATH.'/stacks/'.$entry);
					if($headers){
						array_push($result, $headers);
					}
				}
			}
		}
	}
	return $result;
}
function display_stacks() {
	$stacks = getStacks();
?>
		<div id="wrap" class="wrap" style="width: 50%">
			<table width="50px" cellspacing="0" class="wp-list-table widefat fixed posts">
				<thead>
					<tr>
						<th class="manage-column column-title" id="StackName" scope="col">
							<span>Stack Name</span>
						</th>
						<th class="manage-column column-title" id="Author" scope="col">
							<span>Author</span>
						</th>
						<th class="manage-column column-title" id="Description" scope="col">
							<span>Description</span>
						</th>
					</tr>
				</thead>
				<tbody id="the-list">
					<? if ($stacks) {
							foreach($stacks as $stack){ ?>
					<tr valign="top" class="post-1 post type-post status-publish format-standard hentry category-- alternate iedit author-self" id="post-1">
						<td class="post-title page-title column-title">
							<?php echo $stack['Name'].'&nbsp'.$stack['Version']; ?>
						</td>
						<td class="post-title page-title column-title">
							<strong>
								<span class="row-title"><?php echo $stack['Author'] ?></span>
							</strong>
						</td>
						<td class="post-title page-title column-title">
							<strong>
								<?php echo $stack['Description'] ?>
							</strong>
						</td>
					</tr>
					<?php
							}
						} ?>
            </tbody>
				<tfoot>
					<tr>
						<th class="manage-column column-title" id="StackName" scope="col">
							<span>Stack Name</span>
						</th>
						<th class="manage-column column-title" id="Author" scope="col">
							<span>Author</span>
						</th>
						<th class="manage-column column-title" id="Description" scope="col">
							<span>Description</span>
						</th>
					</tr>
				</tfoot>
			</table>
		</div>
	<?
}
?>