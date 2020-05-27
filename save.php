<?php
/**
 * @category        modules
 * @package         wysiwyg2
 * @author          WBCE Project
 * @copyright       Norbert Heimsath
 * @license			WTFPL
 */

// Fetch config and Initialize
require('../../config.php');

// later we get the autoloader
require_once (WB_PATH."/modules/wysiwyg2/classes/class.upload.php");

// suppress to print the header, so no new FTAN will be set
// This is only here till we remove singletab 
$admin_header = false;

// Tells script to update when this page was last updated
$update_when_modified = true;

// Include WB admin wrapper script
require(WB_PATH.'/modules/admin.php');

// Check for Valid FTAN
if (!$admin->checkFTAN()) {
	$admin->print_header();
	$admin->print_error($MESSAGE['GENERIC_SECURITY_ACCESS'], ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
}

// After check print the header Maybe we too no longer need this.. we will see 
$admin->print_header();

// Include the WB functions file
require_once(WB_PATH.'/framework/functions.php');

// fetch MEdial url for replace {SYSVAR:MEDIA_REL}
$sMediaUrl  = WB_URL.MEDIA_DIRECTORY;


// What the fuck is this? Ahhhh, its for save and return
$bBackLink = isset($_POST['pagetree']);

// Update the mod_wysiwygs table with the contents
if(isset($_POST['content'.$section_id])) 
    $content = $_POST['content'.$section_id];
if(isset($_POST['content_short'.$section_id])) 
    $content_short = $_POST['content_short'.$section_id];
if(isset($_POST['headline'.$section_id])) 
    $headline = $_POST['headline'.$section_id];


//this one is special, as we got a file upload 
$image="";
$sUploadError="";
//if we got an upload

$handle = new upload($_FILES['image'.$section_id]);
if ($handle->uploaded) { //this check is somewhat buggy , not sure why 

	//unlik old files
	array_map('unlink', glob(WB_PATH.MEDIA_DIRECTORY.'/wysiwyg2/s'.$section_id."_*"));

	//construct and set new filename
	$iname='s'.$section_id."_".strtolower($handle->file_src_name_body);
	//echo "<br>inem :".$iname."<br>";
	$handle->file_new_name_body   = $iname;	

	// Move file to Target dir whith new filename
	$handle->process(WB_PATH.MEDIA_DIRECTORY.'/wysiwyg2/');
	if ($handle->processed) { //sucess, now set image value
		$image = '{SYSVAR:MEDIA_REL}/wysiwyg2/'.$iname.'.'.$handle->file_src_name_ext;
		$handle->clean();
	} 
	else { // failed, echo error 
		echo "Handle error".$handle->error;
	}
} 
else { //upload failed, echo error
		//echo "Uploaderror:".$handle->file_src_error;
}
//echo "<br>image :".$image."<br>";


// one more special case , delete the image is set, this overrides the upload and delete it. 
if(isset($_POST['delete'.$section_id])) {
	array_map('unlink', glob(WB_PATH.MEDIA_DIRECTORY.'/wysiwyg2/s'.$section_id."_*"));
	$image="";
}


// Magic Quotes, this should be no longer necessary, but possibly it still is 
if(ini_get('magic_quotes_gpc')==true) {
	$content = $admin->strip_slashes($content);
	$content_short = $admin->strip_slashes($content_short);
	$headline = $admin->strip_slashes($headline);
	$image = $admin->strip_slashes($image);
}

// Replacement for Media Url (correct adresses for images if site is moved)
$searchfor = '@(<[^>]*=\s*")('.preg_quote($sMediaUrl).')([^">]*".*>)@siU';
$content = preg_replace($searchfor, '$1{SYSVAR:MEDIA_REL}$3', $content);
// Sanitize Short text and headline
$content_short = strip_tags($content_short);
$headline = strip_tags($headline);

// Generate SQL Query and run it 

// only mess whith image, when an image is actually uploaded
$imquery="";
if ($image !="") $imquery='`image`=\''.$database->escapeString($image).'\', ';

// now create the rest of the query
$sql = 'UPDATE `'.TABLE_PREFIX.'mod_wysiwyg2` '
     . 'SET `content`=\''.$database->escapeString($content).'\', '
     .     '`content_short`=\''.$database->escapeString($content_short).'\', '
     .     $imquery
     .     '`headline`=\''.$database->escapeString($headline).'\' '
     . 'WHERE `section_id`='.(int)$section_id;
$database->query($sql);

// is this stuff done vor setting back link ? there should be something better...
$sec_anchor = (defined( 'SEC_ANCHOR' ) && ( SEC_ANCHOR != '' )  ? '#'.SEC_ANCHOR.$section['section_id'] : '' );
if(defined('EDIT_ONE_SECTION') && EDIT_ONE_SECTION){
    $edit_page = ADMIN_URL.'/pages/modify.php?page_id='.$page_id.'&wysiwyg2='.$section_id;
} elseif ( $bBackLink ) {
	$edit_page = ADMIN_URL.'/pages/index.php';
} else {
    $edit_page = ADMIN_URL.'/pages/modify.php?page_id='.$page_id.$sec_anchor;
}

// Check if there is a database error, otherwise say successful
if ($database->is_error()) {
	$admin->print_error($database->get_error(), $js_back);
} else {
	$admin->print_success($MESSAGE['PAGES_SAVED'], $edit_page );
}

// Print admin footer //This displays the footer/End of admin page 
$admin->print_footer();


