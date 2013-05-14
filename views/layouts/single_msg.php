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

	require("layout_settings.php")
?>
<!DOCTYPE html>
<html>

  <?
  require("head_normal.php");
  ?>


  <body>
    <div data-role="page" id="<?= $page_id ?: '' ?>" >
      <? include("side_menu.php"); ?>
      <div data-role="header" data-theme="<?=TOOLBAR_THEME ?>">
        <? include("side_menu_link.php"); ?>
        <h1><?= $page_title ?: 'Stud.IP' ?></h1>
        <a href="javascript:history.back();" class="externallink" data-ajax="false" data-icon="check" data-transition="slidedown" data-theme="<?=TOOLBAR_ABORT ?>" class="externallink" data-ajax="false">Fertig</a>
      </div><!-- /header -->

        <?= $content_for_layout ?>

    </div>
 </body>
</html>
