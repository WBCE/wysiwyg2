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

if (!function_exists('GetModTplFile')) :
	function GetModTplFile($sModule, $sTplFile="view.tpl.php") {
		$tpath=WB_PATH."/templates/".TEMPLATE."/modules/".$sModule."/".$sTplFile;
		if (file_exists ($tpath)) return $tpath;
		else return (WB_PATH."/modules/".$sModule."/templates/".$sTplFile) ;
	}
endif; 
