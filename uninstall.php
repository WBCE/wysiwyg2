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


//Drop the database
$database->query("DROP TABLE IF EXISTS `".TABLE_PREFIX."mod_wysiwyg2");

require_once(WB_PATH.'/framework/functions.php');

//delete image dir
rm_full_dir(WB_PATH."media/wysiwyg2/"); 
