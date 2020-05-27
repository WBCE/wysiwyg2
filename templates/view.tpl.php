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

/*
Available Vars:
$headline           Simply the headline.
$content_short      Short teaser Text , mostly used in short views.
$content		    Full content
$image              Is the Image url 
$section_id         The section Id
$page_id            The page Id
$page_title         Page title
$page_description   Page description
$page_keywords      Page keywords

*/?>
<style>/*
as we got a nice Filter that moves this to the head , i simply use this 
you could even use the frontend.css, but as this feature is more or less deprecated , 
i do it this way for now.
*/
.wysiwyg2 .imageholder {width:300px; border; 1px solid red; vertical-align: top; text-align: center;padding-right: 15px}
.wysiwyg2 .imageholder img {width:300px; border; 1px solid green; }
.wysiwyg2 .textholder {vertical-align: top; text-align: left;}
.wysiwyg2 table {width:100%;}
.wysiwyg2 table	td {padding: 0px}
</style>
<div class="wysiwyg2"><!-- for easy css-->
	<h2><?php echo $headline ?></h2>
	<table>
		<tr>
			<?php if ($image!=""): ?>
			<td class="imageholder"><img src="<?php echo $image ?>" title="" alt="<?php echo $headline ?>" /></td>
			<?php endif; ?>
			<td class="textholder"><?php echo $content ?></td>
		</tr>
	</table>	
</div>
