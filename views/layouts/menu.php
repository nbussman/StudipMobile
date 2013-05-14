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

<div data-role="page" id="main" data-hash="false">

      <div data-role="header" data-theme="b">
          <h1>Men&uuml;</h1>
      </div><!-- /header -->

      <div data-role="content">
                <ul data-role="listview">
                        <li>
                                <a href="<?= $controller->url_for("activities") ?>" data-panel="main">
                                        <img src="<?= $plugin_path ?>/public/images/icons/glyfish18/124-bullhorn.png" alt="Neuigkeiten" class="ui-li-icon ui-li-thumb">
                                        Neuigkeiten
                                </a>
                        </li>
                        <li>
                                <a href="<?= $controller->url_for("courses") ?>" data-panel="main">
                                        <img src="<?= $plugin_path ?>/public/images/icons/glyfish18/13-target.png" alt="Kurse" class="ui-li-icon ui-li-thumb" style="">
                                        Kurse
                                </a>
                        </li>
                        <li>
                                <a href="<?= $controller->url_for("dates") ?>" data-panel="main">
                                        <img src="<?= $plugin_path ?>/public/images/icons/glyfish18/83-calendar.png" alt="Termine" class="ui-li-icon ui-li-thumb">
                                        Termine
                                </a>
                        </li>
                        <li>
                                <a href="" data-panel="main">
                                        <img src="<?= $plugin_path ?>/public/images/icons/glyfish18/145-persondot.png" alt="Mein Profil" class="ui-li-icon ui-li-thumb">
                                        Mein Profil
                                </a>
                        </li>
                        <li><a href=""><img src="<?= $plugin_path ?>/public/images/icons/glyfish18/40-inbox.png" alt="Posteingang" class="ui-li-icon ui-li-thumb">Nachrichten</a>
                                <ul>
                                        <li>
                                                <a href="<?= $controller->url_for("mails") ?>" data-panel="main"  data-icon="studip-inbox" data-transition="slide">
                                                        <img src="<?= $plugin_path ?>/public/images/icons/glyfish18/40-inbox.png" alt="Posteingang" class="ui-li-icon ui-li-thumb">
                                                        Eingang
                                                </a>
                                        </li>
                                        <li>
                                                <a href="<?= $controller->url_for("mails/list_outbox") ?>" data-panel="main"  data-icon="studip-inbox" data-transition="slide">
                                                        <img src="<?= $plugin_path ?>/public/images/icons/glyfish18/44-shoebox.png" alt="Postausgang" class="ui-li-icon ui-li-thumb">
                                                        Ausgang
                                                </a>
                                        </li>
                                        <li>
                                                <a href="<?= $controller->url_for("mails/show_msg") ?>" data-panel="main">
                                                        <img src="<?= $plugin_path ?>/public/images/icons/glyfish18/18-envelope.png" alt="Neue Nachricht schreiben" class="ui-li-icon ui-li-thumb">
                                                        Neue Nachricht
                                                </a>
                                        </li>
                              </ul>
                        </li>
                        <li>
                                <a href="<?= $controller->url_for("search") ?>" data-panel="main">
                                        <img src="<?= $plugin_path ?>/public/images/icons/glyfish18/164-glasses-2.png" alt="Suchen" class="ui-li-icon ui-li-thumb">
                                        Suchen
                                </a>
                        </li>
                        <li>
                                <a href="<?= $controller->url_for("session/destroy") ?>" data-panel="main"  data-icon="studip-dates" data-iconpos="top">
                                        <img src="<?= $plugin_path ?>/public/images/icons/glyfish18/148-doghouse.png" alt="Abmelden" class="ui-li-icon ui-li-thumb">
                                        Abmelden
                                </a>
                        </li>
                </ul>
                
      </div><!-- /content -->

  <div data-role="footer" data-id="footer" data-position="fixed">
    <div data-role="navbar" data-iconspos="top">
                   <ul class="ui-grid-b">
                           <li class="ui-block-a"><a href="<?= $controller->url_for("mails/index") ?>" data-theme="c" data-icon="studip-inbox" data-transition="flip">Eingang</a></li>
                           <li class="ui-block-b"><a href="<?= $controller->url_for("mails/list_outbox") ?>" data-theme="c" data-icon="studip-shoebox"  data-transition="flip">Ausgang</a></li>
                           <li class="ui-block-c"><a href="<?= $controller->url_for("mails/show_msg") ?>" data-theme="c" data-icon="studip-envelope" data-transition="slideup">Neu Nachricht</a></li>
                   </ul>
    </div>
  </div>

</div>