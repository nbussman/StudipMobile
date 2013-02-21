<?
	require("layout_settings.php");
?>
<!DOCTYPE html>
<html>
 <?
  require("head_custom.php");
 ?>

<body onload="detectmobiles()">
	<? include("side_menu.php"); ?>
	<div data-role="page" id="<?= $page_id ?: '' ?>" data-scroll='true'>
	    <div data-role="header" data-theme="<?=TOOLBAR_THEME ?>">
	      <a href="<?= $controller->url_for("session/destroy") ?>" data-role="button"  
	      	 data-iconpos="noicon" class="externallink" data-ajax="false">Logout</a>
	        <h1><?= $page_title ?: 'Stud.IP' ?></h1>
	    </div>

	    <div data-role="content">
		    <?= $content_for_layout ?>
	    </div>
	</div>

</body>

</html>