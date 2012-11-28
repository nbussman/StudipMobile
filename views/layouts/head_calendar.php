<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stud.IP Mobile</title>
    <link rel="stylesheet" href="<?= $plugin_path ?>/public/stylesheets/mobile.css" />
    <link rel="stylesheet" href="<?= $plugin_path ?>/public/vendor/jquery.mobile/custom_mobile_theme.min.css" />
    <link rel="stylesheet" href="<?= $plugin_path ?>/public/vendor/jquery.mobile/jquery.mobile-1.2.0.min.css" />

    <link rel="stylesheet"  href="<?= $plugin_path ?>/public/stylesheets/jquery.swipeButton.css" />
    <link rel="stylesheet" type="text/css" href="<?= $plugin_path ?>/public/stylesheets/bartender.min.css" /> 
    <style type="text/css">
    	.ui-page {
	    	background: url("<?= $plugin_path ?>/public/images/rag.jpg");
    	}
	</style>
    
    <script src="<?= $plugin_path ?>/public/vendor/jquery/jquery-1.8.3.min.js"></script>    
    <script src="<?= $plugin_path ?>/public/vendor/jquery.mobile/jquery.mobile-1.2.0.min.js"></script>

    <!-- MAP-->
	<script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
	<script src="<?= $plugin_path ?>/public/vendor/map/jquery.ui.map.full.min.js" type="text/javascript"></script>
    <!-- END MAP-->

    <script src="<?= $plugin_path ?>/public/javascripts/custom.js"></script>
    <!-- CUSTOM END -->
    <script src="<?= $plugin_path ?>/public/vendor/mustache/jquery.mustache.js"></script>
    <script src="<?= $plugin_path ?>/public/vendor/date/date.js"></script>
    <script src="<?= $plugin_path ?>/public/javascripts/application.js"></script>
    <script src="<?= $plugin_path ?>/public/javascripts/jquery.swipeButton.min.js"></script>
    <script>
      var STUDIP = STUDIP || {};
      STUDIP.ABSOLUTE_URI_STUDIP = "<?= $GLOBALS['ABSOLUTE_URI_STUDIP'] ?>";
    </script>
    <script>
    	//register, cause external link like class="externallink" data-ajax="false" not work for android standard browser
    	$('a.externallink').bind( 'tap', function(){ window.location = this.href; } );

    	$(document).ready(function() {
    
    		// attach the plugin to an element
    		$('#swipeMe li').swipeDelete({
    			btnTheme: 'f',
    			click: function(e){
    				e.preventDefault();
    				var url = $(e.target).attr('href');
    				$(this).parents('li').remove();
    				$.post(url, function(data) {
    					console.log(data);
    				});
    			}
    		});
    
    	});
    </script>
    
    
 </head>
