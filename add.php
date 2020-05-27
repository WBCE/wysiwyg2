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

// Insert an extra row into the database
$sql = 'INSERT INTO `'.TABLE_PREFIX.'mod_wysiwyg2` '
     . 'SET `page_id`='.$page_id.', '
     .     '`section_id`='.$section_id.', '
     .     '`headline`=\'\', '
     .     '`content_short`=\'\', '
     .     '`content`=\'\', '
     .     '`image`=\'\'';
$database->query($sql);

