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
<div data-role="content"  style="padding:15px 3px 0px;">
<?
$this->set_layout("layouts/single_msg");
$page_title = "Nachricht";
$page_id = "mail-show";
if (sizeof($mail)) 
{
        $time = date("H:i",$mail[0]['mkdate']);
        $wochentag = Helper::get_weekday(date("N", $mail[0]['mkdate']));
		$monat      = Helper::get_moth(date("m", $mail[0]['mkdate']));
		$day = $wochentag.date(", j. ",$mail[0]['mkdate']).$monat.date(", Y",$mail[0]['mkdate']);
        ?>
        <ul data-role="listview">
        			<li data-role="fieldcontain">

        					<h3><?= htmlReady($mail[0]['title']) ?></h3>
        					<p><strong><?=$day ?> </strong></p>
        			</li>
        			<li data-role="fieldcontain">
        					<p style="padding-top:12px;">
        					        <strong>An:</strong> <?= htmlReady($mail[0]['receiver']) ?><br>
        						<strong>Von:</strong> <?= htmlReady($mail[0]['author']) ?>
        					</p>
        					<span class="ui-li-count"> <?=$time ?> Uhr</span>
        			</li>
        </ul>
        <p style="font-family: Helvetica,Arial,sans-serif;font-size: 12px;font-weight: normal;white-space:wrap;">
        	<br />
        	<?= htmlReady($mail[0]['message'],TRUE, TRUE); ?>
        </p>
        <?php
}
else
{
        ?>
        <p>Beim Laden der Nachricht ist ein Fehler aufgetreten.</p>
        <?
}
?>
</div><!-- /content -->


<div data-role="footer" data-id="footer" data-position="fixed" data-theme="c">
    <div data-role="navbar" data-iconspos="top">
        <ul class="ui-grid-a">
            <li class="ui-block-a"><a id="marikieren" href="<?= $controller->url_for("mails/show_msg",htmlReady($mail[0]['id']), htmlReady(true)) ?>" data-theme="c" data-icon="star" data-transition="flip">Markieren</a></li>
            <li class="ui-block-b"><a id="antworten" href="<?= $controller->url_for("mails/write",htmlReady($mail[0]['author_id'])) ?>" data-theme="c" data-icon="check" data-transition="slideup">Antworten</a></li>
        </ul>
    </div>
</div>