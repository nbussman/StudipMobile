<?
	require("layout_settings.php")
?>
<!DOCTYPE html>
<html>

  <head>
    <meta charset="windows-1252">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stud.IP Mobile</title>
    <link rel="stylesheet" href="<?= $plugin_path ?>/public/vendor/jquery.mobile/jquery.mobile-1.0rc1.min.css" />

    <script src="<?= $plugin_path ?>/public/vendor/jquery/jquery-1.6.3.min.js"></script>
    <script src="<?= $plugin_path ?>/public/vendor/jquery.mobile/jquery.mobile-1.0rc1.min.js"></script>


    <script src="<?= $plugin_path ?>/public/vendor/mustache/jquery.mustache.js"></script>
    <script src="<?= $plugin_path ?>/public/vendor/date/date.js"></script>

    <script src="<?= $plugin_path ?>/public/javascripts/application.js"></script>

    <script>
      var STUDIP = STUDIP || {};
      STUDIP.ABSOLUTE_URI_STUDIP = "<?= $GLOBALS['ABSOLUTE_URI_STUDIP'] ?>";
    </script>

  </head>


  <body>

    <div data-role="page" id="<?= $page_id ?: '' ?>" >

      <div data-role="header" data-theme="<?=TOOLBAR_THEME ?>">
        <a href="<?= $controller->url_for("quickdial") ?>" class="externallink" data-ajax="false" data-icon="grid"  data-theme="<?=TOOLBAR_BUTTONS ?>"><?=_("Menu")?></a>
        <h1><?= $page_title ?: 'Stud.IP' ?></h1>
        <a href="javascript:history.back();" class="externallink" data-ajax="false" data-icon="check" data-transition="slidedown" data-theme="<?=TOOLBAR_ABORT ?>" class="externallink" data-ajax="false">Fertig</a>
      </div><!-- /header -->

        <?= $content_for_layout ?>

    </div>
 </body>
</html>
