<?
	require "layout_settings.php";
?>
<!DOCTYPE html>
<html>

<head>
  <?
  	require "head_custom.php";
  ?>


<body onload="detectmobiles()">
	<div data-role="page" id="<?= $page_id ?: '' ?>">
	    <div data-role="header" data-theme="<?=TOOLBAR_THEME ?>">
	      <a href="html/settings.html" data-role="button" data-icon="gear" data-iconpos="notext">Einstellungen</a>
	        <h1><?= $page_title ?: 'Stud.IP' ?></h1>
	      <a href="html/search.html" data-role="button" data-icon="search" data-iconpos="notext">Suche</a>
	    </div>

	    
		<?= $content_for_layout ?>
	    </div>
	</div>


</body>

</html>