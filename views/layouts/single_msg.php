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
        <a href="<?= $controller->url_for("quickdial") ?>" data-icon="grid"  data-theme="<?=TOOLBAR_BUTTONS ?>"><?=_("Menu")?></a>
        <h1><?= $page_title ?: 'Stud.IP' ?></h1>
        <a href="javascript:history.back();" data-icon="check" data-transition="slidedown" data-theme="<?=TOOLBAR_ABORT ?>" rel="external">Fertig</a>
      </div><!-- /header -->
      
      <div data-role="content"  style="padding:15px 3px 0px;">
        
        <?= $content_for_layout ?>
        
      </div><!-- /content -->


      <div data-role="footer" data-id="footer" data-position="fixed" data-theme="c">
        <div data-role="navbar" data-iconspos="top">
                       <ul class="ui-grid-b">
                               <li class="ui-block-a"><a href="<?= $controller->url_for("mails/index") ?>" data-theme="c" data-icon="star" data-transition="flip">Markieren</a></li>
                               <li class="ui-block-b"><a href="<?= $controller->url_for("mails/list_outbox") ?>" data-theme="c" data-icon="back"  data-transition="flip">Weiterleiten</a></li>
                               <li class="ui-block-c"><a href="<?= $controller->url_for("mails/show_msg") ?>" data-theme="c" data-icon="check" data-transition="slideup">Antworten</a></li>
                       </ul>
        </div>
      </div>

    </div>
 </body>
</html>
