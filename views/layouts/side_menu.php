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

<div  data-role="panel" id="leftpanel" data-display="reveal" data-theme="a">
    <h2>Menü</h2>
    <ul data-role="listview" data-theme="a" class="nav-search" data-inset="false" id="menu_side">
        <li class="active" data-icon="false">
            <a href="<?= $controller->url_for("quickdial") ?>" class="externallink contentLink" data-ajax="false">
                <img src="<?= $plugin_path ?>/public/images/quickdial/bw/quick.png"   class="ui-li-icon ui-corner-none"> Start
            </a>
        </li>
        <li data-icon="false"><a href="<?= $controller->url_for("activities") ?>" class="externallink contentLink" data-ajax="false">
        <img src="<?= $plugin_path ?>/public/images/quickdial/bw/news.png"   class="ui-li-icon ui-corner-none" />
        News
    </a></li>
    <li data-icon="false"><a href="<?= $controller->url_for("calendar") ?>" class="externallink contentLink" data-ajax="false">
        <img src="<?= $plugin_path ?>/public/images/quickdial/bw/schedule.png"   class="ui-li-icon ui-corner-none" />
        Planer
    </a></li>
    <li data-icon="false"><a href="<?= $controller->url_for("mails") ?>" class="externallink contentLink" data-ajax="false">
        <img src="<?= $plugin_path ?>/public/images/quickdial/bw/mail.png"   class="ui-li-icon ui-corner-none" />
        Nachrichten
    </a></li>
    <li data-icon="false"><a href="<?= $controller->url_for("courses") ?>" class="externallink contentLink" data-ajax="false">
        <img src="<?= $plugin_path ?>/public/images/quickdial/bw/seminar.png"   class="ui-li-icon ui-corner-none" />
        Kurse
    </a></li>
    <li data-icon="false"><a href="<?= $controller->url_for("profiles/show") ?>" class="externallink contentLink" data-ajax="false">
        <img src="<?= $plugin_path ?>/public/images/quickdial/bw/profile.png"   class="ui-li-icon ui-corner-none" />
        Ich
    </a></li>
    </ul>
</div><!-- /panel -->