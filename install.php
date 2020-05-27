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


// Create DB table
//$database->query("DROP TABLE IF EXISTS `".TABLE_PREFIX."mod_wysiwyg2`");
$mod_wysiwyg = 'CREATE TABLE IF NOT EXISTS `'.TABLE_PREFIX.'mod_wysiwyg2` ( '
	. ' `section_id` INT NOT NULL DEFAULT \'0\','
	. ' `page_id` INT NOT NULL DEFAULT \'0\','
	. ' `headline` TEXT NOT NULL ,'
	. ' `content` LONGTEXT NOT NULL ,'
	. ' `content_short` LONGTEXT NOT NULL ,'
	. ' `image` TEXT NOT NULL ,'
	. ' PRIMARY KEY ( `section_id` ) '
	. ' ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci';
$database->query($mod_wysiwyg);

require_once(WB_PATH.'/framework/functions.php');

//create directory for images
make_dir(WB_PATH.'/media/wysiwyg2/');
