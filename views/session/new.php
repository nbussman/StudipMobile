<?php
$page_title = "Stud.IP - Login";
?>
<center><img src="<?=$plugin_path ?>/public/images/logo.png" style="border:0;width:80%"></center>
<form action="<?= $controller->url_for('session/create') ?>" method="post" data-ajax="false">
  <div data-role="fieldcontain">
    <label for="username">Nutzername:</label>
    <input type="text" name="username" id="username" value="">
  </div>
  <div data-role="fieldcontain">
    <label for="password">Passwort:</label>
    <input type="password" name="password" id="password" value="">
  </div>
    <input type="submit" value="Login">
</form>
<button data-theme="e"><a href="<?=$_SERVER['HTTP_HOST'] ?>">Zur Webansicht</a></button>
