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


$this->set_layout("layouts/single_page_back");
$page_title = "Dateien";
$page_id = "courses-list_files";

if (sizeof($files)) 
{
    	?>
	<a href="<?= $controller->url_for("courses/dropfiles", htmlReady($seminar_id)) ?>" class="externallink" data-ajax="false" data-role="button" data-theme="b">Alle Dateien in meine Dropbox</a><br>
	<ul id="files" data-role="listview" data-filter="false" data-count-theme="b">
		<?
		foreach($files AS $file)
		{
			?>
			<li><a href="<?=$file["link"] ?>" class="externallink" data-ajax="false">
				<!-- <img src="<?= $plugin_path ?>/public/images/activities/files.png" class="ui-li-icon"> -->
				<img src="<?=$plugin_path ?><?=$file["icon_link"] ?>" class="ui-li-icon">
				<div style="padding-left:10px;">
					<h3><?=htmlReady($file["name"]) ?></h3>
					<p><strong><?=htmlReady($file["author"]) ?></strong></p>
					<p><?=htmlReady($file["description"]) ?></p>
				</div>
				<!-- <p class="ui-li-count"><strong> <?=$file["extension"] ?> </strong></p> -->
			</a></li>
			
			<?
		}
		?>
	</ul>	
	<?
} 
else 
{ 
	?>
	<ul data-role="listview" data-inset="true" data-theme="e">
		<li>Zu dieser Veranstaltung sind leider keine Dateien vorhanden.</li>
	</ul>
	<? 
} 
?>