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
