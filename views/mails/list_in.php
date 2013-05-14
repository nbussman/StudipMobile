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
<div data-role="page" id="Nachrichten">
<? include dirname(__FILE__).'./../layouts/side_menu.php'; ?>
	<div data-role="header" data-theme="a">
        	<? include dirname(__FILE__).'./../layouts/side_menu_link.php'; ?>
        	<h1>Nachrichten</h1>
        	<a href="#popupMenu" data-rel="popup" data-role="button" data-inline="true">Eingang</a>
        	<div data-role="popup" id="popupMenu" data-theme="a">
				<ul data-role="listview" data-inset="true" style="min-width:210px;" data-theme="d">
					<li data-role="divider" data-theme="a">Eingang</li>
					<li><a href="<?= $controller->url_for("mails/list_outbox") ?>">Ausgang</a></li>
					<li><a href="<?= $controller->url_for("mails/write") ?>">Neue Nachricht</a></li>
				</ul>
			</div>
	</div><!-- /header -->
      <div data-role="content">
 <? //<ul id="messages" data-role="listview" data-filter="true" data-filter-placeholder="Suchen" data-inset="false" data-divider-theme="d"> ?>
 <ul id="swipeMe" data-role="listview" data-filter="true" data-filter-placeholder="Suchen" data-inset="false" data-divider-theme="d">
<?
//laden der nachrichten 
//wenn eingang leer
if ( empty($inbox) )
{
    ?>
        <li data-theme="e" data-role="list-divider" data-swipeurl=""><center>Keine Nachrichten vorhanden</center></li>
    <?
}
else
{
    //wenn array nicht leer
    foreach ($inbox as $mail)
    {
            if ( ( !$day ) || ( date("j.m.Y",$mail['mkdate']) != $dayCount ) )
            {	
            		$wochentag = Helper::get_weekday(date("N", $mail['mkdate']));
            		$monat      = Helper::get_moth(date("m", $mail['mkdate']));
            		$day = $wochentag.date(", j. ",$mail['mkdate']).$monat.date(", Y",$mail['mkdate']);

                    $dayCount = date("j.m.Y",$mail['mkdate']);
                                        ?>
                            <li  data-role="list-divider"><?= htmlReady($day) ?></li>
                    <?php
            }
        
            $time = date("H:i",$mail['mkdate']);
    ?>

            <li data-theme="c" data-swipeurl="<?= $controller->url_for("mails/index", $intervall ,htmlReady($mail['id'])) ?>">
                    <a href="<?= $controller->url_for("mails/show_msg", htmlReady($mail['id'])) ?>" data-transition="slideup">
                    <?
                    if ($mail['readed'] == 0)
                    {
                            Helper::getColorball("#1B4EA9",10);
                    }
                    else
                    {
                            Helper::getColorball("#000000",10,true);
                    }
                    ?>
                    <h3><?= htmlReady($mail['author']) ?></h3>
                    <p><strong><?= htmlReady($mail['title']) ?></strong></p>
                
                    <p><?= htmlReady($mail['message']) ?>
                    <p class="ui-li-aside"><strong><?= htmlReady($time) ?></strong></p>
            </a></li>

    <?php
    }
?>
	<li data-theme="e" data-role="list-divider" data-swipeurl=""><a href=""><center>weitere Nachrichten</center></a></li>	
<?
}
?>
</ul>
</div><!-- /content -->



</div>

