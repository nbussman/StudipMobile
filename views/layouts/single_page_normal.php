<?
	require("layout_settings.php");
?>
<!DOCTYPE html>
<html>
 <?
  require("head_normal.php");
 ?>
  <body>
    <? include("side_menu.php"); ?>
    <div data-role="page" id="<?= $page_id ?: '' ?>" >

      <div data-role="header"  data-theme="<?=TOOLBAR_THEME ?>">
        <? include("side_menu_link.php"); ?>
        <h1><?= $page_title ?: 'Stud.IP' ?></h1>
        <a href="<?= $controller->url_for("quickdial") ?>" class="externallink" 
           data-ajax="false" data-icon="grid" data-iconpos="notext" data-theme="d"><?=_("Menu")?></a>
      </div><!-- /header -->
      
      <div data-role="content">
        <?= $content_for_layout ?>
      </div><!-- /content -->
  </body>
</html>