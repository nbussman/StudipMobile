<?
	require("layout_settings.php")
?>
<!DOCTYPE html>
<html>

  <?
  require("head_normal.php");
  ?>


  <body>

    <div data-role="page" id="<?= $page_id ?: '' ?>" >

      <div data-role="header" data-theme="<?=TOOLBAR_THEME ?>">
        <a href="<?= $controller->url_for("quickdial") ?>" class="externallink" 
           data-ajax="false" data-icon="grid"  data-iconpos="notext" 
           data-theme="<?=TOOLBAR_BUTTONS ?>"><?=_("Menu")?></a>
        <h1><?= $page_title ?: 'Stud.IP' ?></h1>
        <a href="javascript:history.back();" class="externallink" data-ajax="false" data-icon="check" data-transition="slidedown" data-theme="<?=TOOLBAR_ABORT ?>" class="externallink" data-ajax="false">Fertig</a>
      </div><!-- /header -->

        <?= $content_for_layout ?>

    </div>
 </body>
</html>
