<?php
/**
 *
 * @category        modules
 * @package         wysiwyg2
 * @author          WBCE Project
 * @copyright       Norbert Heimsath
 * @license			WTFPL
 *
 */

//no direct file access
if(count(get_included_files()) ==1){$z="HTTP/1.0 404 Not Found";header($z);die($z);}

function wysiwyg2_search($func_vars) {
	extract($func_vars, EXTR_PREFIX_ALL, 'func');
	static $search_sql = FALSE;
	if(function_exists('search_make_sql_part')) {
		if($search_sql===FALSE)
			$search_sql = search_make_sql_part($func_search_url_array, $func_search_match, array('`content`'));
	} else {
		$search_sql = '1=1';
	}
	
	// how many lines of excerpt we want to have at most
	$max_excerpt_num = $func_default_max_excerpt;
	$divider = ".";
	$result = false;
	
	// we have to get 'content' instead of 'text', because strip_tags() dosen't remove scripting well.
	// scripting will be removed later on automatically
	$table = TABLE_PREFIX."mod_wysiwyg2";
	$query = $func_database->query("
		SELECT content
		FROM $table
		WHERE section_id='$func_section_id'
	");

	if($query->numRows() > 0) {
		if($res = $query->fetchRow()) {
			$mod_vars = array(
				'page_link' => $func_page_link,
				'page_link_target' => "#wb_section_$func_section_id",
				'page_title' => $func_page_title,
				'page_description' => $func_page_description,
				'page_modified_when' => $func_page_modified_when,
				'page_modified_by' => $func_page_modified_by,
				'text' => $res['content'].$divider,
				'max_excerpt_num' => $max_excerpt_num
			);
			if(print_excerpt2($mod_vars, $func_vars)) {
				$result = true;
			}
		}
	}
	return $result;
}

?>
