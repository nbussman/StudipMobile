<?php
$page_title = "Stud.IP - Login";
?>

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
