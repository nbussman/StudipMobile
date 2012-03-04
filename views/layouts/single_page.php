<?
	require("layout_settings.php");
?>
<!DOCTYPE html>
<html>
 <?
  require("head_custom.php");
 ?>
  <body>
    <div data-role="page" id="<?= $page_id ?: '' ?>" >

      <div data-role="header"  data-theme="<?=TOOLBAR_THEME ?>">
        <a href="<?= $controller->url_for("quickdial") ?>" rel="external" data-icon="grid" data-iconpos="notext" data-theme="d"><?=_("Menu")?></a>
        <h1><?= $page_title ?: 'Stud.IP' ?></h1>
       
      </div><!-- /header -->
      
      <div data-role="content">
        <?= $content_for_layout ?>
      </div><!-- /content -->
  </body>
</html>