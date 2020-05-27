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


//Load Language Files
if (file_exists(WB_PATH.'/modules/wysiwyg2/languages/'.LANGUAGE.'.php')) {
	require_once(WB_PATH.'/modules/wysiwyg2/languages/'.LANGUAGE.'.php');
}
else {
	require_once(WB_PATH.'/modules/wysiwyg2/languages/EN.php');
}
	


// Fetch media URL for replacing {SYSVAR:MEDIA_REL}
$sMediaUrl = WB_URL.MEDIA_DIRECTORY;

// Get page content   htmlspecialchars
$content = '';
$content_short = '';
$headline = '';
$image = WB_URL. "/modules/wysiwyg2/images/no_image.jpg";

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
	echo "<h3>Database error, did not found the right number of rows ($rows)</h3>" ;
}

if(mb_detect_encoding($content, 'UTF-8, '.strtoupper(DEFAULT_CHARSET)) === 'UTF-8'){
	// der String ist in UTF-8 kodiert
	//$content = (utf8_decode($content));
	//$content = (iconv("UTF-8", strtoupper(DEFAULT_CHARSET), $content));
}

//$content = utf8_decode($content);

// Lest see if a WYSIWYG editor ist set
if(!isset($wysiwyg_editor_loaded)) {
	$wysiwyg_editor_loaded=true;

	// No WYSIWYG Editor defined create a show_wysiwyg_editor() funktion, that only creates a textarea.
	if (!defined('WYSIWYG_EDITOR') OR WYSIWYG_EDITOR=="none" OR !file_exists(WB_PATH.'/modules/'.WYSIWYG_EDITOR.'/include.php')) {
		function show_wysiwyg_editor($name,$id,$content,$width,$height) {
			echo '<textarea name="'.$name.'" id="'.$id.'" style="width: '.$width.'; height: '.$height.';">'.$content.'</textarea>';
		}
	} else {
	// Ok we got a WYSIWYG defined asking myself for what we need the idlist
		$id_list = array();
		$sql  = 'SELECT `section_id` FROM `'.TABLE_PREFIX.'sections` ';
		$sql .= 'WHERE `page_id`='.(int)$page_id.' AND `module`=\'wysiwyg2\'';
		if (($query_wysiwyg = $database->query($sql))) {
			while($wysiwyg_section = $query_wysiwyg->fetchRow()) {
				$entry='content'.$wysiwyg_section['section_id'];
				$id_list[] = $entry;
			}
			require(WB_PATH.'/modules/'.WYSIWYG_EDITOR.'/include.php');
		}
	}
}





include (WB_PATH."/modules/wysiwyg2/templates/modify.tpl.php");


