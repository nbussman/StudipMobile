<?
// Copyright (C) 2013  Nils Bussmann

// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.

// You should have received a copy of the GNU General Public License
// along with this program. If not, see <http://www.gnu.org/licenses/>.
?>

<head>
  <title>Stud.IP Mobile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1, initial-scale=1, user-scalable=0">
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <link rel="stylesheet" href="<?= $plugin_path ?>/public/stylesheets/mobile.css" />
  <link rel="stylesheet" href="<?= $plugin_path ?>/public/vendor/jquery.mobile/custom_mobile_theme.min.css" />
  <!-- <link rel="stylesheet" href="<?= $plugin_path ?>/public/vendor/jquery.mobile/jquery.mobile-1.2.0.min.css" /> -->
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />
  <link rel="stylesheet" href="<?= $plugin_path ?>/public/stylesheets/mobile.css" />
  <link rel="stylesheet" href="<?= $plugin_path ?>/public/stylesheets/startscreen.css" />
  <link rel="apple-touch-icon" href="<?= $plugin_path ?>/public/images/quickdial/ios.png" type="image/gif" />
  <link rel="stylesheet"  href="<?= $plugin_path ?>/public/stylesheets/jquery.swipeButton.css" />
  <!-- <link rel="stylesheet"  href="<?= $plugin_path ?>/public/stylesheets/side_menu.css" /> -->
  <!--
  <script src="<?= $plugin_path ?>/public/vendor/jquery/jquery-1.6.3.min.js"></script>
  -->
  <!--<script src="<?= $plugin_path ?>/public/vendor/jquery/jquery-1.8.3.min.js"></script>-->
  <!--<script src="<?= $plugin_path ?>/public/vendor/jquery.mobile/jquery.mobile-1.2.0.min.js"></script>-->
  <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
  <script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script> 

  <script src="<?= $plugin_path ?>/public/vendor/mustache/jquery.mustache.js"></script>
  <script src="<?= $plugin_path ?>/public/vendor/date/date.js"></script>
  <script src="<?= $plugin_path ?>/public/javascripts/application.js"></script>
  <script src="<?= $plugin_path ?>/public/javascripts/jquery.swipeButton.min.js"></script>
  <script src="<?= $plugin_path ?>/public/javascripts/side_menu.min.js"></script>
  <script>
       
    
    function SetCookie(bookmark,cookieValue,nDays) {
      var today = new Date();
      var expire = new Date();
 
      if (nDays==null || nDays==0) nDays=1;
        expire.setTime(today.getTime() + 3600000*24*nDays);
        document.cookie = cookieName+"="+escape(cookieValue)
                        + ";expires="+expire.toGMTString();
      }
      
    //register, cause external link like rel="external" not work for android standard browser
    $('a.externallink').bind( 'tap', function(){ window.location = this.href; } );
    </script>
</head>

