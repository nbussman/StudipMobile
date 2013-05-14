<?php
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

$this->set_layout("layouts/single_page_normal");
$page_title = "Kurse";
$page_id = "courses-index";

if (sizeof($courses)) {
    echo $this->render_partial('courses/_list.php');
} else { ?>
<p>Sie haben zur Zeit keine Veranstaltungen abonniert, an denen Sie teilnehmen können. Bitte nutzen Sie <a href="#">Veranstaltung suchen / hinzufügen</a> um neue Veranstaltungen aufzunehmen</p>
<? } ?>
