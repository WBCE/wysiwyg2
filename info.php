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



$module_directory = 'wysiwyg2';
$module_name = 'WYSIWYG2';
$module_function = 'page';
$module_version = '0.3';
$module_platform = '1.4';
$module_author = 'Norbert Heimsath';
$module_license = 'WTFPL';
$module_description = 'WYSIWYG Module whith some extra fields';

/*
0.3 2020/05/27
! Fix for Fatal Error when used with other wysiwyg2 based modules on the same page (thx to Bernd)

 v0.2.1  fixed some deprecated for PHP7.4 (Bernd)
