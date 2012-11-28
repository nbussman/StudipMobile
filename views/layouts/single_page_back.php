<?
	require("layout_settings.php");
?>
<!DOCTYPE html>
<html>
 <?
  require("head_normal.php");
 ?>
  <body>
    <div data-role="page" id="<?= $page_id ?: '' ?>" >

      <div data-role="header"  data-theme="<?=TOOLBAR_THEME ?>">
        <a href="javascript:history.back()" class="externallink" data-icon="arrow-l" data-iconpos="notext" data-theme="d"><?=_("Menu")?></a>
        <h1><?= $page_title ?: 'Stud.IP' ?></h1>
       
      </div><!-- /header -->
      
      <div data-role="content">
        <?= $content_for_layout ?>
      </div><!-- /content -->
  </body>
</html>