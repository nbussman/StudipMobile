<title>Stud.IP Mobile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1, initial-scale=1, user-scalable=0">
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <link rel="stylesheet" href="<?= $plugin_path ?>/public/stylesheets/mobile.css" />
  <link rel="stylesheet" href="<?= $plugin_path ?>/public/vendor/jquery.mobile/custom_mobile_theme.min.css" />
  <link rel="stylesheet" href="<?= $plugin_path ?>/public/vendor/jquery.mobile/jquery.mobile-1.0rc1.min.css" />
  <link rel="stylesheet" href="<?= $plugin_path ?>/public/stylesheets/mobile.css" />
  <link rel="stylesheet" href="<?= $plugin_path ?>/public/stylesheets/startscreen.css" />
  <link rel="apple-touch-icon" href="<?= $plugin_path ?>/public/images/quickdial/ios.png" type="image/gif" />
  <link rel="stylesheet"  href="<?= $plugin_path ?>/public/stylesheets/jquery.swipeButton.css" />
  <!--
  <script src="<?= $plugin_path ?>/public/vendor/jquery/jquery-1.6.3.min.js"></script>
  -->
 <script src="http://code.jquery.com/jquery-1.6.4.js"></script>
  <script src="<?= $plugin_path ?>/public/vendor/jquery.mobile/jquery.mobile-1.0rc1.min.js"></script>
  <script src="<?= $plugin_path ?>/public/vendor/mustache/jquery.mustache.js"></script>
  <script src="<?= $plugin_path ?>/public/vendor/date/date.js"></script>
  <script src="<?= $plugin_path ?>/public/javascripts/application.js"></script>
  <script src="<?= $plugin_path ?>/public/javascripts/jquery.swipeButton.min.js"></script>
  <script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
  <script>
    $(document).ready(function() {
     
      $('.bookmark').click(function() {
        $('.bookmark').fadeOut('slow');
      }); 
    }); 
    
    
    function SetCookie(bookmark,cookieValue,nDays) {
      var today = new Date();
      var expire = new Date();
 
      if (nDays==null || nDays==0) nDays=1;
        expire.setTime(today.getTime() + 3600000*24*nDays);
        document.cookie = cookieName+"="+escape(cookieValue)
                        + ";expires="+expire.toGMTString();
      }
    
    
    function detectmobiles () {
      var ua = navigator.userAgent;
      var checker = {
        iphone: ua.match(/(iPhone|iPod|iPad)/),
        blackberry: ua.match(/BlackBerry/),
        android: ua.match(/Android/)
      };
        if (checker.iphone) {
          $('.bookmark').show();                                          
        };
    }
          
    
    function hideinfo () {
      if ( $('.bookmark').is(':visible') ) {
      $('.bookmark').fadeOut('slow');
      }
    } 
    
    window.setTimeout ("hideinfo()", 20000);
    
    $(function() {          
       $('.ticker').bind('swipeleft', function(event) {
        $('.ticker').animate({"left": "-=300px"}, "slow");
      });        
    
      $('.ticker').bind('swiperight', function(event) {
        $('.ticker').animate({"left": "+=300px"}, "slow");
      });  
           
      $(window).bind('orientationchange',function(e){
        if(window.orientation == 0) {
          $('.ticker').show();
          window.setTimeout('location.reload()');
        }
        else {
         $('.ticker').hide();
        }
      });   
    });
 
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