<!DOCTYPE html>
<html>

  <head>
    <meta charset="windows-1252">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stud.IP Mobile</title>
    
    <!--for the split view -->
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="<?= $plugin_path ?>/public/vendor/jquery.mobile/compiled/jquery.mobile.css" />
    <link rel="stylesheet" href="<?= $plugin_path ?>/public/vendor/jquery.mobile/jquery.mobile.splitview.css" />
    <link rel="stylesheet"  href="<?= $plugin_path ?>/public/vendor/jquery.mobile/jquery.mobile.grids.collapsible.css" />
    <script type="text/javascript" src="<?= $plugin_path ?>/public/vendor/jquery.mobile/jquery-1.6.4.js"></script>
    <script type="text/javascript" src="<?= $plugin_path ?>/public/vendor/jquery.mobile/jquery.mobile.splitview.js"></script>
    <script type="text/javascript" src="<?= $plugin_path ?>/public/vendor/jquery.mobile/compiled/jquery.mobile.js"></script>
    <script type="text/javascript" src="<?= $plugin_path ?>/public/vendor/jquery.mobile/iscroll-wrapper.js"></script>
    <script type="text/javascript" src="<?= $plugin_path ?>/public/vendor/jquery.mobile/iscroll.js"></script>
    <!-- end of import for split view -->
    
    <link rel="stylesheet" href="<?= $plugin_path ?>/public/stylesheets/mobile.css" />

    <script src="<?= $plugin_path ?>/public/vendor/mustache/jquery.mustache.js"></script>
    <script src="<?= $plugin_path ?>/public/vendor/date/date.js"></script>

    <script src="<?= $plugin_path ?>/public/javascripts/application.js"></script>

    <script>
      var STUDIP = STUDIP || {};
      STUDIP.ABSOLUTE_URI_STUDIP = "<?= $GLOBALS['ABSOLUTE_URI_STUDIP'] ?>";
    </script>

  </head>


  <body> 
              <div data-role="panel" data-id="menu" data-hash="crumbs">
                  <!-- Start of first page -->
                  <?
                        include "menu.php";
                  ?>
                  <!-- other side panel pages here -->
              </div>
              <div data-role="panel" data-id="main">
                  <!-- Start of second page -->
                  <div data-role="page" id="<?= $page_id ?: '' ?>" >

                        <div data-role="header"  data-theme="b">
                                <a href="<?= $controller->url_for("quickdial") ?>" data-iconpos="notext" data-icon="grid"  data-theme="d"><?=_("Menu")?></a>
                                <h1><?= $page_title ?: 'Stud.IP' ?></h1>
                        </div><!-- /header -->

                        <div data-role="content">
                          <?= $content_for_layout ?>
                        </div><!-- /content -->

                  <!--
                        <div data-role="footer" data-id="footer" data-position="fixed">
                          <h4>Page Footer</h4>
                        </div><!-- /footer -->

                      </div>
                  <!-- other main panel pages here -->
              </div>
          </body>
      </html>