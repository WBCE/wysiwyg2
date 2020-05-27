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

// edit form for wysiwyg2

?>

<form name="wysiwyg<?php echo $section_id; ?>" action="<?php echo WB_URL; ?>/modules/wysiwyg2/save.php" enctype="multipart/form-data" method="post">

	<input type="hidden" name="page_id" value="<?php echo $page_id; ?>" />
	<input type="hidden" name="section_id" value="<?php echo $section_id; ?>" />
	<?php echo $admin->getFTAN()."\n";?>

	<?php echo $WIWYG2['HEADLINE']?>:<br/>
	<input type="text" id="headline<?php echo $section_id?>" name="headline<?php echo $section_id?>"  size="80" maxlength="200" style="width:600px" value="<?php echo $headline ?>" /><br />

	<?php echo $WIWYG2['IMAGE']?>:<br/>
	<img src="<?php echo $image?>" / title="" alt=""> <br/>

	<?php echo $WIWYG2['IMAGE_UPLOAD']?>:<br/>
	<input type="file" size="50" id="image<?php echo $section_id?>" name="image<?php echo $section_id?>"  value="" /><br/>

	<?php echo $WIWYG2['IMAGE_DELETE']?>
	<input type="checkbox" id="delete<?php echo $section_id?>" name="delete<?php echo $section_id?>" value="Delete" ><br/> <br/> 


	<?php echo $WIWYG2['CONTENT_SHORT']?>:<br/>
	<textarea id="content_short<?php echo $section_id?>" name="content_short<?php echo $section_id?>" style="width:600px" rows="4" cols="80"><?php echo $content_short?></textarea><br/>

	<?php echo $WIWYG2['CONTENT']?>:<br/>
	<?php
	show_wysiwyg_editor('content'.$section_id,'content'.$section_id,$content,'100%','350');
	?>
	
	<div style="text-align:right">   
		<input name="modify" type="submit" value="<?php echo $TEXT['SAVE']; ?>" style="min-width: 100px; margin-top: 5px;" />
		<input name="pagetree" type="submit" value="<?php echo $TEXT['SAVE'].' &amp; '.$TEXT['BACK']; ?>" style="min-width: 100px; margin-top: 5px;" />
		&nbsp;&nbsp;&nbsp;<input name="cancel" type="button" value="<?php echo $TEXT['CANCEL']; ?>" onclick="javascript: window.location = 'index.php';" style="min-width: 100px; margin-top: 5px;" />
	</div>	
</form>
<br />
