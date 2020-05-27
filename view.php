<?php
/**
 * @category        modules
 * @package         wysiwyg2
 * @author          WBCE Project
 * @copyright       Norbert Heimsath
 * @license			WTFPL
 */
//no direct file access
if(count(get_included_files()) ==1){$z="HTTP/1.0 404 Not Found";header($z);die($z);}

// fetch the function fo template loading , this should be in core 
require_once (WB_PATH."/modules/wysiwyg2/includes/get_tpl_file.php");

// fetch MEdial url for replace {SYSVAR:MEDIA_REL}
$sMediaUrl = WB_URL.MEDIA_DIRECTORY;

// Get content 
$content = '';
$content_short = '';
$headline = '';
$image = '';

$sql = 'SELECT * FROM `'.TABLE_PREFIX.'mod_wysiwyg2` WHERE `section_id`='.(int)$section_id;
$get_content = $database->query($sql);
$rows = $get_content->numRows();
if ($rows==1) {
	$Data = $get_content->fetchRow();
	
	// get values for Variables
	$content = str_replace('{SYSVAR:MEDIA_REL}', $sMediaUrl, $Data['content'] );	
	$content_short = $Data['content_short'];
	$headline = $Data['headline'];
	if ($Data['image']!="") 
		$image = str_replace('{SYSVAR:MEDIA_REL}', $sMediaUrl, $Data['image'] );

} else {
	$content= "<h3>Database error, did not found the right number of rows ($rows)</h3>" ;
}


// I think the Module function should provide an even more complete set of data
// maybe even better provide a global registry whith this data 
// this schould be far more like : User created, user last edited , last edited , created date....
$page_title=$wb->page_title;
$page_description=$wb->page_description;
$page_keywords=$wb->page_keywords;

//if the Template got a special template for this override the default one
include (GetModTplFile('wysiwyg2'));




